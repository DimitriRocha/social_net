<?php
abstract class AppController{

	function __construct(){

	}

	function auth(){
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			header("Location: login");
		}
	}

	function userIsLoggedIn(){
		if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}
}
