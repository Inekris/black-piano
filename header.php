<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html <?php language_attributes( 'html' ); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php
global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' );
$site_description = get_bloginfo( 'description', 'display' ); if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description";
if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s', 'black-piano' ), max( $paged, $page ) );
?></title>
<meta name="description" content="<?php echo bloginfo('description'); ?>" />


<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/comment-style.css" type="text/css" media="screen" />
<?php if(is_home() && (!$paged || $paged == 1) || is_single()) { ?>
      <meta name="googlebot" content="index,archive,follow,noodp" />
      <meta name="robots" content="all,index,follow" />
      <meta name="msnbot" content="all,index,follow" />
  <?php } else { ?>
      <meta name="googlebot" content="noindex,noarchive,follow,noodp" />
      <meta name="robots" content="noindex,follow" />
      <meta name="msnbot" content="noindex,follow" />
<?php } ?>

<?php wp_enqueue_script( 'jquery' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 
<?php wp_head(); ?>

<!--<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scroll.js"></script>-->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jscript.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/comment.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/rollover.js"></script>

<!--[if IE 7]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie7.css" type="text/css" />
<![endif]-->

<?php $options = get_black_piano_option(); ?>

</head>

<body <?php body_class(); ?>>

<div id="header-menu">
<?php if (has_nav_menu('header-menu')) { ?>
 <div class="header-menu">
  <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'header-menu' , 'container' => '' ) ); ?>
 </div>
<?php }; ?>
</div>

<div id="header">

 <!-- logo -->
 <div id="logo">
  <?php the_dp_logo(); ?>
 </div>

 <div id="header-meta">
  <?php if ($options['show_search']) { ?>
  <div id="header-search-area"<?php if (!$options['show_rss']&&!$options['twitter_url']) : echo ' style="margin-right:0;"'; endif; ?>>
   <?php if ($options['custom_search_id']) : ?>
   <form action="http://www.google.com/cse" method="get" id="searchform">
    <div>
     <input id="search-input" type="text" value="<?php _e('SEARCH','black-piano'); ?>" name="q" onfocus="if (this.value == '<?php _e('SEARCH','black-piano'); ?>') this.value = '';" onblur="if (this.value == '') this.value = '<?php _e('SEARCH','black-piano'); ?>';" />
    </div>
    <div>
     <input type="image" src="<?php bloginfo('template_url'); ?>/img/search_button.gif" name="sa" alt="<?php _e('Search from this blog.','black-piano'); ?>" title="<?php _e('Search from this blog.','black-piano'); ?>" id="search-button" class="rollover" />
     <input type="hidden" name="cx" value="<?php echo $options['custom_search_id']; ?>" />
     <input type="hidden" name="ie" value="UTF-8" />
    </div>
   </form>
   <?php else: ?>
   <form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <div><input id="search-input" type="text" value="<?php _e('SEARCH','black-piano'); ?>" name="s" onfocus="if (this.value == '<?php _e('SEARCH','black-piano'); ?>') this.value = '';" onblur="if (this.value == '') this.value = '<?php _e('SEARCH','black-piano'); ?>';" /></div>
    <div><input type="image" src="<?php bloginfo('template_url'); ?>/img/search_button.gif" alt="<?php _e('Search from this blog.','black-piano'); ?>" title="<?php _e('Search from this blog.','black-piano'); ?>" id="search-button" class="rollover" /></div>
   </form>
   <?php endif; ?>
  </div>
  <?php }; ?>
  <?php if ($options['show_rss']) : ?>
  <a href="<?php bloginfo('rss2_url'); ?>" class="target_blank" id="header-rss" title="<?php _e('RSS','black-piano'); ?>" ><?php _e('RSS','black-piano'); ?></a>
  <?php endif; ?>
  <?php if ($options['twitter_url']) : ?>
  <a href="<?php echo $options['twitter_url']; ?>" class="target_blank" id="header-twitter" title="<?php _e('Twitter','black-piano'); ?>" ><?php _e('Twitter','black-piano'); ?></a>
  <?php endif; ?>
  <?php if ($options['facebook_url']) : ?>
  <a href="<?php echo $options['facebook_url']; ?>" class="target_blank" id="header-facebook" title="<?php _e('Facebook','black-piano'); ?>" ><?php _e('Facebook','black-piano'); ?></a>
  <?php endif; ?>
 </div><!-- END #header-meta -->

</div><!-- END #header -->

<div id="contents" class="cf">
