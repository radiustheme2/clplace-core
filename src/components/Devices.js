/* global wp */
import {useCallback, useEffect, useRef, useState} from "react";

const {__} = wp.i18n
import './scss/devices.scss'
import useClickOutside from "../helpers/useClickOutside";

const Devices = (props) => {
    const [switcherIsOpen, setSwitcherIsOpen] = useState(false);
    const [device, setDevice] = useState(() => props.device || 'lg');
    const devicesRef = useRef();
    const closeDevices = useCallback(() => setSwitcherIsOpen(false), []);
    useEffect(() => {
        if (device) {
            window.rttpgDevice = device
        }
    }, [])
    const onClickHandler = (_device) => {
        window.rttpgDevice = _device;
        setDevice(_device);
        props.onChange(_device);
        setSwitcherIsOpen(() => !switcherIsOpen)
    }
    useClickOutside(devicesRef, closeDevices);

    return <div ref={devicesRef}
                className={`rttpg-device-switchers active-${device}${switcherIsOpen ? ' rttpg-device-switchers-open' : ''} `}
                onClick={() => setSwitcherIsOpen(() => !switcherIsOpen)}>
        <div className="rttpg-device-switchers-wrap">
            <a className={`rttpg-device-switcher rttpg-device-switcher-desktop${device === 'lg' ? ' active' : ''}`}
               onClick={() => onClickHandler('lg')} data-tooltip={__('Desktop')}>
                <i className="fas fa-desktop"></i>
            </a>
            <a className={`rttpg-device-switcher rttpg-device-switcher-laptop${device === 'md' ? ' active' : ''}`}
               onClick={() => onClickHandler('md')} data-tooltip={__('Tablet')}>
                <i className="fas fa-tablet-alt"></i>
            </a>
            <a className={`rttpg-device-switcher rttpg-device-switcher-tablet${device === 'sm' ? ' active' : ''}`}
               onClick={() => onClickHandler('sm')} data-tooltip={__('Mobile')}>
                <i className="fas fa-mobile-alt"></i>
            </a>
            {/* <a className={`rttpg-device-switcher rttpg-device-switcher-smartphone${device === 'xs' ? ' active' : ''}`}
			 onClick={() => onClickHandler('xs')} data-tooltip={__('Phone')}>
			 <i className="dashicons dashicons-smartphone" />
			 </a> */}
        </div>
    </div>
}

export default Devices;