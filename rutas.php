<?php

include_once('lang.php');

session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
  
$_GET["option"] = 5;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>IFS México | Rutas</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="http://ifsmexico.com" />
<!-- css -->

<?php require_once("views/shared/LayoutCSS.php"); ?>
<link href="js/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="js/plugins/jvectormap/jquery-jvectormap-2.0.2.css">
     
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
	<section id="inner-headline-servicios">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="pageTitle">Rutas</h2>
			</div>
		</div>
	</div>
	</section>

    

	<section id="content">
		<div class="container content">		
                        
            
                <div class="row"> 
				    <div class="col-md-12">
					    <div class="about-logo">						    
						    <p>Ofrecemos el mayor número de servicios a destinos directos y lugares a donde muy pocos llegan. Contamos con 15*  rutas de exportación con conexiones</p>
					    </div>
								
				    </div>
			    </div>
						
			    <hr>
			    
			    <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
              <!-- MAP & BOX PANE -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"><a href="#importados" id="btnimp">Importaci&oacute;n</a> / <a href="#exportados" id="btnexp" class="active">Exportaci&oacute;n</a></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="row">
                    <div class="col-md-9 col-sm-8">
                      <div class="pad">
                        <!-- Map will be created here -->
                        <div id="world-map-markers" style="height: 325px;"></div>
                      </div>
                    </div><!-- /.col -->
                    <div class="col-md-3 col-sm-4">
                      <div class="pad box-pane-right bg-green" style="min-height: 345px; padding-bottom: 0px;">
                      
                      <div class="box"> 
                        	
                        	<div class="box-header">
			                  <h3 id="tituloItinerario" class="box-title">&nbsp;</h3>
			                </div>
                                                   
                            <div id="descItinerario" class="box-body">
                      
                        
                          			&nbsp;
                                                
                        	</div>
                        </div>
                        
                      </div>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col -->
			    
			    </div>
			    
                <!-- 
                <div class="row">
           
                    <div class="col-md-8">
              
                        <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"><a href="" id="btnimp">Importaci&oacute;n</a> / <a href="" id="btnexp">Exportaci&oacute;n</a></h3>
                            <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <div class="row">
                    
                                <div class="pad">
                        
                                <div id="world-map-markers" style="height: 325px;"></div>
                                </div>
                    
                    
                            </div>
                        </div>
                        </div>

                    </div>
            
                    </div>
                      -->                                         

        </div>
    </section>
      
	<?php include_once("views/shared/LayoutFooter.php"); ?>	

</div>

<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<?php include_once("views/shared/LayoutScripts.php"); ?>
    <!-- DATA TABES SCRIPT -->
    <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="js/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>    
    <!-- jvectormap -->
    <script src="js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js" type="text/javascript"></script>
    <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>

    <script src="js/pages/dashboard2.js" type="text/javascript"></script>

</body>
</html>
