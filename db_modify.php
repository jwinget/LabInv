<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include 'db_con.php';
$dna_type = $_GET['dna_type'];

$name = mysql_real_escape_string($_POST['dna_name']);
$sequence = mysql_real_escape_string($_POST['dna_sequence']);
$originator = mysql_real_escape_string($_POST['originator']);
$notes = mysql_real_escape_string($_POST['notes']);
$short_desc = mysql_real_escape_string($_POST['short_desc']);

switch ($dna_type) {
	case 'construct':
		$parent_vector = mysql_real_escape_string($_POST['parent_vector']);
		$resist = mysql_real_escape_string($_POST['dna_resist']);
		$strain = mysql_real_escape_string($_POST['strain']);
		// Subroutine for handling the upload of the plasmid map
		$upload_folder = 'maps/';
		if((!empty($_FILES['dna_map'])) && ($_FILES['dna_map']['error'] == 0)) {
			$filename = basename($_FILES['dna_map']['name']);
			$ext = substr($filename, strrpos($filename, '.') + 1);
			if (($ext == 'png') && ($_FILES['dna_map']['type'] == 'image/png') && ($_FILES['dna_map']['size'] < 300000)) {
				$newname = dirname(__FILE__).'/maps/'.$filename;
				$map_url = 'maps/'.$filename;
				if (!file_exists($newname)) {
					if ((move_uploaded_file($_FILES['dna_map']['tmp_name'],$newname))) {
					} else {
						echo "Error: A problem occurred during file upload";
						die();
						}
				} else {
					echo "<h2>Error: File ".$_FILES['dna_map']['name']." already exists. Using the existing map. </h2><br />";
					}	
			} else {
				echo "Error: Only .png images under 300kb are accepted for upload";
				die();
				}
		} else {
			echo "Error: No file uploaded";
			die();
		}

		break;
	case 'oligo':
		$supplier = mysql_real_escape_string($_POST['supplier']);
		$concentration = mysql_real_escape_string($_POST['concentration']);
		// Subroutine for calculating Tm
		$cleanseq = strtolower(trim(str_replace(array(" ", "\n", "\r"), "", $_POST['sequence'])));
		$g_count = substr_count($cleanseq, 'g');
		$c_count = substr_count($cleanseq, 'c');
		$gc = ($g_count+$c_count)/strlen($cleanseq);
		$tm = 64.9+41*($g_count+$c_count-16.4)/strlen($cleanseq);
		break;
	default:
		break;
}

// Process the form
# type-dependent rows
switch ($dna_type) {
	case 'construct':
		$type_rows = 'parent_vector, drug_resist, strain, map';
		break;
	case 'oligo':
		$type_rows = 'concentration, supplier, tm';
		break;
	default:
		break;
}

# type-dependent variables
switch ($dna_type) {
	case 'construct':
		$type_values = $parent_vector."', '".$resist."', '".$strain."', '".$map_url;
		break;
	case 'oligo':
		$type_values = $concentration."', '".$supplier."', '".$tm;
		break;
	default:
		break;
	}

$query = "INSERT INTO ".$dna_type."s (id, name, sequence, date_added, originator, notes, short_desc, ".$type_rows.") VALUES ('NULL', '".$name."', '".$sequence."', CURDATE(), '".$originator."', '".$notes."', '".$short_desc."', '".$type_values."')";
mysql_query($query) or die ('Error adding '.$dna_type);
header('Location: add_success.php?dna_type='.$dna_type);
?>
