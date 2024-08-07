<?php
/*
Plugin Name: Simple Admin Button Plugin
Description: A simple plugin to add a custom admin menu with a button.
Version: 1.0
Author: Hristo
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Hook to add the admin menu
add_action('admin_menu', 'simple_admin_button_menu');

function simple_admin_button_menu() {
    add_menu_page(
        'Simple Button Page', // Page title
        'Simple Button',      // Menu title
        'manage_options',     // Capability
        'simple-button',      // Menu slug
        'simple_admin_button_page', // Callback function
        'dashicons-admin-generic',  // Icon URL
        2                      // Position
    );
}

function simple_admin_button_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Simple Button Page', 'simple-button-plugin'); ?></h1>
        <form method="post" action="">
            <?php
            if (isset($_POST['simple_button_action'])) {
                echo '<div id="message" class="updated notice is-dismissible"><p>Button Clicked!</p></div>';
            }
            ?>
            <input type="hidden" name="simple_button_action" value="1" />
            <button type="submit" class="button button-primary"><?php esc_html_e('Click Me!', 'simple-button-plugin'); ?></button>
        </form>
    </div>
    <?php
}
?>
