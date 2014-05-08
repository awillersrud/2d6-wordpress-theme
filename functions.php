<?php

add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );
add_theme_support( 'post-thumbnails' );

function display_hall_of_fame_posts($number_of_posts = 10, $post_id = null, $full_post = false, $hall_of_fame_link = false) {
    rewind_posts();
    if ($post_id != null) {
        query_posts('category_name=hall-of-fame&posts_per_page=5&p=' . $post_id);
    } else {
        query_posts('category_name=hall-of-fame&posts_per_page=' . $number_of_posts);
    }
    while (have_posts()) : the_post();
    display_hall_of_fame_post($full_post, $hall_of_fame_link);
    endwhile;
}

function display_hall_of_fame_post($full_post = false, $hall_of_fame_link = false) {
?>
<div class="tds-hall-of-fame-post tds-padding-liten-full">

    <?php
    if ($full_post) {
        the_content('', true, '');
    } else {
        if (has_post_thumbnail() ) {
            the_post_thumbnail();
        }
        global $more;
        $more = 0;
        the_content('Les mer »');
        if ($hall_of_fame_link) {?>
            <a class="hoyre" href="<?php echo get_bloginfo('wpurl') . "/halloffame"?>">Til Hall of Fame »</a>
            <?php
        }
    }
    ?>
    <div class="clearfix" ></div>
</div>
<?php
}

function paamelding($turnering) {
    $http_post = ('POST' == $_SERVER['REQUEST_METHOD']);

    if ( ! $http_post ) {
        if (is_user_logged_in() && er_paameldt(wp_get_current_user()->ID, $turnering->id)) { ?>
        <p><b>Du er allerede påmeldt!</b> Husk at påmelding er bindende, hvis du allikevel ikke kan delta setter vi pris på
            å få beskjed på forhånd slik at vi kan beregne paringen best mulig. Send en mail til
            <a href="mailto:turnering@spillforeningen2d6.no">turnering@spillforeningen2d6.no</a> for avmelding.</p>

        <?php
        } else {
            display_paameldingskjema($turnering);
        }
    } else {

        if (is_user_logged_in()) {

            if (!isset($_POST['haer'])) {
                $errors = new WP_Error();
                $errors->add('haer_error', '<span class="feilmelding">Hær er påkrevd</span><br />');
                display_paameldingskjema($turnering, $errors);
            } else {
                $haer = $_POST['haer'];
                $user = wp_get_current_user();
                insert_player($user->first_name, $user->last_name, $user->user_email, $haer, $user->ID, $turnering->id);
                bekreft_paamelding($user->user_email);
            }

        } else {

            registrer_paamelding_uten_bruker($turnering);
        }
    }
}

function registrer_paamelding_uten_bruker($turnering)
{
    $errors = new WP_Error();

    $fornavn = $_POST['first_name'];
    $etternavn = $_POST['last_name'];
    $epost = $_POST['email'];
    $brukernavn = $_POST['user_login'];
    $haer = null;

    if (empty($fornavn))
        $errors->add('first_name_error', '<span class="feilmelding">Fornavn er påkrevd</span><br />');
    if (empty ($etternavn))
        $errors->add('last_name_error', '<span class="feilmelding">Etternavn er påkrevd</span><br />');

    if (empty($epost)) {
        $errors->add('email_error', __('<span class="feilmelding">Epost er påkrevd</span><br />'));
    } elseif (!is_email($epost)) {
        $errors->add('email_error', __('<span class="feilmelding">Epost adressen er ikke korrekt</span><br />'));
        $epost = '';
    } elseif (email_exists($epost)) {
        $errors->add('email_error', __('<span class="feilmelding">Epost adressen er allerede registrert</span><br />'));
    }

    if (!isset($_POST['haer'])) {
        $errors->add('haer_error', '<span class="feilmelding">Hær er påkrevd</span><br />');
    } else {
        $haer = $_POST['haer'];
    }


    if (empty ($errors->errors)) {

        $ny_bruker_id = null;
        if (!empty($_POST['user_login'])) {
            $errors = register_new_user($brukernavn, $epost);
            if (!is_wp_error($errors)) {
                $ny_bruker_id = get_user_by('email', $epost)->ID;
                insert_player($fornavn, $etternavn, $epost, $haer, $ny_bruker_id, $turnering->id);

                bekreft_paamelding($epost, $ny_bruker_id);
            } else {
                display_paameldingskjema($turnering, $errors, $fornavn, $etternavn, $epost, $brukernavn, $haer);
            }
        } else {
            insert_player($fornavn, $etternavn, $epost, $haer, $ny_bruker_id, $turnering->id);

            bekreft_paamelding($epost, $ny_bruker_id);
        }

    } else {
        display_paameldingskjema($turnering, $errors, $fornavn, $etternavn, $epost, $brukernavn, $haer);
    }
}

