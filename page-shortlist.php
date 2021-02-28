<?php /* Template Name: Shortlist Template */ ?>

<?php get_header(); ?>

	<?php while ( have_posts() ) : ?>

		<?php the_post(); ?>

		<?php the_content(); ?>

	<?php endwhile; ?>

	<section data-shortlist-container class="recipes list">

	</section>	

<?php get_footer();
