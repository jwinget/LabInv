<?php
include 'db_con.php';

$construct_name = mysql_real_escape_string($_POST['construct_name']);
$construct_sequence = mysql_real_escape_string($_POST['construct_sequence']);
$construct_parent_vector = mysql_real_escape_string($_POST['construct_parent_vector']);
$construct_resist = mysql_real_escape_string($_POST['construct_resist']);
$construct_strain = mysql_real_escape_string($_POST['construct_strain']);
$bpm_precursor = mysql_real_escape_string($_POST['construct_bpm_precursor']);
$otm_precursor_1 = mysql_real_escape_string($_POST['construct_otm_precursor_1']);
$otm_precursor_2 = mysql_real_escape_string($_POST['construct_otm_precursor_2']);
$construct_originator = mysql_real_escape_string($_POST['construct_originator']);
$construct_source = mysql_real_escape_string($_POST['construct_source']);
$construct_notes = mysql_real_escape_string($_POST['construct_notes']);

// Subroutine for handling the upload of the plasmid map
$upload_folder = 'maps/';
if((!empty($_FILES['construct_map'])) && ($_FILES['construct_map']['error'] == 0)) {
	$filename = basename($_FILES['construct_map']['name']);
	$ext = substr($filename, strrpos($filename, '.') + 1);
	if (($ext == 'png') && ($_FILES['construct_map']['type'] == 'image/png') && ($_FILES['construct_map']['size'] < 300000)) {
		$newname = dirname(__FILE__).'/maps/'.$filename;
		$map_url = 'maps/'.$filename;
		if (!file_exists($newname)) {
			if ((move_uploaded_file($_FILES['construct_map']['tmp_name'],$newname))) {
			} else {
				echo "Error: A problem occurred during file upload";
				die();
				}
		} else {
			echo "<h2>Error: File ".$_FILES['construct_map']['name']." already exists. Using the existing map. </h2><br />";
			}
	} else {
		echo "Error: Only .png images under 300kb are accepted for upload";
		die();
		}
} else {
	echo "Error: No file uploaded";
	die();
}

// Process the form
$query = "INSERT INTO constructs (id, name, sequence, parent_vector, drug_resist, strain, bpm_precursor, otm_precursor_1, otm_precursor_2, map, date_added, originator, outside_source, notes) VALUES ('NULL', '".$construct_name."', '".$construct_sequence."', '".$construct_parent_vector."', '".$construct_resist."', '".$construct_strain."', '".$bpm_precursor."', '".$otm_precursor_1."', '".$otm_precursor_2."', '".$map_url."', CURDATE(), '".$construct_originator."', '".$construct_source."', '".$construct_notes."')";

mysql_query($query) or die ('Error adding construct');

echo ('Construct added successfully')
?>
<p><a href='constructs.php'>Return to construct list</a></p>
