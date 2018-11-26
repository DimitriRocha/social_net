<?php
abstract class AppSchema{
	public $db_con;

	function __construct(){

	}

	protected function db_config(){
		$this->db_con = new PDO('mysql:host='.DB_HOST.';dbname='.DB_SCHEMA.';port=3306', DB_USER, DB_PASS);
		$this->db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}


	function insert($values){
		$columns = array();
		$insertValues = array();
		$queryVariables = '';
		$table = $this->table;

		if(isset($values['pass'])){
			$values['pass'] = password_hash($values['pass'], PASSWORD_BCRYPT);
		}

		foreach ($values as $key => $value) {
			$columns[] = "`". $key ."`";
			$insertValues[] = $value;
			$queryVariables .= '?,';
		}

		$queryVariables = substr_replace($queryVariables ,"", -1);
		$fieldsStr = implode(',', $columns);

		$pdoQuery = "INSERT INTO $table ($fieldsStr) VALUES ($queryVariables)";

		try {
			$preparedStatement = $this->db_con->prepare($pdoQuery);
			$result = $preparedStatement->execute($insertValues);
		}
		catch (PDOException $e){
			$result = $e->getMessage();
		}

		return $result;
	}

	function findAll($options = []){
		$pdoQuery = "SELECT * FROM $this->table";

		if (isset($options['conditions'])) {
			$condStr = " WHERE ";
			foreach ($options['conditions'] as $key => $condition) {
				$colString = $key;
				$valString = $condition;
				// $valString = addslashes($condition);
				if (!preg_match('/([\=\<\>])|(!=)/', $key)) {
					$colString .= " =";
				}
				if (!preg_match('/\b(OR)\b/', $condition)) {
					$valString .= " AND ";
				}else{
					$valString .= " ";
				}
				$condStr .= "$colString $valString";
			}
			$condStr = substr_replace($condStr ,"", -4);
			$pdoQuery .= $condStr;
		}

		if (isset($options['limit']) && $options['limit'] > 0) {
			$pdoQuery .= "LIMIT $limit";
		}
		try{
			$stmt = $this->db_con->query($pdoQuery);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}catch (PDOException $e){
			$result = $e->getMessage();
		}

		return $result;
	}

	function getPostsMainPage($options = []){
		$pdoQuery = "SELECT network_posts.id AS post_id, name, user, content, image_url, date, (count(*) - 1) as num_likes
					 FROM network_posts 
				     LEFT JOIN users ON network_posts.user_id = users.id
					 LEFT JOIN post_likes ON network_posts.id = post_likes.network_posts_id
					 WHERE users.id = ".$_SESSION['user']['id']."
					 GROUP BY network_posts.id
					 ORDER BY network_posts.id DESC 
					 LIMIT 10;";

		$stmt = $this->db_con->query($pdoQuery);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
	
	function insertNetworkPost($options){
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

	function insertComment($options){
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
