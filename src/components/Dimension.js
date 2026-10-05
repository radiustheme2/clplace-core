/* global wp*/
import {useState} from "react";
import PropTypes from "prop-types";
import Devices from "./Devices";
import "./scss/dimension.scss";


const Dimension = (props) => {
    const {responsive, onChange, className, units, value: data, type} = props;

    const [device, setDevice] = useState(() => window.rttpgDevice || 'lg');
    const defaultData = {isLinked: true, unit: 'px', value: ''};
    const currentData = responsive ? (data[device] ? data[device] : defaultData) : data || defaultData;

    const disableLink = props?.disableLink;
    const allowDimension = props?.allowDimension;

    if(disableLink === true){
        currentData.isLinked = false;
    }
    if(props?.important){
        currentData.important = true;
    }
    const updateData = (newData) => {
        if(disableLink === true){
            newData.isLinked = false;
        }
        newData.type = type;
        onChange(newData);
    }

    const onChangeDimension = (type, newValue) => {
        let formattedValue = currentData.value ? currentData.value.split(" ") : ['', '', '', ''];
        if (currentData.isLinked) {
            formattedValue = new Array(5).fill(formattedValue[0] || '0');
        } else {
            if (formattedValue.length < 4) {
                formattedValue = new Array(5).fill(formattedValue[0] || '0');
            }
        }
        const [top, right, bottom, left] = formattedValue;

        const newData = JSON.parse(JSON.stringify(data));
        const updatedValue = currentData.isLinked ? `${newValue} ${newValue} ${newValue} ${newValue}` : `${type === 'top' ? `${newValue}` : `${top}`} ${type === 'right' ? `${newValue}` : `${right}`} ${type === 'bottom' ? `${newValue}` : `${bottom}`} ${type === 'left' ? `${newValue}` : `${left}`}`;
        if (responsive) {
            newData[device].value = updatedValue;
        } else {
            newData.value = updatedValue;
        }
        updateData(newData);
    }

    const updateUnit = (_unit) => {
        const newData = JSON.parse(JSON.stringify(data));
        if (responsive) {
            newData[device].unit = _unit;
        } else {
            newData.unit = _unit;
        }
        updateData(newData);
    }

    //TODO::::::::::::
    const toggleIsLinked = () => {
        if(disableLink === true){
            return;
        }
        const newData = JSON.parse(JSON.stringify(data));
        if (responsive) {
            newData[device].isLinked = !newData[device].isLinked;
            if (newData[device].isLinked) {
                newData[device].value = newData[device].value ? newData[device].value.split(" ")[0] : '';
            }
        } else {
            newData.isLinked = !newData.isLinked;
        }

        updateData(newData);
    }

    const dimensionTypes = ['top', 'right', 'bottom', 'left'];
    let dimensionValues;
    if (currentData.isLinked) {
        const firstValue = currentData?.value ? currentData.value.split(" ")[0] : '';
        dimensionValues = new Array(5).fill(firstValue);
    } else {
        dimensionValues = currentData?.value ? currentData.value.split(" ") : ['', '', '', '']
    }

    return (
        <div className={`rttpg-control-field rttpg-cf-dimension ${className}`}>
            <div className={`rttpg-cf-head`}>
                <div className="rt-left-part">
                    <div className="rttpg-label">{props.label}</div>
                    {responsive && <Devices device={device} onChange={_device => {
                        setDevice(_device);
                        const newData = JSON.parse(JSON.stringify(data));
                        if (!newData[_device]) {
                            newData[_device] = defaultData;
                            updateData(newData);
                        }
                    }}/>}
                </div>
                <div className="rt-right-part">
                    <div className="rttpg-units-choices">
                        {(units && Array.isArray(units) ? units : ['px', 'em', '%']).map(_unit => (
                            <label
                                className={(currentData?.unit === _unit || (!currentData?.unit && _unit === defaultData.unit)) ? 'active' : ''}
                                onClick={() => updateUnit(_unit)}>
                                {_unit}</label>
                        ))}
                    </div>
                </div>
            </div>
            <div className="rttpg-cf-body">
                <div className="rttpg-control-dimensions">
                    {dimensionTypes.map((_item, _i) => {
                        let isDisable = false;
                        if((allowDimension==='vertical' && ['left','right'].includes(_item)) || allowDimension==='horizontal' && ['top','bottom'].includes(_item)){
                            isDisable = true;
                        }
                        return (
                            <div className="rttpg-control-dimension">
                                <input
                                    type="number"
                                    value={dimensionValues[_i]}
                                    data-setting={_item}
                                    onChange={(e) => onChangeDimension(_item, e.target.value)}
                                    disabled={isDisable}
                                />
                                <label className="rttpg-control-dimension-label">{_item}</label>
                            </div>
                        );
                    })}

                    <div className='rttpg-control-dimension linking'>
                        <button
                            className={`rttpg-link-dimensions  ${currentData?.isLinked ? "admin-links linked" : "editor-unlink"}`}
                            onClick={toggleIsLinked}
                        >
							<span
                                className={`rt-dm-link-icon dashicons dashicons-${currentData?.isLinked ? "admin-links linked" : "editor-unlink"}`}>
							</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );
}

Dimension.propTypes = {
    label: PropTypes.string,
    value: PropTypes.object,
    onChange: PropTypes.func.isRequired,
    type: PropTypes.oneOf(['padding', 'margin', 'borderRadius']),
};

export default Dimension;
