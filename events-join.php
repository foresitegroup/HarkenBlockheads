<?php
$PageTitleLang = "JOIN_TITLE";
include "header.php";
?>

<div class="site-width join">
  <h1 class="pagetitle"><?php echo $PageTitle; ?></h1>

  <?php echo $lang['WHY_JOIN']; ?><br>
  <br>

  <div class="join-form-header cf">
    <div class="join-form-header-left">
      <?php echo $lang['FILL_FORM_EVENTS']; ?>
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
          // if ($('#age').val() === '') { alert('Age required.'); $('#age').focus(); return false; }
          if ($('#email').val() === '') { alert('Email address required.'); $('#email').focus(); return false; }
          if ($('#address').val() === '') { alert('Address required.'); $('#address').focus(); return false; }
          if ($('#city').val() === '') { alert('City required.'); $('#city').focus(); return false; }
          if ($('#state').val() === '') { alert('State required.'); $('#state').focus(); return false; }
          if ($('#zip').val() === '') { alert('Zip required.'); $('#zip').focus(); return false; }
          if ($('#country').val() === '') { alert('Country required.'); $('#country').focus(); return false; }

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

  <form action="form-events-join.php" method="POST" id="join-form" class="events-join">
    <div>
      <input type="text" name="<?php echo md5("firstname" . $ip . $salt . $timestamp); ?>" id="firstname" placeholder="<?php echo $lang['FIRST_NAME']; ?>">

      <input type="text" name="<?php echo md5("lastname" . $ip . $salt . $timestamp); ?>" id="lastname" placeholder="<?php echo $lang['LAST_NAME']; ?>">

      <!-- <input type="text" name="<?php //echo md5("age" . $ip . $salt . $timestamp); ?>" id="age" placeholder="Age"> -->

      <div style="clear: both;"></div>

      <input type="email" name="<?php echo md5("email" . $ip . $salt . $timestamp); ?>" id="email" placeholder="<?php echo $lang['EMAIL']; ?>">

      <input type="text" name="<?php echo md5("address" . $ip . $salt . $timestamp); ?>" id="address" placeholder="<?php echo $lang['ADDRESS']; ?>">

      <input type="text" name="<?php echo md5("address2" . $ip . $salt . $timestamp); ?>" id="address2" placeholder="<?php echo $lang['ADDRESS2']; ?>">

      <input type="text" name="<?php echo md5("city" . $ip . $salt . $timestamp); ?>" id="city" placeholder="<?php echo $lang['CITY']; ?>">

      <input type="text" name="<?php echo md5("state" . $ip . $salt . $timestamp); ?>" id="state" placeholder="<?php echo $lang['STATE']; ?>">

      <input type="text" name="<?php echo md5("zip" . $ip . $salt . $timestamp); ?>" id="zip" placeholder="<?php echo $lang['ZIP']; ?>">

      <input type="text" name="<?php echo md5("country" . $ip . $salt . $timestamp); ?>" id="country" placeholder="<?php echo $lang['COUNTRY']; ?>">

      <div style="clear: both;"></div>

      <input type="text" name="<?php echo md5("parent_name" . $ip . $salt . $timestamp); ?>" id="parent_name" placeholder="<?php echo $lang['PARENT_NAME']; ?>">

      <input type="checkbox" name="consent" value="I certify that I am the minor applicant's legal guardian and this application is being made with my full consent." id="r-consent">
      <label for="r-consent"><?php echo $lang['CONSENT']; ?></label>

      <div class="centered">
        <input type="checkbox" name="terms" value="" id="r-terms">
        <label for="r-terms"><?php echo $lang['JOIN_TERMS']; ?></label>
      </div>

      <input type="hidden" name="referrer" value="events-join.php">

      <input type="text" name="confirmationCAP" style="display: none;">

      <input type="hidden" name="ip" value="<?php echo $ip; ?>">
      <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>">

      <input type="submit" name="submit" value="<?php echo $lang['SIGN_UP']; ?>" id="submit" disabled>

      <div id="join-form-messages"><?php echo $feedback; ?></div>
    </div>
  </form>
</div>

<?php include "footer.php"; ?>