<?php
/*
Template Name: Om 2d6 turneringer
*/
get_header();?>


<div class="forside-topp-container">
    <img class="header-image"
         src="<?php bloginfo('template_directory'); ?>/img/om-2d6-turneringer/OmTurnering_Toppbilde.jpg">
</div>

<hr/>

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
<?php get_footer();?>