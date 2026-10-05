<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.2
 */

namespace RT\ClplaceCore\Elementor\Widgets;

use Elementor\Utils;
use RT\ClplaceCore\Helper\Fns;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use RT\ClplaceCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Team extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'RT Team', 'clplace-core' );
		$this->rt_base = 'rt-agents';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		// widget title
		$this->start_controls_section(
			'rt_agent_grid',
			[
				'label' => esc_html__( 'Team Grid', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Style', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Style 1', 'clplace-core' ),
					'style2' => __( 'Style 2', 'clplace-core' ),
					'style3' => __( 'Style 3', 'clplace-core' ),
				],

			]
		);

		$this->add_control(
			'image',
			[
				'label'   => __( 'Team Image', 'clplace-core' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail',
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'large',
			]
		);

		$this->add_control(
			'team_name',
			[
				'label'       => __( 'Team Name', 'clplace-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'E.g. John Doe', 'clplace-core' ),
				'default'     => __( 'John Doe', 'clplace-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'team_designation',
			[
				'label'       => __( 'Team Designation', 'clplace-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'E.g. Marketing Manager', 'clplace-core' ),
				'default'     => __( 'Marketing Manager', 'clplace-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'company_name',
			[
				'label'       => __( 'Company Name', 'clplace-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'E.g. Eco Builders', 'clplace-core' ),
				'default'     => __( 'Eco Builders', 'clplace-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'company_url',
			[
				'label'         => __( 'Company Link', 'clplace-core' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'Company link', 'clplace-core' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'condition'     => [
					'company_name!' => '',
				],
				'label_block' => true,
			]
		);


		$this->add_control(
			'team_phone',
			[
				'label'       => __( 'Phone', 'clplace-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( '+121 456 8976', 'clplace-core' ),
				'default'     => __( '+121 456 8976', 'clplace-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'thumb_label',
			[
				'label'       => __( 'Thumb label', 'clplace-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'E.g. Thumb Label', 'clplace-core' ),
				'default'     => __( 'Thumb Label', 'clplace-core' ),
				'label_block' => true,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'social_title', [
				'label'   => __( 'Title', 'clplace-core' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'List Title', 'clplace-core' ),
			]
		);

		$repeater->add_control(
			'social_icon',
			[
				'label'   => __( 'Icon', 'clplace-core' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fab fa-facebook-f',
					'library' => 'solid',
				],
			]
		);

		$repeater->add_control(
			'social_link', [
				'label'       => __( 'Link ', 'clplace-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'social_icon_list',
			[
				'label'       => __( 'Social Icon List', 'clplace-core' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'social_title' => __( 'Facebook', 'clplace-core' ),
						'social_icon'  => [
							'value'   => 'fab fa-facebook-f',
							'library' => 'solid',
						],
						'social_link'  => '#',
					],
					[
						'social_title' => __( 'Twitter', 'clplace-core' ),
						'social_icon'  => [
							'value'   => 'fab fa-twitter',
							'library' => 'solid',
						],
						'social_link'  => '#',
					],
					[
						'social_title' => __( 'linkedin', 'clplace-core' ),
						'social_icon'  => [
							'value'   => 'fab fa-linkedin-in',
							'library' => 'solid',
						],
						'social_link'  => '#',
					],
				],
				'title_field' => '{{{ social_title }}}',
				'condition'   => [
					'layout' => 'style1',
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
					'{{WRAPPER}} .team-block' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		/* Title Settings
		====================================================================== */
		$this->start_controls_section(
			'name_style',
			[
				'label' => __( 'Name Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .team-name',
			]
		);

		$this->add_control(
			'name_spacing',
			[
				'label'              => __( 'Name Spacing', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .team-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => __( 'Name Color', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();


		/* Designation Settings
		====================================================================== */
		$this->start_controls_section(
			'designation_style',
			[
				'label' => __( 'Designation Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'designation_typography',
				'selector' => '{{WRAPPER}} .designation',
			]
		);

		$this->add_control(
			'designation_spacing',
			[
				'label'              => __( 'Designation Spacing', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);

		$this->add_control(
			'designation_color',
			[
				'label'     => __( 'Designation Color', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .designation' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		/* Company / Agency Settings
		====================================================================== */
		$this->start_controls_section(
			'agency_style',
			[
				'label' => __( 'Company / Designation Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'agency_typography',
				'selector' => '{{WRAPPER}} .company-name a, {{WRAPPER}} .company-name a',
			]
		);

		$this->add_control(
			'agency_spacing',
			[
				'label'              => __( 'Company Spacing', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .company-name a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
			]
		);

		$this->add_control(
			'agency_color',
			[
				'label'     => __( 'Company Color', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .company-name a, {{WRAPPER}} .company-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		/* Contact Style
		====================================================================== */
		$this->start_controls_section(
			'contact_style',
			[
				'label' => __( 'Contact Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'contact_typography',
				'selector' => '{{WRAPPER}} .item-phn-no',
			]
		);

		$this->add_control(
			'contact_color',
			[
				'label'     => __( 'Contact Color', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item-phn-no' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		/* Thumb Meta Style
		====================================================================== */
		$this->start_controls_section(
			'thumb_meta_style',
			[
				'label' => __( 'Thumb Meta Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'thumb_meta_typography',
				'selector' => '{{WRAPPER}} .thumb-label',
			]
		);

		$this->add_control(
			'thumb_meta_color',
			[
				'label'     => __( 'Thumb Meta Color', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thumb-label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'thumb_meta_bg',
			[
				'label'     => __( 'Thumb Meta Background', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thumb-label' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'thumb_meta_dot_color',
			[
				'label'     => __( 'Thumb Meta Dot color', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .thumb-label' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		/* Contact Style
		====================================================================== */
		$this->start_controls_section(
			'social_icon_style',
			[
				'label' => __( 'Social Icon Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'social_icon_size',
			[
				'label'      => __( 'Icon Size', 'clplace-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 60,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 16,
				],
				'selectors'  => [
					'{{WRAPPER}} .rt-social-item a'   => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'social_icon_style_tabs'
		);

		$this->start_controls_tab(
			'social_icon_normal_tab',
			[
				'label' => __( 'Normal', 'clplace-core' ),
			]
		);

		$this->add_control(
			'social_icon_color',
			[
				'label'     => __( 'Social Icon Color', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .team-social-dropdown .social-item .social-link'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-agents-wrapper .team-social-dropdown .social-item .social-link svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_icon_bg_color',
			[
				'label'     => __( 'Social Icon Background', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .team-social-dropdown .social-item .social-link' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'social_icon_hover_tab',
			[
				'label' => __( 'Hover', 'clplace-core' ),
			]
		);

		$this->add_control(
			'social_icon_color_hover',
			[
				'label'     => __( 'Social Icon Color Hover', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .team-social-dropdown .social-item .social-link:hover'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-agents-wrapper .team-social-dropdown .social-item .social-link:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_icon_bg_color_hoer',
			[
				'label'     => __( 'Social Icon Background Hover', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rt-agents-wrapper .team-social-dropdown .social-item .social-link:hover' => 'background-color: {{VALUE}}',
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
		if ( 'style2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'style3' == $data['layout'] ) {
			$template = 'view-3';
		}
		Fns::get_template( "elementor/team/$template", [ 'data' => $data ] );
	}

}