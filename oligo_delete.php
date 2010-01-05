<?php
	session_start();
	if (!isset ($_SESSION['valid_user'])){
		header('Location: login.php');
		}
	else {
	include 'head.php';
?>
</head>
<body>
<?php
include 'db_con.php';
$id = $_GET['oligo_id'];
if (isset($id)) {
	$result = sprintf("SELECT * FROM oligos WHERE id = '%s'",
		mysql_real_escape_string($id));
	$query = mysql_query($result);
	while ($row = mysql_fetch_array($query))
		{
		echo "<h2>Are you sure you want to delete ".$row['name']."?</h2>";
		}
	}
?>
<h4>This cannot be undone</h4>
<FORM ACTION='oligo_deleted.php' METHOD=POST>
<?php echo "<INPUT TYPE=HIDDEN NAME='oligo_id' VALUE=".$id.">"; ?>
<INPUT TYPE=SUBMIT NAME='delete_oligo' ID='delete_oligo' VALUE='DELETE' />
</FORM>
<?php
};
include 'foot.php' ?>
