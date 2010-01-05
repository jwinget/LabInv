<?php
include 'db_con.php';

$oligo_name = mysql_real_escape_string($_POST['oligo_name']);
$oligo_sequence = mysql_real_escape_string($_POST['oligo_sequence']);
$oligo_supplier = mysql_real_escape_string($_POST['oligo_supplier']);
$oligo_originator = mysql_real_escape_string($_POST['oligo_originator']);
$oligo_notes = mysql_real_escape_string($_POST['oligo_notes']);

// Process the form
$query = "INSERT INTO oligos (id, name, sequence, supplier, date_added, originator, notes) VALUES ('NULL', '".$oligo_name."', '".$oligo_sequence."', '".$oligo_supplier."', CURDATE(), '".$oligo_originator."', '".$oligo_notes."')";

mysql_query($query) or die ('Error adding oligo');

echo ('Oligo added successfully')
?>
<p><a href='oligos.php'>Return to oligo list</a></p>
