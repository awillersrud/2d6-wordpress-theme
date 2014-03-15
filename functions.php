<?php

add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );
add_theme_support( 'post-thumbnails' );

function display_hall_of_fame_posts($number_of_posts = 10, $full_post = false, $hall_of_fame_link = false) {
    rewind_posts();
    query_posts('category_name=hall-of-fame&posts_per_page=' . $number_of_posts);
    global $more;
    $more = 0;
    while (have_posts()) : the_post(); ?>
    <div class="tds-hall-of-fame-post tds-padding-liten-full">

        <?php
        if ($full_post) {
            the_content('', true, '');
        } else {
            if ( has_post_thumbnail() ) {
                the_post_thumbnail();
            }
            the_content('Les mer »');
            if ($hall_of_fame_link) {?>
                <a class="hoyre" href="<?php echo get_bloginfo('wpurl') . "/hall-of-fame"?>">Til Hall of Fame »</a>
            <?php
            }
        }
        ?>
        <div class="clearfix" ></div>
    </div>

    <?php endwhile;
}

function tds_army_checkbox($army) {

    $id = preg_replace("/[ ]/", "_", $army)
?>
    <div class="tds-army-selector-container">

        <input type="radio" name="army" id="<?php echo $id ?>" />

        <label for="<?php echo $id ?>"><?php echo $army ?></label>
    </div>
<?php
}

add_action( 'wp_login_failed', 'tds_front_end_login_fail' );

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
        $errors->add( 'first_name_error', __('<strong>ERROR</strong>: You must include a first name.','mydomain') );

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