<?php
/*
Plugin Name: Tab Override
Plugin URI: http://tinsology.net/plugins/tab-override/
Description: Causes tabs to function as they would in a text editor rather than a browser.
Version: 3.3.1
Author: Bill Bryant, Mathew Tinsley
Author URI: http://wjbryant.com/
License: GPLv2 or later
*/

/*
Copyright 2014  Bill Bryant     (email : bill@wjbryant.com),
                Mathew Tinsley  (email : tinsley@tinsology.net)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

/**
 * Plugin initialization code
 *
 * @package Tab_Override
 */

// initialize the plugin on admin pages only
if ( is_admin() ) {
	require_once( dirname( __FILE__ ) . '/includes/class-tab-override.php' );

	// assign an instance of the Tab_Override class to a global object so the
	// methods can be referenced in other files if necessary (ex: remove_action())
	// without the need to include the class file
	global $tab_override;
	$tab_override = Tab_Override::get_instance( __FILE__ );
}
