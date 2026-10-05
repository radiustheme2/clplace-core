const {useEffect, useRef} = wp.element;
import SectionTitle from "../../component-parts/SectionTitle";

function SectionTitleLayout({props}) {
    const {attributes, setAttributes, clientId} = props;
    const {
        uniqueId,
        section_title_style,
        section_title_alignment,
        enable_external_link
    } = attributes;

    let dynamicParentClass = ''; //get_parent_class_list({props});
    dynamicParentClass += ' section-title-style-' + section_title_style;
    dynamicParentClass += ' section-title-align-' + section_title_alignment;
    dynamicParentClass += enable_external_link === 'show' ? ' has-external-link' : '';
    const newClintID = clientId.substr(0, 6);

    let filterRef = useRef();

    useEffect(() => {
        if (!uniqueId) {
            setAttributes({uniqueId: newClintID});
        } else if (uniqueId && uniqueId !== newClintID) {
            setAttributes({uniqueId: newClintID});
        }
    }, []);


    return (
        <div ref={filterRef}
             className={`rttpg-block-postgrid rttpg-block-wrapper rttpg-block-${uniqueId + ' ' + dynamicParentClass}`}>
            <div className={`rt-tpg-container clearfix`}>
                <div className={`tpg-header-wrapper`}>
                    <SectionTitle attributes={attributes} setAttributes={setAttributes}/>
                </div>
            </div>
        </div>
    )
}

export default SectionTitleLayout;