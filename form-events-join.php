<?php
session_start();

$salt = "BlockheadsJoinForm";

if ($_POST['confirmationCAP'] == "") {
  if (
      $_POST[md5('firstname' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('lastname' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('address' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('city' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('state' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('zip' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('country' . $_POST['ip'] . $salt . $_POST['timestamp'])] != ""
     )
  {
    //Add to database
    include_once "inc/dbconfig.php";
    $mysqli->query("INSERT INTO `join` (
                  firstname,
                  lastname,
                  email,
                  address,
                  address2,
                  city,
                  state,
                  zip,
                  country,
                  parent_name,
                  parent_consent
                  ) VALUES (
                  '" . $mysqli->real_escape_string($_POST[md5('firstname' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('lastname' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('address' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('address2' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('city' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('state' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('zip' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('country' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST[md5('parent_name' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                  '" . $mysqli->real_escape_string($_POST['consent']) . "'
                  )");
    $mysqli->close();

    // Send email
    $Headers = "From: Join Form <joinform@harken.com>\r\n";
    $Headers .= "Reply-To: " . $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\r\n";
    $Subject = "Harken Blockheads Sign-Up";
    $SendTo = "blockheads@harken.com";
    $Headers .= "Cc: hays.formella@harken.com\r\n";

    $Headers .= "Bcc: mark@foresitegrp.com\r\n";

    $Message = "Sign-up from " . $_POST[md5('firstname' . $_POST['ip'] . $salt . $_POST['timestamp'])] . " " . $_POST[md5('lastname' . $_POST['ip'] . $salt . $_POST['timestamp'])] . " (" . $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] . ")";

    $Message .= "\n\nAge: " . $_POST[md5('age' . $_POST['ip'] . $salt . $_POST['timestamp'])];

    $Message .= "\n\n" . $_POST[md5('address' . $_POST['ip'] . $salt . $_POST['timestamp'])];

    if ($_POST[md5('address2' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "") 
    $Message .= "\n" . $_POST[md5('address2' . $_POST['ip'] . $salt . $_POST['timestamp'])];

    $Message .= "\n" . $_POST[md5('city' . $_POST['ip'] . $salt . $_POST['timestamp'])] . ", " . $_POST[md5('state' . $_POST['ip'] . $salt . $_POST['timestamp'])] . " " . $_POST[md5('zip' . $_POST['ip'] . $salt . $_POST['timestamp'])];

    $Message .= "\n" . $_POST[md5('country' . $_POST['ip'] . $salt . $_POST['timestamp'])];

    if ($_POST[md5('parent_consent' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "") 
    $Message .= "\n\n" . $_POST[md5('parent_consent' . $_POST['ip'] . $salt . $_POST['timestamp'])];
    if ($_POST['consent'] != "") $Message .= "\n" . $_POST['consent'];

    $Message = stripslashes($Message);
  
    mail($SendTo, $Subject, $Message, $Headers);
    
    $feedback = "<strong>You have been signed up!</strong> Thank you for joining Harken Blockheads. Your membership kit is on its way and you will begin receiving the monthly Blockheads Bulletin newsletter.";
    
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