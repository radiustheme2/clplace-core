import { registerBlockType } from "@wordpress/blocks";
import { __ } from "@wordpress/i18n";
import Edit from "./edit";
import Save from "./save";
import attributes from "./attributes";
import example from "./example";
import variations from "./variations";

registerBlockType('rttpg/row', {
	title: __("Row (The Post Grid)", "clplace"),
	// category: "rttpg",
	description: "The post grid block, List layout",
	apiVersion: 1,
	icon: <img src={rtParams.plugin_url + "/assets/images/gutenberg/row.svg"} alt={__("TPG Row")}/>,
	keywords: [
		__("row", "clplace"),
		__("column", "clplace"),
		__("post grid"),
		__("clplace"),
		__("the post grid"),
		__("grid"),
		__("post"),
	],
	attributes,
	save: Save,
	edit: Edit,
	variations,
	example,
	supports: {
		align: ["full"],
	}
});