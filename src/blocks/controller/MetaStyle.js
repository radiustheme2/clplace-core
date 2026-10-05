import Alignment from "../../components/Alignment";

const {__} = wp.i18n;
import {__experimentalHeading as Heading} from '@wordpress/components';
import {Button, ButtonGroup, PanelBody} from "@wordpress/components";
import {BOX_HOVER} from "../../components/Constants";
import Typography from "../../components/Typography";
import Color from "../../components/Color";
import Dimension from "../../components/Dimension";
import Range from "../../components/Range";

function MetaStyle(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        prefix,
        show_meta,
        post_meta_typography,
        postmeta_alignment,
        meta_wrap_spacing,
        meta_spacing,
        category_position,
        separator_cat_typography,
        category_margin_bottom,
        category_radius,
        category_padding,
        meta_info_style_tabs,
        meta_info_color,
        meta_link_color,
        meta_separator_color,
        meta_icon_color,
        separate_category_color,
        separate_category_bg,
        show_cat_icon,
        separate_category_icon_color,
        meta_link_colo_hover,
        separate_category_color_hover,
        separate_category_bg_hover,
        meta_link_colo_box_hover,
        separate_category_color_box_hover,
        separate_category_bg_box_hover,
        separate_category_icon_color_box_hover,
        category_style,
        meta_separator,
        post_footer_border_color,
        author_image_width
    } = attributes;

    let postLayout = prefix + "_layout";

    if (!(attributes[postLayout] !== 'grid-layout7' && show_meta === 'show')) {
        return '';
    }

    return (
        <PanelBody title={__('Meta Data', 'clplace-core')} initialOpen={false}>

            <Typography
                label={__('Meta Typography')}
                value={post_meta_typography}
                onChange={(val) => setAttributes({post_meta_typography: val})}
            />

            <Alignment
                label={__("Alignment", "clplace-core")}
                options={['left', 'center', 'right']}
                responsive={true}
                value={postmeta_alignment}
                onChange={postmeta_alignment => setAttributes({postmeta_alignment})}
            />

            <Dimension
                label={__("Meta Wrapper Spacing", "clplace-core")}
                type="margin" responsive
                value={meta_wrap_spacing}
                onChange={(value) => {
                    setAttributes({meta_wrap_spacing: value})
                }}
            />

            <Dimension
                label={__("Meta Spacing", "clplace-core")}
                type="margin" responsive
                value={meta_spacing}
                onChange={(value) => {
                    setAttributes({meta_spacing: value})
                }}
            />


            <Heading className="rttpg-control-heading">{__("Separate Category:", "clplace-core")}</Heading>
            <div className={`rttpg-ground-control`}>
                <Typography
                    label={__('Separate Cat Typography')}
                    value={separator_cat_typography}
                    onChange={(val) => setAttributes({separator_cat_typography: val})}
                />


                {category_position === 'above_title' &&
                    <Range
                        label={__("Category Margin Bottom")}
                        value={category_margin_bottom}
                        onChange={(val) => setAttributes({category_margin_bottom: val})}
                        min={0}
                        max={50}
                        step={1}
                    />
                }

                <Dimension
                    label={__("Category Border Radius", "clplace-core")}
                    type="borderRadius" responsive
                    value={category_radius}
                    onChange={(value) => {
                        setAttributes({category_radius: value})
                    }}
                />

                {category_style !== 'style3' &&
                    <>
                        <Dimension
                            label={__("Category Padding", "clplace-core")}
                            type="padding" responsive
                            value={category_padding}
                            onChange={(value) => {
                                setAttributes({category_padding: value})
                            }}
                        />
                        <small
                            className="rttpg-help">{__("NB. If you use a separate category or there is a background on a category then below options will work.", "clplace-core")}</small>
                    </>
                }
            </div>

            <Heading className="rttpg-control-heading">{__("Author Image:", "clplace-core")}</Heading>
            <Range
                label={__("Author Avater Size")}
                value={author_image_width}
                onChange={(val) => setAttributes({author_image_width: val})}
                min={0}
                max={80}
                step={1}
            />

            <Heading className="rttpg-control-heading">{__("Appearance & Behavior:", "clplace-core")}</Heading>

            {/*Category Tab*/}
            <ButtonGroup className="rttpg-btn-group rttpg-btn-group-state rttpg-bottom-border-radius-none">
                {BOX_HOVER.map((item, key) => (
                    <Button
                        key={key}
                        isPrimary={meta_info_style_tabs === item.value}
                        isSecondary={meta_info_style_tabs !== item.value}
                        onClick={() => setAttributes({meta_info_style_tabs: item.value})}
                    >
                        {item.label}
                    </Button>
                ))}
            </ButtonGroup>

            {meta_info_style_tabs === 'normal' &&
                <div className="rttpg-ground-control">
                    <Color
                        label={__('Meta Color', 'clplace-core')}
                        color={meta_info_color}
                        onChange={(meta_info_color) => setAttributes({meta_info_color})}
                    />
                    <Color
                        label={__('Meta Link Color', 'clplace-core')}
                        color={meta_link_color}
                        onChange={(meta_link_color) => setAttributes({meta_link_color})}
                    />

                    {'default' !== meta_separator &&
                        <Color
                            label={__('Separator Color', 'clplace-core')}
                            color={meta_separator_color}
                            onChange={(meta_separator_color) => setAttributes({meta_separator_color})}
                        />
                    }
                    <Color
                        label={__('Icon Color', 'clplace-core')}
                        color={meta_icon_color}
                        onChange={(meta_icon_color) => setAttributes({meta_icon_color})}
                    />
                    <hr/>
                    <Color
                        label={__('Category Color', 'clplace-core')}
                        color={separate_category_color}
                        onChange={(separate_category_color) => setAttributes({separate_category_color})}
                    />
                    <Color
                        label={__('Category Background', 'clplace-core')}
                        color={separate_category_bg}
                        onChange={(separate_category_bg) => setAttributes({separate_category_bg})}
                    />
                    {show_cat_icon === 'yes' &&
                        <Color
                            label={__('Category Icon Color', 'clplace-core')}
                            color={separate_category_icon_color}
                            onChange={(separate_category_icon_color) => setAttributes({separate_category_icon_color})}
                        />
                    }

                    {['grid-layout3', 'slider-layout2'].includes(attributes[postLayout]) &&
                        <Color
                            label={__('Footer Border Color', 'clplace-core')}
                            color={post_footer_border_color}
                            onChange={(post_footer_border_color) => setAttributes({post_footer_border_color})}
                        />
                    }
                </div>
            }

            {meta_info_style_tabs === 'hover' &&
                <div className="rttpg-ground-control">
                    <Color
                        label={__('Meta Link Color - Hover', 'clplace-core')}
                        color={meta_link_colo_hover}
                        onChange={(meta_link_colo_hover) => setAttributes({meta_link_colo_hover})}
                    />
                    <hr/>
                    <Color
                        label={__('Category Color - Hover', 'clplace-core')}
                        color={separate_category_color_hover}
                        onChange={(separate_category_color_hover) => setAttributes({separate_category_color_hover})}
                    />
                    <Color
                        label={__('Category Background - Hover', 'clplace-core')}
                        color={separate_category_bg_hover}
                        onChange={(separate_category_bg_hover) => setAttributes({separate_category_bg_hover})}
                    />

                </div>
            }

            {meta_info_style_tabs === 'box_hover' &&
                <div className="rttpg-ground-control">
                    <Color
                        label={__('Meta Color - Box Hover', 'clplace-core')}
                        color={meta_link_colo_box_hover}
                        onChange={(meta_link_colo_box_hover) => setAttributes({meta_link_colo_box_hover})}
                    />
                    <hr/>
                    <Color
                        label={__('Category Color - Hover', 'clplace-core')}
                        color={separate_category_color_box_hover}
                        onChange={(separate_category_color_box_hover) => setAttributes({separate_category_color_box_hover})}
                    />
                    <Color
                        label={__('Category Background - Box Hover', 'clplace-core')}
                        color={separate_category_bg_box_hover}
                        onChange={(separate_category_bg_box_hover) => setAttributes({separate_category_bg_box_hover})}
                    />
                    {show_cat_icon === 'yes' &&
                        <Color
                            label={__('Category Icon Color - Box Hover', 'clplace-core')}
                            color={separate_category_icon_color_box_hover}
                            onChange={(separate_category_icon_color_box_hover) => setAttributes({separate_category_icon_color_box_hover})}
                        />
                    }
                </div>
            }

        </PanelBody>
    );
}

export default MetaStyle;
