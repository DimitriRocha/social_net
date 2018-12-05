<?php
class PostLikesSchema extends AppSchema{

	function __construct(){
		//Constroi a conexão com o banco de dados
		parent::db_config();
	}

	public function insertLike($insertValues){
		$pdoQuery= "SELECT * FROM post_likes
		WHERE user_id = $insertValues[0]
		AND network_posts_id = $insertValues[1]";

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

			echo json_encode(true);
		} else {
			echo json_encode(false);
		}
		
		die();
	}

}
