=== Hupso Share Buttons for Twitter, Facebook & Google+ ===
Contributors: kasal
Donate link: http://www.hupso.com/
Tags: twitter, facebook, google, social sharing, share buttons, social share buttons, share icons, stumbleupon, addthis, sharethis, sexybookmarks, addtoany, multisite, pinterest, print, tumblr, bebo, social media, social buttons, social share, email, print button, social plugin, social widget, email button, post, plus 1, vkontakte, vk.com, reddit, delicous, del.icio.us, linkedin, tumblr, pinterest, stumbleupon, digg, stumble upon, pinterest button, +1, google +1, tweet, like, share, sharing, shortcode
Requires at least: 2.8
Tested up to: 4.2.2
Stable tag: 4.0.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Help share your posts on popular social networks: Twitter, Facebook, Google+, Linkedin, Pinterest, StumbleUpon, Tumblr, Reddit, Bebo and others.

== Description ==

Add simple social share buttons to your articles. Your visitors will be able to easily share your content on the most popular social networks: Twitter, Facebook, Google Plus, Linkedin, Tumblr, Pinterest, StumbleUpon, Digg, Reddit, Bebo, Delicous, VKontakte and Email. 

These services are used by millions of people every day, so sharing your content there will increase traffic to your website.

**Main features / advantages**

