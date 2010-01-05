<?php
	session_start();
	if (!isset ($_SESSION['valid_user'])) {
		header('Location: login.php');
		}
	else {
	include 'head.php' ?>
</head>
<body>
<?php include 'db_con.php'; ?>
<div id='top'>
	<h1>DNA Inventory</h1>
</div>

<div id='latest_oligos'>
	<h3>Latest Oligos</h3>
	<span class='add'>
		<a href='oligos.php'>Complete listing</a>
	</span>
	<?php
		$result = mysql_query(
			'SELECT * FROM oligos');
		if (!$result) {
			echo ('<p>Error retrieving oligos: ' .
				mysql_error() . '</p>');
			exit();
		}

		while ($row = mysql_fetch_array($result) ) {
			echo('<p><a href=oligos.php?oligo_id='. $row['id'] . '>' . $row['name'] . '</a></p>');
		}
	?>
</div>

<div id='latest_constructs'>
	<h3>Latest DNA Constructs</h3>
	<span class='add'>
		<a href='constructs.php'>Complete Listing</a>
	</span>
</div>
<?php
};
include 'foot.php'
?>
