<?php
$accion = $_POST['accion'];
controlador($accion);

function controlador($accion){
	require_once '../db_conexion.php';
	$cone = mysqli_connect($host, $user, $pass, $db);
	switch ($accion) {


		case 'LIST_DETALLE_PROTOCOLOS':
			session_start();
			$id_protocolo = $_POST['referencia'];
			$sql1 = "select * from ma_ocupacional_protocolos where id_protocolo='$id_protocolo' and estado='1'";
			$res1= mysqli_query($cone, $sql1);

			$array = mysqli_fetch_array($res1);

			$examenes=$array['cod_interno_examenes'];
			$nombre_protocolo=$array['nombre'];
			$descripcion_protocolo=$array['descripcion'];

			$lista_examenes = explode(',',$examenes);
			$cantidad_examenes = count($lista_examenes);



			$row_cnt = $res1->num_rows;
			echo $nombre_protocolo.'%'.$descripcion_protocolo.'%';
			if($row_cnt>0){

				echo '<i class="fa fa-circle" style="color:#f4c2c0"></i> Items Eliminados';
				echo '<table id="example2" class="table table-bordered table-hover">';
				echo '<thead style="background-color:#55B7BE;color:#FFFFFF" >';
				echo "<tr>";
				echo "<th>Especialidad</th><th>Descripcion</th><th></th>";
				echo "</tr>";
				echo '</thead>';
				$especialidad="";
				$contador=0;
				while ($contador<$cantidad_examenes) :
					$sqlexamen="select * from ma_ocupacional_examenes where cod_interno ='".$lista_examenes[$contador]."' and estado=1 limit 1";
					$resexamen= mysqli_query($cone, $sqlexamen);
					$arrayexamen= mysqli_fetch_array($resexamen);
					echo "<tr>";
					if($especialidad!=$arrayexamen['especialidad']){
						echo "<td>".$arrayexamen['especialidad']."</td><td>".$arrayexamen['descripcion']."</td>";
					}else{
						echo "<td></td><td>".$arrayexamen['descripcion']."</td>";
					}
					echo "<td><button type='button' class='btn btn-xs btn-danger' onclick='EliminarItemAuditor(".$arrayexamen['especialidad'].','.$arrayexamen['descripcion'].")'><span class='fa fa-trash' ></span></button>&nbsp;";

					echo "</tr>";
					
					$contador++;
				endwhile;
				echo "</table>";

			}
			else{
				echo ('ERROR');
			}
			
			break;	

		case 'ADD_PRODUCTO':
			$producto=$_POST['producto'];
			$especialidad='';$descripcion='';

			if($_POST['producto']!=''){
				$sql = "select * from ma_ocupacional_examenes where cod_interno='$producto' and estado=1 limit 1 ";
				$res= mysqli_query($cone, $sql);
				while ($row = mysqli_fetch_assoc($res)) :
					$descripcion=$row['descripcion'];
					$especialidad=$row['especialidad'];
				endwhile; 
				session_start();

				if(!isset($_SESSION['carrito_examenes_protocolo_ocupacional'])){
						$_SESSION['carrito_examenes_protocolo_ocupacional'] = array();
				}
	
					$carrito_ocupacional = $_SESSION['carrito_examenes_protocolo_ocupacional'];
	
					$item = count($carrito_ocupacional);
				//$cantidad = 1;
					$existe = false;
	
					for($i=0;$i<$item;$i++){
						if($carrito_ocupacional[$i]['producto']== $producto){
							$existe=true;
							break;
						}
					}
					if($existe==false){
						$carrito_ocupacional[$item]=array(
							'producto'=>$producto,
							'descripcion'=>$descripcion,
							'especialidad'=>$especialidad
						);
					}	
					$_SESSION['carrito_examenes_protocolo_ocupacional'] = $carrito_ocupacional;
			}
		break;	

		case 'LIST_PRODUCTOS':
				session_start();
	
				if(!isset($_SESSION['carrito_examenes_protocolo_ocupacional'])){
					$_SESSION['carrito_examenes_protocolo_ocupacional'] = array();
				}
	
				$carrito_ocupacional = $_SESSION['carrito_examenes_protocolo_ocupacional'];
				$item = count($carrito_ocupacional);
	
				$contador=0;
				if($item>0){
					echo '<table id="example2" class="table table-bordered table-hover">';
					echo '<thead style="background-color:#55B7BE;color:#FFFFFF" >';
					echo "<tr>";
					echo "<th>Especialidad</th><th>Descripcion</th><th>-</th>";
					echo "</tr>";
					echo '</thead>';
					while ($contador<$item):
						echo "<tr>";
						echo "<td>".$carrito_ocupacional[$contador]['especialidad']."</td><td>".$carrito_ocupacional[$contador]['descripcion']."</td>";
						echo "<td><button type='button' class='btn btn-xs btn-danger' onclick='EliminarItemF(".$contador.")'><span class='fa fa-trash'></span></button></td>";

						echo "</tr>";
						$contador++;
					endwhile;
					echo "</table>";
				}

		break;

		
		case 'ELIM_PRODUCTOF':		
			$item = $_POST["item"];
			session_start();
			$carrito_ocupacional = $_SESSION['carrito_examenes_protocolo_ocupacional'];

			for($i=$item;$i<count($carrito_ocupacional)-1;$i++ ){                           
				$carrito_ocupacional[$i]=$carrito_ocupacional[$i+1];
			}
			unset($carrito_ocupacional[count($carrito_ocupacional)-1]);
			
			$_SESSION['carrito_examenes_protocolo_ocupacional'] = $carrito_ocupacional;
		break;	


		case 'ELIM_ITEM_PROTOCOLO':
			$id_item = $_POST['id_protocolo'];
			$sqlauditor = "update ma_ocupacional_protocolos set estado=0 where id_protocolo='$id_item'";
			$resauditor = mysqli_query($cone, $sqlauditor);
			if ($resauditor !== false) {
					echo ('ok');
			}else{
					echo('Error');
				}
		break;


		

		default:
			# code...
			break;

	}


}

?>