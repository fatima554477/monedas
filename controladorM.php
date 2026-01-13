<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

define('__ROOT1__', dirname(dirname(__FILE__)));
include_once (__ROOT1__."/includes/error_reporting.php");
include_once (__ROOT1__."/MONEDAS/class.epcinnM.php");

$monedas = NEW accesoclase();
$conexion = NEW colaboradores();

$listar_temporal = isset($_POST["listar_temporal"])?$_POST["listar_temporal"]:"";
$campo_temporal = isset($_POST["campo"])?$_POST["campo"]:"";
$campos_temporales_permitidos = array('IMAGENDOLARES', 'IMAGENEUROS', 'IMAGENTODOS', 'IMAGENLIBRA');
if($listar_temporal == 'listar_temporal' && in_array($campo_temporal, $campos_temporales_permitidos, true)){
	$sessionidem = isset($_SESSION['idem'])?$_SESSION['idem']:'';
	$fecha = date('Y-m-d');
	$querycontras_temporal = $monedas->Listado_fotosgUARDARMONEDAtemporal($campo_temporal, $fecha, $sessionidem);
	while($row_temporal = mysqli_fetch_array($querycontras_temporal)){
		if($row_temporal[$campo_temporal] != ""){
			$fecha_registro = isset($row_temporal['fecha']) ? $row_temporal['fecha'] : '';
			echo "<a target='_blank' href='includes/archivos/".$row_temporal[$campo_temporal]."' id='A".$row_temporal['id']."' >Visualizar!</a> "." <span id='".$row_temporal['id']."' class='view_dataAEborrar' style='cursor:pointer;color:blue;'>Borrar!</span><span > ".$fecha_registro."</span>".'<br/>';
		}
	}
exit;
}

$listar_tabla = isset($_POST["listar_tabla"])?$_POST["listar_tabla"]:"";
$tipo_tabla = isset($_POST["tipo_tabla"])?$_POST["tipo_tabla"]:"";
if($listar_tabla === 'listar_tabla'){
	function render_monedas_rows($querycontras, $imagenCampo, $permisoModulo, $viewClass, $borrarClass, $checkboxWidth){
		$monedas = $GLOBALS['monedas'];
		$conexion = $GLOBALS['conexion'];
		$html = '';
		while($row = mysqli_fetch_array($querycontras)){
			$urlIMAGEN_MONEDAS = '';
			$urlIMAGEN_MONEDASid = $monedas->listado_fotos_moneda($row["id"]);
			while($rowfotos = mysqli_fetch_array($urlIMAGEN_MONEDASid)){
				$urlIMAGEN_MONEDAS .= $conexion->descargararchivo($rowfotos[$imagenCampo]);
			}
			$html .= "<tr>";
			$html .= "<td><input type=\"checkbox\" style=\"width:".$checkboxWidth."\" class=\"form-check-input\" name=\"fotosve[]\" id=\"fotosve\" value=\"".$row["id"]."\"/></td>";
			$html .= "<td>".$row["MONEDAS"]."</td>";
			$html .= "<td>".$row["ISO"]."</td>";
			$html .= "<td>".$row["BANCO_MONEDAS"]."</td>";
			$html .= "<td>".$row["FECHA_TIPO"]."</td>";
			$html .= "<td>".$row["HORA_TIPO"]."</td>";
			$html .= "<td>".$row["TIPO_CAMBIO1"]."</td>";
			$html .= "<td>".$row["TIPO_CAMBIO2"]."</td>";
			$html .= "<td>".$row["TIPO_CAMBIO"]."</td>";
			$html .= "<td>".$urlIMAGEN_MONEDAS."</td>";
			$html .= "<td>".$row["OBSERVACIONES_MONEDAS"]."</td>";
			$html .= "<td>".$row["FECHA_MONEDAS"]."</td>";
			if($conexion->variablespermisos('', $permisoModulo, 'modificar')=='si'){
				$html .= "<td><input type=\"button\" name=\"view\" value=\"MODIFICAR\" id=\"".$row["id"]."\" class=\"btn btn-info btn-xs ".$viewClass."\" /></td>";
			}
			if($conexion->variablespermisos('', $permisoModulo, 'borrar')=='si'){
				$html .= "<td><input type=\"button\" name=\"view2\" value=\"BORRAR\" id=\"".$row["id"]."\" class=\"btn btn-info btn-xs ".$borrarClass."\" /></td>";
			}
			$html .= "</tr>";
		}
		return $html;
	}

	switch($tipo_tabla){
		case 'DOLAR':
			echo render_monedas_rows($monedas->Listado_MONEDAS(), 'IMAGENDOLARES', 'AGREGANUEVO_DOLAR', 'view_MONEDAS', 'view_dataMONEDASborrar', '12%');
			break;
		case 'EURO':
			echo render_monedas_rows($monedas->Listado_EURO(), 'IMAGENEUROS', 'AGREGANUEVO_EURO', 'view_MONEDAS2', 'view_dataMONEDASborrar2', '12%');
			break;
		case 'TODOS':
			echo render_monedas_rows($monedas->Listado_MONEDATODOS(), 'IMAGENTODOS', 'AGREGANUEVO_TODOS', 'view_MONEDAS3', 'view_dataMONEDASborrar3', '12%');
			break;
		case 'LIBRA':
			echo render_monedas_rows($monedas->Listado_MONEDA4(), 'IMAGENLIBRA', 'LIBRAE', 'view_MONEDAS4', 'view_dataMONEDASborrar4', '12%');
			break;
	}
	exit;
}

