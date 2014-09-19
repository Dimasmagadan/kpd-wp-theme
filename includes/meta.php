<?php

function os_register_meta_boxes( $meta_boxes ){
	$prefix = 'os_';

	$meta_boxes[] = array(
		'id' => 'standard',
		'title' => __( 'Standard Fields', 'text-domain' ),
		'pages' => array( 'post', 'page' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context' => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority' => 'high',
		// Auto save: true, false (default). Optional.
		// 'autosave' => true,
		'fields' => array(
			// TEXT
			array(
				'name'  => __( 'Text', 'text-domain' ),
				'id'    => $prefix.'text',
				'desc'  => __( 'Text description', 'text-domain' ),
				'type'  => 'text',
				'std'   => __( 'Default text value', 'text-domain' ),
				// 'clone' => true,
			),
			// CHECKBOX
			array(
				'name' => __( 'Checkbox', 'text-domain' ),
				'id'   => $prefix.'checkbox',
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 1,
			),
			// RADIO BUTTONS
			array(
				'name'    => __( 'Radio', 'text-domain' ),
				'id'      => $prefix.'radio',
				'type'    => 'radio',
				// Array of 'value' => 'Label' pairs for radio options.
				// Note: the 'value' is stored in meta field, not the 'Label'
				'options' => array(
					'value1' => __( 'Label1', 'text-domain' ),
					'value2' => __( 'Label2', 'text-domain' ),
				),
			),
			// SELECT BOX
			array(
				'name'     => __( 'Select', 'text-domain' ),
				'id'       => $prefix.'select',
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'value1' => __( 'Label1', 'text-domain' ),
					'value2' => __( 'Label2', 'text-domain' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'value2',
				'placeholder' => __( 'Select an Item', 'text-domain' ),
			),
			// HIDDEN
			array(
				'id'   => $prefix.'hidden',
				'type' => 'hidden',
				// Hidden field must have predefined value
				'std'  => __( 'Hidden value', 'text-domain' ),
			),
			// PASSWORD
			array(
				'name' => __( 'Password', 'text-domain' ),
				'id'   => $prefix.'password',
				'type' => 'password',
			),
			// TEXTAREA
			array(
				'name' => __( 'Textarea', 'text-domain' ),
				'desc' => __( 'Textarea description', 'text-domain' ),
				'id'   => $prefix.'textarea',
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 3,
			),
		),
		'validation' => array(
			'rules' => array(
				$prefix.'password' => array(
					'required'  => true,
					'minlength' => 7,
				),
			),
			// optional override of default jquery.validate messages
			'messages' => array(
				$prefix.'password' => array(
					'required'  => __( 'Password is required', 'text-domain' ),
					'minlength' => __( 'Password must be at least 7 characters', 'text-domain' ),
				),
			)
		)
	);

	// 2nd meta box
	$meta_boxes[] = array(
		'title' => __( 'Advanced Fields', 'text-domain' ),

		'fields' => array(
			// HEADING
			array(
				'type' => 'heading',
				'name' => __( 'Heading', 'text-domain' ),
				'id'   => 'fake_id', // Not used but needed for plugin
			),
			// SLIDER
			array(
				'name' => __( 'Slider', 'text-domain' ),
				'id'   => $prefix.'slider',
				'type' => 'slider',

				// Text labels displayed before and after value
				'prefix' => __( '$', 'text-domain' ),
				'suffix' => __( ' USD', 'text-domain' ),

				// jQuery UI slider options. See here http://api.jqueryui.com/slider/
				'js_options' => array(
					'min'   => 10,
					'max'   => 255,
					'step'  => 5,
				),
			),
			// NUMBER
			array(
				'name' => __( 'Number', 'text-domain' ),
				'id'   => $prefix.'number',
				'type' => 'number',

				'min'  => 0,
				'step' => 5,
			),
			// DATE
			array(
				'name' => __( 'Date picker', 'text-domain' ),
				'id'   => $prefix.'date',
				'type' => 'date',

				// jQuery date picker options. See here http://api.jqueryui.com/datepicker
				'js_options' => array(
					'appendText'      => __( '(yyyy-mm-dd)', 'text-domain' ),
					'dateFormat'      => __( 'yy-mm-dd', 'text-domain' ),
					'changeMonth'     => true,
					'changeYear'      => true,
					'showButtonPanel' => true,
				),
			),
			// DATETIME
			array(
				'name' => __( 'Datetime picker', 'text-domain' ),
				'id'   => $prefix . 'datetime',
				'type' => 'datetime',

				// jQuery datetime picker options.
				// For date options, see here http://api.jqueryui.com/datepicker
				// For time options, see here http://trentrichardson.com/examples/timepicker/
				'js_options' => array(
					'stepMinute'     => 15,
					'showTimepicker' => true,
				),
			),
			// TIME
			array(
				'name' => __( 'Time picker', 'text-domain' ),
				'id'   => $prefix . 'time',
				'type' => 'time',

				// jQuery datetime picker options.
				// For date options, see here http://api.jqueryui.com/datepicker
				// For time options, see here http://trentrichardson.com/examples/timepicker/
				'js_options' => array(
					'stepMinute' => 5,
					'showSecond' => true,
					'stepSecond' => 10,
				),
			),
			// COLOR
			array(
				'name' => __( 'Color picker', 'text-domain' ),
				'id'   => $prefix.'color',
				'type' => 'color',
			),
			// CHECKBOX LIST
			array(
				'name' => __( 'Checkbox list', 'text-domain' ),
				'id'   => $prefix.'checkbox_list',
				'type' => 'checkbox_list',
				// Options of checkboxes, in format 'value' => 'Label'
				'options' => array(
					'value1' => __( 'Label1', 'text-domain' ),
					'value2' => __( 'Label2', 'text-domain' ),
				),
			),
			// EMAIL
			array(
				'name'  => __( 'Email', 'text-domain' ),
				'id'    => $prefix.'email',
				'desc'  => __( 'Email description', 'text-domain' ),
				'type'  => 'email',
				'std'   => 'name@email.com',
			),
			// RANGE
			array(
				'name'  => __( 'Range', 'text-domain' ),
				'id'    => $prefix.'range',
				'desc'  => __( 'Range description', 'text-domain' ),
				'type'  => 'range',
				'min'   => 0,
				'max'   => 100,
				'step'  => 5,
				'std'   => 0,
			),
			// URL
			array(
				'name'  => __( 'URL', 'text-domain' ),
				'id'    => $prefix.'url',
				'desc'  => __( 'URL description', 'text-domain' ),
				'type'  => 'url',
				'std'   => 'http://google.com',
			),
			// OEMBED
			array(
				'name'  => __( 'oEmbed', 'text-domain' ),
				'id'    => $prefix.'oembed',
				'desc'  => __( 'oEmbed description', 'text-domain' ),
				'type'  => 'oembed',
			),
			// SELECT ADVANCED BOX
			array(
				'name'     => __( 'Select', 'text-domain' ),
				'id'       => $prefix.'select_advanced',
				'type'     => 'select_advanced',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'value1' => __( 'Label1', 'text-domain' ),
					'value2' => __( 'Label2', 'text-domain' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				// 'std'         => 'value2', // Default value, optional
				'placeholder' => __( 'Select an Item', 'text-domain' ),
			),
			// TAXONOMY
			array(
				'name'    => __( 'Taxonomy', 'text-domain' ),
				'id'      => $prefix.'taxonomy',
				'type'    => 'taxonomy',
				'options' => array(
					// Taxonomy name
					'taxonomy' => 'category',
					// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
					'type' => 'checkbox_list',
					// Additional arguments for get_terms() function. Optional
					'args' => array()
				),
			),
			// POST
			array(
				'name'    => __( 'Posts (Pages)', 'text-domain' ),
				'id'      => $prefix.'pages',
				'type'    => 'post',

				// Post type
				'post_type' => 'page',
				// Field type, either 'select' or 'select_advanced' (default)
				'field_type' => 'select_advanced',
				// Query arguments (optional). No settings means get all published posts
				'query_args' => array(
					'post_status'    => 'publish',
					'posts_per_page' => - 1,
				)
			),
			// WYSIWYG/RICH TEXT EDITOR
			array(
				'name' => __( 'WYSIWYG / Rich Text Editor', 'text-domain' ),
				'id'   => $prefix.'wysiwyg',
				'type' => 'wysiwyg',
				// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
				'raw'  => false,
				'std'  => __( 'WYSIWYG default value', 'text-domain' ),

				// Editor settings, see wp_editor() function: look4wp.com/wp_editor
				'options' => array(
					'textarea_rows' => 4,
					'teeny'         => true,
					'media_buttons' => false,
				),
			),
			// DIVIDER
			array(
				'type' => 'divider',
				'id'   => 'fake_divider_id', // Not used, but needed
			),
			// FILE UPLOAD
			array(
				'name' => __( 'File Upload', 'text-domain' ),
				'id'   => $prefix.'file',
				'type' => 'file',
			),
			// FILE ADVANCED (WP 3.5+)
			array(
				'name' => __( 'File Advanced Upload', 'text-domain' ),
				'id'   => $prefix.'file_advanced',
				'type' => 'file_advanced',
				'max_file_uploads' => 4,
				'mime_type' => 'application,audio,video', // Leave blank for all file types
			),
			// IMAGE UPLOAD
			array(
				'name' => __( 'Image Upload', 'text-domain' ),
				'id'   => $prefix.'image',
				'type' => 'image',
			),
			// THICKBOX IMAGE UPLOAD (WP 3.3+)
			array(
				'name' => __( 'Thickbox Image Upload', 'text-domain' ),
				'id'   => $prefix.'thickbox',
				'type' => 'thickbox_image',
			),
			// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
			array(
				'name'             => __( 'Plupload Image Upload', 'text-domain' ),
				'id'               => $prefix.'plupload',
				'type'             => 'plupload_image',
				'max_file_uploads' => 4,
			),
			// IMAGE ADVANCED (WP 3.5+)
			array(
				'name'             => __( 'Image Advanced Upload', 'text-domain' ),
				'id'               => $prefix.'imgadv',
				'type'             => 'image_advanced',
				'max_file_uploads' => 4,
			),
			// BUTTON
			array(
				'id'   => $prefix.'button',
				'type' => 'button',
				'name' => ' ', // Empty name will "align" the button to all field inputs
			),
		)
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'os_register_meta_boxes' );

