<?php

namespace ECA\Widgets\ImageList;

use ECA\Core\Utility;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

/**
 * Class ImageList
 *
 * @since   1.0.0
 * @package ECA\Widgets\ImageList
 */
class ImageList extends \Elementor\Widget_Base {

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

		return 'imagelist';
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

		return __( 'ImageList', 'elementor-custom-adddons' );
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

	/**
	 * Configuration of content tab controls.
	 *
	 * @since 1.0.0
	 */
	protected function content_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Images', 'elementor-custom-adddons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control( 'image_field', [
			'label'   => __( 'Choose Image', 'elementor-custom-adddons' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$image_sizes = Utility::get_image_sizes();

		$options = [];

		foreach ( $image_sizes as $size => $dimension ) {

			$options[ $size ] = __( ucfirst( str_replace( '_', ' ', $dimension['name'] ) ) . ' ' . $dimension['width'] . '*' . $dimension['height'], 'elementor-custom-addons' );
		}

		$repeater->add_control( 'image_size', [
			'label'   => __( 'Image Size', 'elementor-custom-addons' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'thumbnail',
			'options' => $options,
		] );

		$this->add_control(
			'list',
			[
				'label'       => __( 'Images Items', 'elementor-custom-addons' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'image_field' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'image_size'  => __( 'Item content. Click the edit button to change this text.', 'elementor-custom-addons' ),
					],
				],
				'image_field' => '{{{ image_field }}}',
			]
		);

		$this->add_control(
			'url',
			[
				'label'       => __( 'URL to embed', 'elementor-custom-adddons' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'input_type'  => 'url',
				'placeholder' => __( 'https://your-link.com', 'elementor-custom-adddons' ),
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Configuration of style tab controls.
	 *
	 * @since 1.0.0
	 */
	protected function style_controls() {

		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Image', 'elementor-custom-adddons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control( 'columns', [
			'label'   => __( 'Columns', 'elementor-custom-addons' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '25%',
			'options' => [
				'24%' => __( '4 Columns', 'elementor-custom-addons' ),
				'32.5%' => __( '3 Columns', 'elementor-custom-addons' ),
				'49%' => __( '2 Columns', 'elementor-custom-addons' ),
			],
			'selectors' => [
				'{{WRAPPER}} .image-item' => 'width: {{VALUE}}'
			],
		] );

		$this->add_control( 'border_type', [
			'label'   => __( 'Border Type', 'elementor-custom-addons' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'solid',
			'options' => [
				'solid'  => __( 'Solid', 'elementor-custom-addons' ),
				'dashed' => __( 'Dashed', 'elementor-custom-addons' ),
				'dotted' => __( 'Dotted', 'elementor-custom-addons' ),
				'double' => __( 'Double', 'elementor-custom-addons' ),
				'none'   => __( 'None', 'elementor-custom-addons' ),
			],
		] );

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'elementor-custom-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .your-class' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'elementor-custom-addons' ),
				'selector' => '{{WRAPPER}} .wrapper',
			]
		);

		$this->end_controls_section();
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

		eca_load_views('elementor.image-list',compact('settings'));
	}

}
