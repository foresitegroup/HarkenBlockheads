    <?php if (isset($SocialTitle)) { ?>
    <div class="social-header">
      <div class="social-header-title<?php if (isset($SocialClass)) echo " " . $SocialClass; ?>"><?php echo $SocialTitle; ?></div>
      <div class="site-width">
        <div class="social-header-left">
          <a href="https://www.instagram.com/explore/tags/harkenblockheads">#HARKENBLOCKHEADS</a>
          <a href="https://www.instagram.com/explore/tags/harken">#HARKEN</a>
        </div>

        <div class="social-header-right">
          <a href="https://www.facebook.com/Harken-Blockheads-1297811663614506/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
          <a href="https://www.instagram.com/harkenblockhead"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          <!-- <a href="https://twitter.com/harkenblockhead"><i class="fa fa-twitter" aria-hidden="true"></i></a> -->
          <a href="https://www.youtube.com/playlist?list=PLVKzKD5m_w-UnpQCMFmcQxMbvPVztFtqI"><i class="fa fa-youtube" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>

    <div class="social-tiles cf">
      <?php
      require_once("inc/instafeed.php");
      for ($i=1; $i <= 10; $i++) {
        echo "<a href=\"https://www.instagram.com/harkenblockhead\" class=\"social instagram\" id=\"instafeed-" . $i . "\"></a>\n";
      }
      ?>
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
          <a href="https://www.facebook.com/Harken-Blockheads-1297811663614506/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
          <a href="https://www.instagram.com/harkenblockhead"><i class="fa fa-instagram" aria-hidden="true"></i></a>
          <!-- <a href="https://twitter.com/harkenblockhead"><i class="fa fa-twitter" aria-hidden="true"></i></a> -->
          <a href="https://www.youtube.com/playlist?list=PLVKzKD5m_w-UnpQCMFmcQxMbvPVztFtqI"><i class="fa fa-youtube" aria-hidden="true"></i></a>
        </div>

        <div style="clear: both;"></div>

        &copy; <?php echo date("Y"); ?> All rights reserved, Harken Inc.
      </div>
    </div>

  </body>
</html>