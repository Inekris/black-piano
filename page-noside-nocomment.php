<?php
/*
Template Name:No sidebar, No comment
*/
?>
<?php get_header(); $options = get_black_piano_option(); ?>

<div id="left_col">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <div class="post" <?php post_class(); ?>>
  <h2 class="post_title" style="margin-bottom:20px;"><?php the_title(); ?></h2>
  <div class="post_content">
   <?php the_content(__('Read more', 'black-piano')); ?>
   <?php wp_link_pages(); ?>
  </div>
 </div>

 <?php endwhile; else: ?>

 <div class="post">
  <p class="no_post"><?php _e("Sorry, but you are looking for something that isn't here.","black-piano"); ?></p>
 </div>

 <?php endif; ?>

</div><!-- END #left_col -->

<?php get_footer(); ?>