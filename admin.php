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
      	<ul>
          <li><a href="manage_artists.php">Artists</a></li>
          <li><a href="manage_rate.php">Sampe Rate</a></li>
          <li><a href="manage_depth.php">Bit Depth</a></li>
          <li><a href="manage_store-artwork.php">Store/Artwork</a></li>
          <li><a href="manage_analog.php">Analog</a></li>
          <li><a href="manage_drawer.php">Drawer</a></li>
        </ul>
    </body>
</html>