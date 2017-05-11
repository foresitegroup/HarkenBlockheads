<?php
session_start();

$salt = "BlockheadsContestForm";

if ($_POST['confirmationCAP'] == "") {
  if (
      $_POST[md5('name' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] != ""
     )
  {
    $Subject = "Red Ratchet Contest Entry";
    $SendTo = "blockheads@harken.com";
    $Headers = "From: Contest Form <contestform@harken.com>\r\n";
    $Headers .= "Reply-To: " . $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\r\n";
    $Headers .= "Cc: hays.formella@harken.com\r\n";
    $Headers .= "Bcc: mark@foresitegrp.com\r\n";

    $Message = "Name: " . $_POST[md5('name' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\n";

    $Message .= "Email: " . $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\n";

    $Message = stripslashes($Message);
  
    mail($SendTo, $Subject, $Message, $Headers);
    
    $feedback = "Thank you for entering our contest! Good luck!";
    
    if (!empty($_REQUEST['src'])) {
      header("HTTP/1.0 200 OK");
      echo $feedback;
    }
  } else {
    $feedback = "Some required information is missing! Please go back and make sure all required fields are filled.";

    if (!empty($_REQUEST['src'])) {
      header("HTTP/1.0 500 Internal Server Error");
      echo $feedback;
    }
  }
}

if (empty($_REQUEST['src'])) {
  $_SESSION['feedback'] = $feedback;
  header("Location: " . $_POST['referrer'] . "#contest-form");
}
?>