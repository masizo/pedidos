function submenu_in(sub){
  	document.getElementById(sub).style.height = 'auto';
	document.getElementById(sub).style.transition="1s";
}

function submenu_out(sub){
  	document.getElementById(sub).style.height = '0px';
	document.getElementById(sub).style.transition="1s";
}