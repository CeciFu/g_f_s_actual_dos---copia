$(document).ready(function() {  
						   $('#form1').submit(function(event){
													   var vacio = false;

 							if (!$('input[name="funciones"]').is(':checked')) {
						        alert('Se debe seleccionar por lo menos una función');
								event.preventDefault();
							    }

							});
});