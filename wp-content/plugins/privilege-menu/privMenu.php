<?php
/**
 * Plugin Name: Privileged Menu
 * Plugin URI: http://www.fuzzguard.com.au/plugins/privileged-menu
 * Description: Used to provide Menu display to users based on their Privilege Level (User roles or Logged In/Logged Out)
 * Version: 1.7.4
 * Author: Benjamin Guy
 * Author URI: http://www.fuzzguard.com.au
 * Text Domain: privilege-menu
 * License: GPL2

    Copyright 2014  Benjamin Guy  (email: beng@fuzzguard.com.au)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/


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

/**
* Load Custom Walker class
* @since 0.2
*/
include('customWalker.php');




/**
* Create class privMenu() to prevent any function name conflicts with other WordPress plugins or the WordPress core.
* @since 0.1
*/
class privMenu {

        /**
        * Loads localization files for each language
        * @since 1.4
        */
	function _action_init()
	{
		// Localization
		load_plugin_textdomain('privilege-menu', false, 'privilege-menu/lang/');
	}


    	/**
     	* Removes items from the menu displayed to the user if that menu item has been denied access to them in the admin panel
     	* @since 0.2
     	*/
	function remove_menu_items( $items, $menu, $args ) {

    		foreach ( $items as $key => $item ) {
				$meta_data = get_post_meta( $item->ID, '_priv_menu_role', true);

				// Handle the old format of the meta data.
				if( !is_array( $meta_data ) ) {
					$temp = $meta_data;
					$meta_data = array();
					$meta_data['users'] = $temp;
					$meta_data['roles'] = array();
				}

				$visible = true;

         		switch( $meta_data['users'] ) {
					case 'admin':
						$meta_data['roles'][] = 'administrator';
					case 'in' :
						if( is_user_logged_in() ) {
							// By default assume a menu with the "logged in" user resitriction is visible when a user is logged in.
							$visible = true;

							// Setup for matching of roles if they exist.
							$role_match = false;
							$role_count = 0;

							// Check to see if we have an array of roles or not.
							if ( is_array( $meta_data['roles'] ) ) {
								// Count the number of roles we have to check.
								$role_count = count( $meta_data['roles'] );

								// Loop through each role and check to see if this user has it.
								foreach( $meta_data['roles'] as $role ) {
									if ( current_user_can( $role ) ) {
										$role_match = true;
									}
								}
							}

							// If we haven't match a user role to the current user and we have user roles set, make this menu item invisible.
							if( !$role_match && $role_count > 0 ) { $visible = false; }
						}
						else {
							$visible = false;
						}
						break;
					case 'out' :
						$visible = ! is_user_logged_in() ? true : false;
						break;
					default:
						$visible = true;
						break;
          		}

          		// add filter to work with plugins that don't use traditional roles
          		$visible = apply_filters( 'nav_menu_roles_item_visibility', $visible, $item );

          		if ( ! $visible ) unset( $items[$key] ) ;
    		}

    		return $items;
	}

    /**
     * Replace the default Admin Menu Walker
     * @since 0.2
     */
    function edit_priv_menu_walker( $walker, $menu_id ) {
        return 'Priv_Menu_Walker';
    }



