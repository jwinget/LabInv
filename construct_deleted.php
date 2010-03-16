<?php
include 'db_con.php';
$id = $_POST['construct_id'];
if (isset($id)) {
	$del_query = sprintf("DELETE FROM constructs WHERE id = %s",
		mysql_real_escape_string($id));
	mysql_query($del_query) or die ('Error deleting construct');
	}
echo ('Construct deleted successfully')
?>
<p><a href='constructs.php'>Return to construct list</a></p>
