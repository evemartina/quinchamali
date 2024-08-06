<!DOCTYPE html>
<html>

<head>
    <title>Alfareras Quinchamali</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css"/>
    <link rel="stylesheet" href="../css/navbar-custom.css"/>
    <link rel="stylesheet" href="../css/button-custom.css"/>
    <link rel="stylesheet" href="../css/color.css"/>
</head>
<body class="background-gris-1">
    <div class="header fixed-top">
        <nav class="navbar navbar-expand-lg transparent navbar-inverse">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item ">
                <a class="nav-link" href="../index.php" rel-include="home">INICIO <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item navbar-border-left active">
                <a class="nav-link" href="./alfareras.php" rel-include="alfareras">ALFARERAS</a>
              </li>
              <li class="nav-item navbar-border-left">
                <a class="nav-link" href="./catalogo.php" rel-include="catalogo">CÁTALOGO PRODUCTOS</a>
              </li>
                    <li class="nav-item navbar-border-left">
                <a class="nav-link" href="./noticias.php" rel-include="noticias">NOTICIAS</a>
              </li>
                    <li class="nav-item navbar-border-left">
                <a class="nav-link" href="./arte.php" rel-include="arte"> QUINCHAMALÍ Y EL ARTE</a>
              </li>
            </ul>
          </div>
        </nav>
    </div>
    <div class="container-fluid p-0" >
        <div  id="home-div" class="div-secciones">
            <div id="alfareras">
              <section class="panel with-navbar first">
                <div class="container h-100">
                    <div class="row pt-5">

                        <div class="resCarousel ResSlid1 ResHover" data-items="2-3-4-4" data-slide="5" data-speed="900" data-interval="4000" data-load="3" data-animator="lazy" data-value="0">
                            <div class="resCarousel-inner">

                                <div class="item">
                                    <div class="tile">
                                        <div class="col p-0"><img class="d-block w-100" src="https://c1.staticflickr.com/9/8429/7570631302_5f252c52d1_b.jpg" alt="First slide"></div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="tile">
                                        <div class="col p-0"><img class="d-block w-100" src="https://c1.staticflickr.com/9/8429/7570631302_5f252c52d1_b.jpg" alt="First slide"></div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="tile">
                                        <div class="col p-0"><img class="d-block w-100" src="https://c1.staticflickr.com/9/8429/7570631302_5f252c52d1_b.jpg" alt="First slide"></div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="tile">
                                        <div class="col p-0"><img class="d-block w-100" src="https://c1.staticflickr.com/9/8429/7570631302_5f252c52d1_b.jpg" alt="First slide"></div>
                                    </div>
                                </div>

                                <div class="item" style="">
                                    <div class="tile">
                                        <div class="col p-0"><img class="d-block w-100" src="https://c1.staticflickr.com/9/8429/7570631302_5f252c52d1_b.jpg" alt="First slide"></div>
                                    </div>
                                </div>
                               
                            </div>
                            <a class="carousel-control-prev leftRs" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next rightRs" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>

                    <div class="row mt-3 pt-5">

                        <div class="col-3">
                            <h3 class="subtitle m-0">Alfareras</h3>
                        </div>

                        <div class="col-9">
                            <p class="m-0" style="padding-top: 2.5px; padding-bottom: 2.5px">andit enim et nisl dapibus, quis suscipit orci rutrum. Vivamus rutrum facilisis hendrerit.
                                Pellentesque non arcu quam. Morbi quis orci neque. Nunc massa enim, accumsan sed
                                hendrerit non, volutpat at orci. Duis auctor bibendum eros nec aliquet. Cras venenatis
                            pulvinar mi</p>
                        </div>

                    </div>

                </div>

            </section>

            <section class="panel with-navbar second">

                <div class="container h-100" id="perfil_alfarera">


                </div>

            </section>

            <section class="panel with-navbar three">

                <div class="container h-100">

                    <div class="row align-items-center h-100">

                        <div id="carouselExampleControls2" class="col-12 carousel slide" data-ride="carousel">
                            <div class="carousel-inner" id="productos_img">
                                
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>

                </div>

            </section>
        </div>
        <?php   include("./footer.php");?>
        </div>    
        
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="../js/bootstrap.min.js" ></script>
    <script src="../js/pooper.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js" ></script>
    <script src="../js/jquery.scrollify.js"></script>
    <script src="../js/index.js"></script>   
    <script type="text/javascript">
        $(function(){
            cargaPerfil(1)

        });
        $(".nav-item").on('click',function(){
            div=$(this).find('a').attr('rel-include');
            $(".div-secciones").hide();
            $("#"+div+"-div").show();
        })
      function cargaPerfil(id){
        var texto='';
        var productos='';
        var active;
        $.ajax({
            'url' : '../modelo/alfareras.php/',
            'type':'POST',
            'data':{accion:'alfarera',id:id}  ,
            success:function(respuesta){
                var res =JSON.parse(respuesta);
                console.log(res);

                texto+='<div class="row align-items-center h-100">'
                texto+='<div class="col-7">'
                texto+='<h3>'+res.data.nombre+' '+res.data.apellido+'</h3>'
                texto+='<p>'+res.data.biografia+'</p>'
                texto+='</div>'
                texto+='<div class="col-4 ml-auto" style="background: url('+res.data.foto+');background-repeat: no-repeat;background-size: 348px;background-position-x: 0px;background-position-y: -90px;height: 267px;">'
               //  texto+=' <img src="'+res.data.foto+'" class="img-fluid" alt="Responsive image" width="200px">'
                texto+='</div>';

                    $.each(res.productos,function(i,val){
                        console.log(i)
                        if(i==0){
                            active='active';
                        }else{
                            active='';
                        }
                        texto+='<div class="col-4" style="background: url(../upload/productos/alfarera_'+res.data.id+'/'+val.url+');background-repeat: no-repeat; background-size: 376px 287px;background-position-x: 0px;background-position-y: -6px;height: 277px;">'
                        //texto+='<img src="../upload/productos/alfarera_'+res.data.id+'/'+val.url+'" width="200px"  class="img-fluid" alt="Responsive image">'
                        texto+='</div>' ; 
                        productos+=' <div class="carousel-item '+active+'">'
                        productos+= '<div class="row align-items-center">'
                        productos+='<div class="col-5 m-4 ml-auto">'
                        productos+='<img src="../upload/productos/alfarera_'+res.data.id+'/'+val.url+'" width="200px"  class="img-fluid" alt="Responsive image">'
                        productos+='</div>'
                        productos+='<div class="col-6">'
                        productos+='<h3>'+val.nombre+'</h3>'
                        productos+='<p>'+val.descripcion;
                        productos+='</p>'
                        productos+='</div>'
                        productos+='</div>'
                        productos+='</div>';
                    });                             
             
                texto+='</div>';   
                $("#perfil_alfarera").html(texto);
                $("#productos_img").html(productos)
            }       
        })

       }
    </script>
</body>


</html>
       








