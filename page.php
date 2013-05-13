<?php get_header(); $options = get_black_piano_option(); ?>

<div id="left_col">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
 <div class="post" <?php post_class(); ?>>
  <h2 class="post_title" style="margin-bottom:20px;"><?php the_title(); ?></h2>
  <div class="post_content">
  	  <?php 
  // Fixed stupid coding error. Now the page, doesn't show an excerpt of the page.
	the_content();
	wp_link_pages(); ?>
  </div>
 </div>

 <?php endwhile; else: ?>

 <div class="post">
  <p class="no_post"><?php _e("Sorry, but you are looking for something that isn't here.","black-piano"); ?></p>
 </div>

 <?php endif; ?>

 <?php if ($options['show_comment']): ?>
 <div id="comments_wrapper">
  <?php if (function_exists('wp_list_comments')) { comments_template('', true); } else { comments_template(); } ?>
 </div>
 <?php endif; ?>
  <?php if ( $options['show_return_top'] ) { ?>
  <?php if ( get_adjacent_post() ) { ?>
	 <p class="return_top">
	 <?php } 
	 else {
	 	?> <p class="return_top_empty">
	 <?php };?><a href="#header_menu"><?php _e('Return top','black-piano'); ?></a></p>
 <?php }; ?>

</div><!-- END #left_col -->

<?php if($options['layout'] == 'right') { ?>
<?php get_sidebar(); ?>
<?php }; ?>

<?php get_footer(); ?>