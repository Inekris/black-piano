<?php get_header(); $options = get_black_piano_option(); ?>

<div id="left-col">

 <?php if ($options['show_bread_crumb']) : ?>
 <div id="bread-crumb">
  <ul class="cf">
   <li id="bc_home"><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('HOME','black-piano'); ?></a></li>
   <?php if ($options['show_category']): ?><li id="bc_cat"><?php the_category(' . '); ?></li><?php endif; ?>
   <li><?php the_title(); ?></li>
  </ul>
 </div>
 <?php endif; ?>

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
 <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <h2 class="post-title"><?php the_title(); ?></h2>
  <?php if ($options['show_author'] or $options['show_date'] or $options['show_category'] or $options['show_tag'] or $options['show_comment']) { ?>
  <ul class="post-info">
   <?php if ($options['show_date']): ?><li><?php the_time(__('M jS. Y', 'black-piano')) ?></li><?php endif; ?>
   <?php if ( $options['show_category'] && ! $options['show_bread_crumb'] ): ?><li><?php _e('Posted in ','black-piano'); ?><?php the_category(' . '); ?></li><?php endif; ?>
   <?php if ($options['show_author']) : ?><li><?php _e('By ','black-piano'); ?><?php the_author_posts_link(); ?></li><?php endif; ?>
    <?php if ($options['show_tag']): ?><?php the_tags('<li class="post-tag">', ' . ', '</li>'); ?><?php endif; ?>
   <?php if ($options['show_comment']): ?><li class="write-comment"><a href="<?php the_permalink() ?>#comments"><?php _e('Write comment','black-piano'); ?></a></li><?php endif; ?>
   <?php edit_post_link(__('[ EDIT ]', 'black-piano'), '<li class="post_edit">', '</li>' ); ?>
  </ul>
  <?php }; ?>
  <div class="post-content cf">
   <?php the_content(__('Read more', 'black-piano')); ?>
  
   <?php wp_link_pages(); ?>
   
 

  </div>
   <?php if ( get_post_meta( get_the_id() ) <> "" ) {
   		$the_meta_string="";
   		$the_meta_keys = get_post_custom_keys();
   		foreach ( $the_meta_keys as $the_meta_key ) {
   			//$protected = ( '_' == $the_meta_key[0] );
   			if ( ! strstr( $the_meta_key, '_' ) ) {
	   			$the_meta_value = get_post_meta( get_the_id(), $the_meta_key, true );
   				$the_meta_string.='<li class="meta-val"><b>'.$the_meta_key.":</b> ".$the_meta_value."</li>"; 
   				}
   			}
 /*  		$the_meta_stuff=get_post_meta( get_the_id() );
   		$the_meta_string="";
   		foreach ( $the_meta_stuff as $the_meta_key => $the_meta_value ) {
   			if ( strstr( $the_meta_key, "_" ) == FALSE ) {
   				$the_meta_string.='<li class="meta-val">'.$the_meta_key.": ";
   				foreach ( $the_meta_value as $the_real_meta ) {
   					$the_meta_string.=$the_real_meta." ";
   					}
   				$the_meta_string.="</li>";
   				}
   			}*/
   		if (  "" !== $the_meta_string ) {
   		?><div class="post-meta"><ul class="cf"><?php echo $the_meta_string; ?></ul></div>
   	<?php } } ?>
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
  <?php if ( get_adjacent_post() ) { ?>
	 <p class="return-top">
	 <?php } 
	 else {
	 	?> <p class="return-top-empty">
	 <?php };?><a href="#header-menu"><?php _e('Return top','black-piano'); ?></a></p>
 <?php }; ?>

 </div>
 <?php endif; ?>

</div><!-- END #left-col -->

<?php if($options['layout'] == 'right') { ?>
<?php get_sidebar(); ?>
<?php }; ?>

<?php get_footer(); ?>