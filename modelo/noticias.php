<?php 
include("conexion.php");
$data = array();	

$connection = new createCon();
if(isset($_POST['accion'])){
	$accion=$_POST['accion'];
	if($accion==='getNoticias'){
		$query='SELECT * FROM noticias order by id asc';
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
						'titulo'	=> ucfirst($row['titulo']),
						'subtitulo' 	=> ucfirst($row['subtitulo']),
						'noticia' => $row['noticia'],
						'foto' 		=> '<img src="../../upload/noticias/'.$row['foto'].'" width="50" heigth="auto" onclick="verFotoNoticia(\''.$row['foto'].'\')">',
						'estado' 	=> ($row['estado']==1)?"Activa ":"Inactiva",
						'acciones'	=> '<i class="fa fa-pencil acciones_noticias" rel-id="'.$row['id'].'" rel-accion="editar" style="margin-left:10px"></i> 
						<i class="fa fa-trash acciones_noticias" rel-id="'.$row['id'].'" rel-accion="eliminar" rel-estado="'.$row['estado'].'" style="margin-left:10px"></i> '


					);
				}
			}				
		}
		if(empty($data['data'])){
			$data['data']=[];
		}

	}	
	
	
	if($accion=='eliminarNoticia'){ 	
		$estado=$_POST['estado'];
		if($estado==0){
			$cambio=1;
		}else{
			$cambio=0;
		}
		$id=$_POST['id'];		
		$query="UPDATE noticias set estado=".$cambio." WHERE id=".$id;
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

	if($accion=='guardarNoticia'){ 
		$data['post']=$_POST;
		$data['S']=$_FILES;
		$uploads_dir = '../upload/noticias';
		$titulo=$_POST['titulo'];
		$subtitulo=$_POST['subtitulo'];
		$noticia=$_POST['noticia'];
		$con=$connection->connect();
		$id;
		$name ;
		foreach ($_FILES["foto"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES["foto"]["tmp_name"][$key];			       
				$tipo=explode('/',$_FILES["foto"]["type"][$key]);
				$name = 'noticia'.quitaEspeciales($titulo).'.'.$tipo[1];
				if(move_uploaded_file($tmp_name, "$uploads_dir/$name")){
					$data['foto']='Subida';
					$data['error_foto']=false;
				}else{
					$data['foto']='NO subio';
					$data['error_foto']=true;
				}
			}
		}
		$sql="INSERT INTO noticias values(null,'{$titulo}','{$subtitulo}','{$noticia}','{$name}',1)";
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
		$query='SELECT * FROM noticias WHERE id='.$id;
		$data = array();
		if(!($result=mysqli_query($connection->connect(), $query))){
			$data['error']=true;
			$data['noticias']=[];
		}elseif(($result)){
			$num_rows = mysqli_num_rows($result);
			if($num_rows === 0){
				$data['error']=true;
				$data['noticias']=[];
			}else{						
				while($row = mysqli_fetch_assoc($result)){
					$data['noticias'] = $row;
					$data['error']=false;
				}
			}			
		}
	}
	if($accion=='updateNoticia'){ 
		$uploads_dir = '../upload/noticias';
		$titulo=$_POST['titulo'];
		$subtitulo=$_POST['subtitulo'];
		$noticia=$_POST['noticia'];
		$id=$_POST['id'];
		if(isset($_FILES["foto"])){
			foreach ($_FILES["foto"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$tmp_name = $_FILES["foto"]["tmp_name"][$key];			       
					$tipo=explode('/',$_FILES["foto"]["type"][$key]);
					$name = 'noticia'.quitaEspeciales($titulo).'.'.$tipo[1];
					if(move_uploaded_file($tmp_name, "$uploads_dir/$name")){
						$data['foto']='Subida';
						$data['error_foto']=false;
					}else{
						$data['foto']='NO subio';
						$data['error_foto']=true;
					}
				}
			}
			$sql="UPDATE noticias set titulo='{$titulo}',subtitulo='{$subtitulo}',noticia='{$noticia}',foto='{$name}' where id=".$id;
		}else{
			$sql="UPDATE  noticias set titulo='{$titulo}',subtitulo='{$subtitulo}',noticia='{$noticia}' where id=".$id;

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