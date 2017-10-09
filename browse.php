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
        <h2>Browse books</h2>
            <form id="searchform" action="browse.php" method="POST">
				<table>
                    <tbody>
                        <tr>
                            <td>Title</td>
                            <td><input type="text" name="searchtitle"></td>
                        </tr>
						<tr>
                            <td>Author</td>
                            <td><input type="text" name="searchauthor"></td>
                        </tr>
                        <tr>
                            <td><input id="searchbutton" type="submit" name="submit" value="Search"></td>
                        </tr>
                    </tbody>
                </table>
            </form>
        <h3>Book List</h3>

    </main>
	<?php
		# Open the database
		@ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
		
		if ($db->connect_error) {
			echo "could not connect: " . $db->connect_error;
			printf("<br><a href=index.php>Return to home page </a>");
			exit();
		}
		
		$searchtitle = "";
		$searchauthor = "";
		
		if (isset($_POST) && !empty($_POST)) {
		# Get data from form
			$searchtitle = trim($_POST['searchtitle']);
			$searchauthor = trim($_POST['searchauthor']);
		}
		
		//	if (!$searchtitle && !$searchauthor) {
		//	  echo "You must specify either a title or an author";
		//	  exit();
		//	}
		
		$searchtitle = addslashes($searchtitle);
		$searchauthor = addslashes($searchauthor);
		
		$searchtitle= htmlentities($searchtitle);
		$searchauthor= htmlentities($searchauthor);
		
		$searchtitle = mysqli_real_escape_string($db, $searchtitle);
		$searchauthor = mysqli_real_escape_string($db, $searchauthor);
		
		
		# Build the query. Users are allowed to search on title, author, or both
		
		$query = "select * from `books` where `reserved` = 0";
		if ($searchtitle && !$searchauthor) { // Title search only
			$query = $query . " and title like '%" . $searchtitle . "%'";
		}
		if (!$searchtitle && $searchauthor) { // Author search only
			$query = $query . " and author like '%" . $searchauthor . "%'";
		}
		if ($searchtitle && $searchauthor) { // Title and Author search
			$query = $query . " and title like '%" . $searchtitle . "%' and author like '%" . $searchauthor . "%'"; // unfinished
		}
		
		//echo "Running the query: $query <br/>"; # For debugging
		
		
		  # Here's the query using an associative array for the results
		//$result = $db->query($query);
		//echo "<p> $result->num_rows matching books found </p>";
		//echo "<table border=1>";
		//while($row = $result->fetch_assoc()) {
		//echo "<tr><td>" . $row['bookid'] . "</td> <td>" . $row['title'] . "</td><td>" . $row['author'] . "</td></tr>";
		//}
		//echo "</table>";
		 
		
		# Here's the query using bound result parameters
			// echo "we are now using bound result parameters <br/>";
		$stmt = $db->prepare($query);
		$stmt->bind_result($bookid, $title, $author, $pages, $published, $edition, $reserved);
		$stmt->execute();
			
		//    $stmt2 = $db->prepare("update onloan set 0 where bookid like ". $bookid);
		//    $stmt2->bind_result($reserved, $bookid);
			
	
		echo '<table cellpadding="6">';
		echo '<tr><b> <td>Title</td> <td>Author</td> <td>Reserved</td> <td>Reserve</td></b></tr>';
		while ($stmt->fetch()) {
			if($reserved==1)
				$reserved="Yes";
			else {
				$reserved="No";
			}
		   
			echo "<tr>";
			echo "<td> $title </td><td> $author </td><td> $reserved </td>";
			echo '<td><a href="reserveBook.php?bookid=' . urlencode($bookid) . '">Reserve</a></td>';
			echo "</tr>";
			
		}
		echo "</table>";
    ?>
    <?php include("footer.php"); ?>
</body>
