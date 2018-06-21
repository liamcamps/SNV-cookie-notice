<?php
function cookie_notice(){
    $border_style = get_field('cookie_notice_border', 'option');
    echo $border_style;
    if ($border_style == 'top') {
        $border_class = ' border-top';
    } elseif ($border_style == 'around') {
        $border_class = ' border-top border-left border-right';
    } else {
        $border_class = '';
    }
?>
    <div class="cookie-notice cookie-boxed" data-reload="<?php echo get_field('cookie_notice_reload_after_accepting', 'option') ? 'true' : 'false'; ?>">
		<?php include_once( 'cookienoticecss.php' ); ?>
        <?php if (get_field('cookie_notice_style', 'option') != 'full'){ ?>
    	<div class="container">
            <div class="col-12 cookie-notice-wrapper<?php echo $border_class; ?>">
        <?php } else { ?>
            <div class="container-fluid cookie-notice-wrapper<?php echo $border_class; ?>">
        <?php } ?>
        		<div class="row align-items-center">
        			<div class="col cookie-padding border-right">
                        <?php if (get_field('cookie_notice_title', 'option')){ ?>
                            <h4><?php the_field('cookie_notice_title', 'option'); ?></h4>
                        <?php }
                        $cookiepage = get_field('cookie_notice_cookie_page','option') ? get_field('cookie_notice_cookie_page','option') : get_site_url().'/cookies';
                        echo str_replace('[/settings]','</a>',str_replace('[settings]','<a href="'.$cookiepage.'">',get_field('cookie_notice_content', 'option'))); ?>
        			</div>
        			<div class="col-auto p-0">
                        <a href="#" class="cookie-padding" data-cookie-notice="close"><?php the_field('cookie_notice_close_txt', 'option'); ?></a>
                    </div>
        		</div>
        <?php if (get_field('cookie_notice_style', 'option') != 'full'){ ?>
            </div>
        <?php } ?>
    	</div>
    </div>
<?php
};