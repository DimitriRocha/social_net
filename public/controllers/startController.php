<?php
class StartController extends AppController{
	public $UsersSchema;

	function __construct(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$this->UsersSchema = new UsersSchema();
		$this->auth();
	}

	public function index(){

		// $this->UsersSchema->insert([
		// 	'name' => 'Teste',
		// 	'user' => 'teste',
		// 	'pass' => '123456'
		// ]);

		$result = $this->UsersSchema->findAll();

		set([$result]);
	}

	public function teste(){

	}
}
