<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header();

$TopDir = substr( home_url(), 0, strrpos( home_url(), '/')+1);
?>

<div class="home-posts">
	<?php
	if (!is_single()) :
		// if ($lang['LANGUAGE'] == "English") {
		// 	$args = array(
		// 		'meta_query' => array('relation' => 'OR',
		// 			array(
		// 				'key' => 'language',
		// 				'value' => array('All', 'English'),
		// 				'compare' => 'IN'
		// 			),
		// 			array('key' => 'language', 'compare' => 'NOT EXISTS')
		// 		)
		// 	);
		// } else {
		// 	$args = array('meta_key' => 'language', 'meta_value' => array('All', $lang['LANGUAGE']));
		// }
    
    function CatDisplay($the_cat) {
    	global $the_query;

    	$the_query = new WP_Query(array('category_name' => $the_cat, 'posts_per_page' => 3, 'post__in'  => get_option('sticky_posts')));

    	$sticky_query = $the_query;
    	$unsticky_query = "";

    	$sticky_count = $sticky_query->found_posts;

    	if ($sticky_count < 3) {
    		$unsticky_count = 3 - $sticky_count;
    		$the_query = new WP_Query(array('category_name' => $the_cat, 'posts_per_page' => $unsticky_count, 'post__not_in'  => get_option('sticky_posts')));
    		$unsticky_query = $the_query;
    	}

			if ($sticky_query->have_posts() || $unsticky_query->have_posts()) :
				$catObj = get_category_by_slug($the_cat);
				echo '<h2 class="cat">'.$catObj->name."</h2>\n";

				while ($sticky_query->have_posts()) : $sticky_query->the_post();
					get_template_part('content', get_post_format($post_id));
				endwhile;

				if ($unsticky_query != "") :
					while ($unsticky_query->have_posts()) : $unsticky_query->the_post();
						get_template_part('content', get_post_format($post_id));
					endwhile;
				endif;

				echo '<div class="centered cat-centered"><a href="'.home_url().'/category/'.$the_cat.'/" class="button">More</a></div>';
			endif;
		}

		CatDisplay('maintenance-repair');
		CatDisplay('rigging-tuning-and-splicing');
		CatDisplay('advice-inspiration');
		CatDisplay('boat-tours');
		CatDisplay('safety');
		CatDisplay('contests');

		echo '<div class="centered cat-centered"><a href="'.home_url().'/all/" class="all">See All Articles</a></div>';
	else :
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'content', get_post_format($post_id) );
			endwhile;

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );
		endif;
	endif;

	if (!is_single()) :
	?>
  <div style="clear: both;"></div>

  <div class="centered">
		<a href="#" id="loadmore"><?php echo $lang['LOAD_MORE']; ?></a>
		<script type="text/javascript">
		  $(function () {
			  $(".post").slice(0, 18).show();
			  $("#loadmore").on('click', function (e) {
			    e.preventDefault();
			    $(".post:hidden").slice(0, 18).slideDown();
			    if ($(".post:hidden").length == 0) {
			      $("#loadmore").fadeOut('slow');
			    }
			  });
			  if (<?php echo $the_query->post_count; ?> <= 18) $("#loadmore").fadeOut('fast');
			});
		</script>
	</div>
  <?php endif; ?>
</div><!-- .content-area -->

<?php get_footer(); ?>