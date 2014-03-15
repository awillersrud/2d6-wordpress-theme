<?php
/*
Template Name: Turnering
*/
get_header();

$category = get_the_category();

$header_image_url = get_bloginfo('template_directory') . "/img/" . $category[0]->category_nicename . "/header_image.png";

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

<hr/>

<div class="tds-container">
<div class="tds-padding-liten-full tds-hall-of-fame-post">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    the_content();
endwhile; else: ?>
    <p>Sorry, no posts matched your criteria.</p>
    <?php endif; ?>
</div>
</div>
<?php get_footer();?>
