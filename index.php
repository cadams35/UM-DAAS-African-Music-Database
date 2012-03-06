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
      	<p>View all tape content.</p>
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
        <table border="1">
            <tr>
                <th>Title</th>
                <th>Primary Artist</th>
                <th>Secondary Artist</th>
                <th>Other Artist</th>
                <th>Analog Format</th>
                <th>Date Digitized</th>
                <th>CD Backup</th>
                <th>Cover Front</th>
                <th>Cover Back</th>
                <th>File Notes</th>
                <th>Rate</th>
                <th>Depth</th>
                <th>Format</th>
                <th>Side A</th>
                <th>Side B</th>
                <th>Notes</th>
                <th>BWF Metadata</th>
                <th>Notebook ID</th>
                <th>Year</th>
                <th>Artwork</th>
                <th>Nyrere Song</th>
            </tr>
<?php
    // Create sql command FOR TABLE TAPE
    $sql = "SELECT id, title, primary_artist_id, secondary_artist_id, other_artist_id, analog_id, date_digitized, cd_backup, cover_file, cover_file_2, file_notes, rate, depth, format_id, side_a_file, side_b_file, note_file, bwf_metadata, notebook_id, year, artwork, nyrere_song FROM tape";
    // Retrieve all records
    $result = mysql_query($sql);
    
    // Iterate for each row retrieved from database
    while ( $row = mysql_fetch_row($result) ) 
    {
        // Display one record per HTML row, [0] is id
?>
            <tr>
                <td><?php echo(htmlentities($row[1])); ?></td>                
                <td align="center"><?php echo(htmlentities($row[2])); ?></td> 
                <td align="center"><?php echo(htmlentities($row[3])); ?></td> 
                <td align="center"><?php echo(htmlentities($row[4])); ?></td> 
                <td align="center"><?php echo(htmlentities($row[5])); ?></td>
                <td align="center"><?php echo(htmlentities($row[6])); ?></td>
                <td align="center"><?php echo(htmlentities($row[7])); ?></td>
                <td align="center"><?php echo(htmlentities($row[8])); ?></td>
                <td align="center"><?php echo(htmlentities($row[9])); ?></td>
                <td align="center"><?php echo(htmlentities($row[10])); ?></td>
                <td align="center"><?php echo(htmlentities($row[11])); ?></td>
                <td align="center"><?php echo(htmlentities($row[12])); ?></td>
                <td align="center"><?php echo(htmlentities($row[13])); ?></td>
                <td align="center"><?php echo(htmlentities($row[14])); ?></td>
                <td align="center"><?php echo(htmlentities($row[15])); ?></td>
                <td align="center"><?php echo(htmlentities($row[16])); ?></td>
                <td align="center"><?php echo(htmlentities($row[17])); ?></td>
                <td align="center"><?php echo(htmlentities($row[18])); ?></td>
                <td align="center"><?php echo(htmlentities($row[19])); ?></td>
                <td align="center"><?php echo(htmlentities($row[20])); ?></td>
                <td align="center"><?php echo(htmlentities($row[21])); ?></td>
                <td>
                    <!-- Edit/Delete page need to know which data to delete so need to send the id to these page (column 1 in SQL)  -->
                    <a href="delete.php?id=<?php echo(htmlentities($row[0])); ?>">Delete</a> / 
                    <a href="edit.php?id=<?php echo(htmlentities($row[0])); ?>">Edit</a>
                </td>
            </tr>
<?php
    }
?>
        </table>
        <a href="add.php">Add new</a>
    </body>
</html>

