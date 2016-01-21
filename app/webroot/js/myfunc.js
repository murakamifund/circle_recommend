function func_home(){
	
	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[1].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[1].id = "current";
	document.getElementById('mainimg').style.display = "block";
}

/*
function func_about(){

	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[3].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[3].id = "current";
	
}
*/

function func_student(){

	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[3].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[3].id = "current";
	
}

function func_circle(){

	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[5].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[5].id = "current";
	
	
}

function func_student_edit(){

	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[7].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[7].id = "current";
	
}

function student_edit_func(x){
	for(i=0;i<3;i++){
		document.getElementById('student_edit_content'+String(i)).style.display = "none";
	}
	document.getElementById('student_edit_content'+String(x)).style.display = "block";

}



function func_student_resister(){

	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[7].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[7].id = "current";
	
}

function func_student_login(){

	default_func();
}


function func_circle_edit_main(){
	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[7].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[7].id = "current";
}


function func_circle_edit(){
	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[7].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[7].id = "current";
}

function func_circle_edit_cal(){
	default_func();
	document.getElementById('menubar_pc').childNodes[1].childNodes[7].id = "current";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[7].id = "current";
}


function func_circle_id(man,woman){
	default_func();
	var sum = man + woman ; 
	var maxwidth= 250;
	document.getElementById('man_ratio').style.width = man*maxwidth/sum+"px";
	document.getElementById('woman_ratio').style.width = woman*maxwidth/sum+"px";
	menu_backtwice();
}

function func_event_id(){
	default_func();
	menu_backtwice();
}

function func_event_id(){
	default_func();
	menu_backtwice();
}

function func_resister(){
	default_func();
}

function func_resister_finish(){
	default_func();
}




function changewidth(){

if (OCwindowWidth() > 480) {
	var imax = 3;
	for(var i=0;i<imax;i++)document.getElementsByClassName('menu_pc')[i].style.width = (972/imax)+'px';
}

}



function default_func(){

//	changewidth();
	document.getElementById('menubar_pc').childNodes[1].childNodes[1].id = "";
	document.getElementById('menubar_pc').childNodes[1].childNodes[3].id = "";
	document.getElementById('menubar_pc').childNodes[1].childNodes[5].id = "";
	document.getElementById('menubar_pc').childNodes[1].childNodes[7].id = "";

	document.getElementById('menubar_mobile').childNodes[1].childNodes[1].id = "";	
	document.getElementById('menubar_mobile').childNodes[1].childNodes[3].id = "";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[5].id = "";
	document.getElementById('menubar_mobile').childNodes[1].childNodes[7].id = "";
	
	document.getElementById('mainimg').style.display = "none";
}



function display_popup(){


	document.getElementById('popup').style.display = "block";
	document.getElementById('overlay').style.display = "block";

}

function close_popup(){

	document.getElementById('popup').style.display = "none";
	document.getElementById('overlay').style.display = "none";
}


function menu_backtwice(){
	document.getElementsByClassName('menu_pc')[0].href = "../../Students/home";
	document.getElementsByClassName('menu_pc')[1].href = "../../Students/student";
	document.getElementsByClassName('menu_pc')[2].href = "../../Students/circle";
//	document.getElementsByClassName('menu_pc')[3].href = "../../Students/student_resister";

	document.getElementsByClassName('menu_mobile')[0].href = "../../Students/home";
	document.getElementsByClassName('menu_mobile')[1].href = "../../Students/student";
	document.getElementsByClassName('menu_mobile')[2].href = "../../Students/circle";
//	document.getElementsByClassName('menu_mobile')[3].href = "../../Circles/student_resister";
	
	if(document.getElementById('student_bar')!=null){
		document.getElementsByClassName('student_bar_btn')[0].childNodes[0].href = "../student_resister";
		document.getElementsByClassName('student_bar_btn')[1].childNodes[0].href = "../student_tw_logout";
	}
	document.getElementById('logo').childNodes[0].childNodes[0].src = "../../img/logo03.png";
	document.getElementById('popup').childNodes[3].childNodes[0].childNodes[0].src = "../../img/image3.png";
}

