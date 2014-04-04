<?php
/*
Template Name: 2d6 Turnering Resultater
*/
get_header();

if (have_posts()) : while (have_posts()) : the_post();

$turneringId = get_post_meta(get_the_ID(), "TurneringId", true);
$bestArmyPost = get_post_meta(get_the_ID(), "BestArmyPost", true);

$turnering = get_tournament($turneringId);
?>

<div class="morkere">
    <div class="tds-container">
        <div class="tds-padding-liten">
            <div class="container-mork-graa-med-skyer">
                <div class="tds-padding-stor">

                    <?php the_post_thumbnail(); ?>

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
                <div class="tds-padding-liten-full">
                    <div class="topp3-bilde">
                        <div class="haandskrift vinner"><span>Team Odden</span></div>
                        <div class="haandskrift vinner"><span>Vigo & friends</span></div>
                        <div class="haandskrift vinner"><span>Team TBA</span></div>
<!--                        <div class="haandskrift vinner"><span>Vigo & Tall dark and handsome</span></div>-->
                    </div>

                    <h2 class="haandskrift rode-linjer">RESULTLISTE</h2>
                    <?php display_resultater($turnering) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
endwhile; else: ?>
<p>Beklager, teknisk feil</p>
<?php endif; ?>


<?php
    if ($bestArmyPost != null) { ?>

    <div class="mork">
        <div class="tds-container">
            <div class="tds-padding-liten">
                <div class="tds-padding-stor">
                    <div class="tds-padding-liten">
                        <img class="forside-tds-hall-of-fame-logo" src="<?php bloginfo('template_directory'); ?>/img/hall-of-fame/header_image.png" alt="2d6 Hall of Fame">
                        <?php display_hall_of_fame_posts(1, $bestArmyPost, false, false) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php }
?>

<?php get_footer(); ?>

<script type="text/javascript">
    $.each($(".vinner"), resize);
</script>
