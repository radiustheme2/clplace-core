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
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use RT\ClplaceCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ListingLocationsSlider extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Listing Locations Slider', 'clplace-core' );
		$this->rt_base = 'rt-listing-locations-slider';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		/* -- Settings Options -- */
		$this->__options_settings_controls();
		$this->__visibility_settings_controls();

		/* -- Style -- */
		$this->__content_style_settings_controls();
		$this->__slider_style_settings_controls();
		$this->__slider_options_settings_controls();
		$this->__slider_responsive_settings_controls();
	}

	protected function __options_settings_controls() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'clplace-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'listing_loc_id',
			[
				'label'       => __( 'Select Location', 'clplace-core' ),
				'type'        => Controls_Manager::SELECT2,
				'options' => $this->listing_terms_slug('rtcl_location'),
				'multiple' => false,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'counter_label',
			[
				'label'       => esc_html__( 'Count label', 'clplace-core' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Listing Ads', 'clplace-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Layout', 'clplace-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1' => __( 'Layout 01', 'clplace-core' ),
					'layout-2' => __( 'Layout 02', 'clplace-core' ),
				],
			]
		);

		$this->add_control(
			'items',
			[
				'label'       => __( 'Locations List', 'clplace-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ listing_loc_id }}}',
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding', 'clplace-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .location-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .location-box' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
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
				'type'         => \Elementor\Controls_Manager::SWITCHER,
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
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clplace-core' ),
				'label_off'    => __( 'Hide', 'clplace-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->end_controls_section();
	}

	protected function __content_style_settings_controls() {
		//Content setting
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Title Typo', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .location-box .location-box-content .listing-location a',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label'              => __( 'Title Margin', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '30',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .location-box .location-box-content .listing-location' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'count_typo',
				'label'    => esc_html__( 'Count Label Typo', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .location-box .location-box-content .listing-count',
			]
		);
		$this->add_responsive_control(
			'count_margin',
			[
				'label'              => __( 'Count Label Margin', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '30',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .location-box .location-box-content .listing-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->start_controls_tabs( 'iconbox_tab_style' );
		// Normal tab.
		$this->start_controls_tab(
			'style_normal',
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
					'{{WRAPPER}} .location-box .location-box-content .listing-location a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'count_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Count Label Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .location-box .location-box-content .listing-count' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		// Hover tab.
		$this->start_controls_tab(
			'style_hover',
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
					'{{WRAPPER}} .location-box .location-box-content .listing-location a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'count_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Count Label Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .location-box:hover .location-box-content .listing-count' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'number_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Number Settings', 'clplace-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'number_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Number Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .location-box .location-box-content .listing-count .count' => 'color: {{VALUE}}',
				),
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
				'selector' => '{{WRAPPER}} .location-box .location-box-content .listing-count .count',
			]
		);
		$this->add_responsive_control(
			'number_box_size',
			[
				'label' => esc_html__( 'Number Box Size', 'clplace-core' ),
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
					'{{WRAPPER}} .location-box .location-box-content .listing-count .count' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function __slider_style_settings_controls() {
		//Content setting
		$this->start_controls_section(
			'slider_style',
			[
				'label' => esc_html__( 'Slider Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'layout-5',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_radius',
			[
				'label'      => __( 'Radius', 'clplace-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_control(
			'nex_prev_arrow',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Arrow Top / Bottom', 'clplace-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => -100,
						'max' => 100,
					),
					'px' => array(
						'min' => -200,
						'max' => 200,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'top: {{SIZE}}{{UNIT}};',
				),
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->add_control(
			'prev_arrow',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Prev Arrow', 'clplace-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => -100,
						'max' => 100,
					),
					'px' => array(
						'min' => -200,
						'max' => 200,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .swiper-navigation .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				),
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->add_control(
			'next_arrow',
			[
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'next_arrow',
				'mode'          => 'responsive',
				'label'   => esc_html__( 'Next Arrow', 'clplace-core' ),
				'size_units' => array( '%', 'px' ),
				'range' => array(
					'%' => array(
						'min' => -100,
						'max' => 100,
					),
					'px' => array(
						'min' => -200,
						'max' => 200,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .swiper-navigation .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				),
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->start_controls_tabs(
			'navigation_style_tabs',
			[
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]

		);

		$this->start_controls_tab(
			'navigation_style_tab',
			[
				'label' => __( 'Normal', 'clplace-core' ),
			]
		);
		$this->add_control(
			'arrow_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->add_control(
			'arrow_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow BG Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'navigation_style_hover_tab',
			[
				'label' => __( 'Hover', 'clplace-core' ),
			]
		);
		$this->add_control(
			'arrow_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'ArrowHover Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button:hover' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);

		$this->add_control(
			'arrow_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Arrow BG Hover Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .swiper-navigation .swiper-button:hover' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_arrow' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'pagination_color',
			[
				'label'     => __( 'Pagination Color', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_pagination' => 'yes',
				],
			]
		);
		$this->add_control(
			'pagination_active_color',
			[
				'label'     => __( 'Pagination Active Color', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				],
				'condition'   => [
					'display_pagination' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __slider_options_settings_controls() {
		// Slider option
		$this->start_controls_section(
			'section_slider_option',
			[
				'label' => __( 'Slider Option', 'clplace-core' ),
				'condition' => [
					'layout!' => 'layout-5',
				],
			]
		);

		$this->add_control(
			'slider_autoplay',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Autoplay', 'clplace-core' ),
				'label_on'    => esc_html__( 'On', 'clplace-core' ),
				'label_off'   => esc_html__( 'Off', 'clplace-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Enable or disable autoplay. Default: On', 'clplace-core' ),
			]
		);
		$this->add_control(
			'display_arrow',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Navigation Arrow', 'clplace-core' ),
				'label_on'    => esc_html__( 'On', 'clplace-core' ),
				'label_off'   => esc_html__( 'Off', 'clplace-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Navigation Arrow. Default: On', 'clplace-core' ),
			]
		);
		$this->add_control(
			'display_pagination',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Pagination', 'clplace-core' ),
				'label_on'    => esc_html__( 'On', 'clplace-core' ),
				'label_off'   => esc_html__( 'Off', 'clplace-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Navigation Arrow. Default: On', 'clplace-core' ),
			]
		);
		$this->add_control(
			'slides_per_group',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'label'   => esc_html__( 'slides Per Group', 'clplace-core' ),
				'default' => array(
					'size' => 1,
				),
				'description' => esc_html__( 'slides Per Group. Default: 1', 'clplace-core' ),
			]
		);
		$this->add_control(
			'centered_slides',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Centered Slides', 'clplace-core' ),
				'label_on'    => esc_html__( 'On', 'clplace-core' ),
				'label_off'   => esc_html__( 'Off', 'clplace-core' ),
				'default'     => 'no',
				'description' => esc_html__( 'Centered Slides. Default: On', 'clplace-core' ),
			]
		);
		$this->add_control(
			'slides_space',
			[
				'type'    => Controls_Manager::SLIDER,
				'mode' 			=> 'responsive',
				'label'   => esc_html__( 'Slides Space', 'clplace-core' ),
				'size_units' => array( 'px', '%' ),
				'default' => array(
					'unit' => 'px',
					'size' => 24,
				),
				'description' => esc_html__( 'Slides Space. Default: 24', 'clplace-core' ),
			]
		);
		$this->add_control(
			'slider_autoplay_delay',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Autoplay Slide Delay', 'clplace-core' ),
				'default' => 5000,
				'description' => esc_html__( 'Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds', 'clplace-core' ),
				'condition'   => [
					'slider_autoplay' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_autoplay_speed',
			[
				'type'    => Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Autoplay Slide Speed', 'clplace-core' ),
				'default' => 1000,
				'description' => esc_html__( 'Set any value for example .8 seconds to play it in every 2 seconds. Default: .8 Seconds', 'clplace-core' ),
				'condition'   => [
					'slider_autoplay' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_loop',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => esc_html__( 'Loop', 'clplace-core' ),
				'label_on'    => esc_html__( 'On', 'clplace-core' ),
				'label_off'   => esc_html__( 'Off', 'clplace-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Loop to first item. Default: On', 'clplace-core' ),
			]
		);
		$this->end_controls_section();
	}

	protected function __slider_responsive_settings_controls() {
		// Slider responsive
		$this->start_controls_section(
			'section_slider_grid',
			[
				'label' => __( 'Slider Grid', 'clplace-core' ),
				'condition' => [
					'layout!' => 'layout-5',
				],
			]
		);

		$this->add_control(
			'desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 1600px', 'clplace-core' ),
				'default' => '2',
				'options' => array(
					'1' => esc_html__( '1', 'clplace-core' ),
					'2' => esc_html__( '2', 'clplace-core' ),
					'3' => esc_html__( '3',  'clplace-core' ),
					'4' => esc_html__( '4',  'clplace-core' ),
					'5' => esc_html__( '5',  'clplace-core' ),
					'6' => esc_html__( '6',  'clplace-core' ),
				),
			]
		);
		$this->add_control(
			'md_desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 1200px', 'clplace-core' ),
				'default' => '2',
				'options' => array(
					'1' => esc_html__( '1', 'clplace-core' ),
					'2' => esc_html__( '2', 'clplace-core' ),
					'3' => esc_html__( '3',  'clplace-core' ),
					'4' => esc_html__( '4',  'clplace-core' ),
					'5' => esc_html__( '5',  'clplace-core' ),
					'6' => esc_html__( '6',  'clplace-core' ),
				),
			]
		);
		$this->add_control(
			'sm_desktop',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Desktops: > 992px', 'clplace-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'clplace-core' ),
					'2' => esc_html__( '2', 'clplace-core' ),
					'3' => esc_html__( '3',  'clplace-core' ),
					'4' => esc_html__( '4',  'clplace-core' ),
					'5' => esc_html__( '5',  'clplace-core' ),
				),
			]
		);
		$this->add_control(
			'tablet',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Tablets: > 768px', 'clplace-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'clplace-core' ),
					'2' => esc_html__( '2', 'clplace-core' ),
					'3' => esc_html__( '3',  'clplace-core' ),
					'4' => esc_html__( '4',  'clplace-core' ),
					'5' => esc_html__( '5',  'clplace-core' ),
				),
			]
		);
		$this->add_control(
			'mobile',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Phones: > 576px', 'clplace-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'clplace-core' ),
					'2' => esc_html__( '2', 'clplace-core' ),
					'3' => esc_html__( '3',  'clplace-core' ),
					'4' => esc_html__( '4',  'clplace-core' ),
					'5' => esc_html__( '5',  'clplace-core' ),
				),
			]
		);
		$this->add_control(
			'sm_mobile',
			[
				'type'    => Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Phones: > 425px', 'clplace-core' ),
				'default' => '1',
				'options' => array(
					'1' => esc_html__( '1', 'clplace-core' ),
					'2' => esc_html__( '2', 'clplace-core' ),
					'3' => esc_html__( '3',  'clplace-core' ),
					'4' => esc_html__( '4',  'clplace-core' ),
					'5' => esc_html__( '5',  'clplace-core' ),
				),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		if($data['slider_autoplay']=='yes'){
			$data['slider_autoplay']=true;
		}
		else{
			$data['slider_autoplay']=false;
		}

		$swiper_data = array(
			'slidesPerView' 	    => 2,
			'loop'				    => $data['slider_loop']=='yes' ? true:false,
			'spaceBetween'		    => $data['slides_space']['size'],
			'slidesPerGroup'	    => $data['slides_per_group']['size'],
			'centeredSlides'	    => $data['centered_slides']=='yes' ? true:false ,
			'slideToClickedSlide'   => true,
			'autoplay'				=> array(
				'delay'             => $data['slider_autoplay_delay'],
			),
			'speed'                 => $data['slider_autoplay_speed'],
			'breakpoints'           => array(
				'0'                 => array('slidesPerView' =>1),
				'425'               => array('slidesPerView' =>$data['sm_mobile']),
				'576'               => array('slidesPerView' =>$data['mobile']),
				'768'               => array('slidesPerView' =>$data['tablet']),
				'992'               => array('slidesPerView' =>$data['sm_desktop']),
				'1200'              => array('slidesPerView' =>$data['md_desktop']),
				'1600'              => array('slidesPerView' =>$data['desktop'])
			),
			'auto'                  => $data['slider_autoplay']
		);

		if ( 'layout-4' == $data['layout'] ) {
			$swiper_data['effect'] = "cards";
		}

		$data['swiper_data'] = json_encode( $swiper_data );

		$template = 'view-1';

		Fns::get_template( "elementor/listing-locations-slider/$template", $data );
	}

}