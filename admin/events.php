<?php
include "login.php";

$PageTitle = "Events";
include "header.php";
?>

<div class="site-width admin">
  <div class="one-half">
    <h3>Add Event</h3><br>
    <form action="events-db.php?a=add" method="POST">
      <div>
        <input type="text" name="startdate" class="startdate" placeholder="Start Date">

        <input type="text" name="enddate" class="enddate" placeholder="End Date (optional)">

        <div style="clear: both;"></div>

        <input type="text" name="starttime" class="starttime" placeholder="Start Time (optional)">

        <input type="text" name="endtime" class="endtime" placeholder="End Time (optional)">

        <div style="clear: both;"></div>

        <input type="text" name="title" placeholder="Title">

        <input type="text" name="location" placeholder="Location">

        <input type="text" name="image" placeholder="Image" id="image">

        <textarea name="details" placeholder="Details"></textarea>
        
        <input type="text" name="eventlink" placeholder="Event Link">

        <input type="submit" name="submit" value="SUBMIT" id="submit">

        <div style="clear: both;"></div>
      </div>
    </form>
  </div>
  
  <div class="one-half last">
    <h3>Events</h3><br>

    <?php
    $result = $mysqli->query("SELECT * FROM events ORDER BY startdate ASC");

    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
      echo "<div class=\"controls\">";
        echo "<a href=\"events-edit.php?id=" . $row['id'] . "\" title=\"Edit\" class=\"c-edit\"><i class=\"fa fa-pencil\"></i></a>";
        echo "<a href=\"events-db.php?a=delete&id=" . $row['id'] . "\" onClick=\"return(confirm('Are you sure you want to delete this record?'));\" title=\"Delete\" class=\"c-delete\"><i class=\"fa fa-trash\"></i></a>";
      echo "</div>";

      echo "<strong>" . date("n/j/y", $row['startdate']);
      if ($row['startdate'] != $row['enddate']) {
        echo ($row['enddate'] - $row['startdate'] == 86400) ? " & " : "-";
        echo date("n/j/y", $row['enddate']);
      }
      echo "</strong><br>";

      echo $row['title'];

      echo "<div style=\"clear: both; height: 0.7em\"></div><br>";
    }

    $result->close();
    ?>
  </div>

  <div style="clear: both;"></div>
</div>


<script type="text/javascript">
  $(document).on("click", ".select-image", function() {
    event.preventDefault();
    $("#image").val(this.title);
    $("#image").css("background-image", 'url(../images/events/'+this.title+')');
    $("#mediamanager").dialog("close");
  });
</script>

<div id="mediamanager" title="Media Manager">
  <div id="tabs">
    <ul>
      <li><a href="mm-images.php">Select Image</a></li>
      <li><a href="mm-upload.php">Upload Image</a></li>
    </ul>
  </div>
</div>

<?php include "footer.php"; ?>