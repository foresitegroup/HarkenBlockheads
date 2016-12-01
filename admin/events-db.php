<?php
include("../inc/dbconfig.php");

$startdate = (isset($_POST['startdate'])) ? strtotime($_POST['startdate']) : time();
$enddate = (!empty($_POST['enddate'])) ? strtotime($_POST['enddate']) : $startdate;

switch ($_GET['a']) {
  case "add":
    $mysqli->query("INSERT INTO events (
                  startdate,
                  enddate,
                  title,
                  details,
                  image,
                  videolink
                  ) VALUES(
                  '" . $startdate . "',
                  '" . $enddate . "',
                  '" . $mysqli->real_escape_string($_POST['title']) . "',
                  '" . $mysqli->real_escape_string($_POST['details']) . "',
                  '" . $mysqli->real_escape_string($_POST['image']) . "',
                  '" . $mysqli->real_escape_string($_POST['videolink']) . "'
                  )");
    break;
  case "edit":
    $mysqli->query("UPDATE events SET
                  startdate = '" . $startdate . "',
                  enddate = '" . $enddate . "',
                  title = '" . $mysqli->real_escape_string($_POST['title']) . "',
                  details = '" . $mysqli->real_escape_string($_POST['details']) . "',
                  image = '" . $mysqli->real_escape_string($_POST['image']) . "',
                  videolink = '" . $mysqli->real_escape_string($_POST['videolink']) . "'
                  WHERE id = '" . $_POST['id'] . "'");
    break;
  case "delete":
    $mysqli->query("DELETE FROM events WHERE id = '" . $_GET['id'] . "'");
    break;
}

$mysqli->close();

header( "Location: events.php" );
?>