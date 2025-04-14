<?php
use Elementor\Controls_Manager;

if(!function_exists('mascot_core_get_cpt_shortcode_template_part')) {
	/**
	 * Load a cpt shortcode template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function mascot_core_get_cpt_shortcode_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start  = false ) {

		$template_path = 'cpt/' . $folder . '/' . $slug;

		return mascot_core_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

	}
}

if(!function_exists('mascot_core_get_shortcode_template_part')) {
	/**
	 * Load a shortcode template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function mascot_core_get_shortcode_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start  = false ) {

		$template_path = 'widgets/' . $folder . '/' . $slug;

		return mascot_core_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

	}
}

if(!function_exists('mascot_core_get_shortcode_current_theme_template_part')) {
	/**
	 * Load a shortcode template part into a template
	 *
	 * @param string $slug The slug name for the generic template.
	 * @param string $name The name of the specialised template.
	 * @param string $folder The name of the specialised folder.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function mascot_core_get_shortcode_current_theme_template_part( $slug, $name = null, $folder = '', $params = array(), $shortcode_ob_start  = false ) {

		$template_path = 'widgets-current-theme/' . $folder . '/' . $slug;

		return mascot_core_get_template_part( $template_path, $name, $params, $shortcode_ob_start );

	}
}


if(!function_exists('mascot_core_get_template_part')) {
	/**
	 * Load a template part into a template
	 *
	 * @param string $template_path path of the specialised template.
	 * @param string $name The name of the specialised template.
	 * @param array $params array of parameters to pass to the template.
	 * @param boolean $shortcode_ob_start only for shortcodes to get HTML string.
	 */
	function mascot_core_get_template_part( $template_path, $name = null, $params = array(), $shortcode_ob_start = false ) {

		$output_html = '';

		if( is_array($params) && count($params) ) {
			extract($params);
		}

		$templates = array();
		$name = (string) $name;
		if ( '' !== $name )
			$templates[] = "{$template_path}-{$name}.php";

		$templates[] = "{$template_path}.php";

		$located = mascot_core_locate_template($templates);

		if($located) {
			if( $shortcode_ob_start ) {
				ob_start();
				include($located);
				$output_html = ob_get_clean();
			} else {
				include($located);
			}
		}

		return $output_html;
	}
}

if(!function_exists('mascot_core_locate_template')) {
	/**
	 * Retrieve the name of the highest priority template file that exists.
	 *
	 * Searches in the MASCOT_STYLESHEET_DIR before MASCOT_TEMPLATE_DIR
	 * so that themes which inherit from a parent theme can just overload one file.
	 *
	 * @param string|array $template_names Template file(s) to search for, in order.
	 * @return string The template filename if one is located.
	 */
	function mascot_core_locate_template($template_names) {
		$located = '';
		foreach ( (array) $template_names as $template_name ) {
			if ( !$template_name ) {
				continue;
			}
			if ( file_exists(MASCOT_CORE_ELEMENTOR_ABS_PATH . '/' . $template_name)) {
				$located = MASCOT_CORE_ELEMENTOR_ABS_PATH . '/' . $template_name;
				break;
			}
		}
		return $located;
	}
}


if ( ! function_exists('mascot_core_get_yes_no_select_array') ) {
	/**
	 * Returns array of yes no
	 * @return array
	 */
	function mascot_core_get_yes_no_select_array($enable_default = true, $set_yes_to_be_first = false ) {
		$select_options = array();

		if ( $enable_default ) {
			$select_options[''] = esc_html__( 'Default', 'mascot-core' );
		}

		if ( $set_yes_to_be_first ) {
			$select_options['yes'] = esc_html__( 'Yes', 'mascot-core' );
			$select_options['no']  = esc_html__( 'No', 'mascot-core' );
		} else {
			$select_options['no']  = esc_html__( 'No', 'mascot-core' );
			$select_options['yes'] = esc_html__( 'Yes', 'mascot-core' );
		}

		return $select_options;
	}
}
if( ! function_exists('mascot_core_add_elementor_widget_categories') ) {
		function mascot_core_add_elementor_widget_categories($elements_manager) {

			$elements_manager->add_category(
				'tm',
				[
					'title' => esc_html__('Mascot', 'mascot-core'),
					'icon' => 'fa fa-plug',
				]
			);

		}

		add_action('elementor/elements/categories_registered', 'mascot_core_add_elementor_widget_categories');
};



