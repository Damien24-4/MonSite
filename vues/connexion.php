<div id="content">
    
    <?php
    
        if(isset($error) && $error)
        {
            ?>
            
    <div class="errorMessage">
        Les informations sont incorrects
    </div>
    
    
             <?php
            
        }
    ?>
    
    
    
    <form id="formAdmin" action="login" method="POST" style="top: 100px;" >
        <div class="rubrique" >
            <label for="login">Identifiant</label>
            <input type="text" name="login">
        </div>
        <div class="rubrique" >
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp">
        </div>
        <input type="submit" id="ValidAdmin" class="btn-green">
    </form>
    
    
    
</div>