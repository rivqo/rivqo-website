<?php
namespace MASCOTCOREAMISO\CPT\Staff;

use MASCOTCOREAMISO\Lib;

/**
 * Singleton class
 * class CPT_Staff
 * @package MASCOTCOREAMISO\CPT\Staff;
 */
final class CPT_Staff implements Lib\Mascot_Core_Amiso_Interface_PostType {

	/**
	 * @var string
	 */
	public 	$ptKey;
	public 	$ptKeyRewriteBase;
	public  $ptTaxKey;
	public  $ptTaxKeyRewriteBase;
	public  $social_list;
	private $ptMenuIcon;
	private $ptSingularName;
	private $ptPluralName;

	/**
	 * Call this method to get singleton
	 *
	 * @return CPT_Staff
	 */
	public static function Instance() {
		static $inst = null;
		if ($inst === null) {
			$inst = new CPT_Staff();
		}
		return $inst;
	}

	/**
	 * Private ctor so nobody else can instance it
	 *
	 */
	private function __construct() {
		$this->ptSingularName = esc_html__( 'Staff Item', 'mascot-core-amiso' );
		$this->ptPluralName = esc_html__( 'Staff', 'mascot-core-amiso' );
		$this->ptKey = 'staff-items';
		$this->ptKeyRewriteBase = $this->ptKey;
		$this->ptTaxKey = 'staff_category';
		$this->ptTaxKeyRewriteBase = str_replace( '_', '-', $this->ptTaxKey );
		$this->ptMenuIcon = 'dashicons-id';
		$this->social_list = $this->socialList();
		add_filter( 'manage_edit-'.$this->ptKey.'_columns', array($this, 'customColumnsSettings') ) ;
		add_filter( 'manage_'.$this->ptKey.'_posts_custom_column', array($this, 'customColumnsContent') ) ;
		add_filter( 'rwmb_meta_boxes', array($this, 'regMetaBoxes') ) ;
	}

	/**
	 * @return string
	 */
	public function getPTKey() {
		return $this->ptKey;
	}

	/**
	 * @return string
	 */
	public function getPTTaxKey() {
		return $this->ptTaxKey;
	}

	/**
	 * registers custom post type & Tax
	 */
	public function register() {
		if ( class_exists( 'ReduxFramework' ) ) {
			if( ! mascot_core_amiso_get_redux_option( 'cpt-settings-staff-enable', true ) ) {
				return;
			}
		}

		$this->ptPluralName = mascot_core_amiso_get_redux_option( 'cpt-settings-staff-label', esc_html__( 'Staff', 'mascot-core-amiso' ) );
		$this->ptMenuIcon = mascot_core_amiso_get_redux_option( 'cpt-settings-staff-admin-dashicon', $this->ptMenuIcon );
		$this->ptKeyRewriteBase = mascot_core_amiso_get_redux_option( 'cpt-settings-staff-slug', $this->ptKeyRewriteBase );
		$this->ptTaxKeyRewriteBase = mascot_core_amiso_get_redux_option( 'cpt-settings-staff-cat-slug', $this->ptKeyRewriteBase );

		$this->registerCustomPostType();
		$this->registerCustomTax();
	}

