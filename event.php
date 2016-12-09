<?php
if (strpos($_SERVER['QUERY_STRING'], "google") !== false) {
  // tap into google
  include "inc/iCalEasyReader.php";
  $ical = new iCalEasyReader();
  $gcal = $ical->load(file_get_contents("https://calendar.google.com/calendar/ical/c322etugp1dcbvu8jc5ltdm4pc@group.calendar.google.com/public/basic.ics"));

  foreach ($gcal['VEVENT'] as $row) {
    if ($row['UID'] == $_SERVER['QUERY_STRING']) {
      if (is_array($row['DTSTART'])) {
        $Estartdate = strtotime($row['DTSTART']['value'] . " midnight");
      } else {
        $Estartdate = strtotime($row['DTSTART']);
      }

      if (is_array($row['DTEND'])) {
        $Eenddate = strtotime($row['DTEND']['value'] . " midnight yesterday");
      } else {
        $Eenddate = strtotime($row['DTEND']);
      }

      $Etitle = $row['SUMMARY'];
      $Elocation = $row['LOCATION'];
      $Edetails = $row['DESCRIPTION'];
    }
  }
} else {
  include_once "inc/dbconfig.php";
  $result = $mysqli->query("SELECT * FROM events WHERE id = '" . $_SERVER['QUERY_STRING'] . "'");
  $row = $result->fetch_array(MYSQLI_ASSOC);

  $Estartdate = $row['startdate'];
  $Eenddate = $row['enddate'];
  $Etitle = $row['title'];
  $Elocation = $row['location'];
  $Edetails = $row['details'];
  $Eimage = $row['image'];
}

$PageTitle = "Event | " . $Etitle;
$SocialTitle = "#HARKENBLOCKHEADS";
include "header.php";
?>

<div class="site-width">
  <?php
  echo $Estartdate . "<br>";
  echo $Eenddate . "<br>";
  echo $Etitle . "<br>";
  echo $Elocation . "<br>";
  echo $Edetails . "<br>";
  if (isset($Eimage)) echo $Eimage . "<br>";
  ?>
</div>

<?php include "footer.php"; ?>