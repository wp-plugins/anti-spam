=== Anti-spam ===
Contributors: webvitaly
Donate link: http://web-profile.com.ua/donate/
Tags: spam, spammer, spammers, comment, comments, antispam, anti-spam, antibot, anti-bot, blockspam, block-spam, spamfree, spam-free, spambot, spam-bot, bot
Requires at least: 3.0
Tested up to: 3.5
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

No spam in comments. No captcha.

== Description ==

Plugin will block spam in comments. Users hate spam in comments and also they hate captcha.
So Anti-spam plugin will block spam automatically without moderation and silently for site visitors.

**[Anti-spam support page](http://web-profile.com.ua/wordpress/plugins/anti-spam/ "Need help with the plugin?")**

= Useful plugins: =
* ["Page-list" - show list of pages with shortcodes](http://wordpress.org/extend/plugins/page-list/ "list of pages with shortcodes")
* ["Iframe" - embed iframe with shortcode](http://wordpress.org/extend/plugins/iframe/ "embed iframe")
* ["Filenames to latin" - sanitize filenames to latin during upload](http://wordpress.org/extend/plugins/filenames-to-latin/ "sanitize filenames to latin")

== Installation ==

1. install and activate the plugin on the Plugins page
2. enjoy life without spam in comments

== Frequently Asked Questions ==

= How does it work? =

Two extra fields are added to comments form. First is the question about the current year. Second should be empty.
If the user visits site, than first field is answered automatically with javascript, second field left blank and both fields are hidden and invisible for the user.
If the spammer tries to submit comment form, he will make a mistake with answer on first field or tries to submit an empty field and spam comment will be rejected.

= How to test what spam comments are rejected? =

You may enable sending all rejected spam comments to admin email.
You should edit "anti-spam.php" file and find "$antispam_unqprfx_send_spam_comment_to_admin" and make it "true".

== Changelog ==

= 1.2 - 2012-10-28 =
* minor changes

= 1.1 - 2012-10-14 =
* sending answer from server to client into hidden field (because client year and server year could mismatch)

= 1.0 =
* initial release