	/**
	 * Regsiters custom post type
	 */
	private function registerCustomPostType() {

		$labels = array(
			'name'					=> $this->ptPluralName,
			'singular_name'			=> $this->ptPluralName . ' ' . esc_html__( 'Item', 'mascot-core-amiso' ),
			'menu_name'				=> $this->ptPluralName,
			'name_admin_bar'		=> $this->ptPluralName,
			'archives'				=> esc_html__( 'Item Archives', 'mascot-core-amiso' ),
			'attributes'			=> esc_html__( 'Item Attributes', 'mascot-core-amiso' ),
			'parent_item_colon'		=> esc_html__( 'Parent Item:', 'mascot-core-amiso' ),
			'all_items'				=> esc_html__( 'All Items', 'mascot-core-amiso' ),
			'add_new_item'			=> esc_html__( 'Add New Item', 'mascot-core-amiso' ),
			'add_new'				=> esc_html__( 'Add New', 'mascot-core-amiso' ),
			'new_item'				=> esc_html__( 'New Item', 'mascot-core-amiso' ),
			'edit_item'				=> esc_html__( 'Edit Item', 'mascot-core-amiso' ),
			'update_item'			=> esc_html__( 'Update Item', 'mascot-core-amiso' ),
			'view_item'				=> esc_html__( 'View Item', 'mascot-core-amiso' ),
			'view_items'			=> esc_html__( 'View Items', 'mascot-core-amiso' ),
			'search_items'			=> esc_html__( 'Search Item', 'mascot-core-amiso' ),
			'not_found'				=> esc_html__( 'Not found', 'mascot-core-amiso' ),
			'not_found_in_trash'	=> esc_html__( 'Not found in Trash', 'mascot-core-amiso' ),
			'featured_image'		=> esc_html__( 'Featured Image', 'mascot-core-amiso' ),
			'set_featured_image'	=> esc_html__( 'Set featured image', 'mascot-core-amiso' ),
			'remove_featured_image'	=> esc_html__( 'Remove featured image', 'mascot-core-amiso' ),
			'use_featured_image'	=> esc_html__( 'Use as featured image', 'mascot-core-amiso' ),
			'insert_into_item'		=> esc_html__( 'Insert into item', 'mascot-core-amiso' ),
			'uploaded_to_this_item'	=> esc_html__( 'Uploaded to this item', 'mascot-core-amiso' ),
			'items_list'			=> esc_html__( 'Items list', 'mascot-core-amiso' ),
			'items_list_navigation'	=> esc_html__( 'Items list navigation', 'mascot-core-amiso' ),
			'filter_items_list'		=> esc_html__( 'Filter items list', 'mascot-core-amiso' ),
		);

		$args = array(
			'label'						=> $this->ptSingularName,
			'description'				=> esc_html__( 'Post Type Description', 'mascot-core-amiso' ),
			'labels'					=> $labels,
			'supports'					=> array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
			'taxonomies'				=> array( $this->ptTaxKey ),
			'hierarchical'				=> false,
			'public'					=> true,
			'show_ui'					=> true,
			'show_in_menu'				=> true,
			'menu_position'				=> 30,
			'menu_icon'					=> $this->ptMenuIcon,
			'show_in_admin_bar'			=> true,
			'show_in_nav_menus'			=> true,
			'can_export'				=> true,
			'has_archive'				=> false,
			'exclude_from_search'		=> false,
			'publicly_queryable'		=> true,
			'capability_type'			=> 'page',
			'rewrite'					=> array( 'slug' => $this->ptKeyRewriteBase, 'with_front' => false ),
		);
		register_post_type( $this->ptKey, $args );

	}

