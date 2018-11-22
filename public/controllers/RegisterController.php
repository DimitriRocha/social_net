<?php
class RegisterController extends AppController{
	public $UsersSchema;

	function __construct(){
		$this->UsersSchema = new UsersSchema();
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}

	public function index(){
		$result = $this->UsersSchema->findAll();
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$result = $this->registerUser($_POST['name'],$_POST['user'],$_POST['pass'],$_POST['occupation']);

			if ($result) {
				redirect("/login");
			}else{
				$_SESSION['error'];
				redirect("/register");
			}
		}
		set([$result]);
	}

	public function registerUser($name, $user, $pass, $occupation){
		$result = $this->UsersSchema->insert([
			'name' => $name,
			'user' => $user,
			'pass' => $pass,
			'occupation' => $occupation
		]);

		return $result;
	}
}
