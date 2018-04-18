<?php
session_start();

$salt = "BlockheadsSweepstakesForm";

if ($_POST['confirmationCAP'] == "") {
  if (
      $_POST[md5('firstname' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('lastname' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('age' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('address' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('city' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('state' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('zip' . $_POST['ip'] . $salt . $_POST['timestamp'])] != ""
     )
  {
    //Add to database
    include_once "inc/dbconfig.php";
    $mysqli->query("INSERT INTO `sweepstakes` (
                  firstname,
                  lastname,
                  age,
                  email,
                  address,
                  address2,
                  city,
                  state,
                  zip,
                  resident,
                  member
                  ) VALUES (
                  '" . $mysqli->real_escape_string($_POST[md5('firstname' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('lastname' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('age' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('address' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('address2' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('city' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('state' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('zip' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $_POST['resident'] . "',
                  '" . $_POST['member'] . "'
                  )");
    $mysqli->close();

    // Send email
    $Headers = "From: Sweepstakes Form <sweepstakesform@harken.com>\r\n";
    $Headers .= "Reply-To: " . $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\r\n";

    $SendTo = "blockheads@harken.com";

    $Subject = "Harken Blockheads Sweepstakes Sign-Up";
    $Headers .= "Cc: hays.formella@harken.com\r\n";
    $Headers .= "Bcc: mark@foresitegrp.com\r\n";

    $Message = "Sweepstakes sign-up from " . $_POST[md5('firstname' . $_POST['ip'] . $salt . $_POST['timestamp'])] . " " . $_POST[md5('lastname' . $_POST['ip'] . $salt . $_POST['timestamp'])] . " (" . $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] . ")";

    $Message .= "\n\nAge: " . $_POST[md5('age' . $_POST['ip'] . $salt . $_POST['timestamp'])];

    $Message .= "\n\n" . $_POST[md5('address' . $_POST['ip'] . $salt . $_POST['timestamp'])];

    if ($_POST[md5('address2' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "") 
    $Message .= "\n" . $_POST[md5('address2' . $_POST['ip'] . $salt . $_POST['timestamp'])];

    $Message .= "\n" . $_POST[md5('city' . $_POST['ip'] . $salt . $_POST['timestamp'])] . ", " . $_POST[md5('state' . $_POST['ip'] . $salt . $_POST['timestamp'])] . " " . $_POST[md5('zip' . $_POST['ip'] . $salt . $_POST['timestamp'])];

    $Message .= "\n\n" . $_POST['resident'];

    $Message .= "\n\n" . $_POST['member'];

    $Message = stripslashes($Message);
  
    mail($SendTo, $Subject, $Message, $Headers);
    
    $feedback = "<strong>You have been entered!</strong> Thank you for entering our sweepstakes. Winners will be announced on April 20th at noon CST through the Harken Blockheads Facebook and Instagram pages.";
    
    if (!empty($_REQUEST['src'])) {
      header("HTTP/1.0 200 OK");
      echo $feedback;
    }
  } else {
    $feedback = "<strong>Some required information is missing! Please go back and make sure all required fields are filled.</strong>";

    if (!empty($_REQUEST['src'])) {
      header("HTTP/1.0 500 Internal Server Error");
      echo $feedback;
    }
  }
}

if (empty($_REQUEST['src'])) {
  $_SESSION['feedback'] = $feedback;
  header("Location: " . $_POST['referrer'] . "#join-form");
}
?>