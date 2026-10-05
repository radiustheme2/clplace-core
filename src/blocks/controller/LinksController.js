const {__} = wp.i18n;
import {SelectControl, PanelBody} from "@wordpress/components";
import {POST_LINK_TYPE, CLPLACE_IS_PRO} from "../../components/Constants";

function LinksController(props) {
    const {attributes, setAttributes} = props.data;
    //All attribute
    const {post_link_type, link_target, is_thumb_linked} = attributes;

    return (
        <PanelBody title={__('Links', 'clplace-core')} initialOpen={false}>
            <SelectControl
                label={__("Post link type", "clplace-core")}
                className="rttpg-control-field label-inline rttpg-expand"
                options={POST_LINK_TYPE}
                value={post_link_type}
                onChange={(post_link_type) => setAttributes({post_link_type})}
            />

            {CLPLACE_IS_PRO === 'rttpg-is-pro' &&
                <p className="rttpg-help">{__("NB. Please upgrade to pro for popup options", "clplace-core")}</p>}

            {post_link_type === 'default' && (
                <SelectControl
                    label={__("Link Target", "clplace-core")}
                    className="rttpg-control-field label-inline rttpg-expand"
                    options={[
                        {value: '_self', label: __('Same Window', 'clplace-core')},
                        {value: '_blank', label: __('New Window', 'clplace-core')}
                    ]}
                    value={link_target}
                    onChange={(link_target) => setAttributes({link_target})}
                />)}

            <SelectControl
                label={__("Thumbnail Link", "clplace-core")}
                className="rttpg-control-field label-inline rttpg-expand"
                options={[{value: 'yes', label: __('Yes', 'clplace-core')}, {
                    value: 'no',
                    label: __('No', 'clplace-core')
                }]}
                value={is_thumb_linked}
                onChange={(is_thumb_linked) => setAttributes({is_thumb_linked})}
            />
        </PanelBody>
    );
}

export default LinksController;
