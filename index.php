<?php get_header(); ?>

<div class="container">
	<?php if(have_posts()): ?>
		<div class="posts">
			<?php while(have_posts()): the_post(); ?>
				<?php get_template_part('partials/post-tile'); ?>
			<?php endwhile; ?>
			<div class="pagination">
				<?php
				global $wp_query;
				print paginate_links(array(
					'current'   => max( 1, get_query_var('paged')),
					'total'     => $wp_query->max_num_pages,
					'prev_text' => 'Prev',
					'next_text' => 'Next',
					'type'      => 'list',
					'end_size'  => 3,
					'mid_size'  => 3
				));
				?>
			</div>
		</div>
	<?php else: ?>
		<div class="no-posts">
			<p>No posts were found</p>
		</div>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
