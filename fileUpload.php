<!doctype html>
<html lang="en">
<head>
	<title>Library</title>
	<link rel="stylesheet" type="text/css" href="book.css"/>
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	<meta charset="utf-8"/>
</head>
<body>
    <?php
        if (isset($_FILES['upload'])){
            $allowedextensions = array('jpg', 'jpeg', 'gif', 'png');
            $extension = strtolower(substr($_FILES['upload']['name'], strrpos($_FILES['upload']['name'], '.') + 1));
            $error = array ();
            
            if(in_array($extension, $allowedextensions) === false){
                $error[] = 'This is not an image, upload is allowed only for images.';        
            }
        
            if($_FILES['upload']['size'] > 1000000){ 
                $error[]='The file exceeded the upload limit';
            }
        
            if(empty($error)){
                move_uploaded_file($_FILES['upload']['tmp_name'], "uploadedfiles/{$_FILES['upload']['name']}");     
            }    
        }
    ?>
    
    <?php include 'config.php'; ?>
    <?php include 'header.php'; ?>
    
    <h2>Select images</h1>
    
    <?php 
        if (isset($error)){
            if (empty($error)){
                echo '<a href="uploadedfiles/' . $_FILES['upload']['name'] . '">Check file</a>
				<br> <a href="gallery.php">Go to Gallery</a>';
            }
            else {
                foreach ($error as $err){
                    echo $err;
                }               
            }
        }              
    ?>
    
    <form action="fileUpload.php" method="POST" enctype="multipart/form-data">
        <input id="fileinput" type="file" name="upload">
        <input id="searchbutton" type="submit" value="Upload">
    </form>
    
    <?php include 'footer.php'; ?>
</body>