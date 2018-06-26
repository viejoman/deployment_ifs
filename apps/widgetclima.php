<?php

$id = isset($_POST['widgetclima']) ? $_POST['widgetclima'] : 0;

$widgetclima = "";

if ($id == 1) {

$widgetclima = <<<EOPAGE
		<div id="cont_a6d1658ca86c665c4143188e5b57635e">
            <span id="h_a6d1658ca86c665c4143188e5b57635e"></span>
            <script type="text/javascript" async src="http://www.meteored.mx/wid_loader/a6d1658ca86c665c4143188e5b57635e"></script>
        </div>
EOPAGE;

}  elseif ($id == 2) {

$widgetclima = <<<EOPAGE
		<div id="cont_4c6516b3191a99a0f614306208a7a07e">
            <span id="h_4c6516b3191a99a0f614306208a7a07e"></span>
            <script type="text/javascript" async src="http://www.meteored.mx/wid_loader/4c6516b3191a99a0f614306208a7a07e"></script>
        </div>
EOPAGE;
    
}  elseif ($id == 3) {

$widgetclima = <<<EOPAGE
		<div id="cont_91957522ccbf4fb1ef70d6986c59c30d">
            <span id="h_91957522ccbf4fb1ef70d6986c59c30d"></span>
            <script type="text/javascript" async src="http://www.meteored.mx/wid_loader/91957522ccbf4fb1ef70d6986c59c30d"></script>
        </div>
EOPAGE;

}  elseif ($id == 4) {

$widgetclima = <<<EOPAGE
		<div id="cont_e4d2beb28f491a2ccfbcf56a1505f6c3">
            <span id="h_e4d2beb28f491a2ccfbcf56a1505f6c3"></span>
            <script type="text/javascript" async src="http://www.meteored.mx/wid_loader/e4d2beb28f491a2ccfbcf56a1505f6c3"></script>
        </div>
EOPAGE;

}  elseif ($id == 5) {

$widgetclima = <<<EOPAGE
		<div id="cont_94f2e3737d10bc11e9c8f258dc6fcadd">
          <span id="h_94f2e3737d10bc11e9c8f258dc6fcadd"></span>
          <script type="text/javascript" async src="http://www.meteored.mx/wid_loader/94f2e3737d10bc11e9c8f258dc6fcadd"></script>
        </div>
EOPAGE;

}  elseif ($id == 6) {

$widgetclima = <<<EOPAGE
		<div id="cont_69afada18f3c3fa64cc487c71ebe6280">
            <span id="h_69afada18f3c3fa64cc487c71ebe6280"></span>
            <script type="text/javascript" async src="http://www.meteored.mx/wid_loader/69afada18f3c3fa64cc487c71ebe6280"></script>
        </div>
EOPAGE;

}

echo $widgetclima;

?>