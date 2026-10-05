const { __ } = wp.i18n;
const { useState, useEffect } = wp.element;
import Range from "./Range";

function Animation(props) {

	const { label, value: data, onChange } = props;

	const setSettings = (val, property) => {
		const newData = JSON.parse(JSON.stringify(data));
		newData[property] = val;
		onChange(newData);
	};

	// const defData = {
	// 	'animateClass': '',
	// 	'speed': 2000,
	// 	'delay': ''
	// }

	return (
		<>

			<div className="rttpg-control-field">

				{label && (
					<span className="rttpg-label">{label}</span>
				)}


				<Range
					label={__("Animation Duration")}
					reset={true}
					value={data['speed']}
					onChange={(val) => setSettings(val, 'speed')}
					min={0}
					max={5000}
					step={1}
				/>

				<Range
					label={__("Animation Delay")}
					reset={true}
					value={data['delay']}
					onChange={(val) => setSettings(val, 'delay')}
					min={0}
					max={5000}
					step={1}
				/>

			</div>

		</>
	);
};

export default Animation;
