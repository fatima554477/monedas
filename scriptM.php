	<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">

    <h4 class="modal-title">Detalles</h4>
   </div>
   <div class="modal-body" id="personal_detalles2">

   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
   </div>
  </div>
 </div>
</div>



<div id="dataModal" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">

    <h4 class="modal-title">Detalles</h4>
   </div>
   <div class="modal-body" id="personal_detalles">
    
   </div>
   <div class="modal-footer">
   
   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
   
   </div>
  </div>
 </div>
</div>
	

<!--NUEVO CODIGO BORRAR-->
<div id="dataModal3" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">

    <h4 class="modal-title">Detalles</h4>
   </div>
   <div class="modal-body" id="personal_detalles3">
    ¿ESTÁS SEGURO DE BORRAR ESTE REGISTRO?
   </div>
   <div class="modal-footer">
          <span id="btnYes" class="btn confirm">SI BORRAR</span>	  
   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
   
   </div>
  </div>
 </div>
</div>




<script type="text/javascript">
	var fileobj;
function upload_file(e,name) {
	    e.preventDefault();
	    fileobj = e.dataTransfer.files[0];
	    if (fileobj) {
	        var targetInput = document.getElementById(name);
	        if (targetInput) {
	            targetInput.value = fileobj.name;
	        }
	    }
	    ajax_file_upload1(fileobj,name);
	}
	 
	function file_explorer(name) {
	    document.getElementsByName(name)[0].click();
	    document.getElementsByName(name)[0].onchange = function() {
	        fileobj = document.getElementsByName(name)[0].files[0];
	        if (fileobj) {
	            var targetInput = document.getElementById(name);
	            if (targetInput) {
	                targetInput.value = fileobj.name;
	            }
	        }
	        ajax_file_upload1(fileobj,name);
	    };
	}

function ajax_file_upload1(file_obj,nombre) {
	    if(file_obj != undefined) {
	        var form_data = new FormData();                  
	        form_data.append(nombre, file_obj);
	        $.ajax({
	            type: 'POST',
	              url:"MONEDAS/controladorM.php",
	            contentType: false,
	            processData: false,
	            data: form_data,
 beforeSend: function() {
$('#1'+nombre).html('<p style="color:green;">CARGANDO archivo!</p>');
    },				
            success:function(response) {
					
	if($.trim(response) == 2 ){
		$('#1'+nombre).html('<p style="color:red;">Error, archivo diferente a PDF, JPG o GIF.</p>');
	}else{
		$('#1'+nombre).html('');
		actualizar_listado_temporal(nombre);
	}

	            }
	        });
	    }
	}

	function actualizar_listado_temporal(nombre) {
		$.ajax({
			type: 'POST',
			url: "MONEDAS/controladorM.php",
			data: { listar_temporal: 'listar_temporal', campo: nombre },
			success: function(response) {
				$("#2" + nombre).html(response);
			}
		});
	}


function comasainput(name){
	
const numberNoCommas = (x) => {
  return x.toString().replace(/,/g, "");
}

    var total = document.getElementsByName(name)[0].value;
	 var total2 = numberNoCommas(total)
const numberWithCommas = (x) => {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}	
    document.getElementsByName(name)[0].value = numberWithCommas(total2);	
}



	$(document).ready(function(){





 




/////////////////////  MONEDAS  //////////////////////////////////////



$("#GUARDAR_MONEDAS").click(function(){
const formData = new FormData($('#MONEDASform')[0]);

$.ajax({
    url:"MONEDAS/controladorM.php",
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajeMONEDAS').html('cargando'); 
    },    
   success:function(data){
		$("#2IMAGENDOLARES").load(location.href + " #2IMAGENDOLARES");	
		$("#reset_MONEDAS").load(location.href + " #reset_MONEDAS");	
		$("#mensajeMONEDAS").html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(3000).fadeOut(); 

   }
   
})
});


$(document).on('click', '.view_MONEDAS', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
  url:"MONEDAS/VistaPreviaMONEDAS.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajeMONEDAS').html('CARGANDO').fadeIn().delay(3000).fadeOut(); 
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 })