$hMONEDAS = isset($_POST["hMONEDAS"])?$_POST["hMONEDAS"]:"";
$enviarMONEDAS = isset($_POST["enviarMONEDAS"])?$_POST["enviarMONEDAS"]:"";
$IpMONEDAS = isset($_POST["IpMONEDAS"])?$_POST["IpMONEDAS"]:"";

$borra_MONEDAS = isset($_POST["borra_MONEDAS"])?$_POST["borra_MONEDAS"]:"";
$EMAIL_MONEDAS = isset($_POST["EMAIL_MONEDAS"])?$_POST["EMAIL_MONEDAS"]:"";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$hEUROS = isset($_POST["hEUROS"])?$_POST["hEUROS"]:"";
$enviarMONEDAS2 = isset($_POST["enviarMONEDAS2"])?$_POST["enviarMONEDAS2"]:"";
$IpMONEDAS2 = isset($_POST["IpMONEDAS2"])?$_POST["IpMONEDAS2"]:"";
$borra_MONEDAS2 = isset($_POST["borra_MONEDAS2"])?$_POST["borra_MONEDAS2"]:"";
$EMAIL_MONEDAS2= isset($_POST["EMAIL_MONEDAS2"])?$_POST["EMAIL_MONEDAS2"]:"";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$hTODOS = isset($_POST["hTODOS"])?$_POST["hTODOS"]:"";
$enviarMONEDAS3 = isset($_POST["enviarMONEDAS3"])?$_POST["enviarMONEDAS3"]:"";
$IpMONEDAS3 = isset($_POST["IpMONEDAS3"])?$_POST["IpMONEDAS3"]:"";
$borra_MONEDAS3 = isset($_POST["borra_MONEDAS3"])?$_POST["borra_MONEDAS3"]:"";
$EMAIL_MONEDAS3= isset($_POST["EMAIL_MONEDAS3"])?$_POST["EMAIL_MONEDAS3"]:"";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$hMONEDAS4 = isset($_POST["hMONEDAS4"])?$_POST["hMONEDAS4"]:"";
$enviarMONEDAS4 = isset($_POST["enviarMONEDAS4"])?$_POST["enviarMONEDAS4"]:"";
$IpMONEDAS4 = isset($_POST["IpMONEDAS4"])?$_POST["IpMONEDAS4"]:"";
$borra_MONEDAS4 = isset($_POST["borra_MONEDAS4"])?$_POST["borra_MONEDAS4"]:"";
$EMAIL_MONEDAS4= isset($_POST["EMAIL_MONEDAS4"])?$_POST["EMAIL_MONEDAS4"]:"";



