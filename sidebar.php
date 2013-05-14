<?php $options = get_black_piano_option(); ?>

<div id="right-col">

 <?php if ( $options['information_title'] && $options['show_information_block'] ) : ?>
 <h3 class="side-title" id="info-title"><?php echo ($options['information_title']); ?></h3>
 <div class="side-box" id="info-box">
  <?php echo wpautop($options['information_contents']); ?>
 </div>
 <?php endif; ?>

<?php if(is_active_sidebar('top')||is_active_sidebar('bottom')||is_active_sidebar('left')||is_active_sidebar('right')){ ?>

 <div id="side_top">
  <?php dynamic_sidebar('top'); ?>
 </div>
 <div id="side-middle" class="cf">
  <div id="side-left">
   <?php dynamic_sidebar('left'); ?>
  </div>
  <div id="side-right">
   <?php dynamic_sidebar('right'); ?>
  </div>
 </div>
 <div id="side-bottom">
  <?php dynamic_sidebar('bottom'); ?>
 </div>

<?php } else { ?>

 <div id="side_top">
  <div class="side-box">
   <h3 class="side-title"><?php _e('RECENT ENTRY','black-piano'); ?></h3>
   <ul>
    <?php $myposts = get_posts('numberposts=5'); foreach($myposts as $post) : ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    <?php endforeach; ?>
   </ul>
  </div>
 </div>

 <div id="side_middle_ex" class="cf">
  <div id="side-left">
   <div class="side-box-short">
    <h3 class="side-title"><?php _e('CATEGORY','black-piano'); ?></h3>
    <ul>
     <?php wp_list_categories('title_li='); ?>
    </ul>
   </div>
  </div>
  <div id="side-right">
   <div class="side-box-short">
    <h3 class="side-title"><?php _e('ARCHIVES','black-piano'); ?></h3>
    <ul>
     <?php wp_get_archives('type=monthly'); ?>
    </ul>
   </div>
  </div>
 </div><!-- END #side-middle -->

 <div id="side-bottom">
  <div class="side-box">
   <h3 class="side-title"><?php _e('CALENDAR','black-piano'); ?></h3>
   <?php get_calendar(true); ?>
  </div>
 </div>

 <?php }; ?>

 <div class="side-box">
  <?php bp_show_copyright_info(); ?>
 </div>

</div><!-- END #right-col -->