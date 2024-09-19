<?php
/**
 * Plugin Name:       Codebaou-hal21-vertical-menu
 * Description:       Un menu vertical para el footer
 * Requires at least: 6.6
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       codebaou-hal21-menu-vertical
 *
 * @package CodebaouHal21
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function codebaou_hal21_codebaou_hal21_menu_vertical_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'codebaou_hal21_codebaou_hal21_menu_vertical_block_init' );
