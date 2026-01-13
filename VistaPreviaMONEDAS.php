<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }  
//select.php  CONTRASENA_DE1
$identioficador = isset($_POST["personal_id"])?$_POST["personal_id"]:'';
if($identioficador != '')
{
 $output = '';
	require "controladorM.php";
	$conexion = NEW accesoclase();

$queryVISTAPREV = $conexion->Listado_MONEDAS2($identioficador);
 $output .= '
<div id="mensajeMONEDActualiza">DOLARES</div> 
 <form  id="Listado_MONEDASform"> 
      <div class="table-responsive">  
           <table class="table table-bordered">';
        $row = mysqli_fetch_array($queryVISTAPREV);
		
		$queryVISTAPREVfotos = $conexion->Listado_MONEDAS2fotos($identioficador,'IMAGENDOLARES');
	while( $row2 = mysqli_fetch_array($queryVISTAPREVfotos, MYSQLI_ASSOC)){
		if($row2["IMAGENDOLARES"]!=""){
			$urlIMAGEN_MONEDAS.= "<a target='_blank'
			href='includes/archivos/".$row2["IMAGENDOLARES"]."'>Visualizar!</a>"."&nbsp;&nbsp;<span id='".$row2['id']."' class='view_dolar_Bborrar' style='cursor:pointer;color:blue;'>Borrar!</span><br>";
		}else{
			$urlIMAGEN_MONEDAS="";
		}
	}		
          
    		
             $output .= '

<tr>
<td width="30%"  class="text-start"><label>MONEDA</label></td>
<td width="70%"  class="text-start"><input type="text" name="MONEDAS" value="'.$row["MONEDAS"].'"></td>
</tr>
 
<tr>
<td width="30%"  class="text-start"><label>ISO</label></td>
<td width="70%"  class="text-start"><input type="text" name="ISO" value="'.$row["ISO"].'"></td>
</tr>
 
<tr>
<td width="30%"  class="text-start"><label>BANCO</label></td>
<td width="70%"  class="text-start"><input type="text" name="BANCO_MONEDAS" value="'.$row["BANCO_MONEDAS"].'"></td>
</tr>

<tr>
<td width="30%"  class="text-start"><label></label>FECHA DEL TIPO DE CAMBIO</td>
<td width="70%"  class="text-start"><input type="date" name="FECHA_TIPO" value="'.$row["FECHA_TIPO"].'"></td>
</tr>

<tr>
<td width="30%"  class="text-start"><label></label>HORA DEL TIPO DE CAMBIO</td>
<td width="70%"  class="text-start"><input type="time" name="HORA_TIPO" value="'.$row["HORA_TIPO"].'"></td>
</tr>
<tr>
<td width="30%"  class="text-start"><label>TIPO DE CAMBIO (A LA VENTA):</label></td>
<td width="70%"  class="text-start"><input type="text" name="TIPO_CAMBIO1" value="'.$row["TIPO_CAMBIO1"].'"></td>
</tr>
<tr>
<td width="30%"  class="text-start"><label>TIPO DE CAMBIO (A LA COMPRA):</label></td>
<td width="70%"  class="text-start"><input type="text" name="TIPO_CAMBIO2" value="'.$row["TIPO_CAMBIO2"].'"></td>
</tr>

<tr>
<td width="30%"  class="text-start"><label>TIPO DE CAMBIO (COMPRADO):</label></td>
<td width="70%"  class="text-start"><input type="text" name="TIPO_CAMBIO" value="'.$row["TIPO_CAMBIO"].'"></td>
</tr>
<tr>
<td width="30%"  class="text-start"><label>DOCUMENTO:</label></td>
<td width="70%"  class="text-start">


<div id="drop_file_zone" ondrop="upload_file3(event, \'IMAGENDOLARES1\');" ondragover="return false" style="width:300px;"> <p>Suelta aquí o busca tu archivo</p> <p> <input class="form-control form-control-sm" id="IMAGENDOLARES1" type="text" onkeydown="return false" onclick="file_explorer3(\'IMAGENDOLARES1\');" style="width:250px;" value="'.$row["IMAGENDOLARES"].'" required /> </p> <input type="file" name="IMAGENDOLARES1" id="nono"/> <div id="2IMAGENDOLARES1"> "'.$urlIMAGEN_MONEDAS.'" </div> </div> </div>


</td>
</tr>    
 
<td width="30%"  class="text-start"><label>OBSERVACIONES</label></td>
<td width="70%"  class="text-start"><input type="text" name="OBSERVACIONES_MONEDAS" value="'.$row["OBSERVACIONES_MONEDAS"].'"></td>
</tr> 

<tr>
<td width="30%"  class="text-start"><label>FECHA DE ÚLTIMA CARGA</label></td>
<td width="70%"  class="text-start"><input type="text" name="FECHA_MONEDAS" value="'.$row["FECHA_MONEDAS"].'"></td>
</tr> 



	';
	


	 $output .= '<tr>  
            <td width="30%"  class="text-start"><label>GUARDAR</label></td>  
            <td width="70%"  class="text-start">
			
			<input type="hidden" value="'.$row["id"].'"  name="IpMONEDAS"  id="IpMONEDAS"/>
			
			<button class="btn btn-sm btn-outline-success px-5" type="button" id="clickMONEDAS">GUARDAR</button>
			
			<input type="hidden" value="enviarMONEDAS"  name="enviarMONEDAS"/>

			</td>  
        </tr>
     ';
    //IPCIERRE
    $output .= '</table></div></form>';
    echo $output;
}
//
?>

<script>
	var fileobj;
	function upload_file3(e,name) {
	    e.preventDefault();
	    fileobj = e.dataTransfer.files[0];
	    ajax_file_upload13(fileobj,name);
	}
	 
	function file_explorer3(name) {
	    document.getElementsByName(name)[0].click();
	    document.getElementsByName(name)[0].onchange = function() {
	        fileobj = document.getElementsByName(name)[0].files[0];
	        ajax_file_upload13(fileobj,name);
	    };
	}

	function ajax_file_upload13(file_obj,nombre) {
	    if(file_obj != undefined) {
	        var form_data = new FormData();                  
	        form_data.append(nombre, file_obj);
	        form_data.append("IpMONEDAS",  $("#IpMONEDAS").val());
	        form_data.append("actualizaDOLARES", 'actualizaDOLARES');			
	        $.ajax({
	            type: 'POST',
                url:"MONEDAS/controladorM.php",
				  dataType: "html",
	            contentType: false,
	            processData: false,
	            data: form_data,
 beforeSend: function() {
$('#2'+nombre).html('<p style="color:green;">Cargando archivo!</p>');
    },				
	            success:function(response) {

		if($.trim(response) == 2 ){
			$('#2'+nombre).html('<p style="color:red;">Error, archivo diferente a PDF, JPG o GIF.</p>');
			$('#'+nombre).val("");
		}else{
			$('#2'+nombre).html(response);
		}

	            }
	        });
	    }
	}
    $(document).ready(function(){

$("#clickMONEDAS").click(function(){
	
   $.ajax({  
   url:"MONEDAS/controladorM.php",
    method:"POST",  
    data:$('#Listado_MONEDASform').serialize(),

    beforeSend:function(){  
    $('#mensajeMONEDActualiza2').html('cargando'); 
    }, 	
	
    success:function(data){
	
		$("#reset_MONEDAS").load(location.href + " #reset_MONEDAS");
    $('#mensajeMONEDAS').html("<span id='ACTUALIZADO' >"+data+"</span>"); 

			$('#dataModal').modal('hide');

    }  
   });
   
});

		});
		
	</script>