function move(direction, step){
	var first_item = $("div.dalaverka-carousel div.item").first();
	var old_margin = first_item.css("margin-left");
	var old_margin = parseInt(old_margin);
    
    var new_margin = NaN;
	if(direction == "left"){
		new_margin = old_margin-step;

		var first_width = first_item.width();
		var perc_hidden = Math.floor((new_margin / first_width) * -100);
		if(perc_hidden >= 10){
			new_margin = 0;
			first_item.css("margin-left", "0px");
			first_item.appendTo("div.dalaverka-carousel div.items");
		}
	}else if(direction == "right"){
		new_margin = old_margin+step;

		var last = $("div.dalaverka-carousel div.item").last();
		var last_width = last.width();
		var perc_hidden = Math.floor((new_margin / last_width) * 100);
		if(perc_hidden >= -28){
			new_margin = 0;
			last.css("margin-left", "0px");
		 	$("div.dalaverka-carousel div.items").prepend(last);
		}
	}

	// Set the new margin left
	$("div.dalaverka-carousel div.item").first().css("margin-left", (new_margin + "px"));
}


$("div.dalaverka-carousel div.controls div.left-button button").click(function(){
	move("right", 30);
});
$("div.dalaverka-carousel div.controls div.right-button button").click(function(){
	move("left", 30);
});

$("div.dalaverka-carousel").ready(function(){
	setInterval(
		function(){
			move("right", 10)
		},
		2900
	);
});

