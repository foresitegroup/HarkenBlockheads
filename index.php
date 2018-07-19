<?php
$BodyClass = "line";
$SocialTitle = "#HARKENBLOCKHEADS";
include "header.php";
?>

<div class="home-posts">
  <a href="https://www.instagram.com/explore/tags/harkenblockheads/" class="header">#HARKENBLOCKHEADS</a>

  <?php
  if ($lang['LANGUAGE'] == "English") {
    $args = array(
      'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC', 'offset' => 1,
      'meta_query' => array('relation' => 'OR',
        array('key' => 'language', 'value' => array('All', 'English'), 'compare' => 'IN'),
        array('key' => 'language', 'compare' => 'NOT EXISTS')
      )
    );
  } else {
    $args = array(
      'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC', 'offset' => 1,
      'meta_key' => 'language', 'meta_value' => array('All', $lang['LANGUAGE'])
    );
  }
  $sr = 1;
  $posts_query = new WP_Query($args);
    while ($posts_query->have_posts() ) : $posts_query->the_post();
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
  endwhile;
  ?>

  <div class="centered">
    <a href="feed" class="button"><?php echo $lang['MORE']; ?></a>
  </div>
</div>

<?php date_default_timezone_set('America/Chicago'); ?>
<?php if (strtotime("now") <= strtotime("20 July 2018 3:00pm")) { ?>
<div id="contest">
  <div class="site-width">
    <h2>Will You Be The Fastest Blockhead To Mackinac Island?</h2>

    <img src="images/race-to-mac-2017-winner.jpg" alt="">

    <div class="text">
      <h3>Register for the First Blockhead to the Island Award</h3>

      The 110th Chicago Yacht Club Race to Mackinac&reg; presents an exclusive award given to the first Blockhead to reach the island. You must be a member of Blockheads before the race begins in order to be eligible for this award. Sign up for your free membership today and let us know which boat you are racing on. Already a member? Fill out the same form, including your member ID number, if possible, and boat info, to be entered for the award. The First Blockhead to the Island Award will be presented at the awards party on Tuesday, July 24, on Mackinac Island. Sail fast!
      <br>

      <a href="join.php?award" class="button">SIGN UP</a>
    </div>
  </div>
</div>
<?php } else { ?>
<div id="contest">
  <div class="site-width">
    <h2>Will You Be The Fastest Blockhead To Mackinac Island?</h2>

    <img src="images/race-to-mac-2017-winner.jpg" alt="">

    <div class="text">
      <h3>Sorry, Entries are Now Closed for the First Blockhead to the Island Award</h3>

      The 110th Chicago Yacht Club Race to Mackinac&reg; presents an exclusive award given to the first Blockhead to reach the island. The First Blockhead to the Island Award will be presented at the awards party on Tuesday, July 24, on Mackinac Island. Sail fast!
      <br>

      <a href="http://yb.tl/chicagomack2018" class="button">TRACK THE FLEET</a>
    </div>
  </div>
</div>
<?php } ?>

<div class="home-event">
  <?php
  $NoEvents = "";

  include_once "inc/dbconfig.php";

  $now = time();

  $result = $mysqli->query("SELECT * FROM events WHERE enddate+86400 >= $now ORDER BY startdate ASC LIMIT 1");

  // If there are no upcoming events just display the last event
  if (mysqli_num_rows($result) == 0) $result = $mysqli->query("SELECT * FROM events ORDER BY enddate DESC LIMIT 1");

  if (mysqli_num_rows($result) > 0) {
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
  } else {
    // Empty database
    $NoEvents = "true";
  }

  if ($NoEvents == "") {
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
  <?php } ?>
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