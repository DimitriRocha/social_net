<?php
//Aqui serão declarados os caminhos e variáveis globais
loadConfig("database.php");
loadConfig("core.php");
loadResources();
startProjectSchemas();
startViews();

$data;
$css;
$scripts;
$view;

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
	global $view;
	global $css;
	global $scripts;

	$cssPath = "public".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR.$pathName.DIRECTORY_SEPARATOR."style.css";
	$css[] = "<link rel='stylesheet' href='$cssPath'>";

	$view[] = glob(PROJECT_ROOT."public".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR.$pathName.DIRECTORY_SEPARATOR."view.php")[0];

	$scriptPath = "public".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR.$pathName.DIRECTORY_SEPARATOR."main.js";
	$scripts[] = "<script src='$scriptPath'></script>";
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

function startProjectCss(){
	global $css;
	foreach (glob(PROJECT_ROOT."assets".DIRECTORY_SEPARATOR."css".DIRECTORY_SEPARATOR."*.css") as $filepath)
	{
		$filename = explode(DIRECTORY_SEPARATOR, $filepath);
		$filename = end($filename);
		$cssImportStr = "assets".DIRECTORY_SEPARATOR."css".DIRECTORY_SEPARATOR.$filename;
		$css[] = "<link rel='stylesheet' href='$cssImportStr'>";
	}
}

function startProjectJs(){
	global $scripts;
	foreach (glob(PROJECT_ROOT."assets".DIRECTORY_SEPARATOR."js".DIRECTORY_SEPARATOR."*.js") as $filepath)
	{
		$filename = explode(DIRECTORY_SEPARATOR, $filepath);
		$filename = end($filename);
		$scriptsImportStr = "assets".DIRECTORY_SEPARATOR."js".DIRECTORY_SEPARATOR.$filename;
		$scripts[] = "<script src='$scriptsImportStr'></script>";
	}
}

function set($variablesArray){
	global $data;
	$data = $variablesArray;
}

function importComponent($viewName){
	global $css;
	echo "<div class='{$viewName}Component'>";
	echo "<style scoped>\n";
	@include_once(PROJECT_ROOT."public".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."components".DIRECTORY_SEPARATOR.$viewName.DIRECTORY_SEPARATOR."style.css");
	echo "</style>";
	if (! @include_once(PROJECT_ROOT."public".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."components".DIRECTORY_SEPARATOR.$viewName.DIRECTORY_SEPARATOR."view.php")){
		throw new Exception ('View file does not exist');
	}else{

		echo "<script>";
		@include_once(PROJECT_ROOT."public".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR."components".DIRECTORY_SEPARATOR.$viewName.DIRECTORY_SEPARATOR."main.js");
		echo "</script>";
	}
	echo '</div>';
}

function startViews(){
	startProjectCss();
	startProjectJs();
	startProjectFolderByRequest();
}

function getImage($imageName){
	return "../../..".PROJECT_PATH."/assets/images/".$imageName;
}

function redirect($place){
	$redirection = 'Location: '.PROJECT_PATH.$place;
	header($redirection);
}