function bekreft_paamelding($epost, $ny_bruker_id = null) {
    ?>

    <h3>Takk, din påmelding er registrert</h3>

    <?php if ($ny_bruker_id != null) { ?>
        <p>Epost med passord til din nye bruker på spillforeningen2d6.no er sendt til <?php echo $epost ?></p>
    <?php }
}

function display_paameldingskjema($turnering, WP_Error $errors = null, $first_name = null, $last_name = null, $email = null, $username = null, $haer = null) {

    $errors = $errors == null ? new WP_Error() : $errors;
    ?>
        <form action="#paamelding" method="POST">
            <span>Fyll ut feltene under for å melde deg på til <?php echo $turnering->name ?>. Påmelding til
                <?php echo $turnering->name ?> er bindende. Hvis du allikevel finner ut at du ikke får deltatt etter at
                du er påmeldt, gi beskjed til turnering@spillforeningen2d6.no. Aldersgrense for å delta er 16 år.</span>

            <?php if (is_user_logged_in()) {
            ?>
                <p>Du er logget inn som <?php echo wp_get_current_user()->display_name ?></p>

            <?php } else { ?>
                <p>Allerede registrert som bruker? <a href="<?php echo wp_login_url() ?>">Logg inn »</a></p>
                <p>
                    <label for="first_name">Fornavn*:<br /><?php echo $errors->get_error_message("first_name_error") ?>
                        <input type="text" name="first_name" id="first_name" class="text" value="<?php echo esc_attr(stripslashes($first_name)); ?>" />

                    </label>
                </p>
                <p>
                    <label for="last_name">Etternavn*:<br /><?php echo $errors->get_error_message("last_name_error") ?>
                        <input type="text" name="last_name" id="last_name" class="text" value="<?php echo esc_attr(stripslashes($last_name)); ?>" />
                    </label>
                </p>
                <p>
                    <label for="email">Epost*:<br /><?php echo  $errors->get_error_message("email_error") ?>
                        <input type="text" name="email" id="email" class="text" value="<?php echo esc_attr(stripslashes($email)); ?>" size="25" />

                    </label>
                </p>
                <p>
                    <label for="user_login">Brukernavn (for å registrere deg som bruker på denne siden):<br />
                        <?php echo $errors->get_error_message("user_login_error") ?>
                        <?php echo $errors->get_error_message("username_exists") ?>
                        <input type="text" name="user_login" id="user_login" class="text" value="<?php echo esc_attr(stripslashes($username)); ?>" size="25" /></label>
                </p>

            <?php } ?>

            <p>
                <span>Kryss av for hvilken hær du skal spille*:</span>
                <br /><?php echo $errors->get_error_message("haer_error") ?>
            </p>

            <div>
                <?php
                tds_army_checkbox("Beastmen", $haer);
                tds_army_checkbox("Bretonnia", $haer);
                tds_army_checkbox("Daemons of Chaos", $haer);
                tds_army_checkbox("Dark Elves", $haer);
                tds_army_checkbox("Dwarfs", $haer);
                tds_army_checkbox("Dogs of War", $haer);
                tds_army_checkbox("High Elves", $haer);
                tds_army_checkbox("Lizardmen", $haer);
                tds_army_checkbox("Ogre Kingdoms", $haer);
                tds_army_checkbox("Orcs & Goblins", $haer);
                tds_army_checkbox("Skaven", $haer);
                tds_army_checkbox("Chaos Dwarfs", $haer);
                tds_army_checkbox("The Empire", $haer);
                tds_army_checkbox("Tomb Kings", $haer);
                tds_army_checkbox("Vampire Counts", $haer);
                tds_army_checkbox("Warriors of Chaos", $haer);
		tds_army_checkbox("Wood Elves", $haer);
                tds_army_checkbox("Vet ikke", $haer);
                ?>

            </div>

            <div class="clearfix"></div>

            <div class="tds-padding-liten-full rod-knapp-container send-paamelding">
                <input type="image" src="<?php bloginfo('template_directory'); ?>/img/knapp-paamelding.png" alt="Send påmelding" />
            </div>

        </form>
    <?php
}

function tds_army_checkbox($army, $haer) {

    $id = preg_replace("/[ ]/", "_", $army);
    $checked = $haer == $id ? "checked" : "";
    ?>
<div class="tds-army-selector-container">

    <input type="radio" name="haer" id="<?php echo $id ?>" value="<?php echo $army ?>" <?php echo $checked ?> />

    <label for="<?php echo $id ?>"><?php echo $army ?></label>
</div>
<?php
}



