function ajaxListas(link,args,resul){

    a=nuevoAjax();
    a.open("POST", link,true);
    a.onreadystatechange = callback;
    a.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    a.send(args);

    function nuevoAjax(){
        var xmlhttp;
        try{
            xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e){
            try{
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e){
                try{
                    xmlhttp = new XMLHttpRequest();
                }
                catch(e){
                    xmlhttp = false;
                }
            }
        }
        if (!xmlhttp)
            return null;
        else
            return xmlhttp;
    }

    function callback() {
        if (a.readyState==1)
        {
            //resul.innerHTML= "<div class=imagenes><img src='img/loading.gif'></div>";
        }
         
        if (a.readyState==4) {
	    resul.innerHTML = a.responseText;

        }
    }
}


function nivel1OnChange(){

   link="inc/busqueda.php";
   var nivel1List = document.getElementById("nivel1List");
   var selectedNivel1 = nivel1List.options[nivel1List.selectedIndex].value;
   resul=document.getElementById("nivel2List");
   ajaxListas(link,"busqueda="+selectedNivel1,resul);
   var nivel3List = document.getElementById("nivel3List");
   nivel3List.innerHTML = "<option value=0>--</option>";
   var nivel4List = document.getElementById("nivel4List");
   nivel4List.innerHTML = "<option value=0>--</option>";
   var nivel5List = document.getElementById("nivel5List");
   nivel5List.innerHTML = "<option value=0>--</option>";
   var nivel6List = document.getElementById("nivel6List");
   nivel6List.innerHTML = "<option value=0>--</option>";
}


function nivel2OnChange(){

   link="inc/busqueda.php";
   var nivel2List = document.getElementById("nivel2List");
   var selectedNivel2 = nivel2List.options[nivel2List.selectedIndex].value;
   resul=document.getElementById("nivel3List");
   ajaxListas(link,"busqueda="+selectedNivel2,resul);

}


