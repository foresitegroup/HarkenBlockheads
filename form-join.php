<?php
session_start();

include_once "inc/dbconfig.php";

$salt = "BlockheadsJoinForm";

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".RECAPTCHA_SECRET_KEY."&response=".$_POST['g-recaptcha-response']);
$responsekeys = json_decode($response);

if ($responsekeys->success) {
  if ($_POST['confirmationCAP'] == "") {
    if (
        $_POST[md5('firstname' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
        $_POST[md5('lastname' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
        $_POST[md5('age' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
        $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
        $_POST[md5('address' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
        $_POST[md5('city' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
        $_POST[md5('state' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
        $_POST[md5('zip' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
        $_POST['country'] != ""
       )
    {
      $Contest = "";
      //date_default_timezone_set('America/Chicago');
      // if (strtotime("now") <= strtotime("15 July 2017 2:00pm") && isset($_POST['contest'])) {
      if (isset($_POST['contest'])) {
        $Contest = "Blockheads Membership Number: " . $_POST[md5('membership-number' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\nBoat Name: " . $_POST[md5('boat-name' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\nRace Division: " . $_POST[md5('race-division' . $_POST['ip'] . $salt . $_POST['timestamp'])];
      }

      //Add to database
      $mysqli->query("INSERT INTO `join` (
                    firstname,
                    lastname,
                    age,
                    email,
                    address,
                    address2,
                    city,
                    state,
                    zip,
                    country,
                    promo,
                    contest
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
                    '" . $_POST['country'] . "',
                    '" . $mysqli->real_escape_string($_POST[md5('promo' . $_POST['ip'] . $salt . $_POST['timestamp'])]) . "',
                    '" . $Contest . "'
                    )");
      $mysqli->close();

      // Send email
      $Headers = "From: Join Form <joinform@harken.com>\r\n";
      $Headers .= "Reply-To: " . $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\r\n";
      
      if (isset($_POST['contest'])) {
        $Subject = "First Blockhead to the Island Award Sign-Up";
        $SendTo = "marketing.intern@harken.com";
      } else {
        $Subject = "Harken Blockheads Sign-Up";
        $SendTo = "blockheads@harken.com";
      }
      
      // $Subject = "Harken Blockheads Sign-Up";
      // $SendTo = "blockheads@harken.com";
      if ($_POST['country'] == "Australia") $SendTo = "blockheads@harken.com.au";
      if ($_POST['country'] == "Canada") $SendTo = "eosborn@transatmarine.com";
      if ($_POST['country'] == "Chile") $SendTo = "administracion@windmade.cl";
      if ($_POST['country'] == "Poland") $SendTo = "Zofia.Truchanowicz@harken.pl";
      if ($_POST['country'] == "Slovenia") $SendTo = "info@sailing-point.si";
      if ($_POST['country'] == "South Africa") $SendTo = "lars@harken.co.za";
      if ($_POST['country'] == "United Kingdom") $SendTo = "blockheads@harken.co.uk";

      $Headers .= "Cc: hays.formella@harken.com\r\n";
      $Headers .= "Bcc: foresitegroupllc@gmail.com\r\n";

      $Message = "Sign-up from " . $_POST[md5('firstname' . $_POST['ip'] . $salt . $_POST['timestamp'])] . " " . $_POST[md5('lastname' . $_POST['ip'] . $salt . $_POST['timestamp'])] . " (" . $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] . ")";

      $Message .= "\n\nAge: " . $_POST[md5('age' . $_POST['ip'] . $salt . $_POST['timestamp'])];

      $Message .= "\n\n" . $_POST[md5('address' . $_POST['ip'] . $salt . $_POST['timestamp'])];

      if ($_POST[md5('address2' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "") 
      $Message .= "\n" . $_POST[md5('address2' . $_POST['ip'] . $salt . $_POST['timestamp'])];

      $Message .= "\n" . $_POST[md5('city' . $_POST['ip'] . $salt . $_POST['timestamp'])] . ", " . $_POST[md5('state' . $_POST['ip'] . $salt . $_POST['timestamp'])] . " " . $_POST[md5('zip' . $_POST['ip'] . $salt . $_POST['timestamp'])];

      $Message .= "\n" . $_POST['country'];

      if ($_POST[md5('promo' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "") 
      $Message .= "\Special Code: " . $_POST[md5('promo' . $_POST['ip'] . $salt . $_POST['timestamp'])];
      
      // CONTEST
      $Message .= "\n";
      if ($_POST[md5('membership-number' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "") 
      $Message .= "\nBlockheads Membership Number: " . $_POST[md5('membership-number' . $_POST['ip'] . $salt . $_POST['timestamp'])];
      if ($_POST[md5('boat-name' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "") 
      $Message .= "\nBoat Name: " . $_POST[md5('boat-name' . $_POST['ip'] . $salt . $_POST['timestamp'])];
      if ($_POST[md5('race-division' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "") 
      $Message .= "\nRace Division: " . $_POST[md5('race-division' . $_POST['ip'] . $salt . $_POST['timestamp'])];

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
}
?>