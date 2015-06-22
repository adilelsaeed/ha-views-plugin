<?php
/**
 * Plugin Name: Hsoub Views Widget
 * Plugin URI: http://academy.hsoub.com/
 * Description: إضافة صغيرة تقوم بإضافة مربع جانبي لعرض المقالات الأكثر مشاهدة في موقع ووردبريس مع إمكانية عرض عدد المشاهدات في كل مقالة.
 * Version: 1.4.0
 * Author: Adil Elsaeed
 * Author URI: http://adilelsaeed.com
 * Text Domain: ha-widgets
 * Domain Path: /lang/
 * License: GPL2
 */

/* ---------------------------------- *
 * الثوابت الأساسية
 * ---------------------------------- */

if ( !defined( 'SDG_PLUGIN_DIR' ) ) {
	define( 'HA_VIEWS_DIR', plugin_dir_path( __FILE__ ) );
}

if ( !defined( 'HA_VIEWS_URL' ) ) {
	define( 'SDG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( !defined( 'HA_VIEWS_VER' ) ) {
	define( 'SDG_PLUGIN_VER', '1.1.0' );
}


/* ---------------------------------- *
 * تضمين ملفات الإضافة
 * ---------------------------------- */

// الملف المسئول عن عدد المشاهدات
require_once HA_VIEWS_DIR . 'includes/views.php';

// الملف المسئول عن الويدجت
require_once HA_VIEWS_DIR . 'includes/widget.php';

// الملف المسئول عن الكود المختصر
require_once HA_VIEWS_DIR . 'includes/shortcode.php';



/* ---------------------------------- *
 * ضف الملفات المساعدة 
 * ---------------------------------- */
add_action('wp_enqueue_scripts', 'ha_scripts');
function ha_scripts(){
		wp_enqueue_script( 'sdg-admin',  HA_VIEWS_URL . 'css/widget.css', array(), SDG_PLUGIN_VER);
}