<?php
// phpinfo();
// die();
define("PROJECT_ROOT", __DIR__ . DIRECTORY_SEPARATOR);
//Adicionar caminho adicional da url caso não esteja na raiz
define("PROJECT_PATH", "/social_net");
?>
<?php include("config/bootstrap.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Social Net</title>
	<?php
	foreach ($css as $key => $cssItem) {
		echo($cssItem);
	}
	?>
</head>
<body>
	<?php
	foreach ($view as $key => $viewItem) {
		include($viewItem);
	}

	foreach ($scripts as $key => $script) {
		echo($script);
	}
	?>
</body>
</html>
