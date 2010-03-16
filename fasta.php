<?php
	session_start();
	if (!isset ($_SESSION['valid_user'])){
		header('Location: login.php');
		}
	else {
	include 'head.php';

	# Hide errors when $fasta_id isn't set
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>

</head>
<body>
<div id='container'>
<div id='main'>
<?php
include 'db_con.php';

$dna_type = $_GET['dna_type'];
if (isset($dna_type)) {
	$id = $_GET['id'];
	if (isset($id)) {
		if ($id == 'all') {
			$result = sprintf("SELECT * FROM %s",
				mysql_real_escape_string($dna_type));
				}
		else {
			$result = sprintf("SELECT * FROM %s WHERE id = %s",
				mysql_real_escape_string($dna_type),
				mysql_real_escape_string($id));
				}
		$query = mysql_query($result) or die("Query failed with: ".mysql_error());
		while ($row = mysql_fetch_array($query))
			{
			echo "<pre>>".$row['name']."<br />";
			echo $row['sequence']."</pre><br />";
			}
		}
	};
	
?>
</div>
</div>
<?php
};
include 'foot.php' ?>
