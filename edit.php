<?php
    // Gain access to DB
    require_once "db.php";
    // Initialize session for page
    session_start();
    
    require_once "navigation.php";
    
    // Check if id was sent to the page, we need it to know what to edit
    if (isset($_GET['id']) === FALSE) {
        // No id was sent
        
        // Set error message
        $_SESSION['sesError'] = "Unknown identifier";
        // Redirect to index page
        header( 'Location: index.php' );
        // Suspend further execution of this page and wait for redirect
        return;
    }
        
    // Need to check whether the user came to this page because of clicking the
    // link from the index page or because of the form submission in this page.
    if ( isset($_POST['title']) && 
         isset($_POST['primary_artist_id']) && 
         isset($_POST['secondary_artist_id']) && 
         isset($_POST['other_artist_id']) &&
         isset($_POST['analog_id']) && 
         isset($_POST['date_digitized']) && 
         isset($_POST['cd_backup']) && 
         isset($_POST['cover_file']) && 
         isset($_POST['cover_file_2']) && 
         isset($_POST['file_notes']) && 
         isset($_POST['rate']) && 
         isset($_POST['depth']) && 
         isset($_POST['format_id']) && 
         isset($_POST['side_a_file']) && 
         isset($_POST['side_b_file']) && 
         isset($_POST['note_file']) && 
         isset($_POST['bwf_metadata']) && 
         isset($_POST['notebook_id']) && 
         isset($_POST['year']) && 
         isset($_POST['artwork']) && 
         isset($_POST['nyrere_song']) ) {
        // Came to this page because of the form submission.
        
        // Safeguard entered values 
        $title = trim(mysql_real_escape_string($_POST['title']));
        $priartist = trim(mysql_real_escape_string($_POST['primary_artist_id']));
        $secartist = trim(mysql_real_escape_string($_POST['secondary_artist_id']));
        $othartist = trim(mysql_real_escape_string($_POST['other_artist_id']));
        $analog = trim(mysql_real_escape_string($_POST['analog_id']));
        $datedig = trim(mysql_real_escape_string($_POST['date_digitized']));
        $cdbackup = trim(mysql_real_escape_string($_POST['cd_backup']));
        $covfilea = trim(mysql_real_escape_string($_POST['cover_file']));
        $covfileb = trim(mysql_real_escape_string($_POST['cover_file_2']));
        $notes = trim(mysql_real_escape_string($_POST['file_notes']));
        $rate = trim(mysql_real_escape_string($_POST['rate']));
        $depth = trim(mysql_real_escape_string($_POST['depth']));
        $format = trim(mysql_real_escape_string($_POST['format_id']));
        $sideafile = trim(mysql_real_escape_string($_POST['side_a_file']));
        $sidebfile = trim(mysql_real_escape_string($_POST['side_b_file']));
        $notefile = trim(mysql_real_escape_string($_POST['note_file']));
        $bwfmeta = trim(mysql_real_escape_string($_POST['bwf_metadata']));
        $notebook = trim(mysql_real_escape_string($_POST['notebook_id']));
        $year = trim(mysql_real_escape_string($_POST['year']));
        $artwork = trim(mysql_real_escape_string($_POST['artwork']));
        $nyrere = trim(mysql_real_escape_string($_POST['nyrere_song']));
        
        // Various checks of entered values
        if ( empty($title) )
            // Value for title is an empty string
            // Set error message to display in index page
            $_SESSION['sesError'] = "Add Error: Title cannot be empty";
        elseif ( empty($priartist) )
            $_SESSION['sesError'] = "Add Error: Primary Artist cannot be empty";
        elseif ( empty($analog) )
            $_SESSION['sesError'] = "Add Error: Analog Type cannot be empty";
        elseif ( empty($datedig) )
            $_SESSION['sesError'] = "Add Error: Date Digitized cannot be empty";
        elseif ( empty($cdbackup) )
            $_SESSION['sesError'] = "Add Error: CD Backup cannot be empty";
        elseif ( empty($rate) )
            $_SESSION['sesError'] = "Add Error: Rate cannot be empty";
        elseif ( empty($depth) )
            $_SESSION['sesError'] = "Add Error: Depth cannot be empty";
        elseif ( empty($format) )
            $_SESSION['sesError'] = "Add Error: Format cannot be empty";
        elseif ( empty($notebook) )
            $_SESSION['sesError'] = "Add Error: Notebook cannot be empty";
        else {
            // Everything is ok so update record ON TABLE TAPE
            $sql = "UPDATE tape
                    SET title='$title', primary_artist_id='$priartist', secondary_artist_id='$secartist', other_artist_id='$othartist', analog_id='$analog', date_digitized='$datedig', cd_backup='$cdbackup', cover_file='$covfilea', cover_file_2='$covfileb', file_notes='$notes', rate='$rate', depth='$depth', format_id='$format', side_a_file='$sideafile', side_b_file='$sidebfile', note_file='$notefile', bwf_metadata='$bwfmeta', notebook_id='$notebook', year='$year', artwork='$artwork', nyrere_song='$nyrere',
                    WHERE id=$id";
                    
            mysql_query($sql);
            
            // Set message to display back in index page
            $_SESSION['sesMessage'] = 'Record updated';
        }
        // Redirect to index page
        header( 'Location: index.php' );
        // Suspend further execution of this page and wait for redirect
        return;
    }

    // Came to this page because of clicking the link from the index page
        
    // Get ID of the track to edit
    $id = $_GET['id'];
        
    // Get data to pre-populate fields in the form FROM TABLE TAPE
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
      	<p>Edit an existing record.</p>
    </body>
        <form method="post">
            <table border="0">
            	<tr>
                    <td align="right">Title</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="title" 
                               value="<?php echo $title; ?>">
                    </td>
                <tr>
                    <td align="right">Primary Artist</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="primary_artist_id" 
                               value="<?php echo $priartist; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Secondary Artist</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="secondary_artist_id" 
                               value="<?php echo $secartist; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Other Artist</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="other_artist_id" 
                               value="<?php echo $othartist; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Analog Format</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="analog_id" 
                               value="<?php echo $analog; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Date Digitized</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="date_digitized" 
                               value="<?php echo $datedig; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">CD Backup</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="cd_backup" 
                               value="<?php echo $cdbackup; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Cover Front</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="cover_file" 
                               value="<?php echo $covfilea; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Cover Back</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="cover_file_b" 
                               value="<?php echo $covfileb; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">File Notes</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="file_notes" 
                               value="<?php echo $notes; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Rate</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="rate" 
                               value="<?php echo $rate; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Depth</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="depth" 
                               value="<?php echo $depth; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Format</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="format" 
                               value="<?php echo $format; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Side A</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="side_a_file" 
                               value="<?php echo $sideafile; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Side B</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="side_b_file" 
                               value="<?php echo $sidebfile; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Notes</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="note_file" 
                               value="<?php echo $notefile; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">BWF Metadata</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="bwf_metadata" 
                               value="<?php echo $bwfmeta; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Notebook ID</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="notebook_id" 
                               value="<?php echo $notebook; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Year</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="year" 
                               value="<?php echo $year; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Artwork</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="artwork" 
                               value="<?php echo $artwork; ?>">
                    </td>
                </tr>
                <tr>
                    <td align="right">Nyrere Song</td>
                    <td>:</td>
                    <td>
                        <input type="text" 
                               name="nyrere_song" 
                               value="<?php echo $nyrere; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <input type="hidden" 
                               name="hdnID" 
                               value="<?php echo $id; ?>"/>
                        <input type="submit" 
                               value="Update"/>
                        &nbsp;&nbsp;
                        <a href="index.php">Cancel</a>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>

