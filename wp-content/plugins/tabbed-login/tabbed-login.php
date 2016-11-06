<?php
/*
Plugin Name: Tabbed Login Widget
Plugin URI: http://wordpress.org/extend/plugins/tabbed-login/
Description: Easily add an beautifull tabbed login to your site's sidebar.
Version: 1.1.2
Author: Vivek Marakana
Author URI: http://htmlcsstutor.com
*/
include("tabbed-login-shortcode.php");
add_action( 'widgets_init', 'tabbed_load_login_widget' );

function tabbed_load_login_widget() {

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

	register_widget( 'tabbed_login_Widget' );
}

class tabbed_login_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	public function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-login tabbed-login-widget', 'description' => __('Display Tabbed Login/Register/LostPassword form in sidebar.','tabbed-login') );

		/* Widget control settings. */
		$control_ops = array( 'id_base' => 'tabbed-login-widget' );

		/* Create the widget. */
		parent::__construct( 'tabbed-login-widget', 'Tabbed Login Widget', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Before widget (defined by themes). */
		echo $before_widget;
?>

	<?php global $user_ID, $user_identity,$current_url;
		  $current_url='http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	get_currentuserinfo(); if (!$user_ID) { ?>

<div id="login-register-password">
	<ul class="tabs_login">
		<li class="active_login"><a href="#login" ><?php _e('Login', 'tabbed-login'); ?></a></li>
		<?php  if(get_option('users_can_register')) { ?>
		<li><a href="#register"><?php _e('Register', 'tabbed-login') ?></a></li>
		<?php }; ?>
		<li><a href="#forgot_password"><?php _e('Forgot', 'tabbed-login'); ?></a></li>
	</ul>
	<div class="tab_container_login">
		<div id="login" class="tab_content_login">

			<?php $register = $_GET['register']; $reset = $_GET['reset']; if ($register == true) { ?>

			<h3><?php _e('Success!', 'tabbed-login'); ?></h3>
			<p><?php _e('Check your email for the password and then return to log in.', 'tabbed-login'); ?></p>

			<?php } elseif ($reset == true) { ?>

			<h3><?php _e('Success!', 'tabbed-login'); ?></h3>
			<p><?php _e('Check your email to reset your password.', 'tabbed-login'); ?></p>

			<?php } else { ?>


			<?php } ?>

			<form method="post" action="<?php bloginfo('url') ?>/wordpress-bootstrap/wp-login.php" class="wp-user-form">
				<div class="username">
					<label for="user_login"><?php _e('아이디', 'tabbed-login'); ?> </label>
					<input type="text" name="log" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="11" />
				</div>
				<div class="password">
					<label for="user_pass"><?php _e('Password', 'tabbed-login'); ?> </label>
					<input type="password" name="pwd" value="" size="20" id="user_pass" tabindex="12" />
				</div>
				<div class="login_fields">
					<div class="rememberme">
						<label for="rememberme">
							<input type="checkbox" name="rememberme" value="forever" checked="checked" id="rememberme" tabindex="13" /><?php _e(' Remember me', 'tabbed-login'); ?>
						</label>
					</div>
					<?php do_action('login_form'); ?>
					<input type="submit" id="submit" name="user-submit" value="<?php _e('Login', 'tabbed-login'); ?>" tabindex="14" class="user-submit" />
					<input type="hidden" name="redirect_to" value="<?php echo $current_url; ?>" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>
		</div>

		<?php  if(get_option('users_can_register')) { ?>

		<div id="register" class="tab_content_login" style="display:none;">
			<h3><?php _e('메이븐 회원이 되어주세요.', 'tabbed-login'); ?></h3>
			<p><?php _e('Sign up now for the good stuff.', 'tabbed-login'); ?></p>
			<form method="post" action="<?php echo site_url('/wp-login.php?action=register', 'login_post') ?>" class="wp-user-form">
				<div class="username">
					<label for="user_login"><?php _e('아이디', 'tabbed-login'); ?> </label>
					<input type="text" name="user_login" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="101" />
				</div>
				<div class="password">
					<label for="user_email"><?php _e('Your Email', 'tabbed-login'); ?> </label>
					<input type="text" name="user_email" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" id="user_email" tabindex="102" />
				</div>
				<div class="login_fields">
					<?php do_action('register_form'); ?>
					<input type="submit" name="user-submit" id="submit" value="<?php _e('회원가입', 'tabbed-login'); ?>" class="user-submit" tabindex="103" />
					<?php $register = $_GET['register']; if($register == true) { echo '<p>Check your email for the password!</p>'; } ?>
					<input type="hidden" name="redirect_to" value="<?php echo $current_url; ?>?register=true" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>
		</div>

		<?php }; ?>

		<div id="forgot_password" class="tab_content_login" style="display:none;">
			<h3><?php _e('Lost Your Password?', 'tabbed-login'); ?></h3>
			<p><?php _e('Enter your username or email to reset your password.', 'tabbed-login'); ?></p>
			<form method="post" action="<?php echo site_url('/wp-login.php?action=lostpassword', 'login_post') ?>" class="wp-user-form">
				<div class="username">
					<label for="user_login" class="hide"><?php _e('Username or Email', 'tabbed-login'); ?> </label>
					<input type="text" name="user_login" value="" size="20" id="user_login" tabindex="1001" />
				</div>
				<div class="login_fields">
					<?php do_action('login_form', 'resetpass'); ?>
					<input type="submit" name="user-submit" id="submit" value="<?php _e('Reset my password', 'tabbed-login'); ?>" class="user-submit" tabindex="1002" />
					<?php $reset = $_GET['reset']; if($reset == true) { echo '<p>'.__('A message was sent to your email address.','tabbed-login').'</p>'; } ?>
					<input type="hidden" name="redirect_to" value="<?php echo $current_url; ?>?reset=true" />
					<input type="hidden" name="user-cookie" value="1" />
				</div>
			</form>
		</div>
	</div>

	<?php } else { // is logged in ?>

<?php
/* ----- Calculate Member's Point with post, board, comment count ----- */
include('./dbconfig.php');

//Post Count
$sql = "SELECT a.id, display_name, COUNT( b.id ) count
          FROM wp_users a
          LEFT OUTER JOIN wp_posts b ON a.id = b.post_author
           AND post_status =  'publish'
           AND comment_status =  'open'
      GROUP BY display_name
        HAVING display_name = '$user_identity'";
$post_result = mysqli_query($connect, $sql);
if($post_result){
	while($post_row = mysqli_fetch_array($post_result)){
		$member_post = $post_row['count'];
	}
}

//KBoard Count
$sql = "SELECT b.id, display_name, count(a.uid) count
          FROM wp_kboard_board_content a, wp_users b
         WHERE a.member_uid = b.id
           AND a.board_id in (1,2,3,4,5,6,7,8,9,10,11)
           AND display_name = '$user_identity'
      GROUP BY a.member_uid";
$board_result = mysqli_query($connect, $sql);
if($board_result){
	while($board_row = mysqli_fetch_array($board_result)){
		$member_board = $board_row['count'];
	}
}

//Comment Count
$sql = "SELECT a.id, display_name, count(uid) count
          FROM wp_users a
          LEFT OUTER JOIN wp_kboard_comments b ON a.id = b.user_uid
      GROUP BY display_name
        HAVING display_name = '$user_identity'";
$comment_result = mysqli_query($connect, $sql);
if($comment_result){
	while($comment_row = mysqli_fetch_array($comment_result)){
		$member_comment = $comment_row['count'];
	}
}

//Member's Point
$sql = "SELECT a.id
              ,a.display_name
              ,(a.count + b.count) * 5 + c.count as point
        FROM(
            SELECT a.id, display_name, COUNT( b.id ) count
            FROM wp_users a
            LEFT OUTER JOIN wp_posts b ON a.id = b.post_author
            AND post_status =  'publish'
            AND comment_status =  'open'
            GROUP BY display_name
            ) a,
            (
            SELECT b.id, display_name, count(a.uid) count
            FROM wp_kboard_board_content a, wp_users b
            WHERE a.member_uid = b.id
            AND a.board_id in (1,2,3,4,5,6,7,8,9,10,11)
            GROUP BY a.member_uid
            ) b,
            (
            SELECT a.id, display_name, count(uid) count
            FROM wp_users a
            LEFT OUTER JOIN wp_kboard_comments b ON a.id = b.user_uid
            GROUP BY display_name
            ORDER BY count DESC
            ) c
        WHERE a.id = b.id
        AND a.id = c.id
        AND a.display_name = '$user_identity'";
$point_result = mysqli_query($connect, $sql);
if($point_result){
	while($point_row = mysqli_fetch_array($point_result)){
		$member_point = $point_row['point'];
	}
}

//Latest Comments of User's content
$sql = "SELECT a.uid, content_uid, a.content, a.user_display
		  FROM wp_kboard_comments a, wp_kboard_board_content b
		 WHERE user_display != '$user_identity'
		   AND b.board_id IN (1,2,3,4,5,6,7,8,9,10)
           AND a.content_uid = b.uid
           AND member_display = '$user_identity'
	  ORDER BY a.uid DESC
	     LIMIT 5";
$latest_comment_result = mysqli_query($connect, $sql);
?>

<div id="login-register-password" class="logged-in">
	<style>
	#login-register-password {
	position:relative;
	}

	</style>
	<div class="sidebox">
		<?php if (version_compare($GLOBALS['wp_version'], '2.5', '>=')){
			if (get_option('show_avatars')){
		?>
		<div class="usericon">
			<?php global $userdata; get_currentuserinfo(); echo get_avatar($userdata->ID, 150); ?>
		</div>
		<?php  }else{?>
		<style type="text/css">.userinfo p{margin-left: 0px !important;text-align:center;}.userinfo{width:100%;}</style>
		<?php }}?>
		<div class="userinfo">
			<p><strong><?php echo $user_identity; ?></strong>님, 환영합니다.</p>
			<p>
				<a href="<?php echo wp_logout_url($current_url); ?>"><?php _e('Log out', 'tabbed-login'); ?></a> |
				<?php if (current_user_can('manage_options')) {
					echo '<a href="' . admin_url() . '" target="_blank">' . __('Admin', 'tabbed-login') . '</a>'; } else {
					echo '<a href="' . admin_url() . 'profile.php" target="_blank">' . __('Profile', 'tabbed-login') . '</a>'; } ?>
				<?php
					if (current_user_can('publish_post')){
						echo ' | <a href="' . admin_url() . 'post-new.php" target="_blank">' . '포스팅' . '</a>';
					}
				?>
			</p>
			<p>
				<table class="logintable">
					<tr>
						<td>포스팅 : <?php  echo $member_post?></td>
						<td>게시판 : <?php echo $member_board?></td>
					</tr>
					<tr>
						<td>댓<font color="#fff">공</font>글 : <?php echo $member_comment?></td>
						<td>포인트 : <?=$member_point?></td>
					</tr>
				</table>
			</p>
		</div>		
		<style>
			.logintable {
				padding-top:15px !important;
			}
			.maincomment {
				float:left;
				padding: 0 5px;
			}
			
			.maincomment h6 {
				margin:5px 0;
				border-bottom:1px solid #e3e3e3;
			}
			.logincom {
				border-bottom:3px solid #c65b51;
			}
			.maincomment tr {
				border-bottom:1px solid #e3e3e3;
			}
		</style>	

		<div class="maincomment">
			<h6><span class="logincom">최근 댓글(MavHub)</span></h6>
			<table>
			<?php
				if($latest_comment_result){
					while($latest_comment_row = mysqli_fetch_array($latest_comment_result)){
			?>
					<tr>
						<td class="span4">
							<a href="http://mismaven.kr/?kboard_content_redirect=<?php echo $latest_comment_row['content_uid'] ?>">
								<?php echo substr($latest_comment_row['content'], 0, 40); ?>..
							</a>
						</td>
						<td class="span2">
						by <?php echo $latest_comment_row['user_display']; ?>
						</td>
					</tr>
			<?php
					}
				}
			?>
			</table>
		</div>
	</div>

	<?php } ?>

</div>

<?php
		echo $after_widget;
	}

	function form( $instance ) {
	?>
		<p>
			<?php _e('No option available for this widget.', 'tabbed-login'); ?>
			<br/><strong><?php _e('Note : Do not put the same widget twice in a page.', 'tabbed-login'); ?></strong>
		</p>

	<?php
	}
}
?>