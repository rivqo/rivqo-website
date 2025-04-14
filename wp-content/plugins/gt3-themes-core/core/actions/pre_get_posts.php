<?php

defined('ABSPATH') or exit;

add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_search()) {
        //////////////////////////////////////
        // category terms search.
        if (!$query->is_main_query()) return $query;

        $post_type = $query->get('post_type', array());
        if (is_string($post_type)) {
            $post_type = array($post_type);
        }

        $_post_types = gt3_option('search_post_types');
        if (is_string($_post_types)) {
            $__pt = json_decode($_post_types, true);
            $_post_types = json_last_error() ? array() : $__pt;
        }

        if (is_array($_post_types)) {
            $query->set('post_type', $_post_types);
        }
    }

    return $query;
});
