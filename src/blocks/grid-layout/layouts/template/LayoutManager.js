import Layout1 from "./Layout1";
import Layout2 from "./Layout2";
import Layout3 from "./Layout3";
import Layout4 from "./Layout4";
import Layout5 from "./Layout5";
import Layout6 from "./Layout6";
import Layout7 from "./Layout7";
import Layout8 from "./Layout8";
import Layout9 from "./Layout9";

function LayoutManager({attributes, post}) {
    const {prefix} = attributes;
    let layout = <Layout1 attributes={attributes} post={post}/>
    if ('grid-layout3' === attributes[prefix + '_layout']) {
        layout = <Layout2 attributes={attributes} post={post}/>
    } else if ('grid-layout4' === attributes[prefix + '_layout']) {
        layout = <Layout3 attributes={attributes} post={post}/>
    } else if ('grid-layout2' === attributes[prefix + '_layout']) {
        layout = <Layout4 attributes={attributes} post={post}/>
    } else if ('grid-layout5' === attributes[prefix + '_layout']) {
        layout = <Layout5 attributes={attributes} post={post}/>
    } else if ('grid-layout5-2' === attributes[prefix + '_layout']) {
        layout = <Layout6 attributes={attributes} post={post}/>
    } else if ('grid-layout6' === attributes[prefix + '_layout']) {
        layout = <Layout7 attributes={attributes} post={post}/>
    } else if ('grid-layout6-2' === attributes[prefix + '_layout']) {
        layout = <Layout8 attributes={attributes} post={post}/>
    } else if ('grid-layout7' === attributes[prefix + '_layout']) {
        layout = <Layout9 attributes={attributes} post={post}/>
    }

    return layout;
}

export default LayoutManager;