$hnuevodocubanco= isset($_POST["hnuevodocubanco"])?$_POST["hnuevodocubanco"]:"";
//hnuevodocubanco
if($hnuevodocubanco == 'hnuevodocubanco'){
   $BANCO = isset($_POST["BANCO"])?$_POST["BANCO"]:"";	 
   echo $monedas->NUEVODOCUBANCO($BANCO, $hnuevodocubanco);
   }


$borra_BANCO= isset($_POST["borra_BANCO"])?$_POST["borra_BANCO"]:"";
if($borra_BANCO == 'borra_BANCO'){	 
   $borra_BANCO_IP = isset($_POST["borra_BANCO_IP"])?$_POST["borra_BANCO_IP"]:"";
   echo $monedas->BORRAREGISTRO_banco( $borra_BANCO_IP );
}




if($hMONEDAS == 'hMONEDAS' or $enviarMONEDAS=='enviarMONEDAS'){

					 
   $MONEDAS = isset($_POST["MONEDAS"])?$_POST["MONEDAS"]:"";
   $ISO = isset($_POST["ISO"])?$_POST["ISO"]:"";
   $BANCO_MONEDAS = isset($_POST["BANCO_MONEDAS"])?$_POST["BANCO_MONEDAS"]:"";
   $TIPO_CAMBIO = isset($_POST["TIPO_CAMBIO"])?$_POST["TIPO_CAMBIO"]:"";
   
   $FECHA_TIPO = isset($_POST["FECHA_TIPO"])?$_POST["FECHA_TIPO"]:"";
   $HORA_TIPO = isset($_POST["HORA_TIPO"])?$_POST["HORA_TIPO"]:"";
   
   $TIPO_CAMBIO1 = isset($_POST["TIPO_CAMBIO1"])?$_POST["TIPO_CAMBIO1"]:"";
   $TIPO_CAMBIO2 = isset($_POST["TIPO_CAMBIO2"])?$_POST["TIPO_CAMBIO2"]:"";
   $OBSERVACIONES_MONEDAS = isset($_POST["OBSERVACIONES_MONEDAS"])?$_POST["OBSERVACIONES_MONEDAS"]:"";
   $FECHA_MONEDAS = isset($_POST["FECHA_MONEDAS"])?$_POST["FECHA_MONEDAS"]:"";
   $hMONEDAS = isset($_POST["hMONEDAS"])?$_POST["hMONEDAS"]:""; 
				 
				 
					 
   echo $monedas->monedas($MONEDAS ,$ISO,$BANCO_MONEDAS, $FECHA_TIPO, $HORA_TIPO, $TIPO_CAMBIO ,$TIPO_CAMBIO1,$TIPO_CAMBIO2,$OBSERVACIONES_MONEDAS,$IMAGEN_MONEDAS1, $FECHA_MONEDAS , $hMONEDAS,$IpMONEDAS,$enviarMONEDAS );
				 
					
				   
   }
   elseif($EMAIL_MONEDAS ==true){
   $conexion2 = new herramientas();
   $NOMBRE_1 = 'Peticion';
   $EMAILnombre = array($EMAIL_MONEDAS=>$NOMBRE_1);
   $adjuntos = array(''=>'');
   $Subject = 'DATOS SOLICITADOS';
	/*nuevo*/
   $array = isset($_POST['MONEDAS'])?$_POST['MONEDAS']:'';
   if($array != ''){
   $loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
   $or1='';
   for($rrr=0;$rrr<=$loopcuenta;$rrr++){
   if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
   $query1 .= ' id= '.$array[$rrr].$or1;
   }
   $query2 = str_replace('[object Object]','',$query1);
   $query2 = "and (".$query2.") ";
   }else{
   echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
   } 
																				   
   $MANDA_INFORMACION = $monedas->MANDA_INFORMACION('MONEDAS, TIPO_CAMBIO, FECHA_MONEDAS ',
				 
   'NOMBRE ,OBSERVACIONES,FECHA', '13MONEDAS',  " where idRelacion = '".$_SESSION['id'] ."' ".$query2/*nuevo*/ );
   $variables = 'ADJUNTO_MONEDAS, ';
   //MONEDAS trim($variables, ',');
				 
   $cadenacompleta =substr($variables, 0, -2);
				  
   $adjuntos = $monedas->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'13MONEDAS', " where idRelacion = '".$_SESSION['id'] ."' ".$query2 );
				 
   $html = $conexion->html2('MONEDAS',$MANDA_INFORMACION );
				 
   $logo = 'ADJUNTAR_LOGO_INFORMACION_2023_05_31_07_45_49.jpg';