$(document).on('click', '.view_dataMONEDASborrar', function(){

  var borra_moneda = $(this).attr("id");
  var borra_MONEDAS = "borra_MONEDAS";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
  url:"MONEDAS/controladorM.php",
   method:"POST",
   data:{borra_moneda:borra_moneda,borra_MONEDAS:borra_MONEDAS},
   
    beforeSend:function(){  
    $('#mensajeMONEDAS').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajeMONEDAS").html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(3000).fadeOut(); 			
			$("#reset_MONEDAS").load(location.href + " #reset_MONEDAS");
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });		

/////////////////////SCRIPT enviar EMAIL//////
$(document).on('click', '#BUTTON_MONEDAS', function(){
var EMAIL_MONEDAS = $('#EMAIL_MONEDAS').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emil_MONEDAS").serialize();

$.ajax({
  url:"MONEDAS/controladorM.php",
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_MONEDAS:EMAIL_MONEDAS},


beforeSend:function(){
$('#mensajeMONEDAS').html('cargando');
},
success:function(data){
$('#mensajeMONEDAS').html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(3000).fadeOut(); 

}
});
});


/////////////////////  BANCO  2 //////////////////////////////////////


$("#enviardocubanco").click(function(){
const formData = new FormData($('#DOCUMENTONUEVObancoform')[0]);

$.ajax({
    url:"MONEDAS/controladorM.php",
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajeDOCUnuevoBANCO').html('cargando'); 
    },    
   success:function(data){
		$("#resetmonedas1").load(location.href + " #resetmonedas1");
		$("#resetmonedas2").load(location.href + " #resetmonedas2");	
		$("#resetmonedas3").load(location.href + " #resetmonedas3");		
		$("#reseteateNUEVObanco").load(location.href + " #reseteateNUEVObanco");	
		$("#mensajeDOCUnuevoBANCO").html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(3000).fadeOut(); 

   }
   
})
});


$(document).on('click', '.view_databorraNUEVOborra', function(){
  var borra_BANCO_IP = $(this).attr("id");
  var borra_BANCO = "borra_BANCO";
  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR
  $.ajax({
  url:"MONEDAS/controladorM.php",
   method:"POST",
   data:{borra_BANCO_IP:borra_BANCO_IP,borra_BANCO:borra_BANCO},
    beforeSend:function(){  
    $('#mensajeMONEDAS2').html('CARGANDO'); 
    },    
   success:function(data){
		$("#resetmonedas1").load(location.href + " #resetmonedas1");
		$("#resetmonedas2").load(location.href + " #resetmonedas2");	
		$("#resetmonedas3").load(location.href + " #resetmonedas3");
			$('#dataModal3').modal('hide');	   
			$("#mensajeDOCUnuevoBANCO").html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(3000).fadeOut(); 		
			$("#reseteateNUEVObanco").load(location.href + " #reseteateNUEVObanco");
   }
  });
    //AGREGAR	
	});
 //AGREGAR	 
 }); 


function obtenerConfigBorradoMonedas(contenedorId, idRegistro) {
	if (contenedorId === '2IMAGENDOLARES') {
		return {
			data: {borra_id_Dolares: idRegistro, borrasDolares: 'borrasDolares'},
			mensaje: '#mensajeMONEDAS',
			recarga: '#2IMAGENDOLARES'
		};
	}
	if (contenedorId === '2IMAGENEUROS') {
		return {
			data: {borra_id_EUROS: idRegistro, borrasEUROS: 'borrasEUROS'},
			mensaje: '#mensajeMONEDAS2',
			recarga: '#2IMAGENEUROS'
		};
	}
	if (contenedorId === '2IMAGENTODOS') {
		return {
			data: {borra_id_TODOS: idRegistro, borrasTODOS: 'borrasTODOS'},
			mensaje: '#mensajeMONEDAS3',
			recarga: '#2IMAGENTODOS'
		};
	}
	if (contenedorId === '2IMAGENLIBRA') {
		return {
			data: {borra_id_LIBRA: idRegistro, borrasLIBRA: 'borrasLIBRA'},
			mensaje: '#mensajeMONEDAS4',
			recarga: '#2IMAGENLIBRA'
		};
	}
	return null;
}

