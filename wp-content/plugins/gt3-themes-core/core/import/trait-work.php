<?php

namespace GT3\ThemesCore\Import;

use Elementor\Plugin as Elementor_Plugin;

trait Work_Trait {
	
	public function _tick_import(){
		
		switch($this->current_step) {
			case self::STEP_TERMS:
				$this->import_theme_options();
				$this->process_terms();
				
				$this->current_step  = self::STEP_ATTACHMENTS;
				$this->current_index = 0;
				$this->next_step();
				break;
			
			case self::STEP_ATTACHMENTS:
				$this->process_attachments();
				
				if($this->current_index >= $this->get_max_index()) {
					$this->current_step  = self::STEP_POSTS;
					$this->current_index = 0;
					$this->next_step();
				}
				break;
			
			case self::STEP_POSTS:
				
				$this->process_posts();
				
				if($this->current_index >= $this->get_max_index()) {
					$this->current_step  = self::STEP_MENUS;
					$this->current_index = 0;
					$this->next_step();
				}
				break;
			
			case self::STEP_MENUS:
				
				$this->process_menus();
				
				if($this->current_index >= $this->get_max_index()) {
					$this->current_step  = self::STEP_FINISH;
					$this->current_index = 0;
					$this->next_step();
				}
				break;
			
			case self::STEP_FINISH:
				$this->backfill_parents();
				
				$this->backfill_attachment_urls();
				
				$this->remap_featured_images();
				
				$this->import_widgets();
				
				$this->import_settings();
				
				if(class_exists('RevSlider') && count($this->rev_sliders)) {
					$this->process_rev_sliders();
				}
				
				wp_cache_flush();
				foreach(get_taxonomies() as $tax) {
					delete_option("{$tax}_children");
					_get_term_hierarchy($tax);
				}
				
				wp_defer_term_counting(false);
				wp_defer_comment_counting(false);
				
				do_action('gt3/core/import/finish');
				
				$this->active = false;
				flush_rewrite_rules(true);
				
				$woo_import_url = '';
				if(class_exists('WooCommerce')) {
					$woo_import_url = wp_normalize_path(stream_resolve_include_path($this->folder.'gt3-wc-products.csv'));
					if($woo_import_url) {
						$params         = array(
							'post_type'       => 'product',
							'page'            => 'product_importer',
							'step'            => 'mapping',
							'file'            => $woo_import_url,
							'delimiter'       => ',',
							'update_existing' => 0,
							'_wpnonce'        => wp_create_nonce('woocommerce-csv-importer'), // wp_nonce_url() escapes & to &amp; breaking redirects.
						);
						$woo_import_url = add_query_arg($params, admin_url('edit.php'));
					}
				}
				
				$this->emit_sse_message(array(
					'links' => array(
						'site_url'       => get_site_url(),
						'woo_import_url' => $woo_import_url,
						'customizer_url' => wp_customize_url(),
						'dashboard_url'  => add_query_arg(array( 'page' => 'gt3_dashboard' ), admin_url('admin.php')),
					)
				));
				
				$this->next_step();
				break;
		}
		
		$this->_tick_import();
	}
}