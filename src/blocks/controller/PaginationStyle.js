import RangeDevice from "../../components/RangeDevice";
const {__} = wp.i18n;
import {
    __experimentalBorderControl as BorderControl,
    __experimentalHeading as Heading,
    Button,
    ButtonGroup,
    PanelBody
} from "@wordpress/components";
import {ACTIVE_HOVER, TPG_COLOR_PALATE} from "../../components/Constants";
import Typography from "../../components/Typography";
import Color from "../../components/Color";
import Dimension from "../../components/Dimension";
import Alignment from "../../components/Alignment";

function ReadMoreStyle(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        pagination_style_tabs,
        show_pagination,
        pagination_typography,
        pagination_text_align,
        pagination_type,
        pagination_spacing,
        pagination_btn_width,
        pagination_btn_height,
        pagination_border_radius,
        pagination_color,
        pagination_bg,
        pagination_border_color,
        pagination_color_hover,
        pagination_bg_hover,
        pagination_border_color_hover,
        pagination_color_active,
        pagination_bg_active,
        pagination_border_color_active
    } = attributes;

    if (!(show_pagination === 'show' && pagination_type !== 'load_on_scroll')) {
        return '';
    }

    return (<PanelBody title={__('Pagination / LoadMore', 'clplace-core')} initialOpen={false}>

        <Typography
            label={__('Typography')}
            value={pagination_typography}
            onChange={(val) => setAttributes({pagination_typography: val})}
        />

        <Alignment
            label={__("Alignment", "clplace-core")}
            options={['left', 'center', 'right']}
            value={pagination_text_align}
            responsive={true}
            onChange={pagination_text_align => setAttributes({pagination_text_align})}
        />

        <hr/>

        <Dimension
            label={__("Button Vertical Spacing", "clplace-core")}
            type="margin" responsive
            value={pagination_spacing}
            onChange={(value) => {
                setAttributes({pagination_spacing: value})
            }}
        />
        <RangeDevice
            label={__('Button Width')}
            className={`rttpg-control-field label-inline`}
            responsive={true}
            min={10}
            max={200}
            step={1}
            value={pagination_btn_width}
            onChange={(val) => setAttributes({pagination_btn_width: val})}
        />
        <RangeDevice
            label={__('Button Height')}
            className={`rttpg-control-field label-inline`}
            responsive={true}
            min={10}
            max={200}
            step={1}
            value={pagination_btn_height}
            onChange={(val) => setAttributes({pagination_btn_height: val})}
        />
        <Dimension
            label={__("Border Radius", "clplace-core")}
            type="borderRadius" responsive
            value={pagination_border_radius}
            onChange={(value) => {
                setAttributes({pagination_border_radius: value})
            }}
        />

        {/*TODO STYLE TAB*/}

        <Heading className="rttpg-control-heading">{__("Appearance & Behavior:", "clplace-core")}</Heading>

        <ButtonGroup className="rttpg-btn-group rttpg-btn-group-state rttpg-bottom-border-radius-none">
            {ACTIVE_HOVER.map((item, key) => (
                <Button
                    key={key}
                    isPrimary={pagination_style_tabs === item.value}
                    isSecondary={pagination_style_tabs !== item.value}
                    onClick={() => setAttributes({pagination_style_tabs: item.value})}
                >
                    {item.label}
                </Button>
            ))}
        </ButtonGroup>

        {/*TODO NORMAL TAB*/}

        {pagination_style_tabs === 'normal' &&
            <div className="rttpg-ground-control">
                <Color
                    label={__('Color', 'clplace-core')}
                    color={pagination_color}
                    onChange={(pagination_color) => setAttributes({pagination_color})}
                />

                <Color
                    label={__('Background Color', 'clplace-core')}
                    color={pagination_bg}
                    onChange={(pagination_bg) => setAttributes({pagination_bg})}
                />

                <BorderControl
                    colors={TPG_COLOR_PALATE}
                    value={pagination_border_color}
                    label={__("Pagination Border", "clplace-core")}
                    onChange={(val) => {
                        const newVal = {openTpgBorder: 1, ...val}
                        setAttributes({pagination_border_color: newVal})
                    }}
                    withSlider
                />

            </div>
        }

        {/*TODO HOVER TAB*/}
        {pagination_style_tabs === 'hover' &&
            <div className="rttpg-ground-control">
                <Color
                    label={__('Color - Hover', 'clplace-core')}
                    color={pagination_color_hover}
                    onChange={(pagination_color_hover) => setAttributes({pagination_color_hover})}
                />

                <Color
                    label={__('Background Color - Hover', 'clplace-core')}
                    color={pagination_bg_hover}
                    onChange={(pagination_bg_hover) => setAttributes({pagination_bg_hover})}
                />

                <BorderControl
                    colors={TPG_COLOR_PALATE}
                    value={pagination_border_color_hover}
                    label={__("Pagination Border - Hover", "clplace-core")}
                    onChange={(val) => {
                        const newVal = {openTpgBorder: 1, ...val}
                        setAttributes({pagination_border_color_hover: newVal})
                    }}
                    withSlider
                />

            </div>
        }

        {/*TODO HOVER TAB*/}
        {pagination_style_tabs === 'active' &&
            <div className="rttpg-ground-control">
                <Color
                    label={__('Color - Active', 'clplace-core')}
                    color={pagination_color_active}
                    onChange={(pagination_color_active) => setAttributes({pagination_color_active})}
                />

                <Color
                    label={__('Background Color - Active', 'clplace-core')}
                    color={pagination_bg_active}
                    onChange={(pagination_bg_active) => setAttributes({pagination_bg_active})}
                />

                <BorderControl
                    colors={TPG_COLOR_PALATE}
                    value={pagination_border_color_active}
                    label={__("Pagination Border - Active", "clplace-core")}
                    onChange={(val) => {
                        const newVal = {openTpgBorder: 1, ...val}
                        setAttributes({pagination_border_color_active: newVal})
                    }}
                    withSlider
                />

            </div>
        }


    </PanelBody>);
}

export default ReadMoreStyle;
