<?php
/**
 * Mouse helper
 *
 */



// Add dynamic CSS to insert it to the footer
if ( ! function_exists('tm_addons_add_inline_css') ) {
	function tm_addons_add_inline_css($css) {
		global $TM_MOUSEHELPER_STORAGE;
		$TM_MOUSEHELPER_STORAGE['inline_css'] = ( ! empty($TM_MOUSEHELPER_STORAGE['inline_css']) ? $TM_MOUSEHELPER_STORAGE['inline_css'] : '' ) . $css;
	}
}

// Add variables to the frontend
if ( !function_exists( 'tm_addons_localize_scripts_front' ) ) {
	add_action("wp_footer", 'tm_addons_localize_scripts_front');
	function tm_addons_localize_scripts_front() {
		//added after menuzord plugin because it causes error
		wp_localize_script( 'menuzord', 'TM_MOUSEHELPER_STORAGE', apply_filters('tm_addons_filter_localize_script', array(
			// AJAX parameters
			'ajax_url'	=> esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce'=> esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			// Site base url
			'site_url'	=> esc_url(get_home_url()),
			// Is single page/post
			'post_id' => get_the_ID(),
			// VC frontend edit mode
			// Is preview mode
			'is_preview_elm'=> mascot_core_is_preview(),
			// Mobile breakpoints for JS (if window width less then)
			'mobile_breakpoint_fixedrows_off' => 768,
			'mobile_breakpoint_fixedcolumns_off' => 768,
			'mobile_breakpoint_stacksections_off' => 768,
			'mobile_breakpoint_fullheight_off' => 1025,
			'mobile_breakpoint_mousehelper_off' => 1025,
		) ) );
	}
}

// Enqueue frontend scripts and styles priority
if ( ! defined( 'TM_ENQUEUE_SCRIPTS_PRIORITY' ) ) define( 'TM_ENQUEUE_SCRIPTS_PRIORITY', 11 );

// Enqueue responsive styles priority
if ( ! defined( 'TM_ENQUEUE_RESPONSIVE_PRIORITY' ) ) define( 'TM_ENQUEUE_RESPONSIVE_PRIORITY', 2000 );

// Load required styles and scripts for the frontend
if ( ! function_exists( 'tm_cursor_mouse_helper_load_scripts_front' ) ) {
	add_action( 'wp_enqueue_scripts', 'tm_cursor_mouse_helper_load_scripts_front', TM_ENQUEUE_SCRIPTS_PRIORITY);
	add_action( 'tm_addons_action_pagebuilder_preview_scripts', 'tm_cursor_mouse_helper_load_scripts_front', 10, 1 );
	function tm_cursor_mouse_helper_load_scripts_front( $force = false ) {
		static $loaded = false;
		$preview_elm = mascot_core_is_preview();
		$need        = ! $loaded && ( ! $preview_elm ) && (
						$force === true
							|| ( $preview_elm )
							|| (int) mascot_core_amiso_get_redux_option('mouse_helper') > 0
						);
		if ( ! $loaded && $need ) {
			$loaded = true;
			wp_enqueue_style(  'tm_addons-mouse-helper', plugins_url( '/mouse-helper.css', __FILE__ ), array(), null );
			wp_enqueue_script( 'tm_addons-mouse-helper', plugins_url( '/mouse-helper.js', __FILE__ ), array('jquery', 'menuzord'), null, true );
			do_action( 'tm_addons_action_load_scripts_front', $force, 'mouse_helper' );
		}
		if ( ! $loaded && $preview_elm ) {
			do_action( 'tm_addons_action_load_scripts_front', false, 'mouse_helper', 2 );
		}
	}
}

// Enqueue responsive styles for frontend
if ( ! function_exists( 'tm_cursor_mouse_helper_load_scripts_front_responsive' ) ) {
	add_action( 'wp_enqueue_scripts', 'tm_cursor_mouse_helper_load_scripts_front_responsive', TM_ENQUEUE_RESPONSIVE_PRIORITY );
	add_action( 'tm_addons_action_load_scripts_front_mouse_helper', 'tm_cursor_mouse_helper_load_scripts_front_responsive', 10, 1 );
	function tm_cursor_mouse_helper_load_scripts_front_responsive( $force = false ) {
		static $loaded = false;
		if ( ! $loaded && (
			current_action() == 'wp_enqueue_scripts'
			||
			current_action() != 'wp_enqueue_scripts' && $force === true
			)
		) {
			$loaded = true;
			wp_enqueue_style( 'tm_addons-mouse-helper-responsive', plugins_url( '/mouse-helper.responsive.css', __FILE__ ));
		}
	}
}



