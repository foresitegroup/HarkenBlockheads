    <?php if (isset($SocialTitle)) { ?>
    <div class="social-header">
      <div class="social-header-title<?php if (isset($SocialClass)) echo " " . $SocialClass; ?>"><?php echo $SocialTitle; ?></div>
      <div class="site-width">
        <div class="social-header-left">
          <a href="https://twitter.com/hashtag/harkenblockheads">#HARKENBLOCKHEADS</a>
          <a href="https://twitter.com/hashtag/harken">#HARKEN</a>
        </div>

        <div class="social-header-right">
          <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
          <a href="https://www.instagram.com/harkenblockhead"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          <a href="https://twitter.com/harkenblockhead"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>

    <?php
    require_once($TopDir . "inc/instafeed.php");
    require_once($TopDir . "inc/TweetPHP/stuff.php");
    ?>
    
    <div class="social-tiles cf">
      <div class="social instagram" id="instafeed-1"></div>
      
      <div class="social twitter">
        <div class="content">
          <?php echo $TweetPHP->autolink($tweet_array[0]['text']); ?>
        </div>

        <a href="https://twitter.com/harkenblockhead/status/<?php echo $tweet_array[0]['id']; ?>" class="tweet-link">@BLOCKHEADS</i></a>
      </div>

      <div class="social instagram" id="instafeed-2"></div>

      <div class="social twitter">
        <div class="content">
          <?php echo $TweetPHP->autolink($tweet_array[1]['text']); ?>
        </div>

        <a href="https://twitter.com/harkenblockhead/status/<?php echo $tweet_array[1]['id']; ?>" class="tweet-link">@BLOCKHEADS</i></a>
      </div>

      <div class="social instagram" id="instafeed-3"></div>

      <div class="social twitter">
        <div class="content">
          <?php echo $TweetPHP->autolink($tweet_array[2]['text']); ?>
        </div>

        <a href="https://twitter.com/harkenblockhead/status/<?php echo $tweet_array[2]['id']; ?>" class="tweet-link">@BLOCKHEADS</i></a>
      </div>

      <div class="social instagram" id="instafeed-4"></div>

      <div class="social twitter">
        <div class="content">
          <?php echo $TweetPHP->autolink($tweet_array[3]['text']); ?>
        </div>

        <a href="https://twitter.com/harkenblockhead/status/<?php echo $tweet_array[3]['id']; ?>" class="tweet-link">@BLOCKHEADS</i></a>
      </div>

      <div class="social instagram" id="instafeed-5"></div>

      <div class="social twitter">
        <div class="content">
          <?php echo $TweetPHP->autolink($tweet_array[4]['text']); ?>
        </div>

        <a href="https://twitter.com/harkenblockhead/status/<?php echo $tweet_array[4]['id']; ?>" class="tweet-link">@BLOCKHEADS</i></a>
      </div>
    </div>
    <?php } ?>

    <div class="footer-contact">
      <a href="<?php echo $TopDir; ?>contact.php">CONTACT</a>
    </div>

    <div class="prefooter">
      <div class="site-width">
        <img src="<?php echo $TopDir; ?>images/logo-prefooter.png" alt=""><br>
        <br>

        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </div>
    </div>

    <div class="bh-footer">
      <div class="site-width">
        <div class="bh-footer-left">
          <a href="<?php echo $TopDir; ?>join.php">JOIN</a>
          <a href="<?php echo $TopDir; ?>contact.php">CONTACT</a>
          <a href="<?php echo $TopDir; ?>terms.php">TERMS</a>
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