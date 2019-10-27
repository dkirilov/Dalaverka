<?php
      
	  namespace core;
	  
	  abstract class Widget{
		  
		     private $widget_name = null;
		     private $translations  = null;
		     private $css = array();
		     private $js = array();
		     private $vendor_css = array();
		     private $vendor_js = array();
			 private $user_lang = null;
			 private $widget_dir = null;
			 private $widget_lang_dir = null;
			 private $widget_front_dir_url = null;
			 
			 
			 public function  __construct($user_lang, $wgt_name){
			 	  global $dispatcher;

				  $this->setWidgetName($wgt_name);
				  $this->setWidgetDir(WIDGETS_DIR . DEFAULT_TEMPLATE . DS . $wgt_name . DS);				 
				  $this->setUserLang($user_lang);
				  $this->loadTranslations();
				  $this->loadAllCSS();
				  $this->loadAllJS();
				
               if(!empty($dispatcher->template)){
               	 $dispatcher->template->addActiveWidget($this);
               }
			 }
			 
			 private function setWidgetName($wgt_name){
				   // TODO: Widget name validation
				   
				   $this->widget_name = $wgt_name;
			 }
			 
			 public function getWidgetName(){
				  return $this->widget_name;
			 }
			 
			 private function setWidgetDir($path_to_dir){
				  if(file_exists($path_to_dir)){
					  $this->widget_dir = $path_to_dir;
					  $this->widget_front_dir_url = WIDGETS_DIR_URL . DEFAULT_TEMPLATE . "/{$this->getWidgetName()}/front/";
				  }else{
					  throw new \Exception("Widget dir '{$path_to_dir}' doesn't exist!");
				  }
			 }
			 
			 protected function setUserLang($lang_code){
				 $this->widget_lang_dir = $this->widget_dir . "lang/$lang_code/";
			     if(file_exists($this->widget_lang_dir)){
                    $this->user_lang = $lang_code;
				 }else{
					 throw new \Exception("Selected language is not available for this widget!");
				 }
			 }
			 
			 private function loadTranslations(){
				   $widget_lang_files = scandir($this->widget_lang_dir);
				   foreach($widget_lang_files as $wgt_fn){
					    if(file_exists($this->widget_lang_dir  . $wgt_fn) && strpos($wgt_fn, '.lang.php') !== false){
							 include_once($this->widget_lang_dir . $wgt_fn);
						}
				   }
				   
				   if(!empty($wgt_lang)){
				   		$this->translations = $wgt_lang;
				   }
			 }
			 
			 public function getTranslation($transl_id){
				  if(empty($transl_id)){
					  throw new \Exception('You must provide $transl_id parameter with a value!');
				  }
				  if(empty($this->translations)){
					   throw new \Exception('Translations array is empty! May be the translations are not loaded successfully.');
				  }
				  if(empty($this->translations[$transl_id])){
					   throw new \Exception("Translation with id '$transl_id' doesn't exist!");
				  }
				  
				  return $this->translations[$transl_id];
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

			private function loadAll($filter_ext, $dir_path, $dir_url, $vendor = false){
				$files = array();
				rscandir($dir_path, "", $filter_ext, $files);

				foreach ($files as $fname => $fpath) {
						$furl = $dir_url . $fpath;
						$this->add($filter_ext, $fname, $furl, $vendor);
				}
			}

			protected function loadAllCSS(){
			 	$wgt_css_dir_path = $this->widget_dir . "front" . DS . "css" . DS;
			 	$wgt_css_dir_url = $this->widget_front_dir_url . "css/";
			   
			   // Load All Own CSS
			   $this->loadAll("css", $wgt_css_dir_path, $wgt_css_dir_url);

 				// Load All external vendor CSS
 				$this->loadAll("css", $wgt_css_dir_path . "vendor" . DS, $wgt_css_dir_url . "vendor/", true);
			}

			protected function loadAllJS(){
			 	$wgt_js_dir_path = $this->widget_dir . "front" . DS . "js" . DS;
			 	$wgt_js_dir_url = $this->widget_front_dir_url . "js/";
			   
			   // Load All Own JS
			   $this->loadAll("js", $wgt_js_dir_path, $wgt_js_dir_url);

 				// Load All external vendor JS
 				$this->loadAll("js", $wgt_js_dir_path . "vendor" . DS, $wgt_js_dir_url . "vendor/", true);
			}

			 protected function addCSS(string $css_name, string $css_url){
			 	$this->add("css", $css_name, $css_url);
			 }


			 protected function addJS(string $js_name, string $js_url){
				$this->add("js", $js_name, $js_url);
			 }

			 protected function addVendorCSS(string $css_name, string $css_url){
			 	$this->add("css", $css_name, $css_url, true);
			 }


			 protected function addVendorJS(string $js_name, string $js_url){
				$this->add("js", $js_name, $js_url, true);
			 }

			 public function getAllCSS(){
			 	return $this->css;
			 }

			 public function getAllJS(){
			 	return $this->js;
			 }

			 public function getAllVendorCSS(){
			 	return $this->vendor_css;
			 }

			 public function getAllVendorJS(){
			 	return $this->vendor_js;
			 }
			 
			 public function render(){
                   global $dispatcher;
			 
				   $back_index_path = $this->widget_dir . 'back' . DS . 'index.php';
				   $front_index_path = $this->widget_dir . 'front' . DS . 'index.phtml';
				   
				   if(file_exists($back_index_path)){
					    include_once($back_index_path);
				   }
				   if(file_exists($front_index_path)){
     				   include_once($front_index_path);
				   }else{
					    throw new \Exception("Widget's index.phtml file is missing!");
				   }				   
			}
			 
	  }
?>