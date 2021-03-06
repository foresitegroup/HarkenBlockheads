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
    
    <!-- BEGIN Instagram Feed Wordpress plugin -->
    <?php require_once('feed/wp-blog-header.php'); ?>
    <link rel='stylesheet' href='<?php echo $TopDir; ?>feed/wp-content/plugins/instagram-feed/css/sb-instagram.min.css' type='text/css' media='all' />
    <?php echo do_shortcode('[instagram-feed]'); ?>
    <script type='text/javascript'>
      var sbiajaxurl = "<?php echo $TopDir; ?>feed/wp-admin/admin-ajax.php";
      var sb_instagram_js_options = {"sb_instagram_at":"","font_method":"svg"};
    </script>
    <script type='text/javascript' src='<?php echo $TopDir; ?>feed/wp-content/plugins/instagram-feed/js/sb-instagram.min.js'></script>
    <!-- END Instagram Feed Wordpress plugin -->
    <?php } ?>

    <div class="footer-contact">
      <a href="<?php echo $TopDir; ?>contact.php"><?php echo $lang['CONTACT']; ?></a>
    </div>

    <div class="prefooter">
      <div class="site-width">
        <img src="<?php echo $TopDir; ?>images/logo-prefooter.png" alt=""><br>
        <br>

        <?php echo $lang['BLOCKHEAD']; ?>
      </div>
    </div>

    <div class="bh-footer">
      <div class="site-width">
        <div class="bh-footer-left">
          <a href="<?php echo $TopDir; ?>join.php"><?php echo $lang['JOIN']; ?></a>
          <a href="<?php echo $TopDir; ?>contact.php"><?php echo $lang['CONTACT']; ?></a>
          <a href="<?php echo $TopDir; ?>terms.php"><?php echo $lang['TERMS']; ?></a>
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