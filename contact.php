<?php
// $PageTitle = "Contact Us";
$PageTitleLang = "CONTACT_TITLE";
$SocialTitle = "Follow Us";
$SocialClass = "sht-contact";
include "header.php";
?>

<div class="site-width contact">
  <h1 class="pagetitle"><?php echo $PageTitle; ?></h1>

  <?php echo $lang['CONTACT_TEXT']; ?><br>
  <br>

  <script type="text/javascript">
    $(document).ready(function() {
      var form = $('#contact-form');
      var formMessages = $('#contact-form-messages');
      $(form).submit(function(event) {
        event.preventDefault();
        
        function formValidation() {
          if ($('#firstname').val() === '') { alert('First name required.'); $('#firstname').focus(); return false; }
          if ($('#lastname').val() === '') { alert('Last name required.'); $('#lastname').focus(); return false; }
          if ($('#email').val() === '') { alert('Email address required.'); $('#email').focus(); return false; }
          if ($('#message').val() === '') { alert('Message required.'); $('#message').focus(); return false; }
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
    });
  </script>

  <?php
  // Settings for randomizing form field names
  $ip = $_SERVER['REMOTE_ADDR'];
  $timestamp = time();
  $salt = "BlockheadsContactForm";
  ?>

  <noscript>
  <?php
  $feedback = (!empty($_SESSION['feedback'])) ? $_SESSION['feedback'] : "";
  unset($_SESSION['feedback']);
  ?>
  </noscript>

  <form action="form-contact.php" method="POST" id="contact-form">
    <div>
      <input type="text" name="<?php echo md5("firstname" . $ip . $salt . $timestamp); ?>" id="firstname" placeholder="<?php echo $lang['FIRST_NAME']; ?>">

      <input type="text" name="<?php echo md5("lastname" . $ip . $salt . $timestamp); ?>" id="lastname" placeholder="<?php echo $lang['LAST_NAME']; ?>">

      <div style="clear: both;"></div>

      <input type="email" name="<?php echo md5("email" . $ip . $salt . $timestamp); ?>" id="email" placeholder="<?php echo $lang['EMAIL']; ?>">

      <textarea name="<?php echo md5("message" . $ip . $salt . $timestamp); ?>" id="message" placeholder="<?php echo $lang['MESSAGE']; ?>"></textarea>

      <div class="radio">
        <?php echo $lang['I_AM_A']; ?>:<br>
        <input type="radio" name="iama" value="Sailor" id="r-sailor"> <label for="r-sailor"><?php echo $lang['SAILOR']; ?></label><br>
        <input type="radio" name="iama" value="Coach/Instructor" id="r-coach-instructor"> <label for="r-coach-instructor"><?php echo $lang['COACH']; ?></label><br>
        <input type="radio" name="iama" value="Other" id="r-other"> <label for="r-other"><?php echo $lang['OTHER']; ?></label>
      </div>

      <input type="hidden" name="referrer" value="contact.php">

      <input type="text" name="confirmationCAP" style="display: none;">

      <input type="hidden" name="ip" value="<?php echo $ip; ?>">
      <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>">

      <input type="submit" name="submit" value="<?php echo $lang['SEND_MESSAGE']; ?>">

      <div id="contact-form-messages"><?php echo $feedback; ?></div>
    </div>
  </form>
</div>

<?php include "footer.php"; ?>