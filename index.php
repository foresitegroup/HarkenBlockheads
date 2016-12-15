<?php
$SocialTitle = "#HARKENBLOCKHEADS";
include "header.php";
?>

<div class="home-posts">
  <a href="https://twitter.com/hashtag/harkenblockheads" class="header">#HARKENBLOCKHEADS</a>
  
  <?php
  $posts = get_posts('posts_per_page=3&offset=1&order=DESC&orderby=date');
  foreach ($posts as $post) :
    setup_postdata( $post );
    $TheImage = VidOrImg();
    ?>
    <a href="<?php the_permalink(); ?>" class="post">
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
  <?php endforeach; ?>
  
  <div class="centered">
    <a href="feed" class="button">MORE</a>
  </div>
</div>

<!-- <div class="home-poll">
  POLL GOES HERE<br>
  I need excruciating details on how this will work.
</div> -->

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

<?php include "footer.php"; ?>