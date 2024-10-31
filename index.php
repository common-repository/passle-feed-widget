<?php

if( !defined( 'WP_CONTENT_DIR' ) )
{
	exit( 'No direct script access allowed.' );
}

/*
Plugin Name: Passle Feed Widget
Description: A simple widget to display a list of your Passle posts on your Wordpress site.
Author: Passle Limited
Version: 0.2
Author URI: http://www.passle.net/
*/

// CONSTANTS

define( 'PASSLE_FEED_WIDGET_PLUGIN_VERSION', '0.2' );

define( 'PASSLE_FEED_WIDGET_PLUGIN_PATH', dirname( __FILE__ ) );

define( 'PASSLE_FEED_WIDGET_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

define( 'PASSLE_FEED_WIDGET_PLUGIN_PASSLE_FEED_URL_BASE', 'https://www.passle.net/pluginfeed/' );

// include() or require() any necessary files here...

include_once( 'classes/PassleFeedWidget.php' );

// tie into WordPress Hooks and any functions that should run on load.

add_action( 'widgets_init', 'PassleFeedWidget::register_this_widget' );

add_action( 'init', 'PassleFeedWidget::css_styles' );

add_action( 'init', 'PassleFeedWidget::java_scripts' );