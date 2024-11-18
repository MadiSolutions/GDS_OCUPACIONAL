<?php
	require_once '../db_conexion.php';
	$cn = mysqli_connect($host, $user, $pass, $db);

	$campo = $_POST["campo"];

	$sql = "select * from ma_ocupacional_examenes where descripcion like '%$campo%' and estado=1 limit 25";
	$res = mysqli_query($cn,$sql);


	$html = "<option value=''>Seleccione Opcion</option>";

	while ($row = mysqli_fetch_assoc($res)):
		//$html .= "<li onclick=\"mostrar('" . $row["descripcion"] . "')\">" . $row["descripcion"] . "</li>";
		$html .= "<option value='". $row["cod_interno"] . "'>" . $row["descripcion"] . "</option>";
	endwhile;
	echo json_encode($html, JSON_UNESCAPED_UNICODE);
?>