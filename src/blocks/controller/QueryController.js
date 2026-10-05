const {__} = wp.i18n;
import {__experimentalHeading as Heading} from '@wordpress/components';
import Select from 'react-select';
import "flatpickr/dist/themes/light.css";
import Flatpickr from "react-flatpickr";
import cogoToast from 'cogo-toast';
import {
    SelectControl,
    ToggleControl,
    TextControl,
    PanelBody,
    __experimentalNumberControl as NumberControl
} from "@wordpress/components";

import {
    POSTS_TYPE,
    AUTHOR_LISTS,
    TAX_RELATION,
    PRINT_TAXONOMY,
    POST_ORDER_BY,
    POST_SORT_ORDER,
    CLPLACE_IS_PRO
} from "../../components/Constants";

function QueryController(props) {
    const {attributes, setAttributes, changeQuery} = props.data;

    //All attribute
    const {
        ignore_sticky_posts,
        no_posts_found_text,
        post_type,
        post_id,
        exclude,
        post_limit,
        offset,
        author,
        post_keyword,
        relation,
        orderby,
        order,
        taxonomy_lists,
        start_date,
        end_date
    } = attributes;

    const allTermList = rtParams.all_term_list;
    const allTaxonomyList = rtParams.get_taxonomies;

    let tpgAllTaxonomies = new Set();
    for (let tax in allTaxonomyList) {
        let value = allTaxonomyList[tax];
        if (value.object_type[0] === post_type) {
            tpgAllTaxonomies.add({
                value: value.name, name: value.label
            });
        }
    }
    tpgAllTaxonomies = [...tpgAllTaxonomies];

    return (
        <PanelBody title={__('Query Build', 'clplace-core')} initialOpen={false}>
            <SelectControl
                label={__('Post Source', 'clplace-core')}
                className="rttpg-control-field label-inline rttpg-expand"
                value={post_type}
                options={POSTS_TYPE}
                onChange={(post_type) => {
                    setAttributes({post_type, page: 1})
                    changeQuery()
                }}
            />

            <Heading className="rttpg-control-heading">
                {__("Common Filters:", "clplace-core")}
            </Heading>

            <TextControl
                autocomplete="off"
                label={__("Include only", "clplace-core")}
                help={__("Enter the post IDs separated by comma for include", "clplace-core")}
                className="rttpg-control-field label-inline rttpg-expand has-help"
                placeholder="Eg. 10, 15, 17"
                value={post_id}
                onChange={(post_id) => {
                    setAttributes({post_id})
                    changeQuery()
                }}
            />

            <TextControl
                autocomplete="off"
                label={__("Exclude", "clplace-core")}
                help={__("Enter the post IDs separated by comma for exclude", "clplace-core")}
                placeholder="Eg. 12, 13"
                className="rttpg-control-field label-inline rttpg-expand has-help"
                value={exclude}
                onChange={(exclude) => {
                    setAttributes({exclude})
                    changeQuery()
                }}
            />

            <NumberControl
                isShiftStepEnabled
                label={__("Limit", "clplace-core")}
                max={100}
                min={-1}
                value={post_limit}
                onChange={(post_limit) => {
                    setAttributes({post_limit})
                    changeQuery()
                }}
                placeholder={__("Eg. 36", "clplace-core")}
                shiftStep={10}
                step="1"
                className="rttpg-control-field label-inline"
            />
            <p className="rttpg-help">{__("The number of posts to show. Enter -1 to show all found posts.", "clplace-core")}</p>

            <NumberControl
                isShiftStepEnabled
                label={__("Offset", "clplace-core")}
                max={100}
                min={0}
                value={offset}
                onChange={(offset) => {
                    setAttributes({offset})
                    changeQuery()
                }}
                placeholder={__("Eg. 3", "clplace-core")}
                shiftStep={10}
                step="1"
                className="rttpg-control-field label-inline"
            />

            <Heading className="rttpg-control-heading">
                {__("Advanced Filters:", "clplace-core")}
            </Heading>

            <div className="rttpg-ground-control">
                {tpgAllTaxonomies.map((taxonomy) => {
                    return (
                        <div className="components-base-control rttpg-repeater">
                            <label
                                className="components-base-control__label components-input-control__label"
                                htmlFor="react-select-2-input">
                                {__('By ' + taxonomy.name, 'clplace-core')}
                            </label>

                            <Select
                                options={PRINT_TAXONOMY(allTermList[taxonomy.value])}
                                value={Object.keys(taxonomy_lists).length > 0 ? taxonomy_lists[taxonomy.value] !== undefined ? taxonomy_lists[taxonomy.value].options : [] : []}
                                onChange={(value) => {
                                    props.changeTaxonomy(value, taxonomy.value)
                                }}
                                isMulti={true}
                                closeMenuOnSelect={true}
                                isClearable={false}
                            />
                        </div>
                    )
                })}

                <SelectControl
                    label={__("Taxonomies Relation", "clplace-core")}
                    className="rttpg-control-field label-inline"
                    value={relation}
                    options={TAX_RELATION}
                    onChange={(relation) => {
                        setAttributes({relation})
                        changeQuery()
                    }}
                />
            </div>


            <SelectControl
                label={__("By Author", "clplace-core")}
                className="rttpg-control-field label-inline rttpg-expand"
                value={author}
                options={AUTHOR_LISTS}
                onChange={(author) => {
                    setAttributes({author})
                    changeQuery()
                }}
            />


            <TextControl
                autocomplete="off"
                label={__("By Keyword", "clplace-core")}
                className="rttpg-control-field label-inline rttpg-expand"
                placeholder="Search by keyword"
                value={post_keyword}
                onChange={(post_keyword) => {
                    setAttributes({post_keyword})
                    changeQuery()
                }}
            />

            <div className={`rttpg-elm-wrapper ${CLPLACE_IS_PRO}`}>
                <label>{__("Start Date", "clplace-core")}</label>
                <Flatpickr
                    label={__("Start Date", "clplace-core")}
                    options={{'dateFormat': "M j, Y"}}
                    placeholder="Choose Start Date..."
                    value={start_date}
                    onChange={([start_date]) => {
                        setAttributes({start_date})
                        changeQuery()
                    }}
                />
                {CLPLACE_IS_PRO === 'rttpg-is-pro' && <div className={`rttpg-alert-message`} onClick={() => {
                    cogoToast.warn('Please upgrade to pro for this feature.', {position: 'top-right'});
                }}></div>}
            </div>

            <div className={`rttpg-elm-wrapper ${CLPLACE_IS_PRO}`}>
                <label> {__("End Date", "clplace-core")}</label>
                <Flatpickr
                    label={__("End Date", "clplace-core")}
                    options={{'dateFormat': "M j, Y"}}
                    placeholder="Choose End Date..."
                    value={end_date}
                    onChange={([end_date]) => {
                        setAttributes({end_date})
                        changeQuery()
                    }}
                />
                {CLPLACE_IS_PRO === 'rttpg-is-pro' && <div className={`rttpg-alert-message`} onClick={() => {
                    cogoToast.warn('Please upgrade to pro for this feature.', {position: 'top-right'});
                }}></div>}
            </div>

            <SelectControl
                label={__("Order By", "clplace-core")}
                className="rttpg-control-field label-inline rttpg-expand"
                value={orderby}
                options={POST_ORDER_BY}
                onChange={(orderby) => {
                    setAttributes({orderby})
                    changeQuery()
                }}
            />

            <SelectControl
                label={__("Sort Order", "clplace-core")}
                className="rttpg-control-field label-inline rttpg-expand"
                value={order}
                options={POST_SORT_ORDER}
                onChange={(order) => {
                    setAttributes({order})
                    changeQuery()
                }}
            />
            <hr/>

            <div className={`rttpg-elm-wrapper ${CLPLACE_IS_PRO}`}>
                <>
                    <ToggleControl
                        label={__("Ignore sticky posts", "clplace-core")}
                        className="rttpg-toggle-control-field"
                        checked={ignore_sticky_posts}
                        onChange={(ignore_sticky_posts) => {
                            setAttributes({ignore_sticky_posts: ignore_sticky_posts ? 'yes' : ''})
                            changeQuery()
                        }}
                    />
                    {CLPLACE_IS_PRO === 'rttpg-is-pro' && <div className={`rttpg-alert-message`} onClick={() => {
                        cogoToast.warn('Please upgrade to pro for this feature.', {position: 'top-right'});
                    }}></div>}
                </>
            </div>
            <hr/>

            {/*setAttributes({no_posts_found_text})*/}
            {/*changeQuery()*/}

            <TextControl
                autocomplete="off"
                label={__("No Post Found Text", "clplace-core")}
                className="rttpg-control-field"
                value={no_posts_found_text}
                onChange={val => {
                    setAttributes({no_posts_found_text: val});
                    changeQuery()
                }
                }
            />
        </PanelBody>
    );
}

export default QueryController;
