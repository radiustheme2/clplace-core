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
use RT\ClplaceCore\Abstracts\ElementorBase;
use RT\ClplaceCore\Helper\Fns;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Title extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Section Title', 'clplace-core' );
		$this->rt_base = 'rt-title';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		/* --General Settings Options -- */
		$this->__options_settings_controls();

		/* --Style Settings Options -- */
		$this->__subtitle_settings_controls();
		$this->__title_settings_controls();
		$this->__description_settings_controls();
		$this->__bgtitle_settings_controls();
		$this->__common_settings_controls();

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
			'top_sub_title',
			[
				'label'       => esc_html__( 'Top Sub Title', 'clplace-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Why Choose Our Properties',
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Main Title', 'clplace-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'rows'        => 3,
				'default'     => "This is a section main title",
				'description' => esc_html__( "If you would like to use different color then separate word by", 'clplace-core' ),
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
			'bg_title',
			[
				'label'   => esc_html__( 'Background Title', 'clplace-core' ),
				'type'    => Controls_Manager::TEXT,
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

		$this->add_control(
			'main_title_tag',
			[
				'label'   => esc_html__( 'Main Title Tag', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' => esc_html__( 'H1', 'clplace-core' ),
					'h2' => esc_html__( 'H2', 'clplace-core' ),
					'h3' => esc_html__( 'H3', 'clplace-core' ),
					'h4' => esc_html__( 'H4', 'clplace-core' ),
					'h5' => esc_html__( 'H5', 'clplace-core' ),
					'h6' => esc_html__( 'H6', 'clplace-core' ),
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * @return void
	 */
	protected function __subtitle_settings_controls() {
		$this->start_controls_section(
			'top_title_settings',
			[
				'label' => esc_html__( 'Top Sub Title Settings', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'top_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .top-sub-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'top_title_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .top-sub-title i'        => 'color: {{VALUE}}',
					'{{WRAPPER}} .section-title-wrapper .top-sub-title svg path' => 'fill: {{VALUE}}',
				],
				'condition' => [
					'top_title_icon!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'top_title_two_typo',
				'label'    => esc_html__( 'Typography', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .top-sub-title',
			]
		);

		$this->add_responsive_control(
			'top_title_padding',
			[
				'label'              => esc_html__( 'Padding', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .top-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'top_title_margin',
			[
				'label'              => esc_html__( 'Margin', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .top-sub-title-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'sub_title_border',
				'selector' => '{{WRAPPER}} .section-title-wrapper .top-sub-title',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'sub_title_bg',
				'label'    => esc_html__( 'Background', 'clplace-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background', 'clplace-core'),
						'default' => 'classic',
					]
				],
				'selector' => '{{WRAPPER}} .section-title-wrapper .top-sub-title',
			]
		);
		$this->add_responsive_control(
			'sub_title_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .section-title-wrapper .top-sub-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->end_controls_section();
	}

	/**
	 * @return void
	 */
	protected function __title_settings_controls() {
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
					'{{WRAPPER}} .section-title-wrapper .main-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_two',
			[
				'type'        => Controls_Manager::COLOR,
				'label'       => esc_html__( 'Color 2', 'clplace-core' ),
				'description' => esc_html__( "If you would like to use different color then separate word by <span> from main title.", 'clplace-core' ),
				'selectors'   => [
					'{{WRAPPER}} .section-title-wrapper .main-title span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typo',
				'label'    => esc_html__( 'Typography', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .main-title',
			]
		);

		$this->add_responsive_control(
			'heading_margin',
			[
				'label'              => __( 'Margin', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'          => [
					'{{WRAPPER}} .main-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * @return void
	 */
	protected function __description_settings_controls() {
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
				'selector' => '{{WRAPPER}} .section-title-wrapper .description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .description' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .section-title-wrapper .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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
					'{{WRAPPER}} .section-title-wrapper .description ul li::before' => 'content: "{{VALUE}}"',
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
					'{{WRAPPER}} .section-title-wrapper .description ul li::before' => 'transform: translateY( {{SIZE}}{{UNIT}} );',
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
					'{{WRAPPER}} .section-title-wrapper .description ul li' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'description_list_icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'List Icon Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .description ul li::before' => 'color: {{VALUE}}',
				],
				'condition' => [
					'description_li_icon!' => '',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * @return void
	 */
	protected function __bgtitle_settings_controls() {
		$this->start_controls_section(
			'background_title_settings',
			[
				'label' => esc_html__( 'Background Title Settings',
					'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'bg_title_position',
			[
				'label'     => __( 'Position', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '',
				'options'   => [
					''         => __( 'Absolute Position', 'clplace-core' ),
					'static'   => __( 'Position Static', 'clplace-core' ),
					'relative' => __( 'Position Relative', 'clplace-core' ),
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .bg-title-wrap' => 'position: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'background_title_typo',
				'label'    => esc_html__( 'Typography', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .section-title-wrapper .background-title',
			]
		);

		$this->add_control(
			'bg_title_style',
			[
				'label'   => __( 'Title Style', 'clplace-core' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid'   => __( 'Solid', 'clplace-core' ),
					'outline' => __( 'Outline', 'clplace-core' ),
				],
			]
		);

		$this->add_control(
			'background_title_border_width',
			[
				'label'      => __( 'Outline Width', 'clplace-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 5,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors'  => [
					'{{WRAPPER}} .section-title-wrapper .background-title' => ' -webkit-text-stroke-width:{{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'bg_title_style' => 'outline'
				]
			]
		);

		$this->add_control(
			'background_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .background-title' => 'color: {{VALUE}}; -webkit-text-stroke-color:{{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_title_opacity',
			[
				'label'      => __( 'Opacity', 'clplace-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1,
						'step' => 0.1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors'  => [
					'{{WRAPPER}} .section-title-wrapper .background-title' => 'opacity:{{SIZE}};',
				],
			]
		);

		$this->add_responsive_control(
			'background_title_position',
			[
				'label'              => __( 'Position', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'default'            => [
					'top'      => '0',
					'right'    => '',
					'bottom'   => '',
					'left'     => '0',
					'isLinked' => false,
				],
				'allowed_dimensions' => [ 'top', 'left' ],
				'selectors'          => [
					'{{WRAPPER}} .section-title-wrapper .bg-title-wrap' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * @return void
	 */
	protected function __common_settings_controls() {
		$this->start_controls_section(
			'Common Settings',
			[
				'label' => esc_html__( 'Common Settings', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'section_title_wrap_margin',
			[
				'label'              => __( 'Wrapper Margin', 'clplace-core' ),
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
					'{{WRAPPER}} .section-title-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}



	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';
		Fns::get_template( "elementor/title/$template", $data );
	}

}