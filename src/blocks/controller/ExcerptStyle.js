const {__} = wp.i18n;
import {__experimentalHeading as Heading, Button, ButtonGroup, PanelBody} from "@wordpress/components";
import {NORMAL_HOVER} from "../../components/Constants";
import Typography from "../../components/Typography";
import Color from "../../components/Color";
import Dimension from "../../components/Dimension";
import Alignment from "../../components/Alignment";

function ExcerptStyle(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        prefix,
        content_typography,
        excerpt_spacing,
        content_alignment,
        excerpt_style_tabs,
        excerpt_color,
        meta_position,
        excerpt_hover_color,
        excerpt_border_hover,
        excerpt_border,
        show_excerpt
    } = attributes;

    if (show_excerpt !== 'show') {
        return '';
    }

    let postLayout = prefix + "_layout";

    return (
        <PanelBody title={__('Excerpt / Content', 'clplace-core')} initialOpen={false}>

            <Typography
                label={__('Typography', 'clplace-core')}
                value={content_typography}
                onChange={(val) => setAttributes({content_typography: val})}
            />

            <Dimension
                label={__("Excerpt Spacing", "clplace-core")}
                type="margin" responsive
                value={excerpt_spacing}
                onChange={(value) => {
                    setAttributes({excerpt_spacing: value})
                }}
            />

            <Alignment
                label={__("Alignment", "clplace-core")}
                options={['left', 'center', 'right']}
                value={content_alignment}
                responsive={true}
                onChange={content_alignment => setAttributes({content_alignment})}
            />

            <Heading className="rttpg-control-heading">{__("Appearance & Behavior:", "clplace-core")}</Heading>
            {/*Hover Tab*/}

            <ButtonGroup className="rttpg-btn-group rttpg-btn-group-state rttpg-bottom-border-radius-none">
                {NORMAL_HOVER.map((item, key) => (
                    <Button
                        key={key}
                        isPrimary={excerpt_style_tabs === item.value}
                        isSecondary={excerpt_style_tabs !== item.value}
                        onClick={() => setAttributes({excerpt_style_tabs: item.value})}
                    >
                        {item.label}
                    </Button>))}
            </ButtonGroup>

            {excerpt_style_tabs === 'normal' &&
                <div className="rttpg-ground-control">
                    <Color
                        label={__('Excerpt color', 'clplace-core')}
                        color={excerpt_color}
                        onChange={(excerpt_color) => setAttributes({excerpt_color})}
                    />

                    {(meta_position === 'default' && attributes[postLayout] === 'grid-layout3') && <Color
                        label={__('Border color - Hover', 'clplace-core')}
                        color={excerpt_border}
                        onChange={(excerpt_border) => setAttributes({excerpt_border})}
                    />}
                </div>
            }


            {excerpt_style_tabs === 'hover' &&
                <div className="rttpg-ground-control">
                    <Color
                        label={__('Excerpt color - Hover', 'clplace-core')}
                        color={excerpt_hover_color}
                        onChange={(excerpt_hover_color) => setAttributes({excerpt_hover_color})}
                    />

                    {(meta_position === 'default' && attributes[postLayout] === 'grid-layout3') && <Color
                        label={__('Border color - Hover', 'clplace-core')}
                        color={excerpt_border_hover}
                        onChange={(excerpt_border_hover) => setAttributes({excerpt_border_hover})}
                    />}
                </div>
            }

        </PanelBody>
    );
}

export default ExcerptStyle;
