<?php get_header(); ?>

	<div class="main">

		<div class="recipes tabs">

			<button onclick="skddSwitchTab('basic_tab', 'basic_recipes');" id="basic_tab" class="tab_menu active">
				Basic Recipes
			</button>
			
			<button onclick="skddSwitchTab('full_tab', 'full_recipes');" id="full_tab" class="tab_menu">
				Full Recipes
			</button>

			<button onclick="skddSwitchTab('like_tab', 'liked_recipes');" id="like_tab" data-like-tab-btn class="tab_menu hidden">
				<span class="liked_icon">
					Liked
				</span>
			</button>
			
		</div>	 

		<div data-recipe-container class="recipes list"> 
								
			<div id="basic_recipes" class="tab_content" > 
				
				<?php

				$loop = new WP_Query(
					array(
						'post_type' => 'recipes',
						'order' => 'asc',
						'posts_per_page' => 100,
						'tax_query' => array(
							array(
								'taxonomy' => 'tax_recipes',
								'field'    => 'slug',
								'terms'    => array( 'basic' ),
								'operator' => 'IN'
							),
						),
					)
				);    

				while ( $loop->have_posts() ) : $loop->the_post(); ?>   

					<?php include('components/recipe-list.php'); ?>
					
				<?php endwhile;
					wp_reset_postdata();
				?>

			</div>



			<div id="full_recipes" class="tab_content" style="display:none;">
				
				<?php
				
				$loop = new WP_Query(
					array(
						'post_type' => 'recipes',
						'order' => 'asc',
						'posts_per_page' => 100,
						'tax_query' => array(
							array(
								'taxonomy' => 'tax_recipes',
								'field'    => 'slug',
								'terms'    => array( 'full' ),
								'operator' => 'IN'
							),
						),
					)
				);    

				while ( $loop->have_posts() ) : $loop->the_post(); ?>   

					<?php include('components/recipe-list.php'); ?>
					
				<?php endwhile;
					wp_reset_postdata();
				?>

			</div>

			<div id="liked_recipes" data-shortlist-container data-like-tab-content class="tab_content" style="display:none;"> 			

			</div>

		</div>

	</div>   

<?php get_footer(); ?>