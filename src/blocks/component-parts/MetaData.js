import {el_ignore_layout, change_icon} from "./functions";

function MetaData({attributes, post}) {
    const {
        prefix,
        show_author,
        show_author_image,
        show_meta_icon,
        author_prefix,
        show_category,
        category_position,
        show_date,
        show_tags,
        show_comment_count,
        show_post_count,
        meta_separator,
        meta_ordering,
        category_style,
        author_icon_visibility
    } = attributes;

    const {avatar_url, author_name, category, tags, post_date, comment_count, post_count, category_bg} = post;

    let postLayout = prefix + "_layout";

    let is_author_avatar = null;

    if (show_author_image === 'show') {
        is_author_avatar = 'has-author-avatar';
    }

    let category_condition = (category && show_category === 'show' && el_ignore_layout(attributes[postLayout], category_position) && ['default', 'with_meta'].includes(category_position));
    if (!rtParams.hasPro) {
        category_condition = (category && show_category === 'show')
    }

    const catCount = category.length;
    const tagCount = tags.length;

    let metaSeparator = (meta_separator && meta_separator !== 'default') ?
        <span className="separator">{meta_separator}</span> : null;

    const meta_data = {};
    meta_data.author = (show_author === 'show' &&
        <>
            <span className={`autho ${is_author_avatar}`}>
                {(show_meta_icon === 'yes' && author_icon_visibility !== 'hide') &&
                    <>
                        {show_author_image === 'image' ? <img src={avatar_url}/> : <i className={change_icon("fa fa-user", "user")}></i>}
                    </>
                }
                {author_prefix && (
                    <span className="author-prefix">{author_prefix}</span>
                )}
                <a href="#">{author_name}</a>
            </span>
            {metaSeparator}
        </>
    );

    meta_data.category = (category && category_condition &&
        <>
            <span className="categories-links">
                {show_meta_icon === 'yes' && <i className={change_icon("fas fa-folder-open", "folder")}></i>}
                {category.map((cat, index) => (
                    <>
                        <a href="#" style={{"--tpg-primary-color": category_bg[index]? category_bg[index]:''}}>{cat}</a>
                        {index !== (catCount - 1) && <span className="rt-separator">,</span>}
                    </>
                ))}
            </span>
            {metaSeparator}
        </>
    );

    meta_data.date = (show_date === 'show' &&
        <>
            <span className="date">
                {show_meta_icon === 'yes' && <i className={change_icon("far fa-calendar-alt", "calendar")}></i>}
                <a href="#">{post_date}</a>
            </span>
            {metaSeparator}
        </>
    );

    meta_data.tags = (tags && show_tags === 'show' &&
        <>
            <span className="post-tags-links">
                {show_meta_icon === 'yes' && <i className={change_icon("fa fa-tags", "tag")}></i>}
                {tags.map((tag, index) => (
                    <>
                        <a href="#">{tag}</a>
                        {index !== (tagCount - 1) && <span className="rt-separator">,</span>}
                    </>
                ))}
            </span>
            {metaSeparator}
        </>
    );

    meta_data.comment_count = (show_comment_count === 'show' &&
        <>
            <span className="comment-count">
                {show_meta_icon === 'yes' && <i className={change_icon("fas fa-comments", "chat")}></i>}
                {comment_count}
            </span>
            {metaSeparator}
        </>
    );

    meta_data.post_count = (rtParams.hasPro && show_post_count === 'show' &&
        <>
            <span className="post-count">
                {show_meta_icon === 'yes' && <i className={change_icon("fa fa-eye", "view")}></i>}
                {post_count}
            </span>
            {metaSeparator}
        </>
    );

    const meta_data_keys = Object.keys(meta_data);
    const newMetaOrdering = [...meta_ordering];
    const newMetaKey = newMetaOrdering.map(item => item.value);

    if ((meta_data_keys.length != meta_ordering.length) && newMetaKey.length) {
        let new_meta_arr = meta_data_keys.filter(item => !newMetaKey.includes(item))
        new_meta_arr.map(meta => {
            return (
                newMetaOrdering.push({value: meta, label: meta})
            )
        })
    }

    return (
        <div className={`post-meta-tags rt-el-post-meta`}>
            {
                (newMetaOrdering.length
                        ?
                        newMetaOrdering.map(item => meta_data[item.value])
                        :
                        meta_data_keys.map(key => meta_data[key])
                )
            }
        </div>
    );
}

export default MetaData;
