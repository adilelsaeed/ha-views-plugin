<?php
/* ---------------------------------- *
هذا الملف لإنشاء الودجت الخاص بعرض أكثر المقالات مشاهدة
 * ---------------------------------- */
class HA_Views_Widget extends WP_Widget { 
    // البيانات الأساسية للودجت (مثل إسم ووصف الودجت)
	public function __construct() { 
    	$widget_details = array( 'classname' => 'ha_views_widget', 'description' => 'ودجت لعرض المقالات الأكثر مشاهدة' ); 
		parent::__construct( 'ha_views_widget', 'المقالات الأكثر مشاهدة', $widget_details );
    } 
  	
  	// عرض خيارات الويدجت في لوحة تحكم ووردبريس 
    public function form( $instance ) { 
    	$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '' ) );
		$title = strip_tags($instance['title']);
		$count = $instance['count']; 
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('العنوان:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('عدد المقالات:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></p>
<?php
    }

    // لحفظ خيارات الويدجت عندما يقوم المستخدم بتعديلها 
    public function update( $new_instance, $old_instance ) { 
    	return $new_instance; 
    }

    // ما سيتم عرضه في واجهة الموقع (المقالات الأكثر مشاهدة)
    public function widget($args, $instance ) { 

    	$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] :  'المقالات الأكثر مشاهدة' ;
    	$count = ( ! empty( $instance['count'] ) ) ? $instance['count'] :  5 ;
    	
    	$query_args = array(
				    'meta_key' 		 => 'ha_post_views_count',
				    'orderby' 		 => 'meta_value_num',
				    'posts_per_page' => $count
				);
		$query = new WP_Query($query_args);

		if($query->have_posts()):
?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<ul>
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $args['after_widget']; ?>
<?php
		wp_reset_postdata();
		endif;
    } 
    
}


// تسجيل الويدجت من خلال إضافة الدالة ادناه للحدث widget_init
add_action( 'widgets_init', 'ha_widget_init' ); 
function ha_widget_init() { 
  register_widget( 'HA_Views_Widget' ); 
} 


