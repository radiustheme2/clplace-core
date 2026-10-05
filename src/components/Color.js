const {__} = wp.i18n;
const {useState, useEffect} = wp.element;
const {Dropdown, Tooltip, ColorPicker, Button} = wp.components;

import './scss/color.scss'

function Color({label, color, onChange}) {

    const [bgColor, setBgColor] = useState(color);
    useEffect(() => {
        setBgColor(color);
    }, [color]);

    const onChangeComplete = ({rgb, hex}) => {
        let color = rgb ? `rgba(${rgb.r},${rgb.g},${rgb.b},${rgb.a})` : hex;
        onChange(color);
    };

    return (
        <div className="rttpg-control-field rttpg-cf-color-wrap">

            {label && (
                <span className="rttpg-label">{label}</span>
            )}

            <div className="rttpg-color">
                <Dropdown
                    contentClassName="rttpg-components-popover rttpg-cp-color-content"
                    renderToggle={({isOpen, onToggle}) => (
                        <Tooltip text={color || "default"}>
                            <div className="rttpg-color-ball">
                                <div
                                    style={{
                                        height: 25,
                                        width: 25,
                                        borderRadius: "50%",
                                        boxShadow: "inset 0 0 0 1px rgba(0,0,0,.1)",
                                        backgroundColor: bgColor,
                                    }}
                                    aria-expanded={isOpen}
                                    onClick={onToggle}
                                    aria-label={color || "default"}
                                ></div>
                            </div>
                        </Tooltip>
                    )}
                    renderContent={() => (
                        <ColorPicker
                            color={color}
                            onChangeComplete={(color) => onChangeComplete(color)}
                        />
                    )}
                />
                {bgColor && (
                    <Button
                        isSmall
                        className="rttpg-undo-btn"
                        icon="image-rotate"
                        onClick={() => onChange(undefined)}
                    ></Button>
                )}
            </div>

        </div>
    );
};

export default Color;
