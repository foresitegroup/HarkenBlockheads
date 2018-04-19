<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

$TheImage = VidOrImg();

if ( is_single() ) :
	?>
  <div class="site-width post-single">
	  <?php the_content(); ?>

    <div class="share-buttons">
      Share This Story<br>

      <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&picture=<?php echo $TheImage; ?>" target="new" class="facebook"></a>
      <a href="http://www.twitter.com/share?url=<?php the_permalink(); ?>&text=<?php echo str_replace(' ', '+', the_title('','',false)); ?>" target="new" class="twitter"></a>
      <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="new" class="google"></a>
      <a href="mailto:?subject=<?php echo str_replace(' ', '%20', the_title('','',false)); ?>&body=<?php the_permalink(); ?>" class="email">
    </div>
	</div>
	<?php
else :
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