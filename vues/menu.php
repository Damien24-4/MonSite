<nav id="menu">
    <ul>
                <a  href="Presentation" class="menu1">
                    <li><?php echo getTrad("menu1") ?></li>
                </a>
                <div class="menuSeparator"></div> 
                <a  href="Galerie" class="menu2">
                    <li><?php echo getTrad("menu2") ?></li>
                </a>
                 <div class="menuSeparator"></div> 
                <a  href="Activite" class="menu3">
                    <li><?php echo getTrad("menu3") ?></li>
                </a>
                <div class="menuSeparator"></div> 
                <a  href="Contact" class="menu4">
                    <li><?php echo getTrad("menu4") ?></li>
                </a>
                <?php
                
                if(IsAdmin()):
                ?>
                    <div class="menuSeparator"></div> 
                <a  href="Traductions" class="menu5">
                    <li><?php echo getTrad("menu5") ?></li>
                </a>
                    
                <?php    
                endif;
                ?>
    </ul>
</nav>
