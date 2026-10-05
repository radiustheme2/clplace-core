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
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use RT\ClplaceCore\Abstracts\ElementorBase;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ListingCategoriesFilter extends ElementorBase {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'Listing Cats Filter', 'clplace-core' );
		$this->rt_base = 'rt-listing-categories-filter';
		parent::__construct( $data, $args );
	}


	protected function register_controls() {

		/* -- Content Settings -- */
		$this->__portfolio_post_content_settings();
		$this->__portfolio_post_layout_settings();
		$this->__portfolio_post_grid_settings();
		$this->__visibility_settings();
		/* -- Style Settings -- */
		$this->__portfolio_post_box_style();
		$this->__portfolio_post_thumbnail_style();
		$this->__portfolio_post_title_style();
		$this->__portfolio_post_content_style();
		$this->__portfolio_post_link_style();
	}

	protected function __portfolio_post_content_settings(){
		$this->start_controls_section(
			'Portfolio_post_content_settings',
			[
				'label' => esc_html__( 'Content Settings', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'Portfolios_post_options',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Content Settings', 'clplace-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'post_limit',
			[
				'label'       => __( 'Post Limit', 'clplace-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post Limit', 'clplace-core' ),
				'description' => __( 'Enter number of post to show.', 'clplace-core' ),
				'default'     => '3',
			]
		);
		$this->add_control(
			'post_excerpt',
			[
				'label'       => __( 'Post Excerpt', 'clplace-core' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Post Excerpt Limit', 'clplace-core' ),
				'description' => __( 'Enter number of post word to show.', 'clplace-core' ),
				'default'     => '8',
			]
		);
		$this->add_control(
			'post_source',
			[
				'label'       => __( 'Post Source', 'clplace-core' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'most_recent' => __( 'From all recent post', 'clplace-core' ),
					'by_title'       => __( 'By Post ID', 'clplace-core' ),
					'by_category' => __( 'By Category', 'clplace-core' ),
					'by_tags'     => __( 'By Tags', 'clplace-core' ),
				],
				'default'     => [ 'most_recent' ],
				'description' => __( 'Select posts source that you like to show.', 'clplace-core' ),
			]
		);
		$this->add_control(
			'titles',
			[
				'label'       => __( 'Choose Titles', 'clplace-core' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->rt_blog_posts_title(),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_title',
				],
				'description' => __( 'Select post category\'s.', 'clplace-core' ),
			]
		);

		$this->add_control(
			'categories',
			[
				'label'       => __( 'Choose Categories', 'clplace-core' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => $this->listing_terms_slug('rtcl_category'),
				'label_block' => true,
				'condition'   => [
					'post_source' => 'by_category',
				],
				'description' => __( 'Select post category\'s.', 'clplace-core' ),
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
				'label'   => esc_html__( 'Order by', 'clplace-core' ),
				'type'    =>Controls_Manager::SELECT,
				'options' => [
					'date'           => esc_html__( 'Date', 'clplace-core' ),
					'ID'             => esc_html__( 'Order by post ID', 'clplace-core' ),
					'author'         => esc_html__( 'Author', 'clplace-core' ),
					'title'          => esc_html__( 'Title', 'clplace-core' ),
					'modified'       => esc_html__( 'Last modified date', 'clplace-core' ),
					'comment_count'  => esc_html__( 'Number of comments', 'clplace-core' ),
					'rand'           => esc_html__( 'Random order', 'clplace-core' ),
				],
			]
		);
		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Sort order', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'ASC'  => esc_html__( 'ASC', 'clplace-core' ),
					'DESC' => esc_html__( 'DESC', 'clplace-core' ),
				],
			]
		);
		$this->add_control(
			'readmore',
			[
				'label'        => esc_html__( 'Read More Button', 'clplace-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'clplace-core' ),
				'label_off'    => esc_html__( 'Hide', 'clplace-core' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'post_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'full',
			]
		);
		$this->end_controls_section();
	}

	protected function __portfolio_post_layout_settings() {
		$this->start_controls_section(
			'Portfolio_post_layout_settings',
			[
				'label' => esc_html__( 'Layouts Settings', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		//Image selector
		$this->add_control(
			'styles',
			[
				'label' => esc_html__('Design Style', 'clplace-core'),
//				'type' => ImageSelectorControl::ImageSelector,
				'type' => 'rt-image-select',
				'options' => [
					'1' => [
						'title' => esc_html__('Style 1', 'clplace-core'),
						'url' =>  trailingslashit( get_template_directory_uri() ) . 'assets/img/theme/portfolio-1.jpg',
					],
					'2' => [
						'title' => esc_html__('Style 2', 'clplace-core'),
						'url' => trailingslashit( get_template_directory_uri() ) . 'assets/img/theme/portfolio-2.jpg',
					],
					'3' => [
						'title' => esc_html__('Style 3', 'clplace-core'),
						'url' => trailingslashit( get_template_directory_uri() ) . 'assets/img/theme/portfolio-3.jpg',
					],
					'4' => [
						'title' => esc_html__('Style 4', 'clplace-core'),
						'url' => trailingslashit( get_template_directory_uri() ) . 'assets/img/theme/portfolio-4.jpg',
					],
				],
				'default' => '1',
			]
		);
		$this->add_control(
			'Portfolios_layout_options',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Layout Settings', 'clplace-core' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'layouts',
			[
				'type'    	  => Controls_Manager::SELECT,
				'label'   	  => esc_html__( 'Layouts', 'clplace-core' ),
				'options' 	  => array(
					'grid' => esc_html__( 'Grid', 'clplace-core' ),
					'masonry' => esc_html__( 'Masonry', 'clplace-core' ),
					'slider' => esc_html__( 'Slider', 'clplace-core' ),
					'list' => esc_html__( 'List', 'clplace-core' ),
				),
				'default' 	  => 'grid',
				'description' => esc_html__( 'Portfolio Layout. Default: Grid', 'clplace-core' ),
			]
		);
		$this->end_controls_section();
	}

	protected function __portfolio_post_grid_settings() {
		$this->start_controls_section(
			'grid_settings',
			[
				'label'     => esc_html__( 'Grid Settings', 'clplace-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						['name' => 'layouts', 'operator' => '==', 'value' => 'grid'],
						['name' => 'masonry_layouts', 'operator' => '==', 'value' => '1'],
					],
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
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						['name' => 'layouts', 'operator' => '==', 'value' => 'grid'],
						['name' => 'masonry_layouts', 'operator' => '==', 'value' => '1'],
					],
				],
			]
		);

		$this->start_popover();
		$this->add_control(
			'grid_column_desktop',
			[
				'label'   => esc_html__( 'Grid Column for Desktop', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => $this->rt_grid_options(),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						['name' => 'layouts', 'operator' => '==', 'value' => 'grid'],
						['name' => 'masonry_layouts', 'operator' => '==', 'value' => '1'],
					],
				],
			]
		);
		$this->add_control(
			'grid_column_tab',
			[
				'label'   => esc_html__( 'Grid Column for Tab', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '2',
				'options' => $this->rt_grid_options(),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						['name' => 'layouts', 'operator' => '==', 'value' => 'grid'],
						['name' => 'masonry_layouts', 'operator' => '==', 'value' => '1'],
					],
				],
			]
		);
		$this->add_control(
			'grid_column_mobile',
			[
				'label'   => esc_html__( 'Grid Column for Mobile', 'clplace-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => $this->rt_grid_options(),
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						['name' => 'layouts', 'operator' => '==', 'value' => 'grid'],
						['name' => 'masonry_layouts', 'operator' => '==', 'value' => '1'],
					],
				],
			]
		);
		$this->end_popover();

		$this->end_controls_section();
	}

	protected function __visibility_settings() {
		$this->start_controls_section(
			'visibility_settings',
			[
				'label'     => esc_html__( 'Visibility Settings', 'clplace-core' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'rtcl_show_types',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => __( 'Show Types', 'clplace-core' ),
				'label_on'    => __( 'On', 'clplace-core' ),
				'label_off'   => __( 'Off', 'clplace-core' ),
				'default'     => '',
				'description' => __( 'Show or Hide Types. Default: On', 'clplace-core' ),
			]
		);
		$this->add_control(
			'rtcl_show_labels',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => __( 'Show Badge', 'clplace-core' ),
				'label_on'    => __( 'On', 'clplace-core' ),
				'label_off'   => __( 'Off', 'clplace-core' ),
				'default'     => '',
				'description' => __( 'Show or Hide labels. Default: On', 'clplace-core' ),
			]
		);
		$this->add_control(
			'rtcl_show_image',
			[
				'type'        => Controls_Manager::SWITCHER,
				'label'       => __( 'Show Badge', 'clplace-core' ),
				'label_on'    => __( 'On', 'clplace-core' ),
				'label_off'   => __( 'Off', 'clplace-core' ),
				'default'     => 'yes',
				'description' => __( 'Show or Hide labels. Default: On', 'clplace-core' ),
			]
		);
		$this->add_control(
			'rtcl_show_favourites',
			[
				'type'      => Controls_Manager::SWITCHER,
				'label'     => __( 'Show Favourites', 'clplace-core' ),
				'label_on'  => __( 'On', 'clplace-core' ),
				'label_off' => __( 'Off', 'clplace-core' ),
				'default'   => 'yes',
			]
		);
		$this->end_controls_section();
	}

	protected function __portfolio_post_box_style() {
		$this->start_controls_section(
			'portfolio_post_box_style',
			[
				'label' => esc_html__( 'Post Box Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'portfolio_post_box_bg_color',
				'label'    => esc_html__( 'Background', 'clplace-core' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background Color', 'clplace-core'),
					]
				],
				'selector' => '{{WRAPPER}} .ayo-portfolio-box.el-portfolio-box',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'portfolio_post_box_border',
				'label'     => __( 'Border', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .ayo-portfolio-box.el-portfolio-box',
			]
		);
		$this->add_control(
			'portfolio_post_box_border',
			[
				'label' => esc_html__( 'Border Radius', 'clplace-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ayo-portfolio-box.el-portfolio-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'portfolio_post_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .ayo-portfolio-box.el-portfolio-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
			]
		);
		$this->end_controls_section();
	}

	protected function __portfolio_post_thumbnail_style() {
		$this->start_controls_section(
			'portfolio_post_thumb_style',
			[
				'label' => esc_html__( 'Thumbnail Image', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'thum_display',
			[
				'label' => esc_html__( 'Thumb', 'clplace-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'clplace-core' ),
				'label_off' => esc_html__( 'Hide', 'clplace-core' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'thumb_size_width',
			[
				'label'      => __( 'Thumb Size Width', 'clplace-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 1200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .el-portfolio-box .item-img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .el-portfolio-box .item-img img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->add_control(
			'thumb_size_height',
			[
				'label'      => __( 'Thumb Size Height', 'clplace-core' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 600,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .el-portfolio-box .item-img' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .el-portfolio-box .item-img img' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'clplace-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .el-portfolio-box .item-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->add_control(
			'portfolio_post_thumb_hover_style',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Hover Style', 'clplace-core' ),
				'separator' => 'before',
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'portfolio_post_thumb_hover_overlay1',
				'label'    => esc_html__( 'Background', 'clplace-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Overlay 1', 'clplace-core'),
						'default' => 'classic',
					]
				],
				'selector'  => '{{WRAPPER}} .ayo-portfolio-box.style-1 .item-img::before',
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'portfolio_post_thumb_hover_overlay2',
				'label'    => esc_html__( 'Background', 'clplace-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Overlay 2', 'clplace-core'),
						'default' => 'classic',
					]
				],
				'selector'  => '{{WRAPPER}} .ayo-portfolio-box.style-1 .item-img::after',
				'condition'=>[
					'thum_display' =>'yes'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'portfolio_post_thumb_hover_overlay2_border',
				'label'     => __( 'Border', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .ayo-portfolio-box.style-1 .item-img::after',
				'condition'=> [
					'thum_display' =>'yes'
				]
			]
		);
		$this->end_controls_section();
	}

	protected function __portfolio_post_title_style() {
		$this->start_controls_section(
			'portfolio_post_title_style',
			[
				'label' => esc_html__( 'Title Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'portfolio_post_title_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .title-cat-wrapper .list-title a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ayo-portfolio-box .content .title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'portfolio_post_title_typo',
				'label'    => esc_html__( 'Typography', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .ayo-portfolio-box .content .title a, {{WRAPPER}} .title-cat-wrapper .list-title a',
			]
		);
		$this->add_control(
			'portfolio_post_title_hover_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Hover Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .title-cat-wrapper:hover .list-title a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ayo-portfolio-box .content .title a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function __portfolio_post_content_style() {
		$this->start_controls_section(
			'portfolio_post_content_style',
			[
				'label' => esc_html__( 'Content', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'portfolio_post_content_color',
			[
				'type'      => Controls_Manager::COLOR,
				'label'     => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => [
					'{{WRAPPER}} .ayo-portfolio-box .content p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'portfolio_post_content_typo',
				'label'    => esc_html__( 'Typography', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .ayo-portfolio-box .content p',
			]
		);
		$this->end_controls_section();
	}

	// Button Style
	protected function __portfolio_post_link_style() {
		$this->start_controls_section(
			'portfolio_post_link_style',
			[
				'label' => esc_html__( 'Read More Style', 'clplace-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'portfolio_post_link_heading',
			[
				'type' => Controls_Manager::HEADING,
				'label'   => esc_html__( 'Read More Style', 'clplace-core' ),
				'separator' => 'before',
				'condition' => ['readmore' => 'yes'],
			]
		);

		$this->start_controls_tabs( 'portfolio_post_link_tab_style' );
		// Normal tab.
		$this->start_controls_tab(
			'portfolio_post_link_style_normal',
			[
				'label' => __( 'Normal', 'clplace-core' ),
				'condition' => ['readmore' => 'yes'],
			]
		);

		$this->add_control(
			'portfolio_post_link_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .ayo-portfolio-box .list-button' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ayo-portfolio-box .content .post-btn a' => 'color: {{VALUE}}',
				),
				'condition' => ['readmore' => 'yes'],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'portfolio_post_link_typo',
				'label'    => esc_html__( 'Typography', 'clplace-core' ),
				'selector' => '{{WRAPPER}} .ayo-portfolio-box .content .post-btn a, {{WRAPPER}} .ayo-portfolio-box .list-button',
				'condition' => ['readmore' => 'yes'],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'portfolio_post_link_bg_color',
				'label'    => esc_html__( 'Background', 'clplace-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__(' Background', 'clplace-core'),
						'default' => 'classic',
					]
				],
				'selector'  => '{{WRAPPER}} .ayo-portfolio-box .content .post-btn a, {{WRAPPER}} .ayo-portfolio-box .list-button',
				'condition' => ['readmore' => 'yes'],
			]
		);
		$this->add_responsive_control(
			'portfolio_post_link_padding',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Padding', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .ayo-portfolio-box .list-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .ayo-portfolio-box .content .post-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
				'condition' => ['readmore' => 'yes'],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'portfolio_post_link_border',
				'label'     => __( 'Border', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .ayo-portfolio-box .content .post-btn a, {{WRAPPER}} .ayo-portfolio-box .list-button',
				'condition' => ['readmore' => 'yes'],
			]
		);
		$this->add_responsive_control(
			'portfolio_post_link_border_radius',
			[
				'type'    => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'label'   => esc_html__( 'Radius', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .title-cat-wrapper .list-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
					'{{WRAPPER}} .ayo-portfolio-box .content .post-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				),
				'condition' => ['readmore' => 'yes'],
			]
		);
		$this->end_controls_tab();

		// Hover tab.
		$this->start_controls_tab(
			'portfolio_post_link_style_hover',
			[
				'label' => __( 'Hover', 'clplace-core' ),
				'condition' => ['readmore' => 'yes'],
			]
		);
		$this->add_control(
			'portfolio_post_link_hover_color',
			[
				'type'    => Controls_Manager::COLOR,
				'label'   => esc_html__( 'Color', 'clplace-core' ),
				'selectors' => array(
					'{{WRAPPER}} .title-cat-wrapper:hover .list-button' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ayo-portfolio-box .content .post-btn a:hover' => 'color: {{VALUE}}',
				),
				'condition' => ['readmore' => 'yes'],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'portfolio_post_link_hover_bg_color',
				'label'    => esc_html__( 'Background', 'clplace-core' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'fields_options' => [
					'background' => [
						'label' => esc_html__(' Background', 'clplace-core'),
						'default' => 'classic',
					]
				],
				'selector'  => '{{WRAPPER}} .ayo-portfolio-box .content .post-btn a:hover, {{WRAPPER}} .title-cat-wrapper:hover .list-button',
				'condition' => ['readmore' => 'yes'],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'portfolio_post_link_hover_border',
				'label'     => __( 'Border', 'clplace-core' ),
				'selector'  => '{{WRAPPER}} .ayo-portfolio-box .content .post-btn a:hover, {{WRAPPER}} .title-cat-wrapper:hover .list-button',
				'condition' => ['readmore' => 'yes'],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$data = $this->get_settings();

		$data['rtcl_thumb_image_size'] = 'full';

		$template = 'view-1';

		Fns::get_template( "elementor/listing-categories-filter/$template", $data );
	}

}