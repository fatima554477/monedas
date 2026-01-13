


<div id="content">     
			<hr/>
		<strong>	  <p class="mb-0 text-uppercase" ><img src="includes/contraer31.png" id="mostrar28" style="cursor:pointer;"/>
<img src="includes/contraer41.png" id="ocultar28" style="cursor:pointer;"/>&nbsp;&nbsp;&nbsp; TIPO DE CAMBIO&nbsp;<a style="color:red;font:12px">    (DÓLARES)</a></p></strong>


<div  id="mensajeMONEDAS11">
<div class="progress" style="width: 25%;">
									<div class="progress-bar" role="progressbar" style="width: <?php echo $eventoscrono ; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $Aeventosporcentaje ; ?>%</div></div>
									</div>
									</div>
							
	        <div id="target28" style="display:block;" class="content2">
        <div class="card">
          <div class="card-body">
  
                      <form class="row g-3 needs-validation was-validated" id="MONEDASform"  novalidate="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 
                      
                                 
<?php if($conexion->variablespermisos('','AGREGANUEVO_DOLAR','guardar')=='si'){ ?>
                        <table class="table mb-0 table-striped">
      <tr>
               
               <th style="text-align:center" scope="col"></th>
               <th style="text-align:center" scope="col"></th>
  

               </tr>
    
         <tr  style="background:#f7edf8"> 
         <th class="text-start"> <label for="validationCustom03" class="text-start">MONEDA:</label></th>
  <td><input type="text" class="form-control" id="validationCustom03" required=""    value="DOLAR" name="MONEDAS" readonly>
         </td>  </tr>
         <tr  style="background:#f7edf8"> 
         <th class="text-start"> <label for="validationCustom03" class="text-start">CÓDIGO ISO:</label></th>
         <td><input type="text" class="form-control" id="validationCustom03" required=""    value="USD" name="ISO" readonly>
         </td>  </tr>

         <tr  style="background:#f7edf8"> 
         <th class="text-start"> <label for="validationCustom03" class="text-start">BANCO:</label></th>
         <td>


	<span id="resetmonedas1">
	<?php
	/*linea para multiples colores*/
	$fondos = array("fff0df","f4ffdf","dfffed","dffeff","dfe8ff","efdfff","ffdffd","efdfff","ffdfe9");
	$num = 0;
	/*linea para multiples colores*/
	
	$queryper = $monedas->Listado_banco();
	$encabezado1 = '<select class="form-select mb-3" aria-label="Default select example" id="BANCO_MONEDAS" required="" name="BANCO_MONEDAS">
	<option value="">SELECCIONA UNA OPCIÓN</option>';	
	while($row1 = mysqli_fetch_array($queryper))
	{ 
	$select='';
	if($BANCO_MONEDAS==$row1['nuevo_documento_cierre']){$select = "selected";};
	
	/*linea para multiples colores*/
	if($num==8){$num=0;}else{$num++;}
	/*linea para multiples colores*/

	$option1 .= '<option style="background: #'.$fondos[$num].'" '.$select.' value="'.$row1['banco'].'">'.$row1['banco'].'</option>';
	}
	echo $encabezado1.$option1.'</select>';			
	?>
	</span>


		 
		 
         </td>  </tr>
		 
		 
		 		          <tr  style="background:#f7edf8"> 
         <th class="text-start"> <label for="validationCustom03" class="text-start">FECHA TIPO DE CAMBIO:</label></th>
         <td><input type="date" class="form-control" id="validationCustom03" required=""     value="<?php echo date('Y-m-d'); ?>"  name="FECHA_TIPO">
         </td>  </tr>
     <tr style="background:#f7edf8"> 
    <th class="text-start"> 
        <label for="validationCustom03" class="text-start">HORA TIPO DE CAMBIO:</label>
    </th>
    <td>
        <input type="time" class="form-control" id="validationCustom03" required
          value="<?php echo isset($HORA_TIPO) ? $HORA_TIPO : date('H:i'); ?>"  name="HORA_TIPO">
    </td>
    </tr>


         <tr style="background:#ebf8fa"> 
         <th  class="text-start"> <label for="validationCustom03" class="text-start">TIPO DE CAMBIO (A LA VENTA):</label></th>
         <td>

         <div class="input-group mb-3"> <span class="input-group-text">$</span><input type="text"  style="width:450px;height:40px;"  class="form-control"   value="<?php echo $TIPO_CAMBIO1; ?>" name="TIPO_CAMBIO1" 
		 onkeyup="comasainput('TIPO_CAMBIO')"  placeholder="VENTA">
 </div>
 </td>
         </tr> 
		          <tr style="background:#ebf8fa"> 
         <th  class="text-start"> <label for="validationCustom03" class="text-start">TIPO DE CAMBIO (A LA COMPRA):</label></th>
         <td>

         <div class="input-group mb-3"> <span class="input-group-text">$</span><input type="text"  style="width:450px;height:40px;"  class="form-control"   value="<?php echo $TIPO_CAMBIO2; ?>" name="TIPO_CAMBIO2" 
		 onkeyup="comasainput('TIPO_CAMBIO')"  placeholder="COMPRA">
 </div>
 </td>
         </tr> 
		          <tr style="background:#ebf8fa"> 
         <th  class="text-start"> <label for="validationCustom03" class="text-start">TIPO DE CAMBIO (COMPRADO):</label></th>
         <td>

         <div class="input-group mb-3"> <span class="input-group-text">$</span><input type="text"  style="width:450px;height:40px;"  class="form-control"   value="<?php echo $TIPO_CAMBIO; ?>" name="TIPO_CAMBIO" 
		 onkeyup="comasainput('TIPO_CAMBIO')"  placeholder="TIPO DE CAMBIO COMPRADO">
 </div>
 </td>
         </tr>


		 
		          <tr  style="background:#f7edf8"> 
         <th class="text-start"> <label for="validationCustom03" class="text-start">IMAGEN:</label></th>
         <td>
		 
	
		 
		 
<div id="drop_file_zone" ondrop="upload_file(event,'IMAGENDOLARES')" ondragover="return false" >
<p>Suelta aquí o busca tu archivo</p>
<p><input class="form-control form-control-sm" id="IMAGENDOLARES" type="text" onkeydown="return false" onclick="file_explorer('IMAGENDOLARES');"  VALUE="<?php echo $IMAGEN_MONEDAS; ?>" required /></p>
<input type="file" name="IMAGENDOLARES" id="nono"/>
<div id="1IMAGENDOLARES">
<?php
if($IMAGEN_MONEDAS!=""){echo "<a target='_blank' href='includes/archivos/".$IMAGEN_MONEDAS."'>Visualizar!</a>"; 
}?></div>
</div>         
<div id="2IMAGENDOLARES"><?php 


if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
$idem_usuario = $_SESSION['idem'];
$monedas->borra_fotosgUARDARMONEDAtemporal($idem_usuario);
}

