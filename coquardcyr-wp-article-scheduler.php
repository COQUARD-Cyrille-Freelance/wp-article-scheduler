<?php
/**
 * Plugin Name: coquardcyr wp article scheduler
 * Version: 1.0.0
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: coquardcyrwparticlescheduler
 * Domain Path: /languages
 */
use function CoquardcyrWpArticleScheduler\Dependencies\LaunchpadCore\boot;

defined( 'ABSPATH' ) || exit;


require __DIR__ . '/inc/Dependencies/LaunchpadCore/boot.php';

boot(__FILE__);
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc/Dependencies' . DIRECTORY_SEPARATOR . 'ActionScheduler' . DIRECTORY_SEPARATOR . 'action-scheduler.php';