//$idlogo = $monedas->variable_comborelacion1a();
//$logo = $monedas->variables_informacionfiscal_logo($idlogo);
				 
   $embebida = array('../includes/archivos/'.$logo => 'ver');
   echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
   }  
					 
	if($borra_MONEDAS == 'borra_MONEDAS' ){
				 
   $borra_moneda = isset($_POST["borra_moneda"])?$_POST["borra_moneda"]:"";
   echo $monedas->borra_MONEDAS( $borra_moneda );
   }	
   	   //include_once (__ROOT1__."/includes/crea_funciones.php");




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if($hEUROS == 'hEUROS' or $enviarMONEDAS2=='enviarMONEDAS2'){

					 
   $MONEDAS = isset($_POST["MONEDAS"])?$_POST["MONEDAS"]:"";
   $ISO = isset($_POST["ISO"])?$_POST["ISO"]:"";
   $BANCO_MONEDAS = isset($_POST["BANCO_MONEDAS"])?$_POST["BANCO_MONEDAS"]:"";
   $TIPO_CAMBIO = isset($_POST["TIPO_CAMBIO"])?$_POST["TIPO_CAMBIO"]:"";
   
   $FECHA_TIPO = isset($_POST["FECHA_TIPO"])?$_POST["FECHA_TIPO"]:"";
   $HORA_TIPO = isset($_POST["HORA_TIPO"])?$_POST["HORA_TIPO"]:"";
   
   $TIPO_CAMBIO1 = isset($_POST["TIPO_CAMBIO1"])?$_POST["TIPO_CAMBIO1"]:"";
   $TIPO_CAMBIO2 = isset($_POST["TIPO_CAMBIO2"])?$_POST["TIPO_CAMBIO2"]:"";
   $OBSERVACIONES_MONEDAS = isset($_POST["OBSERVACIONES_MONEDAS"])?$_POST["OBSERVACIONES_MONEDAS"]:"";
   $FECHA_MONEDAS = isset($_POST["FECHA_MONEDAS"])?$_POST["FECHA_MONEDAS"]:"";
   $hEUROS = isset($_POST["hEUROS"])?$_POST["hEUROS"]:""; 
				 
				 
					 
   echo $monedas->monedas2($MONEDAS ,$ISO,$BANCO_MONEDAS,$FECHA_TIPO, $HORA_TIPO, $TIPO_CAMBIO,$TIPO_CAMBIO1,$TIPO_CAMBIO2,$OBSERVACIONES_MONEDAS,$IMAGEN_MONEDAS, $FECHA_MONEDAS , $hEUROS,$IpMONEDAS2,$enviarMONEDAS2 );
				 
					
				   
   }
   elseif($EMAIL_MONEDAS2 ==true){
   $conexion2 = new herramientas();
   $NOMBRE_1 = 'Peticion';
   $EMAILnombre = array($EMAIL_MONEDAS2=>$NOMBRE_1);
   $adjuntos = array(''=>'');
   $Subject = 'DATOS SOLICITADOS';
	/*nuevo*/
   $array = isset($_POST['MONEDAS2'])?$_POST['MONEDAS2']:'';
   if($array != ''){
   $loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
   $or1='';
   for($rrr=0;$rrr<=$loopcuenta;$rrr++){
   if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
   $query1 .= ' id= '.$array[$rrr].$or1;
   }
   $query2 = str_replace('[object Object]','',$query1);
   $query2 = "and (".$query2.") ";
   }else{
   echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
   } 
																				   
   $MANDA_INFORMACION = $monedas->MANDA_INFORMACION('MONEDAS, TIPO_CAMBIO, FECHA_MONEDAS ',
				 
   'NOMBRE ,OBSERVACIONES,FECHA', '13MONEDAS',  " where idRelacion = '".$_SESSION['id'] ."' ".$query2/*nuevo*/ );
   $variables = 'ADJUNTO_MONEDAS, ';
   //MONEDAS trim($variables, ',');
				 
   $cadenacompleta =substr($variables, 0, -2);
				  
   $adjuntos = $monedas->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'13MONEDAS', " where idRelacion = '".$_SESSION['id'] ."' ".$query2 );
				 
   $html = $conexion->html2('MONEDAS',$MANDA_INFORMACION );
				 
   $logo = 'ADJUNTAR_LOGO_INFORMACION_2023_05_31_07_45_49.jpg';
