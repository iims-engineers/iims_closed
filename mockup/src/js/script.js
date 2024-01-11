$(function(){
	'use strict';
	
	function infoAccordionToggle() {
    const $btn = $('.l-header__info-btn');
		const $accordion = $('.l-header__info');

    $btn.on('click', function() {
      $accordion.slideToggle(200);
    })
	}

	infoAccordionToggle();
});