// Add mouse_helper to the list with JS vars
if ( !function_exists( 'tm_cursor_mouse_helper_localize_script' ) ) {
	add_action("tm_addons_filter_localize_script", 'tm_cursor_mouse_helper_localize_script');
	function tm_cursor_mouse_helper_localize_script($vars) {
		$vars['mouse_helper']            = (int) mascot_core_amiso_get_redux_option('mouse_helper');
		$vars['mouse_helper_delay']      = max( 1, min( 20, (int) mascot_core_amiso_get_redux_option('mouse_helper_delay') ) );
		$vars['mouse_helper_centered']   = (int) mascot_core_amiso_get_redux_option('mouse_helper_centered');
		$vars['msg_mouse_helper_anchor'] = (int) mascot_core_amiso_get_redux_option('mouse_helper') > 0 ? esc_attr__( 'Scroll to', 'mascot-core-amiso' ) : '';
		return $vars;
	}
}



//========================================================================
//  Add params to the ThemeREX Addons Options and layout to the page
//========================================================================



// Add params to the ThemeREX Addons Options.
if ( ! function_exists( 'tm_cursor_mouse_helper_add_redux_options' ) ) {
	add_action('setup_theme', 'tm_cursor_mouse_helper_add_redux_options');
	function tm_cursor_mouse_helper_add_redux_options() {

		if ( ! class_exists( 'Redux' ) ) {
			return;
		}
		// This is your option name where all the Redux data is stored.
		$opt_name = "amiso_redux_theme_opt";

		// -> START Custom HTML/JS Codes
		Redux::setSection( $opt_name, array(
			'title'  => esc_html__( 'Cursor Mouse helper', 'mascot-core-amiso' ),
			'id'     => 'mouse_helper_section',
			'desc'   => '',
			'icon'   => 'dashicons-before dashicons-arrow-up',
			'priority'   => 18,
			'fields' => array(
				array(
					'id'       => 'mouse_helper',
					'type'     => 'switch',
					'title'    => esc_html__( 'Show mouse helper', 'mascot-core-amiso' ),
					'subtitle' => esc_html__( 'Display animated helper near the mouse cursor on desktop and notebooks', 'mascot-core-amiso' ),
					'default'  => 0,
					'on'       => esc_html__( 'Yes', 'mascot-core-amiso' ),
					'off'      => esc_html__( 'No', 'mascot-core-amiso' ),
				),
				array(
					'id'       => 'mouse_helper_permanent',
					'type'     => 'switch',
					'title'    => esc_html__( 'Always visible', 'mascot-core-amiso' ),
					'subtitle' => esc_html__( 'Display the mouse helper permanently or only when hovering over the corresponding object', 'mascot-core-amiso' ),
					'default'  => 0,
					'on'       => esc_html__( 'Yes', 'mascot-core-amiso' ),
					'off'      => esc_html__( 'No', 'mascot-core-amiso' ),
					'required' => array(
						array( 'mouse_helper', '=', '1' ),
					)
				),
				array(
					'id'       => 'mouse_helper_centered',
					'type'     => 'switch',
					'title'    => esc_html__( 'Centered', 'mascot-core-amiso' ),
					'subtitle' => esc_html__( 'Place the center of the helper in the cursor position', 'mascot-core-amiso' ),
					'default'  => 0,
					'on'       => esc_html__( 'Yes', 'mascot-core-amiso' ),
					'off'      => esc_html__( 'No', 'mascot-core-amiso' ),
					'required' => array(
						array( 'mouse_helper', '=', '1' ),
					)
				),
				array(
					'id'            => 'mouse_helper_delay',
					'type'          => 'slider',
					'title'         => esc_html__( 'Delay', 'mascot-core-amiso' ),
					'subtitle'      => esc_html__( 'The coefficient of lag between the helper and the cursor (1 - the helper moves with the cursor)', 'mascot-core-amiso' ),
					'desc'          => '',
					'default'       => 10,
					'min'           => 1,
					'step'          => 1,
					'max'           => 20,
					'display_value' => 'text',
					'required' => array(
						array( 'mouse_helper', '=', '1' ),
					)
				),


				array(
					'id'       => 'mouse_helper_replace_cursor',
					'type'     => 'button_set',
					'compiler' =>true,
					'title'    => esc_html__( 'System cursor', 'mascot-core-amiso' ),
					'subtitle' => esc_html__( 'Replace system cursor with custom image', 'mascot-core-amiso' ),
					'options' => array(
						"0"    => esc_html__( 'Default', 'mascot-core-amiso' ),
						"1"    => esc_html__( 'Replace', 'mascot-core-amiso' ),
						"hide" => esc_html__( 'Hide', 'mascot-core-amiso' ),
					),
					'default' => '0',
				),
				array(
					'id'       => 'mouse_helper_replace_cursor_default',
					'type'     => 'media',
					'url'      => false,
					'title'    => esc_html__( 'Default cursor image', 'mascot-core-amiso' ),
					'subtitle' => esc_html__( 'Select or upload image to use it as default cursor. If you select animated cursor .ANI - select alternative cursor for not supported browsers in the next field', 'mascot-core-amiso' ),
					'compiler' => 'true',
					'desc'     => '',
					'required' => array(
						array( 'mouse_helper_replace_cursor', '=', '1' )
					)
				),
				array(
					'id'       => 'mouse_helper_replace_cursor_default2',
					'type'     => 'media',
					'url'      => false,
					'title'    => esc_html__( 'Default cursor image (alternative)', 'mascot-core-amiso' ),
					'subtitle' => esc_html__( 'Select or upload image to use it as alternative cursor', 'mascot-core-amiso' ),
					'compiler' => 'true',
					'desc'     => '',
					'required' => array(
						array( 'mouse_helper_replace_cursor', '=', '1' ),
					)
				),
				array(
					'id'       => 'mouse_helper_replace_cursor_links',
					'type'     => 'media',
					'url'      => false,
					'title'    => esc_html__( 'Cursor image over links', 'mascot-core-amiso' ),
					'subtitle' => esc_html__( 'Select or upload image to use it as cursor over links and buttons.  If you select animated cursor .ANI - select alternative cursor for not supported browsers in the next field', 'mascot-core-amiso' ),
					'compiler' => 'true',
					'desc'     => '',
					'required' => array(
						array( 'mouse_helper_replace_cursor', '=', '1' ),
					)
				),
				array(
					'id'       => 'mouse_helper_replace_cursor_links2',
					'type'     => 'media',
					'url'      => false,
					'title'    => esc_html__( 'Cursor image over links (alternative)', 'mascot-core-amiso' ),
					'subtitle' => esc_html__( 'Select or upload image to use it as alternative cursor', 'mascot-core-amiso' ),
					'compiler' => 'true',
					'desc'     => '',
					'required' => array(
						array( 'mouse_helper_replace_cursor', '=', '1' ),
					)
				),
			)
		) );
	}
}