//$idlogo = $monedas->variable_comborelacion1a();
//$logo = $monedas->variables_informacionfiscal_logo($idlogo);
				 
   $embebida = array('../includes/archivos/'.$logo => 'ver');
   echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
   }  
					 
	if($borra_MONEDAS2 == 'borra_MONEDAS2' ){
				 
   $borra_moneda2 = isset($_POST["borra_moneda2"])?$_POST["borra_moneda2"]:"";
   echo $monedas->borra_MONEDAS2( $borra_moneda2 );
   }	
   	   //include_once (__ROOT1__."/includes/crea_funciones.php");	


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if($hTODOS == 'hTODOS' or $enviarMONEDAS3=='enviarMONEDAS3'){

	
					 
   $MONEDAS = isset($_POST["MONEDAS"])?$_POST["MONEDAS"]:"";
   $ISO = isset($_POST["ISO"])?$_POST["ISO"]:"";
   $BANCO_MONEDAS = isset($_POST["BANCO_MONEDAS"])?$_POST["BANCO_MONEDAS"]:"";
   $TIPO_CAMBIO = isset($_POST["TIPO_CAMBIO"])?$_POST["TIPO_CAMBIO"]:"";
      $FECHA_TIPO = isset($_POST["FECHA_TIPO"])?$_POST["FECHA_TIPO"]:"";
   $HORA_TIPO = isset($_POST["HORA_TIPO"])?$_POST["HORA_TIPO"]:"";
   $TIPO_CAMBIO1 = isset($_POST["TIPO_CAMBIO1"])?$_POST["TIPO_CAMBIO1"]:"";
   $TIPO_CAMBIO2 = isset($_POST["TIPO_CAMBIO2"])?$_POST["TIPO_CAMBIO2"]:"";
   $OBSERVACIONES_MONEDAS = isset($_POST["OBSERVACIONES_MONEDAS"])?$_POST["OBSERVACIONES_MONEDAS"]:"";
   $FECHA_MONEDAS = isset($_POST["FECHA_MONEDAS"])?$_POST["FECHA_MONEDAS"]:"";
   $hTODOS = isset($_POST["hTODOS"])?$_POST["hTODOS"]:""; 
				 
				 
					 
   echo $monedas->monedas3($MONEDAS ,$ISO,$BANCO_MONEDAS,$FECHA_TIPO, $HORA_TIPO, $TIPO_CAMBIO ,$TIPO_CAMBIO1,$TIPO_CAMBIO2,$OBSERVACIONES_MONEDAS,$IMAGEN_MONEDAS1, $FECHA_MONEDAS , $hTODOS,$IpMONEDAS3,$enviarMONEDAS3 );
				 
					
				   
   }
   elseif($EMAIL_MONEDAS3 ==true){
   $conexion2 = new herramientas();
   $NOMBRE_1 = 'Peticion';
   $EMAILnombre = array($EMAIL_MONEDAS3=>$NOMBRE_1);
   $adjuntos = array(''=>'');
   $Subject = 'DATOS SOLICITADOS';
	/*nuevo*/
   $array = isset($_POST['MONEDAS3'])?$_POST['MONEDAS3']:'';
   if($array != ''){
   $loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
   $or1='';
   for($rrr=0;$rrr<=$loopcuenta;$rrr++){
   if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
   $query1 .= ' id= '.$array[$rrr].$or1;
   }
   $query2 = str_replace('[object Object]','',$query1);
   $query2 = "and (".$query2.") ";
   }else{
   echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
   } 
																				   
   $MANDA_INFORMACION = $monedas->MANDA_INFORMACION('MONEDAS, TIPO_CAMBIO, FECHA_MONEDAS ',
				 
   'NOMBRE ,OBSERVACIONES,FECHA', '13MONEDAS',  " where idRelacion = '".$_SESSION['id'] ."' ".$query2/*nuevo*/ );
   $variables = 'ADJUNTO_MONEDAS, ';
   //MONEDAS trim($variables, ',');
				 
   $cadenacompleta =substr($variables, 0, -2);
				  
   $adjuntos = $monedas->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'13MONEDAS', " where idRelacion = '".$_SESSION['id'] ."' ".$query2 );
				 
   $html = $conexion->html2('MONEDAS',$MANDA_INFORMACION );
				 
   $logo = 'ADJUNTAR_LOGO_INFORMACION_2023_05_31_07_45_49.jpg';

				 
   $embebida = array('../includes/archivos/'.$logo => 'ver');
   echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
   }  
					 
	if($borra_MONEDAS3 == 'borra_MONEDAS3' ){
				 
   $borra_moneda3 = isset($_POST["borra_moneda3"])?$_POST["borra_moneda3"]:"";
   echo $monedas->borra_MONEDAS3( $borra_moneda3 );
   }	
   	   //include_once (__ROOT1__."/includes/crea_funciones.php");	



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if($hMONEDAS4 == 'hMONEDAS4' or $enviarMONEDAS4=='enviarMONEDAS4'){

	
					 
   $MONEDAS = isset($_POST["MONEDAS"])?$_POST["MONEDAS"]:"";
   $ISO = isset($_POST["ISO"])?$_POST["ISO"]:"";
   $BANCO_MONEDAS = isset($_POST["BANCO_MONEDAS"])?$_POST["BANCO_MONEDAS"]:"";
   $TIPO_CAMBIO = isset($_POST["TIPO_CAMBIO"])?$_POST["TIPO_CAMBIO"]:"";
      $FECHA_TIPO = isset($_POST["FECHA_TIPO"])?$_POST["FECHA_TIPO"]:"";
   $HORA_TIPO = isset($_POST["HORA_TIPO"])?$_POST["HORA_TIPO"]:"";
   $TIPO_CAMBIO1 = isset($_POST["TIPO_CAMBIO1"])?$_POST["TIPO_CAMBIO1"]:"";
   $TIPO_CAMBIO2 = isset($_POST["TIPO_CAMBIO2"])?$_POST["TIPO_CAMBIO2"]:"";
   $OBSERVACIONES_MONEDAS = isset($_POST["OBSERVACIONES_MONEDAS"])?$_POST["OBSERVACIONES_MONEDAS"]:"";
   $FECHA_MONEDAS = isset($_POST["FECHA_MONEDAS"])?$_POST["FECHA_MONEDAS"]:"";
   $hMONEDAS4 = isset($_POST["hMONEDAS4"])?$_POST["hMONEDAS4"]:""; 
				 
				 
					 
   echo $monedas->MONEDAS4($MONEDAS ,$ISO,$BANCO_MONEDAS,$FECHA_TIPO, $HORA_TIPO, $TIPO_CAMBIO ,$TIPO_CAMBIO1,$TIPO_CAMBIO2,$OBSERVACIONES_MONEDAS,$IMAGEN_MONEDAS1, $FECHA_MONEDAS , $hMONEDAS4,$IpMONEDAS4,$enviarMONEDAS4 );
				 
					
				   
   }
   elseif($EMAIL_MONEDAS4 ==true){
   $conexion2 = new herramientas();
   $NOMBRE_1 = 'Peticion';
   $EMAILnombre = array($EMAIL_MONEDAS4=>$NOMBRE_1);
   $adjuntos = array(''=>'');
   $Subject = 'DATOS SOLICITADOS';
	/*nuevo*/
   $array = isset($_POST['MONEDAS4'])?$_POST['MONEDAS4']:'';
   if($array != ''){
   $loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
   $or1='';
   for($rrr=0;$rrr<=$loopcuenta;$rrr++){
   if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
   $query1 .= ' id= '.$array[$rrr].$or1;
   }
   $query2 = str_replace('[object Object]','',$query1);
   $query2 = "and (".$query2.") ";
   }else{
   echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
   } 
																				   
   $MANDA_INFORMACION = $monedas->MANDA_INFORMACION('MONEDAS, TIPO_CAMBIO, FECHA_MONEDAS ',
				 
   'NOMBRE ,OBSERVACIONES,FECHA', '13MONEDAS',  " where idRelacion = '".$_SESSION['id'] ."' ".$query2 );
   $variables = 'ADJUNTO_MONEDAS, ';

				 
   $cadenacompleta =substr($variables, 0, -2);
				  
   $adjuntos = $monedas->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'13MONEDAS', " where idRelacion = '".$_SESSION['id'] ."' ".$query2 );
				 
   $html = $conexion->html2('MONEDAS',$MANDA_INFORMACION );
				 
   $logo = 'ADJUNTAR_LOGO_INFORMACION_2023_05_31_07_45_49.jpg';

				 
   $embebida = array('../includes/archivos/'.$logo => 'ver');
   echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
   }  
					 
	if($borra_MONEDAS4 == 'borra_MONEDAS4' ){
				 
   $borra_moneda4 = isset($_POST["borra_moneda4"])?$_POST["borra_moneda4"]:"";
   echo $monedas->borra_MONEDAS4( $borra_moneda4 );
   }	
   



