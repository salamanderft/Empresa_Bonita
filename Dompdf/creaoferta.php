<?php
	session_start();
	if(isset($_SESSION["admretorna"]))
	{
		include("../clases/clases.php");
		include("../php/funciones.php");
		$codusu = $_SESSION["admretorna"];
		$datosusu = new Consulta("administradores","WHERE cod_adm = $codusu");
		$rowusu = $datosusu->hconfetch();
		$nomusu = $rowusu["nom_adm"];
		
		//vamos sacar los datos
		
		$ema = $rowusu["email_adm"];		
		
		//$img = $rowusu["imagen_per"];
		
		//vamos a consultar los sectores
		$datossec = new Consulta("ramas","ORDER BY campo_ram ASC");
		
		//recibimos el codigo de la empresa
		$codemp = $_GET["doc"];
		//buscamos esa empresa
		
		$datosper = new Consulta("empresas"," WHERE cod_emp =$codemp");
		$regper = $datosper->hconfetch();
        $nom = $regper["nom_emp"];
        
		
		
?>
<!DOCTYPE html>


<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Retorna. Fundación Venancio Salcines</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.php" class="app-brand-link">
              
              <span class="app-brand-text demo menu-text fw-bolder ms-2"><img src="imagenes/retornalogo.png" width="45%"></span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
              <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home"></i>
                <div data-i18n="Analytics">Inicio</div>
              </a>
            </li>

            <!-- Layouts -->
            
			 <li class="menu-item">
              <a href="candidatos.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-face"></i>
                <div data-i18n="Analytics">Candidatos</div>
              </a>
            </li>
            
             <li class="menu-item open">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-building-house"></i>
                <div data-i18n="Account Settings">Empresas</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item ">
                  <a href="altaempresa.php" class="menu-link">
                    <div data-i18n="Account">Alta empresa</div>
                  </a>
                </li>
                <li class="menu-item active">
                  <a href="consultaempresa.php" class="menu-link">
                    <div data-i18n="Notifications">Consulta empresa</div>
                  </a>
                </li>
                
              </ul>
            </li>
            
            <li class="menu-item ">
              <a href="ofertas.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-donate-heart"></i>
                <div data-i18n="Analytics">Ofertas laborales</div>
              </a>
            </li>
            
            <li class="menu-item ">
              <a href="colocados.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-trophy"></i>
                <div data-i18n="Analytics">Candidatos colocados</div>
              </a>
            </li>
			<li class="menu-item ">
              <a href="administradores.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Analytics">Administradores</div>
              </a>
            </li>
            
            <li class="menu-item">
              <a
                href="notificaciones.php"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div data-i18n="Support">Notificaciones</div>
              </a>
            </li>

           
            <!-- Misc -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Plan Retorna</span></li>
            
            <li class="menu-item">
              <a
                href="help.php"
                class="menu-link"
              >
                <i class="menu-icon tf-icons bx bx-question-mark"></i>
                <div data-i18n="Documentation">Ayuda</div>
              </a>
            </li>
             <li class="menu-header small text-uppercase"><span class="menu-header-text">Entidad colaboradora</span></li>
             <div class="app-brand demo">
            <a target= "_blank" href="https://fundacionsalcines.org" class="app-brand-link">
              
              <span class="app-brand-text demo menu-text fw-bolder ms-2"><img src="imagenes/fundacionsalcines.png" width="40%"></span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>
          </ul>
          
          
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Buscar..."
                    aria-label="Buscar..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                    <?php
                    	if($img == "")
                    	{
                    ?>
                      <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                      <?php
                      	}
                      	else
                      	{
                      	$rutaimg = "./usuarios/$codusu/avatar/$img";
                      	?>
                      	<img src="<?php echo $rutaimg;?>" alt class="w-px-40 h-auto rounded-circle" />
                      	<?php
                      	}
                      ?>
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="perfil.php">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                             <?php
                    	if($img == "")
                    	{
                    ?>
                      <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                      <?php
                      	}
                      	else
                      	{
                      	$rutaimg = "./usuarios/$codusu/avatar/$img";
                      	?>
                      	<img src="<?php echo $rutaimg;?>" alt class="w-px-40 h-auto rounded-circle" />
                      	<?php
                      	}
                      ?>
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?php echo $nomusu;?></span>
                            <small class="text-muted">Administrador</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="perfil.php">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Perfil</span>
                      </a>
                    </li>
                    
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="salir.php">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Crear oferta para la empresa</span> <?php echo $nom;?></h4>
<div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link " href="verempresa.php?doc=<?php echo $codemp;?>"><i class="bx bx-building-house me-1"></i> Datos empresa</a>
                      
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="creaoferta.php?doc=<?php echo $codemp;?>"
                        ><i class="bx bx-donate-heart me-1"></i> Crear oferta</a
                      >
                    </li>
                     <li class="nav-item">
                      <a class="nav-link" href="match.php?doc=<?php echo $codemp;?>"
                        ><i class="bx bx-group me-1"></i> Match de candidatos</a
                      >
                    </li>
                    
                  </ul>
                  <div class="card mb-4">
                  <p></p>
                    <div class="col-lg-12 col-md-12">
                      <div class="mt-3">
                        
                        <!-- Modal -->
                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Enviar email a </h5>
                                
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                                
                              </div>
                              <div class="modal-body">
                              <form action="enviarmail.php" method="POST">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Asunto</label>
                                    <input
                                      type="text"
                                      id="nameWithTitle"
                                      class="form-control"
                                      placeholder="Asunto"
                                      name="asunto"
                                    />
                                  </div>
                                </div>
                                <div class="row g-2">
                                
                                	
                                  <div class="col mb-3">
                                    <label for="emailWithTitle" class="form-label">Mensaje</label>
                                    <textarea class="form-control" style="resize:none" placeholder="Escribe el mensaje" rows=5 name="mensaje"></textarea>
                                  </div>
                                  
                                </div>
                              </div>
                              <div class="modal-footer">
                                
                                <input type="submit" class="btn btn-primary" value="Enviar">
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        
                        
                        
                        <div class="modal fade" id="modalCenterdos" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Recordar subir CV a </h5>
                                
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                                
                              </div>
                              <div class="modal-body">
                              <form action="enviarmail.php" method="POST">
                                <div class="row">
                                  <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Asunto</label>
                                    <input
                                      type="text"
                                      id="nameWithTitle"
                                      class="form-control"
                                      placeholder="Asunto"
                                      name="asunto"
                                      value="Recuerda subir tu curriculum a Retorna"
                                    />
                                  </div>
                                </div>
                                <div class="row g-2">
                                
                                	
                                  <div class="col mb-3">
                                    <label for="emailWithTitle" class="form-label">Mensaje</label>
                                    <textarea class="form-control" style="resize:none" placeholder="Escribe el mensaje" rows=5 name="mensaje"></textarea>
                                  </div>
                                  
                                </div>
                              </div>
                              <div class="modal-footer">
                                
                                <input type="submit" class="btn btn-primary" value="Enviar">
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                      </div>
                    </div>
                    <!-- Account -->
                    
                    <div class="card-body">
                    <center>
                      <button
                          class="btn btn-primary me-1"
                          type="button"
                    		onclick = "mostrarformes()"
                        >
                          <i class="bx bxs-graduation"></i> Por estudio
                        </button>
                        <button
                          class="btn btn-primary me-1"
                          type="button"
                    		onclick = "mostrarformex()"
                        >
                          <i class="bx bx-run"></i> Por experiencia
                        </button>
                        </center>
                    
                    
                      <form id="formAccountSettings" class="estudios" style="display:none">
                      <?php //echo "<input type='hidden' value='$img' id='imgantigua'>";?>
                        <div class="row">
                        
                        <div class="mb-12 col-md-12">
                           <label  class="form-label"><b><font color="#047CC4">Datos de la oferta POR ESTUDIOS</font></b></label>
                           </div>
                           <hr>
                          <div class="mb-3 col-md-4">
                            <label for="rama" class="form-label">Necesita... (Búsqueda por ramas)</label>
                            <select id="rama" class="select2 form-select">
                            <option value="">Selecciona Rama de estudios</option>
                             <?php
                             	foreach($datossec->hconquery() as $regsec)
                             	{
                             		$nomsec = $regsec["campo_ram"];
                             		$codigoram = $regsec["codigo_ram"];
                             		echo '<option value="'.$codigoram.'">'.$nomsec.'</option>';
                             	}
                             ?>
                              
                              

                            </select>
                          </div>
                          
                          <div class="mb-3 col-md-2">
                            <label for="vacante" class="form-label">Número de vacantes</label>
                            <input
                              class="form-control"
                              type="number"
                              id="vacante"
                              name="vacante"
                              placeholder= "Número de Vacantes"
                            />
                          </div>
                          
                          <div class="mb-3 col-md-2">
                            <label class="form-label" for="sexo">Sexo</label>
                            <select id="sexo" class="select2 form-select">
                            <option value="">Selecciona Sexo</option>
                              <option value="Hombre">Hombre</option>
								<option value="Mujer">Mujer</option>
			
                              
                            </select>
                          </div>
                          
                          <div class="mb-3 col-md-4">
                            <label class="form-label" for="country">País (en caso de no especificar país, déjalo sin seleccionar)</label>
                            <select id="pais" class="select2 form-select">
                            <option value="">Selecciona País</option>
                              <option value="Argentina">Argentina</option>
					<option value="Bolivia">Bolivia</option>
					<option value="Brasil">Brasil</option>
					<option value="Chile">Chile</option>
					<option value="Colombia">Colombia</option>
					<option value="Costa Rica">Costa Rica</option>
					<option value="Cuba">Cuba</option>
					<option value="República Dominicana">República Dominicana</option>
					<option value="Ecuador">Ecuador</option>
					<option value="El Salvador">El Salvador</option>
					<option value="Guayana Francesa">Guayana Francesa</option>
					<option value="Guatemala">Guatemala</option>
					<option value="Haití">Haití</option>
					<option value="Honduras">Honduras</option>
					<option value="México">México</option>
					<option value="Nicaragua">Nicaragua</option>
					<option value="Panamá">Panamá</option>
					<option value="Paraguay">Paraguay</option>
					<option value="Perú">Perú</option>
					<option value="Uruguay">Uruguay</option>
					<option value="Venezuela">Venezuela</option>
                              
                            </select>
                          </div>
                          
                         <div class="mb-3 col-md-12">
                            <label class="form-label" for="country">Descripción de la oferta</label>
                            <textarea id="descripcion" class="form-control" placeholder="Descripción" style="resize:none" maxlength='500'></textarea>
                          </div> 
                          
                          <input type="hidden" id="codigoemp" value="<?php echo $codemp;?>">
                          
                          
                          
                        </div>
                        <div class="mt-2">
                          <input type="button" class="btn btn-primary me-2" value="Crear oferta" onclick='creaoferta()'>
                        </div>
                      </form>
                      
                      
                      
                      <form id="formAccountSettings" class="experiencia" style="display:none">
                      <?php //echo "<input type='hidden' value='$img' id='imgantigua'>";?>
                        <div class="row">
                        
                        <div class="mb-12 col-md-12">
                           <label  class="form-label"><b><font color="#047CC4">Datos de la oferta POR EXPERIENCIA</font></b></label>
                           </div>
                           <hr>
                          <div class="mb-3 col-md-3">
                            <label for="rama" class="form-label">Necesita... (Búsqueda por ocupación)</label>
                            <select id="prof" class="select2 form-select" onchange="buscaprof1()">
                            <option value="">Selecciona</option>
                             <?php
                             	$datosocu = new Consulta("profesiones","");
                             	foreach($datosocu->hconquery() as $regocu)
                             	{
                             		$codprof = $regocu["cod_prof"];
                             		$nomprof = $regocu["nom_prof"];
                             		echo '<option value="'.$codprof.'">'.$nomprof.'</option>';
                             	}
                             ?>
                              
                              

                            </select>
                          </div>
                          <div id="laprofesion2" class="mb-3 col-md-3" style='display:none'>
                            <label for="prof2" class="form-label">Subcategoría:</label>
                            <select id="prof2" class="select2 form-select" onchange="buscaprof2()">
                            
                            </select>
                          </div>
                          <hr>
                          <div class="mb-3 col-md-2">
                            <label for="vacante" class="form-label">Número de vacantes</label>
                            <input
                              class="form-control"
                              type="number"
                              id="vacante"
                              name="vacante"
                              placeholder= "Número de Vacantes"
                            />
                          </div>
                          
                          <div class="mb-3 col-md-2">
                            <label class="form-label" for="sexo">Sexo</label>
                            <select id="sexo" class="select2 form-select">
                            <option value="">Selecciona Sexo</option>
                              <option value="Hombre">Hombre</option>
								<option value="Mujer">Mujer</option>
			
                              
                            </select>
                          </div>
                          
                          <div class="mb-3 col-md-4">
                            <label class="form-label" for="country">País (en caso de no especificar país, déjalo sin seleccionar)</label>
                            <select id="pais" class="select2 form-select">
                            <option value="">Selecciona País</option>
                              <option value="Argentina">Argentina</option>
					<option value="Bolivia">Bolivia</option>
					<option value="Brasil">Brasil</option>
					<option value="Chile">Chile</option>
					<option value="Colombia">Colombia</option>
					<option value="Costa Rica">Costa Rica</option>
					<option value="Cuba">Cuba</option>
					<option value="República Dominicana">República Dominicana</option>
					<option value="Ecuador">Ecuador</option>
					<option value="El Salvador">El Salvador</option>
					<option value="Guayana Francesa">Guayana Francesa</option>
					<option value="Guatemala">Guatemala</option>
					<option value="Haití">Haití</option>
					<option value="Honduras">Honduras</option>
					<option value="México">México</option>
					<option value="Nicaragua">Nicaragua</option>
					<option value="Panamá">Panamá</option>
					<option value="Paraguay">Paraguay</option>
					<option value="Perú">Perú</option>
					<option value="Uruguay">Uruguay</option>
					<option value="Venezuela">Venezuela</option>
                              
                            </select>
                          </div>
                          
                         <div class="mb-3 col-md-12">
                            <label class="form-label" for="country">Descripción de la oferta</label>
                            <textarea id="descripcion" class="form-control" placeholder="Descripción" style="resize:none" maxlength='500'></textarea>
                          </div> 
                          
                          <input type="hidden" id="codigoemp" value="<?php echo $codemp;?>">
                          
                          
                          
                        </div>
                        <div class="mt-2">
                          <input type="button" class="btn btn-primary me-2" value="Crear oferta" onclick='creaoferta()'>
                        </div>
                      </form>
                      
                      
                      
                      
                      
                      
                      
                      
                      
                    </div>
                    <!-- /Account -->
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , Retorna -
                  <a href="https://fundacionsalcines.org" target="_blank" class="footer-link fw-bolder"> Fundación Venancio Salcines</a>
                </div>
                <div>
                  <a href="https://fundacionsalcines.org/politica-privacidad/" class="footer-link me-4" target="_blank">Política de privacidad</a>
                  <a href="https://fundacionsalcines.org/aviso-legal/" target="_blank" class="footer-link me-4">Aviso legal</a>

                  <a
                    href="contacto.php"
                    
                    class="footer-link me-4"
                    >Contacto</a
                  >

                  <a
                    href="help.php"
                    
                    class="footer-link me-4"
                    >Soporte</a
                  >
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
   

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/pages-account-settings-account.js"></script>
<script src="./../js/functions.js"></script>
<script>
	function mostrarformes(formulario)
	{
		$('.estudios').show();
		$('.experiencia').hide();
	}
	function mostrarformex(formulario)
	{
		$('.estudios').hide();
		$('.experiencia').show();
	}


	function buscaprof1()
	{
		$("#laprofesion2").show();
		var dato = $("#prof").val();
		$.post(
			"./buscaprofe1.php",
			{codigo:dato},
			function(recojo)
			{
				alert(recojo);
				//$("#prof2").html(recojo);
			}
		);
		
	}

</script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
<?php
	}
	else
	{
		echo "
			<script>
				alert('Tienes que iniciar sesión');
				window.location.href='./../index.html';
			</script>
		
		";
	}


?>
