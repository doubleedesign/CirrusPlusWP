<div class="pagination content row">
	<div class="col-12">
		<?php
		global $wp_query;
		echo paginate_links(array(
			'current'   => max( 1, get_query_var('paged')),
			'total'     => $wp_query->max_num_pages,
			'prev_text' => 'Prev',
			'next_text' => 'Next',
			'type'      => 'list',
			'end_size'  => 3,
			'mid_size'  => 3
		)); ?>
	</div>
</div>