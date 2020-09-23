<?php

namespace ECA;

use ECA\Core\NeedSetup;
use ECA\Widgets\ImageList\ImageList;
use ECA\Widgets\Posts\Posts;
use Elementor\Plugin;

/**
 * Class Setup
 *
 * @since   1.0.0
 * @package ECA
 */
class Setup implements NeedSetup {


	/**
	 * @return bool|void
	 */
	public static function setup() {

		include 'functions.php';

		add_action( 'elementor/widgets/widgets_registered', array( static::class, 'update_widgets_registered' ) );

		add_action('elementor/frontend/after_enqueue_styles', function() {

			wp_enqueue_style('image-list-css' , ECA_URL .'/assets/css/image-list.css');
		});
	}

	/**
	 * @hooked 'elementor/widgets/widgets_registered'
	 *
	 * @since  1.0.0
	 */
	public static function update_widgets_registered() {

		$image_list = new ImageList();
		$posts      = new Posts();

		// Let Elementor know about our widget
		Plugin::instance()->widgets_manager->register_widget_type( $image_list );
		Plugin::instance()->widgets_manager->register_widget_type( $posts );
	}
}
