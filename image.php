<?php get_header(); $options = get_black_piano_option(); ?>

<div id="left-col">

 <?php if ($options['show_bread_crumb']) : ?>
 <div id="bread-crumb">
  <ul class="cf">
   <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('HOME','black-piano'); ?></a></li>
   <?php if ($options['show_category']): ?><li id="bc_cat"><?php the_category(' . '); ?></li><?php endif; ?>
   <li><?php the_title(); ?></li>
  </ul>
 </div>
 <?php endif; ?>

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
 <div class="post">
  <h2 class="post-title"><?php the_title(); ?></h2>
  
  <div class="post-content cf">
  <?php if ( wp_attachment_is_image( $post->id ) ) : $bp_att_image = wp_get_attachment_image_src( $post->id, "full" ); ?><a href="<?php echo get_permalink($post->post_parent); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo $bp_att_image[0];?>" width="<?php echo $bp_att_image[1];?>" height="<?php echo $bp_att_image[2];?>"  class="centered" alt="<?php $post->post_excerpt; ?>" /></a>
  <?php else : ?>
  <a href="<?php echo esc_html($post->ID) ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
<?php endif; ?>
  </div>
   
 </div>

 <?php endwhile; else: ?>

 <div class="post">
  <p class="no-post"><?php _e("Sorry, but you are looking for something that isn't here.","black-piano"); ?></p>
 </div>

 <?php endif; ?>
 <?php if ($options['show_comment']): ?>
 <div id="comments-wrapper">
  <?php if (function_exists('wp_list_comments')) { comments_template('', true); } else { comments_template(); } ?>
 </div>
 <?php endif; ?>

 

 <?php if ($options['show_next_post']) : ?> <div id="prev-next-post" class="cf">
  <?php next_post_link( '<p class="prev-post">%link</p>' ); ?>
  <?php previous_post_link( '<p class="next-post">%link</p>' ); ?>
  <?php if ( $options['show_return_top'] ) { ?>
 <p class="return-top">
	<a href="#header-menu"><?php _e('Return top','black-piano'); ?></a></p>
 <?php }; ?>

 </div>
 <?php endif; ?>

</div><!-- END #left-col -->

<?php if($options['layout'] == 'right') { ?>
<?php get_sidebar(); ?>
<?php }; ?>

<?php get_footer(); ?>