import {CLPLACE_IS_PRO} from "../../components/Constants";

const {__} = wp.i18n;
import {PanelBody} from "@wordpress/components";

function PromotionalMessage() {

    if (CLPLACE_IS_PRO === 'rttpg-has-pro') {
        return '';
    }

    return (
        <PanelBody className={`rttpg-go-to-premium-panel`} title={__('Go Premium for More Features', 'clplace-core')}
                   initialOpen={true}>
            <div className={`rttpg-get-pro-message-wrapper`}>
                <h4>{__('Unlock more possibilities', 'clplace-core')}</h4>
                <div className="rttpg-pro-message"><span className="pro-feature"> Get the <a
                    href="//www.radiustheme.com/downloads/clplace-pro-for-wordpress/"
                    target="_blank">Pro version</a> for more stunning layouts and customization options.</span>
                </div>
                <a className="rttpg-button-go-pro"
                   href="//www.radiustheme.com/downloads/clplace-pro-for-wordpress/" target="_blank">Get Pro</a>
            </div>
        </PanelBody>
    );
}

export default PromotionalMessage;
