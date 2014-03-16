<head>
    <meta charset="utf-8">
    <title><?php (bloginfo('name') + wp_title()) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
    <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) ); ?>
    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
</head>
  <body>


<div class="tds-container">
  <div class="tds-nav-toppmeny">
    <a class="hjem" href="<?php bloginfo('wpurl') ?>" ></a>
<!--    <div class="meny-container">-->
        <a class="meny" href="<?php echo get_bloginfo('wpurl') . "/om-2d6" ?>">OM 2D6</a>
        <a class="meny" href="<?php echo get_bloginfo('wpurl') . "/om-2d6-turneringer"?>">OM TURNERINGER</a>
        <a class="meny" href="<?php echo get_bloginfo('wpurl') . "/hall-of-fame"?>">HALL OF FAME</a>

      <a class="meny hoyre" href="http://www.2d6.no">2D6 FORUM</a>
      <?php
      if ( is_user_logged_in() ) { ?>
      <a class="meny hoyre" href="<?php echo wp_logout_url( get_home_url() ); ?>">LOGG UT</a>
      <?php } else { ?>
      <a class="meny hoyre" href="<?php echo get_bloginfo('wpurl') . "/login"?>">LOGG INN</a>
      <?php } ?>

<!--      </div>-->
  </div>
</div>


  <hr/>

  <!--
  <div id="omtds">
      <div class="container">
          <div class="om-tds-tekst">
        <h1>SPILLFORENINGEN 2D6</h1>
        <p>Kort om hvem vi er og hva formålet tli denne siden er. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris.
Morbi accumsan ipsum velit. Nam nec tellus a odio tinci</p>
      </div>
      </div>
  </div>
  -->

