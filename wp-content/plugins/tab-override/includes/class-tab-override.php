<?php
// Part of the Tab Override WordPress plugin

/**
 * Contains the Tab_Override class
 *
 * @package Tab_Override
 */

/**
 * The Tab_Override class
 *
 * This class contains the main functionality of the Tab Override plugin.
 * This class follows the singleton pattern: it can only be instantiated once.
 * To get an instance of the class, call Tab_Override::get_instance( $plugin_file_path ).
 * This class requires PHP 5.
 *
 * @package Tab_Override
 */
class Tab_Override {
	const VERSION = '3.3.1'; // the current version of the plugin

	protected static $_instance; // an instance of the class
	protected $_plugin_file; // the full path of the main plugin file
	protected $_initialized = false; // whether the _init_hook() method was called
	protected $_options; // the array of options from the database
	protected $_options_page_hook_suffix; // the string hook suffix for the options page

	// the array of default options
	protected $_default_options = array(
		'tab_size' => '',
		'auto_indent' => 1,
		'tabs_button' => 1,
		'enable_index' => 1,
		'enable_post' => 1,
		'enable_post_new' => 1,
		'enable_edit_comments' => 1,
		'enable_comment' => 1,
		'enable_theme_editor' => 1,
		'enable_plugin_editor' => 1,
		'tab_key_code' => 9,
		'tab_key_modifiers' => array(),
		'untab_key_code' => 9,
		'untab_key_modifiers' => array( 'shift' ),
		'dashboard_selector' => '#content, #replycontent',
		'post_selector' => '#content, #replycontent',
		'fullscreen_selector' => '#wp_mce_fullscreen',
		'editor_selector' => '#newcontent',
		'other_selector' => '#content, #replycontent'
	);

	/**
	 * Initializes variables, loads the textdomain and adds initial actions
	 * and filters for the plugin.
	 *
	 * @param string $plugin_file_path The full path of the main plugin file
	 */
	protected function __construct( $plugin_file_path ) {
		$this->_plugin_file = $plugin_file_path;

		load_plugin_textdomain( 'tab-override', false, basename( dirname( $this->_plugin_file ) ) . '/languages/' );

		// fire the tab_override_init hook after all plugins are loaded
		add_action( 'plugins_loaded', array( $this, '_init_hook' ) );
		add_action( 'admin_menu', array( $this, 'create_menu' ) );
		add_action( 'admin_init', array( $this, 'check_version' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'add_scripts' ) );

		add_filter( 'plugin_action_links', array( $this, 'set_action_links' ), 10, 2 );
		add_filter( 'plugin_row_meta', array( $this, 'set_meta_links' ), 10, 2 );
	}

	/**
	 * Returns an instance of the Tab_Override class.
	 *
	 * @param  string         $plugin_file_path The full path of the main plugin file
	 * @return object|boolean                   An instance of the Tab_Override class
	 *                                          or false if one cannot be created
	 */
	public static function get_instance( $plugin_file_path ) {
		// only create a new instance if one does not already exist and the
		// plugin file path is known
		if ( ! self::$_instance ) {
			if ( ! $plugin_file_path ) {
				return false;
			}
			self::$_instance = new self( $plugin_file_path );
		}

		return self::$_instance;
	}

	/**
	 * Executes any actions added to the tab_override_init hook. This method
	 * is added to the plugins_loaded hook so other plugins have a chance to
	 * add actions to the tab_override_init hook. This method must be public
	 * in order to be used as a callback for add_action().
	 */
	public function _init_hook() {
		// only call _init_hook() once
		if ( $this->_initialized ) {
			return;
		}
		$this->_initialized = true;

		// create a hook to allow for additional init actions
		do_action( 'tab_override_init' );
	}

