<?php get_header();

$turnering = get_featured_tournament();
?>


<div class="tds-container hvit forside-header" xmlns="http://www.w3.org/1999/html">
    <div class="tds-padding-liten tds-padding-liten-topp tds-padding-liten-bunn">
	<img class="" src="<?php bloginfo('template_directory'); ?>/img/forside/2d6-header.jpg">
	<span class="forside-om-tds-tekst">
	  <h1>Spillforeningen 2d6</h1>
	  <span>Spillforeningen 2d6 er en klubb for Warmachine/Hordes- og Kings of War-spillere i Oslo. 2d6 ønsker å skape en
	  solid ramme rundt disse figurspillene, noe vi gjør gjennom å arrangere flere årlige turneringer og gjennom klubblokalet
	  vårt i Oslo sentrum. Her på hjemmesiden vår finner du all relevant informasjon om 2d6 og om turneringene våre.</span>
    </div>
</div>

<hr/>

<div class="morkere">
    <div class="tds-container">
	<div class="tds-padding-liten">
	    <div class="container-mork-graa-med-skyer">
		<div class="tds-padding-liten-topp tds-padding-liten-bunn">
		    <div class="tds-padding-stor">
			<!--<img src="<?php bloginfo('template_directory'); ?>/img/forside/neste-turnering-overskrift.png"/>-->
			<a href="<?php echo $turnering->getUrl() ?>">
			    <img src="<?php bloginfo('template_directory'); echo $turnering->logo_path; ?>"/>
			</a>

            <?php if ($turnering->open_for_registration) { ?>
			<div class="rod-knapp-container gaa-til-paamelding">
                <a href="<?php echo $turnering->getUrl() ?>" class="rod-knapp"><img
                    src="<?php bloginfo('template_directory'); ?>/img/forside/KnappPaamelding_Forside.png"/></a>
            </div>
            <?php } ?>


			<div class="forside-neste-turnering-beskrivelse tds-padding-liten tds-padding-liten-topp tds-padding-liten-bunn">
                <?php echo $turnering->teaser_text ?>
    	    </div>

			<?php display_turneringskalender(); ?>
		    </div>
		</div>
	    </div>
	</div>
    </div>
</div>

<hr/>

<div class="lys">
    <div class="tds-container">
	<div class="tds-padding-liten">
	    <a href="om-2d6-turneringer">
	    <img class="om-turneringer-heading"
		 src="<?php bloginfo('template_directory'); ?>/img/forside/OmTurneringer_Heading.png"/>
	    </a>

	    <p>Hva er turnering, og hva er turneringsspill? Her finner dere alt dere trenger å vite om hva det vil si å delta
	    på en 2d6 turnering. Det kan dreie seg om alt fra regler og malekrav, til forklaringer på en del vanlige begreper
	    man støter på ved turneringer, m.mer. Nyttig både for veteraner og nye til turneringsspilling.</p>

	    <div class="mer-om-container">
		<a href="om-2d6-turneringer" class="mer-om-link">Mer om turneringer »</a>
	    </div>
	</div>
    </div>
</div>

<hr/>

<div class="forside-tds-hall-of-fame">
    <div class="tds-container">
	<div class="tds-padding-liten">
	<div class="tds-padding-stor">
	    <a href="<?php echo get_bloginfo('wpurl') . "/halloffame" ?>">
		<img class="forside-tds-hall-of-fame-logo" src="<?php bloginfo('template_directory'); ?>/img/hall-of-fame/header_image.png" alt="2d6 Hall of Fame">
	    </a>
	</div>
	</div>
	<div class="tds-padding-liten">
	<p>I 2d6 Hall of Fame finner du alle hærene som har vunnet «Best Army» på en av våre turneringer. Les mer om hvordan
	kåringene foregår, de forskjellige male- og base-teknikkene benyttet, forskjellige enheter og modeller i hærene og mye, mye mer!</p>
	</div>

	<?php display_hall_of_fame_posts(1, null, false, true); ?>

    </div>
</div>

<?php get_footer(); ?>

<?php

function display_turneringskalender() {
    $tournaments = get_tournaments_for_calendar();
    $len = count($tournaments)
?>
<div
    class="forside-turneringskalender tds-padding-liten tds-padding-liten-topp tds-padding-liten-bunn">
    <div class="forside-turneringskalender-label">TURNERINGSKALENDER:</div>

    <table>
        <?php foreach ($tournaments as $index=>$tournament) { ?>
        <tr>
            <td class="forside-turneringskalender-turneringsnavn">
                <?php if ($tournament->getUrl() != null) { ?>
                    <a href="<?php echo $tournament->getUrl() ?>"><?php echo $tournament->name ?></a>
                <?php } else { ?>
                    <?php echo $tournament->name ?>
                <?php } ?>
            </td>
            <td><?php echo $tournament->location ?></td>
            <td class="forside-turneringskalender-dato"><?php echo $tournament->date_string() ?></td>
        </tr>
        <?php if ($index < $len - 1) {?>
        <tr>
            <td class="forside-turneringskalender-separator" colspan="3"/>
        </tr>
        <?php }
        }
        ?>

    </table>
</div>
<?php
}
?>
