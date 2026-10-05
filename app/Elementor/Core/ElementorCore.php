<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\ClplaceCore\Elementor\Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

use RT\ClplaceCore\Traits\SingletonTraits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class ElementorCore {
	use SingletonTraits;

	public function __construct() {
		add_action( 'elementor/element/before_section_end', [ $this, 'clplace_elementor_widget_extend' ], 10, 3 );
		add_action( 'elementor/widget/before_render_content', [ $this, 'clplace_elementor_extend_widget_render' ] );

		add_action( 'elementor/frontend/section/before_render', [ $this, 'render_elementor_section_parallax_background' ] );
		add_action( 'elementor/element/section/section_background/before_section_end', [ $this, 'add_elementor_section_background_controls' ] );
		add_action( 'elementor/element/container/section_background/before_section_end', [ $this, 'add_elementor_container_background_controls' ], 10, 2 );

		/* = Counter = */
		add_action( 'elementor/element/counter/section_counter/after_section_start', [ $this, 'custom_counter_control' ], 10, 2 );
		add_action( 'elementor/element/counter/section_title/after_section_start', [ $this, 'custom_counter_title_control' ], 10, 2 );

		/* = Accordion = */
		add_action( 'elementor/element/accordion/section_title_style/after_section_start', [ $this, 'accordion_full_items_control' ], 10, 2 );
		add_action( 'elementor/element/accordion/section_toggle_style_title/before_section_end', [ $this, 'accordion_title_control' ], 10, 2 );
		add_action( 'elementor/element/accordion/section_toggle_style_icon/before_section_end', [ $this, 'accordion_icon_control' ], 10, 2 );
		add_action( 'elementor/element/accordion/section_toggle_style_content/before_section_end', [ $this, 'accordion_content_control' ], 10, 2 );

		/* = Button = */
		add_action( 'elementor/element/button/section_style/after_section_start', [ $this, 'custom_button_control' ], 10, 2 );

		/* = Testimonial = */
		add_action( 'elementor/element/testimonial/section_testimonial/before_section_end', [ $this, 'custom_testimonial_control' ], 10, 2 );

		/* = Social Icon = */
		add_action( 'elementor/element/social-icons/section_social_icon/after_section_start', [ $this, 'social_icons_content_control' ], 10, 2 );

		add_filter( 'rtcl_el_widgets_fields/rtcl-listing-single-location', [ $this, 'single_location_settings_new_fields'], 10, 2 );

	}

	public function get_bg_controlls( $element ) {
		$element->add_control(
			'rt_container_parallax',
			[
				'label'        => __( 'Parallax', 'clplace-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_off'    => __( 'Off', 'clplace-core' ),
				'label_on'     => __( 'On', 'clplace-core' ),
				'default'      => 'no',
				'prefix_class' => 'rt-parallax-bg-',
			]
		);

		$element->add_control(
			'rt_parallax_speed',
			[
				'label'     => __( 'Speed', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0.1,
				'max'       => 5,
				'step'      => 0.1,
				'default'   => 0.5,
				'condition' => [
					'rt_container_parallax' => 'yes',
				],
			]
		);

		$element->add_control(
			'rt_parallax_transition',
			[
				'label'        => __( 'Parallax Transition off?', 'clplace-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_off'    => __( 'on', 'clplace-core' ),
				'label_on'     => __( 'Off', 'clplace-core' ),
				'default'      => 'off',
				'return_value' => 'off',
				'prefix_class' => 'rt-parallax-transition-',
				'condition'    => [
					'rt_container_parallax' => 'yes',
				],
			]
		);
	}

	function add_elementor_container_background_controls( $element ) {
		// Ensure it's the correct element type
		if ( 'container' === $element->get_name() ) {
			$this->get_bg_controlls( $element );
		}
	}

	function add_elementor_section_background_controls( \Elementor\Element_Section $section ) {
		$this->get_bg_controlls( $section );
	}

	// Render section background parallax
	function render_elementor_section_parallax_background( \Elementor\Element_Base $element ) {
		if ( 'section' === $element->get_name() ) {
			if ( 'yes' === $element->get_settings_for_display( 'rt_section_parallax' ) ) {
				$rt_background = $element->get_settings_for_display( 'background_image' );
				if ( ! isset( $rt_background ) ) {
					return;
				}
				$rt_background_URL = $rt_background['url'];
				$data_speed        = $element->get_settings_for_display( 'rt_parallax_speed' );

				$element->add_render_attribute( '_wrapper', [
					'data-speed'    => $data_speed,
					'data-bg-image' => $rt_background_URL,
				] );
			}
		}
	}

	function custom_testimonial_control( $button, $args ) {

		$button->add_control( 'custom_testimonial_author_position',
			[
				'label'        => __( 'Author Position', 'clplace-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'footer',
				'options'      => [
					'footer' => __( 'Footer', 'clplace-core' ),
					'header' => __( 'Header', 'clplace-core' ),
				],
				'prefix_class' => 'elementor-testimonial-author-pos-',
			]
		);
		$button->add_control( 'custom_testimonial_author_alignment',
			[
				'label'     => __( 'Author Alignment', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => [
					'default' => __( 'Default', 'clplace-core' ),
					'left'    => __( 'Left', 'clplace-core' ),
					'center'  => __( 'Center', 'clplace-core' ),
					'right'   => __( 'right', 'clplace-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial-wrapper .elementor-testimonial-meta' => 'text-align: {{VALUE}};',
				],
			]
		);

		$button->add_control( 'custom_testimonial_quote_visibility',
			[
				'label'        => __( 'Quote Icon Visibility', 'clplace-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'disable',
				'options'      => [
					'enable'        => __( 'Enable', 'clplace-core' ),
					'disable'       => __( 'Disable', 'clplace-core' ),
				],
				'prefix_class' => 'elementor-testimonial-quote-',
				'separator'    => 'before',
			]
		);

		$button->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'           => 'testimonial_quote_image',
				'label'          => __( 'Choose Quote Image', 'clplace-core' ),
				'types'          => [ 'classic'],
				'fields_options' => [
					'background' => [
						'default' => 'classic',
						'label'   => esc_html__( 'Choose Quote Image', 'clplace-core' ),
					],
				],
				'exclude'        => [ 'color' ],
				'condition' => [
					'custom_testimonial_quote_visibility' => 'enable',
				],
				'selector'       => '{{WRAPPER}} .elementor-testimonial-wrapper',
			]
		);

		$button->add_control( 'custom_testimonial_control',
			[
				'label'        => __( 'Start Visibility', 'clplace-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'disable',
				'options'      => [
					'enable'        => __( 'Enable to Header', 'clplace-core' ),
					'enable-footer' => __( 'Enable to Footer', 'clplace-core' ),
					'disable'       => __( 'Disable', 'clplace-core' ),
				],
				'prefix_class' => 'elementor-testimonial-star-',
				'separator'    => 'before',
			]
		);

		$button->add_control( 'custom_testimonial_alignment',
			[
				'label'     => __( 'Start Alignment', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => [
					'left'   => __( 'Left', 'clplace-core' ),
					'center' => __( 'Center', 'clplace-core' ),
					'right'  => __( 'Right', 'clplace-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial-wrapper::before' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'custom_testimonial_control!' => 'disable',
				],
			]
		);

		$button->add_control(
			'custom_testimonial_color',
			[
				'label'     => __( 'Star Color', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-testimonial-wrapper::before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'custom_testimonial_control!' => 'disable',
				],
			]
		);

		$button->add_control(
			'custom_testimonial_size',
			[
				'label'      => __( 'Star Size', 'clplace-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-testimonial-wrapper::before' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-testimonial-wrapper'         => 'padding-top: calc({{SIZE}}{{UNIT}} / 4);',
				],
				'condition'  => [
					'custom_testimonial_control!' => 'disable',
				],
			]
		);

		$button->add_control(
			'testimonial_box_heading',
			[
				'label'     => __( 'Box Settings', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$button->add_responsive_control(
			'custom_testimonial_max_width',
			[
				'label'      => __( 'Box Size', 'clplace-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 200,
						'max'  => 1200,
						'step' => 10,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}' => 'max-width: {{SIZE}}{{UNIT}}; width:100%;',
				],
			]
		);

		$button->add_control( 'custom_testimonial_wrap_alignment',
			[
				'label'        => __( 'Box Alignment', 'clplace-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'center',
				'options'      => [
					'left'     => __( 'Left', 'clplace-core' ),
					'center'   => __( 'Center', 'clplace-core' ),
					'right'    => __( 'Right', 'clplace-core' ),
					'absolute' => __( 'Absolute Center', 'clplace-core' ),
				],
				'prefix_class' => 'rt-testimonial-',
			]
		);

		$button->add_control(
			'custom_testimonial_absolute_y_pos',
			[
				'label'      => __( 'Box Vertical Position', 'clplace-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}.rt-testimonial-absolute' => 'bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'custom_testimonial_wrap_alignment' => 'absolute',
				],
			]
		);

		$button->add_responsive_control(
			'custom_testimonial_padding',
			[
				'label'      => __( 'Content Padding', 'clplace-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-testimonial-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'custom_testimonial_control!' => 'disable',
				],
			]
		);
	}

	function custom_button_control( $button, $args ) {
		$button->add_control( 'animation_btn_enable',
			[
				'label'        => __( 'Animation Button', 'clplace-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'enable',
				'options'      => [
					'enable'  => __( 'Enable', 'clplace-core' ),
					'disable' => __( 'Disable', 'clplace-core' ),
				],
				'prefix_class' => 'elementor-button-animation-',
			]
		);

		$button->add_control(
			'button_animation_color',
			[
				'label'     => __( 'Hover Animation Color', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-button::after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'animation_btn_enable' => 'enable',
				],
			]
		);
	}

	function custom_counter_control( $counter, $args ) {
		$counter->add_control( 'counter_style',
			[
				'label'        => __( 'Counter Style', 'clplace-core' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'default-style',
				'options'      => [
					'default-style' => __( 'Default', 'clplace-core' ),
					'circle-style'  => __( 'Circle BG', 'clplace-core' ),
				],
				'prefix_class' => 'elementor-counter-',
			]
		);

		$counter->add_control(
			'bg_width',
			[
				'label'      => __( 'BG Width', 'clplace-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 170,
						'max'  => 300,
						'step' => 5,
					],
				],
				'condition'  => [
					'counter_style' => 'circle-style',
				],
				'selectors'  => [
					'{{WRAPPER}} .elementor-counter::after'           => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .elementor-counter::before'          => 'width: calc({{SIZE}}px + 42px); height: calc({{SIZE}}px + 42px)',
					'{{WRAPPER}} .elementor-widget-container::before' => 'width: calc({{SIZE}}px + 84px); height: calc({{SIZE}}px + 84px)',
				],
			]
		);

		$counter->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'background',
				'label'     => __( 'Background', 'clplace-core' ),
				'types'     => [ 'gradient' ],
				'selector'  => '{{WRAPPER}} .elementor-widget-container::before, {{WRAPPER}} .elementor-counter::before, {{WRAPPER}} .elementor-counter::after',
				'condition' => [
					'counter_style' => 'circle-style',
				],
			]
		);

		$counter->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'clplace-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start;text-align:left;' => [
						'title' => __( 'Left', 'clplace-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center;text-align:center;'   => [
						'title' => __( 'Center', 'clplace-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end;text-align:right;'  => [
						'title' => __( 'Right', 'clplace-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-counter .elementor-counter-number-prefix, {{WRAPPER}} .elementor-counter .elementor-counter-number-suffix' => 'flex-grow: inherit;',
					'{{WRAPPER}} .elementor-counter' => 'align-items: {{VALUE}};',
				],
				'condition' => [
					'counter_style' => 'default-style',
				],
			]
		);
	}

	function custom_counter_title_control( $counter, $args ) {
		$counter->add_control( 'counter_title_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'        => __( 'Margin', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .elementor-counter .elementor-counter-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
	}

	/**
	 * Accordion Full Items
	 * @param $accordion
	 * @param $args
	 *
	 * @return void
	 */
	function accordion_full_items_control( $accordion, $args ) {
		$accordion->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'accordion_items_border',
				'label'     => esc_html__( 'Border', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .elementor-accordion .elementor-accordion-item',
			]
		);
		$accordion->add_responsive_control( 'accordion_items_gap',
			[
				'label' => esc_html__( 'Gap', 'clplace-core' ),
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
					'{{WRAPPER}} .elementor-accordion' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$accordion->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'accordion_items_shadow',
				'selector' => '{{WRAPPER}} .elementor-accordion .elementor-accordion-item',
				'fields_options' =>
					[
						'box_shadow_type' =>
							[
								'default' =>'no'
							],
					]
			]
		);
		$accordion->add_responsive_control( 'accordion_items_border_radius',
			[
				'label' => __('Border Radius', 'clplace-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion .elementor-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
	}

	/**
	 * Accordion Title
	 * @param $accordion
	 * @param $args
	 *
	 * @return void
	 */
	function accordion_title_control( $accordion, $args ) {
		$accordion->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'clplace-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	/**
	 * Accordion Title
	 * @param $accordion
	 * @param $args
	 *
	 * @return void
	 */
	function accordion_icon_control( $accordion, $args ) {
		$accordion->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__( 'Margin', 'clplace-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$accordion->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'clplace-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 1,
					],
					'rem' => [
						'max' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-accordion-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
	}


	/**
	 * Accordion Content
	 * @param $accordion
	 * @param $args
	 *
	 * @return void
	 */
	function accordion_content_control( $accordion, $args ) {
		$accordion->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'clplace-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}


	/**
	 * Accordion Content
	 * @param $accordion
	 * @param $args
	 *
	 * @return void
	 */
	function social_icons_content_control( $repeater, $args ) {

		$repeater->add_control(
			'item_icon_primary_hover_color',
			[
				'label' => esc_html__( 'Primary Hover Color', 'clplace-core' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'item_icon_color' => 'custom',
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.elementor-social-icon:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

	}

	public function single_location_settings_new_fields( $fields, $obj ){

		if( 'rtcl-listing-single-location' == $obj->rtcl_base ){
			$listing_single_new_control = array(
				array(
					'id'      => 'count_text',
					'type'    => Controls_Manager::TEXT,
					'label'   => esc_html__( ' Count Text', 'clplace-core' ),
					'condition'   => [ 'rtcl_location_style' => 'style-3' ],
					'label_block' => true,
					'description' => esc_html__( 'Listing Count Text', 'clplace-core' ),
				),
				array(
					'id'      => 'custom_animation',
					'type'    => Controls_Manager::SELECT,
					'label'   => __( 'Theme Custom Animation', 'clplace-core' ),
					'options' => array(
						'none'    => __( 'None', 'clplace-core' ),
						'animation-scale-x' => __( 'animation scale x', 'clplace-core' ),
						'animation-scale-y' => __( 'animation scale Y', 'clplace-core' ),
					),
					'default' => 'none',
				),
				array(
					'id'      => 'custom_animation_delay',
					'type'    => Controls_Manager::SELECT,
					'label'   => __( 'Theme Custom Animation Delay', 'clplace-core' ),
					'options' => array(
						'0ms'    => __( '0ms', 'clplace-core' ),
						'100ms' => __( '100ms', 'clplace-core' ),
						'200ms' => __( '200ms', 'clplace-core' ),
						'300ms' => __( '300ms', 'clplace-core' ),
						'400ms' => __( '400ms', 'clplace-core' ),
						'500ms' => __( '500ms', 'clplace-core' ),
						'600ms' => __( '600ms', 'clplace-core' ),
						'700ms' => __( '700ms', 'clplace-core' ),
						'800ms' => __( '800ms', 'clplace-core' ),
						'900ms' => __( '900ms', 'clplace-core' ),
						'1000ms' => __( '1000ms', 'clplace-core' ),
						'1100ms' => __( '1100ms', 'clplace-core' ),
						'1200ms' => __( '1200ms', 'clplace-core' ),
						'1300ms' => __( '1300ms', 'clplace-core' ),
						'1400ms' => __( '1400ms', 'clplace-core' ),
						'1500ms' => __( '1500ms', 'clplace-core' ),
						'1600ms' => __( '1600ms', 'clplace-core' ),
					),
					'default' => '0ms',
				),
			);
			$fields = $obj->insert_new_controls( 'enable_link', $listing_single_new_control, $fields );
		}
		return $fields;
	}

	public function clplace_elementor_widget_extend( $section, $section_id, $args ) {
		/**
		 * Extend Image Carousel
		 */
		/*
		if ( 'image-carousel' === $section->get_name() && $section_id == 'section_counter' ) {
			$section->add_control(
				'counter_style',
				[
					'label'   => esc_html__( 'Counter', 'clplace-core' ),
					'type'    => \Elementor\Controls_Manager::SELECT,
					'default' => 'default-style',
					'options' => [
						'default-style' => __( 'Default', 'clplace-core' ),
						'circle-style'  => __( 'Circle BG', 'clplace-core' ),
					],

				]
			);
		}
		*/
	}

	/**
	 * render custom control output
	 *
	 */
	public function clplace_elementor_extend_widget_render( $widget ) {
		/**
		 * Adding a new attribute to our button
		 *
		 * @param \Elementor\Widget_Base $button
		 */
		/*
		if ( 'image-carousel' === $widget->get_name() ) {
			// Get the settings
			$settings = $widget->get_settings();
			// Adding our type as a class to the button
			if ( $settings['nav_style'] ) {
				$widget->add_render_attribute( 'carousel-wrapper',
					[
						'class' => $settings['nav_style'],
					], true );
			}
		}
		*/
	}

}