	/**
	 * Checks the plugin version and updates the options array.
	 */
	public function check_version() {
		global $wp_version;

		// deactivate plugin if WordPress version is less than 3.3
		if ( version_compare( $wp_version, '3.3', '<' ) ) {
			deactivate_plugins( plugin_basename( $this->_plugin_file ) );
			wp_die( esc_html__(
				'The Tab Override plugin requires WordPress version 3.3 or higher.',
				'tab-override'
			) );
		}

		$version = get_option( 'tab_override_version' );

		if ( self::VERSION !== $version ) {
			$old_settings = get_option( 'tab_override' );

			// first time plugin is activated, set defaults
			if ( ! is_array( $old_settings ) ) {
				$settings = $this->_default_options;

				// get the old tab size option
				$old_tab_size = get_option( 'tab_override_tab_size' );

				// if it exists, delete it
				if ( false !== $old_tab_size ) {
					delete_option( 'tab_override_tab_size' );

					// use the old tab size setting if possible
					// no need to check for the empty string since it's the default anyway
					if ( is_numeric( $old_tab_size ) ) {
						$old_tab_size = absint( $old_tab_size );
						if ( $old_tab_size ) {
							$settings['tab_size'] = ( 100 < $old_tab_size ) ? 100 : $old_tab_size;
						}
					}
				}
			} else {
				$settings = array();

				// use the old settings when possible, otherwise use the defaults
				foreach ( $this->_default_options as $option => $value ) {
					$settings[$option] = ( isset( $old_settings[$option] ) ) ? $old_settings[$option] : $value;
				}
			}

			// since this plugin only functions on admin pages, autoload is disabled
			// need to use add_option to set autoload, so delete the option and re-create it
			// older versions of the plugin had autoload enabled
			delete_option( 'tab_override' );
			add_option( 'tab_override', $settings, '', 'no' );

			// it's not necessary to delete the version option, since it was always
			// created with autoload enabled
			if ( false === $version ) {
				add_option( 'tab_override_version', self::VERSION, '', 'no' );
			} else {
				update_option( 'tab_override_version', self::VERSION );
			}
		}
	}

	/**
	 * Getter method for the main plugin file path.
	 *
	 * @return string the full path of the main plugin file
	 */
	public function get_plugin_file() {
		return $this->_plugin_file;
	}

	/**
	 * Adds a settings link to the plugins page.
	 *
	 * @param  array  $links The action links for the plugin (Activate, Deactivate, Edit, Delete)
	 * @param  string $file  The plugin file name
	 * @return array         The modified links array
	 */
	public function set_action_links( $links, $file ) {
		if ( $file == plugin_basename( $this->_plugin_file ) ) {
			array_unshift( $links, sprintf(
				'<a title="%1$s" href="options-general.php?page=tab-override-settings">%2$s</a>',
				esc_attr__( 'Edit settings for this plugin', 'tab-override' ),
				esc_html__( 'Settings', 'tab-override' )
			) );
		}

		return $links;
	}

	/**
	 * Changes the author site link on the plugins page to one link per author.
	 *
	 * @param  array  $links The meta links for the plugin (author site, plugin site)
	 * @param  string $file  The plugin file name
	 * @return array         The modified links array
	 */
	public function set_meta_links( $links, $file ) {
		if ( $file == plugin_basename( $this->_plugin_file ) ) {
			// look for author link - split text into two links
			foreach ( $links as $key => $link ) {
				if ( strpos( $link, 'author' ) !== false ) {
					$links[$key] = sprintf(
						'By <a title="%1$s" href="http://wjbryant.com/">Bill Bryant</a>, <a title="%1$s" href="http://tinsology.net/">Mathew Tinsley</a>',
						esc_attr__( 'Visit author homepage' )
					);
					break;
				}
			}
		}

		return $links;
	}

	/**
	 * Gets the display representation of the tab key combo.
	 *
	 * @param  boolean $useDefaults Whether to use the default settings
	 * @return string               The tab key combo
	 */
	public function get_tab_key_combo($useDefaults = false) {
		$tab_key_modifiers = ( $useDefaults ) ?
			$this->_default_options['tab_key_modifiers'] :
			$this->_options['tab_key_modifiers'];

		$tab_key_code = ( $useDefaults ) ?
			$this->_default_options['tab_key_code'] :
			$this->_options['tab_key_code'];

		$modifiers = '';

		foreach ( $tab_key_modifiers as $modifier ) {
			$modifiers .= ucfirst( $modifier ) . '+';
		}

		return $modifiers . $tab_key_code;
	}

