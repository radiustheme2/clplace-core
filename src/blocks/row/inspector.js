/* global wp */
import {
    BaseControl, Button, ButtonGroup, PanelBody, SelectControl, TabPanel, ToggleControl
} from "@wordpress/components";

import {
    NORMAL_HOVER, BORDER_STYLES
} from "../../components/Constants";

import {Icon} from '@wordpress/components';
import renderControlIcons from '../../components/icon/renderControlIcons'
import IconControl from "../../components/IconControl";

import Dimension from "../../components/Dimension";
import Background from "../../components/Background";
import Color from "../../components/Color";
import Range from "../../components/Range";
import RangeDevice from "../../components/RangeDevice";
import BoxShadow from "../../components/BoxShadow";

const {__} = wp.i18n;
const {InspectorControls} = wp.blockEditor;

function Inspector(props) {
    const {attributes, setAttributes} = props;

    const {
        gutterX,
        gutterY,
        columns,
        innerContainerWidth,
        alignItem,
        justifyContent,

        //advance
        rowMarginTop,
        rowMarginBottom,
        mainWrapMargin,
        mainWrapPadding,
        mainWrapBG,
        mainWrapHoverBG,
        mainWrapHoverBGTransition,
        mainWrapBGType,
        mainWrapBorderType,
        mainWrapBorderStyle,
        mainWrapBorderColor,
        mainWrapBorderWidth,
        mainWrapRadius,
        mainWrapHoverBorderStyle,
        mainWrapHoverBorderColor,
        mainWrapHoverBorderWidth,
        mainWrapHoverRadius,
        mainWrapShadowType,
        mainWrapShadow,
        mainWrapHoverShadow,
        mainWrapBGOverlayEnable,
        mainWrapBGOverlay,
        mainWrapBGOverlayOpacity,
        mainWrapBGOverlayZindex,
        mainWrapShowHide,
    } = attributes;

    const alignItemsOptions = [
        {
            value: 'flex-start',
            label: __('Flex Start', 'clplace-core'),
            icon: (<Icon icon={renderControlIcons(`flex-ai-row-start`)}/>),
        },
        {
            value: 'center',
            label: __('Center', 'clplace-core'),
            icon: (<Icon icon={renderControlIcons(`flex-ai-row-center`)}/>),
        },
        {
            value: 'flex-end',
            label: __('Flex End', 'clplace-core'),
            icon: (<Icon icon={renderControlIcons(`flex-ai-row-end`)}/>),
        },
        {
            value: 'stretch',
            label: __('Stretch', 'clplace-core'),
            icon: (<Icon icon={renderControlIcons(`flex-ai-row-strech`)}/>),
        },
    ];

    const justifyContentOptions = [
        {
            value: 'flex-start',
            label: __('Flex Start', 'clplace-core'),
            icon: (<Icon icon={renderControlIcons(`flex-jc-row-start`)}/>),
        },
        {
            value: 'center',
            label: __('Center', 'clplace-core'),
            icon: (<Icon icon={renderControlIcons(`flex-jc-row-center`)}/>),
        },
        {
            value: 'flex-end',
            label: __('Flex End', 'clplace-core'),
            icon: (<Icon icon={renderControlIcons(`flex-jc-row-end`)}/>),
        },
        {
            value: 'space-between',
            label: __('Space Between', 'clplace-core'),
            icon: (<Icon icon={renderControlIcons(`flex-jc-row-space-between`)}/>),
        },
        {
            value: 'space-around',
            label: __('Space Around', 'clplace-core'),
            icon: (<Icon icon={renderControlIcons(`flex-jc-row-space-around`)}/>),
        },
        {
            value: 'space-evenly',
            label: __('Space Evenly', 'clplace-core'),
            icon: (<Icon icon={renderControlIcons(`flex-jc-row-space-evenly`)}/>),
        },
    ];


    return (
        <InspectorControls key="controls">
            <div className="rttpg-panel-control-wrapper">
                <TabPanel
                    className="rttpg-tab-panel"
                    activeClass="active-tab"
                    tabs={[
                        {
                            name: "general",
                            title: "General",
                            className: "rttpg-tab-btn general",
                        },
                        {
                            name: "advance",
                            title: "Advanced",
                            className: "rttpg-tab-btn advance",
                        },
                    ]}
                >

                    {(tab) => (

                        <div className="rttpg-tab-content">
                            {tab.name === "general" && (
                                <>
                                    <PanelBody title={__('Row Settings', 'clplace-core')} initialOpen={true}>

                                        <RangeDevice
                                            label={__('Max Width (px)')}
                                            responsive={true}
                                            value={innerContainerWidth}
                                            defultValue={{lg: 1200, md: 984, sm: 564, unit: 'px'}}
                                            // units={['px', '%',]}
                                            min={0}
                                            max={2000}
                                            step={1}
                                            onChange={(val) => setAttributes({innerContainerWidth: val})}
                                        />

                                        <Range
                                            label={__('Column')}
                                            reset={true}
                                            //defultValue={1}
                                            value={columns}
                                            min={0}
                                            max={6}
                                            step={1}
                                            onChange={(val) => setAttributes({columns: val})}
                                        />

                                        <RangeDevice
                                            label={__('Columns Gap')}
                                            responsive={true}
                                            value={gutterX}
                                            min={0}
                                            max={100}
                                            step={1}
                                            onChange={(val) => setAttributes({gutterX: val})}
                                        />


                                        <div className="rttpg-custom-alignment">
                                            <IconControl
                                                label={__("Align Items", "clplace-core")}
                                                value={alignItem}
                                                responsive={true}
                                                options={alignItemsOptions}
                                                onChange={val => setAttributes({alignItem: val})}
                                            />

                                            <IconControl
                                                label={__("Justify Content", "clplace-core")}
                                                value={justifyContent}
                                                responsive={true}
                                                options={justifyContentOptions}
                                                onChange={val => setAttributes({justifyContent: val})}
                                            />
                                        </div>

                                    </PanelBody>
                                </>
                            )}
                            {tab.name === "advance" && (
                                <>
                                    <PanelBody title={__('Warpper Margin & Padding', 'clplace-core')}
                                               initialOpen={true}>

                                        <RangeDevice
                                            label={__('Margin Top')}
                                            responsive={true}
                                            value={rowMarginTop}
                                            min={0}
                                            max={500}
                                            step={1}
                                            onChange={(val) => setAttributes({rowMarginTop: val})}
                                        />
                                        <RangeDevice
                                            label={__('Margin Bottom')}
                                            responsive={true}
                                            value={rowMarginBottom}
                                            min={0}
                                            max={500}
                                            step={1}
                                            onChange={(val) => setAttributes({rowMarginBottom: val})}
                                        />

                                        <Dimension onChange={(value) => {
                                            setAttributes({mainWrapPadding: value})
                                        }} label="Padding" type="padding" responsive value={mainWrapPadding}/>

                                    </PanelBody>

                                    <PanelBody title={__('Background', 'clplace-core')} initialOpen={false}>

                                        <ButtonGroup className="rttpg-btn-group rttpg-btn-group-state">
                                            {NORMAL_HOVER.map((item, key) => (
                                                <Button
                                                    key={key}
                                                    variant={mainWrapBGType === item.value ? 'primary' : 'secondary'}
                                                    onClick={() => setAttributes({mainWrapBGType: item.value})}
                                                >
                                                    {item.label}
                                                </Button>
                                            ))}
                                        </ButtonGroup>

                                        {mainWrapBGType === "normal" && (
                                            <Background label={"Background"} value={mainWrapBG}
                                                        onChange={val => setAttributes({mainWrapBG: val})}/>

                                        )}
                                        {mainWrapBGType === "hover" && (
                                            <>
                                                <Background label={"Background"} value={mainWrapHoverBG}
                                                            onChange={val => setAttributes({mainWrapHoverBG: val})}/>
                                                <Range
                                                    label={__("Background Transition")}
                                                    reset={true}
                                                    value={mainWrapHoverBGTransition}
                                                    onChange={(val) => setAttributes({mainWrapHoverBGTransition: val})}
                                                    min={0}
                                                    max={5}
                                                    step={0.1}
                                                />
                                            </>
                                        )}

                                        <ToggleControl
                                            label={__("Enable Overlay", "clplace-core")}
                                            checked={mainWrapBGOverlayEnable}
                                            onChange={(mainWrapBGOverlayEnable) =>
                                                setAttributes({mainWrapBGOverlayEnable})
                                            }
                                        />

                                        {mainWrapBGOverlayEnable && (
                                            <>
                                                <Background label={"Background"} value={mainWrapBGOverlay}
                                                            onChange={val => setAttributes({mainWrapBGOverlay: val})}/>
                                                <Range
                                                    label={__("Opacity", "clplace-core")}
                                                    reset={true}
                                                    value={mainWrapBGOverlayOpacity}
                                                    onChange={(val) => setAttributes({mainWrapBGOverlayOpacity: val})}
                                                    min={0}
                                                    max={1}
                                                    step={0.01}
                                                />

                                                <Range
                                                    label={__("Z-Index", "clplace-core")}
                                                    reset={true}
                                                    value={mainWrapBGOverlayZindex}
                                                    onChange={(val) => setAttributes({mainWrapBGOverlayZindex: val})}
                                                    min={-10000}
                                                    max={999999}
                                                    step={1}
                                                />

                                            </>
                                        )}


                                    </PanelBody>

                                    <PanelBody title={__('Border', 'clplace-core')} initialOpen={false}>
                                        <ButtonGroup className="rttpg-btn-group rttpg-btn-group-state">
                                            {NORMAL_HOVER.map((item, key) => (
                                                <Button
                                                    key={key}
                                                    variant={mainWrapBorderType === item.value ? 'primary' : 'secondary'}
                                                    onClick={() => setAttributes({mainWrapBorderType: item.value})}
                                                >
                                                    {item.label}
                                                </Button>
                                            ))}
                                        </ButtonGroup>

                                        {mainWrapBorderType === "normal" && (
                                            <>
                                                <SelectControl
                                                    label={__('Border Style', 'clplace-core')}
                                                    value={mainWrapBorderStyle}
                                                    options={BORDER_STYLES}
                                                    onChange={(mainWrapBorderStyle) => setAttributes({
                                                        mainWrapBorderStyle
                                                    })
                                                    }
                                                />

                                                {(mainWrapBorderStyle !== 'none' && mainWrapBorderStyle) && (
                                                    <>
                                                        <Color
                                                            label={__("Border Color")}
                                                            color={mainWrapBorderColor}
                                                            onChange={(mainWrapBorderColor) => setAttributes({
                                                                mainWrapBorderColor
                                                            })
                                                            }
                                                        />
                                                        <Dimension onChange={(value) => {
                                                            setAttributes({mainWrapBorderWidth: value})
                                                        }} label="Border Width" type="border" responsive
                                                                   value={mainWrapBorderWidth}/>
                                                    </>
                                                )}

                                                <Dimension onChange={(value) => {
                                                    setAttributes({mainWrapRadius: value})
                                                }} label="Border Radius" type="borderRadius" responsive
                                                           value={mainWrapRadius}/>

                                            </>
                                        )}

                                        {mainWrapBorderType === "hover" && (
                                            <>
                                                <SelectControl
                                                    label={__('Border Style', 'clplace-core')}
                                                    value={mainWrapHoverBorderStyle}
                                                    options={BORDER_STYLES}
                                                    onChange={(mainWrapHoverBorderStyle) => setAttributes({
                                                        mainWrapHoverBorderStyle
                                                    })
                                                    }
                                                />

                                                {(mainWrapHoverBorderStyle !== 'none' && mainWrapHoverBorderStyle) && (
                                                    <>
                                                        <Color
                                                            label={__("Border Color")}
                                                            color={mainWrapHoverBorderColor}
                                                            onChange={(mainWrapHoverBorderColor) => setAttributes({
                                                                mainWrapHoverBorderColor
                                                            })
                                                            }
                                                        />
                                                        <Dimension onChange={(value) => {
                                                            setAttributes({mainWrapHoverBorderWidth: value})
                                                        }} label="Border Width" type="border" responsive
                                                                   value={mainWrapHoverBorderWidth}/>
                                                    </>
                                                )}

                                                <Dimension onChange={(value) => {
                                                    setAttributes({mainWrapHoverRadius: value})
                                                }} label="Border Radius" type="borderRadius" responsive
                                                           value={mainWrapHoverRadius}/>

                                            </>
                                        )}

                                    </PanelBody>

                                    <PanelBody title={__('Shadow', 'clplace-core')} initialOpen={false}>
                                        <ButtonGroup className="rttpg-btn-group rttpg-btn-group-state">
                                            {NORMAL_HOVER.map((item) => (
                                                <Button
                                                    isLarge
                                                    variant={mainWrapShadowType === item.value ? 'primary' : 'secondary'}
                                                    onClick={() => setAttributes({
                                                        mainWrapShadowType: item.value
                                                    })}
                                                >
                                                    {item.label}
                                                </Button>
                                            ))}
                                        </ButtonGroup>

                                        {mainWrapShadowType === "normal" && (
                                            <BoxShadow value={mainWrapShadow}
                                                       onChange={val => setAttributes({mainWrapShadow: val})}/>
                                        )}

                                        {mainWrapShadowType === "hover" && (
                                            <BoxShadow value={mainWrapHoverShadow}
                                                       onChange={val => setAttributes({mainWrapHoverShadow: val})}/>
                                        )}
                                    </PanelBody>

                                    <PanelBody title={__('Show/Hide Condition', 'clplace-core')} initialOpen={false}>
                                        <ToggleControl
                                            label={__("Hide on desktop", "clplace-core")}
                                            className="rttpg-control-field"
                                            checked={mainWrapShowHide['lg']}
                                            onChange={(val) =>
                                                setAttributes({mainWrapShowHide: {...mainWrapShowHide, lg: val}})
                                            }
                                        />
                                        <ToggleControl
                                            label={__("Hide on Tablet", "clplace-core")}
                                            className="rttpg-control-field"
                                            checked={mainWrapShowHide['md']}
                                            onChange={(val) =>
                                                setAttributes({mainWrapShowHide: {...mainWrapShowHide, md: val}})
                                            }
                                        />
                                        <ToggleControl
                                            label={__("Hide on Mobile", "clplace-core")}
                                            className="rttpg-control-field"
                                            checked={mainWrapShowHide['sm']}
                                            onChange={(val) =>
                                                setAttributes({mainWrapShowHide: {...mainWrapShowHide, sm: val}})
                                            }
                                        />
                                    </PanelBody>

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