
<div id="content"> 


			<hr/>
			<strong>  <p class="mb-0 text-uppercase">
<img src="includes/contraer31.png" id="mostrar6" style="cursor:pointer;"/>
<img src="includes/contraer41.png" id="ocultar6" style="cursor:pointer;"/>&nbsp;&nbsp;&nbsp;AGREGAR NUEVO BANCO</p><div  id="mensajeDOCUnuevoBANCO"><div class="progress" style="width: 25%;">
									<div class="progress-bar" role="progressbar" style="width: <?php echo $ROWCATEGORIAS; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $ROWCATEGORIAS; ?>%</div></div>
								</div></div></strong>
	       
            <div id="target6" style="display:block;"  class="content2 scroll">
			

			
			<form class="row g-3 needs-validation was-validated" novalidate="" id="DOCUMENTONUEVObancoform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
			
			
<?php if($conexion->variablespermisos('','AGREGANUEVO_BANCO','guardar')=='si'){ ?>
							<table id="example2" class="table table-striped table-bordered" style="background:#e3effa">
					

								<thead>
									<tr style="text-align:center;">
										<strong><th style="background:#e3effa">NUEVO BANCO:</td></strong><br>
							
										<td style="background:#e3effa"><input style="width:500px;" type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $BANCO; ?>" name="BANCO"></td>

                                   </tr>
		
                                    </table><table>
									
                  <input type="hidden" name="hnuevodocubanco" id="hnuevodocubanco"  value="hnuevodocubanco">
               
               <tr>
          
            <th>
		

<button style="float:right"   class="btn btn-sm btn-outline-success px-5"  type="button" id="enviardocubanco" value="enviardocubanco" name="enviardocubanco">GUARDAR</button> </th>
                      
                 </tr><?php } ?> 
      
               </table></form>




			   <?php
$querycontras = $monedas->Listado_banco();
?>

<br />
<div class='table-responsive'>
<div align='right'>
</div>
<br />
<div id='employee_table'>
<tbody= 'font-style:italic;'>
<table class="table table-striped table-bordered" style="width:100%"  id='reseteateNUEVObanco' name='reseteateNUEVObanco'>
<tr style="text-align:center">
<td width="70%"style="background:#c9e8e8">NUEVO </td>  

</tr>
<?php
while($row = mysqli_fetch_array($querycontras))
{
?>                                                     


<tr style="background:#f5f9fc;text-align:center">                                    

<td  width="70%"><?php echo $row["banco"]; ?></td>

<td>

</td>
<td>

<?php if($conexion->variablespermisos('','AGREGANUEVO_BANCO','borrar')=='si'){ ?>
<input type="button" name="view2" value="BORRAR" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_databorraNUEVOborra" /><?php } ?>
</td>
</tr>
<?php
}
?>
</table>
</tbody>
</div>
</div>
</div>   
	 
			   
					