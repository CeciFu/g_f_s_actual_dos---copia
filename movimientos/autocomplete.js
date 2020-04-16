

$(document).ready(function() {    
 
 var array = Array(11);


	if($('#tipoUsuario').val()!=1&&$('#tipoUsuario').val()!=4)
	{

		var sector = $('#idSectorUsuario').val();
		$('select#nivel3List option:selected').prop('selected',false);
		$('select#nivel3List option[value ='+sector+' ]').prop('selected',true);
		$('select#nivel3List option:not(:selected)').attr('disabled', true);


	}




$( "#remito" ).submit(function( event ) {
							  var vacio = false; 
							   var i =1;
							   while(i<array.length)
							   {
								   if($('#documento'+i).val()== "")
								   {
									  
									   vacio = true;
								   i++;
								   }
								   else
								   {
									  
									  break;
								   }
									   
									
							}
							   
								   if(vacio)
								   {alert( "Debe haber al menos un documento cargado en el remito" );
									  event.preventDefault();}
});
 
 
 
   $('#documento1').autocomplete({
  		  minLength: 2,
		  source: "autocomplete.php",
		 select: function (event, ui) {
			 var hojas = ui.item.folios;
      	  	$('#idDoc1').val(ui.item.id); // save selected id to hidden input
			$('#anio1').val(ui.item.anio);
			$('#folios1').val(ui.item.folios);
			$('#folios1').on('change', function(){
												if($(this).val()< hojas)
												{
													alert("El documento no puede cargarse con una cantidad de folios menor a la que tenía");
													$('#folios1').val(ui.item.folios);
												}
												});
			if($('#tipoUsuario').val()==1||$('#tipoUsuario').val()==4)
			{
				$('select#nivel3List option:selected').prop('selected',false);
				$('select#nivel3List option[value ='+ui.item.sector+' ]').prop('selected',true);
			}

										array[1] = $('#idDoc1').val();
										for(i=2;i<array.length;i++)
										{
											
											if(array[i] == array[1])
											alert("El valor ya se encuentra repetido en el documento"+ i);
										}
    	}
		 
    });
   

	
	$('#documento2').autocomplete({
		  minLength: 2,
		  source: "autocomplete.php",
		 select: function (event, ui) {
			 var hojas = ui.item.folios;
        $('#idDoc2').val(ui.item.id); // save selected id to hidden input
		$('#anio2').val(ui.item.anio);
		$('#folios2').val(ui.item.folios);
		$('#folios2').on('change', function(){
												if($(this).val()< hojas)
												{
													alert("El documento no puede cargarse con una cantidad de folios menor a la que tenía");
													$('#folios2').val(ui.item.folios);
												}
												});
		
		
												array[2] = $('#idDoc2').val();
										for(i=1;i<array.length;i++)
										{
											if(i!=2)
											if(array[i] == array[2])
											alert("El valor ya se encuentra repetido en el documento "+ i);
										}
		 }
    });
	
	
	$('#documento3').autocomplete({										  
		  minLength: 2,
source: "autocomplete.php",
		 select: function (event, ui) {
			 var hojas = ui.item.folios;
        $('#idDoc3').val(ui.item.id); // save selected id to hidden input
		$('#anio3').val(ui.item.anio);
		$('#folios3').val(ui.item.folios);
		$('#folios3').on('change', function(){
												if($(this).val()< hojas)
												{
													alert("El documento no puede cargarse con una cantidad de folios menor a la que tenía");
													$('#folios3').val(ui.item.folios);
												}
												});
												array[3] = $('#idDoc3').val();
																				for(i=1;i<array.length;i++)
										{
											if(i!=3)
											if(array[i] == array[3])
											alert("El valor ya se encuentra repetido en el documento "+ i);
										}
		 }
    });
	
	
	$('#documento4').autocomplete({										  
		  minLength: 2,
source: "autocomplete.php",
		 select: function (event, ui) {
			 var hojas = ui.item.folios;
        $('#idDoc4').val(ui.item.id); // save selected id to hidden input
		$('#anio4').val(ui.item.anio);
		$('#folios4').val(ui.item.folios);
		$('#folios4').on('change', function(){
												if($(this).val()< hojas)
												{
													alert("El documento no puede cargarse con una cantidad de folios menor a la que tenía");
													$('#folios4').val(ui.item.folios);
												}
												});
												array[4] = $('#idDoc4').val();
                                        for(i=1;i<array.length;i++)
										{
											if(i!=4)
											if(array[i] == array[4])
											alert("El valor ya se encuentra repetido en el documento "+ i);
										}
		 }
		 
    });
	
	
	$('#documento5').autocomplete({										  
		  minLength: 2,
source: "autocomplete.php",
		 select: function (event, ui) {
			 var hojas = ui.item.folios;
        $('#idDoc5').val(ui.item.id); // save selected id to hidden input
		$('#anio5').val(ui.item.anio);
		$('#folios5').val(ui.item.folios);
		$('#folios5').on('change', function(){
												if($(this).val()< hojas)
												{
													alert("El documento no puede cargarse con una cantidad de folios menor a la que tenía");
													$('#folios5').val(ui.item.folios);
												}
												});
												array[5] = $('#idDoc5').val();
					                    for(i=1;i<array.length;i++)
										{
											if(i!=5)
											if(array[i] == array[5])
											alert("El valor ya se encuentra repetido en el documento "+ i);
										}
		 }
    });
	
	
	$('#documento6').autocomplete({										  
		  minLength: 2,
source: "autocomplete.php",
		 select: function (event, ui) {
			 var hojas = ui.item.folios;
        $('#idDoc6').val(ui.item.id); // save selected id to hidden input
		$('#anio6').val(ui.item.anio);
		$('#folios6').val(ui.item.folios);
		$('#folios6').on('change', function(){
												if($(this).val()< hojas)
												{
													alert("El documento no puede cargarse con una cantidad de folios menor a la que tenía");
													$('#folios6').val(ui.item.folios);
												}
												});
												array[6] = $('#idDoc6').val();
										for(i=1;i<array.length;i++)
										{
											if(i!=6)
											if(array[i] == array[6])
											alert("El valor ya se encuentra repetido en el documento "+ i);
										}
		 }
    });
	

	
	$('#documento7').autocomplete({										  
		  minLength: 2,
source: "autocomplete.php",
		 select: function (event, ui) {
			 var hojas = ui.item.folios;
        $('#idDoc7').val(ui.item.id); // save selected id to hidden input
		$('#anio7').val(ui.item.anio);
		$('#folios7').val(ui.item.folios);
		$('#folios7').on('change', function(){
												if($(this).val()< hojas)
												{
													alert("El documento no puede cargarse con una cantidad de folios menor a la que tenía");
													$('#folios7').val(ui.item.folios);
												}
												});
												array[7] = $('#idDoc7').val();
																				for(i=1;i<array.length;i++)
										{
											if(i!=7)
											if(array[i] == array[7])
											alert("El valor ya se encuentra repetido en el documento "+ i);
										}
		 }
    });
	

	$('#documento8').autocomplete({										  
		  minLength: 2,
source: "autocomplete.php",
		 select: function (event, ui) {
			 var hojas = ui.item.folios;
        $('#idDoc8').val(ui.item.id); // save selected id to hidden input
		$('#anio8').val(ui.item.anio);
		$('#folios8').val(ui.item.folios);
		$('#folios8').on('change', function(){
												if($(this).val()< hojas)
												{
													alert("El documento no puede cargarse con una cantidad de folios menor a la que tenía");
													$('#folios8').val(ui.item.folios);
												}
												});
												array[8] = $('#idDoc8').val();
																				for(i=1;i<array.length;i++)
										{
											if(i!=8)
											if(array[i] == array[8])
											alert("El valor ya se encuentra repetido en el documento "+ i);
										}
		 }
    });
	
	
	$('#documento9').autocomplete({										  
		  minLength: 2,
source: "autocomplete.php",
		 select: function (event, ui) {
			 var hojas = ui.item.folios;
        $('#idDoc9').val(ui.item.id); // save selected id to hidden input
		$('#anio9').val(ui.item.anio);
		$('#folios9').val(ui.item.folios);
		$('#folios9').on('change', function(){
												if($(this).val()< hojas)
												{
													alert("El documento no puede cargarse con una cantidad de folios menor a la que tenía");
													$('#folios9').val(ui.item.folios);
												}
												});
												array[9] = $('#idDoc9').val();
																				for(i=1;i<array.length;i++)
										{
											if(i!=9)
											if(array[i] == array[9])
											alert("El valor ya se encuentra repetido en el documento "+ i);
										}
		 }
    });
	
	$('#documento10').autocomplete({										  
		  minLength: 2,
source: "autocomplete.php",
		 select: function (event, ui) {
			 var hojas = ui.item.folios;
        $('#idDoc10').val(ui.item.id); // save selected id to hidden input
		$('#anio10').val(ui.item.anio);
		$('#folios10').val(ui.item.folios);
		$('#folios10').on('change', function(){
												if($(this).val()< hojas)
												{
													alert("El documento no puede cargarse con una cantidad de folios menor a la que tenía");
													$('#folios10').val(ui.item.folios);
												}
												});
												array[10] = $('#idDoc10').val();
																				for(i=1;i<array.length;i++)
										{
											if(i!=10)
											if(array[i] == array[10])
											alert("El valor ya se encuentra repetido en el documento "+ i);
										}
		 }
    });
	



	
});    
