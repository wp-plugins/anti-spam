/* Anti-spam plugin. No spam in comments. No captcha. wordpress.org/extend/plugins/anti-spam/  */

jQuery(function($){
    $('.comment-form-anti-spam, .comment-form-anti-spam-2').hide(); // hide inputs from users
    var answer = $('.comment-form-anti-spam input#anti-spam-0').val(); // get answer
    $('.comment-form-anti-spam input#anti-spam').val( answer ); // set answer into other input
});