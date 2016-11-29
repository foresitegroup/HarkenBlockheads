<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Harken Blockheads<?php if ($PageTitle != "") echo " | " . $PageTitle; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Foresite Group">

    <meta name="viewport" content="width=device-width">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800|Work+Sans:900" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="inc/main.css?<?php echo filemtime('inc/main.css'); ?>">

    <script type="text/javascript" src="inc/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="inc/jquery.waypoints.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("a[href^='http'], a[href$='.pdf']").not("[href*='" + window.location.host + "']").attr('target','_blank');

        $(".menu-spacer").waypoint(function(direction) {
          $(".menu").toggleClass("sticky", direction == "down");
          $(".menu-spacer").toggleClass("sticky", direction == "down");
        });
      });
    </script>
  </head>
  <body>

    <div class="home-banner">
      <div class="image" style="background-image: url(images/blog1.jpg);"></div>

      <div class="site-width">
        <div class="home-banner-left">
          <a href="."><img src="images/logo.png" alt=""></a>
        </div>

        <div class="home-banner-right">
          <h3>LATEST:</h3>

          <h1>Orange Bowl Regatta</h1>

          <a href="#" class="button">READ</a>

          <a href="#">SEE MORE <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
    
    <div class="menu-spacer"></div>

    <div class="menu">
      <div class="site-width">
        <div class="menu-logo">
          <a href="."><img src="images/logo-menu.png" alt=""></a>
          <a href="https://twitter.com/hashtag/harkenblockheads">#HARKENBLOCKHEADS</a>
        </div>

        <ul>
          <li><a href="#">JOIN.</a></li>
          <li><a href="#">FEED.</a></li>
          <li><a href="#">EVENTS.</a></li>
        </ul>
      </div>
    </div>
    
    <div class="home-posts">
      <a href="https://twitter.com/hashtag/harkenblockheads" class="header">#HARKENBLOCKHEADS</a>

      <div class="post">
        <div class="image" style="background-image: url(images/blog2.jpg);"></div>

        <h3>Media</h3>

        <h2>Orange Bowl Regatta Weekend Recap</h2>

        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </div>

      <div class="post">
        <div class="image" style="background-image: url(images/blog3.jpg);"></div>

        <h3>Film</h3>

        <h2>Dodo's Delight a Short Sailing Film</h2>

        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </div>

      <div class="post">
        <div class="image" style="background-image: url(images/blog4.jpg);"></div>

        <h3>Photo</h3>

        <h2>Blockhead Adventure #02</h2>

        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
      </div>

      <a href="#" class="button">MORE</a>
    </div>

    <div class="home-poll">
      POLL GOES HERE<br>
      I need excruciating details on how this will work.
    </div>

    <div class="home-event">
      <div class="image" style="background-image: url(images/event1.jpg);"></div>

      <div class="site-width">
        <div class="header">NEXT EVENT</div>

        <div class="event">
          <div class="event-left">
            <div class="event-month">December</div>
            <div class="event-date">26-28</div>

            <a href="#" class="button">VIEW EVENT</a>
          </div>

          <div class="event-right">
            Orange Bowl Regatta
          </div>

          <div style="clear: both;"></div>
        </div>

        <a href="#" class="more">+ MORE EVENTS</a>
      </div>
    </div>

    <div class="home-social-header">
      <div class="site-width">
        <div class="home-social-header-left">
          <a href="https://twitter.com/hashtag/harkenblockheads">#HARKENBLOCKHEADS</a>
          <a href="https://twitter.com/hashtag/harken">#HARKEN</a>
        </div>

        <div class="home-social-header-right">
          <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
          <a href="https://www.instagram.com/harkenblockhead"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          <a href="https://twitter.com/harkenblockhead"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>

    <?php
    require_once("inc/instafeed.php");
    require_once("inc/TweetPHP/stuff.php");
    ?>
    
    <div class="home-social instagram" id="instafeed-1"></div>
    
    <div class="home-social twitter">
      <div class="content">
        <?php echo $TweetPHP->autolink($tweet_array[0]['text']); ?>
      </div>

      <a href="https://twitter.com/harkenblockhead/status/<?php echo $tweet_array[0]['id']; ?>" class="tweet-link">@BLOCKHEADS</i></a>
    </div>

    <div class="home-social instagram" id="instafeed-2"></div>

    <div class="home-social twitter">
      <div class="content">
        <?php echo $TweetPHP->autolink($tweet_array[1]['text']); ?>
      </div>

      <a href="https://twitter.com/harkenblockhead/status/<?php echo $tweet_array[1]['id']; ?>" class="tweet-link">@BLOCKHEADS</i></a>
    </div>

    <div class="home-social instagram" id="instafeed-3"></div>

    <div class="home-social twitter">
      <div class="content">
        <?php echo $TweetPHP->autolink($tweet_array[2]['text']); ?>
      </div>

      <a href="https://twitter.com/harkenblockhead/status/<?php echo $tweet_array[2]['id']; ?>" class="tweet-link">@BLOCKHEADS</i></a>
    </div>

    <div class="home-social instagram" id="instafeed-4"></div>

    <div class="home-social twitter">
      <div class="content">
        <?php echo $TweetPHP->autolink($tweet_array[3]['text']); ?>
      </div>

      <a href="https://twitter.com/harkenblockhead/status/<?php echo $tweet_array[3]['id']; ?>" class="tweet-link">@BLOCKHEADS</i></a>
    </div>

    <div class="home-social instagram" id="instafeed-5"></div>

    <div class="home-social twitter">
      <div class="content">
        <?php echo $TweetPHP->autolink($tweet_array[4]['text']); ?>
      </div>

      <a href="https://twitter.com/harkenblockhead/status/<?php echo $tweet_array[4]['id']; ?>" class="tweet-link">@BLOCKHEADS</i></a>
    </div>

    <div style="clear: both;"></div>

    <div class="home-contact">
      <a href="#">CONTACT</a>
    </div>

    <div class="home-prefooter">
      <div class="site-width">
        <img src="images/logo-prefooter.png" alt=""><br>
        <br>

        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
    </div>

    <div class="bh-footer">
      <div class="site-width">
        <div class="bh-footer-left">
          <a href="#">JOIN</a>
          <a href="#">CONTACT</a>
          <a href="#">TERMS</a>
        </div>

        <div class="bh-footer-right">
          <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
          <a href="https://www.instagram.com/harkenblockhead"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          <a href="https://twitter.com/harkenblockhead"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
        </div>

        <div style="clear: both;"></div>

        &copy; <?php echo date("Y"); ?> All rights reserved, Harken Inc.
      </div>
    </div>

  </body>
</html>