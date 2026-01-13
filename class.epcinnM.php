<?php
/*
clase EPC INNOVA
CREADO : 10/mayo/2023
TESTER: FATIMA ARELLANO
PROGRAMER: SANDOR ACTUALIZACION: 1 MAY 2023

*/
	define('__ROOT3__', dirname(dirname(__FILE__)));
	require __ROOT3__."/includes/class.epcinn.php";	
	

	
	class accesoclase extends colaboradores{


	public function Listado_fotosgUARDARMONEDAtemporal($CAMPO,$fecha,$idrelacionsesion){
		$conn = $this->db();

		$variablequery = "select id, ".$CAMPO." from 13MONEDAfotos where 
		(".$CAMPO." is not null or ".$CAMPO." <> '') and BANDERA = 'si'
		and idrelacionsesion = '".$idrelacionsesion."'
		order by id desc ";
		$arrayquery1 = mysqli_query($conn,$variablequery) or die(mysqli_error($conn));
		return $arrayquery1;
	}

	public function borra_fotosgUARDARMONEDAtemporal($idrelacionsesion){
		$conn = $this->db();
		$variablequery = "delete from 13MONEDAfotos where 
		idrelacionsesion = '".$idrelacionsesion."'
		and BANDERA = 'si' ";
		mysqli_query($conn,$variablequery) or die(mysqli_error($conn));
	}


	public function sologuardarMONEDA($archivo,$nuevonombre,$campo,$nombretabla,$idrelacionsesion,$idpost,$BANDERA){
		$conn = $this->db();//idrelacionsesion
		$fecha = DATE('Y-m-d');
		if($idpost==''){$idpost = 'null';}
		$variablequery2 = 
		"insert into ".$nombretabla." 
		(".$campo.",fecha,idrelacionsesion, BANDERA, idRelacion) 
		values 
		('".$nuevonombre."','".$fecha."','".$idrelacionsesion."','".$BANDERA."','".$idpost."') ";
		mysqli_query($conn,$variablequery2)or die('class.epcinnmm.49'.mysqli_error($conn));
		}

	public function cargarMONEDA($archivo,$IDENTIFICADOR,$campo,$nombretabla,$idrelacionsesion,$idpost,$BANDERA)
	{
		$nombre_carpeta=__ROOT3__.'/includes/archivos';
		$filehandle = opendir($nombre_carpeta);
		$nombretemp = $_FILES[$archivo]["tmp_name"];
		$nombrearchivo = $_FILES[$archivo]["name"];
		$tamanyoarchivo = $_FILES[$archivo]["size"];
		//$tipoarchivo = getimagesize($nombretemp);
		$extension = explode('.',$nombrearchivo);
		$cuenta = count($extension) - 1;
		$nuevonombre =  $archivo.'_'.date('Y_m_d_h_i_s').'.'.$extension[$cuenta];
		 $extension[$cuenta];

		if( 
		strtolower($extension[$cuenta]) == 'pdf' or 
		strtolower($extension[$cuenta]) == 'gif' or 
		strtolower($extension[$cuenta]) == 'jpeg' or 
		strtolower($extension[$cuenta]) == 'jpg' or 
		strtolower($extension[$cuenta]) == 'png' or 
		strtolower($extension[$cuenta]) == 'mp4' or 
		strtolower($extension[$cuenta]) == 'docx' or 
		strtolower($extension[$cuenta]) == 'doc' or 
		strtolower($extension[$cuenta]) == 'xml' or 
		strtolower($extension[$cuenta]) == 'txt' or
		strtolower($extension[$cuenta]) == 'xlsx' or
		strtolower($extension[$cuenta]) == 'htm' or
		strtolower($extension[$cuenta]) == 'xls'  		
		){ //gif o jpg
		/*if ($tamanyoarchivo <= $tamanyomax) { //archivo demasioado grande*/
		if(move_uploaded_file($nombretemp, $nombre_carpeta.'/'. $nuevonombre)){
		chmod ($nombre_carpeta.'/' . $nuevonombre, 0755);
		$tamanyo =fileSize($nombre_carpeta.'/'. $nuevonombre);
		$fp = fopen($nombre_carpeta.'/'.$nuevonombre, "rb"); 
		$contenido = fread($fp, $tamanyo);
		$contenido = addslashes($contenido);
		if($IDENTIFICADOR=='MONEDA'){
			//$archivo,$nuevonombre,$campo,$nombretabla,$idrelacionsesion,$BANDERA
		$this->sologuardarMONEDA($archivo,$nuevonombre,$campo,$nombretabla,$idrelacionsesion,$idpost,$BANDERA);
		}
		
		return trim($nuevonombre);
		}
		else{
			return "1";
		}
		}
		else{
			return "2";
		}
	}

/*select id,IMAGEN_MONEDAS from 13MONEDAfotos where idRelacion = '160' order by id desc */
	public function listado_links_generico_moneda($idrow,$tabla,$campo,$jqueryborrar){
		$conn = $this->db();
		$urlSUBIR_COTIZACION = '';
		$variablequery = "select id,".$campo." from ".$tabla." where idRelacion = '".$idrow."' and bandera = 'no' and (".$campo." is not null or ".$campo." <> '' ) order by id desc ";
		$arrayquery = mysqli_query($conn,$variablequery);
		while($rowDOCTOS = mysqli_fetch_array($arrayquery, MYSQLI_ASSOC))
		{
			if($rowDOCTOS[$campo]!=""){
			$urlSUBIR_COTIZACION .= "<a target='_blank'
            href='includes/archivos/".$rowDOCTOS[$campo]."'>Visualizar!</a>"." <span id='".$rowDOCTOS['id']."' class='".$jqueryborrar."' style='cursor:pointer;color:blue;'>Borrar!</span> ".'<br/>';
            }else{
            //$urlSUBIR_COTIZACION="";
            }
		}
		return $urlSUBIR_COTIZACION;
	}

	public function borrafotomoneda($idrow){
		$conn = $this->db();

		$variablequery = "delete from 13MONEDAfotos where id = '".$idrow."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		echo "ARCHIVO BORRADO";
	}
	/////////////////////////////////////////////////
	public function tomar_ultimo_id($idRelacion,$idrelacionsesion){
		$conn = $this->db();		
		$query1 = "update 13MONEDAfotos set idRelacion = '".$idRelacion."', BANDERA = 'no' where BANDERA = 'si' and idrelacionsesion = '".$idrelacionsesion."' " ;
		mysqli_query($conn,$query1) or die('P160'.mysqli_error($conn));
	}

	public function listado_fotos_moneda($idRelacio){
		$con = $this->db();
		$query = "select * from 13MONEDAfotos where idRelacion = '".$idRelacio."' ";
		$mysqli = mysqli_query($con,$query);
		return $mysqli;
	}
	
    public function monedas ($MONEDAS ,$ISO,$BANCO_MONEDAS,$FECHA_TIPO, $HORA_TIPO, $TIPO_CAMBIO,$TIPO_CAMBIO1,$TIPO_CAMBIO2,$OBSERVACIONES_MONEDAS,$IMAGEN_MONEDAS, $FECHA_MONEDAS , $hMONEDAS,$IpMONEDAS,$enviarMONEDAS){
	$TIPO_CAMBIO  = str_replace(',','',$TIPO_CAMBIO);
	$TIPO_CAMBIO1  = str_replace(',','',$TIPO_CAMBIO1);
	$TIPO_CAMBIO2  = str_replace(',','',$TIPO_CAMBIO2);
	
	$conn = $this->db();
	$session = isset($_SESSION['id'])?$_SESSION['id']:'';  
	if($session != ''){                            
		
	 $var1 = "update 13MONEDAS  set
	 
	 
	 MONEDAS = '".$MONEDAS."' , 
	 ISO = '".$ISO."' , 
	 BANCO_MONEDAS = '".$BANCO_MONEDAS."' , 
	 TIPO_CAMBIO = '".$TIPO_CAMBIO."' , 
	 
	 FECHA_TIPO = '".$FECHA_TIPO."' , 
	 HORA_TIPO = '".$HORA_TIPO."' ,
	 
	 TIPO_CAMBIO1 = '".$TIPO_CAMBIO1."' , 
	 TIPO_CAMBIO2 = '".$TIPO_CAMBIO2."' , 
	 IMAGEN_MONEDAS= '".$IMAGEN_MONEDAS."' , 	 
	 OBSERVACIONES_MONEDAS= '".$OBSERVACIONES_MONEDAS."' , 	 
	 FECHA_MONEDAS= '".$FECHA_MONEDAS."' , 	 
	 hMONEDAS = '".$hMONEDAS."'
	 where id = '".$IpMONEDAS."' ;  ";

	 $var2 = "insert into 13MONEDAS ( MONEDAS,ISO,BANCO_MONEDAS,TIPO_CAMBIO,FECHA_TIPO ,HORA_TIPO,TIPO_CAMBIO1,TIPO_CAMBIO2,OBSERVACIONES_MONEDAS, IMAGEN_MONEDAS, FECHA_MONEDAS, hMONEDAS, idRelacion) values ( '".$MONEDAS."' , '".$ISO."' , '".$BANCO_MONEDAS."' , '".$TIPO_CAMBIO."' , '".$FECHA_TIPO."' , '".$HORA_TIPO."' , '".$TIPO_CAMBIO1."' , '".$TIPO_CAMBIO2."' , '".$OBSERVACIONES_MONEDAS."' , '".$IMAGEN_MONEDAS."' , '".$FECHA_MONEDAS."' , '".$hMONEDAS."' , '".$session."' ); ";		
		
		if($enviarMONEDAS=='enviarMONEDAS'){
	mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
	return "Actualizado";
				
	}else{
	mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));

	$ultimo_id = mysqli_insert_id($conn);
	$idempermiso = $_SESSION['idempermiso'];
	$this->tomar_ultimo_id($ultimo_id,$idempermiso);

	return "Ingresado";
	}
		
	}else{
	echo "TU SESIÓN HA TERMINADO";	
	}
	
}

	
    public function Listado_MONEDAS(){
	$session = isset($_SESSION['id'])?$_SESSION['id']:'';
	
	$conn = $this->db();
	$variablequery = "select * from 13MONEDAS WHERE MONEDAS = 'DOLAR' order by id desc ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}	


	public function Listado_MONEDAS2($id){
	$conn = $this->db();
	$variablequery = "select * from 13MONEDAS  where id = '".$id."' ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}




	public function Listado_MONEDAS2fotos($id,$campo){
	$conn = $this->db();
	/*select id,IMAGENDOLARES from 13MONEDAfotos where idRelacion = '160' and bandera = 'no' order by id desc */
	$variablequery = "select id,".$campo." from 13MONEDAfotos where 
	idRelacion = '".$id."' and bandera = 'no' and (".$campo." is not null or ".$campo." <>'' ) ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}






    public function borra_MONEDAS($id){
	$conn = $this->db();
	$variablequery = "delete from 13MONEDAS where id = '".$id."' ";
	$arrayquery = mysqli_query($conn,$variablequery);
	RETURN 
	
	"<P style='color:green; font-size:28px;'>ELEMENTO BORRADO</P>";
}
	



	
	/////////////////////////////////////////////////

    public function monedas2 ($MONEDAS ,$ISO,$BANCO_MONEDAS,$FECHA_TIPO, $HORA_TIPO, $TIPO_CAMBIO,$TIPO_CAMBIO1,$TIPO_CAMBIO2,$OBSERVACIONES_MONEDAS,$IMAGEN_MONEDAS, $FECHA_MONEDAS , $hEUROS,$IpMONEDAS2,$enviarMONEDAS2 ){
	$TIPO_CAMBIO  = str_replace(',','',$TIPO_CAMBIO);
	$TIPO_CAMBIO1  = str_replace(',','',$TIPO_CAMBIO1);
	$TIPO_CAMBIO2  = str_replace(',','',$TIPO_CAMBIO2);
	
	$conn = $this->db();
	$session = isset($_SESSION['id'])?$_SESSION['id']:'';  
	if($session != ''){                           
		
	 $var1 = "update 13MONEDAS  set
	 
	 
	 MONEDAS = '".$MONEDAS."' , 
	 ISO = '".$ISO."' , 
	 BANCO_MONEDAS = '".$BANCO_MONEDAS."' , 
	 TIPO_CAMBIO = '".$TIPO_CAMBIO."' , 
	 
	 FECHA_TIPO = '".$FECHA_TIPO."' , 
	 HORA_TIPO = '".$HORA_TIPO."' ,
	 
	 TIPO_CAMBIO1 = '".$TIPO_CAMBIO1."' , 
	 TIPO_CAMBIO2 = '".$TIPO_CAMBIO2."' , 
	 IMAGEN_MONEDAS = '".$IMAGEN_MONEDAS."' , 	 
	 OBSERVACIONES_MONEDAS = '".$OBSERVACIONES_MONEDAS."' , 	 
	 FECHA_MONEDAS = '".$FECHA_MONEDAS."' , 	 
	 hEUROS = '".$hEUROS."'
	 where id = '".$IpMONEDAS2."' ;  ";

	 $var2 = "insert into 13MONEDAS ( MONEDAS,ISO,BANCO_MONEDAS,TIPO_CAMBIO,FECHA_TIPO ,HORA_TIPO,TIPO_CAMBIO1,TIPO_CAMBIO2,OBSERVACIONES_MONEDAS, IMAGEN_MONEDAS, FECHA_MONEDAS, hEUROS, idRelacion) values ( '".$MONEDAS."' , '".$ISO."' , '".$BANCO_MONEDAS."' , '".$TIPO_CAMBIO."' , '".$FECHA_TIPO."' , '".$HORA_TIPO."' , '".$TIPO_CAMBIO1."' , '".$TIPO_CAMBIO2."' , '".$OBSERVACIONES_MONEDAS."' , '".$IMAGEN_MONEDAS."' , '".$FECHA_MONEDAS."' , '".$hEUROS."' , '".$session."' ); ";		
		
		if($enviarMONEDAS2=='enviarMONEDAS2'){
	mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
	return "Actualizado";
				
	}else{
	mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
	
	$ultimo_id = mysqli_insert_id($conn);
	$idempermiso = $_SESSION['idempermiso'];
	$this->tomar_ultimo_id($ultimo_id,$idempermiso);	
	
	return "Ingresado";
	}
		
	}else{
	echo "TU SESIÓN HA TERMINADO";	
	}
	
}

	
    public function Listado_EURO(){
	$session = isset($_SESSION['id'])?$_SESSION['id']:'';
	
	$conn = $this->db();
	$variablequery2 = "select * from 13MONEDAS WHERE MONEDAS = 'EURO' order by id desc ";
	return $arrayquery2 = mysqli_query($conn,$variablequery2);
}	


	public function Listado_MONEDAS22($id){
	$conn = $this->db();
	$variablequery2 = "select * from 13MONEDAS  where id = '".$id."' ";
	return $arrayquery2 = mysqli_query($conn,$variablequery2);
}


    public function borra_MONEDAS2($id){
	$conn = $this->db();
	$variablequery2 = "delete from 13MONEDAS where id = '".$id."' ";
	$arrayquery2 = mysqli_query($conn,$variablequery2);
	RETURN 
	
	"<P style='color:green; font-size:28px;'>ELEMENTO BORRADO</P>";
}
	

	/////////////////////////////////////////////////

    public function monedas3 ($MONEDAS ,$ISO,$BANCO_MONEDAS,$FECHA_TIPO, $HORA_TIPO, $TIPO_CAMBIO,$TIPO_CAMBIO1,$TIPO_CAMBIO2,$OBSERVACIONES_MONEDAS,$IMAGEN_MONEDAS, $FECHA_MONEDAS , $hTODOS,$IpMONEDAS3,$enviarMONEDAS3){
	$TIPO_CAMBIO  = str_replace(',','',$TIPO_CAMBIO);
	$TIPO_CAMBIO1  = str_replace(',','',$TIPO_CAMBIO1);
	$TIPO_CAMBIO2  = str_replace(',','',$TIPO_CAMBIO2);
	
	$conn = $this->db();
	$session = isset($_SESSION['id'])?$_SESSION['id']:'';  
	if($session != ''){                            
		
	 $var1 = "update 13MONEDAS  set
	 
	 
	 MONEDAS = '".$MONEDAS."' , 
	 ISO = '".$ISO."' , 
	 BANCO_MONEDAS = '".$BANCO_MONEDAS."' , 
	 TIPO_CAMBIO = '".$TIPO_CAMBIO."' , 
	 
	 FECHA_TIPO = '".$FECHA_TIPO."' , 
	 HORA_TIPO = '".$HORA_TIPO."' ,
	 
	 TIPO_CAMBIO1 = '".$TIPO_CAMBIO1."' , 
	 TIPO_CAMBIO2 = '".$TIPO_CAMBIO2."' , 
	 IMAGEN_MONEDAS = '".$IMAGEN_MONEDAS."' , 	 
	 OBSERVACIONES_MONEDAS= '".$OBSERVACIONES_MONEDAS."' , 	 
	 FECHA_MONEDAS = '".$FECHA_MONEDAS."' , 	 
	 hTODOS = '".$hTODOS."'
	 where id = '".$IpMONEDAS3."' ;  ";

	 $var2 = "insert into 13MONEDAS ( MONEDAS,ISO,BANCO_MONEDAS,TIPO_CAMBIO,FECHA_TIPO ,HORA_TIPO,TIPO_CAMBIO1,TIPO_CAMBIO2,OBSERVACIONES_MONEDAS, IMAGEN_MONEDAS, FECHA_MONEDAS, hTODOS, idRelacion) values ( '".$MONEDAS."' , '".$ISO."' , '".$BANCO_MONEDAS."' , '".$TIPO_CAMBIO."' , '".$FECHA_TIPO."' , '".$HORA_TIPO."' , '".$TIPO_CAMBIO1."' , '".$TIPO_CAMBIO2."' , '".$OBSERVACIONES_MONEDAS."' , '".$IMAGEN_MONEDAS."' , '".$FECHA_MONEDAS."' , '".$hTODOS."' , '".$session."' ); ";		
		
		if($enviarMONEDAS3=='enviarMONEDAS3'){
	mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
	return "Actualizado";
				
	}else{
	mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
	
	$ultimo_id = mysqli_insert_id($conn);
	$idempermiso = $_SESSION['idempermiso'];
	$this->tomar_ultimo_id($ultimo_id,$idempermiso);	
	
	return "Ingresado";
	}
		
	}else{
	echo "TU SESIÓN HA TERMINADO";	
	}
	
}

	
public function Listado_MONEDATODOS(){
    $session = isset($_SESSION['id'])?$_SESSION['id']:'';
    
    $conn = $this->db();
    $variablequery = "SELECT * 
                      FROM 13MONEDAS 
                      WHERE MONEDAS NOT IN ('EURO','DOLAR','LIBRA ESTERLINA') 
                      ORDER BY id DESC";
    
    return $arrayquery = mysqli_query($conn,$variablequery);
}	


	public function Listado_MONEDAS33($id){
	$conn = $this->db();
	$variablequery = "select * from 13MONEDAS  where id = '".$id."' ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}


    public function borra_MONEDAS3($id){
	$conn = $this->db();
	$variablequery = "delete from 13MONEDAS where id = '".$id."' ";
	$arrayquery = mysqli_query($conn,$variablequery);
	RETURN 
	
	"<P style='color:green; font-size:28px;'>ELEMENTO BORRADO</P>";
}

    public function MONEDAS4 ($MONEDAS ,$ISO,$BANCO_MONEDAS,$FECHA_TIPO, $HORA_TIPO, $TIPO_CAMBIO,$TIPO_CAMBIO1,$TIPO_CAMBIO2,$OBSERVACIONES_MONEDAS,$IMAGEN_MONEDAS, $FECHA_MONEDAS , $hMONEDAS4,$IpMONEDAS4,$enviarMONEDAS4){
	$TIPO_CAMBIO  = str_replace(',','',$TIPO_CAMBIO);
	$TIPO_CAMBIO1  = str_replace(',','',$TIPO_CAMBIO1);
	$TIPO_CAMBIO2  = str_replace(',','',$TIPO_CAMBIO2);
	
	$conn = $this->db();
	$session = isset($_SESSION['id'])?$_SESSION['id']:'';  
	if($session != ''){                            
		
	 $var1 = "update 13MONEDAS  set
	 
	 
	 MONEDAS = '".$MONEDAS."' , 
	 ISO = '".$ISO."' , 
	 BANCO_MONEDAS = '".$BANCO_MONEDAS."' , 
	 TIPO_CAMBIO = '".$TIPO_CAMBIO."' , 
	 
	 FECHA_TIPO = '".$FECHA_TIPO."' , 
	 HORA_TIPO = '".$HORA_TIPO."' ,
	 
	 TIPO_CAMBIO1 = '".$TIPO_CAMBIO1."' , 
	 TIPO_CAMBIO2 = '".$TIPO_CAMBIO2."' , 
	 IMAGEN_MONEDAS = '".$IMAGEN_MONEDAS."' , 	 
	 OBSERVACIONES_MONEDAS = '".$OBSERVACIONES_MONEDAS."' , 	 
	 FECHA_MONEDAS = '".$FECHA_MONEDAS."' , 	 
	 hMONEDAS4 = '".$hMONEDAS4."'
	 where id = '".$IpMONEDAS4."' ;  ";

	 $var2 = "insert into 13MONEDAS( MONEDAS,ISO,BANCO_MONEDAS,TIPO_CAMBIO,FECHA_TIPO ,HORA_TIPO,TIPO_CAMBIO1,TIPO_CAMBIO2,OBSERVACIONES_MONEDAS, IMAGEN_MONEDAS, FECHA_MONEDAS, hMONEDAS4, idRelacion) values ( '".$MONEDAS."' , '".$ISO."' , '".$BANCO_MONEDAS."' , '".$TIPO_CAMBIO."' , '".$FECHA_TIPO."' , '".$HORA_TIPO."' , '".$TIPO_CAMBIO1."' , '".$TIPO_CAMBIO2."' , '".$OBSERVACIONES_MONEDAS."' , '".$IMAGEN_MONEDAS."' , '".$FECHA_MONEDAS."' , '".$hMONEDAS4."' , '".$session."' ); ";	
		
		if($enviarMONEDAS4=='enviarMONEDAS4'){
	mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
	return "Actualizado";
				
	}else{
	mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));

	$ultimo_id = mysqli_insert_id($conn);
	$idempermiso = $_SESSION['idempermiso'];
	$this->tomar_ultimo_id($ultimo_id,$idempermiso);

	return "Ingresado";
	}
		
	}else{
	echo "TU SESIÓN HA TERMINADO";	
	}
	
}



	
public function Listado_MONEDA4(){
	$session = isset($_SESSION['id'])?$_SESSION['id']:'';
	
	$conn = $this->db();
	$variablequery = "select * from 13MONEDAS WHERE MONEDAS = 'LIBRA ESTERLINA' order by id desc ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}	


	public function Listado_MONEDAS44($id){
	$conn = $this->db();
	$variablequery = "select * from 13MONEDAS  where id = '".$id."' ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}


    public function borra_MONEDAS4($id){
	$conn = $this->db();
	$variablequery = "delete from 13MONEDAS where id = '".$id."' ";
	$arrayquery = mysqli_query($conn,$variablequery);
	RETURN 
	
	"<P style='color:green; font-size:28px;'>ELEMENTO BORRADO</P>";
}






	public function NUEVODOCUBANCO($banco , $enviarCIERRENUEVO, $IPBANCO=FALSE){
		
		$conn = $this->db();
		//$existe = $this->revisar_guardar_cierrenuevo();
		$session = isset($_SESSION['id'])?$_SESSION['id']:'';  
		if($session != ''){
			
		 $var1 = "update 13bancos set 
		 banco = '".$banco."'  where id = '".$IPBANCO."' ; ";
	
		 $var2 = " insert into 13bancos (banco) values ( '".$banco."' ); ";		
			
	    if($enviarCIERRENUEVO=='hnuevodocubanco'){
		mysqli_query($conn,$var2) or die('P156'.mysqli_error($conn));
		return "Actualizado";
					
		}elseif($enviarCIERRENUEVO=='hnuevodocubancoactualiza'){
		mysqli_query($conn,$var1) or die('P160'.mysqli_error($conn));
		return "Ingresado";
		}
			
        }else{
		echo "TU SESIÓN HA TERMINADO";	
		}
		
	}


	public function Listado_banco2($id){
		$conn = $this->db();
		$variablequery = "select * from 13bancos  where id = '".$id."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}

	public function Listado_banco(){
		$conn = $this->db();
		$variablequery = "select * from 13bancos ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}	

	public function revisar_guardar_nuevo($id){
		$conn = $this->db();
		$var1 = 'select id from 13bancos where id = "'.$id.'" ';
		
		$query = mysqli_query($conn,$var1) or die('P44'.mysqli_error($conn));
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $row['id'];
	}
	public function BORRAREGISTRO_banco($id){
		$conn = $this->db();
		$var1 = 'DELETE from 13bancos where id = "'.$id.'" ';
	
		$query = mysqli_query($conn,$var1) or die('P44'.mysqli_error($conn));
		mysqli_fetch_array($query, MYSQLI_ASSOC);
				RETURN 
		
		"<P style='color:green;font-size:25px;'>ELEMENTO BORRADO</P>";
	}
	
/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
	
}




	

?>