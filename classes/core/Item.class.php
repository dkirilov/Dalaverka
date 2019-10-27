<?php

namespace core;

abstract class Item{
	private $name;
	private $type;
	private $title;

	public function __construct(string $name, string $type, string $title){
		$this->setName($name);
		$this->setType($type);
		$this->setTitle($title);
	}

	protected function setName(string $name){
		$this->name = $name;
	}

	public function getName(){
		return $this->name;
	}

	protected function setType(string $type){
		$this->type = $type;
	}

	public function getType(){
		return $this->type;
	}

	protected function setTitle(string $title){
		$this->title = $title;
	}

	public function getTitle(){
		return $this->title;
	}

	abstract public function printHtml();
}

?>