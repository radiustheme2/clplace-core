import {CLPLACE_IS_PRO} from "../../components/Constants";

const {__} = wp.i18n;
import {PanelBody} from "@wordpress/components";

function PromotionalMessage2() {

    if (CLPLACE_IS_PRO === 'rttpg-has-pro') {
        return '';
    }

    return (
        <div className={`rttpg-slider-layout-promotions`}>
            <h4>{__('Please upgrade to pro for slider layout!\n', 'clplace-core')}</h4>
            <div className="rttpg-pro-message"><span className="pro-feature"> Get the <a
                href="//www.radiustheme.com/downloads/clplace-pro-for-wordpress/"
                target="_blank">Pro version</a> for more stunning layouts and customization options.</span>
            </div>
            <a className="rttpg-button-go-pro"
               href="//www.radiustheme.com/downloads/clplace-pro-for-wordpress/" target="_blank">Get Pro</a>
        </div>

    );
}

export default PromotionalMessage2;
