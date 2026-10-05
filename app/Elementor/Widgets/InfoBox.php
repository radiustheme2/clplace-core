<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\ClplaceCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use RT\ClplaceCore\Helper\Fns;
use RT\ClplaceCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class InfoBox extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Info Box', 'clplace-core' );
		$this->rt_base = 'rt-info-box';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		/* --General Settings Options -- */
		$this->__options_settings_controls();

		/* -- Info Elements Options -- */
		$this->__infobox_icon_settings_controls();
		$this->__infobox_number_settings_controls();
		$this->__infobox_title_settings_controls();
		$this->__infobox_description_settings_controls();
		$this->__infobox_button_settings_controls();
		$this->__infobox_style_settings_controls();

	}

	// Info Box General Settings
	protected function __options_settings_controls() {
		$this->start_controls_section(
			'info_box_general',
			[
				'label' => esc_html__( 'General', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'styles',
			[
				'label'   => esc_html__( 'Style', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( 'Style 1', 'clplace-core' ),
					'2' => esc_html__( 'Style 2', 'clplace-core' ),
					'3' => esc_html__( 'Style 3', 'clplace-core' ),
					'4' => esc_html__( 'Style 4', 'clplace-core' ),
					'5' => esc_html__( 'Style 5', 'clplace-core' ),
					'6' => esc_html__( 'Style 6', 'clplace-core' ),
					'7' => esc_html__( 'Style 7', 'clplace-core' ),
					'8' => esc_html__( 'Style 8', 'clplace-core' ),
					'9' => esc_html__( 'Style 9', 'clplace-core' ),
					'10' => esc_html__( 'Style 10', 'clplace-core' ),
					'11' => esc_html__( 'Style 11', 'clplace-core' ),
					'12' => esc_html__( 'Style 12', 'clplace-core' ),
				],

			]
		);
		$this->add_responsive_control(
			'icon_position',
			[
				'type'    => Controls_Manager::CHOOSE,
				'label'   => esc_html__( 'Icon Position', 'clplace-core' ),
				'options' => [
					'left'    => array(
						'title' => __( 'Left', 'clplace-core' ),
						'icon' => 'eicon-arrow-left',
					),
					'top' => array(
						'title' => __( 'Top', 'clplace-core' ),
						'icon' => 'eicon-arrow-up',
					),
					'right' => array(
						'title' => __( 'Right', 'clplace-core' ),
						'icon' => 'eicon-arrow-right',
					),
				],
				'default' => 'top',
			]
		);

		$this->add_responsive_control(
			'alignment1',
			[
				'type'    => Controls_Manager::CHOOSE,
				'label'   => esc_html__( 'Icon Alignment left/right', 'clplace-core' ),
				'options' => [
					'flex-start'    => array(
						'title' => esc_html__( 'Left', 'clplace-core' ),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'clplace-core' ),
						'icon' => 'eicon-text-align-center',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Right', 'clplace-core' ),
						'icon' => 'eicon-text-align-right',
					),
				],
				'prefix_class' => 'elementor-align-',
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .info-box' => 'align-items: {{VALUE}};',
				],
				'condition'   => [
					'icon_position' => 'top',
				],
			]
		);
		$this->add_responsive_control(
			'textalign2',
			[
				'type'    => Controls_Manager::CHOOSE,
				'label'   => esc_html__( 'Text Alignment left/right', 'clplace-core' ),
				'options' => [
					'left'    => array(
						'title' => esc_html__( 'Left', 'clplace-core' ),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'clplace-core' ),
						'icon' => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'clplace-core' ),
						'icon' => 'eicon-text-align-right',
					),
				],
				'prefix_class' => 'elementor-align-',
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .info-box' => 'text-align: {{VALUE}};',
				],
				'condition'   => [
					'icon_position' => 'top',
				],
			]
		);

		$this->add_responsive_control(
			'alignment3',
			[
				'type'    => Controls_Manager::CHOOSE,
				'label'   => esc_html__( 'Text Alignment top/bottom', 'clplace-core' ),
				'options' => [
					'flex-start'    => array(
						'title' => esc_html__( 'Top', 'clplace-core' ),
						'icon' => 'eicon-v-align-top',
					),
					'center' => array(
						'title' => esc_html__( 'Middle', 'clplace-core' ),
						'icon' => 'eicon-v-align-middle',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Bottom', 'clplace-core' ),
						'icon' => 'eicon-v-align-bottom',
					),
				],
				'prefix_class' => 'elementor-align-',
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .info-box' => 'align-items: {{VALUE}};',
				],
				'condition'   => [
					'icon_position' => ['left', 'right'],
				],
			]
		);
		$this->add_responsive_control(
			'textalign4',
			[
				'type'    => Controls_Manager::CHOOSE,
				'label'   => esc_html__( 'Text Alignment left/right', 'clplace-core' ),
				'options' => [
					'left'    => array(
						'title' => esc_html__( 'Left', 'clplace-core' ),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'clplace-core' ),
						'icon' => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'clplace-core' ),
						'icon' => 'eicon-text-align-right',
					),
				],
				'prefix_class' => 'elementor-align-',
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .info-box' => 'text-align: {{VALUE}};',
				],
				'condition'   => [
					'icon_position' => ['left', 'right'],
				],
			]
		);
		$this->add_control(
			'css_classes',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'CSS Clasess', 'clplace-core' ),
				'label_block' => true,
			]
		);
		$this->end_controls_section();
	}

	// Icon Box Settings
	protected function __infobox_icon_settings_controls() {
		$this->start_controls_section(
			'iconbox_settings',
			[
				'label'     => esc_html__( 'Icon Box', 'clplace-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'icon_text',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Icon Text', 'clplace-core' ),
				'default' => '01',
				'label_block' => true,
				'condition' => [ 'styles' => '4' ],
			]
		);
		$this->add_control(
			'icon_image',
			[
				'label'   => esc_html__( 'Icon Image', 'clplace-core' ),
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
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'clplace-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .item-icon-box i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .item-icon-box svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .item-icon-box img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'iconbox_width',
			[
				'label' => esc_html__( 'Width', 'clplace-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .item-icon-box' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_responsive_control(
			'iconbox_height',
			[
				'label' => esc_html__( 'Height', 'clplace-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .item-icon-box' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_responsive_control(
			'iconbox_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .item-icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->add_responsive_control(
			'iconbox_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .item-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'icon_border',
				'label'     => esc_html__( 'Border', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .item-icon-box',
			]
		);

		$this->start_controls_tabs( 'iconbox_tab_style' );
		// Normal tab.
		$this->start_controls_tab(
			'iconbox_style_normal',
			[
				'label' => esc_html__( 'Normal', 'clplace-core' ),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .item-icon-box i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .item-icon-box svg' => 'color: {{VALUE}}',
					'{{WRAPPER}} .item-icon-box svg path' => 'stroke: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'icon_box_bg',
				'label'    => esc_html__( 'Background', 'clplace-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Icon box Background', 'clplace-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .info-box .item-icon-box, {{WRAPPER}} .info-box .item-icon-box::after',
			]
		);
		$this->add_responsive_control(
			'iconbox_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .item-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->end_controls_tab();

		// Hover tab.
		$this->start_controls_tab(
			'iconbox_style_hover',
			[
				'label' => esc_html__( 'Hover', 'clplace-core' ),
			]
		);
		$this->add_control(
			'icon_h_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .info-box:hover .item-icon-box i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box:hover .item-icon-box svg' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box:hover .item-icon-box svg path' => 'stroke: {{VALUE}}',

				),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'icon_h_box_bg',
				'label'    => esc_html__( 'Background', 'clplace-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Icon Hover Box Background', 'clplace-core'),
						'default' => 'classic',
					]
				],
				'selector' => '
					{{WRAPPER}} .info-box:hover .item-icon-box,
					{{WRAPPER}} .info-box:hover .item-icon-box::after
				',
			]
		);
		$this->add_responsive_control(
			'iconbox_h_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .info-box:hover .item-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'icon_2_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Icon 2', 'clplace-core' ),
				'separator' => 'before',
				'condition' => [ 'styles' => '1' ],
			]
		);
		$this->add_control(
			'icon2',
			[
				'type'        => Controls_Manager::ICONS,
				'label'   => esc_html__( 'Icon', 'clplace-core' ),
				'default' => array(
					'value' => 'fas fa-smile-wink',
					'library' => 'fa-solid',
				),
				'condition' => [ 'styles' => '1' ],
			]
		);
		$this->add_control(
			'icon_2_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .icon-2 i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon-2 svg path' => 'fill: {{VALUE}}',
				),
				'condition' => [ 'styles' => '1' ],
			]
		);
		$this->add_control(
			'icon_2_hover_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Hover Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .info-box:hover .icon-2 i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box:hover .icon-2 svg path' => 'fill: {{VALUE}}',
				),
				'condition' => [ 'styles' => '1' ],
			]
		);
		$this->add_responsive_control(
			'icon_2_size',
			[
				'label' => esc_html__( 'Icon Size', 'clplace-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-2 i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon-2 svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'styles' => '1' ],
			]
		);

		$this->end_controls_section();
	}

	// Number Box Settings
	protected function __infobox_number_settings_controls() {
		$this->start_controls_section(
			'number_settings',
			[
				'label'     => esc_html__( 'Number Box', 'clplace-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => [ 'styles' => ['1', '2', '12']],
			]
		);
		$this->add_control(
			'number_text',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Number Text', 'clplace-core' ),
				'default' => '01',
				'label_block' => true,
				'condition' => [ 'styles' => ['1', '2', '12']],
			]
		);


		$this->add_control(
			'number_box_width',
			[
				'label' => esc_html__( 'Width', 'clplace-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .number' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
				'condition' => [ 'styles' => ['1', '2', '12']],
			]
		);
		$this->add_control(
			'number_box_height',
			[
				'label' => esc_html__( 'Height', 'clplace-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .number' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
				'condition' => [ 'styles' => ['1', '2', '12']],
			]
		);

		$this->start_controls_tabs( 'number_box_tab_style' );
		// Normal tab.
		$this->start_controls_tab(
			'number_box_style_normal',
			[
				'label' => esc_html__( 'Normal', 'clplace-core' ),
				'condition' => [ 'styles' => ['1', '2', '12']],
			]
		);
		$this->add_control(
			'number_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .number' => 'color: {{VALUE}}',
				),
				'condition' => [ 'styles' => ['1', '2', '12']],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'number_box_bg',
				'label'    => esc_html__( 'Background', 'clplace-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Number Box Background', 'clplace-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .number',
				'condition' => [ 'styles' => ['1', '2', '12']],
			]
		);
		$this->add_responsive_control(
			'number_box_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
				'condition' => [ 'styles' => ['1', '2', '12']],
			]
		);
		$this->end_controls_tab();

		// Hover tab.
		$this->start_controls_tab(
			'number_box_style_hover',
			[
				'label' => esc_html__( 'Hover', 'clplace-core' ),
				'condition' => [ 'styles' => ['1', '2', '12']],
			]
		);
		$this->add_control(
			'number_h_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .info-box:hover .number' => 'color: {{VALUE}}',
				),
				'condition' => [ 'styles' => ['1', '2', '12']],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'number_box_hbg',
				'label'    => esc_html__( 'Background', 'clplace-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Number Box Hover Background', 'clplace-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .info-box:hover .number',
				'condition' => [ 'styles' => ['1', '2', '12']],
			]
		);
		$this->add_responsive_control(
			'number_box_h_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Border Radius', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .info-box:hover .number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
				'condition' => [ 'styles' => ['1', '2', '12']],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	// Title Style
	protected function __infobox_title_settings_controls() {
		$this->start_controls_section(
			'title_settings',
			[
				'label'     => esc_html__( 'Title', 'clplace-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Title', 'clplace-core' ),
				'default' => 'Infobox Title',
				'label_block' => true,
			]
		);
		$this->add_responsive_control(
			'heading_tag',
			[
				'type'    => Controls_Manager::SELECT,
				'label'   => esc_html__( 'HTML Tag', 'clplace-core' ),
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default' => 'h3',
			]
		);
		$this->add_control(
			'title_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Title Style', 'clplace-core' ),
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .item-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .item-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->start_controls_tabs( 'title_tab_style' );
			// Normal tab.
			$this->start_controls_tab(
				'title_style_normal',
				[
					'label' => __( 'Normal', 'clplace-core' ),
				]
			);
			$this->add_control(
				'title_color',
				[
					'type'    => Controls_Manager::COLOR,
					'label'   => esc_html__( 'Color', 'clplace-core' ),
					'selectors' => array(
						'{{WRAPPER}} .item-title' => 'color: {{VALUE}}',
						'{{WRAPPER}} .item-title a' => 'color: {{VALUE}}',
					),
				]
			);
			$this->end_controls_tab();

			// Hover tab.
			$this->start_controls_tab(
				'title_style_hover',
				[
					'label' => __( 'Hover', 'clplace-core' ),
				]
			);
			$this->add_control(
				'title_hover_color',
				[
					'type'    => Controls_Manager::COLOR,
					'label'   => esc_html__( 'Hover Color', 'clplace-core' ),
					'selectors' => array(
						'{{WRAPPER}} .info-box:hover .content .item-title a:hover' => 'color: {{VALUE}}',
						'{{WRAPPER}} .info-box:hover .content .item-title' => 'color: {{VALUE}}',
						'{{WRAPPER}} .info-box:hover .content .item-title a' => 'color: {{VALUE}}',
					),
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	// Description Style
	protected function __infobox_description_settings_controls() {
		$this->start_controls_section(
			'desc_settings',
			[
				'label'     => esc_html__( 'Description', 'clplace-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'desc',
			[
				'type'    => Controls_Manager::WYSIWYG,
				'label'   => esc_html__( 'Description', 'clplace-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'desc_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Style', 'clplace-core' ),
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typo',
				'label'    => esc_html__( 'Typography', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .info-box p',
			]
		);
		$this->add_responsive_control(
			'desc_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .info-box p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->add_responsive_control(
			'desc_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .info-box p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'desc_border',
				'label'     => __( 'Border', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .info-box p',
				'condition' => [ 'styles' => '12' ],
			]
		);
		$this->start_controls_tabs( 'desc_tab_style' );
			// Normal tab.
			$this->start_controls_tab(
				'desc_style_normal',
				[
					'label' => __( 'Normal', 'clplace-core' ),
				]
			);
			$this->add_control(
				'desc_color',
				[
					'type'    => Controls_Manager::COLOR,
					'label'   => esc_html__( 'Color', 'clplace-core' ),
					'selectors' => array(
						'{{WRAPPER}} .info-box p' => 'color: {{VALUE}}',
						'{{WRAPPER}} .info-box .description-text a' => 'color: {{VALUE}}'
					),
				]
			);
			$this->end_controls_tab();

			// Hover tab.
			$this->start_controls_tab(
				'desc_style_hover',
				[
					'label' => __( 'Hover', 'clplace-core' ),
				]
			);
			$this->add_control(
				'desc_hover_color',
				[
					'type'    => Controls_Manager::COLOR,
					'label'   => esc_html__( 'Color', 'clplace-core' ),
					'selectors' => array(
						'{{WRAPPER}} .info-box:hover p' => 'color: {{VALUE}}',
						'{{WRAPPER}} .info-box:hover .description-text a' => 'color: {{VALUE}}'
					),
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	// Button Style
	protected function __infobox_button_settings_controls() {
		$this->start_controls_section(
			'btn_style',
			[
				'label'     => esc_html__( 'Button', 'clplace-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'infobox_btn_visibility',
			[
				'label'   => __( 'Excerpt Visibility', 'clplace-core' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'visible' => [
						'title' => __( 'Visible', 'clplace-core' ),
						'icon'  => 'eicon-check',
					],
					'hidden'  => [
						'title' => __( 'Hidden', 'clplace-core' ),
						'icon'  => 'eicon-editor-close',
					],
				],
				'toggle'  => false,
				'default' => 'visible',
			]
		);
		$this->add_control(
			'btnicon',
			[
				'type'        => Controls_Manager::ICONS,
				'label'   => esc_html__( 'Link Icon', 'clplace-core' ),
				'default' => array(
					'value' => 'fas fa-smile-wink',
					'library' => 'fa-solid',
				),
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);
		$this->add_control(
			'btntext',
			[
				'type'    => Controls_Manager::TEXT,
				'label'   => esc_html__( 'Link Text', 'clplace-core' ),
				'label_block' => true,
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);
		$this->add_control(
			'url',
			[
				'type'  => Controls_Manager::URL,
				'label' => esc_html__( 'Link Url', 'clplace-core' ),
				'placeholder' => 'https://your-link.com',
				'label_block' => true,
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);
		$this->add_control(
			'btn_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Button Style', 'clplace-core' ),
				'separator' => 'before',
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);

		$this->start_controls_tabs( 'btn_tab_style' );
		// Normal tab.
		$this->start_controls_tab(
			'btn_style_normal',
			[
				'label' => __( 'Normal', 'clplace-core' ),
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'btn_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .item-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .item-btn i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .item-btn svg' => 'color: {{VALUE}}',
				),
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typo',
				'label'    => esc_html__( 'Typography', 'clplace-core' ),
				'selector' => '
					{{WRAPPER}} .item-btn, 
					{{WRAPPER}} .item-btn i, 
					{{WRAPPER}} .item-btn svg
				',
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_bg_color',
				'label'     => __( 'Background', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .item-btn',
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .item-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);
		$this->add_responsive_control(
			'btn_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .btn-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border',
				'label'     => __( 'Border', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .item-btn',
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);
		$this->add_responsive_control(
			'btn_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Border Radius', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .item-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);
		$this->end_controls_tab();

		// Hover tab.
		$this->start_controls_tab(
			'btn_style_hover',
			[
				'label' => __( 'Hover', 'clplace-core' ),
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);
		$this->add_control(
			'btn_h_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .info-box:hover .item-btn' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box:hover .item-btn i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box:hover .item-btn svg' => 'color: {{VALUE}}',
				),
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_hbg_color',
				'label'     => __( 'Background', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .info-box:hover .item-btn',
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_hover_border',
				'label'     => __( 'Border', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .info-box:hover .item-btn',
				'condition' => [
					'infobox_btn_visibility' => 'visible',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	// Infobox Styling
	protected function __infobox_style_settings_controls() {
		// Box Style
		$this->start_controls_section(
			'box_settings',
			[
				'label'     => esc_html__( 'Info Box', 'clplace-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'infobox_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .info-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->add_responsive_control(
			'infobox_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .info-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'infobox_11_bg',
				'label'    => esc_html__( 'Background', 'clplace-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Infobox Background', 'clplace-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .clplace-info-box.clplace-info-box-3::before',
				'conditions' => [
					'terms' => [
						['name' => 'styles', 'operator' => '==', 'value' => 11],
					],
				],
			]
		);
		$this->add_responsive_control(
			'infobox_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .info-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->add_control(
			'info_box_border_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Hover Border Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .info-box:hover' => 'border-color: {{VALUE}}'
				),
			]
		);
		$this->add_responsive_control(
			'dashline_height',
			[
				'label' => esc_html__( 'Dashed Line Height', 'clplace-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .clplace-info-box.clplace-info-box-2:before' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_control(
			'dashed_line_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Dashed Line Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .clplace-info-box.clplace-info-box-2:before' => 'border-color: {{VALUE}}'
				),
			]
		);
		$this->add_control(
			'active_item',
			[
				'label'        => __( 'Active Item', 'clplace-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'clplace-core' ),
				'label_off'    => __( 'No', 'clplace-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'conditions' => [
					'terms' => [
						[ 'name' => 'styles', 'operator' => '==', 'value' => 11 ],
					],
				],
			]
		);

		$this->add_control(
			'infobox_hover_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Hover Style', 'clplace-core' ),
				'separator' => 'before',
				'condition' => [ 'styles' => ['3', '6', '11'] ],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'infobox_11_hover_bg',
				'label'    => esc_html__( 'Background', 'clplace-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Infobox Hover Background', 'clplace-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .clplace-info-box.clplace-info-box-11:hover:before',

				'conditions' => [
					'terms' => [
						['name' => 'styles', 'operator' => '==', 'value' => 11],
					],
				],
			]
		);

		/* = Tab = */
		$this->start_controls_tabs( 'infobox_tab_style' );
			// Normal tab.
			$this->start_controls_tab(
				'infobox_style_normal',
				[
					'label' => __( 'Normal', 'clplace-core' ),
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'infobox_bg',
					'label'    => esc_html__( 'Background', 'clplace-core' ),
					'types' => [ 'classic', 'gradient', 'video' ],
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Infobox Background', 'clplace-core'),
							'default' => 'classic',
						]
					],
					'selector' => '{{WRAPPER}} .info-box',
					'conditions' => [
						'terms' => [
							['name' => 'styles', 'operator' => '!=', 'value' => 11],
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'infobox_border',
					'label'     => __( 'Border', 'clplace-core' ),
					'selector'  => '{{WRAPPER}} .info-box',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'infobox_box_shadow',
					'selector' => '{{WRAPPER}} .info-box',
					'fields_options' =>
						[
							'box_shadow_type' =>
								[
									'default' =>'no'
								],
						]
				]
			);
			$this->end_controls_tab();

			// Hover tab.
			$this->start_controls_tab(
				'infobox_style_hover',
				[
					'label' => __( 'Hover', 'clplace-core' ),
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'infobox_hover_bg',
					'label'    => esc_html__( 'Background', 'clplace-core' ),
					'types' => [ 'classic', 'gradient', 'video' ],
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Infobox Background', 'clplace-core'),
							'default' => 'classic',
						]
					],
					'selector' => '{{WRAPPER}} .info-box:hover',
					'condition' => [ 'styles!' => ['3', '6', '11'] ],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'infobox_hover_bg_3_6_11',
					'label'    => esc_html__( 'Background', 'clplace-core' ),
					'types' => [ 'classic', 'gradient', 'video' ],
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Infobox Background', 'clplace-core'),
							'default' => 'classic',
						]
					],
					'selector' => '{{WRAPPER}} .clplace-info-box.clplace-info-box-3::before',
					'condition' => [ 'styles' => ['3', '6', '11'] ],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'infobox_hover_border',
					'label'     => __( 'Border', 'clplace-core' ),
					'selector'  => '{{WRAPPER}} .info-box:hover',
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'infobox_hover_box_shadow',
					'selector' => '{{WRAPPER}} .info-box:hover',
					'fields_options' =>
						[
							'box_shadow_type' =>
								[
									'default' =>'no'
								],
						]
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';
		$template = 'view-'.$data['styles'];

		Fns::get_template( "elementor/info-box/{$template}", $data );
	}

}