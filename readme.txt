=== Linker ===
Contributors: KingYes, ariel.k
Tags: click tracking, custom post types, redirect, 301, outbound links, pretty links, link manager, links, google analytics, affiliates, external links,
Requires at least: 3.5
Tested up to: 3.9
Stable tag: 1.0.0
License: GPLv2 or later

Manage, create and track outbound links by custom pretty links with your domain. e.g. your-domain.com/go/fb-link

== Description ==

Linker is a simple & easy plugin to manage, create and track outbound links from your website. Linker adds a new custom post type to your Admin menu, where you can create, edit, delete, and manage Links by 301 redirects.

Linker is tracking click counts and save them of a custom field on that custom post type, it really simple & cool. 

<h4>Integration with Google Analytics</h4>
You can track with Google Analytics to get full statistics by Event Tracking.

 This plagin work well too with [Google Analytics for WordPress](http://wordpress.org/plugins/google-analytics-for-wordpress/) by Yoast. 

Go to the Setting Page of Google Analytics under the Setting Menu, and go to > Internal Links to Track as Outbound  > enter "/go/" in the field > choose Label to use.

Now you can show up in Analytics all clicks out. go to Content > Event Tracking > Categories, and you’ll see your Label that used. that's all.

<h4>Thanks</h4>
We took inspiration to our plugin from [Simple URL](http://wordpress.org/plugins/simple-urls/) plugin - so thank you so much, you done good job.

<strong>Contributions:</strong><br />

Would you like to like to contribute to Linker? You are more than welcome to submit your pull requests on the [GitHub repo](https://github.com/KingYes/wp-linker). Also, if you have any notes about the code, please open a ticket on ths issue tracker.


== Installation ==

1. Upload plugin files to your plugins folder or install using WordPress built-in Add New Plugin installer
1. Activate the plugin
1. Navigate to Settings > Permalinks and save them. Yes, just click Save Changes.
1. Go to the Linker Menu under the Pages
1. Create a new Link and publish
1. Now you can track how many times clicked on each link

== Screenshots ==

== Frequently Asked Questions ==

= Requirements =
* __Requires PHP5__ for list management functionality.

= Can I change the Link structure other than /go/ ? =
* Sure. Just use with `linker_prefix_slug` filter.

= What is the plugin license? =
* This plugin is released under a GPL license.


== Changelog ==

= 1.0.0 =
* Blastoff!
