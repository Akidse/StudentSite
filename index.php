<?php
include_once './loader.php';
try
{
	$route = new Router('index');
}
catch(Exception $e)
{
	die($e->getMessage());
}

include $route->getPath();
$template = new Template($route->getCurrentRoute);
$template->addVariable('title', 'Andrew');
echo $template->render();

?>