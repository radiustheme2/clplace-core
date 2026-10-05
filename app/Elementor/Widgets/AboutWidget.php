<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\ClplaceCore\Elementor\Widgets;

use Elementor\Utils;
use RT\ClplaceCore\Helper\Fns;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use RT\ClplaceCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class AboutWidget extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'About Widget', 'clplace-core' );
		$this->rt_base = 'rt-about-widget';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		/* --General Settings Options -- */
		$this->__options_settings_controls();

		/* --Style Settings Options -- */
		$this->__title_style_controls();
		$this->__description_style_controls();
		$this->__button_style_controls();

	}

	/**
	 * @return void
	 */
	protected function __options_settings_controls() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'logo_image',
			[
				'label'   => __( 'Logo Image', 'clplace-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => esc_html__( 'Description', 'clplace-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => 'Lorem Ipsum has been standard dent scrambled. Reply dummy text of the printing and typesetting industry',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'clplace-core' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => "App",
				'description' => esc_html__( "This is a app button title", 'clplace-core' ),
			]
		);

		$this->add_control(
			'play_store_icon',
			[
				'type'        => Controls_Manager::ICONS,
				'label'   => esc_html__( 'Play Store Icon', 'clplace-core' ),
				'default' => array(
					'value' => 'fas fa-smile-wink',
					'library' => 'fa-solid',
				),
			]
		);
		$this->add_control(
			'play_store_link',
			[
				'type'  => Controls_Manager::URL,
				'label' => esc_html__( 'Play Store Link', 'clplace-core' ),
				'placeholder' => 'https://your-link.com',
				'label_block' => true,
			]
		);

		$this->add_control(
			'app_store_icon',
			[
				'type'        => Controls_Manager::ICONS,
				'label'   => esc_html__( 'App Store Icon', 'clplace-core' ),
				'default' => array(
					'value' => 'fas fa-smile-wink',
					'library' => 'fa-solid',
				),
			]
		);
		$this->add_control(
			'app_store_link',
			[
				'type'  => Controls_Manager::URL,
				'label' => esc_html__( 'App Store Link', 'clplace-core' ),
				'placeholder' => 'https://your-link.com',
				'label_block' => true,
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
					'{{WRAPPER}} .section-title-wrapper' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
	}

	/**
	 * @return void
	 */
	protected function __title_style_controls() {
		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Main Title Settings', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .app-btn-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .app-btn-title',
			]
		);

		$this->add_responsive_control(
			'heading_margin',
			[
				'label'              => __( 'Margin', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'          => [
					'{{WRAPPER}} .app-btn-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * @return void
	 */
	protected function __description_style_controls() {
		$this->start_controls_section(
			'description_settings',
			[
				'label' => esc_html__( 'Description Settings', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typo',
				'label'    => esc_html__( 'Typography', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .about-us-widget .description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .about-us-widget .description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label'              => __( 'Margin', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .about-us-widget .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'description_list_settings',
			[
				'label'     => __( 'List Settings (if you use list item in description)', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_li_icon',
			[
				'label'     => __( 'List Icon', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '\f00c',
				'options'   => [
					''      => __( 'No Icon', 'clplace-core' ),
					'\f00c' => __( 'Check', 'clplace-core' ),
					'\f14a' => __( 'Check-square', 'clplace-core' ),
					'\f105' => __( 'Angle-right', 'clplace-core' ),
					'\f0da' => __( 'Caret-right', 'clplace-core' ),
					'\f061' => __( 'Arrow-right', 'clplace-core' ),
					'\f30b' => __( 'Long-arrow-alt-right', 'clplace-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .about-us-widget .description ul li::before' => 'content: "{{VALUE}}"',
				],
			]
		);

		$this->add_control(
			'description_li_icon_position',
			[
				'label'      => __( 'Icon Position', 'clplace-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
						'step' => 0,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors'  => [
					'{{WRAPPER}} .about-us-widget .description ul li::before' => 'transform: translateY( {{SIZE}}{{UNIT}} );',
				],
				'condition'  => [
					'description_li_icon!' => '',
				],
			]
		);

		$this->add_control(
			'description_list_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .about-us-widget .description ul li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'description_list_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .about-us-widget .description ul li::before' => 'color: {{VALUE}}',
				],
				'condition' => [
					'description_li_icon!' => '',
				],
			]
		);
		$this->end_controls_section();
	}

	// Button Style
	protected function __button_style_controls() {
		$this->start_controls_section(
			'btn_style',
			[
				'label'     => esc_html__( 'Button', 'clplace-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'btn_tab_style' );
		// Normal tab.
		$this->start_controls_tab(
			'btn_style_normal',
			[
				'label' => __( 'Normal', 'clplace-core' ),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .app-download-area a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .app-download-area i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .app-download-area svg path' => 'fill: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'btn_typo',
				'label'    => esc_html__( 'Typography', 'clplace-core' ),
				'selector' => '
					{{WRAPPER}} .app-download-area a, 
					{{WRAPPER}} .app-download-area a i, 
					{{WRAPPER}} .app-download-area a svg
				',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_bg_color',
				'label'     => __( 'Background', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .app-download-area a',
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .app-download-area a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->add_responsive_control(
			'btn_margin',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Margin', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .app-download-area a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_border',
				'label'     => __( 'Border', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .app-download-area a',
			]
		);
		$this->add_responsive_control(
			'btn_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Border Radius', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .app-download-area a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->end_controls_tab();

		// Hover tab.
		$this->start_controls_tab(
			'btn_style_hover',
			[
				'label' => __( 'Hover', 'clplace-core' ),
			]
		);
		$this->add_control(
			'btn_h_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .app-download-area a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .app-download-area a:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .app-download-area a:hover svg path' => 'fill: {{VALUE}}',
				),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'btn_hbg_color',
				'label'     => __( 'Background', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .app-download-area a:hover',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'btn_hover_border',
				'label'     => __( 'Border', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .app-download-area a:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/about/$template", $data );
	}

}