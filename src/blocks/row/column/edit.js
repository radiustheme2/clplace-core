const { useEffect } = wp.element;
import Inspector from "./inspector";
import { CssGenerator } from "../../../utils/css/CssGenerator";
import classnames from "classnames";
import { InnerBlocks, useBlockProps } from "@wordpress/block-editor";
const { select } = wp.data;

function Edit(props) {
	const { isSelected, attributes, setAttributes, clientId, className } = props;

	//block id generate for css
	const {
		uniqueId,
		mainWrapShowHide,
		mainWrapBGOverlayEnable,
		mainWrapAnimation
	} = attributes;

	const editBlockProps = useBlockProps();
	const _client = clientId.substr(0, 6);
	useEffect(() => {
		if (!uniqueId) {
			setAttributes({ uniqueId: _client });
		} else if (uniqueId && uniqueId !== _client) {
			setAttributes({ uniqueId: _client });
		}
	}, []);

	useEffect(() => {
		const sidebarEl = document.querySelector('.interface-interface-skeleton__sidebar');
		sidebarEl.classList.add('tpg-sidebar')
		sidebarEl.classList.remove('tpg-settings-enable')
		sidebarEl.addEventListener('click', function (event) {
			const hasClass = event.target.classList.contains('rttpg-tab-btn');
			if (hasClass) {
				const selectText = event.target.textContent;
				this.classList.remove('tpg-settings-enable')
			}
		})
		sidebarEl.addEventListener('scroll', function (e) {
			if (e.target.scrollTop > 86) {
				this.classList.add('tpg-should-collapse');
			} else {
				this.classList.remove('tpg-should-collapse');
			}
		})

	}, [isSelected]);

	if (uniqueId) {
		CssGenerator(attributes, 'column', uniqueId);
	}

	const { getBlockOrder } = select('core/block-editor');

	//editor all block common wrapper class
	const editWrapClass = classnames([
		'rttpg-block-' + uniqueId,
		className,
		'rttpg-block',
		'rttpg-column',
		'rttpg-block-editor',
		mainWrapBGOverlayEnable ? 'rttpg-overlay' : '',
		mainWrapAnimation['animateClass'],
		mainWrapShowHide.lg ? 'rttpg-hide-desktop' : '',
		mainWrapShowHide.md ? 'rttpg-hide-tablet' : '',
		mainWrapShowHide.sm ? 'rttpg-hide-mobile' : '',
	])

	return [

		isSelected && (
			<Inspector
				attributes={attributes}
				setAttributes={setAttributes}
			/>
		),

		// <div {...editBlockProps}>
		<div className={editWrapClass}>

			<InnerBlocks
				templateLock={false}
				renderAppender={(
					getBlockOrder(clientId).length > 0 ? undefined :
						() => {
							if (getBlockOrder(clientId).length > 0) {
								return null;
							} else {
								return <InnerBlocks.ButtonBlockAppender />
							}
						}
				)}
			/>
		</div>
		// </div>

	]
}

export default Edit;