// Add mouse helper to the page
if ( !function_exists( 'tm_cursor_mouse_helper_add_to_html' ) ) {
	add_action('wp_footer', 'tm_cursor_mouse_helper_add_to_html');
	function tm_cursor_mouse_helper_add_to_html() {
		if ( (int) mascot_core_amiso_get_redux_option( 'mouse_helper' ) > 0 ) {
			// Add mouse helper layout
			?><div class="<?php
				echo esc_attr( apply_filters( 'tm_addons_filter_mouse_helper_classes',
							'tm_cursor_mouse_helper'
							. ( (int) mascot_core_amiso_get_redux_option( 'mouse_helper_permanent' ) > 0
									? ' tm_cursor_mouse_helper_permanent'
									: ''
									)
							. ( (int) mascot_core_amiso_get_redux_option( 'mouse_helper_centered' ) > 0
									? ' tm_cursor_mouse_helper_centered'
									: ''
									)
						)
					);
				?>"
				<?php
				do_action( 'tm_addons_action_mouse_helper_attributes' );
			?>><?php
				do_action( 'tm_addons_action_mouse_helper_layout' );
			?></div><?php
			// Load addon-specific scripts and styles
			tm_cursor_mouse_helper_load_scripts_front( true );
		}
	}
}

// Replace system cursor
if ( !function_exists( 'tm_cursor_mouse_helper_replace_system_cursor' ) ) {
	add_filter('body_class', 'tm_cursor_mouse_helper_replace_system_cursor');
	function tm_cursor_mouse_helper_replace_system_cursor( $classes ) {
		if ( (int) mascot_core_amiso_get_redux_option( 'mouse_helper_replace_cursor' ) == 1 ) {
			$classes[]  = 'tm_addons_custom_cursor';
			$cur_defa   = mascot_core_amiso_get_redux_option( 'mouse_helper_replace_cursor_default', false, 'url' );
			$cur_defa2  = mascot_core_amiso_get_redux_option( 'mouse_helper_replace_cursor_default2', false, 'url' );
			$cur_links  = mascot_core_amiso_get_redux_option( 'mouse_helper_replace_cursor_links', false, 'url' );
			$cur_links2 = mascot_core_amiso_get_redux_option( 'mouse_helper_replace_cursor_links2', false, 'url' );
			if ( ! empty( $cur_defa ) ) {
				tm_addons_add_inline_css(
					join( ',', apply_filters( 'tm_addons_filter_custom_cursor_default', array(
						'body',
						'body *'
					) ) )
					. ' { cursor: '
						. 'url(' . esc_url($cur_defa) . ')'
						. ( ! empty($cur_defa2) ? ',url(' . esc_url($cur_defa2) . ')' : '' )
						. ', auto !important; }'
					);
			}
			if ( ! empty( $cur_links ) ) {
				tm_addons_add_inline_css(
					join( ',', apply_filters( 'tm_addons_filter_custom_cursor_links', array(
						'body a',
						'body a *',
						'body button',
						'body input[type="submit"]',
						'body input[type="button"]',
						'body input[type="reset"]'
					) ) )
					. ' { cursor: '
						. 'url(' . esc_url($cur_links) . ')'
						. ( ! empty($cur_links2) ? ',url(' . esc_url($cur_links2) . ')' : '' )
						. ', pointer !important; }'
					);
			}
		} else if ( in_array( mascot_core_amiso_get_redux_option( 'mouse_helper_replace_cursor' ), array( '2', 'hide' ) ) ) {
			if ( ! mascot_core_is_preview() ) {
				$classes[]  = 'tm_addons_hide_cursor';
			}
		}
		return $classes;
	}
}



