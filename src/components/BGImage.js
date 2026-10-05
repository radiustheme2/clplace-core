const {__} = wp.i18n;
const {useState, useEffect} = wp.element;
const {MediaUpload} = wp.blockEditor;
const {BaseControl, Button} = wp.components;

import Color from "./Color";
import ImageAvater from "./ImageAvater";
import SelectObj1 from "./SelectObj1";

import './scss/bgImage.scss'

import {
    BACKGROUND_POSITION,
    BACKGROUND_ATTACHMENT,
    BACKGROUND_REPEAT,
    BACKGROUND_SIZE
} from './Constants';

function BGImage(props) {

    const [device, setDevice] = useState(() => window.rttpgDevice || 'md');
    const {label, value, image, onChange} = props;
    const responsive = true;
    const resAttr = ['imgPosition', 'imgAttachment', 'imgRepeat', 'imgSize'];

    const defaultData = {
        color: '',
        img: {
            imgURL: '',
            imgID: ''
        },
        imgProperty: {
            imgPosition: {lg: ''},
            imgAttachment: {lg: ''},
            imgRepeat: {lg: ''},
            imgSize: {lg: ''},
        }
    }

    const setSettings = (val, type) => {
        const newData = JSON.parse(JSON.stringify(value));

        if (resAttr.includes(type)) {
            if (responsive) {
                newData['imgProperty'] = val;
            } else {
                newData['imgProperty'] = val;
            }
        } else {
            newData[type] = val;
        }

        // if (resAttr.includes(type)) {
        // 	if (responsive) {
        // 		newData.imgProperty = val;
        // 	} else {
        // 		newData.imgProperty = val;
        // 	}
        // } else {
        // 	newData[type] = val;
        // }

        // if (resAttr.includes(type)) {
        // 	if (responsive) {
        // 		newData.imgProperty[device][type] = val;
        // 	} else {
        // 		newData.imgProperty[type] = val;
        // 	}
        // } else {
        // 	newData[type] = val;
        // }

        onChange(newData)

    }

    const imgURLVal = value['img'] !== undefined ? value['img']['imgURL'] : '';
    const imgIDVal = value['img'] !== undefined ? value['img']['imgID'] : '';

    return (
        <div className="rttpg-control-field rttpg-cf-bg-img-wrap">

            {label && (
                <span className="rttpg-label">{label}</span>
            )}

            <div className="rttpg-bg-img">
                <Color
                    label={__('Color')}
                    color={value['color'] || ''}
                    onChange={(val) => setSettings(val, 'color')}
                />

                {image !== false &&
                    <BaseControl label={__("Image")}>
                        <MediaUpload
                            onSelect={(media) => {
                                const imgobj = {
                                    imgURL: media.url,
                                    imgID: media.id
                                }
                                setSettings(imgobj, 'img')
                            }
                            }
                            allowedTypes={["image"]}
                            value={imgIDVal}
                            render={({open}) => {
                                {
                                    if (!imgURLVal) {
                                        return (
                                            <div onClick={open} className={"rttpg-placeholder-image"}>
                                                <div className="dashicon dashicons dashicons-insert"/>
                                                <div>{__('Insert')}</div>
                                            </div>
                                        );
                                    } else {
                                        return (
                                            <ImageAvater
                                                imageUrl={imgURLVal}
                                                onEditImage={open}
                                                onDeleteImage={() => {
                                                    setSettings('', 'img');
                                                }}
                                            />
                                        )
                                    }
                                }
                            }}
                        />

                        {imgURLVal && (
                            <SelectObj1
                                label={__('Position')}
                                responsive={true}
                                value={value['imgProperty']}
                                name={'imgPosition'}
                                options={BACKGROUND_POSITION}
                                onChange={(val) => {
                                    setSettings(val, 'imgPosition')
                                }}
                            />

                        )}

                        {imgURLVal && (
                            <SelectObj1
                                label={__('Attachment')}
                                responsive={true}
                                value={value['imgProperty']}
                                name={'imgAttachment'}
                                options={BACKGROUND_ATTACHMENT}
                                onChange={(val) => setSettings(val, 'imgAttachment')}
                            />
                        )}

                        {imgURLVal && (
                            <SelectObj1
                                label={__('Repeat')}
                                responsive={true}
                                value={value['imgProperty']}
                                name={'imgRepeat'}
                                options={BACKGROUND_REPEAT}
                                onChange={(val) => setSettings(val, 'imgRepeat')}
                            />
                        )}

                        {imgURLVal && (
                            <SelectObj1
                                label={__('Size')}
                                responsive={true}
                                value={value['imgProperty']}
                                name={'imgSize'}
                                options={BACKGROUND_SIZE}
                                onChange={(val) => setSettings(val, 'imgSize')}
                            />
                        )}
                    </BaseControl>
                }
            </div>

        </div>
    )
}

export default BGImage;