    /**
     * Save users selection in DataBase as post_meta on return of data from users browser
     * @since 0.2
     */
    function save_extra_menu_opts( $menu_id, $menu_item_db_id, $args ) {
        global $wp_roles;

        $allowed_roles = apply_filters( 'priv_menu_roles', $wp_roles->role_names );

        // verify this came from our screen and with proper authorization.
        if ( ! isset( $_POST['priv-menu-role-nonce'] ) || ! wp_verify_nonce( $_POST['priv-menu-role-nonce'], 'priv-menu-nonce-name' ) )
            return;

	$saved_data = array( 'users' => '', 'roles' => '');

        if ( isset( $_POST['priv-menu-logged-in-out'][$menu_item_db_id]  )  && in_array( $_POST['priv-menu-logged-in-out'][$menu_item_db_id], array( 'in', 'out') ) ) {
              $saved_data['users'] = $_POST['priv-menu-logged-in-out'][$menu_item_db_id];
        }

	if ( isset( $_POST['priv-menu-role'][$menu_item_db_id] ) ) {
            $custom_roles = array();
            // only save allowed roles
            foreach( $_POST['priv-menu-role'][$menu_item_db_id] as $role ) {
                if ( array_key_exists ( $role, $allowed_roles ) ) $custom_roles[] = $role;
            }

            if ( ! empty ( $custom_roles ) ) {
		 $saved_data['roles'] = $custom_roles;
	    }
        }

	if ( $saved_data['roles'] != '' || $saved_data['users'] != '' ) {
            update_post_meta( $menu_item_db_id, '_priv_menu_role', $saved_data );
        } else {
            delete_post_meta( $menu_item_db_id, '_priv_menu_role' );
        }
    }

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 *
 * @since 1.7
 */
function fuzzguard_plugin_manager_register_required_plugins() {
        /*
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */

        $plugins = array(
                // This is an example of how to include a plugin from the WordPress Plugin Repository.
                array(
                        'name'      => 'Privilege Menu',
                        'slug'      => 'privilege-menu',
                        'required'  => false,
                ),
                array(
                        'name'      => 'Privilege Widget',
                        'slug'      => 'privilege-widget',
                        'required'  => false,
                ),

        );

        /*
         * Array of configuration settings. Amend each line as needed.
         *
         * TGMPA will start providing localized text strings soon. If you already have translations of our standard
         * strings available, please help us make TGMPA even better by giving us access to these translations or by
         * sending in a pull-request with .po file(s) with the translations.
         *
         * Only uncomment the strings in the config array if you want to customize the strings.
         */
        $config = array(
                'id'           => 'fuzzguard_plugin_manager',                 // Unique ID for hashing notices for multiple instances of TGMPA.
                'default_path' => '',                      // Default absolute path to bundled plugins.
                'menu'         => 'fuzzguard-plugin-manager', // Menu slug.
                'parent_slug'  => 'plugins.php',            // Parent menu slug.
                'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
                'has_notices'  => true,                    // Show admin notices or not.
                'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
                'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
                'is_automatic' => false,                   // Automatically activate plugins after installation or not.
                'message'      => '',                      // Message to output right before the plugins table.

        );

        tgmpa( $plugins, $config );
}

} //End of privMenu() class


/**
* Define the Class
* @since 0.1
*/
$myprivMenuClass = new privMenu();


/**
* Action of what function to call on wordpress initialization
* @since 1.4
*/
add_action('plugins_loaded', array($myprivMenuClass, '_action_init'));

/**
* Action of what function to call to save users selection when returned from their browser
* @since 0.1
*/
add_action( 'wp_update_nav_menu_item', array( $myprivMenuClass, 'save_extra_menu_opts'), 10, 3 );


/**
* Replace the default Admin Menu Walker with the custom one from the customWalker.php file
* @since 0.1
*/
add_filter( 'wp_edit_nav_menu_walker', array( $myprivMenuClass, 'edit_priv_menu_walker' ), 999, 2 );

/**
 * Include the TGM_Plugin_Activation class.
 * @since 1.7
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

/**
* Add required plugins install from TGM
* @since 1.7
*/
add_action( 'tgmpa_register', array( $myprivMenuClass, 'fuzzguard_plugin_manager_register_required_plugins') );

/**
* If is_admin() is not defined (User not in admin panel) then filter the displayed menu through the below function.
* @since 0.2
*/
if ( ! is_admin() ) {
        // add meta to menu item
	add_filter( 'wp_get_nav_menu_items', array($myprivMenuClass, 'remove_menu_items'), null, 3 );
}
?>
