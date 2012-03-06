<?php
    // Gain access to DB
    require_once "db.php";
    // Initialize session for page
    session_start();
    
    require_once "navigation.php";
?>
<html>
    <body>
        <h2>African Music Database</h2>
      	<p>Add a new record:</p>

    <div id="admin">
      	<ul>
      	    <li><a href="addtape.php">Add a new tape</a></li>
      	    <li><a href="addsong.php">Add a new song</a></li>
     	</ul>
      	</div>    
    </body>