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


                <h2 class="label">PÅMELDING</h2>

                <div class="morkere">
                    <div class="tds-padding-liten-full">

                        <span>Fyll ut feltene under for å melde deg på til 2d6 Crusade 2014. Kanskje noe mer tekst, skal det være bindende på melding. Bør aldersgrensen nevnes her.</span>

                        <form action="<?php echo get_bloginfo('wpurl') . "/paamelding" ?>" method="POST">
                            <p>
                                <label for="first_name">Fornavn*:<br />
                                    <input type="text" name="first_name" id="first_name" class="text" value="" /></label>
                            </p>
                            <p>
                                <label for="last_name">Etternavn*:<br />
                                    <input type="text" name="last_name" id="last_name" class="text" value="" /></label>
                            </p>
                            <p>
                                <label for="email">Epost*:<br />
                                    <input type="text" name="email" id="email" class="text" value="" size="25" /></label>
                            </p>
                            <p>
                                <span>Kryss av for hvilken hær du skal spille*:</span>
                            </p>

                            <div>
                            <?php
                                tds_army_checkbox("Beastmen");
                                tds_army_checkbox("Bretonnia");
                                tds_army_checkbox("Daemons of Chaos");
                                tds_army_checkbox("Dark Elves");
                                tds_army_checkbox("Dwarfs");
                                tds_army_checkbox("Dogs of War");
                                tds_army_checkbox("High Elves");
                                tds_army_checkbox("Lizardmen");
                                tds_army_checkbox("Ogre Kingdoms");
                                tds_army_checkbox("Orcs & Goblins");
                                tds_army_checkbox("Skaven");
                                tds_army_checkbox("Chaos Dwarfs");
                                tds_army_checkbox("The Empire");
                                tds_army_checkbox("Tomb Kings");
                                tds_army_checkbox("Vampire Counts");
                                tds_army_checkbox("Warriors of Chaos");
                                tds_army_checkbox("Vet ikke");
                                ?>

                            </div>

                            <div class="clearfix"></div>


                            <div class="tds-padding-liten-full rod-knapp-container">
                                <a href="<?php echo get_bloginfo('wpurl') . "/2d6-crusade" ?>" class="rod-knapp"><img
                                    src="<?php bloginfo('template_directory'); ?>/img/forside/KnappPaamelding_Forside.png"/></a>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>


