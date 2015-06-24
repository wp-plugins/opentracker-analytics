<?php
/**
 * Plugin Name: Opentracker
 * Plugin URI:
 * Description: Opentracker Plugin
 * Author: Opentracker
 * Author URI: http://www.opentracker.net?wordPressPlugin
 * Version: 1.0
 *
 * Text Domain: opentracker
 */

/*  Copyright 2015  Elena Karaush  (email: karaush@meta.ua)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
defines
*/
require_once ('init.php');

/**
main plug-in class
*/
require_once ('opentracker.class.php');

register_activation_hook( __FILE__, 'opentracker_activate');
register_deactivation_hook( __FILE__, 'opentracker_deactivate');
register_uninstall_hook( __FILE__, 'opentracker_uninstall');

try {
    $otApplication = new Opentracker();
} catch (Exception $e) {
    echo $e->getMessage();
}

/**
Plugin Install Functions
*/

function opentracker_activate() {
	add_option( 'opentracker_sitename', 'sitename','','yes');

}

function opentracker_deactivate() {
       delete_option('opentracker_sitename');
}

function opentracker_uninstall() {
      delete_option('opentracker_sitename');
}


function opentracker_settings_link($links) {
  $settings_link = '<a href="http://' . $_SERVER['SERVER_NAME'] . '/wp-admin/admin.php?page=opentracker">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'opentracker_settings_link' );

?>