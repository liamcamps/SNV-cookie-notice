(function($) {
	$(document).on('click','.cookie-notice a', function(e){
		$this = $(this);
		if (/#/.test($this.attr('href'))) {
	        e.preventDefault();
	        if ($this.data('cookie-notice') == 'close') {
	        	Cookies.set('cookie_notice_dismissed', 1, { expires: 31 });
	        	Cookies.set('cookie_notice_accepted', 1, { expires: 31 });
	        	if ($this.closest('.cookie-notice').data('reload') == true) {
	        		location.reload();
	        	} else {
		        	$('.cookie-notice').remove();
		        }
	        }
	    }
	});

	$(document).on('click','form.cookie-form a', function(e){
		$this = $(this);
		if (/#/.test($this.attr('href'))) {
	        e.preventDefault();
	        if ($this.data('cookie-notice') == 'save') {
	        	$formdata = $this.closest('form').serializeArray();
	        	Cookies.set('cookie_notice_dismissed', 1, { expires: 31 });
	        	$.each($formdata, function(i,val){
	        		if (val.name == 'cookie_tool_level') {
	        			Cookies.set('cookie_notice_accepted', val.value, { expires: 31 });
	        			location.reload();
	        		}
	        	})
	        }
	    }
	})
})( jQuery );