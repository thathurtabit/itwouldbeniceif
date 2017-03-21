<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);





add_action('comment_post_redirect', __NAMESPACE__ .  '\\wpsites_redirect_after_comment');
/**
 * @author    Brad Dalton
 * @example   http://wpsites.net/wordpress-admin/redirect-comment-authors-to-a-thank-you-landing-page/
 * @copyright 2014 WP Sites
 */
function wpsites_redirect_after_comment() {
wp_safe_redirect('thank-you');
      exit();
}





// Make sure you can add query variables to the URL
// http://www.rlmseo.com/blog/passing-get-query-string-parameters-in-wordpress-url/

function add_custom_query_var( $vars ){
  $vars[] = "q";
  return $vars;
}
add_filter( 'query_vars', 'add_custom_query_var');




// Custom functions
// ADDED FROM ORIGINGAL QWOTA


// remove HTML from comments
  add_filter('comment_text', __NAMESPACE__ .  '\\wp_filter_nohtml_kses');
  add_filter('comment_text_rss', __NAMESPACE__ .  '\\wp_filter_nohtml_kses');
  add_filter('comment_excerpt', __NAMESPACE__ .  '\\wp_filter_nohtml_kses');
    
  
  // My custom Qwtoa - Comment Forms - http://ottopress.com/2010/wordpress-3-0-theme-tip-the-comment-form/comment-page-2/#comment-5302
  
  function qwota_comment_form($form_options) {
    
    
    // Fields Array
    $fields = array(
    
      'wrap-start' =>
      '<div class="comment-form row">',
      
      'author' =>
        '<div class="form-comment-author col-lg-6">' .
        '<p class="">' .
        '<label for="author">' . __( 'Your name' ) . '<span class="caveat">*</span></label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="author" class="validate" data-validation="required" data-validation-length="max50" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . $aria_req . '" required>' .
        '</p>' .
        '<p class="input-info"><i class="fa fa-info-circle"></i> Just put \'Anonymous\' if you\'re shy.</p>'.
        '</div>',
        
      'email' =>
        '<div class="form-comment-email col-lg-6">' .
        '<p class="">' .
        '<label for="email">' . __( 'Your email' ) . '<span class="caveat">*</span></label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="email" class="validate" data-validation="required email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . $aria_req . '" required>' .
        '</p>' .
        '<p class="input-info"><i class="fa fa-info-circle"></i> Only used for Gravatar &amp; spam busting</p>'.
        '</div>',
        
        
      'wrap-end' =>
      '</div>',
      
      
    );

    // Form Options Array
    $form_options = array(
      
      // Template Options
      'comment_field' =>
      '<div id="comment-wrap" class="comment-form row">' .
      '<p class="comment-input col-lg-12">' .
     
            '<textarea id="comment" class="comment-enter" name="comment" data-validation="required" data-validation-length="1-80" data-validation="alphanumeric" data-validation-allowing="-_.!?" cols="" rows="" aria-required="true" placeholder="It would be nice if..." autocomplete="off" required></textarea>' .                         
      '</p>' .
      '<p class="input-info" id="maxlength-p">' .
      '<span id="maxlength">80</span> characters left'  .
      '</p>' .
      '</div>',
      
      // Include Fields Array
      'fields' => apply_filters( 'comment_form_default_fields', $fields ),
      
      'must_log_in' =>
      '<p class="must-log-in">' .
      sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
      wp_login_url( apply_filters( 'the_permalink', get_permalink($post_id) ) ) ) .
      '</p>',
      
      'logged_in_as' =>
      '<p class="logged-in-as">' .
      sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
      admin_url('profile.php'), $user_identity, wp_logout_url( apply_filters('the_permalink', get_permalink($post_id)) ) ) .
      '</p>',
      
      'comment_notes_before' =>
      '<button class="btn quote-form-open-close add-quote__close"><span class="sr-only">Close</span><span class="fa fa-times"></span></button>'
      ,
      
      'comment_notes_after' =>
      '',
            
      // Rest of Options
      'id_form' => 'form-comment',
      'class_form' => 'comment-form-wrap',
      'id_submit' => 'submit',
      'title_reply' => __( 'It would be nice if...' ),
      'label_submit' => __( 'Add' ),
    );

  return $form_options;
  } add_filter('comment_form_defaults', __NAMESPACE__ .  '\\qwota_comment_form');

    

  /**
 * Qwota Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyten_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * 
 */
function iwbni_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case '' :
  ?>



<li id="suggestion-<?php comment_ID(); ?>" class="suggestion">

  <div class="suggestion-inner">

     <?php get_template_part('templates/content', 'suggestion-text'); ?>

  </div>
</li>
<?php
      break;
    case 'pingback'  :
    case 'trackback' :

      break;
    endswitch;
}
