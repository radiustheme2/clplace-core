import {change_icon} from "./functions";

function ReadMore({attributes}) {

    const {read_more_label, post_link_type, show_btn_icon, readmore_btn_icon, readmore_icon_position} = attributes;

    let readMoreClass = ' tpg-post-link';

    if (post_link_type === 'popup') {
        readMoreClass += ' tpg-single-popup';
    } else if (post_link_type === 'multi_popup') {
        readMoreClass += ' tpg-multi-popup';
    }

    if (!read_more_label) {
        return '';
    }

    return (
        <div className="post-footer">
            <div className="read-more">
                <a href="#" className={readMoreClass}>
                    {(readmore_icon_position === 'left' && show_btn_icon === 'yes') &&
                        <i className={`left-icon ` + change_icon("fas fa-arrow-left", "left-arrow")}></i>}
                    {read_more_label}
                    {(readmore_icon_position === 'right' && show_btn_icon === 'yes') &&
                        <i className={`right-icon ` + change_icon("fas fa-arrow-right", "right-arrow")}></i>}
                </a>
            </div>
        </div>
    )
}

export default ReadMore;