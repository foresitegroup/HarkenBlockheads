<?php
include("../inc/dbconfig.php");

// $startdate = (isset($_POST['startdate'])) ? strtotime($_POST['startdate']) : time();
// $enddate = (!empty($_POST['enddate'])) ? strtotime($_POST['enddate']) : $startdate;

if (!empty($_POST['startdate'])) {
  if (!empty($_POST['starttime'])) {
    $startdate = strtotime($_POST['startdate'] . " " . $_POST['starttime']);
  } else {
    $startdate = strtotime($_POST['startdate']);
  }
} else {
  $startdate = time();
}

if (!empty($_POST['enddate'])) {
  if (!empty($_POST['endtime'])) {
    $enddate = strtotime($_POST['enddate'] . " " . $_POST['endtime']);
  } else {
    $enddate = strtotime($_POST['enddate']);
  }
} else {
  $enddate = $startdate;
}

switch ($_GET['a']) {
  case "add":
    $mysqli->query("INSERT INTO events (
                  startdate,
                  enddate,
                  title,
                  location,
                  details,
                  image
                  ) VALUES(
                  '" . $startdate . "',
                  '" . $enddate . "',
                  '" . $mysqli->real_escape_string($_POST['title']) . "',
                  '" . $mysqli->real_escape_string($_POST['location']) . "',
                  '" . $mysqli->real_escape_string($_POST['details']) . "',
                  '" . $mysqli->real_escape_string($_POST['image']) . "'
                  )");
    break;
  case "edit":
    $mysqli->query("UPDATE events SET
                  startdate = '" . $startdate . "',
                  enddate = '" . $enddate . "',
                  title = '" . $mysqli->real_escape_string($_POST['title']) . "',
                  location = '" . $mysqli->real_escape_string($_POST['location']) . "',
                  details = '" . $mysqli->real_escape_string($_POST['details']) . "',
                  image = '" . $mysqli->real_escape_string($_POST['image']) . "'
                  WHERE id = '" . $_POST['id'] . "'");
    break;
  case "delete":
    $mysqli->query("DELETE FROM events WHERE id = '" . $_GET['id'] . "'");
    break;
}

$mysqli->close();

header( "Location: events.php" );
?>