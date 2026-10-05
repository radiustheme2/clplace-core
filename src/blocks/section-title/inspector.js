const {InspectorControls} = wp.blockEditor;
import {TabPanel} from "@wordpress/components";
import SectionTitleSettings from "../controller/SectionTitleSettings";
import SectionTitleStyle from "../controller/SectionTitleStyle";

function Inspector(props) {
    
    return (
        <InspectorControls key="controls">
            <div className="rttpg-panel-control-wrapper">
                <TabPanel className="rttpg-tab-panel" activeClass="active-tab" tabs={[
                    {name: "content", title: "Content", className: "rttpg-tab-btn content"},
                    {name: "styles", title: "Styles", className: "rttpg-tab-btn styles"}
                ]}
                >
                    {(tab) => (
                        <div className="rttpg-tab-content">

                            {/* Content Tab*/}
                            {tab.name === "content" && (
                                <>
                                    <SectionTitleSettings data={props} open={true}/>
                                </>
                            )}


                            {/* Style Tab*/}
                            {tab.name === "styles" && (
                                <>
                                    <SectionTitleStyle data={props}/>
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