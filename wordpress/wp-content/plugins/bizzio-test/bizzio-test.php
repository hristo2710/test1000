<?php
/*
Plugin Name: Bizzio Test Plugin
Description: Test plugin for communication with Bizzio.
Version: 1.0
Author: GenCloud Ltd.
Author URI: https://gencloud.bg/
*/

// ensures that the file is being accessed through WordPress and not directly
if (!defined('ABSPATH')) {
    exit; // exit if accessed directly.
}

// hook to add the admin menu
add_action('admin_menu', 'bizzio_test_menu');

// enqueue scripts
add_action('admin_enqueue_scripts', 'bizzio_test_enqueue_scripts');

function bizzio_test_enqueue_scripts($hook) {
    // Only load the script on the plugin's admin page
    if ($hook != 'toplevel_page_bizzio_test') { 
        // 'toplevel_page_bizzio_test' is the hook suffix for the top-level admin page created by the plugin. 
        // It is constructed using the menu slug provided in the add_menu_page function
        return;
    }
    wp_enqueue_script('bizzio-test-script', plugin_dir_url(__FILE__) . 'bizzio-test.js', array('jquery'), '1.0', true);
    /* 
        'bizzio-test-script': The handle/name of the script 
        plugin_dir_url(__FILE__) . 'bizzio-test.js': The URL to the JavaScript file
        plugin_dir_url(__FILE__) returns the URL of the directory containing the current PHP file, and appending 'bizzio-test.js' specifies the script's file name
        array('jquery'): This array specifies the script dependencies. In this case, the script depends on jQuery, which means jQuery will be loaded before this script
        '1.0': The version number of the script. This helps with cache busting; if you change the script, you can update the version number to ensure browsers load the new version
        true: This boolean value specifies whether to load the script in the footer (true) or the header (false). Loading scripts in the footer is generally recommended for better page load performance.    
    */
}

function bizzio_test_menu() {
    add_menu_page(
        'Bizzio Test Page', // page title displayed in the browser tab
        'Bizzio Test',      // menu title in the admin sidebar
        'manage_options',   // capability, only users with the manage_options capability can see this menu item
        'bizzio_test',      // menu slug used in the URL
        'bizzio_test_page', // callback function that renders the content of the page
        'dashicons-cloud',  // icon displayed in the admin menu
        1                   // position of the menu item in the admin sidebar
    );
}

// adds a button and a container (<div id="bizzio-products"></div>) to display the fetched products
function bizzio_test_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Bizzio Test Page', 'bizzio-test'); ?></h1>
        <button id="bizzio-fetch-button" class="button button-primary"><?php esc_html_e('Fetch products', 'bizzio-test'); ?></button>
        <div id="bizzio-products"></div>
    </div>
    <?php
}
?>