	/**
	 * Regsiters custom Taxonomy
	 */
	private function registerCustomTax() {

		$labels = array(
			'name'						=> _x( 'Staff Categories', 'Taxonomy General Name', 'mascot-core-amiso' ),
			'singular_name'				=> _x( 'Staff Category', 'Taxonomy Singular Name', 'mascot-core-amiso' ),
			'menu_name'					=> $this->ptPluralName . esc_html__( ' Categories', 'mascot-core-amiso' ),
			'all_items'					=> esc_html__( 'All ', 'mascot-core-amiso' ) . $this->ptSingularName . esc_html__( ' Categories', 'mascot-core-amiso' ),
			'parent_item'				=> esc_html__( 'Parent Item', 'mascot-core-amiso' ),
			'parent_item_colon'			=> esc_html__( 'Parent Item:', 'mascot-core-amiso' ),
			'new_item_name'				=> esc_html__( 'New ', 'mascot-core-amiso' ) . $this->ptSingularName . esc_html__( ' Category', 'mascot-core-amiso' ),
			'add_new_item'				=> esc_html__( 'Add ', 'mascot-core-amiso' ) . $this->ptSingularName . esc_html__( ' Category', 'mascot-core-amiso' ),
			'edit_item'					=> esc_html__( 'Edit ', 'mascot-core-amiso' ) . $this->ptSingularName . esc_html__( ' Category', 'mascot-core-amiso' ),
			'update_item'				=> esc_html__( 'Update ', 'mascot-core-amiso' ) . $this->ptSingularName . esc_html__( ' Category', 'mascot-core-amiso' ),
			'view_item'					=> esc_html__( 'View ', 'mascot-core-amiso' ) . $this->ptSingularName . esc_html__( ' Category', 'mascot-core-amiso' ),
			'separate_items_with_commas'=> esc_html__( 'Separate items with commas', 'mascot-core-amiso' ),
			'add_or_remove_items'		=> esc_html__( 'Add or remove items', 'mascot-core-amiso' ),
			'choose_from_most_used'		=> esc_html__( 'Choose from the most used', 'mascot-core-amiso' ),
			'popular_items'				=> esc_html__( 'Popular Items', 'mascot-core-amiso' ),
			'search_items'				=> esc_html__( 'Search Items', 'mascot-core-amiso' ),
			'not_found'					=> esc_html__( 'Not Found', 'mascot-core-amiso' ),
			'no_terms'					=> esc_html__( 'No items', 'mascot-core-amiso' ),
			'items_list'				=> esc_html__( 'Items list', 'mascot-core-amiso' ),
			'items_list_navigation'		=> esc_html__( 'Items list navigation', 'mascot-core-amiso' ),
		);
		$args = array(
			'labels'					=> $labels,
			'hierarchical'				=> true,
			'public'					=> true,
			'show_ui'					=> true,
			'show_admin_column'			=> true,
			'show_in_nav_menus'			=> true,
			'show_tagcloud'				=> true,
			'rewrite'					=> array( 'slug' => $this->ptTaxKeyRewriteBase, 'with_front' => false ),
		);
		register_taxonomy( $this->ptTaxKey, array( $this->ptKey ), $args );
	}

	/**
	 * Custom Columns Settings
	 */
	public function customColumnsSettings( $columns ) {

		$columns = array(
			'cb'			=> '<input type="checkbox" />',
			'title'			=> esc_html__( 'Title', 'mascot-core-amiso' ),
			'thumbnail'		=> esc_html__( 'Thumbnail', 'mascot-core-amiso' ),
			'category'		=> esc_html__( 'Category', 'mascot-core-amiso' ),
			'date'			=> esc_html__( 'Date', 'mascot-core-amiso' ),
		);
		return $columns;
	}

	/**
	 * Custom Columns Content
	 */
	public function customColumnsContent( $columns ) {
		global $post;
		switch( $columns ) {
			case 'category' :
				$post_terms = array();
				$taxonomy 	= $this->ptTaxKey;
				$post_type 	= get_post_type( $post->ID );
				$terms 		= get_the_terms( $post->ID, $taxonomy );

				if ( ! empty( $terms ) ) {
					foreach ( $terms as $term ) {
						$post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, $taxonomy, 'edit' ) ) . "</a>";
					}
					echo join( ', ', $post_terms );
				}
				else echo '<i>No categories.</i>';
			break;

			case 'thumbnail' :
				echo get_the_post_thumbnail( $post->ID, array( 64, 64 ) );
			break;

