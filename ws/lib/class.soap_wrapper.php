<?php	
date_default_timezone_set('America/Mexico_City');	

require_once 'nusoap.php';
			
class Soap_wrapper extends soap_server {		
	var $script_uri;	
	
	public function __construct() 	
	{		
		$page = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
		//$page = substr($page,0,strrpos($page,'/'));		
		$this->script_uri='http://'.$page; 		parent::nusoap_server();  		
		
		$this->configureWSDL('wsLogin','urn:'.$this->script_uri);		
		
		$this->wsdl->addComplexType(						
			"ArrayOfString", 						
			"complexType", 						
			"array",						
			"",                 
			"SOAP-ENC:Array",                 
			array(),                 
			array(
					array(
							"ref"=>"SOAP-ENC:arrayType",
							"wsdl:arrayType"=>"xsd:string[]"
					)
			),                 
			"xsd:string"
		);
		
		$this->wsdl->schemaTargetNamespace=$this->script_uri;
		
	}
	
	
	public function service_start($data)        
	{            
		if(!empty($data)){	           	
			
			$sUsername = $this->hookUsernameBetweenTags($data, 'Username');	           	
			$sPassword = $this->hookPasswordBetweenTags($data, 'Password');	           		           	
			
			$authHeaders = array();	           	
			
			$authHeaders['username'] = $sUsername;	           	
			$authHeaders['password'] = $sPassword;	           		           	
			
			$headers = apache_request_headers();	           		            
			
			$this->validateUser($authHeaders);	            
			//$this->validateToken($headers);	            	            
			$this->service($data);           
		}          
		else            
		$this->service($data);          
	}
	
	
	private function validateUser($auth)        
	{			
		$sMensaje = "Headers sin datos para evaluar";
		$bAuthentication = false;			
		if(!empty($auth['username'])&& !empty($auth['password'])) 
		{
			
			$codeResp = $this->authenticate($auth['username'], $auth['password']);                
			switch ($codeResp) 
			{                	
				case 0   : 
							$bAuthentication = true;                			   
							break;
				case -1  : 
							$sMensaje = "Password no es valido";                			  
				 			break;
				 case -2  : $sMensaje = "Usuario no existe";                			   
				 			break;
			}
		}
		
		if (!$bAuthentication)
			$this->fault(401,'Fallo autenticacion, verifique credenciales - ' . $sMensaje);				        
	}
	
	
	public function validateToken($headers) 
	{        	        	
		//file_put_contents("TOKEN-Test".date("dmYHis").".txt", "TOKEN : ".print_r($headers, true));        	        	
		$bTokenValido = false;        				
		foreach ($headers as $header => $value) {				
			if ($header == "Authentication-IFS")			    	
			if (base64_decode($value) == (sha1('test1234|d215|2015'))) {			    		
				$bTokenValido = true;			    		
				break;			    	}			    				
		}						
		if (!$bTokenValido) {				
			$this->fault(401,'Token failed');			
		}			        
	}
	
	
	private function authenticate($p__username, $p__password) 
	{	
		$_sLog = ""; 	
		$_sLog .= "INI authenticate" . "\r\n";
		$user = new User();
		        	        	
		$username = $p__username;        	        	
		$p__password = base64_decode($p__password);

		$_sLog .= "INI authenticate" . "\r\n";
		$_sLog .= "CLAVE :" . "|d".str_pad(intval(date("z"))+1, 3, "0", STR_PAD_LEFT)."|".date("Y") . "\r\n";
		
		//file_put_contents("AUTENTICACION-Test".date("dmYHis").".txt", "USER PASS : ".sha1($user->password()."|d".str_pad(intval(date("z"))+1, 3, "0", STR_PAD_LEFT)."|".date("Y"))." - PASS : " . $p__password ."\r\n".$_sLog);
		
		if ($user->exist($username)) 
		{        	        		
			$user->setUser($username);
			
			//if (sha1($user->password()."|d".str_pad(date("z")+1, 3, "0", STR_PAD_LEFT)."|".date("Y")) == $p__password) 
			if (sha1($user->password()."|d".(date("z")+1)."|".date("Y")) == $p__password)
			{
				return 0;
			}
			else
				return -1;
		} 
		else 
		{        		        		
			return -2;        		        	
		}        
	}                               
	
	private function hookUsernameBetweenTags($string, $tagname) 
	{
		$_sLog = "";
		$sValue = "";		    
		$pattern = "/<wsse:$tagname>(.*)<\/wsse:$tagname>/";		
		
		preg_match($pattern, $string, $matches);		    
		if (isset($matches[1])) {
			$sValue = $matches[1];	 
			$_sLog .= "$tagname : " . $sValue;
		}				  
		else 		    	
			$sValue = "";		    			    
		
		//file_put_contents("$tagname-Test".date("dmYHis").".txt", "$tagname : ".$_sLog);
		//file_put_contents("HADER-Test".date("dmYHis").".txt", "HEADER : ".$string);
			
		return  $sValue;		
	}
	
	private function hookPasswordBetweenTags($string, $tagname) 
	{
		$_sLog = "";
		$sValue = "";		    
		$pattern = "/<wsse:$tagname Type=\"http\:\/\/docs.oasis-open.org\/wss\/2004\/01\/oasis-200401-wss-username-token-profile-1.0\#PasswordText\">(.*)<\/wsse:$tagname>/";
		preg_match($pattern, $string, $matches);		    
		if (isset($matches[1])) {
			$sValue = $matches[1];	 
			$_sLog .= "$tagname : " . $sValue;
		}				  
		else 		    	
			$sValue = "";
			
		//file_put_contents("$tagname-Test".date("dmYHis").".txt", "$tagname : ".$_sLog);
		//file_put_contents("HADER-Test".date("dmYHis").".txt", "HEADER : ".$string);
			
		return  $sValue;		
	}
		
}

?>