<?php get_header(); ?>

	<?php if ( have_posts() ) {

			while ( have_posts() ) { ?>

				<article class="hero">

					<div class="image">
						<?php the_post_thumbnail('large'); ?>
					</div>

					<div class="text">

						<h1>
							<?php the_title(); ?>
						</h1>

						<?php the_excerpt(); ?>

					</div>

				</article>

				<div class="content">

					<?php the_post(); ?>

					<?php the_content(); ?>

				</div>
				
			<?php }
		}

	?>

<?php get_footer();