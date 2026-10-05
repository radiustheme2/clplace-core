import {el_ignore_layout, get_el_thumb_cat} from "./functions";

function Heading({attributes, post}) {
    const {prefix, category_position, title_tag} = attributes;

    let postLayout = prefix + "_layout";
    const HeadingTag = `${title_tag}`;

    return (
        <div className="entry-title-wrapper">
            {
                ((rtParams.hasPro && category_position === 'above_title' || !el_ignore_layout(attributes[postLayout], category_position)) &&
                    get_el_thumb_cat({attributes, post}, 'cat-above-title')
                )
            }
            <HeadingTag className="entry-title">
                <a href="#" dangerouslySetInnerHTML={{__html: post.title}}></a>
            </HeadingTag>
        </div>
    );
}

export default Heading;
