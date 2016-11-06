<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

delete_option( 'tab_override_tab_size' ); // in case the old option still exists
delete_option( 'tab_override' ); // the array containing all the options
delete_option( 'tab_override_version' );
