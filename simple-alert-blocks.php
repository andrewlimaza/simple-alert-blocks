<?php
/**
 * Plugin Name: Simple Alert Blocks
 * Description: Create a simple alert notice in the new Block Editor.
 * Author: Andrew Lima
 * Author URI: https://andrewlima.co.za
 * Version: 1.3
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

function sab_register_files_for_gutenberg() {
    wp_register_script(
        'sab-gutenberg-js',
        plugins_url( 'build/index.js', __FILE__ ),
        array( 'wp-blocks', 'wp-element', 'wp-editor' )
    );

    wp_register_script(
      'sab-hide-alert-js',
      plugins_url( 'js/hide-alert.js', __FILE__ ),
      array( 'jquery' )
    );

    wp_register_style(
      'sab-gutenberg-css',
      plugins_url( 'css/bootstrap-alerts.css', __FILE__ ),
      array(),
      filemtime( plugin_dir_path( __FILE__ ) . 'css/bootstrap-alerts.css' )
    );

    register_block_type( 'simple-alerts-for-gutenberg/alert-boxes', array(
        'editor_script' => 'sab-gutenberg-js',
        'editor_style' => 'sab-gutenberg-css'
    ) );
}
add_action( 'init', 'sab_register_files_for_gutenberg' );

/** Enqueue Script and Style if the post has a block only. */
function sab_enqueue_styles_scripts() {
  if ( has_block( 'simple-alerts-for-gutenberg/alert-boxes' ) ) {
    wp_enqueue_style( 'sab-gutenberg-css' );
    wp_enqueue_script( 'sab-hide-alert-js' );
  }
}
add_action( 'wp_enqueue_scripts', 'sab_enqueue_styles_scripts' );