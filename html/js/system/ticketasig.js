	
	$(document).ready(function()
	{
		$.ajax({
			method : "post",
			url : "admintickets.php",
			data : {
				ticketCampo2:'T.id_solicitante',
				ticketCampo1:'T.id_asignado'
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				if(respuesta[1]>0){
					$( "#divNiguno" ).hide();
					$( "#tablaTickets" ).show();
					xajax_muestraTabla(respuesta[0]);
				}else{
				
					$( "#tablaTickets" ).hide();
					$( "#divNiguno" ).show();
					}
				//$( "#tbodyTickets" ).html(respuesta['info']);
				
			}
		});
		
	});
	 
var abrirTicket=function(idT)
	{
	mostrarEspera('Abriendo ticket...');
	xajax_verTicket(idT);
	
  	 }
