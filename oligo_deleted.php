<?php
include 'db_con.php';
$id = $_POST['oligo_id'];
if (isset($id)) {
	$del_query = sprintf("DELETE FROM oligos WHERE id = '%s'",
		mysql_real_escape_string($id));
	mysql_query($del_query) or die ('Error deleting oligo');
	}
echo ('Oligo deleted successfully')
?>
<p><a href='oligos.php'>Return to oligo list</a></p>
