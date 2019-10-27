<?php

namespace core;

use \core\Item;

class Product extends Item{
	private $descr;
	private $pictures;
	private $price;
	private $currency;
	private $promo_price;
	private $discount; // Discount in percents
	private $publisher;
	private $affiliate_link;
	private $promo_expires_on;
	
	public function __construct(string $name, string $title, string $descr, float $price, float $promo_price, string $currency, string $publisher, string $affiliate_link = "", string $expires_on){

		parent::__construct($name, "product", $title);

		$this->setDescription($descr);
		$this->setPrice($price);
		$this->setPromoPrice($promo_price);
		$this->setCurrency($currency);
		$this->setPublisher($publisher);
		$this->setAffiliateLink($affiliate_link);
		$this->setPromoExpiresOn($expires_on);
	}

	private function setDescription(string $description){
		$this->descr = $description;
	}

	private function setPrice(float $price){
		$this->price = $price;
	}

	private function setPromoPrice(float $promo_price){
		if($this->price <= $promo_price){
			throw new \Exception("Invalid promo price! Promo price should be smaller than regular price!", 101);
		}

		$this->promo_price = $promo_price;

		// Calculates discount percentage
		$this->discount = -100 + round( ($promo_price / $this->price) * 100 ); 
	}

	private function setCurrency(string $currency){
		$this->currency = $currency;
	}

	private function setPublisher(string $publisher){
		$this->publisher = $publisher;
	}

	private function setAffiliateLink(string $link){
		$this->affiliate_link = $link;
	}

	private function setPromoExpiresOn(string $date){
		$this->promo_expires_on = $date;
	}

	public function getDescription(){
		return $this->descr;
	}

	public function getPrice(){
		return number_format($this->price, 2);
	}

	public function getPromoPrice(){
		return number_format($this->promo_price, 2);
	}

	public function getCurrency(){
		return $this->currency;
	}

	public function getDiscount(){
		return $this->discount;
	}

	public function getPublisher(){
		return $this->publisher;
	}

	public function getAffiliateLink(){
		return $this->affiliate_link;
	}

	public function getPromoExpiresOn(){
		return $this->promo_expires_on;
	}

	public function addPicture(Picture $picture){
		$this->pictures[] = $picture;
	}

	public function getPictures(){
		return $this->pictures;
	}


	public function printHtml(){
		?>
		<div class="product" id="<?= $this->getName(); ?>">
			<div class="title"><strong><?= $this->getTitle(); ?></strong></div>
			<div class="picture">	
<?php $this->pictures[0]->printHtml(); ?>
			</div>
			<div class="buttons">
				<a href="<?= $this->getAffiliateLink(); ?>" target="_blank" title="Към сайта на магазина, който предлага продукта >>" class="btn-normal"><i class="fas fa-shopping-cart"></i></a>
				<a href="#link-to-product-details" title="Вижте описанието и характеристиките на продукта" class="btn-normal"><i class="fas fa-info-circle"></i></a>
				<button class="btn-normal" title="Добавете този продукт в любими"><i class="fas fa-heart"></i></button>
			</div>
			<div class="price">
				<span class="regular">
					<del><?= $this->getPrice(); ?></del>
				</span>
				<span class="promo">
					<?= $this->getPromoPrice(); ?><?= $this->getCurrency(); ?>
				</span>
				<span class="discount">
					<em title="Отстъпка в проценти"><?= $this->getDiscount(); ?>%</em>
				</span>
			</div>
		</div>
		<?php
	}
}

?>