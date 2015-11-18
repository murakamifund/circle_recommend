function changewidth(){

if (OCwindowWidth() > 480) {
	imax = 6;
	for(var i=0;i<imax;i++)document.getElementsByClassName('menu_pc')[i].style.width = (972/imax)+'px';
}

/*	var nav = $('#fixed-navi');
	var navTop = nav.offset().top;
	$(window).scroll(function () {
		var winTop = $(this).scrollTop();
		if (winTop >= navTop) {
			nav.addClass('fixed').css('top',0);
		} else if (winTop < navTop) {
			nav.removeClass('fixed').css('top',-navTop+'px');
		}
	});
*/

}