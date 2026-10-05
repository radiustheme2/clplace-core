const {__} = wp.i18n;
import {__experimentalBorderControl as BorderControl, __experimentalHeading as Heading} from '@wordpress/components';
import {Button, ButtonGroup, PanelBody, SelectControl} from "@wordpress/components";
import {BOX_HOVER, TPG_COLOR_PALATE} from "../../components/Constants";
import Typography from "../../components/Typography";
import Color from "../../components/Color";
import Dimension from "../../components/Dimension";
import RangeDevice from "../../components/RangeDevice";
import Alignment from "../../components/Alignment";

function ReadMoreStyle(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        prefix,
        show_read_more,
        readmore_typography,
        readmore_spacing,
        readmore_btn_style,
        readmore_padding,
        readmore_btn_alignment,
        readmore_icon_size,
        readmore_icon_y_position,
        readmore_style_tabs,
        readmore_text_color,
        readmore_icon_color,
        readmore_bg,
        border_radius,
        readmore_border,
        readmore_icon_margin,
        readmore_text_color_hover,
        readmore_icon_color_hover,
        readmore_bg_hover,
        border_radius_hover,
        readmore_border_hover,
        show_btn_icon,
        readmore_icon_margin_hover,
        readmore_text_color_box_hover,
        readmore_icon_color_box_hover,
        readmore_bg_box_hover,
        readmore_border_box_hover
    } = attributes;

    let postLayout = prefix + "_layout";

    if (!(show_read_more === 'show' && attributes[postLayout] !== 'grid-layout7')) {
        return '';
    }

    return (
        <PanelBody title={__('Read More', 'clplace-core')} initialOpen={false}>

            <Typography
                label={__('Typography')}
                value={readmore_typography}
                onChange={(val) => setAttributes({readmore_typography: val})}
            />

            <Alignment
                label={__("Button Alignment", "clplace-core")}
                options={['left', 'center', 'right']}
                responsive={true}
                value={readmore_btn_alignment}
                onChange={readmore_btn_alignment => setAttributes({readmore_btn_alignment})}
            />

            <hr/>

            <Dimension
                label={__("Button Spacing", "clplace-core")}
                type="margin" responsive
                value={readmore_spacing}
                onChange={(value) => {
                    setAttributes({readmore_spacing: value})
                }}
            />

            {readmore_btn_style === 'default-style' &&
                <Dimension
                    label={__("Button Padding", "clplace-core")}
                    type="padding" responsive
                    value={readmore_padding}
                    onChange={(value) => {
                        setAttributes({readmore_padding: value})
                    }}
                />
            }


            {show_btn_icon === 'yes' &&
                <>
                    <RangeDevice
                        label={__('Icon Size')}
                        responsive={true}
                        min={10}
                        max={50}
                        step={1}
                        value={readmore_icon_size}
                        onChange={(val) => setAttributes({readmore_icon_size: val})}
                    />
                    <RangeDevice
                        label={__('Icon Vertical Position')}
                        responsive={true}
                        min={-20}
                        max={20}
                        step={1}
                        value={readmore_icon_y_position}
                        onChange={(val) => setAttributes({readmore_icon_y_position: val})}
                    />
                </>
            }

            <Heading className="rttpg-control-heading">{__("Appearance & Behavior:", "clplace-core")}</Heading>

            {/*{Read More Style Tab}*/}

            <ButtonGroup className="rttpg-btn-group rttpg-btn-group-state rttpg-bottom-border-radius-none">
                {BOX_HOVER.map((item, key) => (
                    <Button
                        key={key}
                        isPrimary={readmore_style_tabs === item.value}
                        isSecondary={readmore_style_tabs !== item.value}
                        onClick={() => setAttributes({readmore_style_tabs: item.value})}
                    >
                        {item.label}
                    </Button>
                ))}
            </ButtonGroup>

            {/*TODO NORMAL TAB*/}

            {readmore_style_tabs === 'normal' &&
                <div className="rttpg-ground-control">
                    <Color
                        label={__('Text Color', 'clplace-core')}
                        color={readmore_text_color}
                        onChange={(readmore_text_color) => setAttributes({readmore_text_color})}
                    />
                    {show_btn_icon === 'yes' &&
                        <Color
                            label={__('Icon Color', 'clplace-core')}
                            color={readmore_icon_color}
                            onChange={(readmore_icon_color) => setAttributes({readmore_icon_color})}
                        />
                    }
                    {readmore_btn_style === 'default-style' &&
                        <>
                            <Color
                                label={__('Background Color', 'clplace-core')}
                                color={readmore_bg}
                                onChange={(readmore_bg) => setAttributes({readmore_bg})}
                            />
                            <Dimension
                                label={__("Border Radius", "clplace-core")}
                                type="borderRadius" responsive
                                value={border_radius}
                                onChange={(value) => {
                                    setAttributes({border_radius: value})
                                }}
                            />

                            <BorderControl
                                colors={TPG_COLOR_PALATE}
                                value={readmore_border}
                                label={__("Button Border", "clplace-core")}
                                onChange={(val) => {
                                    const newVal = {openTpgBorder: 1, ...val}
                                    setAttributes({readmore_border: newVal})
                                }}
                                withSlider
                            />

                        </>}

                    {show_btn_icon === 'yes' &&
                        <Dimension
                            label={__("Icon Spacing", "clplace-core")}
                            type="margin" responsive
                            value={readmore_icon_margin}
                            onChange={(value) => {
                                setAttributes({readmore_icon_margin: value})
                            }}
                        />
                    }

                </div>}

            {/*TODO HOVER TAB*/}

            {readmore_style_tabs === 'hover' &&
                <div className="rttpg-ground-control">
                    <Color
                        label={__('Text Color hover', 'clplace-core')}
                        color={readmore_text_color_hover}
                        onChange={(readmore_text_color_hover) => setAttributes({readmore_text_color_hover})}
                    />

                    {show_btn_icon === 'yes' &&
                        <Color
                            label={__('Icon Color - Hover', 'clplace-core')}
                            color={readmore_icon_color_hover}
                            onChange={(readmore_icon_color_hover) => setAttributes({readmore_icon_color_hover})}
                        />
                    }

                    {readmore_btn_style === 'default-style' &&
                        <>
                            <Color
                                label={__('Background Color - Hover', 'clplace-core')}
                                color={readmore_bg_hover}
                                onChange={(readmore_bg_hover) => setAttributes({readmore_bg_hover})}
                            />
                            <Dimension
                                label={__("Border Radius - Hover", "clplace-core")}
                                type="borderRadius" responsive
                                value={border_radius_hover}
                                onChange={(value) => {
                                    setAttributes({border_radius_hover: value})
                                }}
                            />

                            <BorderControl
                                colors={TPG_COLOR_PALATE}
                                value={readmore_border_hover}
                                label={__("Button Border - Hover", "clplace-core")}
                                onChange={(val) => {
                                    const newVal = {openTpgBorder: 1, important: 1, ...val}
                                    setAttributes({readmore_border_hover: newVal})
                                }}
                                withSlider
                            />
                        </>
                    }

                    {show_btn_icon === 'yes' &&
                        <Dimension
                            label={__("Icon Spacing - Hover", "clplace-core")}
                            type="margin" responsive
                            value={readmore_icon_margin_hover}
                            onChange={(value) => {
                                setAttributes({readmore_icon_margin_hover: value})
                            }}
                        />
                    }
                </div>
            }

            {/*TODO BOX-HOVER TAB*/}

            {readmore_style_tabs === 'box_hover' &&
                <div className="rttpg-ground-control">
                    <Color
                        label={__('Text Color - BoxHover', 'clplace-core')}
                        color={readmore_text_color_box_hover}
                        onChange={(readmore_text_color_box_hover) => setAttributes({readmore_text_color_box_hover})}
                    />
                    {show_btn_icon === 'yes' &&
                        <Color
                            label={__('Icon Color - BoxHover', 'clplace-core')}
                            color={readmore_icon_color_box_hover}
                            onChange={(readmore_icon_color_box_hover) => setAttributes({readmore_icon_color_box_hover})}
                        />
                    }
                    {readmore_btn_style === 'default-style' &&
                        <>
                            <Color
                                label={__('Background Color - BoxHover', 'clplace-core')}
                                color={readmore_bg_box_hover}
                                onChange={(readmore_bg_box_hover) => setAttributes({readmore_bg_box_hover})}
                            />

                            <BorderControl
                                colors={TPG_COLOR_PALATE}
                                value={readmore_border_box_hover}
                                label={__("Button Border - BoxHover", "clplace-core")}
                                onChange={(val) => {
                                    const newVal = {openTpgBorder: 1, ...val}
                                    setAttributes({readmore_border_box_hover: newVal})
                                }}
                                withSlider
                            />
                        </>
                    }

                </div>
            }

        </PanelBody>
    );
}

export default ReadMoreStyle;
