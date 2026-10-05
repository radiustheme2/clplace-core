const {__} = wp.i18n;
import {PanelBody, SelectControl, ToggleControl, TextControl} from "@wordpress/components";
import IconList from "../../components/IconList";

function ReadMoreSettings(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        show_read_more,
        readmore_btn_style,
        read_more_label,
        show_btn_icon,
        readmore_btn_icon,
        readmore_icon_position
    } = attributes;

    if (show_read_more !== 'show') {
        return '';
    }

    return (
        <PanelBody title={__('Read More', 'clplace-core')} initialOpen={false}>

            <SelectControl
                label={__("Button Style", "clplace-core")}
                className="rttpg-control-field label-inline rttpg-expand"
                options={[
                    {value: 'default-style', label: __('Default from style', 'clplace-core')}, {
                        value: 'only-text', label: __('Text Button', 'clplace-core')
                    }
                ]}
                value={readmore_btn_style}
                onChange={(readmore_btn_style) => setAttributes({readmore_btn_style})}
            />

            <TextControl
                autocomplete="off"
                label={__("Button Label", "clplace-core")}
                className="rttpg-control-field label-inline rttpg-expand"
                placeholder="Type Read More Label here"
                value={read_more_label}
                onChange={(read_more_label) => setAttributes({read_more_label})}
            />

            <ToggleControl
                label={__("Show Button Icon", "clplace-core")}
                className="rttpg-toggle-control-field"
                checked={show_btn_icon}
                onChange={(show_btn_icon) => setAttributes({show_btn_icon: show_btn_icon ? 'yes' : ''})}
            />

            {show_btn_icon === 'yes' &&
                <>
                    <SelectControl
                        label={__("Icon Position", "clplace-core")}
                        className="rttpg-control-field label-inline rttpg-expand"
                        options={[
                            {value: 'left', label: __('Left', 'clplace-core')},
                            {value: 'right', label: __('Right', 'clplace-core')}
                        ]}
                        value={readmore_icon_position}
                        onChange={(readmore_icon_position) => setAttributes({readmore_icon_position})}
                    />
                </>
            }


        </PanelBody>
    );
}

export default ReadMoreSettings;
