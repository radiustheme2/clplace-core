<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\ClplaceCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use RT\ClplaceCore\Helper\Fns;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use RT\ClplaceCore\Abstracts\ElementorBase;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class VideoIcon extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Video', 'clplace-core' );
		$this->rt_base = 'rt-video-icon';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		/* --General Settings Options -- */
		$this->__options_settings_controls();
		$this->__play_button_settings_controls();
		$this->__image_settings_controls();
	}

	/**
	 * @return void
	 */
	protected function __options_settings_controls(){
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Style', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon-style1',
				'options' => [
					'icon-style1' => __( 'Animation Style # 1', 'clplace-core' ),
					'icon-style2' => __( 'Animation Style # 2', 'clplace-core' ),
				],
			]
		);
		$this->add_control(
			'video_image',
			[
				'label'   => __( 'Video Image', 'clplace-core' ),
				'type'    => Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'icon',
			[
				'type'        => Controls_Manager::ICONS,
				'label'   => esc_html__( 'Icon', 'clplace-core' ),
				'default' => array(
					'value' => 'fas fa-smile-wink',
					'library' => 'fa-solid',
				),
			]
		);
		$this->add_control(
			'video_url',
			[
				'label' => __( 'Video URL', 'clplace-core' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder' => __( 'Enter your URL', 'clplace-core' ),
				'default' => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
				'label_block' => true,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'clplace-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter button text', 'clplace-core' ),
				'default' => __( 'Play Video', 'clplace-core' ),
				'label_block' => true,
			]
		);

		$this->add_responsive_control(
			'wrap_height',
			[
				'label' => __( 'Wrapper Height', 'clplace-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'vh' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'clplace-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'clplace-core' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'clplace-core' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'clplace-core' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Horizontal Align', 'clplace-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'clplace-core' ),
					'flex-start' => __( 'Start', 'clplace-core' ),
					'center' => __( 'Center', 'clplace-core' ),
					'flex-end' => __( 'End', 'clplace-core' ),
					'space-between' => __( 'Space Between', 'clplace-core' ),
					'space-around' => __( 'Space Around', 'clplace-core' ),
					'space-evenly' => __( 'Space Evenly', 'clplace-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper' => 'justify-content: {{VALUE}}; display:flex',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * @return void
	 */
	protected function __play_button_settings_controls(){
		$this->start_controls_section(
			'video_button_style',
			[
				'label' => esc_html__( 'Play Button Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'video_button_size',
			[
				'label' => __( 'Button Size', 'clplace-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 3,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .icon-box' => 'transform: scale({{SIZE}});',
				],
			]
		);

		$this->add_control(
			'video_button_spacing',
			[
				'label' => __( 'Button Spacing', 'clplace-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .icon-box' => 'margin-right:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'video_button_style_tabs'
		);

		$this->start_controls_tab(
			'video_button_style_normal_tab',
			[
				'label' => __( 'Normal', 'clplace-core' ),
			]
		);

		$this->add_control(
			'button_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Background Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => __( 'Hover', 'clplace-core' ),
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color Hover', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Background Color Hover', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .video-popup-icon:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'text_style',
			[
				'label' => __( 'Text Style', 'clplace-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Text Typography', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .rt-video-icon-wrapper .button-text',
			]
		);

		$this->add_control(
			'text_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .button-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Text Hover Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-video-icon-wrapper .button-text:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * @return void
	 */
	protected function __image_settings_controls() {
		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__( 'Video Image', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'img_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .rt-video-icon-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);

		$this->start_controls_tabs('img_style_tabs' );
			$this->start_controls_tab(
				'img_style_normal_tab',
				[
					'label' => __( 'Normal', 'clplace-core' ),
				]
			);
			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name'     => 'css_filters',
					'selector' => '{{WRAPPER}} .rt-video-icon-wrapper img',
				]
			);
			$this->add_control(
				'slider_image_opacity',
				[
					'label'      => __( 'Image Opacity', 'clplace-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1,
							'step' => .1,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .rt-video-icon-wrapper img' => 'opacity: {{SIZE}}',
					],
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'img_style_hover_tab',
				[
					'label' => __( 'Hover', 'clplace-core' ),
				]
			);
			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name'     => 'css_filters_hover',
					'selector' => '{{WRAPPER}} .rt-video-icon-wrapper:hover img',
				]
			);
			$this->add_control(
				'slider_image_opacity_hover',
				[
					'label'      => __( 'Image Opacity Hover', 'clplace-core' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px' => [
							'min'  => 0,
							'max'  => 1,
							'step' => .1,
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .rt-video-icon-wrapper:hover img' => 'opacity: {{SIZE}}',
					],
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/video-icon/$template", $data );
	}

}