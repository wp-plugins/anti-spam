=== Anti-spam ===
Contributors: webvitaly
Donate link: http://web-profile.com.ua/donate/
Tags: spam, spammer, spammers, comment, comments, antispam, anti-spam, block-spam, spamfree, spam-free, spambot, spam-bot, bot
Requires at least: 3.0
Tested up to: 3.5.1
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

No spam in comments. No captcha.

== Description ==

[Anti-spam](http://web-profile.com.ua/wordpress/plugins/anti-spam/ "Plugin page") |
[Donate](http://web-profile.com.ua/donate/ "Support the development")

Anti-spam plugin blocks spam in comments automatically, invisibly for users and for admins.

* **no captcha**, because spam is not users' problem
* **no moderation queues**, because spam is not administrators' problem
* **no options**, because it is great to forget about spam completely

Plugin is easy to use: just install it and it just works.
Need [more info about the plugin](http://wordpress.org/extend/plugins/anti-spam/faq/)?

= Useful plugins: =
* ["Page-list" - show list of pages with shortcodes](http://wordpress.org/extend/plugins/page-list/ "list of pages with shortcodes")
* ["Iframe" - embed iframe with shortcode](http://wordpress.org/extend/plugins/iframe/ "embed iframe")
* ["Filenames to latin" - sanitize filenames to latin during upload](http://wordpress.org/extend/plugins/filenames-to-latin/ "sanitize filenames to latin")

== Installation ==

1. install and activate the plugin on the Plugins page
2. enjoy life without spam in comments

== Frequently Asked Questions ==

= How does Anti-spam plugin work? =

Two extra hidden fields are added to comments form. First field is the question about the current year. Second field should be empty.
If the user visits site, than first field is answered automatically with javascript, second field left blank and both fields are hidden by javascript and css and invisible for the user.
If the spammer tries to submit comment form, he will make a mistake with answer on first field or tries to submit an empty field and spam comment will be automatically rejected.

= How to test what spam comments are rejected? =

You may enable sending all rejected spam comments to admin email.
You should edit "anti-spam.php" file and find "$antispam_unqprfx_send_spam_comment_to_admin" and make it "true".

= What is the percentage of spam blocked? =

Anti-spam plugin blocks about 99.9% of automatic spam messages (sent by spam-bots via post requests). 
But Anti-spam plugin will pass the messages which were submitted by spammers manually via browser. But such messages happens very rarely.

= Not enough information about the plugin? =

You may check out the [source code of the plugin](http://plugins.trac.wordpress.org/browser/anti-spam/trunk/anti-spam.php).
The plugin has about 100 lines of code and pretty easy to read. I was trying my best to make plugin's code clean.
Plugin is small but it makes all the dirty work against spam pretty good. You may give it a try.

== Changelog ==

= 1.2 - 2012-10-28 =
* minor changes

= 1.1 - 2012-10-14 =
* sending answer from server to client into hidden field (because client year and server year could mismatch)

= 1.0 - 2012-09-06 =
* initial release
