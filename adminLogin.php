<?php
session_start();

// Check if a session exists, then destroy it
if (isset($_SESSION['adminID']) ) {
    session_destroy();
}?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Bio</title>
<script src="http://www.w3schools.com/lib/w3data.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>

<div class="login-page">
	<div class="login-container">
		<div class="login-header">
			Login To Admin Page
		</div>
		<form id="loginForm" action="homePage-process.php?c=login" method="post" enctype="multipart/form-data">
		<table class="login-info">
			<tr>
				<td style="width: 10%;">
					<span class="material-symbols-outlined">person</span>
				</td>
				<td style="width: 30%;">
			<div class="login-font">
				Username
			</div>
		</td>
		<td style="width: 60%;">
			<input type="text" name="name" required>
		</td>
	</tr>
		<tr>
			<td>
					<span class="material-symbols-outlined">lock</span>
				</td>
			<td>
			<div class="login-font">
				Password
			</div>
		</td>
		<td>
			<input type="password" name="password" required>
		</td>
	</tr>
		</table>
		<button type="submit" class="login-button">Login</button>
	</form>
	</div>
</div>

</body>
</html>