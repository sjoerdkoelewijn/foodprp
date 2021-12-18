<?php acf_form_head(); ?>
<?php get_header(); ?>

	<div id="primary">
		<div id="content" class="add_recipe" role="main">

		<?php 

		$ips = get_option( 'ip_whitelist', '' );
		$allowedip = explode (",", $ips); 
		
		?>

			

			<?php if ((in_array($_SERVER['REMOTE_ADDR'], $allowedip))) { // Check if IP is whitelisted ?>

				<?php while ( have_posts() ) : the_post(); ?>
					
					<h1>
						<?php the_title(); ?>
					</h1>
					
					<?php the_content(); ?>
								
						<?php
			
							acf_form(array(
								'post_id'		=> 'new_post',
								'post_title'	=> true,
								'new_post'		=> array(
									'post_type'		=> 'recipes',
									'post_status'	=> 'publish'								
								),
								'return' 		=> '%post_url%',
								'submit_value' => __("Add new recipe", 'skdd'),
							));
							
						?>

				<?php endwhile; ?>

			<?php } else { ?>

				<h1>
					No Access
				</h1>

			<?php } ?>

		</div>
	</div>

<?php get_footer(); ?>