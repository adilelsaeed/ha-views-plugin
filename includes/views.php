<?php
/* ---------------------------------- *
هذا الملف مخصص لإنشاء ومتابعة عدد المشاهدات
 * ---------------------------------- */

// الدالة المسئولة من تحديث عدد المشاهادات
function ha_set_post_views() {
	// إذا لم يكن هذا مقال مفرد (صفحة أو مقال) لا تنفذ شئ
	if(!is_singular()){
		return;
	}
	// الوصول الى بيانات المقال الحالي
	global $post;
	$post_id = $post->ID;
    $count_key = 'ha_post_views_count';
    // إسترجاع العدد الحالي للمشاهدات
    $count = get_post_meta($post_id, $count_key, true);
    if($count==''){ // هذا يعني أنه بم يتم إنشاء الميتا الخاص بحفظ عدد المشاهدات حتى الان
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0'); // إنشاء الميتا الخاص بحفظ عدد المشاهدات
    }else{ 
    	// زيادة عدد المشاهدات بمقدار مشاهدة واحدة
        $count++;
        // حفظ الميتا التي حفظنا فيه عدد المشاهادات
        update_post_meta($post_id, $count_key, $count);
    }
}

// إضافة الدالة الى الحدث المناسب لنضمن تنفيذها عند عرض المقال
add_action('wp_head', 'ha_set_post_views');


// إسترجاع عدد مشاهدات المقال الحالي
function ha_get_post_views(){
	// الوصول الى بيانات المقال الحالي
	global $post;
	$post_id = $post->ID;
    $count_key = 'ha_post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if($count==''){
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        return "0 مشاهدة";
    }
    return $count.' مشاهدة';
}