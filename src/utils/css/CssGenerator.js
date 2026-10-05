import _typeof from '@babel/runtime/helpers/typeof';
import {
    cssGradient,
    cssCustomBorder2,
    cssBorder,
    cssBoxShadow,
    cssFilter,
    cssTypography,
    cssDimension,
    cssBackground,
    cssColor,
    cssBackgroundColor,
    cssPadding,
    cssBorderRadius,
    cssMargin,
    cssCustomBorder
} from './CssHelper';

// Replace Value
const replaceData = (selector, key, value) => selector.replace(new RegExp(key, "g"), value);

// Object Empty Check
const isEmpty = obj => (typeof obj === 'undefined' ? 'undefined' : _typeof(obj)) === 'object' && Object.keys(obj).length !== 0;

// {{WRAPPER}} Replace
const replaceWarp = (selector, ID) => {
    selector = selector.replace(new RegExp('{{WRAPPER}}', "g"), `.${RDTheme.itemID}-block-${ID}`);
    selector = selector.replace(new RegExp('{{WRAPPER_ID}}', "g"), 'block-' + ID);
    return selector;
}

export const objectReplace = (warp, value) => {
    let output = '';
    value.forEach(function (sel) {
        output += sel + ';';
    });
    return warp + '{' + output + '}';
};

export const objectAppend = (warp, value) => {
    let output = '';
    value.forEach(function (sel) {
        output += warp + sel;
    });
    return output;
};

// Plain String/Number Field CSS Replace
export const singleField = (style, blockID, key, value) => {

    value = typeof value != 'object' ? value : objectField(value).data
    if (typeof style == 'string') {
        if (style) {
            if (value || value == '0') {
                const warpData = replaceWarp(style, blockID);
                if (typeof value == 'boolean') {
                    return [warpData];
                } else {
                    if (warpData.indexOf('{{') === -1 && warpData.indexOf('{') < 0) {
                        return [warpData + value];
                    } else {
                        return [replaceData(warpData, '{{' + key + '}}', value)];
                    }
                }
            } else {
                return [];
            }
        } else {
            return [replaceWarp(value, blockID)]; // Custom CSS Field
        }
    } else {
        const output = [];
        style.forEach(function (sel) {
            output.push(replaceData(replaceWarp(sel, blockID), '{{' + key + '}}', value));
        });
        return output;
    }
};

// Object Field CSS Replace
const objectField = (data, type) => {
    if (data.openTypography) {
        return {data: cssTypography(data), action: 'append'}; //Typography
    } else if (data.openBg) {
        return {data: cssBackground(data), action: 'append'}; //Background
    } else if (data.openBorder) {
        return {data: cssBorder(data), action: 'append'}; //Border
    } else if (data.openShadow && data.color) {
        return {data: cssBoxShadow(data), action: 'append'}; //Shadow
    } else if (data.openFilter) {
        return {data: cssFilter(data), action: 'append'}; //Shadow
    } else if (data.direction) {
        return {data: cssGradient(data, 'return'), action: 'append'}; //Gradient
    } else if (typeof data.top != 'undefined' || typeof data.left != 'undefined' || typeof data.right != 'undefined' || typeof data.bottom != 'undefined') {
        return {data: cssDimension(data), action: 'replace'}; //Dimension
    } else if (data.openColor) {
        if (data.replace) {
            return {data: cssColor(data), action: 'replace'}; //Color Advanced
        } else {
            return {data: cssColor(data), action: 'append'}; //Color Advanced
        }
    } else if (data.openBGColor) {
        return {data: cssBackgroundColor(data), action: 'append'};
    } else if (type === 'padding') {
        return {data: cssPadding(data), action: 'append'}; //dimension
    } else if (type === 'borderRadius') {
        return {data: cssBorderRadius(data), action: 'append'}; //dimension
    } else if (type === 'margin') {
        return {data: cssMargin(data), action: 'append'}; //dimension
    } else if (type === 'border') {
        return {data: cssCustomBorder(data), action: 'append'}; //dimension
    } else if (data.openTpgBorder) {
        return {data: cssCustomBorder2(data), action: 'append'}; //borderControl
    } else {
        return {data: '', action: 'append'};
    }
};

export const checkDepends = (settings, selectData) => {
    let _depends = true;
    if (selectData.hasOwnProperty('depends')) {
        selectData.depends.forEach((data) => {
            const previous = _depends;
            if (data.condition === '==' || data.condition === '===') {
                if (typeof data.value == 'string' || typeof data.value == 'number' || typeof data.value == 'boolean') {
                    _depends = settings[data.key] === data.value;
                } else {
                    let select = false;
                    data.value.forEach(function (arrData) {
                        if (settings[data.key] === arrData) {
                            select = true;
                        }
                    });
                    if (select) {
                        _depends = true;
                    }
                }
            } else if (data.condition === '!=' || data.condition === '!==') {
                if (typeof data.value == 'string' || typeof data.value == 'number' || typeof data.value == 'boolean') {
                    _depends = settings[data.key] !== data.value;
                } else {
                    let _select = false;
                    data.value.forEach(function (arrData) {
                        if (settings[data.key] !== arrData) {
                            _select = true;
                        }
                    });
                    if (_select) {
                        _depends = true;
                    }
                }
            }
            _depends = previous === false ? false : _depends;
        });
    }

    return _depends;
};

