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

$queryVISTAPREV = $conexion->Listado_MONEDAS33($identioficador);
 $output .= '
<div id="mensajeMONEDActualiza3">TODOS</div> 
 <form  id="Listado_MONEDASform3"> 
      <div class="table-responsive">  
           <table class="table table-bordered">';
        $row = mysqli_fetch_array($queryVISTAPREV);
    
		$queryVISTAPREVfotos = $conexion->Listado_MONEDAS2fotos($identioficador,'IMAGENTODOS');
	while( $row2 = mysqli_fetch_array($queryVISTAPREVfotos, MYSQLI_ASSOC)){
		if($row2["IMAGENTODOS"]!=""){
			$urlIMAGEN_MONEDAS.= "<a target='_blank'
			href='includes/archivos/".$row2["IMAGENTODOS"]."'>Visualizar!</a>"."&nbsp;&nbsp;<span id='".$row2['id']."' class='view_todos_Bborrar' style='cursor:pointer;color:blue;'>Borrar!</span><br>";
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


<div id="drop_file_zone" ondrop="upload_file3(event, \'IMAGENTODOS3\');" ondragover="return false" style="width:300px;"> <p>Suelta aquí o busca tu archivo</p> <p> <input class="form-control form-control-sm" id="IMAGENTODOS3" type="text" onkeydown="return false" onclick="file_explorer3(\'IMAGENTODOS3\');" style="width:250px;" value="'.$row["IMAGENTODOS"].'" required /> </p> <input type="file" name="IMAGENTODOS3" id="nono"/> <div id="3IMAGENTODOS3"> "'.$urlIMAGEN_MONEDAS.'" </div> </div> </div>


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
			
			<input type="hidden" value="'.$row["id"].'"  name="IpMONEDAS3"  id="IpMONEDAS3"/>
			
			<button class="btn btn-sm btn-outline-success px-5" type="button" id="clickMONEDAS3">GUARDAR</button>
			
			<input type="hidden" value="enviarMONEDAS3"  name="enviarMONEDAS3"/>

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
	    ajax_file_upload3(fileobj,name);
	}
	 
	function file_explorer3(name) {
	    document.getElementsByName(name)[0].click();
	    document.getElementsByName(name)[0].onchange = function() {
	        fileobj = document.getElementsByName(name)[0].files[0];
	        ajax_file_upload3(fileobj,name);
	    };
	}

	function ajax_file_upload3(file_obj,nombre) {
	    if(file_obj != undefined) {
	        var form_data = new FormData();                  
	        form_data.append(nombre, file_obj);
	        form_data.append("IpMONEDAS3",  $("#IpMONEDAS3").val());
	        form_data.append("actualizaTODOS", 'actualizaTODOS');			
	        $.ajax({
	            type: 'POST',
	        url:"MONEDAS/controladorM.php",
				  dataType: "html",
	            contentType: false,
	            processData: false,
	            data: form_data,
 beforeSend: function() {
$('#3'+nombre).html('<p style="color:green;">Cargando archivo!</p>');
$('#respuestaser').html('<p style="color:green;">Actualizado!</p>');
    },				
	            success:function(response) {

		if($.trim(response) == 2 ){
			$('#3'+nombre).html('<p style="color:red;">Error, archivo diferente a PDF, JPG o GIF.</p>');
			$('#'+nombre).val("");
		}else{
			$('#3'+nombre).html(response);
		}
		
	            }
	        });
	    }
	}


    $(document).ready(function(){

$("#clickMONEDAS3").click(function(){
	
   $.ajax({  
   url:"MONEDAS/controladorM.php",
    method:"POST",  
    data:$('#Listado_MONEDASform3').serialize(),

    beforeSend:function(){  
    $('#mensajeMONEDActualiza3').html('cargando'); 
    }, 	
	
    success:function(data){
	
		$("#reset_MONEDAS3").load(location.href + " #reset_MONEDAS3");
    $('#mensajeMONEDAS3').html("<span id='ACTUALIZADO' >"+data+"</span>"); 

			$('#dataModal').modal('hide');

    }  
   });
   
});

		});
		
	</script>