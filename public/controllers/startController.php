<?php
class StartController extends AppController{
	function __construct(){

	}

	public function index(){
        echo "Start controller function index";
        set(
        	[
        		"hello" => "world"
        	]
        );
	}

	public function teste(){

	}
}
