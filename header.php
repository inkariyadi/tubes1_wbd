<?php

    if(isset($_COOKIE["super"]) && $_COOKIE["super"]){
        echo '<header>
    <!-- <a href="#">LOGO</a> -->
    <nav>
        <ul class="nav-links">
            <li><a href="home.php" class="cool-link">Home</a></li>
            <li><a href="addnew.php" class="cool-link">Add New Chocolate</a></li>

            
        </ul>
        <form action="search.php">
            <input type="text" placeholder="Search" name="search" id="search">
            <!-- <button id="search-button" type="submit">Search</button> -->
        </form>
        <ul class="nav-links">
            <li><a href="signout.php" class="cool-link">Logout</a></li>
        </ul>
        
    </nav>
    </header>';
    }else{
        echo '<header>
    <!-- <a href="#">LOGO</a> -->
    <nav>
        <ul class="nav-links">
            <li><a href="home.php" class="cool-link">Home</a></li>
            <li><a href="history.php" class="cool-link">History</a></li>

        </ul>
        
        <form action="search.php">
            <input type="text" placeholder="Search" name="search" id="search">
            <!-- <button id="search-button" type="submit">Search</button> -->
        </form>
        <ul class="nav-links">
            <li><a href="signout.php" class="cool-link">Logout</a></li>
        </ul>
        
    </nav>
    </header>';
    }
    
?>