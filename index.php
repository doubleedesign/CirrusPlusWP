<?php get_header(); ?>

<div class="content row">
	<?php
	if(have_posts()) {
		while(have_posts()) {
			the_post();
			get_template_part('partials/post-tile');
		}
		get_template_part('partials/pagination');
	}
	else { ?>
		<div class="alert alert-warning">
			<p>No posts were found</p>
		</div>
	<?php } ?>
</div>

<?php get_footer(); ?>
