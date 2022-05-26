<?php
$PageTitleLang = "JOIN_TITLE";
$SocialTitle = "Follow Us";
$SocialClass = "sht-join";
$OGimage = "og-image.jpg";
$OGdescription = "Become a better sailor and get free stuff! Sign up and we'll send you a Blockheads kit including decals, flat whistle, Carbo block magnet and membership card.";
$MenuClass = "join";
include "header.php";
include_once "inc/dbconfig.php";
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
            $('#form-fields').css('display', 'none');
            $('#join-form').css('padding-bottom', '6em');
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
    <div id="form-fields">
      <div class="parent-popup">
        <?php echo $lang['POP_UP'];?>
      </div>

      <input type="text" name="<?php echo md5("promo" . $ip . $salt . $timestamp); ?>" id="promo" placeholder="<?php echo $lang['SPECIAL_CODE']; ?>">

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

      <!-- <input type="text" name="<?php //echo md5("country" . $ip . $salt . $timestamp); ?>" id="country" placeholder="Country"> -->

      <select name="country" id="country">
        <option value=""><?php echo $lang['COUNTRY']; ?></option>
        <option value="Australia">Australia</option>
        <option value="Canada">Canada</option>
        <option value="Chile">Chile</option>
        <option value="Poland">Poland</option>
        <option value="Slovenia">Slovenia</option>
        <option value="South Africa">South Africa</option>
        <option value="United Kingdom">United Kingdom</option>
        <option value="United States">United States</option>
      </select>

      <div style="clear: both;"></div>

      <?php date_default_timezone_set('America/Chicago'); ?>
      <?php if (strtotime("now") <= strtotime("20 July 2018 3:00pm")) { ?>
      <!-- <div class="centered contest-fields">
        <input type="checkbox" name="contest" value="yes" id="r-contest"<?php if ($_SERVER['QUERY_STRING'] == "award") echo " checked"; ?>>
        <label for="r-contest">I am sailing in the 110th Chicago Yacht Club Race to Mackinac and am registering for the First Blockhead to the Island Award</label>

        <div class="contest-reveal">
          <input type="text" name="<?php echo md5("membership-number" . $ip . $salt . $timestamp); ?>" id="membership-number" placeholder="Blockheads Membership Number">
          <div id="membership-number-note">Found on the back of your Blockheads membership card, not required</div>

          <input type="text" name="<?php echo md5("boat-name" . $ip . $salt . $timestamp); ?>" id="boat-name" placeholder="Boat Name">

          <input type="text" name="<?php echo md5("race-division" . $ip . $salt . $timestamp); ?>" id="race-division" placeholder="Race Division">
        </div>
      </div> -->
      <?php } ?>

      <div class="centered">
        <input type="checkbox" name="terms" value="" id="r-terms">
        <label for="r-terms"><?php echo $lang['JOIN_TERMS']; ?></label>
      </div>

      <input type="hidden" name="referrer" value="join.php">

      <input type="text" name="confirmationCAP" style="display: none;">

      <input type="hidden" name="ip" value="<?php echo $ip; ?>">
      <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>">

      <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITE_KEY; ?>"></div><br>

      <input type="submit" name="submit" value="<?php echo $lang['SIGN_UP']; ?>" id="submit" disabled>
    </div>

    <div id="join-form-messages"><?php echo $feedback; ?></div>
  </form>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<?php include "footer.php"; ?>