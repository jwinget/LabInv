<?php
	session_start();
	if (!isset ($_SESSION['valid_user'])){
		header('Location: login.php');
		}
	else {
	include 'head.php';

	# Hide errors when $construct_id isn't set
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
	</script>
	<script> //<![CDATA[    
		// When the page is ready
		$(document).ready(function(){
			$("#add_construct").click(function(event){
				$('#construct_add').toggle('slow');
				event.preventDefault();
     		});
		});
	//]]></script>
</head>
<body>
<div id='container'>
<div id='top'>
	<h1>DNA Construct Database</h1>
</div>
<div id='nav'>
<ul id='crumbs'>
	<li><a href='index.php'>Home</a></li>
	<li><p>DNA Construct Database</p></li>
</ul>
</div>
<div id='main'>
<div id='construct_add' style='display:none;'>
		<FORM ENCTYPE='multipart/form-data' ACTION="construct_add.php" METHOD=POST>
		<h4>Construct Name:</h4>
		<INPUT TYPE=TEXT NAME="construct_name" /><br />
		<h4>Sequence:</h4>
		<TEXTAREA ROWS="10" COLS="40" NAME="construct_sequence"></textarea><br />
		<h4>Parent Vector:</h4>
		<INPUT TYPE=TEXT NAME="construct_parent_vector" /><br />
		<h4>Map:</h4>
		<a class='inline' href='http://wishart.biology.ualberta.ca/PlasMapper/' target='_blank'>Generate map here</a><p class='inline'>, save to your computer, and upload below</p><br />
		<INPUT TYPE=HIDDEN NAME='max_map_size' VALUE='300000'/ >
		<INPUT TYPE=FILE NAME="construct_map" /><br />
		<h4>Drug Resistance:</h4>
		<INPUT TYPE=TEXT NAME="construct_resist" /><br />
		<h4>Strain:</h4>
		<INPUT TYPE=TEXT WIDTH='4' NAME="construct_strain" /><br />
		<h4>Entered by:</h4>
		<INPUT TYPE=TEXT NAME="construct_originator" /><br />
		<h4>Notes and Usage:</h4>
		<TEXTAREA ROWS="5" COLS="40" NAME="construct_notes"></textarea><br />
		<h5>BPM Precursor:</h5>
		<INPUT TYPE=TEXT NAME="construct_bpm_precursor" /><br />
		<h5>OTM Precursor 1:</h5>
		<INPUT TYPE=TEXT NAME="construct_otm_precursor_1" /><br />
		<h5>OTM Precursor 2:</h5>
		<INPUT TYPE=TEXT NAME="construct_otm_precursor_2" /><br />
		<h5>Outside Source:</h5>
		<INPUT TYPE=TEXT NAME="construct_source" /><br />
		<INPUT TYPE=SUBMIT NAME="submit_construct" ID="submit_construct" VALUE="SUBMIT" />
	</FORM>
</div>
<p><a href='' id='add_construct'>Add a construct</a></p>

<div id='construct_list'>
<?php
include 'db_con.php';

// Check to see if this is a detail page
$id = $_GET['construct_id'];
if (isset($id)) {
	$result = sprintf("SELECT * FROM constructs WHERE id = '%s'",
		mysql_real_escape_string($id));
	$query = mysql_query($result);
	while ($row = mysql_fetch_array($query))
		{
		echo "<div id='topbar'>";
		echo "<ul>";
		echo "<li><a href='fasta.php?dna_type=constructs&id=".$row['id']."'>FASTA</a></li>";
		echo "<li><a href=".$row['map'].">Plasmid Map</a></li>";
		echo "<li><a href='constructs.php'>Full construct list</a></li>";
		echo "<li><a href='help.php'>Help</a></li>";
		echo "</ul>";
		echo "</div>";
		echo "<h1>".$row['name']."</h1>";
		echo "<div id='mapdiv'><a href=".$row['map']."><img src=".$row['map']." /></a></div>";
		echo "<h4>Resistance:</h4><p>".$row['drug_resist']."</p><br />";
		echo "<h4>Strain:</h4><p>".$row['strain']."</p><br />";
		echo "<h4>Notes:</h4><p>".$row['notes']."</p><br />";
		echo "<h4>Originator:</h4><p>".$row['originator']."</p><br />";
		}
	echo '<a href="construct_delete.php?construct_id='.$id.'>Delete construct</a>';
	}
	

else { 
// Get oligo list
echo ("<ul id='construct_list'>");
$result = mysql_query("SELECT * FROM constructs");
	if (!$result) {
		echo('<p>Error retrieving construct list</p>');
		exit();
	}
	else {
		while ($row = mysql_fetch_array($result))
			{
			echo "<li><p><a href=?construct_id=" . $row['id'] . "> " . $row['name'] . "</a> - ".$row['notes']."</p></li>";
			}
		}
	}
?>
</div>
</div>
<?php 
};
include 'foot.php' ?>
