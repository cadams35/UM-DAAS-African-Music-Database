<?php
    // Gain access to DB
    require_once "db.php";
    // Initialize session for page
    session_start();
?>
<?php
    require_once "navigation.php";
    //first, get the artist name to be displayed
    $id = mysql_real_escape_string($_GET['id']);
    $result = mysql_query("SELECT id,title FROM artist WHERE id='$id'");
    $row = mysql_fetch_row($result)
?>

<html>
    <body>
        <h2>African Music Database</h2>
      	<h3> <?php echo(htmlentities($row[1])); ?></h3>
    </body>
<?php
    // Show messages, if any
    if ( isset($_SESSION['sesMessage'] ) ) 
    {
        // Informative message, e.g. Record Added, etc.
        echo '<p style="color:green">' . $_SESSION['sesMessage'] . "</p>\n";
        // Once message has been displayed once clear session
        unset($_SESSION['sesMessage']);
    }
    if ( isset($_SESSION['sesError'] ) ) 
    {
        // Error message, e.g. Value must be integer, etc.
        echo '<p style="color:red">' . $_SESSION['sesError'] . "</p>\n";
        // Once message has been displayed once clear session
        unset($_SESSION['sesError']);
    } 
?>
<?php
    //now get the tape information to be displayed
    $id = mysql_real_escape_string($_GET['id']);
    $result = mysql_query("SELECT id,title FROM tape WHERE primary_artist_id='$id'");
    // Iterate for each row retrieved from database
    while ( $row = mysql_fetch_row($result) ) 
    {
        // Display one record per HTML row, [0] is id
?>
           <p> <a href="tape.php?id=<?php echo(htmlentities($row[0])); ?>"><?php echo(htmlentities($row[1])); ?> </a> </p>
               
<?php
    }
?>
