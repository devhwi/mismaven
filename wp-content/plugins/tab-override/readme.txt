=== Tab Override ===
Contributors: wjbryant, mtinsley
Tags: tab, tabs, tab key, html editor, post editor, override, insert, allow, indent, code, admin
Requires at least: 3.3
Tested up to: 4.0
Stable tag: 3.3.1

Tab Override allows you to enter tabs into the HTML editor (not Visual) as you would in a desktop text editor.

== Description ==

Tab Override allows you to enter tabs into the HTML editor (not Visual) as you would in a desktop text editor.

= Features =

* Tab character insertion via the tab key
* Tab character removal via the shift+tab key combination
* Multi-line selection support
* Adjustable tab size (use tabs or any number of spaces)
* Auto indent feature
* Custom key combinations (use any key and modifier keys for tab/untab)
* Tabs on/off toolbar button
* Can be enabled or disabled for specific admin pages
* Customizable jQuery selectors for plugin interoperability
* Cross-browser compatible

NOTE: As of version 3.0, PHP 4 is no longer supported.

== Installation ==

1. Upload the `tab-override` directory to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Set the plugin options through the 'Settings' menu in WordPress

== Frequently Asked Questions ==

= What browsers are supported? =

IE 6+, Firefox, Chrome, Safari, Opera 10.50+

= Is PHP 4 supported? =

No, PHP 4 support was dropped in version 3.0.

= Where can I ask additional questions? =

[wjbryant.com](http://wjbryant.com/projects/tab-override/ "Tab Override Documentation on Bill Bryant's Website") or [tinsology.net](http://tinsology.net/plugins/tab-override/ "Tab Override Documentation on Mathew Tinsley's Website")

== Screenshots ==

1. Multiple lines can be indented at once
2. The Tab Override settings page

== Changelog ==

= 3.3.1 =
* Updated the JavaScript library to version 4.0.2

= 3.3.0 =
* Added options for custom key combinations
* Updated the JavaScript library to version 4.0.0

= 3.2.1 =
* Internet Explorer 10 compatibility

= 3.2 =
* Added options to customize the selectors used by the jQuery plugin
* Updated the jQuery plugin to the latest version (2.0)
* Increased the minimum required version of WordPress to 3.3

= 3.1.2 =
* Updated the jQuery plugin

= 3.1.1 =
* WordPress 3.3 compatibility update
* Increased the minimum required version of WordPress to 3.2

= 3.1 =
* Added an optional tabs on/off toolbar button
* Removed the reset_options option
* Fixed the auto indent option to switch on/off properly
* Changed the way new options are created when the plugin is updated
* Increased the minimum required version of WordPress to 3.0

= 3.0.1 =
* Updated settings array to enable auto indent by default

= 3.0 =
* Added an auto indent feature
* Added an uninstall procedure to clean up options in the database
* Improved security and performance
* Updated the jQuery plugin to version 1.1 (includes auto indent, IE bug fixes)
* Added translation support (internationalization / i18n)
* Added tab_override_init and tab_override_add_scripts hooks
* Updated code to better conform to WordPress coding standards
* PHP 4 is no longer supported

= 2.2 =
* Updated code for WordPress 3.0 compatibility
* Added options to select which admin pages have Tab Override enabled
* Added option to reset all options to defaults when plugin is (re)activated

= 2.1 =
* Added a settings page with a Tab Size option (default blank = tab character)
* JavaScript is now included as a jQuery plugin

= 2.0.1 =
* Fixed a compatibility issue with Internet Explorer

= 2.0 =
* Added support for Internet Explorer, Chrome and Safari
* Added tab removal support via the shift+tab key combination
* Added mutli-line selection support

= 1.1 =
* Added Firefox support

= 1.0 =
* Initial release
* Opera only