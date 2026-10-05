const {__} = wp.i18n;
import "flatpickr/dist/themes/light.css";
import {SelectControl, TextControl, PanelBody, ToggleControl} from "@wordpress/components";
import {SECTION_TITLE_STYLE, SECTION_TITLE_SOURCE, HEADING} from "../../components/Constants";

function SectionTitleSettings(props) {
    const {attributes, setAttributes} = props.data;

    let initOpen = false;
    if (props?.open) {
        initOpen = true
    }

    //All attribute
    const {
        section_title_style,
        section_title_source,
        section_title_text,
        section_title_tag,
        show_section_title,
        enable_external_link,
        section_external_link,
        section_external_text
    } = attributes;

    if (show_section_title !== 'show') {
        return '';
    }
    return (
        <PanelBody title={__('Section Title', 'clplace-core')} initialOpen={initOpen}>
            <SelectControl
                label={__('Title Style', 'clplace-core')}
                className="rttpg-control-field label-inline"
                value={section_title_style}
                options={SECTION_TITLE_STYLE}
                onChange={(section_title_style) => setAttributes({section_title_style})}
            />
            <SelectControl
                label={__('Title Source', 'clplace-core')}
                className="rttpg-control-field label-inline"
                value={section_title_source}
                options={SECTION_TITLE_SOURCE}
                onChange={(section_title_source) => setAttributes({section_title_source})}
            />
            {'custom_title' === section_title_source && (
                <TextControl
                    autocomplete="off"
                    help="Help text to explain the input."
                    label="Enter Title"
                    value={section_title_text}
                    onChange={(section_title_text) => setAttributes({section_title_text})}
                />
            )}
            <SelectControl
                label={__('Title Tags', 'clplace-core')}
                className="rttpg-control-field label-inline"
                options={HEADING}
                value={section_title_tag}
                onChange={(section_title_tag) => setAttributes({section_title_tag})}
            />

            <ToggleControl
                label={__("Enable External Link", "clplace-core")}
                className="rttpg-toggle-control-field"
                checked={enable_external_link}
                onChange={(enable_external_link) => setAttributes({enable_external_link: enable_external_link ? 'show' : ''})}
            />

            {enable_external_link === 'show' &&
                <>
                    <TextControl
                        autocomplete="off"
                        label="External Link"
                        value={section_external_link}
                        onChange={(section_external_link) => setAttributes({section_external_link})}
                    />

                    <TextControl
                        autocomplete="off"
                        label="Link Text"
                        value={section_external_text}
                        onChange={(section_external_text) => setAttributes({section_external_text})}
                    />
                </>
            }
        </PanelBody>
    );
}

export default SectionTitleSettings;
