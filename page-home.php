<?php /* Template Name: Homepage Template */ ?>

<?php get_header(); ?>

	<?php while ( have_posts() ) : ?>
		
		<?php the_post(); ?>

		<?php the_content(); ?>

	<?php endwhile; ?>

	<section class="recipes">

		<?php 

		$args = array(
			'post_type'=> 'recipes',
			'order'    => 'ASC'
		);              

		$the_query = new WP_Query( $args );
		if($the_query->have_posts() ) : 
			while ( $the_query->have_posts() ) : 
			$the_query->the_post();  ?>
			
				<article class="recipe">

					<?php if ( has_post_thumbnail() ) : ?>

						<a class="image" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail('medium'); ?>
						</a>

					<?php endif; ?>

					<div class="text">

						<a href="<?php the_permalink(); ?>">
						
							<h1>
								<?php the_title(); ?>
							</h1>
							
						</a>	
													
						<?php the_excerpt(); ?>	

					</div>

				</article>

			<?php endwhile; 
			wp_reset_postdata(); 
		else: 
		endif;

		?>

	</section>	

<?php get_footer();
