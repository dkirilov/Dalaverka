<?php

$product1 = new \core\Product(
	"tennents_super",
	"Tennents - Super",
	"A strong pale lager brewed in Luton.",
	66.08,
	61.34,
	"лв",
	"thedrinkshop.com",
	"http://affiliate.link.to.our.com/product",
	"31.10.2019"
);
$product2 = new \core\Product(
	"plantation_rum",
	" Plantation Rum - Tri... ",
	"White chocolate and citrus notes on the nose.
     A fresh palate with deep fruit notes followed by spicy and woody tones.
     Spicy chocolate on the finish.",
	45.59,
	30.00,
	"лв",
	"thedrinkshop.com",
	"http://affiliate.link.to.our.com/product",
	"31.10.2019"
);
$product3 = new \core\Product(
	"vibrator_1002",
	"Vibrator 1002 Super Power",
	"Kkcasmkcmksmcksmkcmlkas km masm cklmskamcksamkcmklasmkcmkmeimcksmklcmskac  a clsamkmcksamckmskamckmsakm kmskcmk amkm kmask masm kmklsam kasmckmasklcnejwnvoe;",
	107.90,
	105.45,
	"лв",
	"SexForYouShop.com",
	"http://affiliate.link.to.our.com/product",
	"31.10.2019"
);
$product4 = new \core\Product(
	"whiskey_vinegar",
	"Whiskey vingear",
	"Unique sweet and sour vinegar with the taste of Whiskey at the finish. Perfect for marinades and as a salad dressing. Gives an extra kick to your dressings and sauces and is a great accompaniment during the grilling season!",
	14.95,
	13.55,
	"лв",
	"oilvinegear.com",
	"http://affiliate.link.to.our.com/product",
	"31.10.2019"
);
$product5 = new \core\Product(
	"italian_nut_crumbs",
	"Italian Nut Crumbs",
	"A bread crumb alternative. 

The perfect mix of premium pecans, cashews, and almonds blended with east coast inspired Italian spices.

Italian Nut Crumbs are the perfect ingredient for meatballs, eggplant parmesan or your favorite Italian dish!",
	13.95,
	10.55,
	"лв",
	"oilvinegear.com",
	"http://affiliate.link.to.our.com/product",
	"31.10.2019"
);



$product1->addPicture(new \core\Picture("tennents_super_1", "Tennents Super", "https://d1osgs5rdqb11o.cloudfront.net/products/main/1266/1266.thm350.jpg", "377px", "450px"));
$product2->addPicture(new \core\Picture("plantation_rum", "Plantation Rum - Trinidad 2008", "https://d1osgs5rdqb11o.cloudfront.net/products/main/17548/17548.thm350.jpg", "377px", "450px"));
$product3->addPicture(new \core\Picture("vibr_pic_1", "Vibrator 1000 Second Picture", "https://images-na.ssl-images-amazon.com/images/I/51iE0HzoloL._SY450_.jpg", "377px", "450px"));
$product4->addPicture(new \core\Picture("whiskey_vinegar", "Whiskey vingear", "https://bpstatic.nl/cache/oilenvineg/Producten_2019-65971-Whiskey-Vinegar-250ml-1_2.png-750-750", "377px", "450px"));
$product5->addPicture(new \core\Picture("italian_nut_crumbs", "Italian Nut Crumbs", "https://bpstatic.nl/cache/oilenvineg/oilenvineg-us-Products-italian%20nut%20crumbs%20website.png-750-750", "377px", "450px"));

$top_promo_products->addItem($product1);
$top_promo_products->addItem($product2);
$top_promo_products->addItem($product3);
$top_promo_products->addItem($product4);
$top_promo_products->addItem($product5);



$home_top_banner_1 = new \core\Banner("home_top_banner_1", 
	                                  "Колички, столчета за кола, шезлонги", 
	                                  "https://profitshare.bg/images/advertiser_widgets_shared/m980x200_5600_1569935941.jpg", 
	                                  "99%", "200px",
	                                  "https://profitshare.bg/l/817105",
	                                  -15
	                                  );


$home_top_banner_2 = new \core\Banner("home_top_banner_2", 
	                                  "Колички, столчета за кола, шезлонги", 
	                                  "https://profitshare.bg/images/advertiser_widgets_shared/300x250_5600_1569935934.jpg", 
	                                  "300px", "250px",
	                                  "https://profitshare.bg/l/817105",
	                                  -15
	                                  );

$home_top_banner_3 = new \core\Banner("home_top_banner_3", 
	                                  "Колички, столчета за кола, шезлонги", 
	                                  "https://profitshare.bg/images/advertiser_widgets_shared/m1200x628_5600_1569935946.jpg", 
	                                  "99%", "628px",
	                                  "https://profitshare.bg/l/817105",
	                                  -15
	                                  );
?>