<?php
/* Template Name: All Blog Posts */

get_header();

$TopDir = substr( home_url(), 0, strrpos( home_url(), '/')+1);
?>

<div class="home-posts">
	<?php
	if (!is_single()) :
		if ($lang['LANGUAGE'] == "English") {
			$args = array(
				'ignore_sticky_posts' => true,
				'meta_query' => array('relation' => 'OR',
					array(
						'key' => 'language',
						'value' => array('All', 'English'),
						'compare' => 'IN'
					),
					array('key' => 'language', 'compare' => 'NOT EXISTS')
				)
			);
		} else {
			$args = array('ignore_sticky_posts' => true, 'meta_key' => 'language', 'meta_value' => array('All', $lang['LANGUAGE']));
		}
	  
		$the_query = new WP_Query($args);

		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
				get_template_part( 'content', get_post_format($post_id) );
			endwhile;

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );
		endif;

		wp_reset_query();
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
			  $(".post").slice(0, 9).show();
			  $("#loadmore").on('click', function (e) {
			    e.preventDefault();
			    $(".post:hidden").slice(0, 9).slideDown();
			    if ($(".post:hidden").length == 0) {
			      $("#loadmore").fadeOut('slow');
			    }
			  });
			  if (<?php echo $the_query->post_count; ?> <= 9) $("#loadmore").fadeOut('fast');
			});
		</script>
	</div>
  <?php endif; ?>
</div><!-- .content-area -->

<?php get_footer(); ?>