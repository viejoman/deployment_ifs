<?php
require_once("/home/ifsmexic/public_html/incl/phpmailer/class.phpmailer.php");
class cEnvioMail
{
    public $sPara;
    public $sDe;
    private $sMensaje;
    private $sAltMensaje;
    public $sAsunto;
    public $oMailer;
    public $sBccMail;
    public $sBccName;
		
    /**
     *
     * @param type $sTo
     * @param type $sFrom
     * @param type $sSubject
     * @param type $sFromName 
     */
    public function cEnvioMail($sTo,$sFrom,$sSubject, $sFromName = 'IFS Notificaciones')
    {
        $this->oMailer=new PHPMailer();
        //$this->oMailer->SMTPDebug = 2;
        $this->oMailer->ContentType='text/html';
        //$sFrom = 'notifica@ver.ifsneutral.com';
        
        //if(trim($sFrom)=='comercializacion@ver.ifsneutral.com'){
            //$this->addReplayTo('comercializacion@ver.ifsneutral.com');
            //$this->addReplayTo($sFrom);
            //$sFrom = 'notifica@ver.ifsneutral.com';
        //}
        $this->setFrom($sFrom, $sFromName );
        //$this->oMailer->Host= "10.1.2.235";
        $this->oMailer->Host = 'mail.ifsmexico.com';
        $this->oMailer->Mailer ='smtp';
        $this->oMailer->Port= 9025;
        //$this->oMailer->Port = 587;
        $aDestinatarios=preg_split("/,/",$sTo);
        foreach($aDestinatarios as $sDestinatario){
            if (trim($sDestinatario) != ''){
                $this->oMailer->AddAddress($sDestinatario);
            }	
        }
        $this->sPara=$sTo;
        $this->oMailer->isHTML(true);
        $this->oMailer->Subject=$sSubject;
        //$this->authenticateSmtp('notifica', 'Notifica9823');
        $this->oMailer->SetLanguage("es", "../incl/phpmailer/language/phpmailer.lang-es.php");
                
    }
        
        public function setFrom($sFrom, $sFromName = 'IFS Notificaciones')
        {
            $this->oMailer->From= $sFrom;
            $this->oMailer->FromName = $sFromName;
        }
        
        public function isHtml($bool)
        {
            $this->oMailer->isHTML($bool);
        }

        public function agregarContenido($sTexto)
        {
            $this->sMensaje .= $sTexto;
        }

        public function agregarContenidoAlt($sTexto)
        {
            $this->sAltMensaje .= $sTexto;
        }
//-------------------------------------------Agregar con copia oculta-----------------------------------------------//
public function agregarBcc($sBcc, $sName = '')
        {
			/*$this->sBccMail = $sBcc;
			$this->sBccName = $sName;
			$this->oMailer->AddBCC( $this->sBccMail, $this->sBccName );*/
            $nMails = 1;
            $i      = 0;
            $aCC    = split(',', $sBcc);
            $nMails = count($aCC);
            for($i = 0; $i < $nMails; ++$i){
                $this->oMailer->AddBCC( $aCC[$i], $sName );
            }
		}
		
		public function enviar(){
			$this->oMailer->Body=$this->sMensaje;
			$this->oMailer->AltBody=$this->sAltMensaje;
			if (! ($this->oMailer->Send())){
				return 'Error';
			}
			else{
				return true;
			}
		}
		
//------------------------------------------agregarImagen para Usar en el Body------------------------------------------
		public function agregarImgBody($sUrlImg,$sNameIMG){
			//$this->oMailer->WordWrap = 150;
			$idImg = "";
			$this->oMailer->AddEmbeddedImage($sUrlImg, $sNameIMG, $idImg);
			$this->oMailer->IsHTML(true); 
			return '<img src="cid:'.$sNameIMG.'" alt="'.$idImg.'">';
		}
		//-------------------------------------------AGREGAR CC--------------------------------------------------------
		public function agregarCC($sCc, $sName = '')
        {
            $nMails = 1;
            $i      = 0;
            //$aCC    = split(',', $sCc);
            $aCC = preg_split("/\,/",$sCc);
            $nMails = count($aCC);
            for($i = 0; $i < $nMails; ++$i){
                $this->oMailer->AddCC($aCC[$i], $sName );
            }
		}
		//-------------------------------------------Adjuntar Archivo-----------------------------------
		public function addArchivo($sURL){
			$this->WordWrap = 150;
			$this->oMailer->AddAttachment($sURL);
			$this->oMailer->IsHTML(true); 
		}
		//-------------------------------------------Responde a---------------------------------------------------------------------
		public function addReplayTo( $sMail , $sNombre = "" ){
			$this->oMailer->AddReplyTo( $sMail , $sNombre );
		}
		//-------------------------------------------Respuesta de Error a-----------------------------------------------------------
		public function agregarCCMAILER($sCc, $sName = ""){
			$this->oMailer->AddCCMAILER($sCc, $name = "");
		}
		public function setPriority($level){
			$this->oMailer->Priority = $level;
		}
		public function enviarMSGNextel($mensaje){
			$sUrl2 = 'http://mexmessag.nextelinternational.com/cgi/iPageExt.dll?cmd='.urlencode('sendPage')
						.'&twoWayPTNs='.urlencode($this->sPara)
						.'&from='.urlencode($this->sDe)
						.'&subject='.urlencode($this->sAsunto)
						.'&message='.urlencode($mensaje)
						.'&confaddr=&replyemail=&count='.urlencode($longitud);
			$ch = curl_init($sUrl2);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE) ;
			curl_exec($ch);
			if (curl_errno($ch)){
			  $Res = curl_error($ch);
			} else {
				$Res = false;
			}
			curl_close($ch);
			return $Res;
		}
        
        public function authenticateSmtp($sUsername, $sPassword)
        {
            $this->oMailer->Username = $sUsername;
            $this->oMailer->Password = $sPassword;
            $this->oMailer->SMTPAuth = TRUE;
        }
        
        public function getError()
        {
            return $this->oMailer->ErrorInfo;
        }
	}
?>
