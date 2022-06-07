<?php
session_start();

if (!isset($TopDir)) $TopDir = "";

function email($address, $name="") {
  $email = "";
  for ($i = 0; $i < strlen($address); $i++) { $email .= (rand(0, 1) == 0) ? "&#" . ord(substr($address, $i)) . ";" : substr($address, $i, 1); }
  if ($name == "") $name = $email;
  echo "<a href=\"&#109;&#97;&#105;&#108;&#116;&#111;&#58;$email\">$name</a>";
}

if (!isset($langpath)) $langpath = ""; // For Wordpress

if (isset($_REQUEST['lang']) && (is_file($langpath . "language/" . $_REQUEST['lang'] . ".ini") == true)) {
  setcookie("HBlang", $_REQUEST['lang'], strtotime("+1 year"), "/");
  $language = $_REQUEST['lang'];

  $loc = (!(empty($_SERVER['HTTP_REFERER']))) ? $_SERVER['HTTP_REFERER'] : $_SERVER['PHP_SELF'];
  header("Location: " . $loc);
} else {
  $language = (isset($_COOKIE['HBlang'])) ? $_COOKIE['HBlang'] : "english";
}

global $lang; // For Wordpress
$lang = parse_ini_file($langpath . "language/" . $language . ".ini");

if (isset($PageTitleLang)) $PageTitle = $lang[$PageTitleLang];
if (isset($PageTitleLangPlus)) $PageTitle .= $PageTitleLangPlus;
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
    
    <meta property="og:title" content="Harken Blockheads<?php if (isset($PageTitle)) echo " | " . $PageTitle; ?>" />
    <meta property="twitter:title" content="Harken Blockheads<?php if (isset($PageTitle)) echo " | " . $PageTitle; ?>" />
    <?php
    if (isset($OGdescription)) echo "<meta property=\"og:description\" content=\"".$OGdescription."\" />\n";
    if (isset($OGimage)) {
      echo "<meta property=\"og:image\" content=\"http://harkenblockheads.com/images/".$OGimage."\" />\n";
      echo "<meta property='twitter:image' content=\"http://harkenblockheads.com/images/".$OGimage."\" />\n";
      echo "<meta name=\"twitter:card\" content=\"summary_large_image\" />\n";
    }

    if(function_exists('wp_head')) wp_head();
    ?>

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
    
    <!-- Google Analytics [This will stop working 7/1/23] -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-90627023-1', 'auto');
      ga('send', 'pageview');
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PSSVQ9Z93P"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-PSSVQ9Z93P');
    </script>
  </head>
  <body class="<?php echo $language; if (isset($BodyClass)) echo " " . $BodyClass; ?>">
    
    <?php if (!isset($PageTitle)) { ?>
    <div class="home-banner">
      <?php
      require('feed/wp-blog-header.php');
      global $wpdb;

      if ($lang['LANGUAGE'] == "English") {
        $args = array(
          'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'DESC',
          'ignore_sticky_posts' => true,
          'meta_query' => array('relation' => 'OR',
            array('key' => 'language', 'value' => array('All', 'English'), 'compare' => 'IN'),
            array('key' => 'language', 'compare' => 'NOT EXISTS')
          )
        );
      } else {
        $args = array(
          'posts_per_page' => 1, 'orderby' => 'date', 'order' => 'DESC',
          'ignore_sticky_posts' => true,
          'meta_key' => 'language', 'meta_value' => array('All', $lang['LANGUAGE'])
        );
      }

      $hero_query = new WP_Query($args);
      while ($hero_query->have_posts() ) : $hero_query->the_post();
        if (get_post_meta(get_the_ID(), 'fv_video_embed', true)) {
          $fv = FeedVideo(get_post_meta(get_the_ID(), 'fv_video_embed', true));
          $FeedImage = $fv[1];
        }

        if (get_post_thumbnail_id() != "") $FeedImage = wp_get_attachment_url(get_post_thumbnail_id());
      ?>
      <div class="image"<?php if ($FeedImage != "") echo "style=\"background-image: url(" . $FeedImage . ");\""; ?>></div>

      <div class="site-width">
        <div class="home-banner-left">
          <a href="."><img src="images/logo.png" alt=""></a>
        </div>

        <div class="home-banner-right">
          <div>
            <h3><?php echo $lang['LATEST']; ?>:</h3>

            <h1><?php the_title(); ?></h1>

            <a href="<?php the_permalink(); ?>" class="button"><?php echo $lang['READ']; ?></a>

            <a href="feed" class="more"><?php echo $lang['SEE_MORE']; ?> <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
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
          <li><a href="<?php echo $TopDir; ?>join.php"<?php if (isset($MenuClass) && $MenuClass == "join") echo ' class="active"'; ?>><?php echo $lang['JOIN']; ?>.</a></li>
          <li><a href="<?php echo $TopDir; ?>feed"<?php if (isset($MenuClass) && $MenuClass == "feed") echo ' class="active"'; ?>><?php echo $lang['FEED']; ?>.</a></li>
          <li><a href="<?php echo $TopDir; ?>events.php"<?php if (isset($MenuClass) && $MenuClass == "events") echo ' class="active"'; ?>><?php echo $lang['EVENTS']; ?>.</a></li>
          <li><a href="<?php echo $TopDir; ?>wallpapers.php"<?php if (isset($MenuClass) && $MenuClass == "wallpapers") echo ' class="active"'; ?>><?php echo $lang['WALLPAPERS_TITLE']; ?>.</a></li>
          <li class="menu-social">
            <a href="https://www.facebook.com/Harken-Blockheads-1297811663614506/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="https://www.instagram.com/harkenblockhead"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <!-- <a href="https://twitter.com/harkenblockhead"><i class="fa fa-twitter" aria-hidden="true"></i></a> -->
            <a href="https://www.youtube.com/playlist?list=PLVKzKD5m_w-UnpQCMFmcQxMbvPVztFtqI"><i class="fa fa-youtube" aria-hidden="true"></i></a>
          </li>

          <li>
            <form name="Language" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="language">
              <div>
                <select name="lang" onchange="document.Language.submit()">
                  <option value="english"<?php if ($language == "english") echo " selected"; ?>>English</option>
                  <option value="spanish"<?php if ($language == "spanish") echo " selected"; ?>>Espa&ntilde;ol</option>
                  <option value="polish"<?php if ($language == "polish") echo " selected"; ?>>Polski</option>
                </select>
              </div>
            </form>
          </li>
        </ul>
      </div>
    </div>
