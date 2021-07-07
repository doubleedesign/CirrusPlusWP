<?php 
the_post();
get_header(); 
?>

<?php get_template_part('partials/breadcrumbs'); ?>

<div class="content row">
	<?php the_content(); ?>
</div>

<?php get_footer(); ?>