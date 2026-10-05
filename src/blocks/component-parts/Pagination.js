import Pagination from "../../components/pagination/Pagination";
import {change_icon} from "./functions";

function PostPagination({props, totalPages}) {
    const {attributes, setAttributes} = props;
    const {
        show_pagination,
        page,
        pagination_type,
        load_more_button_text,
        query_change,
        ajax_pagination_type
    } = attributes;
    if (show_pagination !== 'show' || totalPages < 2) {
        return '';
    }
    return (
        <div className="rt-pagination-wrap">
            {['pagination', 'pagination_ajax'].includes(pagination_type) && (
                ajax_pagination_type === 'yes' ?
                    <div className="rt-pagination">
                        <ul className="pagination-list">
                            <li className=""><a href="#"><i className={change_icon("fa fa-angle-double-left", "left-arrow")}></i></a></li>
                            <li className=""><a href="#"><i className={change_icon("fa fa-angle-double-right", "right-arrow")}></i></a></li>
                        </ul>
                    </div>
                    :
                    <Pagination
                        total={totalPages}
                        current={page}
                        onClickPage={page => setAttributes({page, query_change: true})}
                    />

            )
            }
            {'load_more' === pagination_type &&
                <div className="rt-loadmore-btn rt-loadmore-action rt-loadmore-style">
                    <span
                        className="rt-loadmore-text">{load_more_button_text ? load_more_button_text : 'Load More'}</span>
                </div>
            }


        </div>
    )
}

export default PostPagination;