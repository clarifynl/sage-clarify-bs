import {__} from '@wordpress/i18n';
import {registerBlockType} from '@wordpress/blocks';
import {InnerBlocks, useBlockProps} from '@wordpress/block-editor';

registerBlockType('sage/inner-blocks', {
	apiVersion: 2,
	title: __('Inner Blocks'),
	description: __('Block for inserting inner blocks'),
	icon: 'tagcloud',
	category: 'layout',
	example: {
		innerBlocks: [{
			name: 'core/paragraph'
		}]
	},
	edit: () => {
		const blockProps = useBlockProps();

		return (
			<div {...blockProps}>
				<InnerBlocks
					templateLock={false}
					renderAppender={() => <InnerBlocks.ButtonBlockAppender />}
				/>
			</div>
		);
	},
	save: () => {
		const blockProps = useBlockProps.save();

		return (
			<div {...blockProps}>
				<InnerBlocks.Content/>
			</div>
		);
	}
});