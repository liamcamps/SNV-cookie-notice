<style>
	body .cookie-notice {
		position: fixed;
		z-index: 9999999;
		<?php if (get_field('cookie_notice_bottom_top', 'option') == 'top') {
			echo get_field('cookie_notice_offset_top', 'option') ? 'top: '.get_field('cookie_notice_offset_top', 'option').'px;' : 'top: 0;';
		} else {
			echo get_field('cookie_notice_offset_bottom', 'option') ? 'bottom: '.get_field('cookie_notice_offset_bottom', 'option').'px;' : 'bottom: 0;';
		}
		if (get_field('cookie_notice_style', 'option') == 'full'){
			echo get_field('cookie_notice_offset_left', 'option') ? 'padding-left: '.get_field('cookie_notice_offset_left', 'option').'px;' : '';
			echo get_field('cookie_notice_offset_right', 'option') ? 'padding-right: '.get_field('cookie_notice_offset_right', 'option').'px;' : '';
		} ?>
		display: none;
	}
	body .cookie-notice.cookie-boxed {
		left: 50%;
		-webkit-transform: translateX(-50%);
		-ms-transform: translateX(-50%);
		-o-transform: translateX(-50%);
		transform: translateX(-50%);
	}
	body .cookie-notice:not(.cookie-boxed) {
		width: 100%;
	}
	body .cookie-notice.shown {
		display: block;
	}
	body .cookie-notice p:last-child{
		margin-bottom: 0px;
	}
	body .cookie-notice p {
		font-size: <?php echo get_field('cookie_notice_base_font_size', 'option') ? get_field('cookie_notice_base_font_size', 'option') : '16'; ?>px;
		line-height: 1.35em;
		color: <?php echo get_field('cookie_notice_color','option') ? get_field('cookie_notice_color','option') : '#000'; ?>;
	}
	body .cookie-notice h1 {
		font-size: <?php echo get_field('cookie_notice_base_font_size', 'option') ? 2.5 * get_field('cookie_notice_base_font_size', 'option') : '40'; ?>px;
		line-height: 1.35em;
		color: <?php echo get_field('cookie_notice_color','option') ? get_field('cookie_notice_color','option') : '#000'; ?>;
	}
	body .cookie-notice h2 {
		font-size: <?php echo get_field('cookie_notice_base_font_size', 'option') ? 2 * get_field('cookie_notice_base_font_size', 'option') : '32'; ?>px;
		line-height: 1.35em;
		color: <?php echo get_field('cookie_notice_color','option') ? get_field('cookie_notice_color','option') : '#000'; ?>;
	}

	body .cookie-notice h3 {
		font-size: <?php echo get_field('cookie_notice_base_font_size', 'option') ? 1.75 * get_field('cookie_notice_base_font_size', 'option') : '28'; ?>px;
		line-height: 1.35em;
		color: <?php echo get_field('cookie_notice_color','option') ? get_field('cookie_notice_color','option') : '#000'; ?>;
	}

	body .cookie-notice h4 {
		font-size: <?php echo get_field('cookie_notice_base_font_size', 'option') ? 1.5 * get_field('cookie_notice_base_font_size', 'option') : '24'; ?>px;
		line-height: 1.35em;
		color: <?php echo get_field('cookie_notice_color','option') ? get_field('cookie_notice_color','option') : '#000'; ?>;
	}

	body .cookie-notice h5 {
		font-size: <?php echo get_field('cookie_notice_base_font_size', 'option') ? 1.25 * get_field('cookie_notice_base_font_size', 'option') : '20'; ?>px;
		line-height: 1.35em;
		color: <?php echo get_field('cookie_notice_color','option') ? get_field('cookie_notice_color','option') : '#000'; ?>;
	}

	body .cookie-notice h6 {
		font-size: <?php echo get_field('cookie_notice_base_font_size', 'option') ? get_field('cookie_notice_base_font_size', 'option') : '16'; ?>px;
		line-height: 1.35em;
		color: <?php echo get_field('cookie_notice_color','option') ? get_field('cookie_notice_color','option') : '#000'; ?>;
	}

	body .cookie-notice .cookie-notice-wrapper {
		background: <?php echo get_field('cookie_notice_background','option') ? get_field('cookie_notice_background','option') : '#fff'; ?>;
		color: <?php echo get_field('cookie_notice_color','option') ? get_field('cookie_notice_color','option') : '#000'; ?>;
	}

	body .cookie-notice .border {
		border: 1px solid <?php echo get_field('cookie_notice_color','option') ? cookienoticehex2rgba(get_field('cookie_notice_color','option'),'0.25') : 'rgba(0,0,0,0.25)'; ?>;
	}

	body .cookie-notice .border-right {
		border-right: 1px solid <?php echo get_field('cookie_notice_color','option') ? cookienoticehex2rgba(get_field('cookie_notice_color','option'),'0.25') : 'rgba(0,0,0,0.25)'; ?>;
	}

	body .cookie-notice .border-top {
		border-top: 1px solid <?php echo get_field('cookie_notice_color','option') ? cookienoticehex2rgba(get_field('cookie_notice_color','option'),'0.25') : 'rgba(0,0,0,0.25)'; ?>;
	}

	body .cookie-notice .border-left {
		border-left: 1px solid <?php echo get_field('cookie_notice_color','option') ? cookienoticehex2rgba(get_field('cookie_notice_color','option'),'0.25') : 'rgba(0,0,0,0.25)'; ?>;
	}

	body .cookie-notice .cookie-padding {
		padding: <?php echo get_field('cookie_notice_padding','option') ? get_field('cookie_notice_padding','option') : '30'; ?>px <?php echo get_field('cookie_notice_padding_horizontal','option') ? get_field('cookie_notice_padding_horizontal','option') : '30'; ?>px;
	}
</style>