$(document).on('click', '.view_dataAEborrar', function(){
	var idRegistro = $(this).attr('id');
	var contenedorId = $(this).closest('div').attr('id');
	var config = obtenerConfigBorradoMonedas(contenedorId, idRegistro);
	if (!config) {
		return;
	}
	$('#personal_detalles3').html();
	$('#dataModal3').modal('show');
	$('#btnYes').off('click').on('click', function() {
		$.ajax({
			url:"MONEDAS/controladorM.php",
			method:'POST',
			data: config.data,
			beforeSend:function(){
				$(config.mensaje).html('cargando');
			},
			success:function(){
				$('#dataModal3').modal('hide');
				$(config.recarga).load(location.href + " " + config.recarga);
			}
		});
	});
});




//SCRIPT PARA BORRAR FOTOGRAFIA IMAGEN_MONEDASOLARES
$(document).on('click', '.view_dolar_Bborrar', function(){
var borra_id_Dolares = $(this).attr('id');
var borrasDolares = 'borrasDolares';
$('#personal_detalles3').html();
$('#dataModal3').modal('show');
	$('#btnYes').click(function() {
		$.ajax({
			url:"MONEDAS/controladorM.php",
			method:'POST',
			data:{borra_id_Dolares:borra_id_Dolares,borrasDolares:borrasDolares},
			beforeSend:function(){
				$('#mensajeMONEDActualiza').html('cargando');
			},
				success:function(data){
					$('#dataModal3').modal('hide');
					$('#'+borra_id_Dolares).html("<span id='ACTUALIZADO' >"+data+"</span>");
				}
		});
	});
});





//SCRIPT PARA BORRAR FOTOGRAFIA IMAGEN_MONEDASEUROS
$(document).on('click', '.view_EURO_Bborrar', function(){
var borra_id_EUROS = $(this).attr('id');
var borrasEUROS = 'borrasEUROS';
$('#personal_detalles3').html();
$('#dataModal3').modal('show');
	$('#btnYes').click(function() {
		$.ajax({
			url:"MONEDAS/controladorM.php",
			method:'POST',
			data:{borra_id_EUROS:borra_id_EUROS,borrasEUROS:borrasEUROS},
			beforeSend:function(){
				$('#mensajeMONEDActualiza').html('cargando');
			},
				success:function(data){
					$('#dataModal3').modal('hide');
					$('#'+borra_id_EUROS).html("<span id='ACTUALIZADO' >"+data+"</span>");
				}
		});
	});
});




//SCRIPT PARA BORRAR FOTOGRAFIA IMAGEN_MONEDASTODOS view_todos_Bborrar
$(document).on('click', '.view_todos_Bborrar', function(){
var borra_id_TODOS = $(this).attr('id');
var borrasTODOS = 'borrasTODOS';
$('#personal_detalles3').html();
$('#dataModal3').modal('show');
	$('#btnYes').click(function() {
		$.ajax({
			url:"MONEDAS/controladorM.php",
			method:'POST',
			data:{borra_id_TODOS:borra_id_TODOS,borrasTODOS:borrasTODOS},
			beforeSend:function(){
				$('#mensajeMONEDActualiza').html('cargando');
			},
				success:function(data){
					$('#dataModal3').modal('hide');
					$('#'+borra_id_TODOS).html("<span id='ACTUALIZADO' >"+data+"</span>");
				}
		});
	});
});

//SCRIPT PARA BORRAR FOTOGRAFIA IMAGEN_MONEDASLIBRA
$(document).on('click', '.view_LIBRA_Bborrar', function(){
var borra_id_LIBRA = $(this).attr('id');
var borrasLIBRA = 'borrasLIBRA';
$('#personal_detalles3').html();
$('#dataModal3').modal('show');
	$('#btnYes').click(function() {
		$.ajax({
			url:"MONEDAS/controladorM.php",
			method:'POST',
			data:{borrasLIBRA:borrasLIBRA,borra_id_LIBRA:borra_id_LIBRA},
			beforeSend:function(){
				$('#mensajeMONEDActualiza').html('cargando');
			},
				success:function(data){
					$('#dataModal3').modal('hide');
					$('#'+borra_id_LIBRA).html("<span id='ACTUALIZADO' >"+data+"</span>");
				}
		});
	});
});
/////////////////////  MONEDAS  2 //////////////////////////////////////


