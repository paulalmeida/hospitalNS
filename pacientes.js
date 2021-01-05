$(".DT").on("click", ".EditarPaciente", function(){

	var personaId = $(this).attr("personaId");
	var datos = new FormData();

	$('input[type=checkbox]').prop('checked',false);
	datos.append("txt-per-id", personaId);

	$.ajax({

		url: "Ajax/personasAjax.php",
		method: "POST",
		data: datos,
		dataType: "json",
		contentType: false,
		cache: false,
		processData: false,

		success: function(result) { //we got the response

			$("#txt-per-id").val(result.Id);
			$("#txt-per-cedula").val(result.Cedula);
			$("#txt-per-nombre").val(result.Nombre);
			$("#txt-per-apellido").val(result.Apellido);
			$("#txt-per-email").val(result.Email);
			$("#txt-per-telefono").val(result.Telefono);
			$("#txt-per-ciudad").val(result.Ciudad);
			$("#txt-per-direccion").val(result.Direccion);
			$("#txt-per-fechaNacimiento").val(result.FechaNacimiento);
			$("#cbx-per-genero").val(result.Genero);

         },
         error: function(jqxhr, status, exception) {
             alert('Exception manejada por el sistema :', exception);
         }

	})

});



$(".DT").on("click", ".EliminarPaciente", function(){

	var personaId = $(this).attr("personaId");

	window.location = "index.php?url=pacientes&deleteId="+personaId;

});




$("#btn-per-nuevo").off();
$("#btn-per-nuevo").click(function () {

	$('input[type=checkbox]').prop('checked',false);
	
	$("#txt-per-id").val("");
			$("#txt-per-cedula").val("");
			$("#txt-per-nombre").val("");
			$("#txt-per-apellido").val("");
			$("#txt-per-email").val("");
			$("#txt-per-telefono").val("");
			$("#txt-per-ciudad").val("");
			$("#txt-per-direccion").val("");
			//$("#txt-per-fechaNacimiento").val("");
			$("#cbx-per-genero").val("M");    
});