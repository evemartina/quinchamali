$(function(){
	cargarTabla();
});

var url='../modelo/alfareras.php';
var url_productos='../modelo/productos.php';

function cargarSubCategorias($categoria){
	$.ajax({
		url:url_productos,
		data:{accion:'getSubCategorias'},
		type:'POST',
		success:function(res){
			console.log(res);
			r=JSON.parse(res);
			$.each(r,function(i,val){
			$('#getSubCategorias').append('<option value="'+val.id+'">'+val.nombre+'</option>')

			});
		}

	});

}



function cargarTabla(){
	tabla = $('#alfareras').DataTable( {		
		processing: true,
		 "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
			//serverSide: true,	
			order: [[5,"asc"]],
			autoWidth: false,
			ajax:{
				'url' : '../modelo/alfareras.php/',
				'type':'POST',
				'data':{accion:'getAlfareras'}	
			},			

			columns: [
			{ 
				data: "id",
				title:"Cod.",
				width:'5%'
			},
			{
				data: "nombre",
				title:"Nombre",
				width:'15%'
			},
			{
				data: "apellido",
				title:"Apellido",
				width:'15%'
			},
			{
				data: "biografia",
				title:"Biografia",
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

$("body").on("click",".acciones",function(){
	var ruta=$(this).attr('rel-accion');
	var id  = $(this).attr('rel-id');

	switch(ruta){
		case 'editar':

		$.ajax({
			url:url,
			type:'POST',
			data:{id:id,accion:'edit'},
			success:function (result) {
				var res =JSON.parse(result);
				console.log(res.alfarera)
				if(!res.error){
					agregarAlfarera('Editar Alfarera','editar',id);
					$('#form-add #nombre').val(res.alfarera.nombre);
					$('#form-add #apellido').val(res.alfarera.apellido);
					$('#form-add #biografia').val(res.alfarera.biografia);
					if(res.alfarera.foto!=''){
						console.log(res.alfarera.foto)
						$('#form-add #foto').parent('div').append('<img src="../upload/perfiles/'+res.alfarera.foto+'" width="50">');
					}
				}
			}
		})
		break;
		case 'productos':
		texto='';
		id=$(this).attr('rel-id');
		$(".modal-title").html('Fotos Productos Artesanas');
		$('#contenido').html($('#productos').html());
		$('#contenido>form').attr('id','form-productos');
		$('#contenido>form').attr('enctype',"multipart/form-data")
		$(".modal-footer").html('<button type="button" class="btn btn-primary" onclick="subir('+id+')">Guardar</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>')
		$("#modalContenido").modal('show');


		break;
		case 'eliminar':
		var estado = $(this).attr('rel-estado');
		$.confirm({
			title: 'Confirmar!',
			content: 'Esta seguro que desea cambiar estado Alfarera!',
			buttons: {
				confirmar: function () {
					       // $.alert('Confirmed!');
					       $.ajax({
					       	url:url,
					       	type:'POST',
					       	data:{id:id,estado:estado,accion:'eliminarAlfarera'},
					       	success:function(resp){
					       		console.log(resp)
					       		if(resp){					      								      			
					       			$("#alfareras").dataTable().fnDestroy();
					       			cargarTabla();
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

function verFoto(foto){
		//$.alert(foto);
		$(".modal-title").html('Foto Artesanas');
		$("#contenido").html('<img src="../upload/perfiles/'+foto+'" width="550">');
		$('#contenido').addClass('text-center');
		$(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>');
		$("#modalContenido").modal('show');

	}
	function agregarAlfarera(titulo,btn,id){
		if(id!=0){
			params=id;
		}else{
			params='';
		}
		$(".modal-title").html(titulo);
		$("#contenido").html($("#formulario_alfareras").html());
		$('#contenido>form').attr('id','form-add');
		$('#contenido>form').attr('enctype',"multipart/form-data")
		$('#contenido').removeClass('text-center');
		$(".modal-footer").html('<button type="button" class="btn btn-primary" onclick="'+btn+'('+params+')">Guardar</button> <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>')
		$("#modalContenido").modal('show');
	}
	function guardarAlfarera(){		
		var data = new FormData();
		var error=[];
		var form_data = $("#form-add").serializeArray();
		$.each(form_data, function (key, input) {
			if(input.value==''){
				$("#"+input.name).addClass('error');
				error.push(input.name)
			}else{
				data.append(input.name, input.value);
				$("#"+input.name).removeClass('error');
			}

		});
		var file_data = $("#form-add").find('input:file')[0].files;
		if(file_data.length>0){
			 $("#form-add").find('input:file').removeClass('error');
			for (var i = 0; i < file_data.length; i++) {
				data.append("foto[]", file_data[i]);
			}
		}else{
			error.push('foto');
			 $("#form-add").find('input:file').addClass('error');
		}

		
		data.append('accion','guardarAlfarera');
		if(error.length >0){
			return false;

		}
		$.ajax({
			url:url,
			type:'POST',
			contentType:false,
			cache:false,
			processData:false,
			data: data, 
			success:function (resp) {
				var respuesta=JSON.parse(resp);		        	
				if(!respuesta.error && !respuesta.error_foto){
					$("#modalContenido").modal('hide');
					$("#alfareras").dataTable().fnDestroy();
					cargarTabla();
					respuestaAlert('success','Agregar Alfarera','  Alfarera ingresada con exito');
					setTimeout(function(){$("#alerta_response").alert('close')},2000);
					
				}else{
					respuestaAlert('danger','Agregar Alfarera','  Alfarera no fue ingresada intente nuevamente');
					setTimeout(function(){$("#alerta_response").alert('close')},2000);
				}
			}     
		})

	}
	function editar(id){	
		console.log('editar'+id)	
		var data = new FormData();
		var error=[];
		var form_data = $("#form-add").serializeArray();
		$.each(form_data, function (key, input) {
			if(input.value==''){
				$("#"+input.name).addClass('error');
				error.push(input.name)
			}else{
				data.append(input.name, input.value);
				$("#"+input.name).removeClass('error');
			}

		});
		var file_data = $("#form-add").find('input:file')[0].files;
		if(file_data.length>0){			
			for (var i = 0; i < file_data.length; i++) {
				data.append("foto[]", file_data[i]);
			}
		}		
		data.append('accion','updateAlfarera');
		data.append('id',id);
		if(error.length >0){			
			return false;
		}
		$.ajax({
			url:url,
			type:'POST',
			contentType:false,
			cache:false,
			processData:false,
			data: data, 
			success:function (resp) {
				console.log(resp);
				var respuesta=JSON.parse(resp);		        	
				if(!respuesta.error && !respuesta.error_foto){
					$("#alfareras").dataTable().fnDestroy();
					cargarTabla();
					$("#modalContenido").modal('hide');
 					respuestaAlert('success','Agregar Alfarera','  Alfarera actualizada con exito');
					setTimeout(function(){$("#alerta_response").alert('close')},2000);
					
				}else{
					respuestaAlert('danger','Agregar Alfarera','  Alfarera no fue actualizada intente nuevamente');
					setTimeout(function(){$("#alerta_response").alert('close')},2000);
				}
			}     
		})

	}
	function respuestaAlert(tipo,titulo,texto){
		var mensaje='';
		mensaje+='<div class="alert alert-'+tipo+' alert-dismissible fade show" role="alert" id="alerta_response">';
		mensaje+='<strong>'+titulo+'!</strong>'+texto;
		mensaje+='<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
		mensaje+='<span aria-hidden="true">&times;</span>';
		mensaje+='</button>';
		mensaje+='</div>';
		$("#respuestas").html(mensaje);

	}

	
	
	

