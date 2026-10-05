import classnames from 'classnames';
import {InnerBlocks, useBlockProps} from '@wordpress/block-editor';

export default function save(props) {
    const {
        uniqueId,
        gutterX,
        gutterY,
        mainWrapShowHide,
        mainWrapBGOverlayEnable
    } = props.attributes;

    let inlineStyle = {
        '--d-gap-x': gutterX['lg'] + gutterX['unit'],
        '--t-gap-x': gutterX['md'] + gutterX['unit'],
        '--m-gap-x': gutterX['sm'] + gutterX['unit'],
        '--d-gap-y': gutterY['lg'] + gutterY['unit'],
        '--t-gap-y': gutterY['md'] + gutterY['unit'],
        '--m-gap-y': gutterY['sm'] + gutterY['unit'],
    }
    const saveBlockProps = useBlockProps.save();

    //editor all block common wrapper class
    const editWrapClass = classnames([
        'rttpg-block-postgrid',
        'rttpg-block-' + uniqueId,
        saveBlockProps.className,
        'rttpg-block',
        'rttpg-row-wrap',
        'rttpg-block-frontend',
        mainWrapBGOverlayEnable ? 'rttpg-overlay' : '',
        mainWrapShowHide.lg ? 'rttpg-hide-desktop' : '',
        mainWrapShowHide.md ? 'rttpg-hide-tablet' : '',
        mainWrapShowHide.sm ? 'rttpg-hide-mobile' : '',
    ]);
    const blockWrapClass = classnames([
        'rttpg-row'
    ]);

    return (
        <div className={editWrapClass} style={inlineStyle}>
            <div className="rttpg-container">
                <div className={blockWrapClass}>
                    <InnerBlocks.Content/>
                </div>
            </div>
        </div>
    );

}

