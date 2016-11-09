<?php
class Router
{
	const DEFAULT_PAGE = 'index';

	private $currentRoute = NULL;

	public function __construct($route = NULL)
	{
		if($route == NULL)$route = self::DEFAULT_PAGE;
		$this->setRoute($route);
	}

	public function getPath()
	{
		return './pages/'.$this->currentRoute.'.php';
	}

	public function getTemplatePath()
	{
		return PathManager::page($this->currentRoute);
	}

	public function setRoute($route)
	{
		$route = 'index';
		if(!file_exists('pages/'.$route.'.php'))
		{
			throw new Exception('Route was not found');
		}

		$this->currentRoute = $route;
	}
}
?>