$("#GUARDAR_MONEDAS2").click(function(){
const formData = new FormData($('#MONEDASform2')[0]);

$.ajax({
    url:"MONEDAS/controladorM.php",
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajeMONEDAS2').html('cargando'); 
    },    
   success:function(data){
		$("#2IMAGENEUROS").load(location.href + " #2IMAGENEUROS");
		$("#reset_MONEDAS2").load(location.href + " #reset_MONEDAS2");	
			$("#mensajeMONEDAS2").html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(3000).fadeOut(); 

   }
   
})
});


$(document).on('click', '.view_MONEDAS2', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
  url:"MONEDAS/VistaPreviaMONEDAS2.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajeMONEDAS2').html('CARGANDO').fadeIn().delay(3000).fadeOut(); 
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 })



$(document).on('click', '.view_dataMONEDASborrar2', function(){

  var borra_moneda2 = $(this).attr("id");
  var borra_MONEDAS2 = "borra_MONEDAS2";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
  url:"MONEDAS/controladorM.php",
   method:"POST",
   data:{borra_moneda2:borra_moneda2,borra_MONEDAS2:borra_MONEDAS2},
   
    beforeSend:function(){  
    $('#mensajeMONEDAS2').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajeMONEDAS2").html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(3000).fadeOut(); 		
			$("#reset_MONEDAS2").load(location.href + " #reset_MONEDAS2");
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });		

/////////////////////SCRIPT enviar EMAIL//////
$(document).on('click', '#BUTTON_MONEDAS2', function(){
var EMAIL_MONEDAS2 = $('#EMAIL_MONEDAS2').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emil_MONEDAS2").serialize();

$.ajax({
  url:"MONEDAS/controladorM.php",
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_MONEDAS2:EMAIL_MONEDAS2},


beforeSend:function(){
$('#mensajeMONEDAS2').html('cargando');
},
success:function(data){
$('#mensajeMONEDAS2').html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(3000).fadeOut(); 

}
});
});



/////////////////////  MONEDAS  3//////////////////////////////////////



$("#GUARDAR_MONEDAS3").click(function(){
const formData = new FormData($('#MONEDASform3')[0]);

$.ajax({
    url:"MONEDAS/controladorM.php",
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajeMONEDAS3').html('cargando'); 
    },    
   success:function(data){
	$("#2IMAGENTODOS").load(location.href + " #2IMAGENTODOS");
	$("#reset_MONEDAS3").load(location.href + " #reset_MONEDAS3");	
	$("#mensajeMONEDAS3").html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(3000).fadeOut(); 

   }
   
})
});


$(document).on('click', '.view_MONEDAS3', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
  url:"MONEDAS/VistaPreviaMONEDAS3.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajeMONEDAS3').html('CARGANDO').fadeIn().delay(3000).fadeOut();  
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 })



$(document).on('click', '.view_dataMONEDASborrar3', function(){

  var borra_moneda3 = $(this).attr("id");
  var borra_MONEDAS3 = "borra_MONEDAS3";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
  url:"MONEDAS/controladorM.php",
   method:"POST",
   data:{borra_moneda3:borra_moneda3,borra_MONEDAS3:borra_MONEDAS3},
   
    beforeSend:function(){  
    $('#mensajeMONEDAS3').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajeMONEDAS3").html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(3000).fadeOut(); 			
			$("#reset_MONEDAS3").load(location.href + " #reset_MONEDAS3");
			$("#reset_MONEDAS2").load(location.href + " #reset_MONEDAS2");
			
		$("#reset_MONEDAS").load(location.href + " #reset_MONEDAS");	
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });		

/////////////////////SCRIPT enviar EMAIL//////
$(document).on('click', '#BUTTON_MONEDAS3', function(){
var EMAIL_MONEDAS3 = $('#EMAIL_MONEDAS3').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emil_MONEDAS3").serialize();

$.ajax({
  url:"MONEDAS/controladorM.php",
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_MONEDAS3:EMAIL_MONEDAS3},


beforeSend:function(){
$('#mensajeMONEDAS3').html('cargando');
},
success:function(data){
$('#mensajeMONEDAS3').html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(3000).fadeOut(); 

}
});
});



/////////////////////  MONEDAS  4 //////////////////////////////////////



