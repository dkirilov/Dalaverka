<?php

     class DalaverkaSlider extends \core\Widget{
		  public function __construct($user_lang){
			   parent::__construct($user_lang, get_class());

			   if(!$this->jQueryLoaded()){
			   	 // Then loads jQuery
			     $this->addVendorJS("jQuery", "https://code.jquery.com/jquery-3.4.1.min.js");
               }
		  }

		  private function jQueryLoaded(){
		  	   global $dispatcher;

		  	   return $dispatcher->template->isLoaded("js", "jQuery");
		  }
	 }

?>