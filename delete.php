<?php
    // Gain access to DB
    require_once "db.php";
    // Initialize session for page
    session_start();
    
    require_once "navigation.php";

    // Check if id was sent to the page, we need it to know what to delete
    if (isset($_GET['id']) === FALSE) 
    {
        // No id wsa sent
        
        // Set error message
        $_SESSION['sesError'] = "Unknown identifier";
        // Redirect to index page
        header( 'Location: index.php' );
        // Suspend further execution of this page and wait for redirect
        return;
    }
    
    // Need to check whether the user came to this page because of clicking the
    // link from the index page or because of the form submission in this page.
    if ( isset($_POST['hdnID']) ) 
    {
        // Came to this page because of the form submission.
        
        // Safeguard entered values 
        $id = mysql_real_escape_string($_POST['hdnID']);
         
        // Everything is ok so delete record FROM TABLE TAPE
        $sql = "DELETE FROM tape WHERE id = $id";
        mysql_query($sql);
        
        // Set message to display back in index page
        $_SESSION['sesMessage'] = 'Record deleted';
        
        // Redirect to index page
        header( 'Location: index.php' );
        // Suspend further execution of this page
        return;
    }
    
    // Came to this page because of clicking the link from the index page

    // Get id of the track to delete
    $id = $_GET['id'];
        
    // Get data of tracks to display in the page FROM TABLE TABLE TAPE
    $sql = "SELECT id, title, primary_artist_id, secondary_artist_id, other_artist_id, analog_id, date_digitized, cd_backup, cover_file, cover_file_2, file_notes, rate, depth, format_id, side_a_file, side_b_file, note_file, bwf_metadata, notebook_id, year, artwork, nyrere_song FROM tape WHERE id=$id";
    $result = mysql_query($sql);

    // Make sure the SQL was a success and there is such a row with that id
    if ($result === false) {
        // No such row
        $_SESSION['sesError'] = "Unknown identifier";
        // Redirect to index page
        header( 'Location: index.php' );
        // Suspend further execution of this page and wait for redirect
        return;
    }

    // Because id is a primary key, SQL will return max 1 row
    $row = mysql_fetch_row($result);

    // Safeguard retrieved values
    $id = htmlentities($row[0]);
    $title = htmlentities($row[1]);
    $priartist = htmlentities($row[2]);
    $secartist = htmlentities($row[3]);
    $othartist = htmlentities($row[4]);
    $analog = htmlentities($row[5]);
    $datedig = htmlentities($row[6]);
    $cdbackup = htmlentities($row[7]);
    $covfilea = htmlentities($row[8]);
    $covfileb = htmlentities($row[9]);
    $notes = htmlentities($row[10]);
    $rate = htmlentities($row[11]);
    $depth = htmlentities($row[12]);
    $format = htmlentities($row[13]);
    $sideafile = htmlentities($row[14]);
    $sidebfile = htmlentities($row[15]);
    $notefile = htmlentities($row[16]);
    $bwfmeta = htmlentities($row[17]);
    $notebook = htmlentities($row[18]);
    $year = htmlentities($row[19]);
    $artwork = htmlentities($row[20]);
    $nyrere = htmlentities($row[21]);
?>
<html>
    <body>
        <h2>African Music Database</h2>
      	<p>View all tape content.</p>
    </body>
        <form method="post">
            <table border="0">
                <tr>
                    <td align="right">Title</td>
                    <td>:</td>
                    <td><?php echo $title; ?></td>
                </tr>
                <tr>
                    <td align="right">Primary Artist</td>
                    <td>:</td>
                    <td><?php echo $priartist; ?></td>
                </tr>
                <tr>
                    <td align="right">Secondary Artist</td>
                    <td>:</td>
                    <td><?php echo $secartist; ?></td>
                </tr>
                <tr>
                    <td align="right">Other Artist</td>
                    <td>:</td>
                    <td><?php echo $othartist; ?></td>
                </tr>
                <tr>
                    <td align="right">Analog Format</td>
                    <td>:</td>
                    <td><?php echo $analog; ?></td>
                </tr>
                <tr>
                    <td align="right">Date Digitized</td>
                    <td>:</td>
                    <td><?php echo $datedig; ?></td>
                </tr>
                <tr>
                    <td align="right">CD Backup</td>
                    <td>:</td>
                    <td><?php echo $cdbackup; ?></td>
                </tr>
                <tr>
                    <td align="right">Cover Front</td>
                    <td>:</td>
                    <td><?php echo $covefilea; ?></td>
                </tr>
                <tr>
                    <td align="right">Cover Back</td>
                    <td>:</td>
                    <td><?php echo $covefileb; ?></td>
                </tr>
                <tr>
                    <td align="right">File Notes</td>
                    <td>:</td>
                    <td><?php echo $notes; ?></td>
                </tr>
                <tr>
                    <td align="right">Rate</td>
                    <td>:</td>
                    <td><?php echo $rate; ?></td>
                </tr>
                <tr>
                    <td align="right">Depth</td>
                    <td>:</td>
                    <td><?php echo $depth; ?></td>
                </tr>
                <tr>
                    <td align="right">Format</td>
                    <td>:</td>
                    <td><?php echo $format; ?></td>
                </tr>
                <tr>
                    <td align="right">Side A</td>
                    <td>:</td>
                    <td><?php echo $sideafile; ?></td>
                </tr>
                <tr>
                    <td align="right">Side B</td>
                    <td>:</td>
                    <td><?php echo $sidebfile; ?></td>
                </tr>
                <tr>
                    <td align="right">Notes</td>
                    <td>:</td>
                    <td><?php echo $notefile; ?></td>
                </tr>
                <tr>
                    <td align="right">BWF Metadata</td>
                    <td>:</td>
                    <td><?php echo $bwfmeta; ?></td>
                </tr>
                <tr>
                    <td align="right">Notebook ID</td>
                    <td>:</td>
                    <td><?php echo $notebook; ?></td>
                </tr>
                <tr>
                    <td align="right">Year</td>
                    <td>:</td>
                    <td><?php echo $year; ?></td>
                </tr>
                <tr>
                    <td align="right">Artwork</td>
                    <td>:</td>
                    <td><?php echo $artwork; ?></td>
                </tr>
                <tr>
                    <td align="right">Nyrere Song</td>
                    <td>:</td>
                    <td><?php echo $nyrere; ?></td>
                </tr>
                    <td colspan="3" align="center">
                        <input type="hidden" 
                               name="hdnID" 
                               value="<?php echo $id; ?>"/>
                        <input type="submit" 
                               value="Delete" 
                               name="btnDelete"/>
                        &nbsp;&nbsp;
                        <a href="index.php">Cancel</a>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>

