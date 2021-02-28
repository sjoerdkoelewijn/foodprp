<?php get_header(); ?>



				<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ); ?>

				<article 
					class="hero"
					<?php if( $featured_image ): ?> 
                    	style="background-image:url('<?php echo $featured_image[0]; ?>');" 
                    <?php endif; ?> 	
					> 

					<div class="text">

						<h1>
							<?php the_title(); ?>							
						</h1>						

						<?php the_field('sub_header'); ?>

					</div>

				</article>

				<div class="content">

					<article class="recipe_meta">

						<p>
							<?php the_field('quantity'); ?> gr
						</p>
						<p>
							<?php the_field('cook_time'); ?> mins
						</p>

					</article>

					<article class="recipe_ingredients">

					<h2>
						Ingredients
					</h2>
					<?php

						if( have_rows('ingredients') ): ?>
							<ul>

								<?php while ( have_rows('ingredients') ) : the_row();?>
									<li>
										<?php the_sub_field('amount'); ?>
										<?php the_sub_field('unit'); ?>
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
						<ul>
						<?php foreach( $required_recipes as $post ): 

							// Setup this post for WP functions (variable must be named $post).
							setup_postdata($post); ?>
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>									
							</li>
						<?php endforeach; ?>
						</ul>
						<?php 
						// Reset the global post object so that the rest of the page works correctly.
						wp_reset_postdata(); ?>
					<?php endif; ?>


					</article>
					


					<article class="recipe_steps">

					<h2>
						Steps
					</h2>

					<?php if( have_rows('instructions') ): ?>
						<ul>

							<?php while ( have_rows('instructions') ) : the_row();?>
								<li>
									<?php the_sub_field('step'); ?>
									
								</li>
							<?php endwhile; ?>

						</ul>
					<?php endif; 
					?>

					</article>
					
					
				



				</div>
				


<?php get_footer();