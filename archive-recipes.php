<?php get_header(); ?>

	<div class="main">

		<nav class="categories full">
		
			<?php sk_get_custom_taxonomy('types', 'full'); ?>
		
		</nav>

		<nav class="categories text">
		
			<?php sk_get_custom_taxonomy('courses', 'text'); ?>
	
		</nav>

		<section data-recipe-container class="recipes list"> 

			<?php include('components/recipe-list.php'); ?>

		</section>

	</div>   

<?php get_footer(); ?>