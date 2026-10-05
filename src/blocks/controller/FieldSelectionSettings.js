const {__} = wp.i18n;
import {ToggleControl, PanelBody} from "@wordpress/components";
import cogoToast from "cogo-toast";
import {CLPLACE_IS_PRO} from "../../components/Constants";

function FieldSelectionSettings(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    //All attribute
    const {
        prefix,
        post_type,
        show_section_title,
        show_title,
        show_thumb,
        show_excerpt,
        show_meta,
        show_date,
        show_category,
        show_tags,
        show_author,
        show_comment_count,
        show_post_count,
        show_read_more,
        show_social_share,
        show_woocommerce_rating,
        show_acf
    } = attributes;

    let postLayout = prefix + "_layout";

    return (
        <PanelBody title={__('Field Selection', 'clplace-core')} initialOpen={true}>
            <ToggleControl
                label={__("Section Title", "clplace-core")}
                className="rttpg-toggle-control-field"
                checked={show_section_title}
                onChange={(show_section_title) => setAttributes({show_section_title: show_section_title ? 'show' : ''})}
            />

            {attributes[postLayout] !== 'grid-layout7' &&
                <ToggleControl
                    label={__("Post Title", "clplace-core")}
                    className="rttpg-toggle-control-field"
                    checked={show_title}
                    onChange={(show_title) => setAttributes({show_title: show_title ? 'show' : ''})}
                />
            }

            <ToggleControl
                label={__("Post Thumbnail", "clplace-core")}
                className="rttpg-toggle-control-field"
                checked={show_thumb}
                onChange={(show_thumb) => setAttributes({show_thumb: show_thumb ? 'show' : ''})}
            />

            {!['grid-layout7', 'slider-layout4'].includes(attributes[postLayout]) &&
                <>
                    <ToggleControl
                        label={__("Post Excerpt", "clplace-core")}
                        className="rttpg-toggle-control-field"
                        checked={show_excerpt}
                        onChange={(show_excerpt) => setAttributes({show_excerpt: show_excerpt ? 'show' : ''})}
                    />

                    <ToggleControl
                        label={__("Meta Data", "clplace-core")}
                        className="rttpg-toggle-control-field"
                        checked={show_meta}
                        onChange={(show_meta) => setAttributes({show_meta: show_meta ? 'show' : ''})}
                    />

                    {'show' === show_meta && (

                        <>
                            <ToggleControl
                                label={__("Post Date", "clplace-core")}
                                className="rttpg-toggle-control-field rttpg-padding-left"
                                checked={show_date}
                                onChange={(show_date) => setAttributes({show_date: show_date ? 'show' : ''})}
                            />

                            <ToggleControl
                                label={__("Post Category", "clplace-core")}
                                className="rttpg-toggle-control-field rttpg-padding-left"
                                checked={show_category}
                                onChange={(show_category) => setAttributes({show_category: show_category ? 'show' : ''})}
                            />
                            {show_category === 'show' && <small
                                className="rttpg-help pl-30">{__("NB: If needed, you can change category source from (Category & tags Settings)", "clplace-core")}</small>}

                            <ToggleControl
                                label={__("Post Tags", "clplace-core")}
                                className="rttpg-toggle-control-field rttpg-padding-left"
                                checked={show_tags}
                                onChange={(show_tags) => setAttributes({show_tags: show_tags ? 'show' : ''})}
                            />

                            {show_tags === 'show' &&
                                <small
                                    className="rttpg-help pl-30">{__("NB: If needed, you can change tag source from (Meta Data Settings)", "clplace-core")}</small>}

                            <ToggleControl
                                label={__("Post Author", "clplace-core")}
                                className="rttpg-toggle-control-field rttpg-padding-left"
                                checked={show_author}
                                onChange={(show_author) => setAttributes({show_author: show_author ? 'show' : ''})}
                            />

                            <ToggleControl
                                label={__("Post Comment Count", "clplace-core")}
                                className="rttpg-toggle-control-field rttpg-padding-left"
                                checked={show_comment_count}
                                onChange={(show_comment_count) => setAttributes({show_comment_count: show_comment_count ? 'show' : ''})}
                            />

                            <div className="rttpg-arert-wrapper">
                                <ToggleControl
                                    label={__("Post View Count", "clplace-core")}
                                    className={`rttpg-toggle-control-field rttpg-padding-left ${CLPLACE_IS_PRO}`}
                                    checked={show_post_count}
                                    onChange={(show_post_count) => setAttributes({show_post_count: show_post_count ? 'show' : ''})}
                                />
                                {CLPLACE_IS_PRO === 'rttpg-is-pro' &&
                                    <div className={`rttpg-alert-message`} onClick={() => {
                                        cogoToast.warn('Please upgrade to pro for this feature.', {position: 'top-right'});
                                    }}></div>}
                            </div>

                        </>)}


                    <ToggleControl
                        label={__("Read More Button", "clplace-core")}
                        className="rttpg-toggle-control-field"
                        checked={show_read_more}
                        onChange={(show_read_more) => setAttributes({show_read_more: show_read_more ? 'show' : ''})}
                    />

                    <div className="rttpg-arert-wrapper">
                        <ToggleControl
                            label={__("Social Share", "clplace-core")}
                            className={`rttpg-toggle-control-field ${CLPLACE_IS_PRO}`}
                            checked={show_social_share}
                            onChange={(show_social_share) => setAttributes({show_social_share: show_social_share ? 'show' : ''})}
                        />
                        {CLPLACE_IS_PRO === 'rttpg-is-pro' &&
                            <div className={`rttpg-alert-message`} onClick={() => {
                                cogoToast.warn('Please upgrade to pro for this feature.', {position: 'top-right'});
                            }}></div>}
                    </div>

                    {(post_type === 'product' && attributes[postLayout] !== 'grid-layout7') && (
                        <div className="rttpg-arert-wrapper">
                            <ToggleControl
                                label={__("Woocommerce Rating", "clplace-core")}
                                className={`rttpg-toggle-control-field ${CLPLACE_IS_PRO}`}
                                checked={show_woocommerce_rating}
                                onChange={(show_woocommerce_rating) => setAttributes({show_woocommerce_rating: show_woocommerce_rating ? 'show' : ''})}
                            />
                        </div>
                    )}

                    {(rtParams.hasAcf && !['grid-layout7', 'slider-layout4'].includes(attributes[postLayout])) && (
                        <div className="rttpg-arert-wrapper">

                            <ToggleControl
                                label={__("Advanced Custom Field", "clplace-core")}
                                className={`rttpg-toggle-control-field ${CLPLACE_IS_PRO}`}
                                checked={show_acf}
                                onChange={(show_acf) => {
                                    setAttributes({show_acf: show_acf ? 'show' : ''})
                                    changeQuery()
                                }}
                            />
                            {show_acf === 'show' && <small
                                className="rttpg-help">{__("NB. Please choose ACF group from below ACF settings", "clplace-core")}</small>}
                            {CLPLACE_IS_PRO === 'rttpg-is-pro' &&
                                <div className={`rttpg-alert-message`} onClick={() => {
                                    cogoToast.warn('Please upgrade to pro for this feature.', {position: 'top-right'});
                                }}></div>}
                        </div>
                    )}
                </>
            }
        </PanelBody>
    );
}

export default FieldSelectionSettings;
