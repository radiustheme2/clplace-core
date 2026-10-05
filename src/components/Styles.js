const {__} = wp.i18n;
import './scss/styles.scss'
import cogoToast from "cogo-toast";

function Styles(props) {

    const {label, value, options, columns = 3, onChange} = props

    return (
        <div className="rttpg-control-field rttpg-cf-styles-wrap">

            {label && (
                <div className="rttpg-cf-head">
                    <span className="rttpg-label">{label}</span>
                </div>
            )}
            <div className={`rttpg-style-list rttpg-style-columns-${columns}`}>
                {options.map((data, index) => (
                    <div
                        role="button"
                        tabindex={index} aria-label={data.label ? data.label : ''}
                        onClick={() => {
                            (! rtParams.hasPro && data.isPro) ?
                                cogoToast.warn('Please install "The Post Grid Pro" for this layout!',{ position: 'top-right' })
                                :
                            onChange(data.value)
                        }}
                        className={`${value == data.value ? 'rttpg-active' : ''} ${(! rtParams.hasPro && data.isPro) ? 'is-pro' : ''}`}
                    >
                        {data.icon && <span className="rttpg-layout rttpg-style-icon">{data.icon}</span>}
                        {data.label && <span className="rttpg-label">{data.label}</span>}
                        {(! rtParams.hasPro && data.isPro) && <span className={`pro-lable`}>{__('Pro','clplace-core')}</span>}
                    </div>
                ))}

            </div>
        </div>
    )

}




export default Styles