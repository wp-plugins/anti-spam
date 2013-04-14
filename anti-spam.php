<?php
/*
Plugin Name: Anti-spam
Plugin URI: http://web-profile.com.ua/wordpress/plugins/anti-spam/
Description: No spam in comments. No captcha.
Version: 1.1
Author: webvitaly
Author URI: http://web-profile.com.ua/wordpress/
License: GPLv2 or later
*/

/*
future to do list:
- block spam in trackbacks and pingbacks
- show spam counter in admin section
- include js only on singular pages with comments enabled
- add options page if it will be needed
- also check year+1 and year-1 to be equal year for users could leave comments in the end of the year
*/

$antispam_unqprfx_send_spam_comment_to_admin = false; // if true, than rejected spam comments will be sent to admin email

$antispam_unqprfx_version = '1.1';


function antispam_unqprfx_scripts_styles_init() {
	global $antispam_unqprfx_version;
	if ( !is_admin() ) { // && is_singular() && comments_open() && get_option( 'thread_comments' )
		//wp_enqueue_script('jquery');
		wp_enqueue_script( 'anti-spam-script', plugins_url( '/js/anti-spam.js', __FILE__ ), array('jquery'), $antispam_unqprfx_version );
	}
}
add_action('init', 'antispam_unqprfx_scripts_styles_init');


function antispam_unqprfx_form_part() {
	$antispam_unqprfx_form_part = '
<p class="comment-form-anti-spam" style="clear:both;">
	<label for="anti-spam">Current ye@r</label> <span class="required">*</span>
	<input type="hidden" name="anti-spam-0" id="anti-spam-0" value="'.date('Y').'" />
	<input type="text" name="anti-spam" id="anti-spam" size="30" value="" />
</p>
'; // question (hidden with js) [aria-required="true" required="required"]
	$antispam_unqprfx_form_part .= '
<p class="comment-form-anti-spam-2" style="display:none;">
	<label for="anti-spam-2">Leave this field empty</label> <span class="required">*</span>
	<input type="text" name="anti-spam-2" id="anti-spam-2" size="30" value=""/>
</p>
'; // empty field (hidden with css)
	echo $antispam_unqprfx_form_part;
}
add_action( 'comment_form', 'antispam_unqprfx_form_part' ); // add anti-spam input to the comment form


function antispam_unqprfx_check_comment( $commentdata ) {
	global $antispam_unqprfx_send_spam_comment_to_admin;
	extract( $commentdata );
	$antispam_unqprfx_pre_error_message = '<strong><a href="javascript:window.history.back()">Go back</a></strong> and try again.';
	$antispam_unqprfx_error_message = '';
	if( !is_user_logged_in() && $comment_type != 'pingback' && $comment_type != 'trackback' /* && !current_user_can( 'publish_posts' ) */ ) { // logged in user is not a spammer
		$error_flag = false;

		if ( trim( $_POST['anti-spam'] ) != date('Y') ) { // answer is wrong - maybe spam
			$error_flag = true;
			if ( empty( $_POST['anti-spam'] ) ) { // empty answer - maybe spam
				$antispam_unqprfx_error_message .= '<br> Error: empty answer. ';
			}else{
				$antispam_unqprfx_error_message .= '<br> Error: answer is wrong. ';
			}
		}
		if ( !empty( $_POST['anti-spam-2'] ) ) { // field is not empty - maybe spam
			$error_flag = true;
			$antispam_unqprfx_error_message .= '<br> Error: field should be empty. ';
		}
		if( $error_flag ){ // if we have an error
			if ( $antispam_unqprfx_send_spam_comment_to_admin ) { // if sending email to admin is enabled
				$post = get_post($comment->comment_post_ID);

				$antispam_unqprfx_admin_email = get_option('admin_email');  // admin email
				$antispam_unqprfx_subject = 'Spam comment on site "'.get_bloginfo('name').'" '; // email subject
				$antispam_unqprfx_message  = 'Spam comment on "'.$post->post_title.'"' . "\r\n";
				$antispam_unqprfx_message .= get_permalink($comment->comment_post_ID) . "\r\n\r\n";

				$antispam_unqprfx_message .= 'IP : ' . $_SERVER['REMOTE_ADDR'] . "\r\n";
				$antispam_unqprfx_message .= 'User agent : ' . $_SERVER['HTTP_USER_AGENT'] . "\r\n";
				$antispam_unqprfx_message .= 'Referer : ' . $_SERVER['HTTP_REFERER'] . "\r\n\r\n";

				$antispam_unqprfx_message .= 'Errors: ' . $antispam_unqprfx_error_message . "\r\n\r\n";

				$antispam_unqprfx_message .= 'Post vars:'."\r\n"; // lets see what post vars spammers try to submit
				foreach ($_POST as $key => $value) {
					$antispam_unqprfx_message .= '$_POST['.$key. '] = '.$value."\r\n"; // .chr(13).chr(10)
				}
				$antispam_unqprfx_message .= "\r\n\r\n";

				$antispam_unqprfx_message .= 'Cookie vars:'."\r\n"; // lets see what cookie vars spammers try to submit
				foreach ($_COOKIE as $key => $value) {
					$antispam_unqprfx_message .= '$_COOKIE['.$key. '] = '.$value."\r\n"; // .chr(13).chr(10)
				}
				$antispam_unqprfx_message .= "\r\n\r\n";

				$antispam_unqprfx_message .= '-----------------------------'."\r\n";
				$antispam_unqprfx_message .= 'This is spam comment rejected by Anti-spam plugin. wordpress.org/extend/plugins/anti-spam/' . "\r\n";
				$antispam_unqprfx_message .= 'You may edit "anti-spam.php" file and disable this notification.' . "\r\n";
				$antispam_unqprfx_message .= 'You should find "$antispam_unqprfx_send_spam_comment_to_admin" and make it equal to "false".' . "\r\n";

				@wp_mail( $antispam_unqprfx_admin_email, $antispam_unqprfx_subject, $antispam_unqprfx_message ); // send comment to admin email
			}
			wp_die( $antispam_unqprfx_pre_error_message . $antispam_unqprfx_error_message ); // die and show errors
		}
	}
	return $commentdata;
}

if( ! is_admin() ) {
	add_filter( 'preprocess_comment', 'antispam_unqprfx_check_comment', 1 );
}