//========================================================================
//  Highlight on mouse hover for Title
//========================================================================

// Add 'mouse_helper_highlight' to the 'Title' params in Elementor
if ( !function_exists( 'tm_cursor_mouse_helper_highlight_add_title_param_in_elementor' ) ) {
	add_filter( 'tm_addons_filter_elementor_add_title_param', 'tm_cursor_mouse_helper_highlight_add_title_param_in_elementor' );
	function tm_cursor_mouse_helper_highlight_add_title_param_in_elementor( $params ) {
		if ( is_array( $params ) ) {
			foreach( $params as $k => $v ) {
				if ( $v['name'] == 'typed' ) {
					$params = array_merge(
								array_slice( $params, 0, $k, true),
								array(
									array(
										'name' => "mouse_helper_highlight",
										'type' => \Elementor\Controls_Manager::SWITCHER,
										'label' => __("Highlight on mouse hover", 'mascot-core-amiso'),
										'description' => wp_kses_data( __( 'Used only if option "Mouse helper" is on in the Theme Panel - ThemeREX Addons settings', 'mascot-core-amiso' ) ),
										'label_off' => __( 'Off', 'mascot-core-amiso' ),
										'label_on' => __( 'On', 'mascot-core-amiso' ),
										'return_value' => '1',
										'default' => '',
										'condition' => array(
											'title!' => '',
										),
									)
								),
								array_slice( $params, $k, null, true)
								);
					break;
				}
			}
		}
		return $params;
	}
}

// Add 'mouse_helper_highlight' to the 'Title' params in VC
if ( !function_exists( 'tm_cursor_mouse_helper_highlight_add_title_param_in_vc' ) ) {
	add_filter( 'tm_addons_filter_vc_add_title_param', 'tm_cursor_mouse_helper_highlight_add_title_param_in_vc', 10, 3 );
	function tm_cursor_mouse_helper_highlight_add_title_param_in_vc( $params, $group, $button ) {
		if ( is_array( $params ) ) {
			foreach( $params as $k => $v ) {
				if ( $v['param_name'] == 'typed' ) {
					$params = array_merge(
						array_slice( $params, 0, $k, true),
						array(
							array(
								"param_name" => "mouse_helper_highlight",
								"heading" => esc_html__("Highlight on mouse hover", 'mascot-core-amiso'),
								'edit_field_class' => 'vc_col-sm-4 vc_new_row',
								"admin_label" => true,
								'dependency' => array(
									'element' => 'title',
									'not_empty' => true
								),
								"std" => "0",
								"value" => array(esc_html__("Highlight title", 'mascot-core-amiso') => "1" ),
								"type" => "checkbox"
							),
						),
						array_slice( $params, $k, null, true)
						);
					break;
				}
			}
		}
		return $params;
	}
}

// Add 'mouse_helper_highlight' to the default 'Title' values
if ( !function_exists( 'tm_cursor_mouse_helper_highlight_add_title_defaults' ) ) {
	add_filter( 'tm_addons_sc_atts', 'tm_cursor_mouse_helper_highlight_add_title_defaults', 10, 2 );
	function tm_cursor_mouse_helper_highlight_add_title_defaults( $atts, $sc ) {
		if ( isset( $atts['title'] ) && isset( $atts['typed'] ) ) {
			$atts['mouse_helper_highlight'] = 0;
		}
 		return $atts;
 	}
}

// Apply custom color to the tpl.title
if ( !function_exists( 'tm_cursor_mouse_helper_highlight_add_title_class_tpl' ) ) {
	add_filter( 'tm_addons_filter_sc_item_title_class', 'tm_cursor_mouse_helper_highlight_add_title_class_tpl', 10, 3 );
	function tm_cursor_mouse_helper_highlight_add_title_class_tpl( $class, $sc, $args=array() ) {
		if ( ! empty($args['title_color']) ) {
			if ( ! empty($args['mouse_helper_highlight']) && (int) mascot_core_amiso_get_redux_option('mouse_helper') > 0 ) {
				$class .= ' ' . tm_addons_add_inline_css_class(
									'color: ' . tm_addons_hex2rgba( $args['title_color'], apply_filters( 'tm_addons_filter_mouse_helper_highlight_opacity', 0.33 ) ) . ' !important;'
									. 'background-image: radial-gradient(closest-side, ' . $args['title_color'] . ' 78%, transparent 0);'
								);
			}
		}
		return $class;
	}
}

