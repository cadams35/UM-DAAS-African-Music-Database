<?php
    // Gain access to DB
    require_once "db.php";
    // Initialize session for page
    session_start();
    
    // Need to check whether the user came to this page because of clicking the
    // link from the index page or because of the form submission in this page.
    if ( isset($_POST['tape_title']) && 
         isset($_POST['track_title']) && 
         isset($_POST['track_notes']) && 
         isset($_POST['poetry_title']) &&
         isset($_POST['melody_title']) && 
         isset($_POST['vocalist']) && 
         isset($_POST['file']) && 
         isset($_POST['rate']) && 
         isset($_POST['depth']) && 
         isset($_POST['format']) && 
         isset($_POST['bwf']) && 
         isset($_POST['note_file']) && 
         isset($_POST['toc']) ) 
    {
        // Came to this page because of the form submission.

        // Safeguard entered values 
        $tape = trim(mysql_real_escape_string($_POST['tape_title']));
        $track = trim(mysql_real_escape_string($_POST['track_title']));
        $tnotes = trim(mysql_real_escape_string($_POST['track_notes']));
        $poetry = trim(mysql_real_escape_string($_POST['poetry_title']));
        $melody = trim(mysql_real_escape_string($_POST['melody_title']));
        $vocalist = trim(mysql_real_escape_string($_POST['vocalist']));
        $file = trim(mysql_real_escape_string($_POST['file']));
        $rate = trim(mysql_real_escape_string($_POST['rate']));
        $depth = trim(mysql_real_escape_string($_POST['depth']));
        $format = trim(mysql_real_escape_string($_POST['format']));
        $bwf = trim(mysql_real_escape_string($_POST['bwf']));
        $notefile = trim(mysql_real_escape_string($_POST['note_file']));
        $toc = trim(mysql_real_escape_string($_POST['toc']));
        
        // Various checks of entered values
        if ( empty($tape) )
            // Value for title is an empty string
            // Set error message to display in index page
            $_SESSION['sesError'] = "Add Error: Tape Title cannot be empty";
        elseif ( empty($track) )
            $_SESSION['sesError'] = "Add Error: Song Title cannot be empty";
        elseif ( empty($file) )
            $_SESSION['sesError'] = "Add Error: Song File cannot be empty";
        elseif ( empty($rate) )
            $_SESSION['sesError'] = "Add Error: Rate cannot be empty";
        elseif ( empty($depth) )
            $_SESSION['sesError'] = "Add Error: Depth cannot be empty";
        elseif ( empty($format) )
            $_SESSION['sesError'] = "Add Error: Format cannot be empty";
                 
        else 
        {
            // Everything is ok so insert new record INTO TABLE TAPE
            $sql = "INSERT INTO track (tape_id, title, track_notes, poetry_id, melody_id, 
                    vocalist_id, track_file, rate, depth, bwf_metadata, note_file, toc_number)
                    VALUES ('$tape', '$track', '$tnotes', '$poetry', '$melody', '$vocalist', 
                    '$file', '$rate', '$depth', '$format', '$bwf', '$notefile', '$toc')";
            mysql_query($sql);
            
            // Set message to display in index page
            $_SESSION['sesMessage'] = 'Record Added';
        }
        // Redirect to index page
        header( 'Location: index.php' );        
        // Suspend further execution of this page and wait for redirect
        return;
    }
    
    require_once "navigation.php";
    
?>
<html>
    <body>
        <h2>African Music Database</h2>
    </body>
        <p> Add a new song: </p>
        <form method="post">
            <table border="0">
                <tr>
                    <td align="right">Tape Title</td>
                    <td>:</td>
                    <td><input type="text" name="tape_title"></td>
                    <!--NEEDS TO BE MATCHED WITH EXISTING TAPE, OR PROMPT ENTRY OF EXISTING TAPE-->
                </tr>
                <tr>
                    <td align="right">Song Title</td>
                    <td>:</td>
                    <td><input type="text" name="track_title"></td>
                </tr>
                <tr>
                    <td align="right">Notes</td>
                    <td>:</td>
                    <td><input type="text" name="track_notes"></td>
                </tr>
                <tr>
                    <td align="right">Poetry (shairi)</td>
                    <td>:</td>
                    <td><input type="text" name="poetry_title"></td>
                </tr>
                <tr>
                    <td align="right">Melody (shairi)</td>
                    <td>:</td>
                    <td><input type="text" name="melody_title"></td>
                </tr>
                <tr>
                    <td align="right">Vocalist (muimbaji)</td>
                    <td>:</td>
                    <td><input type="text" name="vocalist"></td>
                </tr>
                <tr>
                    <td align="right">Song File</td>
                    <td>:</td>
                    <td><input type="text" name="file"></td>
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
                    <td><input type="text" name="format"></td>
                </tr>
                <tr>
                    <td align="right">.bwf Metadata</td>
                    <td>:</td>
                    <td><input type="text" name="bwf"></td>
                </tr>
                <tr>
                    <td align="right">Note File</td>
                    <td>:</td>
                    <td><input type="text" name="note_file"></td>
                </tr>
                <tr>
                    <td align="right">ToC Number</td>
                    <td>:</td>
                    <td><input type="text" name="toc"></td>
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