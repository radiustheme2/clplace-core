/**
 * Set inline CSS class.
 * @param {object} props - The block object.
 * @return {array} The inline CSS class.
 */

import RB_SVG_Icon from "./gbicon.json"
import parseSVG from "./parseIcon"

function renderSVG(svg) {

    svg = parseSVG(svg)

    var fontAwesome = RB_SVG_Icon[svg]

    if ("undefined" != typeof fontAwesome) {
        var viewbox_array = (fontAwesome["svg"].hasOwnProperty("brands")) ? fontAwesome["svg"]["brands"]["viewBox"] : fontAwesome["svg"]["solid"]["viewBox"]
        var path = (fontAwesome["svg"].hasOwnProperty("brands")) ? fontAwesome["svg"]["brands"]["path"] : fontAwesome["svg"]["solid"]["path"]
        var viewBox = viewbox_array.join(" ")

        return (
            <svg xmlns="http://www.w3.org/2000/svg" viewBox={viewBox} width="1em" height="1em" fill="currentColor">
                <path d={path}></path>
            </svg>
        )
    }

}

export default renderSVG
