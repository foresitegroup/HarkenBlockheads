<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

$TopDir = substr( home_url(), 0, strrpos( home_url(), '/')+1);

if (!is_single()) :
  $SocialTitle = "Follow Us";
  $SocialClass = "sht-join";
else :
  $orig_post = $post;
  global $post;
  $cats = wp_get_post_categories($post->ID);
  $tags = wp_get_post_tags($post->ID);
  
  if ($cats || $tags) {
    $args = array(
      'category__in' => $cats,
      // 'tag__in' => $tags,
      'post__not_in' => array($post->ID),
      'posts_per_page'=>4 // Number of related posts to display.
    );
    
    $my_query = new wp_query($args);
    
    if ($my_query->post_count > 0) {
      echo "<div class=\"home-posts post-rec cf\">\n";
      echo "<h4>RECOMMENDED</h4>\n";

      while($my_query->have_posts()) {
        $my_query->the_post();
        $TheImage = VidOrImg();
        ?>
        <a href="<?php the_permalink(); ?>" class="post">
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
      }

      echo "</div>";

      ?>
      <script type="text/javascript">
        $(document).ready(function() { $(".footer-contact").addClass("dark"); });
      </script>
      <?php
    }
  }
  $post = $orig_post;
  // wp_reset_query();
endif;

include "../footer.php";
?>