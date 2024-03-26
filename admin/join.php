<?php
include "login.php";

$PageTitle = "Sigh Ups";
include "header.php";
?>

<style>
  .admin { margin: 0 auto; width: 96%; }
  TD { font-size: 80%; }
  A .fa-trash { color: #888888; margin-right: 0.5em; font-size: 140%; }
  A:hover .fa-trash { color: #ED1835; }
</style>

<div class="admin">
  <h3>Sign Ups</h3>
  <a href="join-export.php">Export to CSV</a><br>
  <br>

  <table style="width: 100%;" cellspacing="0">
    <tr style="background: #ED1835;">
      <td>&nbsp;</td>
      <td>First Name</td>
      <td>Last Name</td>
      <td>Age</td>
      <td>Email</td>
      <td>Address</td>
      <td>Address 2</td>
      <td>City</td>
      <td>State</td>
      <td>Zip</td>
      <td>Country</td>
    </tr>

    <?php
    $result = $mysqli->query("SELECT * FROM `join` ORDER BY id DESC");

    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
      echo "<tr>\n";
      
      echo "<td><a href=\"join-db.php?a=delete&id=".$row['id']."\" onClick=\"return(confirm('Are you sure you want to delete this record?'));\" title=\"Delete\"><i class=\"fa fa-trash\"></i></a></td>\n";
      echo "<td>".$row['firstname']."</td>\n";
      echo "<td>".$row['lastname']."</td>\n";
      echo "<td>".$row['age']."</td>\n";
      echo "<td>".$row['email']."</td>\n";
      echo "<td>".$row['address']."</td>\n";
      echo "<td>".$row['address2']."</td>\n";
      echo "<td>".$row['city']."</td>\n";
      echo "<td>".$row['state']."</td>\n";
      echo "<td>".$row['zip']."</td>\n";
      echo "<td>".$row['country']."</td>\n";

      echo "</tr>\n";
    }

    $result->close();
    ?>
  </table>
</div>

<?php include "footer.php"; ?>