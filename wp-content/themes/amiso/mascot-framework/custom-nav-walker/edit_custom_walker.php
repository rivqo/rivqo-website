<?php
/**
 *  /!\ This is a copy of Walker_Nav_Menu_Edit class in core
 *
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */




// Add the mega menu custom fields to the menu fields.
add_action( 'amiso_nav_megamenu_item_custom_fields', 'amiso_add_megamenu_fields', 20, 4 );

/**
 * Adds the menu markup.
 *
 * @param string $item_id The ID of the menu item.
 * @param object $item    The menu item object.
 * @param int    $depth   The depth of the current item in the menu.
 * @param array  $args    Menu arguments.
 */
function amiso_add_megamenu_fields( $item_id, $item, $depth, $args ) {
	?>
	<div class="clear"></div>
	<div class="mascot-mega-menu-options">
		<p class="field-megamenu-status description description-wide">
			<label for="edit-menu-item-mascot-megamenu-status-<?php echo esc_attr( $item_id ); ?>">
				<input type="checkbox" id="edit-menu-item-mascot-megamenu-status-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-mascot-megamenu-status" name="menu-item-mascot-megamenu-status[<?php echo esc_attr( $item_id ); ?>]" value="enabled" <?php checked( $item->mascot_megamenu_status, 'enabled' ); ?> />
				<strong><?php esc_html_e( 'Enable Mega Menu (only for main menu)', 'amiso' ); ?></strong>
			</label>
		</p>
		<p class="field-megamenu-containerwidth description description-wide">
			<label for="edit-menu-item-mascot-megamenu-containerwidth-<?php echo esc_attr( $item_id ); ?>">
				<?php esc_html_e( 'Mega Menu Container Width', 'amiso' ); ?>
				<select id="edit-menu-item-mascot-megamenu-containerwidth-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-mascot-megamenu-containerwidth" name="menu-item-mascot-megamenu-containerwidth[<?php echo esc_attr( $item_id ); ?>]">
					<option value="megamenu-fullwidth-fullwindow" <?php selected( $item->mascot_megamenu_containerwidth, 'megamenu-fullwidth-fullwindow' ); ?>><?php esc_html_e( 'Fullwidth - Full Window', 'amiso' ); ?></option>
					<option value="megamenu-fullwidth" <?php selected( $item->mascot_megamenu_containerwidth, 'megamenu-fullwidth' ); ?>><?php esc_html_e( 'Fullwidth', 'amiso' ); ?></option>
					<option value="megamenu-three-quarter-width" <?php selected( $item->mascot_megamenu_containerwidth, 'megamenu-three-quarter-width' ); ?>><?php esc_html_e( 'Three Quarter Width', 'amiso' ); ?></option>
					<option value="megamenu-half-width" <?php selected( $item->mascot_megamenu_containerwidth, 'megamenu-half-width' ); ?>><?php esc_html_e( 'Half Width', 'amiso' ); ?></option>
					<option value="megamenu-quarter-width" <?php selected( $item->mascot_megamenu_containerwidth, 'megamenu-quarter-width' ); ?>><?php esc_html_e( 'Quarter Width', 'amiso' ); ?></option>
				</select>
			</label>
		</p>
		<p class="field-megamenu-dropdownposition description description-wide">
			<label for="edit-menu-item-mascot-megamenu-dropdownposition-<?php echo esc_attr( $item_id ); ?>">
				<?php esc_html_e( 'Mega Menu Dropdown Position', 'amiso' ); ?>
				<select id="edit-menu-item-mascot-megamenu-dropdownposition-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-mascot-megamenu-dropdownposition" name="menu-item-mascot-megamenu-dropdownposition[<?php echo esc_attr( $item_id ); ?>]">
					<option value="megamenu-position-left" <?php selected( $item->mascot_megamenu_dropdownposition, 'megamenu-position-left' ); ?>><?php esc_html_e( 'Left', 'amiso' ); ?></option>
					<option value="megamenu-position-center" <?php selected( $item->mascot_megamenu_dropdownposition, 'megamenu-position-center' ); ?>><?php esc_html_e( 'Center', 'amiso' ); ?></option>
					<option value="megamenu-position-right" <?php selected( $item->mascot_megamenu_dropdownposition, 'megamenu-position-right' ); ?>><?php esc_html_e( 'Right', 'amiso' ); ?></option>
				</select>
			</label>
		</p>
		<p class="field-megamenu-gridcolumnwidth description description-wide">
			<label for="edit-menu-item-mascot-megamenu-gridcolumnwidth-<?php echo esc_attr( $item_id ); ?>">
				<?php esc_html_e( 'Mega Menu Column Width in Grid system', 'amiso' ); ?>
				<select id="edit-menu-item-mascot-megamenu-gridcolumnwidth-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-mascot-megamenu-gridcolumnwidth" name="menu-item-mascot-megamenu-gridcolumnwidth[<?php echo esc_attr( $item_id ); ?>]">
					<option value="" <?php selected( $item->mascot_megamenu_gridcolumnwidth, 'auto' ); ?>><?php esc_html_e( 'Auto', 'amiso' ); ?></option>
					<option value="1" <?php selected( $item->mascot_megamenu_gridcolumnwidth, '1' ); ?>>1</option>
					<option value="2" <?php selected( $item->mascot_megamenu_gridcolumnwidth, '2' ); ?>>2</option>
					<option value="3" <?php selected( $item->mascot_megamenu_gridcolumnwidth, '3' ); ?>>3</option>
					<option value="4" <?php selected( $item->mascot_megamenu_gridcolumnwidth, '4' ); ?>>4</option>
					<option value="5" <?php selected( $item->mascot_megamenu_gridcolumnwidth, '5' ); ?>>5</option>
					<option value="6" <?php selected( $item->mascot_megamenu_gridcolumnwidth, '6' ); ?>>6</option>
					<option value="7" <?php selected( $item->mascot_megamenu_gridcolumnwidth, '7' ); ?>>7</option>
					<option value="8" <?php selected( $item->mascot_megamenu_gridcolumnwidth, '8' ); ?>>8</option>
					<option value="9" <?php selected( $item->mascot_megamenu_gridcolumnwidth, '9' ); ?>>9</option>
					<option value="10" <?php selected( $item->mascot_megamenu_gridcolumnwidth, '10' ); ?>>10</option>
					<option value="11" <?php selected( $item->mascot_megamenu_gridcolumnwidth, '11' ); ?>>11</option>
					<option value="12" <?php selected( $item->mascot_megamenu_gridcolumnwidth, '12' ); ?>>12</option>
				</select>
			</label>
		</p>
		<p class="field-megamenu-cpt description description-wide">
			<label for="edit-menu-item-mascot-megamenu-cpt-<?php echo esc_attr( $item_id ); ?>">
				<?php esc_html_e( 'Mega Menu Elementor (Optional)', 'amiso' ); ?>
					<?php
						//Get all megamenu posts
						$args = array(
							 'post_type'     => 'megamenu',
							 'post_status'   => array( 'publish' ),
							 'numberposts'   => -1,
							 'orderby'       => 'title',
							 'order'         => 'ASC',
							 'suppress_filters'   => false
						);
						$megamenus = get_posts($args);
						$tg_megamenu_select = array();
						$tg_megamenu_select[''] = esc_html__( '-- Select Megamenu --', 'amiso' );

						if(!empty($megamenus))
						{
							foreach ($megamenus as $megamenu)
							{
								$tg_megamenu_select[$megamenu->ID] = $megamenu->post_title;
							}
						}
						else
						{
							$tg_megamenu_select[''] = esc_html__( 'No mega menu found. Please create one first', 'amiso' );
						}
					?>
				<select id="edit-menu-item-mascot-megamenu-cpt-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-mascot-megamenu-cpt" name="menu-item-mascot-megamenu-cpt[<?php echo esc_attr( $item_id ); ?>]">
					<?php if ( ! empty( $tg_megamenu_select ) && is_array( $tg_megamenu_select ) ) : ?>
						<?php foreach ( $tg_megamenu_select as $megamenu_id => $title ) : ?>
							<option value="<?php echo esc_attr( $megamenu_id ); ?>" <?php selected( $item->mascot_megamenu_cpt, $megamenu_id ); ?>><?php echo esc_html($title); ?></option>
						<?php endforeach; ?>
					<?php endif; ?>
				</select>
			</label>
		</p>
		<p class="field-megamenu-widgetarea description description-wide">
			<label for="edit-menu-item-mascot-megamenu-widgetarea-<?php echo esc_attr( $item_id ); ?>">
				<?php esc_html_e( 'Mega Menu Widget Area (Optional)', 'amiso' ); ?>
				<select id="edit-menu-item-mascot-megamenu-widgetarea-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-mascot-megamenu-widgetarea" name="menu-item-mascot-megamenu-widgetarea[<?php echo esc_attr( $item_id ); ?>]">
					<option value="0"><?php esc_html_e( 'Select Widget Area', 'amiso' ); ?></option>
					<?php global $wp_registered_sidebars; ?>
					<?php if ( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ) : ?>
						<?php foreach ( $wp_registered_sidebars as $sidebar ) : ?>
							<option value="<?php echo esc_attr( $sidebar['id'] ); ?>" <?php selected( $item->mascot_megamenu_widgetarea, $sidebar['id'] ); ?>><?php echo esc_html( $sidebar['name'] ); ?></option>
						<?php endforeach; ?>
					<?php endif; ?>
				</select>
			</label>
		</p>

		<p class="field-megamenu-bgimage description description-wide">
			<a  id="mascot-media-upload-<?php echo esc_attr( $item_id ); ?>" class="mascot-open-media button button-primary mascot-megamenu-upload-bgimage" data-target="#edit-menu-item-mascot-megamenu-bgimage-<?php echo esc_attr( $item_id ); ?>" data-preview=".mascot-megamenu-bgimage-image" data-frame="select" data-state="wpc_widgets_insert_single" data-fetch="url" data-title="<?php esc_attr_e( 'Insert Image', 'amiso' ); ?>" data-button="<?php esc_attr_e( 'Insert', 'amiso' ); ?>" data-class="media-frame tm-widget-custom-uploader" title="<?php esc_attr_e( 'Add Media', 'amiso' ); ?>"><?php esc_html_e( 'Set BG image', 'amiso' ); ?></a>

			<label for="edit-menu-item-mascot-megamenu-bgimage-<?php echo esc_attr( $item_id ); ?>">
				<input type="hidden" id="edit-menu-item-mascot-megamenu-bgimage-<?php echo esc_attr( $item_id ); ?>" class="mascot-new-media-image widefat code edit-menu-item-mascot-megamenu-bgimage" name="menu-item-mascot-megamenu-bgimage[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_url( $item->mascot_megamenu_bgimage ); ?>" />
				<img src="<?php echo esc_url( $item->mascot_megamenu_bgimage ); ?>" id="mascot-media-img-<?php echo esc_attr( $item_id ); ?>" class="mascot-megamenu-bgimage-image" style="<?php echo ( trim( esc_url( $item->mascot_megamenu_bgimage ) ) ) ? 'display:inline;' : ''; ?>" />

				<a href="#" id="mascot-media-remove-<?php echo esc_attr( $item_id ); ?>" data-target="#edit-menu-item-mascot-megamenu-bgimage-<?php echo esc_attr( $item_id ); ?>" data-preview=".mascot-megamenu-bgimage-image" class="remove-mascot-megamenu-bgimage" style="<?php echo ( trim( esc_url( $item->mascot_megamenu_bgimage ) ) ) ? 'display:inline;' : ''; ?>"><?php esc_html_e( 'Remove Image', 'amiso' ); ?></a>


			</label>
		</p>
	</div><!-- .mascot-mega-menu-options-->
	<?php
}



