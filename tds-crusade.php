<?php
/*
Template Name: 2d6 Crusade
*/

get_header();

if (have_posts()) : while (have_posts()) : the_post();

    $turneringId = get_post_meta(get_the_ID(), "TurneringId", true);
    $turnering = get_tournament($turneringId);
    ?>

<div class="morkere">
    <div class="tds-container">
        <div class="tds-padding-liten">
            <div class="container-mork-graa-med-skyer">
                <div class="tds-padding-stor">
                    <div class="tds-padding-liten-full">

                        <?php the_post_thumbnail(); ?>

                    </div>
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
		<div class="tds-padding-liten">
		    <?php the_content(); ?>
		</div>
	    </div>
	</div>
    </div>
</div>

<hr/>

<div class="lys">
    <div class="tds-container">
	<div class="tds-padding-liten">
	    <div class="tds-padding-stor">
		<div class="hvit">
		    <div class="tds-padding-liten">
			<h3 class="rod-tekst">DELTAGERE:</h3>

			<div>
			    <?php tds_deltagerliste($turnering); ?>
			</div>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>

<?php get_footer(); ?>

<?php
endwhile; else: ?>
<p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>

