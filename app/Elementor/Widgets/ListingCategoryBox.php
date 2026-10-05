<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\ClplaceCore\Elementor\Widgets;

use Elementor\Group_Control_Border;
use Elementor\Utils;
use Elementor\Controls_Manager;
use RT\ClplaceCore\Helper\Fns;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use RT\ClplaceCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ListingCategoryBox extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Listing Category Box', 'clplace-core' );
		$this->rt_base = 'rt-listing-category-box';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		/* -- Settings Options -- */
		$this->__options_settings_controls();
		$this->__visibility_settings_controls();

		/* -- Style -- */
		$this->__common_style_settings_controls();
		$this->__icon_style_settings_controls();
		$this->__title_style_settings_controls();
		$this->__count_style_settings_controls();
		$this->__desc_style_settings_controls();
		$this->__button_style_settings_controls();
	}

	protected function __options_settings_controls() {
		$category_dropdown = $this->taxonomy_list( 'all', 'rtcl_category' );
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
				'label'   => esc_html__( 'Layout', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( 'Layout 01', 'clplace-core' ),
					'2' => esc_html__( 'Layout 02', 'clplace-core' ),
					'3' => esc_html__( 'Layout 03', 'clplace-core' ),
				],
			]
		);

		$this->add_control(
			'category',
			[
				'label'       => esc_html__( 'Select Category', 'clplace-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options' => $category_dropdown,
				'multiple' => false,
				'label_block' => true,
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'clplace-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label'       => __( 'Icon Type', 'clplace-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options' => array(
					'icon' => esc_html__( 'Icon', 'clplace-core' ),
					'image' => esc_html__( 'Image', 'clplace-core' ),
				),
				'default' => 'icon',
				'multiple' => false,
				'label_block' => true,
			]
		);

		$this->add_control(
			'counter_label',
			[
				'label'       => esc_html__( 'Count label', 'clplace-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Listing Ads', 'clplace-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'cats_desc',
			[
				'label'       => esc_html__( 'Description', 'clplace-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'condition' => [ 'layout' =>'3'],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding', 'clplace-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .category-box .category-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
				'default' => 'center',
				'toggle' => true,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .category-box .category-box-content' => 'align-items: {{VALUE}};',
					'{{WRAPPER}} .category-box .category-box-content .content-bottom' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_switch',
			[
				'label'        => __( 'Button', 'clplace-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'clplace-core' ),
				'label_off'    => __( 'No', 'clplace-core' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [ 'layout' => [ '1', '3' ] ],
			]
		);
		$this->end_controls_section();
	}

	protected function __visibility_settings_controls() {
		//Visibility setting
		$this->start_controls_section(
			'section_option',
			[
				'label' => __( 'Visibility', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_display',
			[
				'label'        => __( 'Icon Display', 'clplace-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clplace-core' ),
				'label_off'    => __( 'Hide', 'clplace-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'count_display',
			[
				'label'        => __( 'Count Display', 'clplace-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clplace-core' ),
				'label_off'    => __( 'Hide', 'clplace-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->end_controls_section();
	}

	protected function __icon_style_settings_controls() {
		//Content setting
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'icon_box_size',
			[
				'label' => esc_html__( 'Icon Box Size', 'clplace-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .category-box .category-box-content .category-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .category-box .category-box-content .category-icon .rtcl-cat-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .category-box .category-box-content .category-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .category-box .category-box-content .category-icon img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_box_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'padding', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .category-box .category-box-content .category-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->add_responsive_control(
			'icon_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .category-box .category-box-content .category-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->start_controls_tabs( 'icon_tab_style' );
			// Normal tab.
			$this->start_controls_tab(
				'icon_normal',
				[
					'label' => esc_html__( 'Normal', 'clplace-core' ),
				]
			);
			$this->add_control(
				'icon_color',
				[
					'type'      => Controls_Manager::COLOR,
					'label'     => esc_html__( 'Icon Color', 'clplace-core' ),
					'selectors' => [
						'{{WRAPPER}} .category-box .category-box-content .category-icon .rtcl-cat-icon' => 'color: {{VALUE}}',
					],
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
							'label' => esc_html__('Background', 'clplace-core'),
							'default' => 'classic',
						]
					],
					'selector' => '{{WRAPPER}} .category-box .category-box-content .category-icon',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'icon_box_border',
					'label'     => __( 'Border', 'clplace-core' ),
					'selector'  => '{{WRAPPER}} .category-box .category-box-content .category-icon',
				]
			);
			$this->add_responsive_control(
				'icon_box_radius',
				[
					'type'    => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'label'   => esc_html__( 'Icon Box Border Radius', 'clplace-core' ),
					'selectors' => array(
						'{{WRAPPER}} .category-box .category-box-content .category-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					),
				]
			);
			$this->end_controls_tab();

			// Hover tab.
			$this->start_controls_tab(
				'icon_hover',
				[
					'label' => esc_html__( 'Hover', 'clplace-core' ),
				]
			);
			$this->add_control(
				'icon_hover_color',
				[
					'type'      => Controls_Manager::COLOR,
					'label'     => esc_html__( 'Icon Color', 'clplace-core' ),
					'selectors' => [
						'{{WRAPPER}} .category-box:hover .category-box-content .category-icon .rtcl-cat-icon' => 'color: {{VALUE}}',
					],
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
							'label' => esc_html__('Background', 'clplace-core'),
							'default' => 'classic',
						]
					],
					'selector' => '{{WRAPPER}} .category-box:hover .category-box-content .category-icon',
				]
			);
			$this->add_responsive_control(
				'icon_box_h_radius',
				[
					'type'    => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'label'   => esc_html__( 'Icon Box Border Radius', 'clplace-core' ),
					'selectors' => array(
						'{{WRAPPER}} .category-box:hover .category-box-content .category-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					),
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function __title_style_settings_controls() {
		//Content setting
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Title Typo', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .category-box .category-box-content .listing-category a',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .category-box .category-box-content .listing-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->start_controls_tabs( 'title_tab_style' );
			// Normal tab.
			$this->start_controls_tab(
				'title_normal',
				[
					'label' => esc_html__( 'Normal', 'clplace-core' ),
				]
			);
			$this->add_control(
				'title_color',
				[
					'type'      => Controls_Manager::COLOR,
					'label'     => esc_html__( 'Title Color', 'clplace-core' ),
					'selectors' => [
						'{{WRAPPER}} .category-box .category-box-content .listing-category a' => 'color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_tab();

			// Hover tab.
			$this->start_controls_tab(
				'title_hover',
				[
					'label' => esc_html__( 'Hover', 'clplace-core' ),
				]
			);
			$this->add_control(
				'title_hover_color',
				[
					'type'      => Controls_Manager::COLOR,
					'label'     => esc_html__( 'Title Color', 'clplace-core' ),
					'selectors' => [
						'{{WRAPPER}} .layout-1 .category-box .category-box-content .listing-category a:hover' => 'color: {{VALUE}}',
						'{{WRAPPER}} .layout-2 .category-box:hover .category-box-content .listing-category a' => 'color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function __count_style_settings_controls() {
		//Content setting
		$this->start_controls_section(
			'count_style',
			[
				'label' => esc_html__( 'Count Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'count_typo',
				'label'    => esc_html__( 'Count Typo', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .category-box .category-box-content .listing-count',
			]
		);

		$this->start_controls_tabs( 'count_tab_style' );
			// Normal tab.
			$this->start_controls_tab(
				'count_normal',
				[
					'label' => esc_html__( 'Normal', 'clplace-core' ),
				]
			);
			$this->add_control(
				'count_color',
				[
					'type'      => Controls_Manager::COLOR,
					'label'     => esc_html__( 'Count Color', 'clplace-core' ),
					'selectors' => [
						'{{WRAPPER}} .category-box .category-box-content .listing-count' => 'color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_tab();

			// Hover tab.
			$this->start_controls_tab(
				'count_hover',
				[
					'label' => esc_html__( 'Hover', 'clplace-core' ),
				]
			);
			$this->add_control(
				'count_hover_color',
				[
					'type'      => Controls_Manager::COLOR,
					'label'     => esc_html__( 'Count Hover Color', 'clplace-core' ),
					'selectors' => [
						'{{WRAPPER}} .category-box:hover .category-box-content .listing-count' => 'color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function __desc_style_settings_controls() {
		//Content setting
		$this->start_controls_section(
			'desc_style',
			[
				'label' => esc_html__( 'Description Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typo',
				'label'    => esc_html__( 'Count Typo', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .category-box .category-box-content .content-bottom .desc',
				'condition' => [ 'layout' =>'3'],

			]
		);
		$this->add_responsive_control(
			'desc_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .category-box .category-box-content .content-bottom .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->start_controls_tabs( 'desc_tab_style' );
			// Normal tab.
			$this->start_controls_tab(
				'desc_normal',
				[
					'label' => esc_html__( 'Normal', 'clplace-core' ),
				]
			);

			$this->add_control(
				'desc_color',
				[
					'type'      => Controls_Manager::COLOR,
					'label'     => esc_html__( 'Count Color', 'clplace-core' ),
					'selectors' => [
						'{{WRAPPER}} .category-box .category-box-content .content-bottom .desc' => 'color: {{VALUE}}',
					],
					'condition' => [ 'layout' =>'3'],
				]
			);
			$this->end_controls_tab();

			// Hover tab.
			$this->start_controls_tab(
				'desc_hover',
				[
					'label' => esc_html__( 'Hover', 'clplace-core' ),
				]
			);
			$this->add_control(
				'desc_hover_color',
				[
					'type'      => Controls_Manager::COLOR,
					'label'     => esc_html__( 'Description Hover Color', 'clplace-core' ),
					'selectors' => [
						'{{WRAPPER}} .category-box:hover .category-box-content .content-bottom .desc' => 'color: {{VALUE}}',
					],
				]
			);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function __button_style_settings_controls() {
		//Content setting
		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__( 'Button Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typo',
				'label'    => esc_html__( 'Typography', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .category-box .category-box-content .button-link',
			]
		);
		$this->add_responsive_control(
			'button_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Border Radius', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .category-box .category-box-content .button-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->add_responsive_control(
			'button_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .category-box .category-box-content .button-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->start_controls_tabs( 'button_tab_style' );
			// Normal tab.
			$this->start_controls_tab(
				'button_normal',
				[
					'label' => esc_html__( 'Normal', 'clplace-core' ),
				]
			);
			$this->add_control(
				'button_color',
				[
					'type'      => Controls_Manager::COLOR,
					'label'     => esc_html__( 'Color', 'clplace-core' ),
					'selectors' => [
						'{{WRAPPER}} .category-box .category-box-content .button-link' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'button_bg',
					'label'    => esc_html__( 'Background', 'clplace-core' ),
					'types' => [ 'classic', 'gradient', 'video' ],
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Background', 'clplace-core'),
							'default' => 'classic',
						]
					],
					'selector' => '{{WRAPPER}} .category-box .category-box-content .button-link',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'button_border',
					'label'     => __( 'Border', 'clplace-core' ),
					'selector'  => '{{WRAPPER}} .category-box .category-box-content .button-link',
				]
			);
			$this->end_controls_tab();

			// Hover tab.
			$this->start_controls_tab(
				'button_hover',
				[
					'label' => esc_html__( 'Hover', 'clplace-core' ),
				]
			);
			$this->add_control(
				'button_hover_color',
				[
					'type'      => Controls_Manager::COLOR,
					'label'     => esc_html__( 'Color', 'clplace-core' ),
					'selectors' => [
						'{{WRAPPER}} .category-box .category-box-content .button-link:hover' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'button_hover_bg',
					'label'    => esc_html__( 'Background', 'clplace-core' ),
					'types' => [ 'classic', 'gradient', 'video' ],
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Background', 'clplace-core'),
							'default' => 'classic',
						]
					],
					'selector' => '{{WRAPPER}} .category-box .category-box-content .button-link:hover',
				]
			);
			$this->add_control(
				'button_hover_border_color',
				[
					'type'      => Controls_Manager::COLOR,
					'label'     => esc_html__( 'Border Color', 'clplace-core' ),
					'selectors' => [
						'{{WRAPPER}} .category-box .category-box-content .button-link:hover' => 'border-color: {{VALUE}}',
					],
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function __common_style_settings_controls() {
		//Content setting
		$this->start_controls_section(
			'common_style',
			[
				'label' => esc_html__( 'Common Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'full_box_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .category-box .category-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->start_controls_tabs( 'common_tab_style' );
			// Normal tab.
			$this->start_controls_tab(
				'common_normal',
				[
					'label' => esc_html__( 'Normal', 'clplace-core' ),
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'full_box_bg',
					'label'    => esc_html__( 'Background', 'clplace-core' ),
					'types' => [ 'classic', 'gradient', 'video' ],
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Background', 'clplace-core'),
							'default' => 'classic',
						]
					],
					'selector' => '{{WRAPPER}} .category-box',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'full_box_border',
					'label'     => __( 'Border', 'clplace-core' ),
					'selector'  => '{{WRAPPER}} .category-box',
				]
			);
			$this->add_responsive_control(
				'full_box_border_radius',
				[
					'type'    => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'label'   => esc_html__( 'Border Radius', 'clplace-core' ),
					'selectors' => array(
						'{{WRAPPER}} .category-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					),
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'full_box_boxshadow',
					'selector' => '{{WRAPPER}} .category-box',
					'fields_options' => [
						'box_shadow_type' => [
							'default' =>''
						],
						'box_shadow' => [
							'default' => [
								'horizontal' => 0,
								'vertical' => 0,
								'blur' => 50,
								'spread' => 0,
								'color' => 'rgba(0,0,0,0.05'
							]
						]
					]
				]
			);
			$this->end_controls_tab();

			// Hover tab.
			$this->start_controls_tab(
				'common_hover',
				[
					'label' => esc_html__( 'Hover', 'clplace-core' ),
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name'     => 'full_box_hover_bg',
					'label'    => esc_html__( 'Background', 'clplace-core' ),
					'types' => [ 'classic', 'gradient', 'video' ],
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Background', 'clplace-core'),
							'default' => 'classic',
						]
					],
					'selector' => '{{WRAPPER}} .category-box:hover',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'full_box_hover_border',
					'label'     => __( 'Border', 'clplace-core' ),
					'selector'  => '{{WRAPPER}} .category-box:hover',
				]
			);
			$this->add_responsive_control(
				'full_box_hover_border_radius',
				[
					'type'    => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'label'   => esc_html__( 'Border Radius', 'clplace-core' ),
					'selectors' => array(
						'{{WRAPPER}} .category-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					),
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'full_box_hover_boxshadow',
					'selector' => '{{WRAPPER}} .category-box:hover',
					'fields_options' =>
						[
							'box_shadow_type' =>
								[
									'default' =>''
								],
							'box_shadow' => [
								'default' =>
									[
										'horizontal' => 0,
										'vertical' => 0,
										'blur' => 50,
										'spread' => 0,
										'color' => 'rgba(0,0,0,0.3)'
									]
							]
						]
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-'.$data['layout'];

		$term = get_term( $data['category'], 'rtcl_category' );
		if ( $term && ! is_wp_error( $term ) ) {
			$data['term_id']   = $term->term_id;
			$data['title']     = $term->name;
			$data['count']     = $term->count;
			$data['permalink'] = get_term_link( $term );
		} else {
			$data['term_id']    = '';
			$data['title']      = __( 'Please Select a Category', 'clplace-core' );
			$data['count']      = 0;
			$data['permalink']  = '#';
		}

		Fns::get_template( "elementor/listing-category-box/$template", $data );
	}

}