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
        <h2>My books</h2>
	<?php
	/*/connetct to database/*/
	@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);

	if ($db->connect_error) {
		echo "could not connect: " . $db->connect_error;
		printf("<br><a href=index.php>Return to home page </a>");
		exit();
	}
	
	$query = "select * from `books` where `reserved` = 1";
	$stmt = $db->prepare($query);
    $stmt->bind_result($bookid, $title, $author, $pages, $published, $edition, $reserved);
    $stmt->execute();
	
	/*/table and return/*/
		echo '<table cellpadding="6">';
		echo '<tr><b> <td>Title</td> <td>Author</td> <td>Return</td> </b></tr>';
		while ($stmt->fetch()) {
       
        echo "<tr>";
        echo "<td> $title </td><td> $author </td>";
        echo '<td><a href="returnBook.php?bookid=' . urlencode($bookid) . '">Return</a></td>';
        echo "</tr>";  
    }
    echo "</table>";
    ?>
		
    </main>
    <?php include("footer.php"); ?>
</body>
