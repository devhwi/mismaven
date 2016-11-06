<?php

/*Use:
	[tabbed-login-form width="200"]
		width: Enter width in pixels
			NOTE - DON'T ADD "px" after pixels
			i.e. Don't write width="200px" just write width="200"
*/

global $string;

function tabbed_shortcode( $atts ) {
    extract(shortcode_atts(array(
        'width' => '400'
    ), $atts));
	
	$plugin_url = (is_ssl()) ? str_replace('http://','https://', WP_PLUGIN_URL) : WP_PLUGIN_URL;
	// CSS
	$sidebar_login_css = $plugin_url . '/tabbed-login/css/tabbed-login.css';
    wp_register_style('tabbed_login_css_styles', $sidebar_login_css);
    wp_enqueue_style('tabbed_login_css_styles');
	
	load_plugin_textdomain('tabbed-login', false, 'tabbed-login/lang/');
	// Scripts
	$tabbed_login_script = $plugin_url . '/tabbed-login/js/tabbed-login.js';
	
	wp_enqueue_script('jquery');
	wp_register_script('tabbed-login', $tabbed_login_script);
	wp_enqueue_script('tabbed-jQuery');
	wp_enqueue_script('tabbed-login');
	
	global $user_ID, $user_identity,$current_url;
	get_currentuserinfo();
	$current_url='http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];	
	if(!$user_ID){	
		$string="<div id='login-register-password' class='shortcode' style='width:".$width."px'>";
	}else{
		$string="<div id='login-register-password' class='shortcode logged-in' style='width:".$width."px'>";
	}
	
	if (!$user_ID) {
		$string .= "<ul class='tabs_login'>
					<li class='active_login'><a href='#login' >".__('Login', 'tabbed-login')."</a></li>";
		if(get_option('users_can_register')) { 
			$string .= "<li><a href='#register'>".__('Register', 'tabbed-login')."</a></li>";
		}
		$string .= "<li><a href='#forgot_password'>".__('Forgot', 'tabbed-login')."</a></li>
					</ul>
					<div class='tab_container_login'>
					<div id='login' class='tab_content_login'>";
		$register = $_GET['register']; $reset = $_GET['reset']; 
		if ($register == true) {
			$string .= "<h3>".__('Success!', 'tabbed-login')."</h3>"
			."<p>".__('Check your email for the password and then return to log in.', 'tabbed-login')."</p>";
		} elseif ($reset == true) { 			
			$string .= "<h3>".__('Success!', 'tabbed-login')."</h3>"
			."<p>".__('Check your email to reset your password.', 'tabbed-login')."</p>";
		} else { 
			$string .= "<h3>".__('Have an account?', 'tabbed-login')."</h3>";
		}
		$string .= "
			<form method='post' action='".site_url("/wp-login.php")."' class='wp-user-form'>
				<div class='username'>
					<label for='user_login'>".__('Username', 'tabbed-login').": </label>
					<input type='text' name='log' value='".esc_attr(stripslashes($user_login))."' size='20' id='user_login' tabindex='11' />
				</div>
				<div class='password'>
					<label for='user_pass'>".__('Password', 'tabbed-login').": </label>
					<input type='password' name='pwd' value='' size='20' id='user_pass' tabindex='12' />
				</div>				
				<div class='login_fields'>
					<div class='rememberme'>
						<label for='rememberme'>
							<input type='checkbox' name='rememberme' value='forever' checked='checked' id='rememberme' tabindex='13' />".__(' Remember me', 'tabbed-login')."
						</label>
					</div>"
					.do_action('login_form').
					"<input type='submit' name='user-submit' value='".__('Login', 'tabbed-login')."' tabindex='14' class='user-submit' />
					<input type='hidden' name='redirect_to' value='".$current_url."' />
					<input type='hidden' name='user-cookie' value='1' />
				</div>
			</form>
		</div>
		";
		if(get_option('users_can_register')) { 
			$string .="
				<div id='register' class='tab_content_login' style='display:none;'>
			<h3>".__('Register for this site!', 'tabbed-login')."</h3>
			<p>".__('Sign up now for the good stuff.', 'tabbed-login')."</p>
			<form method='post' action='".site_url('wp-login.php?action=register', 'login_post')."' class='wp-user-form'>
				<div class='username'>
					<label for='user_login'>".__('Username', 'tabbed-login').": </label>
					<input type='text' name='user_login' value='".esc_attr(stripslashes($user_login))."' size='20' id='user_login' tabindex='101' />
				</div>
				<div class='password'>
					<label for='user__mail'>".__('Your Email', 'tabbed-login').": </label>
					<input type='text' name='user__mail' value='".esc_attr(stripslashes($user__mail))."' size='25' id='user__mail' tabindex='102' />
				</div>
				<div class='login_fields'>"
					.do_action('register_form').
					"<input type='submit' name='user-submit' value='".__('Sign up!', 'tabbed-login')."' class='user-submit' tabindex='103' />";
			$register = $_GET['register']; 
			if($register == true) { 
				$string .= "<p>Check your email for the password!</p>";
			}
			$string .="
					<input type='hidden' name='redirect_to' value='".$current_url."?register=true' />
					<input type='hidden' name='user-cookie' value='1' />
				</div>
			</form>
		</div>
			";
		}
		
		$string .="
			<div id='forgot_password' class='tab_content_login' style='display:none;'>
			<h3>".__('Lost Your Password?', 'tabbed-login')."</h3>
			<p>".__('Enter your username or email to reset your password.', 'tabbed-login')."</p>
			<form method='post' action='".site_url('wp-login.php?action=lostpassword', 'login_post')."' class='wp-user-form'>
				<div class='username'>
					<label for='user_login' class='hide'>".__('Username or Email', 'tabbed-login').": </label>
					<input type='text' name='user_login' value='' size='20' id='user_login' tabindex='1001' />
				</div>
				<div class='login_fields'>"
					.do_action('login_form', 'resetpass').
					"<input type='submit' name='user-submit' value='".__('Reset my password', 'tabbed-login')."' class='user-submit' tabindex='1002' />";
		$reset = $_GET['reset']; 
		if($reset == true) { 
			$string .= "<p>".__('A message was sent to your email address.','tabbed-login')."</p>"; 
		}
		$string .="
					<input type='hidden' name='redirect_to' value='".$current_url."?reset=true' />
					<input type='hidden' name='user-cookie' value='1' />
				</div>
			</form>
		</div>
	</div>
		";
	} else {
		$string .="
			<div class='sidebox'>
		<h3>".__('Welcome, ', 'tabbed-login').$user_identity."</h3>";
		if (version_compare($GLOBALS['wp_version'], '2.5', '>=')){
			if (get_option('show_avatars')){
			global $userdata; get_currentuserinfo();
			$string .="
				<div class='usericon'>".get_avatar($userdata->ID, 50)."</div>";
		}else{
			$string .="
				<style type='text/css'>.userinfo p{margin-left: 0px !important;text-align:center;}.userinfo{width:100%;}</style>";
		}}
		$string .="
		<div class='userinfo'>
			<p>".__('You are logged in as ', 'tabbed-login')."<strong>".$user_identity."</strong></p>
			<p>
				<a href='".wp_logout_url($current_url)."'>".__('Log out', 'tabbed-login')."</a> | ";
		if (current_user_can('manage_options')) { 
			$string .="<a href='".admin_url()."'>".__('Admin', 'tabbed-login')."</a>"; 
		} else { 
			$string .="<a href='".admin_url()."profile.php'>".__('Profile', 'tabbed-login')."</a>"; 
		}
		$string .="
			</p>
		</div>
	</div>
		";
	}
	$string .="</div>";
	
    return $string;
}
add_shortcode('tabbed-login-form', 'tabbed_shortcode');

?>