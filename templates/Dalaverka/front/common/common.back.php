<?php

// Add some external vendor CSS
$this->addVendorCSS("FontAwesome", "https://use.fontawesome.com/releases/v5.7.0/css/all.css");

// Add some external vendor JS
//$this->addVendorJS("Popper.js", "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js");

if($page_name == "home"){
	$home_slider = new DalaverkaSlider(DEFAULT_LANG);
	$top_promo_products = new DalaverkaCarousel(DEFAULT_LANG, "top_promo_products", "Топ продукти на промоция");
}

?>