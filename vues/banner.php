<a href="Accueil">
        <div id="banniere">
            <?php
            
           
            
            ?>
            <div id="tradBloc">
                <?php
                
                $langs = ["fr","en"];
                
                foreach($langs as $country)
                {
                   
                    $currentLang = substr($_SERVER["REQUEST_URI"],strrpos($_SERVER["REQUEST_URI"],"/")-3,3);
                    $destinationUrl = str_replace($currentLang, "/".$country, $_SERVER["REQUEST_URI"]);
                    
                    
                    
                    ?>
                    
<!--                     <a href=" <?php echo  $destinationUrl ?>">
                    <img src="<?php echo  "../images/flag_".$country.".png" ?>"  >
                     </a>-->
                    
                      <?php
                    
                }
                
                ?>
                  
               
             
            </div>
</div>
</a>

