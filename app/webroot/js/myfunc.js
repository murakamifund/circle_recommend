function func_home(){
	
	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[1].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[1].id = "current";
	document.getElementById('mainimg').style.display = "block";
}


function func_about(){

	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[3].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[3].id = "current";
	
}

function func_student(){

	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[5].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[5].id = "current";
	
}

function func_circle(){

	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[7].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[7].id = "current";
	
}

function func_student_resister(){

	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[9].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[9].id = "current";
	
}

function func_student_login(){

	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[11].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[11].id = "current";
	
}






function changewidth(){

if (OCwindowWidth() > 480) {
	var imax = 6;
	for(var i=0;i<imax;i++)document.getElementsByClassName('menu_pc')[i].style.width = (972/imax)+'px';
}

}


function menu_scroll(){

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

function default_func(){

	changewidth();
//	menu_scroll();
	document.getElementById('menubar_pc').childNodes[1].childNodes[1].id = "";
	document.getElementById('menubar_pc').childNodes[1].childNodes[3].id = "";
	document.getElementById('menubar_pc').childNodes[1].childNodes[5].id = "";
	document.getElementById('menubar_pc').childNodes[1].childNodes[7].id = "";
	document.getElementById('menubar_pc').childNodes[1].childNodes[9].id = "";

	document.getElementById('menubar_mobile').childNodes[1].childNodes[1].id = "";	
	document.getElementById('menubar_mobile').childNodes[1].childNodes[3].id = "";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[5].id = "";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[7].id = "";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[9].id = "";
	
	document.getElementById('mainimg').style.display = "none";
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