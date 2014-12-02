<?php 
    session_start();
    require_once("../fonctions.php");
    
    $trad = simplexml_load_file("../lang/lang_".$_SESSION["lang"].".xml");
?>

<form id="formContenu">
    <?php if (isset($idPhoto)):?>  
        <input type="hidden" name="id" value="<?php echo $idPhoto ?>">
        <input type="hidden" name="action" value="edit">    
    <?php  else : ?>
        <input type="hidden" id="action" value="add">
    <?php endif; ?>
    <fieldset>
        <label for="contenu"><?php echo getTrad("contenu"); ?> :</label>
        <textarea id="contenu" name="contenu"></textarea>
    </fieldset>
    <input type="button" onclick="addContenu();" />
</form>