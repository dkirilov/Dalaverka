<?php
	use \core\Banner;
	use \core\Item;

	class DalaverkaCarousel extends \core\Widget{
		private $name = "";
		private $title = "";
		private $items = array();

		public function __construct($user_lang, $name, $title = ""){
		   parent::__construct($user_lang, get_class());

		   $this->setTitle($title);
		}

		public function setName(string $name){
			$this->name = $name;
		}

		public function getName(){
			return $this->name;
		}

		public function setTitle($title){
			$this->title = $title;
		}

		public function getTitle(){
			return $this->title;
		}

		public function addItem(Item $item){
			$this->items[$item->getName()] = $item;
		}

		public function removeItem(Item $item){
			unset($this->items[$item->getName()]);
		}

		public function getItem($item_name){
			return $this->items[$item_name];
		}

		public function getItems(){
			return $this->items;
		}

		public function countItems(){
			return count($this->items);
		}
	}

?>