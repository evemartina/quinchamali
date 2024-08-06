
<style type="text/css">
.error{
	border: 1px solid red !important;
}
</style>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Quinchamali Administracion</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins -->
	<link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
	<link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">




	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">
			<a href="index2.html" class="logo">
				<span class="logo-mini"><b>A</b>dm</span>
				<span class="logo-lg"><b>Quinchamali</b> Admin</span>
			</a>
			<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">Navegación</li>
					<li >
						<a href="../index.php">
							<i class="fa fa-th"></i> <span>Artesanas</span>
						</a>
					</li>
					<li class="treeview">
						<a href="#">
							<i class="fa fa-dashboard"></i> <span>Productos</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li class=""><a href="./productos.php"><i class="fa fa-circle-o"></i> Listado</a></li>
							<li><a href="./subcategorias.php"><i class="fa fa-circle-o"></i> Sub Categoria</a></li>
						</ul>
					</li>
					<li class="active">
						<a href="./noticias.php">
							<i class="fa fa-th"></i> <span>Noticias</span>
						</a>
					</li>
					<li>
						<a href="pages/widgets.html">
							<i class="fa fa-th"></i> <span>Arte</span>
						</a>
					</li>
					<li>
						<a href="pages/login.html">
							<i class="fa fa-th"></i> <span>Login</span>
						</a>
					</li>
				</ul>
			</section>
		</aside>

		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					Listado Noticias
				</h1>
			</section>

			<section class="content">
				<div class="row">
					<div class="col-sm-12"> 
						<div class="box">   
							<div class="box-header">	
								<div class="col-sm-12 pull-right text-right" style="padding-right:0px" onclick="agregarNoticia('Agregar Noticia','guardarNoticia',0)">
									<button class="btn btn-primary " type="button" >Agregar Noticia <i class="fa fa-plus"></i> </button>
								</div>
							</div>
							<div class="box-body">
								<table class="table table-striped table-bordered dataTable" id="noticias" rol="grid">
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
						</div>
					</div>
				</div>
			</section>

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
		</section>
	</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="modalContenido">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Modal title</h4>
				
			</div>
			<div class="modal-body" id="contenido">

			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="../js/noticias.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script>
--><!-- Admin..LTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>

