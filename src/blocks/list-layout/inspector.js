import PromotionalMessage from "../controller/PromotionalMessage";

const {InspectorControls} = wp.blockEditor;

import {TabPanel} from "@wordpress/components";
import LayoutController from "../controller/LayoutController";
import QueryController from "../controller/QueryController";
import PaginationController from "../controller/PaginationController";
import LinksController from "../controller/LinksController";
import FrontEndFilterController from "../controller/FrontEndFilterController";
import FieldSelectionSettings from "../controller/FieldSelectionSettings";
import SectionTitleSettings from "../controller/SectionTitleSettings";
import TitleSettings from "../controller/TitleSettings";
import ExcerptSettings from "../controller/ExcerptSettings";
import PostThumbnailSettings from "../controller/PostThumbnailSettings";
import MetaSettings from "../controller/MetaSettings";
import ACFSettings from "../controller/ACFSettings";
import ReadMoreSettings from "../controller/ReadMoreSettings";
import PaginationStyle from "../controller/PaginationStyle";
import SectionTitleStyle from "../controller/SectionTitleStyle";
import TitleStyle from "../controller/TitleStyle";
import PostThumbnailStyle from "../controller/PostThumbnailStyle";
import ExcerptStyle from "../controller/ExcerptStyle";
import MetaStyle from "../controller/MetaStyle";
import SocialShareStyle from "../controller/SocialShareStyle";
import ACFStyle from "../controller/ACFStyle";
import ReadMoreStyle from "../controller/ReadMoreStyle";
import FrontEndFilterStyle from "../controller/FrontEndFilterStyle";
import CardStyle from "../controller/CardStyle";
import WrapperStyle from "../controller/WrapperStyle";

function Inspector(props) {
    const {attributes, setAttributes, changeQuery, acfData, imageSizes} = props;

    //All attribute
    const {prefix, taxonomy_lists, ignore_sticky_posts, acf_data_lists} = attributes;

    let postLayout = prefix + "_layout";

    //Change Layout handle
    const changeLayout = (selected) => {
        setAttributes(attributes[postLayout] = selected)
        changeQuery();
    }

    //Change Taxonomy handle
    const changeTaxonomy = (terms, tax) => {
        let oldTaxonomies = {
            ...taxonomy_lists,
            [tax]: {
                'name': tax, 'options': terms
            }
        }
        setAttributes({taxonomy_lists: oldTaxonomies});
        changeQuery()
    }

    //Change Taxonomy handle
    const changeAcfData = (value, key) => {
        let OldAcf = {
            ...acf_data_lists,
            [key]: {
                'name': key, 'options': value
            }
        }
        setAttributes({acf_data_lists: OldAcf});
        changeQuery()
    }

    return (
        <InspectorControls key="controls">
            <div className="rttpg-panel-control-wrapper">
                <TabPanel className="rttpg-tab-panel" activeClass="active-tab" tabs={[
                    {name: "content", title: "Content", className: "rttpg-tab-btn content"},
                    {name: "settings", title: "Settings", className: "rttpg-tab-btn settings"},
                    {name: "styles", title: "Styles", className: "rttpg-tab-btn styles"}
                ]}
                >
                    {(tab) => (
                        <div className="rttpg-tab-content">

                            {/* Content Tab*/}
                            {tab.name === "content" && (
                                <>
                                    <LayoutController data={props} changeLayout={changeLayout}/>
                                    <QueryController data={props} changeTaxonomy={changeTaxonomy}/>
                                    <FrontEndFilterController data={props}/>
                                    <PaginationController data={props}/>
                                    <LinksController data={props}/>
                                    <PromotionalMessage/>
                                </>
                            )}

                            {/* Settings Tab*/}
                            {tab.name === "settings" && (
                                <>
                                    <FieldSelectionSettings data={props}/>
                                    <SectionTitleSettings data={props}/>
                                    <TitleSettings data={props}/>
                                    <PostThumbnailSettings data={props} imageSizes={imageSizes}/>
                                    <ExcerptSettings data={props}/>
                                    <MetaSettings data={props}/>
                                    <ACFSettings data={props} changeAcfData={changeAcfData} acfData={acfData}/>
                                    <ReadMoreSettings data={props}/>
                                </>
                            )}

                            {/* Style Tab*/}
                            {tab.name === "styles" && (
                                <>
                                    <SectionTitleStyle data={props}/>
                                    <TitleStyle data={props}/>
                                    <PostThumbnailStyle data={props}/>
                                    <ExcerptStyle data={props}/>
                                    <MetaStyle data={props}/>
                                    <SocialShareStyle data={props}/>
                                    <ACFStyle data={props}/>
                                    <ReadMoreStyle data={props}/>
                                    <PaginationStyle data={props}/>
                                    {rtParams.hasPro && <FrontEndFilterStyle data={props}/>}
                                    <CardStyle data={props}/>
                                    <WrapperStyle data={props}/>
                                </>
                            )}
                        </div>
                    )}
                </TabPanel>
            </div>
        </InspectorControls>
    )
}

export default Inspector;