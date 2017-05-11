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

<!-- <div class="home-poll">
  POLL GOES HERE<br>
  I need excruciating details on how this will work.
</div> -->

<?php date_default_timezone_set('America/Chicago'); ?>
<?php if (strtotime("now") >= strtotime("15 May 2017 9:00am")) { ?>
<div class="contest">
  <img src="images/red-ratchet.jpg" alt="" class="contest-image">

  <div class="site-width">
    <h1>ENTER</h1>
    <h2>TO WIN:</h2>
    <!-- <h4>CONGRATULATIONS TO</h4> -->

    <div style="clear: both;"></div>

    <div class="contest-content">
      <h3>A RED RATCHET!</h3>

      Harken is celebrating 50 years with a splash of red on our Carbo Ratchet blocks. Enter your name and email address for a chance to win one of these special edition 57mm Red Ratchet blocks. Submission closes at midnight CDT on Thursday, May 25th. FIVE winners will be announced on the Harken Blockheads <a href="https://www.facebook.com/Harken-Blockheads-1297811663614506/">Facebook page</a> at 1:00PM CDT on May 26th.

      <div class="redtext">Entry only available to residents of the USA. <a href="contest-rules.php" rel="nofollow">See Full Contest Rules Here</a>.</div>

      <?php if (strtotime("now") <= strtotime("25 May 2017 11:59pm")) { ?>
      <script type="text/javascript">
        $(document).ready(function() {
          var form = $('#contest-form');
          var formMessages = $('#contest-form-messages');
          $(form).submit(function(event) {
            event.preventDefault();

            function formValidation() {
              if ($('#name').val() === '') { alert('First and Last name required.'); $('#name').focus(); return false; }
              if ($('#email').val() === '') { alert('Email address required.'); $('#email').focus(); return false; }
              return true;
            }

            if (formValidation()) {
              var formData = $(form).serialize();
              formData += '&src=ajax';

              $.ajax({
                type: 'POST',
                url: $(form).attr('action'),
                data: formData
              })
              .done(function(response) {
                $(formMessages).html(response);

                $(form).find('input:text').val('');
                $('#email').val(''); // Grrr!
              })
              .fail(function(data) {
                if (data.responseText !== '') {
                  $(formMessages).html(data.responseText);
                } else {
                  $(formMessages).text('Oops! An error occured and your message could not be sent.');
                }
              });
            }
          });
        });
      </script>

      <?php
      // Settings for randomizing form field names
      $ip = $_SERVER['REMOTE_ADDR'];
      $timestamp = time();
      $salt = "BlockheadsContestForm";
      ?>

      <noscript>
      <?php
      $feedback = (!empty($_SESSION['feedback'])) ? $_SESSION['feedback'] : "";
      unset($_SESSION['feedback']);
      ?>
      </noscript>

      <form action="form-contest.php" method="POST" id="contest-form">
        <div>
          <input type="text" name="<?php echo md5("name" . $ip . $salt . $timestamp); ?>" id="name" placeholder="FIRST & LAST NAME">

          <input type="email" name="<?php echo md5("email" . $ip . $salt . $timestamp); ?>" id="email" placeholder="EMAIL ADDRESS">

          <input type="hidden" name="referrer" value="index.php">

          <input type="text" name="confirmationCAP" style="display: none;">

          <input type="hidden" name="ip" value="<?php echo $ip; ?>">
          <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>">

          <input type="submit" name="submit" value="SUBMIT">

          <div id="contest-form-messages"><?php echo $feedback; ?></div>
        </div>
      </form>
      <?php } else { ?>
      Sorry, entries have closed &mdash; check back at 1:00 PM CDT on Friday, May 26th to see who won.
      <?php } ?>
    </div>

    <div style="clear: both;"></div>

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