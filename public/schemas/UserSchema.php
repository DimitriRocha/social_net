<?php
class UsersSchema extends AppSchema{
	public $table = 'users';

	function __construct(){
		//Constroi a conexão com o banco de dados
		parent::db_config();
	}

	function getSugestedFriends($id, $friends){
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

	function getUserByID($id){
		$result = $this->db_con->query(
			"SELECT *
			 FROM `users`
			 WHERE id = $id"
			 )->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
}
