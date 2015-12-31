=== WP Login reCAPTCHA ===
Contributors: Xrvel
Donate link: http://www.xrvel.com/
Tags: login, captcha, recaptcha, admin, security
Requires at least: 2.9
Tested up to: 4.1.2
Stable tag: 2.0.3

Add reCAPTCHA to your WordPress login form

== Description ==

This plugin simply adds reCAPTCHA to your login form. By adding reCAPTCHA to your login form, you can prevent bot / script from trying to login to your WordPress website.

This plugin only works on default Wordpress login page such as http://www.example.com/wp-login.php

Requirement :

* You must have reCAPTCHA account. It is free. You can login on https://www.google.com/recaptcha

== Installation ==

The installation process.

1. Upload  to the `/wp-content/plugins/` directory. Or directly upload from your Plugin management page.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. On your WP Admin, navigate under "Settings" menu, there is "WP Login reCAPTCHA" sub menu.
4. Open that "WP Login reCAPTCHA" sub menu.
5. Fill both public and private reCAPTCHA keys there (REQUIRED).

== Frequently Asked Questions ==

= Why should i use reCAPTCHA and not (put_other_captcha_here) ? =

https://www.google.com/recaptcha/intro/index.html

= What if somehow i entered wrong reCAPTCHA setting (for example wrong Public Key, etc), i can not login to my Wordpress site =

Open your wp-login-recaptcha.php file. You can find it under your `/wp-content/plugins/wp-login-recaptcha` directory.
Change this line

`define('XRVEL_LOGIN_RECAPTCHA_ENABLED', true);`

And modify it into

`define('XRVEL_LOGIN_RECAPTCHA_ENABLED', false);`

Refresh your login form, and reCAPTCHA will dissapear on your login form.
You can login now and fix your reCAPTCHA setting from admin page.

== Changelog ==

= 2.0.4 =
* Add additional code to prevent this plugin to be activated if site / secret key is still empty.

= 2.0.3 =
* Add language option in WP Login reCAPTCHA setting page.

= 2.0.2 =
* Fits reCAPTCHA perfectly on login box (style fix).

= 2.0.1 =
* Add Setting link on Wordpress plugin list menu.

= 2.0.0 =
* WP reCAPTCHA plugin is no longer required to be installed. This plugin can work alone now.

= 1.0.0 =
* Update for latest WP ReCAPTCHA plugin update. There is a small interface bug on WP-admin menu, which is the menu link of WP reCAPTCHA will be displayed twice. However everything is working normally on the user side.

= 0.1.4 =
* Bug fix for latest WP ReCAPTCHA plugin update.

= 0.1.3 =
* Add option to change reCAPTCHA color (theme).

= 0.1.2 =
* Change `XRVEL_LOGIN_RECAPTCHA_DISABLED` to `XRVEL_LOGIN_RECAPTCHA_ENABLED`
* Readme update.

= 0.1.1 =
* Small fix.

= 0.1 =
* First release.

== Upgrade Notice ==
* Not available yet.

== Screenshots ==
* Not available.