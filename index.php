<?php
	session_start();
	if (!isset ($_SESSION['valid_user'])) {
		header('Location: login.php');
		}
	else {
	include 'head.php' ?>
</head>
<body>
<div id='container'>
<?php include 'db_con.php'; ?>
<div id='top'>
	<h1>DNA Inventory</h1>
</div>
<div id='nav'>
<ul id='crumbs'>
	<li><p>Home</p></li>
</ul>
</div>
<div id='main'>
<div id='latest_oligos'>
	<h3>Latest Oligos</h3>
	<span class='add'>
		<a href='oligos.php'>Complete listing</a>
	</span>
	<ul id='oligo_list'>
	<?php
		$result = mysql_query(
			'SELECT * FROM oligos ORDER BY id DESC LIMIT 10');
		if (!$result) {
			echo ('<p>Error retrieving oligos: ' .
				mysql_error() . '</p>');
			exit();
		}

		while ($row = mysql_fetch_array($result) ) {
			echo('<li><p><a href=oligos.php?oligo_id='. $row['id'] . '>' . $row['name'] . '</a> - '.$row['notes'].'</p></li>');
		}
	?>
	</ul>
</div>

<div id='latest_constructs'>
	<h3>Latest DNA Constructs</h3>
	<span class='add'>
		<a href='constructs.php'>Complete Listing</a>
	</span>
	<ul id='oligo_list'>
	<?php
		$result = mysql_query(
			'SELECT * FROM constructs ORDER BY id DESC LIMIT 10');
		if (!$result) {
			echo ('<p>Error retrieving constructs: ' .
				mysql_error() . '</p>');
			exit();
		}

		while ($row = mysql_fetch_array($result) ) {
			echo('<li><p><a href=constructs.php?construct_id='.$row['id'].'>'.$row['name'].'</a> - '.$row['notes'].'</p></li>');
		}
	?>
	</ul>

</div>
</div>
<?php
};
include 'foot.php'
?>
