// CSS Gradient
export var cssGradient = function cssGradient(v, type) {
    let gradietValue = v.type === 'linear' ? 'linear-gradient(' + v.direction + 'deg, ' : 'radial-gradient( circle at ' + v.radial + ' , ';
    gradietValue += v.color1 + ' ' + v.start + '%,' + v.color2 + ' ' + v.stop + '%)';
    if (type === 'object') {
        return {background: gradietValue};
    } else {
        gradietValue = 'background:' + gradietValue + (v.clip ? '-webkit-background-clip: text; -webkit-text-fill-color: transparent;' : '');
        return '{' + gradietValue + '}';
    }
};

// CSS Box Shadow
export var cssBoxShadow = function cssBoxShadow(v) {
    let data = '{';
    data += 'box-shadow:' + (v.inset ? 'inset' : '') + ' ' + v.width.top + 'px ' + v.width.right + 'px ' + v.width.bottom + 'px ' + v.width.left + 'px ' + v.color + ';';
    if (v.transition !== undefined) {
        data += 'transition: box-shadow ' + v.transition + 's;';
    }
    data += '}';
    return data;
    //return '{ box-shadow:' + (v.inset ? 'inset' : '') + ' ' + v.width.top + 'px ' + v.width.right + 'px ' + v.width.bottom + 'px ' + v.width.left + 'px ' + v.color + '; transition: box-shadow 0.5s;}';
};

// CSS Filter
export var cssFilter = function cssFilter(v) {
    let data = '{';
    if (v.opacity !== undefined && v.opacity !== '') {
        data += 'opacity:' + v.opacity + ';';
    }
    data += 'filter:' + 'brightness(' + v.filter.brightness + '% ) ' + 'contrast(' + v.filter.contrast + '% ) ' + 'saturate(' + v.filter.saturate + '% ) ' + 'blur(' + v.filter.blur + 'px ) ' + 'hue-rotate(' + v.filter['hue-rotate'] + 'deg )' + ';';
    if (v.transition !== undefined && v.transition !== '') {
        data += 'transition: filter ' + v.transition + 's;';
    }
    data += '}';
    return data;
};

// CSS Border
export var cssBorder = function cssBorder(v) {
    v = Object.assign({}, {type: 'solid', width: {}, color: '#e5e5e5'}, v);
    const unit = v.width.unit ? v.width.unit : 'px';
    return '{ border-color:  ' + (v.color ? v.color : '#555d66') + '; border-style: ' + (v.type ? v.type : 'solid') + '; border-width: ' + cssDimension(v.width) + '; }';
};

// CSS Typography
const _device = function _device(val, selector) {
    let data = {};
    if (val && val.lg) {
        data.lg = selector.replace(new RegExp('{{key}}', "g"), val.lg + (val.unit || ''));
    }
    if (val && val.md) {
        data.md = selector.replace(new RegExp('{{key}}', "g"), val.md + (val.unit || ''));
    }
    if (val && val.sm) {
        data.sm = selector.replace(new RegExp('{{key}}', "g"), val.sm + (val.unit || ''));
    }
    if (val && val.xs) {
        data.xs = selector.replace(new RegExp('{{key}}', "g"), val.xs + (val.unit || ''));
    }
    return data;
};
const _push = function _push(val, data) {
    if (val.lg) {
        data.lg.push(val.lg);
    }
    if (val.md) {
        data.md.push(val.md);
    }
    if (val.sm) {
        data.sm.push(val.sm);
    }
    if (val.xs) {
        data.xs.push(val.xs);
    }
    return data;
};
export var cssTypography = function cssTypography(v) {
    let font = '';
    if (v.family && v.family !== 'none') {
        if (!['Arial', 'Tahoma', 'Verdana', 'Helvetica', 'Times New Roman', 'Trebuchet MS', 'Georgia'].includes(v.family)) {
            font = "@import url('https://fonts.googleapis.com/css?family=" + v.family.replace(' ', '+') + ':' + (v.weight || 400) + "');";
        }
    }
    let data = {lg: [], md: [], sm: [], xs: []};
    if (v.size) {
        data = _push(_device(v.size, 'font-size:{{key}}'), data);
    }
    if (v.height) {
        data = _push(_device(v.height, 'line-height:{{key}} !important'), data);
    }
    if (v.spacing) {
        data = _push(_device(v.spacing, 'letter-spacing:{{key}}'), data);
    }
    const simple = '{' + (v.family && v.family !== 'none' ? "font-family:'" + v.family + "'," + (v.type || "sans-serif") + ";" : '') + (v.weight ? 'font-weight:' + v.weight + ';' : '') + (v.color ? 'color:' + v.color + ';' : '') + (v.style ? 'font-style:' + v.style + ';' : '') + (v.transform ? 'text-transform:' + v.transform + ';' : '') + (v.decoration ? 'text-decoration:' + v.decoration + ';' : '') + '}';
    return {lg: data.lg, md: data.md, sm: data.sm, xs: data.xs, simple: simple, font: font};
};

