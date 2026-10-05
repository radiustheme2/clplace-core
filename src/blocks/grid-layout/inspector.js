const {InspectorControls} = wp.blockEditor;
import {TabPanel} from "@wordpress/components";
import LayoutController from "../controller/LayoutController";
import QueryController from "../controller/QueryController";
import TitleSettings from "../controller/TitleSettings";
import TitleStyle from "../controller/TitleStyle";


function Inspector(props) {
    const {attributes, setAttributes, changeQuery} = props;

    //All attribute
    const {prefix, taxonomy_lists, ignore_sticky_posts} = attributes;

    let postLayout = prefix + "_layout";

    //Change Layout handle
    const changeLayout = (selected) => {
        setAttributes(attributes[postLayout] = selected)
        changeQuery();
    }

    //Change Taxonomy handle
    const changeTaxonomy = (terms, tax) => {
        let oldTaxonomies = {
            ...taxonomy_lists, [tax]: {
                'name': tax, 'options': terms
            }
        }
        setAttributes({taxonomy_lists: oldTaxonomies});
        changeQuery()
    }


    return (<InspectorControls key="controls">
        <div className="rttpg-panel-control-wrapper">
            <TabPanel className="rttpg-tab-panel" activeClass="active-tab" tabs={[{
                name: "content",
                title: "Content",
                className: "rttpg-tab-btn content"
            }, {name: "settings", title: "Settings", className: "rttpg-tab-btn settings"}, {
                name: "styles",
                title: "Styles",
                className: "rttpg-tab-btn styles"
            }]}
            >
                {(tab) => (<div className="rttpg-tab-content">

                    {/* Content Tab*/}
                    {tab.name === "content" && (<>
                        <LayoutController data={props} changeLayout={changeLayout}/>
                        <QueryController data={props} changeTaxonomy={changeTaxonomy}/>
                    </>)}

                    {/* Settings Tab*/}
                    {tab.name === "settings" && (<>

                        <TitleSettings data={props}/>

                    </>)}

                    {/* Style Tab*/}
                    {tab.name === "styles" && (<>
                        <TitleStyle data={props}/>
                    </>)}
                </div>)}
            </TabPanel>
        </div>
    </InspectorControls>)
}

export default Inspector;