<?php

include_once('lang.php');

session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';

$_GET["option"] = 2;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>IFS M&eacute;xico | Nosotros</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://ifsmexico.com" />
<!-- css -->
<?php require_once("views/shared/LayoutCSS.php"); ?>
 
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body class="layout-boxed">
<div id="wrapper" class="layout-boxed">

	<!-- start header -->
    <?php require_once("views/shared/LayoutHeader.php"); ?>
    <!-- end header -->
	<section id="inner-headline-nosotros">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Nosotros</h2>				
			</div>
		</div>
	</div>
	</section>
	<section id="content">
	        <div class="container">
					
					<div class="about">
							<div class="row" style="margin-bottom: 0px;">
								<div class="col-md-12">
									<h4><span>Usando la mejor red de agentes en el mundo para proporcionar 
									un servicio de calidad y excelencia, para 
									otorgar a nuestros clientes la confianza en todo momento.</span></h4>
								</div>			
							</div>
                            <div class="row">
								<div class="col-md-8">
									<!-- Heading and para -->
									<div class="block-heading-two">
										<h3><span>Neutral Maritime Services de M&eacute;xico S.A. de C.V.</span></h3>
									</div>
									<p>Somos una empresa nacida en Valencia Espa&ntilde;a en el a&ntilde;o de 1985, con el compromiso de ofrecer servicios de calidad a los profesionales del sector, bajo el principio de neutralidad.</p>
	                                    <p>Llegamos a M&eacute;xico en 1995, instalando la primera oficina en el Puerto de Veracruz, siendo esta, hasta la fecha, la oficina central.</p>
	                                    <p>Fuimos innovadores en el pa&iacute;s con el concepto bien fundamentado de consolidado neutral , por ello a trav&eacute;s de los a&ntilde;os nos hemos consolidado como una empresa competitiva; desarrollando e implantando siempre sistemas de calidad y vanguardia que nos diferencian y distinguen, dirigiendo nuestros servicios de manera exclusiva a los Agentes de Carga.</p>
	                                    <p>Gracias a nuestros resultados se han abierto m&aacute;s oficinas a lo largo del pais, actualmente nos encontramos en las 3 ciudades más importantes del pa&iacute;s Ciudad de M&eacute;xico, Guadalajara, Monterrey as&iacute; como en los puertos de Altamira y Manzanillo.</p>
	                                    
	                                    <div class="embed-responsive embed-responsive-4by3">
                                            <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/IeCPOEebqA8" frameborder="0" allowfullscreen></iframe>
                                        </div>
	                                    
								</div>
							 <div class="col-md-4">
								<div class="block-heading-two">
									<h3><span>Nuestras Oficinas</span></h3>
								</div>		
								<!-- Accordion starts -->
								<div class="panel-group" id="accordion-alt3">
								 <!-- Panel. Use "panel-XXX" class for different colors. Replace "XXX" with color. -->
								  <div class="panel panel-veracruz">	
									<!-- Panel heading -->
									 <div class="panel-heading">
										<h4 class="panel-title">
										  <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseOne-alt3">
											<i class="fa fa-angle-right"></i> Veracruz
										  </a>
										</h4>
									 </div>
									 <div id="collapseOne-alt3" class="panel-collapse collapse">
										<!-- Panel body -->
										<div class="panel-body panel-ifs-veracruz">										  
			                            	<strong>Direcci&oacute;n</strong><br>
			                                Nicol&aacute;s Bravo No. 237, Col. Centro <br>
				                            C.P.91700<br> 
				                            Veracruz, Ver.<br>
				                            Tel: 52 229 9318038<br>
											Fax: 52 229 9318038 Ext  102
										</div>
									 </div>
								  </div>
								  <div class="panel panel-mexico">
									 <div class="panel-heading">
										<h4 class="panel-title">
										  <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseTwo-alt3">
											<i class="fa fa-angle-right"></i> M&eacute;xico
										  </a>
										</h4>
									 </div>
									 <div id="collapseTwo-alt3" class="panel-collapse collapse">
										<div class="panel-body panel-ifs-df">
										    <strong>Direcci&oacute;n</strong><br>      
				                            Hegel 209-901<br> 
				                            Col. Polanco<br>
                                            C.P. 11560<br> 
                                            Mexico, DF.<br>
                                            Tel: 52 55 52508515<br>
											Fax: 52 55 52508515
										</div>
									 </div>
								  </div>
								  <div class="panel panel-manzanillo">
									 <div class="panel-heading">
										<h4 class="panel-title">
										  <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseThree-alt3">
											<i class="fa fa-angle-right"></i> Manzanillo
										  </a>
										</h4>
									 </div>
									 <div id="collapseThree-alt3" class="panel-collapse collapse">
										<div class="panel-body panel-ifs-manzanillo">
                                          <strong>Direcci&oacute;n</strong><br>
										  Boulevard Miguel de la Madrid No. 302-C<br>
										  Col. Tapeixtle<br> 
										  C.P. 28239 <br> 
										  Manzanillo, Col<br>
										  Tel: 52 314 3336415, 16 y 332 2820441, 442, 443<br>
										  Fax: 52 314 3336417
										</div>
									 </div>
								  </div>
								  <div class="panel panel-altamira">
									 <div class="panel-heading">
										<h4 class="panel-title">
										  <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseFour-alt3">
											<i class="fa fa-angle-right"></i> Altamira
										  </a>
										</h4>
									 </div>
									 <div id="collapseFour-alt3" class="panel-collapse collapse">
										<div class="panel-body panel-ifs-altamira">
												<strong>Direcci&oacute;n</strong><br>
												Plaza Comercial Hait&iacute;. Local 7 y 8<br />
												Calle Hait&iacute; No. 916 <br>
												Col. Las Am&eacute;ricas <br>
												CP. 89329<br>
												Tampico, Tamps.<br>
												Tel: 52 (833)2609322,   52 (833)2609323<br>   
												Fax: 52 (833)2609324
										</div>
									 </div>
								  </div>

                                    <div class="panel panel-monterrey">
									 <div class="panel-heading">
										<h4 class="panel-title">
										  <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseFive-alt3">
											<i class="fa fa-angle-right"></i> Monterrey
										  </a>
										</h4>
									 </div>
									 <div id="collapseFive-alt3" class="panel-collapse collapse">
										<div class="panel-body panel-ifs-monterrey">
                                            <strong>Direcci&oacute;n</strong><br>
										  	Torre AVALANZ, Batall&oacute;n de San Patricio #109<br>
										  	Piso 17, Oficina 1707<br>
										  	Col. Valle Ote. San Pedro Garza Garc&iacute;a<br>
										  	C.P. 66260<br>
										  	Monterrey, N. L.<br> 
										  	Tel: 52 81 50009063<br>
											Fax: 52 81 81240013
										</div>
									 </div>
								  </div>
                                    <div class="panel panel-guadalajara">
									 <div class="panel-heading">
										<h4 class="panel-title">
										  <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseSix-alt3">
											<i class="fa fa-angle-right"></i> Guadalajara
										  </a>
										</h4>
									 </div>
									 <div id="collapseSix-alt3" class="panel-collapse collapse">
										<div class="panel-body panel-ifs-guadalajara">
                                            <strong>Direcci&oacute;n</strong><br>
										  	Av. Am&eacute;ricas 1545 Piso 22<br> 
										  	Oficina 2231 <br>
										  	Col. Providencia<br>
										  	C.P. 44630<br>
										  	Guadalajara, Jalisco<br>
										  	Tel:  +52 (33) 8000-0038<br>
											Fax:  +52 (33) 8000-0038
										</div>
									 </div>
								  </div>

								  <div class="panel panel-queretaro">
									 <div class="panel-heading">
										<h4 class="panel-title">
										  <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseSix-alt3">
											<i class="fa fa-angle-right"></i> Quer&eacute;taro
										  </a>
										</h4>
									 </div>
									 <div id="collapseSix-alt3" class="panel-collapse collapse">
										<div class="panel-body panel-ifs-queretaro">
                                            <strong>Direcci&oacute;n</strong><br>
										  	Av. Am&eacute;ricas 1545 Piso 22<br> 
										  	Oficina 2231 <br>
										  	Col. Providencia<br>
										  	C.P. 44630<br>
										  	Guadalajara, Jalisco<br>
										  	Tel:  +52 (33) 8000-0038<br>
											Fax:  +52 (33) 8000-0038
										</div>
									 </div>
								  </div>

								  <div class="panel panel-aeropuertocdmx">
									 <div class="panel-heading">
										<h4 class="panel-title">
										  <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseSix-alt3">
											<i class="fa fa-angle-right"></i> Aeropuerto Internacional de la Cd. de M&eacute;xico
										  </a>
										</h4>
									 </div>
									 <div id="collapseSix-alt3" class="panel-collapse collapse">
										<div class="panel-body panel-ifs-aeropuertocdmx">
                                            <strong>Direcci&oacute;n</strong><br>
										  	Av. Am&eacute;ricas 1545 Piso 22<br> 
										  	Oficina 2231 <br>
										  	Col. Providencia<br>
										  	C.P. 44630<br>
										  	Guadalajara, Jalisco<br>
										  	Tel:  +52 (33) 8000-0038<br>
											Fax:  +52 (33) 8000-0038
										</div>
									 </div>
								  </div>

								</div>
								<!-- Accordion ends -->
								
							</div>																			
						    </div>
                            <!--row-->
																															
				    </div>

                <hr>

            </div>
	</section>
	
    <section id="content">
		<div class="container content">		        
        <div class="row margin-bottom-40">
            <div class="col-md-4 md-margin-bottom-40">          
                <div class="panel panel-default" style="width: 355px; height: 250px;">
                    <div class="panel-heading panel-mision">
                        <h2>Misi&oacute;n</h2>
                      </div>
                    <div class="panel-body">
                        
                        <p>Ser l&iacute;deres en el mercado internacional  como Consolidadores Maritimos  con 
                        el compromiso de ofrecer servicios de calidad a los 
                        profesionales del sector bajo el principio de Neutralidad.</p>        
                    </div>
                </div>
            </div>
            <div class="col-md-4">              
                <div class="panel panel-default" style="width: 355px; height: 250px;">
                    <div class="panel-heading panel-vision">
                        <h2>Visi&oacute;n</h2>
                      </div>
                    <div class="panel-body">
                            
                            <p>Ofrecer a nuestros clientes el cumplimiento &oacute;ptimo de servicio a trav&eacute;s de nuestra 
                            infraestructura propia en Espa&ntilde;a, Portugal, Miami, Marruecos y T&uacute;nez ya que contamos 
                            con presencia multinacional a trav&eacute;s de una amplia red de Agentes en el mundo, con el 
                            tratamiento eficaz de la mercanc&iacute;a tanto en origen como en destino.</p>        
                        </div>
                </div>
            </div>
            <div class="col-md-4 md-margin-bottom-40">              
                <div class="panel panel-default" style="width: 355px; height: 250px;">
                    <div class="panel-heading panel-valores">
                        <h2>Valores</h2>
                      </div>
                    <div class="panel-body">
                        
                        <ul>
	                        <li>Neutralidad</li>
	
							<li>Integridad</li>
	
							<li>Transparencia y Apertura</li>
							
							<li>Respeto a nuestros Clientes y compa&ntilde;eros de trabajo</li>
                        </ul>        
                          </div>
                </div>

            </div>
        </div>
                    
    </div>
    </section>

    <?php include_once("views/shared/LayoutFooter.php"); ?>	

</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript ================================================== -->

<?php include_once("views/shared/LayoutScripts.php"); ?>	

</body>
</html>