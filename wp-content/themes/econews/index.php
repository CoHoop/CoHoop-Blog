<?php get_header(); ?>

	<?php // homepage slideshow and banner ad
		if(is_front_page() && ( ide_option('homepage_featured') || ide_option('homepage_banner') )):
			include IDE_PATH.'/layouts/homepage.php';
		endif;
	?>

<div id="content">
	<?php include IDE_PATH.'layouts/blog.php'; ?>
</div><!-- content //-->

<?php ide_sidebar(); ?>

<?php get_footer(); ?>