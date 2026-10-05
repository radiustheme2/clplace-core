import Thumbnail from "../../../component-parts/Thumbnail"
import Heading from "../../../component-parts/Heading"
import MetaData from "../../../component-parts/MetaData";
import SocialShare from "../../../component-parts/SocialShare";
import ReadMore from "../../../component-parts/ReadMore";
import PostExcerpt from "../../../component-parts/PostExcerpt";

function Layout5({attributes, post}) {
    const {
        hover_animation,
        show_thumb,
        show_title,
        show_meta,
        show_excerpt,
        show_acf,
        show_social_share,
        show_read_more
    } = attributes;

    const {tpg_post_count} = post;

    let colClasses = " ";
    colClasses += " " + hover_animation;

    return (

        <div className={`offset-item ${post.post_class}  ${colClasses}`}>
            <div className="rt-holder tpg-post-holder">
                <div className="rt-detail rt-el-content-wrapper">

                    {(show_thumb === 'show') &&
                        <Thumbnail attributes={attributes} post={post}/>
                    }

                    <div className="offset-content">
                        {show_title === 'show' &&
                            <Heading attributes={attributes} post={post}/>
                        }

                        {show_meta === 'show' &&
                            <MetaData attributes={attributes} post={post}/>
                        }

                        {(show_excerpt === 'show' || show_acf === 'show') && tpg_post_count == 1 &&
                            <PostExcerpt attributes={attributes} post={post}/>
                        }

                        {(rtParams.hasPro && show_social_share === 'show' && tpg_post_count == 1) &&
                            <SocialShare/>
                        }

                        {(show_read_more === 'show' && tpg_post_count == 1) &&
                            <ReadMore attributes={attributes}/>
                        }

                    </div>
                </div>
            </div>
        </div>

    )
}

export default Layout5;
