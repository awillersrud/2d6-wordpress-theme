<?php get_header(); ?>

<div class="forside-topp-container">
    <img class="forside-skjult-bilde" src="<?php bloginfo('template_directory'); ?>/img/forside/BlodForside-1920.png">
    <img class="forside-topp-bilde" src="<?php bloginfo('template_directory'); ?>/img/forside/BlodForside-1920.png">
    <div class="tds-container">
          <span class="forside-om-tds-tekst">
              <h1>SPILLFORENINGEN 2D6</h1>
              <p>Kort om hvem vi er og hva formålet tli denne siden er. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.
                  Morbi accumsan ipsum velit. Nam nec tellus a odio tinci</p>
          </span>
    </div>
</div>

<hr/>

<div class="forside-neste-turnering">
    <div class="tds-container">
        <div class="forside-neste-turnering-label">
            <img src="<?php bloginfo('template_directory'); ?>/img/forside/NesteTurnering_Heading.png"/>
        </div>
        <img src="<?php bloginfo('template_directory'); ?>/img/forside/CrusadeDato_Logo.png"/>

        <div class="forside-neste-turnering-paamelding">
            <a class="rod-knapp"><img src="<?php bloginfo('template_directory'); ?>/img/forside/KnappPaamelding_Forside.png"/></a>
        </div>

        <div class="forside-neste-turnering-beskrivelse">
            Her står det litt om turneringen som kommer, i dette tilfellet Crusade. Antall deltagere bør være med, om det spilles med senarioer, poengsum.  Max antall bør med. This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollic itudin, lorem quis biben dum auctor, nisi elit consequat ipsum, nec
        </div>

        <div class="forside-turneringskalender">
            <div class="forside-turneringskalender-label">TURNERINGSKALENDER:</div>

            <table>
                <tr><td class="forside-turneringskalender-turneringsnavn">2D6 Crusade</td><td>Oslo</td><td class="forside-turneringskalender-dato">26-27.04.2014</td></tr>

                <tr><td class="forside-turneringskalender-separator" colspan="3" /></tr>

                <tr><td class="forside-turneringskalender-turneringsnavn">Indian Summer</td><td>Gjøvik</td><td class="forside-turneringskalender-dato">05-06.08.2014</td></tr>
                <tr><td class="forside-turneringskalender-separator" colspan="3" /></tr>
                <tr><td class="forside-turneringskalender-turneringsnavn">NM</td><td>Oslo</td><td class="forside-turneringskalender-dato">05-06.10.2014</td></tr>
                <tr><td class="forside-turneringskalender-separator" colspan="3" /></tr>
                <tr><td class="forside-turneringskalender-turneringsnavn">Dark Stormy Knights (DSK)</td><td>Bergen</td><td class="forside-turneringskalender-dato">05-06.11.2014</td></tr>
                <tr><td class="forside-turneringskalender-separator" colspan="3" /></tr>
                <tr><td class="forside-turneringskalender-turneringsnavn">2d6 Challenge</td><td>Oslo</td><td class="forside-turneringskalender-dato">16-17.11.2014</td></tr>
            </table>
        </div>

    </div>

</div>

<hr/>

<div class="forside-om-turneringer">
    <div class="tds-container">
        <img class="om-turneringer-heading" src="<?php bloginfo('template_directory'); ?>/img/forside/OmTurneringer_Heading.png"/>
        <p>Tekst om at det ikke er farlig eller skummelt å spille turneringer. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, </p>
        <div class="mer-om-container">
            <a class="mer-om-link">Mer om turneringer »</a>
        </div>
    </div>
</div>

<hr/>

<div class="forside-tds-hall-of-fame">
    <div class="tds-container">
        <img src="<?php bloginfo('template_directory'); ?>/img/hall-of-fame/HallofFame_Logo.png" alt="2d6 Hall of Fame">
        <p>I 2d6 Hall of Fame finner du alle hærene som har vunnet best painted i en av våre turneringer. Les mer om hvordan kåringene foregår, de forskjellige enhetene i hæren og teknikkene brukt.</p>
        <div class="forside-tds-hall-of-fame-teaser">

            <?php query_posts('category_name=hall-of-fame&posts_per_page=1');
            global $more;
            $more = 0;
            while (have_posts()) : the_post(); ?>

                <div class="post">
                    <div class="entry">

                        <?php
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail();
                        }
                        the_content('Les mer »');
                        ?>
                    </div>
                    <div class="clearfix" />

                </div>

                <?php endwhile; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
