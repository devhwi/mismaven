<?php
/**
* Don't display if wordpress admin class is not found
* Protects code if wordpress breaks
* @since 0.2
*/
if ( ! function_exists( 'is_admin' ) ) {
    header( 'Status: 403 Forbidden' );
    header( 'HTTP/1.1 403 Forbidden' );
    exit();
}

//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();

$option_name = '_priv_menu_role';

//delete_option( $option_name );

delete_post_meta_by_key( $option_name );

// For site options in multisite
//delete_site_option( $option_name );  

?>
