<?php
class StartController{
	function __construct(){
		echo "Start Controller ^^";
	}

	public function index(){
		echo "Started function wow";
	}

	public function teste($first, $second){
		echo "The test $first worked WOW $second";
	}
}
