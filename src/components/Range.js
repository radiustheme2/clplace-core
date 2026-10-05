const { RangeControl, Button } = wp.components;

import './scss/rangeDevice.scss'

function Range( props ) {
    const { label, value: data, onChange, min, max, step, reset } = props;
    const dataAttributes = { min, max, step };

    const setSettings = ( val ) => {
        onChange( val );
    };

    return (
        <div className="rttpg-control-field rttpg-cf-range-wrap">
            { label && (
                <div className="rttpg-cf-head">
                    <span className="rttpg-label">{ label }</span>
                </div>
            ) }
            <div className="rttpg-cf-body">
                <RangeControl
                    value={ data }
                    onChange={ ( val ) => {
                        setSettings( val )
                    } }
                    { ...dataAttributes }
                />

                { (reset && data) ? <Button
                    isSmall
                    className="rttpg-undo-btn"
                    icon="image-rotate"
                    onClick={ () => onChange( null ) }
                ></Button> : ''
                }
            </div>
        </div>
    );
}

export default Range;
