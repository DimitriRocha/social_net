<?php
class LoginController extends AppController{
	public $UsersSchema;

	function __construct(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$this->UsersSchema = new UsersSchema();
	}

	public function index(){
		if ($this->userIsLoggedIn()) {
			header("Location: /");
		}

		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			$this->requestUserLogin($_POST['nickname'], $_POST['pass']);
			header('Location: /');
		}
	}

	public function requestUserLogin($nickname, $pass){
		addslashes($nickname);
		addslashes($pass);
		$result = $this->UsersSchema->findAll(
			[
				'conditions' => [
					'user' => "'$nickname'"
				]
			]
		);
		@$result = $result[0];

		if (!empty($result) && password_verify($pass, $result['pass'])){
			$_SESSION['user'] = $result;
		}else{
			$_SESSION['error'] = "Usuário ou senha incorretos!!!";
		}
	}
}
