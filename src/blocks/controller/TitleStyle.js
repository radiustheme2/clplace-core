const {__} = wp.i18n;
import {__experimentalHeading as Heading, Button, ButtonGroup, PanelBody, SelectControl} from "@wordpress/components";
import {BOX_HOVER} from "../../components/Constants";
import Typography from "../../components/Typography";
import Color from "../../components/Color";
import Dimension from "../../components/Dimension";
import Alignment from "../../components/Alignment";

function TitleStyle(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        prefix,
        title_spacing,
        title_padding,
        title_typography,
        title_offset_typography,
        title_border_visibility,
        title_alignment,
        title_box_hover_tab,
        title_color,
        title_bg_color,
        title_border_color,
        title_hover_border_color,
        title_hover_color,
        title_bg_color_hover,
        title_color_box_hover,
        title_bg_color_box_hover,
        title_border_color_hover,
        title_hover_underline,
        show_title
    } = attributes;

    if (show_title !== 'show') {
        return '';
    }

    let postLayout = prefix + "_layout";

    return (
        <PanelBody title={__('Post Title', 'clplace-core')} initialOpen={false}>

            <Typography
                label={__('Typography')}
                value={title_typography}
                onChange={(val) => setAttributes({title_typography: val})}
            />

            {['grid-layout5', 'grid-layout5-2', 'grid-layout6', 'grid-layout6-2', 'list-layout2', 'list-layout2-2', 'list-layout3', 'list-layout3-2', 'grid_hover-layout4','grid_hover-layout4-2', 'grid_hover-layout5','grid_hover-layout5-2','grid_hover-layout6','grid_hover-layout6-2','grid_hover-layout7','grid_hover-layout7-2','grid_hover-layout9','grid_hover-layout9-2'].includes(attributes[postLayout]) &&
                <Typography
                    label={__('Offset Typography')}
                    value={title_offset_typography}
                    onChange={(val) => setAttributes({title_offset_typography: val})}
                />
            }

            {attributes[postLayout] === 'grid_hover-layout3' &&
                <SelectControl
                    label={__("Title Border Bottom", "clplace-core")}
                    className="rttpg-control-field label-inline rttpg-expand"
                    options={[
                        {value: 'default', label: __('Default', 'clplace-core')}, {
                            value: 'show', label: __('Show', 'clplace-core')
                        }, {value: 'hide', label: __('Hide', 'clplace-core')}
                    ]}
                    value={title_border_visibility}
                    onChange={(title_border_visibility) => setAttributes({title_border_visibility})}
                />
            }

            <Alignment
                label={__("Alignment", "clplace-core")}
                options={['left', 'center', 'right']}
                value={title_alignment}
                // responsive={ true }
                onChange={title_alignment => setAttributes({title_alignment})}
            />

            <Dimension
                label={__("Title Margin", "clplace-core")}
                type="margin" responsive
                value={title_spacing}
                onChange={(value) => {
                    setAttributes({title_spacing: value})
                }}
            />

            <Dimension
                label={__("Title Padding", "clplace-core")}
                type="padding" responsive
                value={title_padding}
                // isLinked={ true }
                onChange={(value) => {
                    setAttributes({title_padding: value})
                }}
            />

            <Heading className="rttpg-control-heading">{__("Appearance & Behavior:", "clplace-core")}</Heading>

            <ButtonGroup className="rttpg-btn-group rttpg-btn-group-state rttpg-bottom-border-radius-none">
                {BOX_HOVER.map((item, key) => (
                    <Button
                        key={key}
                        isPrimary={title_box_hover_tab === item.value}
                        isSecondary={title_box_hover_tab !== item.value}
                        onClick={() => setAttributes({title_box_hover_tab: item.value})}
                    >
                        {item.label}
                    </Button>))}
            </ButtonGroup>

            {title_box_hover_tab === 'normal' &&
                <div className="rttpg-ground-control">
                    <Color
                        label={__('Title Color', 'clplace-core')}
                        color={title_color}
                        onChange={(title_color) => setAttributes({title_color})}
                    />
                    <Color
                        label={__('Title Background', 'clplace-core')}
                        color={title_bg_color}
                        onChange={(title_bg_color) => setAttributes({title_bg_color})}
                    />

                    {(title_border_visibility !== 'hide' && attributes[postLayout] === 'grid_hover-layout3') &&
                        <Color
                            label={__('Title Separator Color', 'clplace-core')}
                            color={title_border_color}
                            onChange={(title_border_color) => setAttributes({title_border_color})}
                        />
                    }
                </div>
            }

            {title_box_hover_tab === 'hover' &&
                <div className="rttpg-ground-control">
                    <Color
                        label={__('Title Color on Hover', 'clplace-core')}
                        color={title_hover_color}
                        onChange={(title_hover_color) => setAttributes({title_hover_color})}
                    />
                    <Color
                        label={__('Title Background on hover', 'clplace-core')}
                        color={title_bg_color_hover}
                        onChange={(title_bg_color_hover) => setAttributes({title_bg_color_hover})}
                    />

                    {title_hover_underline === 'enable' &&
                        <Color
                            label={__('Title Hover Border Color', 'clplace-core')}
                            color={title_hover_border_color}
                            onChange={(title_hover_border_color) => setAttributes({title_hover_border_color})}
                        />
                    }
                </div>
            }


            {title_box_hover_tab === 'box_hover' &&
                <div className="rttpg-ground-control">
                    <Color
                        label={__('Title color on boxhover', 'clplace-core')}
                        color={title_color_box_hover}
                        onChange={(title_color_box_hover) => setAttributes({title_color_box_hover})}
                    />
                    <Color
                        label={__('Title Background on boxhover', 'clplace-core')}
                        color={title_bg_color_box_hover}
                        onChange={(title_bg_color_box_hover) => setAttributes({title_bg_color_box_hover})}
                    />

                    {(title_border_visibility !== 'hide' && attributes[postLayout] === 'grid_hover-layout3') &&
                        <Color
                            label={__('Title Separator color - boxhover', 'clplace-core')}
                            color={title_border_color_hover}
                            onChange={(title_border_color_hover) => setAttributes({title_border_color_hover})}
                        />
                    }
                </div>
            }


        </PanelBody>
    );
}

export default TitleStyle;
