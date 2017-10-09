<header>
        <div id="title">
            <h1>Title here</h1>
            <h3>- for readers, by readers.</h3>
        </div>
        <img id="headerimg" src="pics/header.png" alt="header image"/>
        <nav id="menu">
            <ul>
                <li><a class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'active' : NULL ?>"  
				href="index.php">Home</a></li>
                <li><a class="<?php echo ($current_page == 'browse.php') ? 'active' : NULL ?>"  
				href="browse.php">Browse Books</a></li>
                <li><a class="<?php echo $current_page == 'books.php' ? 'active' : NULL ?>" 
				href="books.php">My Books</a></li>
                <li><a class="<?php echo $current_page == 'gallery.php' ? 'active' : NULL ?>" 
				href="gallery.php">Gallery</a></li>
                <li><a class="<?php echo $current_page == 'about.php' ? 'active' : NULL ?>" 
				href="about.php">About</a></li>
                <li><a class="<?php echo $current_page == 'contact.php' ? 'active' : NULL ?>" 
				href="contact.php">Contact</a></li>
                <li><a class="<?php echo $current_page == 'login.php' ? 'active' : NULL ?>" 
				href="login.php">Log In</a></li>
            </ul>
        </nav>
    </header>