<?php
    // Gain access to DB
    require_once "db.php";
    // Initialize session for page
    session_start();
    
    require_once "navigation.php";

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
         isset($_POST['nyrere_song']) ) 
    {
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
        //elseif ( empty($year) )
            //$_SESSION['sesError'] = "Add Error: Year cannot be empty";
            
        //elseif ( is_numeric($year) === False )
            // Value for year is not numeric
            // Set error message to display in index page
            //$_SESSION['sesError'] = "Add Error: Year must be a number";
        //elseif ( is_numeric($datedig) === False ) 
            //$_SESSION['sesError'] = "Add Error: Date Digitized must be a number";
          
        else 
        {
            // Everything is ok so insert new record INTO TABLE TAPE
            $sql = "INSERT INTO tape (title, primary_artist_id, secondary_artist_id, other_artist_id, analog_id, date_digitized, cd_backup, cover_file, cover_file_2, file_notes, rate, depth, format_id, side_a_file, side_b_file, note_file, bwf_metadata, notebook_id, year, artwork, nyrere_song)
                    VALUES ('$title', '$priartist', '$secartist', '$othartist', '$analog', '$datedig', '$cdbackup', '$covfilea', '$covefileb', '$notes', '$rate', '$depth', '$format', '$sideafile', '$sidebfile', '$notefile', '$bwfmeta', '$notebook', '$year', '$artwork', '$nyrere')";
            mysql_query($sql);
            
            // Set message to display in index page
            $_SESSION['sesMessage'] = 'Record Added';
        }
        // Redirect to index page
        header( 'Location: index.php' );        
        // Suspend further execution of this page and wait for redirect
        return;
    }
?>
<html>
    <body>
        <h2>African Music Database</h2>
    </body>
        <p> Add a new tape: </p>
        <form method="post">
            <table border="0">
            	<tr>
                    <td align="right">Title</td>
                    <td>:</td>
                    <td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <td align="right">Primary Artist</td>
                    <td>:</td>
                    <td><input type="text" name="primary_artist_id"></td>
                </tr>
                <tr>
                    <td align="right">Secondary Artist</td>
                    <td>:</td>
                    <td><input type="text" name="secondary_artist_id"></td>
                </tr>
                <tr>
                    <td align="right">Other Artist</td>
                    <td>:</td>
                    <td><input type="text" name="other_artist_id"></td>
                </tr>
                <tr>
                    <td align="right">Analog Format</td>
                    <td>:</td>
                    <td><input type="text" name="analog_id"></td>
                </tr>
                <tr>
                    <td align="right">Date Digitized</td>
                    <td>:</td>
                    <td><input type="text" name="date_digitized"></td>
                </tr>
                <tr>
                    <td align="right">CD Backup</td>
                    <td>:</td>
                    <td><input type="text" name="cd_backup"></td>
                </tr>
                <tr>
                    <td align="right">Cover Front</td>
                    <td>:</td>
                    <td><input type="text" name="cover_file"></td>
                </tr>
                <tr>
                    <td align="right">Cover Back</td>
                    <td>:</td>
                    <td><input type="text" name="cover_file_2"></td>
                </tr>
                <tr>
                    <td align="right">File Notes</td>
                    <td>:</td>
                    <td><input type="text" name="file_notes"></td>
                </tr>
                <tr>
                    <td align="right">Rate</td>
                    <td>:</td>
                    <td><input type="text" name="rate"></td>
                </tr>
                <tr>
                    <td align="right">Depth</td>
                    <td>:</td>
                    <td><input type="text" name="depth"></td>
                </tr>
                <tr>
                    <td align="right">Format</td>
                    <td>:</td>
                    <td><input type="text" name="format_id"></td>
                </tr>
                <tr>
                    <td align="right">Side A</td>
                    <td>:</td>
                    <td><input type="text" name="side_a_file"></td>
                </tr>
                <tr>
                    <td align="right">Side B</td>
                    <td>:</td>
                    <td><input type="text" name="side_b_file"></td>
                </tr>
                <tr>
                    <td align="right">Notes</td>
                    <td>:</td>
                    <td><input type="text" name="note_file"></td>
                </tr>
                <tr>
                    <td align="right">BWF Metadata</td>
                    <td>:</td>
                    <td><input type="text" name="bwf_metadata"></td>
                </tr>
                <tr>
                    <td align="right">Notebook ID</td>
                    <td>:</td>
                    <td><input type="text" name="notebook_id"></td>
                </tr>
                <tr>
                    <td align="right">Year</td>
                    <td>:</td>
                    <td><input type="text" name="year"></td>
                </tr>
                <tr>
                    <td align="right">Artwork</td>
                    <td>:</td>
                    <td><input type="text" name="artwork"></td>
                </tr>
                <tr>
                    <td align="right">Nyrere Song</td>
                    <td>:</td>
                    <td><input type="text" name="nyrere_song"></td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <input type="submit" value="Add New"/>
                        &nbsp;&nbsp;
                        <a href="index.php">Cancel</a>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>

