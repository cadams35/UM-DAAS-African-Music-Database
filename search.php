<?php
    // Gain access to DB
    require_once "db.php";
    // Initialize session for page
    session_start();
    
    require_once "navigation.php";

    // Need to check whether the user came to this page because of clicking the
    // link from the index page or because of the form submission in this page.
    if ( isset($_POST['search_term']) OR 
         isset($_POST['table']) )
    {
        // Came to this page because of the form submission.

        // Safeguard entered values 
        $search_term = trim(mysql_real_escape_string($_POST['search_term']));
        $table = trim(mysql_real_escape_string($_POST['table']));
       
        
        // Various checks of entered values
        if ( empty($search_term) )
            $_SESSION['sesError'] = "Must enter a search term";
        elseif ( empty($table) )
            $_SESSION['sesError'] = "Must select a field to search";
       
          
        else 
        {
            if ($table == "artist") {
            // If "search groups" has been selected, search artist table
            $result = mysql_query("SELECT id,title FROM artist WHERE title LIKE '%$search_term%'");
            }
            if ($table == "tape") {
            // EIf "search tapes" has been selected, search tape table
            $result = mysql_query("SELECT id,title FROM tape WHERE title LIKE '%$search_term%'");
            }
            if ($table == "track") {
            // If "search songs" has been selected, search track table
            $result = mysql_query("SELECT id,title FROM track WHERE title LIKE '%$search_term%'");
            }
            
        }
       
    }
?>
<html>
    <body>
        <h2>African Music Database</h2>
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

        <h3> Search the database: </h3>
        <form method="post">
            <table border="0">
            	<tr>
                    <td align="right">Keyword</td>
                    <td>:</td>
                    <td><input type="text" name="search_term"></td>
                </tr>
                <tr>
                    <td align="right"></td>
                    <td></td>
                    <td><input type="radio" name="table" value="artist">Search Groups</td>
                </tr>
                <tr>
                    <td align="right"></td>
                    <td></td>
                    <td><input type="radio" name="table" value="tape">Search Tapes</td>
                </tr>
                <tr>
                    <td align="right"></td>
                    <td></td>
                    <td><input type="radio" name="table" value="track">Search Songs</td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <input type="submit" value="Search"/>
                        &nbsp;&nbsp;
                        <a href="index.php">Cancel</a>
                    </td>
                </tr>
            </table>
        </form>
    <?php
    //now get the track information to be displayed
    if (isset($result)) {
    echo("<h3>Search Results:</h3>");
    // Iterate for each row retrieved from database
    while ( $row = mysql_fetch_row($result) ) 
    {
        // Display results with links
        if ($table == "artist") {
        ?>

           <p> <a href="artist.php?id=<?php echo(htmlentities($row[0])); ?>"><?php echo(htmlentities($row[1])); ?>  </p>
        <?php
        } 
        
        if ($table == "tape") {
        ?>

           <p> <a href="tape.php?id=<?php echo(htmlentities($row[0])); ?>"><?php echo(htmlentities($row[1])); ?>  </p>
        <?php
        }
        
        if ($table == "track") {
        ?>
           <p> <a href="song.php?id=<?php echo(htmlentities($row[0])); ?>"><?php echo(htmlentities($row[1])); ?>  </p>
        <?php
        }
        
        
        

    }
    }
?>
   
    </body>
</html>

