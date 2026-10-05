import { SelectControl } from "@wordpress/components";

const { __ } = wp.i18n;

import './scss/rangeDevice.scss'
import { COL_OPTIONS, COL_OPTIONS_GRID } from "./Constants"
import { useState, useEffect } from "react";

function TPGColumn( props ) {
    const { label, value: data, onChange, className, changeQuery, colStyle = "" } = props;

    const setSettings = ( device, val ) => {
        const newData = JSON.parse( JSON.stringify( data ) );
        newData[device] = val;
        onChange( newData );
    };

    const GRID_CLOUMN = colStyle === 'grid' ? COL_OPTIONS_GRID : COL_OPTIONS;

    return (
        <div className={ `rttpg-column-group ${ className }` }>
            { label && (
                <div className="rttpg-cf-head">
                    <span className="rttpg-label">{ label }</span>
                </div>
            ) }

            <div className="rttpg-column-group-inner">
                <SelectControl
                    label={ __( 'Desktop', 'clplace-core' ) }
                    className="rttpg-control-field"
                    value={ data.lg || '' }
                    options={ GRID_CLOUMN }
                    onChange={ ( val ) => {
                        setSettings( 'lg', val );
                        changeQuery();
                    } }
                />

                <SelectControl
                    label={ __( 'Tablet', 'clplace-core' ) }
                    className="rttpg-control-field"
                    value={ data.md || '' }
                    options={ GRID_CLOUMN }
                    onChange={ ( val ) => setSettings( "md", val ) }
                />

                <SelectControl
                    label={ __( 'Mobile', 'clplace-core' ) }
                    className="rttpg-control-field"
                    value={ data.sm || '' }
                    options={ GRID_CLOUMN }
                    onChange={ ( val ) => setSettings( "sm", val ) }
                />
            </div>

        </div>
    );
}

export default TPGColumn;
