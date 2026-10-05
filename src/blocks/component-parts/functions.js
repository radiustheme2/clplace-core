/**
 *
 * @param attributes
 * @param className
 * @returns {*}
 */
export function get_parent_class_list({props}) {
    const {attributes, className} = props;
    const {
        full_wrapper_align,
        filter_type,
        section_title_style,
        section_title_alignment,
        show_pagination,
        ajax_pagination_type,
        show_meta,
        hover_animation,
        title_visibility_style,
        title_position,
        title_hover_underline,
        meta_position,
        author_icon_visibility,
        show_author_image,
        category_position,
        readmore_btn_style,
        grid_hover_overlay_type,
        grid_hover_overlay_height,
        on_hover_overlay,
        title_border_visibility,
        title_alignment,
        filter_v_alignment,
        border_style,
        filter_next_prev_btn,
        filter_h_alignment,
        is_box_border,
        arrow_position,
        dots,
        dots_style,
        lazyLoad,
        carousel_overflow,
        slider_direction,
        dots_text_align,
        acf_label_style,
        acf_alignment,
        pagination_btn_space_btween,
        pagination_btn_position,
        box_border_bottom,
        category_style,
        offset_img_position,
        scroll_visibility,
        enable_external_link
    } = attributes;


    let dynamicParentClass;
    dynamicParentClass = ' ' + className;
    dynamicParentClass += full_wrapper_align?.lg ? ' tpg-wrapper-align-' + full_wrapper_align?.lg : '';
    dynamicParentClass += ' tpg-filter-type-' + filter_type;
    dynamicParentClass += ' pagination-visibility-' + show_pagination;
    dynamicParentClass += ' ajax-pagination-type-next-prev-' + ajax_pagination_type;
    dynamicParentClass += ' meta-visibility-' + show_meta;
    dynamicParentClass += ' section-title-style-' + section_title_style;
    dynamicParentClass += ' section-title-align-' + section_title_alignment;
    dynamicParentClass += ' img_hover_animation_' + hover_animation;
    dynamicParentClass += ' title-' + title_visibility_style;
    dynamicParentClass += ' title_position_' + title_position;
    dynamicParentClass += ' title_hover_border_' + title_hover_underline;
    dynamicParentClass += ' meta_position_' + meta_position;
    dynamicParentClass += ' tpg-is-author-icon-' + author_icon_visibility;
    dynamicParentClass += ' author-image-visibility-' + show_author_image;
    dynamicParentClass += ' tpg-category-position-' + category_position;
    dynamicParentClass += ' readmore-btn-' + readmore_btn_style;
    dynamicParentClass += ' grid-hover-overlay-type-' + grid_hover_overlay_type;
    dynamicParentClass += ' grid-hover-overlay-height-' + grid_hover_overlay_height;
    dynamicParentClass += ' hover-overlay-height-' + on_hover_overlay;
    dynamicParentClass += ' tpg-title-border-' + title_border_visibility;
    dynamicParentClass += ' title-alignment-' + title_alignment;
    dynamicParentClass += ' tpg-filter-alignment-' + filter_v_alignment;
    dynamicParentClass += ' filter-button-border-' + border_style;
    dynamicParentClass += ' filter-nex-prev-btn-' + filter_next_prev_btn;
    dynamicParentClass += ' tpg-filter-h-alignment-' + filter_h_alignment;
    dynamicParentClass += ' tpg-el-box-border-' + is_box_border;
    dynamicParentClass += pagination_btn_space_btween === 'space-between' ? ' tpg-prev-next-space-between' : '';
    dynamicParentClass += pagination_btn_position === 'absolute' ? ' tpg-prev-next-absolute' : '';
    dynamicParentClass += box_border_bottom === 'enable' ? ' tpg-border-bottom-enable' : '';
    dynamicParentClass += offset_img_position === 'offset-image-right' ? ' offset-image-right' : '';
    dynamicParentClass += ' tpg-cat-' + category_style;

    //Slider layout
    dynamicParentClass += ' slider-arrow-position-' + arrow_position;
    dynamicParentClass += ' slider-dot-enable-' + dots;
    dynamicParentClass += ' slider-dots-style-' + dots_style;
    dynamicParentClass += ' is-lazy-load-' + lazyLoad;
    dynamicParentClass += ' is-carousel-overflow-' + carousel_overflow;
    dynamicParentClass += ' slider-direction-' + slider_direction;
    dynamicParentClass += ' slider-dots-align-' + dots_text_align;
    dynamicParentClass += scroll_visibility === 'yes' ? '' : ' slider-scroll-hide';
    dynamicParentClass += enable_external_link === 'show' ? ' has-external-link' : '';


    //ACF
    dynamicParentClass += ' act-label-style-' + acf_label_style;
    dynamicParentClass += ' tpg-acf-align-' + acf_alignment;

    return dynamicParentClass;
}

export function get_el_thumb_cat({attributes, post}, classes = 'cat-over-image') {
    const {prefix, show_meta, show_category, category_position, category_style, show_cat_icon} = attributes;
    let postLayout = prefix + "_layout";
    if (!('show' === show_meta && 'show' === show_category)) {
        return null
    }
    const {category, category_bg} = post;
    const countCat = category.length;
    let categoryPosition = category_position;
    if (['grid-layout4', 'slider-layout3'].includes(attributes[postLayout]) && category_position === 'default') {
        categoryPosition = 'top_left';
    }

    return (
        <div className={`tpg-separate-category ${category_style} ${categoryPosition} ${classes}`}>
            <span className="categories-links">
                {show_cat_icon === 'yes' && <i className="fas fa-folder-open"></i>}
                {category && category.map((cat, index) => {
                    return (
                        <>
                            <a href="#"
                               style={{"--tpg-primary-color": category_bg[index] ? category_bg[index] : ''}}>{cat}</a>
                            {(index + 1) !== countCat && <span className="rt-separator">,</span>}
                        </>
                    )
                })}
            </span>
        </div>
    )
}

export const el_ignore_layout = (layout, category_position) => {
    const allLayout = [
        'grid-layout4',
        'grid-layout5',
        'grid-layout5-2',
        'grid-layout6',
        'grid-layout6-2',
        'list-layout4',
        'list-layout5',
        'grid_hover-layout5',
        'grid_hover-layout6',
        'grid_hover-layout7',
        'grid_hover-layout8',
        'grid_hover-layout9',
        'grid_hover-layout10',
        'grid_hover-layout5-2',
        'grid_hover-layout6-2',
        'grid_hover-layout7-2',
        'grid_hover-layout9-2',
        'grid_hover-layout11',
        'slider-layout3',
        'slider-layout5',
        'slider-layout6',
        'slider-layout7',
        'slider-layout8',
        'slider-layout9',
        'slider-layout11',
        'slider-layout12'
    ];
    return !(category_position === 'default' && allLayout.includes(layout));
}

export const change_icon = (fontawesome, flaticon) => {
    if (rtParams.iconFont === 'fontawesome') {
        return fontawesome;
    } else {
        return 'flaticon-tpg-' + flaticon;
    }
}