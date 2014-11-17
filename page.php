<?php
/*
Template Name: Default page
*/
get_header(); ?>


<hr/>

<div class="lys">

<div class="tds-container">
<div class="tds-padding-liten">
<div class="tds-padding-stor">
<div class="tds-padding-liten">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    the_content();
endwhile; else: ?>
<p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>

</div>
</div>
</div>
</div>
</div>
<?php get_footer(); ?>
