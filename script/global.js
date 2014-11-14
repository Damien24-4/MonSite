
$(document).ready(function()
{
    
   resizeContent();
   resize(resizeContent);
   initGallerie();
   
  initDatatable();

    
});

function test()
{
    alert("ok");
}


function resize(fct)
{
    
var rtime = new Date(1, 1, 2000, 12,00,00);
var timeout = false;
var delta = 200;
$(window).resize(function() {
    rtime = new Date();
    if (timeout === false) {
        timeout = true;
        setTimeout(resizeend, delta);
    }
});

function resizeend() {
    if (new Date() - rtime < delta) {
        setTimeout(resizeend, delta);
    } else {
        timeout = false;
        fct();
        
        
        
    }               
}
    
    
    
}

function resizeContent()
{
    var content = $("#content");
        var height = $("#global").height()-($("#banniere").height()+$("#menu").height()+$("#footer").height());
        
       
        
        content.height(height);
}


function dialog(param)
{
    displayOverlay();
    
    $("body").append("<div id='dialog'></div>");
    
    var dialog = $("#dialog");
    
    dialog.prepend("<div class='dialogTitle'><div class='closeDialog'></div></div>");
    dialog.find(".closeDialog").on("click",function()
    {
       closeDialog();

    });
    
   
    
    dialog.width(param["width"]);
    dialog.height(param["height"]);
    
    var top = ($(window).height()-param["height"])/2;
    var left = ($(window).width()-param["width"])/2;
    
    
    dialog.css("top",top+"px");
    dialog.css("left",left+"px");
    
    
    
    resize(function()
            {
                
                
                 var dialog = $("#dialog");
                 
                 var top = ($(window).height()-param["height"])/2;
                 var left = ($(window).width()-param["width"])/2;
    
    
                 dialog.animate(
                         {
                             "top":top,
                             "left":left
                         });
                 
                
            });
    
}

function displayOverlay()
{
    if($("#overlay").length === 0)
    {
         $("body").prepend("<div id='overlay'></div>");
    }
   
    $("#overlay").fadeIn();
}


function closeDialog()
{
     var dialog = $("#dialog");
     dialog.remove();
     removeOverlay();
}


function removeOverlay()
{
    $("#overlay").fadeOut();
}


function displayWaiting()
{
    if($("#overlayWaiting").length === 0)
    {
         $("body").prepend("<div id='overlayWaiting'></div>");
         $("body").prepend("<div id='waitingLoader' class='waiting' ></div>");
         $(".waiting").css("top",$(window).height()/2-25+"px");
         $(".waiting").css("left",$(window).width()/2-25+"px");
    }
    
    $("#waitingLoader").show();
    $("#overlayWaiting").fadeIn();
}

function removeWaiting()
{
     $("#waitingLoader").hide();
     $("#overlayWaiting").fadeOut();
}


function addPhoto(idCateg)
{
    dialog({
        height : 250,
        width : 500
    });
    
    $.ajax({
   type: "POST",
   url: "../vues/photoManager/addPhotoForm.php",
   data: {
       idCateg : idCateg
   },
   success: function(msg){
     
     $("#dialog").append(msg);
   }
 });
}

function addPhotoValid()
{
    
   

    error = false;
    var bloc = $("#managePhotoForm");
    
    var files = new Array();
    
    
    var action = bloc.find("#action").val();
    var name = bloc.find("#namePhoto").val();
    var idCateg = bloc.find("#categ").val();
    
    var file_data = bloc.find("#photo").prop("files");  
    
    
    
    var form_data = new FormData();  
    
    error = error || fieldError(bloc.find("#namePhoto"),isNullOrWhiteSpace(name));
  
    error = error || fieldError(bloc.find("#categ"),isNullOrWhiteSpace(idCateg) || idCateg == 0);
    
    error = error || fieldError(bloc.find("#photo"),typeof(file_data)==='undefined');
    
    if(error)
        return;
       
    
     for(var i = 0 ; i<file_data["length"];i++)
    {
      form_data.append("file"+i, file_data[i]);
     
    }
    
    
    form_data.append("action", action);
    form_data.append("name", name);
    form_data.append("idCateg", idCateg);
    
             
    if(bloc.find("#idPhoto").length===1)
        form_data.append("idPhoto", bloc.find("#idPhoto").val());
    
    displayWaiting();
    
    $.ajax({
                url: "../vues/photoManager/managePhoto.php",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data ,                         
                type: 'post',
                success: function(data){
                    removeWaiting();
                    
                
                    
                    var result = JSON.parse(data);
                   
                   
                   
                   
                    if(result["ok"])
                    {
                    
                        $("#galerie"+idCateg).append(result["photo"]);
                        initGallerie();
                    }
                    else
                         $("#dialog").append(result["error"]); 
                    
                    
                   
                    closeDialog();
                    
                }
     });
    
    
}



