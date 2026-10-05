import Select from "react-select";

const {Spinner} = wp.components;
const {__} = wp.i18n;
import {__experimentalHeading as Heading, PanelBody, ToggleControl} from "@wordpress/components";


function ACFSettings(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    //All attribute
    const {
        show_acf,
        cf_hide_empty_value,
        cf_hide_group_title,
        cf_show_only_value,
        acf_data_lists,
        post_type
    } = attributes;

    if (!(rtParams.hasAcf && rtParams.hasPro && show_acf === 'show')) {
        return '';
    }

    const acfData = [...props.acfData];
    const currentAcf = acfData.find(acf => acf?.post_type === post_type)

    return (
        <PanelBody title={__('ACF', 'clplace-core')} initialOpen={false}>

            <Heading className="rttpg-control-heading">
                {__("Choose ACF Field:", "clplace-core")}
            </Heading>

            <div className="components-base-control rttpg-repeater">
                <Select
                    options={currentAcf?.options}
                    value={acf_data_lists[currentAcf?.post_type + '_cf_group']?.options}
                    onChange={(value) => {
                        props.changeAcfData(value, currentAcf?.post_type + '_cf_group')
                    }}
                    isMulti={true}
                    closeMenuOnSelect={true}
                    isClearable={false}
                />
            </div>

            <ToggleControl
                label={__("Hide field with empty value?", "clplace-core")}
                className="rttpg-toggle-control-field"
                checked={cf_hide_empty_value}
                onChange={cf_hide_empty_value => {
                    setAttributes({cf_hide_empty_value: cf_hide_empty_value ? 'show' : ''});
                    changeQuery();
                }}
            />
            <ToggleControl
                label={__("Show group title?", "clplace-core")}
                className="rttpg-toggle-control-field"
                checked={cf_hide_group_title}
                onChange={cf_hide_group_title => {
                    setAttributes({cf_hide_group_title: cf_hide_group_title ? 'show' : ''});
                    changeQuery();
                }}
            />
            <ToggleControl
                label={__("Show label?", "clplace-core")}
                className="rttpg-toggle-control-field"
                checked={cf_show_only_value}
                onChange={cf_show_only_value => {
                    setAttributes({cf_show_only_value: cf_show_only_value ? 'show' : ''});
                    changeQuery();
                }}
            />

        </PanelBody>
    );
}

export default ACFSettings;
