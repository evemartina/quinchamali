<?php 
include("conexion.php");
$connection = new createCon();
$data=array();

$id=$_POST['id'];
$uploads_dir = '../upload/productos/alfarera_'.$id;
if (!file_exists($uploads_dir)) {
	mkdir($uploads_dir, 0777, true);
}
$nombre=$_POST['piesa_nombre'];
$descripcion=$_POST['descripcion'];
$categoria=$_POST['categoria'];
$subcategoria=$_POST['subCategorias'];

$con=$connection->connect();

$name ;
foreach ($_FILES["foto"]["error"] as $key => $error) {
	if ($error == UPLOAD_ERR_OK) {
		$tmp_name = $_FILES["foto"]["tmp_name"][$key];			       
		$tipo=explode('/',$_FILES["foto"]["type"][$key]);
		$name = $nombre.'.'.$tipo[1];
		$n=str_replace(" ", "_", $name);
		if(move_uploaded_file($tmp_name, "$uploads_dir/$n")){
			$data['foto']='Subida';
			$data['error_foto']=false;
		}else{
			$data['foto']='NO subio';
			$data['error_foto']=true;
		}
	}
}
$sql="INSERT INTO productos values(null,'{$nombre}','{$descripcion}','{$categoria}','{$subcategoria}',$id,'{$n}')";
if (mysqli_query($con, $sql)) {
	$data['error']=false;
	$id= mysqli_insert_id($con);
} else {
	$data['error']=true;
	$data['error_query']= "Error: " . $sql . "<br>" . mysqli_error($con);
}
echo json_encode($data);