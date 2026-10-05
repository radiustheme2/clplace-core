import {registerBlockType} from "@wordpress/blocks";
import {__} from "@wordpress/i18n";
import Edit from "./edit";

registerBlockType("rttpg/tpg-section-title", {
    title: __("Section Title", "clplace"),
    category: "rttpg",
    description: "The post grid block, Section Title",
    icon: <img src={rtParams.plugin_url + "/assets/images/gutenberg/section-title.svg"} alt={__("Section Title")}/>,
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
        __("section title"),
        __("title"),
        __("the"),
        __("grid"),
        __("post"),
    ],
    save: () => null,
    edit: Edit
});