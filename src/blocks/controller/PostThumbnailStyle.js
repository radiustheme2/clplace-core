import cogoToast from "cogo-toast";

const {__} = wp.i18n;
import { __experimentalHeading as Heading} from '@wordpress/components';
import {Button, ButtonGroup, PanelBody, SelectControl} from "@wordpress/components";
import {NORMAL_HOVER, OVERLAY_TYPE, OVERLAY_TYPE_TWO, CLPLACE_IS_PRO} from "../../components/Constants";
import Color from "../../components/Color";
import Dimension from "../../components/Dimension";
import Background from "../../components/Background";
import Range from "../../components/Range";

function PostThumbnailStyle(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        prefix,
        img_border_radius,
        image_width,
        thumbnail_spacing,
        thumbnail_overlay_padding,
        grid_hover_style_tabs,
        grid_hover_overlay_color,
        is_thumb_lightbox,
        thumb_lightbox_bg,
        thumb_lightbox_color,
        grid_hover_overlay_color_hover,
        thumb_lightbox_bg_hover,
        thumb_lightbox_color_hover,
        grid_hover_overlay_type,
        grid_hover_overlay_height,
        on_hover_overlay,
        thumbnail_position,
        thumbnail_position_hover,
        show_thumb,
        thumbnail_transition_duration,
        thumbnail_opacity,
        thumbnail_opacity_hover
    } = attributes;

    if (show_thumb !== 'show') {
        return '';
    }

    let postLayout = prefix + "_layout";

    return (
        <PanelBody title={__('Thumbnail', 'clplace-core')} initialOpen={false}>

            <SelectControl
                label={__("Image Width (Optional)", "clplace-core")}
                className="rttpg-control-field label-inline rttpg-expand"
                options={[
                    {value: 'inherit', label: __('Default', 'clplace-core')},
                    {value: '100%', label: __('100%', 'clplace-core')},
                    {value: 'auto', label: __('Auto', 'clplace-core')}
                ]}
                value={image_width}
                onChange={(image_width) => setAttributes({image_width})}
            />

            <div className="rttpg-arert-wrapper">
                <Dimension
                    label={__("Border Radius", "clplace-core")}
                    className={`rttpg-dimension-wrap ${CLPLACE_IS_PRO}`}
                    type="borderRadius" responsive
                    value={img_border_radius}
                    onChange={(value) => {
                        setAttributes({img_border_radius: value})
                    }}
                />
                {CLPLACE_IS_PRO === 'rttpg-is-pro' &&
                    <div className={`rttpg-alert-message`} onClick={() => {
                        cogoToast.warn('Please upgrade to pro for this feature.', {position: 'top-right'});
                    }}></div>}
            </div>

            <Dimension
                label={__("Thumbnail Margin", "clplace-core")}
                type="margin" responsive
                value={thumbnail_spacing}
                onChange={(value) => {
                    setAttributes({thumbnail_spacing: value})
                }}
            />

            {prefix === 'grid_hover' &&
                <Dimension
                    label={__("Overlay Content Padding", "clplace-core")}
                    type="padding" responsive
                    value={thumbnail_overlay_padding}
                    onChange={(value) => {
                        setAttributes({thumbnail_overlay_padding: value})
                    }}
                />
            }

            <Heading className="rttpg-control-heading">{__("Overlay Style:", "clplace-core")}</Heading>

            <ButtonGroup className="rttpg-btn-group rttpg-btn-group-state rttpg-bottom-border-radius-none">
                {NORMAL_HOVER.map((item, key) => (
                    <Button
                        key={key}
                        isPrimary={grid_hover_style_tabs === item.value}
                        isSecondary={grid_hover_style_tabs !== item.value}
                        onClick={() => setAttributes({grid_hover_style_tabs: item.value})}
                    >
                        {item.label}
                    </Button>))}
            </ButtonGroup>

            {grid_hover_style_tabs === 'normal' ?
                <div className="rttpg-ground-control">
                    <Background
                        label={__("Overlay BG", "clplace-core")}
                        image={false}
                        value={grid_hover_overlay_color}
                        onChange={val => setAttributes({grid_hover_overlay_color: val})}/>

                    {is_thumb_lightbox === 'show' && <>
                        <Color
                            label={__('Light Box Background', 'clplace-core')}
                            color={thumb_lightbox_bg}
                            onChange={(thumb_lightbox_bg) => setAttributes({thumb_lightbox_bg})}
                        />
                        <Color
                            label={__('Light Box Color', 'clplace-core')}
                            color={thumb_lightbox_color}
                            onChange={(thumb_lightbox_color) => setAttributes({thumb_lightbox_color})}
                        />
                    </>
                    }
                    <SelectControl
                        label={__("Thumb Position", "clplace-core")}
                        className="rttpg-control-field label-inline"
                        options={[
                            {value: '', label: __('Center Center', 'clplace-core')},
                            {value: 'top center', label: __('Top Center', 'clplace-core')},
                            {value: 'bottom center', label: __('Bottom Center', 'clplace-core')},
                            {value: 'center left', label: __('Left Center', 'clplace-core')},
                            {value: 'center right', label: __('Right Center', 'clplace-core')},
                        ]}
                        value={thumbnail_position}
                        onChange={(thumbnail_position) => {
                            setAttributes({thumbnail_position})
                        }}
                    />
                    <Range
                        label={__("Thumbnail Opacity")}
                        value={thumbnail_opacity}
                        onChange={(val) => setAttributes({thumbnail_opacity: val})}
                        min={0}
                        max={1}
                        step={.01}
                    />

                </div>
                :
                <div className="rttpg-ground-control">
                    <Background
                        label={__("Overlay BG - Hover", "clplace-core")}
                        image={false}
                        value={grid_hover_overlay_color_hover}
                        onChange={val => setAttributes({grid_hover_overlay_color_hover: val})}/>

                    {is_thumb_lightbox === 'show' && <>
                        <Color
                            label={__('Light Box Background - Hover', 'clplace-core')}
                            color={thumb_lightbox_bg_hover}
                            onChange={(thumb_lightbox_bg_hover) => setAttributes({thumb_lightbox_bg_hover})}
                        />
                        <Color
                            label={__('Light Box Color - Hover', 'clplace-core')}
                            color={thumb_lightbox_color_hover}
                            onChange={(thumb_lightbox_color_hover) => setAttributes({thumb_lightbox_color_hover})}
                        />
                    </>
                    }
                    <SelectControl
                        label={__("Thumb Position - Hover", "clplace-core")}
                        className="rttpg-control-field label-inline"
                        options={[
                            {value: '', label: __('Center Center', 'clplace-core')},
                            {value: 'top center', label: __('Top Center', 'clplace-core')},
                            {value: 'bottom center', label: __('Bottom Center', 'clplace-core')},
                            {value: 'center left', label: __('Left Center', 'clplace-core')},
                            {value: 'center right', label: __('Right Center', 'clplace-core')},
                        ]}
                        value={thumbnail_position_hover}
                        onChange={(thumbnail_position_hover) => {
                            setAttributes({thumbnail_position_hover})
                        }}
                    />
                    <Range
                        label={__("Thumbnail Opacity")}
                        value={thumbnail_opacity_hover}
                        onChange={(val) => setAttributes({thumbnail_opacity_hover: val})}
                        min={0}
                        max={1}
                        step={.01}
                    />
                </div>
            }

            <hr/>

            <Range
                label={__('Thumbnail Transition Duration')}
                value={thumbnail_transition_duration}
                min={0.1}
                max={10}
                step={0.1}
                onChange={(val) => setAttributes({thumbnail_transition_duration: val})}
            />

            <SelectControl
                label={__('Overlay Interaction', 'clplace-core')}
                className="rttpg-control-field label-inline rttpg-expand"
                help={__("If you don't choose overlay background then it will work only for some selected layout", "clplace-core")}
                value={grid_hover_overlay_type}
                options={(['grid_hover', 'slider'].includes(prefix)) ? OVERLAY_TYPE_TWO : OVERLAY_TYPE}
                onChange={(grid_hover_overlay_type) => setAttributes({grid_hover_overlay_type})}
            />

            {(attributes[postLayout] !== 'grid_hover-layout3') &&
                <>
                    <SelectControl
                        label={__("Overlay Height", "clplace-core")}
                        className="rttpg-control-field label-inline rttpg-expand"
                        options={[
                            {value: 'default', label: __('Default', 'clplace-core')},
                            {value: 'full', label: __('100%', 'clplace-core')},
                            {value: 'auto', label: __('Auto', 'clplace-core')}
                        ]}
                        value={grid_hover_overlay_height}
                        onChange={(grid_hover_overlay_height) => setAttributes({grid_hover_overlay_height})}
                    />


                    <SelectControl
                        label={__("Overlay Height on hover", "clplace-core")}
                        className="rttpg-control-field label-inline rttpg-expand"
                        options={[
                            {value: 'default', label: __('Default', 'clplace-core')},
                            {value: 'full', label: __('100%', 'clplace-core')},
                            {value: 'auto', label: __('Auto', 'clplace-core')}
                        ]}
                        value={on_hover_overlay}
                        onChange={(on_hover_overlay) => setAttributes({on_hover_overlay})}
                    />
                </>
            }

        </PanelBody>
    );
}

export default PostThumbnailStyle;
