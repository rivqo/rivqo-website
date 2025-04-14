<a href="#" class="top-nav-search-btn" data-target="<?php echo esc_attr($holder_id)?>"><i class="search-icon <?php echo mascot_core_get_redux_option( 'header-settings-navigation-menu-search-icon-code', 'fa fa-search' ); ?>"></i></a>
<?php 
    global $nav_search_holder_id;
    $nav_search_holder_id[] = $holder_id;
 ?>