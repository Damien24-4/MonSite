 




<div class="categorie" id="<?php  echo "categphoto".$categ->ID; ?>">
        <span class="categorieLabel"><?php  echo $categ->nom; ?></span>
     <?php  if(IsAdmin()): ?>
        <div class="addButton" onclick="addPhoto(<?php  echo $categ->ID; ?>)"></div>
     <?php  endif; ?>
</div> 
<div class="galerie" id="<?php echo "galerie".$categ->ID; ?>">
    
     <?php  foreach ($categ->photos as $photo) {

    include("photoView.php");

     }  ?>
    
    
</div>

