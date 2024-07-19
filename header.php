<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<meta name="google-site-verification" content="lYbTaJ8S-wTpEszGzUM0tNZXRVhshW-Pze5t9HB8jRc" />

	<title><?php wp_title( ' | ', true, 'right' ); ?></title>

	<?php $favicon = get_template_directory_uri().'/apple-touch-icon.png' ?>

	<link rel="shortcut icon" href="<?php echo $favicon; ?>">
	<link rel="apple-touch-icon" href="<?php echo $favicon; ?>">

	<?php wp_head(); ?>

	<!-- fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

	<?php the_field('mj_global_head_scripts','option') ?>

</head>

<body <?php body_class(); ?>>

<header id="header" class="leftRight animate">

	<div class="container relative">

		<div id="nav-toggle" class="absolute vCenter">
			<div class="relative">
				<div class="open-nav absolute cover"></div>
				<div class="close-nav absolute cover"></div>
				<div class="hamburger relative">
					<span class="bar absolute animate"></span>
					<span class="bar absolute animate"></span>
					<span class="bar absolute animate"></span>
				</div>
			</div>
		</div>

		<div class="d-flex align-items-start logo-nav">

			<div class="navs relative d-flex justify-content-between">

				<?php if (has_nav_menu('main-nav')) : ?>
				<div class="menu-main-nav-container">
					<ul id="menu-main-nav" class="menu d-flex align-items-center justify-content-start animate">
						<?php
						wp_nav_menu(array(
							'theme_location' => 'main-nav',
							'items_wrap' => '%3$s',
							'container' => '',
							'depth' => '2',
							'after' => '<span class="toggle relative animate"><span class="openSubNav absolute cover"><span class="label absolute vCenter"><span class="arrow relative">Open</span></span></span><span class="closeSubNav absolute cover"><span class="label absolute vCenter"><span class="arrow relative">Close</span></span></span></span>',
						));

						?>
					</ul>
				</div><?php endif ?>

				<?php if (has_nav_menu('aux-nav')) : ?>
				<div class="menu-aux-nav-container">
					<ul id="menu-aux-nav" class="menu d-flex align-items-center justify-content-end animate">
						<?php
						wp_nav_menu(array(
							'theme_location' => 'aux-nav',
							'items_wrap' => '%3$s',
							'container' => '',
							'depth' => '1',
						));
						?>
					</ul>
				</div><?php endif ?>

			</div>

		</div>

	</div>
</header>

<div id="content_wrapper">