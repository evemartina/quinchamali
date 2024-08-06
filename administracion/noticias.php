<div class="col-auto">
	
	<div class="row" style="margin: 10px">
		<h2>Noticias</h2>
		<div class="ml-auto">
			<button class="btn btn-primary " type="button" onclick="agregarNoticia('Agregar Noticia','guardarNoticia',0)">Agregar Noticia <i class="fa fa-plus"></i> </button>
		</div>
	</div>
	<table class="table table-striped table-bordered dataTable" id="noticias">
		<thead>
			<th>ID</th>
			<th>Titulo</th>
			<th>Subtitulo</th>
			<th>Noticia</th>
			<th>Foto</th>
			<th>Estado</th>
			<th>Acciones</th>
		</thead>
		<tbody>

		</tbody>
	</table>
</div>

<script type="text/javascript">

</script>

<div id="formulario" style="display: none;">
	<form >
		<div class="form-group">
			<label for="exampleInputEmail1">Titulo</label>
			<input type="text" class="form-control" id="titulo"  name="titulo" aria-describedby="emailHelp" placeholder="Ingrese titulo">
		</div>
		<div class="form-group">
			<label for="exampleInputPassword1">Subtitulo</label>
			<input type="text" class="form-control" id="subtitulo"  name="subtitulo" placeholder="Ingrese apellido">
		</div>
		<div class="form-group">
			<label for="exampleFormControlTextarea1">Noticia</label>
			<textarea class="form-control" id="noticia" name="noticia" rows="3"></textarea>
		</div>
		<div class="form-group">
			<label for="exampleFormControlFile1">Foto Noticia</label>
			<input type="file" class="form-control-file" id="foto" name="foto">
		</div>

		
	</form>
</div>