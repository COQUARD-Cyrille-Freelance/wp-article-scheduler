<?php
/**
 * Plugin Name: End to End helper
 * Version: 1.0.0
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: endtoendhelper
 * Domain Path: /languages
 */
use function EndToEndHelper\Dependencies\LaunchpadCore\boot;

defined( 'ABSPATH' ) || exit;


require __DIR__ . '/inc/Dependencies/LaunchpadCore/boot.php';

boot(__FILE__);
