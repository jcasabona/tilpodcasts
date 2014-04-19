=== Simplecast Episodes ===
Contributors: Joe Casabona
Tags: podcasts, simplecast, audio, episodes
Stable Tag: trunk
Donate link: http://casabona.org/plugins/
Requires at least: 3.6
Tested up to: 3.9
License: GPL

The Simplecast Epsiodes plugin allows you to add and embed podcasts hosted at simplecast.fm into WordPress. 

== Description ==
The Simplecast Epsiodes plugin allows you to add and embed podcasts hosted at simplecast.fm into WordPress. You have the ability to add direct download links, as well as titles, descriptions (for Show Notes), and tags. The plugin also creates an options page where you can add information about upcoming episodes, sponsors, and select the type of embedded player you want.

== Installation ==
1. Download and install simplecast-episode.zip 
2. Upload to `/wp-content/plugins/`
3. Activate the plugin

There is a list of template tags on the FAQs page.

== Frequently Asked Questions ==

= Where do the podcasts come from?

In order to use this plugin, you need to have a Simplecast account. You can sign up at [simplecast.fm](http://simplecast.fm)

= Do you have template tags or short codes?

Right now there is only one template tag, called `simplecast_latest_show()`. It will display the latest show. I hope to add more in the near future. they will all be in the simplecast-functions.php file

== Screenshots ==
1. The \"Add Episode\" admin screen
2. The Podcast Settings admin screen
3. A sample frontend screen

== Changelog ==

= 0.6 =
* New setting to choose to download the epsiode onto your server (Epsiodes->Settings). When set to yes, this will happen automatically.
* BETA- Ability to download ALL previously added simplecast episodes into the WordPress Media area (Episodes->Settings). This is still in beta and can be pretty slow, especially if you have a lot of episodes.
* Added a new function, `simplecast_direct_url()` to get the download URL of an episode from its embed URL. 

= 0.4 =
First official release of the plugin