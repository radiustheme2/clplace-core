const {__} = wp.i18n;
import {__experimentalHeading as Heading, Button, ButtonGroup, PanelBody, SelectControl} from "@wordpress/components";
import {NORMAL_HOVER} from "../../components/Constants";
import Typography from "../../components/Typography";
import Color from "../../components/Color";
import Dimension from "../../components/Dimension";
import RangeDevice from "../../components/RangeDevice";
import Alignment from "../../components/Alignment";

function FrontEndFilterStyle(props) {
    const {attributes, setAttributes} = props.data;

    //All attribute
    const {
        front_filter_typography,
        filter_type,
        filter_btn_style,
        filter_text_alignment,
        filter_button_width,
        filter_next_prev_btn,
        section_title_style,
        border_style,
        filter_h_alignment,
        filter_btn_radius,
        frontend_filter_style_tabs,
        filter_color,
        filter_bg_color,
        filter_border_color,
        filter_search_bg,
        sub_menu_color_heading,
        sub_menu_bg_color,
        sub_menu_color,
        sub_menu_border_bottom,
        filter_nav_color,
        filter_nav_bg,
        filter_nav_border,
        filter_color_hover,
        filter_bg_color_hover,
        filter_border_color_hover,
        filter_search_bg_hover,
        sub_menu_color_heading_hover,
        sub_menu_bg_color_hover,
        sub_menu_color_hover,
        sub_menu_border_bottom_hover,
        filter_nav_color_hover,
        filter_nav_bg_hover,
        filter_nav_border_hover,
        show_taxonomy_filter,
        show_author_filter,
        show_order_by,
        show_sort_order,
        show_search
    } = attributes;

    if (!(show_taxonomy_filter === 'show' || show_author_filter === 'show' || show_order_by === 'show' || show_sort_order === 'show' || show_search === 'show')) {
        return '';
    }

    return (
        <PanelBody title={__('Front-End Filter', 'clplace-core')} initialOpen={false}>

            <Typography
                label={__('Typography', 'clplace-core')}
                value={front_filter_typography}
                onChange={(val) => setAttributes({front_filter_typography: val})}
            />

            {(filter_type === 'button' && filter_btn_style === 'carousel') &&
                <>

                    <RangeDevice
                        label={__('Filter Width')}
                        responsive={true}
                        value={filter_button_width}
                        min={0}
                        max={1000}
                        step={1}
                        onChange={(val) => setAttributes({filter_button_width: val})}
                    />

                    <SelectControl
                        label={__("Next/Prev Button", "clplace-core")}
                        className="rttpg-control-field label-inline rttpg-expand"
                        options={[
                            {value: 'visible', label: __('Visible', 'clplace-core')}, {
                                value: 'hidden', label: __('Hidden', 'clplace-core')
                            }
                        ]}
                        value={filter_next_prev_btn}
                        onChange={(filter_next_prev_btn) => setAttributes({filter_next_prev_btn})}
                    />

                    {['style2', 'style3'].includes(section_title_style) && <SelectControl
                        label={__("Filter Border", "clplace-core")}
                        className="rttpg-control-field label-inline rttpg-expand"
                        options={[
                            {value: 'disable', label: __('Disable', 'clplace-core')}, {
                                value: 'enable', label: __('Enable', 'clplace-core')
                            }
                        ]}
                        value={border_style}
                        onChange={(border_style) => setAttributes({border_style})}
                    />}
                </>

            }

            {filter_type === 'dropdown' ?
                <SelectControl
                    label={__("Vertical Alignment", "clplace-core")}
                    className="rttpg-control-field label-inline rttpg-expand"
                    options={[
                        {value: '', label: __('Default', 'clplace-core')},
                        {value: 'left', label: __('Left', 'clplace-core')},
                        {value: 'center', label: __('Center', 'clplace-core')},
                        {value: 'right', label: __('Right', 'clplace-core')}
                    ]}
                    value={filter_h_alignment}
                    onChange={(filter_h_alignment) => setAttributes({filter_h_alignment})}
                />
                :
                <SelectControl
                    label={__("Text Align", "clplace-core")}
                    className="rttpg-control-field label-inline rttpg-expand"
                    options={[
                        {value: '', label: __('Default', 'clplace-core')},
                        {value: 'left', label: __('Left', 'clplace-core')},
                        {value: 'center', label: __('Center', 'clplace-core')},
                        {value: 'right', label: __('Right', 'clplace-core')}
                    ]}
                    value={filter_text_alignment}
                    onChange={(filter_text_alignment) => setAttributes({filter_text_alignment})}
                />

            }

            {filter_type !== 'default' &&
                <Dimension
                    label={__("Border Radius", "clplace-core")}
                    type="borderRadius" responsive
                    value={filter_btn_radius}
                    onChange={(value) => {
                        setAttributes({filter_btn_radius: value})
                    }}
                />
            }

            <Heading className="rttpg-control-heading">{__("Appearance & Behavior:", "clplace-core")}</Heading>
            {/*Box Style Tab*/}
            <ButtonGroup className="rttpg-btn-group rttpg-btn-group-state rttpg-bottom-border-radius-none">
                {NORMAL_HOVER.map((item, key) => (
                    <Button
                        key={key}
                        isPrimary={frontend_filter_style_tabs === item.value}
                        isSecondary={frontend_filter_style_tabs !== item.value}
                        onClick={() => setAttributes({frontend_filter_style_tabs: item.value})}
                    >
                        {item.label}
                    </Button>
                ))}
            </ButtonGroup>

            {frontend_filter_style_tabs === 'normal' ?
                <div className="rttpg-ground-control">
                    <Color
                        label={__('Filter Color', 'clplace-core')}
                        color={filter_color}
                        onChange={(filter_color) => setAttributes({filter_color})}
                    />
                    <Color
                        label={__('Filter Background', 'clplace-core')}
                        color={filter_bg_color}
                        onChange={(filter_bg_color) => setAttributes({filter_bg_color})}
                    />
                    <Color
                        label={__('Filter Border Color', 'clplace-core')}
                        color={filter_border_color}
                        onChange={(filter_border_color) => setAttributes({filter_border_color})}
                    />
                    {(show_search === 'show' && filter_btn_style === 'default') && <Color
                        label={__('Search Background', 'clplace-core')}
                        color={filter_search_bg}
                        onChange={(filter_search_bg) => setAttributes({filter_search_bg})}
                    />
                    }

                    {(filter_type === 'dropdown') &&
                        <>
                            <Color
                                label={__('Sub Menu Options', 'clplace-core')}
                                color={sub_menu_color_heading}
                                onChange={(sub_menu_color_heading) => setAttributes({sub_menu_color_heading})}
                            />
                            <Color
                                label={__('Submenu Background', 'clplace-core')}
                                color={sub_menu_bg_color}
                                onChange={(sub_menu_bg_color) => setAttributes({sub_menu_bg_color})}
                            />
                            <Color
                                label={__('Submenu Color', 'clplace-core')}
                                color={sub_menu_color}
                                onChange={(sub_menu_color) => setAttributes({sub_menu_color})}
                            />
                            <Color
                                label={__('Submenu Border', 'clplace-core')}
                                color={sub_menu_border_bottom}
                                onChange={(sub_menu_border_bottom) => setAttributes({sub_menu_border_bottom})}
                            />
                        </>
                    }

                    {(filter_next_prev_btn === 'visible' && filter_btn_style === 'carousel') &&
                        <>
                            <Color
                                label={__('Filter Nav Color', 'clplace-core')}
                                color={filter_nav_color}
                                onChange={(filter_nav_color) => setAttributes({filter_nav_color})}
                            />
                            <Color
                                label={__('Filter Nav Background', 'clplace-core')}
                                color={filter_nav_bg}
                                onChange={(filter_nav_bg) => setAttributes({filter_nav_bg})}
                            />
                            <Color
                                label={__('Filter Nav Border', 'clplace-core')}
                                color={filter_nav_border}
                                onChange={(filter_nav_border) => setAttributes({filter_nav_border})}
                            />
                        </>
                    }
                </div>
                :
                <div className="rttpg-ground-control">
                    <Color
                        label={__('Filter Color - Hover/Active', 'clplace-core')}
                        color={filter_color_hover}
                        onChange={(filter_color_hover) => setAttributes({filter_color_hover})}
                    />
                    <Color
                        label={__('Filter Background - Hover/Active', 'clplace-core')}
                        color={filter_bg_color_hover}
                        onChange={(filter_bg_color_hover) => setAttributes({filter_bg_color_hover})}
                    />
                    <Color
                        label={__('Filter Border Color - Hover/Active', 'clplace-core')}
                        color={filter_border_color_hover}
                        onChange={(filter_border_color_hover) => setAttributes({filter_border_color_hover})}
                    />
                    {(show_search === 'show' && filter_btn_style === 'default') &&
                        <Color
                            label={__('Search Background - Hover/Active', 'clplace-core')}
                            color={filter_search_bg_hover}
                            onChange={(filter_search_bg_hover) => setAttributes({filter_search_bg_hover})}
                        />
                    }

                    {(filter_type === 'dropdown') &&
                        <>
                            <Color
                                label={__('Sub Menu Options - Hover', 'clplace-core')}
                                color={sub_menu_color_heading_hover}
                                onChange={(sub_menu_color_heading_hover) => setAttributes({sub_menu_color_heading_hover})}
                            />
                            <Color
                                label={__('Submenu Background - Hover', 'clplace-core')}
                                color={sub_menu_bg_color_hover}
                                onChange={(sub_menu_bg_color_hover) => setAttributes({sub_menu_bg_color_hover})}
                            />
                            <Color
                                label={__('Submenu Color - Hover', 'clplace-core')}
                                color={sub_menu_color_hover}
                                onChange={(sub_menu_color_hover) => setAttributes({sub_menu_color_hover})}
                            />
                            <Color
                                label={__('Submenu Border - Hover', 'clplace-core')}
                                color={sub_menu_border_bottom_hover}
                                onChange={(sub_menu_border_bottom_hover) => setAttributes({sub_menu_border_bottom_hover})}
                            />
                        </>
                    }

                    {(filter_next_prev_btn === 'visible' && filter_btn_style === 'carousel') &&
                        <>
                            <Color
                                label={__('Filter Nav Color - Hover', 'clplace-core')}
                                color={filter_nav_color_hover}
                                onChange={(filter_nav_color_hover) => setAttributes({filter_nav_color_hover})}
                            />
                            <Color
                                label={__('Filter Nav Background - Hover', 'clplace-core')}
                                color={filter_nav_bg_hover}
                                onChange={(filter_nav_bg_hover) => setAttributes({filter_nav_bg_hover})}
                            />
                            <Color
                                label={__('Filter Nav Border - Hover', 'clplace-core')}
                                color={filter_nav_border_hover}
                                onChange={(filter_nav_border_hover) => setAttributes({filter_nav_border_hover})}
                            />
                        </>
                    }
                </div>

            }

        </PanelBody>
    );
}

export default FrontEndFilterStyle;
