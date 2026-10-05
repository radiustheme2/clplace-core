const {__} = wp.i18n;
const {useState, useEffect} = wp.element;
const {Dropdown, Button, SelectControl, RangeControl, ToggleControl} = wp.components;

import Range from "./Range";

import "./scss/filterImage.scss";

function FilterImage(props) {
    const {label, value: data, onChange, transition = false, opacity = false} = props;

    const setSettings = (val, type, property = null) => {
        const newData = JSON.parse(JSON.stringify(data));
        if (type === 'filter') {
            newData[type][property] = val;
        } else {
            newData[type] = val;
        }
        onChange(newData);
    };

    const defData = {
        'openFilter': 1,
        'filter': {'brightness': '', 'contrast': '', 'saturate': '', 'blur': '', 'hue-rotate': ''},
        'opacity': '',
        'transition': ''
    }

    return (
        <>

            {opacity && (
                <div className="rttpg-opacity-field">
                    <Range
                        label={__("Opacity", "clplace")}
                        reset={true}
                        value={data['opacity']}
                        onChange={(val) => setSettings(val, 'opacity')}
                        min={0}
                        max={1}
                        step={0.01}
                    />
                </div>
            )}

            <div className="rttpg-control-field rttpg-cf-filter-image-wrap">
                {label && (
                    <span className="rttpg-label">{label}</span>
                )}
                <div className="rttpg-filter-image-wrap">
                    <Dropdown
                        className="rttpg-filter-image-dropdown-icon"
                        contentClassName="rttpg-components-popover rttpg-cp-filter-image"
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
                            <div className="rttpg-filter-image-content">
                                <Range
                                    label={__("Blur")}
                                    reset={true}
                                    value={data['filter']["blur"]}
                                    onChange={(val) => setSettings(val, 'filter', 'blur')}
                                    min={0}
                                    max={10}
                                    step={0.1}
                                />
                                <Range
                                    label={__("Brightness")}
                                    reset={true}
                                    value={data['filter']["brightness"]}
                                    onChange={(val) => setSettings(val, 'filter', 'brightness')}
                                    min={0}
                                    max={200}
                                />
                                <Range
                                    label={__("Contrast")}
                                    reset={true}
                                    value={data['filter']["contrast"]}
                                    onChange={(val) => setSettings(val, 'filter', 'contrast')}
                                    min={0}
                                    max={200}
                                />
                                <Range
                                    label={__("Saturation")}
                                    reset={true}
                                    value={data['filter']["saturate"]}
                                    onChange={(val) => setSettings(val, 'filter', 'saturate')}
                                    min={0}
                                    max={200}
                                />
                                <Range
                                    label={__("Hue")}
                                    reset={true}
                                    value={data['filter']["hue-rotate"]}
                                    onChange={(val) => setSettings(val, 'filter', 'hue-rotate')}
                                    min={0}
                                    max={360}
                                />
                            </div>
                        )}
                    />
                </div>
            </div>

            {transition && (
                <div className="rttpg-transition-field">
                    <Range
                        label={__("Transition Duration")}
                        reset={true}
                        value={data['transition']}
                        onChange={(val) => setSettings(val, 'transition')}
                        min={0}
                        max={5}
                        step={0.1}
                    />
                </div>
            )}

        </>
    );
};

export default FilterImage;
