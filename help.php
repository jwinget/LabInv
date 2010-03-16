<?php
	session_start();
	if(!isset ($_SESSION['valid_user'])){
		header('Location: login.php');
		}
	else {
		include 'head.php';
?>
</head>
<div id='container'>
<div id='top'>
	<h1>Help Using the Lab Database</h1>
</div>
<div id='nav'>
<ul id='crumbs'>
	<li><a href='index.php'>Home</a></li>
	<li><p>Help</p></li>
</ul>
</div>
<div id='main'>
<h3>Table of Contents</h3>
<ul id='help_toc'>
	<li><a href='#navigating'>Browsing the database</a></li>
	<li><a href='#adding'>Adding to the database</a></li>
	<li><a href='#deleting'>Deleting from the database</a></li>
	<li><a href='#maps'>Generating a plasmid map</a></li>
</ul>
<h2 id='navigating'>Browsing the Database</h2>
<p class='inline'>The database is split into two main sections: </p><a class='inline' href='oligos.php'>oligos</a><p class='inline'> and </p><a class='inline' href='constructs.php'>constructs</a><p class='inline'>. Both can be accessed from the </p><a class='inline' href='index.php'>home</a><p class='inline'> page.</p>
<p>If you click the complete listing for either, you will see a table with all entries in the given database (OTM or BPM). You can also click the name of any entry to see its detail page.</p>
<p>FASTA-formatted sequences can also be produced either for the full database or for an individual entry. The links can be found on the complete listings and detail pages, respectively. These files may be helpful for use in programs like BLAST.</p>
<br />

<h2 id='adding'>Adding to the Database</h2>
<p class='inline'>To add a new </p><a class='inline' href='oligos.php'>oligo</a><p class='inline'> or </p><a class='inline' href='constructs.php'>plasmid</a><p class='inline'>, click the button that says "Add a new..." at the top of either the listings page or a detail page.</p>
<p>The entry form should slide down into view. To close the form, simply click the button again.</p>
<p>Enter the requested information into the form fields. Most of the items should be pretty self-explanatory. Please try to fill in as much as you possibly can. Some of the form fields are required, and you won't be able to add your DNA until these are filled in.</p>
<p>Make sure that you are starting from the next number in the OTM or BPM, simply by checking the full listings.</p>
<p class='inline'>Also note that for oligos, the </p><h5 class='inline'>concentration should be only a number</h5><p class='inline'>, in mM.</p><br />
<p class='inline'>Once you've entered all the information into the form, </p><h5 class='inline'>double-check it!</h5><p class='inline'> There is no easy way to alter something once you've entered it (you have to delete it and start over), so make sure everything is right.</p>
<p>Once you are satisfied that everything is correct, press the submit button. You should see a page that says your entry was successfully added. You can verify this by checking the full listings page.</p>
<br />

<h2 id='deleting'>Deleting from the Database</h2>
<p>There is no way to alter an entry once it has been entered into the database. If you notice an error, the only option is to delete the original entry and re-enter it following the procedure described above.</p>
<p>To delete an entry, first go to its detail page. On the bottom left will be a delete link. Clicking this will take you to a confirmation page.</p>
<h5 class='inline'>Note that deleting CANNOT BE UNDONE</h5><p class='inline'>. Never delete an entry that isn't yours without very good reason</p>
<p>If you are sure you want to delete this entry, press the delete button. You should see a screen saying that the entry has been successfully deleted.</p>
<br />

<h2 id='maps'>Generating a plasmid map</h2>
<p>To generate a plasmid map for adding your entry to the BPM, you will need your complete sequence (obtained from virtual cloning software such as SerialCloner).</p>
<p class='inline'>Go to </p><a href='http://wishart.biology.ualberta.ca/PlasMapper/'>PlasMapper</a>
<p>Paste your sequence into the text window and then press the "Graphic Map" button. Save this file to your hard drive.</p>
<p>You can then upload this file directly to the BPM</p>
</div>
<?php
};
include 'foot.php' ?>
