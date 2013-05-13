<?php get_header(); $options = get_black_piano_option(); ?>


<div id="left_col">

 <?php if ( have_posts() ) : ?>

 <div id="archive_headline">
 <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 <?php if ( is_category() ) { ?>
  <h3><span><?php printf( __( 'Archive for the &#8216; %s &#8217; Category', 'black-piano' ), single_cat_title( '', false ) ); ?></span></h3>

  <?php } elseif( is_tag() ) { ?>
  <h3><span><?php printf( __( 'Posts Tagged &#8216; %s &#8217;', 'black-piano' ), single_tag_title( '', false ) ); $same_cat_black_piano = true;?></span></h3>

  <?php } elseif ( is_day() ) { ?>
  <h3><span><?php printf( __( 'Archive for &#8216; %s &#8217;', 'black-piano' ), get_the_time( __('F jS, Y', 'black-piano' ) ) ); ?></span></h3>

  <?php } elseif ( is_month() ) { ?>
  <h3><span><?php printf( __( 'Archive for &#8216; %s &#8217;', 'black-piano' ), get_the_time( __( 'F, Y', 'black-piano' ) ) ); ?></span></h3>

  <?php } elseif ( is_year() ) { ?>
  <h3><span><?php printf( __( 'Archive for &#8216; %s &#8217;', 'black-piano' ), get_the_time( __( 'Y', 'black-piano' ) ) ); ?></span></h3>

  <?php } elseif ( is_author() ) { ?>
  <h3><span><?php _e( 'Author Archive', 'black-piano' ); ?></span></h3>

  <?php } elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) { ?>
  <h3><span><?php _e( 'Blog Archives', 'black-piano' ); ?></span></h3>
  <?php } ?>
 </div><!-- END #archive_headline -->

 <?php while ( have_posts() ) : the_post(); ?>

 <div class="post">
  <h2 class="post_title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
  <?php if ( $options['show_date'] or $options['show_author'] ) { ?>
  <ul class="post_info">
   <?php if ( $options['show_date'] ): ?><li><?php the_time( __( 'M jS. Y', 'black-piano' ) ) ?></li><?php endif; ?>
   <?php if ( $options['show_author']) : ?><li><?php _e( 'By ','black-piano' ); ?><?php the_author_posts_link(); ?></li><?php endif; ?>
   <?php edit_post_link( __( '[ EDIT ]', 'black-piano' ), '<li class="post_edit">', '</li>' ); ?>
  </ul>
  <?php }; ?>
  <div class="post_content cf">
     <?php 
  	$permlink=get_permalink();
  	$bp_id=get_the_id();
  	$cont=get_the_content(); 
  	if ( ! ( check_for_more( $cont,$permlink,$bp_id ) ||  str_word_count( $cont ) < 55 ) && $options['show_my_more'] )  { 
		the_excerpt();
		} 
	else { 
		the_content( __( 'Read more', 'black-piano' ) ); 
		 } ?>
   <?php wp_link_pages(); ?>
  </div>
  <?php if ( $options['show_category'] or $options['show_tag'] or $options['show_comment'] ) { ?>
  <div class="post_meta">
   <ul class="cf">
    <?php if ( $options['show_comment'] ): ?><li class="post_comment"><?php comments_popup_link( __( 'Write comment', 'black-piano' ), __( '1 comment', 'black-piano' ), __('% comments', 'black-piano') ); ?></li><?php endif; ?>
    <?php if ( $options['show_category'] ): ?><li class="post_category"><?php the_category( ' . ' ); ?></li><?php endif; ?>
    <?php if ( $options['show_tag'] ): ?><?php the_tags( '<li class="post_tag">', ' . ', '</li>' ); ?><?php endif; ?>
   </ul>
  </div>
  <?php }; ?>
 </div><!-- END .post -->

 <?php endwhile; else: ?>

 <div class="post">
  <p class="no_post"><?php _e( "Sorry, but you are looking for something that isn't here.", "black-piano" ); ?></p>
 </div>

 <?php endif; ?>

 <div id="prev_next_post" class="cf">
  <p class="next_post"><?php next_posts_link( __( 'Older posts', 'black-piano' ) ); ?></p>
  <p class="prev_post"><?php previous_posts_link( __( 'Newer posts', 'black-piano' ) ); ?></p>
    <?php if ( $options['show_return_top'] ) { ?>
  <?php if ( get_next_posts_link()  ) { ?>
	 <p class="return_top">
	 <?php } 
	 else { 
	 		if( get_adjacent_post( is_category(), '', false ) ) {
	 			?> <p class="return_top_empty">
	 			<?php }
	 			else { 
	 				?> <p class="return_top_none">
	 			<?php } ?>
	 <?php };?><a href="#header_menu"><?php _e( 'Return top' , 'black-piano' ); ?></a></p>
 <?php }; ?>

 </div>
 <?php//}; ?>

</div><!-- END #left_col -->

<?php if($options['layout'] == 'right') { ?>
<?php get_sidebar(); ?>
<?php }; ?>

<?php get_footer(); ?>