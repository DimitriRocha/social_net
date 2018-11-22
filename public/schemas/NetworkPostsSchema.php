<?php
class NetworkPostsSchema extends AppSchema{

	public $table = 'network_posts';


	function __construct(){
		//Constroi a conexão com o banco de dados
		parent::db_config();
	}
	
}
