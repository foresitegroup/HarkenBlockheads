<?php
include "login.php";

$PageTitle = "Edit Event";
include "header.php";

$result = $mysqli->query("SELECT * FROM events WHERE id = '" . $_GET['id'] . "'");
$row = $result->fetch_array(MYSQLI_ASSOC);
?>

<div class="site-width admin edit">
  <div class="one-half edit">
    <h3>Edit Event</h3><br>
    <form action="events-db.php?a=edit" method="POST">
      <div>
        <input type="text" name="startdate" class="startdate" placeholder="Start Date" value="<?php echo date("m/d/Y", $row['startdate']); ?>">

        <input type="text" name="enddate" class="enddate" placeholder="End Date (optional)" value="<?php if ($row['enddate'] != $row['startdate']) echo date("m/d/Y", $row['enddate']); ?>">

        <div style="clear: both;"></div>

        <input type="text" name="starttime" class="starttime" placeholder="Start Time (optional)" value="<?php if (date("g:ia", $row['startdate']) != "12:00am") echo date("g:ia", $row['startdate']); ?>">

        <input type="text" name="endtime" class="endtime" placeholder="End Time (optional)" value="<?php if ($row['enddate'] != $row['startdate'] && date("g:ia", $row['enddate']) != "12:00am") echo date("g:ia", $row['enddate']); ?>">

        <div style="clear: both;"></div>

        <input type="text" name="title" placeholder="Title"<?php if ($row['title'] != "") echo "value=\"" . $row['title'] . "\""; ?>>

        <input type="text" name="location" placeholder="Location"<?php if ($row['location'] != "") echo "value=\"" . $row['location'] . "\""; ?>>

        <input type="text" name="image" placeholder="Image" id="image"<?php if ($row['image'] != "") echo "value=\"" . $row['image'] . "\" style=\"background-image: url(../images/events/" . $row['image'] . ");\""; ?>>

        <textarea name="details" placeholder="Details"><?php if ($row['details'] != "") echo $row['details']; ?></textarea>
        
        <input type="text" name="eventlink" placeholder="Event Link"<?php if ($row['eventlink'] != "") echo "value=\"" . $row['eventlink'] . "\""; ?>>

        Show details link? &nbsp;
        <input type="radio" name="detailslink" value="yes" id="dly"<?php if ($row['detailslink'] == "yes") echo " checked"; ?>> <label for="dly">Yes</label>
        &nbsp; &nbsp;
        <input type="radio" name="detailslink" value="no" id="dln"<?php if ($row['detailslink'] == "no") echo " checked"; ?>> <label for="dln">No</label>
        <br><br>

        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <input type="submit" name="submit" value="UPDATE"  style="display: block; margin: 0 auto;">

        <div style="clear: both;"></div>
      </div>
    </form>
  </div>
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