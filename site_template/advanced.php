<?php include("topbit.php");

    $app_name = mysqli_real_escape_string($dbconnect, $_POST['app_name']);
    $dev_name = mysqli_real_escape_string($dbconnect, $_POST['dev_name']);
    $genre = mysqli_real_escape_string($dbconnect, $_POST['genre']);
    $cost = mysqli_real_escape_string($dbconnect, $_POST['cost']);

    //cost code
    if ($cost=="") {
        $cost_op = ">=";
        $cost = 0;
    }
    else {
        $cost_op = "<=";
    }

    // In App

    if (isset($_POST['in_app'])) {
        $in_app = 0;
    }

    else {
        $in_app = 1;
    }
    
    // Ratings
    
    $rating_more_less = mysqli_real_escape_string($dbconnect, $_POST['rate_more_less']);
    $rating = mysqli_real_escape_string($dbconnect, $_POST['rating']);

    if ($rating == "") {
        $rating = 0;
        $rate_more_less = "at least";
    }

    if ($rating_more_less == "at least") {
        $rate_op = ">=";
    }
    else {
        $rate_op = "<=";
         
    } // end rating if / else

    // Age
    
    $age_more_less = mysqli_real_escape_string($dbconnect, $_POST['age_more_less']);
    $age = mysqli_real_escape_string($dbconnect, $_POST['age']);

    if ($age == "") {
        $age = 0;
        $age_more_less = "at least";
    }

    if ($age_more_less == "at least") {
        $age_op = ">=";
    }
    else {
        $age_op = "<=";
    } // end age if / else
    
    $find_sql = "SELECT *
    FROM `L2_prac_game_details`
    JOIN L2_prac_genre ON ( L2_prac_game_details.GenreID = L2_prac_genre.GenreID )
    JOIN L2_prac_developer ON ( L2_prac_game_details.DeveloperID = L2_prac_developer.DeveloperID )
    WHERE `Name` LIKE '%$app_name%'
    AND `DevName` LIKE '%$dev_name%'
    AND `GenreName` LIKE '%$genre%'
    AND `Price` $cost_op $cost 
    AND (`In App` = $in_app OR `In App` = 0)
    AND `User Rating` $rate_op $rating 
    AND `Age` $age_op $age";
    $find_query = mysqli_query($dbconnect, $find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);
    $count = mysqli_num_rows($find_query);

?>

        <div class="box main">
            <h2>All Results</h2>
            
            
            <?php include("results.php") ?>
            
        </div> <!-- / main -->
        
<?php include("bottombit.php") ?>