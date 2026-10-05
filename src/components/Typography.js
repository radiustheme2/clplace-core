const {__} = wp.i18n;
const {useState, useEffect} = wp.element;
const {Dropdown, Button, SelectControl} = wp.components;

import RangeDevice from "./RangeDevice";
import {FONT_WEIGHTS, TEXT_TRANSFORM} from "./Constants";
import "./scss/typography.scss";

function Typography(props) {

    const {label, value: data, onChange} = props;
    const setSettings = (val, type) => {
        const newData = JSON.parse(JSON.stringify(data));
        newData[type] = val;
        onChange(newData);
    };

    return (
        <div className="rttpg-control-field rttpg-cf-typography-wrap">

            {label && (
                <span className="rttpg-label">{label}</span>
            )}

            <div className="rttpg-typography">
                <Dropdown
                    className="rttpg-typography-dropdown-icon"
                    contentClassName="rttpg-components-popover rttpg-cp-typography-content"
                    position="bottom right"
                    renderToggle={({isOpen, onToggle}) => (
                        <Button
                            isSmall
                            onClick={onToggle}
                            aria-expanded={isOpen}
                            icon="edit"
                        ></Button>
                    )}

                    renderContent={() => (

                        <div className="rttpg-typography-content">
                            <RangeDevice
                                label={__('Font Size')}
                                responsive={true}
                                value={data['size']}
                                units={['px', 'em', '%']}
                                min={1}
                                max={data["size"]["unit"] === "em" ? 10 : 200}
                                step={data["size"]["unit"] === "em" ? 0.1 : 1}
                                onChange={(val) => setSettings(val, 'size')}
                            />

                            <SelectControl
                                label={__("Font Weight")}
                                value={data["weight"]}
                                options={FONT_WEIGHTS}
                                onChange={(val) =>
                                    setSettings(val, 'weight')
                                }
                            />
                            <SelectControl
                                label={__("Text Transform")}
                                value={data["transform"]}
                                options={TEXT_TRANSFORM}
                                onChange={(val) =>
                                    setSettings(val, 'transform')
                                }
                            />
                            <RangeDevice
                                label={__('Letter Spacing')}
                                responsive={true}
                                value={data['spacing']}
                                units={['px', 'em']}
                                min={-5}
                                max={data["spacing"]["unit"] === "em" ? 10 : 100}
                                step={data["spacing"]["unit"] === "em" ? 0.1 : 1}
                                onChange={(val) => setSettings(val, 'spacing')}
                            />
                            <RangeDevice
                                label={__('Line Height')}
                                responsive={true}
                                value={data['height']}
                                units={['px', 'em']}
                                min={1}
                                max={data["height"]["unit"] === "em" ? 10 : 100}
                                step={data["height"]["unit"] === "em" ? 0.1 : 1}
                                onChange={(val) => setSettings(val, 'height')}
                            />

                        </div>
                    )}


                />

            </div>
        </div>
    );
};

export default Typography;
