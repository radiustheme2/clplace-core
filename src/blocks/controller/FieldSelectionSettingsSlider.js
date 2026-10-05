const {__} = wp.i18n;
import {ToggleControl, PanelBody} from "@wordpress/components";
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
                onChange={(val) => {
                    setAttributes({show_section_title: val ? 'show' : ''})
                    changeQuery();
                }}
            />

            {attributes[postLayout] !== 'grid-layout7' &&
                <ToggleControl
                    label={__("Post Title", "clplace-core")}
                    className="rttpg-toggle-control-field"
                    checked={show_title}
                    onChange={(val) => {
                        setAttributes({show_title: val ? 'show' : ''})
                        changeQuery();
                    }}
                />
            }

            <ToggleControl
                label={__("Post Thumbnail", "clplace-core")}
                className="rttpg-toggle-control-field"
                checked={show_thumb}
                onChange={(val) => {
                    setAttributes({show_thumb: val ? 'show' : ''});
                    changeQuery();
                }}
            />

            {attributes[postLayout] !== 'grid-layout7' &&
                <>
                    <ToggleControl
                        label={__("Post Excerpt", "clplace-core")}
                        className="rttpg-toggle-control-field"
                        checked={show_excerpt}
                        onChange={(val) => {
                            setAttributes({show_excerpt: val ? 'show' : ''})
                            changeQuery()
                        }}
                    />

                    <ToggleControl
                        label={__("Post Meta", "clplace-core")}
                        className="rttpg-toggle-control-field"
                        checked={show_meta}
                        onChange={(val) => {
                            setAttributes({show_meta: val ? 'show' : ''})
                            changeQuery()
                        }}
                    />

                    {'show' === show_meta && (

                        <>
                            <ToggleControl
                                label={__("Post Date", "clplace-core")}
                                className="rttpg-toggle-control-field rttpg-padding-left"
                                checked={show_date}
                                onChange={(val) => {
                                    setAttributes({show_date: val ? 'show' : ''})
                                    changeQuery();
                                }}
                            />

                            <ToggleControl
                                label={__("Post Category", "clplace-core")}
                                className="rttpg-toggle-control-field rttpg-padding-left"
                                checked={show_category}
                                onChange={(val) => {
                                    setAttributes({show_category: val ? 'show' : ''})
                                    changeQuery()
                                }}
                            />
                            {show_category === 'show' && <small
                                className="rttpg-help pl-30">{__("NB. If needed, you can change category source from (Meta Data Settings)", "clplace-core")}</small>}

                            <ToggleControl
                                label={__("Post Tags", "clplace-core")}
                                className="rttpg-toggle-control-field rttpg-padding-left"
                                checked={show_tags}
                                onChange={(val) => {
                                    setAttributes({show_tags: val ? 'show' : ''})
                                    changeQuery()
                                }}
                            />

                            {show_tags === 'show' &&
                                <small
                                    className="rttpg-help pl-30">{__("NB: If needed, you can change tag source from (Meta Data Settings)", "clplace-core")}</small>}

                            <ToggleControl
                                label={__("Post Author", "clplace-core")}
                                className="rttpg-toggle-control-field rttpg-padding-left"
                                checked={show_author}
                                onChange={(val) => {
                                    setAttributes({show_author: val ? 'show' : ''})
                                    changeQuery()
                                }}
                            />

                            <ToggleControl
                                label={__("Post Comment Count", "clplace-core")}
                                className="rttpg-toggle-control-field rttpg-padding-left"
                                checked={show_comment_count}
                                onChange={(val) => {
                                    setAttributes({show_comment_count: val ? 'show' : ''})
                                    changeQuery()
                                }}
                            />

                            <ToggleControl
                                label={__("Post View Count", "clplace-core")}
                                className="rttpg-toggle-control-field rttpg-padding-left"
                                checked={show_post_count}
                                onChange={(val) => {
                                    setAttributes({show_post_count: val ? 'show' : ''})
                                    changeQuery()
                                }}
                            />

                        </>)}


                    <ToggleControl
                        label={__("Read More Button", "clplace-core")}
                        className="rttpg-toggle-control-field"
                        checked={show_read_more}
                        onChange={(val) => {
                            setAttributes({show_read_more: val ? 'show' : ''})
                            changeQuery()
                        }}
                    />


                    <ToggleControl
                        label={__("Social Share", "clplace-core")}
                        className="rttpg-toggle-control-field"
                        checked={show_social_share}
                        onChange={(val) => {
                            setAttributes({show_social_share: val ? 'show' : ''})
                            changeQuery()
                        }}
                    />
                </>
            }

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

            {(rtParams.hasAcf && rtParams.hasPro && attributes[postLayout] !== 'grid-layout7') && (
                <>
                    <ToggleControl
                        label={__("Advanced Custom Field", "clplace-core")}
                        className="rttpg-toggle-control-field"
                        checked={show_acf}
                        onChange={(val) => {
                            setAttributes({show_acf: val ? 'show' : ''})
                            changeQuery()
                        }}
                    />
                    {show_acf === 'show' && <small
                        className="rttpg-help">{__("NB. Please choose ACF group from below ACF settings", "clplace-core")}</small>}
                </>
            )}
        </PanelBody>
    );
}

export default FieldSelectionSettings;
