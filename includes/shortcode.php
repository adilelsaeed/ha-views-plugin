<?php
/* ---------------------------------- *
هذا الملف لإنشاء الشيفرة المختصر لعرض عدد مشاهدات المقال.
 * ---------------------------------- */

function ha_views_shortcode( $atts ){
	return ha_get_post_views();
}
add_shortcode( 'ha_views', 'ha_views_shortcode' );