if(!function_exists('mascot_core_get_button_arraylist')) {
	/**
	 * Return Button Array List
	 */
	function mascot_core_get_button_arraylist( $control_object, $serial, $prefix = '', $btn_condition = false ) {
		$array = array();

		switch ( $serial ) {
			case '1':
				if( $btn_condition ) {
					$control_object->add_control(
						$prefix . "btn_design_style", [
							'label' => esc_html__( "Button Design Style", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'options' => mascot_core_get_btn_design_style(),
							'default' => 'btn-theme-colored1',
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_control(
						$prefix . "btn_design_style", [
							'label' => esc_html__( "Button Design Style", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'options' => mascot_core_get_btn_design_style(),
							'default' => 'btn-theme-colored1',
						]
					);
				}
				break;

			case '2':
				if( $btn_condition ) {
					$control_object->add_control(
						$prefix . "button_size", [
							'label' => esc_html__( "Button Size", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'options' => mascot_core_get_button_size(),
							'default' => '',
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_control(
						$prefix . "button_size", [
							'label' => esc_html__( "Button Size", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'options' => mascot_core_get_button_size(),
							'default' => '',
						]
					);
				}
				break;

			case '3':
				if( $btn_condition ) {
					$control_object->add_responsive_control(
						$prefix . "button_alignment", [
							'label' => esc_html__( "Button Alignment", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::CHOOSE,
							'options' => mascot_core_text_align_choose(),
							'selectors' => [
								'{{WRAPPER}} .btn-view-details' => 'text-align: {{VALUE}};'
							],
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
					$control_object->add_responsive_control(
						$prefix . "button_text_alignment", [
							'label' => esc_html__( "Button Text Alignment", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::CHOOSE,
							'options' => mascot_core_text_align_choose(),
							'selectors' => [
								'{{WRAPPER}} .btn-view-details > a' => 'text-align: {{VALUE}};'
							],
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_responsive_control(
						$prefix . "button_alignment", [
							'label' => esc_html__( "Button Alignment", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::CHOOSE,
							'options' => mascot_core_text_align_choose(),
							'selectors' => [
								'{{WRAPPER}} .btn-view-details' => 'text-align: {{VALUE}};'
							],
						]
					);
					$control_object->add_responsive_control(
						$prefix . "button_text_alignment", [
							'label' => esc_html__( "Button Text Alignment", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::CHOOSE,
							'options' => mascot_core_text_align_choose(),
							'selectors' => [
								'{{WRAPPER}} .btn-view-details > a' => 'text-align: {{VALUE}};'
							],
						]
					);
				}
				break;

			case '4':
				if( $btn_condition ) {
					$control_object->add_control(
						$prefix . "button_hover_animation_effect", [
							'label' => esc_html__( "Animation Effect", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'options' => array(
								''	=> 	esc_html__( 'None', 'mascot-core' ),
								'hvr-sweep-to-right'	=> 	esc_html__( 'Sweep To Right', 'mascot-core' ),
								'hvr-bounce-to-right'	=> 	esc_html__( 'Bounce To Right', 'mascot-core' ),
								'hvr-shutter-out-horizontal'	=> 	esc_html__( 'Shutter Out Horizontal', 'mascot-core' ),
								'btn-arrow-hover-animation'	=> 	esc_html__( 'Arrow Hover Animation', 'mascot-core' ),
							),
							'default' => '',
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_control(
						$prefix . "button_hover_animation_effect", [
							'label' => esc_html__( "Animation Effect", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SELECT,
							'options' => array(
								''	=> 	esc_html__( 'None', 'mascot-core' ),
								'hvr-sweep-to-right'	=> 	esc_html__( 'Sweep To Right', 'mascot-core' ),
								'hvr-bounce-to-right'	=> 	esc_html__( 'Bounce To Right', 'mascot-core' ),
								'hvr-shutter-out-horizontal'	=> 	esc_html__( 'Shutter Out Horizontal', 'mascot-core' ),
								'btn-arrow-hover-animation'	=> 	esc_html__( 'Arrow Hover Animation', 'mascot-core' ),
							),
							'default' => '',
						]
					);
				}
				break;

			case '5':
				if( $btn_condition ) {
					$control_object->add_control(
						$prefix . "btn_class", [
							'label' => esc_html__( "Custom CSS Class", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::TEXT,
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_control(
						$prefix . "btn_class", [
							'label' => esc_html__( "Custom CSS Class", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::TEXT,
						]
					);
				}
				break;

			case '6':
				if( $btn_condition ) {
					$control_object->add_control(
						$prefix . "btn_outlined", [
							'label' => esc_html__( "Make Button Outlined", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_control(
						$prefix . "btn_outlined", [
							'label' => esc_html__( "Make Button Outlined", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SWITCHER,
						]
					);
				}
				break;

			case '7':
				if( $btn_condition ) {
					$control_object->add_control(
						$prefix . "btn_round", [
							'label' => esc_html__( "Make Button Round", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_control(
						$prefix . "btn_round", [
							'label' => esc_html__( "Make Button Round", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SWITCHER,
						]
					);
				}
				break;

			case '8':
				if( $btn_condition ) {
					$control_object->add_control(
						$prefix . "btn_flat", [
							'label' => esc_html__( "Make Button Flat", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_control(
						$prefix . "btn_flat", [
							'label' => esc_html__( "Make Button Flat", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SWITCHER,
						]
					);
				}
				break;

			case '9':
				if( $btn_condition ) {
					$control_object->add_responsive_control(
						$prefix . "btn_block", [
							'label' => esc_html__( "Button Fullwidth (Block Level Button)", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'selectors' => [
								'{{WRAPPER}} .btn-view-details' => 'display:grid;'
							],
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_responsive_control(
						$prefix . "btn_block", [
							'label' => esc_html__( "Button Fullwidth (Block Level Button)", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'selectors' => [
								'{{WRAPPER}} .btn-view-details' => 'display:grid;'
							],
						]
					);
				}
				break;

			case '10':
				if( $btn_condition ) {
					$control_object->add_control(
						$prefix . "btn_threed_effect", [
							'label' => esc_html__( "3D Effect", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_control(
						$prefix . "btn_threed_effect", [
							'label' => esc_html__( "3D Effect", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SWITCHER,
						]
					);
				}
				break;

			case '11':
				if( $btn_condition ) {
					$control_object->add_control(
						$prefix . "btn_gradient_effect", [
							'label' => esc_html__( "Gradient Effect", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_control(
						$prefix . "btn_gradient_effect", [
							'label' => esc_html__( "Gradient Effect", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::SWITCHER,
						]
					);
				}
				break;

			case '12':
				if( $btn_condition ) {
					$control_object->add_responsive_control(
						$prefix . "btn_link_color", [
							'label' => esc_html__( "Link Color", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .btn-view-details a' => 'color: {{VALUE}};'
							],
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_responsive_control(
						$prefix . "btn_link_color", [
							'label' => esc_html__( "Link Color", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .btn-view-details a' => 'color: {{VALUE}};'
							],
						]
					);
				}
				break;

			case '13':
				if( $btn_condition ) {
					$control_object->add_responsive_control(
						$prefix . "btn_link_color_hover", [
							'label' => esc_html__( "Link Color on Hover", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}}:hover .btn-view-details a' => 'color: {{VALUE}};'
							],
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_responsive_control(
						$prefix . "btn_link_color_hover", [
							'label' => esc_html__( "Link Color on Hover", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}}:hover .btn-view-details a' => 'color: {{VALUE}};'
							],
						]
					);
				}
				break;

			case '14':
				if( $btn_condition ) {
					$control_object->add_responsive_control(
						$prefix . "btn_bg_color", [
							'label' => esc_html__( "Link Background Color", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .btn-view-details a' => 'background-color: {{VALUE}};'
							],
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_responsive_control(
						$prefix . "btn_bg_color", [
							'label' => esc_html__( "Link Background Color", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .btn-view-details a' => 'background-color: {{VALUE}};'
							],
						]
					);
				}
				break;

			case '15':
				if( $btn_condition ) {
					$control_object->add_responsive_control(
						$prefix . "btn_bg_color_hover", [
							'label' => esc_html__( "Link Background Color on Hover", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}}:hover .btn-view-details a' => 'background-color: {{VALUE}};'
							],
							'condition' => [
								$prefix . 'show_view_details_button' => array('yes')
							]
						]
					);
				} else {
					$control_object->add_responsive_control(
						$prefix . "btn_bg_color_hover", [
							'label' => esc_html__( "Link Background Color on Hover", 'mascot-core' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}}:hover .btn-view-details a' => 'background-color: {{VALUE}};'
							],
						]
					);
				}
				break;

			default:
				# code...
				break;
		}

		return $array;
	}
}



















if(!function_exists('mascot_core_get_button_text_color_typo_arraylist')) {
	/**
	 * Return Button Text Colro Typo Array List
	 */
	function mascot_core_get_button_text_color_typo_arraylist( $control_object, $serial) {
		$array = array();

		switch ( $serial ) {
			case '1':
				$control_object->start_controls_tabs('tabs_button_wrapper_style');
				$control_object->start_controls_tab(
					'button_typo_normal',
					[
						'label' => esc_html__('Normal', 'mascot-core'),
					]
				);
				$control_object->add_control(
					'button_bg_custom_color_options',
					[
						'label' => esc_html__( 'Background Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);
				$control_object->add_responsive_control(
					'button_bg_custom_color', [
						'label' => esc_html__( "BG Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .btn' => 'background-color: {{VALUE}};'
						]
					]
				);
				$control_object->add_responsive_control(
					'button_bg_theme_colored', [
						'label' => esc_html__( "BG Theme Colored", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .btn' => 'background-color: var(--theme-color{{VALUE}});'
						],
					]
				);
				$control_object->add_control(
					'button_text_color_options',
					[
						'label' => esc_html__( 'Text Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					'button_text_color', [
						'label' => esc_html__( "Button Text Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .btn' => 'color: {{VALUE}} !important;',
						]
					]
				);
				$control_object->add_responsive_control(
					'button_text_theme_colored', [
						'label' => esc_html__( "Button Text Theme Colored", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .btn' => 'color: var(--theme-color{{VALUE}}) !important;'
						],
					]
				);
				$control_object->add_group_control(
					\Elementor\Group_Control_Typography::get_type(), [
						'name' => 'button_text_typography',
						'label' => esc_html__( 'Button Text Typography', 'mascot-core' ),
						'selector' => '{{WRAPPER}} .btn',
					]
				);
				$control_object->add_control(
					'button_arrow_color_options',
					[
						'label' => esc_html__( 'Arrow Color Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					'button_arrow_color', [
						'label' => esc_html__( "Arrow Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .btn:after' => 'color: {{VALUE}} !important;',
							'{{WRAPPER}} .btn:before' => 'color: {{VALUE}} !important;',
						]
					]
				);
				$control_object->add_responsive_control(
					'button_arrow_theme_colored', [
						'label' => esc_html__( "Arrow Theme Colored", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .btn:after' => 'color: var(--theme-color{{VALUE}}) !important;',
							'{{WRAPPER}} .btn:before' => 'color: var(--theme-color{{VALUE}}) !important;',
						],
					]
				);
				$control_object->add_control(
					'btn_border_options',
					[
						'label' => esc_html__( 'Border Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'btn_border',
						'label' => esc_html__( 'Border', 'mascot-core' ),
						'selector' => '{{WRAPPER}} .btn',
					]
				);
				$control_object->add_responsive_control(
					'btn_border_radius',
					[
						'label' => esc_html__( "Border Radius", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);
				$control_object->add_responsive_control(
					'btn_border_custom_color', [
						'label' => esc_html__( "Border Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .btn' => 'border-color: {{VALUE}} !important;'
						]
					]
				);
				$control_object->add_responsive_control(
					'btn_border_theme_colored', [
						'label' => esc_html__( "Border Theme Colored", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .btn' => 'border-color: var(--theme-color{{VALUE}}) !important;'
						],
					]
				);


				
				$control_object->add_control(
					'btn_boxshadow_options',
					[
						'label' => esc_html__( 'Box Shadow Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'btn_boxshadow',
						'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
						'selector' => '{{WRAPPER}} .btn',
					]
				);
				$control_object->add_control(
					'btn_padding_options',
					[
						'label' => esc_html__( 'Padding Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					'btn_padding',
					[
						'label' => esc_html__( 'Button Padding', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$control_object->add_responsive_control(
					'btn_margin',
					[
						'label' => esc_html__( 'Button Margin', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$control_object->add_control(
					'button_icon_color_options',
					[
						'label' => esc_html__( 'Icon Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					'button_icon_color', [
						'label' => esc_html__( "Button Icon Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .btn:after, {{WRAPPER}} .btn:before' => 'color: {{VALUE}};'
						]
					]
				);
				$control_object->add_responsive_control(
					'button_icon_theme_colored', [
						'label' => esc_html__( "Button Icon Theme Colored", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .btn:after, {{WRAPPER}} .btn:before' => 'color: var(--theme-color{{VALUE}});'
						],
					]
				);
				$control_object->end_controls_tab();









				$control_object->start_controls_tab(
					'button_typo_hover',
					[
						'label' => esc_html__('Hover', 'mascot-core'),
					]
				);
				$control_object->add_control(
					'button_bg_custom_color_options_hover',
					[
						'label' => esc_html__( 'Background Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);
				$control_object->add_responsive_control(
					'button_bg_color_hover', [
						'label' => esc_html__( "BG Color (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .btn:hover,{{WRAPPER}} .btn:focus' => 'background-color: {{VALUE}};'
						]
					]
				);
				$control_object->add_responsive_control(
					'button_bg_color_hover_animated', [
						'label' => esc_html__( "BG Color (Hover Animated)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .btn:hover:before,{{WRAPPER}} .btn:focus:before' => 'background-color: {{VALUE}};'
						]
					]
				);
				$control_object->add_responsive_control(
					'button_bg_theme_colored_hover', [
						'label' => esc_html__( "BG Theme Colored (Hover Animated)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .btn:hover:before' => 'background-color: var(--theme-color{{VALUE}});',
							'{{WRAPPER}} .btn:hover:after' => 'background-color: var(--theme-color{{VALUE}});'
						],
					]
				);
				$control_object->add_responsive_control(
					'button_bg_theme_colored_hover_only', [
						'label' => esc_html__( "BG Theme Colored (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .btn:hover' => 'background-color: var(--theme-color{{VALUE}});'
						],
					]
				);
				$control_object->add_control(
					'button_text_color_options_hover',
					[
						'label' => esc_html__( 'Text Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					'button_text_color_hover', [
						'label' => esc_html__( "Button Text Color (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .btn:hover' => 'color: {{VALUE}} !important;',
							'{{WRAPPER}} .btn:focus' => 'color: {{VALUE}} !important;',
						]
					]
				);
				$control_object->add_responsive_control(
					'button_text_theme_colored_hover', [
						'label' => esc_html__( "Button Text Theme Colored (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .btn:hover' => 'color: var(--theme-color{{VALUE}}) !important;',
							'{{WRAPPER}} .btn:focus' => 'color: var(--theme-color{{VALUE}}) !important;'
						],
					]
				);
				$control_object->add_control(
					'button_arrow_color_options_hover',
					[
						'label' => esc_html__( 'Arrow Color Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					'button_arrow_color_hover', [
						'label' => esc_html__( "Arrow Color (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .btn:hover:after' => 'color: {{VALUE}} !important;',
							'{{WRAPPER}} .btn:focus:after' => 'color: {{VALUE}} !important;',
							'{{WRAPPER}} .btn:hover:before' => 'color: {{VALUE}} !important;',
							'{{WRAPPER}} .btn:focus:before' => 'color: {{VALUE}} !important;',
						]
					]
				);
				$control_object->add_responsive_control(
					'button_arrow_theme_colored_hover', [
						'label' => esc_html__( "Arrow Theme Colored (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .btn:hover:after' => 'color: var(--theme-color{{VALUE}}) !important;',
							'{{WRAPPER}} .btn:focus:after' => 'color: var(--theme-color{{VALUE}}) !important;',
							'{{WRAPPER}} .btn:hover:before' => 'color: var(--theme-color{{VALUE}}) !important;',
							'{{WRAPPER}} .btn:focus:before' => 'color: var(--theme-color{{VALUE}}) !important;',
						],
					]
				);
				$control_object->add_control(
					'btn_border_options_hover',
					[
						'label' => esc_html__( 'Border Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					'btn_border_custom_color_hover', [
						'label' => esc_html__( "Border Color (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .btn:hover' => 'border-color: {{VALUE}} !important;',
							'{{WRAPPER}} .btn:focus' => 'border-color: {{VALUE}} !important;',
						]
					]
				);
				$control_object->add_responsive_control(
					'btn_border_theme_colored_hover', [
						'label' => esc_html__( "Border Theme Colored (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .btn:hover' => 'border-color: var(--theme-color{{VALUE}}) !important;',
							'{{WRAPPER}} .btn:focus' => 'border-color: var(--theme-color{{VALUE}}) !important;'
						],
					]
				);
				$control_object->add_control(
					'btn_boxshadow_options_hover',
					[
						'label' => esc_html__( 'Box Shadow Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'btn_boxshadow_hover',
						'label' => esc_html__( 'Box Shadow(Hover)', 'mascot-core' ),
						'selector' => '{{WRAPPER}} .btn:hover',
					]
				);
				$control_object->add_control(
					'button_icon_color_options_hover',
					[
						'label' => esc_html__( 'Icon Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					'button_icon_color_hover', [
						'label' => esc_html__( "Button Icon Color (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .btn:hover:after, {{WRAPPER}} .btn:hover:before' => 'color: {{VALUE}};'
						]
					]
				);
				$control_object->add_responsive_control(
					'button_icon_theme_colored_hover', [
						'label' => esc_html__( "Button Icon Theme Colored (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .btn:hover:after, {{WRAPPER}} .btn:hover:before' => 'color: var(--theme-color{{VALUE}});'
						],
					]
				);
				$control_object->end_controls_tab();




				$control_object->start_controls_tab(
					'button_typo_wrapper_hover',
					[
						'label' => esc_html__('Wrapper Hover', 'mascot-core'),
					]
				);
				$control_object->add_control(
					'button_bg_custom_color_options_wrapper_hover',
					[
						'label' => esc_html__( 'Background Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);
				$control_object->add_responsive_control(
					'button_bg_color_wrapper_hover', [
						'label' => esc_html__( "BG Color (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}}:hover .btn' => 'background-color: {{VALUE}};'
						]
					]
				);
				$control_object->add_responsive_control(
					'button_bg_theme_colored_wrapper_hover', [
						'label' => esc_html__( "BG Theme Colored (Hover Animated)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}}:hover .btn:before' => 'background-color: var(--theme-color{{VALUE}});',
							'{{WRAPPER}}:hover .btn:after' => 'background-color: var(--theme-color{{VALUE}});'
						],
					]
				);
				$control_object->add_responsive_control(
					'button_bg_theme_colored_hoverwrapper__only', [
						'label' => esc_html__( "BG Theme Colored (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}}:hover .btn' => 'background-color: var(--theme-color{{VALUE}});'
						],
					]
				);
				$control_object->add_control(
					'button_text_color_options_wrapper_hover',
					[
						'label' => esc_html__( 'Text Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					'button_text_color_wrapper_hover', [
						'label' => esc_html__( "Button Text Color (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}}:hover .btn' => 'color: {{VALUE}} !important;',
						]
					]
				);
				$control_object->add_responsive_control(
					'button_text_theme_colored_wrapper_hover', [
						'label' => esc_html__( "Button Text Theme Colored (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}}:hover .btn' => 'color: var(--theme-color{{VALUE}}) !important;',
						],
					]
				);
				$control_object->add_control(
					'button_arrow_color_options_wrapper_hover',
					[
						'label' => esc_html__( 'Arrow Color Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					'button_arrow_color_wrapper_hover', [
						'label' => esc_html__( "Arrow Color (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}}:hover .btn:after' => 'color: {{VALUE}} !important;',
							'{{WRAPPER}}:hover .btn:before' => 'color: {{VALUE}} !important;',
						]
					]
				);
				$control_object->add_responsive_control(
					'button_arrow_theme_colored_wrapper_hover', [
						'label' => esc_html__( "Arrow Theme Colored (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}}:hover .btn:after' => 'color: var(--theme-color{{VALUE}}) !important;',
							'{{WRAPPER}}:hover .btn:before' => 'color: var(--theme-color{{VALUE}}) !important;',
						],
					]
				);
				$control_object->add_control(
					'btn_border_options_wrapper_hover',
					[
						'label' => esc_html__( 'Border Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					'btn_border_custom_color_wrapper_hover', [
						'label' => esc_html__( "Border Color (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}}:hover .btn' => 'border-color: {{VALUE}} !important;',
						]
					]
				);
				$control_object->add_responsive_control(
					'btn_border_theme_colored_wrapper_hover', [
						'label' => esc_html__( "Border Theme Colored (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}}:hover .btn' => 'border-color: var(--theme-color{{VALUE}}) !important;',
						],
					]
				);
				$control_object->add_control(
					'btn_boxshadow_options_wrapper_hover',
					[
						'label' => esc_html__( 'Box Shadow Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'btn_boxshadow_wrapper_hover',
						'label' => esc_html__( 'Box Shadow(Hover)', 'mascot-core' ),
						'selector' => '{{WRAPPER}}:hover .btn',
					]
				);
				$control_object->add_control(
					'button_icon_color_options_wrapper_hover',
					[
						'label' => esc_html__( 'Icon Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					'button_icon_color_wrapper_hover', [
						'label' => esc_html__( "Button Icon Color (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}}:hover .btn:after, {{WRAPPER}}:hover .btn:before' => 'color: {{VALUE}};'
						]
					]
				);
				$control_object->add_responsive_control(
					'button_icon_theme_colored_wrapper_hover', [
						'label' => esc_html__( "Button Icon Theme Colored (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}}:hover .btn:after, {{WRAPPER}}:hover .btn:before' => 'color: var(--theme-color{{VALUE}});'
						],
					]
				);
				$control_object->end_controls_tab();
				$control_object->end_controls_tabs();
				break;
			case '2':
				break;
			case '3':
				break;
			case '4':
				break;
			case '5':
				break;
			case '6':
				break;
			case '7':
				break;
			case '8':
				break;
			case '9':
				break;

			default:
				# code...
				break;
		}

		return $array;
	}
}

































if(!function_exists('mascot_core_get_viewdetails_button_arraylist')) {
	/**
	 * Return Button Show Array List
	 */
	function mascot_core_get_viewdetails_button_arraylist( $control_object, $serial, $btn_text = '', $prefix = '', $std = 'true' ) {
		$array = array();
		if( $btn_text == '' ) $btn_text = esc_html__( 'Read More', 'mascot-core' );

		switch ( $serial ) {
			case '1':
				$control_object->add_control(
					$prefix . "show_view_details_button", [
						'label' => sprintf( esc_html__( "Show %s Button", 'mascot-core' ), $btn_text ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'no',
					]
				);
				break;

			case '2':
				$control_object->add_control(
					$prefix . "view_details_button_text", [
						'label' => sprintf( esc_html__( "%s Button Text", 'mascot-core' ), $btn_text ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html( $btn_text ),
						'condition' => [
							$prefix . 'show_view_details_button' => array('yes')
						]
					]
				);
				break;

			default:
				# code...
				break;
		}
	}
}

if(!function_exists('mascot_core_get_button_control')) {
	/**
	 * Return Button Show Array List
	 */
	function mascot_core_get_button_control($control_object, $show_btn_switcher = false ) {

		if( $show_btn_switcher ) {
			$control_object->start_controls_section(
				'button_show_hide', [
					'label' => esc_html__( 'Button Show/Hide', 'mascot-core' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
			mascot_core_get_viewdetails_button_arraylist($control_object, 1);
			mascot_core_get_viewdetails_button_arraylist($control_object, 2);
			$control_object->end_controls_section();
		}

		if( $show_btn_switcher ) {
			$control_object->start_controls_section(
				'button_options', [
					'label' => esc_html__( 'Button Options', 'mascot-core' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
					'condition' => [
						'show_view_details_button' => array('yes')
					]
				]
			);
		} else {
			$control_object->start_controls_section(
				'button_options', [
					'label' => esc_html__( 'Button Options', 'mascot-core' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
		}


		mascot_core_get_button_arraylist($control_object, 1);
		mascot_core_get_button_arraylist($control_object, 2);
		mascot_core_get_button_arraylist($control_object, 3);
		mascot_core_get_button_arraylist($control_object, 4);
		mascot_core_get_button_arraylist($control_object, 5);
		mascot_core_get_button_arraylist($control_object, 6);
		mascot_core_get_button_arraylist($control_object, 7);
		mascot_core_get_button_arraylist($control_object, 8);
		mascot_core_get_button_arraylist($control_object, 9);
		mascot_core_get_button_arraylist($control_object, 10);
		mascot_core_get_button_arraylist($control_object, 11);
		mascot_core_get_button_arraylist($control_object, 12);
		$control_object->add_responsive_control(
			'tm_btn_padding',
			[
				'label' => esc_html__( 'Button Padding', 'mascot-core' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$control_object->end_controls_section();




		if( $show_btn_switcher ) {
			$control_object->start_controls_section(
				'button_color_typo_options', [
					'label' => esc_html__( 'Button Color/Typography', 'mascot-core' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
					'condition' => [
						'show_view_details_button' => array('yes')
					]
				]
			);
		} else {
			$control_object->start_controls_section(
				'button_color_typo_options', [
					'label' => esc_html__( 'Button Color/Typography', 'mascot-core' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
		}
		mascot_core_get_button_text_color_typo_arraylist($control_object, 1);
		mascot_core_get_button_text_color_typo_arraylist($control_object, 2);
		mascot_core_get_button_text_color_typo_arraylist($control_object, 3);
		mascot_core_get_button_text_color_typo_arraylist($control_object, 4);
		mascot_core_get_button_text_color_typo_arraylist($control_object, 5);
		mascot_core_get_button_text_color_typo_arraylist($control_object, 6);
		mascot_core_get_button_text_color_typo_arraylist($control_object, 7);
		mascot_core_get_button_text_color_typo_arraylist($control_object, 8);
		mascot_core_get_button_text_color_typo_arraylist($control_object, 9);
		$control_object->end_controls_section();
	}
}

if(!function_exists('mascot_core_get_loadmore_button_control')) {
	/**
	 * Return Loadmore Button Show Array List
	 */
	function mascot_core_get_loadmore_button_control($control_object) {
		$control_object->start_controls_section(
			'loadmore_button_options', [
					'label' => esc_html__( 'Loadmore Button Options', 'mascot-core' ),
					'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		mascot_core_get_viewdetails_button_arraylist($control_object, 1,  esc_html__( "Load More", 'mascot-core' ), 'loadmore_');
		mascot_core_get_viewdetails_button_arraylist($control_object, 2,  esc_html__( "Load More", 'mascot-core' ), 'loadmore_');
		mascot_core_get_button_arraylist($control_object, 1, 'loadmore_');
		mascot_core_get_button_arraylist($control_object, 2, 'loadmore_');
		mascot_core_get_button_arraylist($control_object, 3, 'loadmore_');
		mascot_core_get_button_arraylist($control_object, 4, 'loadmore_');
		mascot_core_get_button_arraylist($control_object, 5, 'loadmore_');
		mascot_core_get_button_arraylist($control_object, 6, 'loadmore_');
		mascot_core_get_button_arraylist($control_object, 7, 'loadmore_');
		mascot_core_get_button_arraylist($control_object, 8, 'loadmore_');
		mascot_core_get_button_arraylist($control_object, 9, 'loadmore_');
		mascot_core_get_button_arraylist($control_object, 10, 'loadmore_');
		mascot_core_get_button_arraylist($control_object, 11, 'loadmore_');
		mascot_core_get_button_arraylist($control_object, 12, 'loadmore_');
		$control_object->end_controls_section();
	}
}

if(!function_exists('mascot_core_font_style_list')) {
	/**
	 * Font Style List
	 */
	function mascot_core_font_style_list() {
		$font_style_list = array(
			''	=>	esc_html__( 'Normal', 'mascot-core'),
			'italic'	=>	esc_html__( 'Italic', 'mascot-core')
		);
		return $font_style_list;
	}
}

if(!function_exists('mascot_core_font_weight_list')) {
	/**
	 * Font weight List
	 */
	function mascot_core_font_weight_list() {
		$font_weight_list = array(
			''			=>	esc_html__( 'Default', 'mascot-core'),
			'100'   => '100',
			'200'   => '200',
			'300'   => '300',
			'400'   => '400',
			'500'   => '500',
			'600'   => '600',
			'700'   => '700',
			'800'   => '800',
		);
		return $font_weight_list;
	}
}

if(!function_exists('mascot_core_text_transform_list')) {
	/**
	 * Text Transform List
	 */
	function mascot_core_text_transform_list() {
		$text_transform_list = array(
			''	=>	esc_html__( 'Default', 'mascot-core'),
			'none'	=>	esc_html__( 'None', 'mascot-core'),
			'capitalize'	=>	esc_html__( 'Capitalize', 'mascot-core'),
			'uppercase'	=>	esc_html__( 'Uppercase', 'mascot-core'),
			'lowercase'	=>	esc_html__( 'Lowercase', 'mascot-core'),
			'initial'	=>	esc_html__( 'Initial', 'mascot-core'),
			'inherit'	=>	esc_html__( 'Inherit', 'mascot-core')
		);
		return $text_transform_list;
	}
}

if(!function_exists('mascot_core_get_btn_design_style')) {
	/**
	 * Return Design Style
	 */
	function mascot_core_get_btn_design_style() {
		$array = array(
			'btn-circle-arrow'	=>	esc_html__( 'Circle With Arrow', 'mascot-core'),
			'btn-plain-text'	=>	esc_html__( 'Plain Text', 'mascot-core'),
			'btn-plain-text-with-arrow'	=>	esc_html__( 'Plain Text + Arrow Left', 'mascot-core'),
			'btn-plain-text-with-arrow-right'	=>	esc_html__( 'Plain Text + Arrow Right', 'mascot-core'),
			'btn-dark'	=>	esc_html__( 'Button Dark', 'mascot-core'),
			'btn-light'	=>	esc_html__( 'Button Light', 'mascot-core'),
			'btn-modern-white'	=>	esc_html__( 'Button Modern White', 'mascot-core'),
			'btn-modern-theme-colored'	=>	esc_html__( 'Button Modern Theme Colored', 'mascot-core'),
			'btn-primary'	=>	esc_html__( 'Button Primary', 'mascot-core'),
			'btn-secondary'	=>	esc_html__( 'Button Secondary', 'mascot-core'),
			'btn-success'	=>	esc_html__( 'Button Success', 'mascot-core'),
			'btn-danger'	=>	esc_html__( 'Button Danger', 'mascot-core'),
			'btn-warning'	=>	esc_html__( 'Button Warning', 'mascot-core'),
			'btn-info'	=>	esc_html__( 'Button Info', 'mascot-core'),
			'btn-gray'	=>	esc_html__( 'Button Gray', 'mascot-core'),
		);

		$array_theme_color = array();
		for ($i=1; $i <= mascot_core_number_of_theme_colors(); $i++) {
			$array_theme_color[ 'btn-theme-colored' . $i ] = esc_html__( 'Button Theme Colored', 'mascot-core') . ' ' . $i;
		}

		$array = array_merge($array_theme_color, $array);
		return $array;
	}
}

if(!function_exists('mascot_core_get_button_size')) {
	/**
	 * Return Button Size
	 */
	function mascot_core_get_button_size() {
		$array = array(
			''	=>	esc_html__( 'Default', 'mascot-core'),
			'btn-lg'	=>	esc_html__( 'Large', 'mascot-core'),
			'btn-sm'	=>	esc_html__( 'Small', 'mascot-core'),
			'btn-xs'	=>	esc_html__( 'Extra Small', 'mascot-core')
		);
		return $array;
	}
}


if ( ! function_exists( 'mascot_core_get_available_image_sizes' ) ) {
	/**
	 * Get information about available image sizes
	 */
	function mascot_core_get_available_image_sizes() {
		$size = array();
		$available_image_sizes = mascot_core_get_available_image_sizes_array();

		// Create the full array with sizes and crop info
		foreach( $available_image_sizes as $key => $value ) {
			$sizes[ $key ]	=	$key . ( ($value['crop'] == 1) ? ' - cropped' : '') . ' - (' .$value['width'] . 'x' . $value['height'] . ')';
		}
		return $sizes;
	}
}


if ( ! function_exists( 'mascot_core_get_available_image_sizes_array' ) ) {
	/**
	 * Get information about available image sizes
	 */
	function mascot_core_get_available_image_sizes_array( $size = '' ) {
	
		global $_wp_additional_image_sizes;
	
		$sizes = array();
		$get_intermediate_image_sizes = get_intermediate_image_sizes();
	
		// Create the full array with sizes and crop info
		foreach( $get_intermediate_image_sizes as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large', 'full' ) ) ) {
				$sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
				$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
				$sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
				if ( $_size == 'large' ) {
					$sizes[ 'full' ] ['width'] = 0;
					$sizes[ 'full' ] ['height'] = 0;
					$sizes[ 'full' ] ['crop'] = false;
				}
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array( 
					'width' => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
				);
			}
		}
	
		// Get only 1 size if found
		if ( $size ) {
			if( isset( $sizes[ $size ] ) ) {
				return $sizes[ $size ];
			} else {
				return false;
			}
		}
		return $sizes;
	}
}




if(!function_exists('mascot_core_get_owl_carousel_arraylist')) {
	/**
	 * Return Owl Carousel Array List
	 */
	function mascot_core_get_owl_carousel_arraylist( $control_object, $serial, $prefix = '', $dependency = array() ) {
		$array = array();

		switch ( $serial ) {
			case '1':
				$control_object->add_control(
					$prefix . "carousel_autoplay",[
						'label' => esc_html__( "Autoplay", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'yes',
						'condition' => $dependency
					]
				);
				break;

			case '2':
				$control_object->add_control(
					$prefix . "carousel_loop", [
						'label' => esc_html__( "Loop", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'yes',
						'condition' => $dependency
					]
				);
				break;

			case '3':
				$control_object->add_control(
					$prefix . "animation_speed", [
						'label' => esc_html__( "Autoplay Interval Timeout", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						"description" => esc_html__( "Autoplay interval timeout in milliseconds. Default value is 6000", 'mascot-core' ),
						'default' => '6000',
						'condition' => $dependency
					]
				);
				break;

			case '4':
				$control_object->add_control(
					$prefix . "smart_speed", [
						'label' => esc_html__( "Smart Speed", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						"description" => esc_html__( "Autoplay Smart Speed in milliseconds. Default value is 300", 'mascot-core' ),
						'default' => '300',
						'condition' => $dependency
					]
				);
				break;

			case '5':
				$control_object->add_control(
					$prefix . "margin", [
						'label' => esc_html__( "Gutter", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						"description" => esc_html__( "Gutter between two slides. Default 30", 'mascot-core' ),
						'default' => '30',
						'condition' => $dependency
					]
				);
				break;

			case '6':
				$control_object->add_control(
					$prefix . "stagepadding", [
						'label' => esc_html__( "Stage Padding", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						"description" => esc_html__( "Stage padding option adds left and right padding style onto stage-wrapper. Example: 50", 'mascot-core' ),
						'condition' => $dependency
					]
				);
				break;

			case '7':
				$control_object->add_control(
					'title_text_color_options',
					[
						'label' => esc_html__( 'Responsive', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_control(
					$prefix . "tablet", [
						'label' => esc_html__( "Columns in Tablet", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						"description" => esc_html__( "Between 768 to 1024", 'mascot-core' ),
						'condition' => $dependency,
						'separator' => 'before',
					]
				);
				$control_object->add_control(
					$prefix . "tablet_extra", [
						'label' => esc_html__( "Columns in Tablet Extra", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						"description" => esc_html__( "Between 1025 to 1200", 'mascot-core' ),
						'condition' => $dependency
					]
				);
				$control_object->add_control(
					$prefix . "laptop", [
						'label' => esc_html__( "Columns in Laptop", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						"description" => esc_html__( "Between 1201 to 1366", 'mascot-core' ),
						'condition' => $dependency
					]
				);
				$control_object->add_control(
					$prefix . "laptop_large", [
						'label' => esc_html__( "Columns in Laptop Large", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						"description" => esc_html__( "Between 1367 to 1440", 'mascot-core' ),
						'condition' => $dependency
					]
				);
				break;

			case '8':
				break;

			case '9':
				$control_object->add_control(
					$prefix . "center", [
						'label' => esc_html__( "Carousel Center Feature?", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'no',
						"description" => esc_html__( "This feature adds a class called 'center' into the middle image. Keep in mind that dots are not working here like a pagination", 'mascot-core' ),
						'condition' => $dependency,
						'separator' => 'before',
					]
				);
				break;

			case '10':
				$control_object->add_control(
					$prefix . "focused-center-image", [
						'label' => esc_html__( "Focused Center Image?", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'no',
						"description" => esc_html__( "Focus Center Image and Blur Other Images", 'mascot-core' ),
						'condition' => [
							'center' => array('yes')
						]
					]
				);
				break;

			case '11':
				$control_object->add_control(
					$prefix . "zoomin-center-image", [
						'label' => esc_html__( "ZoomIn Center Image?", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'no',
						'condition' => [
							'center' => array('yes')
						]
					]
				);
				break;

			case '12':
				$control_object->add_control(
					$prefix . "owl-stage-outer-overflow-visible", [
						'label' => esc_html__( "Owl Outer Stage Overflow Visible?", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_on' => __( 'Yes', 'mascot-core' ),
						'label_off' => __( 'No', 'mascot-core' ),
						'return_value'	=> 'visible',
						'default'	=> 'hidden',
						'selectors' => [
							'{{WRAPPER}} .owl-stage-outer' => 'overflow: {{VALUE}}',
						],
					]
				);
				break;

			case '13':
				$control_object->add_control(
					$prefix . "owl-stage-parent-wrapper-overflow-hidden", [
						'label' => esc_html__( "Make Parent Wrapper Overflow Hidden?", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'label_on' => __( 'Yes', 'mascot-core' ),
						'label_off' => __( 'No', 'mascot-core' ),
						'return_value'	=> 'hidden',
						'default'	=> 'visible',
						'selectors' => [
							'{{WRAPPER}} .elementor-widget-container' => 'overflow: {{VALUE}}',
						],
					]
				);
				break;

			case '14':
				$control_object->add_responsive_control(
					$prefix . 'carousel_item_margin',
					[
						'label' => esc_html__( 'Carousel Item Margin', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-item > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
						'condition' => $dependency
					]
				);
				break;

			default:
				# code...
				break;
		}

		return $array;
	}
}




if(!function_exists('mascot_core_get_owl_carousel_nav_arraylist')) {
	/**
	 * Return Owl Carousel Nav Array List
	 */
	function mascot_core_get_owl_carousel_nav_arraylist( $control_object, $serial, $prefix = '', $dependency = array() ) {
		$array = array();

		switch ( $serial ) {
			case '1':
				$control_object->add_control(
					$prefix . "show_navigation", [
						'label' => esc_html__( "Show Arrow Navigation", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'yes',
						'condition' => $dependency
					]
				);
				$control_object->add_responsive_control(
					$prefix . "arrow_display_visibility", [
						'label' => esc_html__( "Visibility in Responsive (Show/Hide)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::CHOOSE,
						'options' => [
							'block' => [
								'title' => __( 'Show', 'mascot-core' ),
								'icon' => 'eicon-check',
							],
							'none' => [
								'title' => __( 'Hide', 'mascot-core' ),
								'icon' => 'eicon-ban',
							],
						],
						'default' => 'block',
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav' => 'display: {{VALUE}};'
						],
					]
				);
				break;

			case '2':
				$control_object->add_control(
					$prefix . 'carousel_arrow_nav_pos_options',
					[
						'label' => esc_html__( 'Arrow Position', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'condition' => [
							'show_navigation' => array('yes'),
						],
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					'carousel_arrow_nav_pos_vertical',
					[
						'label' => __( 'Vertical Orientation', 'mascot-core' ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'top' => [
								'title' => __( 'Top', 'mascot-core' ),
								'icon' => 'eicon-v-align-top',
							],
							'bottom' => [
								'title' => __( 'Bottom', 'mascot-core' ),
								'icon' => 'eicon-v-align-bottom',
							],
						],
						'condition' => [
							'show_navigation' => array('yes')
						],
						'default' => 'top',
						'toggle' => false,
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_pos_offset_y',
					[
						'label' => __( 'Offset', 'mascot-core' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ '%', 'px' ],
						'range' => [
							'px' => [
								'min' => -1300,
								'max' => 1300,
								'step' => 1,
							],
							'%' => [
								'min' => -250,
								'max' => 250,
								'step' => 1,
							],
						],
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav' =>
									'{{carousel_arrow_nav_pos_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_pos_horizontal',
					[
						'label' => __( 'Horizontal Orientation', 'mascot-core' ),
						'type' => Controls_Manager::CHOOSE,
						'default' => is_rtl() ? 'right' : 'left',
						'options' => [
							'left' => [
								'title' => __( 'Left', 'mascot-core' ),
								'icon' => 'eicon-h-align-left',
							],
							'right' => [
								'title' => __( 'Right', 'mascot-core' ),
								'icon' => 'eicon-h-align-right',
							],
						],
						'condition' => [
							'show_navigation' => array('yes')
						],
						'toggle' => false,
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_pos_offset_x',
					[
						'label' => __( 'Offset', 'mascot-core' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ '%', 'px' ],
						'range' => [
							'px' => [
								'min' => -1300,
								'max' => 1300,
								'step' => 1,
							],
							'%' => [
								'min' => -250,
								'max' => 250,
								'step' => 1,
							],
						],
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav' =>
									'{{carousel_arrow_nav_pos_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
						],
					]
				);
				break;

			case '3':
				$control_object->add_control(
					$prefix . 'carousel_arrow_nav_hor_ver_options',
					[
						'label' => esc_html__( 'Arrow Horizontal/Vertical Placement', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'condition' => [
							'show_navigation' => array('yes')
						],
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_pos_center', [
						'label' => esc_html__( "Arrow Position Horizontal Center", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav' => 'left: 50% !important; right: auto !important; bottom: -80px; transform: translate(-50%, -50%);'
						],
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_separated_arrow', [
						'label' => esc_html__( "Or Arrow Vertical Center in Left Right", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'no',
						'separator' => 'before',
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav' => 'position:initial;',
							'{{WRAPPER}} .owl-carousel .owl-nav' => 'left:0;top:50%;position:absolute;transform:translateY(-50%);width: 100%;',
							'{{WRAPPER}} .owl-carousel .owl-nav > *' => 'position:absolute;',
							'{{WRAPPER}} .owl-carousel .owl-nav > .owl-prev' => 'transform:translateY(-50%)translateX(10px);left:-33px;',
							'{{WRAPPER}} .owl-carousel .owl-nav > .owl-next' => 'transform:translateY(-50%)translateX(-10px);left:auto;right:-33px;',
						],
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_separated_arrow_left',
					[
						'label' => __( 'Left Arrow Position', 'mascot-core' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px' ],
						'range' => [
							'px' => [
								'min' => -300,
								'max' => 200,
								'step' => 1,
							],
						],
						'condition' => [
							$prefix . 'carousel_arrow_nav_separated_arrow' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav .owl-prev' => 'left: {{SIZE}}{{UNIT}};'
						],
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_separated_arrow_left_hover',
					[
						'label' => __( 'Left Arrow Position (Hover)', 'mascot-core' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px' ],
						'range' => [
							'px' => [
								'min' => -300,
								'max' => 200,
								'step' => 1,
							],
						],
						'condition' => [
							$prefix . 'carousel_arrow_nav_separated_arrow' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel:hover .owl-nav .owl-prev' => 'left: {{SIZE}}{{UNIT}};'
						],
					]
				);




				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_separated_arrow_right',
					[
						'label' => __( 'Right Arrow Position', 'mascot-core' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px' ],
						'range' => [
							'px' => [
								'min' => -300,
								'max' => 200,
								'step' => 1,
							],
						],
						'condition' => [
							$prefix . 'carousel_arrow_nav_separated_arrow' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav .owl-next' => 'left:auto;right: {{SIZE}}{{UNIT}};'
						],
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_separated_arrow_right_hover',
					[
						'label' => __( 'Right Arrow Position (Hover)', 'mascot-core' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px' ],
						'range' => [
							'px' => [
								'min' => -300,
								'max' => 200,
								'step' => 1,
							],
						],
						'condition' => [
							$prefix . 'carousel_arrow_nav_separated_arrow' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel:hover .owl-nav .owl-next' => 'left:auto;right: {{SIZE}}{{UNIT}};'
						],
					]
				);
				break;

			case '4':
				break;

			case '5':
				break;

			case '6':
				break;

			case '7':
				break;

			case '8':
				break;

			case '9':
				break;

			case '10':
				break;

			case '11':
				break;

			case '12':
				$control_object->add_control(
					$prefix . 'carousel_arrow_nav_bg_options',
					[
						'label' => esc_html__( 'Arrow BG Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'condition' => [
							'show_navigation' => array('yes')
						],
						'separator' => 'before',
					]
				);
				break;

			case '13':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_bg_color',
					[
						'label' => esc_html__( "Arrow BG Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav button' => 'background-color: {{VALUE}};'
						],
					]
				);
				break;

			case '14':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_bg_color_hover',
					[
						'label' => esc_html__( "Arrow BG Color (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav button:hover' => 'background-color: {{VALUE}};'
						],
					]
				);
				break;

			case '15':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_bg_theme_color',
					[
						'label' => esc_html__( "Arrow BG Theme Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav button' => 'background-color: var(--theme-color{{VALUE}});'
						],
					]
				);
				break;

			case '16':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_bg_theme_color_hover',
					[
						'label' => esc_html__( "Arrow BG Theme Color (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav button:hover' => 'background-color: var(--theme-color{{VALUE}});'
						],
					]
				);
				break;

			case '17':
				$control_object->add_control(
					$prefix . 'carousel_arrow_nav_text_options',
					[
						'label' => esc_html__( 'Arrow Text Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'condition' => [
							'show_navigation' => array('yes')
						],
					]
				);
				break;

			case '18':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_text_color',
					[
						'label' => esc_html__( "Arrow Text Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav button' => 'color: {{VALUE}};'
						],
					]
				);
				break;

			case '19':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_text_color_hover',
					[
						'label' => esc_html__( "Arrow Text Color (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav button:hover' => 'color: {{VALUE}};'
						],
					]
				);
				break;

			case '20':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_text_theme_color',
					[
						'label' => esc_html__( "Arrow Text Theme Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav button' => 'color: var(--theme-color{{VALUE}});'
						],
					]
				);
				break;

			case '21':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_text_theme_color_hover',
					[
						'label' => esc_html__( "Arrow Text Theme Color (Hover)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav button:hover' => 'color: var(--theme-color{{VALUE}});'
						],
					]
				);
				break;

			case '22':
				$control_object->add_control(
					$prefix . 'carousel_arrow_nav_size_options',
					[
						'label' => esc_html__( 'Arrow Size & Border', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'condition' => [
							'show_navigation' => array('yes')
						],
						'separator' => 'before',
					]
				);
				break;

			case '23':
				$control_object->add_responsive_control(
					'carousel_arrow_nav_widthheight',
					[
						'label' => esc_html__( 'Dimension (Width and Height)', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px' ],
						'range' => [
							'px' => [
								'min' => 20,
								'max' => 120,
							],
						],
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
						],
					]
				);
				break;

			case '24':
				$control_object->add_responsive_control(
					'carousel_arrow_nav_border_radius',
					[
						'label' => esc_html__( "Border Radius", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);
				$control_object->add_control(
					'carousel_arrow_nav_border_title',
					[
						'label' => esc_html__( 'Border', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'carousel_arrow_nav_border',
						'label' => esc_html__( 'Border', 'mascot-core' ),
						'selector' => '{{WRAPPER}} .owl-carousel .owl-nav button',
						'condition' => [
							'show_navigation' => array('yes')
						],
					]
				);
				$control_object->add_control(
					'carousel_arrow_nav_border_hover_title',
					[
						'label' => esc_html__( 'Border (Hover)', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'carousel_arrow_nav_border_hover',
						'label' => esc_html__( 'Border', 'mascot-core' ),
						'selector' => '{{WRAPPER}} .owl-carousel .owl-nav button:hover',
						'condition' => [
							'show_navigation' => array('yes')
						],
					]
				);
				break;

			case '25':
				$control_object->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'carousel_arrow_nav_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
						'separator' => 'before',
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selector' => '{{WRAPPER}} .owl-carousel .owl-nav button',
					]
				);
				break;

			case '26':
				$control_object->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'icon_typography',
						'label' => esc_html__( 'Typography', 'mascot-core' ),
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selector' => '{{WRAPPER}} .owl-carousel .owl-nav button',
					]
				);
				break;

			case '27':
				$control_object->add_control(
					$prefix . 'carousel_arrow_nav_opacity_options',
					[
						'label' => esc_html__( 'Arrow Opacity', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'condition' => [
							'show_navigation' => array('yes')
						],
						'separator' => 'before',
					]
				);
				break;

			case '28':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_opacity',
					[
						'label' => esc_html__( 'Opacity', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'max' => 1,
								'min' => 0.10,
								'step' => 0.01,
							],
						],
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-nav button' => 'opacity: {{SIZE}};'
						]
					]
				);
				break;

			case '29':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_opacity_hover',
					[
						'label' => esc_html__( 'Opacity (hover)', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'range' => [
							'px' => [
								'max' => 1,
								'min' => 0.10,
								'step' => 0.01,
							],
						],
						'condition' => [
							'show_navigation' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel:hover .owl-nav button' => 'opacity: {{SIZE}};'
						]
					]
				);
				break;

			default:
				# code...
				break;
		}

		return $array;
	}
}




if(!function_exists('mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist')) {
	/**
	 * Return Owl Carousel Nav Array List
	 */
	function mascot_core_get_owl_carousel_nav_bs5_breakpoints_arraylist( $control_object, $serial, $prefix = '', $dependency = array() ) {
		$array = array();

		switch ( $serial ) {
			case '1':
				$control_object->add_control(
					$prefix . 'carousel_arrow_nav_pos_xl_options',
					[
						'label' => esc_html__( 'Arrow Position - Breakpoints XL (1200px -> 1399.98px)', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);
				break;

			case '2':
				$control_object->add_responsive_control(
					'carousel_arrow_nav_pos_xl_vertical',
					[
						'label' => __( 'Vertical Orientation', 'mascot-core' ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'top' => [
								'title' => __( 'Top', 'mascot-core' ),
								'icon' => 'eicon-v-align-top',
							],
							'bottom' => [
								'title' => __( 'Bottom', 'mascot-core' ),
								'icon' => 'eicon-v-align-bottom',
							],
						],
						'default' => 'top',
						'toggle' => false,
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_pos_xl_offset_y',
					[
						'label' => __( 'Offset', 'mascot-core' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ '%', 'px' ],
						'range' => [
							'px' => [
								'min' => -1300,
								'max' => 1300,
								'step' => 1,
							],
							'%' => [
								'min' => -250,
								'max' => 250,
								'step' => 1,
							],
						],
						'selectors' => [
							'@media (min-width: 1200px) and (max-width: 1399.98px){ {{WRAPPER}} .owl-carousel .owl-nav' =>
									'{{carousel_arrow_nav_pos_xl_vertical.VALUE}}: {{SIZE}}{{UNIT}}}',
						],
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_pos_xl_horizontal',
					[
						'label' => __( 'Horizontal Orientation', 'mascot-core' ),
						'type' => Controls_Manager::CHOOSE,
						'default' => is_rtl() ? 'right' : 'left',
						'options' => [
							'left' => [
								'title' => __( 'Left', 'mascot-core' ),
								'icon' => 'eicon-h-align-left',
							],
							'right' => [
								'title' => __( 'Right', 'mascot-core' ),
								'icon' => 'eicon-h-align-right',
							],
						],
						'toggle' => false,
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_pos_xl_offset_x',
					[
						'label' => __( 'Offset', 'mascot-core' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ '%', 'px' ],
						'range' => [
							'px' => [
								'min' => -1300,
								'max' => 1300,
								'step' => 1,
							],
							'%' => [
								'min' => -250,
								'max' => 250,
								'step' => 1,
							],
						],
						'selectors' => [
							'@media (min-width: 1200px) and (max-width: 1399.98px){ {{WRAPPER}} .owl-carousel .owl-nav' =>
									'{{carousel_arrow_nav_pos_xl_horizontal.VALUE}}: {{SIZE}}{{UNIT}}}',
						],
					]
				);
				break;

			case '3':
				break;

			case '4':
				break;

			case '5':
				break;

				
			case '6':
				$control_object->add_control(
					$prefix . 'carousel_arrow_nav_pos_md_options',
					[
						'label' => esc_html__( 'Arrow Position - Breakpoints MD (992px -> 1199.98px)', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				break;

			case '7':
				$control_object->add_responsive_control(
					'carousel_arrow_nav_pos_md_vertical',
					[
						'label' => __( 'Vertical Orientation', 'mascot-core' ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'top' => [
								'title' => __( 'Top', 'mascot-core' ),
								'icon' => 'eicon-v-align-top',
							],
							'bottom' => [
								'title' => __( 'Bottom', 'mascot-core' ),
								'icon' => 'eicon-v-align-bottom',
							],
						],
						'default' => 'top',
						'toggle' => false,
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_pos_md_offset_y',
					[
						'label' => __( 'Offset', 'mascot-core' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ '%', 'px' ],
						'range' => [
							'px' => [
								'min' => -1300,
								'max' => 1300,
								'step' => 1,
							],
							'%' => [
								'min' => -250,
								'max' => 250,
								'step' => 1,
							],
						],
						'selectors' => [
							'@media (min-width: 992px) and (max-width: 1199.98px){ {{WRAPPER}} .owl-carousel .owl-nav' =>
									'{{carousel_arrow_nav_pos_md_vertical.VALUE}}: {{SIZE}}{{UNIT}}}',
						],
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_pos_md_horizontal',
					[
						'label' => __( 'Horizontal Orientation', 'mascot-core' ),
						'type' => Controls_Manager::CHOOSE,
						'default' => is_rtl() ? 'right' : 'left',
						'options' => [
							'left' => [
								'title' => __( 'Left', 'mascot-core' ),
								'icon' => 'eicon-h-align-left',
							],
							'right' => [
								'title' => __( 'Right', 'mascot-core' ),
								'icon' => 'eicon-h-align-right',
							],
						],
						'toggle' => false,
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_nav_pos_md_offset_x',
					[
						'label' => __( 'Offset', 'mascot-core' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ '%', 'px' ],
						'range' => [
							'px' => [
								'min' => -1300,
								'max' => 1300,
								'step' => 1,
							],
							'%' => [
								'min' => -250,
								'max' => 250,
								'step' => 1,
							],
						],
						'selectors' => [
							'@media (min-width: 992px) and (max-width: 1199.98px){ {{WRAPPER}} .owl-carousel .owl-nav' =>
									'{{carousel_arrow_nav_pos_md_horizontal.VALUE}}: {{SIZE}}{{UNIT}}}',
						],
					]
				);
				break;

			case '8':
				break;

			case '9':
				break;

			case '10':
				break;

			default:
				# code...
				break;
		}

		return $array;
	}
}




if(!function_exists('mascot_core_get_owl_carousel_dots_arraylist')) {
	/**
	 * Return Owl Carousel Bullets/Dots List
	 */
	function mascot_core_get_owl_carousel_dots_arraylist( $control_object, $serial, $prefix = '', $dependency = array() ) {
		$array = array();

		switch ( $serial ) {
			case '1':
				$control_object->add_control(
					$prefix . "show_bullets",[
						'label' => esc_html__( "Show Bullets/Dots Navigation", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'no',
						'condition' => $dependency
					]
				);
				break;

			case '2':
				$control_object->add_responsive_control(
					$prefix . "dots_display_visibility", [
						'label' => esc_html__( "Visibility in Responsive (Show/Hide)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::CHOOSE,
						'options' => [
							'block' => [
								'title' => __( 'Show', 'mascot-core' ),
								'icon' => 'eicon-check',
							],
							'none' => [
								'title' => __( 'Hide', 'mascot-core' ),
								'icon' => 'eicon-ban',
							],
						],
						'default' => 'block',
						'condition' => [
							'show_bullets' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-dots' => 'display: {{VALUE}};'
						],
					]
				);
				break;

			case '3':
				$control_object->add_control(
					$prefix . 'carousel_arrow_dots_pos_options',
					[
						'label' => esc_html__( 'Bullets/Dots Position', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'condition' => [
							'show_bullets' => array('yes')
						],
						'separator' => 'before',
					]
				);
				break;

			case '4':
				$control_object->add_control(
					$prefix . 'carousel_arrow_dots_pos_center', [
						'label' => esc_html__( "Dots Position Horizontal Center", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'yes',
						'condition' => [
							'show_bullets' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-dots' => 'left: 50%; bottom: -75px; transform: translate(-50%, -50%);'
						],
					]
				);
				$control_object->add_responsive_control(
					'carousel_arrow_dots_pos_vertical',
					[
						'label' => __( 'Vertical Orientation', 'mascot-core' ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'top' => [
								'title' => __( 'Top', 'mascot-core' ),
								'icon' => 'eicon-v-align-top',
							],
							'bottom' => [
								'title' => __( 'Bottom', 'mascot-core' ),
								'icon' => 'eicon-v-align-bottom',
							],
						],
						'condition' => [
							'show_bullets' => array('yes')
						],
						'default' => 'top',
						'toggle' => false,
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_dots_pos_offset_y',
					[
						'label' => __( 'Offset', 'mascot-core' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ '%', 'px' ],
						'range' => [
							'px' => [
								'min' => -1300,
								'max' => 1300,
								'step' => 1,
							],
							'%' => [
								'min' => -250,
								'max' => 250,
								'step' => 1,
							],
						],
						'condition' => [
							'show_bullets' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-dots' =>
									'{{carousel_arrow_dots_pos_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_dots_pos_horizontal',
					[
						'label' => __( 'Horizontal Orientation', 'mascot-core' ),
						'type' => Controls_Manager::CHOOSE,
						'default' => is_rtl() ? 'right' : 'left',
						'options' => [
							'left' => [
								'title' => __( 'Left', 'mascot-core' ),
								'icon' => 'eicon-h-align-left',
							],
							'right' => [
								'title' => __( 'Right', 'mascot-core' ),
								'icon' => 'eicon-h-align-right',
							],
						],
						'condition' => [
							'show_bullets' => array('yes')
						],
						'toggle' => false,
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_dots_pos_offset_x',
					[
						'label' => __( 'Offset', 'mascot-core' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ '%', 'px' ],
						'range' => [
							'px' => [
								'min' => -1300,
								'max' => 1300,
								'step' => 1,
							],
							'%' => [
								'min' => -250,
								'max' => 250,
								'step' => 1,
							],
						],
						'condition' => [
							'show_bullets' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-dots' =>
									'{{carousel_arrow_dots_pos_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
						],
					]
				);
				break;

			case '5':
				break;

			case '6':
				break;

			case '7':
				break;

			case '8':
				break;

			case '9':
				$control_object->add_control(
					$prefix . 'carousel_arrow_dots_bg_options',
					[
						'label' => esc_html__( 'Bullets/Dots BG Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'condition' => [
							'show_bullets' => array('yes')
						],
						'separator' => 'before',
					]
				);
				break;

			case '10':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_dots_bg_color',
					[
						'label' => esc_html__( "BG Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'show_bullets' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-dots .owl-dot span' => 'background-color: {{VALUE}};'
						],
					]
				);
				break;

			case '11':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_dots_bg_color_hover',
					[
						'label' => esc_html__( "BG Color (Active)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'condition' => [
							'show_bullets' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-dots .owl-dot:hover span' => 'background-color: {{VALUE}};',
							'{{WRAPPER}} .owl-carousel .owl-dots .owl-dot.active span' => 'background-color: {{VALUE}};'
						],
					]
				);
				break;

			case '12':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_dots_bg_theme_color',
					[
						'label' => esc_html__( "BG Theme Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'condition' => [
							'show_bullets' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-dots .owl-dot span' => 'background-color: var(--theme-color{{VALUE}});'
						],
					]
				);
				break;

			case '13':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_dots_bg_theme_color_hover',
					[
						'label' => esc_html__( "BG Theme Color (Active)", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'condition' => [
							'show_bullets' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-dots .owl-dot:hover span' => 'background-color: var(--theme-color{{VALUE}});',
							'{{WRAPPER}} .owl-carousel .owl-dots .owl-dot.active span' => 'background-color: var(--theme-color{{VALUE}});'
						],
					]
				);
				break;

			case '14':
				$control_object->add_control(
					$prefix . 'carousel_arrow_dots_size_options',
					[
						'label' => esc_html__( 'Bullet Size', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'condition' => [
							'show_bullets' => array('yes')
						],
						'separator' => 'before',
					]
				);
				break;

			case '15':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_dots_width',
					[
						'label' => esc_html__( 'Width', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px' ],
						'range' => [
							'px' => [
								'min' => 1,
								'max' => 50,
							],
						],
						'condition' => [
							'show_bullets' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-dots .owl-dot span' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_dots_width_active',
					[
						'label' => esc_html__( 'Width (Active)', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px' ],
						'range' => [
							'px' => [
								'min' => 1,
								'max' => 50,
							],
						],
						'condition' => [
							'show_bullets' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-dots .owl-dot:hover span' => 'width: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .owl-carousel .owl-dots .owl-dot.active span' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);
				break;

			case '16':
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_dots_height',
					[
						'label' => esc_html__( 'Height', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px' ],
						'range' => [
							'px' => [
								'min' => 1,
								'max' => 50,
							],
						],
						'condition' => [
							'show_bullets' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-dots .owl-dot span' => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$control_object->add_responsive_control(
					$prefix . 'carousel_arrow_dots_height_active',
					[
						'label' => esc_html__( 'Height (Active)', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SLIDER,
						'size_units' => [ 'px' ],
						'range' => [
							'px' => [
								'min' => 1,
								'max' => 50,
							],
						],
						'condition' => [
							'show_bullets' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-dots .owl-dot:hover span' => 'height: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .owl-carousel .owl-dots .owl-dot.active span' => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);
				break;

			case '17':
				$control_object->add_responsive_control(
					'carousel_arrow_dots_border_radius',
					[
						'label' => esc_html__( "Border Radius", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'separator' => 'before',
						'size_units' => [ 'px', '%', 'em' ],
						'condition' => [
							'show_bullets' => array('yes')
						],
						'selectors' => [
							'{{WRAPPER}} .owl-carousel .owl-dots .owl-dot span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);
				break;

			default:
				# code...
				break;
		}

		return $array;
	}
}



if(!function_exists('mascot_core_get_cat_filter_arraylist')) {
	/**
	 * Return Category Filter Array List
	 */
	function mascot_core_get_cat_filter_arraylist( $control_object, $serial, $dependency = array() ) {
		$array = array();

		switch ( $serial ) {
			case '1':
				$control_object->add_control(
					"show_cat_filter", [
						'label' => esc_html__( "Show Category Filter?", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'no',
						'condition' => $dependency
					]
				);
				break;

			case '2':
				$control_object->add_control(
					'cat_filter_style', [
						'label' => esc_html__( "Filter Style", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => [
							'filter-style-1'	=>	esc_html__( 'Style 1', 'mascot-core' ),
							'filter-style-2'	=>	esc_html__( 'Style 2', 'mascot-core' ),
							'filter-style-3'	=>	esc_html__( 'Style 3', 'mascot-core' ),
							'filter-style-4'	=>	esc_html__( 'Style 4', 'mascot-core' ),
							'filter-style-5'	=>	esc_html__( 'Style 5', 'mascot-core' ),
							'filter-style-6'	=>	esc_html__( 'Style 6', 'mascot-core' ),
							'filter-style-7'	=>	esc_html__( 'Style 7', 'mascot-core' ),
							'filter-style-8'	=>	esc_html__( 'Style 8', 'mascot-core' ),
							'filter-style-9'	=>	esc_html__( 'Style 9', 'mascot-core' ),
							'filter-style-10'	=>	esc_html__( 'Style 10', 'mascot-core' ),
							'filter-style-11'	=>	esc_html__( 'Style 11', 'mascot-core' ),
							'filter-style-12'	=>	esc_html__( 'Style 12', 'mascot-core' ),
							'filter-style-13'	=>	esc_html__( 'Style 13', 'mascot-core' ),
							'filter-style-14'	=>	esc_html__( 'Style 14', 'mascot-core' ),
							'filter-style-15'	=>	esc_html__( 'Style 15', 'mascot-core' ),
							'filter-style-16'	=>	esc_html__( 'Style 16', 'mascot-core' ),
							'filter-style-flat'	=>	esc_html__( 'Style flat', 'mascot-core' )
						],
						'default' => 'filter-style-3',
						'condition' => [
							'show_cat_filter' => array('yes')
						]
					]
				);
				break;

			case '3':
				$control_object->add_responsive_control(
					'filter_alignment',
					[
						'label' => esc_html__( "Filter Alignment", 'mascot-core' ),
						'type' => Controls_Manager::CHOOSE,
						'label_block' => false,
						'options' => mascot_core_text_align_choose(),
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter' => 'text-align: {{VALUE}};'
						],
						'default' => 'center',
					]
				);
				break;

			case '4':
				$control_object->start_controls_tabs('tabs_iconbox_wrapper_style');
				$control_object->start_controls_tab(
					'filter_normal',
					[
						'label' => esc_html__('Normal', 'mascot-core'),
					]
				);
				$control_object->add_control(
					'filter_bg_color_options',
					[
						'label' => esc_html__( 'Background Color Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_control(
					'filter_custom_bg_color',
					[
						'label' => esc_html__( "Filter Custom BG Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a' => 'background-color: {{VALUE}};'
						]
					]
				);
				$control_object->add_control(
					'filter_bg_theme_colored',
					[
						'label' => esc_html__( "BG Theme Colored", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a' => 'background-color: var(--theme-color{{VALUE}});'
						],
					]
				);



				//text Icon
				$control_object->add_control(
					'filter_text_options',
					[
						'label' => esc_html__( 'Text Color Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_control(
					'filter_text_color',
					[
						'label' => esc_html__( "Text Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a' => 'color: {{VALUE}};'
						]
					]
				);
				$control_object->add_control(
					'filter_theme_colored',
					[
						'label' => esc_html__( "Text Theme Colored", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a' => 'color: var(--theme-color{{VALUE}});'
						],
					]
				);
				$control_object->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name' => 'filter_typography',
						'label' => esc_html__( 'Text Typography', 'mascot-core' ),
						'selector' => '{{WRAPPER}} .isotope-layout-filter a',
						'separator' => 'before',
					]
				);
				$control_object->add_responsive_control(
					'filter_margin',
					[
						'label' => esc_html__( 'Margin', 'mascot-core' ),
						'type' => Controls_Manager::DIMENSIONS,
						'separator' => 'before',
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$control_object->add_responsive_control(
					'filter_padding',
					[
						'label' => esc_html__( 'Padding', 'mascot-core' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$control_object->add_control(
					'filter_border_options',
					[
						'label' => esc_html__( 'Border Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'filter_box_shadow',
						'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
						'selector' => '{{WRAPPER}} .isotope-layout-filter a',
					]
				);
				$control_object->add_responsive_control(
					'filter_border_radius',
					[
						'label' => esc_html__( "Border Radius", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em' ],
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);
				$control_object->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'filter_border',
						'label' => esc_html__( 'Border', 'mascot-core' ),
						'selector' => '{{WRAPPER}} .isotope-layout-filter a',
					]
				);
				$control_object->add_control(
					'filter_border_theme_colored',
					[
						'label' => esc_html__( "Border Theme Colored", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a' => 'border-color: var(--theme-color{{VALUE}});'
						],
					]
				);
				$control_object->end_controls_tab();


				$control_object->start_controls_tab(
					'filter_hover',
					[
						'label' => esc_html__('Hover', 'mascot-core'),
					]
				);
				$control_object->add_control(
					'filter_bg_color_options_hover',
					[
						'label' => esc_html__( 'Background Color Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);
				$control_object->add_control(
					'filter_custom_bg_color_hover',
					[
						'label' => esc_html__( "Filter Custom BG Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a:hover' => 'background-color: {{VALUE}};',
						]
					]
				);
				$control_object->add_control(
					'filter_bg_theme_colored_hover',
					[
						'label' => esc_html__( "BG Theme Colored", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a:hover' => 'background-color: var(--theme-color{{VALUE}});',
						],
					]
				);
				//text Icon
				$control_object->add_control(
					'filter_text_options_hover',
					[
						'label' => esc_html__( 'Text Color Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_control(
					'filter_text_color_hover',
					[
						'label' => esc_html__( "Text Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a:hover' => 'color: {{VALUE}};',
						]
					]
				);
				$control_object->add_control(
					'filter_theme_colored_hover',
					[
						'label' => esc_html__( "Text Theme Colored", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a:hover' => 'color: var(--theme-color{{VALUE}});',
						],
					]
				);
				$control_object->add_control(
					'filter_border_options_hover',
					[
						'label' => esc_html__( 'Border Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'filter_box_shadow_hover',
						'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
						'selector' => '{{WRAPPER}} .isotope-layout-filter a:hover',
					]
				);
				$control_object->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'filter_border_hover',
						'label' => esc_html__( 'Border', 'mascot-core' ),
						'selector' => '{{WRAPPER}} .isotope-layout-filter a:hover',
					]
				);
				$control_object->add_control(
					'filter_border_theme_colored_hover',
					[
						'label' => esc_html__( "Border Theme Colored", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a:hover' => 'border-color: var(--theme-color{{VALUE}});',
						],
					]
				);
				$control_object->end_controls_tab();


				$control_object->start_controls_tab(
					'filter_active',
					[
						'label' => esc_html__('Active', 'mascot-core'),
					]
				);
				$control_object->add_control(
					'filter_bg_color_options_active',
					[
						'label' => esc_html__( 'Background Color Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
					]
				);
				$control_object->add_control(
					'filter_custom_bg_color_active',
					[
						'label' => esc_html__( "Filter Custom BG Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a.active' => 'background-color: {{VALUE}};',
						]
					]
				);
				$control_object->add_control(
					'filter_bg_theme_colored_active',
					[
						'label' => esc_html__( "BG Theme Colored", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a.active' => 'background-color: var(--theme-color{{VALUE}});',
						],
					]
				);
				//text Icon
				$control_object->add_control(
					'filter_text_options_active',
					[
						'label' => esc_html__( 'Text Color Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_control(
					'filter_text_color_active',
					[
						'label' => esc_html__( "Text Color", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a.active' => 'color: {{VALUE}};',
						]
					]
				);
				$control_object->add_control(
					'filter_theme_colored_active',
					[
						'label' => esc_html__( "Text Theme Colored", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a.active' => 'color: var(--theme-color{{VALUE}});',
						],
					]
				);
				$control_object->add_control(
					'filter_border_options_active',
					[
						'label' => esc_html__( 'Border Options', 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);
				$control_object->add_group_control(
					\Elementor\Group_Control_Box_Shadow::get_type(),
					[
						'name' => 'filter_box_shadow_active',
						'label' => esc_html__( 'Box Shadow', 'mascot-core' ),
						'selector' => '{{WRAPPER}} .isotope-layout-filter a.active',
					]
				);
				$control_object->add_group_control(
					\Elementor\Group_Control_Border::get_type(),
					[
						'name' => 'filter_border_active',
						'label' => esc_html__( 'Border', 'mascot-core' ),
						'selector' => '{{WRAPPER}} .isotope-layout-filter a.active',
					]
				);
				$control_object->add_control(
					'filter_border_theme_colored_active',
					[
						'label' => esc_html__( "Border Theme Colored", 'mascot-core' ),
						'type' => \Elementor\Controls_Manager::SELECT,
						'options' => mascot_core_theme_color_list(),
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} .isotope-layout-filter a.active' => 'border-color: var(--theme-color{{VALUE}});',
						],
					]
				);
				$control_object->end_controls_tab();
				$control_object->end_controls_tabs();
				break;

			default:
				# code...
				break;
		}

		return $array;
	}
}

if (!function_exists('mascot_core_shortcode_get_blog_post_format')) {
  /**
   * Return Shortcode Blog Post Format HTML
   */
  function mascot_core_shortcode_get_blog_post_format( $post_format = '', $params = array() ) {

    $format = $post_format ? : 'standard';
    $params['post_format'] = $format;

    //Produce HTML version by using the parameters (filename, variation, folder name, parameters)
    $html = mascot_core_get_cpt_shortcode_template_part( 'post-format', $format, 'blog/tpl/post-format', $params, true );
    return $html;
  }
}

if(!function_exists('mascot_core_get_animation_type')) {
	/**
	 * Return animation type
	 */
	function mascot_core_get_animation_type() {
		$array = array(
			''  =>  esc_html__( 'None', 'mascot-core' ),
			'tm-animation-floating'  =>  esc_html__( 'Floating Animation', 'mascot-core' ),
			'tm-animation-slide-horizontal'  =>  esc_html__( 'Horizontal Slide Animation', 'mascot-core' ),
			'tm-animation-scaling'  =>  esc_html__( 'Scaling Animation', 'mascot-core' ),
			'tm-animation-flicker'  =>  esc_html__( 'Flicker Animation', 'mascot-core' ),
			'tm-animation-spin'  =>  esc_html__( 'Spin Animation', 'mascot-core' ),

			'tm-animation-floating'	=>	esc_html__( 'Floating Animation', 'mascot-core' ),
			'tm-animation-slide-horizontal'	=>	esc_html__( 'Horizontal Slide Animation', 'mascot-core' ),
			'tm-animation-scaling'	=>	esc_html__( 'Scaling Animation', 'mascot-core' ),

			'tm-animation-flicker'	=>	esc_html__( 'Flicker Animation', 'mascot-core' ),
			'tm-animation-spin'	=>	esc_html__( 'Spin Animation', 'mascot-core' ),
			'tm-animation-rotated-half'	=>	esc_html__( 'Rotated Half Animation', 'mascot-core' ),
			'tm-animation-jump'	=>	esc_html__( 'Jump Animation', 'mascot-core' ),

			'tm-animation-run'	=>	esc_html__( 'Run Animation', 'mascot-core' ),
			'tm-animation-scale-right'	=>	esc_html__( 'Scale Right Animation', 'mascot-core' ),

			'tm-animation-random-animation1'	=>	esc_html__( 'Random Animation 1', 'mascot-core' ),
			'tm-animation-random-animation2'	=>	esc_html__( 'Random Animation 2', 'mascot-core' ),
			'tm-animation-random-animation3'	=>	esc_html__( 'Random Animation 3', 'mascot-core' ),
			'tm-animation-random-animation4'	=>	esc_html__( 'Random Animation 4', 'mascot-core' ),
			'tm-animation-random-animation5'	=>	esc_html__( 'Random Animation 5', 'mascot-core' )
		);
		return $array;
	}
}

if(!function_exists('mascot_core_text_align_choose')) {
	/**
	 * Text Alignment List - Elementor CHOOSE Control
	 */
	function mascot_core_text_align_choose() {
		$alignment_list = array(
			'left' => [
				'title' => esc_html__('Left', 'mascot-core'),
				'icon' => 'eicon-h-align-left',
			],
			'center' => [
				'title' => esc_html__('Center', 'mascot-core'),
				'icon' => 'eicon-h-align-center',
			],
			'right' => [
				'title' => esc_html__('Right', 'mascot-core'),
				'icon' => 'eicon-h-align-right',
			],
		);
		return $alignment_list;
	}
}




if(!function_exists('mascot_core_get_shortcode_snippet')) {
	function mascot_core_get_shortcode_snippet( $shortcode_object, $params ) {
		$atts = array();

		if ( empty( $shortcode_object ) || ! is_object( $shortcode_object ) ) {
			return '';
		}

		if ( ! empty( $params ) ) {
			foreach ( $params as $key => $value ) {
				if ( is_array( $value ) || 'shortcode_snippet' === $key ) {
					continue;
				}

				$atts[] = $key . '="' . esc_attr( $value ) . '"';
			}
		}

		return sprintf(
			'<textarea rows="3" readonly>[%s %s]</textarea>',
			$shortcode_object->get_name(),
			implode( ' ', $atts )
		);
	}
}




if(!function_exists('mascot_core_get_wpcf7_list')) {
    /**
     * Get Contact Form 7 [ if exists ]
     */
    function mascot_core_get_wpcf7_list()
    {
        $options = array();

        if (function_exists('wpcf7')) {
            $wpcf7_form_list = get_posts(array(
                'post_type' => 'wpcf7_contact_form',
                'showposts' => 999,
            ));
            $options[0] = esc_html__('Select a Contact Form', 'mascot-core');
            if (!empty($wpcf7_form_list) && !is_wp_error($wpcf7_form_list)) {
                foreach ($wpcf7_form_list as $post) {
                    $options[$post->ID] = $post->post_title;
                }
            } else {
                $options[0] = esc_html__('Create a Form First', 'mascot-core');
            }
        }
        return $options;
    }
}



if(!function_exists('mascot_core_isotope_gutter_list_elementor')) {
	/**
	 * Masorny Gutter list Elementor
	 */
	function mascot_core_isotope_gutter_list_elementor() {
		$gutter_list = array(
			'gutter' 		=>  esc_html__( 'Default', 'mascot-core' ),
			'gutter-0'		=>  '0',
			'gutter-2'  	=>  '2px',
			'gutter-5'  	=>  '5px',
			'gutter-10'  	=>  '10px',
			'gutter-15'  	=>  '15px',
			'gutter-20'  	=>  '20px',
			'gutter-30'  	=>  '30px',
			'gutter-40'  	=>  '40px',
			'gutter-50'  	=>  '50px',
			'gutter-60'  	=>  '60px',
		);
		return $gutter_list;
	}
}



if(!function_exists('mascot_core_disply_type_list_elementor')) {
	/**
	 * Display Property list Elementor
	 */
	function mascot_core_disply_type_list_elementor() {
		$list = array(
			'flex' => esc_html__('Flex', 'mascot-core'),
			'block' => esc_html__('Block', 'mascot-core'),
			'inline' => esc_html__('Inline', 'mascot-core'),
			'inline-flex' => esc_html__('Inline Flex', 'mascot-core'),
			'inline-block' => esc_html__('Inline Block', 'mascot-core'),
			'inherit' => esc_html__('Inherit', 'mascot-core'),
			'initial' => esc_html__('Initial', 'mascot-core'),
		);
		return $list;
	}
}



if(!function_exists('mascot_core_disply_flex_horizontal_align_elementor')) {
	/**
	 * Horizontal Align list Elementor
	 */
	function mascot_core_disply_flex_horizontal_align_elementor() {
		$list = array(
			'' => esc_html__( 'Default', 'mascot-core' ),
			'flex-start' => esc_html__( 'Start', 'mascot-core' ),
			'center' => esc_html__( 'Center', 'mascot-core' ),
			'flex-end' => esc_html__( 'End', 'mascot-core' ),
			'space-between' => esc_html__( 'Space Between', 'mascot-core' ),
			'space-around' => esc_html__( 'Space Around', 'mascot-core' ),
			'space-evenly' => esc_html__( 'Space Evenly', 'mascot-core' ),
		);
		return $list;
	}
}



if(!function_exists('mascot_core_disply_flex_vertical_align_elementor')) {
	/**
	 * Vertical Align list Elementor
	 */
	function mascot_core_disply_flex_vertical_align_elementor() {
		$list = array(
			'' => esc_html__( 'Default', 'mascot-core' ),
			'flex-start' => esc_html__( 'Top', 'mascot-core' ),
			'center' => esc_html__( 'Middle', 'mascot-core' ),
			'flex-end' => esc_html__( 'Bottom', 'mascot-core' ),
		);
		return $list;
	}
}



if(!function_exists('mascot_core_disply_flex_direction_elementor')) {
	/**
	 * flex-direction list Elementor
	 */
	function mascot_core_disply_flex_direction_elementor() {
		$list = array(
			'' => esc_html__( 'Default', 'mascot-core' ),
			'row' => esc_html__( 'Displayed horizontally', 'mascot-core' ),
			'row-reverse' => esc_html__( 'Displayed horizontally but in reverse order', 'mascot-core' ),
			'column' => esc_html__( 'Displayed vertically, as a column', 'mascot-core' ),
			'column-reverse' => esc_html__( 'Displayed vertically but in reverse order', 'mascot-core' ),
		);
		return $list;
	}
}



if(!function_exists('mascot_core_php_date_format')) {
	/**
	 * Masorny Gutter list Elementor
	 */
	function mascot_core_php_date_format( $type = 'day' ) {
		$day_list = array(
			'd' =>  esc_html__( 'The day of the month (from 01 to 31)', 'mascot-core' ),
			'D' =>  esc_html__( 'A textual representation of a day (three letters)', 'mascot-core' ),
			'j' =>  esc_html__( 'The day of the month without leading zeros', 'mascot-core' ),
			'l' =>  esc_html__( 'A full textual representation of a day', 'mascot-core' ),
			'w' =>  esc_html__( 'A numeric representation of the day (1 for Monday, 7 for Sunday)', 'mascot-core' ),
		);
		$month_list = array(
			'F' =>  esc_html__( 'A full textual representation of a month (January through December)', 'mascot-core' ),
			'm' =>  esc_html__( 'A numeric representation of a month (from 01 to 12)', 'mascot-core' ),
			'M' =>  esc_html__( 'A short textual representation of a month (three letters)', 'mascot-core' ),
			'n' =>  esc_html__( 'A numeric representation of a month, without leading zeros', 'mascot-core' ),
		);
		$year_list = array(
			'Y' =>  esc_html__( 'A four digit representation of a year', 'mascot-core' ),
			'y' =>  esc_html__( 'A two digit representation of a year', 'mascot-core' ),
		);



		switch ($type) {
			case 'day':
				return $day_list;
				break;
			case 'month':
				return $month_list;
				break;
			case 'year':
				return $year_list;
				break;
			
			default:
				return $day_list;
				break;
		}
	}
}

if(!function_exists('mascot_core_get_elementor_templates')) {
	/**
	 * Get Elementor Templates
	 */
    function mascot_core_get_elementor_templates() {
        $templates = get_posts([
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        ]);

        if (!empty($templates) && !is_wp_error($templates)) {

            foreach ($templates as $template) {
                $options[$template->ID] = $template->post_title;
            }

            update_option('temp_count', $options);

            return $options ?? [];
        }
    }
}



// Return true if Elementor exists and mode is preview
if ( !function_exists( 'mascot_core_is_edit' ) ) {
	function mascot_core_is_edit() {
		static $is_edit = -1;
		if ( $is_edit === -1 ) {
			if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				$is_edit = true;
			} else {
				$is_edit = false;
			}
		}
		return $is_edit;
	}
}
if ( !function_exists( 'mascot_core_is_preview' ) ) {
	function mascot_core_is_preview() {
		static $is_preview = -1;
		if ( $is_preview === -1 ) {
			if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
				$is_preview = true;
			} else {
				$is_preview = false;
			}
		}
		return $is_preview;
	}
}


if ( !function_exists( 'mascot_core_header_mobile_full_page_nav_add_class_to_body' ) ) {
	function mascot_core_header_mobile_full_page_nav_add_class_to_body ( $classes ) {
		$classes[] = 'menu-full-page';
		return $classes;
	}
	add_filter( 'body_class', 'mascot_core_header_mobile_full_page_nav_add_class_to_body' );
}