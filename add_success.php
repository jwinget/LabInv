<?php
	session_start();
		if (!isset ($_SESSION['valid_user'])){
			header('Location: login.php');
			}
		else {
		include 'head.php';
		
		error_reporting(E_ERROR | E_WARNING | E_PARSE);
		$dna_type = $_GET['dna_type'];
?>
</head>
<body>
<div id='container'>
		<h1><?php echo ucwords($dna_type); ?> Added Successfully</h1>
		<a href='browse.php?dna_type=<?php echo $dna_type; ?>'>Return to <?php echo $dna_type; ?> list</a>
</div>
<?php
};
include 'foot.php' ?>
