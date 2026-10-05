/* global wp, jQuery, ajaxurl */
import {CssGenerator} from './CssGenerator';

const {select} = wp.data;


const innerBlocks = function (blocks) {
    let type = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
    let __CSS = '';
    if (type === true) {
        __CSS = '';
        type = false;
    }
    blocks.map((row) => {
        const {attributes, name} = row;
        const [blockType, blockName] = name.split('/');
        if (blockType === RDTheme.itemID && attributes.uniqueId) {
            __CSS += CssGenerator(attributes, blockName, attributes.uniqueId, true);
        }
        if (row.innerBlocks && row.innerBlocks.length > 0) {
            __CSS += innerBlocks(row.innerBlocks);
        }
    });
    return __CSS;
};

const isRadiusThemeBlock = (blocks) => {
    let hasBlock = false;
    blocks.forEach(function (block) {
        const {name, innerBlocks = []} = block;
        const [blockType, blockName] = name.split('/');

        if (blockType === RDTheme.itemID) {
            hasBlock = true;
        }

        if (!hasBlock && innerBlocks.length > 0) {
            hasBlock = isRadiusThemeBlock(innerBlocks);
        }
    });
    return hasBlock;
}

const getData = pId => {

    jQuery
        .ajax({
            url: ajaxurl,
            dataType: "json",
            type: "POST",
            data: {
                nonce: rtParams.nonce,
                postId: pId,
                action: 'clplace_block_css_get_posts'
            }
        })
        .then(function (response) {

            if (response.success) {
                const innerBlock = innerBlocks(wp.blocks.parse(response.data), true);
                if (innerBlock.css) {

                    jQuery
                        .ajax({
                            url: ajaxurl,
                            dataType: "json",
                            type: "POST",
                            data: {
                                nonce: rtParams.nonce,
                                inner_css: innerBlock.css,
                                post_id: wp.data.select('core/editor').getCurrentPostId(),
                                action: 'clplace_block_css_appended'
                            }
                        })
                        .done(function (res) {
                            if (res.success) {
                                // Save Data
                            }
                        });
                }
            }
        });
};

const parseBlock = blocks => {
    blocks.forEach(function (block) {
        if (block.name.indexOf('core/block') !== -1) {
            getData(block.attributes.ref);
        }
        if (block.innerBlocks && block.innerBlocks.length > 0) {
            parseBlock(block.innerBlocks);
        }
    });
};

const ParseCss = (setDatabase = true) => {
    window.bindCss = true;
    const all_blocks = select('core/block-editor').getBlocks();
    const {getCurrentPostId} = select('core/editor');
    const hasRttpgBlocks = isRadiusThemeBlock(all_blocks);
    const blockCss = innerBlocks(all_blocks, true);
    console.log(blockCss)

    if (setDatabase) {
        parseBlock(all_blocks);
        jQuery
            .ajax({
                url: ajaxurl,
                dataType: "json",
                type: "POST",
                data: {
                    nonce: rtParams.nonce,
                    block_css: blockCss,
                    post_id: getCurrentPostId,
                    has_block: hasRttpgBlocks,
                    action: 'clplace_block_css_save'
                }
            });
    }
    setTimeout(function () {
        window.bindCss = false;
    }, 900);

};

export default ParseCss;