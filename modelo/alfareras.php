<?php 
include("conexion.php");
$data = array();	

$connection = new createCon();
if(isset($_POST['accion'])){
	$accion=$_POST['accion'];
	if($accion==='getAlfareras'){
		$query='SELECT * FROM alfareras order by id asc';
		if(!($result=mysqli_query($connection->connect(), $query))){
			$data = false;
		}elseif(($result)){
			$num_rows = mysqli_num_rows($result);
			if($num_rows === 0){
				$data = false;
			}else{			
				while($row = mysqli_fetch_assoc($result)){
					$data['data'][]	= array(
						'id' 		=> $row['id'],
						'nombre'	=> ucfirst($row['nombre']),
						'apellido' 	=> ucfirst($row['apellido']),
						'biografia' => $row['biografia'],
						'foto' 		=> '<img src="../upload/perfiles/'.$row['foto'].'" width="50" heigth="auto" onclick="verFoto(\''.$row['foto'].'\')">',
						'estado' 	=> ($row['estado']==1)?"Activa ":"Inactiva",
						'acciones'	=> '<i class="fa fa-pencil acciones" rel-id="'.$row['id'].'" rel-accion="editar" style="margin-left:5px"></i> 
						<i class="fa fa-trash acciones" rel-id="'.$row['id'].'" rel-accion="eliminar" rel-estado="'.$row['estado'].'" style="margin-left:5px"></i> 
						<i class="fa fa-upload acciones" rel-id="'.$row['id'].'" rel-accion="productos"  style="margin-left:5px"></i> '


					);
				}
			}				
		}
		if(empty($data['data'])){
			$data['data']=[];
		}

	}	
	if($accion==='alfarera'){
		$query='SELECT * FROM alfareras where id='.$_POST["id"];
		if(!($result=mysqli_query($connection->connect(), $query))){
			$data = false;
		}elseif(($result)){
			$num_rows = mysqli_num_rows($result);
			if($num_rows === 0){
				$data = false;
			}else{			
				while($row = mysqli_fetch_assoc($result)){
					$data['data']	= array(
						'id' 		=> $row['id'],
						'nombre'	=> ucfirst($row['nombre']),
						'apellido' 	=> ucfirst($row['apellido']),
						'biografia' => $row['biografia'],
						'foto' 		=> '../upload/perfiles/'.$row['foto'],
						'estado' 	=> ($row['estado']==1)?"Activa ":"Inactiva",	
					);
				}
			}				
		}
		$query='SELECT * FROM productos where idAlfarera='.$_POST["id"];
		if(!($result=mysqli_query($connection->connect(), $query))){
			$data = false;
		}elseif(($result)){
			$num_rows = mysqli_num_rows($result);
			if($num_rows === 0){
				$data = false;
			}else{			
				while($row = mysqli_fetch_assoc($result)){
					$data['productos'][]	= array(
						'id' 		=> $row['id'],
						'nombre'	=> ucfirst($row['nombre']),
						'descripcion' => $row['descripcion'],
						'url' 		=> $row['url'],
					);
				}
			}				
		}
	}	
	
	
	if($accion=='eliminarAlfarera'){ 	
		$estado=$_POST['estado'];
		if($estado==0){
			$cambio=1;
		}else{
			$cambio=0;
		}
		$id=$_POST['id'];		
		$query="UPDATE alfareras set estado=".$cambio." WHERE id=".$id;
		$con=$connection->connect();
		if(!($result=mysqli_query($con, $query))){
			$data['respuesta']=false;
			$data['mensaje']='error';
		}elseif($result){
				//print_r($result);
			$d = mysqli_affected_rows($con);
			if($d==1){
				$data ['respuesta']= false;
				$data['mensaje']='falsee';
			}else{
				$data['respuesta']=true;
				$data['mensaje']='eliminada';
			}
		}
			// $data;
	}

	if($accion=='guardarAlfarera'){ 
		$data['post']=$_POST;
		$data['S']=$_FILES;
		$uploads_dir = '../upload/perfiles';
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$biografia=$_POST['biografia'];
		$con=$connection->connect();
		$id;
		$name ;
		foreach ($_FILES["foto"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES["foto"]["tmp_name"][$key];			       
				$tipo=explode('/',$_FILES["foto"]["type"][$key]);
				$name = 'alfrera_'.quitaEspeciales($apellido).'.'.$tipo[1];
				$n=str_replace(" ","_",$name);
				if(move_uploaded_file($tmp_name, "$uploads_dir/$name")){
					$data['foto']='Subida';
					$data['error_foto']=false;
				}else{
					$data['foto']='NO subio';
					$data['error_foto']=true;
				}
			}
		}
		
		$sql="INSERT INTO alfareras values(null,'{$nombre}','{$apellido}','{$biografia}','{$n}',1)";
		if (mysqli_query($con, $sql)) {
			$data['error']=false;
			$id= mysqli_insert_id($con);
		} else {
			$data['error']=true;
			$data['error_query']= "Error: " . $sql . "<br>" . mysqli_error($con);
		}
		
	}

	if($accion=='edit'){ 
		$id=$_POST['id'];
		$query='SELECT * FROM alfareras WHERE id='.$id;
		$data = array();
		if(!($result=mysqli_query($connection->connect(), $query))){
			$data['error']=true;
			$data['alfarera']=[];
		}elseif(($result)){
			$num_rows = mysqli_num_rows($result);
			if($num_rows === 0){
				$data['error']=true;
				$data['alfarera']=[];
			}else{						
				while($row = mysqli_fetch_assoc($result)){
					$data['alfarera'] = $row;
					$data['error']=false;
				}
			}			
		}
	}
	if($accion=='updateAlfarera'){ 
		$uploads_dir = '../upload/perfiles';
		$nombre=$_POST['nombre'];
		$apellido=$_POST['apellido'];
		$biografia=$_POST['biografia'];
		$id=$_POST['id'];
		if(isset($_FILES["foto"])){
			foreach ($_FILES["foto"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["foto"]["tmp_name"][$key];			       
					$tipo=explode('/',$_FILES["foto"]["type"][$key]);
					$name = 'alfrera_'.quitaEspeciales($apellido).'.'.$tipo[1];
					$n=str_replace(" ","_",$name);

					if(move_uploaded_file($tmp_name, "$uploads_dir/$n")){
						$data['foto']='Subida';
						$data['error_foto']=false;
					}else{
						$data['foto']='NO subio';
						$data['error_foto']=true;
					}
				}
			}
			$sql="UPDATE alfareras set nombre='{$nombre}',apellido='{$apellido}',biografia='{$biografia}',foto='{$n}' where id=".$id;
		}else{
			$sql="UPDATE alfareras set nombre='{$nombre}',apellido='{$apellido}',biografia='{$biografia}' where id=".$id;

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