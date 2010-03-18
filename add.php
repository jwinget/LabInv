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
					break;
				case 'construct':
					break;
				default:
					header('Location: 404.php');
					break;
					}
		?>
		<h1>New <?php echo ucwords($dna_type); ?> Entry</h1>
	</div>
	<div id='nav'>
		<ul id='crumbs'>
			<li><a href='index.php'>Home</a></li>
			<li><a href='browse.php?dna_type=<?php echo $dna_type; ?>'><?php echo ucwords($dna_type); ?> Database</a></li>
			<li><p>Add <?php echo ucwords($dna_type); ?></p</li>
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
	?>
	<FORM <?php echo $form_enctype; ?> ACTION='db_add.php?dna_type=<?php echo $dna_type; ?>' METHOD=POST>
	<ul id='addform'>
		<li><h4>Name:</h4><INPUT TYPE=TEXT NAME='dna_name' /></li>
		<li><h4>Sequence:</h4><TEXTAREA ROWS='10' COLS='40' NAME='dna_sequence'></textarea></li>
		<?php
		switch ($dna_type) {
			case 'construct':
				echo '<li><h4>Parent Vector:</h4><INPUT TYPE="TEXT" NAME="parent_vector" /></li>';
				echo '<li><h4>Map:</h4>';
				echo '<a class="inline" href="http://wishart.biology.ualberta.ca/PlasMapper/" target="_blank">Generate map</a><p class="inline">, save to your computer, and upload below</p><br />';
				echo '<INPUT TYPE=HIDDEN NAME="max_map_size" VALUE="300000" />';
				echo '<INPUT TYPE=FILE NAME="dna_map" /></li>';
				echo '<li><h4>Drug Resistance:</h4><INPUT TYPE=TEXT NAME="dna_resist" /></li>';
				echo '<li><h4>Strain:</h4><INPUT TYPE=TEXT NAME="strain" /></li>';
				break;
			case 'oligo':
				echo '<li><h4>Supplier:</h4><INPUT TYPE=TEXT NAME="supplier" /></li>';
				echo '<li><h4>Concentration, in mM</h4><INPUT TYPE=TEXT WIDTH="4" NAME="concentration"/></li>';
				break;
			default:
				break;
		}
		?>
		<li><h4>Entered by:</h4><INPUT TYPE=TEXT NAME="originator" /></li>
		<li><h4>Note and Usage:</h4><TEXTAREA ROWS="5" COLS="40" NAME="notes"></textarea></li>
		<li><INPUT TYPE=SUBMIT NAME="submit_dna" ID="submit_dna" VALUE="SUBMIT" /></li>
	</ul>
	</FORM>
</div>
<?php
};
include 'foot.php'; ?>