* Slick, minimalistic design.
* Very small and fast. The code for sharing button is very small (only a few KB), so share buttons will not slow down your website - even on devices with slow network connections.
* All major social networks are supported: Twitter, Facebook (Facebook Share / Facebook Like / Facebook Send), Google Plus, Linkedin, Tumblr, Pinterest, StumbleUpon, Digg, Reddit, Bebo, Delicious, VKontakte, Odnoklassniki, Sina Weibo, QZone, Renren.
* Social media counters: Twitter Tweet, Facebook Like, Google +1, Linkedin Share, Pinterest - Pin it 
* Compatible with all major web browsers: Firefox, Chrome, Internet Explorer, Safari, Opera.
* Share toolbar works with desktop and mobile devices (mobile phones and tablets). Tested with PC, Apple iOS / iPhone / iPad and Google Android devices.
* Real-time button preview in admin settings. You will be able to see the preview of share buttons as you configure them.
* Support for right-to-left (RTL) scripts / languages (Arabic, Persian, Urdu, Hebrew, Yiddish, Syriac, Thaana/Dhivehi, N'Ko, Chinese, Japanese).
* Hide or show buttons for specific posts / pages (see Shortcodes below)
* Hide or show buttons for posts / pages / front page / categories
* Option to add "via @yourprofile" to tweets (Twitter)
* Localized counters: Tweet, Facebook Like, Facebook Share, Google +1 buttons can use translated versions (support for 73 languages)
* Hide share buttons for specific categories
* Hide "Share" image or use translated image (20+ languages available)
* Sidebar widget
* Use of shortcodes inside template files
* Display staring stats for whole website or for each page individually
* Select image to use for Facebook sharing (Facebook thumbnail)
* You can use your own custom social icons for Twitter, Facebook and other social networks
* Load social icons from your own content delivery network (CDN)
* Set background and border color for share button (menu)
* Support for SSL (https)
* Email button
* Print button
* All share buttons are optional: You can add or remove any button from plugin settings
* Multisite support (works with Wordpress Multi-site)
* Support for custom post types (it is possible to show or hide share buttons for each custom post type)

Share Buttons are *very easy to configure*. Just select button type, size, position and which social networking services do you want to offer to your visitors.
Buttons will appear below your articles or on top of them (or both) as you choose.

**Shortcodes**

* Use `[hupso_hide]` anywhere in post's text to hide buttons for specific post. 
* Use `[hupso]` anywhere in post's text to show buttons at custom position inside the post. Buttons will be shown exactly where this shortcode appears.
* Shortcodes inside template files: Add this PHP code inside template files at position where you want to show share buttons: `echo do_shortcode('[hupso]');`
You can configure share buttons in plugin settings.
* Shortcodes inside widget text: Just include `[hupso]` anywhere in widget text area and share buttons will be displayed there.
* You can use custom titles and urls inside shortcodes. Exampe: `[hupso title="My title" url="http://www.hupso.com/share/"]`. You can use only title or only url if you like: `[hupso title="My title"]`, `[hupso url="http://www.hupso.com/share/"]`.

**Translations**

Plugin is currently translated into: French, Czech, Polish, Arabic, Traditional Chinese, Simplified Chinese and Dutch (Nederlands / Belgium).
If you would like to translate into your language, send message [here](http://www.hupso.com/share/feedback/).


[Share Buttons Demo](http://www.hupso.com/share/) | [FAQ](http://wordpress.org/extend/plugins/hupso-share-buttons-for-twitter-facebook-google/faq/) | [Feedback](http://www.hupso.com/share/feedback/)


== Installation ==

1. Download plugin file (.zip)
2. Extract zip file and upload folder /hupso-share-buttons-for-twitter-facebook-google/ to /wp-content/plugins/
3. Go to "Plugins" and activate the plugin "Hupso Share Buttons for Twitter, Facebook & Google+"


== Frequently Asked Questions ==

= How do I change settings? =

From the Wordpress Administration click on "Settings" and then click on "Hupso Share Buttons".

= Are share buttons free? =

Yes. Thay are free and will always be free. And you do not need to open any account to use them.

= Are share buttons using Javascript? =

Yes. Javascript is required for sharing buttons to function properly and it must be enabled. Counters load javascript code from Twitter, Facebook, Google, Linkedin, Pinterest or from other social services that are selected. Interface for share buttons is loaded from our servers via javascript at run-time. This enables us to add minor enhancements and fix browser bugs the moment they are discovered without forcing you to upgrade the plugin all the time. Some button images are loaded from your local Wordpress installation and some from our servers. Clicks on share icons can be redirected to target social network throught our servers. One of the benefits of such setup is that share buttons keep working properly, even when there are API changes at social networking sites. This can be a major advantage for websites that do not plan to update plugins regularly.

= How can I hide/show share buttons for specific posts? =

You can hide share buttons for specific post using shortcode `[hupso_hide]`. Add `[hupso_hide]` anywhere in your post's text and buttons will be hidden.
You can show share buttons for specific post at custom position using shortcode `[hupso]`. Add `[hupso]` in your post's text where you want the buttons to appear.

= Which social networks are supported? =

All major social networks are supported: Twitter, Facebook, Google+, Linkedin, StumbleUpon, Digg, Reddit, Bebo and Delicious.

= Can I show share buttons in sidebar? =

Yes. There is a sidebar widget included with the plugin. Go to WP Administration then click on "Widgets" under "Appearance" menu.
Then drag Hupso Share Buttons Widget from left and drop it on the sidebar on the right.

= How can I style Hupso share buttons with CSS? =

Use class "hupso-share-buttons" like this:
`.hupso-share-buttons { 
	/* add style here */
}`

= How can I style "Share image" with CSS? =

Add CSS to your style.css file.

For share buttons:  
`.hupso_pop > img { 
	/* add style rules here */
}`

For share toolbar:   
`.hupso_toolbar > img { 
	/* add style rules here */
}`

For counters:  
`.hupso_counters > img { 
	/* add style rules here */
}`

= How do I change the margin of share button, share toolbar or counters? =

Add CSS to your style.css file:
`.hupso_c > div > div {
	margin-left: 0px !important;
}`

= Facebook comment box is cut on the right. How do I fix it? =

Add this CSS to your style.css file:
`iframe { 
	max-width:none !important; 
}`

= Facebook comment box is cut at the bottom. How do I fix it? =

This usually happens when you have `overflow:hidden` in your main class for post (style.css). It might look like this:
`.post {
 overflow:hidden;
 }`
 
Find it and replace it with:
`.post {
 overflow:visible;
 }`
 
 It is possible that your theme is using a different name, so it might be .post, .article, .entry-content or something similar.


= Share counters are not aligned properly. How can I fix this? =

Add proper CSS to your style.css file. Example:
`.hupso_twitter {
	margin-left: 20px !important;
	margin-right: 25px !important;
}
.hupso_facebook {
	margin-top: -20px !important;
}
.hupso_google {
	margin-bottom: 5px !important;
}
.hupso_pinterest {
	margin-right: 10px !important;
}
.hupso_email_button {
	margin-left: 3px !important;
}
.hupso_print_button {
	margin-left: 3px !important;
}
.IN-widget { /* Linkedin */
	margin-top: 1px !important;
}
`

= How can I move share icons so they would show up in the same line as title of the post? =

Hide share image (from settings) and add this CSS to your style.css file:
`.hupso_c {
    float: right;
    margin-right: 40px;
    margin-top: -80px;
    padding-bottom: 20px;
}`

Then adjust the values so that it looks great with your theme. 

= How can I increase the space between the buttons? =

Add this CSS to your style.css file:

`.hupso_c > div > a > img {
    padding-right: 7px !important;
}`


= Facebook like button is seen through my top navigation bar while other buttons are ok. How can fix it? =

Add this CSS to your style.css file:
`.fb_edge_widget_with_comment {
    z-index: 0;
}`

= How can I use counters under posts and share toolbar in sidebar? =
You can use Hupso WP plugin for counters on top/bottom of every post and use raw HTML code for sidebar widget. Go to [Hupso Share Buttons homepage](http://www.hupso.com/share/) and generate HTML code for share buttons. In WP admin, go to Appearance->Widgets and create new text widget (drag and drop it to sidebar) and paste HTML code inside it. 

= How can I show share buttons inside template files? =

Add this PHP code inside template files at position where you want to show share buttons: `echo do_shortcode('[hupso]');` 
You can configure share buttons in plugin settings.

= How can I hide share buttons inside template files? =

Use this code: `global $HUPSO_SHOW; $HUPSO_SHOW = false;` Make sure you do this before div `id="content"`. This will hide the buttons in content. Share buttons will still show in widget (if used).

= Can I use shortcodes inside widget text? =

Yes, you can. Just include `[hupso]` anywhere in widget text area and share buttons will be displayed there.

= Can I set title and url as shortcode parameters? =

Yes. Include this shortcodes anywhere inside post's text or inside text widget: `[hupso title="My title" url="http://www.hupso.com/share/"]`. Replace title and url with your title and your url.
You can also set only one of the parameters like this: `[hupso title="My title"]` or like this `[hupso url="http://www.hupso.com/share/"]`.

= Can I replace/change/modify social icons (images) for Twitter, Facebook and other social networks? =

Yes, you can. Go to plugin settings. Change "Use custom social share icons" to "Yes, serve images from local Wordpress folder", then replace the icons inside plugin folder "img/services". You can also upload images to another web server or CDN ([read instructions](http://www.hupso.com/share/custom-social-icons.php)).

= How can I display share buttons only inside widget and not under posts? =

Add Hupso share buttons widget, then go to Hupso plugin settings and clear all fields in "Show buttons on" section.

= Why is Facebook icon missing when using counters? =

It is missing if your site is running from localhost. It will work when you move website to actual domain.

= Can I set share buttons in such a way that it counts the entire site instead of just that specific page? =

Yes, you can. Enter your website root under "Custom url" in Settings. After that counters will show sharing stats for your whole website, not for each page individually.

= Email button does not seem to work on some devices. Nothing happens when I click on it. What can I do? =

Clicking on e-mail button invokes default e-mail application on the device. If default e-mail application is not set up, it will not do anything.
On Firefox and Chrome you can use web based e-mail (such as gmail.com or outlook.com) as your default e-mail application if you like, so
clicking on the email icons will open your web based e-mail account.

[Firefox instructions](https://support.mozilla.org/en-US/kb/change-program-used-open-email-links)

[Chrome instructions](https://support.google.com/chrome/answer/1382847?hl=en#content)

= Buttons are not working properly. What can I do? =

Please upgrade the plugin to the latest version. If that does not help then try to reinstall the plugin (uninstall it and install it again).
If you still have problems then send bug report [using this feedback form](http://www.hupso.com/share/feedback/).

= Buttons are not working with one post. Only "Share" image in shown, but no social icons. They work correctly on other posts. What can I do? =

HTML of your post in not valid. You need to fix the text inside the post. Perhaps you forgot to close a p or div tag at the end. Perhaps you have some other HTML error in it. Use HTML validator if you cannot find an error.

= What settings are available? =

From Settings screen you are able to choose: button type (share button, share toolbar, counters), button size, social sharing services, menu type, button position (above or below your posts), display options.

Please look at *Screenshots* for more information.

= When will floating toolbars be available? =

[Hupso Share Buttons](http://www.hupso.com/share/) provide other button types including floating toolbars. We plan to implement those in next versions of this plugin.

= Why is featured post image not used as thumbnail with Facebook on new posts? =

You image should be at least 200px in both dimensions. This is a Facebook limitation. Please wait up to 24 hours for Facebook to fetch the new thumbnail. After that it should work.
Also check "og:image" meta tags on your site and use [Facebook Debugger](https://developers.facebook.com/tools/debug) to fix problems with Facebook images, titles and descriptions. 

= Found a bug? Have a suggestion? =

If you are using an old version of the plugin then first update to latest version. It is possible that your bug has already been fixed.
Please send bug reports and suggestion using [this feedback form](http://www.hupso.com/share/feedback/).


== Screenshots ==

1. Share Toolbar
2. Counters (Twitter Tweet, Facebook Like, Google +1, Linkedin Share) 
3. Share Toolbar (big)
4. Share Buttons with drop down menu (icons and service names)
5. Share Buttons with drop down menu (icons only)
6. Settings in Wordpress Administration (with real-time button preview)
7. Share buttons under post, sidebar widget and text widget - English version (73 languages available)
8. Share buttons under post, sidebar widget and text widget - Spanish version (73 languages available)
9. Share buttons under post, sidebar widget and text widget - Chinese version (73 languages available)
10. Pinterest dialog that opens after clicking on "Pint it" icon


== Changelog ==

= 4.0.3 =
* Added Arabic translation

= 4.0.2 =
* Added French translation

= 4.0.1 =
* Added Polish translation
* Compatible with Wordpress 4.2.2

= 4.0.0 =
* Added Russian share image
* Compatible with Wordpress 4.2.1
* Improved compatibility with theme Twenty Fifteen

= 3.9.25 =
* Shortcodes with custom urls are now working properly (example: [hupso url="http://www.yahoo.com"])

= 3.9.24 =
* Added Dutch (Nederlands / Belgium) translation

= 3.9.23 =
* Fix for using echo do_shortcode('[hupso]') inside the loop

= 3.9.22 =
* Renren button

= 3.9.21 =
* Sina Weibo button
* QZone button

= 3.9.20 =
* Odnoklassniki button

= 3.9.19 =
* Support for custom post types.  It is now possible to show or hide share buttons for each custom post type.

= 3.9.18 =
* VKontakte button
* Added Traditional Chinese translation
* Added Simplified Chinese translation
* Fixed double display of buttons in gallery

= 3.9.17 =
* Tumblr button
* Top div now uses class "hupso-share-buttons", so it is now easy to customize buttons with CSS
* Better Pinterest dialog for selecting images

= 3.9.16 =
* Included hupso.pot file for translation. If you would like to translate into your language, send message [here](http://www.hupso.com/share/feedback/). 
* Added Czech translation 

= 3.9.15 =
* Share buttons can now be enabled/disabled for each post or page individually (inside Edit Post screen). You need to enable this in plugin settings first.

= 3.9.14 =
* Color picker now supports touch devices
* Fixed some strict PHP warnings

= 3.9.13 =
* Bugfix for excerpts

= 3.9.12 =
* Option to hide share buttons in excerpts

= 3.9.11 =
* Removed option to show or hide share buttons in excerpts due to incompatibility with some themes (it will be added back in next version)

= 3.9.10 =
* Bugfix for shortcodes

= 3.9.9 =
* Option to show or hide share buttons in excerpts

= 3.9.8 =
* Email button
* Print button

= 3.9.7 =
* Bugfix: shortcodes can now be used without showing buttons under posts

= 3.9.6 =
* support for SSL (https)
* minor bug fixes

= 3.9.5 =
* option to set background and border color for share button (menu)

= 3.9.4 =
* option to use your own custom social icons
* share button is now available in 8 more colors

= 3.9.3 =
* it is now possible to set title and url as shortcode parameters, e.g.: `[hupso title="My title" url="http://www.hupso.com/share/"]`
* replaced border="0" with style="border:0px;" to help pass W3C validation

= 3.9.2 =
* option to use custom image as Share button (you can now create your own share button)
* added button to update preview in settings

= 3.9.1 =
* Facebook comment box is now always visible
* Fixed potential interference with Nextgen Gallery plugin (while working in admin)
* Added Turkish "Share" image

= 3.9 =
* Pinterest support (Pin it button)
* Option to display custom Share image from URL
* Select image to use for Facebook sharing (Facebook thumbnail)
* Share buttons can now be hidden inside template files (by setting `global $HUPSO_SHOW; $HUPSO_SHOW = false;` anywhere before div `id="content"`)

= 3.8 =
* Option to show or hide share buttons for search pages
* Option to use custom title and url for sharing (useful if you want counters to show sharing stats for your whole website, not for each page individually)

= 3.7 =
* Option to display share buttons on password protected pages
* Fixed: you can now display share buttons only in widget (just clear all fields in "Show buttons on" section)

= 3.6 =
* Sidebar widget
* Shortcodes can now be used directly from template files (see FAQ)
* Option to show share buttons above and below your posts
* Share buttons are not shown on password protected pages
* Czech "Share" image
* Bugfix: Share image is shown/hidden properly

= 3.5 =
* Option to add "via @yourprofile" to tweets (Twitter)
* Localized counters: Tweet, Facebook Like, Facebook Share, Google +1 buttons can now use translated versions (support for 73 languages)
* Chinese "Share" image
* Fix for Facebook Like in Internet Explorer 8
* Option to add CSS style to share buttons

= 3.4 =
* Option to hide "Share" image
* Option to use translated "Share" image (20 languages)

= 3.3 =
* Option to show/hide share buttons for (all) posts/pages
* Option to hide share buttons for specific categories
* Option to select which title gets used when sharing (title of post or title of current web page)

= 3.2 =
* It is now possible to hide buttons for specific post using shortcode [hupso_hide]
* It is now possible to show buttons for specific post at custom position using shortcode` [hupso]` (buttons will be displayed exactly where this shortcode appears)
* Text for social networks is now pulled from post's title
* Fixed a bug where share buttons did not load inside posts for some themes

= 3.1 =
* Bugfix for Share button not loading properly
* Settings are now deleted on plugin uninstall

= 3.0 =
* New button type: Counters (support for Facebook Like, Facebook Send, Twitter Tweet, Google +1, Linkedin Share)
* Featured post image (post thumbnail) is now used as Facebook thumbnail when sharing to Facebook
* Fix for empty excerpts

= 2.3 =
* Fixed diplay of excerpts (post summaries)

= 2.2 =
* Fixed option to display share buttons inside categories and tags

= 2.1 =
* Better support for right-to-left (RTL) scripts/languages (Arabic, Persian, Urdu, Hebrew, Yiddish, Syriac, Thaana/Dhivehi, N'Ko, Chinese, Japanese)

= 2.0 =
* New button type: share toolbar
* Real-time button preview in admin settings

= 1.3 =
* Added options to show/hide social buttons on frontpage and inside categories

= 1.2 =
* Improved default settings

= 1.1 =
* Fixed plugin path

= 1.0 =
* Initial release





