<?php
/*
 * Template Name: Toolbox
 */
?>
<?php get_header();
$args = array(
    'post_type' => 'toolbox',
    'meta_query' => array(
        array(
            'key' => 'highlight',
            'value' => 'yes',
            'compare' => 'LIKE'
        )
    ),
    'orderby' => 'date',
    'order' => 'DESC',
);
query_posts($args);
?>

<div id="content">
    <div id="toolbox" class="post post-full-width">
        <h1><?php the_title(); ?></h1>
            <?php if (have_posts()) :
                while (have_posts()) : the_post();

                    $toolbox_meta = get_meta_toolbox_box(); ?>

                    <div class="videoContainer promoted">
                        <div class='videoThumbnail'>
                            <?php if (has_post_thumbnail()) { ?>
                                <a href="#<?php echo $toolbox_meta[0] ?>" title="<?php echo the_title(); ?>" rel="shadowbox">
                                    <?php the_post_thumbnail('toolbox-image', array('title' => '' . get_the_title() . '', 'class' => 'img-polaroid')); ?>
                                </a>
                            <?php } ?>
                            <div class="videoPlay">
                                <a href="#<?php echo $toolbox_meta[0] ?>" title="<?php echo the_title(); ?>" rel="shadowbox">Play video</a>
                            </div>
                        </div>
                        <div class="videoMeta">
                            <h2><?php the_title(); ?></h2>
                            <p><?php the_content() ?></p>
                            <p class="tags"><?php the_tags('Tags: ',' • '); ?></p>
                        </div>

                    </div>
                <?php endwhile;
            endif;
            ?>


        <?php
        $args = array(
            'post_type' => 'toolbox',
            'meta_query' => array(
                array(
                    'key' => 'highlight',
                    'value' => 'no',
                    'compare' => 'LIKE'
                )
            ),
            'orderby' => 'meta_value date',
            'order' => 'DESC',
        );
        query_posts($args);

        if (have_posts()) :
        while (have_posts()) : the_post();

            $toolbox_meta = get_meta_toolbox_box(); ?>

            <div class="videoContainer">
                <div class='videoThumbnail'>
                    <?php if (has_post_thumbnail()) { ?>
                        <a href="#<?php echo $toolbox_meta[0] ?>" title="<?php echo the_title(); ?>" rel="shadowbox">
                            <?php the_post_thumbnail('toolbox-image', array('title' => '' . get_the_title() . '', 'class' => 'img-polaroid')); ?>
                        </a>
                    <?php } ?>
                    <div class="videoPlay">
                        <a href="#<?php echo $toolbox_meta[0] ?>" title="<?php echo the_title(); ?>" rel="shadowbox">Play video</a>
                    </div>
                </div>
                <div class="videoMeta">
                    <h2><?php the_title(); ?></h2>
                    <p><?php the_content() ?></p>
                    <p class="tags"><?php the_tags('Tags: ',' • '); ?></p>
                </div>
            </div>
            <?php endwhile;
            endif;
        ?>
    </div>
</div><!-- Portfolio Container -->

<?php get_footer(); ?>