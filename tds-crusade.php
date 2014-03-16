<?php
/*
Template Name: 2d6 Crusade
*/
get_header(); ?>

<div class="morkere">
    <div class="tds-container">
        <div class="tds-padding-liten">
            <div class="container-mork-graa-med-skyer">
                <div class="tds-padding-stor">
                    <img class="" src="<?php bloginfo('template_directory'); ?>/img/crusade/Crusade2014.png">
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

<div class="lys">
    <div class="tds-container">
        <div class="tds-padding-liten">
            <div class="tds-padding-stor">

                <h2 id="paamelding" class="haandskrift rode-linjer">PÅMELDING</h2>

                <div class="morkere">
                    <div class="tds-padding-liten-full">

                    <?php paamelding() ?>

                    </div>
                </div>


                <div class="hvit">
                    <div class="tds-padding-liten">
                        <h3 class="rod-tekst">DELTAGERE OG HÆRER:</h3>

                        <div>
                            <?php tds_deltagerliste(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>