// Add 'data-mouse-helper' to the tpl.title
if ( !function_exists( 'tm_cursor_mouse_helper_highlight_add_title_data_tpl' ) ) {
	add_action( 'tm_addons_action_sc_item_title_data', 'tm_cursor_mouse_helper_highlight_add_title_data_tpl', 10, 2 );
	function tm_cursor_mouse_helper_highlight_add_title_data_tpl( $sc, $args=array() ) {
		if ( ! empty($args['mouse_helper_highlight']) && (int) mascot_core_amiso_get_redux_option( 'mouse_helper' ) > 0 ) {
			echo ' ' . apply_filters( 'tm_addons_filter_mouse_helper_attributes', 'data-mouse-helper="highlight"', 'titles' );
		}
	}
}

// Apply custom color to the tpe.title (JS code to override variable value)
if ( !function_exists( 'tm_cursor_mouse_helper_highlight_add_title_tag_tpe' ) ) {
	add_action( 'tm_addons_filter_tpe_item_title_tag', 'tm_cursor_mouse_helper_highlight_add_title_tag_tpe' );
	function tm_cursor_mouse_helper_highlight_add_title_tag_tpe() {
		?>
		if ( settings.title_color != '' && settings.mouse_helper_highlight == 1 && TM_STORAGE['mouse_helper'] > 0 ) {
			title_tag_style = 'color: ' + tm_addons_hex2rgba( settings.title_color, 0.33 ) + ' !important;'
							+ 'background-image: radial-gradient(closest-side, ' + settings.title_color + ' 78%, transparent 0);';
		}
		<?php
	}
}

// Add 'data-mouse-helper' to the tpe.title (JS code to add data-param)
if ( !function_exists( 'tm_cursor_mouse_helper_highlight_add_title_data_tpe' ) ) {
	add_action( 'tm_addons_action_tpe_item_title_data', 'tm_cursor_mouse_helper_highlight_add_title_data_tpe' );
	function tm_cursor_mouse_helper_highlight_add_title_data_tpe() {
		$data = apply_filters( 'tm_addons_filter_mouse_helper_attributes', 'data-mouse-helper="highlight"', 'titles' );
		?>
		+ ( settings.mouse_helper_highlight > 0 ? ' <?php echo $data; ?>' : '' )
		<?php
	}
}


//========================================================================
//  Highlight on mouse hover for Heading
//========================================================================

// Add 'mouse_helper_highlight' to the 'Heading' params
if ( ! function_exists( 'tm_cursor_mouse_helper_highlight_add_heading_param_in_elementor' ) ) {
	add_action( 'elementor/element/before_section_end', 'tm_cursor_mouse_helper_highlight_add_heading_param_in_elementor', 10, 3 );
	function tm_cursor_mouse_helper_highlight_add_heading_param_in_elementor( $element, $section_id, $args ) {
		if ( ! is_object($element) ) return;
		$el_name = $element->get_name();
		if ( 'heading' == $el_name && 'section_title' === $section_id && (int) mascot_core_amiso_get_redux_option('mouse_helper') > 0 ) {
			$element->add_control( 'mouse_helper_highlight', array(
									'type' => \Elementor\Controls_Manager::SWITCHER,
									'label' => __("Highlight on mouse hover", 'mascot-core-amiso'),
									'label_on' => __( 'On', 'mascot-core-amiso' ),
									'label_off' => __( 'Off', 'mascot-core-amiso' ),
									'return_value' => '1',
									'default' => '',
								) );
		}
	}
}


// Add data parameter and color styles to the Heading
if ( ! function_exists( 'tm_cursor_mouse_helper_highlight_before_render_heading_in_elementor' ) ) {
	// Before Elementor 2.1.0
	add_action( 'elementor/frontend/element/before_render', 'tm_cursor_mouse_helper_highlight_before_render_heading_in_elementor', 10, 1 );
	// After Elementor 2.1.0
	add_action( 'elementor/frontend/widget/before_render', 'tm_cursor_mouse_helper_highlight_before_render_heading_in_elementor', 10, 1 );
	function tm_cursor_mouse_helper_highlight_before_render_heading_in_elementor( $element ) {
		if ( is_object( $element ) && (int) mascot_core_amiso_get_redux_option( 'mouse_helper' ) > 0 ) {
			$el_name = $element->get_name();
			if ( 'heading' == $el_name ) {
				$highlight = $element->get_settings( 'mouse_helper_highlight' );
				if ( ! empty( $highlight ) ) {
					$element->add_render_attribute( 'title', 'data-mouse-helper', 'highlight' );
					$title_color = $element->get_settings( 'title_color' );
					if ( ! empty( $title_color ) && substr( $title_color, 0, 1 ) == '#' ) {
						$element->add_render_attribute( 'title', 'class', tm_addons_add_inline_css_class(
							'color: ' . tm_addons_hex2rgba( $settings['title_color'], apply_filters( 'tm_addons_filter_mouse_helper_highlight_opacity', 0.33 ) ) . ' !important;'
							. 'background-image: radial-gradient(closest-side, ' . $title_color . ' 78%, transparent 0);'
						) );
					}
				}
			}
		}
	}
}




