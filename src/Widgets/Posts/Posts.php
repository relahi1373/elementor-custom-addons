<?php

namespace ECA\Widgets\Posts;

use Elementor\Controls_Manager;

/**
 * Class Posts
 *
 * @since   1.0.0
 * @package ECA\Widgets\Posts
 */
class Posts extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {

		return 'posts';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {

		return __( 'Posts', 'elementor-custom-adddons' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {

		return 'fa fa-code';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {

		return [
			'general'
		];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->content_controls();

		$this->style_controls();

	}

	protected function content_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Layout', 'elementor-custom-adddons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control( 'skin', [
			'label'   => __( 'Skin', 'elementor-custom-addons' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'classic',
			'options' => [
				'classic' => __( 'Classic', 'elementor-custom-addons' ),
				'cards'   => __( 'Cards', 'elementor-custom-addons' ),
			],
		] );

		$this->add_responsive_control( 'columns', [
			'label'     => __( 'Columns', 'elementor-custom-addons' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => '25%',
			'options'   => [
				'23%'   => __( '4 Columns', 'elementor-custom-addons' ),
				'31.5%' => __( '3 Columns', 'elementor-custom-addons' ),
				'48%'   => __( '2 Columns', 'elementor-custom-addons' ),
			],
			'selectors' => [
				'{{WRAPPER}} .posts-item__classic,.posts-item__cards' => 'width: {{VALUE}}'
			],
		] );

		$this->add_control(
			'posts_per_page',
			[
				'label'   => __( 'Posts Per Page', 'elementor-custom-addons' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 6,
				'max'     => 15,
				'step'    => 1,
				'default' => 6,
			]
		);

		$this->add_control( 'show_image', [
			'label'     => __( 'Show Image', 'elementor-custom-addons' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'block',
			'options'   => [
				'block' => __( 'Yes', 'elementor-custom-addons' ),
				'none'  => __( 'No', 'elementor-custom-addons' ),
			],
			'selectors' => [
				'{{WRAPPER}} .thumbnail-post' => 'display: {{VALUE}}'
			],
			'show_on'   => [
				[
					'skin=cards'
				]
			]
		] );

		$this->end_controls_section();
	}

	protected function style_controls() {

		// There is no need to add any style settings.
	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		$args = [
			'post_type'      => 'post',
			'posts_per_page' => $settings['posts_per_page'],
		];

		$query = new \WP_Query( $args );

		eca_load_views( 'elementor.posts-' . $settings['skin'], compact( 'settings', 'query' ) );
	}

}
