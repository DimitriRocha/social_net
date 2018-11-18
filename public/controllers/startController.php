<?php
class StartController extends AppController{
	public $UsersSchema;

	function __construct(){
		$this->UsersSchema = new UsersSchema();
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
