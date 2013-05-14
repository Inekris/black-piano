<?php
      if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
       die ('Please do not load this page directly. Thanks!');
        if (function_exists('post_password_required')) {
         if ( post_password_required() ) {
          echo '<div id="comments"><div class="password-protected"><p>';_e('This post is password protected. Enter the password to view comments.','black-piano'); echo '</p></div></div>';
          return;
         };
	} else {
         if (!empty($post->post_password))  { // if there's a password
          if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie  ?>
           <div id="comments"><div class="password-protected"><p><?php _e('This post is password protected. Enter the password to view comments.','black-piano'); ?></p></div></div>
          <?php return;
          }
         }
        }
?>

<?php //custom comments function by mg12 - http://www.neoease.com/  ?>

<?php
       if (function_exists('wp_list_comments')) { $trackbacks = $comments_by_type['pings']; }
       else { $trackbacks = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_approved = '1' AND (comment_type = 'pingback' OR comment_type = 'trackback') ORDER BY comment_date", $post->ID)); }
?>

<?php if ($comments || comments_open()) ://if there is comment and comment is open ?>

<br /><div id="comment-header" class="cf">

 <h3 class="comment-headline"><?php _e('Comment', 'black-piano'); ?></h3>

 <ul id="comment-header-right">
<?php if(pings_open()) ://if trackback is open ?>
   <li id="trackback_switch"><a href="javascript:void(0);"><?php _e('Trackback','black-piano'); ?><?php echo (' ( ' . count($trackbacks) . ' )'); ?></a></li>
   <li id="comment_switch" class="comment-switch-active"><a href="javascript:void(0);"><?php _e('Comments','black-piano'); ?><?php echo (' ( ' . (count($comments)-count($trackbacks)) . ' )'); ?></a></li>
<?php else ://if comment is closed,show onky number ?>
   <li id="trackback-closed"><?php _e('Trackback are closed','black-piano'); ?></li>
   <li id="comment-closed"><?php _e('Comments', 'black-piano'); echo (' (' . (count($comments)-count($trackbacks)) . ')'); ?></li>
<?php endif; ?>
 </ul>

<?php if(pings_open()) ://if trackback is open ?>

<?php endif; ?>

</div><!-- END #comment-header -->

<div id="comments">

 <div id="comment-area">
  <!-- start commnet -->
  <ol class="commentlist">
	<?php
		if ($comments && count($comments) - count($trackbacks) > 0) {
			// for WordPress 2.7 or higher
			if (function_exists('wp_list_comments')) {
				wp_list_comments('type=comment&callback=custom_comments');
			// for WordPress 2.6.3 or lower
			} else {
				foreach ($comments as $comment) {
					if($comment->comment_type != 'pingback' && $comment->comment_type != 'trackback') {
						custom_comments($comment, null, null);
					}
				}
			}
		} else {
	?>
    <li class="comment">
     <div class="comment-content"><p><?php _e('No comments yet.','black-piano'); ?></p></div>
    </li>
	<?php
		}
	?>
  </ol>
  <!-- comments END -->

  <?php
        if (get_option('page_comments')) { $comment_pages = paginate_comments_links('echo=0');
        if ($comment_pages) {
  ?>

  <div id="comment-pager" class="cf">
   <?php echo $comment_pages; ?>
  </div>

  <?php }} // END comment pages ?>

 </div><!-- #comment-list END -->


 <div id="trackback-area">
 <!-- start trackback -->
 <?php if (pings_open()) ://id trackback is open ?>

  <div id="trackback-url-area">
   <label for="trackback_url"><?php _e('TRACKBACK URL' , 'black-piano'); ?></label>
   <input type="text" name="trackback_url" id="trackback_url" size="60" value="<?php trackback_url() ?>" readonly="readonly" onfocus="this.select()" />
  </div>

  <ol class="commentlist">
   <?php if ($trackbacks) : $trackbackcount = 0; ?>
   <?php foreach ($trackbacks as $comment) : ?>
   <li class="comment">
    <div class="trackback-time">
     <?php echo get_comment_time(__('M jS. Y', 'black-piano')) ?>
     <?php edit_comment_link(__('[ EDIT ]', 'black-piano'), '', ''); ?>
    </div>
    <div class="trackback-title">
     <?php _e('Trackback from : ' , 'black-piano'); ?><a href="<?php comment_author_url() ?>"><?php comment_author(); ?></a>
    </div>
   </li>
   <?php endforeach; ?>
   <?php else : ?>
   <li class="comment"><div class="comment-content"><p><?php _e('No trackbacks yet.','black-piano'); ?></p></div></li>
   <?php endif; ?>
  </ol>

 <?php endif; ?>
 <!-- trackback end -->
 </div><!-- #trackbacklist END -->

 <?php else : // if comment is close ?>

  <div id="comments">

 <?php endif; // END comment is open ?>



 <?php if (!comments_open()) : // if comment are closed and don't have any comments ?>

  <div class="comment-closed" id="respond">
   <?php _e('Comment are closed.','black-piano'); ?>
  </div>

 <?php elseif ( get_option('comment_registration') && !$user_ID ) : // If registration required and not logged in. ?>

 <div class="comment-form-wrapper" id="respond">
  <?php if (function_exists('wp_login_url')) 
        { $login_link = wp_login_url();  }
        else 
        { $login_link = get_site_url() . '/wp-login.php?redirect_to=' . urlencode(get_permalink()); }
  ?>
  <?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'black-piano'), $login_link); ?>
 </div>

 <?php else ://if comment is open ?>

 <fieldset class="comment-form-wrapper" id="respond">

  <?php if (function_exists('comment_reply_link')) { ?>
  <div id="cancel-comment-reply"><?php cancel-comment-reply_link() ?></div>
  <?php } ?>

  <form action="<?php echo esc_url(site_url('/')); ?>wp-comments-post.php" method="post" id="commentform">

   <?php if ( $user_ID ) : ?>

   <div id="comment-user-login">
    <p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.', 'black-piano'), get_site_url() . '/wp-admin/profile.php', $user_identity); ?><span><a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'black-piano'); ?>"><?php _e('[ Log out ]', 'black-piano'); ?></a></span></p>
   </div><!-- #comment-user-login END -->

   <?php else : ?>

   <div id="guest-info">
    <div id="guest_name"><label for="author"><span><?php _e('NAME','black-piano'); ?></span><?php if ($req) _e('( required )', 'black-piano'); ?></label><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /></div>
    <div id="guest_email"><label for="email"><span><?php _e('E-MAIL','black-piano'); ?></span><?php if ($req) _e('( required )', 'black-piano'); ?> <?php _e('- will not be published -','black-piano'); ?></label><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /></div>
    <div id="guest_url"><label for="url"><span><?php _e('URL','black-piano'); ?></span></label><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /></div>
    <?php if ( function_exists('cs_print_smilies') ) { echo '<div id="custom_smilies">'; cs_print_smilies(); echo "</div>\n"; } ?>
   </div>

   <?php endif; ?>

   <div id="comment-textarea">
    <textarea name="comment" id="comment" cols="50" rows="10" tabindex="4"></textarea>
   </div>

   <div id="submit-comment-wrapper">
    <?php do_action('comment_form', $post->ID); ?>
    <input name="submit" type="submit" id="submit-comment" tabindex="5" value="<?php _e('Submit Comment', 'black-piano'); ?>" title="<?php _e('Submit Comment', 'black-piano'); ?>" alt="<?php _e('Submit Comment', 'black-piano'); ?>" />
   </div>
   <div id="input-hidden-field">
    <?php if (function_exists('comment_id_fields')) { ?>
    <?php comment_id_fields(); ?>
    <?php } else { ?>
    <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
    <?php } ?>
   </div>

  </form>

 </fieldset><!-- #comment-form-area END -->

<?php endif; ?>
</div><!-- #comment end -->