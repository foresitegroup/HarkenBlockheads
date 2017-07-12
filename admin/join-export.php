<?php
include("../inc/dbconfig.php");

$result = $mysqli->query("SELECT firstname,lastname,age,email,address,address2,city,state,zip,country,contest FROM `join` ORDER BY lastname ASC");

// Create header row
$csv_output = "First Name,Last Name,Age,Email,Address,Address 2,City,State,Zip Code,Country,Contest";

$data = "";

// Loop through database and put each relevant row in a line
while($row = $result->fetch_array(MYSQLI_NUM)) {
	$line = '';
	foreach($row as $value) {
		if ((!isset($value)) OR ($value == "") OR ($value == "12/31/1969")) {
			$value = ",";
		} else {
			$value = str_replace('"', '""', $value);
      $value = str_replace("\n", " ", $value);
			$value = '"' . $value . '"' . ",";
		}
		$line .= $value;
	}
  $data .= rtrim($line, ",") . "\n";
}

// Remove trailing come at end of line and add new line
$data = str_replace("\r","",$data);

// Done with the database
$result->free();

// Create the CSV file
$filename = "Join_" . date("Ymd-Hi") . ".csv";
$content = $csv_output."\n".$data;

$fd = fopen ($filename, "w");
fputs($fd, $content);
fclose($fd);

// Prepare to email the file
$content = chunk_split(base64_encode($content));
$uid = md5(uniqid(time()));
$eol = PHP_EOL;

// Basic headers
$header = "From: Blockheads Database <database@harkenblockheads.com>".$eol;
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"";

// Put everything else in $message
$message = "--".$uid.$eol;
$message .= "Content-Type: text/html; charset=ISO-8859-1".$eol;
$message .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
// $message .= "Email text goes here.".$eol;
$message .= "--".$uid.$eol;
$message .= "Content-Type: application/csv; name=\"".$filename."\"".$eol;
$message .= "Content-Transfer-Encoding: base64".$eol;
$message .= "Content-Disposition: attachment; filename=\"".$filename."\"".$eol;
$message .= $content.$eol;
$message .= "--".$uid."--";

// Send the mail
mail("hays.formella@harken.com", "Join Database Export", $message, $header);
// mail("lippert@gmail.com", "Join Database Export", $message, $header);

// All done, delete the file
unlink($filename);
?>