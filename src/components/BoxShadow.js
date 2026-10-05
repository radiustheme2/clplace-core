const { __ } = wp.i18n;
const { useState, useEffect } = wp.element;
const { Dropdown, Button, SelectControl, RangeControl, ToggleControl } = wp.components;

import Range from "./Range";

import Color from "./Color";
import "./scss/boxshadow.scss";

function BoxShadow( props ) {
    const { label, value: data, onChange, transition } = props;

    const setSettings = ( val, type, property = null ) => {
        const newData = JSON.parse( JSON.stringify( data ) );
        if ( type === 'width' ) {
            newData[type][property] = val;
        } else {
            newData[type] = val;
        }
        onChange( newData );
    };

    return (
        <div className="rttpg-control-field rttpg-cf-typography-wrap">

            { label && (
                <span className="rttpg-label">{ label }</span>
            ) }

            <div className="rttpg-typography">

                <Dropdown
                    className="rttpg-typography-dropdown-icon"
                    contentClassName="rttpg-components-popover rttpg-cp-typography-content"
                    position="bottom right"
                    renderToggle={ ( { isOpen, onToggle } ) => (
                        <Button
                            isSmall
                            onClick={ onToggle }
                            aria-expanded={ isOpen }
                            icon="edit"
                        ></Button>
                    ) }

                    renderContent={ () => (
                        <div className="rttpg-typography-content">
                            <Color
                                label={ __( "Color" ) }
                                color={ data['color'] }
                                onChange={ ( val ) => setSettings( val, 'color' ) }
                            />
                            <Range
                                label={ __( "Horizontal Offset" ) }
                                reset={ true }
                                value={ data['width']["top"] }
                                onChange={ ( val ) => setSettings( val, 'width', 'top' ) }
                                min={ 0 }
                                max={ 100 }
                            />
                            <Range
                                label={ __( "Vertical Offset" ) }
                                reset={ true }
                                value={ data['width']["right"] }
                                onChange={ ( val ) => setSettings( val, 'width', 'right' ) }
                                min={ 0 }
                                max={ 100 }
                            />
                            <Range
                                label={ __( "Shadow Blur" ) }
                                reset={ true }
                                value={ data['width']["bottom"] }
                                onChange={ ( val ) => setSettings( val, 'width', 'bottom' ) }
                                min={ 0 }
                                max={ 100 }
                            />
                            <Range
                                label={ __( "Shadow Spread" ) }
                                reset={ true }
                                value={ data['width']["left"] }
                                onChange={ ( val ) => setSettings( val, 'width', 'left' ) }
                                min={ 0 }
                                max={ 100 }
                            />

                            <div className="rttpg-toggle-control-field">
                                <ToggleControl
                                    label="Inset"
                                    checked={ data['inset'] }
                                    onChange={ ( val ) => setSettings( val, 'inset' ) }
                                />
                            </div>

                            { transition && (
                                <Range
                                    label={ __( "Shadow Transition" ) }
                                    reset={ true }
                                    value={ data['transition'] }
                                    onChange={ ( val ) => setSettings( val, 'transition' ) }
                                    min={ 0 }
                                    max={ 5 }
                                    step={ 0.1 }
                                />
                            ) }
                        </div>

                    ) }


                />

            </div>
        </div>
    );
};

export default BoxShadow;
