<?php
class UsersSchema extends AppSchema{
	public $table = 'users';

	function __construct(){
		//Constroi a conexão com o banco de dados
		parent::db_config();
	}


}
