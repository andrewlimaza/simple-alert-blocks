<?php
/**
 * Plugin Name: Simple Bootstrap Alerts For Gutenberg
 * Description: Gutenberg block for Bootstrap alert boxes. Works without Bootstrap enqueued.
 * Plugin URI: https://andrewlima.co.za
 * Author: Andrew Lima
 * Author URI: https://andrewlima.co.za
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: simple-bootstrap-alerts-for-gutenberg
 * Network: false
 *
 *
 * Simple Bootstrap Alerts For Gutenberg is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Simple Bootstrap Alerts For Gutenberg is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Simple Bootstrap Alerts For Gutenberg. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

defined( 'ABSPATH' ) || exit;

function sbafg_register_files_for_gutenberg() {
    wp_register_script(
        'sbafg-gutenberg-js',
        plugins_url( 'js/gutenberg.build.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'wp-editor' )
    );

    wp_register_style(
      'sbafg-gutenberg-css',
      plugins_url( 'css/bootstrap-alerts.css', __FILE__ ),
      array(),
      filemtime( plugin_dir_path( __FILE__ ) . 'css/bootstrap-alerts.css' )
    );

    register_block_type( 'simple-bootstrap-alerts-for-gutenberg/alert-boxes', array(
        'editor_script' => 'sbafg-gutenberg-js',
        'style' => 'sbafg-gutenberg-css'
    ) );
}
add_action( 'init', 'sbafg_register_files_for_gutenberg' );
