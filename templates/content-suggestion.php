<?php


global $wpdb;


// http://www.pontikis.net/blog/jquery-ui-autocomplete-step-by-step
// get what user typed in autocomplete input
$my_q = get_query_var( 'q' );
$q = trim($_GET['q']);
 
 
// SECURITY HOLE ***************************************************************
// make sur we're only accepting number queries
if( ! preg_match('/^\d+$/', $q)) {
  
  echo '<h3>Sorry dude, that\'s not a valid query.</h3>';
  exit;
}
// *****************************************************************************


$args = array(
   // args here
	'post_id' => 7
);

// The Query
$comments_query = new WP_Comment_Query;
$comments = $comments_query->query( $args );
$comment = get_comment( intval( $q ) );
?>

<div class="suggestion">
	<div class="suggestion-inner">
		<?php get_template_part('templates/content', 'suggestion-text'); ?>
	</div>
</div>
