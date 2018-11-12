<?php
//Aqui serão declarados os caminhos e variáveis globais
loadConfig("database.php");
loadConfig("core.php");
loadResources();
loadAsset("css/main.css");
startProjectSchemas();
startProjectFolderByRequest();
loadAsset("js/main.js");

$data = [];
//Declaração das funções de includes
function loadAsset($path){
	include(PROJECT_ROOT."assets".DIRECTORY_SEPARATOR.$path);
}

function loadConfig($path){
	include(PROJECT_ROOT."config".DIRECTORY_SEPARATOR.$path);
}

function loadResources(){
	include(PROJECT_ROOT."config".DIRECTORY_SEPARATOR."appController.php");
	include(PROJECT_ROOT."config".DIRECTORY_SEPARATOR."appSchema.php");
}

function startProjectFolderByRequest(){
	$uri = $_SERVER['REQUEST_URI'];
    $uri = str_replace(PROJECT_PATH, "", $uri);
	$uri = explode("/", $uri);
	if ($uri[1] == "") {
		$pathName = "start";
	}else{
		$pathName = $uri[1];
	}

	if (! @include_once(PROJECT_ROOT."public".DIRECTORY_SEPARATOR."controllers".DIRECTORY_SEPARATOR.$pathName."Controller.php")){
		throw new Exception ('Controller file does not exist');
	}
	if (isset($uri[2])) {
		if ($uri[2] == "") {
			$dynamicFunc = "index";
		}else {
			$dynamicFunc = $uri[2];
		}
	}else{
		$dynamicFunc = "index";
	}

	$classname = $pathName;
	$classname .= "Controller";
	$classname = ucfirst($classname);
	$parameters = array_slice($uri, 3);
	//Inicializando o controller
	$refl = new ReflectionClass($classname);
	$controllerInstance = $refl->newInstanceArgs();
	call_user_func_array(array($controllerInstance, $dynamicFunc), $parameters);

	global $data;
	
	if (! @include_once(PROJECT_ROOT."public".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR.$pathName.DIRECTORY_SEPARATOR."view.php")){
		throw new Exception ('View file does not exist');
	}else{
		@include_once(PROJECT_ROOT."public".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR.$pathName.DIRECTORY_SEPARATOR."main.js");
		@include_once(PROJECT_ROOT."public".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR.$pathName.DIRECTORY_SEPARATOR."styles.css");
	}
}

function startProjectSchemas(){
	foreach (glob(PROJECT_ROOT."public".DIRECTORY_SEPARATOR."schemas".DIRECTORY_SEPARATOR."*.php") as $filepath)
	{
		include($filepath);
		//Remove o caminho do arquivo para buscar apenas o nome
		$filename = explode(DIRECTORY_SEPARATOR, $filepath);
		$filename = end($filename);
		//Remove nome da extensão
		$name = explode(".", $filename);
		$name = $name[0];
		$name = ucfirst($name);

	}
}

function set($variablesArray){
	global $data;
	$data = $variablesArray;
}

	
