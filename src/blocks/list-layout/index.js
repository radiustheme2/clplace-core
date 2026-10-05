import {registerBlockType} from "@wordpress/blocks";
import {__} from "@wordpress/i18n";
import Edit from "./edit";

registerBlockType("rttpg/tpg-list-layout", {
    title: __("List Layout", "clplace"),
    category: "rttpg",
    description: "The post grid block, List layout",
    icon: <img src={rtParams.plugin_url + "/assets/images/gutenberg/list-layout.svg"} alt={__("Grid Layout")}/>,
    example: {
        attributes: {
            preview: true
        },
    },
    supports: {
        align: ['center', 'wide', 'full']
    },
    keywords: [
        __("post grid"),
        __("the post grid"),
        __("list layout"),
        __("the post"),
        __("list"),
        __("the"),
        __("grid"),
        __("post"),
    ],
    save: () => null,
    edit: Edit
});