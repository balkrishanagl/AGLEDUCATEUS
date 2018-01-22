<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); 
global $post;
$post_image = get_field('post_image',$post->ID);
?>
<section class="blogMainSec">
	<div class="wrapper">
		<aside class="blogLsec">
			<div class="blogSubBanner">
				<ul>
					<li>
					<?php
					$terms = get_terms('category');
					if ( !empty( $terms ) && !is_wp_error( $terms ) ){ 
						foreach ( $terms as $term ) { 
					?>
						<div class="caseStudies"><?php echo $term->name; ?></div>
					<?php } } ?>
						<img src="<?php echo $post_image['url']; ?>" alt="<?php echo get_the_title($post->ID); ?>">
					</li>
				</ul>
			</div>
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>
			<div class="havingFunSec">
				<h2><?php echo get_the_title($post->ID); ?> <span><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $pfx_date = get_the_date( 'F j, Y', $post->ID ); ?></span></h2>
				<?php echo get_the_content($post->ID); ?>
			</div>
			<div class="sharePlugInSec">
				<div class="plugInSubSec">
					<div class="comntLikeSecL">
						<ul>
							<li><i class="fa fa-comment-o" aria-hidden="true"></i><?php echo $post->comment_count; ?> Comments</li>
							<li><i class="fa fa-heart-o" aria-hidden="true"></i>1 Likes</li>
						</ul>
					</div>
					<div class="shareRsec">
						<ul>
							<li><strong>0</strong> Shares</li>
							<li></li>
						</ul>
					</div>
				</div>
			<?php	// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif; ?>
			</div>
			<?php endwhile; // End of the loop.
			?>
		</aside>
		<aside class="blogRsec">
			<div class="categorySec">
				<h2>Category</h2>
				<?php
				$terms = get_terms('category');
				if ( !empty( $terms ) && !is_wp_error( $terms ) ){ 
				?>
				<ul>
				<li class="active"><a href="<?php echo home_url(); ?>"><i class="fa fa-caret-right" aria-hidden="true"></i>All</a></li>
				<?php foreach ( $terms as $term ) { 
					$term_link = get_term_link( $term );
					if($term->count=='0'){ }else{
				?>
				  <li><a href="<?php echo $term_link; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $term->name; ?></a></li>
				<?php } } ?>
				</ul>
				<?php } ?>
			</div>
			<div class="categorySec mt30">
				<h2>Monthly Archies</h2>
				<ul>
				<?php 
					$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' ORDER BY post_date");
					foreach($years as $year) :
						$months = $wpdb->get_col("SELECT DISTINCT MONTHNAME(post_date) FROM $wpdb->posts WHERE YEAR(post_date) = $year AND post_status = 'publish' AND post_type = 'post' ORDER BY post_date");
				?>
					<li>
						<a href="<?php echo home_url()."/".$year; ?>"><i class="fa fa-caret-down" aria-hidden="true"></i><?php echo $year; ?></a>
						<ul>
						<?php foreach($months as $month) : 
							$date = date_parse($month);
							$month_int =  $date['month'];
						?>
							<li><a href="<?php echo home_url()."/".$year."/".$month_int; ?>"><i class="fa fa-caret-right" aria-hidden="true"></i><?php echo $month; ?> <?php echo $year; ?></a></li>
						<?php endforeach; ?>
						</ul>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</aside>
	</div>
</section>
<section class="relatedArtcSec">
	<div class="wrapper">
		<h2>Related Articles <small></small></h2>
		<div class="relatedSubSec">
		<?php $recomd_posts = get_field('related_posts'); 
			if( $recomd_posts ):
		?>
			<ul class="blogBxSlider owl-carousel">
		<?php foreach($recomd_posts as $rp){ 
			$pId = $rp->ID;
			$post_obj_cat = get_the_category($pId);
			$post_obj_catName =  $post_obj_cat[0]->cat_name;
			$author_id = $rp->post_author;
			$content = get_the_content($pId);
			$post_image = get_field('post_image',$pId);
			$cmtCount = wp_count_comments( $pId );
		?>
				<li>
					<div class="slide">
						<div class="blogThumBnr">
							<div class="caseStudies green"><?php echo $post_obj_catName; ?></div>
							<img src="<?php echo $post_image['url']; ?>" alt="<?php echo get_the_title($pId); ?>">
						</div>
						<div class="blogDetailMain">
							<div class="blogDetailSub">
								<h2><?php echo get_the_title($pId); ?> <span><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $pfx_date = get_the_date( 'F j, Y', $pId ); ?> <i class="fa fa-user" aria-hidden="true"></i><?php the_author_meta( 'user_nicename' , $author_id ); ?></span></h2>
								<?php 
								$pos = strpos($content, ' ', 150);
								$short_cnt = substr($content,0,$pos );
								echo $short_cnt; ?>..
							</div>
							<div class="readMoreSec">
								<a href="<?php echo get_the_permalink($pId); ?>">Read More<i class="fa fa-angle-right" aria-hidden="true"></i></a>
								<ul>
									<li><a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i><?php echo $cmtCount->approved; ?></a></li>
									<li><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i>1</a></li>
								</ul>
							</div>
						</div>
					</div>
				</li>
			<?php } ?>
			</ul>
			<?php else: ?>
				<p>Don't have related posts!</p>
			<?php wp_reset_postdata(); endif; ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
