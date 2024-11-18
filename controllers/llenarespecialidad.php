<?php
	session_start();
	require_once '../db_conexion.php';
	$cn = mysqli_connect($host, $user, $pass, $db);

	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])){
		$dni_medico=$_SESSION['usuario'];
		$valor=$_POST['valor'];
		if($_SESSION['tipo_usuario']!=2){
			$sql = "select * from turno_medico where estado=1 and fecha='$valor' group by especialidad";
		}else{
			$sql = "select * from turno_medico where estado=1 and fecha='$valor' and medico='$dni_medico' group by especialidad";
		}
		$res = mysqli_query($cn,$sql);
		$datos="<option value='all'>- Seleccione - </option>";
		while ($row = mysqli_fetch_assoc($res)):
			$datos=$datos."<option value=".$row['especialidad'].">".$row['especialidad']."</option>";
		endwhile;

		$resp=[
			"datos"=>$datos
		];
		echo json_encode($resp);
	}

?>