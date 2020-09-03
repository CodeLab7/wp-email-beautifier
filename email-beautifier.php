<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Email Beautifier
 * Plugin URI:        https://codelab7.com
 * Description:       A Simple Plugin to Enhance your Email experience for you and User.
 * Version:           1.0.0
 * Author:            Codelab7
 * Author URI:        https://codelab7.com
 * License:           GPL-3.0+
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       EB
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if( !defined('WPINC')){
	die;
}

define('EB_VERSION', '1.0.0');

function activate_EB(){
	require_once plugin_dir_path(__FILE__).'includes/EB_Activator.php';
	EB_Activator::activate();
}

function deactivate_EB(){
	require_once plugin_dir_path(__FILE__).'includes/EB_Deactivator.php';
	EB_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_EB');
register_deactivation_hook(__FILE__, 'deactivate_EB');

require plugin_dir_path(__FILE__).'includes/EB.php';

function run_EB(){
	$plugin = new EB();
	$plugin->run();

}

run_EB();