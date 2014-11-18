<div class="photoGalerie" id="<?php echo 'photo'.$photo->ID ?>">
     <?php  if(IsAdmin()): ?>
        <div class="deleteButton" onclick="deletePhoto(<?php  echo $photo->ID; ?>)"></div>
     <?php  endif; ?>
        
      <?php  if(IsAdmin()): ?>
        <div class="editButton" onclick="editPhoto(<?php  echo $photo->ID; ?>)"></div>
     <?php  endif; ?>
        
    <a href="<?php echo $photo->chemin ?>" data-lightbox="<?php echo $categ->nom ?>"  data-title="<?php echo $photo->nom ?>"  >
    <img  src="<?php echo str_replace("photos","miniatures",$photo->chemin) ?>" >
    <div class="photoTitle">
        <span class="photoTitleContent" ><?php echo $photo->nom ?></span> 
    </div>
    </a>
</div>