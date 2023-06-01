<?php
/*
Plugin Name: Schools
Description: Hello World
Version: 1
Author: chandresh
Author URI: http://google.com
*/
				
function install() {

    global $wpdb;

    $table_name = $wpdb->prefix . "school";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
            `id` varchar(3) CHARACTER SET utf8 NOT NULL,
            `name` varchar(50) CHARACTER SET utf8 NOT NULL,
			`description` varchar(300) CHARACTER SET utf8 NOT NULL,
			`image` varchar(150) CHARACTER SET utf8 NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}


register_activation_hook(__FILE__, 'install');


add_action('admin_menu','schools_modify');
function schools_modify() {
	

	add_menu_page('Schools',
	'Schools', 
	'manage_options', 
	'school_list',
	'school_list' 
	);
	
	add_submenu_page('school_list', 
	'Add New School', 
	'Add New', 
	'manage_options', 
	'schools_create', 
	'schools_create'); 
	

	add_submenu_page(null, 
	'Update School', 
	'Update', 
	'manage_options', 
	'schools_update', 
	'schools_update'); 
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'schools-list.php');
require_once(ROOTDIR . 'schools-create.php');
require_once(ROOTDIR . 'schools-update.php');

