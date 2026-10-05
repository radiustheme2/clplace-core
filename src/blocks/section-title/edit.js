const {useEffect, useState} = wp.element;
import {CssGenerator} from "../../utils/css/CssGenerator";
import Inspector from "./inspector";
import SectionTitleLayout from "./layouts/SectionTitleLayout";
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

    const [queryEffect, setQueryEffect] = useState(false);

    const handleQueryChange = () => {
        setQueryEffect(!queryEffect);
        setAttributes({query_change: true, page: 1})
    }

    useEffect(() => {
        const sidebarEl = document.querySelector('.interface-interface-skeleton__sidebar');
        sidebarEl.classList.add('tpg-sidebar')
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
    }, []);


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
        CssGenerator(attributes, 'tpg-grid-layout', uniqueId);
    }

    //render
    return [
        isSelected && (
            <Inspector
                attributes={attributes}
                setAttributes={setAttributes}
                changeQuery={handleQueryChange}
            />
        ),
        <SectionTitleLayout props={props}/>
    ]

}
export default Edit;
