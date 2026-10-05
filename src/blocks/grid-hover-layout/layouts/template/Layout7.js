import Thumbnail from "../../../component-parts/Thumbnail"
import Heading from "../../../component-parts/Heading"
import MetaData from "../../../component-parts/MetaData";
import SocialShare from "../../../component-parts/SocialShare";
import ReadMore from "../../../component-parts/ReadMore";
import PostExcerpt from "../../../component-parts/PostExcerpt";

function Layout7({attributes, post}) {
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

    let colClasses = " rt-grid-hover-item rt-grid-item";
    colClasses += " " + hover_animation;

    let newGridColumn = 'rt-col-md-6 rt-col-sm-6 rt-col-xs-12';
    if (post.tpg_post_count == 1) {
        newGridColumn = " tpg-reset-margin";
    }

    return (
        <div className={post.post_class + ' ' + newGridColumn + ' ' + colClasses} data-id={post.id}>

            <div className="rt-holder tpg-post-holder">
                <div className="rt-detail rt-el-content-wrapper">

                    {(show_thumb === 'show') &&
                        <Thumbnail attributes={attributes} post={post}/>
                    }

                    <div className="grid-hover-content">
                        {show_title === 'show' &&
                            <Heading attributes={attributes} post={post}/>
                        }

                        {show_meta === 'show' &&
                            <MetaData attributes={attributes} post={post}/>
                        }

                        {(show_excerpt === 'show' || show_acf === 'show') &&
                            <PostExcerpt attributes={attributes} post={post}/>
                        }

                        {(rtParams.hasPro && show_social_share === 'show') &&
                            <SocialShare/>
                        }

                        {show_read_more === 'show' &&
                            <ReadMore attributes={attributes}/>
                        }
                    </div>
                </div>

            </div>

        </div>
    );
}

export default Layout7;
