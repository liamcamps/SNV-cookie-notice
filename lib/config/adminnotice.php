<?php
/* Register activation hook. */
 
/**
 * Runs only when the plugin is activated.
 * @since 0.1.0
 */
add_filter( 'default_content', 'stijlenvorm_content_by_request', 10, 2 );

/**
 * Fills the default content for post type 'post' if it is not empty.
 *
 * @param string $content
 * @param object $post
 * @return string
 */
function stijlenvorm_content_by_request( $content, $post )
{
    if ( ! empty ( $_GET['pre_content'] )
        and current_user_can( 'edit_post', $post->ID )
        and '' === $content
    )
    {
        return str_replace('\\"','"',str_replace("\\'","'",urldecode($_GET['pre_content'])));
    }

    return $content;
}

function stijlenvorm_admin_notice_example_activation_hook() {
 
    /* Create transient data */
    set_transient( 'stijlenvorm-admin-notice-example', true, 5 );
}
 
 
/* Add admin notice */
add_action( 'admin_notices', 'stijlenvorm_admin_notice_example_notice' );
 
 
/**
 * Admin Notice on Activation.
 * @since 0.1.0
 */
function stijlenvorm_admin_notice_example_notice(){
 
    /* Check transient, if available display notice */
    if( get_transient( 'stijlenvorm-admin-notice-example' ) ){
    	$url = 'post-new.php?post_type=page&post_title=Cookies&pre_content=Op+deze+website+worden+cookies+gebruikt.+Een+cookie+is+een+klein+bestand+dat+informatie+bevat.+Deze+informatie+bestaat+uit+de+pagina%27s+die+u+bezocht+heeft+en+een+aantal+gegevens+over+uw+bezoek.+Ook+gebruiken+we+cookies+voor+enkele+functionaliteiten+op+de+website+waaronder+het+tonen+van+video%27s+en+het+laden+van+websites+van+partners.%0D%0ADe+cookies+worden+lokaal+op+uw+eigen+pc+opgeslagen+en+bevatten+alleen+geanonimiseerde+informatie.%0D%0A%0D%0AMet+behulp+van+de+onderstaande+instellingen+kunt+u+een+keuze+maken+uit+de+cookies+die+u+wilt+accepteren.+Het+niet+accepteren+van+cookies+zal+resulteren+in+een+beperkte+functionaliteit+binnen+de+website.%0D%0A%0D%0A%5Bcookie_options%5D%0D%0A%3Ch4%3ECookies+verwijderen+of+uitschakelen%3C%2Fh4%3E%0D%0AJe+kan+cookies+van+ons+natuurlijk+ook+uitschakelen+en+verwijderen.%C2%A0+Hoe+je+cookies+kan+uitschakelen+of+verwijderen+staat+hier+uitgelegd%3A%0D%0A%3Cul+class%3D%22bullet-list%22%3E%0D%0A+%09%3Cli%3E%3Ca+href%3D%22https%3A%2F%2Fsupport.google.com%2Fchrome%2Fanswer%2F95647%3Fhl%3Dnl%22+target%3D%22_blank%22+rel%3D%22noopener%22%3EChrome%3C%2Fa%3E%3C%2Fli%3E%0D%0A+%09%3Cli%3E%3Ca+href%3D%22https%3A%2F%2Fsupport.mozilla.org%2Fnl%2Fkb%2Fcookies-verwijderen-gegevens-wissen-websites-opgeslagen%22+target%3D%22_blank%22+rel%3D%22noopener%22%3EFirefox%3C%2Fa%3E%3C%2Fli%3E%0D%0A+%09%3Cli%3E%3Ca+href%3D%22https%3A%2F%2Fsupport.microsoft.com%2Fnl-nl%2Fhelp%2F17442%2Fwindows-internet-explorer-delete-manage-cookies%22+target%3D%22_blank%22+rel%3D%22noopener%22%3EInternet+Explorer%3C%2Fa%3E%3C%2Fli%3E%0D%0A+%09%3Cli%3E%3Ca+href%3D%22https%3A%2F%2Fsupport.microsoft.com%2Fnl-nl%2Fhelp%2F10607%2Fwindows-10-view-delete-browser-history-microsoft-edge%22+target%3D%22_blank%22+rel%3D%22noopener%22%3EEdge%3C%2Fa%3E%3C%2Fli%3E%0D%0A+%09%3Cli%3E%3Ca+href%3D%22https%3A%2F%2Fsupport.apple.com%2Fnl-nl%2FHT201265%22+target%3D%22_blank%22+rel%3D%22noopener%22%3ESafari+%28iOS%29%3C%2Fa%3E%3C%2Fli%3E%0D%0A+%09%3Cli%3E%3Ca+href%3D%22https%3A%2F%2Fsupport.apple.com%2Fkb%2FPH21411%3Flocale%3Dnl_NL%22+target%3D%22_blank%22+rel%3D%22noopener%22%3ESafari+%28macOS%29%3C%2Fa%3E%3C%2Fli%3E%0D%0A%3C%2Ful%3E';
        ?>
        <div class="notice-error notice is-dismissible">
            <p>Vergeet niet de pagina aan te maken voor cookies! <a href="<?php echo admin_url().$url; ?>">Maak pagina aan</a>.</p>
        </div>
        <?php
        /* Delete transient, only display this notice once. */
        delete_transient( 'stijlenvorm-admin-notice-example' );
    }
}