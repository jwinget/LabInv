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
		<h1><?php 

			$dna_type = $_GET['dna_type'];
			switch ($dna_type) {
				case 'oligo':
					break;
				case 'construct':
					break;
				default:
					header('Location: 404.php');
					break;
					}
			$id = $_GET['id'];
			// If the ID is set, we will modify that entry
			if (isset($id)) {
					echo 'Modify ';
					}
			else {				
					echo 'New ';
					}
			echo ucwords($dna_type);
		?></h1>
	</div>
	<div id='nav'>
		<ul id='crumbs'>
			<li><a href='index.php'>Home</a></li>
			<li><a href='browse.php?dna_type=<?php echo $dna_type; ?>'><?php echo ucwords($dna_type); ?> Database</a></li>
			<li><p><?php
				if (isset($id)) {
						echo 'Modify ';
						}
				else		{
						echo 'Add ';
						}
				echo ucwords($dna_type);
				?></p></li>
		</ul>
	</div>
	<div id='main'>
	<?php
		switch ($dna_type) {
			case 'construct':
				$form_enctype = 'ENCTYPE="multipart/form-data"';
				$nametype = 'BPM';
				break;
			case 'oligo':
				$nametype = 'OTM';
				break;
			default:
				break;
			}
		$id = $_GET['id'];
			if (isset($id)) {
				// Get the data for this entry from the DB
				include 'db_con.php';
				$result = sprintf ("SELECT * FROM ".$dna_type."s WHERE id = '%s'", mysql_real_escape_string($id));
				$query = mysql_query($result) or die ('Query error');
				while ($row = mysql_fetch_array($query)) {
				// Assign the variables to populate form fields
					$dnaname = $row['name'];
					$short_desc = $row['short_desc'];
					$sequence = $row['sequence'];
					$originator = $row['originator'];
					$notes = $row['notes'];
					switch ($dna_type) {
						case 'construct':
							$parent_vector = $row['parent_vector'];
							$drug_resist = $row['drug_resist'];
							$strain = $row['strain'];
              $map = $row['map'];
							break;
						case 'oligo':
							$supplier = $row['supplier'];
							$concentration = $row['concentration'];
							break;
					}
				}
			}
	?>
	<FORM <?php echo $form_enctype; ?> 
		ACTION='db_add.php?dna_type=<?php echo $dna_type; 
			if (isset($id)) {
				echo '&id='.$id;
				}
		?>' METHOD=POST>
	<ul id='addform'>
		<li><h4><?php echo $nametype; ?> Name:</h4><INPUT TYPE=TEXT NAME='dna_name' VALUE="<?php echo $dnaname; ?>" /></li>
		<li><h4>Short Description:</h4><p>This will be shown when browsing the full database</p><pre>Max 140 characters</pre><TEXTAREA ROWS='2' COLS='40' NAME='short_desc'><?php echo $short_desc; ?></textarea></li>
		<li><h4>Sequence:</h4><TEXTAREA ROWS='10' COLS='40' NAME='dna_sequence'><?php echo $sequence; ?></textarea></li>
		<?php
		switch ($dna_type) {
			case 'construct':
				echo '<li><h4>Parent Vector:</h4><INPUT TYPE="TEXT" NAME="parent_vector" VALUE="'.$parent_vector.'" /></li>';
				if (!isset($id)) {
					// Only show the map fields if this is a new entry
					echo '<li><h4>Map:</h4>';
					echo '<a class="inline" href="http://wishart.biology.ualberta.ca/PlasMapper/" target="_blank">Generate map</a><p class="inline">, save to your computer, and upload below</p><br />';
					echo '<INPUT TYPE=HIDDEN NAME="max_map_size" VALUE="300000" />';
					echo '<INPUT TYPE=FILE NAME="dna_map" /></li>';
				}
        else {
          echo '<INPUT TYPE=HIDDEN NAME="existing_map" VALUE="'.$map.'" />';
        }
				echo '<li><h4>Drug Resistance:</h4><INPUT TYPE=TEXT NAME="dna_resist" VALUE="'.$drug_resist.'" /></li>';
				echo '<li><h4>Strain:</h4><INPUT TYPE=TEXT NAME="strain" VALUE="'.$strain.'" /></li>';
				break;
			case 'oligo':
				echo '<li><h4>Supplier:</h4><INPUT TYPE=TEXT NAME="supplier" VALUE="'.$supplier.'" /></li>';
				echo '<li><h4>Concentration (&#181;M, number only)</h4><INPUT TYPE=TEXT WIDTH="4" NAME="concentration" VALUE="'.$concentration.'" /></li>';
				break;
			default:
				break;
		}
		?>
		<li><h4>Entered by:</h4><INPUT TYPE=TEXT NAME="originator" VALUE="<?php echo $originator; ?>" /></li>
		<li><h4>Notes and Usage:</h4>
		<?php
		switch ($dna_type) {
		default:
			break;
		case 'construct':
			echo ("<pre>include source if outside of the lab</pre>");
		}
		?>
		<TEXTAREA ROWS="5" COLS="40" NAME="notes"><?php echo $notes; ?></textarea></li>
		<li><INPUT TYPE=SUBMIT NAME="submit_dna" ID="submit_dna" VALUE="SUBMIT" /></li>
	</ul>
	</FORM>
</div>
<?php
};
include 'foot.php'; ?>
