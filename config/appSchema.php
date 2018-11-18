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
				$valString = addslashes($condition);
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
}
