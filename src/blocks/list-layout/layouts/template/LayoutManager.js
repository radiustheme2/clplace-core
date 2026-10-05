import Layout1 from "./Layout1";
import Layout2 from "./Layout2";
import Layout3 from "./Layout3";
import Layout4 from "./Layout4";
import Layout5 from "./Layout5";

function LayoutManager({attributes, post}) {
    const {prefix} = attributes;

    let layout = <Layout1 attributes={attributes} post={post}/>
    if ('list-layout2' === attributes[prefix + '_layout']) {
        layout = <Layout2 attributes={attributes} post={post}/>
    } else if ('list-layout2-2' === attributes[prefix + '_layout']) {
        layout = <Layout2 attributes={attributes} post={post}/>
    } else if ('list-layout3' === attributes[prefix + '_layout']) {
        layout = <Layout3 attributes={attributes} post={post}/>
    } else if ('list-layout3-2' === attributes[prefix + '_layout']) {
        layout = <Layout3 attributes={attributes} post={post}/>
    } else if ('list-layout4' === attributes[prefix + '_layout']) {
        layout = <Layout4 attributes={attributes} post={post}/>
    } else if ('list-layout5' === attributes[prefix + '_layout']) {
        layout = <Layout5 attributes={attributes} post={post}/>
    }

    return layout;
}

export default LayoutManager;