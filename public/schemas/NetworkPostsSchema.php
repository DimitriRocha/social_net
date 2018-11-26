<?php
class NetworkPostsSchema extends AppSchema{

	public $table = 'network_posts';


	function __construct(){
		//Constroi a conexão com o banco de dados
		parent::db_config();
	}

	public function getPostsMainPage($friends){
		if (!empty($friends)) {
			$friendsString = "";
			$lastFriend = end($friends);
			foreach ($friends as $key => $friend) {
				if (!($lastFriend == $friend)) {
					$friendsString .= $friend.",";
				}else{
					$friendsString .= $friend;
				}
			}
			$pdoQuery = "SELECT network_posts.id AS post_id, name, user, content, image_url, date, count(*) as num_likes
			FROM network_posts
			LEFT JOIN users ON network_posts.user_id = users.id
			LEFT JOIN post_likes ON network_posts.id = post_likes.network_posts_id
			WHERE users.id IN(".$_SESSION['user']['id'].", $friendsString)
			GROUP BY network_posts.id
			ORDER BY network_posts.id DESC
			LIMIT 10;";
		}else{

			$pdoQuery = "SELECT network_posts.id AS post_id, name, user, content, image_url, date, count(*) as num_likes
			FROM network_posts
			LEFT JOIN users ON network_posts.user_id = users.id
			LEFT JOIN post_likes ON network_posts.id = post_likes.network_posts_id
			WHERE users.id = ".$_SESSION['user']['id']."
			GROUP BY network_posts.id
			ORDER BY network_posts.id DESC
			LIMIT 10;";
		}

		$stmt = $this->db_con->query($pdoQuery);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($results as $key => $result) {
			$sql = "SELECT users.name, comment, comment_date FROM post_comments
			LEFT JOIN users ON user_id = users.id
			WHERE network_posts_id = $result[post_id]";
			$stmt = $this->db_con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
			$results[$key]['comments'] = $stmt;
		}

		return $results;
	}

	public function insertNetworkPost($options){
		$insertValues = array();

		foreach($options as $value) {
			$insertValues[] = $value;
		}
		$pdoQuery = "INSERT INTO network_posts (user_id, content, image_url, date)
		VALUES (?,?,?,?);";

		try {
			$preparedStatement = $this->db_con->prepare($pdoQuery);
			$result = $preparedStatement->execute($insertValues);
		}
		catch (PDOException $e){
			$result = $e->getMessage();
		}

		return $result;
	}

	public function insertComment($options){
		$insertValues = array();

		foreach($options as $value) {
			$insertValues[] = $value;
		}

		$pdoQuery = "INSERT INTO post_comments (user_id, network_posts_id, comment, comment_date)
		VALUES (?,?,?,?);";

		try {
			$preparedStatement = $this->db_con->prepare($pdoQuery);
			$result = $preparedStatement->execute($insertValues);
		}
		catch (PDOException $e){
			$result = $e->getMessage();
		}

		return $result;
	}
}
