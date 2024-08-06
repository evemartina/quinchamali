<?php
 //include("../modelo/alfareras.php");

?>	
<style type="text/css">
img{
	cursor: pointer;
}
i{
	cursor: pointer;
}
.sin_padding{
	margin: 0px !important;
	padding: 0px!important;
}
.error{
	border: 1px solid red !important;
}
table.dataTable tbody td {
	vertical-align: middle;
}

.modal-dialog {
	max-width: 600px !important;
	margin: 1.75rem  auto;
}
</style>
<!DOCTYPE html>
<html>

<head>
	<title>Alfareras Quinchamali</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/index.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">


</head>
<body>	
	<div class="container-fluid" style="margin-top: 20px">
		<div  class="row" style="margin: 10px">
			<div id="respuestas" class="ml-auto">
			</div>
		</div>
		<div class="row">
			<div class="col-2">
				<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Alfareras</a>
					<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Productos</a>
					<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Noticias</a>
					<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Arte</a>
				</div>
			</div>
			<div class="col-10">
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

						<div class="col-auto">							
							<div class="row" style="margin: 10px">
								<h2>Alfareras Quinchamali</h2>
								<div class="ml-auto">
									<button class="btn btn-primary " type="button" onclick="agregarAlfarera('Agregar Alfarera','guardarAlfarera',0)">Agregar Alfarera <i class="fa fa-plus"></i> </button>
								</div>
							</div>
							<table class="table table-striped table-bordered dataTable" id="alfareras">
								<thead>
									<th>ID</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Biografia</th>
									<th>Foto</th>
									<th>Estado</th>
									<th>Acciones</th>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>

					</div>
					<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
					<div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
						<?php include('./noticias.php');?>
					</div>
					<div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
				</div>
			</div>
		</div>

	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="../js/bootstrap.min.js" ></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
	<script src="../js/pooper.min.js" ></script>
	<script src="../js/bootstrap-filestyle.js" ></script>
	<script src="./js/index.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

</body>
</html>

<div class="modal" tabindex="-1" role="dialog" id="modalContenido">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="contenido">

			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
<div id="formulario_alfareras" style="display: none;">
	<form enctype="multipart/form-data" >
		<div class="form-group">
			<label for="exampleInputEmail1">Nombre</label>
			<input type="text" class="form-control" id="nombre"  name="nombre" aria-describedby="emailHelp" placeholder="Ingrese nombre">
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Apellido</label>
			<input type="text" class="form-control" id="apellido"  name="apellido" placeholder="Ingrese apellido">
		</div>
		<div class="form-group">
			<label for="exampleFormControlTextarea1">Biografia</label>
			<textarea class="form-control" id="biografia" name="biografia" rows="3"></textarea>
		</div>
		<div class="form-group">
			<label for="exampleFormControlFile1">Foto Artesana</label>
			<input type="file" class="form-control-file" id="foto" name="foto">
		</div>

		
	</form>
</div>
<div id="productos" style="display: none">
	<div class="container">
		<form >
			<div class="row">
				<div class="form-group col-12">
					<label for="">Nombre Piesa</label>
					<input type="text" class="form-control" id="piesa_nombre" name="piesa_nombre" >
				</div>
				<div class="form-group col-12">					 
					<label>Foto 1</label>
					<input type="file" name="piesas" >
				</div>
				<div class="form-group col-12">
					<label for="exampleFormControlTextarea1">descripcion</label>
					<textarea class="form-control" id="descripcion1" name="descripcion1" rows="2"></textarea>
				</div>
				<div class="form-group col-12">
					<label for="exampleFormControlTextarea1">Categoria</label>
					<select class="form-control" id="categoria" class="categoria" >
						<option value="">seleccione</option>
						<option value="1">Ornamental</option>
						<option value="2">Utilitaria</option>

						<
						
					</select>
				</div>
				<div class="form-group col-12">
					<label for="exampleFormControlselect1">Sub Categoria</label>
					<select class="form-control" id="descripcion3" name="descripcion3" >
						<option value="">seleccione</option>
						<option value="1">option 1</option>
						<option value="2">option2</option>
					</select>
				</div>			
				
			</div> 
		</form>
		
	</div>

</div>

<script type="text/javascript">
	var piesas=0;
	function subir(id){
		var data = new FormData();
		var error=[];
		var form_data = $("#form-productos").serializeArray();
		$.each(form_data, function (key, input) {
			console.log(input);
			if(input.value==''){
				$("#"+input.name).addClass('error');
				error.push(input.name)
			}else{
				data.append(input.name, input.value);
				$("#"+input.name).removeClass('error');
			}
		});
		var file_data = $("#form-productos").find('input:file')[0].files;
		if(file_data.length>0){
			 $("#form-productos").find('input:file').removeClass('error');
			for (var i = 0; i < file_data.length; i++) {
				data.append("foto[]", file_data[i]);
			}
		}else{
			error.push('foto');
			 $("#form-productos").find('input:file').addClass('error');
		}

		
		if(error.length >0){
			return false;

		}
		console.log(data);
		$.ajax({
			url: '../modelo/upload_productos.php',
			type: 'post',
			data:data,
			contentType: false,
			processData: false,
			success: function(result){
				if(!erro){
					piesa ++;
				}
			}
		});
	};

</script>
