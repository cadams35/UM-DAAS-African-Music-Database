<?php
    // Gain access to DB
    require_once "db.php";
    // Initialize session for page
    session_start();
    
    //Fetch information from the tape table
    $sql1="SELECT id, title FROM tape"; 
    $result=mysql_query($sql1); 
    
    $options=""; 

    while ($row=mysql_fetch_array($result)) { 

        $id=$row["id"]; 
        $tapetitle=$row["title"]; 
        $options.="<OPTION VALUE=\"$id\">".$tapetitle."</option>";
        }
    
    //Fetch information from the format table
    $sql2="SELECT id, title FROM format"; 
    $result2=mysql_query($sql2); 
    
    $options2=""; 

    while ($row2=mysql_fetch_array($result2)) { 

        $id2=$row2["id"]; 
        $format=$row2["title"]; 
        $options2.="<OPTION VALUE=\"$id2\">".$format."</option>";
        }
    
    //Fetch information from the poetry table
    $sql3="SELECT id, title FROM poetry"; 
    $result3=mysql_query($sql3); 
    
    $options3=""; 

    while ($row3=mysql_fetch_array($result3)) { 

        $id3=$row3["id"]; 
        $poetry=$row3["title"]; 
        $options3.="<OPTION VALUE=\"$id3\">".$poetry."</option>";
        }
        
    //Fetch information from the melody table
    $sql4="SELECT id, title FROM melody"; 
    $result4=mysql_query($sql4); 
    
    $options4=""; 

    while ($row4=mysql_fetch_array($result4)) { 

        $id4=$row4["id"]; 
        $melody=$row4["title"]; 
        $options4.="<OPTION VALUE=\"$id4\">".$melody."</option>";
        }
        
    //Fetch information from the vocalist table
    $sql5="SELECT id, title FROM vocalist"; 
    $result5=mysql_query($sql5); 
    
    $options5=""; 

    while ($row5=mysql_fetch_array($result5)) { 

        $id5=$row5["id"]; 
        $vocalist=$row5["title"]; 
        $options5.="<OPTION VALUE=\"$id5\">".$vocalist."</option>";
        }
        
    // Need to check whether the user came to this page because of clicking the
    // link from the index page or because of the form submission in this page.
    if ( isset($_POST['track_title']) && 
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
        if (empty($track) )
            $_SESSION['sesError'] = "Add Error: Song Title cannot be empty";
        //elseif ( empty($file) )
          //  $_SESSION['sesError'] = "Add Error: Song File cannot be empty";
        elseif ( empty($rate) )
            $_SESSION['sesError'] = "Add Error: Rate cannot be empty";
        elseif ( empty($depth) )
            $_SESSION['sesError'] = "Add Error: Depth cannot be empty";
        elseif ( empty($format) )
            $_SESSION['sesError'] = "Add Error: Format cannot be empty";
                 
        else 
        {
            // Everything is ok so insert new record INTO TABLE TRACK
            $sql = "INSERT INTO track (title, tape_id, poetry_id, melody_id, vocalist_id, 
                    bwf_metadata, rate, depth, format_id, track_notes, note_file, toc_number)
                    VALUES ('$track', '$tape', '$poetry', '$melody', '$vocalist', '$bwf', 
                    '$rate', '$depth', '$format', '$tnotes', '$notefile', '$toc')";
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
                    <td><select name="tape_title">
                    <OPTION VALUE=0>Choose
                    <?=$options; ?>
                    </select>
                    </td>
                    <td>
                    <a href="addtape.php">Add a new tape</a>
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
                    <td><select name="poetry_title">
                    <OPTION VALUE=0>Choose
                    <?=$options3; ?>
                    </select>
                    </td>
                    <!--NEED TO ADD A LINK TO METADATA ENTRY-->
                </tr>
                
                <tr>
                    <td align="right">Melody (shairi)</td>
                    <td>:</td>
                    <td><select name="melody_title">
                    <OPTION VALUE=0>Choose
                    <?=$options4; ?>
                    </select>
                    </td>
                    <!--NEED TO ADD A LINK TO METADATA ENTRY-->
                </tr>
                
                <tr>
                    <td align="right">Vocalist (muimbaji)</td>
                    <td>:</td>
                    <td><select name="vocalist">
                    <OPTION VALUE=0>Choose
                    <?=$options5; ?>
                    </select>
                    </td>
                    <!--NEED TO ADD A LINK TO METADATA ENTRY-->
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
                    <td><select name="format">
                    <OPTION VALUE=0>Choose
                    <?=$options2; ?>
                    </select>
                    <!--NEED TO ADD A LINK TO METADATA ENTRY-->
                </tr>
                
                <tr>
                    <td align="right">.bwf Metadata</td>
                    <td>:</td>
                    <td><select name="bwf">
                    <option value="y">Yes</option>
                    <option value="n">No</option>
                    </td>
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

