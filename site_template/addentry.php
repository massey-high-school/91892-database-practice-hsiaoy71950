<?php include("topbit.php");

// Get genre list from database

$genre_sql="SELECT * FROM `L2_prac_genre` ORDER BY `L2_prac_genre`.`GenreName` ASC";
$genre_query=mysqli_query($dbconnect, $genre_sql);
$genre_rs=mysqli_fetch_assoc($genre_query);

// form variables
    
$app_name = "";
$subtitle = "";
$url = "";
$genreID = "";
$dev_name = "";
$age = "";
$rating = "";
$rate_count = "";
$cost = "";
$inapp = 1;
$description = "";

$has_errors = "no";

// code form submitting form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $app_name = mysqli_real_escape_string($dbconnect, $_POST['app_name']);
    $subtitle = mysqli_real_escape_string($dbconnect, $_POST['subtitle']);
    $url = mysqli_real_escape_string($dbconnect, $_POST['url']);
    $genreID = mysqli_real_escape_string($dbconnect, $_POST['genre']);
    
    // if GenreID, is not blank, get genre so that genre box does not lose its value if there are errors
    if($genreID != "") {
        $genreitem_sql = "SELECT * FROM `L2_prac_genre` WHERE `GenreID` = $genreID";
        $genreitem_query=mysqli_query($dbconnect,$genreitem_sql);
        $genreitem_rs=mysqli_fetch_assoc($genreitem_query);
        
        $genre = $genreitem_rs['GenreName'];
        
    } //end genreid if
    
    $dev_name = mysqli_real_escape_string($dbconnect, $_POST['dev_name']);
    $age = mysqli_real_escape_string($dbconnect, $_POST['age']);
    $rating = mysqli_real_escape_string($dbconnect, $_POST['rating']);
    $rate_count = mysqli_real_escape_string($dbconnect, $_POST['rate_count']);
    $cost = mysqli_real_escape_string($dbconnect, $_POST['cost']);
    $inapp = mysqli_real_escape_string($dbconnect, $_POST['inapp']);
    $description = mysqli_real_escape_string($dbconnect, $_POST['description']);
    
    //error checking here
    
    //if no errors
    if ($has_errors == "no") {
    
    //go to success page
    //get dev id if exists
    $dev_sql ="SELECT * FROM `L2_prac_developer` WHERE `DevName` LIKE '$dev_name'";
    $dev_query=mysqli_query($dbconnect,$dev_sql);
    $dev_rs=mysqli_fetch_assoc($dev_query);
    $dev_count=mysqli_num_rows($dev_query);
    //add new dev id if not in table
        
    if ($dev_count > 0) {
        $developerID = $dev_rs['DeveloperID'];
    }
        
    else {
    $add_dev_sql = "INSERT INTO `hsiaoy71950`.`L2_prac_developer` 
    (`DeveloperID` ,`DevName`)
    VALUES (NULL , '$dev_name');";
    $add_dev_query = mysqli_query($dbconnect, $add_dev_sql);
    // get dev id
    $newdev_sql = "SELECT * FROM `L2_prac_developer` WHERE `DevName` LIKE '$dev_name'";
    $newdev_query=mysqli_query($dbconnect, $newdev_sql);
    $newdev_rs =mysqli_fetch_assoc($newdev_query);
        
    $developerID = $newdev_rs['DeveloperID'];
    } //end add dev
    // add new entry to database
    $add_entry_sql = "INSERT INTO `hsiaoy71950`.`L2_prac_game_details` (`ID`, `Name`, `Subtitle`, `URL`, `GenreID`, `DeveloperID`, `Age`, `User Rating`, `Rating Count`, `Price`, `In App`, `Description`) VALUES (NULL, '$app_name', '$subtitle', '$url', '$genreID', '$developerID', '$age', '$rating', '$rate_count', '$cost', '$inapp', '$description')";
    $add_entry_query = mysqli_query($dbconnect, $add_entry_sql);
    } //end of no errors if
} //end of submit button

?>

        <div class="box main">
            <div class="add-entry">
            <h2>Add an Entry</h2>
                
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            
            <!-- App Name (req) -->
                <input class="add-field" type="text" name="app_name" value="<?php echo $app_name; ?>" placeholder="App Name (required)..."/>
            <!-- Subtitle (optional) -->
                <input class="add-field" type="text" name="subtitle" value="<?php echo $subtitle; ?>" placeholder="Subtitle (optional)..."/>
            <!-- URL (req, must start http://) -->
                <input class="add-field" type="text" name="url" value="<?php echo $url; ?>" placeholder="URL (required)..."/>
            <!-- Genre dropdown (req) -->
                <select class="adv" name="genre">
                    
                <?php
                if($genreID=="") {
                    ?>
            
                <option value='' disabled selected>Genre (Choose something)...</option>
                <?php
                    }
                else{
                    ?>
                <option value="<?php echo $genreID; ?>" selected><?php echo $genre; ?></option>
                <?php
                    }
                    ?>
            
                <!-- get options from database -->
                <?php 
                    
                do {
                ?>
                <option value="<?php echo $genre_rs['GenreID']; ?>"><?php echo $genre_rs['GenreName']; ?></option>
            
                <?php
                
                } // end genre do loop
            
                while($genre_rs=mysqli_fetch_assoc($genre_query))
            
                ?>
                </select>
            <!-- Dev Name (req) -->
                <input class="add-field" type="text" name="dev_name" value="<?php echo $dev_name; ?>" placeholder="Developer Name (required)..."/>
            <!-- Age (optional, set to 0 if blank) -->
                <input class="add-field" type="text" name="age" value="<?php echo $age; ?>" placeholder="Age (0 for all)..."/>
            <!-- Rating (# between 0-5, 1dp) -->
                <input class="add-field" type="text" name="rating" value="<?php echo $rating; ?>" placeholder="Rating (0-5)"/>
            <!-- # of ratings (int more than 0) -->
                <input class="add-field" type="text" name="rate_count" value="<?php echo $rate_count; ?>" placeholder="# of Ratings"/>
            <!-- cost (decimal 2dp, must be >0) -->
                <input class="add-field" type="text" name="cost" value="<?php echo $cost; ?>" placeholder="Cost (number only)"/>
                
                <br /><br/>
            <!-- in app purchase radio buttons -->
            <div>
                <b>In App Purchase: </b>
                <!-- defaults to yes -->
                <!-- no is 0 and yes is 1 -->
                <?php
                if($inapp==1) {
                //default value yes is selected
                    ?>
                <input type="radio" name="inapp" value="1" checked="checked"/>Yes
                <input type="radio" name="inapp" value="0"/>No
                <?php
                }
                
                else{
                    ?>
                <input type="radio" name="inapp" value="1"/>Yes
                <input type="radio" name="inapp" value="0" checked="checked"/>No
                <?php
                }
                ?>
            </div>
                
            <br />
                
            <!-- description -->
                <textarea class="add-field <?php echo $description_field?>" name="description" placeholder="Description..." rows="6"><?php echo $description; ?></textarea>
            <!-- submit button -->
            <p>
                <input class="submit advanced-button" type="submit" value="Submit" />
            </p>
                
            </form>
            
            </div> <!-- / add-entry -->
        </div> <!-- / main -->
        
<?php include("bottombit.php") ?>