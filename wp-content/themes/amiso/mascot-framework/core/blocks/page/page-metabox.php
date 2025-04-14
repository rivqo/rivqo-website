<?php
add_filter( 'rwmb_meta_boxes', 'amiso_page_metaboxes' );

/**
 * Register meta boxes
 *
 * @param array $meta_boxes
 *
 * @return array
 */
function amiso_page_metaboxes( $meta_boxes ) {
	//list active sidebars
	$active_sidebar_list = array();
	$active_sidebar_list[ 'inherit' ] = esc_html__( 'Inherit from Theme Options', 'amiso' );
	global $wp_registered_sidebars;
	foreach ( $wp_registered_sidebars as $key => $value ) {
		$active_sidebar_list[ $key ] = $value['name'];
	}

	//get primary thme location menu item
	$theme_locations = get_nav_menu_locations();
	$primary_nav_menu_name = 'none';
	if( array_key_exists('primary', $theme_locations) && !empty($theme_locations['primary']) ) {
		$primary_nav_menu_obj = get_term( $theme_locations['primary'], 'nav_menu' );
		$primary_nav_menu_name = $primary_nav_menu_obj->name;
	}

	//ALL custom post types
	//$post_types = get_post_types();

	//Get a List of All Revolution Slider Aliases
	//revslider version 6
	$list_rev_sliders = array();
	if ( class_exists( 'RevSliderSlider' ) ) {
		$list_rev_sliders[0] = esc_html__( 'Select a Slider', 'amiso' );
		$rev_slider = new RevSliderSlider();
		$all_rev_sliders = $rev_slider->get_sliders();
		foreach ( $all_rev_sliders as $each_slide ) {
			$list_rev_sliders[$each_slide->id] = $each_slide->alias;
		}
	}


	//Get a List of All Layer Slider Aliases
	$list_layer_sliders = array();
	if ( class_exists( 'LS_Sliders' ) ) {
		$list_layer_sliders[0] = esc_html__( 'Select a Slider', 'amiso' );
		$LS_Sliders_list = LS_Sliders::find();
		foreach ( $LS_Sliders_list as $each_slide ) {
			$list_layer_sliders[ $each_slide['id'] ] = $each_slide['name'];
		}
	}


	// Background Patterns Reader
	$sample_patterns_path = AMISO_ADMIN_ASSETS_DIR . '/images/pattern/';
	$sample_patterns_url  = AMISO_ADMIN_ASSETS_URI . '/images/pattern/';
	$sample_patterns      = array();

	if ( is_dir( $sample_patterns_path ) ) {

		if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
			$sample_patterns = array();

			while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

				if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
					$name              = explode( '.', $sample_patterns_file );
					$name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
					$sample_patterns[$sample_patterns_url . $sample_patterns_file] = $sample_patterns_url . $sample_patterns_file;
				}
			}
		}
	}


	$text_align_array = array(
		'inherit'			=> esc_html__( 'Inherit from Theme Options', 'amiso' ),
		'text-left flip'	=> esc_html__( 'Left', 'amiso' ),
		'text-center'		=> esc_html__( 'Center', 'amiso' ),
		'text-right flip'	=> esc_html__( 'Right', 'amiso' ),
	);

	// Page Sidebar
	$meta_boxes[] = array(
		'id'			=> 'page_sidebar',
		'title'			=> esc_html__( 'Page Sidebar', 'amiso' ),
		'post_types'	=> array( 'post', 'page', 'portfolio', 'campaign' ),
		'context'		=> 'side',
		'priority'		=> 'low',
		// Sub-fields
		'fields'		=> array(
			array(
				'id'     => 'amiso_' . 'page_mb_sidebar_layout_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// Sub-fields
				'fields' => array(
					array(
						'name'		=> esc_html__( 'Sidebar Layout', 'amiso' ),
						'id'		=> 'sidebar_layout',
						'type'		=> 'image_select',
						'options' 	=> array(
							'inherit'				=> AMISO_ADMIN_ASSETS_URI . '/images/sidebar/inherit.png',
							'sidebar-right-25'		=> AMISO_ADMIN_ASSETS_URI . '/images/sidebar/sidebar-right-25.png',
							'sidebar-right-33'		=> AMISO_ADMIN_ASSETS_URI . '/images/sidebar/sidebar-right-33.png',
							'no-sidebar'			=> AMISO_ADMIN_ASSETS_URI . '/images/sidebar/no-sidebar.png',
							'sidebar-left-25'		=> AMISO_ADMIN_ASSETS_URI . '/images/sidebar/sidebar-left-25.png',
							'sidebar-left-33'		=> AMISO_ADMIN_ASSETS_URI . '/images/sidebar/sidebar-left-33.png',
							'both-sidebar-25-50-25' => AMISO_ADMIN_ASSETS_URI . '/images/sidebar/both-sidebar-25-50-25.png',
						),
						'std'		=> 'inherit',
					),
					array(
						'name'		=> esc_html__( 'Pick Sidebar Default', 'amiso' ),
						'id'		=> 'sidebar_default',
						'type'		=> 'select',
						'options'	=> $active_sidebar_list,
					),
					array(
						'type' 		=> 'heading',
						'name' 		=> esc_html__( 'Sidebar 2 Settings', 'amiso' ),
						'desc'		=> esc_html__( 'Sidebar 2 will only be used if "Sidebar Both Side" is selected.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Pick Sidebar 2', 'amiso' ),
						'id'		=> 'sidebar_two',
						'type'		=> 'select',
						'options'   => $active_sidebar_list,
					),
					array(
						'name'		=> esc_html__( 'Sidebar 2 Position', 'amiso' ),
						'id'		=> 'sidebar_two_position',
						'type'		=> 'select',
						'desc'		=> esc_html__( 'Controls the position of sidebar 2. In that case, sidebar 1 will be shown on opposite side.', 'amiso' ),
						'options'	=> array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'left'		=> esc_html__( 'Left', 'amiso' ),
							'right'	 	=> esc_html__( 'Right', 'amiso' )
						),
					),
				),
			),
		),
	);

	// Meta Box Settings for this Page
	$meta_boxes[] = array(
		'title'	 => esc_html__( 'Page Settings', 'amiso' ),
		'post_types' => array( 'post', 'page', 'portfolio', 'campaign' ),
		'priority'   => 'high',

		// List of tabs, in one of the following formats:
		// 1) key => label
		// 2) key => array( 'label' => Tab label, 'icon' => Tab icon )
		'tabs'		=> array(


			'header'  => array(
				'label' => esc_html__( 'Header', 'amiso' ),
				'icon'  => 'dashicons-arrow-up-alt', // Dashicon
			),
			'theme-color' => array(
				'label' => esc_html__( 'Theme Color Settings', 'amiso' ),
				'icon'  => 'dashicons-art', // Dashicon
			),
			'typography-setting' => array(
				'label' => esc_html__( 'Typography Settings', 'amiso' ),
				'icon'  => 'dashicons-editor-bold', // Dashicon
			),
			'logo' => array(
				'label' => esc_html__( 'Logo', 'amiso' ),
				'icon'  => 'dashicons-palmtree', // Dashicon
			),
			'page-title'		=> array(
				'label' => esc_html__( 'Page Title', 'amiso' ),
				'icon'  => 'dashicons-archive', // Dashicon
			),
			'layout-setings'	=> array(
				'label' => esc_html__( 'Layout Settings', 'amiso' ),
				'icon'  => 'dashicons-editor-table', // Dashicon
			),
			'footer'	=> array(
				'label' => esc_html__( 'Footer Settings', 'amiso' ),
				'icon'  => 'dashicons-arrow-down-alt', // Dashicon
			),
			'slider' => array(
				'label' => esc_html__( 'Slider Settings', 'amiso' ),
				'icon'  => 'dashicons-update', // Dashicon
			),
			'general' => array(
				'label' => esc_html__( 'General Settings', 'amiso' ),
				'icon'  => 'dashicons-admin-home', // Dashicon
			),
		),

		// Tab style: 'default', 'box' or 'left'. Optional
		'tab_style' => 'left',

		// Show meta box wrapper around tabs? true (default) or false. Optional
		'tab_wrapper' => true,

		'fields'	=> array(


			//Header tab starts
			array(
				'id'     => 'amiso_' . 'page_mb_header_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'header',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Header', 'amiso' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Header Visibility', 'amiso' ),
						'id'		=> 'header_visibility',
						'type'		=> 'select',
						'desc'		=> esc_html__( 'Show or hide complete header only for this page.', 'amiso' ),
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'   		=> esc_html__( 'Show', 'amiso' ),
							'0' 		=> esc_html__( 'Hide', 'amiso' ),
						),
					),



					// DIVIDER
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Header  (Built with Elementor)', 'amiso' ),
					),

					array(
						'name' => esc_html__( 'Choose Header (Elementor)', 'amiso' ),
						'desc' => sprintf(esc_html__('Made using Elementor. Create your own one from %s', 'amiso'), '<a href="'.admin_url('edit.php?post_type=header-top').'" target="_blank">Dashboard > Parts - Header Top</a>'),
						'id'          => 'headertop_cpt_elementor',
						'type'        => 'post',

						// Post type.
						'post_type'   => 'header-top',

						// Field type.
						'field_type'  => 'select_advanced',

						// Placeholder, inherited from `select_advanced` field.
						'placeholder' => esc_html__( 'Select a Pre Made Header', 'amiso' ),

						// Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
						'query_args'  => array(
							'post_status'    => 'publish',
							'posts_per_page' => - 1,
						),
					),

					array(
						'name' => esc_html__( 'Or Choose Transparent Header (Elementor)', 'amiso' ),
						'desc' => esc_html__( 'Made From Custom Post Type by using Elementor.', 'amiso' ),
						'id'          => 'headertop_cpt_elementor_transparent',
						'type'        => 'post',

						// Post type.
						'post_type'   => 'header-top',

						// Field type.
						'field_type'  => 'select_advanced',

						// Placeholder, inherited from `select_advanced` field.
						'placeholder' => esc_html__( 'Select a Pre Made Header', 'amiso' ),

						// Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
						'query_args'  => array(
							'post_status'    => 'publish',
							'posts_per_page' => - 1,
						),
					),

					array(
						'name' => esc_html__( 'Choose Header Sticky (Elementor)', 'amiso' ),
						'desc' => esc_html__( 'It will be shown when you scroll down. Made From Custom Post Type by using Elementor.', 'amiso' ),
						'id'          => 'headertop_cpt_elementor_sticky',
						'type'        => 'post',

						// Post type.
						'post_type'   => 'header-top',

						// Field type.
						'field_type'  => 'select_advanced',

						// Placeholder, inherited from `select_advanced` field.
						'placeholder' => esc_html__( 'Select a Pre Made Sticky Header', 'amiso' ),

						// Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
						'query_args'  => array(
							'post_status'    => 'publish',
							'posts_per_page' => - 1,
						),
					),

					array(
						'name' => esc_html__( 'Choose Header Mobile/Tab (Elementor)', 'amiso' ),
						'desc' => esc_html__( 'It will be visible on Tab & Mobile devices only. Made From Custom Post Type by using Elementor.', 'amiso' ),
						'id'          => 'headertop_cpt_elementor_mobile',
						'type'        => 'post',

						// Post type.
						'post_type'   => 'header-top',

						// Field type.
						'field_type'  => 'select_advanced',

						// Placeholder, inherited from `select_advanced` field.
						'placeholder' => esc_html__( 'Select a Pre Made Sticky Header', 'amiso' ),

						// Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
						'query_args'  => array(
							'post_status'    => 'publish',
							'posts_per_page' => - 1,
						),
					),








					array(
						'type' => 'heading',
						'name' => esc_html__( 'Default Header Navigation Row', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Default Header Nav Row (Show/Hide)', 'amiso' ),
						'id'		=> 'header_nav_row_visibility',
						'type'		=> 'select',
						'desc'		=> esc_html__( 'Show or hide default header nav row only for this page.', 'amiso' ),
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'   		=> esc_html__( 'Show', 'amiso' ),
							'0' 		=> esc_html__( 'Hide', 'amiso' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Primary Navigation Menu', 'amiso' ),
						'id'		=> 'custom_primary_nav_menu',
						'type'		=> 'select',
						'desc'		=> sprintf( esc_html__( 'Select which menu you want to display as primary navigation on this page. Currently set to %1$s%2$s%3$s.', 'amiso' ), '<a target="_blank" href="' . esc_url( admin_url( 'nav-menus.php?action=locations' ) ) . '">', $primary_nav_menu_name, '</a>' ),
						'options'   => amiso_get_registered_menus(),
					),
					array(
						'name'		=> esc_html__( 'Enable One Page Nav Smooth Scrolling Effect', 'amiso' ),
						'id'		=> 'enable_one_page_nav_scrolling_effect',
						'type'		=> 'checkbox',
						'desc'		=> esc_html__( 'Check this box in order to enable one page navigation smooth scrollling effect.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Show Custom Button', 'amiso' ),
						'id'		=> 'show_custom_button',
						'type'		=> 'select',
						'desc'		=> esc_html__( 'Enabling this option will show Custom Button.', 'amiso' ),
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'   		=> esc_html__( 'Yes', 'amiso' ),
							'0' 		=> esc_html__( 'No', 'amiso' ),
						),
					),
					array(
						'name'		=> 'title',
						'id'		=> 'custom_button_title',
						'type'		=> 'text',
						'visible'   => array(
							array( 'show_custom_button', '=', '1' )
						),
					),
					array(
						'name'		=> 'link',
						'id'		=> 'custom_button_link',
						'type'		=> 'text',
						'visible'   => array(
							array( 'show_custom_button', '=', '1' )
						),
					),
					array(
						'name'		=> esc_html__( 'Main Nav Items Text Color', 'amiso' ),
						'id'		=> 'main_nav_items_text_color',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   	=> esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'white'   	=> esc_html__( 'Text White', 'amiso' ),
							'dark' 	=> esc_html__( 'Text Dark', 'amiso' ),
						),
					),








					array(
						'type' => 'heading',
						'name' => esc_html__( 'Header Layout', 'amiso' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Header Layout Type (Built in)', 'amiso' ),
						'id'		=> 'header_layout_type',
						'type'		=> 'select',
						'options'   => array(
							'inherit'						=> esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'header-current-theme-style1'	=> esc_html__( 'Header Current Theme Style 1', 'amiso' ),
							'header-current-theme-style2'	=> esc_html__( 'Header Current Theme Style 2', 'amiso' ),

							'header-side-panel-nav'			=> esc_html__( 'Side Push Panel Nav', 'amiso' ),
							'header-vertical-nav'			=> esc_html__( 'Vertical Nav', 'amiso' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Header Container', 'amiso' ),
						'id'		=> 'header_container',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   		=> esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'container' 		=> esc_html__( 'Container', 'amiso' ),
							'container-fluid' 	=> esc_html__( 'Container Fluid', 'amiso' )
						),
					),




					// DIVIDER
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Header Floating Options', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Header Background Shadow (Header Floating)', 'amiso' ),
						'id'		=> 'header_floating_bg_shadow',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   		=> esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'header-bg-no-shadow'		=> esc_html__( 'No Shadow', 'amiso' ),
							'header-bg-dark-shadow'		=> esc_html__( 'Dark Background Shadow', 'amiso' ),
							'header-bg-light-shadow'	=> esc_html__( 'Light Background Shadow', 'amiso' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Text Color (Header Floating)', 'amiso' ),
						'id'		=> 'header_floating_text_color',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   		=> esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'header-floating-bg-dark-text-white'	=> esc_html__( 'White Text', 'amiso' ),
							'header-floating-bg-white-text-dark'		=> esc_html__( 'Dark Text', 'amiso' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Background Color (on Header Floating + Sticky)', 'amiso' ),
						'id'		=> 'header_floating_bg_color_sticky',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   		=> esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'header-floating-sticky-bg-white'	=> esc_html__( 'White BG', 'amiso' ),
							'header-floating-sticky-bg-dark'		=> esc_html__( 'Dark BG', 'amiso' ),
						),
					),



					array(
						'type' => 'heading',
						'name' => esc_html__( 'Header Layout - Vertical Nav', 'amiso' ),
						'visible'   => array(
							array( 'header_layout_type', '=', 'header-vertical-nav' )
						),
					),
					array(
						'name'		=> esc_html__( 'Background Color', 'amiso' ),
						'id'		=> 'vertical_nav_bgcolor',
						'type'		=> 'color',
						'visible'   => array(
							array( 'header_layout_type', '=', 'header-vertical-nav' )
						),
					),
					array(
						'name'		=> esc_html__( 'Background Image', 'amiso' ),
						'id'		=> 'vertical_nav_bgimg',
						'type'		=> 'image_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array(
							array( 'header_layout_type', '=', 'header-vertical-nav' )
						),
					),
					array(
						'name'		=> esc_html__( 'Shadow', 'amiso' ),
						'id'		=> 'vertical_nav_shadow',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'			=> esc_html__( 'Yes', 'amiso' ),
							'0'			=> esc_html__( 'No', 'amiso' ),
						),
						'visible'   => array(
							array( 'header_layout_type', '=', 'header-vertical-nav' )
						),
					),
					array(
						'name'		=> esc_html__( 'Vertical Area Border', 'amiso' ),
						'id'		=> 'vertical_nav_border',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'			=> esc_html__( 'Yes', 'amiso' ),
							'0'			=> esc_html__( 'No', 'amiso' ),
						),
						'visible'   => array(
							array( 'header_layout_type', '=', 'header-vertical-nav' )
						),
					),
					array(
						'name'		=> esc_html__( 'Center Content', 'amiso' ),
						'id'		=> 'vertical_nav_content',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'			=> esc_html__( 'Yes', 'amiso' ),
							'0'			=> esc_html__( 'No', 'amiso' ),
						),
						'visible'   => array(
							array( 'header_layout_type', '=', 'header-vertical-nav' )
						),
					),

				),
			),
			//Header tab ends





			//theme-color tab starts
			array(
				'id'     => 'amiso_' . 'page_mb_theme_color_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'theme-color',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Theme Color Settings', 'amiso' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Change Primary Theme Color', 'amiso' ),
						'id'		=> 'change_primary_theme_color',
						'type'		=> 'checkbox',
						'desc'		=> esc_html__( 'If you want to change primary theme color of this page then check this option.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Primary Theme Color', 'amiso' ),
						'id'		=> 'primary_theme_color',
						'type'		=> 'select',
						'options'   => amiso_metabox_get_list_of_predefined_theme_color_css_files(),
						'visible'   => array(
							array( 'change_primary_theme_color', '=', true )
						),
					),
				),
			),
			//theme-color tab ends





			//typography-setting tab starts
			array(
				'id'     => 'amiso_' . 'page_mb_typography_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'typography-setting',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Typography', 'amiso' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Change Typography', 'amiso' ),
						'id'		=> 'change_typography',
						'type'		=> 'checkbox',
						'desc'		=> esc_html__( 'If you want to change typography of this page then check this option.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Choose Predefined Typography', 'amiso' ),
						'id'		=> 'primary_typography_set',
						'type'		=> 'select',
						'options'   => amiso_metabox_get_list_of_predefined_typography_files(),
						'visible'   => array(
							array( 'change_typography', '=', true )
						),
					),
				),
			),
			//typography-setting tab ends



			//Logo tab starts
			array(
				'id'     => 'amiso_' . 'page_mb_logo_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'logo',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Logo Settings', 'amiso' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Alternative Site Brand', 'amiso' ),
						'id'		=> 'logo_site_brand',
						'desc'		=> esc_html__( 'Enter the text that will be appeared as logo.', 'amiso' ),
						'type'		=> 'text',
					),

					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Logo', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Use logo in replace of text?', 'amiso' ),
						'id'		=> 'use_logo',
						'type'		=> 'select',
						'options'   => array(
							'inherit' 	=> esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'			=> esc_html__( 'Yes', 'amiso' ),
							'0'			=> esc_html__( 'No', 'amiso' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Logo (Default)', 'amiso' ),
						'id'		=> 'logo_default',
						'type'		=> 'image_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array( 'use_logo', '!=', '0' ),
					),

					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Switchable logo', 'amiso' ),
						'visible'   => array( 'use_logo', '!=', '0' ),
					),
					array(
						'name'		=> esc_html__( 'Switchable logo(Light/Dark)?', 'amiso' ),
						'id'		=> 'use_switchable_logo',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'			=> esc_html__( 'Yes', 'amiso' ),
							'0'			=> esc_html__( 'No', 'amiso' ),
						),
						'visible'   => array( 'use_logo', '!=', '0' ),
					),
					array(
						'name'		=> esc_html__( 'Logo (Default)', 'amiso' ),
						'id'		=> 'logo_light',
						'type'		=> 'image_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array( 'use_switchable_logo', '!=', '0' ),
					),
					array(
						'name'		=> esc_html__( 'Logo (Sticky Mode)', 'amiso' ),
						'id'		=> 'logo_dark',
						'type'		=> 'image_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array( 'use_switchable_logo', '!=', '0' ),
					),

					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Logo height', 'amiso' ),
						'visible'   => array( 'use_logo', '!=', '0' ),
					),
					array(
						'name'		=> esc_html__( 'Maximum logo height(px)', 'amiso' ),
						'id'		=> 'logo_maximum_height',
						'type'		=> 'slider',
						'desc'		=> esc_html__( 'Enter maximum logo height in px.', 'amiso' ),
						'suffix' => esc_html__( 'px', 'amiso' ),
						'js_options' => array(
							'min'  => 20,
							'max'  => 150,
							'step' => 1,
						),
						// Default value
						'std'		=> 40,
						'visible'   => array( 'use_logo', '!=', '0' ),
					),
				),
			),
			//Logo tab ends



			//Page Title tab starts
			array(
				'id'     => 'amiso_' . 'page_mb_page_title_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'page-title',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Page Title', 'amiso' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Enable Page Title', 'amiso' ),
						'id'		=> 'enable_page_title',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'			=> esc_html__( 'Yes', 'amiso' ),
							'0'			=> esc_html__( 'No', 'amiso' ),
						),
					),

					array(
						'name' => esc_html__( 'Choose Page Title (Built with Elementor)', 'amiso' ),
						'id'          => 'page_title_widget_area',
						'type'        => 'post',
						'desc'		=> sprintf(esc_html__('Create your own one from %s', 'amiso'), '<a href="'.admin_url('edit.php?post_type=page-title').'" target="_blank">Dashboard > Parts - Page Title</a>'),

						// Post type.
						'post_type'   => 'page-title',

						// Field type.
						'field_type'  => 'select_advanced',

						// Placeholder, inherited from `select_advanced` field.
						'placeholder' => esc_html__( 'Select a Page Title', 'amiso' ),

						// Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
						'query_args'  => array(
							'post_status'    => 'publish',
							'posts_per_page' => - 1,
						),
					),


					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Title & Subtitle', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Page Title Type', 'amiso' ),
						'id'		=> 'page_title_type',
						'type'		=> 'select',
						'options'   => array(
							'page-title'   		=> esc_html__( 'Show This Page Title', 'amiso' ),
							'custom-title'		=> esc_html__( 'Enter Custom Title', 'amiso' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Custom Title Text', 'amiso' ),
						'id'		=> 'custom_page_title_text',
						'desc'		=> esc_html__( 'Enter the text that will be appeared as page title.', 'amiso' ),
						'type'		=> 'text',
						'visible'   => array(
							array( 'page_title_type', '=', 'custom-title' )
						),
					),
					array(
						'name'		=> esc_html__( 'Subtitle Text', 'amiso' ),
						'id'		=> 'page_sub_title_text',
						'desc'		=> esc_html__( 'Enter the text that will be appeared as subtitle.', 'amiso' ),
						'type'		=> 'text',
					),


					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Page Title Layout', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Choose Page Title Layout', 'amiso' ),
						'id'		=> 'title_layout',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'standard'  => esc_html__( 'Standard', 'amiso' ),
							'split'	 	=> esc_html__( 'Split', 'amiso' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Page Title Container', 'amiso' ),
						'id'		=> 'title_container',
						'type'		=> 'select',
						'options'   => array(
							'inherit'			=> esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'container'			=> esc_html__( 'Container', 'amiso' ),
							'container-fluid'   => esc_html__( 'Container Fluid', 'amiso' )
						),
					),
					array(
						'name'		=> esc_html__( 'Page Title Text Alignment', 'amiso' ),
						'id'		=> 'title_text_align',
						'type'		=> 'select',
						'options'   => $text_align_array,
					),
					array(
						'name'		=> esc_html__( 'Default Text Color', 'amiso' ),
						'id'		=> 'title_default_text_color',
						'type'		=> 'select',
						'options'   => array(
							'inherit'		=> esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'text-light' 	=> esc_html__( 'Light Text', 'amiso' ),
							'text-dark'  	=> esc_html__( 'Dark Text', 'amiso' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Page Title Height', 'amiso' ),
						'id'		=> 'title_area_height',
						'type'		=> 'select',
						'options'   => array(
							'inherit'				=> esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'padding-default'		=> esc_html__( 'Default', 'amiso' ),
							'padding-extra-small'   => esc_html__( 'Extra Small', 'amiso' ),
							'padding-small'			=> esc_html__( 'Small', 'amiso' ),
							'padding-medium'		=> esc_html__( 'Medium', 'amiso' ),
							'padding-large'			=> esc_html__( 'Large', 'amiso' ),
							'padding-extra-large'   => esc_html__( 'Extra Large', 'amiso' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Show Title', 'amiso' ),
						'id'		=> 'title_area_show_title',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'			=> esc_html__( 'Yes', 'amiso' ),
							'0'			=> esc_html__( 'No', 'amiso' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Show Breadcrumbs', 'amiso' ),
						'id'		=> 'title_area_show_breadcrumbs',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'			=> esc_html__( 'Yes', 'amiso' ),
							'0'			=> esc_html__( 'No', 'amiso' ),
						),
					),


					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Page Title Background', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Page Title Background Type', 'amiso' ),
						'id'		=> 'title_area_bg_type',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'bg-color'  => esc_html__( 'Background Color', 'amiso' ),
							'bg-img'	=> esc_html__( 'Background Image', 'amiso' ),
							'bg-video'	=> esc_html__( 'Background Video', 'amiso' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Background Color', 'amiso' ),
						'id'		=> 'title_area_bgcolor',
						'type'		=> 'color',
						'visible'   => array(
							array( 'title_area_bg_type', '=', 'bg-color' )
						),
					),
					array(
						'name'		=> esc_html__( 'Background Image', 'amiso' ),
						'id'		=> 'title_area_bgimg',
						'type'		=> 'image_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array(
							array( 'title_area_bg_type', '=', 'bg-img' )
						),
					),
					array(
						'name'		=> esc_html__( 'Add Background Video', 'amiso' ),
						'id'		=> 'title_area_bg_video_status',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'			=> esc_html__( 'Yes', 'amiso' ),
							'0'			=> esc_html__( 'No', 'amiso' ),
						),
						'visible'   => array(
							array( 'title_area_bg_type', '=', 'bg-video' )
						),
					),
					array(
						'name'		=> esc_html__( 'Video Type', 'amiso' ),
						'id'		=> 'title_area_bg_video_type',
						'type'		=> 'select',
						'options'   => array(
							'youtube'		=> esc_html__( 'Youtube', 'amiso' ),
							'self-hosted'   => esc_html__( 'Self Hosted Video', 'amiso' )
						),
						'visible'   => array(
							array( 'title_area_bg_video_status', '=', '1' )
						),
					),
					array(
						'name'		=> esc_html__( 'Youtube Video ID', 'amiso' ),
						'id'		=> 'title_area_bg_video_youtube_id',
						'desc'		=> esc_html__( 'Only put video ID not the whole URL. Example: E5ln4uR4TwQ', 'amiso' ),
						'type'		=> 'text',
						'visible'   => array(
							array( 'title_area_bg_video_type', '=', 'youtube' )
						),
					),
					array(
						'name'		=> esc_html__( 'Video Poster', 'amiso' ),
						'id'		=> 'title_area_bg_video_self_hosted_video_poster',
						'type'		=> 'image_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array(
							array( 'title_area_bg_video_type', '=', 'self-hosted' )
						),
					),
					array(
						'name'		=> esc_html__( 'MP4 Video', 'amiso' ),
						'id'		=> 'title_area_bg_video_self_hosted_mp4_video_url',
						'type'		=> 'file_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array(
							array( 'title_area_bg_video_type', '=', 'self-hosted' )
						),
					),
					array(
						'name'		=> esc_html__( 'WEBM Video', 'amiso' ),
						'id'		=> 'title_area_bg_video_self_hosted_webm_video_url',
						'type'		=> 'file_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array(
							array( 'title_area_bg_video_type', '=', 'self-hosted' )
						),
					),
					array(
						'name'		=> esc_html__( 'OGV Video', 'amiso' ),
						'id'		=> 'title_area_bg_video_self_hosted_ogv_video_url',
						'type'		=> 'file_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array(
							array( 'title_area_bg_video_type', '=', 'self-hosted' )
						),
					),



					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Background Overlay', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Add Page Title Background Overlay?', 'amiso' ),
						'id'		=> 'title_area_bg_layer_overlay_status',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'			=> esc_html__( 'Yes', 'amiso' ),
							'0'			=> esc_html__( 'No', 'amiso' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Overlay Opacity', 'amiso' ),
						'id'		=> 'title_area_bg_layer_overlay_opacity',
						'type'		=> 'slider',
						'desc'		=> esc_html__( 'Overlay on background image on Page Title.', 'amiso' ),
						'js_options' => array(
							'min'  => 1,
							'max'  => 9,
							'step' => 1,
						),
						// Default value
						'std'		=> 7,
						'visible'   => array(
							array( 'title_area_bg_layer_overlay_status', '=', '1' )
						),
					),
					array(
						'name'		=> esc_html__( 'Overlay Color', 'amiso' ),
						'id'		=> 'title_area_bg_layer_overlay_color',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'dark'  	=> esc_html__( 'Dark', 'amiso' ),
							'white' 	=> esc_html__( 'White', 'amiso' )
						),
						'visible'   => array(
							array( 'title_area_bg_layer_overlay_status', '=', '1' )
						),
					),



					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Animation Effect', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Title Animation Effect', 'amiso' ),
						'id'		=> 'title_animation_effect',
						'type'		=> 'select_advanced',
						'options'   => mascot_core_animate_css_animation_list(),
					),
					array(
						'name'		=> esc_html__( 'Subtitle Animation Effect', 'amiso' ),
						'id'		=> 'subtitle_animation_effect',
						'type'		=> 'select_advanced',
						'options'   => mascot_core_animate_css_animation_list(),
					),

					// DIVIDER
					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Typography', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Title Tag', 'amiso' ),
						'id'		=> 'title_tag',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'h1'		=> 'h1',
							'h2'		=> 'h2',
							'h3'		=> 'h3',
							'h4'		=> 'h4',
							'h5'		=> 'h5',
							'h6'		=> 'h6',
						),
					),
					array(
						'name'		=> esc_html__( 'Title Color', 'amiso' ),
						'id'		=> 'title_color',
						'type'		=> 'color',
					),
					array(
						'name'		=> esc_html__( 'Subtitle Tag', 'amiso' ),
						'id'		=> 'subtitle_tag',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'h1'		=> 'h1',
							'h2'		=> 'h2',
							'h3'		=> 'h3',
							'h4'		=> 'h4',
							'h5'		=> 'h5',
							'h6'		=> 'h6',
						),
					),
					array(
						'name'		=> esc_html__( 'Subtitle Color', 'amiso' ),
						'id'		=> 'subtitle_color',
						'type'		=> 'color',
					),
				),
			),
			//Page Title tab ends



			//Layout tab starts
			array(
				'id'     => 'amiso_' . 'page_mb_layout_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'layout-setings',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Layout Settings', 'amiso' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Page Layout', 'amiso' ),
						'id'		=> 'page_layout',
						'type'		=> 'select',
						'options'   => array(
							'inherit'		=> esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'boxed'			=> esc_html__( 'Boxed', 'amiso' ),
							'stretched'	 	=> esc_html__( 'Stretched', 'amiso' )
						),
					),


					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Content Width Setting', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Content Width', 'amiso' ),
						'id'		=> 'content_width',
						'desc'		=> esc_html__( 'Select content width. You can use any width by using custom CSS.', 'amiso' ),
						'type'		=> 'select',
						'options'   => array(
							'inherit'				=> esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'container-970px'	 	=> esc_html__( '970px', 'amiso' ),
							'container-default'		=> esc_html__( '1170px (Bootstrap Default)', 'amiso' ),
							'container-1230px'		=> esc_html__( '1230px (Wide)', 'amiso' ),
							'container-1300px'		=> esc_html__( '1300px (Wider)', 'amiso' ),
							'container-1340px'		=> esc_html__( '1340px (Wider)', 'amiso' ),
							'container-1440px'		=> esc_html__( '1440px (Wider)', 'amiso' ),
							'container-1500px'		=> esc_html__( '1500px (Wider)', 'amiso' ),
							'container-1600px'		=> esc_html__( '1600px (Wider)', 'amiso' ),
							'container-100pr'	 	=> esc_html__( 'Fullwidth 100%', 'amiso' )
						),
					),
					array(
						'name'		=> esc_html__( 'Background Solid Color(For Stretched Mode)', 'amiso' ),
						'id'		=> 'stretched_layout_bg_color',
						'type'		=> 'color',
					),


					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Boxed Layout Settings', 'amiso' ),
						'visible'   => array( 'page_layout', '!=', 'stretched' ),
					),
					array(
						'name'		=> esc_html__( 'Padding Top(px)', 'amiso' ),
						'id'		=> 'boxed_layout_padding_top',
						'desc'		=> esc_html__( 'Please put only integer value. Because the unit \'px\' will be automatically added at the end of the value.', 'amiso' ),
						'type'		=> 'number',
						'visible'   => array(
							array( 'page_layout', '!=', 'stretched' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Padding Bottom(px)', 'amiso' ),
						'id'		=> 'boxed_layout_padding_bottom',
						'desc'		=> esc_html__( 'Please put only integer value. Because the unit \'px\' will be automatically added at the end of the value.', 'amiso' ),
						'type'		=> 'number',
						'visible'   => array(
							array( 'page_layout', '!=', 'stretched' ),
						),
					),
					array(
						'name'		=> esc_html__( 'Container Shadow?', 'amiso' ),
						'id'		=> 'boxed_layout_container_shadow',
						'desc'		=> esc_html__( 'Add shadow around the container.', 'amiso' ),
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'			=> esc_html__( 'Yes', 'amiso' ),
							'0'			=> esc_html__( 'No', 'amiso' ),
						),
						'visible'   => array( 'page_layout', '!=', 'stretched' ),
					),


					array(
						'name'		=> esc_html__( 'Background Type', 'amiso' ),
						'id'		=> 'boxed_layout_bg_type',
						'desc'		=> esc_html__( 'You can use patterns, image or solid color as a background.', 'amiso' ),
						'type'		=> 'select',
						'options'   => array(
							'inherit'		=> esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'bg-color'	 	=> esc_html__( 'Solid Color', 'amiso' ),
							'bg-pattern'	=> esc_html__( 'Patterns from Theme Library', 'amiso' ),
							'bg-image'	 	=> esc_html__( 'Upload Own Image', 'amiso' ),
						),
						'visible'   => array( 'page_layout', '!=', 'stretched' ),
					),
					array(
						'name'		=> esc_html__( 'Background Color', 'amiso' ),
						'id'		=> 'boxed_layout_bg_type_color',
						'type'		=> 'color',
						'visible'   => array(
							array( 'boxed_layout_bg_type', '=', 'bg-color' )
						),
					),
					array(
						'name'		=> esc_html__( 'Background Pattern from Theme Library', 'amiso' ),
						'id'		=> 'boxed_layout_bg_type_pattern',
						'type'		=> 'image_select',
						// Array of 'value' => 'Image Source' pairs
						'options'   => $sample_patterns,
						'std'		=> $sample_patterns[key($sample_patterns)],
						// Allow to select multiple values? Default is false
						'visible'   => array(
							array( 'boxed_layout_bg_type', '=', 'bg-pattern' )
						),
					),
					array(
						'name'		=> esc_html__( 'Background Image', 'amiso' ),
						'id'		=> 'boxed_layout_bg_type_img',
						'type'		=> 'image_advanced',
						'max_file_uploads' => 1,
						'max_status'=> false,
						'visible'   => array(
							array( 'boxed_layout_bg_type', '=', 'bg-image' )
						),
					),


					array(
						'type'		=> 'heading',
						'name'		=> esc_html__( 'Dark Layout Settings', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Enable Dark Layout Mode', 'amiso' ),
						'id'		=> 'enable_dark_layout_mode',
						'type'		=> 'checkbox',
						'desc'		=> esc_html__( 'Check this box to enable dark layout mode.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Custom Dark Background Color', 'amiso' ),
						'id'		=> 'dark_layout_mode_bg_color',
						'type'		=> 'color',
						'desc'		=> esc_html__( 'You can choose custom Background Color. Otherwise it will come from style css file.', 'amiso' ),
					),
				),
			),
			//Layout tab ends



			//footer tab starts
			array(
				'id'     => 'amiso_' . 'page_mb_footer_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'footer',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Footer Settings', 'amiso' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Footer Visibility', 'amiso' ),
						'id'		=> 'footer_visibility',
						'type'		=> 'select',
						'desc'		=> esc_html__( 'Show or hide footer only for this page.', 'amiso' ),
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'			=> esc_html__( 'Show', 'amiso' ),
							'0'			=> esc_html__( 'Hide', 'amiso' ),
						),
					),
					array(
						'name' => esc_html__( 'Choose Footer (Built with Elementor)', 'amiso' ),
						'id'          => 'footer_widget_area',
						'type'        => 'post',
						'desc'		=> sprintf(esc_html__('Create your own one from %s', 'amiso'), '<a href="'.admin_url('edit.php?post_type=footer').'" target="_blank">Dashboard > Parts - Footer</a>'),

						// Post type.
						'post_type'   => 'footer',

						// Field type.
						'field_type'  => 'select_advanced',

						// Placeholder, inherited from `select_advanced` field.
						'placeholder' => esc_html__( 'Select a Footer', 'amiso' ),

						// Query arguments. See https://codex.wordpress.org/Class_Reference/WP_Query
						'query_args'  => array(
							'post_status'    => 'publish',
							'posts_per_page' => - 1,
						),
					),
					array(
						'name'		=> esc_html__( 'Fixed Footer Bottom Effect', 'amiso' ),
						'id'		=> 'footer_fixed_footer_bottom',
						'type'		=> 'select',
						'desc'		=> esc_html__( 'Enabling this option will make Footer gradually appear on scroll. This is popular for OnePage Websites.', 'amiso' ),
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'			=> esc_html__( 'Yes', 'amiso' ),
							'0'			=> esc_html__( 'No', 'amiso' ),
						),
					),
				),
			),
			//footer tab ends




			//slider tab starts
			array(
				'id'     => 'amiso_' . 'page_mb_slider_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'slider',
				// Sub-fields
				'fields' => array(
					//slider tab starts
					array(
						'type' => 'heading',
						'name' => esc_html__( 'Slider Settings', 'amiso' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Slider Type', 'amiso' ),
						'id'		=> 'slider_type',
						'type'		=> 'select',
						'desc' => esc_html__( 'Select the type of slider you want to display.', 'amiso' ),
						'options'   => array(
							'no-slider'			=> esc_html__( 'No Slider', 'amiso' ),
							'rev-slider'		=> esc_html__( 'Slider Revolution', 'amiso' ),
							'layer-slider'		=> esc_html__( 'Layer Slider', 'amiso' ),
						),
						'std'		=> 'no-slider',
					),
					array(
						'name'		=> esc_html__( 'Choose Revolution Slider', 'amiso' ),
						'id'		=> 'select_rev_slider',
						'type'		=> 'select',
						'desc' => esc_html__( 'Select the name(alias) of the revolution slider you want to display.', 'amiso' ),
						'options'   => $list_rev_sliders,
						'visible'   => array( 'slider_type', '=', 'rev-slider' ),
					),
					array(
						'name'		=> esc_html__( 'Choose Layer Slider', 'amiso' ),
						'id'		=> 'select_layer_slider',
						'type'		=> 'select',
						'desc' => esc_html__( 'Select the name(alias) of the revolution slider you want to display.', 'amiso' ),
						'options'   => $list_layer_sliders,
						'visible'   => array( 'slider_type', '=', 'layer-slider' ),
					),
					array(
						'name'		=> esc_html__( 'Slider Position', 'amiso' ),
						'id'		=> 'slider_position',
						'type'		=> 'select',
						'desc' => esc_html__( 'Choose position of the slider you want to display. You can put it below or above the header.', 'amiso' ),
						'options'   => array(
							'default'		=> esc_html__( 'Default', 'amiso' ),
							'below-header'	=> esc_html__( 'Below Header', 'amiso' ),
							'above-header'	=> esc_html__( 'Above Header', 'amiso' ),
						),
						'std'		=> 'default',
						'visible'   => array( 'slider_position', '!=', 'no-slider' ),
					),
					//slider tab ends


				),
			),
			//slider tab ends


			//general tab starts
			array(
				'id'     => 'amiso_' . 'page_mb_general_settings',
				// Group field
				'type'   => 'group',
				// Clone whole group?
				'clone'  => false,
				// Drag and drop clones to reorder them?
				'sort_clone' => false,
				// tab
				'tab'  => 'general',
				// Sub-fields
				'fields' => array(
					array(
						'type' => 'heading',
						'name' => esc_html__( 'General Settings', 'amiso' ),
						'desc' => esc_html__( 'Changes of the following settings will be effective only for this page.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Hide Featured Image', 'amiso' ),
						'id'		=> 'hide_featured_image',
						'type'		=> 'checkbox',
						'desc'		=> esc_html__( 'Enable/Disabling this option will show/hide Featured Image in blog page.', 'amiso' ),
					),
					array(
						'name'		=> esc_html__( 'Show Comments', 'amiso' ),
						'id'		=> 'show_comments',
						'type'		=> 'select',
						'options'   => array(
							'inherit'   => esc_html__( 'Inherit from Theme Options', 'amiso' ),
							'1'			=> esc_html__( 'Yes', 'amiso' ),
							'0'			=> esc_html__( 'No', 'amiso' ),
						),
					),
				),
			),
			//general tab ends


		),
	);


	return $meta_boxes;
}