function tds_deltagerliste($turnering) {

    $spillere = get_tournament_players($turnering->id);

    $split_indeks = (count($spillere) + 1) / 2;
    //$split_indeks = $turnering->max_players / 2;

    //$tom_deltagerliste = array_fill(0, $turnering->max_players, null);

    //$full_deltagerliste = array_replace($tom_deltagerliste, $spillere);

    $spillere_kolonner = array_chunk($spillere, $split_indeks, true);

    $kolonne1 = $spillere_kolonner[0];
    $kolonne2 = $spillere_kolonner[1];

?>
<ol class="deltagerliste">
    <div class="deltagerliste-kolonne">

        <?php
        foreach ($kolonne1 as $indeks=>$spiller) display_deltager($indeks + 1, $spiller); ?>
    </div>
    <div class="deltagerliste-kolonne">
        <?php foreach ($kolonne2 as $indeks=>$spiller) display_deltager($indeks + 1, $spiller); ?>
    </div>
</ol>
<?php
}

function display_deltager($indeks, Player $spiller=null) {
    $navn = $spiller == null ? "" : $spiller->displayName();
    $army = $spiller == null ? "" : $spiller->army;
    ?>
<li>

    <span class="deltagerliste-nummer"><?php echo $indeks?>.</span>
    <div class="deltagerliste-deltager">
        <span class="deltagerliste-navn"><?php echo $navn ?></span>
        <span class="deltagerliste-haer"><?php echo $army ?></span>
    </div>
</li>
    <?php
}


function display_resultater($turnering) {
?>
    <table class="resultatliste">
        <tr>
            <th class="haandskrift rod-tekst">PLASSERING</th>
            <th class="hovedkolonne haandskrift rod-tekst">DELTAGER</th>
            <th class="haandskrift rod-tekst">POENG</th>
            <th class="haandskrift rod-tekst">MALEPOENG</th>
            <th class="haandskrift rod-tekst">TOTALT</th>
        </tr>
        <?php
        $resultatliste = get_final_standing($turnering);

        foreach ($resultatliste as $indeks=>$resultat) display_resultat($indeks + 1, $resultat);
        ?>
    </table>

<?php
}

function display_resultat($plassering, $resultat) {

    $malepoeng = $resultat->painting_score;
    if ($malepoeng == null) {
        $malepoeng = "-";
    }
    $army = $resultat->army;
?>
    <tr>
        <td class="haandskrift"><?php echo $plassering ?></td>
        <td>
            <strong>
                <?php echo $resultat->player_name ?>
            </strong>
            <div><?php if ($army !=null) echo $army ?></div>
        </td>
        <td><?php echo $resultat->battle_points ?></td>
        <td><?php echo $malepoeng ?></td>
        <td><strong><?php echo $resultat->total ?></strong></td>
    </tr>
<?php
}


add_filter('login_url', 'tds_login_url', 10, 2);
function tds_login_url($login_url, $redirect) {
    return get_site_url() . "/login";
}

add_action('wp_login_failed', 'tds_front_end_login_fail' );

function tds_front_end_login_fail( $username ) {
    $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
    // if there's a valid referrer, and it's not the default log-in screen
    if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
        wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
        exit;
    }
}

//1. Add new form elements
add_action('register_form','tds_register_form');
function tds_register_form (){
    $first_name = ( isset( $_POST['first_name'] ) ) ? $_POST['first_name']: '';
    ?>
<p>
    <label for="first_name">Fornavn<br />
        <input type="text" name="first_name" id="first_name" class="input" value="<?php echo esc_attr(stripslashes($first_name)); ?>" size="25" /></label>
</p>
<p>
    <label for="last_name">Etternavn<br />
        <input type="text" name="last_name" id="last_name" class="input" value="<?php echo esc_attr(stripslashes($last_name)); ?>" size="25" /></label>
</p>
<?php
}

//2. Add validation. In this case
add_filter('registration_errors', 'tds_registration_errors', 10, 3);
function tds_registration_errors ($errors, $sanitized_user_login, $user_email) {
    if ( empty( $_POST['first_name'] ) )
        $errors->add( 'first_name_error', '<span class="feilmelding">Manglende brukernavn</span>');

    if ( empty( $_POST['last_name'] ) )
        $errors->add( 'last_name_error', __('<strong>ERROR</strong>: You must include a last name.') );

    return $errors;
}

//3. Finally, save our extra registration user meta.
add_action('user_register', 'tds_user_register');
function tds_user_register ($user_id) {
    if ( isset( $_POST['first_name'] ) )
        update_user_meta($user_id, 'first_name', $_POST['first_name']);
    if ( isset( $_POST['last_name'] ) )
        update_user_meta($user_id, 'last_name', $_POST['last_name']);
}