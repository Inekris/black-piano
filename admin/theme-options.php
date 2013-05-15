<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * Options
 * @var array 
 */
global $black_piano_default_options;
$black_piano_default_options = array(
	'show_author' => 1,
	'show_category' => 1,
	'show_tag' => 1,
	'show_date' => 1,
	'show_thumb' => 1,
	'show_comment' => 1,
	'show_comment_time' => 1,
	'show_custom_fields' => 1,
	'show_next_post' => 1,
	'show_return_top' => 1,
	'show_bread_crumb' => 1,
	'show_search' => 1,
	'show_rss' => 1,
	'show_my_more' => 1,
	'show_site_desc' => 1,
	'show_information_block' => 1,
        'information_title' => __('INFORMATION', 'black-piano'),
        'information_contents' => __('Change this sentence and title from admin Theme option page.', 'black-piano'),
	'layout'  	=> 'right',
	'pager'		=> 'pager',
	'twitter_url' => '',
	'facebook_url' => '',
	'custom_search_id' => '',
	'logotop' => 0,
	'logoleft' => 0
);

/**
 * Get an option
 * @global array $black_piano_default_options
 * @return array 
 */
function get_black_piano_option(){
	global $black_piano_default_options;
	return shortcode_atts($black_piano_default_options, get_option('black_piano_options', array()));
}


// javascript print
add_action('admin_print_scripts', 'my_admin_print_scripts');
function my_admin_print_scripts() {
  wp_enqueue_script('jquery.cookieTab', get_template_directory_uri().'/admin/jquery.cookieTab.js');
}



// WP Gear manager
function wp_gear_manager_admin_scripts() {
wp_enqueue_script('black_piano-image-manager', get_template_directory_uri().'/admin/image-manager.js', array('jquery', 'jquery-ui-draggable', 'imgareaselect'));
}
function wp_gear_manager_admin_styles() {
wp_enqueue_style('imgareaselect');
}
add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');
add_action('admin_print_styles', 'wp_gear_manager_admin_styles');



// Initialize options
function theme_options_init(){
 register_setting( 'black_piano_options', 'black_piano_options', 'theme_options_validate' );
}


