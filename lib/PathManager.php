<?php
class PathManager
{
	public static function getRootDirectory()
	{
		return $_SERVER['DOCUMENT_ROOT'];
	}
	public static function template($routeName)
	{
		return self::getRootDirectory().'/template/'.$routeName.'.tpl';
	}

	public static function page($routeName)
	{
		return self::getRootDirectory().'/page/'.$routeName.'.php';
	}
}
?>