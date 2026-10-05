import {get_el_thumb_cat} from "./functions";

function Thumbnail(props) {
    const attributes = props.attributes;
    const post = props.post;
    const {prefix, category_position, show_category, is_thumb_lightbox} = attributes;
    let postLayout = prefix + "_layout";
    let thumb_cat_condition = (!(category_position === 'above_title' || category_position === 'default'));

    if (attributes[postLayout] === 'grid-layout4' && category_position === 'default') {
        thumb_cat_condition = true;
    } else if (category_position === 'default' && ['grid-layout4', 'grid_hover-layout11', 'slider-layout3'].includes(attributes[postLayout])) {
        thumb_cat_condition = true;
    }

    const offsetSize = props?.offset;
    let imageURL = '';
    if (offsetSize === 'yes' && post.offset_image_url) {
        imageURL = post.offset_image_url;
    } else if (post.image_url) {
        imageURL = post.image_url;
    }

    return (
        <div className="rt-img-holder tpg-el-image-wrap">
            {
                ((rtParams.hasPro && show_category === 'show' && thumb_cat_condition && 'with_meta' !== category_position) &&
                    get_el_thumb_cat({attributes, post})
                )
            }

            {imageURL && <img src={imageURL} className="rt-img-responsive" alt={post.title}/>}

            {
                (is_thumb_lightbox === 'show' || (['grid-layout7', 'slider-layout4'].includes(attributes[postLayout]) && ['default', 'show'].includes(is_thumb_lightbox))) &&
                <a className="tpg-zoom" href="#">
                    <i className="fa fa-plus"></i>
                </a>
            }

            <div className="overlay grid-hover-content"></div>
        </div>
    );
}

export default Thumbnail;
