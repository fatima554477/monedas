        <div class="sidebar-header">
          <div>
           <img src="https://www.epcinn.com/pruebas/crm2/main-files/syn-ui/collapsed-menu/assets/images/icons/epc.png"  alt="logo icon">
          </div>
   
          <div class="toggle-icon ms-auto"><ion-icon name="menu-sharp"></ion-icon>
          </div>
        </div>
        <!--navigation-->
        <ul class="metismenu" id="menu">
          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><ion-icon name="home-sharp"></ion-icon>
              </div>
              <div class="menu-title">MENU CRM</div>
            </a>

          </li>

         <li class="menu-label">WEB APPS</li>


	<li>

		
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><img src="iconos/infoin.png">
              </div>
              <div class="menu-title">INFORMACIÓN IMPORTANTE</div>
            </a>
			
       <ul>
              <li> <a href="INFORMACION_IMPORTANTE.php"><ion-icon name="ellipse-outline"></ion-icon>INFORMACIÓN IMPORTANTE </a>
              </ul>
              </li>




				<li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><img src="iconos/eventos.png">
              </div>
              <div class="menu-title">EVENTOS</div>
            </a>
			
       <ul>
	   

              <li> <a href="ALTA_EVENTOS.php"><ion-icon name="ellipse-outline"></ion-icon>ALTA DE EVENTOS</a>
              </ul>
              </li>

      		<li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><img src="iconos/calendario1.png">
              </div>
              <div class="menu-title">CALENDARIO</div>
            </a>
			
       </li>





			<li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><img src="iconos/proveedores.png">
              </div>
              <div class="menu-title">PROVEEDORES</div>
            </a>
			
            <ul>
              <li> <a href="PROVEEDORES.php"><ion-icon name="ellipse-outline"></ion-icon>PROVEEDORES </a>
              </li>
              <li> <a href="pagoproveedores.php"><ion-icon name="ellipse-outline"></ion-icon>PAGO A PROVEEDORES-A</a>
              </li>
               <li> <a href="ventas_operaciones.php"><ion-icon name="ellipse-outline"></ion-icon>PAGO A PROVEEDORES-VYO</a>
              </li>
	
              <li> <a href="SOLOPROVEEDORES.php"><ion-icon name="ellipse-outline"></ion-icon>FORMULARIO PARA PROVEEDORES</a>
              </li>
              <li> <a href="subirfactura.php"><ion-icon name="ellipse-outline"></ion-icon>SUBE TUS FACTURAS</a>
              </li>

               <li> <a href="listaproveedores.php"><ion-icon name="ellipse-outline"></ion-icon>LISTA DE PROVEEDORES</a>
              </li>
            </ul>			
			
			
          </li>





















			<li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><img src="iconos/user.png">
              </div>
              <div class="menu-title">COLABORADORES</div>
            </a>
			
            <ul>
	<?php if($_SESSION['NIVEL_ACCESO_CRM']=='MAXIMO' OR $_SESSION['STATUS_CARGA_INFORMACION']!='COLABORADOR'){}ELSE{?>
              <li> <a href="solocolaboradores.php"><ion-icon name="ellipse-outline"></ion-icon>COLABORADORES</a>
              </li>
	<?php } ?>
	
	<?php if($_SESSION['STATUS_CARGA_INFORMACION']=='COLABORADOR'){}ELSE{?>
              <li> <a href="coordinadores.php"><ion-icon name="ellipse-outline"></ion-icon>CORDINADORES Y ANIMADORES</a>
              </li>
	<?php } ?>			  
			  
	<?php if($_SESSION['NIVEL_ACCESO_CRM']=='MAXIMO' and $_SESSION['STATUS_CARGA_INFORMACION']=='COLABORADOR'){?>		  
              <li> <a href="colaboradores.php"><ion-icon name="ellipse-outline"></ion-icon>DOCUMENTOS DEL COLABORADOR</a>
              </li>
	<?php } ?>
	
	<?php if($_SESSION['NIVEL_ACCESO_CRM']=='MAXIMO' and $_SESSION['STATUS_CARGA_INFORMACION']=='COLABORADOR'){?>
              <li> <a href="listacolaboradores.php"><ion-icon name="ellipse-outline"></ion-icon>LISTA DE COLABORADORES</a>
              </li>
	<?php } ?>
     	
			
			
          </li>
         
  	<?php if($_SESSION['NIVEL_ACCESO_CRM']=='MAXIMO' and $_SESSION['STATUS_CARGA_INFORMACION']=='COLABORADOR'){?>  
              <li> <a href="cargamasiva.php"><ion-icon name="ellipse-outline"></ion-icon>CARGA MASIVA</a>
              </li>
	<?php } ?>
       
          </ul>   



          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><img src="iconos/empresa.png">
              </div>
              <div class="menu-title">EMPRESAS DEL CORPORATIVO</div>
            </a>
			
            <ul>
            <?php if($_SESSION['NIVEL_ACCESO_CRM']=='MAXIMO' and $_SESSION['STATUS_CARGA_INFORMACION']=='COLABORADOR'){?>
              <li> <a href="listadeempresas.php"><ion-icon name="ellipse-outline"></ion-icon>LISTADO DE EMPRESAS </a>
              </li>
	          <?php } ?>
             
            </ul>			

	
			
			
          </li>


          <li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><img src="iconos/inventariop.png">
              </div>
              <div class="menu-title">INVENTARIO</div>
            </a>
			
            <ul>
              <li> <a href="inventario_general.php"><ion-icon name="ellipse-outline"></ion-icon>INVENTARIO GENERAL</a>
              </li>
             
            </ul>			
			
			
          </li>


			<!--<li>
            <a href="prueba2.php">
              <div class="parent-icon"><img src="iconos/proveedores.png">
              </div>
              <div class="menu-title">Proveedores</div>
            </a>
          </li>-->
          






			<li>
           <a href="?">
              <div class="parent-icon"><img src="iconos/facturas.png">
              </div>
              <div class="menu-title">FACTURAS</div>
            </a>
          </li>
          
			<li>
            <a href="javascript:;" class="has-arrow">
              <div class="parent-icon"><img src="iconos/configuracion.png">
              </div>
              <div class="menu-title">CONFIGURACIÓN</div>
            </a>
			
       <ul>
              <li> <a href="PERMISOS.php"><ion-icon name="ellipse-outline"></ion-icon>PERMISOS </a>
              </ul>
              </li>	

			<li>
           <a href="ayudas.php">
              <div class="parent-icon"><img src="iconos/videos.png">
              </div>
              <div class="menu-title">AYUDAS Y VIDEOS</div>
            </a>
          </li>







			<li>
           <a href="index.php?salir=1">
              <div class="parent-icon"><img src="iconos/salir.png">
              </div>
              <div class="menu-title">SALIR</div>
            </a>
          </li>


















          
  
        </ul>
        <!--end navigation-->