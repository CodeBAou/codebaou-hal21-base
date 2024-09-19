<?php
/**
 * Plugin Name:       Codebaou Hal21 Menu
 * Description:       Un menu compatible con polylang del theme codebaou-hal21-base
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            codebaou
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       codebaou-hal21-menu
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

/** BLOQUES REGISTRO */

function Register_Block_codebaou_hal21_menu(){

    // codebaou-menu
	register_block_type( __DIR__ . '/build' );
}

add_action('init', 'Register_Block_codebaou_hal21_menu');
