<div class="homepage">

	<?php if($cat = ide_option('homepage_featured')): ?>
		<div class="slideshow">
			<div id="homefeatured">
				<?php 
					// show featured posts as slideshow
					$num_posts = ide_option('homepage_featured_num');

					$featured = new WP_Query();
					$featured->query('meta_key=ide_post_image&posts_per_page='.(is_numeric($num_posts) ? $num_posts : 4 ).'&cat='.$cat);
					
					while( $featured->have_posts() ) : $featured->the_post();
					
					$imgurl = @array_pop(get_post_custom_values('ide_post_image'));	// image
				?>
					<div class="featured" style="background: url('<?php echo $imgurl; ?>');">
						<h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					</div>
					
				<?php
					endwhile;
				?>
				<div class="clear"> </div>
			</div><!-- homefeatured //-->
		</div><!-- slideshow //-->
		<script type="text/javascript">
		//<![CDATA[
			var ide_autoslide = <?php echo ide_option('homepage_autoslide') ? 'true' : 'false'; ?>;
		//]]>
		</script>
	<?php endif; ?>

	<?php if($banner = ide_option('homepage_banner')): ?>
		<div class="banner">
			<?php echo $banner; ?>
		</div>
	<?php endif; ?>
	<div class="clear"> </div>
</div>