import cogoToast from "cogo-toast";

const {Spinner} = wp.components;
const {useEffect, useRef} = wp.element;
import {get_parent_class_list} from "../../component-parts/functions";

import LayoutManager from "./template/LayoutManager";
import SectionTitle from "../../component-parts/SectionTitle";
import PostPagination from "../../component-parts/Pagination";

function ListLayouts({props, postData, filterMarkup}) {
    const {attributes, setAttributes, clientId} = props;
    const {
        prefix,
        uniqueId,
        filter_btn_style,
        filter_type,
        grid_layout_style,
        display_per_page,
        query_change
    } = attributes;
    const posts = postData.posts;
    const totalPages = Math.ceil(postData.total_post / display_per_page);
    let dynamicParentClass = get_parent_class_list({props});
    const newClintID = clientId.substr(0, 6);

    let filterRef = useRef();

    useEffect(() => {
        if (!uniqueId) {
            setAttributes({uniqueId: newClintID});
        } else if (uniqueId && uniqueId !== newClintID) {
            setAttributes({uniqueId: newClintID});
        }
        filterRef.current.addEventListener('click', function (e) {
            if (e.target.classList.contains('rt-filter-item-wrap')) {
                cogoToast.warn('N.B: This field works front-end only.');
            }
        })
    }, []);

    let is_carousel = '';
    if (rtParams.hasPro && 'carousel' === filter_btn_style && 'button' === filter_type) {
        is_carousel = 'carousel';
    }

    // Wrapper Class
    let innerWrapperClass = attributes[prefix + '_layout'].replace(/-2/g, "");
    innerWrapperClass += ' list-behaviour';
    innerWrapperClass += ' ' + grid_layout_style;
    innerWrapperClass += ' ' + prefix + '-layout-wrapper';

    if (query_change) {
        innerWrapperClass += ' tpg-editor-loading';
    }

    const PostMap = ({posts}) => {
        return (
            posts.map(post => {
                if (post) {
                    if (post.message) {
                        return <div className="message">{post.message}</div>
                    }
                    return <LayoutManager attributes={attributes} post={post}/>
                } else return null
            })
        )
    }

    const AllPostRender = ({posts, layout}) => {

        if (['list-layout2', 'list-layout2-2', 'list-layout3', 'list-layout3-2'].includes(layout)) {
            const offsetPost = [...posts].slice(1)
            let leftCol = 'rt-col-xs-12 rt-col-md-4 rt-col-sm-5 offset-left-wrap offset-left';
            let rightCol = 'rt-col-xs-12 rt-col-md-8 rt-col-sm-7 offset-right';

            if (['list-layout3', 'list-layout3-2'].includes(layout)) {
                leftCol = 'rt-col-md-6 rt-col-sm-5 offset-left-wrap offset-left';
                rightCol = 'rt-col-md-6 rt-col-sm-7 offset-right';
            }
            return (
                <>
                    <div className={leftCol}>
                        <PostMap posts={[posts[0]]}/>
                    </div>

                    <div className={rightCol}>
                        <div className="rt-row">
                            <PostMap posts={offsetPost}/>
                        </div>
                    </div>
                </>
            )
        }
        return (
            <PostMap posts={posts}/>
        )
    }

    return (
        <div ref={filterRef} className={`rttpg-block-postgrid rttpg-block-wrapper rttpg-block-${uniqueId + ' ' + dynamicParentClass}`}>
            <div
                className={`rt-container-fluid rt-tpg-container tpg-el-main-wrapper clearfix ${attributes[prefix + '_layout']}-main`}
                data-el-settings='' data-el-query='' data-el-path=''>
                {(posts && posts.length) &&
                    <div className={`tpg-header-wrapper ${is_carousel}`}>
                        <SectionTitle attributes={attributes} setAttributes={setAttributes}/>
                        {rtParams.hasPro && <div className={`rt-layout-filter-container rt-clear`}
                                                    dangerouslySetInnerHTML={{__html: filterMarkup}}></div>}
                    </div>
                }

                <div className={`rt-row rt-content-loader ${innerWrapperClass}`}>
                    {
                        (posts && posts.length) ?
                            <AllPostRender posts={posts} layout={attributes[prefix + '_layout']}/>
                            :
                            <div className="rttpg-postgrid-is-loading">
                                {(postData?.message && postData.message) ? postData.message : <Spinner/>}
                            </div>
                    }
                </div>
                <PostPagination props={props} totalPages={totalPages}/>
            </div>
        </div>
    )
}

export default ListLayouts;