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
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use RT\ClplaceCore\Abstracts\ElementorBase;

if (!defined('ABSPATH')) {
	exit;
}

class PricingTable extends ElementorBase {

	public function __construct($data = [], $args = null) {
		$this->rt_name = esc_html__('Pricing Table', 'clplace-core');
		$this->rt_base = 'rt-pricing-table';
		parent::__construct($data, $args);
	}

	protected function register_controls() {

		$this->__general_settings_controls();
		$this->__title_settings_controls();
		$this->__pricing_settings_controls();
		$this->__subtitle_settings_controls();
		$this->__featured_settings_controls();
		$this->__feature_list_settings_controls();
		$this->__icon_image_settings_controls();
		$this->__button_settings_controls();
		$this->__full_box_settings_controls();
	}

	protected function __general_settings_controls() {
		$this->start_controls_section(
			'rt_pricing_table',
			[
				'label' => esc_html__( 'Pricing Table Settings', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __('Icon Type', 'clplace-core'),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => __('Icon', 'clplace-core'),
					'image' => __('Image', 'clplace-core'),
					'none' => __('None', 'clplace-core'),
				],
			]
		);

		$this->add_control(
			'price_icon',
			[
				'label' => __('Choose Icon', 'clplace-core'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-paper-plane',
					'library' => 'fa-solid',
				],
				'condition' => [
					'icon_type' => ['icon'],
				],
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __('Choose Image', 'clplace-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => ['image'],
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Plan Name', 'clplace-core'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Standard',
				'label_block' => false,
			]
		);

		$this->add_control(
			'is_featured',
			[
				'label' => __('Is Featured ?', 'clplace-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'clplace-core'),
				'label_off' => __('No', 'clplace-core'),
				'return_value' => 'is-featured',
				'default' => false,
			]
		);

		$this->add_control(
			'is_active',
			[
				'label' => __('Is Active ?', 'clplace-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'clplace-core'),
				'label_off' => __('No', 'clplace-core'),
				'return_value' => 'is-active',
				'default' => false,
			]
		);

		$this->add_control(
			'featured_text',
			[
				'label' => esc_html__('Featured Text', 'clplace-core'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Featured',
				'label_block' => false,
				'condition' => [
					'is_featured' => 'is-featured',
				],
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__('Subtitle', 'clplace-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Shen an unknown printer took a galley of type and scrambled',
				'rows' => 3,
			]
		);

		$this->add_control(
			'price',
			[
				'label' => esc_html__('Price', 'clplace-core'),
				'type' => Controls_Manager::TEXT,
				'default' => '$29',
				'label_block' => false,
			]
		);

		$this->add_control(
			'period',
			[
				'label' => esc_html__('Period', 'clplace-core'),
				'type' => Controls_Manager::TEXT,
				'default' => 'month',
				'label_block' => false,
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__('Button Text', 'clplace-core'),
				'type' => Controls_Manager::TEXT,
				'default' => 'Get Started',
				'label_block' => false,
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __('Link', 'clplace-core'),
				'type' => Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'clplace-core'),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);

		$this->add_control(
			'feature_list_title',
			[
				'label' => esc_html__('Feature List Title', 'clplace-core'),
				'type' => Controls_Manager::TEXT,
				'default' => 'What’s included:',
				'label_block' => true,
			]
		);

		// Features
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'faature_title', [
				'label' => __('Feature Title', 'clplace-core'),
				'type' => Controls_Manager::TEXT,
				'default' => __('List Title', 'clplace-core'),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_icon',
			[
				'label' => __('Icon', 'clplace-core'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-check-circle',
					'library' => 'solid',
				],
			]
		);

		$repeater->add_control(
			'list_icon_color',
			[
				'label' => __('Icon Color', 'clplace-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '#53e092',
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper {{CURRENT_ITEM}} svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'list_title_color',
			[
				'label' => __('Title Color', 'clplace-core'),
				'type' => Controls_Manager::COLOR,
				'default' => '#646464',
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper {{CURRENT_ITEM}} .list-item' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __('Feature List', 'clplace-core'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'faature_title' => __('All Listing Access', 'clplace-core'),
						'list_icon' => 'fas fa-check-circle',
						'list_icon_color' => '#53e092',
						'list_title_color' => '#646464',
					],
					[
						'faature_title' => __('Location Wise Map', 'clplace-core'),
						'list_icon' => 'fas fa-check-circle',
						'list_icon_color' => '#53e092',
						'list_title_color' => '#646464',
					],
					[
						'faature_title' => __('Free / Pro Ads', 'clplace-core'),
						'list_icon' => 'fas fa-check-circle',
						'list_icon_color' => '#53e092',
						'list_title_color' => '#646464',
					],
					[
						'faature_title' => __('Custom Map Setup', 'clplace-core'),
						'list_icon' => 'fas fa-check-circle',
						'list_icon_color' => '#53e092',
						'list_title_color' => '#646464',
					],
					[
						'faature_title' => __('Apps Integrated', 'clplace-core'),
						'list_icon' => 'fas fa-check-circle',
						'list_icon_color' => '#53e092',
						'list_title_color' => '#646464',
					],
					[
						'faature_title' => __('Advanced Custom Field', 'clplace-core'),
						'list_icon' => 'fas fa-check-circle',
						'list_icon_color' => '#acb7c3',
						'list_title_color' => '#788593',
					],
					[
						'faature_title' => __('Pro Features', 'clplace-core'),
						'list_icon' => 'fas fa-check-circle',
						'list_icon_color' => '#acb7c3',
						'list_title_color' => '#788593',
					],
				],
				'title_field' => '{{{ faature_title }}}',
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
					'{{WRAPPER}} .rt-pricing-box-wrapper  ' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
	}

	protected function __title_settings_controls() {
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__('Title Settings', 'clplace-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Typography', 'clplace-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .plan-name',
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => __('Title Spacing', 'clplace-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'allowed_dimensions' => 'vertical',
				'selectors' => [
					'{{WRAPPER}} .plan-name-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs('title_style_tabs' );
			$this->start_controls_tab(
				'title_style_normal_tab',
				[
					'label' => __('Normal', 'clplace-core'),
				]
			);

			$this->add_control(
				'title_color',
				[
					'type' => Controls_Manager::COLOR,
					'label' => esc_html__('Color', 'clplace-core'),
					'selectors' => [
						'{{WRAPPER}} .rt-pricing-box-wrapper .plan-name' => 'color: {{VALUE}}',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'title_style_hover_tab',
				[
					'label' => __('Hover', 'clplace-core'),
				]
			);

			$this->add_control(
				'title_hover_color',
				[
					'type' => Controls_Manager::COLOR,
					'label' => esc_html__('Hover Color', 'clplace-core'),
					'selectors' => [
						'{{WRAPPER}} .rt-pricing-box-wrapper:hover .plan-name' => 'color: {{VALUE}}',

					],
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function __pricing_settings_controls() {
		$this->start_controls_section(
			'price_settings',
			[
				'label' => esc_html__('Price Settings', 'clplace-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pricing_heading',
			[
				'label' => __('Pricing Options', 'clplace-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				// 'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => esc_html__('Typography', 'clplace-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .price',
			]
		);

		$this->start_controls_tabs('price_style_tabs');

			$this->start_controls_tab(
				'price_style_normal_tab',
				[
					'label' => __('Normal', 'clplace-core'),
				]
			);
			$this->add_control(
				'price_color',
				[
					'type' => Controls_Manager::COLOR,
					'label' => esc_html__('Price Color', 'clplace-core'),
					'selectors' => [
						'{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .price' => 'color: {{VALUE}}',

					],
				]
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'price_style_hover_tab',
				[
					'label' => __('Hover', 'clplace-core'),
				]
			);
			$this->add_control(
				'price_hover_color',
				[
					'type' => Controls_Manager::COLOR,
					'label' => esc_html__('Price Color Hover', 'clplace-core'),
					'selectors' => [
						'{{WRAPPER}} .rt-pricing-box-wrapper:hover .price-wrap .price' => 'color: {{VALUE}}',

					],
				]
			);
		$this->end_controls_tab();

		/* = Period + */
		$this->end_controls_tabs();
			$this->add_control(
				'period_heading',
				[
					'label' => __('Period Options', 'clplace-core'),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'period_typography',
					'label' => esc_html__('Typography', 'clplace-core'),
					'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .period',
				]
			);
			$this->start_controls_tabs('period_style_tabs');
				$this->start_controls_tab(
					'period_style_normal_tab',
					[
						'label' => __('Normal', 'clplace-core'),
					]
				);
				$this->add_control(
					'period_color',
					[
						'type' => Controls_Manager::COLOR,
						'label' => esc_html__('Period Color', 'clplace-core'),
						'selectors' => [
							'{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .period' => 'color: {{VALUE}}',

						],
					]
				);
				$this->end_controls_tab();

			$this->start_controls_tab(
				'period_style_hover_tab',
				[
					'label' => __('Hover', 'clplace-core'),
				]
			);

			$this->add_control(
				'period_hover_color',
				[
					'type' => Controls_Manager::COLOR,
					'label' => esc_html__('Period Color Hover', 'clplace-core'),
					'selectors' => [
						'{{WRAPPER}} .rt-pricing-box-wrapper:hover .price-wrap .period' => 'color: {{VALUE}}',

					],
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		/* = Separator + */
		$this->add_control(
			'pricing_separator',
			[
				'label' => __('Pricing Separator Options', 'clplace-core'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs('separator_style_tabs');
			$this->start_controls_tab(
				'separator_style_normal_tab',
				[
					'label' => __('Normal', 'clplace-core'),
				]
			);
			$this->add_control(
				'separator_color',
				[
					'type' => Controls_Manager::COLOR,
					'label' => esc_html__('Separator Color', 'clplace-core'),
					'selectors' => [
						'{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .seperator' => 'color: {{VALUE}}',

					],
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'separator_style_hover_tab',
				[
					'label' => __('Hover', 'clplace-core'),
				]
			);
			$this->add_control(
				'separator_color_hover',
				[
					'type' => Controls_Manager::COLOR,
					'label' => esc_html__('Separator Color', 'clplace-core'),
					'selectors' => [
						'{{WRAPPER}} .rt-pricing-box-wrapper:hover .price-wrap .seperator' => 'color: {{VALUE}}',

					],
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'separator_size',
			[
				'label' => __('Separator Size', 'clplace-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .price-wrap .seperator' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function __subtitle_settings_controls() {
		$this->start_controls_section(
			'sub_title_settings',
			[
				'label' => esc_html__('Sub Title Settings', 'clplace-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__('Typography', 'clplace-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .subtitle',
			]
		);

		$this->add_responsive_control(
			'subtitle_list_spacing',
			[
				'label' => __('Spacing', 'clplace-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'allowed_dimensions' => 'vertical',
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'subtitle_style_tabs'
		);

		$this->start_controls_tab(
			'subtitle_style_normal_tab',
			[
				'label' => __('Normal', 'clplace-core'),
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Sub Title Color', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .subtitle' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'subtitle_style_hover_tab',
			[
				'label' => __('Hover', 'clplace-core'),
			]
		);

		$this->add_control(
			'subtitle_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Sub Title Color Hover', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .subtitle' => 'color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function __featured_settings_controls() {
		$this->start_controls_section(
			'is_featured_settings',
			[
				'label' => esc_html__('Feature Badge Settings', 'clplace-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'is_featured' => 'is-featured',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'is_featured_typography',
				'label' => esc_html__('Typography', 'clplace-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .is-featured',
			]
		);

		$this->start_controls_tabs(
			'is_featured_style_tabs'
		);

		$this->start_controls_tab(
			'is_featured_style_normal_tab',
			[
				'label' => __('Normal', 'clplace-core'),
			]
		);

		$this->add_control(
			'is_featured_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .is-featured' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'is_featured_bg_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Backgruond Color', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .is-featured' => 'background-color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'is_featured_style_hover_tab',
			[
				'label' => esc_html__('Hover', 'clplace-core'),
			]
		);

		$this->add_control(
			'is_featured_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color Hover', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .is-featured' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'is_featured_bg_color_hover',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Backgruond Color Hover', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .is-featured' => 'background-color: {{VALUE}}',

				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function __feature_list_settings_controls() {
		$this->start_controls_section(
			'feature_list_settings',
			[
				'label' => esc_html__('Feature List Settings', 'clplace-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'feature_list_typography',
				'label' => esc_html__('Typography', 'clplace-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists',
			]
		);
		$this->add_responsive_control(
			'feature_list_padding',
			[
				'label' => __('Padding', 'clplace-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'feature_list_margin',
			[
				'label' => __('Margin', 'clplace-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'desc_border',
				'label'     => __( 'Border', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists',
			]
		);
		/* = Feature Title = */
		$this->add_control(
			'feature_title_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Feature Title', 'clplace-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'feature_title_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-list-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'feature_title_typography',
				'label' => esc_html__('Typography', 'clplace-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .feature-list-title',
			]
		);
		$this->add_responsive_control(
			'feature_title_margin',
			[
				'label' => __('Spacing', 'clplace-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-list-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		/* = Feature List = */
		$this->add_control(
			'feature_list_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Feature List', 'clplace-core' ),
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'list_icon_size',
			[
				'label' => esc_html__( 'List Icon Size', 'clplace-core' ),
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
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs(
			'feature_list_style_tabs'
		);

		$this->start_controls_tab(
			'feature_list_style_normal_tab',
			[
				'label' => __('Normal', 'clplace-core'),
			]
		);

		$this->add_control(
			'feature_list_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists li .list-item' => 'color: {{VALUE}}',
				],
				'description' => esc_html__('This color will work if you don\'t set color from the list', 'clplace-core'),
			]
		);

		$this->add_control(
			'feature_icon_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('List Icon Color', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper .feature-lists svg path' => 'fill: {{VALUE}}',
				],
				'description' => esc_html__('This color will work if you don\'t set color from the list', 'clplace-core'),
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'feature_list_style_hover_tab',
			[
				'label' => __('Hover', 'clplace-core'),
			]
		);

		$this->add_control(
			'feature_list_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color Hover', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .feature-lists li .list-item' => 'color: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'feature_icon_color_hover',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('List Icon Color Hover', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .feature-lists i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .feature-lists svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function __icon_image_settings_controls() {
		$this->start_controls_section(
			'image_icon_settings',
			[
				'label' => esc_html__('Image / Icon Settings', 'clplace-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Image/Icon Size', 'clplace-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 400,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder img' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],

			]
		);

		$this->add_responsive_control(
			'icon_x_position',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('X Position', 'clplace-core'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder' => 'left: {{SIZE}}{{UNIT}};',
				],

			]
		);

		$this->add_responsive_control(
			'icon_y_position',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Y Position', 'clplace-core'),
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 700,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder' => 'top: {{SIZE}}{{UNIT}};',
				],

			]
		);

		//Start Icon Style Tab
		$this->start_controls_tabs(
			'icon_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'icon_style_normal_tab',
			[
				'label' => __('Normal', 'clplace-core'),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder svg path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'icon_type' => ['icon'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'icon_bg',
				'label'    => esc_html__( 'Background', 'clplace-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'clplace-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder',
			]
		);
		$this->add_responsive_control(
			'icon_opacity',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Image/Icon Opacity', 'clplace-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .icon-holder' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'icon_style_hover_tab',
			[
				'label' => __('Hover', 'clplace-core'),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color Hover', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .icon-holder i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .icon-holder svg path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'icon_type' => ['icon'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'icon_hover_bg',
				'label'    => esc_html__( 'Background', 'clplace-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'clplace-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper:hover .icon-holder',
			]
		);
		$this->add_responsive_control(
			'icon_opacity_hover',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Image/Icon Opacity Hover', 'clplace-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover .icon-holder' => 'Opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		//End Icon Style Tab

		$this->end_controls_section();
	}

	protected function __button_settings_controls() {
		$this->start_controls_section(
			'button_settings',
			[
				'label' => esc_html__('Button Settings', 'clplace-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' => esc_html__('Button Margin', 'clplace-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .button-el' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => esc_html__('Button Border Radius', 'clplace-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .button-el' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => esc_html__('Button Typography', 'clplace-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .button-el',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __('Button Padding', 'clplace-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .button-el' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		//Start button Style Tab
		$this->start_controls_tabs(
			'button_style_tabs'
		);

		//Normal Style
		$this->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => __('Normal', 'clplace-core'),
			]
		);

		$this->add_control(
			'button_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .button-el' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Background', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .button-el' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .button-el',
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
							'color' => 'rgba(0,0,0,0.01'
						]
					]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => __('Border', 'clplace-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .button-el',
			]
		);

		$this->end_controls_tab();

		//Hover Style
		$this->start_controls_tab(
			'button_style_hover_tab',
			[
				'label' => __('Hover', 'clplace-core'),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Color Hover', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .button-el:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_bg_hover',
			[
				'type' => Controls_Manager::COLOR,
				'label' => esc_html__('Background on Hover', 'clplace-core'),
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper .button-el:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow_hover',
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .button-el:hover',
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
							'color' => 'rgba(0,0,0,0.01'
						]
					]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border_hover',
				'label' => __('Border', 'clplace-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper .button-el:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function __full_box_settings_controls() {
		$this->start_controls_section(
			'box_settings',
			[
				'label' => esc_html__('Box Settings', 'clplace-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'box_min_height',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => esc_html__('Box Min Height', 'clplace-core'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1000,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __('Border Radius', 'clplace-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __('Box Padding', 'clplace-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_margin',
			[
				'label' => __('Box Margin', 'clplace-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '30',
					'left' => '',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'box_style_tabs'
		);

		$this->start_controls_tab(
			'box_style_normal_tab',
			[
				'label' => __('Normal', 'clplace-core'),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __('Box Shadow', 'clplace-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg',
				'label' => __('Background', 'clplace-core'),
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'clplace-core' ),
					],
				],
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper::before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __('Border', 'clplace-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper',
			]
		);

		$this->add_control(
			'box_up',
			[
				'label' => __('Translate Y', 'clplace-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper' => 'transform: translateY( {{SIZE}}{{UNIT}} );',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_style_hover_tab',
			[
				'label' => __('Hover', 'clplace-core'),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'label' => __('Box Shadow Hover', 'clplace-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper:hover, {{WRAPPER}} .rt-pricing-box-wrapper.is-active',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'box_bg_hover',
				'label' => __('Background Hover', 'clplace-core'),
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background - Hover', 'clplace-core' ),
					],
				],
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper::after',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border_hover',
				'label' => __('Border Hover', 'clplace-core'),
				'selector' => '{{WRAPPER}} .rt-pricing-box-wrapper:hover',
			]
		);

		$this->add_control(
			'box_up_hover',
			[
				'label' => __('Translate Y on Hover', 'clplace-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .rt-pricing-box-wrapper:hover' => 'transform: translateY( {{SIZE}}{{UNIT}} );',
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

		Fns::get_template( "elementor/pricing-table/$template", $data );
	}
}