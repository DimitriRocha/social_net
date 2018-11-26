<?php
class RelationsSchema extends AppSchema{
	public $table = 'relations';

	function __construct(){
		//Constroi a conexão com o banco de dados
		parent::db_config();
	}

	public function getFriends($id){
		$result = [];
		$friends1 = $this->db_con->query("SELECT * FROM `relations` WHERE user_id1 = $id")->fetchAll(PDO::FETCH_ASSOC);
		foreach ($friends1 as $key => $friend) {
			$result[] = $friend['user_id2'];
		}

		$friends2 = $this->db_con->query("SELECT * FROM `relations` WHERE user_id2 = $id")->fetchAll(PDO::FETCH_ASSOC);
		foreach ($friends2 as $key => $friend) {
			$result[] = $friend['user_id1'];
		}
		return $result;
	}

	public function addFriend($loggedUser, $id){
		$now = time();
		$result = $this->db_con->query(
			"INSERT INTO `relations`
			(
				user_id1,
				user_id2,
				invite_date,
				accepted
			)
			VALUES
			(
				$loggedUser,
				$id,
				$now,
				0
			)"
		);
	}
}
