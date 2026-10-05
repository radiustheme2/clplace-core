const {__} = wp.i18n;
import {
    __experimentalBorderControl as BorderControl, __experimentalHeading as Heading,
    __experimentalNumberControl as NumberControl
} from '@wordpress/components';
import {Button, ButtonGroup, PanelBody, SelectControl} from "@wordpress/components";
import {NORMAL_HOVER, TPG_COLOR_PALATE} from "../../components/Constants";
import {BOX_HOVER} from "../../components/Constants";
import Color from "../../components/Color";
import Dimension from "../../components/Dimension";
import RangeDevice from "../../components/RangeDevice";

function SocialShareStyle(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        prefix,
        show_social_share,
        social_icon_margin,
        social_wrapper_margin,
        social_icon_radius,
        icon_font_size,
        main_wrapper_hover_tab,
        social_icon_color,
        social_icon_bg_color,
        social_icon_border,
        social_icon_color_hover,
        social_icon_bg_color_hover,
        social_icon_border_hover,
        social_icon_width,
        social_icon_height,
        social_icon_color_box_hover,
        social_icon_bg_color_box_hover
    } = attributes;

    let postLayout = prefix + "_layout";

    if (!(show_social_share === 'show' && attributes[postLayout] !== 'grid-layout7')) {
        return '';
    }

    return (
        <PanelBody title={__('Social Share', 'clplace-core')} initialOpen={false}>

            <Dimension
                label={__("Icon Margin", "clplace-core")}
                type="margin" responsive
                value={social_icon_margin}
                onChange={(value) => {
                    setAttributes({social_icon_margin: value})
                }}
            />

            <Dimension
                label={__("Icon Wrapper Spacing", "clplace-core")}
                type="margin" responsive
                value={social_wrapper_margin}
                onChange={(value) => {
                    setAttributes({social_wrapper_margin: value})
                }}
            />

            <Dimension
                label={__("Border Radius", "clplace-core")}
                type="borderRadius" responsive
                value={social_icon_radius}
                onChange={(value) => {
                    setAttributes({social_icon_radius: value})
                }}
            />

            <div className="rttpg-image-dimension">

                <label
                    className="components-base-control__label components-input-control__label"
                    htmlFor="react-select-2-input">
                    {__('Icon Width & Height', 'clplace-core')}
                </label>


                <NumberControl
                    // label={ __( "Width", "clplace-core" ) }
                    className="rttpg-control-field"
                    max={2000}
                    min={1}
                    placeholder="Width"
                    step="1"
                    value={social_icon_width}
                    onChange={(social_icon_width) => setAttributes({social_icon_width})}
                />

                <NumberControl
                    // label={ __( "Height", "clplace-core" ) }
                    className="rttpg-control-field"
                    max={2000}
                    min={1}
                    placeholder="Height"
                    step="1"
                    value={social_icon_height}
                    onChange={(social_icon_height) => setAttributes({social_icon_height})}
                />

            </div>

            <RangeDevice
                label={__('Icon Size')}
                responsive={true}
                value={icon_font_size}
                min={0}
                max={100}
                step={1}
                onChange={(val) => setAttributes({icon_font_size: val})}
            />

            <Heading className="rttpg-control-heading">{__("Appearance & Behavior:", "clplace-core")}</Heading>

            <ButtonGroup className="rttpg-btn-group rttpg-btn-group-state rttpg-bottom-border-radius-none">
                {BOX_HOVER.map((item, key) => (
                    <Button
                        key={key}
                        isPrimary={main_wrapper_hover_tab === item.value}
                        isSecondary={main_wrapper_hover_tab !== item.value}
                        onClick={() => setAttributes({main_wrapper_hover_tab: item.value})}
                    >
                        {item.label}
                    </Button>
                ))}
            </ButtonGroup>

            {/*social_share_style_tabs*/}
            {main_wrapper_hover_tab === 'normal' &&
                <div className="rttpg-ground-control">
                    <Color
                        label={__('Icon color', 'clplace-core')}
                        color={social_icon_color}
                        onChange={(social_icon_color) => setAttributes({social_icon_color})}
                    />
                    <Color
                        label={__('Icon Background', 'clplace-core')}
                        color={social_icon_bg_color}
                        onChange={(social_icon_bg_color) => setAttributes({social_icon_bg_color})}
                    />

                    <BorderControl
                        colors={TPG_COLOR_PALATE}
                        value={social_icon_border}
                        label={__("Icon Border", "clplace-core")}
                        onChange={(val) => {
                            const newVal = {openTpgBorder: 1, ...val}
                            setAttributes({social_icon_border: newVal})
                        }}
                        withSlider
                    />

                </div>
            }

            {main_wrapper_hover_tab === 'hover' &&
                <div className="rttpg-ground-control">

                    <Color
                        label={__('Icon color - Hover', 'clplace-core')}
                        color={social_icon_color_hover}
                        onChange={(social_icon_color_hover) => setAttributes({social_icon_color_hover})}
                    />

                    <Color
                        label={__('Icon Background - Hover', 'clplace-core')}
                        color={social_icon_bg_color_hover}
                        onChange={(social_icon_bg_color_hover) => setAttributes({social_icon_bg_color_hover})}
                    />

                    <BorderControl
                        colors={TPG_COLOR_PALATE}
                        value={social_icon_border_hover}
                        label={__("Icon Border - Hover", "clplace-core")}
                        onChange={(val) => {
                            const newVal = {openTpgBorder: 1, ...val}
                            setAttributes({social_icon_border_hover: newVal})
                        }}
                        withSlider
                    />
                </div>
            }

            {main_wrapper_hover_tab === 'box_hover' &&
                <div className="rttpg-ground-control">

                    <Color
                        label={__('Icon color - Hover', 'clplace-core')}
                        color={social_icon_color_box_hover}
                        onChange={(social_icon_color_box_hover) => setAttributes({social_icon_color_box_hover})}
                    />

                    <Color
                        label={__('Icon Background - Hover', 'clplace-core')}
                        color={social_icon_bg_color_box_hover}
                        onChange={(social_icon_bg_color_box_hover) => setAttributes({social_icon_bg_color_box_hover})}
                    />

                </div>
            }

        </PanelBody>
    );
}

export default SocialShareStyle;
