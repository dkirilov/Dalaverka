<?php

namespace core;

class Picture extends Item{
	private $image_url;
	private $size = array(
		'width' => '0px',
		'height' => '0px'
	);

	public function __construct(string $name, string $title, string $url, string $width, string $height){
		parent::__construct($name, "picture", $title);

		$this->setImageUrl($url);
		$this->setSize($width, $height);
	}

	protected function setImageUrl(string $url){
		$this->image_url = $url;
	}

	protected function setSize(string $width, string $height){
		$this->size['width'] = $width;
		$this->size['height'] = $height;	
	}

	public function getImageUrl(){
		return $this->image_url;
	}

	public function getWidth(){
		return $this->size['width'];
	}

	public function getHeight(){
		return $this->size['height'];
	}

	public function printHtml(){
		?>
		<img src="<?= $this->getImageUrl(); ?>" id="<?= $this->getName(); ?>" class="picture" title="<?= $this->getTitle(); ?>" width="<?= $this->getWidth(); ?>" height="<?= $this->getHeight(); ?>"/>
		<?php
	}
}


?>