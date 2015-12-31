=== Post Meta Searcher ===
Contributors: hello@lukerollans.me
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=hello%40lukerollans%2eme&lc=GB&item_name=Plugin%20Development%20Donation&currency_code=USD
Tags: search,meta search,advanced search,custom search,custom field search
Requires at least: 2.5
Tested up to: 3.7.1
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

When activated, forces any WordPress Search Query to query against post meta data as part of the search criteria.

== Description ==

When activated, forces any WordPress Search Query to query against post meta data as part of the search criteria. This also enables you to search against custom fields without the need of specifying any meta keys.

For example, if you have a custom field named "Colour" or something similar on your posts, running a search for "Blue" will return any posts with "Colour" set to "Blue". This is just one example. The plugin will work with any field.

== Installation ==

1. Upload the `post-meta-searcher` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently asked questions ==

= How do I use the plugin? =

All you need to do is activate the plugin. Once activated, any WordPress Search Query that is made will also query against post meta as part of the search criteria.

= How does the plugin work? =

Whenever a WordPress Search Query is run, the plugin will tell WordPress to search against any custom fields you may be using in your posts on top of the default search behavior using the keywords specified in the search.

= Can I deactivate the plugin for specific search queries? =

At this moment, no. This will be a feature implemented in 1.1

== Screenshots ==

1. Plugin does not have any screenshot references. Simply activate and it will work in the background!

== Changelog ==

= 1.2 =
* Fixed bug causing non default prefixed posts table to be queried incorrectly

= 1.1 =
* Small security update

= 1.0 =
* Initial release of plugin

== Upgrade notice ==

No upgrade notice necessary