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
<div id='container'>
<div id='top'>
	<h1>Oligo Database</h1>
</div>
<div id='nav'>
<ul id='crumbs'>
	<li><a href='index.php'>Home</a></li>
	<li><p>Oligo Database</p></li>
</ul>
</div>
<div id='main'>
<div id='oligo_add' style='display:none;'>
		<FORM ACTION="oligo_add.php" METHOD=POST>
		<h4>Oligo Name:</h4>
		<INPUT TYPE=TEXT NAME="oligo_name" /><br />
		<h4>Sequence:</h4>
		<INPUT TYPE=TEXT NAME="oligo_sequence" /><br />
		<h4>Supplier:</h4>
		<INPUT TYPE=TEXT NAME="oligo_supplier" /><br />
		<h4>Concentration:</h4>
		<INPUT TYPE=TEXT WIDTH='4' NAME="oligo_concentration" /><br />
		<h4>Entered by:</h4>
		<INPUT TYPE=TEXT NAME="oligo_originator" /><br />
		<h4>Notes and Usage:</h4>
		<TEXTAREA ROWS="5" COLS="40" NAME="oligo_notes"></textarea><br />
		<INPUT TYPE=SUBMIT NAME="submit_oligo" ID="submit_oligo" VALUE="SUBMIT" />
	</FORM>
</div>
<p><a href='' id='add_oligo'>Add an oligo</a></p>

<div id='oligo_list'>
<?php
include 'db_con.php';

// Check to see if this is a detail page
$id = $_GET['oligo_id'];
if (isset($id)) {
	echo("<a href='oligos.php'>Back to full list</a>");
	$result = sprintf("SELECT * FROM oligos WHERE id = '%s'",
		mysql_real_escape_string($id));
	$query = mysql_query($result);
	while ($row = mysql_fetch_array($query))
		{
		echo "<h1>".$row['name']."</h1>";
		echo "<h4>Sequence:</h4><code>".$row['sequence']."</code>";
		echo "<h4>Notes:</h4><p>".$row['notes']."</p>";
		echo "<h4>Concentration:</h4><p>".$row['concentration']."</p>";
		echo "<h4>Added by</h4><p>".$row['originator']."</p>";
		echo "<h4>Supplier</h4><p>".$row['supplier']."</p>";
		echo "<h4>Date added</h4><p>".$row['date_added']."</p>";
		}
	echo '<a href="oligo_delete.php?oligo_id='.$id.'>Delete oligo</a>';
	}
	

else { 
// Get oligo list
echo ("<ul id='oligo_list'>");
$result = mysql_query("SELECT * FROM oligos");
	if (!$result) {
		echo('<p>Error retrieving oligo list</p>');
		exit();
	}
	else {
		while ($row = mysql_fetch_array($result))
			{
			echo "<li><p><a href=?oligo_id=" . $row['id'] . "> " . $row['name'] . "</a> - ".$row['notes']."</p></li>";
			}
		}
	}
?>
</div>
</div>
<?php 
};
include 'foot.php' ?>
