<?php
$PageTitleLang = "JOIN_TITLE";
$SocialTitle = "Follow Us";
$SocialClass = "sht-join";
include "header.php";
?>

<div class="site-width join">
  <h1 class="pagetitle"><?php echo $PageTitle; ?></h1>

  <?php echo $lang['WHY_JOIN']; ?><br>
  <br>

  <div class="join-form-header cf">
    <div class="join-form-header-left">
      <?php echo $lang['FILL_FORM']; ?>
    </div>

    <div class="join-form-header-right">
      <img src="images/logo-prefooter.png" alt="">
    </div>
  </div>

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
          if ($('#country').val() === '') { alert('Country required.'); $('#country').focus(); return false; }

          if ($('#r-contest').is(':checked') && $('#boat-name').val() === '') {
            alert('Boat name is required');
            $('#boat-name').focus();
            return false;
          }
          if ($('#r-contest').is(':checked') && $('#race-division').val() === '') {
            alert('Race division is required');
            $('#race-division').focus();
            return false;
          }

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
  $salt = "BlockheadsJoinForm";
  ?>

  <noscript>
  <?php
  $feedback = (!empty($_SESSION['feedback'])) ? $_SESSION['feedback'] : "";
  unset($_SESSION['feedback']);
  ?>
  </noscript>

  <form action="form-join.php" method="POST" id="join-form">
    <div>
      <div class="parent-popup">
        Sailors under the age of 13 must verify their parent or guardian's consent before joining Blockheads. Please download the <a href="#">parental consent form</a>. Thank you.
      </div>

      <input type="text" name="<?php echo md5("firstname" . $ip . $salt . $timestamp); ?>" id="firstname" placeholder="First Name">

      <input type="text" name="<?php echo md5("lastname" . $ip . $salt . $timestamp); ?>" id="lastname" placeholder="Last Name">

      <input type="text" name="<?php echo md5("age" . $ip . $salt . $timestamp); ?>" id="age" placeholder="Age">

      <div style="clear: both;"></div>

      <input type="email" name="<?php echo md5("email" . $ip . $salt . $timestamp); ?>" id="email" placeholder="Email Address">

      <input type="text" name="<?php echo md5("address" . $ip . $salt . $timestamp); ?>" id="address" placeholder="Address">

      <input type="text" name="<?php echo md5("address2" . $ip . $salt . $timestamp); ?>" id="address2" placeholder="Apartment/Unit/Suite (optional)">

      <input type="text" name="<?php echo md5("city" . $ip . $salt . $timestamp); ?>" id="city" placeholder="City">

      <input type="text" name="<?php echo md5("state" . $ip . $salt . $timestamp); ?>" id="state" placeholder="State">

      <input type="text" name="<?php echo md5("zip" . $ip . $salt . $timestamp); ?>" id="zip" placeholder="Zip / Postal">

      <input type="text" name="<?php echo md5("country" . $ip . $salt . $timestamp); ?>" id="country" placeholder="Country">

      <div style="clear: both;"></div>

      <?php date_default_timezone_set('America/Chicago'); ?>
      <?php if (strtotime("now") <= strtotime("15 July 2017 2:00pm")) { ?>
      <div class="centered contest-fields">
        <input type="checkbox" name="contest" value="yes" id="r-contest"<?php if ($_SERVER['QUERY_STRING'] == "award") echo " checked"; ?>>
        <label for="r-contest">I am registering for the First Blockhead to the Island Award</label>

        <div class="contest-reveal">
          <input type="text" name="<?php echo md5("membership-number" . $ip . $salt . $timestamp); ?>" id="membership-number" placeholder="Blockheads Membership Number">
          <div id="membership-number-note">Found on the back of your Blockheads membership card, not required</div>

          <input type="text" name="<?php echo md5("boat-name" . $ip . $salt . $timestamp); ?>" id="boat-name" placeholder="Boat Name">

          <input type="text" name="<?php echo md5("race-division" . $ip . $salt . $timestamp); ?>" id="race-division" placeholder="Race Division">
        </div>
      </div>
      <?php } ?>

      <div class="centered">
        <input type="checkbox" name="terms" value="" id="r-terms">
        <label for="r-terms">I agree to the <a href="terms.php">Terms &amp; Services</a></label><br>
        Blockheads is currently not shipping outside of the United States.
      </div>

      <input type="hidden" name="referrer" value="join.php">

      <input type="text" name="confirmationCAP" style="display: none;">

      <input type="hidden" name="ip" value="<?php echo $ip; ?>">
      <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>">

      <input type="submit" name="submit" value="SIGN UP" id="submit" disabled>

      <div id="join-form-messages"><?php echo $feedback; ?></div>
    </div>
  </form>
</div>

<?php include "footer.php"; ?>