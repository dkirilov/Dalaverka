// Makes possible horizontal navigation menu's dropdowns to open/close when clicked
$('a.dropdown-toggle').click(function(){
	$('ul.dropdown-menu-wrapper').fadeToggle("fast");
});
// Dropdown closes when is out of focus
$('a.dropdown-toggle').focusout(function(){
	$('ul.dropdown-menu-wrapper').fadeOut("fast");
});
// Animates header navigation bar when its loaded
$('#headerMenuBar').ready(function(){
	$('#headerMenuBar').fadeIn();
});