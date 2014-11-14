<?php


require_once ("../../model/Photo.php");
require_once ("../../model/Categorie.php");
require_once ("../../model/BDD.php");

if(isset($_POST["idPhoto"]))
{
    $idPhoto = $_POST["idPhoto"];
    $photo = Photo::get($idPhoto);
    $name = $photo->nom;
    $IdCateg = $photo->IdCategorie;
    
}
else
{
    $IdCateg = $_POST["idCateg"];
    $name = "";
}







?>


<div id="managePhotoForm">
    <form>
       
        <?php if (isset($idPhoto)):?>  
            <input type="hidden" id="idPhoto" value="<?php echo $idPhoto ?>">
            <input type="hidden" id="action" value="updatePhoto">    
        <?php  else : ?>
            <input type="hidden" id="action" value="addPhoto">
        <?php endif; ?>
 

         <div class="rubrique" >
            <label for="name">Nom : </label>
            <input type="text" name="name" id="namePhoto" value="<?php echo $name ?>">
        </div>
        <div class="rubrique" >
            <label for="photo">Image : </label>
            <input type="hidden" name="MAX_FILE_SIZE" value="6291456">     
            <input type="file" name="file[]" id="photo" multiple>
        </div>
        <div class="rubrique">
            <label for="file">Catégorie : </label>
        <?php
            displayCategorieChooser($IdCateg);
        ?>
        </div>
        <?php if (isset($idPhoto)):?>  
             <input type="button" id="ValidEditPhoto" onclick="editPhotoValid()" value="Valider" class="btn-green">   
        <?php  else : ?>
            <input type="button" id="ValidAddPhoto" onclick="addPhotoValid()" value="Valider" class="btn-green">
        <?php endif; ?>
           
    </form>
</div>


 <?php

        function displayCategorieChooser($idCateg)
        {
            
            $categories = Categorie::getAllCategorie();
            
            echo "<select id='categ' >";
            foreach($categories as $categ)
            {
                echo "<option value='".$categ->ID."' ";
                if($categ->ID==$idCateg)
                {
                    echo "selected";
                }
                echo " >";
                echo $categ->nom;
                echo "</option>";
            }
            echo "</select>";
        }

?>