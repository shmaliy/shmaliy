function smartColumns() { //функция, подсчитывающая ширину колонок
	//сброс ширины строки до 100% после изменения размера экрана
	var display = $('.header-resize').width();
	var logo = $('.logo').width();
	var logout = $('.log-out').width();
	
	//console.log(display);
	  
	$(".main-menu").css({ 'width' : display - logo - logout-5 + 'px'});
	$(".main-field").css({ 'width' : display - 35 - 120 + 'px'});
}

function formResize() {
	var mainField = $('.main-field').width();
	
	$('.form-composite-group-main').css({'width': mainField - 260 + 'px'});
	
	$('.form-composite-group-main > fieldset > div').addClass("cf");
	$('.form-composite-group-main > fieldset > div > div > input').css({'width': mainField - 275 + 'px'});
	$('.form-composite-group-main > fieldset > div > div > input:checkbox').css({'width': '15px'});
	$('.form-composite-group-main > fieldset > div > div > select').css({'width': mainField - 261 + 'px'});
		
	
}