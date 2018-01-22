<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<section class="blogMainSec">
	<div class="wrapper">
		<aside class="blogLsec">
		<?php  							
			$display_count = 5;
			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
			$offset = ( $paged - 1 ) * $display_count;
				$args=array(
				  'post_type' => 'post',
				  'post_status' => 'publish',
				  'posts_per_page' => $display_count,
				  'paged' => $paged,
				  'offset' => $offset,
					'orderby' => 'ID',
					'order' => 'ASC',	
				);
				$my_query = new WP_Query($args); 
				if( $my_query->have_posts() ) { 
				$i=0;
					while ($my_query->have_posts()) : $my_query->the_post();
					$content = get_the_content($post->ID);
					$post_image = get_field('post_image',$post->ID);
						if ( $i == 0 ) :
			 ?>
			<div class="blogSubBanner">
				<ul>
					<li>
						<div class="caseStudies">
							<?php $category_detail=get_the_category($post->ID);
								foreach($category_detail as $cd){
								echo $cd->cat_name;
								} ?>
						</div>
						<a href="<?php echo get_the_permalink($post->ID); ?>"><img src="<?php echo $post_image['url']; ?>" alt="<?php echo get_the_title($post->ID); ?>"></a>
					</li>
				</ul>
			</div>
			<div class="havingFunSec">
				<h2><?php echo get_the_title($post->ID); ?> <span><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $pfx_date = get_the_date( 'F j, Y', $post->ID ); ?></span></h2>
				<p><?php 
					$pos = strpos($content, ' ', 150);
					$short_cnt = substr($content,0,$pos );
					echo $short_cnt; ?>..<a href="<?php echo get_the_permalink($post->ID); ?>">Read More</a></p>
			</div>
			<?php endif; $i++;  endwhile; } wp_reset_query(); ?>
			<div class="blogRptSec">
				<ul>
				<?php 
				$my_query = new WP_Query($args); 
				if( $my_query->have_posts() ) { 
				$i=0;
					while ($my_query->have_posts()) : $my_query->the_post();
					$content = get_the_content($post->ID);
					$author_id = $post->post_author;
					$post_image = get_field('post_image',$post->ID);
					if ( $i != 0 ) :
				?>
					<li>
						<div class="blogThumBnr">
							<div class="caseStudies green">
							<?php $category_detail=get_the_category($post->ID);
								foreach($category_detail as $cd){
								echo $cd->cat_name;
								} ?>
							</div>
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
								  <!--<li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i></a></li>-->
								  <li><?php if(function_exists('wp_ulike')) wp_ulike('get'); ?></li>
								</ul>
							</div>
						</div>
					</li>
				<?php endif; $i++;  endwhile; } wp_reset_query(); ?>
				</ul>
			</div>
			<div class="pagerSec">
				<?php
				global $wp_query;
				$bignum = 999999999;
				echo paginate_links( array(
							'base' 			=> str_replace($bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
							'format' 		=> '',
							'current' 		=> max(1, get_query_var('paged') ),
							'total' 		=> $my_query->max_num_pages,
							'prev_text' 	=> 'Prev',
							'next_text' 	=> 'Next',
							'type'			=> 'list',
							'range'         => 5,
							) ); wp_reset_query(); 
				?>
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
				<li class="active"><a href="javascript:void(0);"><i class="fa fa-caret-right" aria-hidden="true"></i>All</a></li>
				<?php foreach ( $terms as $term ) { 
					$term_link = get_term_link( $term );
					if($term->count=='0'){ }else{
				?>
				  <li><a href="<?php echo $term_link; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $term->name; ?></a></li>
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
<?php get_footer(); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.page-numbers').addClass('pagination custom_pagination');
	});
</script>