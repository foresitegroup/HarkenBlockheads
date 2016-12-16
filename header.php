<?php
session_start();

if (!isset($TopDir)) $TopDir = "";

function email($address, $name="") {
  $email = "";
  for ($i = 0; $i < strlen($address); $i++) { $email .= (rand(0, 1) == 0) ? "&#" . ord(substr($address, $i)) . ";" : substr($address, $i, 1); }
  if ($name == "") $name = $email;
  echo "<a href=\"&#109;&#97;&#105;&#108;&#116;&#111;&#58;$email\">$name</a>";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Harken Blockheads<?php if (isset($PageTitle)) echo " | " . $PageTitle; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $TopDir; ?>images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo $TopDir; ?>images/apple-touch-icon.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Foresite Group">

    <meta name="viewport" content="width=device-width">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800|Work+Sans:900" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $TopDir; ?>inc/swipebox/swipebox.css">
    <link rel="stylesheet" href="<?php echo $TopDir; ?>inc/main.css<?php if ($TopDir == "") echo '?'.filemtime('inc/main.css'); ?>">

    <script type="text/javascript" src="<?php echo $TopDir; ?>inc/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="<?php echo $TopDir; ?>inc/jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="<?php echo $TopDir; ?>inc/swipebox/jquery.swipebox.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("a[href^='http'], a[href$='.pdf']").not("[href*='" + window.location.host + "']").attr('target','_blank');

        $(".menu-spacer").waypoint(function(direction) {
          $(".menu").toggleClass("sticky", direction == "down");
          $(".menu-spacer").toggleClass("sticky", direction == "down");
        });

        $(".swipebox").swipebox({hideBarsDelay : 0});
      });
    </script>
  </head>
  <body<?php if (isset($BodyClass)) echo " class=\"" . $BodyClass . "\""; ?>>
    
    <?php if (!isset($PageTitle)) { ?>
    <div class="home-banner">
      <?php
      require('feed/wp-blog-header.php');
      $posts = get_posts('posts_per_page=1&order=DESC&orderby=date');
      foreach ($posts as $post) :
        setup_postdata($post);
      ?>
      <div class="image"<?php if (get_post_thumbnail_id() != "") echo "style=\"background-image: url(" . wp_get_attachment_url(get_post_thumbnail_id()) . ");\""; ?>></div>

      <div class="site-width">
        <div class="home-banner-left">
          <a href="."><img src="images/logo.png" alt=""></a>
        </div>

        <div class="home-banner-right">
          <div>
            <h3>LATEST:</h3>

            <h1><?php the_title(); ?></h1>

            <a href="<?php the_permalink(); ?>" class="button">READ</a>

            <a href="feed" class="more">SEE MORE <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php } ?>
    
    <div class="menu-spacer"></div>

    <div class="menu">
      <div class="site-width">
        <div class="menu-logo">
          <a href="<?php echo $TopDir; ?>."><img src="<?php echo $TopDir; ?>images/logo-menu.png" alt=""> #HARKENBLOCKHEADS</a>
        </div>
        
        <input type="checkbox" id="show-menu" role="button">
        <label for="show-menu" id="menu-toggle"></label>
        <ul>
          <li><a href="<?php echo $TopDir; ?>join.php">JOIN.</a></li>
          <li><a href="<?php echo $TopDir; ?>feed">FEED.</a></li>
          <li><a href="<?php echo $TopDir; ?>events.php">EVENTS.</a></li>
          <li class="menu-social">
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="https://www.instagram.com/harkenblockhead"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="https://twitter.com/harkenblockhead"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
          </li>
        </ul>
      </div>
    </div>
