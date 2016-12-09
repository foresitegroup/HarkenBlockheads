<?php
$PageTitle = "Events";
$SocialTitle = "#HARKENBLOCKHEADS";
include "header.php";

// Build the events array
// Starting with the local database...
include_once "inc/dbconfig.php";

$result = $mysqli->query("SELECT * FROM events WHERE enddate > ".time()." ORDER BY startdate ASC");
while($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $events[] = array(
    'startdate' => $row['startdate'],
    'enddate' => $row['enddate'],
    'title' => $row['title'],
    'location' => $row['location'],
    'details' => $row['details'],
    'image' => $row['image'],
    'id' => $row['id']
  );
}

// ...then tap into the Google Calendar
include "inc/iCalEasyReader.php";
$ical = new iCalEasyReader();
$gcal = $ical->load(file_get_contents("https://calendar.google.com/calendar/ical/c322etugp1dcbvu8jc5ltdm4pc@group.calendar.google.com/public/basic.ics"));

foreach ($gcal['VEVENT'] as $row) {
  if (is_array($row['DTSTART'])) {
    $gstartdate = strtotime($row['DTSTART']['value'] . " midnight");
  } else {
    $gstartdate = strtotime($row['DTSTART']);
  }

  if (is_array($row['DTEND'])) {
    $genddate = strtotime($row['DTEND']['value'] . " midnight yesterday");
  } else {
    $genddate = strtotime($row['DTEND']);
  }

  $events[] = array(
    'startdate' => $gstartdate,
    'enddate' => $genddate,
    'title' => $row['SUMMARY'],
    'location' => $row['LOCATION'],
    'details' => $row['DESCRIPTION'],
    'image' => '',
    'id' => $row['UID']
  );
}

// Sort the two different data sources together
foreach ($events as $key => $row) { $startdate[$key] = $row['startdate']; }
array_multisort($startdate, SORT_ASC, $events);
?>

<div class="site-width events-header">
  <h1 class="pagetitle"><?php echo $PageTitle; ?></h1>
</div>

<div class="events-featured">
  <div class="events-featured-left"></div>
  <div class="events-featured-right"<?php if ($events[0]['image'] != "") echo " style=\"background-image: url(images/events/" . $events[0]['image'] . ");\""; ?>></div>

  <div class="site-width">
    <div class="events-featured-content">
      <h4>FEATURED</h4>
      <?php
      echo "<div class=\"events-featured-date\">" . date("M j", $events[0]['startdate']);
      if ($events[0]['startdate'] != $events[0]['enddate']) {
        if (($events[0]['startdate']+86400) <= $events[0]['enddate']) echo "-";
        if (date("M", $events[0]['startdate']) != date("M", $events[0]['enddate'])) echo date("M", $events[0]['enddate']) . " ";
        if (date("j", $events[0]['startdate']) != date("j", $events[0]['enddate'])) echo date("j", $events[0]['enddate']);
      }
      echo "</div>\n";
      ?>
      <div class="events-featured-title"><?php echo $events[0]['title']; ?></div>

      <a href="event.php?<?php echo $events[0]['id']; ?>" class="button">VIEW EVENT</a>
    </div>
  </div>
</div>

<div class="site-width events">
  <h3>UPCOMING</h3>
  
  <table cellspacing="0" cellpadding="0" class="events-list">
    <?php
    $TheYear = "";

    foreach ($events as $row) {
      if ($TheYear != date("Y", $row['startdate'])) {
        $TheYear = date("Y", $row['startdate']);
        echo "<tr><td colspan=\"4\" class=\"events-year\">" . $TheYear . "</td></tr>";
      }
      
      echo "<tr>";
        echo "<td class=\"events-date\">" . date("M j", $row['startdate']);
        if ($row['startdate'] != $row['enddate']) {
          if (($row['startdate']+86400) <= $row['enddate']) echo "-";
          if (date("M", $row['startdate']) != date("M", $row['enddate'])) echo date("M", $row['enddate']) . " ";
          if (date("j", $row['startdate']) != date("j", $row['enddate'])) echo date("j", $row['enddate']);
        }
        echo "</td>";
        ?>
        <td class="events-title"><?php echo $row['title']; ?></td>

        <td class="events-location"><?php echo $row['location']; ?></td>

        <td class="events-details">
          <a href="event.php?<?php echo $row['id']; ?>">DETAILS <i class="fa fa-play-circle-o" aria-hidden="true"></i></a>
        </td>
      </tr>
      <?php
    }
    ?>
  </table>
</div>

<?php include "footer.php"; ?>