/**
 * @param {*} settings
 * @param {string} blockName
 * @param {*} blockID
 * @param isInline
 */
export const CssGenerator = (settings, blockName, blockID, isInline) => {

    if (!blockID) return;
    let __CSS = '',
        lg = [],
        md = [],
        sm = [],
        xs = [],
        notResponsiveCss = [];
    
    Object.keys(settings).forEach(function (key) {
        const attributes = typeof blockName === 'string' ? wp.blocks.getBlockType(`${RDTheme.itemID}/` + blockName)?.attributes : blockName;
        if (attributes && attributes[key] && attributes[key].hasOwnProperty('style')) {

            attributes[key].style.forEach((selectData, indexStyle) => {
                if (selectData.hasOwnProperty('selector')) {
                    const cssSelector = selectData.selector;

                    if (checkDepends(settings, selectData, key, indexStyle)) {
                        if (typeof settings[key] == 'object') {

                            let device = false;
                            let dimension = '';

                            if (settings[key].lg || settings[key].lg === 0) {
                                // Exta Large
                                device = true;
                                dimension = typeof settings[key].lg == 'object' ? objectField(settings[key].lg, settings[key].type).data : settings[key].lg + (settings[key].unit || '');
                                lg = lg.concat(singleField(cssSelector, blockID, key, dimension));
                            }
                            if (settings[key].md || settings[key].md === 0) {
                                // Desktop
                                device = true;
                                dimension = typeof settings[key].md == 'object' ? objectField(settings[key].md, settings[key].type).data : settings[key].md + (settings[key].unit || '');
                                md = md.concat(singleField(cssSelector, blockID, key, dimension));
                            }
                            if (settings[key].sm || settings[key].sm === 0) {
                                // Tablet
                                device = true;
                                dimension = typeof settings[key].sm == 'object' ? objectField(settings[key].sm, settings[key].type).data : settings[key].sm + (settings[key].unit || '');
                                sm = sm.concat(singleField(cssSelector, blockID, key, dimension));
                            }
                            if (settings[key].xs || settings[key].xs === 0) {
                                // Phone
                                device = true;
                                dimension = typeof settings[key].xs == 'object' ? objectField(settings[key].xs, settings[key].type).data : settings[key].xs + (settings[key].unit || '');
                                xs = xs.concat(singleField(cssSelector, blockID, key, dimension));
                            }

                            if (!device) {

                                // Object Field Type Only
                                const objectCss = objectField(settings[key], settings[key].type);
                                const repWarp = replaceWarp(cssSelector, blockID);


                                if (typeof objectCss.data == 'object') {

                                    if (Object.keys(objectCss.data).length !== 0) {
                                        if (objectCss.data.background) {
                                            notResponsiveCss.push(repWarp + objectCss.data.background);
                                        }

                                        // Typography
                                        if (isEmpty(objectCss.data.lg)) {
                                            lg.push(objectReplace(repWarp, objectCss.data.lg));
                                        }
                                        if (isEmpty(objectCss.data.md)) {
                                            md.push(objectReplace(repWarp, objectCss.data.md));
                                        }
                                        if (isEmpty(objectCss.data.sm)) {
                                            sm.push(objectReplace(repWarp, objectCss.data.sm));
                                        }
                                        if (isEmpty(objectCss.data.xs)) {
                                            xs.push(objectReplace(repWarp, objectCss.data.xs));
                                        }
                                        if (objectCss.data.simple) {
                                            notResponsiveCss.push(repWarp + objectCss.data.simple);
                                        }
                                        if (objectCss.data.font) {
                                            lg.unshift(objectCss.data.font);
                                        }

                                        if (objectCss.data.shape) {
                                            objectCss.data.shape.forEach(function (el) {
                                                notResponsiveCss.push(repWarp + el);
                                            });
                                            if (isEmpty(objectCss.data.data.lg)) {
                                                lg.push(objectAppend(repWarp, objectCss.data.data.lg));
                                            }
                                            if (isEmpty(objectCss.data.data.md)) {
                                                md.push(objectAppend(repWarp, objectCss.data.data.md));
                                            }
                                            if (isEmpty(objectCss.data.data.sm)) {
                                                sm.push(objectAppend(repWarp, objectCss.data.data.sm));
                                            }
                                            if (isEmpty(objectCss.data.data.xs)) {
                                                xs.push(objectAppend(repWarp, objectCss.data.data.xs));
                                            }
                                        }
                                    }
                                } else if (objectCss.data && objectCss.data.indexOf('{{') === -1) {
                                    if (objectCss.action === 'append') {
                                        notResponsiveCss.push(repWarp + objectCss.data);
                                    } else {
                                        notResponsiveCss.push(singleField(cssSelector, blockID, key, objectCss.data));
                                    }
                                }
                            }

                        } else {

                            if (key === 'hideTablet') {
                                if (isInline) {
                                    sm = sm.concat(singleField(cssSelector, blockID, key, settings[key]));
                                }
                            } else if (key === 'hideMobile') {
                                if (isInline) {
                                    xs = xs.concat(singleField(cssSelector, blockID, key, settings[key]));
                                }
                            } else {
                                if (settings[key] || settings[key] == '0') {
                                    notResponsiveCss = notResponsiveCss.concat(singleField(cssSelector, blockID, key, settings[key]));
                                }
                            }
                        }
                    }
                }
            });
        }
    });

    // Join CSS
    //lg
    if (lg.length > 0) {
        __CSS += lg.join('');
    }
    //md
    if (md.length > 0) {
        __CSS += '@media (max-width: 1024px) {' + md.join('') + '}';
    }
    //sm
    if (sm.length > 0) {
        __CSS += '@media (max-width: 767px) {' + sm.join('') + '}';
    }
    //xs
    // if (xs.length > 0) {
    // 	__CSS += '@media (max-width: 768px) {' + xs.join('') + '}';
    // } 

    if (notResponsiveCss.length > 0) {
        __CSS += notResponsiveCss.join('');
    }

    if (isInline) {
        return __CSS;
    }

    // Set CSS
    setStyle(__CSS, blockID);
};

