const {__} = wp.i18n;
const {useState} = wp.element;
const {RangeControl, Button} = wp.components;
import Devices from "./Devices";

import './scss/rangeDevice.scss'

function RangeDevice(props) {

    const {label, value: data, onChange, responsive, min, max, units, step, defultValue = {}} = props;
    const [device, setDevice] = useState(() => window.rttpgDevice || 'lg');
    const [unit, setUnit] = useState('px');
    const dataAttributes = {min, max, step};
    const dftData = defultValue;

    const updateUnit = (_unit) => {
        const newData = JSON.parse(JSON.stringify(data));
        if (false !== units) {
            newData.unit = _unit;
        }
        onChange(newData);
        setUnit(_unit);
    }

    const setSettings = (val) => {
        const newData = JSON.parse(JSON.stringify(data));
        newData[device] = val
        if (false !== units) {
            newData.unit = newData.unit || unit;
        }
        onChange(newData);
    };

    return (
        <div className="rttpg-control-field rttpg-cf-range-wrap">

            <div className="rttpg-cf-head">
                <div className="rt-left-part">
                    {label && (
                        <span className="rttpg-label">{label}</span>
                    )}
                    {responsive && <Devices device={device} onChange={_device => {
                        setDevice(_device);
                        const newData = JSON.parse(JSON.stringify(data));
                        if (!newData[_device]) {
                            newData[_device] = '';
                            if (false !== units) {
                                newData.unit = newData.unit || unit;
                            }
                        }
                        onChange(newData)
                    }}
                    />}
                </div>

                {units && (
                    <div className="rt-right-part">
                        <div className="rttpg-units-choices">
                            {(units && Array.isArray(units) ? units : ['px', 'em', '%']).map(_unit => (
                                <label
                                    className={(data?.unit === _unit || (!data?.unit && _unit === unit)) ? 'active' : ''}
                                    onClick={() => updateUnit(_unit)}>
                                    {_unit}
                                </label>
                            ))}
                        </div>
                    </div>
                )}

            </div>

            <div className="rttpg-cf-body">
                <RangeControl
                    className="rttpg-control-field"
                    value={data[device]}
                    onChange={(val) => {
                        setSettings(val)
                    }}
                    {...dataAttributes}
                />

                {(data[device] || data[device] !== 0) && (
                    <Button
                        isSmall
                        className="rttpg-undo-btn"
                        icon="image-rotate"
                        onClick={() => onChange(dftData)}
                    ></Button>
                )}
            </div>
        </div>
    );
};

export default RangeDevice;
