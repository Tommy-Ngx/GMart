<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$args = array(
	'post_type' => 'tbay_testimonial',
	'posts_per_page' => $number,
	'post_status' => 'publish',
);
$loop = new WP_Query($args); 

$rows_count = isset($rows) ? $rows : 1;

if($responsive_type == 'yes') {
    $screen_desktop          =      isset($screen_desktop) ? $screen_desktop : 4;
    $screen_desktopsmall     =      isset($screen_desktopsmall) ? $screen_desktopsmall : 3;
    $screen_tablet           =      isset($screen_tablet) ? $screen_tablet : 3;
    $screen_mobile           =      isset($screen_mobile) ? $screen_mobile : 1;
} else {
    $screen_desktop          =      $columns;
    $screen_desktopsmall     =      $columns;
    $screen_tablet           =      $columns;
    $screen_mobile           =      $columns;  
}


?>

<div class="widget-testimonials widget <?php echo esc_attr($align); ?> <?php echo esc_attr($el_class); ?> <?php echo esc_attr($style); ?>">
	
	<?php if ($title!=''): ?>
        <div class="clearfix">
            <h3 class="widget-title">
                <span><?php echo esc_html( $title ); ?></span>
            </h3>
        </div>
    <?php endif; ?>
	<?php if ( $loop->have_posts() ): ?>


        <div class="owl-carousel testimonials-ca" data-items="<?php echo esc_attr($columns); ?>" data-large="<?php echo esc_attr($screen_desktop);?>" data-medium="<?php echo esc_attr($screen_desktopsmall); ?>" data-smallmedium="<?php echo esc_attr($screen_tablet); ?>" data-extrasmall="<?php echo esc_attr($screen_mobile); ?>" data-carousel="owl" data-pagination="<?php echo ($pagi_type == 'yes') ? 'true' : 'false'; ?>" data-nav="<?php echo ($nav_type == 'yes') ? 'true' : 'false'; ?>">
            <?php $count = 0;  while ( $loop->have_posts() ): $loop->the_post(); ?>

                <?php if($count%$rows_count == 0){ ?>
                    <div class="item">
                <?php } ?>

                    <?php get_template_part( 'vc_templates/testimonial/testimonial', $style ,array( 'loop' => $loop, 'columns' => $columns, 'rows' => $rows, 'pagi_type' => $pagi_type, 'nav_type' => $nav_type,'screen_desktop' => $screen_desktop,'screen_desktopsmall' => $screen_desktopsmall,'screen_tablet' => $screen_tablet,'screen_mobile' => $screen_mobile, 'number' => $number ) ); ?>

                <?php if($count%$rows_count == $rows_count-1 || $count==$loop->post_count -1){ ?>
                    </div>
                <?php }
                $count++; ?>

            <?php endwhile; ?>
        </div>

	<?php endif; ?>
</div>
<?php wp_reset_postdata(); ?>