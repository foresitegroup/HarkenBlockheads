<?php
$BodyClass = "line";
$SocialTitle = "#HARKENBLOCKHEADS";
include "header.php";
?>

<div class="home-posts">
  <a href="https://www.instagram.com/explore/tags/harkenblockheads/" class="header">#HARKENBLOCKHEADS</a>

  <?php
  $posts = get_posts('posts_per_page=3&offset=1&order=DESC&orderby=date');
  $sr = 1;
  foreach ($posts as $post) :
    setup_postdata( $post );
    $TheImage = VidOrImg();
    ?>
    <a href="<?php the_permalink(); ?>" class="post sr<?php echo $sr; ?>">
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
    $sr++;
  endforeach;
  ?>

  <div class="centered">
    <a href="feed" class="button">MORE</a>
  </div>
</div>

<?php date_default_timezone_set('America/Chicago'); ?>
<?php if (strtotime("now") <= strtotime("15 July 2017 2:00pm")) { ?>
<div id="contest">
  <div class="site-width">
    <h2>Will You Be The Fastest Blockhead To Mackinac Island?</h2>

    <img src="images/mackinac-award.jpg" alt="">

    <div class="text">
      <h3>Register for the First Blockhead to the Island Award</h3>

      New for the 109th Chicago Yacht Club Race to Mackinac&reg;, an exclusive award will be given out to the first Blockhead to reach the island. You must be a member of Blockheads before the race begins in order to be eligible for the award. Sign up for your free membership and let us know which boat you are racing on. We ask that current Blockheads fill out the same form and include your member ID number, if possible, and boat info. The award will be presented at the party on Tuesday, July 18th on Mackinac Island. Sail fast!
      <br>

      <a href="join.php?award" class="button">SIGN UP</a>
    </div>
  </div>
</div>
<?php } ?>

<div class="home-event">
  <?php
  include_once "inc/dbconfig.php";

  $now = time();

  $result = $mysqli->query("SELECT * FROM events WHERE enddate+86400 >= $now ORDER BY startdate ASC LIMIT 1");

  // If there are no upcoming events just display the last event
  if (mysqli_num_rows($result) == 0) $result = $mysqli->query("SELECT * FROM events ORDER BY enddate DESC LIMIT 1");

  $row = $result->fetch_array(MYSQLI_ASSOC);

  $TheDate = '<div class="event-month">' . date("F", $row['startdate']) . '</div>';
  $TheDate .= '<div class="event-date">' . date("j", $row['startdate']);

  if ($row['startdate'] != $row['enddate']) {
    $TheDate .= "-";

    if (date("F", $row['startdate']) != date("F", $row['enddate'])) {
      $TheDate .= '</div>';
      $TheDate .= '<div class="event-month">' . date("F", $row['enddate']) . '</div>';
      $TheDate .= '<div class="event-date">';
    }

    $TheDate .= date("j", $row['enddate']);
  }
  $TheDate .= '</div>';
  ?>
  <div class="image"<?php if ($row['image'] != "") echo "style=\"background-image: url(images/events/" . $row['image'] . ");\""; ?>></div>

  <div class="site-width">
    <div class="header">NEXT EVENT</div>

    <div class="event">
      <div class="event-left">
        <?php echo $TheDate; ?>

        <a href="event.php?<?php echo $row['id']; ?>" class="button">VIEW EVENT</a>
      </div>

      <div class="event-right">
        <?php echo $row['title']; ?>
      </div>

      <div style="clear: both;"></div>
    </div>

    <a href="events.php" class="more">+ MORE EVENTS</a>
  </div>
</div>

<script type="text/javascript" src="inc/scrollreveal.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    window.sr = ScrollReveal();
    var customAni = { distance: 0, duration: 0, opacity: 1, scale: 1, viewFactor: 0, reset: true }

    sr.reveal('.sr1', { origin: 'left' });
    sr.reveal('.sr2', { origin: 'bottom', delay: 200 });
    sr.reveal('.sr3', { origin: 'right', delay: 400 });

    sr.reveal('.footer-contact A', {
      beforeReveal: function (el) { el.classList.add('pulse'); },
      beforeReset: function (el) { el.classList.remove('pulse'); },
      customAni
    });
  });
</script>

<?php include "footer.php"; ?>