<?php get_header(); ?>

<div id="content">
    <?php if (have_posts()) { ?>
        <?php
        the_post();
        $imgurl = get_post_custom_values('ide_post_image', $post->ID);
        ?>

        <div class="post">
            <?php if (ide_option('post_strip')) ide_post_strip(); ?>

            <?php if ($imgurl = @array_pop($imgurl)): ?>
                <div class="post_image"><img src="<?php echo $imgurl; ?>" alt="<?php the_title(); ?>" /></div>
            <?php else: ?>
            <h1 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
    <?php endif; ?>

            <div class="post-author">
    <?php echo get_avatar(get_the_author_meta('ID'), '48'); ?>
                <div class="post-meta">Written by <span><?php the_author(); ?></span></div>
                <div class="post-meta">On <?php the_time(get_option('date_format')); ?> in <?php the_category(', '); ?> category</div>
                <?php if (comments_open()) { ?>
                    <p class="comments"><?php comments_popup_link('0 comments', '1 comment', '% comments', '', ''); ?></p>
    <?php } ?>
                <div class="clear"> </div>
            </div>

            <?php if (!empty($imgurl)): ?>
                <h1 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
    <?php endif; ?>

            <div class="text">
    <?php the_content(_('continue reading..')); ?>
                <div class="clear"> </div>
            </div><!-- .text //-->

		<!--Citation Box -->	  <?php if ( get_post_meta($post->ID, 'citation', true) ) : ?>	  	<div class="citation">	          <?php echo get_post_meta($post->ID, 'citation', true) ?>	       </div>	  <?php endif; ?>	  <!-- End Citation box-->    <?php if (ide_option('post_fullmeta')): ?>
                <ul class="postmetadata">
                    <li>This entry was posted
                        on <?php the_time('l, F jS, Y') ?> at <?php the_time('g:i a') ?>
                        <?php $cat = get_the_category();

                        if ($cat[0]->term_id != '1'): ?>
                            and is filed under <?php the_category(', '); ?>
                            <?php endif; ?>
                    </li>

                    <?php if (comments_open() && pings_open()) {
                        // Both Comments and Pings are open 
                        ?>
                        <li>You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.</li>

                    <?php } elseif (!comments_open() && pings_open()) {
                        // Only Pings are Open
                        ?>
                        <li>Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.</li>

                    <?php } elseif (comments_open() && !pings_open()) {
                        // Comments are open, Pings are not 
                        ?>
                        <li>You can skip to the end and leave a response. Pinging is currently not allowed.</li>

                    <?php } elseif (!comments_open() && !pings_open()) {
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