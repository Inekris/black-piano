<?php

// Changed to load_theme_textdomain 25-04-2013

//function my_theme_setup() {
 load_theme_textdomain('black-piano', get_template_directory().'/languages' );
// }
//add_action( 'after_setup_theme', 'my_theme_setup' );*/
//load_textdomain('black-piano', dirname(__FILE__).'/languages/' . get_locale() . '.mo');

// テーマオプション
require_once ( get_stylesheet_directory() . '/admin/theme-options.php' );


//ロゴ画像用関数
get_template_part('functions/header-logo');


// スタイルシートの読み込み
add_action('admin_print_styles', 'my_admin_CSS');

function my_admin_CSS() {
 wp_enqueue_style('myAdminCSS', get_bloginfo('stylesheet_directory').'/admin/my_admin.css');
};


// ページナビ用
function show_posts_nav() {
global $wp_query;
return ($wp_query->max_num_pages > 1);
};


// カスタムメニューの設定
if(function_exists('register_nav_menu')) {
 register_nav_menu( 'header-menu', __( 'Header menu', 'black-piano' ) );
}



// Sidebar widget
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'before_widget' => '<div class="side_box %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_title">',
        'after_title' => "</h3>\n",
        'name' => __('Side top', 'black-piano'),
        'id' => 'top'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="side_box_short %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_title">',
        'after_title' => "</h3>\n",
        'name' => __('Side middle left', 'black-piano'),
        'id' => 'left'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="side_box_short %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_title">',
        'after_title' => "</h3>\n",
        'name' => __('Side middle right', 'black-piano'),
        'id' => 'right'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="side_box %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_title">',
        'after_title' => "</h3>\n",
        'name' => __('Side bottom', 'black-piano'),
        'id' => 'bottom'
    ));
}

// Original custom comments function is written by mg12 - http://www.neoease.com/

if (function_exists('wp_list_comments')) {
	// comment count
	add_filter('get_comments_number', 'comment_count', 0);
	function comment_count( $commentcount ) {
		global $id;
		$_commnets = get_comments('post_id=' . $id);
		$comments_by_type = &separate_comments($_commnets);
		return count($comments_by_type['comment']);
	}
}


function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}
?>

 <li class="comment <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-comment';} else {echo 'guest-comment';} ?>" id="comment-<?php comment_ID() ?>">
  <div class="comment-meta">
   <div class="comment-meta-left">
  <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 35); } ?>
  
    <ul class="comment-name-date">
     <li class="comment-name">
<?php if (get_comment_author_url()) : ?>
<a id="commentauthor-<?php comment_ID() ?>" class="url <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-url';} else {echo 'guest-url';} ?>" href="<?php comment_author_url() ?>" rel="external nofollow">
<?php else : ?>
<span id="commentauthor-<?php comment_ID() ?>">
<?php endif; ?>

<?php comment_author(); ?>

<?php if(get_comment_author_url()) : ?>
</a>
<?php else : ?>
</span>
<?php endif; $options = get_black_piano_option(); ?>
     </li>
     <li class="comment-date"><?php echo get_comment_time(__('M jS. Y', 'black-piano')); if ($options['show_comment_time']) : echo get_comment_time(__(' g:ia', 'black-piano')); endif; ?></li>
    </ul>
   </div>

   <ul class="comment-act">
<?php if (function_exists('comment_reply_link')) { 
        if ( get_option('thread_comments') == '1' ) { ?>
    <li class="comment-reply"><?php comment_reply_link(array_merge( $args, array('add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<span><span>'.__('REPLY','black-piano').'</span></span>'))) ?></li>
<?php   } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'black-piano'); ?></a></li>
<?php   }
      } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'black-piano'); ?></a></li>
<?php } ?>
    <li class="comment-quote"><a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'comment');"><?php _e('QUOTE', 'black-piano'); ?></a></li>
    <?php edit_comment_link(__('EDIT', 'black-piano'), '<li class="comment-edit">', '</li>'); ?>
   </ul>

  </div>
  <div class="comment-content post_content" id="comment-content-<?php comment_ID() ?>">
  <?php if ($comment->comment_approved == '0') : ?>
   <span class="comment-note"><?php _e('Your comment is awaiting moderation.', 'black-piano'); ?></span>
  <?php endif; ?>
  <?php comment_text(); ?>
  </div>

<?php } 

// Excerpt extra's
function check_for_more($content,$permalink,$bp_id) {
	$str_2_check=$permalink."#more-".$bp_id;
	return strstr($content,$str_2_check);
	}

function check_excerpt_length($excerpt, $content) {
	$same=(strlen($excerpt)) == ( strlen( $content) );
	return $same;
	}

