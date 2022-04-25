<?php

/**
 * Plugin wp-book root file.
 *
 * Plugin Name:       WP Book
 * Plugin URI:        https://github.com/Omendra123Rajput/wordpress-book
 * Description:       To manage all book related functionalities.
 * Version:           1.0.0
 * Author:            Omendra Rajput
 * Author URI:        https://mail.google.com/mail/u/0/#inbox
 * License:           GPL v2 or later
 * Text Domain:       wp-book
 * Domain Path:       /languages/
 */

defined('ABSPATH') || die('Denied Direct Access.');

defined('WP_BOOK_PLUGIN_DIR_PATH') || define('WP_BOOK_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
defined('WP_BOOK_PLUGIN_URL') || define('WP_BOOK_PLUGIN_URL', plugins_url().'/wp-book');
/**
 * register_activation_hook function activates our plugin
 */
register_activation_hook(
    __FILE__,
    function () {
        wp_bookmeta_table_create();
    }
);
/**
 * register_deactivation_hook function deactivates our plugin
 */

register_deactivation_hook(
    __FILE__,
    function () {
    }
);
/**
 * register_uninstall_hook function uninstalls our plugin
 */
register_uninstall_hook(
    __FILE__,
    'wp_book_uninstall_cb'
);
// All DB operations.
require WP_BOOK_PLUGIN_DIR_PATH.'includes/db.php';


/**
 * Things to do at plugin delete/uninstall.
 *
 * @return void.
 */
function Wp_Book_Uninstall_cb()
{
        unregister_post_type('book');
        wp_bookmeta_table_drop();

}//end Wp_Book_Uninstall_cb()

// Custom post type Book.
require WP_BOOK_PLUGIN_DIR_PATH.'includes/wp_book_cpt.php';
add_action('init', 'wp_book_cpt_init');

// Custom hierarchical taxonomy Book Category.
require WP_BOOK_PLUGIN_DIR_PATH.'includes/wp_book_category.php';
add_action('init', 'wp_book_category_init');

// Custom non-hierarchical taxonomy Book Tag.
require WP_BOOK_PLUGIN_DIR_PATH.'includes/wp_book_tag.php';
add_action('init', 'wp_book_tag_init');

// Custom meta box book to save book meta information.
require WP_BOOK_PLUGIN_DIR_PATH.'includes/wp_book_metabox.php';
add_action('add_meta_boxes', 'wp_book_metabox_init');
add_action('save_post', 'wp_book_metabox_save_post');


/*
 * Custom meta table(wp_bookmeta) and save all book meta information in that table.
 * wp_bookmeta creted at plugin activation.
 * wp_bookmeta droped at plugin deactivation.
 * below is for register the wp_bookmeta in wordpress.
 */

require WP_BOOK_PLUGIN_DIR_PATH.'includes/wp_book_meta_table.php';
add_action('plugins_loaded', 'wp_book_meta_table_init');
