<div class="card-wrapper col-xs-12 col-md-6 col-lg-4">
	<div class="card u-flex u-flex-column h-100">
		<a href="<?php the_permalink(); ?>" class="card-container">
			<div class="card-image">
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="card-content entry-content">
				<h2><?php the_title(); ?></h2>
				<?php echo doublee_custom_excerpt(get_the_excerpt(), 25); ?>
			</div>
		</a>
	</div>
</div>