//IMAGENDOLARES

$actualizaDOLARES = isset($_POST["actualizaDOLARES"])?$_POST["actualizaDOLARES"]:"";//desde vista previa
$IpMONEDAS = isset($_POST["IpMONEDAS"])?$_POST["IpMONEDAS"]:"";
	if($IpMONEDAS == true and $_FILES["IMAGENDOLARES1"]==TRUE and $actualizaDOLARES == 'actualizaDOLARES'  ){
		foreach($_FILES AS $ETQIETA => $VALOR){
			$session_relacion = $_SESSION['idem'];
			$monedas->cargarMONEDA($ETQIETA,'MONEDA','IMAGENDOLARES','13MONEDAfotos',$session_relacion,$IpMONEDAS,'no');
			echo $monedas->listado_links_generico_moneda($IpMONEDAS,'13MONEDAfotos','IMAGENDOLARES','view_dolar_Bborrar');	
		}	
	}

$borrasDolares = isset($_POST["borrasDolares"])?$_POST["borrasDolares"]:"";
if($borrasDolares =='borrasDolares'){
	$borra_id_Dolares = isset($_POST["borra_id_Dolares"])?$_POST["borra_id_Dolares"]:"";   
		echo ' - '.  $monedas->borrafotomoneda($borra_id_Dolares);
}

