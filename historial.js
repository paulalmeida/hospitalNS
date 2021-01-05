$(".DT").on("click", ".EliminarCita", function(){

	var idUsuario = $("#txt-historial-idUsuario").val();


	var citaID = $(this).attr("citaId");

	//window.location = idUsuario + "&deleteId="+citaID;
	window.location = "../index.php?url=historial/"+ idUsuario +"&deleteId="+ citaID;
});