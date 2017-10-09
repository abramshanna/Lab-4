<?php
    @ $db = new mysqli('localhost', 'root', '', 'library');
    
    if ($db->connect_error) {
        echo "could not connect: " . $db->connect_error;
        printf("<br><a href=index.php>Return to home page </a>");
        exit();
    }
    
        #the mysqli_real_espace_string function helps us solve the SQL Injection
        #it adds forward-slashes in front of chars that we can't store in the username/pass
        #in order to excecute a SQL Injection you need to use a ' (apostrophe)
        #Basically we want to output something like \' in front, so it is ignored by code and processed as text
    
    if (isset($_POST['username'], $_POST['password'])) {
        #with statement under we're making it SQL Injection-proof
        $uname = mysqli_real_escape_string($db, $_POST['username']);
        $uname= htmlentities($uname);
        
        #without function, so here you can try to implement the SQL injection
        #various types to do it, either add ' -- to the end of a username, which will comment out
        #or simply use 
        #' OR '1'='1' #
        #$uname = $_POST['username'];
        
        #here we hash the password, and we want to have it hashed in the database as well
        #optimally when you create a user (through code) you simply send a hash
        #hasing can be done using different methods, MD5, SHA1 etc.
        
        $upass = sha1($_POST['password']);
        
        #just to see what we are selecting, and we can use it to test in phpmyadmin/heidisql
        
        echo "SELECT * FROM users WHERE username = '{$uname}' AND password = '{$upass}'";
        
        $query = ("SELECT * FROM users WHERE username = '{$uname}' "."AND password = '{$upass}'");
           
        
        $stmt = $db->prepare($query);
        $stmt->execute();
        $stmt->store_result(); 
        
        #here we create a new variable 'totalcount' just to check if there's at least
        #one user with the right combination. If there is, we later on print out "access granted"
        $totalcount = $stmt->num_rows();   
    }
?>

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
        <h2>Log in</h2>
        
        <?php
            if (isset($totalcount)) {
                if ($totalcount == 0) {
                    echo 'You got it wrong. Try again!';
                } else {
                    echo 'Welcome! You have successfully logged in.
                    <br>
                    <a href="fileUpload.php">Click here to upload files!</a>';
                }
            }
        ?>
        
		<form method="POST" action="login.php">
			<h3>Username</h3>
			<input type="text" name="username">
            <h3>Password</h3>
            <input type="password" name="password">
            <br>
			<input id="sendbutton" type="submit" value="Log In">
		</form>
        
    </main>
    <?php include("footer.php"); ?>
</body>