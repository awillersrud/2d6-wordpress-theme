<?php
/*
Template Name: Default page
*/
get_header(); ?>

<div class="lys">
<div class="tds-container">
    <img class="" src="<?php bloginfo('template_directory'); ?>/img/forside/2d6-header.jpg">
</div>
</div>

<hr/>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    the_content();
endwhile; else: ?>
<p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>

<?php get_footer(); ?>
