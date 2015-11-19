
onload = function(){

	changewidth();
	
	
	jQuery(function($) {
  
	var nav    = $('#menubar_pc'),
    offset = nav.offset();
  
	$(window).scroll(function () {
 	 if($(window).scrollTop() > offset.top) {
    	nav.addClass('fixed');
  	} else {
    	nav.removeClass('fixed');
  	}
	});
  
	});


}



function changewidth(){

if (OCwindowWidth() > 480) {
	var imax = 6;
	for(var i=0;i<imax;i++)document.getElementsByClassName('menu_pc')[i].style.width = (972/imax)+'px';
}

}


function display_popup(){

	document.getElementById('container').style.backgroundColor = "#333333";
	document.getElementById('container').style.opacity = "0.2";
	document.getElementById('container').style.disabled = true;
	document.getElementById('popup').style.display = "block";

}

function close_popup(){
	document.getElementById('container').style.backgroundColor = "#ffffff";
	document.getElementById('container').style.opacity = "1";
	document.getElementById('container').style.disabled = null;
	document.getElementById('popup').style.display = "none";
}