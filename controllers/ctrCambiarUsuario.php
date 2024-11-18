<?php
//session_start();
date_default_timezone_set('America/Lima');
$accion = $_POST['accion'];
controlador($accion);

function controlador($accion){
	require_once '../db_conexion.php';
	$cone = mysqli_connect($host, $user, $pass, $db);
	switch ($accion) {
		case 'CAMBIAR_A_MEDICO':
			session_start();
			$id_cita=$_POST['id_cita'];

			$query="select * from citas where id_cita='$id_cita' limit 1";
			$res= mysqli_query($cone, $query);
			if ($res !== false) {
				$array = mysqli_fetch_array($res);
				$medico=$array['medico'];
				$_SESSION['usuario']=$medico;
				echo 'OK';
		   }else{
				echo 'ERROR';
			}
		break;
		case 'CAMBIAR_A_ADMIN':
			session_start();
			$_SESSION['usuario']=$_SESSION['usuario_rspl'];
			if($_SESSION['usuario']==$_SESSION['usuario_rspl']){
				echo 'OK';
			}else{
				echo 'ERROR';
			}
		break;
		
		/*case 'GET_INFO_SEGURO':
			$seguro=$_POST['seguro'];
			$sited=$_POST['sited'];
			$ruc='';
			$razon_social='';
			switch ($seguro) {
				case 'PACIFICOSEGUROS':
					$ruc='20332970411';
					$razon_social='PACIFICO COMPAÑIA DE SEGUROS Y REASEGUROS';
					break;
				case 'PACIFICOEPS':
					$ruc='20431115825';
					$razon_social='PACIFICO SA ENTIDAD PRESTADORA DE SALUD';
					break;
				case 'PACIFICOSCTR':
					$ruc='20431115825';
					$razon_social='PACIFICO SA ENTIDAD PRESTADORA DE SALUD';
				break;
				case 'RIMACSEGUROS':
					$ruc='20100041953';
					$razon_social='RIMAC SEGUROS Y REASEGUROS';
				break;
				case 'RIMACEPS':
					$ruc='20414955020';
					$razon_social='RIMAC S.A. ENTIDAD PRESTADORA DE SALUD';
				break;
				case 'RIMACSCTR':
					$ruc='20414955020';
					$razon_social='RIMAC S.A. ENTIDAD PRESTADORA DE SALUD';
				break;
				case 'MAPFRESOAT':
					$ruc='20202380621';
					$razon_social='MAPFRE PERU COMPAÑIA DE SEGUROS Y REASEGUROS S.A.';
				break;
				case 'MAPFREEPS':
					$ruc='20517182673';
					$razon_social='MAPFRE PERU S.A. ENTIDAD PRESTADORA DE SALUD';
				break;
				case 'MAPFRESEGUROS':
					$ruc='20418896915';
					$razon_social='MAPFRE PERU VIDA COMPAÑIA DE SEGUROS Y REASEGUROS';
				break;
				case 'MAPFRESCTR':
					$ruc='20517182673';
					$razon_social='MAPFRE PERU S.A. ENTIDAD PRESTADORA DE SALUD';
				break;
				case 'POSITIVAREEPS':
					$ruc='20601978572';
					$razon_social='LA POSITIVA S.A. ENTIDAD PRESTADORA DE SALUD';
				break;  
				case 'POSITIVASCTR':
					$ruc='20601978572';
					$razon_social='LA POSITIVA S.A. ENTIDAD PRESTADORA DE SALUD';
				break;  
				case 'POSITIVASOAT':
					$ruc='catalogo_positiva';
					$razon_social='LA POSITIVA SEGUROS Y REASEGUROS S.A.';
				break;
				case 'SANITASEPS':
					$ruc='20523470761';
					$razon_social='SANITAS PERU S.A. - EPS';
				break;  
				case 'SANITASSCTR':
					$ruc='20523470761';
					$razon_social='SANITAS PERU S.A. - EPS';
				break;  
				case 'BANCONACION':
					$ruc='20122794424';
					$razon_social='FONDO DE EMPLEADOS DEL BANCO DE LA NACION';
				break;  
				case 'REDSALUD':
					$ruc='20600258894';
					$razon_social='HEALTH CARE ADMINISTRATION RED SALUD S.A.C.';
				break; 
				case 'ELECTROSUR':
					$ruc='catalogo_electrosur';
					$razon_social='ELECTROSUR S.A.';
				break; 
				case 'CHUBB':
					$ruc='20390625007';
					$razon_social='CHUBB PERU S.A. COMPAÑIA DE SEGUROS Y REASEGUROS';
				break;
			}
			
			$query="select a.sited,b.nombre,b.dni from (select sited,seguro,paciente from preliquidacion where estado=1 and sited='$sited') as a join (select * from pacientes where estado=1)as b on a.paciente=b.dni group by sited; ";
			$consulta=mysqli_query($cone,$query);
			
			$nombre='';
			while ($row = mysqli_fetch_assoc($consulta)) : 
				$nombre=$row['nombre'];
			endwhile;


			echo $ruc.'$'.$razon_social.'$'.$nombre;
		break;

		case 'CALCULAR_VENCIMIENTO_CREDITO':
			$hoy = date("Y-m-d");
			$diascredito=$_POST['diascredito'];
			$fecha_base = new DateTime($hoy);
			$feriados = ['2024-06-29','2024-06-30','2024-07-23','2024-07-28','2024-07-29','2024-08-06','2024-08-30','2024-10-08','2024-11-01','2024-12-08','2024-12-09','2024-12-25','2024-12-31'];
	
			$diasSumados=0;
			while ($diasSumados < $diascredito) {
				$fecha_base->modify('+1 day');
				if ($fecha_base->format('N') < 6 && !in_array($fecha_base->format('Y-m-d'), $feriados)) {
					$diasSumados++;
				}
			}

			echo $fecha_base->format('Y-m-d');

		break;
		case 'LIST_PRODUCTOS_FACTURACION':
			$sited=$_POST['sited'];
			$seguro=$_POST['seguro'];
			switch ($seguro) {
				case 'PACIFICOSEGUROS':
					$tabla_pl='catalogo_pacifico';
				break;
				case 'PACIFICOEPS':
					$tabla_pl='catalogo_pacifico';
				break;
				case 'PACIFICOSCTR':
					$tabla_pl='catalogo_pacifico';
				break;
				case 'RIMACSEGUROS':
					$tabla_pl='catalogo_rimac';
				break;
				case 'RIMACEPS':
					$tabla_pl='catalogo_rimac';
				break;
				case 'RIMACSCTR':
					$tabla_pl='catalogo_rimac';
				break;
				case 'MAPFRESOAT':
					$tabla_pl='catalogo_mapfre';
				break;
				case 'MAPFREEPS':
					$tabla_pl='catalogo_mapfre';
				break;
				case 'MAPFRESEGUROS':
					$tabla_pl='catalogo_mapfre';
				break;
				case 'MAPFRESCTR':
					$tabla_pl='catalogo_mapfre';
				break;
				case 'POSITIVASOAT':
					$tabla_pl='catalogo_positiva';
				break;
				case 'POSITIVAEPS':
					$tabla_pl='catalogo_positiva';
				break;  
				case 'POSITIVAREEPS':
					$tabla_pl='catalogo_positiva';
				break;  
				case 'POSITIVASCTR':
					$tabla_pl='catalogo_positiva';
				break;  
				case 'SANITASEPS':
					$tabla_pl='catalogo_sanitas';
				break;  
				case 'SANITASSCTR':
					$tabla_pl='catalogo_sanitas';
				break;  
				case 'BANCONACION':
					$tabla_pl='catalogo_banconacion';
				break;  
				case 'REDSALUD':
					$tabla_pl='catalogo_redsalud';
				break; 
				case 'ELECTROSUR':
					$tabla_pl='catalogo_electrosur';
				break; 
				case 'CHUBB':
					$tabla_pl='catalogo_chubbs';
				break; 
				case 'MINSA':
					$tabla_pl='catalogo_minsa';
				break;          
				default:
					$tabla_pl='catalogo_particular';
				break;
			}

			$flageliminaranterior=0;
			$copagofijo_pl=0;
			$copagovariable_pl=0;
			$subtotal=0;

			$queryjalaventa="select a.*,b.nomenclador,b.unidad from (select * from preliquidacion where sited='$sited' and estado=1)as a join (select * from ".$tabla_pl." where estado=1)as b on a.cod_interno=b.cod_interno; ";
			$consultajalarventa=mysqli_query($cone,$queryjalaventa);
			echo "<table class='table table-bordered table-hover'>";
			echo '<thead style="background-color:#55B7BE;color:#FFFFFF" >';
			echo "<tr>";
			echo "<th>Codigo</th><th>Descripcion</th><th>Cant.</th><th>Precio</th><th>SubTotal</th>";
			echo "</tr>";
			echo '</thead>';

			while ($row = mysqli_fetch_assoc($consultajalarventa)) : 
				$copagofijo_pl=$row['co_pago_fijo'];
				$copagovariable_pl=$row['co_pago_variable'];
				echo "<tr>";
				echo "<td>".$row['cod_interno']."</td><td>".$row['nomenclador']."</td><td>".$row['cantidad']."</td><td>".$row['precio']."</td><td>S/ ".round($row['cantidad']*$row['precio'],2)."</td>";
				echo "</tr>";
				$subtotal=$subtotal+($row['cantidad']*$row['precio']);
			endwhile;
			$queryjalaventa="select a.*,b.nombre_comercial,c.precio_kairos from (select * from preliquidacion_farm where sited='$sited' and estado=1)as a join (select * from ma_medicamento where estado=1)as b join (select * from precios_farmacia where estado=1)as c on a.cod_interno=b.cod_interno and a.cod_interno=c.cod_interno;";
			$consultajalarventa=mysqli_query($cone,$queryjalaventa);
			while ($row = mysqli_fetch_assoc($consultajalarventa)) : 
				echo "<tr>";
				echo "<td>".$row['cod_interno']."</td><td>".$row['nombre_comercial']."</td><td>".$row['cantidad']."</td><td>".$row['precio']."</td><td>S/ ".round($row['cantidad']*$row['precio'],2)."</td>";
				echo "</tr>";
				$subtotal=$subtotal+($row['cantidad']*$row['precio']);
			endwhile;
			echo '<tr>';
			echo '<td></td><td></td><td></td><td><b>SubTotal</b></td><td>S/ '.round($subtotal,2).'</td>';
			echo '</tr>';
			$descuentofactura=($subtotal)*((100-$copagovariable_pl)/100)+($copagofijo_pl/1.18);
			echo '<tr>';
			echo '<td></td><td></td><td></td><td><b>Descuento</b></td><td>S/ '.round($descuentofactura,2).'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td></td><td></td><td></td><td><b>Gravada</b></td><td>S/ '.round($subtotal-$descuentofactura,2).'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td></td><td></td><td></td><td><b>IGV 18.00%</b></td><td>S/ '.round(($subtotal-$descuentofactura)*0.18,2).'</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td></td><td></td><td></td><td><b>Total</b></td><td>S/ '.round(($subtotal-$descuentofactura)*1.18,2).'</td>';
			echo '</tr>';
			echo '</table>';
			echo '<button type="button" class="btn btn-success" onclick="ActualizarImport()">Conforme</button>';       
			break;

		/*case 'GUARDAR_PRE_FACTURACION':
			$sited=$_POST['sited'];
			$seguro=$_POST['seguro'];
			$fecha_colocacion=$_POST['fecha_colocacion'];
			$tipo_comprobante=$_POST['tipo_comprobante'];

			if($fecha_colocacion=='' || $tipo_comprobante==''){
				echo 'ERROR';
			}else{
				$queryeliminar="delete from cab_facturacion_seguros where sited='$sited' and seguro='$seguro' ";
				$consultaeliminar=mysqli_query($cone,$queryeliminar);
				$queryinsert="insert into cab_facturacion_seguros (fecha_colocacion, sited, seguro, tipo_comprobante,estado) values ('$fecha_colocacion','$sited','$seguro','$tipo_comprobante','1')";
				$consultainsert=mysqli_query($cone,$queryinsert);
				if ($consultainsert !== false) {
					echo 'OK';
				}else{
					echo 'ERROR';
				}
			}
		break;*/

		default:
			# code...
		break;

	}


}

?>