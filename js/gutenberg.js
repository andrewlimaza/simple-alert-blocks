
const { __, setLocaleData } = wp.i18n;

const {
	registerBlockType,
} = wp.blocks;

const {
	SelectControl,
	PanelBody,
	CheckboxControl
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

registerBlockType ( 'simple-alerts-for-gutenberg/alert-boxes', {
		title: __( 'Alert Box', 'simple-alerts-for-gutenberg'  ),
		description: __( 'A simple block for alert boxes', 'simple-alerts-for-gutenberg' ),
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
				type: 'string',
			},
			dismiss: {
				type: 'Boolean',
				default: true
			},
		},

        edit: props => {
        	const { attributes: { alert_type, content, dismiss }, setAttributes } = props;
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
    				<CheckboxControl 
    					heading="Please select if the notice should be dismissible."
    					label="Dismissible notice?"
    					help="Show an 'x' and allow users to close this alert."
    					checked={ dismiss }
    					onChange={ dismiss => { setAttributes( { dismiss } ) } }
    				/>
    			</InspectorControls>,
	   			<div className = { "alert alert-" + alert_type } role="alert">
	   			<RichText 
	   					tagName = "p"
	   					className = "content"
	   					value = { content }
	   					onChange = { ( content ) => setAttributes( { content } ) }
	   					placeholder = 'Add text...'
	   					format="string"
	   				/>
	   				{ dismiss === true ? <span className="close" aria-hidden="true" >&times;</span> : null }
	   				</div>
    		]);
        },
        save: props => {
        	const { attributes: { alert_type, content, dismiss } } = props;
       		return (
       			<div className={ "alert alert-" + alert_type } role="alert">
       				<RichText.Content tagname="p" value={content} />
       				{ dismiss === true ? <button type="button" className="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> : null }
	   			</div>
       		);
        },
	}
);