<?php

	namespace core;
	/**
	* This class just stores some info about given banner
	*/
	class Banner extends Picture
	{
		private $discount = null;
		private $link = null;

		public function __construct(string $name, string $title, string $url, string $width, string $height, string $link,  int $discount = 0){
			parent::__construct($name, $title, $url, $width, $height);
			$this->setType("banner");

			$this->setLink($link);
			$this->setDiscount($discount);
		}

		private function setLink(string $link){
			$this->link = $link;
		}

		private function setDiscount(int $discount = 0){
			if($discount > 0){
				throw new \Exception("Banner discount should be negative number!", 102);
			}

			if($discount < -100){
				throw new \Exception("Banner discount cannot be more than -100 percent!", 103);
			}

			$this->discount = $discount;
		}

		public function getLink(){
			return $this->link;
		}

		public function getDiscount(){
			return $this->discount;
		}

		public function printHtml(){
			?>
			<!-- <?= $this->getName(); ?> banner -->
			<div id="<?= $this->getName(); ?>" class="banner">
				<a href="<?= $this->getLink(); ?>" class="banner-link" title="<?= $this->getTitle(); ?>" target="_blank">
					<img src="<?= $this->getImageUrl(); ?>" class="banner-image" style="max-width: <?= $this->getWidth(); ?>; max-height: <?= $this->getHeight(); ?>;" />
				</a>
			</div>
			<?php
		}
	}