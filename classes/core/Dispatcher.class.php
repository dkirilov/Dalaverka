<?php

namespace core;

class Dispatcher{
	
	private $template_name = null;
	public $template = null;
	private $params = null;
	private $lang_code = null;

	public function __construct(string $template_name, string $lang_code, string $req_path = "/"){
		$this->setTemplateName($template_name);
		$this->setLangCode($lang_code);
		$this->setParams($req_path);
	}
	
	public  function run(){
		  $this->template = new \core\Template(DEFAULT_TEMPLATE);
		  $this->template->render($this->getPageName(), $this->getLangCode());	  
	}

	public function getTemplateName(){
		return $this->template_name;
	}
	
	public function getPageName(){
		   return empty($this->getParam(0))?DEFAULT_PAGE:$this->getParam(0);
	}
	
	public function getParams(){
		 return $this->params;
	}
	
	public function getParam($param_no){
		 return $this->params[$param_no];
	}

	public function getLangCode(){
		return $this->lang_code;
	}

	public function setTemplateName(string $template_name){
		if(!$this->templateExists($template_name)){
			throw new \Exception("Template with name $template_name doesn't exist! You can create it or change template name to one that exists.", 123);
		}

		$this->template_name = $template_name;
	}

	public function setLangCode(string $lang_code){
		if(!$this->langExists($lang_code)){
			throw new \Exception("Language with code <b>$lang_code</b> isn't installed yet on this web site! Please change lang code to one that exists or create new one who corresponds to <b>$lang_code</b>.", 125);
		}

		$this->lang_code = $lang_code;
	}

	public function setParams(string $request_path){
		  $this->params = explode('/', $request_path);		
	}

	private function templateExists(string $template_name){
		return file_exists(TEMPLATES_DIR . $template_name);
	}

	private function langExists(string $lang_code){
		if(empty($this->template_name)){
			throw new \Exception("Template name isn't set! You should set template name first.", 124);
		}

		return file_exists(TEMPLATES_DIR . $this->template_name . DS . 'lang' . DS . $lang_code);
	}
}

?>