//IMAGEN EUROS

$actualizaEUROS = isset($_POST["actualizaEUROS"])?$_POST["actualizaEUROS"]:"";//desde vista previa
$IpMONEDAS2 = isset($_POST["IpMONEDAS2"])?$_POST["IpMONEDAS2"]:"";
	if($IpMONEDAS2 == true and $_FILES["IMAGENEUROS22"]==TRUE and $actualizaEUROS == 'actualizaEUROS'  ){
		foreach($_FILES AS $ETQIETA => $VALOR){
			$session_relacion = $_SESSION['idem'];
			$monedas->cargarMONEDA($ETQIETA,'MONEDA','IMAGENEUROS','13MONEDAfotos',$session_relacion,$IpMONEDAS2,'no');
			echo $monedas->listado_links_generico_moneda($IpMONEDAS2,'13MONEDAfotos','IMAGENEUROS','view_EURO_Bborrar');	
		}	
	}

$borrasEUROS = isset($_POST["borrasEUROS"])?$_POST["borrasEUROS"]:"";
if($borrasEUROS =='borrasEUROS'){
	$borra_id_EUROS = isset($_POST["borra_id_EUROS"])?$_POST["borra_id_EUROS"]:"";   
		echo ' - '.  $monedas->borrafotomoneda($borra_id_EUROS);
}





//IMAGEN TODOS

