
const { __, setLocaleData } = wp.i18n;

const {
	registerBlockType,
} = wp.blocks;

const {
	SelectControl,
	PanelBody,
} = wp.components;

const { 
	InspectorControls,
	RichText,
} = wp.editor;

// Available alert types for a dropdown setting.
const all_types = [
	{ value: 'primary', label: 'Primary' },
	{ value: 'secondary', label: 'Secondary' },
	{ value: 'success', label: 'Success' },
	{ value: 'warning', label: 'Warning' },
	{ value: 'danger', label: 'Danger' },
	{ value: 'info', label: 'Info' },
	{ value: 'light', label: 'Light' },
	{ value: 'dark', label: 'Dark' },

];

registerBlockType ( 'simple-bootstrap-alerts-for-gutenberg/alert-boxes', {
		title: __( 'Alert Box', 'simple-bootstrap-alerts-for-gutenberg'  ),
		description: __( 'A simple block for Bootstrap alert boxes', 'simple-bootstrap-alerts-for-gutenberg' ),
		category: 'layout',
		icon: {
			src: 'smiley',
			background: '#cce5ff',
			foreground: '#004085',
		},
		attributes: {
			alert_type: {
				type: 'string',
				default: 'primary'
			},
			content: {
				type: 'array',
				source: 'children',
				selector: 'p'
			}
		},

        edit: props => {
        	const { attributes: { alert_type, content }, setAttributes } = props;

    		return ([
    			<InspectorControls>
    				<PanelBody>
    					<SelectControl
    						label = 'Please select the type of alert you want to display.'
    						options = { all_types } 
  							value = { alert_type }
  							onChange = { alert_type => { setAttributes( { alert_type } ) } }
    					/>
    				</PanelBody>
    			</InspectorControls>,
	   			<div className = { "alert alert-" + alert_type }>
	   				<RichText 
	   					className = "content"
	   					value = { content }
	   					onChange = { content => { setAttributes( { content } ) } }
	   					placeholder = 'Add text...'
	   				/>
	   			</div>
    		]);
        },

        save: props => {
        	const { attributes: { alert_type, content } } = props;
       		return (
       			<div className={ "alert alert-" + alert_type }>{ content }</div>
       		);
        },
	}
);