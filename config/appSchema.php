<?php
class AppSchema{

    function __construct(){

    	$db = new PDO('dblib:host='.DB_HOST.';dbname='.DB_SCHEMA.';charset=UTF-8', DB_USER, DB_PASS);

    	echo '<pre>';
    	print_r($db);
    	echo '</pre>';
    	die();
    }

}
