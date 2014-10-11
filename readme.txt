=== Embed RSS ===
Contributors: pathawks,dirtysuds
Donate link: https://github.com/pathawks/embed-rss
Tags: plugins, wordpress, embed, eombed, rss
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 3.5
Tested up to: 4.0
Stable tag: 1.02

Adds pseudo oembed support for RSS feeds

== Description ==

Will add a list of links to items in a given feed.
Simply include the URL for an RSS feed on it's own line, or wrapped in the embed tag like `[embed]http://example.com/feed.rss[/embed]` and the plugin will embed the feed the page with links to each item.
The url must end with `.rss`

== Installation ==

1. Upload `dirtysuds-embed-rss` to the `/wp-content/plugins/` directory
2. Activate **DirtySuds - Embed RSS** through the 'Plugins' menu in WordPress
3. That's it. Now when you embed an RSS feed using the Wordpress `[embed]` shortcode, the plugin will embed the feed


== Frequently Asked Questions ==

= I have an idea for a great way to improve this plugin =

Please open a pull request on [Github](https://github.com/pathawks/embed-rss)


== Changelog ==

= 1.02 =
* Bugfix

= 1.01 =
* Make use of transients

= 0.98 =
* First version
