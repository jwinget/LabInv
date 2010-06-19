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
<?php 
	$dna_type = $_GET['dna_type'];
	
	# Redirect to index if the dna type isn't set or is set incorrectly 
	switch ($dna_type) {
		case 'oligo':
			break;
		case 'construct':
			break;
		default:
			header('Location: index.php');
			break;
			}
?>
<div id='container'>
	<div id='top'>
		<?php
			echo '<h1>'.ucwords($dna_type).' Database</h1>';
		?>
	</div>
	<div id='nav'>
		<ul id='crumbs'>
			<li><a href='index.php'>Home</a></li>
			<li><p><?php echo ucwords($dna_type).' Database'; ?></p></li>
		</ul>
		<div id="db_utilities"><a class='inline' href='<?php echo 'add.php?dna_type='.$dna_type ;?>'>Add <?php echo ucwords($dna_type); ?></a> | <a class='inline' href='fasta.php?dna_type=<?php echo $dna_type; ?>&id=all'>FASTA sequences</a></div>
	</div>
	<div id='main'>
		<div id='view'>
		<?php
		include 'db_con.php';

		# Check to see if this a detail page
		$id = $_GET['id'];
		if (isset($id)) {
			$result = sprintf("SELECT * FROM ".$dna_type."s WHERE id = '%s'",
				mysql_real_escape_string($id));
			$query = mysql_query($result);
			while ($row = mysql_fetch_array($query)) {
				echo "<div id='topbar'>";
				echo "<ul>";
				echo ("<li><a href='browse.php?dna_type=".$dna_type."'>Complete List</a></li>");
				echo ("<li><a href='fasta.php?dna_type=".$dna_type."&id=".$id."'>FASTA Sequence</a></li>");
			# only link to the plasmid map if this is a construct
			switch ($dna_type) {
				default:
					break;
				case 'oligo':
					break;
				case 'construct':
					echo ("<li><a href='".$row['map']."'>Plasmid Map</a></li>");
					break;
				}
				echo ("<li><a href='help.php'>Help</a></li>");
				echo '</ul>';
				echo '</div>';
        echo '<ul class="utilities">';
                		echo ("<li><a href='add.php?dna_type=".$dna_type."&id=".$id."'>Modify Entry</a></li>");
        echo '</ul>';
        echo "<h1>".$row['name']."</h1>";
				echo "<p>".$row['short_desc']."</p><br />";
			# display information based on dna type
			switch ($dna_type) {
				default:
					break;
				case 'oligo':
					echo "<h4>Sequence:</h4><p>".$row['sequence']."</p>";
					echo "<h4>Tm:</h4><p>".$row['tm']."&deg C</p>";
					echo "<h4>Concentration (&#181;M):</h4><p>".$row['concentration']."</p>";
					echo "<h4>Supplier:</h4><p>".$row['supplier']."</p>";
					break;
				case 'construct':
					echo "<div id='mapdiv'><a href=".$row['map']."><img src=".$row['map']." /></a></div>";
					echo "<h4>Parent Vector:</h4><p>".$row['parent_vector']."</p><br />";
					echo "<h4>Resistance:</h4><p>".$row['drug_resist']."</p><br />";
					echo "<h4>Strain:</h4><p>".$row['strain']."</p><br />";
					break;
					}
				echo "<h4>Notes:</h4><p>".$row['notes']."</p>";
				echo "<h4>Added By:</h4><p>".$row['originator']."</p>";
				echo "<h4>Date Added:</h4><p>".$row['date_added']."</p>";
				}
		}
		else {
			echo ("<ul id='".$dna_type."_list'>");
			$result = mysql_query("SELECT * FROM ".$dna_type."s");
				if(!$result) {
					echo('<p>Error retrieving listings from database</p>');
					exit();
				}
				else {
					// Set up an array to be sorted
					$resultarray = array();
					while ($row = mysql_fetch_array($result))
						{
						$resultarray[$row['name']] = $row;
						}
					function natksort($array) {
						$keys = array_keys($array);
						natsort($keys);

						$ret = array();
						foreach ($keys as $k) {
							$ret[$k] = $array[$k];
						}
						return $ret;
					}

					$resultarray = natksort($resultarray);
					foreach ($resultarray as $resultvalue) {
						echo ("<li><p><a href=?dna_type=".$dna_type."&id=".$resultvalue['id'].">".$resultvalue['name']."</a>");
						echo (" - ".$resultvalue['short_desc']."</p></li>");
						}
					}
				}
		?>
	</div>
</div>
<?php
#Close the else statement follwing the check for login credentials
};
include 'foot.php'; ?>
