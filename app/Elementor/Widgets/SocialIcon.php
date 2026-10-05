<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\ClplaceCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use RT\ClplaceCore\Helper\Fns;
use Elementor\Group_Control_Typography;
use RT\ClplaceCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SocialIcon extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Social Icon', 'clplace-core' );
		$this->rt_base = 'rt-social-icon';
		parent::__construct( $data, $args );
	}
	protected function register_controls() {
		$this->start_controls_section(
			'rt_social_setting',
			[
				'label' => esc_html__( 'RT Social Icon Setting', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'social_icon',
			[
				'label' => esc_html__( 'Icon', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'social',
				'default' => [
					'value' => 'fab fa-wordpress',
					'library' => 'fa-brands',
				],
			]
		);

		$repeater->add_control(
			'link', [
				'type'  => Controls_Manager::URL,
				'label' => esc_html__( 'URL(optional)', 'clplace-core' ),
				'label_block' => true,
				'placeholder' => esc_html__( 'https://your-link.com', 'clplace-core' ),
			]
		);
		$repeater->add_control(
			'icon_color', [
				'type' => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Icon Color', 'clplace-core' ),
				'default'  => '',
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-social-icon {{CURRENT_ITEM}} svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$repeater->add_control(
			'icon_hover_color', [
				'type' => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Icon Hover Color', 'clplace-core' ),
				'default'  => '',
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon {{CURRENT_ITEM}}:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .rt-social-icon {{CURRENT_ITEM}}:hover svg path' => 'fill: {{VALUE}}',
				],
			]
		);
		$repeater->add_control(
			'icon_bg_color', [
				'type' => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Icon Background Color', 'clplace-core' ),
				'default'  => '',
				'selectors' => [
					'{{WRAPPER}} .rt-social-item {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				],
			]
		);
		$repeater->add_control(
			'icon_bg_hover_color', [
				'type' => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Icon Hover Background Color', 'clplace-core' ),
				'default'  => '',
				'selectors' => [
					'{{WRAPPER}} .rt-social-item {{CURRENT_ITEM}}:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'icon_border',
				'label'     => __( 'Border', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .rt-social-item {{CURRENT_ITEM}}',
			]
		);
		$repeater->add_control(
			'icon_hover_border_color', [
				'type' => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Border Hover Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-item {{CURRENT_ITEM}}:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'label',
			[
				'label'     => __('Label', 'clplace-core'),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Follow Us On',

			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label'     => __( 'Alignment', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
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
					'{{WRAPPER}}' => 'text-align: {{VALUE}} !important',
				],
				'toggle'    => true,
			]
		);

		$this->add_control(
			'social_icon',
			[
				'label'   => esc_html__( 'Social Icon', 'clplace-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default' => [
					[
						'title' => 'Facebook',
						'social_icon' => [
							'value' => 'fab fa-facebook-f',
							'library' => 'fa-brands',
						],
					],
					[
						'title' => 'Twitter',
						'social_icon' => [
							'value' => 'fab fa-x-twitter',
							'library' => 'fa-brands',
						],
					],
					[
						'title' => 'Instagram',
						'social_icon' => [
							'value' => 'fab fa-instagram',
							'library' => 'fa-brands',
						],
					],
					[
						'title' => 'Pinterest',
						'social_icon' => [
							'value' => 'fab fa-pinterest-p',
							'library' => 'fa-brands',
						],
					],
				],
			]
		);

		$this->end_controls_section();

		// Title Settings
		//==============================================================
		$this->start_controls_section(
			'label_settings',
			[
				'label' => esc_html__( 'Label Settings', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'flex_direction',
			[
				'label'     => __( 'Direction', 'clplace-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'column' => [
						'title' => __( 'Column', 'clplace-core' ),
						'icon'  => 'eicon-arrow-down',
					],
					'row'     => [
						'title' => __( 'Row', 'clplace-core' ),
						'icon'  => 'eicon-arrow-right',
					],
					'column-reverse'   => [
						'title' => __( 'Column Reverse', 'clplace-core' ),
						'icon'  => 'eicon-arrow-up',
					],
					'row-reverse'   => [
						'title' => __( 'Row Reverse', 'clplace-core' ),
						'icon'  => 'eicon-arrow-left',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon' => 'flex-direction: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'flex_alignment',
			[
				'label'     => __( 'Alignment', 'clplace-core' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => __( 'Left', 'clplace-core' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [
						'title' => __( 'Center', 'clplace-core' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'   => [
						'title' => __( 'Right', 'clplace-core' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon' => 'align-items: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'label_typo',
				'label'    => esc_html__( 'Typo', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .rt-social-icon label',
			]
		);

		$this->add_control(
			'label_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon label'   => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'label_gap',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Gap', 'clplace-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Social List
		//==============================================================
		$this->start_controls_section(
			'social_item_settings',
			[
				'label'     => esc_html__( 'Social List Item', 'clplace-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'social_typo',
				'label'    => esc_html__( 'Social Typo', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .rt-social-icon .rt-social-item a',
			]
		);

		$this->add_responsive_control(
			'social_gap',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Social Gap', 'clplace-core' ),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_width',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Social Width', 'clplace-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_height',
			[
				'type'    => Controls_Manager::SLIDER,
				'label'   => esc_html__( 'Social Height', 'clplace-core' ),
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_radius',
			[
				'label'              => __( 'Social Radius', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs(
			'social_style_tabs', [
			]
		);

		$this->start_controls_tab(
			'social_normal_tab',
			[
				'label' => __( 'Normal', 'clplace-core' ),
			]
		);

		$this->add_control(
			'social_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Social Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_bg_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Social BG Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a' => 'background-color: {{VALUE}}',
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
			'social_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Social Hover Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'social_bg_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Social BG Hover Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .rt-social-icon .rt-social-item a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}


	protected function render() {
		$data     = $this->get_settings();
		$template = 'view-1';

		Fns::get_template( "elementor/social-icon/{$template}", $data );
	}

}