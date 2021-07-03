<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">		
	<link rel="profile" href="http://gmpg.org/xfn/11">
	
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

	<title><?php wp_title(); ?></title>
	
	<?php wp_head(); ?>

	<script type="text/javascript">
		var _ajaxurl = '<?php echo admin_url("admin-ajax.php"); ?>';
		var _pageid = '<?php echo get_the_ID(); ?>';
		var _imagedir = '<?php echo get_stylesheet_directory_uri().'/images' ?>';
	</script>
	 
</head>
<body <?php body_class(); ?>>

<?php

// This fixes an issue where wp_nav_menu applied the_title filter which causes WC and plugins to change nav menu labels
print '<!--';
the_title();
print '-->';

?>

<div id="top"></div>
<div class="wrapper">
	<header class="site-header">
		<div class="container">
			<div class="row align-items-end">
				<div class="site-header__logo col-12 col-md-4">
					<span>Styleguide Demo</span>
				</div>
				<div class="site-header__menu col-12 col-md-8">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'header-menu'
					)); ?>
				</div>
			</div>
		</div>
	</header>