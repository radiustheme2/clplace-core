import TPGColumn from "../../components/TPGColumn";
import {__experimentalHeading as Heading} from '@wordpress/components';
import {SelectControl, PanelBody} from "@wordpress/components";
import RangeDevice from "../../components/RangeDevice";

const {__} = wp.i18n;
import {
    GRID_LAYOUT_OPT,
} from "../../components/Constants";
import Color from "../../components/Color";

function LayoutController(props) {
    const {attributes, setAttributes, changeQuery} = props.data;
    //All attribute
    const {
        card_bg,
        ignore_sticky_posts,
    } = attributes;


    let layoutOptions = GRID_LAYOUT_OPT;


    return (
        <PanelBody title={__('Layout', 'clplace-core')} initialOpen={true}>
            {/*<Layouts
                value={attributes[postLayout]}
                onChange={val => props.changeLayout(val)}
                options={layoutOptions}
            />*/}

            <Color
                label={__('Title Background', 'clplace-core')}
                color={card_bg}
                onChange={(card_bg) => setAttributes({card_bg})}
            />

            <Heading className="rttpg-control-heading">{__("Layout Options:", "clplace-core")}</Heading>

        </PanelBody>
    );
}

export default LayoutController;