$("#GUARDAR_MONEDAS4").click(function(){
const formData = new FormData($('#MONEDASform4')[0]);

$.ajax({
    url:"MONEDAS/controladorM.php",
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajeMONEDAS4').html('cargando'); 
    },    
   success:function(data){
		$("#2IMAGENLIBRA").load(location.href + " #2IMAGENLIBRA");	
		$("#reset_MONEDAS4").load(location.href + " #reset_MONEDAS4");		
			$("#mensajeMONEDAS4").html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(3000).fadeOut(); 

   }
   
})
});


$(document).on('click', '.view_MONEDAS4', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
  url:"MONEDAS/VistaPreviaMONEDAS4.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajeMONEDAS4').html('CARGANDO').fadeIn().delay(3000).fadeOut(); 
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 })



$(document).on('click', '.view_dataMONEDASborrar4', function(){

  var borra_moneda4 = $(this).attr("id");
  var borra_MONEDAS4 = "borra_MONEDAS4";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
  url:"MONEDAS/controladorM.php",
   method:"POST",
   data:{borra_moneda4:borra_moneda4,borra_MONEDAS4:borra_MONEDAS4},
   
    beforeSend:function(){  
    $('#mensajeMONEDAS4').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajeMONEDAS4").html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(3000).fadeOut(); 		
			$("#reset_MONEDAS4").load(location.href + " #reset_MONEDAS4");
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });		

/////////////////////SCRIPT enviar EMAIL//////
$(document).on('click', '#BUTTON_MONEDAS4', function(){
var EMAIL_MONEDAS4 = $('#EMAIL_MONEDAS4').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emil_MONEDAS4").serialize();

$.ajax({
  url:"MONEDAS/controladorM.php",
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_MONEDAS4:EMAIL_MONEDAS4},


beforeSend:function(){
$('#mensajeMONEDAS4').html('cargando');
},
success:function(data){
$('#mensajeMONEDAS4').html("<span id='ACTUALIZADO' >"+data+"</span>").fadeIn().delay(3000).fadeOut(); 

}
});
});


			$('#target1').hide("linear");
			$('#target2').hide("linear");
			$('#target3').hide("linear");
			$('#target4').hide("linear");
			$('#target5').hide("linear");
			$('#target6').hide("linear");
			$('#target7').hide("linear");
			$('#target8').hide("linear");
			$('#target9').hide("linear");
			$('#target10').hide("linear");
			$('#target11').hide("linear");
			$('#target12').hide("linear");
			$('#target13').hide("linear");
			$('#target14').hide("linear");
			$('#target15').hide("linear");
			$('#target16').hide("linear");
			$('#target17').hide("linear");
			$('#target18').hide("linear");
			$('#target19').hide("linear");
			$('#target20').hide("linear");
			$('#target21').hide("linear");
			$('#target22').hide("linear");
			$('#target23').hide("linear");
			$('#target24').hide("linear");
			$('#target25').hide("linear");
			$('#target26').hide("linear");
			$('#target27').hide("linear");
			$('#target28').hide("linear");
			$('#target29').hide("linear");
			$('#target30').hide("linear");
			$('#target31').hide("linear");
			$('#target32').hide("linear");
			$('#target33').hide("linear");
			$('#target34').hide("linear");
			$('#target35').hide("linear");
			$('#target35').hide("linear");
			$('#target37').hide("linear");
			$('#target38').hide("linear");
			$('#target39').hide("linear");
			$('#target40').hide("linear");
			$('#target41').hide("linear");
			$('#target42').hide("linear");
			$('#target43').hide("linear");
			$('#target44').hide("linear");
			$('#targetVIDEO').hide("linear");
			
			$("#mostrar1").click(function(){
				$('#target1').show("swing");
		 	});
			$("#ocultar1").click(function(){
				$('#target1').hide("linear");
			});
			$("#mostrar2").click(function(){
				$('#target2').show("swing");
		 	});
			$("#ocultar2").click(function(){
				$('#target2').hide("linear");
			});
			$("#mostrar3").click(function(){
				$('#target3').show("swing");
		 	});
			$("#ocultar3").click(function(){
				$('#target3').hide("linear");
			});
			$("#mostrar4").click(function(){
				$('#target4').show("swing");
		 	});
			$("#ocultar4").click(function(){
				$('#target4').hide("linear");
			});
			$("#mostrar5").click(function(){
				$('#target5').show("swing");
		 	});
			$("#ocultar5").click(function(){
				$('#target5').hide("linear");
			});
			$("#mostrar6").click(function(){
				$('#target6').show("swing");
		 	});
			$("#ocultar6").click(function(){
				$('#target6').hide("linear");
			});
			$("#mostrar7").click(function(){
				$('#target7').show("swing");
		 	});
			$("#ocultar7").click(function(){
				$('#target7').hide("linear");
			});
			$("#mostrar8").click(function(){
				$('#target8').show("swing");
		 	});
			$("#ocultar8").click(function(){
				$('#target8').hide("linear");
			});
			$("#mostrar9").click(function(){
				$('#target9').show("swing");
		 	});
			$("#ocultar9").click(function(){
				$('#target9').hide("linear");
			});
			$("#mostrar10").click(function(){
				$('#target10').show("swing");
		 	});
			$("#ocultar10").click(function(){
				$('#target10').hide("linear");
			});
			$("#mostrar11").click(function(){
				$('#target11').show("swing");
		 	});
			$("#ocultar11").click(function(){
				$('#target11').hide("linear");
			});
			$("#mostrar12").click(function(){
				$('#target12').show("swing");
		 	});
			$("#ocultar12").click(function(){
				$('#target12').hide("linear");
			});
			$("#mostrar13").click(function(){
				$('#target13').show("swing");
		 	});
			$("#ocultar13").click(function(){
				$('#target13').hide("linear");
			});

			$("#mostrar14").click(function(){
				$('#target14').show("swing");
		 	});
			$("#ocultar14").click(function(){
				$('#target14').hide("linear");
			});
			
			$("#mostrar15").click(function(){
				$('#target15').show("swing");
		 	});
			$("#ocultar15").click(function(){
				$('#target15').hide("linear");
			});
				$("#mostrar16").click(function(){
				$('#target16').show("swing");
		 	});
			$("#ocultar16").click(function(){
				$('#target16').hide("linear");
			});
				$("#mostrar17").click(function(){
				$('#target17').show("swing");
		 	});
			$("#ocultar17").click(function(){
				$('#target17').hide("linear");
			});
				$("#mostrar18").click(function(){
				$('#target18').show("swing");
		 	});
			$("#ocultar18").click(function(){
				$('#target18').hide("linear");
			});
				$("#mostrar19").click(function(){
				$('#target19').show("swing");
		 	});
			$("#ocultar19").click(function(){
				$('#target19').hide("linear");
			});
				$("#mostrar20").click(function(){
				$('#target20').show("swing");
		 	});
			$("#ocultar20").click(function(){
				$('#target20').hide("linear");
				
			});
					$("#mostrar21").click(function(){
				$('#target21').show("swing");
		 	});
			$("#ocultar21").click(function(){
				$('#target21').hide("linear");
				
			});
					$("#mostrar22").click(function(){
				$('#target22').show("swing");
		 	});
			$("#ocultar22").click(function(){
				$('#target22').hide("linear");
				
			});
					$("#mostrar23").click(function(){
				$('#target23').show("swing");
		 	});
			$("#ocultar23").click(function(){
				$('#target23').hide("linear");
				
			});
					$("#mostrar24").click(function(){
				$('#target24').show("swing");
		 	});
			$("#ocultar24").click(function(){
				$('#target24').hide("linear");
				
			});
					$("#mostrar25").click(function(){
				$('#target25').show("swing");
		 	});
			$("#ocultar25").click(function(){
				$('#target25').hide("linear");
				
			});
					$("#mostrar26").click(function(){
				$('#target26').show("swing");
		 	});
			$("#ocultar26").click(function(){
				$('#target26').hide("linear");
				
			});
					$("#mostrar27").click(function(){
				$('#target27').show("swing");
		 	});
			$("#ocultar27").click(function(){
				$('#target27').hide("linear");
				
			});
					$("#mostrar28").click(function(){
				$('#target28').show("swing");
		 	});
			$("#ocultar28").click(function(){
				$('#target28').hide("linear");
				
			});
					$("#mostrar29").click(function(){
				$('#target29').show("swing");
		 	});
			$("#ocultar29").click(function(){
				$('#target29').hide("linear");
				
			});
					$("#mostrar30").click(function(){
				$('#target30').show("swing");
		 	});
			$("#ocultar30").click(function(){
				$('#target30').hide("linear");
				
			});
					$("#mostrar31").click(function(){
				$('#target31').show("swing");
		 	});
			$("#ocultar31").click(function(){
				$('#target31').hide("linear");
				
			});
					$("#mostrar32").click(function(){
				$('#target32').show("swing");
		 	});
			$("#ocultar32").click(function(){
				$('#target32').hide("linear");
				
			});
					$("#mostrar303").click(function(){
				$('#target33').show("swing");
		 	});
			$("#ocultar33").click(function(){
				$('#target33').hide("linear");
				
			});
					$("#mostrar34").click(function(){
				$('#target34').show("swing");
		 	});
			$("#ocultar34").click(function(){
				$('#target34').hide("linear");
				
			});
					$("#mostrar35").click(function(){
				$('#target35').show("swing");
		 	});
			$("#ocultar35").click(function(){
				$('#target35').hide("linear");
				
			});
					$("#mostrar36").click(function(){
				$('#target36').show("swing");
		 	});
			$("#ocultar36").click(function(){
				$('#target36').hide("linear");
				
			});
					$("#mostrar37").click(function(){
				$('#target37').show("swing");
		 	});
			$("#ocultar37").click(function(){
				$('#target37').hide("linear");
				
			});
					$("#mostrar38").click(function(){
				$('#target38').show("swing");
		 	});
			$("#ocultar38").click(function(){
				$('#target38').hide("linear");
				
			});
					$("#mostrar39").click(function(){
				$('#target39').show("swing");
		 	});
			$("#ocultar39").click(function(){
				$('#target39').hide("linear");
				
			});
					$("#mostrar40").click(function(){
				$('#target40').show("swing");
		 	});
			$("#ocultar40").click(function(){
				$('#target40').hide("linear");
				
			});
       

			$("#mostrarVIDEO").click(function(){
				$('#targetVIDEO').show("swing");
		 	});
			$("#ocultarVIDEO").click(function(){
				$('#targetVIDEO').hide("linear");
			});

			$("#mostrartodos").click(function(){
		
				$('#target1').show("swing");
				$('#target2').show("swing");
				$('#target3').show("swing");
				$('#target4').show("swing");
				$('#target5').show("swing");
				$('#target6').show("swing");
				$('#target7').show("swing");
				$('#target8').show("swing");
				$('#target9').show("swing");
				$('#target10').show("swing");
				$('#target11').show("swing");
				$('#target12').show("swing");
				$('#target13').show("swing");
				$('#target14').show("swing");
				$('#target15').show("swing");
				$('#target16').show("swing");
				$('#target17').show("swing");
				$('#target18').show("swing");
				$('#target19').show("swing");
				$('#target20').show("swing");
				$('#target21').show("swing");
				$('#target22').show("swing");
				$('#target23').show("swing");
				$('#target24').show("swing");
				$('#target25').show("swing");
				$('#target26').show("swing");
				$('#target27').show("swing");
				$('#target28').show("swing");
				$('#target29').show("swing");
				$('#target30').show("swing");
				$('#target31').show("swing");
				$('#target32').show("swing");
				$('#target33').show("swing");
				$('#target34').show("swing");
				$('#target35').show("swing");
				$('#target36').show("swing");
				$('#target37').show("swing");
				$('#target38').show("swing");
				$('#target39').show("swing");
				$('#target40').show("swing");
				$('#target41').show("swing");
				$('#target42').show("swing");
				$('#target43').show("swing");
				$('#target44').show("swing");
				$('#targetVIDEO').show("swing");
		 	});
			
			$("#ocultartodos").click(function(){
				
				$('#target1').hide("swing");
				$('#target2').hide("swing");
				$('#target3').hide("swing");
				$('#target4').hide("swing");
				$('#target5').hide("swing");
				$('#target6').hide("swing");
				$('#target7').hide("swing");
				$('#target8').hide("swing");
				$('#target9').hide("swing");
				$('#target10').hide("swing");
				$('#target11').hide("swing");
				$('#target12').hide("swing");
				$('#target13').hide("swing");
				$('#target14').hide("swing");
				$('#target15').hide("swing");
				$('#target16').hide("swing");
				$('#target17').hide("swing");
				$('#target18').hide("swing");
				$('#target19').hide("swing");
				$('#target20').hide("swing");
				$('#target21').hide("swing");
				$('#target22').hide("swing");
				$('#target23').hide("swing");
				$('#target24').hide("swing");
				$('#target25').hide("swing");
				$('#target26').hide("swing");
				$('#target27').hide("swing");
				$('#target28').hide("swing");
				$('#target29').hide("swing");
				$('#target30').hide("swing");
				$('#target31').hide("swing");
				$('#target32').hide("swing");
				$('#target33').hide("swing");
				$('#target34').hide("swing");
				$('#target35').hide("swing");
				$('#target36').hide("swing");
				$('#target37').hide("swing");
				$('#target38').hide("swing");
				$('#target39').hide("swing");
				$('#target40').hide("swing");
				$('#target41').hide("swing");
				$('#target42').hide("swing");
				$('#target43').hide("swing");
				$('#target44').hide("swing");
				$('#targetVIDEO').hide("linear");
			});

			$("#mostrartodos2").click(function(){
		
				$('#target1').show("swing");
				$('#target2').show("swing");
				$('#target3').show("swing");
				$('#target4').show("swing");
				$('#target5').show("swing");
				$('#target6').show("swing");
				$('#target7').show("swing");
				$('#target8').show("swing");
				$('#target9').show("swing");
				$('#target10').show("swing");
				$('#target11').show("swing");
				$('#target12').show("swing");
				$('#target13').show("swing");
				$('#target14').show("swing");
				$('#target15').show("swing");
				$('#target16').show("swing");
				$('#target17').show("swing");
				$('#target18').show("swing");
				$('#target19').show("swing");
				$('#target20').show("swing");
				$('#target21').show("swing");
				$('#target22').show("swing");
				$('#target23').show("swing");
				$('#target24').show("swing");
				$('#target25').show("swing");
				$('#target26').show("swing");
				$('#target27').show("swing");
				$('#target28').show("swing");
				$('#target29').show("swing");
				$('#target30').show("swing");
				$('#target31').show("swing");
				$('#target32').show("swing");
				$('#target33').show("swing");
				$('#target34').show("swing");
				$('#target35').show("swing");
				$('#target36').show("swing");
				$('#target37').show("swing");
				$('#target38').show("swing");
				$('#target39').show("swing");
				$('#target40').show("swing");
				$('#target41').show("swing");
				$('#target42').show("swing");
				$('#target43').show("swing");
				$('#target44').show("swing");
				$('#targetVIDEO').show("swing");
		 	});
			
			$("#ocultartodos2").click(function(){
				
					$('#target1').hide("swing");
				$('#target2').hide("swing");
				$('#target3').hide("swing");
				$('#target4').hide("swing");
				$('#target5').hide("swing");
				$('#target6').hide("swing");
				$('#target7').hide("swing");
				$('#target8').hide("swing");
				$('#target9').hide("swing");
				$('#target10').hide("swing");
				$('#target11').hide("swing");
				$('#target12').hide("swing");
				$('#target13').hide("swing");
				$('#target14').hide("swing");
				$('#target15').hide("swing");
				$('#target16').hide("swing");
				$('#target17').hide("swing");
				$('#target18').hide("swing");
				$('#target19').hide("swing");
				$('#target20').hide("swing");
				$('#target21').hide("swing");
				$('#target22').hide("swing");
				$('#target23').hide("swing");
				$('#target24').hide("swing");
				$('#target25').hide("swing");
				$('#target26').hide("swing");
				$('#target27').hide("swing");
				$('#target28').hide("swing");
				$('#target29').hide("swing");
				$('#target30').hide("swing");
				$('#target31').hide("swing");
				$('#target32').hide("swing");
				$('#target33').hide("swing");
				$('#target34').hide("swing");
				$('#target35').hide("swing");
				$('#target36').hide("swing");
				$('#target37').hide("swing");
				$('#target38').hide("swing");
				$('#target39').hide("swing");
				$('#target40').hide("swing");
				$('#target41').hide("swing");
				$('#target42').hide("swing");
				$('#target43').hide("swing");
				$('#target44').hide("swing");
				$('#targetVIDEO').hide("linear");
			});

		});
		
	</script>