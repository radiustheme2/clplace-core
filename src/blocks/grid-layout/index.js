import {registerBlockType} from "@wordpress/blocks";
import {__} from "@wordpress/i18n";
import Edit from "./edit";

registerBlockType("rt1224/post-block", {
    title: __("Grid Layout", "clplace"),
    category: "rt1224",
    description: "The post grid block, Grid layout",
    icon: <img src={rtParams.plugin_url + "/assets/images/gutenberg/grid-layout.svg"} alt={__("Grid Layout")}/>,
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
        __("grid layout"),
        __("the post"),
        __("the"),
        __("grid"),
        __("post"),
    ],
    save: () => null,
    edit: Edit
});