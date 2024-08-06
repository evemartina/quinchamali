<!DOCTYPE html>
<html>

<head>
	<title>Alfareras Quinchamali</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel="stylesheet" href="./css/index.css"/>
	<link rel="stylesheet" href="./css/navbar-custom.css"/>
	<link rel="stylesheet" href="./css/button-custom.css"/>
	<link rel="stylesheet" href="./css/color.css"/>
</head>
<body class="background-gris-1">
	<div class="header fixed-top">
		<nav class="navbar navbar-expand-lg transparent navbar-inverse">
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav ml-auto">
		      <li class="nav-item active">
		        <a class="nav-link" href="#" rel-include="home">INICIO <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item navbar-border-left">
		        <a class="nav-link" href="./seccion/alfareras.php" rel-include="alfareras">ALFARERAS</a>
		      </li>
		      <li class="nav-item navbar-border-left">
		        <a class="nav-link" href="#" rel-include="catalogo">CÁTALOGO PRODUCTOS</a>
		      </li>
					<li class="nav-item navbar-border-left">
		        <a class="nav-link" href="#" rel-include="noticias">NOTICIAS</a>
		      </li>
					<li class="nav-item navbar-border-left">
		        <a class="nav-link" href="#" rel-include="arte"> QUINCHAMALÍ Y EL ARTE</a>
		      </li>
		    </ul>
		  </div>
		</nav>
	</div>
	<div class="container-fluid p-0" >
		<div  id="home-div" class="div-secciones">
			<?php include("./seccion/home.php")?>
		</div>
		
		
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="./js/bootstrap.min.js" ></script>
	<script src="./js/pooper.min.js" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js" ></script>
	<script src="./js/jquery.scrollify.js"></script>
	<script src="./js/index.js"></script>	
	<script type="text/javascript">
		$(".nav-item").on('click',function(){
			div=$(this).find('a').attr('rel-include');
			$(".div-secciones").hide();
			$("#"+div+"-div").show();
		})
	</script>
</body>


</html>
