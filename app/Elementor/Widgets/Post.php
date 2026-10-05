<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.2
 */

namespace RT\ClplaceCore\Elementor\Widgets;

use Elementor\Controls_Manager;
use RT\ClplaceCore\Helper\Fns;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use RT\ClplaceCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Post extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name      = esc_html__( 'RT Post', 'clplace-core' );
		$this->rt_base      = 'rt-post';
		parent::__construct( $data, $args );
	}

	protected function register_controls() {

		/* = General Settings = */
		$this->__general_settings_controls();

        /* = Styles Settings = */
		$this->__thumbnail_settings_controls();
		$this->__title_settings_controls();
		$this->__content_settings_controls();
		$this->__meta_info_settings_controls();
		$this->__readmore_settings_controls();
		$this->__post_card_settings_controls();
	}


	// Info Box General Settings
	protected function __general_settings_controls() {
		// widget title
		$this->start_controls_section(
			'rt_post_grid',
			[
				'label' => esc_html__( 'Post Grid', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Style', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Style 1', 'clplace-core' ),
					'grid-2'  => __( 'Style 2', 'clplace-core' ),
					'grid-3'  => __( 'Style 3', 'clplace-core' ),
					'grid-4'  => __( 'Style 4', 'clplace-core' ),
				],

			]
		);

		$this->add_control(
			'gridcolumn-popover-toggle',
			[
				'label'        => __( 'Grid Column', 'clplace-core' ),
				'type'         => Controls_Manager::POPOVER_TOGGLE,
				'label_off'    => __( 'Default', 'clplace-core' ),
				'label_on'     => __( 'Custom', 'clplace-core' ),
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_control(
			'gird_column_desktop',
			[
				'label'   => esc_html__( 'Grid Column for Desktop', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => $this->rt_grid_options(),

			]
		);

		$this->add_control(
			'gird_column_tab',
			[
				'label'   => esc_html__( 'Grid Column for Tab', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '6',
				'options' => $this->rt_grid_options(),

			]
		);

		$this->add_control(
			'gird_column_mobile',
			[
				'label'   => esc_html__( 'Grid Column for Mobile', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '12',
				'options' => $this->rt_grid_options(),

			]
		);

		$this->end_popover();

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__( 'Title Tag', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
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

		$this->add_control(
			'post_limit',
			[
				'label'       => __( 'Post Limit', 'clplace-core' ),
				'type'        => Controls_Manager::NUMBER,
				'placeholder' => __( 'Enter Post Limit', 'clplace-core' ),
				'description' => __( 'Enter number of post to show.', 'clplace-core' ),
				'default'     => '12',
			]
		);

		$this->add_control(
			'post_source',
			[
				'label'       => __( 'Post Source', 'clplace-core' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'most_recent' => __( 'From all recent post', 'clplace-core' ),
					'by_category' => __( 'By Category', 'clplace-core' ),
					'by_tags'     => __( 'By Tags', 'clplace-core' ),
					'by_id'       => __( 'By Post ID', 'clplace-core' ),
				],
				'default'     => [ 'most_recent' ],
				'description' => __( 'Select posts source that you like to show.', 'clplace-core' ),
			]
		);

		$this->add_control(
			'categories',
			[
				'label'       => __( 'Choose Categories', 'clplace-core' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => rt_category_list(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_category',
				],
				'description' => __( 'Select post category\'s.', 'clplace-core' ),
			]
		);

		$this->add_control(
			'tags',
			[
				'label'       => __( 'Choose Tags', 'clplace-core' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => rt_tag_list(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_tags',
				],
				'description' => __( 'Select post tag\'s.', 'clplace-core' ),
			]
		);

		$this->add_control(
			'post_id',
			[
				'label'       => __( 'Enter post IDs', 'clplace-core' ),
				'type'        => Controls_Manager::TEXT,
				'description' => __( 'Enter the post IDs separated by comma', 'clplace-core' ),
				'label_block' => 'true',
				'condition'   => [
					'post_source' => 'by_id',
				],
			]
		);

		$this->add_control(
			'offset',
			[
				'label'       => __( 'Post offset', 'clplace-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post offset', 'clplace-core' ),
				'description' => __( 'Number of post to displace or pass over. The offset parameter is ignored when post limit => -1 (show all posts) is used.', 'clplace-core' ),
			]
		);

		$this->add_control(
			'exclude',
			[
				'label'       => __( 'Exclude posts', 'clplace-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => 'true',
				'description' => __( 'Enter the post IDs separated by comma for exclude', 'clplace-core' ),
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order by', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'date'           => __( 'Date', 'clplace-core' ),
					'ID'             => __( 'Order by post ID', 'clplace-core' ),
					'author'         => __( 'Author', 'clplace-core' ),
					'title'          => __( 'Title', 'clplace-core' ),
					'modified'       => __( 'Last modified date', 'clplace-core' ),
					'parent'         => __( 'Post parent ID', 'clplace-core' ),
					'comment_count'  => __( 'Number of comments', 'clplace-core' ),
					'menu_order'     => __( 'Menu order', 'clplace-core' ),
					'meta_value'     => __( 'Meta value', 'clplace-core' ),
					'meta_value_num' => __( 'Meta value number', 'clplace-core' ),
					'rand'           => __( 'Random order', 'clplace-core' ),
				],
				'default'     => [ 'date' ],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Sort order', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ASC'  => __( 'ASC', 'clplace-core' ),
					'DESC' => __( 'DESC', 'clplace-core' ),
				],
				'default'     => [ 'ASC' ],
			]
		);

		$this->end_controls_section();
    }

	protected function __thumbnail_settings_controls() {
		$this->start_controls_section(
			'thumbnail_style',
			[
				'label' => __( 'Thumbnail Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'thumbnail_visibility',
			[
				'label'   => __( 'Thumbnail Visibility', 'clplace-core' ),
				'type'    => Controls_Manager::CHOOSE,
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
			'project_thumbnail_size',
			[
				'label'     => esc_html__( 'Image Size', 'clplace-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => rt_get_all_image_sizes(),
				'condition' => [
					'layout' => 'visible',
				],
			]
		);

		$this->add_control(
			'post_thumbnail_size',
			[
				'label'     => esc_html__( 'Image Size', 'clplace-core' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->rt_get_all_image_sizes(),
				'condition' => [
					'thumbnail_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'thumb_box_radius',
			[
				'label'      => __( 'Thumbnail Radius', 'clplace-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .post-thumbnail-wrap .post-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'thumbnail_visibility' => 'visible',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_box_size',
			[
				'label' => esc_html__( 'Thumbanail Box Size', 'clplace-core' ),
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
					'{{WRAPPER}} .rt-el-post-wrapper .clplace-post-card .post-thumbnail-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'layout' => 'grid-4' ],
			]
		);
		$this->end_controls_section();
    }

	protected function __title_settings_controls() {
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .clplace-post-card .entry-title',
			]
		);

		$this->add_control(
			'title_spacing',
			[
				'label'              => __( 'Title Spacing', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .clplace-post-card .entry-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
			'title_style_tabs'
		);

		$this->start_controls_tab(
			'title_normal_tab',
			[
				'label' => __( 'Normal', 'clplace-core' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .clplace-post-card .entry-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover_tab',
			[
				'label' => __( 'Hover', 'clplace-core' ),
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Title Hover Color', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .clplace-post-card .entry-title a:hover' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
    }

	protected function __content_settings_controls() {
		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Excerpt Style', 'clplace-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_visibility',
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
				'default' => 'hidden',
			]
		);


		$this->add_control(
			'content_limit',
			[
				'label'     => __( 'Excerpt Limit', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'default'   => '20',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'content_typography',
				'selector'  => '{{WRAPPER}} .entry-content',
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_spacing',
			[
				'label'              => __( 'Excerpt Spacing', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'selectors'          => [
					'{{WRAPPER}} .entry-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'          => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => __( 'Content Color', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .entry-content' => 'color: {{VALUE}}',
				],
				'condition' => [
					'content_visibility' => 'visible',
				],
			]
		);

		$this->end_controls_section();
    }

	protected function __meta_info_settings_controls() {
		// Meta Information Settings
		$this->start_controls_section(
			'meta_info_style',
			[
				'label' => __( 'Meta Info Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'post_meta_typography',
				'selector' => '{{WRAPPER}} .clplace-post-meta',
			]
		);

		$this->start_controls_tabs(
			'post_meta_style_tabs'
		);

		$this->start_controls_tab(
			'post_meta_normal_tab',
			[
				'label' => __( 'Normal', 'clplace-core' ),
			]
		);


		$this->add_control(
			'post_meta_color',
			[
				'label'     => __( 'Meta Color', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .clplace-post-meta' => 'color: {{VALUE}}',
					'{{WRAPPER}} .clplace-post-meta a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'post_meta_hover_tab',
			[
				'label' => __( 'Box Hover', 'clplace-core' ),
			]
		);

		$this->add_control(
			'post_meta_color_hover',
			[
				'label'     => __( 'Meta Color Hover', 'clplace-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .clplace-post-meta a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr1',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'author_visibility',
			[
				'label'        => __( 'Author Visibility', 'clplace-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clplace-core' ),
				'label_off'    => __( 'Hide', 'clplace-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'cat_visibility',
			[
				'label'        => __( 'Category Visibility', 'clplace-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clplace-core' ),
				'label_off'    => __( 'Hide', 'clplace-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'date_visibility',
			[
				'label'        => __( 'Date Visibility', 'clplace-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clplace-core' ),
				'label_off'    => __( 'Hide', 'clplace-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'comment_visibility',
			[
				'label'        => __( 'Comment Visibility', 'clplace-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clplace-core' ),
				'label_off'    => __( 'Hide', 'clplace-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);

		$this->add_control(
			'reading_visibility',
			[
				'label'        => __( 'Reading Visibility', 'clplace-core' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'clplace-core' ),
				'label_off'    => __( 'Hide', 'clplace-core' ),
				'return_value' => 'yes',
				'default'      => false,
			]
		);
		$this->end_controls_section();
    }

	protected function __readmore_settings_controls() {
		$this->start_controls_section(
			'readmore_style',
			[
				'label' => __( 'Read More Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'readmore_visibility',
			[
				'label'   => __( 'Read More Visibility', 'clplace-core' ),
				'type'    => Controls_Manager::CHOOSE,
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
				'default' => 'hidden',
			]
		);

		$this->add_control(
			'readmore_text',
			[
				'label'       => __( 'Button Text', 'clplace-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => __( 'See Details', 'clplace-core' ),
				'placeholder' => __( 'Type your title here', 'clplace-core' ),
				'condition'   => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'readmore_typography',
				'selector'  => '{{WRAPPER}} .clplace-button .btn',
				'condition' => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_control(
			'readmore_spacing',
			[
				'label'              => __( 'Button Spacing', 'clplace-core' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'allowed_dimensions' => 'vertical',
				'default'            => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false,
				],
				'selectors'          => [
					'{{WRAPPER}} .clplace-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'          => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_control(
			'readmore_padding',
			[
				'label'      => __( 'Button Padding', 'clplace-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .clplace-button .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Radius', 'clplace-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .clplace-button .btn' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);


		//Button style Tabs
		$this->start_controls_tabs(
			'readmore_style_tabs', [
				'condition' => [
					'readmore_visibility' => [ 'visible' ],
				],
			]
		);

		$this->start_controls_tab(
			'readmore_style_normal_tab',
			[
				'label' => __( 'Normal', 'clplace-core' ),
			]
		);

		$this->add_control(
			'readmore_color',
			[
				'label'     => __( 'Font Color', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .clplace-button .btn' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'readmore_bg',
			[
				'label'     => __( 'Background Color', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .clplace-button .btn' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .clplace-button .btn',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'readmore_style_hover_tab',
			[
				'label' => __( 'Hover', 'clplace-core' ),
			]
		);

		$this->add_control(
			'readmore_color_hover',
			[
				'label'     => __( 'Font Color hover', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .clplace-button .btn:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'readmore_bg_hover',
			[
				'label'     => __( 'Background Color hover', 'clplace-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .clplace-button .btn:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'hover_border',
				'selector' => '{{WRAPPER}} .clplace-button .btn:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
    }

	protected function __post_card_settings_controls() {
		$this->start_controls_section(
			'post_card_style',
			[
				'label' => __( 'Post Card Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .rt-el-post-wrapper.blog-grid .blog-box.grid-style',
			]
		);

		$this->add_control(
			'main_box_radius',
			[
				'label'      => __( 'Main Box Radius', 'clplace-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .rt-el-post-wrapper.blog-grid .blog-box.grid-style' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_box_padding',
			[
				'label'      => __( 'Content Box Padding', 'clplace-core' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .clplace-post-card .entry-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
    }

	protected function render() {
		$data = $this->get_settings();

		$template = 'view-1';
		if ( 'grid-2' == $data['layout'] ) {
			$template = 'view-2';
		} elseif ( 'grid-3' == $data['layout'] ) {
			$template = 'view-3';
		} elseif ( 'grid-4' == $data['layout'] ) {
			$template = 'view-4';
		} elseif ( 'grid-5' == $data['layout'] ) {
			$template = 'view-5';
		}

		$args = [
			'post_type'           => 'post',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $data['post_limit'],
			'post_status'         => 'publish',
		];
		if ( ! empty ( $data['orderby'] ) ) {
			$args['orderby'] = $data['orderby'];
		}
		if ( ! empty( $data['order'] ) ) {
			$args['order'] = $data['order'];
		}

		if ( $data['post_source'] == 'by_category' && $data['categories'] ) :
			$args = wp_parse_args(
				[
					'cat' => $data['categories'],
				]
				, $args );
		endif;

		if ( $data['post_source'] == 'by_tags' && $data['tags'] ) :
			$args = wp_parse_args(
				[
					'tag_slug__in' => $data['tags'],
				]
				, $args );
		endif;

		if ( $data['post_source'] == 'by_id' && $data['post_id'] ) :
			$post_ids         = explode( ',', $data['post_id'] );
			$args['post__in'] = $post_ids;
		endif;

		if ( $data['exclude'] ) :
			$excluded_ids         = explode( ',', $data['exclude'] );
			$args['post__not_in'] = $excluded_ids;
		endif;

		if ( $data['offset'] ) {
			$args['offset'] = $data['offset'];
		}

		$query               = new \WP_Query( $args );
		$gird_column_desktop = $data['gird_column_desktop'] ?? '4';
		$gird_column_tab     = $data['gird_column_tab'] ?? '6';
		$gird_column_mobile  = $data['gird_column_mobile'] ?? '6';

		$col_class = "col-lg-{$gird_column_desktop} col-md-{$gird_column_tab} col-sm-{$gird_column_mobile}";
		?>
        <div class="rt-el-post-wrapper blog-<?php echo esc_attr( $data['layout'] ) ?>">
			<?php if ( $query->have_posts() ) : ?>
                <div class="row justify-content-center">
					<?php while ( $query->have_posts() ) : $query->the_post();
						echo '<article class="clplace-post-card ' . esc_attr( $col_class ) . '">';
						Fns::get_template( "elementor/post/$template", $data );
						echo '</article>';
					endwhile; ?>
                </div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
        </div>
		<?php
	}
}