function new_excerpt_more( $more ) {
	return ' <p><a class="more-link" href="'. get_permalink( get_the_ID() ) . '">'. __('Read more','black-piano').'</a></p>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

//add_filter( 'the_content','check_for_more',100);

function bp_show_copyright_info() {
	$retval =  '<ul id="copyrights">';
    $retval .= '<li>' . __('Copyright &copy;&nbsp;', 'black-piano')  . ' '. '<a href="' . esc_url(home_url('/')) . '">'. ax_first_post_date("Y"). ' -	 '. date("Y"). ' ' . get_bloginfo('name') . '</a></li>';
	$retval .= '<li>' . __('Theme designed by <a href="http://inekris.xs4all.nl/" class="target_blank">Inekris</a>','black-piano') . '</li>';
	$retval .= '<li>' . __('Powered by <a href="http://wordpress.org/" class="target_blank">WordPress</a>','black-piano') . '</li>';
	$retval .= '</ul>';
	echo $retval;
}

function ax_first_post_date($format = "Y-m-d") {
 // Setup get_posts arguments
 $ax_args = array(
 'numberposts' => -1,
 'post_status' => 'publish',
 'order' => 'ASC'
 );
 // Get all posts in order of first to last
 $ax_get_all = get_posts($ax_args);
 // Extract first post from array
 $ax_first_post = $ax_get_all[0];
 // Assign first post date to var
 $ax_first_post_date = $ax_first_post->post_date;
 // return date in required format
 $output = date($format, strtotime($ax_first_post_date));
 return $output;
}

/*	Added filter body_class, as per WP requirements 
	11-05-2013
*/

add_filter('body_class', 'bp_body_class');
function bp_body_class($classes) {
	$options = get_black_piano_option();
	if(is_page_template('page-noside.php')||is_page_template('page-noside-nocomment.php')||$options['layout'] == 'noside') 
			$classes[] = 'no_side';
		if (!$options['show_category'] and !$options['show_tag'] and !$options['show_comment']) 
			$classes[] = 'no_postmeta';
		if (!$options['show_date'] and !$options['show_author']) 
			$classes[] = 'no_postinfo' ;
		return $classes;
	}			
	
/*	Added content width, as per WP requirements
	12-05-2013
*/

function bp_content_width() {
	global $content_width;
	$options = get_black_piano_option();
	if ( 'right' == $options['layout'] ) {
		$content_width = 582;
		}
	else {
		$content_width = 922;
		}
	return $content_width;
}
add_action( 'template_redirect', 'bp_content_width' );

/*
	Fill the content form
	13-05-2013
*/
function bp_comment_form() {
	global $user_identity;
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	get_currentuserinfo();
	$sets = array(
		'id_form'				=>	'commentform',
		'id_submit'				=>	'submit_comment',
		'title_reply'			=>	__( 'Write Comment', 'black-piano' ),
		'title_reply_to'		=>	__( 'Write a Comment to %s', 'black-piano' ),
		'cancel_reply_link' 	=>	__( 'Cancel Reply', 'black-piano'  ),
		'label_submit'			=>	__( 'Submit Comment', 'black-piano' ),
		'comment_field'			=> '<div id="comment_textarea"><textarea name="comment" id="comment" cols="50" rows="10" tabindex="4" ></textarea></div>',
		'must_log_in' 			=>	'',
		'logged_in_as' 			=> 	'<div id="comment_user_login"><p>' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>.', 'black-piano'), get_site_url() . '/wp-admin/profile.php', $user_identity) . '<span><a href="' .  wp_logout_url(get_permalink()) . '" title="' . __('Log out of this account', 'black-piano') . '">' . __('[ Log out ]', 'black-piano') . '</a></span></p></div><!-- #comment-user-login END -->',
		'comment_notes_before'	=>	'',
		'comment_notes_after' 	=>	'',
		'fields' 				=>	apply_filters( 'comment_form_default_fields', array(
									'author'	=> '<div id="guest_info"><div id="guest_name"><label for="author"><span>' . __('NAME','black-piano') . '</span>' .  ( $req ? __( '( required )', 'black-piano' ) : '' ) . '</label><input type="text" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) .'" size="22" tabindex="1"' . $aria_req . ' /></div>',
									'email'		=>	'<div id="guest_email"><label for="email"><span>' . __( 'E-MAIL','black-piano' ) . '</span>' . ( $req ? __( '( required )', 'black-piano' ) : '' ) . ' ' . __( '- will not be published -','black-piano' ) . '</label><input type="text" name="email" id="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="22" tabindex="2"' . $aria_req . ' /></div>',
									'url'		=>	'<div id="guest_url"><label for="url"><span>' . __( 'URL', 'black-piano' ) . '</span></label><input type="text" name="url" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . ' size="22" tabindex="3" /></div></div>') )
				 );
	return $sets;
}
?>