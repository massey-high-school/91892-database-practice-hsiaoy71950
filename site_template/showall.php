<?php include("topbit.php");
    
    $find_sql = "SELECT * FROM `L2_prac_game_details`
    JOIN L2_prac_genre ON (L2_prac_game_details.GenreID = L2_prac_genre.GenreID)
    JOIN L2_prac_developer ON (L2_prac_game_details.DeveloperID = L2_prac_developer.DeveloperID)
    ";
    $find_query = mysqli_query($dbconnect, $find_sql);
    $find_rs = mysqli_fetch_assoc($find_query);
    $count = mysqli_num_rows($find_query);

?>

        <div class="box main">
            <h2>All Results</h2>
            
            
            <?php
            
            if($count < 1) {
            
            ?>
            
            <div class = "error">
                
                Sorry! No results!!!!
            
            </div> <!-- end error -->
            
            <?php
            
            } // end no results if
            
            else {
                do {

            ?>
            
            <div class = "results">
                <div class = "flex-container">
                    <div>
                        <span class = "sub_heading">
                            <a href = "<?php echo $find_rs["URL"]; ?>">
                                <?php echo $find_rs["Name"]; ?>
                            </a>   
                        </span>
                </div>  <!-- Title -->
                
                <?php 
                    
                        if($find_rs["Subtitle"] != "")  {
                            
                    ?>
                            
                    <div>
                    
                        &nbsp; &nbsp; | &nbsp; &nbsp;
                        <?php echo $find_rs["Subtitle"]; ?>
                        
                    </div>  <!-- / subtitle -->
                    
                    <?php 
                        }
                    
                        if($find_rs["Price"] == 0)  {
                            
                    ?>
                            
                    <div>
                    
                        &nbsp; &nbsp; | &nbsp; &nbsp; Free!!!
                        
                    </div>  <!-- / Price -->
                    
                    <?php 
                            
                        }
                    
                    else {
                    ?>
                    
                    <div>
                    
                        &nbsp; &nbsp; | &nbsp; &nbsp; $
                        <?php echo $find_rs["Price"]; ?>
                        
                    </div>  <!-- / Price -->
                        
                    <?php 
                        
                    }
                    
                        if($find_rs["In App"] == 0)  {
                            
                    ?>
                            
                    <div>
                        
                        &nbsp;(In-App Purchases)
                        
                    </div>  <!-- / In app -->
                    
                    <?php 
                        }
                    ?>
                    
                    </div>  <!-- Flex Container -->
                <p>
                    <b>Genre</b>:
                    <?php echo $find_rs["GenreName"]; ?>
                    
                    <br />
                    
                    <b>Developer</b>:
                    <?php echo $find_rs["DevName"]; ?>
                    
                    <br />
                    
                    <b>Rating</b>:
                    <?php echo $find_rs["User Rating"]; ?>
                    
                    (based on <?php echo $find_rs["Rating Count"]; ?> votes)
                
                    <hr />
                
                    <?php echo $find_rs["Description"]; ?>
                
                </p>
                
                
                
                
            </div> <!-- / results -->
            
            <?php
                    
                } // end results "do"
                
                while($find_rs = mysqli_fetch_assoc($find_query));
                
            } // end else
            ?>

            
        </div> <!-- / main -->
        
<?php include("bottombit.php") ?>