	/**
	 * Gets the display representation of the untab key combo.
	 *
	 * @param  boolean $useDefaults Whether to use the default settings
	 * @return string               The untab key combo
	 */
	public function get_untab_key_combo($useDefaults = false) {
		$untab_key_modifiers = ( $useDefaults ) ?
			$this->_default_options['untab_key_modifiers'] :
			$this->_options['untab_key_modifiers'];

		$untab_key_code = ( $useDefaults ) ?
			$this->_default_options['untab_key_code'] :
			$this->_options['untab_key_code'];

		$modifiers = '';

		foreach ( $untab_key_modifiers as $modifier ) {
			$modifiers .= ucfirst( $modifier ) . '+';
		}

		return $modifiers . $untab_key_code;
	}

	/**
	 * Outputs the HTML for the plugin settings page.
	 */
	public function create_settings_page() {
		// get the current options for the field methods
		$this->_options = get_option( 'tab_override' );
		?>
		<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php esc_html_e( 'Tab Override Settings', 'tab-override' ); ?></h2>
		<form method="post" action="options.php">
			<?php
				settings_fields( 'tab_override' );
				do_settings_sections( 'tab-override-settings' );
			?>
			<p class="submit">
				<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'tab-override' ); ?>" />
			</p>
			<div style="text-align: right;">
				<a title="<?php esc_attr_e( 'Tab Override Documentation at tinsology.net', 'tab-override' ); ?>" href="http://tinsology.net/plugins/tab-override/"><?php esc_html_e( 'Documentation', 'tab-override' ); ?></a> |
				<a title="<?php esc_attr_e( 'Tab Override Page at wjbryant.com', 'tab-override' ); ?>" href="http://wjbryant.com/projects/tab-override/">wjbryant.com</a>
			</div>
		</form>
		</div>
		<?php
	}

	/**
	 * Outputs the description HTML for the editor settings section.
	 */
	public function editor_section_description() {
		echo '<p>' . esc_html__( 'These options control how the tab and enter keys function in the HTML editor.', 'tab-override' ) . '</p>';
	}

	/**
	 * Outputs the HTML for the tab size field.
	 */
	public function tab_size_field() {
		?>
		<input type="text" id="tab_override_tab_size" name="tab_override[tab_size]" maxlength="3" class="small-text" value="<?php echo esc_attr( $this->_options['tab_size'] ); ?>" />
		<span class="description"><?php esc_html_e( 'Leave blank to use the tab character (default)', 'tab-override' ); ?></span>
		<?php
	}

	/**
	 * Outputs the HTML for the auto indent field.
	 */
	public function auto_indent_field() {
		?>
		<input type="checkbox" id="tab_override_auto_indent" name="tab_override[auto_indent]" value="1" <?php checked( $this->_options['auto_indent'], 1 ); ?> />
		<label for="tab_override_auto_indent"><?php esc_html_e( 'Enable auto indent', 'tab-override' ); ?></label>
		<?php
	}

	/**
	 * Outputs the HTML for the tab key field.
	 */
	public function tab_key_field() {
		?>
		<input type="hidden" id="tab_override_tab_key_code" name="tab_override[tab_key_code]" value="<?php echo esc_attr( $this->_options['tab_key_code'] ); ?>" />
		<input type="hidden" id="tab_override_tab_key_modifiers" name="tab_override[tab_key_modifiers]" value="<?php echo esc_attr( join( ',', $this->_options['tab_key_modifiers'] ) ); ?>" />
		<input type="text" id="tab_override_tab_key_combo" size="30" value="<?php echo esc_attr( $this->get_tab_key_combo() ); ?>" />
		<span class="description" tabindex="-1"><?php echo esc_html__( 'default:', 'tab-override' ) . ' ' . $this->get_tab_key_combo(true); ?></span>
		<p class="description"><?php echo esc_html__( 'Keys are represented by keyCode number. Press Esc to exit the field.', 'tab-override' ); ?></p>
		<?php
	}

	/**
	 * Outputs the HTML for the untab key field.
	 */
	public function untab_key_field() {
		?>
		<input type="hidden" id="tab_override_untab_key_code" name="tab_override[untab_key_code]" value="<?php echo esc_attr( $this->_options['untab_key_code'] ); ?>" />
		<input type="hidden" id="tab_override_untab_key_modifiers" name="tab_override[untab_key_modifiers]" value="<?php echo esc_attr( join( ',', $this->_options['untab_key_modifiers'] ) ); ?>" />
		<input type="text" id="tab_override_untab_key_combo" size="30" value="<?php echo esc_attr( $this->get_untab_key_combo() ); ?>" />
		<span class="description" tabindex="-1"><?php echo esc_html__( 'default:', 'tab-override' ) . ' ' . $this->get_untab_key_combo(true); ?></span>
		<p class="description"><?php echo esc_html__( 'Keys are represented by keyCode number. Press Esc to exit the field.', 'tab-override' ); ?></p>
		<?php
	}

	/**
	 * Outputs the HTML for the tabs button field.
	 */
	public function tabs_button_field() {
		?>
		<input type="checkbox" id="tab_override_tabs_button" name="tab_override[tabs_button]" value="1" <?php checked( $this->_options['tabs_button'], 1 ); ?> />
		<label for="tab_override_tabs_button"><?php esc_html_e( 'Add a tabs on/off button to the HTML editor toolbar', 'tab-override' ); ?></label>
		<?php
	}

	/**
	 * Outputs the HTML for the enable fields.
	 */
	public function enable_fields() {
		?>
		<input type="checkbox" id="tab_override_enable_index" name="tab_override[enable_index]" value="1" <?php checked( $this->_options['enable_index'], 1 ); ?> />
		<label for="tab_override_enable_index"><?php esc_html_e( 'Dashboard (QuickPress / Recent Comments)', 'tab-override' ); ?></label>
		<br />
		<input type="checkbox" id="tab_override_enable_post" name="tab_override[enable_post]" value="1" <?php checked( $this->_options['enable_post'], 1 ); ?> />
		<label for="tab_override_enable_post"><?php esc_html_e( 'Post / Page', 'tab-override' ); ?></label>
		<br />
		<input type="checkbox" id="tab_override_enable_post_new" name="tab_override[enable_post_new]" value="1" <?php checked( $this->_options['enable_post_new'], 1 ); ?> />
		<label for="tab_override_enable_post_new"><?php esc_html_e( 'New Post / New Page', 'tab-override' ); ?></label>
		<br />
		<input type="checkbox" id="tab_override_enable_edit_comments" name="tab_override[enable_edit_comments]" value="1" <?php checked( $this->_options['enable_edit_comments'], 1 ); ?> />
		<label for="tab_override_enable_edit_comments"><?php esc_html_e( 'Edit Comments', 'tab-override' ); ?></label>
		<br />
		<input type="checkbox" id="tab_override_enable_comment" name="tab_override[enable_comment]" value="1" <?php checked( $this->_options['enable_comment'], 1 ); ?> />
		<label for="tab_override_enable_comment"><?php esc_html_e( 'Comment', 'tab-override' ); ?></label>
		<br />
		<input type="checkbox" id="tab_override_enable_theme_editor" name="tab_override[enable_theme_editor]" value="1" <?php checked( $this->_options['enable_theme_editor'], 1 ); ?> />
		<label for="tab_override_enable_theme_editor"><?php esc_html_e( 'Theme Editor', 'tab-override' ); ?></label>
		<br />
		<input type="checkbox" id="tab_override_enable_plugin_editor" name="tab_override[enable_plugin_editor]" value="1" <?php checked( $this->_options['enable_plugin_editor'], 1 ); ?> />
		<label for="tab_override_enable_plugin_editor"><?php esc_html_e( 'Plugin Editor', 'tab-override' ); ?></label>
		<?php
	}

	/**
	 * Outputs the description HTML for the advanced settings section.
	 */
	public function advanced_section_description() {
		echo '<p>' . esc_html__( 'These options control the jQuery selectors that are used for each page. ' .
			'This is useful for solving compatibility issues with other plugins.', 'tab-override' ) . '</p>' .
			'<p><strong>' . esc_html__( 'Warning: Changing these settings may cause WordPress to function improperly.', 'tab-override' ) .
			'<br />' . esc_html__( 'Do not change these settings unless you know what you are doing!', 'tab-override' ) . '</strong></p>';
	}

	/**
	 * Outputs the HTML for the dashboard selector field.
	 */
	public function dashboard_selector_field() {
		?>
		<input type="text" id="tab_override_dashboard_selector" name="tab_override[dashboard_selector]" size="50" value="<?php echo esc_attr( $this->_options['dashboard_selector'] ); ?>" />
		<span class="description"><?php echo esc_html__( 'default:', 'tab-override' ) . ' ' . $this->_default_options['dashboard_selector']; ?></span>
		<?php
	}

	/**
	 * Outputs the HTML for the post selector field.
	 */
	public function post_selector_field() {
		?>
		<input type="text" id="tab_override_post_selector" name="tab_override[post_selector]" size="50" value="<?php echo esc_attr( $this->_options['post_selector'] ); ?>" />
		<span class="description"><?php echo esc_html__( 'default:', 'tab-override' ) . ' ' . $this->_default_options['post_selector']; ?></span>
		<?php
	}

	/**
	 * Outputs the HTML for the fullscreen selector field.
	 */
	public function fullscreen_selector_field() {
		?>
		<input type="text" id="tab_override_fullscreen_selector" name="tab_override[fullscreen_selector]" size="50" value="<?php echo esc_attr( $this->_options['fullscreen_selector'] ); ?>" />
		<span class="description"><?php echo esc_html__( 'default:', 'tab-override' ) . ' ' . $this->_default_options['fullscreen_selector']; ?></span>
		<?php
	}

	/**
	 * Outputs the HTML for the editor selector field.
	 */
	public function editor_selector_field() {
		?>
		<input type="text" id="tab_override_editor_selector" name="tab_override[editor_selector]" size="50" value="<?php echo esc_attr( $this->_options['editor_selector'] ); ?>" />
		<span class="description"><?php echo esc_html__( 'default:', 'tab-override' ) . ' ' . $this->_default_options['editor_selector']; ?></span>
		<?php
	}

	/**
	 * Outputs the HTML for the "other" selector field.
	 */
	public function other_selector_field() {
		?>
		<input type="text" id="tab_override_other_selector" name="tab_override[other_selector]" size="50" value="<?php echo esc_attr( $this->_options['other_selector'] ); ?>" />
		<span class="description"><?php echo esc_html__( 'default:', 'tab-override' ) . ' ' . $this->_default_options['other_selector']; ?></span>
		<?php
	}

	/**
	 * Sanitizes option values before they are saved in the database.
	 *
	 * @param  array $input The settings from the submitted settings form
	 * @return array        The sanitized settings
	 */
	public function sanitize_settings( $input ) {
		$clean = array();

		$input_tab_size = trim( $input['tab_size'] );

		// the tab size must be either an empty string or a number between 1 and 100 (inclusive)
		if ( '' !== $input_tab_size ) {
			$input_tab_size = absint( $input_tab_size );

			if ( ! $input_tab_size || 100 < $input_tab_size ) {
				$input_tab_size = ''; // the default tab size
				add_settings_error(
					'tab_override_tab_size',
					'tab_override_tab_size_error',
					esc_html__( 'The tab size must be a number between 1 and 100.', 'tab-override' ),
					'error'
				);
			}
		}

		$clean['tab_size'] = $input_tab_size;

		// these options are checkboxes which should be 1 if checked and 0 if not checked
		$checkboxes = array(
			'auto_indent',
			'tabs_button',
			'enable_index',
			'enable_post',
			'enable_post_new',
			'enable_edit_comments',
			'enable_comment',
			'enable_theme_editor',
			'enable_plugin_editor'
		);

		foreach ( $checkboxes as $checkbox ) {
			$clean[$checkbox] = ( isset( $input[$checkbox] ) && 1 == $input[$checkbox] ) ? 1 : 0;
		}

		// these options should be numbers
		$key_codes = array(
			'tab_key_code',
			'untab_key_code'
		);

		foreach ( $key_codes as $key_code ) {
			$clean[$key_code] = absint( $input[$key_code] );
		}

		// these options should be stored as arrays
		$key_modifier_names = array(
			'tab_key_modifiers',
			'untab_key_modifiers'
		);

		$allowed_modifiers = array( 'alt', 'ctrl', 'meta', 'shift' );

		foreach ( $key_modifier_names as $key_modifier_name ) {
			$key_modifiers = explode( ',', $input[$key_modifier_name] );
			$clean[$key_modifier_name] = array();

			foreach ( $key_modifiers as $key_modifier ) {
				if ( in_array( $key_modifier, $allowed_modifiers ) ) {
					$clean[$key_modifier_name][] = $key_modifier;
				}
			}
		}

		// these options are strings and can contain anything
		$selectors = array(
			'dashboard_selector',
			'post_selector',
			'fullscreen_selector',
			'editor_selector',
			'other_selector'
		);

		foreach ( $selectors as $selector ) {
			$clean[$selector] = $input[$selector];
		}

		return $clean;
	}

	/**
	 * Registers the plugin settings and adds sections and fields to the
	 * settings page.
	 */
	public function register_settings() {
		// store all settings in an array
		register_setting( 'tab_override', 'tab_override',
			array( $this, 'sanitize_settings' ) );

		// add the editor settings section and fields
		add_settings_section(
			'editor',
			esc_html__( 'HTML Editor', 'tab-override' ),
			array( $this, 'editor_section_description' ),
			'tab-override-settings'
		);

		add_settings_field(
			'tab_override_tab_size',
			'<label for="tab_override_tab_size">' . esc_html__( 'Tab Size (number 1-100)', 'tab-override' ) . '</label>',
			array( $this, 'tab_size_field' ),
			'tab-override-settings',
			'editor'
		);

		add_settings_field(
			'tab_override_auto_indent',
			esc_html__( 'Auto Indent', 'tab-override' ),
			array( $this, 'auto_indent_field' ),
			'tab-override-settings',
			'editor'
		);

		add_settings_field(
			'tab_override_tab_key',
			esc_html__( 'Tab Key Combination', 'tab-override' ),
			array( $this, 'tab_key_field' ),
			'tab-override-settings',
			'editor'
		);

		add_settings_field(
			'tab_override_untab_key',
			esc_html__( 'Untab Key Combination', 'tab-override' ),
			array( $this, 'untab_key_field' ),
			'tab-override-settings',
			'editor'
		);

		add_settings_field(
			'tab_override_tabs_button',
			esc_html__( 'Tabs On/Off Toolbar Button', 'tab-override' ),
			array( $this, 'tabs_button_field' ),
			'tab-override-settings',
			'editor'
		);

		add_settings_field(
			'tab_override_enable',
			esc_html__( 'Enable Tab Override on these pages', 'tab-override' ),
			array( $this, 'enable_fields' ),
			'tab-override-settings',
			'editor'
		);

		// add the advanced settings section and fields
		add_settings_section(
			'advanced',
			esc_html__( 'Advanced', 'tab-override' ),
			array( $this, 'advanced_section_description' ),
			'tab-override-settings'
		);

		add_settings_field(
			'tab_override_dashboard_selector',
			'<label for="tab_override_dashboard_selector">' . esc_html__( 'Dashboard', 'tab-override' ) . '</label>',
			array( $this, 'dashboard_selector_field' ),
			'tab-override-settings',
			'advanced'
		);

		add_settings_field(
			'tab_override_post_selector',
			'<label for="tab_override_post_selector">' . esc_html__( 'Post', 'tab-override' ) . '</label>',
			array( $this, 'post_selector_field' ),
			'tab-override-settings',
			'advanced'
		);

		add_settings_field(
			'tab_override_fullscreen_selector',
			'<label for="tab_override_fullscreen_selector">' . esc_html__( 'Fullscreen', 'tab-override' ) . '</label>',
			array( $this, 'fullscreen_selector_field' ),
			'tab-override-settings',
			'advanced'
		);

		add_settings_field(
			'tab_override_editor_selector',
			'<label for="tab_override_editor_selector">' . esc_html__( 'Editor', 'tab-override' ) . '</label>',
			array( $this, 'editor_selector_field' ),
			'tab-override-settings',
			'advanced'
		);

		add_settings_field(
			'tab_override_other_selector',
			'<label for="tab_override_other_selector">' . esc_html__( 'Other', 'tab-override' ) . '</label>',
			array( $this, 'other_selector_field' ),
			'tab-override-settings',
			'advanced'
		);
	}

	/**
	 * Creates the settings menu.
	 */
	public function create_menu() {
		$this->_options_page_hook_suffix = add_options_page( esc_html__( 'Tab Override Settings', 'tab-override' ), 'Tab Override',
			'manage_options', 'tab-override-settings', array( $this, 'create_settings_page' ) );

		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Adds the scripts to pages that have Tab Override enabled.
	 *
	 * @param string $hook_suffix The name of the current file being displayed
	 */
	public function add_scripts( $hook_suffix ) {
		// add the script for the plugin options page
		if ( $this->_options_page_hook_suffix == $hook_suffix ) {
			wp_enqueue_script( 'taboverride-settings-page', plugins_url( 'js/taboverride-settings-page.min.js', $this->_plugin_file ),
				array( 'jquery' ), '0.1.0-1', true );
		}

		// these are the admin pages that include a textarea for editing content
		$admin_edit_pages = array(
			'index.php', // Dashboard
			'post.php',
			'post-new.php',
			'edit-comments.php',
			'comment.php',
			'theme-editor.php',
			'plugin-editor.php'
		);

		if ( in_array( $hook_suffix, $admin_edit_pages ) ) {
			$settings = get_option( 'tab_override' );

			// this is 1 or 0
			$page_enabled = $settings['enable_' . preg_replace(
				array( '/-/', '/\.php/' ), array( '_', '' ), $hook_suffix )];

			// use true/false instead of 1/0
			$tabs_button = ( $settings['tabs_button'] ) ? true : false;

			// set the page type string and the tabs default (true = on, false = off)
			// check this before checking if the page is enabled to avoid checking
			// the same thing more than once (for the tabs button option)
			$tabs_default = true;
			switch ( $hook_suffix ) {
				case 'index.php':
					$page_type = 'dashboard';
					break;
				case 'post.php':
				case 'post-new.php':
					$page_type = 'post';
					$tabs_default = ( $page_enabled ) ? true : false;
					break;
				case 'theme-editor.php':
				case 'plugin-editor.php':
					$page_type = 'editor';
					break;
				default:
					$page_type = 'general';
			}

			// if this page is enabled in the options menu or is a post edit page
			// with the tabs button enabled, load the Tab Override scripts
			if ( $page_enabled || ( ! $tabs_default && $tabs_button ) ) {

				// the parameters used by the setup script
				// note that the JavaScript files use camelCase
				$params = array(
					'tabSize' => $settings['tab_size'],
					'autoIndent' => ( $settings['auto_indent'] ) ? true : false,
					'tabsButton' => $tabs_button,
					'pageType' => $page_type,
					'buttonOnTitle' => esc_attr__( 'Turn Tab Override on' ),
					'buttonOnValue' => esc_attr__( 'tabs on' ),
					'buttonOffTitle' => esc_attr__( 'Turn Tab Override off' ),
					'buttonOffValue' => esc_attr__( 'tabs off' ),
					'tabsDefault' => $tabs_default,
					'tabKeyCode' => $settings['tab_key_code'],
					'tabKeyModifiers' => $settings['tab_key_modifiers'],
					'untabKeyCode' => $settings['untab_key_code'],
					'untabKeyModifiers' => $settings['untab_key_modifiers'],
					'dashboardSelector' => $settings['dashboard_selector'],
					'postSelector' => $settings['post_selector'],
					'fullscreenSelector' => $settings['fullscreen_selector'],
					'editorSelector' => $settings['editor_selector'],
					'otherSelector' => $settings['other_selector']
				);

				// include the Tab Override and jQuery plugin scripts in the footer
				wp_enqueue_script( 'taboverride', plugins_url( 'js/taboverride.min.js', $this->_plugin_file ),
					array(), '4.0.0-1', true );

				wp_enqueue_script( 'jquery-taboverride', plugins_url( 'js/jquery.taboverride.min.js', $this->_plugin_file ),
					array( 'jquery', 'taboverride' ), '4.0.2-1', true );

				$dependencies = array( 'jquery', 'taboverride', 'jquery-taboverride' );
				if ( 'post' == $page_type ) {
					$dependencies[] = 'quicktags';
				}

				// include the setup script in the footer
				wp_enqueue_script( 'taboverride-setup', plugins_url( 'js/taboverride-setup.min.js', $this->_plugin_file ),
					$dependencies, '2.1.0', true );

				// add the setup parameters before the setup script
				wp_localize_script( 'taboverride-setup', 'tabOverrideParams', $params );

				// allow additional actions after scripts are enqueued
				do_action( 'tab_override_add_scripts' );
			}
		}
	}
}
