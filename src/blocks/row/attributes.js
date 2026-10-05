const attributes = {
	uniqueId: {
		type: "string",
		default: ""
	},
	preview: {
		type: "boolean",
		default: false
	},

	align: {
		type: 'string',
		default: 'full'
	},
	columns: {
		type: 'number',
		default: ''
	},

	gutterX: {
		type: 'object',
		default: {
			lg: 20,
			md: 20,
			sm: 20,
			unit: 'px'
		},
	},
	gutterY: {
		type: 'object',
		default: {
			lg: 20,
			md: 20,
			sm: 20,
			unit: 'px'
		},
	},

	innerContainerWidth: {
		type: 'object',
		default: {
			lg: 1200,
			md: 1024,
			sm: 767,
			unit: 'px'
		},
		style: [{
			selector: '{{CLPLACE}}.rttpg-block .rttpg-container {max-width:{{innerContainerWidth}};}'
		}]
	},

	alignItem: {
		type: 'object',
		default: {
			lg: '',
		},
		style: [{
			selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap.rttpg-block-editor  > .rttpg-container > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout, ' +
				'{{CLPLACE}}.rttpg-block.rttpg-row-wrap.rttpg-block-frontend .rttpg-container .rttpg-row {align-items: {{alignItem}};}'
		}]
	},

	justifyContent: {
		type: 'object',
		default: {
			lg: '',
		},
		style: [{
			selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap.rttpg-block-editor > .rttpg-container > .rttpg-row > .block-editor-inner-blocks > .block-editor-block-list__layout, {{CLPLACE}}.rttpg-block.rttpg-row-wrap.rttpg-block-frontend .rttpg-container .rttpg-row {justify-content: {{justifyContent}};}'
		}]
	},

	wrapperTag: {
		type: 'string',
		default: 'div'
	},

	//advance style

	rowMarginTop: {
		type: 'object',
		default: {
			lg: '',
			unit: 'px'
		},
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap {margin-top: {{rowMarginTop}};}' }]
	},
	rowMarginBottom: {
		type: 'object',
		default: {
			lg: '',
			unit: 'px'
		},
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap {margin-bottom: {{rowMarginBottom}};}' }]
	},

	mainWrapMargin: {
		type: "object",
		default: {
			lg: {
				isLinked: true,
				unit: "px",
				value: ""
			}
		},
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap {{mainWrapMargin}}' }]
	},

	mainWrapPadding: {
		type: "object",
		default: {
			lg: {
				isLinked: false,
				unit: "px",
				value: ""
			},
			md: {
				isLinked: false,
				unit: "px",
				value: ""
			},
			sm: {
				isLinked: false,
				unit: "px",
				value: ""
			}

		},
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap {{mainWrapPadding}}' }]
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
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap' }]
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
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap:hover' }]
	},

	mainWrapHoverBGTransition: {
		type: "number",
		default: 0.5,
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap {transition: background {{mainWrapHoverBGTransition}}s;}' }]
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
			selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap:before'
		}]
	},
	mainWrapBGOverlayOpacity: {
		type: "number",
		default: 0.5,
		style: [{
			depends: [{ key: 'mainWrapBGOverlayEnable', condition: '==', value: true, }],
			selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap::before{opacity:{{mainWrapBGOverlayOpacity}};}'
		}]
	},

	mainWrapBGOverlayZindex: {
		type: "number",
		default: 1,
		style: [{
			depends: [{ key: 'mainWrapBGOverlayEnable', condition: '==', value: true, }],
			selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap{--row-overlay-z-index:{{mainWrapBGOverlayZindex}};}'
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
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap {border-style: {{mainWrapBorderStyle}};}' }]
	},
	mainWrapBorderColor: {
		type: "string",
		default: "",
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap {border-color: {{mainWrapBorderColor}};}' }]
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
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap {{mainWrapBorderWidth}}' }]
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
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap {{mainWrapRadius}}' }]
	},
	mainWrapHoverBorderStyle: {
		type: "string",
		default: "",
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap:hover {{mainWrapHoverBorderStyle}}' }]
	},
	mainWrapHoverBorderColor: {
		type: "string",
		default: "",
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap:hover  {{mainWrapHoverBorderColor}}' }]
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
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap:hover {{mainWrapHoverBorderWidth}}' }]
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
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap:hover{{mainWrapHoverRadius}}' }]
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
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap' }]
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
		style: [{ selector: '{{CLPLACE}}.rttpg-block.rttpg-row-wrap:hover' }]
	},

	//advanced
	mainWrapShowHide: {
		type: "object",
		default: {
			lg: false,
			md: false,
			sm: false
		}
	}
}

export default attributes;