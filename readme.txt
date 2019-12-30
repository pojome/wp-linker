=== Linker ===
Contributors: pojo.me, KingYes, ariel.k
Tags: automation, 301, Google Analytics by Yoast, affiliates, click tracking, custom post types, external-links, google analytics, link manager, links, outbound links, pretty links, redirect, affiliate, affiliates, click, clicks, link, links, marketing, redirect, rewrite, seo, shortlink, shorturl, shrink, shrinking, slug, stat, statistics, stats, tiny, tinyurl, track, tracking, tweet, twitter, url
Requires at least: 3.5
Tested up to: 5.3
Stable tag: 1.2.1
License: GPLv2 or later

Track Outbound Link Clicks Easily: Shorten & track your site links by using your own domain name. e.g. "your-domain.com/go/link"

== Description ==

Through Linker's short url tool you can know on which links your visitors are clicking. Linker is the easiest tool to use in order to create a short link in your own domain & track outbound link clicks from your website, using software like Google Analytics.
Create short links to your post, manage your 301 redirects, track affiliate links and do many other URL related tasks easily.

<h4>Major Features</h4>
* Create Short and clean URLs, using your own domain.
* Redirect links to any location, both inbound and outbound, using 301 redirects.
* Track outbound link clicks, with internal reporting for Hits per link.
* Enjoy an intuitive and User Friendly Admin Interface
* Setup tracking easily using Linker's out of the box functionality.

<h4>How it Works?</h4>
Linker adds a new custom post type to your Admin menu, where you can create, edit, delete, and manage Links by 301 redirects. What's great about Linker is that it tracks click counts and saves them as a custom field. it's really simple & cool and there is no setup involved. It works seamlessly straight out of the box for whichever theme and plugins you are using.

<strong>Link Example</strong>: Just to make it extra clear, here's how the Linker plugin works.

* Original URL: https://wordpress.org/plugins/linker/
* New URL with Linker: https://pojo.me/go/linker/

<h4>Integration with Google Analytics by Yoast</h4>
Linker works well with [Google Analytics for WordPress](http://wordpress.org/plugins/google-analytics-for-wordpress/) by Yoast.

In order to setup tracking for Google Analytics by Yoast, you need to first go to the Setting page.

1. General Tab > "Track outbound click and downloads" Checkbox > check it
1. Advanced Tab > "Set path for internal links to track as outbound links" Field > enter `/go/`
1. Advanced Tab > "Label for those links" Field > Choose which Label to use (Not required).

Now all of your website outbound clicks will show up automatically in Google Analytics. To view them, go to your account in Google Analytics.
<br />
Under: Content > Event Tracking > Categories, you’ll see the Label that you used for each link. That's all there is to it!

<h4>Translators:</h4>
* Hebrew (he_IL) + RTL Support - [Pojo.me](http://pojo.me/)
* Brazilian Portuguese (pt_BR) - Rhenan Cardozo
* Indonesian (id_ID) - YiiBooster

<h4>Contributions:</h4>
Would you like to like to contribute to Linker? You are more than welcome to submit your pull requests on the [GitHub repo](https://github.com/KingYes/wp-linker). Also, if you have any notes about the code, please open a ticket on the issue tracker.

== Installation ==

1. Upload plugin files to your plugins folder or install using WordPress built-in Add New Plugin installer
1. Activate the plugin
1. Navigate to Settings > Permalinks and save them. Yes, just click Save Changes.
1. Go to the Linker Menu under the Pages
1. Create a new Link and publish
1. Now you can track how many times clicked on each link

== Screenshots ==

1. All Links
2. New Link

== Frequently Asked Questions ==

= Can I change the Link structure other than /go/ ? =
* Sure. Just use with `linker_prefix_slug` filter.

= Requirements =
* __Requires PHP5__ for list management functionality.

= What is the plugin license? =
* This plugin is released under a GPL license.


== Changelog ==

= 1.2.0 =
* New! - Added filter to manage the cpt slug for linker

= 1.1.3 =
* Tweak! - Exclude links from search 

= 1.1.2 =
* Tested up to WordPress v4.4.2 

= 1.1.1 =
* Added translate: Indonesian (id_ID) Thanks to YiiBooster ([#20](https://github.com/KingYes/wp-linker/pull/20))

= 1.1.0 =
* Added filter by Author ([#16](https://github.com/KingYes/wp-linker/pull/16))
* Added readonly field for Copy-Paste linker
* Updated Dashboard Output
* Dashboard info and CSS external file
* Tested up to WordPress v4.3

= 1.0.7 =
* Tweak! - Exclude links from search

= 1.0.6 =
* Added Dashboard Widget and Orderby clicks ([#13](https://github.com/KingYes/wp-linker/pull/13)).

= 1.0.5 =
* Added translate: Brazilian Portuguese (pt_BR) Thanks to Rhenan Cardozo
* Tested up to WordPress v4.2.2

= 1.0.4 =
* The plugin flush the permalinks automation.
* Tested up to WordPress v4.2

= 1.0.3 =
* Tested up to WordPress v4.1

= 1.0.2 =
* Tested up to WordPress v4.0

= 1.0.1 =
* Added translate: Hebrew (he_IL) - Thanks to [Pojo.me](http://pojo.me/)

= 1.0.0 =
* Blastoff!
