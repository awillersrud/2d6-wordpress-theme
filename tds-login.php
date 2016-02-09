<?php
/*
Template Name: 2d6 login
*/


// Redirect to https login if forced to use SSL
if ( force_ssl_admin() && ! is_ssl() ) {
    if ( 0 === strpos($_SERVER['REQUEST_URI'], 'http') ) {
        wp_redirect( set_url_scheme( $_SERVER['REQUEST_URI'], 'https' ) );
        exit();
    } else {
        wp_redirect( 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
        exit();
    }
}

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'login';

if ( is_user_logged_in() ) {
    wp_redirect( home_url() ); exit;
}


get_header(); ?>

<div class="lys">
    <div class="tds-container">
	<div class="tds-padding-liten-full">
	    <div class="tds-padding-stor">
		<div class="morkere">
		<div class="tds-padding-liten-full">

<?php
    $redirect = site_url( $_SERVER['REQUEST_URI'] );
    $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
    // if there's a valid referrer, and it's not the default log-in screen
    if ( !empty($referrer) && !strstr($referrer,'wp-login')) {
	$redirect = $referrer;
    }
$args = array(
    'redirect'	     => $redirect,
    'form_id' => 'loginform-tds',
    'label_username' => __( 'Brukernavn:' ),
    'label_password' => __( 'Passord:' ),
    'label_remember' => __( 'Husk meg' ),
    'label_log_in' => __( 'Logg inn' ),
    'remember' => true
);
wp_login_form( $args );
?>
            <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Glemt passord?' ); ?></a>

            </div>
        </div>
    </div>
    </div>
    </div>
</div>

<?php get_footer(); ?>