<?php
/**
 * Plugin Name:       Codebaou-hal21-ultimas-Entradas
 * Description:       Seccion donde se muestran las ultimas entradas
 * Requires at least: 6.6
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       codebaou-hal2-ultimas-entradas
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
function codebaou_hal21_codebaou_hal2_ultimas_entradas_block_init() {
	register_block_type( __DIR__ . '/build' );
}
add_action( 'init', 'codebaou_hal21_codebaou_hal2_ultimas_entradas_block_init' );
