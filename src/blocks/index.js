/* global wp */
const {__} = wp.i18n;
const {render} = wp.element;
import ParseCss from "../utils/css/ParseCss";
import {updateCategory} from '@wordpress/blocks';
import ImportLayout from './import/ImportLayout'

window.rttpgDevice = 'lg';

//Impost post grid block
import "./grid-layout";
import "./section-title";
import "./row";
import "./row/column";

// Save Style CSS within Database/File
window.bindCss = false;

const clplaceBlocks = [
    `${RDTheme.itemID}/post-block`,
    `${RDTheme.itemID}/row`,
    `${RDTheme.itemID}/tpg-section-title`,
]
wp.data.subscribe(() => {
    try {
        const {getBlockOrder, getBlock} = wp.data.select('core/block-editor');
        const blockIds = getBlockOrder();
        const blocks = blockIds.map((blockId) => getBlock(blockId))
        const ourBlocks = blocks.filter(item => clplaceBlocks.includes(item.name));
        const _wp$data$select = wp.data.select("core/editor");
        if (!_wp$data$select || 0 == ourBlocks.length) {
            return;
        }
        const isSavingPost = _wp$data$select.isSavingPost;
        const isAutoSavingPost = _wp$data$select.isAutosavingPost;

        if (isSavingPost() && !isAutoSavingPost()) {
            ParseCss();
        }
    } catch (err) {
        console.error(err);
    }
});


//UPDATE BLOCK CATEGORY ICON
updateCategory("rttpg", {
    icon: (
        <img
            src={rtParams.plugin_url + "/assets/images/icon-20x20.png"}
            alt={__("The Post Grid")}
        />
    ),
});


if (rtParams.disableImportButton != 'yes') {
    wp.domReady(function () {
        setTimeout(function () {
            const toolbar = document.querySelector(".edit-post-header__toolbar");
            const toolbarChild = document.querySelector(".edit-post-header-toolbar");

            if (!toolbar) {
                return;
            }
            const rttpgImportWrap = document.createElement("div");
            rttpgImportWrap.classList.add("rttpg-import-button-wrapper");

            if (!toolbar.querySelector(".rttpg-import-button-wrapper")) {
                render(<ImportLayout/>, rttpgImportWrap);
                // toolbarChild.append(rttpgImportWrap)
                toolbar.insertBefore(rttpgImportWrap, toolbarChild);
            }
        }, 400);
    });
}