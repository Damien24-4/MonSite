<div id="content">
  
   <?php
   $trads = getAllTraductions();
   
   if(isset($_SESSION["displaykey"]))
   {
      
       $displayKey = $_SESSION["displaykey"]=="true";
   }
   else
   {
       $displayKey = false;
   }
               
  
   
   ?>
   
    
    
    <table id="traductionTable" class="display datatable" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Key</th>
                <th>Traduction</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
               <th>Key</th>
                <th>Traduction</th>
            </tr>
        </tfoot>
 
        <tbody>
            <?php
   
               foreach ($trads as $categ)
               {
                   foreach($categ as $key => $text)
                   {
                     ?>
                         <tr>
                         <td><?php echo $key; ?></td>
                         <td class="traduction"><?php echo $text; ?></td>
                         </tr>
            
                     <?php
                   }
               }
   
       
 
   
   ?>
                         
        <div id="displayTradkey">
            <span><?php echo gettext("displayTradKey"); ?></span>
            <input type="checkbox" name="displaykey" <?php if($displayKey){echo "checked";} ?> onchange="updateSessionVar(this)" >
        </div>
           
           
          
        </tbody>
    </table>
    
    
</div>
