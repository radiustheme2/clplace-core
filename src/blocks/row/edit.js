const {__} = wp.i18n;
const {useEffect, useMemo} = wp.element;
import Inspector from "./inspector";
import {CssGenerator} from "../../utils/css/CssGenerator";
import classnames from "classnames";
import {withSelect, useDispatch} from '@wordpress/data';
import {compose} from '@wordpress/compose';
import {
    __experimentalBlockVariationPicker as BlockVariationPicker, useBlockProps
} from '@wordpress/block-editor';
import {createBlock} from '@wordpress/blocks';

import {
    InnerBlocks
} from "@wordpress/block-editor";
import icons from "../../components/icon/icons";

function Edit(props) {
    const {isSelected, attributes, setAttributes, clientId, className} = props;

    //block id generate for css
    const {
        uniqueId,
        columns,
        gutterX,
        gutterY,
        mainWrapShowHide,
        wrapperTag,
        mainWrapBGOverlayEnable,
    } = attributes;

    const editBlockProps = useBlockProps();

    let inlineStyle = {
        '--d-gap-x': gutterX['lg'] + gutterX['unit'],
        '--t-gap-x': gutterX['md'] + gutterX['unit'],
        '--m-gap-x': gutterX['sm'] + gutterX['unit'],
        '--d-gap-y': gutterY['lg'] + gutterY['unit'],
        '--t-gap-y': gutterY['md'] + gutterY['unit'],
        '--m-gap-y': gutterY['sm'] + gutterY['unit'],
    }

    const _client = clientId.substr(0, 6);

    useEffect(() => {
        if (!uniqueId) {
            setAttributes({uniqueId: _client});
        } else if (uniqueId && uniqueId !== _client) {
            setAttributes({uniqueId: _client});
        }
    }, []);

    //variationPicker svg set width & height
    const variationPickerAllSvg = document.querySelectorAll('.rttpg-container-variation-picker svg');
    if (variationPickerAllSvg.length) {
        variationPickerAllSvg.forEach((svg) => {
            svg.setAttribute('width', '100%');
            svg.setAttribute('height', '100%');
        })
    }

    useEffect(() => {
        const sidebarEl = document.querySelector('.interface-interface-skeleton__sidebar');
        sidebarEl.classList.add('tpg-sidebar')
        sidebarEl.classList.remove('tpg-settings-enable')
        sidebarEl.addEventListener('click', function (event) {
            const hasClass = event.target.classList.contains('rttpg-tab-btn');
            if (hasClass) {
                const selectText = event.target.textContent;
                this.classList.remove('tpg-settings-enable')
            }
        })
        sidebarEl.addEventListener('scroll', function (e) {
            if (e.target.scrollTop > 86) {
                this.classList.add('tpg-should-collapse');
            } else {
                this.classList.remove('tpg-should-collapse');
            }
        })

    }, [isSelected]);

    if (uniqueId) {
        CssGenerator(attributes, 'row', uniqueId);
    }

    //editor all block common wrapper class
    const editWrapClass = classnames([
        'rttpg-block-postgrid',
        'rttpg-block-' + uniqueId,
        'rttpg-block',
        className,
        'rttpg-row-wrap',
        'rttpg-block-editor',
        mainWrapBGOverlayEnable ? 'rttpg-overlay' : '',
        mainWrapShowHide.lg ? 'rttpg-hide-desktop' : '',
        mainWrapShowHide.md ? 'rttpg-hide-tablet' : '',
        mainWrapShowHide.sm ? 'rttpg-hide-mobile' : '',
    ])

    //block class
    const blockWrapClass = classnames([
        'rttpg-row'
    ])

    const getTemplate = useMemo(() => {
        const childColumns = [];
        for (let i = 0; i < columns; i++) {
            childColumns.push(['rttpg/column', {id: i + 1}]);
        }
        return childColumns;
    }, [columns]);

    const blockVariationPickerOnSelect = (
        nextVariation = props.defaultVariation
    ) => {
        if (nextVariation.attributes) {
            props.setAttributes(nextVariation.attributes);
        }

        if (nextVariation.innerBlocks) {
            props.replaceInnerBlocks(
                props.clientId,
                createBlocksFromInnerBlocksTemplate(nextVariation.innerBlocks)
            );
        }
    };

    const createBlocksFromInnerBlocksTemplate = (innerBlocksTemplate) => {
        return innerBlocksTemplate.map(
            ([name, attributes, innerBlocks = []]) =>
                createBlock(
                    name,
                    attributes,
                    createBlocksFromInnerBlocksTemplate(innerBlocks)
                )
        );
    };


    const {variations, hasInnerBlocks} = props;
    if (!hasInnerBlocks) {
        return (
            props.attributes.preview ? icons.row_preview :
                <>
                    <div className='rttpg-container-variation-picker'>
                        <BlockVariationPicker
                            icon={''}
                            label={__('Select Column Layout', 'clplace-core')}
                            variations={variations}
                            instructions={''}
                            onSelect={(nextVariation) =>
                                blockVariationPickerOnSelect(nextVariation)
                            }
                        />
                    </div>
                </>
        );
    }

    //const WrapperTag = wrapperTag;

    return [
        isSelected && (
            <Inspector
                attributes={attributes}
                setAttributes={setAttributes}
            />
        ),

        <div className={editWrapClass} style={inlineStyle}>
            <div className="rttpg-container">
                <div className={blockWrapClass}>
                    <InnerBlocks
                        template={getTemplate}
                        templateLock="all"
                        allowedBlocks={['rttpg/column']}
                    />
                </div>
            </div>
        </div>
    ]

}

const applyWithSelect = withSelect((select, props) => {
    const {
        attributes: {
            columns,
        },
    } = props;
    const {getBlocks} = select('core/block-editor');
    const {
        getBlockType,
        getBlockVariations,
        getDefaultBlockVariation,
    } = select('core/blocks');

    const innerBlocks = getBlocks(props.clientId);
    const {replaceInnerBlocks} = useDispatch('core/block-editor');

    return {
        innerBlocks,
        hasInnerBlocks: select('core/block-editor').getBlocks(props.clientId).length > 0,
        blockType: getBlockType(props.name),
        defaultVariation: typeof getDefaultBlockVariation === 'undefined' ? null : getDefaultBlockVariation(props.name),
        variations: typeof getBlockVariations === 'undefined' ? null : getBlockVariations(props.name),
        replaceInnerBlocks,
    };
});

export default compose(applyWithSelect)(Edit);
//export default Edit;