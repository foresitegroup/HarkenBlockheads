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
    
    <script type="text/javascript">
      jQuery(document).ready(function(){
        var jqxhr = jQuery.ajax("https://apinsta.herokuapp.com/u/harkenblockhead").done(function() {
        }).fail(function() {
        }).always(function(data) {
          items = data.graphql.user.edge_owner_to_timeline_media.edges;
          jQuery.each(items, function(n, item) {
            if((n+1) <= 10) {
              var data_links = '<a href="https://www.instagram.com/p/'+item.node.shortcode+'" style="background-image: url('+item.node.thumbnail_src+');"" target="new"></a>';
              jQuery("#instafeed").append(data_links);
            }
          });
        });
      });
    </script>
    <div id="instafeed"></div>
    <!-- <div class="social-tiles cf"> -->
      <?php
      // $count = 1;
      // $json = json_decode(file_get_contents('https://apinsta.herokuapp.com/u/harkenblockhead'));
      // foreach ($json->graphql->user->edge_owner_to_timeline_media->edges as $key => $value) {
      //   if ($count <= 10) {
      //     echo '<a href="'.'https://www.instagram.com/p/'.$value->node->shortcode.'" style="background-image: url('.$value->node->thumbnail_src.');" class="social instagram"></a>';
      //   } else {
      //     break;
      //   }
      //   $count++;
      // }
      ?>
    <!-- </div> -->
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