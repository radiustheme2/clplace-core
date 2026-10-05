const attributes = {
	uniqueId: {
		type: "string",
		default: ""
	},

	colWidth: {
		type: 'object',
		default: {
			lg: 100,
			md: 100,
			sm: 100,
			unit: '%'
		},
		style: [
			{ selector: '.rttpg-body-wrap .block-editor-block-list__block [id*="{{CLPLACE_ID}}"], ' +
					'.rttpg-row-wrap {{CLPLACE}}.rttpg-block.rttpg-block-frontend {max-width:{{colWidth}};flex:0 0 {{colWidth}};}' }
		]
	},

	//advance style
	mainWrapMargin: {
		type: "object",
		default: {
			lg: {
				isLinked: true,
				unit: "px",
				value: ""
			}
		},
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div , .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column {{mainWrapMargin}}' }]
	},

	mainWrapPadding: {
		type: "object",
		default: {
			lg: {
				isLinked: true,
				unit: "px",
				value: ""
			},
			md: {
				isLinked: true,
				unit: "px",
				value: ""
			},
			sm: {
				isLinked: true,
				unit: "px",
				value: ""
			}

		},
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div , .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column {{mainWrapPadding}}' }]
	},

	mainWrapBG: {
		type: "object",
		default: {
			openBGColor: 0,
			type: 'classic',
			classic: {
				color: '',
				img: {
					imgURL: '',
					imgID: '',
				},
				imgProperty: {
					imgPosition: {
						lg: '',
					},
					imgAttachment: {
						lg: '',
					},
					imgRepeat: {
						lg: '',
					},
					imgSize: {
						lg: '',
					},
				},
			},
			gradient: '',
		},
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div , .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column' }]
	},

	mainWrapHoverBG: {
		type: "object",
		default: {
			openBGColor: 0,
			type: 'classic',
			classic: {
				color: '',
				img: {
					imgURL: '',
					imgID: '',
				},
				imgProperty: {
					imgPosition: {
						lg: '',
					},
					imgAttachment: {
						lg: '',
					},
					imgRepeat: {
						lg: '',
					},
					imgSize: {
						lg: '',
					},
				},
			},
			gradient: '',
		},
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div :hover, .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column:hover' }]
	},

	mainWrapHoverBGTransition: {
		type: "number",
		default: 0.5,
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div , .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column {transition: background {{mainWrapHoverBGTransition}}s;}' }]
	},

	mainWrapBGOverlay: {
		type: "object",
		default: {
			openBGColor: 0,
			type: 'classic',
			classic: {
				color: '',
				img: {
					imgURL: '',
					imgID: '',
				},
				imgProperty: {
					imgPosition: {
						lg: '',
					},
					imgAttachment: {
						lg: '',
					},
					imgRepeat: {
						lg: '',
					},
					imgSize: {
						lg: '',
					},
				},
			},
			gradient: '',
		},
		style: [{
			depends: [{ key: 'mainWrapBGOverlayEnable', condition: '==', value: true, }],
			selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div::before, .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column::before'
		}]
	},
	mainWrapBGOverlayOpacity: {
		type: "number",
		default: 0.5,
		style: [{
			depends: [{ key: 'mainWrapBGOverlayEnable', condition: '==', value: true, }],
			selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div::before, .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column::before{opacity:{{mainWrapBGOverlayOpacity}};}'
		}]
	},

	mainWrapBGOverlayZindex: {
		type: "number",
		default: 1,
		style: [{
			depends: [{ key: 'mainWrapBGOverlayEnable', condition: '==', value: true, }],
			selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div::before, .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column{--column-overlay-z-index:{{mainWrapBGOverlayZindex}};}'
		}]
	},

	mainWrapBGOverlayEnable: {
		type: "boolean",
		default: false
	},

	mainWrapBGType: {
		type: "string",
		default: "normal"
	},
	mainWrapBorderType: {
		type: "string",
		default: "normal"
	},
	mainWrapBorderStyle: {
		type: "string",
		default: "",
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div , .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column {border-style: {{mainWrapBorderStyle}};}' }]
	},
	mainWrapBorderColor: {
		type: "string",
		default: "",
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div , .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column {border-color: {{mainWrapBorderColor}};}' }]
	},
	mainWrapBorderWidth: {
		type: "object",
		default: {
			lg: {
				isLinked: true,
				unit: "px",
				value: ""
			}
		},
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div , .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column {{mainWrapBorderWidth}}' }]
	},
	mainWrapRadius: {
		type: "object",
		default: {
			lg: {
				isLinked: true,
				unit: "px",
				value: ""
			}
		},
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div , .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column {{mainWrapRadius}}' }]
	},
	mainWrapHoverBorderStyle: {
		type: "string",
		default: "",
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div :hover, .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column:hover {{mainWrapHoverBorderStyle}}' }]
	},
	mainWrapHoverBorderColor: {
		type: "string",
		default: "",
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div :hover, .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column:hover  {{mainWrapHoverBorderColor}}' }]
	},
	mainWrapHoverBorderWidth: {
		type: "object",
		default: {
			lg: {
				isLinked: true,
				unit: "px",
				value: ""
			}
		},
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div :hover, .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column:hover {{mainWrapHoverBorderWidth}}' }]
	},
	mainWrapHoverRadius: {
		type: "object",
		default: {
			lg: {
				isLinked: true,
				unit: "px",
				value: ""
			}
		},
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div :hover, .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column:hover{{mainWrapHoverRadius}}' }]
	},

	mainWrapShadowType: {
		type: "string",
		default: "normal"
	},

	mainWrapShadow: {
		type: "object",
		default: {
			openShadow: 1,
			width: {
				top: 1,
				right: 1,
				bottom: 1,
				left: 1,
			},
			color: '',
			inset: false,
			transition: 0.5,
		},
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div , .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column' }]
	},

	mainWrapHoverShadow: {
		type: "object",
		default: {
			openShadow: 1,
			width: {
				top: 1,
				right: 1,
				bottom: 1,
				left: 1,
			},
			color: '',
			inset: false,
			transition: 0.5,
		},
		style: [{ selector: '.rttpg-row-wrap.rttpg-block-editor > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout >  [id*="{{CLPLACE_ID}}"] > div :hover, .rttpg-row-wrap.rttpg-block-frontend {{CLPLACE}}.rttpg-block.rttpg-column:hover' }]
	},

	//advanced
	mainWrapShowHide: {
		type: "object",
		default: {
			lg: false,
			md: false,
			sm: false
		}
	},

	mainWrapAnimation: {
		type: "object",
		default: {
			openAnimate: 1,
			animateClass: '',
			speed: 1200,
			delay: ''
		},
		style: [{ selector: '.rttpg-row-wrap {{CLPLACE}}.rttpg-block.rt__animated' }]
	}


}

export default attributes;