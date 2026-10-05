<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace RT\ClplaceCore\Elementor\Widgets;

use RT\ClplaceCore\Helper\Fns;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use RT\ClplaceCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class MenuIcons extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = __( 'RT Menu Icons', 'clplace-core' );
		$this->rt_base = 'rt-menu-icons';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {
		/* --General Settings Options -- */
		$this->__general_settings_controls();
		$this->__menu_icon_controls();
		$this->__menu_button_controls();
		$this->__menu_login_controls();
	}

	protected function __general_settings_controls() {
		$this->start_controls_section(
			'sec_general',
			[
				'label' => esc_html__( 'General', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hamburger',
			[
				'label'     => esc_html__( 'Hamburg menu', 'clplace-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'clplace-core' ),
				'label_off' => esc_html__( 'Off', 'clplace-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'search',
			[
				'label'     => esc_html__( 'Search bar', 'clplace-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'clplace-core' ),
				'label_off' => esc_html__( 'Off', 'clplace-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'login',
			[
				'label'     => esc_html__( 'Login icon', 'clplace-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'clplace-core' ),
				'label_off' => esc_html__( 'Off', 'clplace-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'button',
			[
				'label'     => esc_html__( 'Button', 'clplace-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'On', 'clplace-core' ),
				'label_off' => esc_html__( 'Off', 'clplace-core' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'button_label',
			[
				'label'     => esc_html__( 'Button Label', 'clplace-core' ),
				'type'      => Controls_Manager::TEXT,
				'separator' => 'before',
				'condition' => [
					'button' => 'yes'
				]
			]
		);

		$this->add_control(
			'has_separator',
			[
				'label'       => esc_html__( 'Icon Separator', 'clplace-core' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'On', 'clplace-core' ),
				'label_off'   => esc_html__( 'Off', 'clplace-core' ),
				'default'     => 'yes',
				'render_type' => 'template',
			]
		);

		$this->add_responsive_control(
			'alignment',
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
					'{{WRAPPER}} .menu-icon-wrapper' => 'justify-content: {{VALUE}};justify-content: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}
	protected function __menu_icon_controls() {
		$this->start_controls_section(
			'icon_style',
			[
				'label' => __( 'Menu Icon Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper svg'               => 'fill: {{VALUE}}',
					'{{WRAPPER}} .menu-icon-wrapper svg path'          => 'fill: {{VALUE}}',
					'{{WRAPPER}} .menu-icon-wrapper .ham_burger .line' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .ham-burger .btn-hamburger span'      => 'background-color: {{VALUE}}',
				],
			]
		);



		$this->add_control(
			'icon_color_hover',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Icon Color:hover', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper a:hover svg'               => 'fill: {{VALUE}}',
					'{{WRAPPER}} .menu-icon-wrapper a:hover .ham_burger .line' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'separator_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Separator Color', 'clplace-core' ),
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .has-separator li:not(:last-child):after' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function __menu_button_controls() {
		// Button Style
		$this->start_controls_section(
			'button_style',
			[
				'label' => __( 'Button Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'button' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typo',
				'label'    => esc_html__( 'Typo', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .button-style-2',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'              => __( 'Padding', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-icon-wrapper a.button-style-2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'button_radius',
			[
				'label'              => __( 'Radius', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-icon-wrapper .button-style-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		// Login Button style Tabs
		$this->start_controls_tabs(
			'button_style_tabs', [
			]
		);

		$this->start_controls_tab(
			'button_style_normal_tab',
			[
				'label' => __( 'Normal', 'clplace-core' ),
			]
		);
		$this->add_control(
			'button_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .button-style-2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color',
				'label' => __('Background', 'clplace-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'clplace-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .button-style-2',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .button-style-2',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'label' => __('Box Shadow', 'clplace-core'),
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .button-style-2',
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
			'button_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .button-style-2:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_hover_color',
				'label' => __('Background', 'clplace-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'clplace-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .button-style-2:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .button-style-2:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_hover_box_shadow',
				'label' => __('Box Shadow', 'clplace-core'),
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .button-style-2:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * @return void
	 */
	protected function __menu_login_controls() {
		// Login Button Style
		$this->start_controls_section(
			'login_style',
			[
				'label' => __( 'Login Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'login' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'login_typo',
				'label'    => esc_html__( 'Typography', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .clplace-user-login a',
			]
		);

		$this->add_responsive_control(
			'login_padding',
			[
				'label'              => __( 'Padding', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-icon-wrapper .clplace-user-login a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'login_radius',
			[
				'label'              => __( 'Radius', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .menu-icon-wrapper .clplace-user-login a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		// Login Button style Tabs
		$this->start_controls_tabs(
			'login_style_tabs', [
			]
		);

		$this->start_controls_tab(
			'login_style_normal_tab',
			[
				'label' => __( 'Normal', 'clplace-core' ),
			]
		);
		$this->add_control(
			'login_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .clplace-user-login a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'login_bg_color',
				'label' => __('Background', 'clplace-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'clplace-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .clplace-user-login a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'login_border',
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .clplace-user-login a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'login_box_shadow',
				'label' => __('Box Shadow', 'clplace-core'),
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .clplace-user-login a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'login_style_hover_tab',
			[
				'label' => __( 'Hover', 'clplace-core' ),
			]
		);

		$this->add_control(
			'login_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .menu-icon-wrapper .clplace-user-login a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'login_bg_hover_color',
				'label' => __('Background', 'clplace-core'),
				'types' => ['classic', 'gradient'],
				'fields_options'  => [
					'background' => [
						'label' => esc_html__( 'Background', 'clplace-core' ),
					],
				],
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .clplace-user-login a:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'login_hover_border',
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .clplace-user-login a:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'login_hover_box_shadow',
				'label' => __('Box Shadow', 'clplace-core'),
				'selector' => '{{WRAPPER}} .menu-icon-wrapper .clplace-user-login a:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';

		Fns::get_template( "elementor/menu-icons/$template", $data );
	}

}