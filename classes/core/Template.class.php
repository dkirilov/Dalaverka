<?php

namespace core;

define('DEFAULT_CSS_DIR_URL', TEMPLATES_DIR_URL . DEFAULT_TEMPLATE . '/front/css/');
define('DEFAULT_JS_DIR_URL', TEMPLATES_DIR_URL . DEFAULT_TEMPLATE . '/front/js/');
define('DEFAULT_IMG_DIR_URL', TEMPLATES_DIR_URL . DEFAULT_TEMPLATE . '/front/img/');

class Template{
	private $template_name = null;
	private $css = array();
	private $js = array();
	private $vendor_css = array();
	private $vendor_js = array();
	private $active_widgets = array();


    public function __construct($template_name){
    	$this->template_name = $template_name;

    	$this->loadAllCSS();
    	$this->loadAllJS();
    }

    private function add($fext, $fname, $furl, $vendor = false){
    	switch ($fext) {
    		case 'css':
    			if($vendor){
    				$this->vendor_css[$fname] = $furl;
    			}else{
    				$this->css[$fname] = $furl;
    			}
    			break;
    		case 'js':
    			if($vendor){
    				$this->vendor_js[$fname] = $furl;
    			}else{
    				$this->js[$fname] = $furl;
    			}
	   			break;		
    		default:
    			break;
    	}
    }

    public function addJS($js_name, $js_url){
    	$this->add("js", $js_name, $js_url);
    }

    public function addCSS($css_name, $css_url){
    	$this->add("css", $css_name, $css_url);
    }

    public function addVendorJS($js_name, $js_url){
    	$this->add("js", $js_name, $js_url, true);
    }

    public function addVendorCSS($css_name, $css_url){
    	$this->add("css", $css_name, $css_url, true);
    }

	public function addActiveWidget(Widget $widget){
		if(!empty($widget)){
			$this->active_widgets[] = $widget;
		}
	}

	public function isLoaded($ext, $name){
		$flist = false;

		switch ($ext) {
			case 'css':
				$flist = $this->getAllCSS();
				break;
			case 'js':
				$flist = $this->getAllJS();
				break;		
			default:
				break;
		}

		return array_key_exists($name, $flist);
	}

    private function loadAll($filter_ext, $dir_path, $dir_url, $vendor = false){
    	$files = array();
    	rscandir($dir_path, "", $filter_ext, $files);

    	foreach ($files as $fname => $fpath) {
    			$furl = $dir_url . $fpath;
    			$this->add($filter_ext, $fname, $furl, $vendor);
    	}
    }

    private function loadAllCSS(){
    	$css_dir_path = TEMPLATES_DIR . $this->template_name . DS . "front" . DS . "css" . DS;

    	// Loads Own Template CSS
 		$this->loadAll("css", $css_dir_path, DEFAULT_CSS_DIR_URL);

 		// Loads external vendor CSS
 		$this->loadAll("css", $css_dir_path."vendor".DS, DEFAULT_CSS_DIR_URL."vendor/", true);
    }

    private function loadAllJS(){
    	$js_dir_path = TEMPLATES_DIR . $this->template_name . DS . "front" . DS . "js" . DS;

    	// Loads Own Template JS
 		$this->loadAll("js", $js_dir_path, DEFAULT_JS_DIR_URL);

 		// Loads external vendor JS
 		$this->loadAll("js", $js_dir_path."vendor".DS, DEFAULT_JS_DIR_URL."vendor/", true);
    }

	 public function getAllCSS(){
	 	$allcss = $this->css;
	 	foreach ($this->active_widgets as $wgt) {
	 		$allcss = array_merge($allcss, $wgt->getAllCSS());
	 	}

	 	return $allcss;
	 }

	 public function getAllJS(){
	 	$alljs = $this->js;
	 	foreach ($this->active_widgets as $wgt) {
	 		$alljs = array_merge($alljs, $wgt->getAllJS());
	 	}

	 	return $alljs;
	 }

	 public function getAllVendorCSS(){
	 	$allcss = $this->vendor_css;
	 	foreach ($this->active_widgets as $wgt) {
	 		$allcss = array_merge($allcss, $wgt->getAllVendorCSS());
	 	}

	 	return $allcss;
	 }

	 public function getAllVendorJS(){
	 	$alljs = $this->vendor_js;
	 	foreach ($this->active_widgets as $wgt) {
	 		$alljs = array_merge($alljs, $wgt->getAllVendorJS());
	 	}

	 	return $alljs;
	 }

	public function render($page_name, $lang_code){
	     $this->loadLanguage($page_name, $lang_code);
	     $this->loadPage($page_name);
	}
	
	public static function render404($template_name){
		include_once(TEMPLATES_DIR_URL . $template_name . '/front/404.php');
	}
	
	public static function getTitle(){
		global $dispatcher, $LANG;
		
		 if(!empty($LANG['page_title'])){
			 return $LANG['page_title'];
		 }else if(!empty($dispatcher)){
			 return $dispatcher->getPageName();
		 }else{
			 throw new \Exception('You have to load a page before you can get page titles!');
		 }
	}
	
	private function loadLanguage($page_name, $lang_code){
		     global $LANG;
			 
			 // Loading common language file
		      $path = TEMPLATES_DIR . $this->template_name .  DS . "lang" . DS . $lang_code . DS . "common.lang.php";
               if(file_exists($path)){
                    require_once($path);
               }else{
				    throw new \Exception('Common language file is missing!', 404);
			   }
			   
			   // Loading the language file related to current page
		       $path = TEMPLATES_DIR . $this->template_name . DS . "lang" . DS . $lang_code . DS . $page_name . ".lang.php";
               if(file_exists($path)){
                    require_once($path);
               }else{
				    throw new \Exception('No language file for current page!', 404);
			   }
	}

	private function loadPage($page_name){
		 $common_dir_path = TEMPLATES_DIR . $this->template_name . DS . 'front' . DS . 'common' . DS;

		 $common_php_path = $common_dir_path . 'common.back.php';
	     $header_path = $common_dir_path . 'header.phtml';
		 $footer_path = $common_dir_path . 'footer.phtml';
		 $backend_path = TEMPLATES_DIR . $this->template_name . DS . 'back' . DS . $page_name . '.back.php';
		 $frontend_path = TEMPLATES_DIR . $this->template_name . DS. 'front' . DS . $page_name . '.front.php';

		 if(file_exists($common_php_path)){
		 	include($common_php_path);
		 }

		 if(file_exists($header_path)){
			 include_once($header_path);			 
		 }else{
			 throw new \Exception('No header file!',404);
		 }
		 
		 if(file_exists($backend_path)){
			 include_once($backend_path);			 
		 }else{
			 throw new \Exception('No backend file!',404);
		 }
		 
		 if(file_exists($frontend_path)){
			 include_once($frontend_path);			 
		 }else{
			 throw new \Exception('No frontend file!',404);
		 }
		 	
		if(file_exists($footer_path)){
			 include_once($footer_path);			 
		 }else{
			 throw new \Exception('No footer file!',404);
		 }
	}
}

?>