// CSS Dimension
export const cssDimension = function cssDimension(v) {
    const unit = v.unit ? v.unit : 'px';
    let data = '';
    if (v.top || v.top === 0) {
        data += v.top + unit + ' '
    }
    if (v.right || v.right === 0) {
        data += v.right + unit + ' '
    }
    if (v.bottom || v.bottom === 0) {
        data += v.bottom + unit + ' '
    }
    if (v.left || v.left === 0) {
        data += v.left + unit + ' '
    }
    return data;
    //return (v.top || 0) + unit + ' ' + (v.right || 0) + unit + ' ' + (v.bottom || 0) + unit + ' ' + (v.left || 0) + unit;
};

// CSS Background
const split_bg = function split_bg(type) {
    const image = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    const imgPosition = arguments[2];
    const imgAttachment = arguments[3];
    const imgRepeat = arguments[4];
    const imgSize = arguments[5];
    const DefaultColor = arguments[6];
    const bgGradient = arguments[7];

    let bgData = DefaultColor ? 'background-color:' + DefaultColor + ';' : '';
    if (type === 'image') {
        bgData += (image.hasOwnProperty('url') ? 'background-image:url(' + image.url + ');' : '') + (imgPosition ? 'background-position:' + imgPosition + ';' : '') + (imgAttachment ? 'background-attachment:' + imgAttachment + ';' : '') + (imgRepeat ? 'background-repeat:' + imgRepeat + ';' : '') + (imgSize ? 'background-size:' + imgSize + ';' : '');
    } else if (type === 'gradient') {
        if (bgGradient && bgGradient.type === 'linear') {
            bgData += 'background-image: linear-gradient(' + bgGradient.direction + 'deg, ' + bgGradient.color1 + ' ' + bgGradient.start + '%,' + bgGradient.color2 + ' ' + bgGradient.stop + '%);';
        } else {
            bgData += 'background-image: radial-gradient( circle at ' + bgGradient.radial + ' , ' + bgGradient.color1 + ' ' + bgGradient.start + '%,' + bgGradient.color2 + ' ' + bgGradient.stop + '%);';
        }
    }
    return bgData;
};
export const cssBackground = function cssBackground(v) {
    let background = '{';
    background += split_bg(v.bgType, v.bgImage, v.bgimgPosition, v.bgimgAttachment, v.bgimgRepeat, v.bgimgSize, v.bgDefaultColor, v.bgGradient);
    background += '}';
    if (v.bgType === 'video') {
        if (v.bgVideoFallback) {
            if (v.bgVideoFallback.url) {
                background += 'background-image: url(' + v.bgVideoFallback.url + '); background-position: center; background-repeat: no-repeat; background-size: cover;';
            }
        }
    }
    if (background !== '{}') {
        return background;
    }
    return {};
};

// CSS ColorAdvanced
export const cssColor = function cssColor(v) {
    let data = v.clip ? '-webkit-background-clip: text; -webkit-text-fill-color: transparent;' : '';
    if (v.type === 'color') {
        data += v.color ? 'background-image: none; background-color: ' + v.color + ';' : '';
    } else if (v.type === 'gradient' && v.gradient) {
        if (v.gradient && v.gradient.type === 'linear') {
            data += 'background-image : linear-gradient(' + v.gradient.direction + 'deg, ' + v.gradient.color1 + ' ' + v.gradient.start + '%,' + v.gradient.color2 + ' ' + v.gradient.stop + '%);';
        } else {
            data += 'background-image : radial-gradient( circle at ' + v.gradient.radial + ' , ' + v.gradient.color1 + ' ' + v.gradient.start + '%,' + v.gradient.color2 + ' ' + v.gradient.stop + '%);';
        }
    }
    if (v.replace) {
        return data;
    } else {
        return '{' + data + '}';
    }
};

export const cssBackgroundColor = (v) => {
    let data = {lg: [], md: [], sm: [], xs: []};
    let simpleData = '';
    if (v.type === 'classic') {

        if (v.classic.imgProperty['imgPosition']) {
            data = _push(_device(v.classic.imgProperty['imgPosition'], 'background-position:{{key}} !important'), data);
        }
        if (v.classic.imgProperty['imgAttachment']) {
            data = _push(_device(v.classic.imgProperty['imgAttachment'], 'background-attachment:{{key}} !important'), data);
        }
        if (v.classic.imgProperty['imgRepeat']) {
            data = _push(_device(v.classic.imgProperty['imgRepeat'], 'background-repeat:{{key}} !important'), data);
        }
        if (v.classic.imgProperty['imgSize']) {
            data = _push(_device(v.classic.imgProperty['imgSize'], 'background-size:{{key}} !important'), data);
        }
        let imgURLVal = v['classic']['img'] !== undefined ? v['classic']['img']['imgURL'] : '';

        simpleData += v.classic['color'] ? 'background:' + v.classic['color'] + ';' : '';
        simpleData += (imgURLVal ? 'background-image:url(' + imgURLVal + ');' : '');

    } else if (v.type === 'gradient' && v.gradient) {
        simpleData += v.gradient ? 'background-image :' + v.gradient + ';background-color:transparent' : '';
    }

    const simple = '{' + simpleData + '}';

    return {lg: data.lg, md: data.md, sm: data.sm, xs: data.xs, simple: simple};
}

