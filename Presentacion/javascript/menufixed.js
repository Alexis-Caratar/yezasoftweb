/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
	var altura = $('.fixedmenu').offset().top;
	
	$(window).on('scroll', function(){
		if ( $(window).scrollTop() > altura ){
			$('.fixedmenu').addClass('principalmenu-fixed');
			
		} else {
			$('.fixedmenu').removeClass('principalmenu-fixed');
                      
		}
	});
 
});