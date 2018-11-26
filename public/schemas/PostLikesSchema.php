<?php
class PostLikesSchema extends AppSchema{

	function __construct(){
		//Constroi a conexão com o banco de dados
		parent::db_config();
	}

	public function insertLike($options){
		$insertValues = array();

		foreach($options as $value) {
			$insertValues[] = $value;
		}

		$pdoQuery= "SELECT * FROM post_likes
		WHERE user_id = $insertValues[0]
		&& network_posts_id = $insertValues[1]";

		$result = $this->db_con->query($pdoQuery)->fetchAll();

		if(empty($result)){
			$pdoQuery = "INSERT INTO post_likes (user_id, network_posts_id)
			VALUES (?,?);";

			try {
				$preparedStatement = $this->db_con->prepare($pdoQuery);
				$result = $preparedStatement->execute($insertValues);
			}
			catch (PDOException $e){
				$result = $e->getMessage();
			}

			return $result;
		} else {
			return 0;
		}
	}

}
