<?php

 	//ini_set('display_errors','Off'); 
 	if (!class_exists('SoapClient'))
	{
        die ("You haven't installed the PHP-Soap module.");
	}

	//echo '<script language="javascript" charset="utf-8">alert($_POST['key']);</script>';
       //echo '<script language="javascript" charset="utf-8">alert($_GET['key']);</script>';
$post = (isset($_POST['key']) && !empty($_POST['key']));
$get  = (isset($_GET['key'])  && !empty($_GET['key']));
     

	if(!$post) {
		if(!$get) {
			echo '<script language="javascript">window.location.href="http://cgia.seslp.gob.mx/nlogin/Default.aspx?app=1164";</script>';
			exit();
		}else{ 			
			$keys = $_GET['key'];
		}
	}else{
		$keys=$_POST['key'];
	}
	//var_dump($keys);

	comprobar($keys);
	       

    function comprobar($key) {          	
		//$wsdl="http://172.16.17.131/nlws/Service.asmx?WSDL";
		$wsdl="http://cgia.seslp.gob.mx/nlws/Service.asmx?WSDL";

		$iplcl=obtengoIP();
		$client=new SoapClient($wsdl,array("trace"=>1, "exceptions"=>0));
		//echo $key;
		$params = array('key'=>$key,'us'=>'Jonathan','ap'=>'1164','yk'=>'PBUMPLSRGH','cc'=>'0','dv'=>'7','ip'=>$iplcl,'modulo'=>'0');

		$result=$client->ValidoKey($params);
		$resp=$result->ValidoKeyResult;
		$arrayR = json_decode(json_encode($result), True);
		//var_dump($arrayR);
		global $usuario;
		global $app;
		$usuario = $arrayR["us"];
		$app     = $arrayR["ap"];
		//$GLOBALS[$usuario]=$arrayR["us"];
		//$GLOBALS[$app]=$arrayR["ap"];
		//return "true";
		//echo '<script language="javascript" charset="utf-8">alert($usuario);</script>';
		if($resp != 1) 
		{ 
			//echo '<script language="javascript" charset="utf-8">alert($resp);</script>';
			echo '<script language="javascript" charset="utf-8">alert("Caducó la sesión o no es valida al ingresar al módulo"); window.location.href="http://cgia.seslp.gob.mx/nlogin/Default.aspx?app=1164";</script>';
		}

    }    


//FUNCION PARA OBTENER LA IP DEL EQUIPO QUE SE CONECTA
	function getRealIP()
	{
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
	        $wip=$_SERVER["HTTP_X_FORWARDED_FOR"];
	    }else{
        	$wip="";
	    }
		return $wip;
	}
 
 
 
    function obtengoIP()
    {
        $wip = "<ip>" . getRealIP() . "</ip>";
        $ipdob = "";
        $resultadoips = ""; 
		$kaxs = "";

        if (is_null($wip) or $wip == "" or $wip == "<ip></ip>")
        {
            $wip = "<ip>". $_SERVER["REMOTE_ADDR"] ."</ip>";
            $resultadoips = $wip;
        }
        else
        {
            $ipdob = "<ipd>". $_SERVER["REMOTE_ADDR"] ."</ipd>";
            if (!(is_null($ipdob) or $ipdob == "" or $ipdob == "<ipd></ipd>")) { $resultadoips = $wip . $ipdob; }
        }

		return $resultadoips;
        //return '<ip>172.16.20.25</ip>';
    }
?>