function afficherVariable(a)
{
    var monArraySeria = "";
    for (var i in a)
    {
        /* On fais ce qu'on veux.. */
        /* Exemple: */
        // alert('Key: ' + i + "\r\nValeur: " + monArray[i]);
        // ou:
        monArraySeria += 'Key: ' + i + '; Valeur: ' + a[i] + "\r\n";

    }
    alert(monArraySeria);
}


function isNullOrWhiteSpace(chaine)
{
    return chaine.trim()==="";
}


function fieldError(field,error)
{
    if(error)
        field.css("background-color","red");
    else
        field.css("background-color","white");
    
    return error;
}


function initGallerie()
{
    
    $(".photoGalerie").each(function()
    {
        
        var bloc = $(this);
        
        $(this).find("img").mouseenter(function()
        {
            
            bloc.find(".photoTitle").slideDown();
        });
    
         $(this).find("img").mouseout(function()
        {
            bloc.find(".photoTitle").slideUp();
        });
    
    });
    
}


function deletePhoto(id)
{
    var name = $("#photo"+id).find("span").text();
    var ok = confirm("Êtes vous sur de vouloir supprimer la photo : "+name);
    
    var data = {
        action : "delete",
        id : id
    };
    
    
    if(ok)
    {
         $.ajax({
                url: "../vues/photoManager/managePhoto.php",
                dataType: 'text',
                data: data ,                         
                type: 'post',
                success: function(data){
                    
                  
                   
                    var result = JSON.parse(data);
                   
                    if(result["ok"])
                        $("#photo"+id).remove();
                    else
                         alert(result["error"]);
                    
                }
     });
        
       
    }
    
}


function editPhoto(id)
{
    var name = $("#photo"+id).find("span").text();
    
    
    dialog({
        height : 500,
        width : 500
    });
    
    $.ajax({
   type: "POST",
   url: "../vues/photoManager/addPhotoForm.php",
   data: {
       idPhoto : id
   },
   success: function(msg){
     
     $("#dialog").append(msg);
   }
 });
    
    
   
}

function editPhotoValid()
{
    error = false;
    var bloc = $("#managePhotoForm");
    
    var files = new Array();
    
    
    var action = bloc.find("#action").val();
    var name = bloc.find("#namePhoto").val();
    var idCateg = bloc.find("#categ").val();
    
    var file_data = bloc.find("#photo").prop("files");  
    
    
    
   
    
    
    var form_data = new FormData();  
    
    error = error || fieldError(bloc.find("#namePhoto"),isNullOrWhiteSpace(name));
  
    error = error || fieldError(bloc.find("#categ"),isNullOrWhiteSpace(idCateg) || idCateg == 0);
    
  
    
    if(error)
        return;
       
    
     for(var i = 0 ; i<file_data["length"];i++)
    {
      form_data.append("file"+i, file_data[i]);
     
    }
    
    
    form_data.append("action", action);
    form_data.append("name", name);
    form_data.append("idCateg", idCateg);
    
    var idPhoto = 0;
             
    if(bloc.find("#idPhoto").length===1)
    {
        idPhoto = bloc.find("#idPhoto").val();
        form_data.append("idPhoto",idPhoto );
        
    }
    
    displayWaiting();
    $.ajax({
                url: "../vues/photoManager/managePhoto.php",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data ,                         
                type: 'post',
                success: function(data){
                    
                     removeWaiting();
                    
                 
                    
                    var result = JSON.parse(data);
                   
                   
                   
                    if(result["ok"])
                    {
                       
                        // change categ
                        var actuelCateg = $("#photo"+idPhoto).parents(".galerie").first().attr("id").replace("galerie","");
                        
                       
                        if(idCateg == actuelCateg)
                        {
                                $("#photo"+bloc.find("#idPhoto").val()).replaceWith(result["photo"]);
                        }
                        else
                        {
                            $("#photo"+bloc.find("#idPhoto").val()).remove();
                              $("#galerie"+idCateg).append(result["photo"]);
                       
                            
                        }
                        
                        initGallerie();
                    }
                    else
                         $("#dialog").append(result["error"]); 
                    
                    
                   
                    closeDialog();
                    
                    
                    
                    
                    
                  
                }
     });
    
    
}

function initDatatable()
{
     $('.datatable').DataTable();
     
     $(".traduction").on("click",function()
     {
        
        var bloc = $(this); 
        if(bloc.find("input").length==0)
        {
             var text = bloc.text();
             bloc.html("<input onblur='saveTraduction(this)' type='text' value='"+text+"' />");
             bloc.find("input").focus();
        }
       
     });
}



function saveTraduction(elt)
{
    var bloc = $(elt);
    var text = bloc.val();
    var key = bloc.parents("tr").find("td").first().text();
    
     $.ajax({
                url: "../vues/traductionManager/manageTraduction.php",
                dataType: 'text',
                data: {key : key, text : text} ,                         
                type: 'post',
                success: function(data){
                    
                    
                    var result = JSON.parse(data);
                    if(result["ok"])
                    {
                       bloc.parents("td").text(text);
                    }
                    else
                         alert(result["error"]); 
                  
                }
     });
    
}



