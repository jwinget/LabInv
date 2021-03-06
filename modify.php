<?php
	session_start();
	if (!isset ($_SESSION['valid_user'])){
		header('Location: login.php');
		}
	else {
		include 'head.php';
		error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
</head>
<body>
<div id='container'>
	<div id='top'>
		<?php $dna_type = $_GET['dna_type'];
			switch ($dna_type) {
				case 'oligo':
					$nametype = 'OTM';
					break;
				case 'construct':
					$nametype = 'BPM';
					break;
				default:
					header('Location: 404.php');
					break;
					}
		?>
		<h1>Modify <?php echo ucwords($dna_type); ?> Entry</h1>
	</div>
	<div id='nav'>
		<ul id='crumbs'>
			<li><a href='index.php'>Home</a></li>
			<li><a href='browse.php?dna_type=<?php echo $dna_type; ?>'><?php echo ucwords($dna_type); ?> Database</a></li>
			<li><p>Modify <?php echo ucwords($dna_type); ?></p></li>
		</ul>
	</div>
	<div id='main'>
	<?php
		switch ($dna_type) {
			case 'construct':
				$form_enctype = 'ENCTYPE="multipart/form-data"';
				break;
			default:
				break;
			}
	
	# Get the data for this entry
	include 'db_con.php';
	$id = $_GET['id'];
	if (!isset($id)) {
		echo 'Error: '.$dna_type.' ID not set';
		}
	else {
		$result = sprintf("SELECT * FROM ".$dna_type."s WHERE id = '%s'",
			mysql_real_escape_string($id));
		$query = mysql_query($result) or die('Query error');
		while ($row = mysql_fetch_array($query)) {
	echo "<FORM ".$form_enctype." ACTION='db_modify.php?dna_type=".$dna_type."&id=".$id."' METHOD=POST>";
	echo "<ul id='addform'>";
		echo "<li><h4>".$nametype." Name:</h4><INPUT TYPE=TEXT NAME='dna_name' value='".$row['name']."'/></li>";
		echo '<li><h4>Short Description:</h4><TEXTAREA ROWS="3" COLS="40" NAME="short_desc">'.$row['short_desc'].'</textarea></li>';
		echo "<li><h4>Sequence:</h4><TEXTAREA ROWS='10' COLS='40' NAME='dna_sequence'>".$row['sequence']."</textarea></li>";
		switch ($dna_type) {
			case 'construct':
				echo '<li><h4>Parent Vector:</h4><INPUT TYPE="TEXT" NAME="parent_vector" VALUE='.$row['parent_vector'].' /></li>';
				echo '<li><h4>Drug Resistance:</h4><INPUT TYPE=TEXT NAME="dna_resist" VALUE='.$row['drug_resist'].' /></li>';
				echo '<li><h4>Strain:</h4><INPUT TYPE=TEXT NAME="strain" VALUE='.$row['strain'].' /></li>';
				break;
			case 'oligo':
				echo '<li><h4>Supplier:</h4><INPUT TYPE=TEXT NAME="supplier" VALUE='.$row['supplier'].' /></li>';
				echo '<li><h4>Concentration, in mM</h4><INPUT TYPE=TEXT WIDTH="4" NAME="concentration" VALUE='.$row['concentration'].' /></li>';
				break;
			default:
				break;
		}
		echo '<li><h4>Entered by:</h4><INPUT TYPE=TEXT NAME="originator" VALUE='.$row['originator'].' /></li>';
		echo '<li><h4>Notes and Usage:</h4><TEXTAREA ROWS="5" COLS="40" NAME="notes">'.$row['notes'].'</textarea></li>';
		echo '<li><input type="checkbox" name="deletebox" value="delete"><h4 class="inline">Delete '.$dna_type.'</h4></input>';
		echo '<li><INPUT TYPE=SUBMIT NAME="modify_dna" ID="modify_dna" VALUE="MODIFY" /></li>';
	echo "</ul>";
	echo "</FORM>";
	}
	}
	?>
</div>
<?php
};
include 'foot.php'; ?>
