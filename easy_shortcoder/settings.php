<?php

    function easy_shortcoder() {
		add_menu_page('Wyglad wtyczki - strona glowna', 'Easy shortcoder', 'administrator', 'easy_shortcoder_main', 'easy_shortcoder_main', 'dashicons-welcome-write-blog');
    }
    add_action('admin_menu', 'easy_shortcoder');
    
    function easy_shortcoder_create_func( $atts ) {
        global $wpdb;
        $tab_name = $wpdb->prefix . "easy_shortcoder";
        $sql = "SELECT * FROM $tab_name where `shortcoder_name` LIKE \"$atts[name]\"";
        $result = $wpdb->get_results($sql);
        return $result[0]->shortcoder_txt ? $result[0]->shortcoder_txt : '' ;
    }
    add_shortcode('esc','easy_shortcoder_create_func');
    