$fecha = date('Y-m-d');
$sessionidem = $_SESSION['idem'];
$querycontras21a33 = $monedas->Listado_fotosgUARDARMONEDAtemporal('IMAGENDOLARES',$fecha,$sessionidem);

while($row2=mysqli_fetch_array($querycontras21a33)){
echo "<a target='_blank' href='includes/archivos/".$row2['IMAGENDOLARES']."' id='A".$row2['id']."' >Visualizar!</a> "." <span id='".$row2['id']."' class='view_dataAEborrar' style='cursor:pointer;color:blue;'>Borrar!</span><span > ".$row2['fecha']."</span>".'<br/>';
}
?></div>		 
		 
         </td>  </tr>
		 
        
  
           <tr style="background:#ebf8fa;">
          <th style="text-align:center" scope="col">OBSERVACIONES</th>
           <td ><textarea style="width:400px;" name="OBSERVACIONES_MONEDAS" class="form-control" aria-label="With textarea"><?php echo $OBSERVACIONES_MONEDAS; ?></textarea></td><br></br>
           
           </tr>
              <tr>
                        <th style="text-align:center;background:#faebee;" scope="col">FECHA DE ÚLTIMA CARGA</th>   
           <td  style="background:#faebee">
           <strong>
           <?php echo date('Y-m-d'); ?>
           </strong>
           <input type="hidden" style="width:200px;"  class="form-control" id="validationCustom03"   value="<?php echo date('Y-m-d'); ?>" name="FECHA_MONEDAS">
           
           </td></tr></div>



                                    
    <input type="hidden" value="hMONEDAS" name="hMONEDAS"/>     
 
  <table>
  <tr>    
 <th>
           

 <button  style="float:right"  class="btn btn-sm btn-outline-success px-5"   type="button" id="GUARDAR_MONEDAS">GUARDAR</button><div style="
    color: #f5f5f5;
    text-shadow: 1px 1px 1px #919191,
        1px 2px 1px #919191,
        1px 3px 1px #919191,
        1px 4px 1px #919191,
        1px 5px 1px #919191,
        1px 6px 1px #919191,
        1px 7px 1px #919191,
        1px 8px 1px #919191,
        1px 9px 1px #919191,
        1px 10px 1px #919191,
    1px 18px 6px rgba(16,16,16,0.4),
    1px 22px 10px rgba(16,16,16,0.2),
    1px 25px 35px rgba(16,16,16,0.2),
    1px 30px 60px rgba(16,16,16,0.4);
	@keyframes fadeIn {
  0% { opacity: 0; }
  100% { opacity: 100; }
}"


id="mensajeMONEDAS"/></th><?php } ?></tr></table>
           
            
                
 </form>

<?php if($conexion->variablespermisos('','AGREGANUEVO_DOLAR','email')=='si'){ ?>

                  <form name="form_emil_MONEDAS" id="form_emil_MONEDAS">
				  <tr>
             <td ><textarea  placeholder="ESCRIBE AQUÍ TUS CORREOS SEPARADOS POR PUNTO Y COMA EJEMPLO: NOMBRE@CORREO.ES;NOMBRE@CORREO.ES" style="width: 500px;" name="EMAIL_MONEDAS" id="EMAIL_MONEDAS" class="form-control" aria-label="With textarea"><?php echo $EMAIL_MONEDAS; ?></textarea>
            <button class="btn btn-sm btn-outline-success px-5"  type="button" id="BUTTON_MONEDAS">ENVIAR POR EMAIL</button></td>  <?php } ?>
                
           </tr></table>


           <?php
