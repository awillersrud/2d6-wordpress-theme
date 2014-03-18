<?php
/*
Template Name: Turnering underside
*/
get_header(); ?>

<div class="morkere">
    <div class="tds-container">
	<div class="tds-padding-liten">
	    <div class="container-mork-graa-med-skyer">
		<div class="tds-padding-stor">
		    <img class="" src="<?php bloginfo('template_directory'); ?>/img/crusade/CrusadeRegelPakke.png">
		</div>
	    </div>
	</div>
    </div>
</div>

<hr/>

<div class="mork">
    <div class="tds-container">
	<div class="tds-padding-liten">
	    <div class="tds-padding-stor">
		<?php if (have_posts()) : while (have_posts()) : the_post();
		the_content();
	    endwhile; else: ?>
		<p>Sorry, no posts matched your criteria.</p>
		<?php endif; ?>
	    </div>
	</div>
    </div>
</div>

<hr/>

<?php get_footer(); ?>

