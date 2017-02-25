<?php
/**
 * Custom control Multiple Terms Checkbox class
 *
 * @package wpg_bezcieniowa_pl
 * @since 1.0.0
 */

/**
 * Multiple terms checkbox class.
 *
 * @since 1.0.0
 * @access public
 */
class WPG_Customize_Control_Checkbox_Term extends WP_Customize_Control {

    /**
     * The type of customize control being rendered.
     *
     * @since 1.0.0
     * @access public
     * @var    string
     */
    public $type = 'checkbox-term';

    /**
     * Displays the control content.
     *
     * @since 1.0.0
     * @access public
     * @return void
     */
    public function render_content() {

        if ( empty( $this->choices ) )
            return; ?>

        <?php if ( !empty( $this->label ) ) : ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php endif; ?>

        <?php if ( !empty( $this->description ) ) : ?>
            <span class="description customize-control-description"><?php echo $this->description; ?></span>

        <?php endif; ?>

        <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>
		

		<div class="checkbox-list">
		<?php

		$term_tax = get_theme_mod('wpg_last_in_term_tax','category');
		
		foreach ( $this->choices as $key => $label ) {

			$class_list = $term_tax == $key ? 'show-list' : '';
		
			printf('<ul class="%s %s">', $key, $class_list);

				foreach ( $this->choices[$key] as $value => $label ) { ?>
		         <li>
		             <label>
		             	<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> />
		                <?php echo esc_html( $label ); ?>
		             </label>
		       	</li>


		<?php 
				}
			echo '</ul>';
		}
		?>

		</div>
        <input id="category-chosen" type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
    <?php }
}
?>