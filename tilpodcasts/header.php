<!DOCTYPE html>
<html lang="en-us">
	<head>
		<title><?php bloginfo('name'); ?> | <?php wp_title(); ?> </title>
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />	
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
		<link href="https://simplecast.fm/podcasts/43/rss" rel="alternate" title="TIL Podcast RSS" type="application/rss+xml" />
	
		<?php wp_head(); ?>
		
	
	</head>
	
	<body>
			<div id="wrapper">
			<nav class="group">
				<div class="contain alignleft">
					<?php wp_nav_menu( array('menu' => 'Main' )); ?>
				</div>
				
				<ul class="social alignright">
						<li><a title="Twitter - @tilpodcast" href="https://twitter.com/tilpodcast"><i class="fa fa-twitter circle"></i></a></li>
						<li><a title="Facebook - tilpodcast" href="http://facebook.com/tilpodcast"><i class="fa fa-facebook circle"></i></a></li>
						<li><a title="RSS Feed" href="http://simplecast.fm/podcasts/43/rss"><i class="fa fa-rss circle"></i></a></li>
						<li><a title="Subscribe on iTunes" href="https://itunes.apple.com/us/podcast/til-podcast/id770159993"><i class="fa fa-music circle"></i></a></li>
					</ul>
			</nav>
			
			<div class="contain">
				<header class="group">
					<h1><a href="<?php bloginfo('home'); ?>"><img src="<?php print IMAGES; ?>/til-web.png" alt="<?php bloginfo('name'); ?>" id="logo" /></a></h1>
					<p><?php bloginfo('description'); ?></p>
				</header>
				
				<div id="content">
