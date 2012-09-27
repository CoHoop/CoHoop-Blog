<?php
	if(is_front_page() && ide_option('homepage_featured')) {
		include IDE_PATH.'homepage.php';
		return;
	}
?>
<?php get_header(); ?>

<div id="content">
<?php if (have_posts()) { ?>
	<?php the_post(); ?>

		<div class="post">
			<h1 class="title"><?php the_title(); ?></h1>
			<div class="clear"> </div>

			<div class="text"><?php the_content('(continue reading...)'); ?></div>
			
			<div class="clear"> </div>
		</div><!-- post //-->

<?php } else {
		_e('<h1>Sorry!</h1>Sorry, the requested content was not found.');
	}
?>
</div><!-- content //-->

<?php ide_sidebar(); ?>

<?php get_footer(); ?>