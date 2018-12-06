<?php
class UsersSchema extends AppSchema{
	public $table = 'users';

	function __construct(){
		//Constroi a conexão com o banco de dados
		parent::db_config();
	}

	public function getSugestedFriends($id, $friends){
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

			$result = $this->db_con->query("SELECT * FROM `users` WHERE id NOT IN($id, $friendsString) ORDER BY RAND() LIMIT 0,10")->fetchAll(PDO::FETCH_ASSOC);
		}else{
			$result = $this->db_con->query("SELECT * FROM `users` WHERE id NOT IN($id) ORDER BY RAND() LIMIT 0,10")->fetchAll(PDO::FETCH_ASSOC);
		}
		return $result;
	}

	public function getUserByID($id){
		$stmt = $this->db_con->query("SELECT *
			FROM `users`
			WHERE id = $id"
		);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function searchUser($searchQuery){
		$searchQuery = "%$searchQuery%";
		$stmt = $this->db_con->prepare("SELECT * FROM `users` WHERE name LIKE :searchQuery");
		$stmt->bindParam(':searchQuery', $searchQuery, PDO::PARAM_STR, 30);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}
}