// Generate dimension css
const getDimensionCss = (data, cssProperty) => {
    let _css = '';
    let isInportant = '';
    const unit = data.unit || 'px';
    if (data?.important) {
        isInportant = '!important';
    }
    if (data?.isLinked) {
        const value = data.value.split(' ')[0];
        _css = value ? `${cssProperty}:${value}${unit}${isInportant}` : '';
    } else {
        let temp = data.value ? data.value.split(" ") : ['', '', '', ''];
        if (temp[0] === '' || temp[1] === '' || temp[2] === '' || temp[3] === '') {
            if (temp[0]) {
                _css += `${cssProperty}-top:${temp[0]}${temp[0] !== '0' ? unit : ''} ${isInportant};`
            }
            if (temp[1]) {
                _css += `${cssProperty}-right:${temp[1]}${temp[1] !== '0' ? unit : ''} ${isInportant};`
            }
            if (temp[2]) {
                _css += `${cssProperty}-bottom:${temp[2]}${temp[2] !== '0' ? unit : ''} ${isInportant};`
            }
            if (temp[3]) {
                _css += `${cssProperty}-left:${temp[3]}${temp[3] !== '0' ? unit : ''} ${isInportant};`
            }
        } else {
            _css = `${cssProperty}:${temp[0] ? temp[0] : `0`}${unit} ${temp[1] ? temp[1] : `0`}${unit} ${temp[2] ? temp[2] : `0`}${unit} ${temp[3] ? temp[3] : `0`}${unit} ${isInportant};`;
        }
    }
    let overflow = '';
    if (cssProperty === 'border-radius') {
        overflow = 'overflow:hidden;';
    }
    _css = '{' + overflow + _css + '}';
    return _css;
}


// Generate dimension css
const getDimensionBorderCss = (data, cssProperty, postfix = '') => {
    let _css = '';
    const unit = data.unit || 'px';
    if (data?.isLinked) {
        const value = data.value.split(' ')[0];
        _css = `${cssProperty}${postfix}:${value || '0'}${unit} `
    } else {
        let temp = data.value ? data.value.split(" ") : ['0', '0', '0', '0'];
        if (temp[0] === '' || temp[1] === '' || temp[2] === '' || temp[3] === '') {
            if (temp[0]) {
                _css += `${cssProperty}-top${postfix}:${temp[0]}${temp[0] !== '0' ? unit : ''};`
            }
            if (temp[1]) {
                _css += `${cssProperty}-right${postfix}:${temp[1]}${temp[1] !== '0' ? unit : ''};`
            }
            if (temp[2]) {
                _css += `${cssProperty}-bottom${postfix}:${temp[2]}${temp[2] !== '0' ? unit : ''};`
            }
            if (temp[3]) {
                _css += `${cssProperty}-left${postfix}:${temp[3]}${temp[3] !== '0' ? unit : ''};`
            }
        } else {
            _css = `${cssProperty}${postfix}:${temp[0] ? temp[0] : `0`}${unit} ${temp[1] ? temp[1] : `0`}${unit} ${temp[2] ? temp[2] : `0`}${unit} ${temp[3] ? temp[3] : `0`}${unit}`;
        }
    }
    _css = '{' + _css + '}';
    return _css;
}


// CSS cssBorderRadius
export const cssBorderRadius = (v) => {
    return getDimensionCss(v, 'border-radius')
}


// CSS cssPadding
export const cssPadding = (v) => {
    return getDimensionCss(v, 'padding')
}
// CSS cssMargin
export const cssMargin = (v) => {
    return getDimensionCss(v, 'margin')
}

// CSS cssCustomBorder
export const cssCustomBorder = (v) => {
    return getDimensionBorderCss(v, 'border', '-width')
}
// CSS cssCustomBorder


export const cssCustomBorder2 = (v) => {
    let data = '{';
    if (v.width && 'undefined' != v.width) {
        data += `border-width:${v.width} ${v?.important ? '!important' : ''};`;
    }
    if (v.color) {
        data += `border-color:${v.color} ${v?.important ? '!important' : ''};`;
    }
    if (v.color && !v.style) {
        data += `border-style: solid ${v?.important ? '!important' : ''};`;
    } else if (v.style) {
        data += `border-style:${v.style} ${v?.important ? '!important' : ''};`;
    }
    data += '}';
    return data;
}