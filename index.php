<?php get_header(); $options = get_black_piano_option(); ?>

<div id="left-col">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <div class="post">
  <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
  <?php if ($options['show_date'] or $options['show_author']) { ?>
  <ul class="post-info">
   <?php if ($options['show_date']): ?><li><?php the_time(__('M jS. Y', 'black-piano')) ?></li><?php endif; ?>
   <?php if ($options['show_author']) : ?><li><?php _e('By ','black-piano'); ?><?php the_author_posts_link(); ?></li><?php endif; ?>
   <?php edit_post_link(__('[ EDIT ]', 'black-piano'), '<li class="post_edit">', '</li>' ); ?>
  </ul>
  <?php }; ?>
  <div class="post-content">
  <?php 
  	if ( has_post_thumbnail() && $options['show_thumb'] ) the_post_thumbnail();
  	$permlink=get_permalink();
  	$bp_id=get_the_id();
  	$cont=get_the_content(); 
  	if ( ! ( check_for_more( $cont,$permlink,$bp_id ) ||  str_word_count( $cont ) < 55 ) && $options['show_my_more'] )  { 
		the_excerpt();
		} 
	else { 
		the_content( __( 'Read more', 'black-piano' ) ); 
		 } ?>
  </div>
  <?php if ($options['show_category'] or $options['show_tag'] or $options['show_comment']) { ?>
  <div class="post-meta">
   <ul class="cf">
    <?php if ($options['show_comment']): ?><li class="post-comment"><?php comments_popup_link(__('Write comment', 'black-piano'), __('1 comment', 'black-piano'), __('% comments', 'black-piano')); ?></li><?php endif; ?>
    <?php if ($options['show_category']): ?><li class="post_category"><?php the_category(' . '); ?></li><?php endif; ?>
    <?php if ($options['show_tag']): ?><?php the_tags('<li class="post-tag">', ' . ', '</li>'); ?><?php endif; ?>
   </ul>
  </div>
  <?php }; ?>
 </div><!-- END .post -->

 <?php endwhile; else: ?>

 <div class="post">
  <p class="no-post"><?php _e("Sorry, but you are looking for something that isn't here.","black-piano"); ?></p>
 </div>

 <?php endif; ?>
<?php if ($options['pager'] == 'pager') { ?>
 <?php include('navigation.php'); ?>
 <?php } else { ?>
 <div id="prev-next-post" class="cf">
  <p class="next-post">
  <?php next_posts_link( __( 'Older posts', 'black-piano' ) ); ?></p>
  <?php if ( $options['show_return_top'] ) { ?>
  <?php if ( get_next_posts_link() ) { ?>
	 <p class="return-top">
	 <?php } 
	  else {
	 	?> <p class="return-top-empty">
	 <?php };?><a href="#header-menu"><?php _e('Return top','black-piano'); ?></a></p>
 <?php }; ?><p class="prev-post">
  <?php previous_posts_link( __( 'Newer posts', 'black-piano' ) ); ?></p>
   
 
 </div><!--id="prev-next-post"-->
 <?php }; ?>


</div><!-- END #left-col -->

<?php if( $options['layout'] == 'right' ) { ?>
<?php get_sidebar(); ?>
<?php }; ?>

<?php get_footer(); ?>