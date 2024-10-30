=== Linker - URL shortener & track outbound link clicks ===
Contributors: pojo.me, KingYes, ariel.k
Tags: 301, click tracking, redirect, shortlinks, link shortener,
Requires at least: 6.0
Requires PHP: 7.0
Tested up to: 6.7
Stable tag: 1.3.0
License: GPLv2 or later

Track Outbound Link Clicks Easily: Shorten & track your site links by using your own domain name. e.g. "your-domain.com/go/link"

== Description ==

<strong>Manage, create and track outbound links by custom pretty links with your domain.</strong>

Through Linker's short url tool you can know on which links your visitors are clicking. Linker is the easiest tool to use in order to create a short link in your own domain & track outbound link clicks from your website, using software like Google Analytics.
Create short links to your post, manage your 301 redirects, track affiliate links and do many other URL related tasks easily.

<h3>Major Features</h3>
* Create Short and clean URLs, using your own domain
* Redirect links to any location, both inbound and outbound, using 301 redirects
* Track outbound link clicks, with internal reporting for Hits per link
* Enjoy an intuitive and User Friendly Admin Interface
* Setup tracking easily using Linker's out of the box functionality
* Set URL Parameters forwarding for improved tracking on every redirection

<h3>How it Works?</h3>
Linker adds a new custom post type to your Admin menu, where you can create, edit, delete, and manage Links by 301 redirects. What's great about Linker is that it tracks click counts and saves them as a custom field. it's really simple & cool and there is no setup involved. It works seamlessly straight out of the box for whichever theme and plugins you are using.

<strong>Link Example</strong>: Just to make it extra clear, here's how the Linker plugin works.

* Original URL: https://wordpress.org/plugins/linker/
* New URL with Linker: https://pojo.me/go/linker/

<h3>Contributions:</h3>
Would you like to contribute to this plugin? You’re more than welcome to submit your pull requests on the [GitHub repo](https://github.com/pojome/wp-linker). And, if you have any notes about the code, please open a ticket on the issue tracker.

== Installation ==

1. Upload plugin files to your plugins folder, or install using WordPress' built-in Add New Plugin installer
1. Activate the plugin
1. Navigate to Settings > Permalinks and save them. Yes, just click Save Changes
1. Go to the Linker menu under the pages
1. Create a new link and publish
1. Now you can track how many times clicked on each link

== Screenshots ==

1. All Links
2. New Link

== Frequently Asked Questions ==

= Can I change the Link structure other than /go/ ? =
* Sure. Just use with `linker_prefix_slug` filter.

= Requirements =
* __Requires PHP 7.0__ for list management functionality.

= What is the plugin license? =

* This plugin is released under a GPL license.


== Changelog ==

= 1.3.0 =
* New: Introducing URL Parameters forwarding for improved tracking on every redirection

= 1.2.2 =
* Security Fix: Add escaping data in the admin area

= 1.2.1 =
* Tweak! - Adjust format number
* Tweak! - Added support for other CPT view

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
