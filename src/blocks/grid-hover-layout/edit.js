const {useEffect, useState} = wp.element;
import {CssGenerator} from "../../utils/css/CssGenerator";
import apiFetch from "@wordpress/api-fetch";
import Inspector from "./inspector";
import GridHoverLayouts from "./layouts/GridHoverLayouts";
import icons from "../../components/icon/icons";

const Edit = (props) => {
    const {isSelected, attributes, setAttributes} = props;

    //all attribute
    const {
        preview,
        prefix,
        uniqueId,
        grid_hover_layout,
        post_id,
        exclude,
        post_limit,
        title_limit,
        title_limit_type,
        offset,
        post_keyword,
        display_per_page,
        layout_style,
        ignore_sticky_posts,
        no_posts_found_text,
        show_pagination,
        media_source,
        image_size,
        image_offset_size,
        default_image,
        category_position,
        category_source,
        tag_source,
        taxonomy_lists,
        start_date,
        end_date,
        hover_animation,
        excerpt_type,
        excerpt_limit,
        excerpt_more_text,
        page,
        query_change,
        acf_data_lists,
        show_acf,
        cf_hide_empty_value,
        cf_show_only_value,
        cf_hide_group_title,

        //TODO: Fetch post filter markup

        post_type,
        author,
        order,
        orderby,
        show_taxonomy_filter,
        show_author_filter,
        show_order_by,
        show_sort_order,
        show_search,
        filter_btn_style,
        filter_btn_item_per_page_mobile,
        filter_btn_item_per_page_tablet,
        filter_btn_item_per_page,
        filter_type,
        filter_taxonomy,
        filter_post_count,
        relation,
        tax_filter_all_text,
        tgp_filter_taxonomy_hierarchical,
        author_filter_all_text,
        tpg_hide_all_button
    } = attributes;

    //set block preview
    if (preview) {
        return icons.grid_hover_preview;
    }

    const [posts, setPosts] = useState([]);
    const [signalController, setSignalController] = useState();
    const [queryEffect, setQueryEffect] = useState(false);
    const [acfData, setAcfData] = useState([])
    const [imageSizes, setImageSizes] = useState([])
    const [filterMarkup, setfilterMarkup] = useState([])
    const controller = typeof AbortController === 'undefined' ? undefined : new AbortController();

    const handleQueryChange = () => {
        setQueryEffect(!queryEffect);
        setAttributes({query_change: true, page: 1})
    }

    const fetch_all_posts = () => {
        signalController?.abort();
        setSignalController(controller);
        setPosts({})
        apiFetch({
            path: '/rttpg/v1/query',
            method: 'POST',
            data: {
                prefix,
                post_type,
                grid_hover_layout,
                post_id,
                exclude,
                post_limit,
                title_limit,
                title_limit_type,
                offset,
                show_pagination,
                ignore_sticky_posts,
                orderby,
                order,
                display_per_page,
                layout_style,
                author,
                start_date,
                end_date,
                media_source,
                image_size,
                image_offset_size,
                show_taxonomy_filter,
                relation,
                post_keyword,
                no_posts_found_text,
                default_image,
                category_position,
                taxonomy_lists,
                category_source,
                tag_source,
                hover_animation,
                excerpt_type,
                excerpt_limit,
                excerpt_more_text,
                page,
                acf_data_lists,
                show_acf,
                cf_hide_empty_value,
                cf_show_only_value,
                cf_hide_group_title
            }
        }).then((data) => {
            setAttributes({query_change: false})
            setPosts(data)
        });
    }

    const fetch_filter_markup = () => {
        if (!rtParams.hasPro) {
            return;
        }
        signalController?.abort();
        setSignalController(controller);
        apiFetch({
            path: '/rttpg/v1/filter',
            method: 'POST',
            signal: controller?.signal,
            data: {
                prefix,
                post_type,
                author,
                order,
                orderby,
                taxonomy_lists,
                show_taxonomy_filter,
                show_author_filter,
                show_order_by,
                show_sort_order,
                show_search,
                filter_btn_style,
                filter_btn_item_per_page_mobile,
                filter_btn_item_per_page_tablet,
                filter_btn_item_per_page,
                filter_type,
                filter_taxonomy,
                filter_post_count,
                relation,
                tax_filter_all_text,
                tgp_filter_taxonomy_hierarchical,
                author_filter_all_text,
                tpg_hide_all_button
            }
        }).then((filterMarkup) => {
            setAttributes({query_change: false})
            setfilterMarkup(filterMarkup?.markup)
        })
    }

    const fetch_all_acf_data = () => {
        signalController?.abort();
        setSignalController(controller);
        apiFetch({path: "/rttpg/v1/acf",signal: controller?.signal})
            .then(acfData => {
                let acfArr = [];
                Object.keys(acfData).map(key => {
                    acfArr.push(acfData[key]);
                })
                setAcfData(acfArr)
            })
    }

    const fetch_all_image_size = () => {
        signalController?.abort();
        setSignalController(controller);
        apiFetch({path: "/rttpg/v1/image-size",signal: controller?.signal})
            .then((imageSizes) => {
                setImageSizes(imageSizes)
            })
    }

    useEffect(() => {
        fetch_all_posts();
        fetch_all_acf_data();
        fetch_filter_markup();
    }, [queryEffect, page]);

    useEffect(() => {
        fetch_all_image_size();
    }, []);

    useEffect(() => {
        const sidebarEl = document.querySelector('.interface-interface-skeleton__sidebar');
        sidebarEl.classList.add('tpg-sidebar')
        sidebarEl.classList.remove('tpg-settings-enable')
        sidebarEl.addEventListener('click', function (event) {
            const hasClass = event.target.classList.contains('rttpg-tab-btn');
            if (hasClass) {
                const selectText = event.target.textContent;
                if (selectText !== 'Content') {
                    this.classList.add('tpg-settings-enable')
                } else {
                    this.classList.remove('tpg-settings-enable')
                }
            }
        })
        sidebarEl.addEventListener('scroll', function (e) {
            if (e.target.scrollTop > 86) {
                this.classList.add('tpg-should-collapse');
            } else {
                this.classList.remove('tpg-should-collapse');
            }
        })

    }, [isSelected]);

    if (uniqueId) {
        CssGenerator(attributes, 'tpg-grid-layout', uniqueId);
    }

    //render
    return [
        isSelected && (
            <Inspector
                attributes={attributes}
                setAttributes={setAttributes}
                changeQuery={handleQueryChange}
                acfData={acfData}
                imageSizes={imageSizes}
                postData={posts}
            />
        ),
        <GridHoverLayouts props={props} postData={posts} filterMarkup={filterMarkup}/>
    ]

}
export default Edit;