$querycontras = $monedas->Listado_MONEDAS();
?>



<br>
<div style="position: relative; display: inline-block; margin-bottom: 10px;">
   
    <input type="text" id="buscadorMonedas" placeholder="Buscar en tabla..." 
        class="form-control" 
        style="padding-left: 30px; width: 300px; background: #f1cbce;"> <span style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); font-size: 20px;">🔍</span>
</div>
<div class="table-container">
<table class="table table-striped table-bordered" style="width:100%" id='reset_MONEDAS' name='reset_MONEDAS'>
<thead>
<tr style='background:#f5f9fc;text-align:center'>

    <th style="background:#c9e8e8;width:12%">ENVIAR <br>POR EMAIL</th>  
    <th style="background:#c9e8e8">MONEDA</th>
    <th style="background:#c9e8e8">ISO</th>
    <th style="background:#c9e8e8">BANCO</th>
    <th style="background:#c9e8e8">FECHA</th>
    <th style="background:#c9e8e8">HORA</th>
    <th style="background:#c9e8e8">A LA VENTA</th>
    <th style="background:#c9e8e8">A LA COMPRA</th>
    <th style="background:#c9e8e8">COMPRADO</th>
    <th style="background:#c9e8e8">IMAGEN</th>
    <th style="background:#c9e8e8">OBSERVACIONES</th>
    <th style="background:#c9e8e8">FECHA DE CARGA</th>
    <?php if($conexion->variablespermisos('','AGREGANUEVO_DOLAR','modificar')=='si'){ ?>
        <th style="background:#c9e8e8">MODIFICAR</th>
    <?php } ?>
    <?php if($conexion->variablespermisos('','AGREGANUEVO_DOLAR','borrar')=='si'){ ?>
        <th style="background:#c9e8e8">BORRAR</th>
    <?php } ?>
</tr>
</thead>
<tbody>
<?php
$urlIMAGEN_MONEDAS ='';
while($row = mysqli_fetch_array($querycontras)) {	
$urlIMAGEN_MONEDAS ='';
	$urlIMAGEN_MONEDASid = $monedas->listado_fotos_moneda($row["id"]);
	while($rowfotos = mysqli_fetch_array($urlIMAGEN_MONEDASid)){
		$urlIMAGEN_MONEDAS .= $conexion->descargararchivo($rowfotos["IMAGENDOLARES"]);
	}
?>
<tr >

    <td  ><input type="checkbox" style="width:18%" class="form-check-input" name="fotosve[]" id="fotosve" value="<?php echo $row["id"]; ?>"/></td>
    <td><?php echo $row["MONEDAS"]; ?></td>
    <td><?php echo $row["ISO"]; ?></td>
    <td><?php echo $row["BANCO_MONEDAS"]; ?></td>
    <td><?php echo $row["FECHA_TIPO"]; ?></td>
    <td><?php echo $row["HORA_TIPO"]; ?></td>
    <td><?php echo $row["TIPO_CAMBIO1"]; ?></td>
    <td><?php echo $row["TIPO_CAMBIO2"]; ?></td>
    <td><?php echo $row["TIPO_CAMBIO"]; ?></td>
    <td><?php echo $urlIMAGEN_MONEDAS; ?></td>
    <td><?php echo $row["OBSERVACIONES_MONEDAS"]; ?></td>
    <td><?php echo $row["FECHA_MONEDAS"]; ?></td>
    <?php if($conexion->variablespermisos('','AGREGANUEVO_DOLAR','modificar')=='si'){ ?>
        <td><input type="button" name="view" value="MODIFICAR" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_MONEDAS" /></td>
    <?php } ?>
    <?php if($conexion->variablespermisos('','AGREGANUEVO_DOLAR','borrar')=='si'){ ?>
        <td><input type="button" name="view2" value="BORRAR" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_dataMONEDASborrar" /></td>
    <?php } ?>
</tr>
<?php } ?>

</form>

</table>
</tbody>
</div>
</div>
</div>
</div>
</div>

<style>
    .table-container {
        max-height: 400px;
        overflow: auto;
        border: 1px solid #ccc;
    }

    table {
        border-collapse: collapse;
        width: max-content;
        min-width: 100%;
    }

    th, td {
        padding: 8px 12px;
        border: 1px solid #ccc;
        text-align: center;
        white-space: nowrap;
    }

    thead th {
        position: sticky;
        top: 0;
        background-color: #f5f9fc;
        z-index: 2;
		
    }
	
	
	
</style>
<script>
document.getElementById("buscadorMonedas").addEventListener("keyup", function() {
    let input = this.value.toLowerCase();
    let filas = document.querySelectorAll("#reset_MONEDAS tbody tr");
    
    filas.forEach(fila => {
        let textoFila = fila.innerText.toLowerCase();
        fila.style.display = textoFila.includes(input) ? "" : "none";
    });
});
</script>

