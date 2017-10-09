<!doctype html>
<html lang="en">
<head>
	<title>Library</title>
	<link rel="stylesheet" type="text/css" href="book.css"/>
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
	<meta charset="utf-8"/>
</head>
<body>
    <?php include 'config.php'; ?>
    <?php include 'header.php'; ?>
    
    <h2>This is gallery</h1>
    
    <!-- modified code from http://www.codingcage.com/2015/06/creating-image-gallery-from-folder-php.html -->
    <?php
        $folder_path = 'uploadedfiles/';
        $num_files = glob($folder_path . "*.{JPG,jpg,gif,png,bmp}", GLOB_BRACE);
        $folder = opendir($folder_path);
 
        if($num_files > 0) {
            while(false !== ($file = readdir($folder))) {
            
                $file_path = $folder_path.$file;
                $extension = strtolower(pathinfo($file ,PATHINFO_EXTENSION));

                if($extension=='jpg' || $extension =='png' || $extension == 'gif' || $extension == 'bmp') {
        
                    echo '<img src="', $file_path, '" height="250" id="galleryimg"/>';
                
                }
            }
        }
        else {
         echo "the folder was empty !";
        }
        closedir($folder);
    ?>
    <?php include 'footer.php' ?>
</body>