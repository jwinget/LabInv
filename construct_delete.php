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
$id = $_GET['construct_id'];
if (isset($id)) {
	$result = sprintf("SELECT * FROM constructs WHERE id = '%s'",
		mysql_real_escape_string($id));
	$query = mysql_query($result);
	while ($row = mysql_fetch_array($query))
		{
		echo "<h2>Are you sure you want to delete ".$row['name']."?</h2>";
		}
	}
?>
<h4><alert>This cannot be undone</alert></h4>
<FORM ACTION='construct_deleted.php' METHOD=POST>
<?php echo "<INPUT TYPE=HIDDEN NAME='construct_id' VALUE=".$id.">"; ?>
<INPUT TYPE=SUBMIT NAME='delete_construct' ID='delete_construct' VALUE='DELETE' />
</FORM>
<?php
};
include 'foot.php' ?>