$actualizaTODOS = isset($_POST["actualizaTODOS"])?$_POST["actualizaTODOS"]:"";//desde vista previa
$IpMONEDAS3 = isset($_POST["IpMONEDAS3"])?$_POST["IpMONEDAS3"]:"";
	if($IpMONEDAS3 == true and $_FILES["IMAGENTODOS3"]==TRUE and $actualizaTODOS == 'actualizaTODOS'  ){
		foreach($_FILES AS $ETQIETA => $VALOR){
			$session_relacion = $_SESSION['idem'];
			$monedas->cargarMONEDA($ETQIETA,'MONEDA','IMAGENTODOS','13MONEDAfotos',$session_relacion,$IpMONEDAS3,'no');
			echo $monedas->listado_links_generico_moneda($IpMONEDAS3,'13MONEDAfotos','IMAGENTODOS','view_todos_Bborrar');	
		}	
	}
//borra_id_TODOS
$borrasTODOS = isset($_POST["borrasTODOS"])?$_POST["borrasTODOS"]:"";//borra_id_TODOS
if($borrasTODOS =='borrasTODOS'){
	$borra_id_TODOS = isset($_POST["borra_id_TODOS"])?$_POST["borra_id_TODOS"]:"";   
		echo ' - '.   $monedas->borrafotomoneda($borra_id_TODOS);
}





//IMAGEN LIBRA

$actualizaLIBRA = isset($_POST["actualizaLIBRA"])?$_POST["actualizaLIBRA"]:"";//desde vista previa
$IpMONEDAS4 = isset($_POST["IpMONEDAS4"])?$_POST["IpMONEDAS4"]:"";
	if($IpMONEDAS4 == true and $_FILES["IMAGENLIBRA4"]==TRUE and $actualizaLIBRA == 'actualizaLIBRA'  ){
		foreach($_FILES AS $ETQIETA => $VALOR){
			$session_relacion = $_SESSION['idem'];
			$monedas->cargarMONEDA($ETQIETA,'MONEDA','IMAGENLIBRA','13MONEDAfotos',$session_relacion,$IpMONEDAS4,'no');
			echo $monedas->listado_links_generico_moneda($IpMONEDAS4,'13MONEDAfotos','IMAGENLIBRA','view_LIBRA_Bborrar');	
		}	
	}

$borrasLIBRA = isset($_POST["borrasLIBRA"])?$_POST["borrasLIBRA"]:"";
if($borrasLIBRA =='borrasLIBRA'){
	$borra_id_LIBRA = isset($_POST["borra_id_LIBRA"])?$_POST["borra_id_LIBRA"]:"";   
		echo ' - '. $monedas->borrafotomoneda($borra_id_LIBRA);
}




if(( $_FILES["IMAGENDOLARES"] !='' and $hMONEDAS =='' ) ){
	foreach($_FILES AS $ETQIETA => $VALOR){
		$session_relacion = $_SESSION['idem'];
		echo $monedas->cargarMONEDA($ETQIETA,'MONEDA','IMAGENDOLARES','13MONEDAfotos',$session_relacion,$idpost,'si');
	}
}

if(( $_FILES["IMAGENEUROS"] !='' and $hEUROS =='' ) ){
	foreach($_FILES AS $ETQIETA => $VALOR){
		$session_relacion = $_SESSION['idem'];
		echo $monedas->cargarMONEDA($ETQIETA,'MONEDA','IMAGENEUROS','13MONEDAfotos',$session_relacion,$idpost,'si');
	}
}

if(( $_FILES["IMAGENTODOS"] !='' and $hTODOS =='' ) ){
	foreach($_FILES AS $ETQIETA => $VALOR){
		$session_relacion = $_SESSION['idem'];
		echo $monedas->cargarMONEDA($ETQIETA,'MONEDA','IMAGENTODOS','13MONEDAfotos',$session_relacion,$idpost,'si');
	}
}

if(( $_FILES["IMAGENLIBRA"] !='' and $hMONEDAS4 =='' ) ){
	foreach($_FILES AS $ETQIETA => $VALOR){
		$session_relacion = $_SESSION['idem'];
		echo $monedas->cargarMONEDA($ETQIETA,'MONEDA','IMAGENLIBRA','13MONEDAfotos',$session_relacion,$idpost,'si');
	}
}
?>