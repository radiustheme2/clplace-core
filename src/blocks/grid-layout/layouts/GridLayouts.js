import cogoToast from "cogo-toast";

const {Spinner} = wp.components;
const {useEffect, useRef} = wp.element;
import {get_parent_class_list} from "../../component-parts/functions";
import LayoutManager from "./template/LayoutManager";
import SectionTitle from "../../component-parts/SectionTitle";
import PostPagination from "../../component-parts/Pagination";

function GridLayouts({props}) {
    const {attributes, setAttributes, clientId} = props;
    const {
        uniqueId,
    } = attributes;

    const newClintID = clientId.substr(0, 6);

    useEffect(() => {
        if (!uniqueId) {
            setAttributes({uniqueId: newClintID});
        } else if (uniqueId && uniqueId !== newClintID) {
            setAttributes({uniqueId: newClintID});
        }
    }, []);

    return (
        <div className={`clplace-post-wrapper  ${RDTheme.itemID}-block-${uniqueId}`}>
           Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem consequuntur delectus ea excepturi impedit maiores pariatur, porro praesentium recusandae reiciendis, reprehenderit sunt unde ut veniam voluptate. Earum eveniet odio qui?
        </div>
    )
}

export default GridLayouts;