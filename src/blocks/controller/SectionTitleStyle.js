import Range from "../../components/Range";

const {__} = wp.i18n;
import {__experimentalNumberControl as NumberControl, PanelBody} from "@wordpress/components";
import Typography from "../../components/Typography";
import Color from "../../components/Color";
import Dimension from "../../components/Dimension";
import Alignment from "../../components/Alignment";

function SectionTitleStyle(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        show_section_title,
        filter_btn_style,
        section_title_alignment,
        section_title_margin,
        section_title_radius,
        section_title_typography,
        section_title_color,
        section_title_bg_color,
        section_title_dot_color,
        section_title_style,
        section_title_line_color,
        section_title_line_width,
        section_title_line_spacing,
        external_icon_size,
        external_icon_position,
        external_icon_color,
        external_icon_color_hover
    } = attributes;

    if (show_section_title !== 'show') {
        return '';
    }

    return (
        <PanelBody title={__('Section Title', 'clplace-core')} initialOpen={true}>

            {filter_btn_style !== 'carousel' &&
                <Alignment
                    label={__("Alignment", "clplace-core")}
                    options={['left', 'center', 'right']}
                    value={section_title_alignment}
                    onChange={section_title_alignment => setAttributes({section_title_alignment})}
                />
            }

            <Dimension
                label={__("Margin", "clplace-core")}
                isLinked={false}
                type="margin" responsive
                value={section_title_margin}
                onChange={(value) => {
                    setAttributes({section_title_margin: value})
                }}
            />

            <Dimension
                label={__("Border Radius", "clplace-core")}
                isLinked={false}
                type="borderRadius" responsive
                value={section_title_radius}
                onChange={(value) => {
                    setAttributes({section_title_radius: value})
                }}
            />

            <Typography
                label={__('Typography', 'clplace-core')}
                value={section_title_typography}
                onChange={(val) => setAttributes({section_title_typography: val})}
            />

            {['style4'].includes(section_title_style) &&
                <>
                    <NumberControl
                        isShiftStepEnabled
                        label={__("Line Width", "clplace-core")}
                        max={1200}
                        min={1}
                        value={section_title_line_width}
                        onChange={(section_title_line_width) => {
                            setAttributes({section_title_line_width})
                        }}
                        placeholder={__("Max 1200", "clplace-core")}
                        shiftStep={1}
                        step="1"
                        className="rttpg-control-field label-inline"
                    />
                    <NumberControl
                        isShiftStepEnabled
                        label={__("Line Spacing", "clplace-core")}
                        max={300}
                        min={-300}
                        value={section_title_line_spacing}
                        onChange={(section_title_line_spacing) => {
                            setAttributes({section_title_line_spacing})
                        }}
                        placeholder={__("-300 to 300", "clplace-core")}
                        shiftStep={1}
                        step="1"
                        className="rttpg-control-field label-inline"
                    />
                </>
            }

            <hr/>

            <Color
                label={__('Title Color', 'clplace-core')}
                color={section_title_color}
                onChange={(section_title_color) => setAttributes({section_title_color})}
            />

            {['style2', 'style3'].includes(section_title_style) &&
                <Color
                    label={__('Title Background Color', 'clplace-core')}
                    color={section_title_bg_color}
                    onChange={(section_title_bg_color) => setAttributes({section_title_bg_color})}
                />
            }

            {['style1', 'style4'].includes(section_title_style) &&
                <Color
                    label={__('Dot / Bar Color', 'clplace-core')}
                    color={section_title_dot_color}
                    onChange={(section_title_dot_color) => setAttributes({section_title_dot_color})}
                />
            }

            {section_title_style !== 'default' &&
                <Color
                    label={__('Line / Border Color', 'clplace-core')}
                    color={section_title_line_color}
                    onChange={(section_title_line_color) => setAttributes({section_title_line_color})}
                />
            }


            <Color
                label={__('External Link Color', 'clplace-core')}
                color={external_icon_color}
                onChange={(external_icon_color) => setAttributes({external_icon_color})}
            />

            <Color
                label={__('External Link Color - Hover', 'clplace-core')}
                color={external_icon_color_hover}
                onChange={(external_icon_color_hover) => setAttributes({external_icon_color_hover})}
            />

            <Range
                label={__("External Icon Size")}
                value={external_icon_size}
                onChange={(val) => setAttributes({external_icon_size: val})}
                min={0}
                max={50}
                step={1}
            />

            <Range
                label={__("External Icon Y Position")}
                value={external_icon_position}
                onChange={(val) => setAttributes({external_icon_position: val})}
                min={-70}
                max={70}
                step={1}
            />

        </PanelBody>
    );
}

export default SectionTitleStyle;
