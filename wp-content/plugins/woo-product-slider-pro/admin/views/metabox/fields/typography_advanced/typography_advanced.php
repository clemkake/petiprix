<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.

/**
 *
 * Field: Typography Advanced
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class SP_WPSP_Framework_Option_typography_advanced extends SP_WPSP_Framework_Options {

	public function __construct( $field, $value = '', $unique = '' ) {
		parent::__construct( $field, $value, $unique );
	}

	public function output() {

		echo $this->element_before();

		$defaults_value = array(
			'family'      => 'Arial',
			'variant'     => 'regular',
			'font'        => 'websafe',
			'size'        => '14',
			'height'      => '',
			'alignment'   => '',
			'transform'   => '',
			'spacing'     => '',
			'color'       => '',
			'hover_color' => ''
		);

		$default_variants = apply_filters( 'sp_websafe_fonts_variants', array(
			'regular',
			'italic',
			'700',
			'700italic',
			'inherit'
		) );

		$websafe_fonts = apply_filters( 'sp_websafe_fonts', array(
			'Arial',
			'Arial Black',
			'Comic Sans MS',
			'Impact',
			'Lucida Sans Unicode',
			'Tahoma',
			'Trebuchet MS',
			'Verdana',
			'Courier New',
			'Lucida Console',
			'Georgia, serif',
			'Palatino Linotype',
			'Times New Roman'
		) );

		$value         = wp_parse_args( $this->element_value(), $defaults_value );
		$family_value  = $value['family'];
		$variant_value = $value['variant'];
		$is_variant    = ( isset( $this->field['variant'] ) && $this->field['variant'] === false ) ? false : true;
		$google_json   = sp_wpsp_get_google_fonts();


		//Container
		echo '<div class="sp_wpsp_font_field" data-id="' . $this->field['id'] . '">';

		if ( is_object( $google_json ) ) {

			$googlefonts = array();

			foreach ( $google_json->items as $key => $font ) {
				$googlefonts[ $font->family ] = $font->variants;
			}

			$is_google = ( array_key_exists( $family_value, $googlefonts ) ) ? true : false;

			echo '<div class="sp-element sp-typography-family sp-wpspro-select-wrapper">Font Family<br>';
			echo '<select name="' . $this->element_name( '[family]' ) . '" class="sp-wpspro-select-css sp-typo-family" data-atts="family"' . $this->element_attributes() . '>';

			do_action( 'sp_typography_family', $family_value, $this );

			echo '<optgroup label="' . __( 'Web Safe Fonts', 'woo-product-slider-pro' ) . '">';
			foreach ( $websafe_fonts as $websafe_value ) {
				echo '<option value="' . $websafe_value . '" data-variants="' . implode( '|', $default_variants ) . '" data-type="websafe"' . selected( $websafe_value, $family_value, true ) . '>' . $websafe_value . '</option>';
			}
			echo '</optgroup>';

			echo '<optgroup label="' . __( 'Google Fonts', 'woo-product-slider-pro' ) . '">';
			foreach ( $googlefonts as $google_key => $google_value ) {

				echo '<option value="' . $google_key . '" data-variants="' . implode( '|', $google_value ) . '" data-type="google" ' . selected( $google_key, $family_value, true ) . '>' . $google_key . '</option>';
			}
			echo '</optgroup>';

			echo '</select>';
			echo '</div>';

			if ( ! empty( $is_variant ) ) {

				$variants = ( $is_google ) ? $googlefonts[ $family_value ] : $default_variants;
				$variants = ( $value['font'] === 'google' || $value['font'] === 'websafe' ) ? $variants : 'regular';
				echo '<div class="sp-element sp-typography-variant sp-wpspro-select-wrapper">Font Weight<br>';
				echo '<select name="' . $this->element_name( '[variant]' ) . '" class="sp-wpspro-select-css sp-typo-variant" data-atts="variant">';
				foreach ( $variants as $variant ) {
					echo '<option value="' . $variant . '" ' . $this->checked( $variant_value, $variant, 'selected' ) . '>' . $variant . '</option>';
				}
				echo '</select>';
				echo '</div>';

			}

			echo sp_wpsp_add_element( array(
				'pseudo'     => true,
				'type'       => 'number',
				'name'       => $this->element_name( '[size]' ),
				'value'      => $value['size'],
				'default'    => ( isset( $this->field['default']['size'] ) ) ? $this->field['default']['size'] : '',
				'wrap_class' => 'small-input sp-font-size',
				'before'     => 'Font Size<br>',
				'attributes' => array(
					'title' => __( 'Font Size', 'woo-product-slider-pro' ),
				),
			) );

			echo sp_wpsp_add_element( array(
				'pseudo'     => true,
				'type'       => 'number',
				'name'       => $this->element_name( '[height]' ),
				'value'      => $value['height'],
				'default'    => ( isset( $this->field['default']['height'] ) ) ? $this->field['default']['height'] : '',
				'wrap_class' => 'small-input sp-font-height',
				'before'     => 'Line Height<br>',
				'attributes' => array(
					'title' => __( 'Line Height', 'woo-product-slider-pro' ),
				),
			) );
			echo '<div class="sp-divider"></div>';
			echo sp_wpsp_add_element( array(
				'pseudo'     => true,
				'type'       => 'select',
				'name'       => $this->element_name( '[alignment]' ),
				'value'      => $value['alignment'],
				'default'    => ( isset( $this->field['default']['alignment'] ) ) ? $this->field['default']['alignment'] : '',
				'wrap_class' => 'small-input sp-font-alignment sp-wpspro-select-wrapper',
				'class' => 'sp-wpspro-select-css',
				'before'     => 'Alignment<br>',
				'options'    => array(
					'inherit' => __( 'Inherit', 'woo-product-slider-pro' ),
					'left'    => __( 'Left', 'woo-product-slider-pro' ),
					'center'  => __( 'Center', 'woo-product-slider-pro' ),
					'right'   => __( 'Right', 'woo-product-slider-pro' ),
					'justify' => __( 'Justify', 'woo-product-slider-pro' ),
					'initial' => __( 'Initial', 'woo-product-slider-pro' ),
				),

			) );
			echo sp_wpsp_add_element( array(
				'pseudo'     => true,
				'type'       => 'select',
				'name'       => $this->element_name( '[transform]' ),
				'value'      => $value['transform'],
				'default'    => ( isset( $this->field['default']['transform'] ) ) ? $this->field['default']['transform'] : '',
				'wrap_class' => 'small-input sp-font-transform sp-wpspro-select-wrapper',
				'class' => 'sp-wpspro-select-css',
				'before'     => 'Transform<br>',
				'options'    => array(
					'none'       => __( 'None', 'woo-product-slider-pro' ),
					'capitalize' => __( 'Capitalize', 'woo-product-slider-pro' ),
					'uppercase'  => __( 'Uppercase', 'woo-product-slider-pro' ),
					'lowercase'  => __( 'Lowercase', 'woo-product-slider-pro' ),
					'initial'    => __( 'Initial', 'woo-product-slider-pro' ),
					'inherit'    => __( 'Inherit', 'woo-product-slider-pro' ),
				),
			) );
			echo sp_wpsp_add_element( array(
				'pseudo'     => true,
				'type'       => 'select',
				'name'       => $this->element_name( '[spacing]' ),
				'value'      => $value['spacing'],
				'default'    => ( isset( $this->field['default']['spacing'] ) ) ? $this->field['default']['spacing'] : '',
				'wrap_class' => 'small-input sp-font-spacing sp-wpspro-select-wrapper',
				'class' => 'sp-wpspro-select-css',
				'before'     => 'Letter Spacing<br>',
				'options'    => array(
					'normal' => __( 'Normal', 'woo-product-slider-pro' ),
					'.3px'   => __( '0.3px', 'woo-product-slider-pro' ),
					'.5px'   => __( '0.5px', 'woo-product-slider-pro' ),
					'1px'    => __( '1px', 'woo-product-slider-pro' ),
					'1.5px'  => __( '1.5px', 'woo-product-slider-pro' ),
					'2px'    => __( '2px', 'woo-product-slider-pro' ),
					'3px'    => __( '3px', 'woo-product-slider-pro' ),
					'5px'    => __( '5px', 'woo-product-slider-pro' ),
					'10px'   => __( '10px', 'woo-product-slider-pro' ),
				),
			) );
			echo '<div class="sp-divider"></div>';
			if ( isset( $this->field['color'] ) && $this->field['color'] == true ) {
				echo '<div class="sp-element sp-typography-color">' . __( 'Color', 'woo-product-slider-pro' ) . '<br>';
				echo sp_wpsp_add_element( array(
					'pseudo'     => true,
					'id'         => $this->field['id'] . '_color',
					'type'       => 'color_picker',
					'name'       => $this->element_name( '[color]' ),
					'attributes' => array(
						'data-atts' => 'bgcolor',
					),
					'value'      => $value['color'],
					'default'    => ( isset( $this->field['default']['color'] ) ) ? $this->field['default']['color'] : '',
					'rgba'       => ( isset( $this->field['rgba'] ) && $this->field['rgba'] === false ) ? false : '',
				) );
				echo '</div>';
			}
			if ( isset( $this->field['hover_color'] ) && $this->field['hover_color'] == true ) {
				echo '<div class="sp-element sp-typography-hover-color">' . __( 'Hover Color', 'woo-product-slider-pro' ) . '<br>';
				echo sp_wpsp_add_element( array(
					'pseudo'     => true,
					'id'         => $this->field['id'] . '_hover_color',
					'type'       => 'color_picker',
					'name'       => $this->element_name( '[hover_color]' ),
					'attributes' => array(
						'data-atts' => 'hovercolor',
					),
					'value'      => $value['hover_color'],
					'default'    => ( isset( $this->field['default']['hover_color'] ) ) ? $this->field['default']['hover_color'] : '',
					'rgba'       => ( isset( $this->field['rgba'] ) && $this->field['rgba'] === false ) ? false : '',
				) );
				echo '</div>';
			}

			/**
			 * Font Preview
			 */
			if ( isset( $this->field['preview'] ) && $this->field['preview'] == true ) {
				if ( isset( $this->field['preview_text'] ) ) {
					$preview_text = $this->field['preview_text'];
				} else {
					$preview_text = 'Lorem ipsum dolor sit amet, pro ad sanctus admodum, vim at insolens appellantur. Eum veri adipiscing an, probo nonumy an vis.';
				}
				echo '<div id="preview-' . $this->field['id'] . '" class="sp-font-preview">' . $preview_text . '</div>';
			}

			echo '<input type="text" name="' . $this->element_name( '[font]' ) . '" class="sp-typo-font hidden" data-atts="font" value="' . $value['font'] . '" />';

		} else {

			echo __( 'Error! Can not load json file.', 'woo-product-slider-pro' );

		}

		//end container
		echo '</div>';

		echo $this->element_after();

	}

}