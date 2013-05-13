<?php get_header(); $options = get_black_piano_option(); ?>

<div id="left_col">

 <div class="post cf" style="margin-bottom:40px;">
  <h2 class="post_title"><?php _e("Error 404 Not Found.","black-piano"); ?></h2>
 </div>

 <div id="prev_next_post" class="cf">
  <p class="next_post"><?php next_posts_link( __( 'Older posts', 'black-piano' ) ); ?></p>
  <p class="prev_post"><?php previous_posts_link( __( 'Newer posts', 'black-piano' ) ); ?></p>
 </div>
 

</div><!-- END #left_col -->

<?php if($options['layout'] == 'right') { ?>
<?php get_sidebar(); ?>
<?php }; ?>

<?php get_footer(); ?>