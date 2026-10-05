const {__} = wp.i18n;
const {useState, useEffect} = wp.element;
const {Button, ButtonGroup, Tooltip} = wp.components;
import {BACKGROUND_TYPE} from './Constants'

import Gradient from './Gradient';
import BGImage from './BGImage';

import './scss/background.scss'

function Background(props) {

    const defaultData = {
        openBGColor: 0,
        type: 'classic',
        classic: {
            'color': '',
            'img': {'imgURL': '', 'imgID': ''},
            'imgProperty': {
                'imgPosition': {'lg': ''},
                'imgAttachment': {'lg': ''},
                'imgRepeat': {'lg': ''},
                'imgSize': {'lg': ''},
            }
        },
        gradient: '',
    };

    const {label, value, onChange} = props;

    const setSettings = (val, type) => {
        onChange(Object.assign({}, defaultData, (value || {}), {openBGColor: 1}, {[type]: val}));
    }

    return (
        <div className="rttpg-control-field rttpg-cf-background-wrap">

            <div className='rttpg-cf-body'>
                <div className="rttpg-cf-body-btn-wrap">

                    {label && (
                        <div className="rttpg-cf-head">
                            <span className="rttpg-label">{label}</span>
                        </div>
                    )}

                    <ButtonGroup className="rttpg-btn-group">
                        {BACKGROUND_TYPE.map((item) => (

                            <Tooltip text={item.label} position="top" delay={0}>
                                <Button
                                    isLarge
                                    isPrimary={value['type'] === item.value}
                                    isSecondary={value['type'] !== item.value}
                                    onClick={() => setSettings(item.value, 'type')}
                                >
                                    {item.value === 'classic' ?
                                        <i className="classic-btn fas fa-paint-brush"></i>
                                        :
                                        <i className="gradient-btn fas fa-barcode"></i>
                                    }

                                </Button>
                            </Tooltip>

                        ))}
                    </ButtonGroup>
                    {(Object.keys(value['classic']).length != 0 || value['gradient']) && (
                        <Button
                            isSmall
                            className="rttpg-undo-btn"
                            icon="image-rotate"
                            onClick={() => onChange(defaultData)}
                        ></Button>
                    )}
                </div>

                <div className="rttpg-cf-body-content-wrap">
                    {value['type'] === "classic" && (
                        <BGImage
                            image={props?.image}
                            value={value['classic']}
                            onChange={val => setSettings(val, 'classic')}
                        />
                    )}

                    {value['type'] === "gradient" && (
                        <Gradient
                            value={value['gradient']}
                            onChange={(val) => setSettings(val, 'gradient')}
                        />
                    )}
                </div>
            </div>

        </div>
    )
}

export default Background;