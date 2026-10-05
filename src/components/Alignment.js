const {__} = wp.i18n
const {useState} = wp.element;
const {Tooltip} = wp.components;
import "./scss/alignment.scss";
import Devices from "./Devices";

const Alignment = (props) => {

    const {value, responsive, onChange, label, content, options} = props;

    const [device, setDevice] = useState(() => window.rttpgDevice || 'lg');

    const _filterValue = () => {
        return value ? (responsive ? (value[device]) : value) : '';
    }

    const [currentValue, setCurrentValue] = useState({current: _filterValue()});

    const setSettings = (val) => {
        if (val == '') {
            return;
        }
        const final = responsive ? Object.assign({}, value, {[device]: val}) : val;
        onChange(final);
        setCurrentValue({current: final});
    }

    const defaultData = options && Array.isArray(options) ? options : ['left', 'center', 'right', 'justify'];

    return (
        <div className="rttpg-control-field rttpg-cf-alignment-wrap">

            {(label || responsive) && (
                <div className="rttpg-cf-head">
                    {label && (
                        <span className="rttpg-label">{label}</span>
                    )}
                    {responsive &&
                        <Devices
                            device={device}
                            onChange={_device => {
                                setDevice(_device);
                                const newData = JSON.parse(JSON.stringify(value));
                                if (!newData[_device]) {
                                    newData[_device] = '';
                                }
                                onChange(newData)
                            }}
                        />
                    }
                </div>
            )}

            <div className="rttpg-cf-body rttpg-btn-group">

                {defaultData.map((data, index) => {
                    if (content) {
                        return (
                            <button className={(_filterValue() == data.value ? 'active' : '') + ' rttpg-button'}
                                    key={index}
                                    onClick={() => setSettings(_filterValue() == data.value ? '' : data.value)}>
                                <Tooltip
                                    text={__(data.label, 'clplace-core')}><span>{__(data.label, 'clplace-core')}</span></Tooltip>
                            </button>
                        )

                    } else {
                        return (
                            <button className={(_filterValue() == data ? 'active' : '') + ' rttpg-button'}
                                    key={index}
                                    onClick={() => setSettings(_filterValue() == data ? '' : data)}>
                                {(data == 'left' || data === 'flex-start') &&
                                    <Tooltip text={__('Left')}>
                                        <i className="fas fa-align-left"></i>
                                    </Tooltip>
                                }
                                {data == 'center' &&
                                    <Tooltip text={__('Middle')}>
                                        <i className="fas fa-align-center"></i>
                                    </Tooltip>
                                }
                                {(data == 'right' || data === 'flex-end') &&
                                    <Tooltip text={__('Right')}>
                                        <i class="fas fa-align-right"></i>
                                    </Tooltip>
                                }
                                {(data == 'justify') &&
                                    <Tooltip text={__('Right')}>
                                        <i class="fas fa-align-justify"></i>
                                    </Tooltip>
                                }
                            </button>
                        )
                    }
                })}

            </div>
        </div>
    )
}

export default Alignment;