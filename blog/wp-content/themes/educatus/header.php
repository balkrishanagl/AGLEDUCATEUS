<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon">
<?php wp_head(); ?>
<link href="<?php echo get_template_directory_uri(); ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo get_template_directory_uri(); ?>/assets/css/layout.css" rel="stylesheet"  />
<link href="<?php echo get_template_directory_uri(); ?>/assets/css/screen.css" rel="stylesheet"  />
<link href="<?php echo get_template_directory_uri(); ?>/assets/css/custom.css" rel="stylesheet"  />
</head>

<body <?php body_class(); ?>>
<header>
	<div class="top_header">
		<ul>
			<li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/phone.png" alt=""> + 91 -33 -2282 5787</li>
			<li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/email.png" alt=""><a href="mailto:Info@educatusexpo.in"> Info@educatusexpo.in</a></li>
			<li><a href="http://aglfbapps.in/educateus/exhibitor-register" class="bg">Register as Exhibitor</a></li>
			<li><a href="javascript:void(0);" class="search bg"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/search.png" alt=""> Search</a><span class="search_box">
			<?php get_search_form();?>
			</span></li>
		</ul>
	</div>
	<div class="bottom_header">
		<div class="logo"><a href="http://aglfbapps.in/educateus/"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo"></a></div>
		<nav>
			<div class="sb-toggle-right  top_click">
				<a href="javascript:void(0);">
					<div class="three_line three_line--htx"><span>toggle menu</span> </div>
				</a>
			</div>
			<ul>
				<li><a href="http://aglfbapps.in/educateus/about">about</a></li>
				<li> <a href="http://aglfbapps.in/educateus/exhibitions"> Exhibitions </a> <span class="drop_mrnu"></span>
					<ul class="sub_menu">
						<li><a href="http://aglfbapps.in/educateus/exhibition/jodhpur">Jodhpur</a></li>
						<li><a href="http://aglfbapps.in">New Delhi</a></li>
						
					</ul>
				</li>
				<li><a href="http://aglfbapps.in/educateus/counselling"> Counseling</a></li>
				<li><a href="http://aglfbapps.in/educateus/scholarship"> Scholarship </a></li>
				<li><a href="http://aglfbapps.in/educateus/news"> News </a></li>
				<li><a href="http://aglfbapps.in/educateus/gallery"> Gallery </a></li>
				<li><a href="http://aglfbapps.in/educateus/online-register"> Register Online </a></li>
				<li><a href="http://aglfbapps.in/educateus/faq"> FAQ </a></li>
				<li><a href="http://aglfbapps.in/educateus/international-presence"> international presence</a></li>
				<li><a href="http://aglfbapps.in/educateus/contact-us"> Contact us </a></li>
			</ul>
		</nav>
	</div>
</header>
<section class="banner">
  <div class="banner_box">
    <ul class="owl-carousel" id="home_slide">
      <li> <?php if ( has_post_thumbnail() ) { ?>
		<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title($post->ID); ?>">
		<?php } ?>
        <div class="tags inner_tags"> <span class="tag1"><?php echo get_the_title($post->ID); ?></span> </div>
      </li>
    </ul>
  </div>
  <div class="socail">
    <ul>
      <li><a href="https://www.facebook.com/educatusexpo"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.png" alt="facebook"></a></li>
      <li><a href="https://twitter.com/educatusexpo"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter.png" alt="twitter"></a></li>
      <li><a href="https://plus.google.com/+EducatusexpoIn"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/google_plus.png" alt="google-plus"></a></li>
      <li><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/linkand.png" alt="linkdin"></a></li>
    </ul>
  </div>
</section>