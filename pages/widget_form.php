<div class="pf-widget-form-inner-wrapper">
	<div class="pf-widget-form-row">
		<div class="pf-widget-form-row-cell-with-label">
			<label for="<?php echo $hash['title.id']; ?>"><?php _e( 'Title:' ); ?></label>
		</div>
		<div class="pf-widget-form-row-cell-with-input">
			<input type="text" id="<?php echo $hash['title.id']; ?>" name="<?php echo $hash['title.name']; ?>" value="<?php echo $hash['title.value']; ?>" />
		</div>
	</div>
	<div class="pf-widget-form-row">
		<div class="pf-widget-form-row-cell-with-label">
			<label for="<?php echo $hash['feed_id.id']; ?>"><?php _e( 'Feed ID:' ); ?></label>
		</div>
		<div class="pf-widget-form-row-cell-with-input">
			<input type="text" id="<?php echo $hash['feed_id.id']; ?>" name="<?php echo $hash['feed_id.name']; ?>" value="<?php echo $hash['feed_id.value']; ?>" />
		</div>
	</div>
	<div class="pf-widget-form-row">
		<div class="pf-widget-form-row-cell-with-label">
			<label for="<?php echo $hash['number_of_posts.id']; ?>"><?php _e( 'Number Of Posts:' ); ?></label>
		</div>
		<div class="pf-widget-form-row-cell-with-input">
			<input type="text" id="<?php echo $hash['number_of_posts.id']; ?>" name="<?php echo $hash['number_of_posts.name']; ?>" value="<?php echo $hash['number_of_posts.value']; ?>" />
		</div>
	</div>
	<div class="pf-widget-form-row">
		<div class="pf-widget-form-row-cell-with-label">
			<label for="<?php echo $hash['hide_thumbnail_images.id']; ?>"><?php _e( 'Hide Thumbnail Images:' ); ?></label>
		</div>
		<div class="pf-widget-form-row-cell-with-radio-buttons">
			<input type="radio" id="<?php echo $hash['hide_thumbnail_images.id']; ?>" name="<?php echo $hash['hide_thumbnail_images.name']; ?>" value="no" <?php echo ( $hash['hide_thumbnail_images.value'] == 'no' ? 'checked="checked"' : '' ); ?> /> No 
			<input type="radio" name="<?php echo $hash['hide_thumbnail_images.name']; ?>" value="yes" <?php echo ( $hash['hide_thumbnail_images.value'] == 'yes' ? 'checked="checked"' : '' ); ?> /> Yes
		</div>
	</div>
</div>