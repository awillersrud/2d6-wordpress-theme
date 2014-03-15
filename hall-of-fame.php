<?php
/*
Template Name: Hall of fame
*/
get_header();

$header_image_url = get_bloginfo('template_directory') . "/img/hall-of-fame/header_image.png";

?>

<div class="forside-topp-container lys">
    <div class="tds-container">
    <div class="tds-padding-liten">
        <div class="tds-padding-stor tds-padding-liten-topp tds-padding-liten-bunn">
            <img class="header-image" src="<?php echo $header_image_url ?>">
        </div>
    </div>
    </div>
</div>

<hr/>

<div class="mork">
    <div class="tds-container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
        the_content();
    endwhile; else: ?>
        <p>Sorry, no posts matched your criteria.</p>
        <?php endif; ?>


<!--        <p>I 2d6 Hall of Fame finner du de hærene som har vunnet «Best Army» på en av 2d6 sine turneringer. Mange hærer holder et høyt nivå, men det er ikke dermed sagt at man må være verdens beste maler for å vinne. Ofte kan en godt gjennomført hær også hevde seg da alt fra baser til konverteringer til sammen kan danne et veldig godt helhetsinntrykk.-->
<!---->
<!--            Vinneren av «Best Army» kåres av turneringens deltagere ved hemmelig avstemning ogannonseres ved turneringens slutt. De nominerte plukkes ut av turneringens arrangører. En hær kan i utgangspunktet bare vinne «Best Army» to ganger. Dette for å sikre en rotasjon av vinnere og skape motivasjon for å legge det lille ekstra i hæren, slik at kanskje din hær en dag får plass på denne eksklusive siden.-->
<!--        </p>-->
    </div>
</div>

<div class="lys">
    <div class="tds-container">
        <h2 class="label">Vinnere «BEST ARMY»</h2>
        <?php display_hall_of_fame_posts(10); ?>
    </div>
</div>
<?php get_footer();?>