			default :
			break;
		}
	}

	/**
	 * socialList
	 */
	public function socialList() {
		$social_list = array(
			'dribbble'  => esc_html__( 'Dribble', 'mascot-core-amiso' ),
			'facebook'  => esc_html__( 'Facebook', 'mascot-core-amiso' ),
			'flickr'  => esc_html__( 'Flickr', 'mascot-core-amiso' ),
			'instagram'  => esc_html__( 'Instagram', 'mascot-core-amiso' ),

			'linkedin'  => esc_html__( 'Linkedin', 'mascot-core-amiso' ),
			'pinterest'  => esc_html__( 'Pinterest', 'mascot-core-amiso' ),
			'rss'  => esc_html__( 'RSS', 'mascot-core-amiso' ),
			'skype'  => esc_html__( 'Skype', 'mascot-core-amiso' ),
			'tumblr'  => esc_html__( 'Tumblr', 'mascot-core-amiso' ),

			'twitter'  => esc_html__( 'Twitter', 'mascot-core-amiso' ),
			'vimeo-square'  => esc_html__( 'Vimeo', 'mascot-core-amiso' ),
			'vine'  => esc_html__( 'Vine', 'mascot-core-amiso' ),
			'wordpress'  => esc_html__( 'Wordpress', 'mascot-core-amiso' ),
			'youtube'  => esc_html__( 'Youtube', 'mascot-core-amiso' ),
		);
		return $social_list;
	}

	/**
	 * Registers Meta Boxes
	 */
	public function regMetaBoxes( $meta_boxes ) {
		//social list array
		$social_list_array = array();
		foreach ($this->social_list as $key => $value) {
			# code...
			if( $key == 'facebook' ) {
				$social_list_array[] = array(
					'id'	=> 'staff_social_'.$key,
					'name'		=> $value,
					'desc'	=> esc_html__( 'Example: https://www.facebook.com/envato/', 'mascot-core-amiso' ),
					'type'	=> 'text',
				);

			} else {
				$social_list_array[] = array(
					'id'	=> 'staff_social_'.$key,
					'name'		=> $value,
					'type'	=> 'text',
				);
			}
		}


		// Meta Box Settings for this Page
		$meta_boxes[] = array(
			'id'		 => 'staff_meta_box',
			'title'	  => esc_html__( 'Staff Meta Box', 'mascot-core-amiso' ),
			'post_types' => $this->ptKey,
			'priority'   => 'high',

			// List of tabs, in one of the following formats:
			// 1) key => label
			// 2) key => array( 'label' => Tab label, 'icon' => Tab icon )
			'tabs'	  => array(
				'general-info' => array(
					'label' => esc_html__( 'General Info', 'mascot-core-amiso' ),
					'icon'  => 'dashicons-clipboard', // Dashicon
				),
				'contact-info' => array(
					'label' => esc_html__( 'Contact Info', 'mascot-core-amiso' ),
					'icon'  => 'dashicons-phone', // Dashicon
				),
				'working-hours' => array(
					'label' => esc_html__( 'Working Hours', 'mascot-core-amiso' ),
					'icon'  => 'dashicons-clock', // Dashicon
				),
				'social-info' => array(
					'label' => esc_html__( 'Social Info', 'mascot-core-amiso' ),
					'icon'  => 'dashicons-twitter', // Dashicon
				),
			),

			// Tab style: 'default', 'box' or 'left'. Optional
			'tab_style' => 'left',

			// Show meta box wrapper around tabs? true (default) or false. Optional
			'tab_wrapper' => true,

			'fields'	 => array(
				array(
					'id'     => 'amiso_' . 'staff_mb_general_info',
					// Group field
					'type'   => 'group',
					// Clone whole group?
					'clone'  => false,
					// Drag and drop clones to reorder them?
					'sort_clone' => false,
					// tab
					'tab'  => 'general-info',
					// Sub-fields
					'fields' => array(
						array(
							'id'	=> 'staff_speciality',
							'name'	=> esc_html__( 'Speciality', 'mascot-core-amiso' ),
							'type'	=> 'wysiwyg',
							'options' => array(
								'media_buttons' => false,
								'textarea_rows' => '4',
							),
						),
						array(
							'id'	=> 'staff_short_bio',
							'name'	=> esc_html__( 'Short Bio:', 'mascot-core-amiso' ),
							'type'	=> 'wysiwyg',
							'options' => array(
								'media_buttons' => false,
								'textarea_rows' => '4',
							),
						),
					),
				),
				array(
					'id'     => 'amiso_' . 'staff_mb_contact_info',
					// Group field
					'type'   => 'group',
					// Clone whole group?
					'clone'  => false,
					// Drag and drop clones to reorder them?
					'sort_clone' => false,
					// tab
					'tab'  => 'contact-info',
					// Sub-fields
					'fields' => array(
						array(
							'id'	=> 'staff_address',
							'name'	=> esc_html__( 'Address:', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						array(
							'id'	=> 'staff_phone',
							'name'	=> esc_html__( 'Phone:', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						array(
							'id'	=> 'staff_fax',
							'name'	=> esc_html__( 'Fax:', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						array(
							'id'	=> 'staff_email',
							'name'	=> esc_html__( 'Email:', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						array(
							'id'	=> 'staff_appointment_btn_text',
							'name'	=> esc_html__( 'Appointment Button Text:', 'mascot-core-amiso' ),
							'std'	=> esc_html__( 'Request an Appointment', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						array(
							'id'	=> 'staff_appointment_btn_url',
							'name'	=> esc_html__( 'Appointment Button URL:', 'mascot-core-amiso' ),
							'std'	=> esc_html__( '#', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						array(
							'name'		=> esc_html__( 'Open Link in New Window?', 'mascot-core-amiso' ),
							'id'		=> 'staff_appointment_btn_url_new_window',
							'type'		=> 'checkbox',
						),
					),
				),
				array(
					'id'     => 'amiso_' . 'staff_mb_working_hours',
					// Group field
					'type'   => 'group',
					// Clone whole group?
					'clone'  => false,
					// Drag and drop clones to reorder them?
					'sort_clone' => false,
					// tab
					'tab'  => 'working-hours',
					// Sub-fields
					'fields' => array(
						//opening hours
						//Day 1
						array(
							'id'	=> 'staff_opening_hours_day_1',
							'name'	=> esc_html__( 'Day 1:', 'mascot-core-amiso' ),
							'std'	=> esc_html__( 'Monday - Friday', 'mascot-core-amiso' ),
							'desc'  => esc_html__( 'Example: Monday - Friday', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						array(
							'id'	=> 'staff_opening_hours_day_1_time',
							'name'	=> esc_html__( 'Time for Day 1:', 'mascot-core-amiso' ),
							'std'	=> esc_html__( '8.00 - 17.00', 'mascot-core-amiso' ),
							'desc'  => esc_html__( 'Example: 8.00 - 17.00', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						//Day 2
						array(
							'id'	=> 'staff_opening_hours_day_2',
							'name'	=> esc_html__( 'Day 2:', 'mascot-core-amiso' ),
							'std'	=> esc_html__( 'Saturday', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						array(
							'id'	=> 'staff_opening_hours_day_2_time',
							'name'	=> esc_html__( 'Time for Day 2:', 'mascot-core-amiso' ),
							'std'	=> esc_html__( '9.00 - 16.00', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						//Day 3
						array(
							'id'	=> 'staff_opening_hours_day_3',
							'name'	=> esc_html__( 'Day 3:', 'mascot-core-amiso' ),
							'std'	=> esc_html__( 'Friday', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						array(
							'id'	=> 'staff_opening_hours_day_3_time',
							'name'	=> esc_html__( 'Time for Day 3:', 'mascot-core-amiso' ),
							'std'	=> esc_html__( '9.30 - 14.00', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						//Day 4
						array(
							'id'	=> 'staff_opening_hours_day_4',
							'name'	=> esc_html__( 'Day 4:', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						array(
							'id'	=> 'staff_opening_hours_day_4_time',
							'name'	=> esc_html__( 'Time for Day 4:', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						//Day 5
						array(
							'id'	=> 'staff_opening_hours_day_5',
							'name'	=> esc_html__( 'Day 5:', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						array(
							'id'	=> 'staff_opening_hours_day_5_time',
							'name'	=> esc_html__( 'Time for Day 5:', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						//Day 6
						array(
							'id'	=> 'staff_opening_hours_day_6',
							'name'	=> esc_html__( 'Day 6:', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						array(
							'id'	=> 'staff_opening_hours_day_6_time',
							'name'	=> esc_html__( 'Time for Day 6:', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						//Day 7
						array(
							'id'	=> 'staff_opening_hours_day_7',
							'name'	=> esc_html__( 'Day 7:', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
						array(
							'id'	=> 'staff_opening_hours_day_7_time',
							'name'	=> esc_html__( 'Time for Day 7:', 'mascot-core-amiso' ),
							'type'	=> 'text',
						),
					),
				),
				array(
					'id'     => 'amiso_' . 'staff_mb_social_info',
					// Group field
					'type'   => 'group',
					// Clone whole group?
					'clone'  => false,
					// Drag and drop clones to reorder them?
					'sort_clone' => false,
					// tab
					'tab'  => 'social-info',
					// Sub-fields
					'fields' => $social_list_array
				),
			)
		);

		return $meta_boxes;
	}

}
