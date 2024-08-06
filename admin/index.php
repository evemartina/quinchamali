
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
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
      <li class="active">
        <a href="index.php">
          <i class="fa fa-th"></i> <span>Artesanas</span>
      </a>
  </li>
  <li class="treeview">
   <a href="./pages/noticias.php">
           <i class="fa fa-dashboard"></i> <span>Productos</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
    </span>
</a>
<ul class="treeview-menu">
  <li class=""><a href="./pages/productos.php"><i class="fa fa-circle-o"></i> Listado</a></li>
  <li><a href="./pages/subCategorias.php"><i class="fa fa-circle-o"></i> Sub Categoria</a></li>
</ul>
</li>
<li>
    <a href="./pages/noticias.php">
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
      Listado Artesanas
  </h1>
</section>

<section class="content">
    <div class="row">

        <div class="col-sm-12"> 
            <div class="box">   
              <div class="box-header">
                <div class="col-sm-12 pull-right text-right"   style="padding-right: 0px">
                    <button type="submit" class="btn btn-primary" onclick="agregarAlfarera('Agregar Alfarera','guardarAlfarera',0)"><i class="ion ion-person-add"></i> Agregar Artesanas</button>
                </div>
            </div>
            <div class="box-body">
             <table class="table table-striped table-bordered dataTable" id="alfareras" role="grid">
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
</div>
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

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="./js/index.js"></script>
<script src="./js/productos.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>



<script src="dist/js/demo.js"></script>
</body>
</html>

<script type="text/javascript">
  function subir(id){
   
  console.log(piesas);
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
    var file_producto = $("#form-productos").find('input:file')[0].files;
    console.log(file_producto)
    if(file_producto.length>0){
         $("#form-productos").find('input:file').removeClass('error');
         for (var i = 0; i < file_producto.length; i++) {
            data.append("foto[]", file_producto[i]);
        }
    }else{
      error.push('foto');
      $("#form-productos").find('input:file').addClass('error');
    }
    if(error.length >0){
      return false;

    }
    data.append('id',id);
    console.log(data);
    $.ajax({
        url: '../modelo/upload_productos.php',
        type: 'post',
        data:data,
        contentType: false,
        processData: false,
        success: function(result){
            console.log(result)
            res=JSON.parse(result);
           if(!res.error && !res.error_foto){
                piesas ++;
                respuestaAlert('success','Agregar Productos','Producto ingresado con exito');
                setTimeout(function(){$("#alerta_response").alert('close')},2000);
                 $('#form-productos')[0].reset();
            }
            if(piesas==3){
                $("#modalContenido").modal('hide');
            }
        }

    });
};

</script>