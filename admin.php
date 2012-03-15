<?php
    // Gain access to DB
    require_once "db.php";
    // Initialize session for page
    session_start();
?>
<?php
    require_once "navigation.php";
?>
<html>
    <body>
        <h2>African Music Database</h2>
      	<p>What would you like to do?</p>
      	<div id="admin">
      	<ul>
      	    <li><a href="view.php">View materials and metadata</a></li>
      	    <li><a href="add.php">Add new materials</a></li>
      	    <li><a href="edit.php">Edit existing materials</a></li>
      	</ul>
      	</div>
      	<p>Manage metadata fields</p>
      	<a href="/metadata.php">Filler</a>
    </body>
</html>