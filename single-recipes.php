<?php get_header(); ?>
		
	<?php the_post_thumbnail('large', ['class' => 'hero_image', 'title' => 'Feature image']); ?>

	<div class="content">

	
		<div class="main_text">

			<h1>
				<?php the_title(); ?>							
			</h1>						

			<?php the_field('long_description'); ?>

		</div>

		<article class="recipe_meta">

			<p>
				<span class="meta_title">
					Quantity
				</span>
				<?php the_field('quantity'); ?> gr
			</p>

			<p>
				<span class="meta_title">
					Active time
				</span>
				<?php the_field('cook_time'); ?> mins
			</p>

			<p>
				<span class="meta_title">
					Total time
				</span>
				<?php the_field('full_time'); ?> mins
			</p>

		</article>



		<div class="recipes tabs" data-tab-menu data-tabs-id="Recipe<?php the_ID(); ?>">

			<button onclick="skddSwitchTab('ingredients_tab', 'recipe_ingredients');" id="ingredients_tab" class="tab_menu active">
				Ingredients
			</button>

			<button onclick="skddSwitchTab('instructions_tab', 'recipe_instructions');" id="instructions_tab" class="tab_menu">
				Instructions
			</button>

		</div>	

		<div class="recipes list">


			<div id="recipe_ingredients" class="tab_content" > 

				
				<?php

					if( have_rows('ingredients') ): ?>
						<ul class="ingredients_list">

							<?php while ( have_rows('ingredients') ) : the_row();?>
								<li>
									<span class="amount">
										<?php the_sub_field('amount'); ?>
										<?php the_sub_field('unit'); ?>
									</span>	

									<?php 									
										$ingredient_name = get_sub_field('name'); 
										echo $ingredient_name->name;
									?>
								</li>
							<?php endwhile; ?>

						</ul>
					<?php endif; 
				?>

				<?php
				$required_recipes = get_field('required_recipes');
				if( $required_recipes ): ?>
					<ul class="ingredients_list">
					<?php foreach( $required_recipes as $post ): 

						// Setup this post for WP functions (variable must be named $post).
						setup_postdata($post); ?>
						<li>

							<span class="amount">
								<?php the_sub_field('amount'); ?>
								<?php the_sub_field('unit'); ?>
							</span>

							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>									
						</li>
					<?php endforeach; ?>
					</ul>
					<?php 
					// Reset the global post object so that the rest of the page works correctly.
					wp_reset_postdata(); ?>
				<?php endif; ?>				
		
			</div>



			<div id="recipe_instructions" class="tab_content hidden">

				<?php if( have_rows('instructions') ): ?>
					<ol class="instruction_list" >

						<?php while ( have_rows('instructions') ) : the_row();?>
							<li>
								<?php the_sub_field('step'); ?>
								
							</li>
						<?php endwhile; ?>

					</ol>
				<?php endif; 
				?>
					

			</div>	


		</div>	

	</div>
				


<?php get_footer();