<!doctype html>
<html lang="en">
<head>
	<title>Library</title>
	<link rel="stylesheet" type="text/css" href="book.css"/>
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	<meta charset="utf-8"/>
</head>
<body>
	<?php include("config.php"); ?>
    <?php include("header.php"); ?>
    <main>
        <h2>Contact us</h2>
		<form>
			<h3>Message</h3>
			<input id="messagefield" type="text" name="message"><br>
			<h3>Name</h3>
			<input type="text" name="name"><br>
			<h3>Email</h3>
			<input type="email" name="email"><br>
			<input id="sendbutton" type="submit" value="Send">
		</form>
    </main>
    <?php include("footer.php"); ?>
</body>
