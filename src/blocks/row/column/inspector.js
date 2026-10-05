/* global wp */
import {
	Button, ButtonGroup, PanelBody, SelectControl, TabPanel, ToggleControl
} from "@wordpress/components";

import {
	NORMAL_HOVER, BORDER_STYLES
} from "../../../components/Constants";

import Dimension from "../../../components/Dimension";
import Background from "../../../components/Background";
import Color from "../../../components/Color";
import Range from "../../../components/Range";
import BoxShadow from "../../../components/BoxShadow";
import RangeDevice from "../../../components/RangeDevice";
import Animation from "../../../components/Animation";

const { __ } = wp.i18n;
const { InspectorControls } = wp.blockEditor;

function Inspector(props) {
	const { attributes, setAttributes } = props;

	const {
		colWidth,
		mainWrapAnimation,

		//advance
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
									<PanelBody title={__('Column Settings', 'clplace-core')} initialOpen={true}>
										<RangeDevice
											label={__('Column Width')}
											responsive={true}
											value={colWidth}
											units={['%']}
											min={.001}
											max={100}
											step={.001}
											onChange={(val) => setAttributes({ colWidth: val })}
										/>
									</PanelBody>
								</>
							)}
							{tab.name === "advance" && (
								<>
									<PanelBody title={__('Warpper Margin & Padding', 'clplace-core')} initialOpen={true}>

										<Dimension onChange={(value) => {
											setAttributes({ mainWrapMargin: value })
										}} label="Margin" type="margin" responsive value={mainWrapMargin} />

										<Dimension onChange={(value) => {
											setAttributes({ mainWrapPadding: value })
										}} label="Padding" type="padding" responsive value={mainWrapPadding} />

									</PanelBody>

									<PanelBody title={__('Background', 'clplace-core')} initialOpen={false}>

										<ButtonGroup className="rttpg-btn-group rttpg-btn-group-state">
											{NORMAL_HOVER.map((item, key) => (
												<Button
													key={key}
													variant={mainWrapBGType === item.value ? 'primary' : 'secondary'}
													onClick={() => setAttributes({ mainWrapBGType: item.value })}
												>
													{item.label}
												</Button>
											))}
										</ButtonGroup>

										{mainWrapBGType === "normal" && (
											<Background label={"Background"} value={mainWrapBG} onChange={val => setAttributes({ mainWrapBG: val })} />

										)}
										{mainWrapBGType === "hover" && (
											<>
												<Background label={"Background"} value={mainWrapHoverBG} onChange={val => setAttributes({ mainWrapHoverBG: val })} />
												<Range
													label={__("Background Transition")}
													reset={true}
													value={mainWrapHoverBGTransition}
													onChange={(val) => setAttributes({ mainWrapHoverBGTransition: val })}
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
												setAttributes({ mainWrapBGOverlayEnable })
											}
										/>

										{mainWrapBGOverlayEnable && (
											<>
												<Background label={"Background"} value={mainWrapBGOverlay} onChange={val => setAttributes({ mainWrapBGOverlay: val })} />
												<Range
													label={__("Opacity", "clplace-core")}
													reset={true}
													value={mainWrapBGOverlayOpacity}
													onChange={(val) => setAttributes({ mainWrapBGOverlayOpacity: val })}
													min={0}
													max={1}
													step={0.01}
												/>

												<Range
													label={__("Z-Index", "clplace-core")}
													reset={true}
													value={mainWrapBGOverlayZindex}
													onChange={(val) => setAttributes({ mainWrapBGOverlayZindex: val })}
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
													onClick={() => setAttributes({ mainWrapBorderType: item.value })}
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
															setAttributes({ mainWrapBorderWidth: value })
														}} label="Border Width" type="border" responsive value={mainWrapBorderWidth} />
													</>
												)}

												<Dimension onChange={(value) => {
													setAttributes({ mainWrapRadius: value })
												}} label="Border Radius" type="borderRadius" responsive value={mainWrapRadius} />

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
															setAttributes({ mainWrapHoverBorderWidth: value })
														}} label="Border Width" type="border" responsive value={mainWrapHoverBorderWidth} />
													</>
												)}

												<Dimension onChange={(value) => {
													setAttributes({ mainWrapHoverRadius: value })
												}} label="Border Radius" type="borderRadius" responsive value={mainWrapHoverRadius} />

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
											<BoxShadow value={mainWrapShadow} onChange={val => setAttributes({ mainWrapShadow: val })} />
										)}

										{mainWrapShadowType === "hover" && (
											<BoxShadow value={mainWrapHoverShadow} onChange={val => setAttributes({ mainWrapHoverShadow: val })} />
										)}
									</PanelBody>

									<PanelBody title={__('Show/Hide Condition', 'clplace-core')} initialOpen={false}>
										<ToggleControl
											label={__("Hide on desktop", "clplace-core")}
											className="rttpg-control-field"
											checked={mainWrapShowHide['lg']}
											onChange={(val) =>
												setAttributes({ mainWrapShowHide: { ...mainWrapShowHide, lg: val } })
											}
										/>
										<ToggleControl
											label={__("Hide on Tablet", "clplace-core")}
											className="rttpg-control-field"
											checked={mainWrapShowHide['md']}
											onChange={(val) =>
												setAttributes({ mainWrapShowHide: { ...mainWrapShowHide, md: val } })
											}
										/>
										<ToggleControl
											label={__("Hide on Mobile", "clplace-core")}
											className="rttpg-control-field"
											checked={mainWrapShowHide['sm']}
											onChange={(val) =>
												setAttributes({ mainWrapShowHide: { ...mainWrapShowHide, sm: val } })
											}
										/>
									</PanelBody>

									<PanelBody title={__('Animation', 'clplace-core')} initialOpen={false}>
										<Animation value={mainWrapAnimation} onChange={val => setAttributes({ mainWrapAnimation: val })} />
									</PanelBody>
								</>
							)}
						</div>
					)}
				</TabPanel>

			</div >
		</InspectorControls >
	)
}

export default Inspector;