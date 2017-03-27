<nav class="navbar fixed-top">
    <div class="navbar-brand"><?php bloginfo('name'); ?>...<span class="sr-only"><?php bloginfo('description'); ?></span></div>
    <nav class="navbar-nav">
      <?php if(!is_front_page()) { ?>
        <a href="<?php bloginfo('url'); ?>" class="nav-link" data-animation="false" data-toggle="tooltip" data-placement="right" title="Back to view more"><i class="fa fa-arrow-left"></i></a>
      <?php } ?>
    </nav>
</nav>
