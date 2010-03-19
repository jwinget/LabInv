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
<h1>FASTA Sequence output:</h1>
<?php
include 'db_con.php';

$dna_type = $_GET['dna_type'];
echo ('<a href = "browse.php?dna_type='.$dna_type.'">Back to '.$dna_type.' database</a><br />');

echo "<TEXTAREA NAME='fasta_seqs' ROWS='60' COLS='60'>";
if (isset($dna_type)) {
	$id = $_GET['id'];
	if (isset($id)) {
		if ($id == 'all') {
			$result = sprintf("SELECT * FROM %s",
				mysql_real_escape_string($dna_type.'s'));
				}
		else {
			$result = sprintf("SELECT * FROM %s WHERE id = %s",
				mysql_real_escape_string($dna_type.'s'),
				mysql_real_escape_string($id));
				}
		$query = mysql_query($result) or die("Query failed with: ".mysql_error());
		while ($row = mysql_fetch_array($query))
			{
			$cleanseq = trim(strtolower(str_replace(array(" ", "\n", "\r"), '', $row['sequence'])));
			$str = '&gt;'.$row['name']."\n".$cleanseq."\n\n";
			echo $str;
			}
		}
	};
	
?>
</TEXTAREA>
</div>
<?php
};
include 'foot.php' ?>
