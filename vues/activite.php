<section id="content">
    <?php   
        if(sizeof($contenus, COUNT_RECURSIVE) == 2):?>
        <p>Aucun contenu n'est disponible pour cette page.
            
        <?php if(IsAdmin()) : ?>
            <script type="text/javascript"  src="../utils/ckeditor/ckeditor.js" ></script>
            Cliquez <a onclick="getFormContenu('../vues/formContenu.php', 'content', 0);">ici</a> pour en ajouter.
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
                
            <?php endif; ?>      
     <?php endif; ?>
</section>