

function enviar()
	{
			var txtUsuario=$("#username").val().trim();
			var txtPass=$("#password").val();
			mostrarEspera("Solicitando acceso...");
			xajax_ingresar(txtUsuario,txtPass);
			return false;
	};
	
	
	
	$(document).ready(function()
	{
		$("#btnEnviar").click(enviar);
	});
	 

