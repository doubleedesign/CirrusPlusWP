<div class="col-xs-12 col-md-6 col-lg-4">
	<a href="<?php the_permalink(); ?>" class="card">
		<div class="card-container">
			<div class="card-image">
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="card-content">
				<h2><?php the_title(); ?></h2>
				<?php the_excerpt(); ?>
			</div>
		</div>
	</a>
</div>