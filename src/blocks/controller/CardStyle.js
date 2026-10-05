import RangeDevice from "../../components/RangeDevice";

const {__} = wp.i18n;
import {__experimentalHeading as Heading, Button, ButtonGroup, PanelBody, SelectControl} from "@wordpress/components";
import {NORMAL_HOVER} from "../../components/Constants";
import Color from "../../components/Color";
import Dimension from "../../components/Dimension";
import BoxShadow from "../../components/BoxShadow";
import Background from "../../components/Background";

function CardStyle(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        prefix,
        box_margin,
        box_margin_extra,
        content_box_padding,
        content_box_padding_2,
        content_box_padding_offset,
        box_radius,
        is_box_border,
        box_style_tabs,
        box_background,
        box_border,
        box_border_bottom,
        box_box_shadow_normal,
        box_background2,
        box_background_hover,
        box_box_shadow2,
        box_background_hover2,
        box_border_hover,
        box_box_shadow_hover,
        box_box_shadow_hover2,
        box_border_bottom_color,
        box_border_spacing
    } = attributes;

    let postLayout = prefix + "_layout";

    const exclude_box_margin_layout = [
        'grid-layout5', 'grid-layout5-2', 'grid-layout6', 'grid-layout6-2',
        'list-layout2', 'list-layout2-2', 'list-layout3', 'list-layout3-2',
        'grid_hover-layout4', 'grid_hover-layout4-2', 'grid_hover-layout5', 'grid_hover-layout5-2', 'grid_hover-layout6', 'grid_hover-layout6-2',
        'grid_hover-layout7', 'grid_hover-layout7-2', 'grid_hover-layout8', 'grid_hover-layout9', 'grid_hover-layout9-2',
        'slider-layout11','slider-layout12','slider-layout13'
    ];

    const exclude_content_box_padding = [
        'grid-layout5', 'grid-layout5-2', 'grid-layout6', 'grid-layout6-2', 'grid-layout7',
        'list-layout1', 'list-layout2', 'list-layout2-2', 'list-layout3', 'list-layout3-2', 'list-layout4', 'list-layout5',
        'slider-layout1', 'slider-layout2', 'slider-layout3', 'slider-layout11','slider-layout12','slider-layout13'
    ];

    const cardBorderLayout = [
        'list-layout2', 'list-layout2-2', 'list-layout3', 'list-layout3-2', 'list-layout4-2', 'list-layout5', 'list-layout5-2',
        'slider-layout11', 'slider-layout12', 'slider-layout13'
    ];

    return (
        <PanelBody title={__('Card (Post Item)', 'clplace-core')} initialOpen={false}>

            {!exclude_box_margin_layout.includes(attributes[postLayout]) &&
                <Dimension
                    label={__("Card Gap", "clplace-core")}
                    type="padding" responsive
                    value={box_margin}
                    onChange={(value) => {
                        setAttributes({box_margin: value})
                    }}
                />
            }

            <Dimension
                label={__("Card Margin (Use if needed)", "clplace-core")}
                type="margin" responsive
                value={box_margin_extra}
                onChange={(value) => {
                    setAttributes({box_margin_extra: value})
                }}
            />
            {!exclude_content_box_padding.includes(attributes[postLayout]) && 'grid_hover' !== prefix &&
                <Dimension
                    label={__("Content Padding", "clplace-core")}
                    type="padding" responsive
                    value={content_box_padding}
                    onChange={(value) => {
                        setAttributes({content_box_padding: value})
                    }}
                />
            }

            {['grid-layout5', 'grid-layout5-2', 'list-layout4'].includes(attributes[postLayout]) &&
                <Dimension
                    label={__("Content Padding", "clplace-core")}
                    type="padding" responsive
                    value={content_box_padding_offset}
                    onChange={(value) => {
                        setAttributes({content_box_padding_offset: value})
                    }}
                />
            }

            {['slider-layout13'].includes(attributes[postLayout]) &&
                <Dimension
                    label={__("Content Padding", "clplace-core")}
                    type="padding" responsive
                    value={content_box_padding_2}
                    onChange={(value) => {
                        setAttributes({content_box_padding_2: value})
                    }}
                />
            }

            {!cardBorderLayout.includes(attributes[postLayout]) &&
                <Dimension
                    label={__("Card Border Radius", "clplace-core")}
                    type="borderRadius" responsive
                    value={box_radius}
                    onChange={(value) => {
                        setAttributes({box_radius: value})
                    }}
                />
            }

            {['grid', 'list'].includes(prefix) &&
                <SelectControl
                    label={__("Enable Border & Box Shadow", "clplace-core")}
                    className="rttpg-control-field label-inline rttpg-expand"
                    options={[
                        {value: 'default', label: __('Default', 'clplace-core')},
                        {value: 'enable', label: __('Enable', 'clplace-core')},
                        {value: 'disable', label: __('Disable', 'clplace-core')}
                    ]}
                    value={is_box_border}
                    onChange={(is_box_border) => setAttributes({is_box_border})}
                />
            }
            {prefix !== 'slider' &&
                <>
                    <SelectControl
                        label={__("Enable Border Bottom", "clplace-core")}
                        className="rttpg-control-field label-inline rttpg-expand"
                        options={[
                            {value: 'enable', label: __('Enable', 'clplace-core')},
                            {value: 'disable', label: __('Disable', 'clplace-core')}
                        ]}
                        value={box_border_bottom}
                        onChange={(box_border_bottom) => setAttributes({box_border_bottom})}
                    />
                    {box_border_bottom === 'enable' &&
                        <>
                            <Color
                                label={__('Border Color', 'clplace-core')}
                                color={box_border_bottom_color}
                                onChange={(box_border_bottom_color) => setAttributes({box_border_bottom_color})}
                            />
                            <RangeDevice
                                label={__('Border Spacing Bottom')}
                                responsive={true}
                                min={0}
                                max={200}
                                step={1}
                                value={box_border_spacing}
                                onChange={(val) => setAttributes({box_border_spacing: val})}
                            />
                        </>
                        // readmore_icon_size
                    }
                </>
            }

            {prefix !== 'grid_hover' &&
                <>
                    <Heading className="rttpg-control-heading">{__("Appearance & Behavior:", "clplace-core")}</Heading>
                    {/*Box Style Tab*/}
                    <ButtonGroup className="rttpg-btn-group rttpg-btn-group-state rttpg-bottom-border-radius-none">
                        {NORMAL_HOVER.map((item, key) => (
                            <Button
                                key={key}
                                isPrimary={box_style_tabs === item.value}
                                isSecondary={box_style_tabs !== item.value}
                                onClick={() => setAttributes({box_style_tabs: item.value})}
                            >
                                {item.label}
                            </Button>
                        ))}
                    </ButtonGroup>

                    {box_style_tabs === 'normal' ?
                        <div className="rttpg-ground-control">
                            {!['slider-layout13'].includes(attributes[postLayout]) &&
                                <Background
                                    image={false}
                                    label={__("Background", "clplace-core")}
                                    value={box_background}
                                    onChange={val => setAttributes({box_background: val})}
                                />
                            }

                            {['slider-layout13'].includes(attributes[postLayout]) &&
                                <>
                                    <Background
                                        image={false}
                                        label={__("Background", "clplace-core")}
                                        value={box_background2}
                                        onChange={val => setAttributes({box_background2: val})}
                                    />
                                    <BoxShadow
                                        label={__('Box Shadow', 'clplace-core')}
                                        value={box_box_shadow2}
                                        onChange={val => setAttributes({box_box_shadow2: val})}
                                        transitioin="0.4"
                                    />
                                </>
                            }
                            {(['grid', 'list'].includes(prefix) && is_box_border === 'enable') &&
                                <>
                                    <Color
                                        label={__('Border Color', 'clplace-core')}
                                        color={box_border}
                                        onChange={(box_border) => setAttributes({box_border})}
                                    />
                                    <BoxShadow
                                        label={__('Box Shadow', 'clplace-core')}
                                        value={box_box_shadow_normal}
                                        onChange={val => setAttributes({box_box_shadow_normal: val})}
                                    />
                                </>
                            }
                        </div>
                        :
                        <div className="rttpg-ground-control">
                            {!['slider-layout13'].includes(attributes[postLayout]) &&
                                <Background
                                    image={false}
                                    label={__("Background - Hover", "clplace-core")}
                                    value={box_background_hover}
                                    onChange={val => setAttributes({box_background_hover: val})}
                                />
                            }
                            {['slider-layout13'].includes(attributes[postLayout]) &&
                                <>
                                    <Background
                                        image={false}
                                        label={__("Background", "clplace-core")}
                                        value={box_background_hover2}
                                        onChange={val => setAttributes({box_background_hover2: val})}
                                    />

                                    <BoxShadow
                                        label={__('Box Shadow - Hover', 'clplace-core')}
                                        value={box_box_shadow_hover2}
                                        onChange={val => setAttributes({box_box_shadow_hover2: val})}
                                        transitioin="0.4"
                                    />
                                </>

                            }
                            {(['grid', 'list'].includes(prefix) && is_box_border === 'enable') &&
                                <>
                                    <Color
                                        label={__('Border Color - Hover', 'clplace-core')}
                                        color={box_border_hover}
                                        onChange={(box_border_hover) => setAttributes({box_border_hover})}
                                    />
                                    <BoxShadow
                                        label={__('Box Shadow - Hover', 'clplace-core')}
                                        value={box_box_shadow_hover}
                                        onChange={val => setAttributes({box_box_shadow_hover: val})}
                                        transitioin="0.4"
                                    />
                                </>
                            }
                        </div>

                    }
                </>
            }

        </PanelBody>
    );
}

export default CardStyle;
