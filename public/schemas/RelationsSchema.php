<?php
class RelationsSchema extends AppSchema{
	public $table = 'relations';

	function __construct(){
		//Constroi a conexão com o banco de dados
		parent::db_config();
	}

	public function getFriends($id){
		$result = [];
		$friends1 = $this->db_con->query("SELECT * FROM `relations` WHERE user_id1 = $id AND accepted <> 0")->fetchAll(PDO::FETCH_ASSOC);
		foreach ($friends1 as $key => $friend) {
			$result[] = $friend['user_id2'];
		}

		$friends2 = $this->db_con->query("SELECT * FROM `relations` WHERE user_id2 = $id AND accepted <> 0")->fetchAll(PDO::FETCH_ASSOC);
		foreach ($friends2 as $key => $friend) {
			$result[] = $friend['user_id1'];
		}
		return $result;
	}

	public function getPendingFriends($id){
		$result = [];
		$friends2 = $this->db_con->query("SELECT * FROM `relations` WHERE user_id2 = $id AND accepted = 0")->fetchAll(PDO::FETCH_ASSOC);
		foreach ($friends2 as $key => $friend) {
			$result[] = [
				'userAdded' => $friend['user_id1'],
				'relationId' => $friend['id']
			];
		}

		return $result;
	}

	public function getSentRequests($id){
		$result = [];
		$friends2 = $this->db_con->query("SELECT * FROM `relations` WHERE user_id1 = $id AND accepted = 0")->fetchAll(PDO::FETCH_ASSOC);
		foreach ($friends2 as $key => $friend) {
			$result[] = $friend['user_id2'];
		}

		return $result;
	}

	public function getCompleteSentRequests($id){
		$result = $this->db_con->query("SELECT * FROM `relations` WHERE user_id1 = $id AND accepted = 0")->fetchAll(PDO::FETCH_ASSOC);
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

	public function acceptFriend($id){
		$result = $this->db_con->query(
			"UPDATE `relations`
			SET accepted = 1
			WHERE id = $id"
		);
	}

	public function refuseFriend($id){
		$result = $this->db_con->query(
			"DELETE FROM `relations`
			WHERE id = $id"
		);
	}
}
