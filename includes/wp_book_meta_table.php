<?php

/**
 * Create custom meta table to save book meta information.
 */


/**
 * Register the wp_bookmeta in wordpress.
 *
 * @return void.
 */
function wp_book_meta_table_init()
{
    global $wpdb;
    $wpdb->bookmeta = $wpdb->prefix.'bookmeta';

}//end wp_book_meta_table_init()
