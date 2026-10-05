import {registerBlockType} from "@wordpress/blocks";
import {__} from "@wordpress/i18n";
import Edit from "./edit";

registerBlockType("rttpg/tpg-grid-hover-layout", {
    title: __("Grid Hover Layout", "clplace"),
    category: "rttpg",
    description: "The post grid block, Grid Hover layout",
    icon: <img src={rtParams.plugin_url + "/assets/images/gutenberg/grid-hover-layout.svg"}
               alt={__("Grid Layout")}/>,
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
        __("grid hover layout"),
        __("hover layout"),
        __("the post"),
        __("list"),
        __("the"),
        __("grid"),
        __("post"),
    ],
    save: () => null,
    edit: Edit
});