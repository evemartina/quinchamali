$(function(){
	cargarTablaNoticias();
});
var url_noticias='../../modelo/noticias.php';
function cargarTablaNoticias(){
		tabla = $('#noticias').DataTable( {		
			processing: true,
			 "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
			//serverSide: true,	
			order: [[5,"asc"]],
			autoWidth: false,
			ajax:{
				'url' : url_noticias,
				'type':'POST',
				'data':{accion:'getNoticias'}	
			},			

			columns: [
			{ 
				data: "id",
				title:"Cod.",
				width:'5%'
			},
			{
				data: "titulo",
				title:"Titulo",
				width:'15%'
			},
			{
				data: "subtitulo",
				title:"Subtitulo",
				width:'15%'
			},
			{
				data: "noticia",
				title:"Noticia",
				width:'43%'
			},	
			{ 
				data: "foto",
				title:"Foto",
				width:'10%'
			},	
			{ 
				data: "estado",
				title:"Estado",
				width:'10%'
			},	

			{ 
				data: "acciones" ,
				title:"Acciones",
				width:'2%'
			}
			],

		});
}
$("body").on("click",".acciones_noticias",function(){
	var ruta=$(this).attr('rel-accion');
	var id  = $(this).attr('rel-id');

	switch(ruta){
		case 'editar':
		$.ajax({
			url:url_noticias,
			type:'POST',
			data:{id:id,accion:'edit'},
			success:function (result) {
				var res =JSON.parse(result);
				console.log(result)
				if(!res.error){
					agregarNoticia('Editar Noticia','editarNoticia',id);
					$('#form-noticia #titulo').val(res.noticias.titulo);
					$('#form-noticia #subtitulo').val(res.noticias.subtitulo);
					$('#form-noticia #noticia').val(res.noticias.noticia);
					if(res.noticias.foto!=''){
						console.log(res.noticias.foto)
						$('#form-noticia #foto').parent('div').append('<img src="../../upload/noticias/'+res.noticias.foto+'" width="50">');
					}
				}
			}
		})
		break;
		case 'ver':

		break;
		case 'eliminar':
		var estado = $(this).attr('rel-estado');
		$.confirm({
			title: 'Confirmar!',
			content: 'Esta seguro que desea cambiar estado a Noticia!',
			buttons: {
				confirmar: function () {
					       // $.alert('Confirmed!');
					       $.ajax({
					       	url:url_noticias,
					       	type:'POST',
					       	data:{id:id,estado:estado,accion:'eliminarNoticia'},
					       	success:function(resp){
					       		console.log(resp)
					       		if(resp){					      								      			
					       			$("#noticias").dataTable().fnDestroy();
					       			cargarTablaNoticias();
					       			respuestaAlert('success','Cambiar Estado ','  Estado actualizado con exito');
					       			setTimeout(function(){$("#alerta_response").alert('close')},2000);
					       		}
					       	}
					       });
					   },
					   cancelar:function () {
					    	// body...
					    },					    
					}
				});
		break;



	}


});
function verFotoNoticia(foto){
	//$.alert(foto);
	$(".modal-title").html('Foto Artesanas');
	$("#contenido").html('<img src="../../upload/noticias/'+foto+'" width="550">');
	$('#contenido').addClass('text-center');
	$(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>');
	$("#modalContenido").modal('show');

}

	
function agregarNoticia(titulo,btn,id){
	if(id!=0){
		params=id;
	}else{
		params='';
	}
	$(".modal-title").html(titulo);
	$("#contenido").html($("#formulario").html());
	$('#contenido>form').attr('id','form-noticia');
	$('#contenido>form').attr('enctype',"multipart/form-data")
	$('#contenido').removeClass('text-center');
	$(".modal-footer").html('<button type="button" class="btn btn-primary" onclick="'+btn+'('+params+')">Guardar</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>')
	$("#modalContenido").modal('show');
}

function guardarNoticia(){		
	var data = new FormData();
	var error=[];
	var form_data = $("#form-noticia").serializeArray();
	$.each(form_data, function (key, input) {
		if(input.value==''){
			$("#"+input.name).addClass('error');
			error.push(input.name)
		}else{
			data.append(input.name, input.value);
			$("#"+input.name).removeClass('error');
		}

	});
	var file_data = $("#form-noticia").find('input:file')[0].files;

	for (var i = 0; i < file_data.length; i++) {
		data.append("foto[]", file_data[i]);
	}
	data.append('accion','guardarNoticia');
	console.log(error)	;
	if(error.length >0){			
		return false;
	}
	$.ajax({
		url:url_noticias,
		type:'POST',
		contentType:false,
		cache:false,
		processData:false,
		data: data, 
		success:function (resp) {
			var respuesta=JSON.parse(resp);		        	
			if(!respuesta.error && !respuesta.error_foto){
				$("#modalContenido").modal('hide');
				$("#noticias").dataTable().fnDestroy();
				cargarTablaNoticias();
				respuestaAlert('success','Agregar Noticia','  Noticia ingresada con exito');
				setTimeout(function(){$("#alerta_response").alert('close')},2000);
				
			}else{
				respuestaAlert('danger','Agregar Noticia','  Noticia no fue ingresada intente nuevamente');
				setTimeout(function(){$("#alerta_response").alert('close')},2000);
			}
		}     
	})

}
function editarNoticia(id){	
	console.log('editar'+id)	
	var data = new FormData();
	var error=[];
	var form_data = $("#form-noticia").serializeArray();
	$.each(form_data, function (key, input) {
		if(input.value==''){
			$("#"+input.name).addClass('error');
			error.push(input.name)
		}else{
			data.append(input.name, input.value);
			$("#"+input.name).removeClass('error');
		}

	});
	var file_data = $("#form-noticia").find('input:file')[0].files;
	if(file_data.length>0){			
		for (var i = 0; i < file_data.length; i++) {
			data.append("foto[]", file_data[i]);
		}
	}		
	data.append('accion','updateNoticia');
	data.append('id',id);
	if(error.length >0){			
		return false;
	}
	$.ajax({
		url:url_noticias,
		type:'POST',
		contentType:false,
		cache:false,
		processData:false,
		data: data, 
		success:function (resp) {
			console.log(resp);
			var respuesta=JSON.parse(resp);		        	
			if(!respuesta.error && !respuesta.error_foto){
				$("#modalContenido").modal('hide');
				$("#noticias").dataTable().fnDestroy();
				cargarTablaNoticias();
				respuestaAlert('success','Agregar Noticia','  Noticia actualizada con exito');
				setTimeout(function(){$("#alerta_response").alert('close')},2000);
				
			}else{
				respuestaAlert('danger','Agregar Noticia','  Noticia no fue actualizada intente nuevamente');
				setTimeout(function(){$("#alerta_response").alert('close')},2000);
			}
		}     
	})

}
