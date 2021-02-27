jQuery(function($){
	$(document).ready(function() {
		
		if(cur_page_data.pageid == 1){
			$('.menu_row').css('width','90%');	
		}
	
		var $window = $(window),
		$body = $('body');		
		
		$('.banner_content h1,.banner_content p,.banner_content a.smue-btn').addClass('wow fadeInUp');
		$('.banner_content h1').attr('data-wow-delay','0.3s');
		$('.banner_content p').attr('data-wow-delay','0.6s');
		$('.banner_content a.smue-btn').attr('data-wow-delay','0.9s');
			
		 /* wow
		-------------------------------*/
		new WOW({ mobile: false }).init();
		
	});

});
