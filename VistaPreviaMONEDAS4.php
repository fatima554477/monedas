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

$queryVISTAPREV = $conexion->Listado_MONEDAS44($identioficador);
 $output .= '
<div id="mensajeMONEDActualiza4">LIBRA ESTERLINA</div> 
 <form  id="Listado_MONEDASform4"> 
      <div class="table-responsive">  
           <table class="table table-bordered">';
        $row = mysqli_fetch_array($queryVISTAPREV);
    
		$queryVISTAPREVfotos = $conexion->Listado_MONEDAS2fotos($identioficador,'IMAGENLIBRA');
	while( $row2 = mysqli_fetch_array($queryVISTAPREVfotos, MYSQLI_ASSOC)){
		if($row2["IMAGENLIBRA"]!=""){
			$urlIMAGEN_MONEDAS.= "<a target='_blank'
			href='includes/archivos/".$row2["IMAGENLIBRA"]."'>Visualizar!</a>"."&nbsp;&nbsp;<span id='".$row2['id']."' class='view_LIBRA_Bborrar' style='cursor:pointer;color:blue;'>Borrar!</span><br>";
		}else{
			$urlIMAGEN_MONEDAS="";
		}
	}			
          
    		
             $output .= '

<tr>
<td class="text-start" width="30%"><label>MONEDA</label></td>
<td class="text-start" width="70%"><input type="text" name="MONEDAS" value="'.$row["MONEDAS"].'"></td>
</tr>
 
<tr>
<td class="text-start" width="30%"><label>ISO</label></td>
<td class="text-start" width="70%"><input type="text" name="ISO" value="'.$row["ISO"].'"></td>
</tr>
 
<tr>
<td class="text-start" width="30%"><label>BANCO</label></td>
<td class="text-start" width="70%"><input type="text" name="BANCO_MONEDAS" value="'.$row["BANCO_MONEDAS"].'"></td>
</tr>

<tr>
<td class="text-start" width="30%"><label></label>FECHA DEL TIPO DE CAMBIO</td>
<td class="text-start" width="70%"><input type="date" name="FECHA_TIPO" value="'.$row["FECHA_TIPO"].'"></td>
</tr>

<tr>
<td class="text-start" width="30%"><label></label>HORA DEL TIPO DE CAMBIO</td>
<td class="text-start" width="70%"><input type="time" name="HORA_TIPO" value="'.$row["HORA_TIPO"].'"></td>
</tr>
<tr>
<td class="text-start" width="30%"><label>TIPO DE CAMBIO (A LA VENTA):</label></td>
<td class="text-start" width="70%"><input type="text" name="TIPO_CAMBIO1" value="'.$row["TIPO_CAMBIO1"].'"></td>
</tr>
<tr>
<td class="text-start" width="30%"><label>TIPO DE CAMBIO (A LA COMPRA):</label></td>
<td class="text-start" width="70%"><input type="text" name="TIPO_CAMBIO2" value="'.$row["TIPO_CAMBIO2"].'"></td>
</tr>

<tr>
<td class="text-start" width="30%"><label>TIPO DE CAMBIO (COMPRADO):</label></td>
<td class="text-start" width="70%"><input type="text" name="TIPO_CAMBIO" value="'.$row["TIPO_CAMBIO"].'"></td>
</tr>
<tr>
<td class="text-start" width="30%"><label>DOCUMENTO:</label></td>
<td class="text-start" width="70%">


<div id="drop_file_zone" ondrop="upload_file4(event, \'IMAGENLIBRA4\');" ondragover="return false" style="width:300px;"> <p>Suelta aquí o busca tu archivo</p> <p> <input class="form-control form-control-sm" id="IMAGENLIBRA4" type="text" onkeydown="return false" onclick="file_explorer4(\'IMAGENLIBRA4\');" style="width:250px;" value="'.$row["IMAGENLIBRA"].'" required /> </p> <input type="file" name="IMAGENLIBRA4" id="nono"/> <div id="4IMAGENLIBRA4"> "'.$urlIMAGEN_MONEDAS.'" </div> </div> </div>


</td>
</tr> 
    
 
<td class="text-start" width="30%"><label>OBSERVACIONES</label></td>
<td class="text-start" width="70%"><input type="text" name="OBSERVACIONES_MONEDAS" value="'.$row["OBSERVACIONES_MONEDAS"].'"></td>
</tr> 

<tr>
<td class="text-start" width="30%"><label>FECHA DE ÚLTIMA CARGA</label></td>
<td class="text-start" width="70%"><input type="text" name="FECHA_MONEDAS" value="'.$row["FECHA_MONEDAS"].'"></td>
</tr> 



	';
	


	 $output .= '<tr>  
            <td class="text-start" width="30%"><label>GUARDAR</label></td>  
            <td class="text-start" width="70%">
			
			<input type="hidden" value="'.$row["id"].'"  name="IpMONEDAS4"  id="IpMONEDAS4"/>
			
			<button class="btn btn-sm btn-outline-success px-5" type="button" id="clickMONEDAS4">GUARDAR</button>
			
			<input type="hidden" value="enviarMONEDAS4"  name="enviarMONEDAS4"/>

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
	function upload_file4(e,name) {
	    e.preventDefault();
	    fileobj = e.dataTransfer.files[0];
	    ajax_file_upload4(fileobj,name);
	}
	 
	function file_explorer4(name) {
	    document.getElementsByName(name)[0].click();
	    document.getElementsByName(name)[0].onchange = function() {
	        fileobj = document.getElementsByName(name)[0].files[0];
	        ajax_file_upload4(fileobj,name);
	    };
	}

	function ajax_file_upload4(file_obj,nombre) {
	    if(file_obj != undefined) {
	        var form_data = new FormData();                  
	        form_data.append(nombre, file_obj);
	        form_data.append("IpMONEDAS4",  $("#IpMONEDAS4").val());
	        form_data.append("actualizaLIBRA", 'actualizaLIBRA');	
	        $.ajax({
	            type: 'POST',
	        url:"MONEDAS/controladorM.php",
				  dataType: "html",
	            contentType: false,
	            processData: false,
	            data: form_data,
 beforeSend: function() {
$('#4'+nombre).html('<p style="color:green;">Cargando archivo!</p>');
$('#respuestaser').html('<p style="color:green;">Actualizado!</p>');
    },				
	            success:function(response) {

		if($.trim(response) == 2 ){
			$('#4'+nombre).html('<p style="color:red;">Error, archivo diferente a PDF, JPG o GIF.</p>');
			$('#'+nombre).val("");
		}else{
			$('#4'+nombre).html(response);
		}

	            }
	        });
	    }
	}


    $(document).ready(function(){

$("#clickMONEDAS4").click(function(){
	
   $.ajax({  
   url:"MONEDAS/controladorM.php",
    method:"POST",  
    data:$('#Listado_MONEDASform4').serialize(),

    beforeSend:function(){  
    $('#mensajeMONEDActualiza4').html('cargando'); 
    }, 	
	
    success:function(data){
	
		$("#reset_MONEDAS4").load(location.href + " #reset_MONEDAS4");
    $('#mensajeMONEDAS4').html("<span id='ACTUALIZADO' >"+data+"</span>"); 

			$('#dataModal').modal('hide');

    }  
   });
   
});

		});
		
	</script>