//========================================================================
//  Mouse Helper for all elements
//========================================================================

// Add "Mouse helper" params to all elements
if (!function_exists('tm_cursor_mouse_helper_add_params_to_elements')) {
	add_action( 'elementor/element/before_section_start', 'tm_cursor_mouse_helper_add_params_to_elements', 10, 3 );
	add_action( 'elementor/widget/before_section_start', 'tm_cursor_mouse_helper_add_params_to_elements', 10, 3 );
	function tm_cursor_mouse_helper_add_params_to_elements($element, $section_id, $args) {

		if ( !is_object($element) ) return;

		if ( in_array( $element->get_name(), array( 'section', 'column', 'common' ) ) && $section_id == '_section_responsive' && (int) mascot_core_amiso_get_redux_option( 'mouse_helper' ) > 0 ) {

			$element->start_controls_section( 'section_tm_mouse_helper', array(
																		'tab' => !empty($args['tab']) ? $args['tab'] : \Elementor\Controls_Manager::TAB_ADVANCED,
																		'label' => TM_ELEMENTOR_WIDGET_BADGE . __( 'Mascot - Mouse Helper', 'mascot-core-amiso' )
																	) );
			$element->add_control( 'mouse_helper', array(
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __("Enable mouse helper", 'mascot-core-amiso'),
				'label_on' => __( 'On', 'mascot-core-amiso' ),
				'label_off' => __( 'Off', 'mascot-core-amiso' ),
				'return_value' => '1',
				'default' => '',
			) );

			$element->add_control( 'mouse_helper_action', array(
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => __( 'Action', 'mascot-core-amiso' ),
				'label_block' => false,
				'options' => apply_filters( 'tm_addons_filter_mouse_helper_action', array(
					'hover' => esc_html__( 'Hover', 'mascot-core-amiso' ),
				) ),
				'condition' => array(
					'mouse_helper' => '1'
				),
				'default' => 'hover',
			) );

			if ( mascot_core_amiso_get_redux_option('mouse_helper_replace_cursor') != 'hide' ) {
				$element->add_control( 'mouse_helper_hide_cursor', array(
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label' => __("Hide system cursor", 'mascot-core-amiso'),
					'label_on' => __( 'On', 'mascot-core-amiso' ),
					'label_off' => __( 'Off', 'mascot-core-amiso' ),
					'return_value' => '1',
					'default' => '',
					'condition' => array(
						'mouse_helper' => '1',
					),
				) );
			}

			if ( (int) mascot_core_amiso_get_redux_option('mouse_helper_centered') == 0 ) {
				$element->add_control( 'mouse_helper_centered', array(
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label' => __("Cursor in the center", 'mascot-core-amiso'),
					'label_on' => __( 'On', 'mascot-core-amiso' ),
					'label_off' => __( 'Off', 'mascot-core-amiso' ),
					'return_value' => '1',
					'default' => '',
					'condition' => array(
						'mouse_helper' => '1',
					),
				) );
			}

			$element->add_control( 'mouse_helper_magnet', array(
				'label' => __( 'Magnet distance', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => array(
					'size' => 0,
					'unit' => 'px'
				),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 100
					),
				),
				'size_units' => array( 'px' ),
				'condition' => array(
					'mouse_helper' => '1'
				),
			) );

			$element->add_control( 'mouse_helper_bg_color', array(
				'label' => __( 'Background color', 'mascot-core-amiso' ),
				'label_block' => false,
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
//				'global' => array(
//					'active' => false,
//				),
				'condition' => array(
					'mouse_helper' => '1',
				),
			) );

			$element->add_control( 'mouse_helper_bd_color', array(
				'label' => __( 'Border color', 'mascot-core-amiso' ),
				'label_block' => false,
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
//				'global' => array(
//					'active' => false,
//				),
				'condition' => array(
					'mouse_helper' => '1',
				),
			) );

			$element->add_control( 'mouse_helper_color', array(
				'label' => __( 'Text color', 'mascot-core-amiso' ),
				'label_block' => false,
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
//				'global' => array(
//					'active' => false,
//				),
				'condition' => array(
					'mouse_helper' => '1',
				),
			) );

			$element->add_control( 'mouse_helper_mode', array(
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => __( 'Overlay mode', 'mascot-core-amiso' ),
				'label_block' => false,
				'options' => apply_filters( 'tm_addons_filter_mouse_helper_mode', array(
					'' => esc_html__( 'Default', 'mascot-core-amiso' ),
					'normal' => esc_html__( 'Normal', 'mascot-core-amiso' ),
					'multiply'  => esc_html__( 'Multiply', 'mascot-core-amiso' ),
					'screen'  => esc_html__( 'Screen', 'mascot-core-amiso' ),
					'overlay'  => esc_html__( 'Overlay', 'mascot-core-amiso' ),
					'darken'  => esc_html__( 'Darken', 'mascot-core-amiso' ),
					'lighten'  => esc_html__( 'Lighten', 'mascot-core-amiso' ),
					'color-dodge'  => esc_html__( 'Color Dodge', 'mascot-core-amiso' ),
					'color-burn'  => esc_html__( 'Color Burn', 'mascot-core-amiso' ),
					'hard-light'  => esc_html__( 'Hard Light', 'mascot-core-amiso' ),
					'soft-light'  => esc_html__( 'Soft Light', 'mascot-core-amiso' ),
					'difference'  => esc_html__( 'Difference', 'mascot-core-amiso' ),
					'exclusion'  => esc_html__( 'Exclusion', 'mascot-core-amiso' ),
					'hue'  => esc_html__( 'Hue', 'mascot-core-amiso' ),
					'saturation'  => esc_html__( 'Saturation', 'mascot-core-amiso' ),
					'color'  => esc_html__( 'Color', 'mascot-core-amiso' ),
					'luminosity'  => esc_html__( 'Luminosity', 'mascot-core-amiso' ),
				) ),
				'condition' => array(
					'mouse_helper' => '1'
				),
				'default' => '',
			) );

			$element->add_control( 'mouse_helper_axis', array(
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => __( 'Motion axis', 'mascot-core-amiso' ),
				'label_block' => false,
				'options' => array(
					'xy' => esc_html__( 'Both', 'mascot-core-amiso' ),
					'x'  => esc_html__( 'X only', 'mascot-core-amiso' ),
					'y'  => esc_html__( 'Y only', 'mascot-core-amiso' ),
				),
				'condition' => array(
					'mouse_helper' => '1'
				),
				'default' => 'xy',
			) );

			$element->add_control( 'mouse_helper_delay', array(
				'label' => __( 'Motion delay', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => array(
					'size' => (int) mascot_core_amiso_get_redux_option( 'mouse_helper_delay' ),
					'unit' => 'px'
				),
				'range' => array(
					'px' => array(
						'min' => 1,
						'max' => 20
					),
				),
				'size_units' => array( 'px' ),
				'condition' => array(
					'mouse_helper' => '1'
				),
			) );

			$element->add_control( 'mouse_helper_text', array(
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => __( 'Helper text', 'mascot-core-amiso' ),
				'label_block' => false,
				'condition' => array(
					'mouse_helper' => '1'
				),
			) );

			$element->add_control( 'mouse_helper_text_size', array(
				'label' => __( 'Text size', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => array(
					'size' => '',
					'unit' => 'px'
				),
				'range' => array(
					'px' => array(
						'min' => 0.2,
						'max' => 2,
						'step' => 0.1
					),
				),
				'size_units' => array( 'px' ),
				'condition' => array(
					'mouse_helper' => '1',
					'mouse_helper_text!' => ''
				),
			) );

			$element->add_control( 'mouse_helper_text_round', array(
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label' => __("Rotate text in a circle", 'mascot-core-amiso'),
				'label_on' => __( 'On', 'mascot-core-amiso' ),
				'label_off' => __( 'Off', 'mascot-core-amiso' ),
				'return_value' => '1',
				'default' => '',
				'condition' => array(
					'mouse_helper' => '1',
					'mouse_helper_text!' => ''
				),
			) );


			$element->add_control( 'mouse_helper_icon_size', array(
				'label' => __( 'Icon size', 'mascot-core-amiso' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => array(
					'size' => '',
					'unit' => 'px'
				),
				'range' => array(
					'px' => array(
						'min' => 1,
						'max' => 5,
						'step' => 0.1
					),
				),
				'size_units' => array( 'px' ),
				'condition' => array(
					'mouse_helper' => '1',
					'mouse_helper_icon[value]!' => '',
					'mouse_helper_icon[library]!' => ''
				),
			) );

			$element->add_control( 'mouse_helper_icon_color', array(
				'label' => __( 'Icon color', 'mascot-core-amiso' ),
				'label_block' => false,
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
//				'global' => array(
//					'active' => false,
//				),
				'condition' => array(
					'mouse_helper' => '1',
					'mouse_helper_icon!' => array( '', 'none' ),
				),
			) );

			$element->add_control( 'mouse_helper_image', array(
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label' => __( 'Image', 'mascot-core-amiso' ),
				'default' => array(
					'url' => '',
				),
				'condition' => array(
					'mouse_helper' => '1'
				),
			) );

			$element->add_control( 'mouse_helper_layout', array(
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label' => __( 'Custom layout', 'mascot-core-amiso' ),
				'condition' => array(
					'mouse_helper' => '1'
				),
			) );

			$element->add_control( 'mouse_helper_callback', array(
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => __( 'JS Callback', 'mascot-core-amiso' ),
				'condition' => array(
					'mouse_helper' => '1'
				),
			) );

			$element->end_controls_section();
		}
	}
}

// Add "data-mouse-helper" to the wrapper of the row
if ( !function_exists( 'tm_cursor_mouse_helper_before_render_elements' ) ) {
	// Before Elementor 2.1.0
	add_action( 'elementor/frontend/element/before_render',  'tm_cursor_mouse_helper_before_render_elements', 10, 1 );
	// After Elementor 2.1.0
	add_action( 'elementor/frontend/section/before_render', 'tm_cursor_mouse_helper_before_render_elements', 10, 1 );
	add_action( 'elementor/frontend/column/before_render', 'tm_cursor_mouse_helper_before_render_elements', 10, 1 );
	add_action( 'elementor/frontend/widget/before_render', 'tm_cursor_mouse_helper_before_render_elements', 10, 1 );
	function tm_cursor_mouse_helper_before_render_elements($element) {
		if ( is_object($element) ) {
			$mouse_helper = $element->get_settings( 'mouse_helper' );
			if ( ! empty( $mouse_helper ) ) {
        		$settings = $element->get_settings_for_display();
				$element->add_render_attribute( '_wrapper', array(
					'data-mouse-helper' => ! empty( $settings['mouse_helper_action'] ) ? $settings['mouse_helper_action'] : 'hover',
					'data-mouse-helper-centered' => (int) mascot_core_amiso_get_redux_option('mouse_helper_centered') == 0
														? ( ! empty( $settings['mouse_helper_centered'] ) ? $settings['mouse_helper_centered'] : 0 )
														: 1,
					'data-mouse-helper-magnet' => ! empty( $settings['mouse_helper_magnet'] ) ? max(0, $settings['mouse_helper_magnet']['size'] ) : 0,
					'data-mouse-helper-color' => ! empty( $settings['mouse_helper_color'] ) ? $settings['mouse_helper_color'] : '',
					'data-mouse-helper-bg-color' => ! empty( $settings['mouse_helper_bg_color'] ) ? $settings['mouse_helper_bg_color'] : '',
					'data-mouse-helper-bd-color' => ! empty( $settings['mouse_helper_bd_color'] ) ? $settings['mouse_helper_bd_color'] : '',
					'data-mouse-helper-mode' => ! empty( $settings['mouse_helper_mode'] ) ? $settings['mouse_helper_mode'] : '',
					'data-mouse-helper-axis' => ! empty( $settings['mouse_helper_axis'] ) ? $settings['mouse_helper_axis'] : 'xy',
					'data-mouse-helper-delay' => ! empty( $settings['mouse_helper_delay'] )
													?  $settings['mouse_helper_delay']['size']
													: ( mascot_core_amiso_get_redux_option( 'mouse_helper_delay' )
														? (int) mascot_core_amiso_get_redux_option( 'mouse_helper_delay' )
														: 10
														),
					'data-mouse-helper-text' => ! empty( $settings['mouse_helper_text'] ) ? $settings['mouse_helper_text'] : '',
					'data-mouse-helper-text-size'  => ! empty( $settings['mouse_helper_text'] ) && ! empty( $settings['mouse_helper_text_size']['size'] ) ? $settings['mouse_helper_text_size']['size'] : '',
					'data-mouse-helper-text-round' => ! empty( $settings['mouse_helper_text_round'] ) ? $settings['mouse_helper_text_round'] : 0,
					'data-mouse-helper-icon' => ! empty( $settings['mouse_helper_icon'] ) ? $settings['mouse_helper_icon'] : '',
					'data-mouse-helper-icon-size'  => ! empty( $settings['mouse_helper_icon'] ) && ! empty( $settings['mouse_helper_icon_size']['size'] ) ? $settings['mouse_helper_icon_size']['size'] : '',
					'data-mouse-helper-icon-color' => ! empty( $settings['mouse_helper_icon_color'] ) ? $settings['mouse_helper_icon_color'] : '',
					'data-mouse-helper-image' => ! empty( $settings['mouse_helper_image']['url'] ) ? $settings['mouse_helper_image']['url'] : '',
					'data-mouse-helper-layout' => ! empty( $settings['mouse_helper_layout'] ) ? $settings['mouse_helper_layout'] : '',
					'data-mouse-helper-callback' => ! empty( $settings['mouse_helper_callback'] ) ? $settings['mouse_helper_callback'] : '',
				) );
				if ( ! mascot_core_is_preview() ) {
					$element->add_render_attribute( '_wrapper', array(
						'data-mouse-helper-hide-cursor' => ! empty( $settings['mouse_helper_hide_cursor'] ) ? $settings['mouse_helper_hide_cursor'] : 0,
					) );
				}
			}
		}
	}
}