<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" lang="en">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if(is_singular() && pings_open(get_queried_object())) : ?>
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
	// This fixes an issue where wp_nav_menu applied the_title filter
	// which causes WC and plugins to change nav menu labels
	print '<!--';
	the_title();
	print '-->';
	?>
	<div id="top"></div>
	<div class="wrapper">

		<header class="site-header header header-animated">
			<nav class="content row">
				<div class="header-brand col-4">
					<div class="nav-item">
						<a class="title" href="<?php echo get_bloginfo('url'); ?>">Cirrus Plus</a>
					</div>
					<div class="nav-item nav-btn" id="header-btn">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
				<?php
				wp_nav_menu(array(
					'theme_location' 	=> 'header-menu',
					'menu_id' 			=> 'header-menu',
					'menu_class' 		=> 'site-header__menu header-nav col-8',
					'container'			=> false,
					'fallback_cb'		=> false,
					'depth'				=> 2,
				)); ?>
			</nav>
		</header>