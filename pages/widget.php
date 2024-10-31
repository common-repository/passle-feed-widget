<?php

echo $hash['before_widget'];

echo $hash['before_title'] . $hash['title'] . $hash['after_title'];

?>
<div class="pf-widget-inner-content">
	<?php
	
	if( !empty( $hash['latest_posts'] ) )
	{
		?>
		<ul class="latest-posts-list">
			<?php
			
			foreach( $hash['latest_posts'] as $latest_post )
			{
				?>
				<li>
					<?php
					
					if( strlen( trim( $latest_post->post_featured_image_thumbnail_url ) ) > 0 )
					{
						?>
						<div class="post-featured-image-thumbnail-container">
							<img src="<?php echo $latest_post->post_featured_image_thumbnail_url; ?>" alt="" />
						</div>
						<?php
					}
					
					?>
					<div class="post-info-container <?php echo ( strlen( trim( $latest_post->post_featured_image_thumbnail_url ) ) == 0 ) ? 'post-info-container-without-post-featured-image-thumbnail-container-on-the-left' : ''; ?>">
						<a href="<?php echo $latest_post->get_permalink(); ?>" class="title" target="_blank"><?php echo strip_tags( html_entity_decode( $latest_post->get_title() ), '<a>' ); ?></a>
						<div class="break;"></div>
						<span class="date"><?php echo $latest_post->get_date( 'd M Y' ); ?></span>
					</div>
				</li>
				<?php
			}
			 
			?>
		</ul>
		<?php
	}
	else
	{
		?>
		<p class="empty-latest-posts-list">The list is empty</p>
		<?php
	}
	
	?>
</div>
<?php

echo $hash['after_widget'];
