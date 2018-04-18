<?php
// $PageTitleLang = "JOIN_TITLE";
$PageTitle = "Volvo Ocean Race Newport VIP Experience Sweepstakes";
$SocialTitle = "Follow Us";
$SocialClass = "sht-join";
include "header.php";
?>

<div class="site-width join">
  <?php date_default_timezone_set('America/Chicago'); ?>
  <?php if (strtotime("now") <= strtotime("19 April 2018 11:59:59pm")) { ?>
  <h1 class="pagetitle"><?php echo $PageTitle; ?></h1>

  Two Blockheads and two guests will be randomly selected to join the Harken team on May 16th and 17th for an all-access experience at the Volvo Ocean Race stopover in Newport, Rhode Island.<br>
  <br>

  Entries close on April 19th at midnight CST. Winners will be announced on April 20th at noon CST through the Harken Blockheads <a href="https://www.facebook.com/Harken-Blockheads-1297811663614506/">Facebook</a> and <a href="https://www.instagram.com/harkenblockhead">Instagram</a> pages. This sweepstakes is open only to Blockheads members who are residents of the United States. If a winner is under 18 years of age, their guest must be a parent or legal guardian. Airfare and lodging are not included as part of the prize<br>
  <br>

  <script type="text/javascript">
    $(document).ready(function() {
      var form = $('#join-form');
      var formMessages = $('#join-form-messages');
      $(form).submit(function(event) {
        event.preventDefault();

        function formValidation() {
          if ($('#firstname').val() === '') { alert('First name required.'); $('#firstname').focus(); return false; }
          if ($('#lastname').val() === '') { alert('Last name required.'); $('#lastname').focus(); return false; }
          if ($('#age').val() === '') { alert('Age required.'); $('#age').focus(); return false; }
          if ($('#email').val() === '') { alert('Email address required.'); $('#email').focus(); return false; }
          if ($('#address').val() === '') { alert('Address required.'); $('#address').focus(); return false; }
          if ($('#city').val() === '') { alert('City required.'); $('#city').focus(); return false; }
          if ($('#state').val() === '') { alert('State required.'); $('#state').focus(); return false; }
          if ($('#zip').val() === '') { alert('Zip required.'); $('#zip').focus(); return false; }

          if (!$('input[name=resident]:checked').val()) { alert('Sorry, you must be a US resident to enter.'); return false; }

          if (!$('input[name=member]:checked').val()) { alert('You must indicate if you are a Blockheads member or not.'); return false; }

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

            $(form).find('input:text, textarea').val('');
            $('#email').val(''); // Grrr!
            $(form).find('input:radio, input:checked').removeAttr('checked').removeAttr('selected');
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

      $('#r-terms').click(function(){
        $('#submit').prop("disabled", !this.checked);
      });

      $('#age').blur(function() {
        if (($('#age').val() != "") && ($('#age').val() < 13)) {
          $('#join-form :input').prop("disabled", true);
          $('#join-form > DIV').addClass("tooyoung");
        }
      });
    });
  </script>

  <?php
  // Settings for randomizing form field names
  $ip = $_SERVER['REMOTE_ADDR'];
  $timestamp = time();
  $salt = "BlockheadsSweepstakesForm";
  ?>

  <noscript>
  <?php
  $feedback = (!empty($_SESSION['feedback'])) ? $_SESSION['feedback'] : "";
  unset($_SESSION['feedback']);
  ?>
  </noscript>

  <form action="form-sweepstakes.php" method="POST" id="join-form">
    <div>
      <div class="parent-popup">
        <?php echo $lang['POP_UP'];?>
      </div>

      <input type="text" name="<?php echo md5("firstname" . $ip . $salt . $timestamp); ?>" id="firstname" placeholder="<?php echo $lang['FIRST_NAME']; ?>">

      <input type="text" name="<?php echo md5("lastname" . $ip . $salt . $timestamp); ?>" id="lastname" placeholder="<?php echo $lang['LAST_NAME']; ?>">

      <input type="text" name="<?php echo md5("age" . $ip . $salt . $timestamp); ?>" id="age" placeholder="<?php echo $lang['AGE']; ?>">

      <div style="clear: both;"></div>

      <input type="email" name="<?php echo md5("email" . $ip . $salt . $timestamp); ?>" id="email" placeholder="<?php echo $lang['EMAIL']; ?>">

      <input type="text" name="<?php echo md5("address" . $ip . $salt . $timestamp); ?>" id="address" placeholder="<?php echo $lang['ADDRESS']; ?>">

      <input type="text" name="<?php echo md5("address2" . $ip . $salt . $timestamp); ?>" id="address2" placeholder="<?php echo $lang['ADDRESS2']; ?>">

      <input type="text" name="<?php echo md5("city" . $ip . $salt . $timestamp); ?>" id="city" placeholder="<?php echo $lang['CITY']; ?>">

      <input type="text" name="<?php echo md5("state" . $ip . $salt . $timestamp); ?>" id="state" placeholder="<?php echo $lang['STATE']; ?>">

      <input type="text" name="<?php echo md5("zip" . $ip . $salt . $timestamp); ?>" id="zip" placeholder="<?php echo $lang['ZIP']; ?>">

      <div style="clear: both;"></div>

      <input type="checkbox" name="resident" value="I am a resident of the United States" id="r-resident">
      <label for="r-resident">I am a resident of the United States</label><br>
      <br>

      <input type="radio" name="member" value="I am a current Blockheads member entering this sweepstakes." id="r-current"> <label for="r-current">I am a current Blockheads member entering this sweepstakes.</label><br>
      <input type="radio" name="member" value="I am not a Blockheads member and would like to sign-up for a free membership and enter this sweepstakes." id="r-new"> <label for="r-new">I am not a Blockheads member and would like to sign-up for a free membership and enter this sweepstakes.</label><br>

      <div class="centered">
        Parents, learn more about Blockheads membership <a href="parents.php">here</a>.<br>

        <input type="checkbox" name="terms" value="" id="r-terms">
        <label for="r-terms">I agree to the <a href="terms.php">Terms &amp; Services</a> and <a href="pdf/Sweepstakes.pdf">Rules</a> of this sweepstakes.</label>
      </div>

      <input type="hidden" name="referrer" value="sweepstakes.php">

      <input type="text" name="confirmationCAP" style="display: none;">

      <input type="hidden" name="ip" value="<?php echo $ip; ?>">
      <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>">

      <input type="submit" name="submit" value="ENTER" id="submit" disabled>

      <div id="join-form-messages"><?php echo $feedback; ?></div>
    </div>
  </form>
  <?php } else { ?>
  <h1 class="pagetitle" style="font-size: 4vw; "><?php echo $PageTitle; ?></h1>

  Sorry, the entry period for this sweepstakes has closed. Winners will be announced on Friday, April 20th at 12:00 PM CST through the Harken Blockheads <a href="https://www.facebook.com/Harken-Blockheads-1297811663614506/">Facebook</a> and <a href="https://www.instagram.com/harkenblockhead">Instagram</a> pages. Join the Blockheads program <a href="join.php">here</a> to receive news and alerts for future contests and promotions. Thank you!
  <?php } ?>
</div>

<?php include "footer.php"; ?>