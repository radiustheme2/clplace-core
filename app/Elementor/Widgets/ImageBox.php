<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\ClplaceCore\Elementor\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use RT\ClplaceCore\Helper\Fns;
use RT\ClplaceCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) exit;

class ImageBox extends ElementorBase {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Image Box', 'clplace-core' );
		$this->rt_base = 'rt-image-box';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'image_box_section',
			[
				'label' => esc_html__( 'Image Box', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'styles',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Style', 'clplace-core' ),
				'options' => array(
					'1' => esc_html__( 'Style 1', 'clplace-core' ),
					'2' => esc_html__( 'Style 2', 'clplace-core' ),
					'3' => esc_html__( 'Style 3', 'clplace-core' ),
				),
				'default' => '1',
			]
		);
		$this->add_control(
			'main_image',
			[
				'label'   => __( 'Main Image', 'clplace-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'animated_images',
			[
				'label' => esc_html__( 'Animation images', 'clplace-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'anim_image1',
			[
				'label'   => __( 'Image 1', 'clplace-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'anim_image2',
			[
				'label'   => __( 'Image 2', 'clplace-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'anim_image3',
			[
				'label'   => __( 'Image 3', 'clplace-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'anim_image4',
			[
				'label'   => __( 'Image 4', 'clplace-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [ 'styles' => '3' ],
			]
		);
		$this->add_control(
			'anim_image5',
			[
				'label'   => __( 'Image 5', 'clplace-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [ 'styles' => '3' ],
			]
		);
		$this->add_control(
			'anim_image6',
			[
				'label'   => __( 'Image 6', 'clplace-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'clplace-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'clplace-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'clplace-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'clplace-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .image-box' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'arrow_shape_visibility',
			[
				'label'        => __( 'Arrow Shape Visibility', 'clplace-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clplace-core' ),
				'label_off'    => __( 'Hide', 'clplace-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'mouse_effect',
			[
				'label'        => __( 'Mouse Effects', 'clplace-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clplace-core' ),
				'label_off'    => __( 'Hide', 'clplace-core' ),
				'return_value' => 'yes',
			]
		);
		/* -- Styles Options -- */
		// $this->__image_box_style_settings();

		$this->end_controls_section();
	}

	/* -- List Options -- */
	protected function __image_box_style_settings() {
		$this->add_responsive_control(
			'image_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Border Radius', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .image-box img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';
		$template = 'view-'.$data['styles'];

		Fns::get_template( "elementor/image-box/{$template}", $data );
	}
}