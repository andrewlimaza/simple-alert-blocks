<?php
/**
 * Plugin Name: Simple Alert Blocks
 * Description: Create a simple alert notice in the new Block Editor.
 * Author: Andrew Lima
 * Author URI: https://andrewlima.co.za
 * Version: 1.1
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: simple-alert-blocks
 * Network: false
 *
 *
 * Simple Alert Blocks For Gutenberg is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Simple Alert Blocks For Gutenberg is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Simple Alert Blocks For Gutenberg. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

defined( 'ABSPATH' ) || exit;

function safgb_register_files_for_gutenberg() {
    wp_register_script(
        'safgb-gutenberg-js',
        plugins_url( 'js/gutenberg.build.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'wp-editor' )
    );

  wp_register_script(
    'safgb-hide-alert-js',
    plugins_url( 'js/hide-alert.js', __FILE__ ),
    array( 'jquery' )
  );

    wp_register_style(
      'safgb-gutenberg-css',
      plugins_url( 'css/bootstrap-alerts.css', __FILE__ ),
      array(),
      filemtime( plugin_dir_path( __FILE__ ) . 'css/bootstrap-alerts.css' )
    );

    register_block_type( 'simple-alerts-for-gutenberg/alert-boxes', array(
        'editor_script' => 'safgb-gutenberg-js',
        'style' => 'safgb-gutenberg-css',
        'script' => 'safgb-hide-alert-js'
    ) );
}
add_action( 'init', 'safgb_register_files_for_gutenberg' );
