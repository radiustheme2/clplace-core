//Internal dependencies
const { __ } = wp.i18n;
import rowIcons from './icons';
const variations = [

	{
		name: 'one-column',
		label: __('One column', 'clplace-core'),
		icon: rowIcons['100'],
		attributes: {
			columns: 1,
			layout: '100',
		},
		innerBlocks: [
			['rttpg/column', { colWidth: { lg: 100, md: 100, sm: 100, unit: '%' } }]
		],
		scope: ['block'],
	},

	{
		name: 'two-column',
		label: __('Two columns', 'clplace-core'),
		icon: rowIcons['50-50'],
		attributes: {
			columns: 2,
			layout: '50-50',
		},
		isDefault: true,
		innerBlocks: [
			['rttpg/column', { colWidth: { lg: 50, md: 50, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 50, md: 50, sm: 100, unit: '%' } }],
		],
		scope: ['block'],
	},

	{
		name: 'three-columns',
		label: __('Three columns',
			'clplace-core'
		),
		icon: rowIcons['33-33-33'],
		attributes: {
			columns: 3,
		},
		innerBlocks: [
			['rttpg/column', { colWidth: { lg: 33.33, md: 33.33, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 33.33, md: 33.33, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 33.33, md: 33.33, sm: 100, unit: '%' } }],
		],
		scope: ['block'],
	},
	{
		name: 'four-columns',
		label: __('Four columns', 'clplace-core'),
		icon: rowIcons['25-25-25-25'],
		attributes: {
			columns: 4,
		},
		innerBlocks: [
			['rttpg/column', { colWidth: { lg: 25, md: 25, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 25, md: 25, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 25, md: 25, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 25, md: 25, sm: 100, unit: '%' } }],
		],
		scope: ['block'],
	},
	{
		name: 'two-column-25-75',
		label: __('Two column 25-75', 'clplace-core'),
		icon: rowIcons['25-75'],
		attributes: {
			columns: 2,
		},
		innerBlocks: [
			['rttpg/column', { colWidth: { lg: 25, md: 25, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 75, md: 75, sm: 100, unit: '%' } }],
		],
		scope: ['block'],
	},
	{
		name: 'two-column-75-25',
		label: __('Two column 75-25', 'clplace-core'),
		icon: rowIcons['75-25'],
		attributes: {
			columns: 2,
		},
		innerBlocks: [
			['rttpg/column', { colWidth: { lg: 75, md: 75, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 25, md: 25, sm: 100, unit: '%' } }],
		],
		scope: ['block'],
	},

	{
		name: 'three-column-25-25-50',
		label: __('Three column 25-25-50', 'clplace-core'),
		icon: rowIcons['25-25-50'],
		attributes: {
			columns: 3,
		},
		innerBlocks: [
			['rttpg/column', { colWidth: { lg: 25, md: 25, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 25, md: 25, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 50, md: 50, sm: 100, unit: '%' } }],
		],
		scope: ['block'],
	},

	{
		name: 'three-column-50-25-25',
		label: __('Three column 50-25-25', 'clplace-core'),
		icon: rowIcons['50-25-25'],
		attributes: {
			columns: 3,
		},
		innerBlocks: [
			['rttpg/column', { colWidth: { lg: 50, md: 50, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 25, md: 25, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 25, md: 25, sm: 100, unit: '%' } }],
		],
		scope: ['block'],
	},

	{
		name: 'three-column-25-50-25',
		label: __('Three column 25-50-25', 'clplace-core'),
		icon: rowIcons['25-50-25'],
		attributes: {
			columns: 3,
		},
		innerBlocks: [
			['rttpg/column', { colWidth: { lg: 25, md: 25, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 50, md: 50, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 25, md: 25, sm: 100, unit: '%' } }],
		],
		scope: ['block'],
	},

	{
		name: 'five-column-20-20-20-20-20',
		label: __('Five column 20-20-20-20-20', 'clplace-core'),
		icon: rowIcons['20-20-20-20-20'],
		attributes: {
			columns: 5,
		},
		innerBlocks: [
			['rttpg/column', { colWidth: { lg: 20, md: 20, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 20, md: 20, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 20, md: 20, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 20, md: 20, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 20, md: 20, sm: 100, unit: '%' } }],
		],
		scope: ['block'],
	},

	{
		name: 'six-column-16-16-16-16-16-16',
		label: __('Five column 16-16-16-16-16-16', 'clplace-core'),
		icon: rowIcons['16-16-16-16-16-16'],
		attributes: {
			columns: 6,
		},
		innerBlocks: [
			['rttpg/column', { colWidth: { lg: 16.66, md: 16.66, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 16.66, md: 16.66, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 16.66, md: 16.66, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 16.66, md: 16.66, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 16.66, md: 16.66, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 16.66, md: 16.66, sm: 100, unit: '%' } }],
		],
		scope: ['block'],
	},

	{
		name: 'three-column-16-66-16',
		label: __('Five column 16-66-16', 'clplace-core'),
		icon: rowIcons['16-66-16'],
		attributes: {
			columns: 3,
		},
		innerBlocks: [
			['rttpg/column', { colWidth: { lg: 16.66, md: 16.66, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 66.68, md: 66.68, sm: 100, unit: '%' } }],
			['rttpg/column', { colWidth: { lg: 16.66, md: 16.66, sm: 100, unit: '%' } }],
		],
		scope: ['block'],
	},




];

export default variations;
