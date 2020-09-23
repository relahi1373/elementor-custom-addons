<?php

if ( ! function_exists( 'eca_load_views' ) ) {

	/**
	 * Include template by extract params.
	 *
	 * @param $view
	 * @param $params
	 */
	function eca_load_views( $view, $params ) {

		$views_directory = ECA_PATH . '/views/';
		$template        = str_replace( '.', DIRECTORY_SEPARATOR, $view );
		$template_path   = sprintf( '%s%s.php', $views_directory, $template );

		if ( file_exists( $template_path ) && is_readable( $template_path ) ) {

			if ( ! empty( $params ) ) {

				extract( $params );
			}

			include $template_path;
		}
	}
}
