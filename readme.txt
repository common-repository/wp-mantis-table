=== WP Mantis Table ===
Contributors: rtprime
Donate link: http://spacdinvadr.com/wp-mantis-tables
Tags: mantis, bug tracker, issues
Requires at least: 2.8
Tested up to: 2.8
Stable tag: 0.1

This plugin for Wordpress 2.8 and above allows you to insert a simple table listing of issues from a Mantis Bug Tracker
into a wordpress page or post.

== Description ==
This plugin for Wordpress 2.8 and above allows you to insert a simple table listing of issues from a Mantis Bug Tracker
into a wordpress page or post.  The plugin is perfect for projects which utilize WordPress for their news/content
management, but also utilize Mantis for their bug tracking/issue tracking

Usage currently is simple:

* Set the URL to the Mantis API (usually `http://example.com/mantisbt/api/soap/mantisconnect.php?wsdl`)
* Set your base URL for links back to your tracker (e.g. `http://example.com/mantisbt`)
* Set up a user in Mantis for wordpress connectivity - provide WP Mantis Tables with the username/password
* Provide the project ID # for the project you want to view
* Place `[MantisTable]` in the page/post where you want the table to appear.

Optionally you can set the table background color for statuses, and change the names applied to each status level.

Plans are under way to extend this functionality into a full Mantis plugin - to allow for many features including - 
(All coming in the future... eventually):

* Limiting the number of issues posted / paging through issues
* View an issue details and notes through WordPress popup
* Allow anonymous issue reports through a WordPress form
* Ability to filter results by version, status, category, etc. within the `[MantisTable]` tag.
* Change logs / roadmaps
* Consolidated Wordpress/Mantis plugins

To report issues with this plugin, or make a feature request, visit [the WP Mantis Table issue tracker](http://issues.rtprime.net).

== Installation ==

Installation is extremely easy:

1. Download the .zip file and unarchive into your `/wp-content/plugins` directory.
2. Activate the plugin.
3. Visit the WP Mantis Tables page under Settings to set the locations to your issue log, mantis user info, etc.
4. Add `[MantisTable]` to the page or post where you want the table to appear.

== Changelog ==

= 0.1 =
* Initial Release