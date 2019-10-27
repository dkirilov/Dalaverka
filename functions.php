<?php

		function custom_exception_handler(Throwable $ex){
		        if(!DEV_MODE){
		        	switch($ex->getCode()){
		        		case 404:
					  		\core\Template::render404(DEFAULT_TEMPLATE);
					  		break;					  		
					  	default:
					  		display_error($ex->getCode(), $ex->getMessage());
					  		break;
		        	}
				}else{		  
					display_error_dev($ex);
				}
		}

		function display_error($error_code, $error_message){
			require(SYSTEM_TEMPLATES_DIR . 'error.php');
		}

		function display_error_dev(Throwable $ex){
			require(SYSTEM_TEMPLATES_DIR . 'error_dev.php');
		}

		function rscandir($dir_path, $addon_path = "", $filter_extension = "", array &$all_file_names = array()){
			$dir_to_scan = $dir_path . $addon_path;
			$dir_files = scandir($dir_to_scan);
			$last_file = $dir_files[count($dir_files)-1];
			foreach ($dir_files as $file) {
				$fext = pathinfo($file, PATHINFO_EXTENSION);
				$fname = pathinfo($file, PATHINFO_FILENAME);

				if(strtolower($fext) == strtolower($filter_extension)){
					$all_file_names[$fname] = $addon_path.$file;
				}else if($file !== "." && $file !== ".." && is_dir($dir_path . $file)){
					$addon_path .= $file . DIRECTORY_SEPARATOR;
					rscandir($dir_path, $addon_path, $filter_extension, $all_file_names);
				}

  			    if($last_file == $file){
  			    	if(empty($addon_path)){
  			    		return !empty($all_file_names);
  			    	}else{
  			    		$addon_path  = explode(DIRECTORY_SEPARATOR, $addon_path);
  			    		unset($addon_path[count($addon_path)-1]);
  			    		$addon_path = implode(DIRECTORY_SEPARATOR, $addon_path);
  			    	}
  			    }
			}

		}

?>