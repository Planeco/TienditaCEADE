	
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
				$( "#slcTipoSolicitud" ).html(data);
			}
		});
		
		$( "#slcTipoSolicitud" ).change(listaAsignacion);
		
		$('#btnSubir').click(function(){
	    	agregar_archivo();
	    });
	    
	    $('#btnGuardar').click(guardaTicket);
	//(    $("#frmLogin").submit(guardaTicket);
	    
	    $('.datepicker').datepicker({
	      dateFormat:'yy-mm-dd' ,
	      minDate : '0D'
	    });      
	    

	}

	function listaAsignacion(){
		var asig=$( "#hdnAsignacion" ).val();
		var tticket=$( "#slcTipoSolicitud" ).val();
		
		if(tticket!="")
		$.ajax({
			method : "post",
			url : "admintickets.php",
			data : {
				tipoticket:tticket,
				asignacion:asig
			},
			success : function(data) {
				respuesta=JSON.parse(data);
				if(asig==1){
					$( "#slcAsignacion" ).html(respuesta['info']);
				}else{
					$( "#txtAsignacion" ).val(respuesta['info']);
					$( "#slcAsignacion" ).val(respuesta['id']);
				}
			}
		});
		else{
			if(asig==1){
				$( "#slcAsignacion" ).html("");
			}else{
				$( "#txtAsignacion" ).val("");
				$( "#slcAsignacion" ).val("");
			}
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
		
		function guardaTicket(){
			var datos={};
			datos['perfilAsignado'] = $('#slcAsignacion').val();
			datos['estatus'] = 1; //fixed for new
			
			//datos['categoria'] = $('#slcCategorias').val();
			datos['prioridad'] = $('#slcPrioridad').val();
			  datos['tipoSolicitud'] = $('#slcTipoSolicitud').val();
			
//			        datos['fechaResolucion']= $('#txtFechaResolucion').val();
			
			              datos['titulo'] =$('#txtTitulo').val();
			              
			              var editorData = editor.getData();
			          	datos['resumen']= editorData.replace(/&nbsp;/gi,' ');

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
				mostrarAviso(' Se debe asignar el ticket.');
				return false;
			}

/*			if(datos['fechaResolucion']==""){
				mostrarAviso('<p><i class="fa fa-pencil"></i> Por favor agregue la fecha de resoluci&oacute;n.</p>');
				return false;
			}
	*/		
			if(datos['tipoSolicitud']==""){
				mostrarAviso('Por favor agregue un tipo de solicitud.');
				return false;
			}
			
			if(datos['titulo']==""){
				mostrarAviso('Por favor agregue un Asunto o T&iacute;tulo');
				return false;
			}
			if(datos['resumen']==""|| datos['resumen'].length<5){
				mostrarAviso('Su mensaje debe contener al menos 5 caracteres.');
				return false;
			}
			mostrarAviso('Enviando datos de ticket...');
			xajax_GuardarTicket(datos,ruta,descripcion);
	//			return false;
		}

