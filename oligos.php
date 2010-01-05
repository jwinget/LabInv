<?php
	session_start();
	if (!isset ($_SESSION['valid_user'])){
		header('Location: login.php');
		}
	else {
	include 'head.php';
?>

	<script> //<![CDATA[    
		// When the page is ready
		$(document).ready(function(){
			$("#add_oligo").click(function(event){
				$('#oligo_add').toggle('slow');
				event.preventDefault();
     		});
		});
	//]]></script>
</head>
<body>
<h1>Oligo Database</h1>
<div id='oligo_add' style='display:none;'>
		<FORM ACTION="oligo_add.php" METHOD=POST>
		<h4>Oligo Name:</h4>
		<INPUT TYPE=TEXT NAME="oligo_name" />
		<h4>Sequence:</h4>
		<INPUT TYPE=TEXT NAME="oligo_sequence" />
		<h4>Supplier:</h4>
		<INPUT TYPE=TEXT NAME="oligo_supplier" />
		<h4>Entered by:</h4>
		<INPUT TYPE=TEXT NAME="oligo_originator" />
		<h4>Notes and Usage:</h4>
		<TEXTAREA ROWS="5" COLS="40" NAME="oligo_notes"></textarea>
		<INPUT TYPE=SUBMIT NAME="submit_oligo" ID="submit_oligo" VALUE="SUBMIT" />
	</FORM>
</div>

<div id='oligo_list'>
<?php
include 'db_con.php';

// Check to see if this is a detail page
$id = $_GET['oligo_id'];
if (isset($id)) { 
	$result = sprintf("SELECT * FROM oligos WHERE id = '%s'",
		mysql_real_escape_string($id));
	$query = mysql_query($result);
	while ($row = mysql_fetch_array($query))
		{
		echo "<h1>".$row['name']."</h1>";
		echo "<h4>Sequence:</h4><code>".$row['sequence']."</code>";
		echo "<h4>Date added</h4><p>".$row['date_added']."</p>";
		echo "<h4>Added by</h4><p>".$row['originator']."</p>";
		echo "<h4>Supplier</h4><p>".$row['supplier']."</p>";
		echo "<h4>Notes</h4><p>".$row['notes']."</p>";
		}
	echo '<a href="oligo_delete.php?oligo_id='.$id.'>Delete oligo</a>';
	}
	

else { 
// Get oligo list
$result = mysql_query("SELECT * FROM oligos");
	if (!$result) {
		echo('<p>Error retrieving oligo list</p>');
		exit();
	}
	else {
		while ($row = mysql_fetch_array($result))
			{
			echo "<a href=?oligo_id=" . $row['id'] . '> ' . $row['name'] . '</a>';
			echo '<br />';
			}
		}
	}
?>
</div>
<p><a href='' id='add_oligo'>Add an oligo</a></p>
<?php 
};
include 'foot.php' ?>
