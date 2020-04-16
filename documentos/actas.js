
$(document).ready(function() {    
	$('select#serie').on('change',function(){
    var valor = $(this).val();

    if(valor == 23)
	$('#copias').val(2);
	
	else
	    if(valor == 22)
           $('#copias').val(2);
		   else
		   $('#copias').val(1);
});		   
	
	

						   });


	function vaciar(control)
{
  control.value='';
}



function habilita(){ 
if(document.alta_doc.numeroDoc.disabled == false) { 
document.alta_doc.numeroDoc.disabled = true; 
document.alta_doc.numeroDoc.value=''; 


} else { 
document.alta_doc.numeroDoc.disabled = false; } 

} 