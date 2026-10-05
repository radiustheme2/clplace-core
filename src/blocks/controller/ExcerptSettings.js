const {__} = wp.i18n;
import {
    PanelBody, SelectControl, TextControl, __experimentalNumberControl as NumberControl
} from "@wordpress/components";
import {EXCERPT_TYPE} from "../../components/Constants";

function ExcerptSettings(props) {
    const {attributes, setAttributes, changeQuery} = props.data;

    //All attribute
    const {excerpt_type, excerpt_limit, excerpt_more_text, show_excerpt} = attributes;

    if (show_excerpt !== 'show') {
        return '';
    }

    return (<PanelBody title={__('Excerpt', 'clplace-core')} initialOpen={false}>

        <SelectControl
            label={__("Excerpt Type", "clplace-core")}
            className="rttpg-control-field label-inline"
            options={EXCERPT_TYPE}
            value={excerpt_type}
            onChange={(excerpt_type) => {
                setAttributes({excerpt_type});
                changeQuery()
            }}
        />

        {['character', 'word'].includes(excerpt_type) && (<>
            <NumberControl
                label={__("Excerpt Limit", "clplace-core")}
                className="rttpg-control-field label-inline"
                max={1000}
                min={0}
                value={excerpt_limit}
                placeholder="6"
                shiftStep={10}
                step="1"
                onChange={(excerpt_limit) => {
                    setAttributes({excerpt_limit})
                    changeQuery()
                }}
            />
            <TextControl
                autocomplete="off"
                label={__("Expansion Indicator", "clplace-core")}
                className="rttpg-control-field label-inline"
                value={excerpt_more_text}
                onChange={(excerpt_more_text) => {
                    setAttributes({excerpt_more_text})
                    changeQuery()
                }}
            />
        </>)}


    </PanelBody>);
}

export default ExcerptSettings;
