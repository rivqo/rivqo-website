<?php

/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if( !class_exists( 'Mascot_Theme_Nav_Walker' ) ) {
class Mascot_Theme_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Private Variables
	 *
	 * @access private
	 * @var string
	 */


	private $mascot_subtitle = '';
	private $mascot_menuicon = '';
	private $mascot_custombadge = '';
	private $dropdown_position = '';
	private $megamenu_status = '';
	private $megamenu_containerwidth = '';
	private $megamenu_dropdownposition = '';
	private $megamenu_gridcolumnwidth = '';
	private $mascot_submenu_title = '';
	private $megamenu_widgetarea = '';
	private $megamenu_cpt = '';
	private $megamenu_bgimage = '';


	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$t = "\t";
		$n = "\n";
		$indent = str_repeat( $t, $depth );
		if ( 0 === $depth && 'enabled' === $this->megamenu_status ) {
			//megamenu bgimage
			if ( ! empty( $this->megamenu_bgimage ) && $this->megamenu_bgimage != '' ) {
				$this->megamenu_bgimage = "style=\"background-image: url('" . $this->megamenu_bgimage . "')\"";
			} else {
				$this->megamenu_bgimage = "";
			}
			$output .= "{$n}{$indent} <div " . $this->megamenu_bgimage . " class=\"megamenu " . $this->megamenu_containerwidth . " " . $this->megamenu_dropdownposition . "\">{$n}{$indent}  <div class=\"megamenu-row\">{$n}";
		} else if ( 0 < $depth && 'enabled' === $this->megamenu_status ) {
			$output .= "{$n}{$indent}<ul class=\"list-unstyled list-dashed\">{$n}";
		} else {
			$output .= "{$n}{$indent}<ul class=\"dropdown{$this->dropdown_position}\">{$n}";
		}
	}



	/**
	 * Ends the list of after the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_lvl()
	 *
	 * @param string   $output Passed by reference. Used to append additional content.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$t = "\t";
		$n = "\n";
		$indent = str_repeat( $t, $depth );
		if ( 0 === $depth && 'enabled' === $this->megamenu_status ) {
			$output .= "{$indent}  </div>{$n}{$indent} </div>{$n}";
		} elseif ( 2 <= $depth && 'enabled' === $this->megamenu_status ) {
			$output .= "{$indent}</ul>{$n}";
		} else {
			$output .= "{$indent}</ul>{$n}";
		}
	}


	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$t = "\t";
		$n = "\n";
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		//custom fields
		$this->mascot_subtitle = trim( get_post_meta( $item->ID, '_menu_item_mascot_subtitle', true ) );
		$this->mascot_menuicon = trim( get_post_meta( $item->ID, '_menu_item_mascot_menuicon', true ) );
		$this->mascot_custombadge = trim( get_post_meta( $item->ID, '_menu_item_mascot_custombadge', true ) );
		$this->mascot_submenu_title = get_post_meta( $item->ID, '_menu_item_mascot_submenu_title', true );
    	$this->megamenu_cpt = get_post_meta( $item->ID, '_menu_item_mascot_megamenu_cpt', true );

		//dropdown position
		if ( 0 < $depth ) {
			$dropdownposition = get_post_meta( $item->ID, '_menu_item_mascot_dropdownposition', true );
			if( $dropdownposition == 'left' ) {
				$this->dropdown_position = ' dropdown-left';
			} else {
				$this->dropdown_position = '';
			}
		}

		//megamenu status
		if( amiso_get_redux_option( 'header-menu-megamenu-enable-megamenu' ) ) {
			if ( 0 === $depth ) {
				$this->megamenu_status = get_post_meta( $item->ID, '_menu_item_mascot_megamenu_status', true );
				$this->megamenu_containerwidth = get_post_meta( $item->ID, '_menu_item_mascot_megamenu_containerwidth', true );
				$this->megamenu_dropdownposition = get_post_meta( $item->ID, '_menu_item_mascot_megamenu_dropdownposition', true );
			}
			$this->megamenu_gridcolumnwidth = get_post_meta( $item->ID, '_menu_item_mascot_megamenu_gridcolumnwidth', true );
			$this->megamenu_widgetarea = get_post_meta( $item->ID, '_menu_item_mascot_megamenu_widgetarea', true );
			$this->megamenu_cpt = get_post_meta( $item->ID, '_menu_item_mascot_megamenu_cpt', true );
			$this->megamenu_bgimage = get_post_meta( $item->ID, '_menu_item_mascot_megamenu_bgimage', true );
		} else {
			$this->megamenu_status = 'disabled';
		}


		/**
		* Dividers, Headers or Disabled
		* =============================
		* Determine whether the item is a Divider, Header, Disabled or regular
		* menu item. To prevent errors we use the strcasecmp() function to so a
		* comparison that is not case sensitive. The strcasecmp() function returns
		* a 0 if the strings are equal.
		*/
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			if ( $args->has_children )
				$class_names .= ' ';

			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			//if has megamenu elementor selected
			if($depth == 0 && !empty($this->megamenu_cpt))
			{
				$class_names .= " tm-elementor-megamenu";
			}

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';


			// We are inside a megamenu.
			if ( 1 === $depth && 'enabled' === $this->megamenu_status ) {
				//megamenu bgimage
				if ( ! empty( $this->megamenu_bgimage ) && $this->megamenu_bgimage != '' ) {
					$this->megamenu_bgimage = "style=\"background-image: url('" . esc_url($this->megamenu_bgimage) . "')\"";
				} else {
					$this->megamenu_bgimage = "";
				}
				$output .= "{$n}{$indent}<div " . esc_url($this->megamenu_bgimage) . " class=\"col" . esc_attr($this->megamenu_gridcolumnwidth) ."\">{$n}{$indent}<ul class=\"list-unstyled list-dashed\">{$n}{$indent}";
			}

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title ) ? $item->title  : '';
			$atts['target'] = ! empty( $item->target )  ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn )   ? $item->xfn  : '';

			// Mega Menu Column Title
			$mascot_submenu_title_class = '';
			if ( 'enabled' === $this->mascot_submenu_title) {
				$mascot_submenu_title_class = ' tm-submenu-title';
			}

			$atts['class']  = 'menu-item-link' . $mascot_submenu_title_class;

			// If item has_children add atts to a.
			$atts['href'] = ! empty( $item->url ) ? $item->url : '';

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			* Glyphicons
			* ===========
			* Since the the menu item is NOT a Divider or Header we check the see
			* if there is a value in the attr_title property. If the attr_title
			* property is NOT null we apply it as the class name for the glyphicon.
			*/

			//menu icon
			if ( ! empty( $this->mascot_menuicon ) ) {
				$item_output .= '<a'. $attributes .'><i class="menu-icon ' . esc_attr( $this->mascot_menuicon ) . '"></i>&nbsp;';
			} else {
				$item_output .= '<a'. $attributes .'>';
			}

			//sub title
			if ( ! empty( $this->mascot_subtitle ) && $this->mascot_subtitle != '' ) {
				$this->mascot_subtitle = '<span class="subtitle"> ' . $this->mascot_subtitle . '</span>';
			}

			// Sub Menu Column Title
			if ( 'enabled' === $this->mascot_submenu_title) {
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after . $this->mascot_subtitle;
			} else {
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after . $this->mascot_subtitle;
			}


			//Custom Badge/Tag
			if ( ! empty( $this->mascot_custombadge ) ) {
				$item_output .= '<span class="tm-menu-badge">' . esc_attr( $this->mascot_custombadge ) . '</span>';
			}

			//added by smile for fixing menuzord indicator
			if ( $args->has_children && $depth === 0 ) {
				//$item_output .= ' <span class="indicator"><i class="fa fa-angle-down"></i></span>';
			} else if ( $args->has_children && $depth > 0 && 'enabled' !== $this->megamenu_status ) {
				if( is_rtl() ) {
					//$item_output .= ' <span class="indicator"><i class="fa fa-angle-left"></i></span>';
				} else {
					//$item_output .= ' <span class="indicator"><i class="fa fa-angle-right"></i></span>';
				}
			}

			$item_output .= ( $args->has_children && 0 === $depth ) ? ' </a>' : '</a>';

			//megamenu widget container
			if ( $this->megamenu_widgetarea && is_active_sidebar( $this->megamenu_widgetarea ) ) {
				ob_start();
				dynamic_sidebar( $this->megamenu_widgetarea );
				$item_output .= '<div class="megamenu-widgets-container second-level-widget">' . ob_get_clean() . '</div>';
			}


			//megamenu cpt container
			if ( $this->megamenu_cpt ) {
				ob_start();
				//query args
				$post_id = '';
				$posts = get_posts([
					'post_type' => 'megamenu',
					'post_status' => 'publish',
					'include' => $this->megamenu_cpt,
				]);
				foreach ( $posts as $post ) {
					$post_id = $post->ID;
				}
				if( $post_id ) {
					if ( did_action( 'elementor/loaded' ) ) {
						$pluginElementor = \Elementor\Plugin::instance();

						// Set edit mode as false, so don't render settings and etc. ( not need for get_builder_content_for_display() )
						$is_edit_mode = $pluginElementor->editor->is_edit_mode();
						$pluginElementor->editor->set_edit_mode( false );

						//$inline_css = $inline_css ? true : $is_edit_mode;
						$contentElementor = htmlentities($pluginElementor->frontend->get_builder_content( $post_id, true ));

						// Restore edit mode ( not need for get_builder_content_for_display() )
						$pluginElementor->editor->set_edit_mode( $is_edit_mode );
						echo html_entity_decode($contentElementor);
					}
				}

				$item_output .= '<div class="megamenu '. esc_attr($this->megamenu_containerwidth) .'  '. esc_attr($this->megamenu_dropdownposition) .' elementor-megamenu-wrapper"><div class="megamenu-row">' . ob_get_clean() . '</div></div>';
			}


			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	 /**
		* Ends the element output, if needed.
		*
		* @since 3.0.0
		*
		* @see Walker::end_el()
		*
		* @param string   $output Passed by reference. Used to append additional content.
		* @param WP_Post  $item   Page data object. Not used.
		* @param int      $depth  Depth of page. Not Used.
		* @param stdClass $args   An object of wp_nav_menu() arguments.
		*/
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$t = "\t";
		$n = "\n";
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';
		// We are inside a megamenu.
		if ( 1 === $depth && 'enabled' === $this->megamenu_status ) {
			$output .= "{$indent}</li>{$n}{$indent}</ul>{$n}{$indent}</div>{$n}";
		} else {
			$output .= "{$indent}</li>{$n}";
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( ! $element )
				return;

		$id_field = $this->db_fields['id'];

		// Display this element.
		if ( is_object( $args[0] ) )
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo wp_kses( $fb_output, 'post' );
		}
	}
}
}
