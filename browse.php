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
	if(!isset ($dna_type)) {
		header('Location: index.php');
		}
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
	</div>
	<div id='main'>
		<a href='<?php echo 'add.php?dna_type='.$dna_type ;?>'>Add <?php echo ucwords($dna_type); ?></a>
		<div id='view'>
		<?php
		include 'db_con.php';

		# Check to see if this a detail page
		$id = $_GET['id'];
		if (isset($id)) {
			$result = sprintf("SELECT * FROM ".$dna_type."s WHERE id = '%s'",
				mysql_real_escape_string($id));
			$query = mysql_query($result);
			switch ($dna_type) {
				default:
					break;
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
					while ($row = mysql_fetch_array($result))
						{
						echo ("<li><p><a href=?dna_type=".$dna_type."&id=".$row['id'].">".$row['name']."</a></p></li>");
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
