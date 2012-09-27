<?php
/*
 * Template Name: FAQ
 */
?>
<?php
get_header();
$args = array(
    'post_type' => 'faq',
    'orderby' => 'date',
    'order' => 'ASC',
);
query_posts($args);
?>

<div id="content">
    <div id="faq" class="post post-full-width">
        <h1><?php the_title(); ?></h1>
        
        <?php if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <div class="faq-QA">
                    <div class="faq-Question"><?php the_title(); ?></div>
                    <div class="faq-Answer"><?php the_content(); ?></div>
                </div>
            <?php
            endwhile;
        endif;
        ?>
    </div>
</div><!-- Portfolio Container -->

<?php get_footer(); ?>