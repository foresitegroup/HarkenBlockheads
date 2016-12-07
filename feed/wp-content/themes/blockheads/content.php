<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

if ( is_single() ) :
	?>
  <div class="site-width post-single">
	  <?php the_content(); ?>

    <?php echo do_shortcode('[ssba]'); ?>
	</div>
	<?php
else :
  $TheImage = VidOrImg();
	?>
	<a href="<?php the_permalink(); ?>" class="post" style="display: none;">
		<div class="image"<?php if ($TheImage != "") echo ' style="background-image: url(' . $TheImage . ');"'; ?>></div>

		<h3>
			<?php
		  $i = 0;
      foreach((get_the_category()) as $category) {
        if ($i > 0) echo ", ";
        echo $category->cat_name;
        $i++;
      }
      ?>
    </h3>

		<h2><?php the_title(); ?></h2>

		<?php echo get_the_excerpt(); ?>
	</a>
	<?php
endif;
?>