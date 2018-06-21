<?php
function cookie_notice(){
    $border_style = get_field('cookie_notice_border', 'option');
    if ($border_style == 'top') {
        $border_class = ' border-top';
    } elseif ($border_style == 'sidetop') {
        $border_class = ' border-top border-left border-right';
    } elseif ($border_style == 'around') {
        $border_class = ' border';
    } else {
        $border_class = '';
    }
    $border_rounded = get_field('cookie_notice_rounded', 'option');
    if ($border_rounded == 'top') {
        $rounded_class = ' rounded-top';
    } elseif ($border_rounded == 'bottom') {
        $rounded_class = ' rounded-bottom';
    } elseif ($border_rounded == 'both') {
        $rounded_class = ' rounded';
    } else {
        $rounded_class = '';
    }
?>
    <?php if (get_field('cookie_notice_style', 'option') != 'full'){ ?>
        <div class="cookie-notice cookie-boxed container" data-reload="<?php echo get_field('cookie_notice_reload_after_accepting', 'option') ? 'true' : 'false'; ?>">
            <?php include_once( 'cookienoticecss.php' ); ?>
            <div class="col-12 cookie-notice-wrapper<?php echo $border_class.$rounded_class; ?>">
    <?php } else { ?>
        <div class="cookie-notice" data-reload="<?php echo get_field('cookie_notice_reload_after_accepting', 'option') ? 'true' : 'false'; ?>">
            <?php include_once( 'cookienoticecss.php' ); ?>
            <div class="container-fluid cookie-notice-wrapper<?php echo $border_class; ?>">
        <?php } ?>
        		<div class="row">
        			<div class="col cookie-padding border-right">
                        <?php if (get_field('cookie_notice_title', 'option')){ ?>
                            <h4><?php the_field('cookie_notice_title', 'option'); ?></h4>
                        <?php }
                        $cookiepage = get_field('cookie_notice_cookie_page','option') ? get_field('cookie_notice_cookie_page','option') : get_site_url().'/cookies';
                        echo str_replace('[/settings]','</a>',str_replace('[settings]','<a href="'.$cookiepage.'">',get_field('cookie_notice_content', 'option'))); ?>
        			</div>
        			<a href="#" class="cookie-padding col-auto d-flex align-items-center" data-cookie-notice="close">
                        <span><?php the_field('cookie_notice_close_txt', 'option'); ?></span>
                    </a>
        		</div>
        <?php if (get_field('cookie_notice_style', 'option') != 'full'){ ?>
            </div>
        <?php } ?>
    	</div>
    </div>
<?php
};