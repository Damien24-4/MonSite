<section id="content">
    <?php   if(sizeof($contenus, COUNT_RECURSIVE) == 2):?>
        <p>Aucun contenu n'est disponible pour cette page.
            
        <?php if(IsAdmin()) : ?>
            Cliquez <a href="<?php $url ?>?action=add">ici</a> pour en ajouter.
        <?php endif; ?>
        
        </p> 
     <?php endif; 
            if(IsAdmin()): 
            if(array_key_exists('action', $paramUrl)):
                switch ($paramUrl['action'])
                {
                    case 'add':
                        break;
                }
    ?>       
                <form>
                    <fieldset>
                        <label for="formContenu"><?php echo getTrad("formContenu"); ?> :</label>
                        <textarea id="formContenu" name="contenu"></textarea>
                    </fieldset>
                    <input type="submit" />
                </form>
                <script type="text/javascript"  src="../utils/ckeditor/ckeditor.js" ></script>
                <script>
                    CKEDITOR.replace('formContenu');
                </script>
            <?php endif; ?>      
     <?php endif; ?>
</section>

