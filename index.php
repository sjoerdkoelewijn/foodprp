<?php get_header(); ?>

	<div class="main">

		<nav class="categories full">
		
			<?php sk_get_custom_taxonomy('courses', 'full'); ?>
		
		</nav>

		<!-- TO DO - Add course categories
			<nav class="categories text">
		
			<?php sk_get_custom_taxonomy('courses', 'text'); ?>
	
		</nav>
		-->

		<section data-recipe-container class="recipes list"> 

			<?php

			$loop = new WP_Query(
				array(
					'post_type' => 'recipes',
					'order' => 'asc'
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