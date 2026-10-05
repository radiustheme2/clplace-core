import Thumbnail from "../../../component-parts/Thumbnail"
import Heading from "../../../component-parts/Heading"
import MetaData from "../../../component-parts/MetaData";
import SocialShare from "../../../component-parts/SocialShare";
import ReadMore from "../../../component-parts/ReadMore";
import PostExcerpt from "../../../component-parts/PostExcerpt";

function Layout3({attributes, post}) {
    const {
        hover_animation,
        layout_style,
        show_thumb,
        show_title,
        show_meta,
        show_excerpt,
        show_acf,
        show_social_share,
        show_read_more
    } = attributes;


    let gridColumn = "rt-col-md-12 rt-col-sm-12 rt-col-xs-12";

    let colClasses = " rt-list-item rt-grid-item";
    colClasses += " " + hover_animation;
    if (layout_style === 'masonry') {
        colClasses += " masonry-grid-item";
    }

    return (
        <div className={post.post_class + ' ' + gridColumn + ' ' + colClasses} data-id={post.id}>

            <div className="rt-holder tpg-post-holder">
                <div className="rt-detail rt-el-content-wrapper">

                    {(show_thumb === 'show') &&
                        <>
                            {post.tpg_post_count == 1 ?
                                <Thumbnail attributes={attributes} post={post}/>
                                :
                                <Thumbnail attributes={attributes} post={post} offset='yes'/>
                            }
                        </>
                    }

                    <div className="post-right-content">
                        {show_title === 'show' &&
                            <Heading attributes={attributes} post={post}/>
                        }

                        {show_meta === 'show' &&
                            <MetaData attributes={attributes} post={post}/>
                        }

                        {(show_excerpt === 'show' || show_acf === 'show') && post.tpg_post_count == 1 &&
                            <PostExcerpt attributes={attributes} post={post}/>
                        }

                        {(rtParams.hasPro && show_social_share === 'show') &&
                            <SocialShare/>
                        }

                        {show_read_more === 'show' && post.tpg_post_count == 1 &&
                            <ReadMore attributes={attributes}/>
                        }
                    </div>
                </div>

            </div>

        </div>
    );
}

export default Layout3;
