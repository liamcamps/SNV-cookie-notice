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
	        			// Set value of the cookie form
	        			Cookies.set('cookie_notice_accepted', val.value, { expires: 31 });
	        			if (val.value == 0 && $this.closest('form').data('clear') == true) {
	        				// if tracking not allowed remove all other removable cookies
	        				Object.keys(Cookies.get()).forEach(function(cookieName) {
								cookiecheckname = cookieName.split("_")[0].replace(/\s/g, '');
								if (cookieName.split("_")[1]) {
									cookiecheckname = cookiecheckname+cookieName.split("_")[1].replace(/\s/g, '');
								}
								// check if used for cookie-notice, if not remove
								if (cookiecheckname != 'cookienotice') {
									Cookies.remove(cookieName);
								}
							});
	        			}
	        			location.reload();
	        		}
	        	})
	        }
	    }
	})
})( jQuery );