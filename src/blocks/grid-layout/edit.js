const {useEffect, useState} = wp.element;
import {CssGenerator} from "../../utils/css/CssGenerator";
import apiFetch from "@wordpress/api-fetch";
import Inspector from "./inspector";
import GridLayouts from "./layouts/GridLayouts";
import icons from "../../components/icon/icons";

const Edit = (props) => {
    const {isSelected, attributes, setAttributes} = props;

    //all attribute
    const {
        preview,
        uniqueId,
    } = attributes;

    //set block preview
    if (preview) {
        return icons.grid_preview;
    }




    useEffect(() => {
        const sidebarEl = document.querySelector('.interface-interface-skeleton__sidebar');
        sidebarEl.classList.add('tpg-sidebar')
        sidebarEl.classList.remove('tpg-settings-enable')
        sidebarEl.addEventListener('click', function (event) {
            const hasClass = event.target.classList.contains('rttpg-tab-btn');
            if (hasClass) {
                const selectText = event.target.textContent;
                if (selectText !== 'Content') {
                    this.classList.add('tpg-settings-enable')
                } else {
                    this.classList.remove('tpg-settings-enable')
                }
            }
        })
        sidebarEl.addEventListener('scroll', function (e) {
            if (e.target.scrollTop > 86) {
                this.classList.add('tpg-should-collapse');
            } else {
                this.classList.remove('tpg-should-collapse');
            }
        })

    }, [isSelected]);

    if (uniqueId) {
        CssGenerator(attributes, 'post-block', uniqueId);
    }

    //render
    return [
        isSelected && (
            <Inspector
                attributes={attributes}
                setAttributes={setAttributes}
            />
        ),
        <GridLayouts props={props}/>
    ]

}
export default Edit;
