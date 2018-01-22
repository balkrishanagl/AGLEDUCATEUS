<?php
/**
 * The template for displaying Category pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
$category_id = get_cat_id( single_cat_title("",false) ); 
$cat_name = get_cat_name($category_id);
?>
<section class="blogMainSec">
	<div class="wrapper">
		<aside class="blogLsec">
			<div class="blogRptSec">
				<ul>
				<?php $new = query_posts('post_type=post&cat='.$category_id.'&post_status=publish&orderby=ID&order=DESC&posts_per_page=-1');
					if( have_posts()) : while(have_posts()) : the_post(); 
					$post_image = get_field('post_image',$post->ID);
					$author_id = $post->post_author;
					$content = get_the_content($post->ID);
				?>
					<li>
						<div class="blogThumBnr">
							<img src="<?php echo $post_image['url']; ?>" alt="<?php echo get_the_title($post->ID); ?>">
						</div>
						<div class="blogDetailMain">
							<div class="blogDetailSub">
								<h2><?php echo get_the_title($post->ID); ?> <span><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $pfx_date = get_the_date( 'F j, Y', $post->ID ); ?> <i class="fa fa-user" aria-hidden="true"></i><?php the_author_meta( 'user_nicename' , $author_id ); ?></span></h2>
								<?php 
								$pos = strpos($content, ' ', 150);
								$short_cnt = substr($content,0,$pos );
								echo $short_cnt; ?>..
							</div>
							<div class="readMoreSec">
								<a href="<?php echo get_the_permalink($post->ID); ?>">Read More<i class="fa fa-angle-right" aria-hidden="true"></i></a>
								<ul>
								  <li><a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i><?php echo $post->comment_count; ?></a></li>
								   <li><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></li>
								</ul>
							</div>
						</div>
					</li>
				<?php endwhile; else: echo "<h4>No posts added for this category!</h4>"; endif; wp_reset_query();?>
				</ul>
			</div>
		</aside>
		<aside class="blogRsec">
			<div class="categorySec">
				<h2>Category</h2>
				<?php
				$terms = get_terms('category');
				if ( !empty( $terms ) && !is_wp_error( $terms ) ){ 
				?>
				<ul>
				<li><a href="<?php echo home_url(); ?>"><i class="fa fa-caret-right" aria-hidden="true"></i>All</a></li>
				<?php foreach ( $terms as $term ) { 
					$term_link = get_term_link( $term );
					if($term->count=='0'){ }else{
				?>
				  <li <?php if($term->name == $cat_name){ ?> class="active" <?php } ?>><a href="<?php echo $term_link; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $term->name; ?></a></li>
				<?php } } ?>
				</ul>
				<?php } ?>
			</div>
			<div class="popularBlogSec">
				<h2>Popular Blog</h2>
				<ul>
				<?php 
				$popularpost = new WP_Query( array( 'posts_per_page' => 5, 'meta_key' => 'wpb_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'  ) );
				while ( $popularpost->have_posts() ) : $popularpost->the_post();
					$post_image = get_field('post_image',$post->ID);
				?>
					<li>
						<a href="<?php echo get_the_permalink($post->ID); ?>">
							<div class="popularBlogThumb"><img src="<?php echo $post_image['url']; ?>" alt="<?php echo get_the_title($post->ID); ?>"></div>
							<div class="popularBlogRsec">
							  <ul>
								<li>
								  <h3><?php echo get_the_title($post->ID); ?> <span><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $pfx_date = get_the_date( 'F j, Y', $post->ID ); ?></span></h3>
								</li>
							  </ul>
							</div>
						</a>
					</li>
				<?php endwhile; wp_reset_query(); ?>
				</ul>
			</div>
		</aside>
	</div>
</section>
<?php
get_footer();
?>