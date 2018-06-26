<?php
//choose language (lang/turk.php) for Turkish
include("lang/eng.php");

/* AGSCROLLER IS FREE FOR NON-COMMERCIAL USAGE UNDER THE
TERMS PRESENTED BELOW.

THIS SCRIPT MAY NOT BE MODIFIED EXCEPT BY WHAT IS EXPLAINED IN THE README
FILE. NO OTHER MODIFICATIONS ARE ALLOWED.

NO PORTIONS OF THIS SOFTWARE MAY BE COPIED, MODIFIED, USED, OR DISTRIBUTED
WITHOUT EXPRESS WRITTEN PERMISSION FROM AGFREELANCE.

AGFREELANCE DISTRIBUTES THIS SOFTWARE "AS-IS" AND MAKE NO WARRANTIES OF ANY KIND WHATSOEVER.

AGSCROLLER V.1.0 (C) 2003 AGFREELANCE - ALL RIGHTS RESERVED
AGFREELANCE
http://www.aycangonenc.com
*/
?>

<html>
<head>
<title>AG Scroller</title>
<meta http-equiv='Content-Type' content='text/html; charset=windows-1254'>
<style type='text/css'>
<!--
body {  font-family: verdana; font-size: 10px; color: #333333}
table {  font-family: verdana; font-size: 10px; color: #333333}
-->
</style>
</head>

<?php
include("conf.php");


//START HTML CODE
echo"<body bgcolor='#FFFFFF'>
<div align='center'>
  <p><a href='http://www.aycangonenc.com'><img src='img/ag.gif' width='135' height='35' border='0'></a> 
  </p>
  <p align='left'>$Preview:</p>";
  include("scroller.php");
 echo "<form method='post' action='process.php'>
    <table width='600' border='0' cellspacing='0' cellpadding='3'>
      <tr> 
        <td width='125' align='right'><b>$CONFIGURESCROLLER</b></td>
        <td width='150'>&nbsp;</td>
        <td width='225'><b>$EXPLANATION</b></td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Tablewidth:</td>
        <td width='150'> 
          <input type='text' name='tablewidth' value='$tablewidth' size='30'>
        </td>
        <td width='225'>$exptablewidth</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Backgroundcolor:</td>
        <td width='150'> 
          <input type='text' name='bgcolor' value='$bgcolor' size='30'>
        </td>
        <td width='225'>$expbackgroundcolor</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Scrollamount:</td>
        <td width='150'> 
          <input type='text' name='scrollamount' value='$scrollamount' size='30'>
        </td>
        <td width='225'>$expscrollamount</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Scrolldelay:</td>
        <td width='150'> 
          <input type='text' name='scrolldelay' value='$scrolldelay' size='30'>
        </td>
        <td width='225'>$expscrolldelay</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Behaviour:</td>
        <td width='150'> 
          <input type='text' name='behavior' value='$behavior' size='30'>
        </td>
        <td width='225'>$expbehaviour</td>
      </tr>
      <tr> 
        <td width='125' align='right'><b>$CONFIGURETEXT</b></td>
        <td width='150'>&nbsp;</td>
        <td width='225'>&nbsp;</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Fontsize:</td>
        <td width='150'> 
          <input type='text' name='fontsize' value='$fontsize' size='30'>
        </td>
        <td width='225'>$expfontsize</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Fontstyle:</td>
        <td width='150'>
          <input type='text' name='fontstyle' value='$fontstyle' size='30'>
        </td>
        <td width='225'>$expfontstyle</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Fontcolor:</td>
        <td width='150'> 
          <input type='text' name='fontcolor' value='$fontcolor' size='30'>
        </td>
        <td width='225'>$expfontcolor</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Spacebetweensentences:</td>
        <td width='150'> 
          <input type='text' name='space' value='$space' size='30'>
        </td>
        <td width='225'>$expspace</td>
      </tr>
      <tr> 
        <td width='125' align='right'><b>$CONFIGURESENTENCE1</b></td>
        <td width='150'>&nbsp;</td>
        <td width='225'>&nbsp;</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Sentence:</td>
        <td width='150'> 
          <textarea name='yazi1' rows='10' cols='30'>$yazi1</textarea>
        </td>
        <td width='225'>$expsentence</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Linkto:</td>
        <td width='150'> 
          <input type='text' name='link1' value='$link1' size='30'>
        </td>
        <td width='225'>$explink</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Linktarget:</td>
        <td width='150'> 
          <input type='text' name='target1' value='$target1' size='30'>
        </td>
        <td width='225'>$exptarget</td>
      </tr>
      <tr> 
        <td width='125' align='right'><b>$CONFIGURESENTENCE2</b></td>
        <td width='150'>&nbsp;</td>
        <td width='225'>&nbsp;</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Sentence:</td>
        <td width='150'> 
          <textarea name='yazi2' rows='10' cols='30'>$yazi2</textarea>
        </td>
        <td width='225'>$expsentence</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Linkto:</td>
        <td width='150'> 
          <input type='text' name='link2' value='$link2' size='30'>
        </td>
        <td width='225'>$explink</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Linktarget:</td>
        <td width='150'> 
          <input type='text' name='target2' value='$target2' size='30'>
        </td>
        <td width='225'>$exptarget</td>
      </tr>
      <tr> 
        <td width='125' align='right'><b>$CONFIGURESENTENCE3</b></td>
        <td width='150'>&nbsp;</td>
        <td width='225'>&nbsp;</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Sentence:</td>
        <td width='150'> 
          <textarea name='yazi3' rows='10' cols='30'>$yazi3</textarea>
        </td>
        <td width='225'>$expsentence</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Linkto:</td>
        <td width='150'> 
          <input type='text' name='link3' value='$link3' size='30'>
        </td>
        <td width='225'>$explink</td>
      </tr>
      <tr> 
        <td width='125' align='right'>$Linktarget:</td>
        <td width='150'> 
          <input type='text' name='target3' value='$target3' size='30'>
        </td>
        <td width='225'>$exptarget</td>
      </tr>
      <tr> 
        <td width='125' align='right'><b><font color='#FF3333'>$Password:</font></b></td>
        <td width='150'>
          <input type='text' name='admin' size='30'>
        </td>
        <td width='225'>
          <input type='submit' name='Submit' value='$Submit'>
          <input type='reset' name='Submit2' value='$Reset'>
        </td>
      </tr>
    </table>
  </form>
  <p align='left'>&nbsp;</p>
  <p align='center'><a href='http://www.aycangonenc.com'><img src='img/ag.gif' width='135' height='35' border='0'></a></p>
</div>
</body>
</html>";
?>
