<?php if( true == get_theme_mod('wpg_contact_maps')) : ?>
		<div id="section-directions-map" class="col-full-no">
			<div id="map-canvas"></div>
			<input id="contact-latlng" type="hidden" value="<?php echo get_theme_mod('wpg_contact_map_latlong','54.248997, 20.804780'); ?>"  />
			<div id="panel" class="text-center">
				<input type="text" id="start" name="start" value="" placeholder="<?php _e('Enter the starting point', 'wpg_theme'); ?>" aria-required="true" aria-invalid="false" title="<?php _e('Enter the starting point', 'wpg_theme'); ?>">
				<button id="show_road" type="button" ><?php _e('Show route', 'wpg_theme'); ?></button>
				<button id="hide_road" type="button" ><?php _e('Hide route', 'wpg_theme'); ?></button>
			</div>
		</div>
		<div id="directions-panel" class="col-full-no color-white bg"></div>
<?php endif; ?>
