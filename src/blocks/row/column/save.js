import classnames from 'classnames';
import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

export default function save(props) {
	const {
		uniqueId,
		mainWrapShowHide,
		mainWrapAnimation,
		mainWrapBGOverlayEnable
	} = props.attributes;

	const saveBlockProps = useBlockProps.save();

	//editor all block common wrapper class
	const editWrapClass = classnames([
		'rttpg-block-postgrid',
		'rttpg-block-' + uniqueId,
		saveBlockProps.className,
		'rttpg-block',
		'rttpg-column',
		mainWrapBGOverlayEnable ? 'rttpg-overlay' : '',
		'rttpg-block-frontend',
		mainWrapAnimation['animateClass'],
		mainWrapShowHide.lg ? 'rttpg-hide-desktop' : '',
		mainWrapShowHide.md ? 'rttpg-hide-tablet' : '',
		mainWrapShowHide.sm ? 'rttpg-hide-mobile' : '',
	])

	return (
		<div className={editWrapClass}>
			<InnerBlocks.Content />
		</div>
	);

}

