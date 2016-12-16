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
	<?php if ( have_posts() ) : ?>

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );

		// End the loop.
		endwhile;

	// If no content, include the "No posts found" template.
	else :
		get_template_part( 'content', 'none' );

	endif;

	if (!is_single()) :
	?>
  <div style="clear: both;"></div>

  <div class="centered">
		<a href="#" id="loadmore">LOAD MORE</a>
		<script type="text/javascript">
		  $(function () {
			  $(".post").slice(0, 9).show();
			  $("#loadmore").on('click', function (e) {
			    e.preventDefault();
			    $(".post:hidden").slice(0, 9).slideDown();
			    if ($(".post:hidden").length == 0) {
			      $("#load").fadeOut('slow');
			    }
			  });
			});
		</script>
	</div>
  <?php endif; ?>
</div><!-- .content-area -->

<?php get_footer(); ?>