<?php 

include_once('lang.php');
include_once('getBrowser.php');

session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
$lang = isset($_GET['lang']) ? $_GET['lang'] : $lang;

$bMainPage = isset($_GET['void']) ? $_GET['void'] : true;

$_SESSION['lang'] = $lang;

$_GET["option"] = 1;

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>IFS M&eacute;xico</title>
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
	<?php include_once("views/feature/LayoutFeatured.php"); ?>	
    
    <?php include_once("views/news/NoticiasView.php"); ?>		
	
    <?php include_once("views/shared/LayoutFooter.php"); ?>	
	
	
	
</div>
<div id="anuncioModalIFS" class="modal fade in">
    <div class="modal-dialog" style="max-width: 749px">
        <div class="modal-content">
            <div class="modal-body">
                <img src="img/ifs_mexico_nueva_dir.png" class="img-responsive" />
            </div>
        </div>
    </div>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<?php include_once("views/shared/LayoutScripts.php"); ?>

<script type="text/javascript">
	/*
	$(document).ready(function() {
        $('#anuncioModalIFS').modal('show');
    });
    */
</script>

</body>
</html>