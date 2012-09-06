jQuery(function($){
    $('.comment-form-anti-spam, .comment-form-anti-spam-2').hide(); // hide inputs from users
    var date = new Date();
    var year = date.getFullYear(); // get current year
    $('.comment-form-anti-spam input').val(year); // automatically fill answer with javascript
});