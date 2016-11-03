<?php
class Template
{
	const COMMON_TEMPLATE = 'common';

	private $currentTemplateName = NULL;

	private $variables = array();
	private $switchers = array();

	public function __construct($routeName = NULL)
	{
		if($routeName == NULL)$routeName = self::COMMON_TEMPLATE;
		$this->currentTemplateName = $routeName;
	}

	public function getTemplatePath()
	{
		return PathManager::template($this->currentTemplateName);
	}

	private function parseTemplate()
	{
		$template = file_get_contents($this->getTemplatePath());
		$template = $this->parseVariables($template);
		$template = $this->parseSwitchers($template);

		return $template;
	}

	public function render()
	{
		return $this->parseTemplate();
	}

	private function parseVariables($content)
	{
		foreach($this->variables as $key => $value)
		{
			$content = str_replace('{'.$key.'}', $value, $content);
		}

		return $content;
	}

	private function parseSwitchers($content)
	{
		foreach($this->switchers as $key => $value)
		{
			$content = preg_replace('~<\!--start:'.$key.'-->(.*)<\!--end:'.$key.'-->~isU', ($value?'$1':''), $content);
			$content = preg_replace('~<\!--start:\!'.$key.'-->(.*)<\!--end:\!'.$key.'-->~isU', ($value?'':'$1'), $content);
		}

		return $content;
	}

	public function addVariable($name, $value)
	{
		$this->variables[$name] = $value;
	}

	public function getVariable($name)
	{
		if(isset($this->variables[$name]))return $this->variables[$name];
		else
			throw new Exception("Such variable doesn't exists");
	}

	public function setSwitch($name, $value)
	{
		$this->switchers[$name] = $value;
	}
}
?>