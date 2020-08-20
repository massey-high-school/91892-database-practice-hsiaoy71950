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
                    
                        if($find_rs["In App"] == 1)  {
                            
                    ?>
                            
                    <div>
                        
                        &nbsp;(In-App Purchases)
                        
                    </div>  <!-- / In app -->
                    
                    <?php 
                        }
                    ?>
                    
                    </div>  <!-- Flex Container -->
                <p>
                    <div class = "flex-container">
                    <div class="star-ratings-sprite">
                        <span style="width:<?php echo $find_rs["User Rating"] / 5 * 100 ?>%" class="star-ratings-sprite-rating">
                        </span>
                    </div>
                    (<?php echo $find_rs["User Rating"] ?> based on <?php echo $find_rs["Rating Count"] ?> votes)
                    </div>
                
                    <b>Developer</b>:
                    <?php echo $find_rs["DevName"]; ?>
                
                    <br />
                
                    <b>Genre</b>:
                    <?php echo $find_rs["GenreName"]; ?>
                
                    <br />
                
                    Suitable for ages
                    <b><?php echo $find_rs["Age"]; ?></b>
                    and up
                    
                    <hr />
                
                    <?php echo $find_rs["Description"]; ?>
                
                </p>
                
                
                
                
            </div> <!-- / results -->
            
            <?php
                    
                } // end results "do"
                
                while($find_rs = mysqli_fetch_assoc($find_query));
                
            } // end else
            ?>