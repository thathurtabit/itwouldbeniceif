 <!--SUGGESTION-->
  <h2 class="suggestion-text">
    <blockquote>
    
	    	<?php comment_text(); ?>

    </blockquote>
  </h2>
  <!--/SUGGESTION--> 

  <!-- AWAITING APPROVAL -->
    <?php if ( $comment->comment_approved == '0' ) : ?>
    <div class="suggestion-moderation">
      <p class="suggestion-awaiting-moderation">
        <?php _e( 'Thank you for your suggestion!<br /> It is awaiting approval.'); ?>
      </p>
    </div>
    <?php endif; ?>
    <!-- / AWAITING APPROVAL -->

    

  <!--SUGGESTION CONTRIBUTOR-->
    <div class="suggestion-contributor-wrap vcard">
		<div class="suggestion-contributor"  data-animation="false" data-toggle="tooltip" data-placement="top" title="<?php $d = "D, M jS, Y";
	      $comment_date = get_comment_date( $d, $comment_ID );
	      echo $comment_date; ?>">
			<!-- <span class="added-by">Added by:</span> -->
	       <?php echo get_avatar( $comment, 12 ); ?> 
	      <?php if(!get_comment_author_url()) : ?>
	      <?php comment_author(); ?>
	      <?php else : ?>
	      <a href="<?php comment_author_url(); ?>" target="_blank" title="Visit <?php comment_author(); ?>'s website.">
	      <?php comment_author(); ?>
	      </a>
      	  <?php endif; ?>
      	</div>

      	<div class="suggestion-meta">
	      
	      <?php
	        // Set params for generating link
	        $my_comment_id = get_comment_ID();
	        $params = array('q' => $my_comment_id);
	      ?>
	      <div class="suggestion-link">
	      	<span class="fa fa-link"></span> 
	      	<a href="<?php echo add_query_arg( $params, site_url( '/s')); ?>" title="Link to this suggestion" class="btn-slide"><?php echo add_query_arg( $params, site_url( '/s')); ?></a>
	      </div>

	      

	  </div>
                
    </div>
    <!--/SUGGESTION CONTRIBUTOR-->



    