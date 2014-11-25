/*
Anti-spam plugin
No spam in comments. No captcha.
wordpress.org/plugins/anti-spam/
*/

(function($) {

	function anti_spam_init() {
		$('.comment-form-antspm, .comment-form-antspm-2').hide(); // hide inputs from users
		var answer = $('.comment-form-antspm input.antspm-a').val(); // get answer
		$('.comment-form-antspm input.antspm-q').val(answer); // set answer into other input instead of user
		$('.comment-form-antspm-2 input.antspm-e-email-url').val(''); // clear value of the empty input because some themes are adding some value for all inputs

		var current_date = new Date();
		var current_year = current_date.getFullYear();

		if ( $('#comments form input.antspm-q').length == 0 ) { // anti-spam input does not exist (could be because of cache or because theme does not use 'comment_form' action)
			$('#comments form').append('<input type="hidden" name="antspm-q" class="antspm-q" value="'+current_year+'" />'); // add whole input with answer via js to comment form
		}

		if ( $('#respond form input.antspm-q').length == 0 ) { // similar, just in case (used because user could bot have #comments)
			$('#respond form').append('<input type="hidden" name="antspm-q" class="antspm-q" value="'+current_year+'" />'); // add whole input with answer via js to comment form
		}

		if ( $('form#commentform input.antspm-q').length == 0 ) { // similar, just in case (used because user could bot have #respond)
			$('form#commentform').append('<input type="hidden" name="antspm-q" class="antspm-q" value="'+current_year+'" />'); // add whole input with answer via js to comment form
		}
	}

	$(document).ready(function() {
		anti_spam_init();
	});

	$(document).ajaxSuccess(function() { // add support for comments forms loaded via ajax
		anti_spam_init();
	});

})(jQuery);