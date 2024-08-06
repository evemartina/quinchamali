var url_productos='../modelo/productos.php';
var piesas=0;
$(function(){
	cargarTablaProductos();
});
function piesasSubidas(id,){
	console.log(id)
	res=0;
   $.ajax({
        url:url_productos,
        type:'POST',
        data:{accion:'getProductoById',id:id},
        success:function(res){
        	console.log(res)
        	data=JSON.parse(res);
        	devuelta(data.total);
        }
    })
}
function devuelta(total){
	piesas=total;
	 if(piesas>=3){
        $.alert({
    title: 'Piezas Alfarera',
        content: 'Alfarera ya cuenta con las piezas requeridas,para editar entrar a <a href="./pages/productos.php" >seccion productos</a>',
    });
        $("#modalContenido").modal('hide');
        return false;
    }
}
function cargarTablaProductos(){
	tabla = $('#productos_lista').DataTable( {		
		processing: true,
		 "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
			//serverSide: true,	
			order: [[5,"asc"]],
			autoWidth: false,
			ajax:{
				'url' : '../../modelo/productos.php',
				'type':'POST',
				'data':{accion:'getProductosTabla'}	
			},			

			columns: [
			{ 
				data: "id",
				title:"Cod.",
				width:'5%'
			},
			{ 
				data: "alfarera",
				title:"Alfarera.",
				width:'5%'
			},
			{
				data: "nombre",
				title:"Nombre",
				width:'15%'
			},
			{
				data: "descripcion",
				title:"Descripcion",
				width:'15%'
			},
			{
				data: "categoria",
				title:"Categoria",
				width:'43%'
			},	
			{ 
				data: "subCategoria",
				title:"Subcategoria",
				width:'10%'
			},	
			{ 
				data: "pieza",
				title:"Pieza",
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
function verFotoProducto(foto,id){
	$(".modal-title").html('Foto Producto');
	$("#contenido").html('<img src="../../upload/productos/alfarera_'+id+'/'+foto+'" width="550">');
	$('#contenido').addClass('text-center');
	$(".modal-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>');
	$("#modalContenido").modal('show');
}
$("body").on("click",".acciones_producto",function(){
	var ruta=$(this).attr('rel-accion');
	var id  = $(this).attr('rel-id');	
	console.log(id)
	var texto='';
		$.ajax({
			url:'../../modelo/productos.php',
			type:'POST',
			data:{id:id,accion:'edit'},
			success:function (result) {
				var res =JSON.parse(result);
				//console.log(res)
				if(!res.error){		

					texto+='<div id="productos" >'
					texto+='<div class="box-body">'
					texto+='<form id="formulario_productos" enctype="multipart/form-data" >'
					texto+='<div class="row">'
					texto+='<div class="form-group col-sm-12">'
					texto+='<label for="">Nombre Pieza</label>'
					texto+='<input type="text" class="form-control" id="piesa_nombre" name="piesa_nombre" value="'+res.nombre+'">'
					texto+='</div>'
					texto+='<div class="form-group col-sm-12">'
					texto+='<label>Foto 1</label>'
					texto+='<input type="file" name="piesas" >'
					texto+='</div>'
					texto+='<div class="form-group col-sm-12">'
					texto+='<label for="exampleFormControlTextarea1">descripcion</label>'
					texto+='<textarea class="form-control" id="descripcion_producto" name="descripcion_producto" rows="2">'+res.descripcion+'</textarea>'
					texto+='</div>'
					texto+='<div class="form-group col-sm-12">'
					texto+='<label for="exampleFormControlTextarea1">Categoria</label>'
					texto+='<select class="form-control" id="categoria_producto" name="categoria_producto" >';
					texto+='<option value="" >seleccione</option>'
					texto+='<option value="1" >Ornamental</option>'
					texto+='<option value="2">Utilitaria</option> '
					texto+='</select>'

					texto+='</div>'
					texto+='<div class="form-group col-sm-12">'
					texto+='<label for="exampleFormControlselect1">Sub Categoria</label>'
					texto+='<select class="form-control" id="subCategorias_producto" name="subCategorias_producto" >'
					texto+='<option value="">seleccione</option>'
					texto+='<option value="1" >option 1</option>'
					texto+='<option value="2">option2</option>'
					texto+='</select>'
					texto+='</div>'   
					texto+='</div> '
					texto+='</form>'
					texto+='</div>'
					texto+='</div>';			
					/*if(res.noticias.foto!=''){					
					}*/

					$("#contenido_producto").html(texto);
					$("#categoria_producto").val(res.idCategoria);
					$("#subCategorias_producto").val(res.idSubCategoria);
					$('#modalContenidoProducto').find('.modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button><button class="btn btn-primary" type="button" onclick="editarProducto('+res.idAlfarera+','+id+')">Actualizar</button>');

					$('#modalContenidoProducto').modal('show');
				}
			}
		});
	});
function editarProducto(idAlfarera,idProducto){
	var data = new FormData();
		var error=[];
		var form_data = $("#formulario_productos").serializeArray();
		$.each(form_data, function (key, input) {
			if(input.value==''){
				$("#"+input.name).addClass('error');
				error.push(input.name)
			}else{
				data.append(input.name, input.value);
				$("#"+input.name).removeClass('error');
			}

		});
		var file_data = $("#formulario_productos").find('input:file')[0].files;
		if(file_data.length>0){			
			for (var i = 0; i < file_data.length; i++) {
				data.append("foto[]", file_data[i]);
			}
		}		
		data.append('accion','updateProductos');
		data.append('idProducto',idProducto);
		data.append('idAlfarera',idAlfarera);

		if(error.length >0){			
			return false;
		}
		console.log(form_data);
		$.ajax({
			url:'../../modelo/productos.php',
			type:'POST',
			contentType:false,
			cache:false,
			processData:false,
			data: data, 
			success:function (resp) {
				console.log(resp);
				var respuesta=JSON.parse(resp);		        	
				if(!respuesta.error && !respuesta.error_foto){
					$("#productos_lista").dataTable().fnDestroy();
					cargarTablaProductos();
					$("#modalContenidoProducto").modal('hide');
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