//Set CSS to Head
// const setStyle = function setStyle(styleCss, blockID) {
// 	const styleSelector = window.document;

// 	const cssId = 'rttpg-block-css-' + blockID;
// 	if (styleSelector.getElementById(cssId) === null) {
// 		const cssInline = document.createElement('style');
// 		cssInline.id = cssId;
// 		cssInline.innerHTML = styleCss;
// 		styleSelector.getElementsByTagName("head")[0].appendChild(cssInline);
// 	} else {
// 		styleSelector.getElementById(cssId).innerHTML = styleCss;
// 	}
// };

const setStyle = function setStyle(styleCss, blockID) {

    const cssId = 'rttpg-block-css-' + blockID;
    const iFrame = document.querySelector('iframe[name=editor-canvas]');

    if (iFrame) {
        setTimeout(
            function () {
                const doc = iFrame.contentDocument;
                if (doc) {
                    const iframeHead = doc.getElementsByTagName('head')[0];
                    if (doc.getElementById(cssId) === null && iframeHead) {
                        const cssInline = document.createElement('style');
                        cssInline.id = cssId;
                        cssInline.innerHTML = styleCss;
                        iframeHead.appendChild(cssInline);
                    } else {
                        doc.getElementById(cssId).innerHTML = styleCss;
                    }

                    if (doc.getElementById('rttpg-frontend-css') === null) {
                        const link = doc.createElement('link');
                        link.rel = 'stylesheet';
                        link.type = 'text/css';
                        if (rtParams.hasPro) {
                            link.href = rtParams.plugin_pro_url + '/assets/css/tpg-block.min.css';
                        } else {
                            link.href = rtParams.plugin_url + '/assets/css/tpg-block.min.css';
                        }
                        link.setAttribute('id', 'rttpg-frontend-css');
                        iframeHead.appendChild(link);
                    }

                    // if (doc.getElementById('rttpg-preview-jquery') === null) {
                    // 	const script = doc.createElement('script');
                    // 	script.src = rtParams.site_url + '/wp-includes/js/jquery/jquery.min.js';
                    // 	script.setAttribute('id', 'rttpg-preview-jquery');
                    // 	iframeHead.appendChild(script);
                    // }

                    // if (doc.getElementById('rttpg-frontend-blocks-js') === null) {
                    // 	const script = doc.createElement('script');
                    // 	script.src = rtParams.plugin_url + '/assets/js/frontend-blocks.js';
                    // 	script.setAttribute('id', 'rttpg-frontend-blocks-js');
                    // 	iframeHead.appendChild(script);
                    // }

                }
            },
            1
        );
    } else {
        const styleSelector = window.document;
        if (styleSelector.getElementById(cssId) === null) {
            const cssInline = document.createElement('style');
            cssInline.id = cssId;
            cssInline.innerHTML = styleCss;
            styleSelector.getElementsByTagName('head')[0].appendChild(cssInline);
        } else {
            styleSelector.getElementById(cssId).innerHTML = styleCss;
        }
    }
};