// Add theme options page
function theme_options_add_page() {
 add_theme_page( __( 'Theme Options', 'black-piano' ), __( 'Theme Options', 'black-piano' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}

/**
 * Layout options
 * @var array 
 */

function layout_options() {
global $layout_options;
$layout_options = array(
 'noside' => array(
  'value' => 'noside',
  'label' => __( 'No sidebar', 'black-piano' ),
  'img' => 'no_side'
 ),
 'right' => array(
  'value' => 'right',
  'label' => __( 'Show sidebar', 'black-piano' ),
  'img' => 'right_side'
 )
);
return $layout_options;
}

function bp_pager_options() {
	$pager_options = array(
		'pager' => array(
			'value' => 'pager',
			'label' => __( 'Use pager', 'pianoblack' ),
			'img' => 'pager'
 		),
 'normal_link' => array(
  'value' => 'normal_link',
  'label' => __( 'Use normal link', 'pianoblack' ),
  'img' => 'normal_link'
 )
);
return $pager_options;
}

// Do options page
function theme_options_do_page() {
 global  $inekris_upload_error;
 $options = get_black_piano_option(); 

 if ( ! isset( $_REQUEST['settings-updated'] ) )
  $_REQUEST['settings-updated'] = false;

  // TinyMCE add
  wp_enqueue_script( 'common' );
  wp_enqueue_script( 'jquery-color' );
  wp_print_scripts('editor');
  if (function_exists('add_thickbox')) add_thickbox();
  wp_print_scripts('media-upload');
 // if (function_exists('wp_editor')) wp_editor();
  wp_admin_css();
  wp_enqueue_script('utils');
  do_action("admin_print_styles-post-php");
  do_action('admin_print_styles');


?>

<div class="wrap">
 <?php screen_icon(); echo "<h2>" . __( 'Theme Options', 'black-piano' ) . "</h2>"; ?>

 <?php 
       if ( false !== $_REQUEST['settings-updated'] ) :
 ?>
 <div class="updated fade"><p><strong><?php _e('Updated', 'black-piano');  ?></strong></p></div>
 <?php endif; ?>

 <?php if(!empty($inekris_upload_error['message'])): ?>
  <?php if($inekris_upload_error['error']): ?>
   <div id="error" class="error"><p><?php echo $inekris_upload_error['message']; ?></p></div>
  <?php else: ?>
   <div id="message" class="updated fade"><p><?php echo $inekris_upload_error['message']; ?></p></div>
  <?php endif; ?>
 <?php endif; ?>
 
 
 <div id="my_theme_option">

<form method="post" action="options.php" enctype="multipart/form-data">
<?php
/*	Removed tab panels and logo settings
	12-05-2013
	*/
?>
<?php settings_fields( 'black_piano_options' ); ?>

 
  <div id="bp-options">

   <?php //Tab 1, general settings ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Display Setup', 'black-piano');  ?></h3>
    <div class="theme_option_input">
     <ul>
      <li><label><input id="black_piano_options[show_author]" name="black_piano_options[show_author]" type="checkbox" value="1" <?php checked( '1', $options['show_author'] ); ?> /> <?php _e('Display author name', 'black-piano');  ?></label></li>
      <li><label><input id="black_piano_options[show_category]" name="black_piano_options[show_category]" type="checkbox" value="1" <?php checked( '1', $options['show_category'] ); ?> /> <?php _e('Display category', 'black-piano');  ?></label></li>
      <li><label><input id="black_piano_options[show_tag]" name="black_piano_options[show_tag]" type="checkbox" value="1" <?php checked( '1', $options['show_tag'] ); ?> /> <?php _e('Display tags', 'black-piano');  ?></label></li>
      <li><label><input id="black_piano_options[show_date]" name="black_piano_options[show_date]" type="checkbox" value="1" <?php checked( '1', $options['show_date'] ); ?> /> <?php _e('Display date', 'black-piano');  ?></label></li>
      <li><label><input id="black_piano_options[show_post_thumb]" name="black_piano_options[show_thumb]" type="checkbox" value="1" <?php checked( '1', $options['show_thumb'] ); ?> /> <?php _e( 'Display Post Thumbnails', 'black-piano' ); ?></label></li>
      <li><label><input id="black_piano_options[show_comment]" name="black_piano_options[show_comment]" type="checkbox" value="1" <?php checked( '1', $options['show_comment'] ); ?> /> <?php _e('Display comment', 'black-piano');  ?></label></li>
      <li><label><input id="black_piano_options[show_comment_time]" name="black_piano_options[show_comment_time]" type="checkbox" value="1" <?php checked( '1', $options['show_comment_time'] ); ?> /> <?php _e('Display comment time', 'black-piano');  ?></label></li>
      <li><label><input id="black_piano_options[show_custom_fields]"  name="black_piano_options[show_custom_fields]" type="checkbox" value="1" <?php checked('1', $options['show_custom_fields'] );?>  /> <?php _e('Display custom fields','black-piano'); ?></label></li>
      
      <li><label><input id="black_piano_options[show_next_post]" name="black_piano_options[show_next_post]" type="checkbox" value="1" <?php checked( '1', $options['show_next_post'] ); ?> /> <?php _e('Display next previous post link at single page', 'black-piano');  ?></label></li>
      <li><label><input id="black_piano_options[show_bread_crumb]" name="black_piano_options[show_bread_crumb]" type="checkbox" value="1" <?php checked( '1', $options['show_bread_crumb'] ); ?> /> <?php _e('Display breadcrumb at single page', 'black-piano');  ?></label></li>
      <li><label><input id="black_piano_options[show_return_top]" name="black_piano_options[show_return_top]" type="checkbox" value="1" <?php checked( '1', $options['show_return_top'] ); ?> /> <?php _e('Display return top link  at bottom of the page', 'black-piano');  ?></label></li>
      <li><label><input id="black_piano_options[show_search]" name="black_piano_options[show_search]" type="checkbox" value="1" <?php checked( '1', $options['show_search'] ); ?> /> <?php _e('Display search form at header', 'black-piano');  ?></label></li>
      <li><label><input id="black_piano_options[show_rss]" name="black_piano_options[show_rss]" type="checkbox" value="1" <?php checked( '1', $options['show_rss'] ); ?> /> <?php _e('Display rss at header', 'black-piano');  ?></label></li>
      <li><label><input id="black_piano_options[show_my_more]" name="black_piano_options[show_my_more]" type="checkbox" value="1" <?php checked( '1', $options['show_my_more'] ); ?> /> <?php _e('Display the automatic excerpt if there is no &lt;!--more--&gt; tag in the post', 'black-piano'); ?></label></li>
      <li><label><input id="black_piano_options[show_site_desc]" name="black_piano_options[show_site_desc]" type="checkbox" value="1" <?php checked( '1', $options['show_site_desc'] ); ?> /> <?php _e('Display site description under site title', 'black-piano');  ?></label></li>
      <li><label><input id="black_piano_options[show_information_block]" name="black_piano_options[show_information_block]" type="checkbox" value="1" <?php checked( '1', $options['show_information_block'] ); ?> /> <?php _e('Display the information block below', 'black-piano'); ?></label></li>
     </ul>
    </div>
   </div>

   <?php // Side information setting -- maybe to be deleted ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Side information setting', 'black-piano');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('If this field is blank, the block won\'t show, even if you chose to show it above', 'black-piano');  ?></p>
     <div style="margin:0 0 5px 0;">
      <label style="display:inline-block; min-width:140px;"><?php _e('Title of information area', 'black-piano');  ?></label>
      <input id="black_piano_options[information_title]" class="regular-text" type="text" name="black_piano_options[information_title]" value="<?php echo esc_attr( $options['information_title'] ); ?>" />
     </div>
     <div id="poststuff" style="margin:0 0 15px 0;">
      <div id="postdivrich" class="postarea">
       <?php wp_editor(stripslashes( $options['information_contents'] ), $id = 'black_piano_options[information_contents]', $class = 'large-text' ); ?>
      </div>
     </div>
    </div>
   </div>

   <?php // Layout, 1 or 2 columns ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Layout', 'black-piano');  ?></h3>
    <div class="theme_option_input layout_option">
     <fieldset class="cf"><legend class="screen-reader-text"><span><?php _e('Layout', 'black-piano');  ?></span></legend>
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          $layout_options=layout_options();
          foreach ( $layout_options as $option ) {
          $layout_setting = $options['layout'];
           if ( '' != $layout_setting ) {
            if ( $options['layout'] == $option['value'] ) {
             $checked = "checked=\"checked\"";
            } else {
             $checked = '';
            }
           }
     ?>
      <label class="description">
       <input type="radio" name="black_piano_options[layout]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo $checked; ?> />
       <img src="<?php  echo get_template_directory_uri(); ?>/admin/<?php echo $option['img']; ?>.gif" alt="" title="" />
       <?php echo $option['label']; ?>
       </label>
       
     <?php
          }
     ?>
     </fieldset>
    </div>
   </div>
   
   <?php // Paging, restored ?>
  <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Pager type', 'black-piano');  ?></h3>
    <div class="theme_option_input pager_option">
     <fieldset class="cf"><legend class="screen-reader-text"><span><?php _e('Pager type', 'black-piano');  ?></span></legend>
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          $pager_options = bp_pager_options();
          foreach ( $pager_options as $option ) {
          $pager_setting = $options['pager'];
           if ( '' != $pager_setting ) {
            if ( $options['pager'] == $option['value'] ) {
             $checked = "checked=\"checked\"";
            } else {
             $checked = '';
            }
           }
     ?>
      <label class="description">
       <input type="radio" name="black_piano_options[pager]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php echo $checked; ?> />
       <img src="<?php echo get_template_directory_uri(); ?>/admin/<?php echo $option['img']; ?>.gif" alt="" title="" />
       <?php echo $option['label']; ?>
      </label>
     <?php
          }
     ?>
     </fieldset>
    </div>
   </div>


   <?php // facebook twitter ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('twitter and facebook setup', 'black-piano');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('When it is blank, twitter and facebook icon will not displayed on a site.', 'black-piano');  ?></p>
     <ul>
      <li>
       <label style="display:inline-block; min-width:140px;"><?php _e('your twitter URL', 'black-piano');  ?></label>
       <input id="black_piano_options[twitter_url]" class="regular-text" type="text" name="black_piano_options[twitter_url]" value="<?php echo esc_attr( $options['twitter_url'] ); ?>" />
      </li>
      <li>
       <label style="display:inline-block; min-width:140px;"><?php _e('your facebook URL', 'black-piano');  ?></label>
       <input id="black_piano_options[facebook_url]" class="regular-text" type="text" name="black_piano_options[facebook_url]" value="<?php echo esc_attr( $options['facebook_url'] ); ?>" />
      </li>
     </ul>
    </div>
   </div>

   <?php // Google custom search ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Using Google custom search', 'black-piano');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('If you want to use google custom search for your wordpress, enter your google custom search ID.<br /><a href="http://www.google.com/cse/" target="_blank">Read more about Google custom search page.</a>', 'black-piano');  ?></p>
     <label style="display:inline-block; margin:0 20px 0 0;"><?php _e('Google custom search ID', 'black-piano');  ?></label>
     <input id="black_piano_options[custom_search_id]" class="regular-text" type="text" name="black_piano_options[custom_search_id]" value="<?php echo esc_attr( $options['custom_search_id'] ); ?>" />
    </div>
   </div>
   
   <?php // This needs fixing ?>
   <div style="clear">
   <p class="submit"><input type="submit" class="button-primary" style="height: 33px; line-height: 15px;" value="<?php _e( 'Save Changes', 'black-piano' ); ?>" /></p>
	</div>
  </div><!-- END #bp-options -->

 </form>

</div>

</div>

<?php

 }


/**
 * Validate, and set default theme options
 */
function theme_options_validate( $input ) {
 global $layout_options;


 
 if ( ! isset( $input['show_author'] ) )
  $input['show_author'] = null;
  $input['show_author'] = ( $input['show_author'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_category'] ) )
  $input['show_category'] = null;
  $input['show_category'] = ( $input['show_category'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_tag'] ) )
  $input['show_tag'] = null;
  $input['show_tag'] = ( $input['show_tag'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_comment'] ) )
  $input['show_comment'] = null;
  $input['show_comment'] = ( $input['show_comment'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_comment_time'] ) )
  $input['show_comment_time'] = null;
  $input['show_comment_time'] = ( $input['show_comment_time'] == 1 ? 1 : 0 );
 
 if ( ! isset( $input['show_custom_fields'] ) )
  $input['show_custom_fields'] = null;
  $input['show_custom_fields'] = ( $input['show_custom_fields'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_date'] ) )
  $input['show_date'] = null;
  $input['show_date'] = ( $input['show_date'] == 1 ? 1 : 0 );
  
 if ( ! isset( $input['show_thumb'] ) ) 
  $input['show_thumb'] = null;
  $input['show_thumb'] = ( $input['show_thumb'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_bread_crumb'] ) )
  $input['show_bread_crumb'] = null;
  $input['show_bread_crumb'] = ( $input['show_bread_crumb'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_return_top'] ) )
  $input['show_return_top'] = null;
  $input['show_return_top'] = ( $input['show_return_top'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_next_post'] ) )
  $input['show_next_post'] = null;
  $input['show_next_post'] = ( $input['show_next_post'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_search'] ) )
  $input['show_search'] = null;
  $input['show_search'] = ( $input['show_search'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_rss'] ) )
  $input['show_rss'] = null;
  $input['show_rss'] = ( $input['show_rss'] == 1 ? 1 : 0 );
  
 if ( ! isset( $input['show_my_more'] ) )
  $input['show_my_more'] = null;
  $input['show_my_more'] = ( $input['show_my_more'] == 1 ? 1 : 0 );

 if ( ! isset( $input['show_site_desc'] ) )
  $input['show_site_desc'] = null;
  $input['show_site_desc'] = ( $input['show_site_desc'] == 1 ? 1 : 0 );
  
	if ( ! isset( $input['show_information_block'] ) )
		$input['show_information_block'] = null;
		$input['show_information_block'] = ( $input['show_information_block'] == 1 ? 1 : 0 );


 if ( ! isset( $input['layout'] ) )
  $input['layout'] = null;
 if ( ! array_key_exists( $input['layout'], layout_options() ) )
  $input['layout'] = null;

 if ( ! isset( $input['pager'] ) )
  $input['pager'] = null;
 if ( ! array_key_exists( $input['pager'], bp_pager_options() ) )
  $input['pager'] = null;

 // twitter,facebook URL
 $input['twitter_url'] = wp_filter_nohtml_kses( $input['twitter_url'] );
 $input['facebook_url'] = wp_filter_nohtml_kses( $input['facebook_url'] );


 $input['custom_search_id'] = wp_filter_nohtml_kses( $input['custom_search_id'] );


 $input['information_title'] = wp_filter_post_kses( $input['information_title'] );
 $input['information_contents'] = $input['information_contents'];
/* Removed the dp_logo thingys */
	
 return $input;
}

?>