<?php
/*
 * Template Name: Cohoopers
 */
?>
<?php get_header(); ?>

<div id="content">
    <div id="cohoopers" class="post post-full-width">
        <h1><?php the_title(); ?></h1>
        <?php if (have_posts()) {
	
            the_post();
            the_content();
        
        }
        ?>

        <?php
        $args = array(
            'post_type' => 'cohoopers',
            'orderby' => 'date',
            'order' => 'DESC',
        );
        query_posts($args);

        if (have_posts()) :
            while (have_posts()) : the_post(); ?>

                <div class="cohooperContainer promoted">
                    <div class='cohooperThumbnail'>
                            <?php if (has_post_thumbnail()) { ?>
                                <a href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>">
                                    <?php the_post_thumbnail(array(150, 150), array('title' => '' . get_the_title() . '', 'class' => 'img-polaroid')); ?>
                                </a>
                            <?php } ?>
                    </div>
                    <div class="cohooperMeta">
                        <h2><a href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>"><?php the_title(); ?></a></h2>
                        <p><?php the_excerpt() ?></p>
                        <p class="noIndent"><?php the_tags('Tags: ', ' • '); ?></p>
                        <a href="<?php the_permalink(); ?>" title="<?php echo the_title(); ?>" class="btn btn-cohoop">Read full post</a>
                    </div>
                </div>
                <?php
            endwhile;
        endif;
        ?>
    </div>
</div><!-- Portfolio Container -->

<?php get_footer(); ?>