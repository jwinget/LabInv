<?php include 'head.php'; ?>
</head>
<body>
<div id='container'>
<div id='top'>
<h1>Login</h1>
</div>
<div id='login'>
	<FORM METHOD='POST' ACTION='session.php'>
		<h5>User Name:</h5>
		<INPUT TYPE='text' NAME='username' />
		<br />
		<h5>Password:</h5>
		<INPUT TYPE='password' NAME='password' />
		<INPUT TYPE='submit' VALUE='Login' />
	</FORM>
</div>
<?php include 'foot.php'; ?>
