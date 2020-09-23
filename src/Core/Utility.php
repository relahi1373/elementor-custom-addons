<?php

namespace ECA\Core;

/**
 * Class Utility
 *
 * @package ECA\Core
 * @since 1.0.0
 */
class Utility {

	/**
	 * Used for finding all image sizes
	 *
	 *
	 * @since   1.0.0
	 * @return array|null
	 *
	 */
	public static function get_image_sizes() {

		global $_wp_additional_image_sizes;

		foreach ( get_intermediate_image_sizes() as $size ) {

			$sizes[ $size ] = array(
				'name'   => '',
				'width'  => '',
				'height' => '',
				'crop'   => false
			);

			$sizes[ $size ]['name'] = $size;

			if ( isset( $_wp_additional_image_sizes[ $size ]['width'] ) ) {

				$sizes[ $size ]['width'] = intval( $_wp_additional_image_sizes[ $size ]['width'] );
			} else {

				$sizes[ $size ]['width'] = get_option( "{$size}_size_w" );
			}

			if ( isset( $_wp_additional_image_sizes[ $size ]['height'] ) ) {

				$sizes[ $size ]['height'] = intval( $_wp_additional_image_sizes[ $size ]['height'] );
			} else {

				$sizes[ $size ]['height'] = get_option( "{$size}_size_h" );
			}

			if ( isset( $_wp_additional_image_sizes[ $size ]['crop'] ) ) {

				$sizes[ $size ]['crop'] = intval( $_wp_additional_image_sizes[ $size ]['crop'] );
			} else {

				$sizes[ $size ]['crop'] = get_option( "{$size}_crop" );
			}
		}

		return apply_filters( 'better-regenerator-thumbnails/intermediate-image-sizes-advanced', $sizes );
	}
}