if( !class_exists( 'Amiso_Walker_Nav_Menu_Edit_Custom' ) ) {
class Amiso_Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
	/**
	 * Starts the list before the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of wp_nav_menu() arguments.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of wp_nav_menu() arguments.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
	}

	/**
	 * Starts the element output.
	 *
	 * @since 3.0.0
	 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
	 *
	 * @see Walker::start_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of wp_nav_menu() arguments.
	 * @param int    $id     Current item ID.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		global $_wp_nav_menu_max_depth;

		// Restores the more descriptive, specific name for use within this method.
		$menu_item              = $data_object;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		ob_start();
		$item_id      = esc_attr( $menu_item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = false;

		if ( 'taxonomy' === $menu_item->type ) {
			$original_object = get_term( (int) $menu_item->object_id, $menu_item->object );
			if ( $original_object && ! is_wp_error( $original_object ) ) {
				$original_title = $original_object->name;
			}
		} elseif ( 'post_type' === $menu_item->type ) {
			$original_object = get_post( $menu_item->object_id );
			if ( $original_object ) {
				$original_title = get_the_title( $original_object->ID );
			}
		} elseif ( 'post_type_archive' === $menu_item->type ) {
			$original_object = get_post_type_object( $menu_item->object );
			if ( $original_object ) {
				$original_title = $original_object->labels->archives;
			}
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $menu_item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id === $_GET['edit-menu-item'] ) ? 'active' : 'inactive' ),
		);

		$title = $menu_item->title;

		if ( ! empty( $menu_item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: Title of an invalid menu item. */
			$title = sprintf( __( '%s (Invalid)', 'amiso' ), $menu_item->title );
		} elseif ( isset( $menu_item->post_status ) && 'draft' === $menu_item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: Title of a menu item in draft status. */
			$title = sprintf( __( '%s (Pending)', 'amiso' ), $menu_item->title );
		}

		$title = ( ! isset( $menu_item->label ) || '' === $menu_item->label ) ? $title : $menu_item->label;

		$submenu_text = '';
		if ( 0 === $depth ) {
			$submenu_text = 'style="display: none;"';
		}

		?>
		<li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo implode( ' ', $classes ); ?>">
			<div class="menu-item-bar">
				<div class="menu-item-handle">
					<label class="item-title" for="menu-item-checkbox-<?php echo esc_attr( $item_id ); ?>">
						<input id="menu-item-checkbox-<?php echo esc_attr( $item_id ); ?>" type="checkbox" class="menu-item-checkbox" data-menu-item-id="<?php echo esc_attr( $item_id ); ?>" disabled="disabled" />
						<span class="menu-item-title"><?php echo esc_html( $title ); ?></span>
						<span class="is-submenu" <?php echo esc_attr( $submenu_text ); ?>><?php _e( 'sub item', 'amiso' ); ?></span>
					</label>
					<span class="item-controls">
						<span class="item-type"><?php echo esc_html( $menu_item->type_label ); ?></span>
						<span class="item-order hide-if-js">
							<?php
							printf(
								'<a href="%s" class="item-move-up" aria-label="%s">&#8593;</a>',
								wp_nonce_url(
									add_query_arg(
										array(
											'action'    => 'move-up-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								),
								esc_attr__( 'Move up', 'amiso' )
							);
							?>
							|
							<?php
							printf(
								'<a href="%s" class="item-move-down" aria-label="%s">&#8595;</a>',
								wp_nonce_url(
									add_query_arg(
										array(
											'action'    => 'move-down-menu-item',
											'menu-item' => $item_id,
										),
										remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
									),
									'move-menu_item'
								),
								esc_attr__( 'Move down', 'amiso' )
							);
							?>
						</span>
						<?php
						if ( isset( $_GET['edit-menu-item'] ) && $item_id === $_GET['edit-menu-item'] ) {
							$edit_url = admin_url( 'nav-menus.php' );
						} else {
							$edit_url = add_query_arg(
								array(
									'edit-menu-item' => $item_id,
								),
								remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) )
							);
						}

						printf(
							'<a class="item-edit" id="edit-%s" href="%s" aria-label="%s"><span class="screen-reader-text">%s</span></a>',
							$item_id,
							$edit_url,
							esc_attr__( 'Edit menu item', 'amiso' ),
							__( 'Edit', 'amiso' )
						);
						?>
					</span>
				</div>
			</div>

			<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
				<?php if ( 'custom' === $menu_item->type ) : ?>
					<p class="field-url description description-wide">
						<label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
							<?php _e( 'URL', 'amiso' ); ?><br />
							<input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $menu_item->url ); ?>" />
						</label>
					</p>
				<?php endif; ?>
				<p class="description description-wide">
					<label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
						<?php _e( 'Navigation Label', 'amiso' ); ?><br />
						<input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $menu_item->title ); ?>" />
					</label>
				</p>
				<p class="field-title-attribute field-attr-title description description-wide">
					<label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
						<?php _e( 'Title Attribute', 'amiso' ); ?><br />
						<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $menu_item->post_excerpt ); ?>" />
					</label>
				</p>
				<p class="field-link-target description">
					<label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
						<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $menu_item->target, '_blank' ); ?> />
						<?php _e( 'Open link in a new tab', 'amiso' ); ?>
					</label>
				</p>
				<p class="field-css-classes description description-thin">
					<label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
						<?php _e( 'CSS Classes (optional)', 'amiso' ); ?><br />
						<input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode( ' ', $menu_item->classes ) ); ?>" />
					</label>
				</p>
				<p class="field-xfn description description-thin">
					<label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
						<?php _e( 'Link Relationship (XFN)', 'amiso' ); ?><br />
						<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $menu_item->xfn ); ?>" />
					</label>
				</p>
				<p class="field-description description description-wide">
					<label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
						<?php _e( 'Description', 'amiso' ); ?><br />
						<textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $menu_item->description ); // textarea_escaped ?></textarea>
						<span class="description"><?php _e( 'The description will be displayed in the menu if the active theme supports it.', 'amiso' ); ?></span>
					</label>
				</p>

				<?php
					/* New fields insertion starts here */
				?>
				<p class="field-megamenu-title description description-wide">
					<label for="edit-menu-item-mascot-submenu-title-<?php echo esc_attr( $item_id ); ?>">
						<input type="checkbox" id="edit-menu-item-mascot-submenu-title-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-mascot-submenu-title" name="menu-item-mascot-submenu-title[<?php echo esc_attr( $item_id ); ?>]" value="enabled" <?php checked( $menu_item->mascot_submenu_title, 'enabled' ); ?> />
						<strong><?php esc_html_e( 'Show this Navigation Label as a Bold Title', 'amiso' ); ?></strong>
					</label>
				</p>
				<p class="field-dropdownposition description description-wide">
					<label for="edit-menu-item-mascot-dropdownposition-<?php echo esc_attr( $item_id ); ?>">
						<input type="checkbox" id="edit-menu-item-mascot-dropdownposition-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-mascot-dropdownposition" name="menu-item-mascot-dropdownposition[<?php echo esc_attr( $item_id ); ?>]" value="left" <?php checked( $menu_item->mascot_dropdownposition, 'left' ); ?> />
						<?php esc_html_e( 'Show it\'s dropdown items to left (default right)', 'amiso' ); ?>
					</label>
				</p>
				<p class="field-custom description description-wide">
					<label for="edit-menu-item-mascot-subtitle-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e( 'Subtitle', 'amiso' ); ?>
					<br />
					<input type="text" id="edit-menu-item-mascot-subtitle-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom" name="menu-item-mascot-subtitle[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $menu_item->mascot_subtitle ); ?>" />
					</label>
				</p>
				<p class="description description-wide">
					<label for="edit-menu-item-mascot-menuicon-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e('Icon', 'amiso'); ?><br/>
						<select id="edit-menu-item-mascot-menuicon-<?php echo esc_attr($item_id); ?>"
								class="widefat mascot-menuicon-picker"
								name="menu-item-mascot-menuicon[<?php echo esc_attr($item_id); ?>]">
							<option value="" <?php selected('', esc_attr($menu_item->mascot_menuicon)) ?>><?php esc_html_e('No Icons', 'amiso') ?></option>
							<?php $arr = $this->mascot_menuiconpicker_fontawesome();
							foreach ($arr as $group => $icons) { ?>
								<optgroup label="<?php echo esc_attr($group); ?>">
									<?php foreach ($icons as $key => $label) {
										$class_key = key($label); ?>
										<option value="<?php echo esc_attr($class_key); ?>" <?php selected($class_key, esc_attr($menu_item->mascot_menuicon)) ?>><?php echo esc_html(current($label)); ?></option>
									<?php } ?>
								</optgroup>
							<?php } ?>
						</select>
					</label>
				</p>
				<script>
					jQuery('.mascot-menuicon-picker').fontIconPicker();
				</script>
				<p class="field-custom description description-wide">
					<label for="edit-menu-item-mascot-custombadge-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e( 'Custom Badge/Tag', 'amiso' ); ?>
					<br />
					<input type="text" id="edit-menu-item-mascot-custombadge-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-custom" name="menu-item-mascot-custombadge[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $menu_item->mascot_custombadge ); ?>" />
					</label>
				</p>
				<?php
					if( amiso_get_redux_option( 'header-menu-megamenu-enable-megamenu' ) ) {
						do_action( 'amiso_nav_megamenu_item_custom_fields', $item_id, $menu_item, $depth, $args );
					}
				?>
				<?php
					/* New fields insertion ends here */
				?>
				<?php
				/**
				 * Fires just before the move buttons of a nav menu item in the menu editor.
				 *
				 * @since 5.4.0
				 *
				 * @param string        $item_id           Menu item ID as a numeric string.
				 * @param WP_Post       $menu_item         Menu item data object.
				 * @param int           $depth             Depth of menu item. Used for padding.
				 * @param stdClass|null $args              An object of menu item arguments.
				 * @param int           $current_object_id Nav menu ID.
				 */
				do_action( 'wp_nav_menu_item_custom_fields', $item_id, $menu_item, $depth, $args, $current_object_id );
				?>

				<fieldset class="field-move hide-if-no-js description description-wide">
					<span class="field-move-visual-label" aria-hidden="true"><?php _e( 'Move', 'amiso' ); ?></span>
					<button type="button" class="button-link menus-move menus-move-up" data-dir="up"><?php _e( 'Up one', 'amiso' ); ?></button>
					<button type="button" class="button-link menus-move menus-move-down" data-dir="down"><?php _e( 'Down one', 'amiso' ); ?></button>
					<button type="button" class="button-link menus-move menus-move-left" data-dir="left"></button>
					<button type="button" class="button-link menus-move menus-move-right" data-dir="right"></button>
					<button type="button" class="button-link menus-move menus-move-top" data-dir="top"><?php _e( 'To the top', 'amiso' ); ?></button>
				</fieldset>

				<div class="menu-item-actions description-wide submitbox">
					<?php if ( 'custom' !== $menu_item->type && false !== $original_title ) : ?>
						<p class="link-to-original">
							<?php
							/* translators: %s: Link to menu item's original object. */
							printf( __( 'Original: %s', 'amiso' ), '<a href="' . esc_attr( $menu_item->url ) . '">' . esc_html( $original_title ) . '</a>' );
							?>
						</p>
					<?php endif; ?>

					<?php
					printf(
						'<a class="item-delete submitdelete deletion" id="delete-%s" href="%s">%s</a>',
						$item_id,
						wp_nonce_url(
							add_query_arg(
								array(
									'action'    => 'delete-menu-item',
									'menu-item' => $item_id,
								),
								admin_url( 'nav-menus.php' )
							),
							'delete-menu_item_' . $item_id
						),
						__( 'Remove', 'amiso' )
					);
					?>
					<span class="meta-sep hide-if-no-js"> | </span>
					<?php
					printf(
						'<a class="item-cancel submitcancel hide-if-no-js" id="cancel-%s" href="%s#menu-item-settings-%s">%s</a>',
						$item_id,
						esc_url(
							add_query_arg(
								array(
									'edit-menu-item' => $item_id,
									'cancel'         => time(),
								),
								admin_url( 'nav-menus.php' )
							)
						),
						$item_id,
						__( 'Cancel', 'amiso' )
					);
					?>
				</div>

				<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
				<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $menu_item->object_id ); ?>" />
				<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $menu_item->object ); ?>" />
				<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $menu_item->menu_item_parent ); ?>" />
				<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $menu_item->menu_order ); ?>" />
				<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $menu_item->type ); ?>" />
			</div><!-- .menu-item-settings-->
			<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}

	function mascot_menuiconpicker_fontawesome() {
		$icons = array(
			'FontAwesome 5' => array(
				array('fa fa-address-book' => 'fa fa-address-book'),
				array('fa fa-address-card' => 'fa fa-address-card'),
				array('fa fa-adjust' => 'fa fa-adjust'),
				array('fa fa-air-freshener' => 'fa fa-air-freshener'),
				array('fa fa-align-center' => 'fa fa-align-center'),
				array('fa fa-align-justify' => 'fa fa-align-justify'),
				array('fa fa-align-left' => 'fa fa-align-left'),
				array('fa fa-align-right' => 'fa fa-align-right'),
				array('fa fa-allergies' => 'fa fa-allergies'),
				array('fa fa-ambulance' => 'fa fa-ambulance'),
				array('fa fa-american-sign-language-interpreting' => 'fa fa-american-sign-language-interpreting'),
				array('fa fa-anchor' => 'fa fa-anchor'),
				array('fa fa-angle-double-down' => 'fa fa-angle-double-down'),
				array('fa fa-angle-double-left' => 'fa fa-angle-double-left'),
				array('fa fa-angle-double-right' => 'fa fa-angle-double-right'),
				array('fa fa-angle-double-up' => 'fa fa-angle-double-up'),
				array('fa fa-angle-down' => 'fa fa-angle-down'),
				array('fa fa-angle-left' => 'fa fa-angle-left'),
				array('fa fa-angle-right' => 'fa fa-angle-right'),
				array('fa fa-angle-up' => 'fa fa-angle-up'),
				array('fa fa-angry' => 'fa fa-angry'),
				array('fa fa-ankh' => 'fa fa-ankh'),
				array('fa fa-apple-alt' => 'fa fa-apple-alt'),
				array('fa fa-archive' => 'fa fa-archive'),
				array('fa fa-archway' => 'fa fa-archway'),
				array('fa fa-arrow-alt-circle-down' => 'fa fa-arrow-alt-circle-down'),
				array('fa fa-arrow-alt-circle-left' => 'fa fa-arrow-alt-circle-left'),
				array('fa fa-arrow-alt-circle-right' => 'fa fa-arrow-alt-circle-right'),
				array('fa fa-arrow-alt-circle-up' => 'fa fa-arrow-alt-circle-up'),
				array('fa fa-arrow-circle-down' => 'fa fa-arrow-circle-down'),
				array('fa fa-arrow-circle-left' => 'fa fa-arrow-circle-left'),
				array('fa fa-arrow-circle-right' => 'fa fa-arrow-circle-right'),
				array('fa fa-arrow-circle-up' => 'fa fa-arrow-circle-up'),
				array('fa fa-arrow-down' => 'fa fa-arrow-down'),
				array('fa fa-arrow-left' => 'fa fa-arrow-left'),
				array('fa fa-arrow-right' => 'fa fa-arrow-right'),
				array('fa fa-arrow-up' => 'fa fa-arrow-up'),
				array('fa fa-arrows-alt' => 'fa fa-arrows-alt'),
				array('fa fa-arrows-alt-h' => 'fa fa-arrows-alt-h'),
				array('fa fa-arrows-alt-v' => 'fa fa-arrows-alt-v'),
				array('fa fa-assistive-listening-systems' => 'fa fa-assistive-listening-systems'),
				array('fa fa-asterisk' => 'fa fa-asterisk'),
				array('fa fa-at' => 'fa fa-at'),
				array('fa fa-atlas' => 'fa fa-atlas'),
				array('fa fa-atom' => 'fa fa-atom'),
				array('fa fa-audio-description' => 'fa fa-audio-description'),
				array('fa fa-award' => 'fa fa-award'),
				array('fa fa-baby' => 'fa fa-baby'),
				array('fa fa-baby-carriage' => 'fa fa-baby-carriage'),
				array('fa fa-backspace' => 'fa fa-backspace'),
				array('fa fa-backward' => 'fa fa-backward'),
				array('fa fa-bacon' => 'fa fa-bacon'),
				array('fa fa-bahai' => 'fa fa-bahai'),
				array('fa fa-balance-scale' => 'fa fa-balance-scale'),
				array('fa fa-balance-scale-left' => 'fa fa-balance-scale-left'),
				array('fa fa-balance-scale-right' => 'fa fa-balance-scale-right'),
				array('fa fa-ban' => 'fa fa-ban'),
				array('fa fa-band-aid' => 'fa fa-band-aid'),
				array('fa fa-barcode' => 'fa fa-barcode'),
				array('fa fa-bars' => 'fa fa-bars'),
				array('fa fa-baseball-ball' => 'fa fa-baseball-ball'),
				array('fa fa-basketball-ball' => 'fa fa-basketball-ball'),
				array('fa fa-bath' => 'fa fa-bath'),
				array('fa fa-battery-empty' => 'fa fa-battery-empty'),
				array('fa fa-battery-full' => 'fa fa-battery-full'),
				array('fa fa-battery-half' => 'fa fa-battery-half'),
				array('fa fa-battery-quarter' => 'fa fa-battery-quarter'),
				array('fa fa-battery-three-quarters' => 'fa fa-battery-three-quarters'),
				array('fa fa-bed' => 'fa fa-bed'),
				array('fa fa-beer' => 'fa fa-beer'),
				array('fa fa-bell' => 'fa fa-bell'),
				array('fa fa-bell-slash' => 'fa fa-bell-slash'),
				array('fa fa-bezier-curve' => 'fa fa-bezier-curve'),
				array('fa fa-bible' => 'fa fa-bible'),
				array('fa fa-bicycle' => 'fa fa-bicycle'),
				array('fa fa-biking' => 'fa fa-biking'),
				array('fa fa-binoculars' => 'fa fa-binoculars'),
				array('fa fa-biohazard' => 'fa fa-biohazard'),
				array('fa fa-birthday-cake' => 'fa fa-birthday-cake'),
				array('fa fa-blender' => 'fa fa-blender'),
				array('fa fa-blender-phone' => 'fa fa-blender-phone'),
				array('fa fa-blind' => 'fa fa-blind'),
				array('fa fa-blog' => 'fa fa-blog'),
				array('fa fa-bold' => 'fa fa-bold'),
				array('fa fa-bolt' => 'fa fa-bolt'),
				array('fa fa-bomb' => 'fa fa-bomb'),
				array('fa fa-bone' => 'fa fa-bone'),
				array('fa fa-bong' => 'fa fa-bong'),
				array('fa fa-book' => 'fa fa-book'),
				array('fa fa-book-dead' => 'fa fa-book-dead'),
				array('fa fa-book-medical' => 'fa fa-book-medical'),
				array('fa fa-book-open' => 'fa fa-book-open'),
				array('fa fa-book-reader' => 'fa fa-book-reader'),
				array('fa fa-bookmark' => 'fa fa-bookmark'),
				array('fa fa-border' => 'fa fa-border'),
				array('fa fa-border-all' => 'fa fa-border-all'),
				array('fa fa-border-none' => 'fa fa-border-none'),
				array('fa fa-border-style' => 'fa fa-border-style'),
				array('fa fa-bowling-ball' => 'fa fa-bowling-ball'),
				array('fa fa-box' => 'fa fa-box'),
				array('fa fa-box-open' => 'fa fa-box-open'),
				array('fa fa-box-tissue' => 'fa fa-box-tissue'),
				array('fa fa-boxes' => 'fa fa-boxes'),
				array('fa fa-braille' => 'fa fa-braille'),
				array('fa fa-brain' => 'fa fa-brain'),
				array('fa fa-bread-slice' => 'fa fa-bread-slice'),
				array('fa fa-briefcase' => 'fa fa-briefcase'),
				array('fa fa-briefcase-medical' => 'fa fa-briefcase-medical'),
				array('fa fa-broadcast-tower' => 'fa fa-broadcast-tower'),
				array('fa fa-broom' => 'fa fa-broom'),
				array('fa fa-brush' => 'fa fa-brush'),
				array('fa fa-bug' => 'fa fa-bug'),
				array('fa fa-building' => 'fa fa-building'),
				array('fa fa-bullhorn' => 'fa fa-bullhorn'),
				array('fa fa-bullseye' => 'fa fa-bullseye'),
				array('fa fa-burn' => 'fa fa-burn'),
				array('fa fa-bus' => 'fa fa-bus'),
				array('fa fa-bus-alt' => 'fa fa-bus-alt'),
				array('fa fa-business-time' => 'fa fa-business-time'),
				array('fa fa-calculator' => 'fa fa-calculator'),
				array('fa fa-calendar' => 'fa fa-calendar'),
				array('fa fa-calendar-alt' => 'fa fa-calendar-alt'),
				array('fa fa-calendar-check' => 'fa fa-calendar-check'),
				array('fa fa-calendar-day' => 'fa fa-calendar-day'),
				array('fa fa-calendar-minus' => 'fa fa-calendar-minus'),
				array('fa fa-calendar-plus' => 'fa fa-calendar-plus'),
				array('fa fa-calendar-times' => 'fa fa-calendar-times'),
				array('fa fa-calendar-week' => 'fa fa-calendar-week'),
				array('fa fa-camera' => 'fa fa-camera'),
				array('fa fa-camera-retro' => 'fa fa-camera-retro'),
				array('fa fa-campground' => 'fa fa-campground'),
				array('fa fa-candy-cane' => 'fa fa-candy-cane'),
				array('fa fa-cannabis' => 'fa fa-cannabis'),
				array('fa fa-capsules' => 'fa fa-capsules'),
				array('fa fa-car' => 'fa fa-car'),
				array('fa fa-car-alt' => 'fa fa-car-alt'),
				array('fa fa-car-battery' => 'fa fa-car-battery'),
				array('fa fa-car-crash' => 'fa fa-car-crash'),
				array('fa fa-car-side' => 'fa fa-car-side'),
				array('fa fa-caravan' => 'fa fa-caravan'),
				array('fa fa-caret-down' => 'fa fa-caret-down'),
				array('fa fa-caret-left' => 'fa fa-caret-left'),
				array('fa fa-caret-right' => 'fa fa-caret-right'),
				array('fa fa-caret-square-down' => 'fa fa-caret-square-down'),
				array('fa fa-caret-square-left' => 'fa fa-caret-square-left'),
				array('fa fa-caret-square-right' => 'fa fa-caret-square-right'),
				array('fa fa-caret-square-up' => 'fa fa-caret-square-up'),
				array('fa fa-caret-up' => 'fa fa-caret-up'),
				array('fa fa-carrot' => 'fa fa-carrot'),
				array('fa fa-cart-arrow-down' => 'fa fa-cart-arrow-down'),
				array('fa fa-cart-plus' => 'fa fa-cart-plus'),
				array('fa fa-cash-register' => 'fa fa-cash-register'),
				array('fa fa-cat' => 'fa fa-cat'),
				array('fa fa-certificate' => 'fa fa-certificate'),
				array('fa fa-chair' => 'fa fa-chair'),
				array('fa fa-chalkboard' => 'fa fa-chalkboard'),
				array('fa fa-chalkboard-teacher' => 'fa fa-chalkboard-teacher'),
				array('fa fa-charging-station' => 'fa fa-charging-station'),
				array('fa fa-chart-area' => 'fa fa-chart-area'),
				array('fa fa-chart-bar' => 'fa fa-chart-bar'),
				array('fa fa-chart-line' => 'fa fa-chart-line'),
				array('fa fa-chart-pie' => 'fa fa-chart-pie'),
				array('fa fa-check' => 'fa fa-check'),
				array('fa fa-check-circle' => 'fa fa-check-circle'),
				array('fa fa-check-double' => 'fa fa-check-double'),
				array('fa fa-check-square' => 'fa fa-check-square'),
				array('fa fa-cheese' => 'fa fa-cheese'),
				array('fa fa-chess' => 'fa fa-chess'),
				array('fa fa-chess-bishop' => 'fa fa-chess-bishop'),
				array('fa fa-chess-board' => 'fa fa-chess-board'),
				array('fa fa-chess-king' => 'fa fa-chess-king'),
				array('fa fa-chess-knight' => 'fa fa-chess-knight'),
				array('fa fa-chess-pawn' => 'fa fa-chess-pawn'),
				array('fa fa-chess-queen' => 'fa fa-chess-queen'),
				array('fa fa-chess-rook' => 'fa fa-chess-rook'),
				array('fa fa-chevron-circle-down' => 'fa fa-chevron-circle-down'),
				array('fa fa-chevron-circle-left' => 'fa fa-chevron-circle-left'),
				array('fa fa-chevron-circle-right' => 'fa fa-chevron-circle-right'),
				array('fa fa-chevron-circle-up' => 'fa fa-chevron-circle-up'),
				array('fa fa-chevron-down' => 'fa fa-chevron-down'),
				array('fa fa-chevron-left' => 'fa fa-chevron-left'),
				array('fa fa-chevron-right' => 'fa fa-chevron-right'),
				array('fa fa-chevron-up' => 'fa fa-chevron-up'),
				array('fa fa-child' => 'fa fa-child'),
				array('fa fa-church' => 'fa fa-church'),
				array('fa fa-circle' => 'fa fa-circle'),
				array('fa fa-circle-notch' => 'fa fa-circle-notch'),
				array('fa fa-city' => 'fa fa-city'),
				array('fa fa-clinic-medical' => 'fa fa-clinic-medical'),
				array('fa fa-clipboard' => 'fa fa-clipboard'),
				array('fa fa-clipboard-check' => 'fa fa-clipboard-check'),
				array('fa fa-clipboard-list' => 'fa fa-clipboard-list'),
				array('fa fa-clock' => 'fa fa-clock'),
				array('fa fa-clone' => 'fa fa-clone'),
				array('fa fa-closed-captioning' => 'fa fa-closed-captioning'),
				array('fa fa-cloud' => 'fa fa-cloud'),
				array('fa fa-cloud-download-alt' => 'fa fa-cloud-download-alt'),
				array('fa fa-cloud-meatball' => 'fa fa-cloud-meatball'),
				array('fa fa-cloud-moon' => 'fa fa-cloud-moon'),
				array('fa fa-cloud-moon-rain' => 'fa fa-cloud-moon-rain'),
				array('fa fa-cloud-rain' => 'fa fa-cloud-rain'),
				array('fa fa-cloud-showers-heavy' => 'fa fa-cloud-showers-heavy'),
				array('fa fa-cloud-sun' => 'fa fa-cloud-sun'),
				array('fa fa-cloud-sun-rain' => 'fa fa-cloud-sun-rain'),
				array('fa fa-cloud-upload-alt' => 'fa fa-cloud-upload-alt'),
				array('fa fa-cocktail' => 'fa fa-cocktail'),
				array('fa fa-code' => 'fa fa-code'),
				array('fa fa-code-branch' => 'fa fa-code-branch'),
				array('fa fa-coffee' => 'fa fa-coffee'),
				array('fa fa-cog' => 'fa fa-cog'),
				array('fa fa-cogs' => 'fa fa-cogs'),
				array('fa fa-coins' => 'fa fa-coins'),
				array('fa fa-columns' => 'fa fa-columns'),
				array('fa fa-comment' => 'fa fa-comment'),
				array('fa fa-comment-alt' => 'fa fa-comment-alt'),
				array('fa fa-comment-dollar' => 'fa fa-comment-dollar'),
				array('fa fa-comment-dots' => 'fa fa-comment-dots'),
				array('fa fa-comment-medical' => 'fa fa-comment-medical'),
				array('fa fa-comment-slash' => 'fa fa-comment-slash'),
				array('fa fa-comments' => 'fa fa-comments'),
				array('fa fa-comments-dollar' => 'fa fa-comments-dollar'),
				array('fa fa-compact-disc' => 'fa fa-compact-disc'),
				array('fa fa-compass' => 'fa fa-compass'),
				array('fa fa-compress' => 'fa fa-compress'),
				array('fa fa-compress-alt' => 'fa fa-compress-alt'),
				array('fa fa-compress-arrows-alt' => 'fa fa-compress-arrows-alt'),
				array('fa fa-concierge-bell' => 'fa fa-concierge-bell'),
				array('fa fa-cookie' => 'fa fa-cookie'),
				array('fa fa-cookie-bite' => 'fa fa-cookie-bite'),
				array('fa fa-copy' => 'fa fa-copy'),
				array('fa fa-copyright' => 'fa fa-copyright'),
				array('fa fa-couch' => 'fa fa-couch'),
				array('fa fa-credit-card' => 'fa fa-credit-card'),
				array('fa fa-crop' => 'fa fa-crop'),
				array('fa fa-crop-alt' => 'fa fa-crop-alt'),
				array('fa fa-cross' => 'fa fa-cross'),
				array('fa fa-crosshairs' => 'fa fa-crosshairs'),
				array('fa fa-crow' => 'fa fa-crow'),
				array('fa fa-crown' => 'fa fa-crown'),
				array('fa fa-crutch' => 'fa fa-crutch'),
				array('fa fa-cube' => 'fa fa-cube'),
				array('fa fa-cubes' => 'fa fa-cubes'),
				array('fa fa-cut' => 'fa fa-cut'),
				array('fa fa-database' => 'fa fa-database'),
				array('fa fa-deaf' => 'fa fa-deaf'),
				array('fa fa-democrat' => 'fa fa-democrat'),
				array('fa fa-desktop' => 'fa fa-desktop'),
				array('fa fa-dharmachakra' => 'fa fa-dharmachakra'),
				array('fa fa-diagnoses' => 'fa fa-diagnoses'),
				array('fa fa-dice' => 'fa fa-dice'),
				array('fa fa-dice-d20' => 'fa fa-dice-d20'),
				array('fa fa-dice-d6' => 'fa fa-dice-d6'),
				array('fa fa-dice-five' => 'fa fa-dice-five'),
				array('fa fa-dice-four' => 'fa fa-dice-four'),
				array('fa fa-dice-one' => 'fa fa-dice-one'),
				array('fa fa-dice-six' => 'fa fa-dice-six'),
				array('fa fa-dice-three' => 'fa fa-dice-three'),
				array('fa fa-dice-two' => 'fa fa-dice-two'),
				array('fa fa-digital-tachograph' => 'fa fa-digital-tachograph'),
				array('fa fa-directions' => 'fa fa-directions'),
				array('fa fa-disease' => 'fa fa-disease'),
				array('fa fa-divide' => 'fa fa-divide'),
				array('fa fa-dizzy' => 'fa fa-dizzy'),
				array('fa fa-dna' => 'fa fa-dna'),
				array('fa fa-dog' => 'fa fa-dog'),
				array('fa fa-dollar-sign' => 'fa fa-dollar-sign'),
				array('fa fa-dolly' => 'fa fa-dolly'),
				array('fa fa-dolly-flatbed' => 'fa fa-dolly-flatbed'),
				array('fa fa-donate' => 'fa fa-donate'),
				array('fa fa-door-closed' => 'fa fa-door-closed'),
				array('fa fa-door-open' => 'fa fa-door-open'),
				array('fa fa-dot-circle' => 'fa fa-dot-circle'),
				array('fa fa-dove' => 'fa fa-dove'),
				array('fa fa-download' => 'fa fa-download'),
				array('fa fa-drafting-compass' => 'fa fa-drafting-compass'),
				array('fa fa-dragon' => 'fa fa-dragon'),
				array('fa fa-draw-polygon' => 'fa fa-draw-polygon'),
				array('fa fa-drum' => 'fa fa-drum'),
				array('fa fa-drum-steelpan' => 'fa fa-drum-steelpan'),
				array('fa fa-drumstick-bite' => 'fa fa-drumstick-bite'),
				array('fa fa-dumbbell' => 'fa fa-dumbbell'),
				array('fa fa-dumpster' => 'fa fa-dumpster'),
				array('fa fa-dumpster-fire' => 'fa fa-dumpster-fire'),
				array('fa fa-dungeon' => 'fa fa-dungeon'),
				array('fa fa-edit' => 'fa fa-edit'),
				array('fa fa-egg' => 'fa fa-egg'),
				array('fa fa-eject' => 'fa fa-eject'),
				array('fa fa-ellipsis-h' => 'fa fa-ellipsis-h'),
				array('fa fa-ellipsis-v' => 'fa fa-ellipsis-v'),
				array('fa fa-envelope' => 'fa fa-envelope'),
				array('fa fa-envelope-open' => 'fa fa-envelope-open'),
				array('fa fa-envelope-open-text' => 'fa fa-envelope-open-text'),
				array('fa fa-envelope-square' => 'fa fa-envelope-square'),
				array('fa fa-equals' => 'fa fa-equals'),
				array('fa fa-eraser' => 'fa fa-eraser'),
				array('fa fa-ethernet' => 'fa fa-ethernet'),
				array('fa fa-euro-sign' => 'fa fa-euro-sign'),
				array('fa fa-exchange-alt' => 'fa fa-exchange-alt'),
				array('fa fa-exclamation' => 'fa fa-exclamation'),
				array('fa fa-exclamation-circle' => 'fa fa-exclamation-circle'),
				array('fa fa-exclamation-triangle' => 'fa fa-exclamation-triangle'),
				array('fa fa-expand' => 'fa fa-expand'),
				array('fa fa-expand-alt' => 'fa fa-expand-alt'),
				array('fa fa-expand-arrows-alt' => 'fa fa-expand-arrows-alt'),
				array('fa fa-external-link-alt' => 'fa fa-external-link-alt'),
				array('fa fa-external-link-square-alt' => 'fa fa-external-link-square-alt'),
				array('fa fa-eye' => 'fa fa-eye'),
				array('fa fa-eye-dropper' => 'fa fa-eye-dropper'),
				array('fa fa-eye-slash' => 'fa fa-eye-slash'),
				array('fa fa-fan' => 'fa fa-fan'),
				array('fa fa-fast-backward' => 'fa fa-fast-backward'),
				array('fa fa-fast-forward' => 'fa fa-fast-forward'),
				array('fa fa-faucet' => 'fa fa-faucet'),
				array('fa fa-fax' => 'fa fa-fax'),
				array('fa fa-feather' => 'fa fa-feather'),
				array('fa fa-feather-alt' => 'fa fa-feather-alt'),
				array('fa fa-female' => 'fa fa-female'),
				array('fa fa-fighter-jet' => 'fa fa-fighter-jet'),
				array('fa fa-file' => 'fa fa-file'),
				array('fa fa-file-alt' => 'fa fa-file-alt'),
				array('fa fa-file-archive' => 'fa fa-file-archive'),
				array('fa fa-file-audio' => 'fa fa-file-audio'),
				array('fa fa-file-code' => 'fa fa-file-code'),
				array('fa fa-file-contract' => 'fa fa-file-contract'),
				array('fa fa-file-csv' => 'fa fa-file-csv'),
				array('fa fa-file-download' => 'fa fa-file-download'),
				array('fa fa-file-excel' => 'fa fa-file-excel'),
				array('fa fa-file-export' => 'fa fa-file-export'),
				array('fa fa-file-image' => 'fa fa-file-image'),
				array('fa fa-file-import' => 'fa fa-file-import'),
				array('fa fa-file-invoice' => 'fa fa-file-invoice'),
				array('fa fa-file-invoice-dollar' => 'fa fa-file-invoice-dollar'),
				array('fa fa-file-medical' => 'fa fa-file-medical'),
				array('fa fa-file-medical-alt' => 'fa fa-file-medical-alt'),
				array('fa fa-file-pdf' => 'fa fa-file-pdf'),
				array('fa fa-file-powerpoint' => 'fa fa-file-powerpoint'),
				array('fa fa-file-prescription' => 'fa fa-file-prescription'),
				array('fa fa-file-signature' => 'fa fa-file-signature'),
				array('fa fa-file-upload' => 'fa fa-file-upload'),
				array('fa fa-file-video' => 'fa fa-file-video'),
				array('fa fa-file-word' => 'fa fa-file-word'),
				array('fa fa-fill' => 'fa fa-fill'),
				array('fa fa-fill-drip' => 'fa fa-fill-drip'),
				array('fa fa-film' => 'fa fa-film'),
				array('fa fa-filter' => 'fa fa-filter'),
				array('fa fa-fingerprint' => 'fa fa-fingerprint'),
				array('fa fa-fire' => 'fa fa-fire'),
				array('fa fa-fire-alt' => 'fa fa-fire-alt'),
				array('fa fa-fire-extinguisher' => 'fa fa-fire-extinguisher'),
				array('fa fa-first-aid' => 'fa fa-first-aid'),
				array('fa fa-fish' => 'fa fa-fish'),
				array('fa fa-fist-raised' => 'fa fa-fist-raised'),
				array('fa fa-flag' => 'fa fa-flag'),
				array('fa fa-flag-checkered' => 'fa fa-flag-checkered'),
				array('fa fa-flag-usa' => 'fa fa-flag-usa'),
				array('fa fa-flask' => 'fa fa-flask'),
				array('fa fa-flip-both' => 'fa fa-flip-both'),
				array('fa fa-flip-horizontal' => 'fa fa-flip-horizontal'),
				array('fa fa-flip-vertical' => 'fa fa-flip-vertical'),
				array('fa fa-flushed' => 'fa fa-flushed'),
				array('fa fa-folder' => 'fa fa-folder'),
				array('fa fa-folder-minus' => 'fa fa-folder-minus'),
				array('fa fa-folder-open' => 'fa fa-folder-open'),
				array('fa fa-folder-plus' => 'fa fa-folder-plus'),
				array('fa fa-font' => 'fa fa-font'),
				array('fa fa-football-ball' => 'fa fa-football-ball'),
				array('fa fa-forward' => 'fa fa-forward'),
				array('fa fa-frog' => 'fa fa-frog'),
				array('fa fa-frown' => 'fa fa-frown'),
				array('fa fa-frown-open' => 'fa fa-frown-open'),
				array('fa fa-funnel-dollar' => 'fa fa-funnel-dollar'),
				array('fa fa-futbol' => 'fa fa-futbol'),
				array('fa fa-fw' => 'fa fa-fw'),
				array('fa fa-gamepad' => 'fa fa-gamepad'),
				array('fa fa-gas-pump' => 'fa fa-gas-pump'),
				array('fa fa-gavel' => 'fa fa-gavel'),
				array('fa fa-gem' => 'fa fa-gem'),
				array('fa fa-genderless' => 'fa fa-genderless'),
				array('fa fa-ghost' => 'fa fa-ghost'),
				array('fa fa-gift' => 'fa fa-gift'),
				array('fa fa-gifts' => 'fa fa-gifts'),
				array('fa fa-glass-cheers' => 'fa fa-glass-cheers'),
				array('fa fa-glass-martini' => 'fa fa-glass-martini'),
				array('fa fa-glass-martini-alt' => 'fa fa-glass-martini-alt'),
				array('fa fa-glass-whiskey' => 'fa fa-glass-whiskey'),
				array('fa fa-glasses' => 'fa fa-glasses'),
				array('fa fa-globe' => 'fa fa-globe'),
				array('fa fa-globe-africa' => 'fa fa-globe-africa'),
				array('fa fa-globe-americas' => 'fa fa-globe-americas'),
				array('fa fa-globe-asia' => 'fa fa-globe-asia'),
				array('fa fa-globe-europe' => 'fa fa-globe-europe'),
				array('fa fa-golf-ball' => 'fa fa-golf-ball'),
				array('fa fa-gopuram' => 'fa fa-gopuram'),
				array('fa fa-graduation-cap' => 'fa fa-graduation-cap'),
				array('fa fa-greater-than' => 'fa fa-greater-than'),
				array('fa fa-greater-than-equal' => 'fa fa-greater-than-equal'),
				array('fa fa-grimace' => 'fa fa-grimace'),
				array('fa fa-grin' => 'fa fa-grin'),
				array('fa fa-grin-alt' => 'fa fa-grin-alt'),
				array('fa fa-grin-beam' => 'fa fa-grin-beam'),
				array('fa fa-grin-beam-sweat' => 'fa fa-grin-beam-sweat'),
				array('fa fa-grin-hearts' => 'fa fa-grin-hearts'),
				array('fa fa-grin-squint' => 'fa fa-grin-squint'),
				array('fa fa-grin-squint-tears' => 'fa fa-grin-squint-tears'),
				array('fa fa-grin-stars' => 'fa fa-grin-stars'),
				array('fa fa-grin-tears' => 'fa fa-grin-tears'),
				array('fa fa-grin-tongue' => 'fa fa-grin-tongue'),
				array('fa fa-grin-tongue-squint' => 'fa fa-grin-tongue-squint'),
				array('fa fa-grin-tongue-wink' => 'fa fa-grin-tongue-wink'),
				array('fa fa-grin-wink' => 'fa fa-grin-wink'),
				array('fa fa-grip-horizontal' => 'fa fa-grip-horizontal'),
				array('fa fa-grip-lines' => 'fa fa-grip-lines'),
				array('fa fa-grip-lines-vertical' => 'fa fa-grip-lines-vertical'),
				array('fa fa-grip-vertical' => 'fa fa-grip-vertical'),
				array('fa fa-guitar' => 'fa fa-guitar'),
				array('fa fa-h-square' => 'fa fa-h-square'),
				array('fa fa-hamburger' => 'fa fa-hamburger'),
				array('fa fa-hammer' => 'fa fa-hammer'),
				array('fa fa-hamsa' => 'fa fa-hamsa'),
				array('fa fa-hand-holding' => 'fa fa-hand-holding'),
				array('fa fa-hand-holding-heart' => 'fa fa-hand-holding-heart'),
				array('fa fa-hand-holding-medical' => 'fa fa-hand-holding-medical'),
				array('fa fa-hand-holding-usd' => 'fa fa-hand-holding-usd'),
				array('fa fa-hand-holding-water' => 'fa fa-hand-holding-water'),
				array('fa fa-hand-lizard' => 'fa fa-hand-lizard'),
				array('fa fa-hand-middle-finger' => 'fa fa-hand-middle-finger'),
				array('fa fa-hand-paper' => 'fa fa-hand-paper'),
				array('fa fa-hand-peace' => 'fa fa-hand-peace'),
				array('fa fa-hand-point-down' => 'fa fa-hand-point-down'),
				array('fa fa-hand-point-left' => 'fa fa-hand-point-left'),
				array('fa fa-hand-point-right' => 'fa fa-hand-point-right'),
				array('fa fa-hand-point-up' => 'fa fa-hand-point-up'),
				array('fa fa-hand-pointer' => 'fa fa-hand-pointer'),
				array('fa fa-hand-rock' => 'fa fa-hand-rock'),
				array('fa fa-hand-scissors' => 'fa fa-hand-scissors'),
				array('fa fa-hand-sparkles' => 'fa fa-hand-sparkles'),
				array('fa fa-hand-spock' => 'fa fa-hand-spock'),
				array('fa fa-hands' => 'fa fa-hands'),
				array('fa fa-hands-helping' => 'fa fa-hands-helping'),
				array('fa fa-hands-wash' => 'fa fa-hands-wash'),
				array('fa fa-handshake' => 'fa fa-handshake'),
				array('fa fa-handshake-alt-slash' => 'fa fa-handshake-alt-slash'),
				array('fa fa-handshake-slash' => 'fa fa-handshake-slash'),
				array('fa fa-hanukiah' => 'fa fa-hanukiah'),
				array('fa fa-hard-hat' => 'fa fa-hard-hat'),
				array('fa fa-hashtag' => 'fa fa-hashtag'),
				array('fa fa-hat-cowboy' => 'fa fa-hat-cowboy'),
				array('fa fa-hat-cowboy-side' => 'fa fa-hat-cowboy-side'),
				array('fa fa-hat-wizard' => 'fa fa-hat-wizard'),
				array('fa fa-hdd' => 'fa fa-hdd'),
				array('fa fa-head-side-cough' => 'fa fa-head-side-cough'),
				array('fa fa-head-side-cough-slash' => 'fa fa-head-side-cough-slash'),
				array('fa fa-head-side-mask' => 'fa fa-head-side-mask'),
				array('fa fa-head-side-virus' => 'fa fa-head-side-virus'),
				array('fa fa-heading' => 'fa fa-heading'),
				array('fa fa-headphones' => 'fa fa-headphones'),
				array('fa fa-headphones-alt' => 'fa fa-headphones-alt'),
				array('fa fa-headset' => 'fa fa-headset'),
				array('fa fa-heart' => 'fa fa-heart'),
				array('fa fa-heart-broken' => 'fa fa-heart-broken'),
				array('fa fa-heartbeat' => 'fa fa-heartbeat'),
				array('fa fa-helicopter' => 'fa fa-helicopter'),
				array('fa fa-highlighter' => 'fa fa-highlighter'),
				array('fa fa-hiking' => 'fa fa-hiking'),
				array('fa fa-hippo' => 'fa fa-hippo'),
				array('fa fa-history' => 'fa fa-history'),
				array('fa fa-hockey-puck' => 'fa fa-hockey-puck'),
				array('fa fa-holly-berry' => 'fa fa-holly-berry'),
				array('fa fa-home' => 'fa fa-home'),
				array('fa fa-horse' => 'fa fa-horse'),
				array('fa fa-horse-head' => 'fa fa-horse-head'),
				array('fa fa-hospital' => 'fa fa-hospital'),
				array('fa fa-hospital-alt' => 'fa fa-hospital-alt'),
				array('fa fa-hospital-symbol' => 'fa fa-hospital-symbol'),
				array('fa fa-hospital-user' => 'fa fa-hospital-user'),
				array('fa fa-hot-tub' => 'fa fa-hot-tub'),
				array('fa fa-hotdog' => 'fa fa-hotdog'),
				array('fa fa-hotel' => 'fa fa-hotel'),
				array('fa fa-hourglass' => 'fa fa-hourglass'),
				array('fa fa-hourglass-end' => 'fa fa-hourglass-end'),
				array('fa fa-hourglass-half' => 'fa fa-hourglass-half'),
				array('fa fa-hourglass-start' => 'fa fa-hourglass-start'),
				array('fa fa-house-damage' => 'fa fa-house-damage'),
				array('fa fa-house-user' => 'fa fa-house-user'),
				array('fa fa-hryvnia' => 'fa fa-hryvnia'),
				array('fa fa-i-cursor' => 'fa fa-i-cursor'),
				array('fa fa-ice-cream' => 'fa fa-ice-cream'),
				array('fa fa-icicles' => 'fa fa-icicles'),
				array('fa fa-icons' => 'fa fa-icons'),
				array('fa fa-id-badge' => 'fa fa-id-badge'),
				array('fa fa-id-card' => 'fa fa-id-card'),
				array('fa fa-id-card-alt' => 'fa fa-id-card-alt'),
				array('fa fa-igloo' => 'fa fa-igloo'),
				array('fa fa-image' => 'fa fa-image'),
				array('fa fa-images' => 'fa fa-images'),
				array('fa fa-inbox' => 'fa fa-inbox'),
				array('fa fa-indent' => 'fa fa-indent'),
				array('fa fa-industry' => 'fa fa-industry'),
				array('fa fa-infinity' => 'fa fa-infinity'),
				array('fa fa-info' => 'fa fa-info'),
				array('fa fa-info-circle' => 'fa fa-info-circle'),
				array('fa fa-inverse' => 'fa fa-inverse'),
				array('fa fa-italic' => 'fa fa-italic'),
				array('fa fa-jedi' => 'fa fa-jedi'),
				array('fa fa-joint' => 'fa fa-joint'),
				array('fa fa-journal-whills' => 'fa fa-journal-whills'),
				array('fa fa-kaaba' => 'fa fa-kaaba'),
				array('fa fa-key' => 'fa fa-key'),
				array('fa fa-keyboard' => 'fa fa-keyboard'),
				array('fa fa-khanda' => 'fa fa-khanda'),
				array('fa fa-kiss' => 'fa fa-kiss'),
				array('fa fa-kiss-beam' => 'fa fa-kiss-beam'),
				array('fa fa-kiss-wink-heart' => 'fa fa-kiss-wink-heart'),
				array('fa fa-kiwi-bird' => 'fa fa-kiwi-bird'),
				array('fa fa-landmark' => 'fa fa-landmark'),
				array('fa fa-language' => 'fa fa-language'),
				array('fa fa-laptop' => 'fa fa-laptop'),
				array('fa fa-laptop-code' => 'fa fa-laptop-code'),
				array('fa fa-laptop-house' => 'fa fa-laptop-house'),
				array('fa fa-laptop-medical' => 'fa fa-laptop-medical'),
				array('fa fa-laugh' => 'fa fa-laugh'),
				array('fa fa-laugh-beam' => 'fa fa-laugh-beam'),
				array('fa fa-laugh-squint' => 'fa fa-laugh-squint'),
				array('fa fa-laugh-wink' => 'fa fa-laugh-wink'),
				array('fa fa-layer-group' => 'fa fa-layer-group'),
				array('fa fa-leaf' => 'fa fa-leaf'),
				array('fa fa-lemon' => 'fa fa-lemon'),
				array('fa fa-less-than' => 'fa fa-less-than'),
				array('fa fa-less-than-equal' => 'fa fa-less-than-equal'),
				array('fa fa-level-down-alt' => 'fa fa-level-down-alt'),
				array('fa fa-level-up-alt' => 'fa fa-level-up-alt'),
				array('fa fa-lg' => 'fa fa-lg'),
				array('fa fa-li' => 'fa fa-li'),
				array('fa fa-life-ring' => 'fa fa-life-ring'),
				array('fa fa-lightbulb' => 'fa fa-lightbulb'),
				array('fa fa-link' => 'fa fa-link'),
				array('fa fa-lira-sign' => 'fa fa-lira-sign'),
				array('fa fa-list' => 'fa fa-list'),
				array('fa fa-list-alt' => 'fa fa-list-alt'),
				array('fa fa-list-ol' => 'fa fa-list-ol'),
				array('fa fa-list-ul' => 'fa fa-list-ul'),
				array('fa fa-location-arrow' => 'fa fa-location-arrow'),
				array('fa fa-lock' => 'fa fa-lock'),
				array('fa fa-lock-open' => 'fa fa-lock-open'),
				array('fa fa-long-arrow-alt-down' => 'fa fa-long-arrow-alt-down'),
				array('fa fa-long-arrow-alt-left' => 'fa fa-long-arrow-alt-left'),
				array('fa fa-long-arrow-alt-right' => 'fa fa-long-arrow-alt-right'),
				array('fa fa-long-arrow-alt-up' => 'fa fa-long-arrow-alt-up'),
				array('fa fa-low-vision' => 'fa fa-low-vision'),
				array('fa fa-luggage-cart' => 'fa fa-luggage-cart'),
				array('fa fa-lungs' => 'fa fa-lungs'),
				array('fa fa-lungs-virus' => 'fa fa-lungs-virus'),
				array('fa fa-magic' => 'fa fa-magic'),
				array('fa fa-magnet' => 'fa fa-magnet'),
				array('fa fa-mail-bulk' => 'fa fa-mail-bulk'),
				array('fa fa-male' => 'fa fa-male'),
				array('fa fa-map' => 'fa fa-map'),
				array('fa fa-map-marked' => 'fa fa-map-marked'),
				array('fa fa-map-marked-alt' => 'fa fa-map-marked-alt'),
				array('fa fa-map-marker' => 'fa fa-map-marker'),
				array('fa fa-map-marker-alt' => 'fa fa-map-marker-alt'),
				array('fa fa-map-pin' => 'fa fa-map-pin'),
				array('fa fa-map-signs' => 'fa fa-map-signs'),
				array('fa fa-marker' => 'fa fa-marker'),
				array('fa fa-mars' => 'fa fa-mars'),
				array('fa fa-mars-double' => 'fa fa-mars-double'),
				array('fa fa-mars-stroke' => 'fa fa-mars-stroke'),
				array('fa fa-mars-stroke-h' => 'fa fa-mars-stroke-h'),
				array('fa fa-mars-stroke-v' => 'fa fa-mars-stroke-v'),
				array('fa fa-mask' => 'fa fa-mask'),
				array('fa fa-medal' => 'fa fa-medal'),
				array('fa fa-medkit' => 'fa fa-medkit'),
				array('fa fa-meh' => 'fa fa-meh'),
				array('fa fa-meh-blank' => 'fa fa-meh-blank'),
				array('fa fa-meh-rolling-eyes' => 'fa fa-meh-rolling-eyes'),
				array('fa fa-memory' => 'fa fa-memory'),
				array('fa fa-menorah' => 'fa fa-menorah'),
				array('fa fa-mercury' => 'fa fa-mercury'),
				array('fa fa-meteor' => 'fa fa-meteor'),
				array('fa fa-microchip' => 'fa fa-microchip'),
				array('fa fa-microphone' => 'fa fa-microphone'),
				array('fa fa-microphone-alt' => 'fa fa-microphone-alt'),
				array('fa fa-microphone-alt-slash' => 'fa fa-microphone-alt-slash'),
				array('fa fa-microphone-slash' => 'fa fa-microphone-slash'),
				array('fa fa-microscope' => 'fa fa-microscope'),
				array('fa fa-minus' => 'fa fa-minus'),
				array('fa fa-minus-circle' => 'fa fa-minus-circle'),
				array('fa fa-minus-square' => 'fa fa-minus-square'),
				array('fa fa-mitten' => 'fa fa-mitten'),
				array('fa fa-mobile' => 'fa fa-mobile'),
				array('fa fa-mobile-alt' => 'fa fa-mobile-alt'),
				array('fa fa-money-bill' => 'fa fa-money-bill'),
				array('fa fa-money-bill-alt' => 'fa fa-money-bill-alt'),
				array('fa fa-money-bill-wave' => 'fa fa-money-bill-wave'),
				array('fa fa-money-bill-wave-alt' => 'fa fa-money-bill-wave-alt'),
				array('fa fa-money-check' => 'fa fa-money-check'),
				array('fa fa-money-check-alt' => 'fa fa-money-check-alt'),
				array('fa fa-monument' => 'fa fa-monument'),
				array('fa fa-moon' => 'fa fa-moon'),
				array('fa fa-mortar-pestle' => 'fa fa-mortar-pestle'),
				array('fa fa-mosque' => 'fa fa-mosque'),
				array('fa fa-motorcycle' => 'fa fa-motorcycle'),
				array('fa fa-mountain' => 'fa fa-mountain'),
				array('fa fa-mouse' => 'fa fa-mouse'),
				array('fa fa-mouse-pointer' => 'fa fa-mouse-pointer'),
				array('fa fa-mug-hot' => 'fa fa-mug-hot'),
				array('fa fa-music' => 'fa fa-music'),
				array('fa fa-network-wired' => 'fa fa-network-wired'),
				array('fa fa-neuter' => 'fa fa-neuter'),
				array('fa fa-newspaper' => 'fa fa-newspaper'),
				array('fa fa-not-equal' => 'fa fa-not-equal'),
				array('fa fa-notes-medical' => 'fa fa-notes-medical'),
				array('fa fa-object-group' => 'fa fa-object-group'),
				array('fa fa-object-ungroup' => 'fa fa-object-ungroup'),
				array('fa fa-oil-can' => 'fa fa-oil-can'),
				array('fa fa-om' => 'fa fa-om'),
				array('fa fa-otter' => 'fa fa-otter'),
				array('fa fa-outdent' => 'fa fa-outdent'),
				array('fa fa-pager' => 'fa fa-pager'),
				array('fa fa-paint-brush' => 'fa fa-paint-brush'),
				array('fa fa-paint-roller' => 'fa fa-paint-roller'),
				array('fa fa-palette' => 'fa fa-palette'),
				array('fa fa-pallet' => 'fa fa-pallet'),
				array('fa fa-paper-plane' => 'fa fa-paper-plane'),
				array('fa fa-paperclip' => 'fa fa-paperclip'),
				array('fa fa-parachute-box' => 'fa fa-parachute-box'),
				array('fa fa-paragraph' => 'fa fa-paragraph'),
				array('fa fa-parking' => 'fa fa-parking'),
				array('fa fa-passport' => 'fa fa-passport'),
				array('fa fa-pastafarianism' => 'fa fa-pastafarianism'),
				array('fa fa-paste' => 'fa fa-paste'),
				array('fa fa-pause' => 'fa fa-pause'),
				array('fa fa-pause-circle' => 'fa fa-pause-circle'),
				array('fa fa-paw' => 'fa fa-paw'),
				array('fa fa-peace' => 'fa fa-peace'),
				array('fa fa-pen' => 'fa fa-pen'),
				array('fa fa-pen-alt' => 'fa fa-pen-alt'),
				array('fa fa-pen-fancy' => 'fa fa-pen-fancy'),
				array('fa fa-pen-nib' => 'fa fa-pen-nib'),
				array('fa fa-pen-square' => 'fa fa-pen-square'),
				array('fa fa-pencil-alt' => 'fa fa-pencil-alt'),
				array('fa fa-pencil-ruler' => 'fa fa-pencil-ruler'),
				array('fa fa-people-arrows' => 'fa fa-people-arrows'),
				array('fa fa-people-carry' => 'fa fa-people-carry'),
				array('fa fa-pepper-hot' => 'fa fa-pepper-hot'),
				array('fa fa-percent' => 'fa fa-percent'),
				array('fa fa-percentage' => 'fa fa-percentage'),
				array('fa fa-person-booth' => 'fa fa-person-booth'),
				array('fa fa-phone' => 'fa fa-phone'),
				array('fa fa-phone-alt' => 'fa fa-phone-alt'),
				array('fa fa-phone-slash' => 'fa fa-phone-slash'),
				array('fa fa-phone-square' => 'fa fa-phone-square'),
				array('fa fa-phone-square-alt' => 'fa fa-phone-square-alt'),
				array('fa fa-phone-volume' => 'fa fa-phone-volume'),
				array('fa fa-photo-video' => 'fa fa-photo-video'),
				array('fa fa-piggy-bank' => 'fa fa-piggy-bank'),
				array('fa fa-pills' => 'fa fa-pills'),
				array('fa fa-pizza-slice' => 'fa fa-pizza-slice'),
				array('fa fa-place-of-worship' => 'fa fa-place-of-worship'),
				array('fa fa-plane' => 'fa fa-plane'),
				array('fa fa-plane-arrival' => 'fa fa-plane-arrival'),
				array('fa fa-plane-departure' => 'fa fa-plane-departure'),
				array('fa fa-plane-slash' => 'fa fa-plane-slash'),
				array('fa fa-play' => 'fa fa-play'),
				array('fa fa-play-circle' => 'fa fa-play-circle'),
				array('fa fa-plug' => 'fa fa-plug'),
				array('fa fa-plus' => 'fa fa-plus'),
				array('fa fa-plus-circle' => 'fa fa-plus-circle'),
				array('fa fa-plus-square' => 'fa fa-plus-square'),
				array('fa fa-podcast' => 'fa fa-podcast'),
				array('fa fa-poll' => 'fa fa-poll'),
				array('fa fa-poll-h' => 'fa fa-poll-h'),
				array('fa fa-poo' => 'fa fa-poo'),
				array('fa fa-poo-storm' => 'fa fa-poo-storm'),
				array('fa fa-poop' => 'fa fa-poop'),
				array('fa fa-portrait' => 'fa fa-portrait'),
				array('fa fa-pound-sign' => 'fa fa-pound-sign'),
				array('fa fa-power-off' => 'fa fa-power-off'),
				array('fa fa-pray' => 'fa fa-pray'),
				array('fa fa-praying-hands' => 'fa fa-praying-hands'),
				array('fa fa-prescription' => 'fa fa-prescription'),
				array('fa fa-prescription-bottle' => 'fa fa-prescription-bottle'),
				array('fa fa-prescription-bottle-alt' => 'fa fa-prescription-bottle-alt'),
				array('fa fa-print' => 'fa fa-print'),
				array('fa fa-procedures' => 'fa fa-procedures'),
				array('fa fa-project-diagram' => 'fa fa-project-diagram'),
				array('fa fa-pull-left' => 'fa fa-pull-left'),
				array('fa fa-pull-right' => 'fa fa-pull-right'),
				array('fa fa-pulse' => 'fa fa-pulse'),
				array('fa fa-pump-medical' => 'fa fa-pump-medical'),
				array('fa fa-pump-soap' => 'fa fa-pump-soap'),
				array('fa fa-puzzle-piece' => 'fa fa-puzzle-piece'),
				array('fa fa-qrcode' => 'fa fa-qrcode'),
				array('fa fa-question' => 'fa fa-question'),
				array('fa fa-question-circle' => 'fa fa-question-circle'),
				array('fa fa-quidditch' => 'fa fa-quidditch'),
				array('fa fa-quote-left' => 'fa fa-quote-left'),
				array('fa fa-quote-right' => 'fa fa-quote-right'),
				array('fa fa-quran' => 'fa fa-quran'),
				array('fa fa-radiation' => 'fa fa-radiation'),
				array('fa fa-radiation-alt' => 'fa fa-radiation-alt'),
				array('fa fa-rainbow' => 'fa fa-rainbow'),
				array('fa fa-random' => 'fa fa-random'),
				array('fa fa-receipt' => 'fa fa-receipt'),
				array('fa fa-record-vinyl' => 'fa fa-record-vinyl'),
				array('fa fa-recycle' => 'fa fa-recycle'),
				array('fa fa-redo' => 'fa fa-redo'),
				array('fa fa-redo-alt' => 'fa fa-redo-alt'),
				array('fa fa-registered' => 'fa fa-registered'),
				array('fa fa-remove-format' => 'fa fa-remove-format'),
				array('fa fa-reply' => 'fa fa-reply'),
				array('fa fa-reply-all' => 'fa fa-reply-all'),
				array('fa fa-republican' => 'fa fa-republican'),
				array('fa fa-restroom' => 'fa fa-restroom'),
				array('fa fa-retweet' => 'fa fa-retweet'),
				array('fa fa-ribbon' => 'fa fa-ribbon'),
				array('fa fa-ring' => 'fa fa-ring'),
				array('fa fa-road' => 'fa fa-road'),
				array('fa fa-robot' => 'fa fa-robot'),
				array('fa fa-rocket' => 'fa fa-rocket'),
				array('fa fa-rotate-180' => 'fa fa-rotate-180'),
				array('fa fa-rotate-270' => 'fa fa-rotate-270'),
				array('fa fa-rotate-90' => 'fa fa-rotate-90'),
				array('fa fa-route' => 'fa fa-route'),
				array('fa fa-rss' => 'fa fa-rss'),
				array('fa fa-rss-square' => 'fa fa-rss-square'),
				array('fa fa-ruble-sign' => 'fa fa-ruble-sign'),
				array('fa fa-ruler' => 'fa fa-ruler'),
				array('fa fa-ruler-combined' => 'fa fa-ruler-combined'),
				array('fa fa-ruler-horizontal' => 'fa fa-ruler-horizontal'),
				array('fa fa-ruler-vertical' => 'fa fa-ruler-vertical'),
				array('fa fa-running' => 'fa fa-running'),
				array('fa fa-rupee-sign' => 'fa fa-rupee-sign'),
				array('fa fa-sad-cry' => 'fa fa-sad-cry'),
				array('fa fa-sad-tear' => 'fa fa-sad-tear'),
				array('fa fa-satellite' => 'fa fa-satellite'),
				array('fa fa-satellite-dish' => 'fa fa-satellite-dish'),
				array('fa fa-save' => 'fa fa-save'),
				array('fa fa-school' => 'fa fa-school'),
				array('fa fa-screwdriver' => 'fa fa-screwdriver'),
				array('fa fa-scroll' => 'fa fa-scroll'),
				array('fa fa-sd-card' => 'fa fa-sd-card'),
				array('fa fa-search' => 'fa fa-search'),
				array('fa fa-search-dollar' => 'fa fa-search-dollar'),
				array('fa fa-search-location' => 'fa fa-search-location'),
				array('fa fa-search-minus' => 'fa fa-search-minus'),
				array('fa fa-search-plus' => 'fa fa-search-plus'),
				array('fa fa-seedling' => 'fa fa-seedling'),
				array('fa fa-server' => 'fa fa-server'),
				array('fa fa-shapes' => 'fa fa-shapes'),
				array('fa fa-share' => 'fa fa-share'),
				array('fa fa-share-alt' => 'fa fa-share-alt'),
				array('fa fa-share-alt-square' => 'fa fa-share-alt-square'),
				array('fa fa-share-square' => 'fa fa-share-square'),
				array('fa fa-shekel-sign' => 'fa fa-shekel-sign'),
				array('fa fa-shield-alt' => 'fa fa-shield-alt'),
				array('fa fa-shield-virus' => 'fa fa-shield-virus'),
				array('fa fa-ship' => 'fa fa-ship'),
				array('fa fa-shipping-fast' => 'fa fa-shipping-fast'),
				array('fa fa-shoe-prints' => 'fa fa-shoe-prints'),
				array('fa fa-shopping-bag' => 'fa fa-shopping-bag'),
				array('fa fa-shopping-basket' => 'fa fa-shopping-basket'),
				array('fa fa-shopping-cart' => 'fa fa-shopping-cart'),
				array('fa fa-shower' => 'fa fa-shower'),
				array('fa fa-shuttle-van' => 'fa fa-shuttle-van'),
				array('fa fa-sign' => 'fa fa-sign'),
				array('fa fa-sign-in-alt' => 'fa fa-sign-in-alt'),
				array('fa fa-sign-language' => 'fa fa-sign-language'),
				array('fa fa-sign-out-alt' => 'fa fa-sign-out-alt'),
				array('fa fa-signal' => 'fa fa-signal'),
				array('fa fa-signature' => 'fa fa-signature'),
				array('fa fa-sim-card' => 'fa fa-sim-card'),
				array('fa fa-sitemap' => 'fa fa-sitemap'),
				array('fa fa-skating' => 'fa fa-skating'),
				array('fa fa-skiing' => 'fa fa-skiing'),
				array('fa fa-skiing-nordic' => 'fa fa-skiing-nordic'),
				array('fa fa-skull' => 'fa fa-skull'),
				array('fa fa-skull-crossbones' => 'fa fa-skull-crossbones'),
				array('fa fa-slash' => 'fa fa-slash'),
				array('fa fa-sleigh' => 'fa fa-sleigh'),
				array('fa fa-sliders-h' => 'fa fa-sliders-h'),
				array('fa fa-sm' => 'fa fa-sm'),
				array('fa fa-smile' => 'fa fa-smile'),
				array('fa fa-smile-beam' => 'fa fa-smile-beam'),
				array('fa fa-smile-wink' => 'fa fa-smile-wink'),
				array('fa fa-smog' => 'fa fa-smog'),
				array('fa fa-smoking' => 'fa fa-smoking'),
				array('fa fa-smoking-ban' => 'fa fa-smoking-ban'),
				array('fa fa-sms' => 'fa fa-sms'),
				array('fa fa-snowboarding' => 'fa fa-snowboarding'),
				array('fa fa-snowflake' => 'fa fa-snowflake'),
				array('fa fa-snowman' => 'fa fa-snowman'),
				array('fa fa-snowplow' => 'fa fa-snowplow'),
				array('fa fa-soap' => 'fa fa-soap'),
				array('fa fa-socks' => 'fa fa-socks'),
				array('fa fa-solar-panel' => 'fa fa-solar-panel'),
				array('fa fa-sort' => 'fa fa-sort'),
				array('fa fa-sort-alpha-down' => 'fa fa-sort-alpha-down'),
				array('fa fa-sort-alpha-down-alt' => 'fa fa-sort-alpha-down-alt'),
				array('fa fa-sort-alpha-up' => 'fa fa-sort-alpha-up'),
				array('fa fa-sort-alpha-up-alt' => 'fa fa-sort-alpha-up-alt'),
				array('fa fa-sort-amount-down' => 'fa fa-sort-amount-down'),
				array('fa fa-sort-amount-down-alt' => 'fa fa-sort-amount-down-alt'),
				array('fa fa-sort-amount-up' => 'fa fa-sort-amount-up'),
				array('fa fa-sort-amount-up-alt' => 'fa fa-sort-amount-up-alt'),
				array('fa fa-sort-down' => 'fa fa-sort-down'),
				array('fa fa-sort-numeric-down' => 'fa fa-sort-numeric-down'),
				array('fa fa-sort-numeric-down-alt' => 'fa fa-sort-numeric-down-alt'),
				array('fa fa-sort-numeric-up' => 'fa fa-sort-numeric-up'),
				array('fa fa-sort-numeric-up-alt' => 'fa fa-sort-numeric-up-alt'),
				array('fa fa-sort-up' => 'fa fa-sort-up'),
				array('fa fa-spa' => 'fa fa-spa'),
				array('fa fa-space-shuttle' => 'fa fa-space-shuttle'),
				array('fa fa-spell-check' => 'fa fa-spell-check'),
				array('fa fa-spider' => 'fa fa-spider'),
				array('fa fa-spin' => 'fa fa-spin'),
				array('fa fa-spinner' => 'fa fa-spinner'),
				array('fa fa-splotch' => 'fa fa-splotch'),
				array('fa fa-spray-can' => 'fa fa-spray-can'),
				array('fa fa-square' => 'fa fa-square'),
				array('fa fa-square-full' => 'fa fa-square-full'),
				array('fa fa-square-root-alt' => 'fa fa-square-root-alt'),
				array('fa fa-stack' => 'fa fa-stack'),
				array('fa fa-stack-1x' => 'fa fa-stack-1x'),
				array('fa fa-stack-2x' => 'fa fa-stack-2x'),
				array('fa fa-stamp' => 'fa fa-stamp'),
				array('fa fa-star' => 'fa fa-star'),
				array('fa fa-star-and-crescent' => 'fa fa-star-and-crescent'),
				array('fa fa-star-half' => 'fa fa-star-half'),
				array('fa fa-star-half-alt' => 'fa fa-star-half-alt'),
				array('fa fa-star-of-david' => 'fa fa-star-of-david'),
				array('fa fa-star-of-life' => 'fa fa-star-of-life'),
				array('fa fa-step-backward' => 'fa fa-step-backward'),
				array('fa fa-step-forward' => 'fa fa-step-forward'),
				array('fa fa-stethoscope' => 'fa fa-stethoscope'),
				array('fa fa-sticky-note' => 'fa fa-sticky-note'),
				array('fa fa-stop' => 'fa fa-stop'),
				array('fa fa-stop-circle' => 'fa fa-stop-circle'),
				array('fa fa-stopwatch' => 'fa fa-stopwatch'),
				array('fa fa-stopwatch-20' => 'fa fa-stopwatch-20'),
				array('fa fa-store' => 'fa fa-store'),
				array('fa fa-store-alt' => 'fa fa-store-alt'),
				array('fa fa-store-alt-slash' => 'fa fa-store-alt-slash'),
				array('fa fa-store-slash' => 'fa fa-store-slash'),
				array('fa fa-stream' => 'fa fa-stream'),
				array('fa fa-street-view' => 'fa fa-street-view'),
				array('fa fa-strikethrough' => 'fa fa-strikethrough'),
				array('fa fa-stroopwafel' => 'fa fa-stroopwafel'),
				array('fa fa-subscript' => 'fa fa-subscript'),
				array('fa fa-subway' => 'fa fa-subway'),
				array('fa fa-suitcase' => 'fa fa-suitcase'),
				array('fa fa-suitcase-rolling' => 'fa fa-suitcase-rolling'),
				array('fa fa-sun' => 'fa fa-sun'),
				array('fa fa-superscript' => 'fa fa-superscript'),
				array('fa fa-surprise' => 'fa fa-surprise'),
				array('fa fa-swatchbook' => 'fa fa-swatchbook'),
				array('fa fa-swimmer' => 'fa fa-swimmer'),
				array('fa fa-swimming-pool' => 'fa fa-swimming-pool'),
				array('fa fa-synagogue' => 'fa fa-synagogue'),
				array('fa fa-sync' => 'fa fa-sync'),
				array('fa fa-sync-alt' => 'fa fa-sync-alt'),
				array('fa fa-syringe' => 'fa fa-syringe'),
				array('fa fa-table' => 'fa fa-table'),
				array('fa fa-table-tennis' => 'fa fa-table-tennis'),
				array('fa fa-tablet' => 'fa fa-tablet'),
				array('fa fa-tablet-alt' => 'fa fa-tablet-alt'),
				array('fa fa-tablets' => 'fa fa-tablets'),
				array('fa fa-tachometer-alt' => 'fa fa-tachometer-alt'),
				array('fa fa-tag' => 'fa fa-tag'),
				array('fa fa-tags' => 'fa fa-tags'),
				array('fa fa-tape' => 'fa fa-tape'),
				array('fa fa-tasks' => 'fa fa-tasks'),
				array('fa fa-taxi' => 'fa fa-taxi'),
				array('fa fa-teeth' => 'fa fa-teeth'),
				array('fa fa-teeth-open' => 'fa fa-teeth-open'),
				array('fa fa-temperature-high' => 'fa fa-temperature-high'),
				array('fa fa-temperature-low' => 'fa fa-temperature-low'),
				array('fa fa-tenge' => 'fa fa-tenge'),
				array('fa fa-terminal' => 'fa fa-terminal'),
				array('fa fa-text-height' => 'fa fa-text-height'),
				array('fa fa-text-width' => 'fa fa-text-width'),
				array('fa fa-th' => 'fa fa-th'),
				array('fa fa-th-large' => 'fa fa-th-large'),
				array('fa fa-th-list' => 'fa fa-th-list'),
				array('fa fa-theater-masks' => 'fa fa-theater-masks'),
				array('fa fa-thermometer' => 'fa fa-thermometer'),
				array('fa fa-thermometer-empty' => 'fa fa-thermometer-empty'),
				array('fa fa-thermometer-full' => 'fa fa-thermometer-full'),
				array('fa fa-thermometer-half' => 'fa fa-thermometer-half'),
				array('fa fa-thermometer-quarter' => 'fa fa-thermometer-quarter'),
				array('fa fa-thermometer-three-quarters' => 'fa fa-thermometer-three-quarters'),
				array('fa fa-thumbs-down' => 'fa fa-thumbs-down'),
				array('fa fa-thumbs-up' => 'fa fa-thumbs-up'),
				array('fa fa-thumbtack' => 'fa fa-thumbtack'),
				array('fa fa-ticket-alt' => 'fa fa-ticket-alt'),
				array('fa fa-times' => 'fa fa-times'),
				array('fa fa-times-circle' => 'fa fa-times-circle'),
				array('fa fa-tint' => 'fa fa-tint'),
				array('fa fa-tint-slash' => 'fa fa-tint-slash'),
				array('fa fa-tired' => 'fa fa-tired'),
				array('fa fa-toggle-off' => 'fa fa-toggle-off'),
				array('fa fa-toggle-on' => 'fa fa-toggle-on'),
				array('fa fa-toilet' => 'fa fa-toilet'),
				array('fa fa-toilet-paper' => 'fa fa-toilet-paper'),
				array('fa fa-toilet-paper-slash' => 'fa fa-toilet-paper-slash'),
				array('fa fa-toolbox' => 'fa fa-toolbox'),
				array('fa fa-tools' => 'fa fa-tools'),
				array('fa fa-tooth' => 'fa fa-tooth'),
				array('fa fa-torah' => 'fa fa-torah'),
				array('fa fa-torii-gate' => 'fa fa-torii-gate'),
				array('fa fa-tractor' => 'fa fa-tractor'),
				array('fa fa-trademark' => 'fa fa-trademark'),
				array('fa fa-traffic-light' => 'fa fa-traffic-light'),
				array('fa fa-trailer' => 'fa fa-trailer'),
				array('fa fa-train' => 'fa fa-train'),
				array('fa fa-tram' => 'fa fa-tram'),
				array('fa fa-transgender' => 'fa fa-transgender'),
				array('fa fa-transgender-alt' => 'fa fa-transgender-alt'),
				array('fa fa-trash' => 'fa fa-trash'),
				array('fa fa-trash-alt' => 'fa fa-trash-alt'),
				array('fa fa-trash-restore' => 'fa fa-trash-restore'),
				array('fa fa-trash-restore-alt' => 'fa fa-trash-restore-alt'),
				array('fa fa-tree' => 'fa fa-tree'),
				array('fa fa-tripadvisor' => 'fa fa-tripadvisor'),
				array('fa fa-trophy' => 'fa fa-trophy'),
				array('fa fa-truck' => 'fa fa-truck'),
				array('fa fa-truck-loading' => 'fa fa-truck-loading'),
				array('fa fa-truck-monster' => 'fa fa-truck-monster'),
				array('fa fa-truck-moving' => 'fa fa-truck-moving'),
				array('fa fa-truck-pickup' => 'fa fa-truck-pickup'),
				array('fa fa-tshirt' => 'fa fa-tshirt'),
				array('fa fa-tty' => 'fa fa-tty'),
				array('fa fa-tv' => 'fa fa-tv'),
				array('fa fa-ul' => 'fa fa-ul'),
				array('fa fa-umbrella' => 'fa fa-umbrella'),
				array('fa fa-umbrella-beach' => 'fa fa-umbrella-beach'),
				array('fa fa-underline' => 'fa fa-underline'),
				array('fa fa-undo' => 'fa fa-undo'),
				array('fa fa-undo-alt' => 'fa fa-undo-alt'),
				array('fa fa-universal-access' => 'fa fa-universal-access'),
				array('fa fa-university' => 'fa fa-university'),
				array('fa fa-unlink' => 'fa fa-unlink'),
				array('fa fa-unlock' => 'fa fa-unlock'),
				array('fa fa-unlock-alt' => 'fa fa-unlock-alt'),
				array('fa fa-upload' => 'fa fa-upload'),
				array('fa fa-user' => 'fa fa-user'),
				array('fa fa-user-alt' => 'fa fa-user-alt'),
				array('fa fa-user-alt-slash' => 'fa fa-user-alt-slash'),
				array('fa fa-user-astronaut' => 'fa fa-user-astronaut'),
				array('fa fa-user-check' => 'fa fa-user-check'),
				array('fa fa-user-circle' => 'fa fa-user-circle'),
				array('fa fa-user-clock' => 'fa fa-user-clock'),
				array('fa fa-user-cog' => 'fa fa-user-cog'),
				array('fa fa-user-edit' => 'fa fa-user-edit'),
				array('fa fa-user-friends' => 'fa fa-user-friends'),
				array('fa fa-user-graduate' => 'fa fa-user-graduate'),
				array('fa fa-user-injured' => 'fa fa-user-injured'),
				array('fa fa-user-lock' => 'fa fa-user-lock'),
				array('fa fa-user-md' => 'fa fa-user-md'),
				array('fa fa-user-minus' => 'fa fa-user-minus'),
				array('fa fa-user-ninja' => 'fa fa-user-ninja'),
				array('fa fa-user-nurse' => 'fa fa-user-nurse'),
				array('fa fa-user-plus' => 'fa fa-user-plus'),
				array('fa fa-user-secret' => 'fa fa-user-secret'),
				array('fa fa-user-shield' => 'fa fa-user-shield'),
				array('fa fa-user-slash' => 'fa fa-user-slash'),
				array('fa fa-user-tag' => 'fa fa-user-tag'),
				array('fa fa-user-tie' => 'fa fa-user-tie'),
				array('fa fa-user-times' => 'fa fa-user-times'),
				array('fa fa-users' => 'fa fa-users'),
				array('fa fa-users-cog' => 'fa fa-users-cog'),
				array('fa fa-utensil-spoon' => 'fa fa-utensil-spoon'),
				array('fa fa-utensils' => 'fa fa-utensils'),
				array('fa fa-vector-square' => 'fa fa-vector-square'),
				array('fa fa-venus' => 'fa fa-venus'),
				array('fa fa-venus-double' => 'fa fa-venus-double'),
				array('fa fa-venus-mars' => 'fa fa-venus-mars'),
				array('fa fa-vial' => 'fa fa-vial'),
				array('fa fa-vials' => 'fa fa-vials'),
				array('fa fa-video' => 'fa fa-video'),
				array('fa fa-video-slash' => 'fa fa-video-slash'),
				array('fa fa-vihara' => 'fa fa-vihara'),
				array('fa fa-virus' => 'fa fa-virus'),
				array('fa fa-virus-slash' => 'fa fa-virus-slash'),
				array('fa fa-viruses' => 'fa fa-viruses'),
				array('fa fa-voicemail' => 'fa fa-voicemail'),
				array('fa fa-volleyball-ball' => 'fa fa-volleyball-ball'),
				array('fa fa-volume-down' => 'fa fa-volume-down'),
				array('fa fa-volume-mute' => 'fa fa-volume-mute'),
				array('fa fa-volume-off' => 'fa fa-volume-off'),
				array('fa fa-volume-up' => 'fa fa-volume-up'),
				array('fa fa-vote-yea' => 'fa fa-vote-yea'),
				array('fa fa-vr-cardboard' => 'fa fa-vr-cardboard'),
				array('fa fa-walking' => 'fa fa-walking'),
				array('fa fa-wallet' => 'fa fa-wallet'),
				array('fa fa-warehouse' => 'fa fa-warehouse'),
				array('fa fa-water' => 'fa fa-water'),
				array('fa fa-wave-square' => 'fa fa-wave-square'),
				array('fa fa-weight' => 'fa fa-weight'),
				array('fa fa-weight-hanging' => 'fa fa-weight-hanging'),
				array('fa fa-wheelchair' => 'fa fa-wheelchair'),
				array('fa fa-wifi' => 'fa fa-wifi'),
				array('fa fa-wind' => 'fa fa-wind'),
				array('fa fa-window-close' => 'fa fa-window-close'),
				array('fa fa-window-maximize' => 'fa fa-window-maximize'),
				array('fa fa-window-minimize' => 'fa fa-window-minimize'),
				array('fa fa-window-restore' => 'fa fa-window-restore'),
				array('fa fa-wine-bottle' => 'fa fa-wine-bottle'),
				array('fa fa-wine-glass' => 'fa fa-wine-glass'),
				array('fa fa-wine-glass-alt' => 'fa fa-wine-glass-alt'),
				array('fa fa-won-sign' => 'fa fa-won-sign'),
				array('fa fa-wrench' => 'fa fa-wrench'),
				array('fa fa-x-ray' => 'fa fa-x-ray'),
				array('fa fa-xs' => 'fa fa-xs'),
				array('fa fa-yen-sign' => 'fa fa-yen-sign'),
				array('fa fa-yin-yang' => 'fa fa-yin-yang'),
			),

			'FontAwesome 5 Brand' => array(
				array('fab fa-500px' => 'fab fa-500px'),
				array('fab fa-accessible-icon' => 'fab fa-accessible-icon'),
				array('fab fa-accusoft' => 'fab fa-accusoft'),
				array('fab fa-acquisitions-incorporated' => 'fab fa-acquisitions-incorporated'),
				array('fab fa-adn' => 'fab fa-adn'),
				array('fab fa-adobe' => 'fab fa-adobe'),
				array('fab fa-adversal' => 'fab fa-adversal'),
				array('fab fa-affiliatetheme' => 'fab fa-affiliatetheme'),
				array('fab fa-airbnb' => 'fab fa-airbnb'),
				array('fab fa-algolia' => 'fab fa-algolia'),
				array('fab fa-alipay' => 'fab fa-alipay'),
				array('fab fa-amazon' => 'fab fa-amazon'),
				array('fab fa-amazon-pay' => 'fab fa-amazon-pay'),
				array('fab fa-amilia' => 'fab fa-amilia'),
				array('fab fa-android' => 'fab fa-android'),
				array('fab fa-angellist' => 'fab fa-angellist'),
				array('fab fa-angrycreative' => 'fab fa-angrycreative'),
				array('fab fa-angular' => 'fab fa-angular'),
				array('fab fa-app-store' => 'fab fa-app-store'),
				array('fab fa-app-store-ios' => 'fab fa-app-store-ios'),
				array('fab fa-apper' => 'fab fa-apper'),
				array('fab fa-apple' => 'fab fa-apple'),
				array('fab fa-apple-pay' => 'fab fa-apple-pay'),
				array('fab fa-artstation' => 'fab fa-artstation'),
				array('fab fa-asymmetrik' => 'fab fa-asymmetrik'),
				array('fab fa-atlassian' => 'fab fa-atlassian'),
				array('fab fa-audible' => 'fab fa-audible'),
				array('fab fa-autoprefixer' => 'fab fa-autoprefixer'),
				array('fab fa-avianex' => 'fab fa-avianex'),
				array('fab fa-aviato' => 'fab fa-aviato'),
				array('fab fa-aws' => 'fab fa-aws'),
				array('fab fa-bandcamp' => 'fab fa-bandcamp'),
				array('fab fa-battle-net' => 'fab fa-battle-net'),
				array('fab fa-behance' => 'fab fa-behance'),
				array('fab fa-behance-square' => 'fab fa-behance-square'),
				array('fab fa-bimobject' => 'fab fa-bimobject'),
				array('fab fa-bitbucket' => 'fab fa-bitbucket'),
				array('fab fa-bitcoin' => 'fab fa-bitcoin'),
				array('fab fa-bity' => 'fab fa-bity'),
				array('fab fa-black-tie' => 'fab fa-black-tie'),
				array('fab fa-blackberry' => 'fab fa-blackberry'),
				array('fab fa-blogger' => 'fab fa-blogger'),
				array('fab fa-blogger-b' => 'fab fa-blogger-b'),
				array('fab fa-bluetooth' => 'fab fa-bluetooth'),
				array('fab fa-bluetooth-b' => 'fab fa-bluetooth-b'),
				array('fab fa-bootstrap' => 'fab fa-bootstrap'),
				array('fab fa-btc' => 'fab fa-btc'),
				array('fab fa-buffer' => 'fab fa-buffer'),
				array('fab fa-buromobelexperte' => 'fab fa-buromobelexperte'),
				array('fab fa-buy-n-large' => 'fab fa-buy-n-large'),
				array('fab fa-buysellads' => 'fab fa-buysellads'),
				array('fab fa-canadian-maple-leaf' => 'fab fa-canadian-maple-leaf'),
				array('fab fa-cc-amazon-pay' => 'fab fa-cc-amazon-pay'),
				array('fab fa-cc-amex' => 'fab fa-cc-amex'),
				array('fab fa-cc-apple-pay' => 'fab fa-cc-apple-pay'),
				array('fab fa-cc-diners-club' => 'fab fa-cc-diners-club'),
				array('fab fa-cc-discover' => 'fab fa-cc-discover'),
				array('fab fa-cc-jcb' => 'fab fa-cc-jcb'),
				array('fab fa-cc-mastercard' => 'fab fa-cc-mastercard'),
				array('fab fa-cc-paypal' => 'fab fa-cc-paypal'),
				array('fab fa-cc-stripe' => 'fab fa-cc-stripe'),
				array('fab fa-cc-visa' => 'fab fa-cc-visa'),
				array('fab fa-centercode' => 'fab fa-centercode'),
				array('fab fa-centos' => 'fab fa-centos'),
				array('fab fa-chrome' => 'fab fa-chrome'),
				array('fab fa-chromecast' => 'fab fa-chromecast'),
				array('fab fa-cloudscale' => 'fab fa-cloudscale'),
				array('fab fa-cloudsmith' => 'fab fa-cloudsmith'),
				array('fab fa-cloudversify' => 'fab fa-cloudversify'),
				array('fab fa-codepen' => 'fab fa-codepen'),
				array('fab fa-codiepie' => 'fab fa-codiepie'),
				array('fab fa-confluence' => 'fab fa-confluence'),
				array('fab fa-connectdevelop' => 'fab fa-connectdevelop'),
				array('fab fa-contao' => 'fab fa-contao'),
				array('fab fa-cotton-bureau' => 'fab fa-cotton-bureau'),
				array('fab fa-cpanel' => 'fab fa-cpanel'),
				array('fab fa-creative-commons' => 'fab fa-creative-commons'),
				array('fab fa-creative-commons-by' => 'fab fa-creative-commons-by'),
				array('fab fa-creative-commons-nc' => 'fab fa-creative-commons-nc'),
				array('fab fa-creative-commons-nc-eu' => 'fab fa-creative-commons-nc-eu'),
				array('fab fa-creative-commons-nc-jp' => 'fab fa-creative-commons-nc-jp'),
				array('fab fa-creative-commons-nd' => 'fab fa-creative-commons-nd'),
				array('fab fa-creative-commons-pd' => 'fab fa-creative-commons-pd'),
				array('fab fa-creative-commons-pd-alt' => 'fab fa-creative-commons-pd-alt'),
				array('fab fa-creative-commons-remix' => 'fab fa-creative-commons-remix'),
				array('fab fa-creative-commons-sa' => 'fab fa-creative-commons-sa'),
				array('fab fa-creative-commons-sampling' => 'fab fa-creative-commons-sampling'),
				array('fab fa-creative-commons-sampling-plus' => 'fab fa-creative-commons-sampling-plus'),
				array('fab fa-creative-commons-share' => 'fab fa-creative-commons-share'),
				array('fab fa-creative-commons-zero' => 'fab fa-creative-commons-zero'),
				array('fab fa-critical-role' => 'fab fa-critical-role'),
				array('fab fa-css3' => 'fab fa-css3'),
				array('fab fa-css3-alt' => 'fab fa-css3-alt'),
				array('fab fa-cuttlefish' => 'fab fa-cuttlefish'),
				array('fab fa-d-and-d' => 'fab fa-d-and-d'),
				array('fab fa-d-and-d-beyond' => 'fab fa-d-and-d-beyond'),
				array('fab fa-dailymotion' => 'fab fa-dailymotion'),
				array('fab fa-dashcube' => 'fab fa-dashcube'),
				array('fab fa-delicious' => 'fab fa-delicious'),
				array('fab fa-deploydog' => 'fab fa-deploydog'),
				array('fab fa-deskpro' => 'fab fa-deskpro'),
				array('fab fa-dev' => 'fab fa-dev'),
				array('fab fa-deviantart' => 'fab fa-deviantart'),
				array('fab fa-dhl' => 'fab fa-dhl'),
				array('fab fa-diaspora' => 'fab fa-diaspora'),
				array('fab fa-digg' => 'fab fa-digg'),
				array('fab fa-digital-ocean' => 'fab fa-digital-ocean'),
				array('fab fa-discord' => 'fab fa-discord'),
				array('fab fa-discourse' => 'fab fa-discourse'),
				array('fab fa-dochub' => 'fab fa-dochub'),
				array('fab fa-docker' => 'fab fa-docker'),
				array('fab fa-draft2digital' => 'fab fa-draft2digital'),
				array('fab fa-dribbble' => 'fab fa-dribbble'),
				array('fab fa-dribbble-square' => 'fab fa-dribbble-square'),
				array('fab fa-dropbox' => 'fab fa-dropbox'),
				array('fab fa-drupal' => 'fab fa-drupal'),
				array('fab fa-dyalog' => 'fab fa-dyalog'),
				array('fab fa-earlybirds' => 'fab fa-earlybirds'),
				array('fab fa-ebay' => 'fab fa-ebay'),
				array('fab fa-edge' => 'fab fa-edge'),
				array('fab fa-elementor' => 'fab fa-elementor'),
				array('fab fa-ello' => 'fab fa-ello'),
				array('fab fa-ember' => 'fab fa-ember'),
				array('fab fa-empire' => 'fab fa-empire'),
				array('fab fa-envira' => 'fab fa-envira'),
				array('fab fa-erlang' => 'fab fa-erlang'),
				array('fab fa-ethereum' => 'fab fa-ethereum'),
				array('fab fa-etsy' => 'fab fa-etsy'),
				array('fab fa-evernote' => 'fab fa-evernote'),
				array('fab fa-expeditedssl' => 'fab fa-expeditedssl'),
				array('fab fa-facebook' => 'fab fa-facebook'),
				array('fab fa-facebook-f' => 'fab fa-facebook-f'),
				array('fab fa-facebook-messenger' => 'fab fa-facebook-messenger'),
				array('fab fa-facebook-square' => 'fab fa-facebook-square'),
				array('fab fa-fantasy-flight-games' => 'fab fa-fantasy-flight-games'),
				array('fab fa-fedex' => 'fab fa-fedex'),
				array('fab fa-fedora' => 'fab fa-fedora'),
				array('fab fa-figma' => 'fab fa-figma'),
				array('fab fa-firefox' => 'fab fa-firefox'),
				array('fab fa-firefox-browser' => 'fab fa-firefox-browser'),
				array('fab fa-first-order' => 'fab fa-first-order'),
				array('fab fa-first-order-alt' => 'fab fa-first-order-alt'),
				array('fab fa-firstdraft' => 'fab fa-firstdraft'),
				array('fab fa-flickr' => 'fab fa-flickr'),
				array('fab fa-flipboard' => 'fab fa-flipboard'),
				array('fab fa-fly' => 'fab fa-fly'),
				array('fab fa-font-awesome' => 'fab fa-font-awesome'),
				array('fab fa-font-awesome-alt' => 'fab fa-font-awesome-alt'),
				array('fab fa-font-awesome-flag' => 'fab fa-font-awesome-flag'),
				array('fab fa-font-awesome-logo-full' => 'fab fa-font-awesome-logo-full'),
				array('fab fa-fonticons' => 'fab fa-fonticons'),
				array('fab fa-fonticons-fi' => 'fab fa-fonticons-fi'),
				array('fab fa-fort-awesome' => 'fab fa-fort-awesome'),
				array('fab fa-fort-awesome-alt' => 'fab fa-fort-awesome-alt'),
				array('fab fa-forumbee' => 'fab fa-forumbee'),
				array('fab fa-foursquare' => 'fab fa-foursquare'),
				array('fab fa-free-code-camp' => 'fab fa-free-code-camp'),
				array('fab fa-freebsd' => 'fab fa-freebsd'),
				array('fab fa-fulcrum' => 'fab fa-fulcrum'),
				array('fab fa-galactic-republic' => 'fab fa-galactic-republic'),
				array('fab fa-galactic-senate' => 'fab fa-galactic-senate'),
				array('fab fa-get-pocket' => 'fab fa-get-pocket'),
				array('fab fa-gg' => 'fab fa-gg'),
				array('fab fa-gg-circle' => 'fab fa-gg-circle'),
				array('fab fa-git' => 'fab fa-git'),
				array('fab fa-git-alt' => 'fab fa-git-alt'),
				array('fab fa-git-square' => 'fab fa-git-square'),
				array('fab fa-github' => 'fab fa-github'),
				array('fab fa-github-alt' => 'fab fa-github-alt'),
				array('fab fa-github-square' => 'fab fa-github-square'),
				array('fab fa-gitkraken' => 'fab fa-gitkraken'),
				array('fab fa-gitlab' => 'fab fa-gitlab'),
				array('fab fa-gitter' => 'fab fa-gitter'),
				array('fab fa-glide' => 'fab fa-glide'),
				array('fab fa-glide-g' => 'fab fa-glide-g'),
				array('fab fa-gofore' => 'fab fa-gofore'),
				array('fab fa-goodreads' => 'fab fa-goodreads'),
				array('fab fa-goodreads-g' => 'fab fa-goodreads-g'),
				array('fab fa-google' => 'fab fa-google'),
				array('fab fa-google-drive' => 'fab fa-google-drive'),
				array('fab fa-google-play' => 'fab fa-google-play'),
				array('fab fa-google-plus' => 'fab fa-google-plus'),
				array('fab fa-google-plus-g' => 'fab fa-google-plus-g'),
				array('fab fa-google-plus-square' => 'fab fa-google-plus-square'),
				array('fab fa-google-wallet' => 'fab fa-google-wallet'),
				array('fab fa-gratipay' => 'fab fa-gratipay'),
				array('fab fa-grav' => 'fab fa-grav'),
				array('fab fa-gripfire' => 'fab fa-gripfire'),
				array('fab fa-grunt' => 'fab fa-grunt'),
				array('fab fa-gulp' => 'fab fa-gulp'),
				array('fab fa-hacker-news' => 'fab fa-hacker-news'),
				array('fab fa-hacker-news-square' => 'fab fa-hacker-news-square'),
				array('fab fa-hackerrank' => 'fab fa-hackerrank'),
				array('fab fa-hips' => 'fab fa-hips'),
				array('fab fa-hire-a-helper' => 'fab fa-hire-a-helper'),
				array('fab fa-hooli' => 'fab fa-hooli'),
				array('fab fa-hornbill' => 'fab fa-hornbill'),
				array('fab fa-hotjar' => 'fab fa-hotjar'),
				array('fab fa-houzz' => 'fab fa-houzz'),
				array('fab fa-html5' => 'fab fa-html5'),
				array('fab fa-hubspot' => 'fab fa-hubspot'),
				array('fab fa-ideal' => 'fab fa-ideal'),
				array('fab fa-imdb' => 'fab fa-imdb'),
				array('fab fa-instagram' => 'fab fa-instagram'),
				array('fab fa-instagram-square' => 'fab fa-instagram-square'),
				array('fab fa-intercom' => 'fab fa-intercom'),
				array('fab fa-internet-explorer' => 'fab fa-internet-explorer'),
				array('fab fa-invision' => 'fab fa-invision'),
				array('fab fa-ioxhost' => 'fab fa-ioxhost'),
				array('fab fa-itch-io' => 'fab fa-itch-io'),
				array('fab fa-itunes' => 'fab fa-itunes'),
				array('fab fa-itunes-note' => 'fab fa-itunes-note'),
				array('fab fa-java' => 'fab fa-java'),
				array('fab fa-jedi-order' => 'fab fa-jedi-order'),
				array('fab fa-jenkins' => 'fab fa-jenkins'),
				array('fab fa-jira' => 'fab fa-jira'),
				array('fab fa-joget' => 'fab fa-joget'),
				array('fab fa-joomla' => 'fab fa-joomla'),
				array('fab fa-js' => 'fab fa-js'),
				array('fab fa-js-square' => 'fab fa-js-square'),
				array('fab fa-jsfiddle' => 'fab fa-jsfiddle'),
				array('fab fa-kaggle' => 'fab fa-kaggle'),
				array('fab fa-keybase' => 'fab fa-keybase'),
				array('fab fa-keycdn' => 'fab fa-keycdn'),
				array('fab fa-kickstarter' => 'fab fa-kickstarter'),
				array('fab fa-kickstarter-k' => 'fab fa-kickstarter-k'),
				array('fab fa-korvue' => 'fab fa-korvue'),
				array('fab fa-laravel' => 'fab fa-laravel'),
				array('fab fa-lastfm' => 'fab fa-lastfm'),
				array('fab fa-lastfm-square' => 'fab fa-lastfm-square'),
				array('fab fa-leanpub' => 'fab fa-leanpub'),
				array('fab fa-less' => 'fab fa-less'),
				array('fab fa-line' => 'fab fa-line'),
				array('fab fa-linkedin' => 'fab fa-linkedin'),
				array('fab fa-linkedin-in' => 'fab fa-linkedin-in'),
				array('fab fa-linode' => 'fab fa-linode'),
				array('fab fa-linux' => 'fab fa-linux'),
				array('fab fa-lyft' => 'fab fa-lyft'),
				array('fab fa-magento' => 'fab fa-magento'),
				array('fab fa-mailchimp' => 'fab fa-mailchimp'),
				array('fab fa-mandalorian' => 'fab fa-mandalorian'),
				array('fab fa-markdown' => 'fab fa-markdown'),
				array('fab fa-mastodon' => 'fab fa-mastodon'),
				array('fab fa-maxcdn' => 'fab fa-maxcdn'),
				array('fab fa-mdb' => 'fab fa-mdb'),
				array('fab fa-medapps' => 'fab fa-medapps'),
				array('fab fa-medium' => 'fab fa-medium'),
				array('fab fa-medium-m' => 'fab fa-medium-m'),
				array('fab fa-medrt' => 'fab fa-medrt'),
				array('fab fa-meetup' => 'fab fa-meetup'),
				array('fab fa-megaport' => 'fab fa-megaport'),
				array('fab fa-mendeley' => 'fab fa-mendeley'),
				array('fab fa-microblog' => 'fab fa-microblog'),
				array('fab fa-microsoft' => 'fab fa-microsoft'),
				array('fab fa-mix' => 'fab fa-mix'),
				array('fab fa-mixcloud' => 'fab fa-mixcloud'),
				array('fab fa-mixer' => 'fab fa-mixer'),
				array('fab fa-mizuni' => 'fab fa-mizuni'),
				array('fab fa-modx' => 'fab fa-modx'),
				array('fab fa-monero' => 'fab fa-monero'),
				array('fab fa-napster' => 'fab fa-napster'),
				array('fab fa-neos' => 'fab fa-neos'),
				array('fab fa-nimblr' => 'fab fa-nimblr'),
				array('fab fa-node' => 'fab fa-node'),
				array('fab fa-node-js' => 'fab fa-node-js'),
				array('fab fa-npm' => 'fab fa-npm'),
				array('fab fa-ns8' => 'fab fa-ns8'),
				array('fab fa-nutritionix' => 'fab fa-nutritionix'),
				array('fab fa-odnoklassniki' => 'fab fa-odnoklassniki'),
				array('fab fa-odnoklassniki-square' => 'fab fa-odnoklassniki-square'),
				array('fab fa-old-republic' => 'fab fa-old-republic'),
				array('fab fa-opencart' => 'fab fa-opencart'),
				array('fab fa-openid' => 'fab fa-openid'),
				array('fab fa-opera' => 'fab fa-opera'),
				array('fab fa-optin-monster' => 'fab fa-optin-monster'),
				array('fab fa-orcid' => 'fab fa-orcid'),
				array('fab fa-osi' => 'fab fa-osi'),
				array('fab fa-page4' => 'fab fa-page4'),
				array('fab fa-pagelines' => 'fab fa-pagelines'),
				array('fab fa-palfed' => 'fab fa-palfed'),
				array('fab fa-patreon' => 'fab fa-patreon'),
				array('fab fa-paypal' => 'fab fa-paypal'),
				array('fab fa-penny-arcade' => 'fab fa-penny-arcade'),
				array('fab fa-periscope' => 'fab fa-periscope'),
				array('fab fa-phabricator' => 'fab fa-phabricator'),
				array('fab fa-phoenix-framework' => 'fab fa-phoenix-framework'),
				array('fab fa-phoenix-squadron' => 'fab fa-phoenix-squadron'),
				array('fab fa-php' => 'fab fa-php'),
				array('fab fa-pied-piper' => 'fab fa-pied-piper'),
				array('fab fa-pied-piper-alt' => 'fab fa-pied-piper-alt'),
				array('fab fa-pied-piper-hat' => 'fab fa-pied-piper-hat'),
				array('fab fa-pied-piper-pp' => 'fab fa-pied-piper-pp'),
				array('fab fa-pied-piper-square' => 'fab fa-pied-piper-square'),
				array('fab fa-pinterest' => 'fab fa-pinterest'),
				array('fab fa-pinterest-p' => 'fab fa-pinterest-p'),
				array('fab fa-pinterest-square' => 'fab fa-pinterest-square'),
				array('fab fa-playstation' => 'fab fa-playstation'),
				array('fab fa-product-hunt' => 'fab fa-product-hunt'),
				array('fab fa-pushed' => 'fab fa-pushed'),
				array('fab fa-python' => 'fab fa-python'),
				array('fab fa-qq' => 'fab fa-qq'),
				array('fab fa-quinscape' => 'fab fa-quinscape'),
				array('fab fa-quora' => 'fab fa-quora'),
				array('fab fa-r-project' => 'fab fa-r-project'),
				array('fab fa-raspberry-pi' => 'fab fa-raspberry-pi'),
				array('fab fa-ravelry' => 'fab fa-ravelry'),
				array('fab fa-react' => 'fab fa-react'),
				array('fab fa-reacteurope' => 'fab fa-reacteurope'),
				array('fab fa-readme' => 'fab fa-readme'),
				array('fab fa-rebel' => 'fab fa-rebel'),
				array('fab fa-red-river' => 'fab fa-red-river'),
				array('fab fa-reddit' => 'fab fa-reddit'),
				array('fab fa-reddit-alien' => 'fab fa-reddit-alien'),
				array('fab fa-reddit-square' => 'fab fa-reddit-square'),
				array('fab fa-redhat' => 'fab fa-redhat'),
				array('fab fa-renren' => 'fab fa-renren'),
				array('fab fa-replyd' => 'fab fa-replyd'),
				array('fab fa-researchgate' => 'fab fa-researchgate'),
				array('fab fa-resolving' => 'fab fa-resolving'),
				array('fab fa-rev' => 'fab fa-rev'),
				array('fab fa-rocketchat' => 'fab fa-rocketchat'),
				array('fab fa-rockrms' => 'fab fa-rockrms'),
				array('fab fa-safari' => 'fab fa-safari'),
				array('fab fa-salesforce' => 'fab fa-salesforce'),
				array('fab fa-sass' => 'fab fa-sass'),
				array('fab fa-schlix' => 'fab fa-schlix'),
				array('fab fa-scribd' => 'fab fa-scribd'),
				array('fab fa-searchengin' => 'fab fa-searchengin'),
				array('fab fa-sellcast' => 'fab fa-sellcast'),
				array('fab fa-sellsy' => 'fab fa-sellsy'),
				array('fab fa-servicestack' => 'fab fa-servicestack'),
				array('fab fa-shirtsinbulk' => 'fab fa-shirtsinbulk'),
				array('fab fa-shopify' => 'fab fa-shopify'),
				array('fab fa-shopware' => 'fab fa-shopware'),
				array('fab fa-simplybuilt' => 'fab fa-simplybuilt'),
				array('fab fa-sistrix' => 'fab fa-sistrix'),
				array('fab fa-sith' => 'fab fa-sith'),
				array('fab fa-sketch' => 'fab fa-sketch'),
				array('fab fa-skyatlas' => 'fab fa-skyatlas'),
				array('fab fa-skype' => 'fab fa-skype'),
				array('fab fa-slack' => 'fab fa-slack'),
				array('fab fa-slack-hash' => 'fab fa-slack-hash'),
				array('fab fa-slideshare' => 'fab fa-slideshare'),
				array('fab fa-snapchat' => 'fab fa-snapchat'),
				array('fab fa-snapchat-ghost' => 'fab fa-snapchat-ghost'),
				array('fab fa-snapchat-square' => 'fab fa-snapchat-square'),
				array('fab fa-soundcloud' => 'fab fa-soundcloud'),
				array('fab fa-sourcetree' => 'fab fa-sourcetree'),
				array('fab fa-speakap' => 'fab fa-speakap'),
				array('fab fa-speaker-deck' => 'fab fa-speaker-deck'),
				array('fab fa-spotify' => 'fab fa-spotify'),
				array('fab fa-squarespace' => 'fab fa-squarespace'),
				array('fab fa-stack-exchange' => 'fab fa-stack-exchange'),
				array('fab fa-stack-overflow' => 'fab fa-stack-overflow'),
				array('fab fa-stackpath' => 'fab fa-stackpath'),
				array('fab fa-staylinked' => 'fab fa-staylinked'),
				array('fab fa-steam' => 'fab fa-steam'),
				array('fab fa-steam-square' => 'fab fa-steam-square'),
				array('fab fa-steam-symbol' => 'fab fa-steam-symbol'),
				array('fab fa-sticker-mule' => 'fab fa-sticker-mule'),
				array('fab fa-strava' => 'fab fa-strava'),
				array('fab fa-stripe' => 'fab fa-stripe'),
				array('fab fa-stripe-s' => 'fab fa-stripe-s'),
				array('fab fa-studiovinari' => 'fab fa-studiovinari'),
				array('fab fa-stumbleupon' => 'fab fa-stumbleupon'),
				array('fab fa-stumbleupon-circle' => 'fab fa-stumbleupon-circle'),
				array('fab fa-superpowers' => 'fab fa-superpowers'),
				array('fab fa-supple' => 'fab fa-supple'),
				array('fab fa-suse' => 'fab fa-suse'),
				array('fab fa-swift' => 'fab fa-swift'),
				array('fab fa-symfony' => 'fab fa-symfony'),
				array('fab fa-teamspeak' => 'fab fa-teamspeak'),
				array('fab fa-telegram' => 'fab fa-telegram'),
				array('fab fa-telegram-plane' => 'fab fa-telegram-plane'),
				array('fab fa-tencent-weibo' => 'fab fa-tencent-weibo'),
				array('fab fa-the-red-yeti' => 'fab fa-the-red-yeti'),
				array('fab fa-themeco' => 'fab fa-themeco'),
				array('fab fa-themeisle' => 'fab fa-themeisle'),
				array('fab fa-think-peaks' => 'fab fa-think-peaks'),
				array('fab fa-trade-federation' => 'fab fa-trade-federation'),
				array('fab fa-trello' => 'fab fa-trello'),
				array('fab fa-tumblr' => 'fab fa-tumblr'),
				array('fab fa-tumblr-square' => 'fab fa-tumblr-square'),
				array('fab fa-twitch' => 'fab fa-twitch'),
				array('fab fa-twitter' => 'fab fa-twitter'),
				array('fab fa-twitter-square' => 'fab fa-twitter-square'),
				array('fab fa-typo3' => 'fab fa-typo3'),
				array('fab fa-uber' => 'fab fa-uber'),
				array('fab fa-ubuntu' => 'fab fa-ubuntu'),
				array('fab fa-uikit' => 'fab fa-uikit'),
				array('fab fa-umbraco' => 'fab fa-umbraco'),
				array('fab fa-uniregistry' => 'fab fa-uniregistry'),
				array('fab fa-unity' => 'fab fa-unity'),
				array('fab fa-untappd' => 'fab fa-untappd'),
				array('fab fa-ups' => 'fab fa-ups'),
				array('fab fa-usb' => 'fab fa-usb'),
				array('fab fa-usps' => 'fab fa-usps'),
				array('fab fa-ussunnah' => 'fab fa-ussunnah'),
				array('fab fa-vaadin' => 'fab fa-vaadin'),
				array('fab fa-viacoin' => 'fab fa-viacoin'),
				array('fab fa-viadeo' => 'fab fa-viadeo'),
				array('fab fa-viadeo-square' => 'fab fa-viadeo-square'),
				array('fab fa-viber' => 'fab fa-viber'),
				array('fab fa-vimeo' => 'fab fa-vimeo'),
				array('fab fa-vimeo-square' => 'fab fa-vimeo-square'),
				array('fab fa-vimeo-v' => 'fab fa-vimeo-v'),
				array('fab fa-vine' => 'fab fa-vine'),
				array('fab fa-vk' => 'fab fa-vk'),
				array('fab fa-vnv' => 'fab fa-vnv'),
				array('fab fa-vuejs' => 'fab fa-vuejs'),
				array('fab fa-waze' => 'fab fa-waze'),
				array('fab fa-weebly' => 'fab fa-weebly'),
				array('fab fa-weibo' => 'fab fa-weibo'),
				array('fab fa-weixin' => 'fab fa-weixin'),
				array('fab fa-whatsapp' => 'fab fa-whatsapp'),
				array('fab fa-whatsapp-square' => 'fab fa-whatsapp-square'),
				array('fab fa-whmcs' => 'fab fa-whmcs'),
				array('fab fa-wikipedia-w' => 'fab fa-wikipedia-w'),
				array('fab fa-windows' => 'fab fa-windows'),
				array('fab fa-wix' => 'fab fa-wix'),
				array('fab fa-wizards-of-the-coast' => 'fab fa-wizards-of-the-coast'),
				array('fab fa-wolf-pack-battalion' => 'fab fa-wolf-pack-battalion'),
				array('fab fa-wordpress' => 'fab fa-wordpress'),
				array('fab fa-wordpress-simple' => 'fab fa-wordpress-simple'),
				array('fab fa-wpbeginner' => 'fab fa-wpbeginner'),
				array('fab fa-wpexplorer' => 'fab fa-wpexplorer'),
				array('fab fa-wpforms' => 'fab fa-wpforms'),
				array('fab fa-wpressr' => 'fab fa-wpressr'),
				array('fab fa-xbox' => 'fab fa-xbox'),
				array('fab fa-xing' => 'fab fa-xing'),
				array('fab fa-xing-square' => 'fab fa-xing-square'),
				array('fab fa-y-combinator' => 'fab fa-y-combinator'),
				array('fab fa-yahoo' => 'fab fa-yahoo'),
				array('fab fa-yammer' => 'fab fa-yammer'),
				array('fab fa-yandex' => 'fab fa-yandex'),
				array('fab fa-yandex-international' => 'fab fa-yandex-international'),
				array('fab fa-yarn' => 'fab fa-yarn'),
				array('fab fa-yelp' => 'fab fa-yelp'),
				array('fab fa-yoast' => 'fab fa-yoast'),
				array('fab fa-youtube' => 'fab fa-youtube'),
				array('fab fa-youtube-square' => 'fab fa-youtube-square'),
				array('fab fa-zhihu' => 'fab fa-zhihu'),
			),
		);

		$icons = apply_filters("mascot_mega_menu/get_icons", $icons);

		return $icons;
	}

}
}


