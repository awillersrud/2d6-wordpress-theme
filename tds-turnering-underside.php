<?php
/*
Template Name: Turnering underside
*/
    get_header();

if (have_posts()) : while (have_posts()) : the_post();

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

<?php get_footer(); ?>

<?php
endwhile; else: ?>
<p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>


