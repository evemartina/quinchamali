<?php
include("conexion.php");
$data = array();	

$connection = new createCon();
/*print_r($_POST);
*/if(isset($_POST['accion'])){
	$accion=$_POST['accion'];

	if($accion=='getProductos'){
		$query='SELECT * from productos INNER JOIN alfareras on alfareras.id=productos.idAlfarera ORDER BY alfareras.id desc';
		$data = array();
		if(!($result=mysqli_query($connection->connect(), $query))){
			$data = false;
		}elseif(($result)){
			$num_rows = mysqli_num_rows($result);
			if($num_rows === 0){
				$data = false;
			}else{						
				while($row = mysqli_fetch_assoc($result)){
					$data['data'][]	= array(
						'nombre'	=> ucfirst($row['nombre']),
						'apellido' 	=> ucfirst($row['apellido']),
						'biografia' => $row['biografia'],						
						'acciones'	=> '<i class="fa fa-pencil-alt acciones-productos" rel-id="'.$row['productos.id'].'" rel-accion="editar" style="margin-left:10px">/i> '


					);
				}
			}
			
		}
		
	}
	if($accion=='getProductoById'){
			$data = array(); 
		$query='SELECT * FROM productos WHERE idAlfarera='.$_POST['id'];
		//$data['query']=$query;
		if(!($result=mysqli_query($connection->connect(), $query))){
			$data = false;
		}elseif(($result)){
			$num_rows = mysqli_num_rows($result);
			if($num_rows === 0){
				$data = false;
			}else{	
				$data['total'] = $num_rows;					
				while($row = mysqli_fetch_assoc($result)){
					
					$data['data'][]=$row;
				}
			}
			
		}
	}
	if($accion =='getCategorias'){ 
		$query='SELECT * from categorias ';
		$data = array();
		if(!($result=mysqli_query($connection->connect(), $query))){
			$data = false;
			$data['res']=$result;
		}elseif(($result)){
			$num_rows = mysqli_num_rows($result);
			if($num_rows === 0){
				$data = false;
			}else{						
				while($row = mysqli_fetch_assoc($result)){
					$data[] = $row;
				}
			}
			
		}
		
	}
	if($accion=='getSubCategorias'){ 
		$query='SELECT * FROM subcategorias where idCategoria='.$_POST['categoria'];
		$data = array();
		if(!($result=mysqli_query($connection->connect(), $query))){
			$data = false;
		}elseif(($result)){
			$num_rows = mysqli_num_rows($result);
			if($num_rows === 0){
				$data = false;
			}else{						
				while($row = mysqli_fetch_assoc($result)){
					$data[] = $row;
				}
			}
			
		}
	}
	if($accion=='getProductosTabla'){
		$query='SELECT a.id as idAlfarera,CONCAT(a.nombre," ",a.apellido) as alfarera,p.id as idProducto,p.nombre,p.descripcion,c.nombre as categoria ,s.nombre as subcategoria,p.url FROM productos as p  INNER JOIN alfareras as a on a.id=p.idAlfarera INNER JOIN categorias as c on c.id =p.idCategoria INNER JOIN subcategorias as s on s.id=p.idSubCategoria ORDER BY a.id DESC';
		if(!($result=mysqli_query($connection->connect(), $query))){
			$data = false;
		}elseif(($result)){
			$num_rows = mysqli_num_rows($result);
			if($num_rows === 0){
				$data = false;
			}else{			
				while($row = mysqli_fetch_assoc($result)){
					$data['data'][]	= array(
						'id' 			=> $row['idProducto'],
						'nombre'		=> ucfirst($row['nombre']),
						'descripcion' 	=> ucfirst($row['descripcion']),
						'categoria' 	=> $row['categoria'],
						'subCategoria' 	=> $row['subcategoria'],
						'pieza' 		=> '<img src="../../upload/productos/alfarera_'.$row['idAlfarera'].'/'.$row['url'].'" width="50" heigth="auto" onclick="verFotoProducto(\''.$row['url'].'\','.$row["idAlfarera"].')">',
						'alfarera'		=> ucfirst($row['alfarera'])  ,

						'acciones'		=> '<i class="fa fa-pencil acciones_producto" rel-id="'.$row['idProducto'].'" rel-accion="editar" style="margin-left:10px"></i> '
					
					);
				}
			}				
		}
	}
	if($accion=='edit'){ 
		$query='SELECT * FROM productos where id='.$_POST['id'];
		$data = array();
		if(!($result=mysqli_query($connection->connect(), $query))){
			$data = false;
		}elseif(($result)){
			$num_rows = mysqli_num_rows($result);
			if($num_rows === 0){
				$data = false;
			}else{						
				while($row = mysqli_fetch_assoc($result)){
					$data = $row;
				}
			}
			
		}
	}
	if($accion=='updateProductos'){ 
		$uploads_dir = '../upload/productos/alfarera_'.$_POST['idAlfarera'];
	if (!file_exists($uploads_dir)) {
		mkdir($uploads_dir, 0777, true);
	}
		$nombre=$_POST["piesa_nombre"];
		$descripcion=$_POST['descripcion_producto'];
		$categoria=$_POST["categoria_producto"];
		$subCategoria=$_POST["subCategorias_producto"];
		$id=$_POST['idProducto'];
		if(isset($_FILES["foto"])){
			foreach ($_FILES["foto"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["foto"]["tmp_name"][$key];			       
					$tipo=explode('/',$_FILES["foto"]["type"][$key]);
					$name = quitaEspeciales($nombre).'.'.$tipo[1];
					$n=str_replace(" ", "_", $name);
					if(move_uploaded_file($tmp_name, "$uploads_dir/$n")){
						$data['foto']='Subida';
						$data['error_foto']=false;
						$data['name']=$n;
						$sql="UPDATE productos set nombre='{$nombre}',descripcion='{$descripcion}',idCategoria='{$categoria}',idSubCategoria='{$subCategoria}',url='{$n}' where id=".$id;
						$data['sql']=$sql;
					}else{
						$data['foto']='NO subio';
						$data['error_foto']=true;
						$data['dir']=$uploads_dir;
						$data['name']=$n;
						$data['sql']=$sql;
					}
				}
			}
			
		}else{
			$sql="UPDATE productos set nombre='{$nombre}',descripcion='{$descripcion}',idCategoria='{$categoria}',idSubCategoria='{$subCategoria}' where id=".$id;

		}			
		$con=$connection->connect();
		if (mysqli_query($con, $sql)) {
			$data['error']=false;
		} else {
			$data['error']=true;
			$data['error_query']= "Error: " . $sql . "<br>" . mysqli_error($con);
		}

	}




	echo json_encode($data);
}
?>