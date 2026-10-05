import Layout1 from "./Layout1";
import Layout2 from "./Layout2";
import Layout3 from "./Layout3";
import Layout4 from "./Layout4";
import Layout5 from "./Layout5";
import Layout6 from "./Layout6";
import Layout7 from "./Layout7";
import Layout8 from "./Layout8";
import Layout9 from "./Layout9";
import Layout10 from "./Layout10";
import Layout11 from "./Layout11";

function LayoutManager({attributes, post}) {
    const {prefix} = attributes;

    let layout = <Layout1 attributes={attributes} post={post}/>                 //Layout 1

    if ('grid_hover-layout2' === attributes[prefix + '_layout']) {
        layout = <Layout2 attributes={attributes} post={post}/>                 //Layout 2
    } else if ('grid_hover-layout3' === attributes[prefix + '_layout']) {
        layout = <Layout3 attributes={attributes} post={post}/>                 //Layout 3
    } else if ('grid_hover-layout4' === attributes[prefix + '_layout']) {
        layout = <Layout4 attributes={attributes} post={post}/>                 //Layout 4
    } else if ('grid_hover-layout4-2' === attributes[prefix + '_layout']) {
        layout = <Layout4 attributes={attributes} post={post}/>                 //Layout 5
    } else if ('grid_hover-layout5' === attributes[prefix + '_layout']) {
        layout = <Layout5 attributes={attributes} post={post}/>                 //Layout 6
    } else if ('grid_hover-layout5-2' === attributes[prefix + '_layout']) {
        layout = <Layout5 attributes={attributes} post={post}/>                 //Layout 7
    } else if ('grid_hover-layout6' === attributes[prefix + '_layout']) {
        layout = <Layout6 attributes={attributes} post={post}/>                 //Layout 8
    } else if ('grid_hover-layout6-2' === attributes[prefix + '_layout']) {
        layout = <Layout6 attributes={attributes} post={post}/>                 //Layout 9
    } else if ('grid_hover-layout7' === attributes[prefix + '_layout']) {
        layout = <Layout7 attributes={attributes} post={post}/>                 //Layout 10
    } else if ('grid_hover-layout7-2' === attributes[prefix + '_layout']) {
        layout = <Layout7 attributes={attributes} post={post}/>                 //Layout 11
    } else if ('grid_hover-layout8' === attributes[prefix + '_layout']) {
        layout = <Layout8 attributes={attributes} post={post}/>                 //Layout 12
    } else if ('grid_hover-layout9' === attributes[prefix + '_layout']) {
        layout = <Layout9 attributes={attributes} post={post}/>                 //Layout 13
    } else if ('grid_hover-layout9-2' === attributes[prefix + '_layout']) {
        layout = <Layout9 attributes={attributes} post={post}/>                 //Layout 14
    } else if ('grid_hover-layout10' === attributes[prefix + '_layout']) {
        layout = <Layout10 attributes={attributes} post={post}/>                 //Layout 15
    } else if ('grid_hover-layout11' === attributes[prefix + '_layout']) {
        layout = <Layout11 attributes={attributes} post={post}/>                 //Layout 16
    }

    return layout;
}

export default LayoutManager;