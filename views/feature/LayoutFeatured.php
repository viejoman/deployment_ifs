<?php

//include_once('../../lang.php');

session_start();
$lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';
  
?>
<section id="featured">
    <div class="container-main-ifs">
        <div id="featured-menu-left">
                           
            <div id="desc-tipo-cambio" class="description-block border-right" style="background-color: #fff; margin-bottom: 5px;">
                <span id="fecha-tipo-cambio"class="description-percentage text-green">
                    Fecha: &nbsp;</span>                    
                    <p id="tipo-cambio" class="text-center" style="margin-bottom: 0px;">
						&nbsp;
					</p>
                <span class="description-text">TC Autorizado<br/>en p&aacute;gina IFS</span>
            </div>                                                      

            <div class="box" style="margin-bottom: 5px;">
                <div class="box-header" style="padding-bottom: 0px;">
                    <div class="form-group" style="margin-bottom: 0px;">
                        <label>Clima para:</label>
                        <select id="widgetclima" name="widgetclima" class="form-control">
                            <option value="1">Veracruz, Ver.</option>
                            <option value="2">Cd. de M&eacute;xico</option>
                            <option value="3">Manzanillo, Col.</option>
                            <option value="4">Altamira, Tamps.</option>
                            <option value="5">Monterrey, Nvo. L&eacute;on</option>
                            <option value="6">Guadalajara, Jal.</option>
                        </select>
                    </div>
                </div>
                <div class="box-body" id="widgeclima-body" style="height: 320px;">
                    <div id="cont_a6d1658ca86c665c4143188e5b57635e">
                        <span id="h_a6d1658ca86c665c4143188e5b57635e"></span>
                        <script type="text/javascript" async src="http://www.meteored.mx/wid_loader/a6d1658ca86c665c4143188e5b57635e"></script>
                    </div>
                </div>
            </div>                       
            
        </div>  
        <div id="featured-menu-right">
            <div id="main-slider" class="flexslider">       
                   <ul class="slides">
            <li>
            <img src="img/slides/bgBarco1.jpg" alt="" style="height: 500px;"/>
            <div class="flex-caption">
                <h3><?php echo $label[$lang]['text']['services']['tab1']['title']; ?></h3> 					
            </div>
            </li>
            
            <li>
            <img src="img/slides/bgBarco2.jpg" alt="" style="height: 500px;"/>
            <div class="flex-caption">
                <h3><?php echo $label[$lang]['text']['services']['tab2']['title']; ?></h3> 					
            </div>
            </li>
            <li>
            <img src="img/slides/bgBarco3.jpg" alt="" style="height: 500px;" />
            <div class="flex-caption">
                <h3><?php echo $label[$lang]['text']['services']['tab3']['title']; ?></h3> 					
            </div>
            </li>
           
        </ul>        
            </div>
        </div>  	 
    </div>
    
</section>