<?php get_header(); ?>

	<?php
		$term = get_queried_object();
		$featured_image = get_field('featured_image', $term);	

	?>

	<article 
		class="hero"
		<?php if( $featured_image ): ?> 
			style="background-image:url(<?php echo $featured_image['url']; ?>);" 
		<?php endif; ?> 	
		> 

		<div class="text">

			<h1>
				<?php single_cat_title(); ?>							
			</h1>						

			<?php the_field('sub_header', $term); ?>

			<?php $description = get_the_archive_description(); ?>

			<?php if ( $description ) : ?>
				<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
			<?php endif; ?>
			

		</div>

	</article>

	<div class="main">

		<section class="recipes list"> 

		<?php

			$loop = new WP_Query(
				array(
					'post_type' => 'recipes',
					'order' => 'asc',
					'tax_query' => array(
						array (
							'taxonomy' => 'courses',
							'field' => 'slug',
							'terms' => $term->slug,
						)
					),
				)
			);    

			while ( $loop->have_posts() ) : $loop->the_post(); ?>   

			<?php include('components/recipe-list.php'); ?>

			    
			<?php endwhile;
    			wp_reset_postdata();
			?>

		</section>


	</div>   

<?php get_footer(); ?>