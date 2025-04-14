<?php
namespace MASCOTCOREAMISO\CPT\Projects;

use MASCOTCOREAMISO\Lib;

/**
 * Singleton class
 * class CPT_Projects
 * @package MASCOTCOREAMISO\CPT\Projects;
 */
final class CPT_Projects implements Lib\Mascot_Core_Amiso_Interface_PostType {

	/**
	 * @var string
	 */
	public  $ptKey;
	public 	$ptKeyRewriteBase;
	public  $ptTaxKey;
	public  $ptTaxKeyRewriteBase;
	private $ptMenuIcon;
	private $ptSingularName;
	private $ptPluralName;

	/**
	 * Call this method to get singleton
	 *
	 * @return CPT_Projects
	 */
	public static function Instance() {
		static $inst = null;
		if ($inst === null) {
			$inst = new CPT_Projects();
		}
		return $inst;
	}

	/**
	 * Private ctor so nobody else can instance it
	 *
	 */
	private function __construct() {
		$this->ptSingularName = esc_html__( 'Projects Item', 'mascot-core-amiso' );
		$this->ptPluralName = esc_html__( 'Projects', 'mascot-core-amiso' );
		$this->ptKey = 'projects';
		$this->ptKeyRewriteBase = $this->ptKey;
		$this->ptTaxKey = 'projects_category';
		$this->ptTaxKeyRewriteBase = str_replace( '_', '-', $this->ptTaxKey );
		$this->ptMenuIcon = 'dashicons-portfolio';
		add_filter( 'manage_edit-'.$this->ptKey.'_columns', array($this, 'customColumnsSettings') ) ;
		add_filter( 'manage_'.$this->ptKey.'_posts_custom_column', array($this, 'customColumnsContent') ) ;
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
			if( ! mascot_core_amiso_get_redux_option( 'cpt-settings-projects-enable', true ) ) {
				return;
			}
		}

		$this->ptPluralName = mascot_core_amiso_get_redux_option( 'cpt-settings-projects-label', esc_html__( 'Projects', 'mascot-core-amiso' ) );
		$this->ptMenuIcon = mascot_core_amiso_get_redux_option( 'cpt-settings-projects-admin-dashicon', $this->ptMenuIcon );
		$this->ptKeyRewriteBase = mascot_core_amiso_get_redux_option( 'cpt-settings-projects-slug', $this->ptKeyRewriteBase );
		$this->ptTaxKeyRewriteBase = mascot_core_amiso_get_redux_option( 'cpt-settings-projects-cat-slug', $this->ptKeyRewriteBase );

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
			'supports'					=> array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' ),
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
			'name'						=> _x( 'Projects Categories', 'Taxonomy General Name', 'mascot-core-amiso' ),
			'singular_name'				=> _x( 'Project Category', 'Taxonomy Singular Name', 'mascot-core-amiso' ),
			'menu_name'					=> $this->ptSingularName . esc_html__( ' Categories', 'mascot-core-amiso' ),
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
	 * Registers Meta Boxes
	 */
	public function regMetaBoxes( $meta_boxes ) {

	}

}