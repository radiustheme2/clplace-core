function PostExcerpt({attributes, post}) {

    const {show_excerpt} = attributes;

    return (
        <div className="tpg-excerpt tpg-el-excerpt">
            {(show_excerpt === 'show' && post.excerpt) &&
                <div className="tpg-excerpt-inner" dangerouslySetInnerHTML={{__html: post.excerpt}}></div>
            }
            {post.acf_data &&
                <div dangerouslySetInnerHTML={{__html: post.acf_data}}></div>
            }
        </div>
    )
}

export default PostExcerpt;