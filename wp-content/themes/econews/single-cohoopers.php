<?php get_header(); ?>

<div id="content">
    <?php if (have_posts()) { ?>
        <?php
        the_post();
        ?>

        <div class="post">
            <h3>CoHooper's portrait</h3>
            <div class="post-cohoopers">
                <div class="post-thumbnail">
                    <?php if (ide_option('post_strip')) ide_post_strip(); ?>

                    <?php if (has_post_thumbnail()) { ?>
                        <?php the_post_thumbnail('cohoopers-maxi', array('title' => '' . get_the_title() . '', 'class' => 'img-polaroid')); ?>
                    <?php } ?>
                </div>
                <h2 class="title"><?php the_title(); ?></h2>
                <blockquote><h1><?php echo get_post_meta(get_the_ID(), 'cohooper_quote', true); ?> </h1></blockquote>
                <p class="tags noIndent"><?php the_tags('Tags: ', ' • '); ?></p>
            </div>
            <div class="text">
                <?php the_content(); ?>
                <div class="clear"> </div>
            </div><!-- .text //-->
            <?php if (ide_option('post_fullmeta')): ?>
                <ul class="postmetadata">
                    <?php
                    if (comments_open() && pings_open()) {
                        // Both Comments and Pings are open 
                        ?>
                        <li>You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.</li>

                        <?php
                    } elseif (!comments_open() && pings_open()) {
                        // Only Pings are Open 
                        ?>
                        <li>Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.</li>

                        <?php
                    } elseif (comments_open() && !pings_open()) {
                        // Comments are open, Pings are not 
                        ?>
                        <li>You can skip to the end and leave a response. Pinging is currently not allowed.</li>

                        <?php
                    } elseif (!comments_open() && !pings_open()) {
                        // Neither Comments, nor Pings are open 
                        ?>
                        <li>Both comments and pings are currently closed.</li>

                    <?php } edit_post_link('Edit this entry', '', '.'); ?>
                </ul>
            <?php endif; ?>					

            <?php comments_template(); ?>
            <div class="clear"> </div>
        </div><!-- .post //-->

        <?php
    } else {
        _e('<h1>Sorry!</h1>Sorry, the requested content was not found.');
    }
    ?>
</div><!-- content //-->

<?php ide_sidebar(); ?>

<?php get_footer(); ?>


                    <!--<div class="post-author">
                    <h1 class="title"><?php //the_title(); ?></h1>
                    <?php //echo get_avatar(get_the_author_meta('ID'), '48'); ?>
                    <div class="post-meta">Written by <span><?php //the_author(); ?></span></div>
                    <div class="post-meta">On <?php //the_time(get_option('date_format')); ?></div>
                    <div class="post-meta"><?php //the_tags('Tags: ', ' • '); ?></div>
                    <?php //if (comments_open()) { ?>
                        <p class="comments"><?php //comments_popup_link('0 comments', '1 comment', '% comments', '', ''); ?></p>
                    <?php //} ?>
                    <div class="clear"> </div>
                    </div>-->