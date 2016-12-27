    <?php if (isset($SocialTitle)) { ?>
    <div class="social-header">
      <div class="social-header-title<?php if (isset($SocialClass)) echo " " . $SocialClass; ?>"><?php echo $SocialTitle; ?></div>
      <div class="site-width">
        <div class="social-header-left">
          <a href="https://twitter.com/hashtag/harkenblockheads">#HARKENBLOCKHEADS</a>
          <a href="https://twitter.com/hashtag/harken">#HARKEN</a>
        </div>

        <div class="social-header-right">
          <a href="https://www.facebook.com/Harken-Blockheads-1297811663614506/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
          <a href="https://www.instagram.com/harkenblockhead"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          <a href="https://twitter.com/harkenblockhead"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <a href="https://www.youtube.com/playlist?list=PLVKzKD5m_w-UnpQCMFmcQxMbvPVztFtqI"><i class="fa fa-youtube" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>

    <?php
    require_once("inc/instafeed.php");
    require_once("inc/TweetPHP/stuff.php");
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

        What exactly is a Blockhead? If you are totally obsessed with how to rig and sail your boat, you might already be one! Join the community of Blockheads to learn more about the sport, engage with others and share sailing experiences. This site serves as the hub for Blockheads globally, where you can discover how to join, media, tips and tricks, contests, and events. This program is all about YOU and we want to hear from everyone! Not seeing something? Your feedback is crucial, feel free to shoot us a comment or message.
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
          <a href="https://www.facebook.com/harkenblockheads"><i class="fa fa-facebook" aria-hidden="true"></i></a>
          <a href="https://www.instagram.com/harkenblockhead"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          <a href="https://twitter.com/harkenblockhead"><i class="fa fa-twitter" aria-hidden="true"></i></a>
          <a href="https://www.youtube.com/playlist?list=PLVKzKD5m_w-UnpQCMFmcQxMbvPVztFtqI"><i class="fa fa-youtube" aria-hidden="true"></i></a>
        </div>

        <div style="clear: both;"></div>

        &copy; <?php echo date("Y"); ?> All rights reserved, Harken Inc.
      </div>
    </div>

  </body>
</html>