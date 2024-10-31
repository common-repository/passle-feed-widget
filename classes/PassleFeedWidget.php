<?php

/*
Passle Feed Widget: add a new widget which display latest posts from pointed feed of Passle.
*/

class PassleFeedWidget extends WP_Widget
{
	public $name				= 'Passle Feed Widget';
	
	public $description			= 'Display latest posts from pointed feed of Passle.';
	
	public $control_options		= array
	(
		'title'						=> ''
		,
		'feed_id'					=> ''
		,
		'number_of_posts'			=> 5
		,
		'hide_thumbnail_images'		=> 'no'
	)
	;
	
	public function __construct()	
	{
		$widget_options		= array
		(
			'classname' 	=> __CLASS__
			,
			'description' 	=> $this->description
		)
		;
		
		parent::__construct( __CLASS__, $this->name, $widget_options, $this->control_options );
	}
	
	/*
	Include all necessary css styles
	*/
	
	public static function css_styles()
	{
		$current_script_name = str_replace( dirname( $_SERVER['PHP_SELF'] ) . '/', '', $_SERVER['PHP_SELF'] );
		
		if
		(
			is_admin()
			&&
			$current_script_name == 'widgets.php'
		)
		{
			wp_enqueue_style( 'passle-feed-widget-plugin-back-end', PASSLE_FEED_WIDGET_PLUGIN_URL . 'css/back-end.css' );
		}
		elseif
		(
			!is_admin()
		)
		{
			wp_enqueue_style( 'passle-feed-widget-plugin-front-end', PASSLE_FEED_WIDGET_PLUGIN_URL . 'css/front-end.css' );
		}
	}
	
	/*
	 Include all necessary java scripts
	*/
	
	public static function java_scripts()
	{
		if
		(
			!is_admin()
		)
		{
			// wp_enqueue_script( 'passle-feed-widget-plugin-front-end', PASSLE_FEED_WIDGET_PLUGIN_URL . 'js/front-end.js', array( 'jquery' ), false, true );
		}
	}
	
	/*
	Display the widget in the manager.
	*/
	
	public function form( $instance )
	{
		$hash = array();
		
		foreach( $this->control_options as $key => $val )
		{
			$hash[ $key . '.id' ] 			= $this->get_field_id( $key );
			
			$hash[ $key . '.name' ] 		= $this->get_field_name( $key );
			
			if( isset( $instance[ $key ] ) )
			{
				$hash[ $key . '.value' ]	= esc_attr( $instance[ $key ] );
			}
			else 
			{
				$hash[ $key . '.value' ]	= esc_attr( $this->control_options[ $key ] );
			}
		}
	
		include( PASSLE_FEED_WIDGET_PLUGIN_PATH . '/pages/widget_form.php' );
	}
	
	/*
	Perform the updating of widget parameters after the manager clicks "Save". 
	*/
	 
	public function update( $new_instance, $old_instance )
	{
		$instance								= $old_instance;
		
		$instance['title']						= $new_instance['title'];
		
		$instance['feed_id']					= $new_instance['feed_id'];
		
		$instance['number_of_posts']			= ( int ) $new_instance['number_of_posts'];
		
		$instance['hide_thumbnail_images']		= $new_instance['hide_thumbnail_images'];
		
		return $instance;
	}
	
	/*
	Change "cache transient lifetime" value only for "fetch_feed" function.
	*/
	
	public function fetch_feed_cache_transient_lifetime( $seconds )
	{
		// 5 minutes
		
		return 300;
	}
	
	/*
	Display widget in the front-end.
	*/
	
	public function widget( $args, $instance )
	{
		$hash						= array_merge( $args, $instance );
		
		$hash['latest_posts'] 		= null;
		
		if( strlen( trim( $hash['feed_id'] ) ) > 0 )
		{
			add_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'fetch_feed_cache_transient_lifetime' ) );
			
			$rss = fetch_feed( PASSLE_FEED_WIDGET_PLUGIN_PASSLE_FEED_URL_BASE . trim( $hash['feed_id'] ) . '/1/' . ( int ) $hash['number_of_posts'] );
			
			remove_filter( 'wp_feed_cache_transient_lifetime', array( $this, 'fetch_feed_cache_transient_lifetime' ) );
			
			if( !is_wp_error( $rss ) )
			{
				$number_of_items_in_the_feed = $rss->get_item_quantity( $hash['number_of_posts'] );
				
				if( $number_of_items_in_the_feed > 0 )
				{
					$hash['latest_posts'] = $rss->get_items( 0, $number_of_items_in_the_feed );
				}
			}
		}
		
		// calculation of additional proprties for SimplePie_Item instance
		
		if( $hash['latest_posts'] != null )
		{
			foreach( $hash['latest_posts'] as $latest_post )
			{
				// post's featured image thumbnail
				
				$latest_post->post_featured_image_thumbnail_url = '';
				
				if( $hash['hide_thumbnail_images'] == 'no' )
				{
					$latest_post->post_featured_image_thumbnail_url = $latest_post->get_link( 0, 'featured-image-thumbnail' );
				}
			}
		}
		
		include( PASSLE_FEED_WIDGET_PLUGIN_PATH . '/pages/widget.php' );
	}
	
	/*
	Register this widget.
	*/
	
	public static function register_this_widget()
	{
		register_widget( __CLASS__ );
	}
}
