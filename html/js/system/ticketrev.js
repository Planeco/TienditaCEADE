	
	$(document).ready(function()
	{
		iniciarControles();
	});
	
	
	function iniciarControles(){
		$.ajax({
			method : "post",
			url : "admintickets.php",
			data : {
				tipotickets:''
			},
			success : function(data) {
				//respuesta=JSON.parse(data);
				$( "#slcCategorias" ).html(data);
			}
		});
		
		$('#slcCategorias').change(function(){
  		  mostrarUsers();
        });
  	  $('#btnGuardar').click(opciones_ticket);
//  	  $("#frmLogin").submit(opciones_ticket); 
  	  $('#btnCancelar').click(function(){
  		  window.location="ticket.php";
        });
  	  
  	  
   $('#btnCerrar').click(function(){
  	 cerrar_reabrir('cerrar')
      });
   $('#btnReabrir').click(function(){
  	 cerrar_reabrir('reabrir')
      });
        
	}
	
	function cerrar_reabrir(operacion){
		mostrarAviso('Procesando solicitud...');
		var movTicket={};
		movTicket['id_ticket']=$('#IdTicket_').val();
		movTicket['id_solicitante']=$('#IdAsignado_').val();
		movTicket['titulo']= $('#hdTitulo').val();
		xajax_movimiento(operacion,movTicket);
		
	}
	function opciones_ticket(){
		
		
		var datos ={};
		datos['estatus']= $('#txtEstatus').val();
		datos['idPerfil']= $('#IdAsignado_').val();
		datos['id_ticket']= $('#IdTicket_').val();
		datos['titulo']= $('#hdTitulo').val();
		var movTicket={};

		var editorData = editor.getData();
		datos['resumen']= editorData.replace(/&nbsp;/gi,' ');
		if (datos['estatus']=='3'|| datos['estatus']=='2')
			datos['perfilAsignado']=$('#txtAsignacion1').val();	
		else{ 
			datos['perfilAsignado']= $('#slcPersonal').val();
		}
		
		var trs = $("#tb1 tr").length;
	    var ruta =[], descripcion=[];
	    var num=0;
	    for (num = 0; num <= trs; num++) {
			if ($("#divTabla tr[id^=fila" + num + "]").attr('id')) {
				ruta.push($("#ruta_archivo" + num).val().trim());
				descripcion.push($("#descripcion" + num).val().trim());
			}
	    }
	if(datos['perfilAsignado']==""){
	mostrarAviso('<p><i class="fa fa-pencil"></i> Se debe asignar el ticket.</p>');
	return false;
	}

	if(datos['resumen']==""){
	mostrarAviso('<p><i class="fa fa-pencil"></i> Su mensaje debe contener al menos 5 caracteres.</p>');
	return false;
	}

		movTicket['estatus']=datos['estatus'];
		movTicket['informacion']=datos;
		movTicket['ruta']=ruta;
		movTicket['descripcion']=descripcion;

		mostrarAviso('Enviando datos de ticket...');
		
		xajax_movimiento('movimiento',movTicket);
		

	}


	      function mostrar_opciones(tipo){
	        $('.opciones').removeClass('btn-success');
	        
	        if(tipo=='enterado'){
	        	$('#txtEstatus').val('2');
	          $('a.enterado').addClass('btn-success');
	        }

	        if(tipo=='responder'){
	        	$('#txtEstatus').val('8');
	          $('a.responder').addClass('btn-success');
	        }
	        
	        if(tipo=='reasignar'){
	        	$('#txtEstatus').val('4');
	          $('a.reasignar').addClass('btn-success');
	        }

	        if(tipo=='comentario'){
	        	$('#txtEstatus').val('3');
	          $('a.comentario').addClass('btn-success');
	        }

	        if(tipo=='resolver'){
	        	$('#txtEstatus').val('5'); 
	          $('a.resolver').addClass('btn-success');
	        }
	        
	        
	        $('#divCat').hide();
	        if(tipo=='enterado' || tipo=='comentario'){
	          $('#contenedor_agregar_archivos').hide();
	          $('#contenedor_opciones_extra').hide();
	          $('#contenedor_general').show();
	        }else if(tipo=='responder' || tipo=='resolver' || tipo=='reasignar'){
	          $('#contenedor_agregar_archivos').hide();
	          $('#contenedor_opciones_extra').show();
	          $('#contenedor_general').show();
	     
	  //   mostrarUsers();
	        }
	        
	        if(tipo=='responder' || tipo=='reasignar'){
	          $('#contenedor_agregar_archivos').show();
	        }

			if(tipo=='resolver'){
	          $('#txtEstatus').val('5');
	        }
	        
			if(tipo=='reasignar'){
				$('#divCat').show();
		        }
		/*	if(tipo=='responder'){
				var idA=$('#IdAsignado_').val();
				$.ajax(
	                    {
	                    	method:"post",
	            					url: "admincuentas.php",  					
	            					data: 
	            					{  						
	                        id_asignado : idA
	            					},
	            					success: function(data) 
	            					{
	                					
	            	          $('#slcPersonal').html(data);
	            	          $('#slcPersonal').removeAttr('disabled');
	            	   		}
	          		    });
				
		        }
	      */
			if(tipo=='responder'||tipo=='resolver'){
				var idA=$('#IdAsignado_').val();
				$.ajax(
	                    {
	                    	method:"post",
	            					url: "admintickets.php",  					
	            					data: 
	            					{  						
	                        responder : idA
	            					},
	            					success: function(data) 
	            					{
	                					
	            	          $('#slcPersonal').html(data);
	            	          $('#slcPersonal').removeAttr('disabled');
	            	   		}
	          		    });
				
		        }
	      
		
		    	        
	      }
	      
	function agregar_archivo(){
	  
	  var tamano = $('.row_tabla').length;
	  var descripcion = $('#txtDescripcionImagen').val();

	  var rand = Math.floor((Math.random()*10000)+999);
	  var formData = new FormData();
	  var inputFileImage = document.getElementById('archivoImagen');
	  var file = inputFileImage.files[0];

	if(file!=undefined &&descripcion!=''){
		$('#tablaArchivos').show();
	  formData.append('imagen',file);
	  formData.append('id',rand);
	$.ajax({
	      url: 'admintickets.php',  
	      type: 'POST',
	      // Form data
	      //datos del formulario
	      data: formData,
	      //necesario para subir archivos via ajax
	      cache: false,
	      contentType: false,	
	      processData: false,
	      //
	      //una vez finalizado correctamente
	      success: function(data){
	    	  if(data){
	          var fila='<tr class="row_tabla" id="fila'+tamano+'">'+
				'<td colspan="2" scope="rt-hide-td" data-rt-column="Archivo">'+
				'<input type="hidden" id="ruta_archivo'+tamano+'" value="'+rand+'_'+file.name+'" />'+file.name+'</td>'+
				'<td colspan="3" scope="rt-hide-td" data-rt-column="Descripcion">'+
				'<input type="hidden" id="descripcion'+tamano+'" value="'+descripcion+'" />'+descripcion+'</td>'+
				'<td scope="rt-hide-td" data-rt-column="Opciones">'+
				'<a href="javascript:quitar_archivo('+tamano+');" class="btn btn-default btn-circle"><i class="fa fa-trash-o"></i> </a></td>'+
			'</tr>';
	 $('#contenedor_tabla').append(fila);
	    	  }else{
	    		  mostrarError('Ocurri&oacute; un problema al subir la imagen');
	    	  }
	 $('#txtDescripcionImagen').val('');
	 $('#archivoImagen').val('');
	    	  
	      }
	  });
	}else{
		  if(file==undefined){
	        var msjError=' Debe seleccionar un archivo';
	    }else if(descripcion==''){
	        var msjError='Debe escribir una descripci&oacute;n';
	    }
		  mostrarError(msjError);
		  }
	                        
	};

	function quitar_archivo(id){
		  
	  $('#fila'+id).remove();
	  if($('.row_tabla').length==0){
	  	$('#tablaArchivos').hide();
	  	
	  }
	}        

	          function mostrarUsers(){
	        	     
	        	  var actual = $('#slcCategorias').val();
	              if(actual==""){
	            		  $('#slcPersonal').html('<option value="">Seleccione una opci&oacute;n</option>');
	                	  $('#slcPersonal').attr('disabled');
	                }else{
	                	$.ajax({
	            			method : "post",
	            			url : "admintickets.php",
	            			data : {
	            				tipoticket:actual,
	            				asignacion:1
	            			},
	            			success : function(data) {
	            				respuesta=JSON.parse(data);
	            				//if(asig==1){
	            					$( "#slcPersonal" ).html(respuesta['info']);
//	            				}
	            			}
	            		});
	            		
	                }
	            	  /*
	             $.ajax(
	                      {
	                      	method:"post",
	              					url: "admincuentas.php",  					
	              					data: 
	              					{  						
	                          id_servicio : actual       
	              					},
	              					success: function(data) 
	              					{
	              	          $('#slcPersonal').html(data);
	              	          $('#slcPersonal').removeAttr('disabled');
	              	        
	              	   		}
	            		    }); */
	              }
	                

