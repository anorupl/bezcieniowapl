<?php
/**
 * Customize control for field Dropdown select
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */

/**
 * Custom class for field Google map .
 *
 * @since 1.0.0
 * @access public
 */
class WPG_Custom_Dropdown extends WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     *
     * @since 1.0.0
     * @access public
     * @var    string
     */
    public $type = 'wpg_custom_dropdown';
	public $post_type;	

	

    /**
     * Displays the control content.
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
	public function render_content() {

		$select_items = new WP_Query( array(
			'post_type'   => $this->post_type,
			'post_status' => 'publish',
			'posts_per_page'=> -1,
			'orderby'     => 'date',
			'order'       => 'DESC'
		));

		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?>>
					<?php 
					printf('<option %1$s value="0">%2$s</option>',
						selected( $this->value(), 0 ),
						__( '&mdash; Select &mdash;', 'wpg_theme' )
					);
					
					while( $select_items->have_posts() ) {
						$select_items->the_post();
						echo "<option " . selected( $this->value(), get_the_ID() ) . " value='" . get_the_ID() . "'>" . the_title( '', '', false ) . "</option>";
					}
					?>
				</select>
			</label>
		<?php
	}
}
?>