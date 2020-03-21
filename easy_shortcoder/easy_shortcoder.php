<?php 

/*
Plugin Name: WP easy shortcoder
Description: This is a simple WordPress plugin to create your own shortcode
Author: sieradz628
Author URI: https://jsscope.com
Plugin URI: https://github.com/sieradz628/WP-easy-shortcoder
License: shareware 
Version: 1.0.0
*/

    function install_db() {
        global $wpdb;
        $tab_name = $wpdb->prefix . "easy_shortcoder";
        if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE $tab_name (
                `ID` INT NOT NULL AUTO_INCREMENT , `shortcoder_name` TEXT NOT NULL , `shortcoder_txt` TEXT NOT NULL , PRIMARY KEY (`ID`)
            ) $charset_collate;";

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );
        }
    }
    register_activation_hook(__FILE__, 'install_db');

    function uninstall_db() {
        global $wpdb;
        $tab_name = $wpdb->prefix . "easy_shortcoder";
        $sql = "DROP TABLE IF EXISTS $tab_name;";
        $wpdb->query($sql);
    }
    register_uninstall_hook(__FILE__, 'uninstall_db');

    require(__DIR__.'/settings.php');

    function easy_shortcoder_main() {
        global $wpdb;
        $tab_name = $wpdb->prefix . "easy_shortcoder";
        if ($_GET["editedID"] && $_POST) {
            $sql = "UPDATE $tab_name SET `shortcoder_name` = \"$_POST[shortcoder_name]\" ,`shortcoder_txt` = \"$_POST[shortcoder_txt]\" WHERE `ID` = ".$_GET["editedID"]." ";
            $wpdb->query($sql);
        } elseif($_POST) {
            $sql = "INSERT INTO $tab_name(`shortcoder_name`, `shortcoder_txt`) VALUES (\"$_POST[shortcoder_name]\", \"$_POST[shortcoder_txt]\")";
            $wpdb->query($sql);
        }
        if ($_GET["deleteID"]) {
            $sql = "DELETE FROM $tab_name WHERE ID = ".$_GET["deleteID"]." ";
            $wpdb->query($sql);
        }
        if ($_GET["editID"]) {
            $sql = "SELECT `ID`, `shortcoder_name`, `shortcoder_txt` FROM `$tab_name` WHERE `ID` = ".$_GET["editID"]." ";
            $name=$wpdb->get_results($sql)[0]->shortcoder_name;
            $txt=$wpdb->get_results($sql)[0]->shortcoder_txt;
            $link="&editedID=".$wpdb->get_results($sql)[0]->ID."";
        }
        include(__DIR__.'/template.php');     
    }
?>
