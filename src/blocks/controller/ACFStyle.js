import Typography from "../../components/Typography";

const {__} = wp.i18n;
import {__experimentalHeading as Heading, Button, ButtonGroup, PanelBody, SelectControl} from "@wordpress/components";
import RangeDevice from "../../components/RangeDevice";
import Alignment from "../../components/Alignment";
import {NORMAL_HOVER} from "../../components/Constants";
import Color from "../../components/Color";

function ACFStyle(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        prefix,
        show_acf,
        acf_group_title_typography,
        acf_typography,
        cf_show_only_value,
        acf_label_style,
        acf_label_width,
        acf_alignment,
        acf_style_tabs,
        acf_group_title_color,
        acf_label_color,
        acf_value_color,
        acf_group_title_color_hover,
        acf_label_color_hover,
        acf_value_color_hover,
        cf_hide_group_title
    } = attributes;
    let postLayout = prefix + "_layout";

    if (!(show_acf === 'show' && attributes[postLayout] !== 'grid-layout7')) {
        return '';
    }

    return (
        <PanelBody title={__('Advanced Custom Field (ACF)', 'clplace-core')} initialOpen={false}>


            <Typography
                label={__('Group Title Typography', 'clplace-core')}
                value={acf_group_title_typography}
                onChange={(val) => setAttributes({acf_group_title_typography: val})}
            />
            <Typography
                label={__('ACF Fields Typography', 'clplace-core')}
                value={acf_typography}
                onChange={(val) => setAttributes({acf_typography: val})}
            />
            {cf_show_only_value === 'yes' &&
                <SelectControl
                    label={__("Label Style", "clplace-core")}
                    className="rttpg-control-field label-inline rttpg-expand"
                    options={[
                        {value: 'default', label: __('Default', 'clplace-core')},
                        {value: 'inline', label: __('Inline', 'clplace-core')},
                        {value: 'block', label: __('Block', 'clplace-core')}
                    ]}
                    value={acf_label_style}
                    onChange={(acf_label_style) => setAttributes({acf_label_style})}
                />
            }
            {acf_label_style === 'default' &&
                <RangeDevice
                    label={__('Label Min Width')}
                    responsive={true}
                    value={acf_label_width}
                    min={0}
                    max={500}
                    step={1}
                    onChange={(val) => setAttributes({acf_label_width: val})}
                />
            }
            {attributes[postLayout] !== 'grid-layout7' &&
                <Alignment
                    label={__("Text Align", "clplace-core")}
                    options={['left', 'center', 'right']}
                    value={acf_alignment}
                    onChange={acf_alignment => setAttributes({acf_alignment})}
                />
            }

            <Heading className="rttpg-control-heading">{__("Appearance & Behavior:", "clplace-core")}</Heading>
            {/*Box Style Tab*/}
            <ButtonGroup className="rttpg-btn-group rttpg-btn-group-state rttpg-bottom-border-radius-none">
                {NORMAL_HOVER.map((item, key) => (
                    <Button
                        key={key}
                        isPrimary={acf_style_tabs === item.value}
                        isSecondary={acf_style_tabs !== item.value}
                        onClick={() => setAttributes({acf_style_tabs: item.value})}
                    >
                        {item.label}
                    </Button>
                ))}
            </ButtonGroup>

            {acf_style_tabs === 'normal' ?
                <div className="rttpg-ground-control">
                    {cf_hide_group_title === 'yes' &&
                        <Color
                            label={__('Group Title Color', 'clplace-core')}
                            color={acf_group_title_color}
                            onChange={(acf_group_title_color) => setAttributes({acf_group_title_color})}
                        />
                    }
                    {cf_show_only_value === 'yes' &&
                        <Color
                            label={__('Label Color', 'clplace-core')}
                            color={acf_label_color}
                            onChange={(acf_label_color) => setAttributes({acf_label_color})}
                        />
                    }
                    <Color
                        label={__('Value Color', 'clplace-core')}
                        color={acf_value_color}
                        onChange={(acf_value_color) => setAttributes({acf_value_color})}
                    />

                </div>
                :
                <div className="rttpg-ground-control">
                    {cf_hide_group_title === 'yes' &&
                        <Color
                            label={__('Group Title Color - BoxHover', 'clplace-core')}
                            color={acf_group_title_color_hover}
                            onChange={(acf_group_title_color_hover) => setAttributes({acf_group_title_color_hover})}
                        />
                    }
                    {cf_show_only_value === 'yes' &&
                        <Color
                            label={__('Label Color - BoxHover', 'clplace-core')}
                            color={acf_label_color_hover}
                            onChange={(acf_label_color_hover) => setAttributes({acf_label_color_hover})}
                        />
                    }
                    <Color
                        label={__('Value Color - BoxHover', 'clplace-core')}
                        color={acf_value_color_hover}
                        onChange={(acf_value_color_hover) => setAttributes({acf_value_color_hover})}
                    />
                </div>

            }


        </PanelBody>
    );
}

export default ACFStyle;
