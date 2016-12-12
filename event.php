<?php
if (strpos($_SERVER['QUERY_STRING'], "google") !== false) {
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

<div class="event-single">
  <div class="event-single-right"<?php if ($Eimage != "") echo " style=\"background-image: url(images/events/" . $Eimage . ");\""; ?>></div>

  <div class="site-width">
    <div class="event-single-content">
      <div class="event-single-title"><?php echo $Etitle; ?></div>
      
      <div class="event-single-header">DATE</div>
      <?php
      echo "<div class=\"event-single-date\">" . date("F j", $Estartdate);
      if ($Estartdate != $Eenddate) {
        if (date("Y", $Estartdate) != date("Y", $Eenddate)) echo ", " . date("Y", $Estartdate);
        if (($Estartdate+86400) <= $Eenddate) echo "-";
        if (date("F", $Estartdate) != date("F", $Eenddate)) echo date("F", $Eenddate) . " ";
        if (date("j", $Estartdate) != date("j", $Eenddate)) echo date("j", $Eenddate);
      }
      echo ", " . date("Y", $Eenddate);
      echo "</div>\n";
      ?>

      <div class="event-single-header">TIME</div>
      <?php
      echo "<div class=\"event-single-time\">";
      if (date("g:ia", $Estartdate) != "12:00am") {
        echo date("g:ia", $Estartdate);
        if (date("g:ia", $Estartdate) != date("g:ia", $Eenddate)) echo "-" . date("g:ia", $Eenddate);
      } else {
        echo "All Day Event";
      }
      echo "</div>\n";
      ?>
      
    </div>
  </div>
</div>

<div class="site-width event-single-details">
  <?php
  if ($Edetails != "") {
    echo "<div class=\"event-single-header\">EVENT DETAILS</div>";
    echo $Edetails;
  }

  if ($row['eventlink'] != "") {
    if (substr($row['eventlink'], 0, 4) == "http") {
      $fullurl = $row['eventlink'];
      $displayurl = preg_replace('#^https?://#', '', rtrim($row['eventlink'],'/'));
    } else {
      $fullurl = "http://" . $row['eventlink'];
      $displayurl = $row['eventlink'];
    }
    echo "<br><br>\nFor event information visit <a href=\"" . $fullurl . "\">" . $displayurl . "</a><br>\n";
  }
  ?>
</div>

<?php include "footer.php"; ?>