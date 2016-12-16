<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

$TopDir = substr( home_url(), 0, strrpos( home_url(), '/')+1);

if (!is_single()) :
  $HeaderClass = "banner-feed-index";
  $PageTitle = "Discover";
  $Description = "";
  $Keywords = "";
  $BodyClass = "line";
  $SocialTitle = "Follow Us";
  $SocialClass = "sht-join";
else :
  $HeaderClass = "banner-feed-single";
  $HeaderBackground = wp_get_attachment_url(get_post_thumbnail_id());
  $PageTitle = get_the_title();
  $TheDate = get_the_date();
endif;

include "../header.php";
?>

<div class="<?php echo $HeaderClass; ?>">
	<div class="site-width">
	  <h1><?php echo $PageTitle; ?></h1>

    <h3><?php echo $TheDate; ?></h3>
	</div>

  <?php
  if (get_post_meta(get_the_ID(), 'fv_video_embed', true)) :
    $fv = FeedVideo(get_post_meta(get_the_ID(), 'fv_video_embed', true));
    ?>
    <div class="site-width">
      <div class="video feed-video">
        <img src="<?php echo $fv[1]; ?>" data-video="<?php echo $fv[0]; ?>">
      </div>
    </div>

    <script type="text/javascript">
      $(window).load(function(){
        $('.feed-video').click(function(){
          video = '<iframe src="'+ $('.feed-video IMG').attr('data-video') +'" frameborder="0" allowfullscreen></iframe>';
          $('.feed-video IMG').replaceWith(video);
          $('.feed-video').removeClass('feed-video');
        });
      });
    </script>
  <?php else : ?>
    <div class="banner-feed-single-image"<?php if ($HeaderBackground != "") echo ' style="background-image: url(' . $HeaderBackground . ');"'; ?>></div>
  <?php endif ?>
</div>
