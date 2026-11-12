<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $ruta = array();
//    $ruta[] = "c:\\inetpub\\wwwroot\\PDF_Pruebas_ORIGINAL";
//    $ruta[] = "c:\\inetpub\\wwwroot\\PDF_Pruebas_ORIGINAL\\CCT";
//    $ruta[] = "c:\\inetpub\\wwwroot\\PDF_Pruebas_COPIA";
    $ruta[] = "C:\\inetpub\\wwwroot\\Formato_Unico_Personal\\FUPs\\Masivo_Original";
    $ruta[] = "C:\\inetpub\\wwwroot\\Formato_Unico_Personal\\FUPs\\Masivo_Original\\CCT";




    $curp = "";

    if(  !(isset($_REQUEST['curp']) && isset($_REQUEST['id'])) && isset($_REQUEST['h'])    )  {
        return '[]';
    }
    $curp3 = "";
    if(isset($_REQUEST['curp'])) 
        $curp3 = $_REQUEST['curp'];

    $id2 = "";
    if(isset($_REQUEST['id']))
        $id2 = $_REQUEST['id'];

    $h2 = '';
    if(isset($_REQUEST['h']))
        $h2 = $_REQUEST['h'];

    if( (strlen($curp3) == 6 || strlen($curp3) == 13 || strlen($curp3) == 18) ) {

        if($id2 > 0)
        if(!(sha1('c63823b9bf2476065c7edb4e50f5203d112d8ad8' . $curp3)  == $h2))
            return '[]';
        $curp = addslashes(strtoupper($curp3));
        $curp = substr($curp,0,6);


        if( $curp == "") {
            echo '[]';
            return;
        }

        $lista2 = array();
        $i=0;

        for($k=0; $k < sizeof($ruta); $k++) {
            $ruta_len = strlen($ruta[$k]);
            $lista = glob("{$ruta[$k]}" . "//*{$curp}*");

            foreach($lista as $lista_) {
                $i++;
                $curp2 = "";
                $elemento = substr( $lista_, $ruta_len + 1 );
                
                $encontrar = explode("_",$elemento);
                
                foreach($encontrar as $encontrar_) {
                    if( substr($encontrar_,0,6) == $curp ) {
                        $curp2 = $encontrar_;
                    }
                }
                
                // agrupar por curp

                $lista2[] = array( "curp"=>$curp2,  "nombre" => $elemento , "id" => $i, "detalle" => array(filesize($lista_), date("Ymd",filemtime($lista_))) );
                if($_REQUEST['id'] == $i) {
                    $url = file_get_contents("$lista_");
                }
            }

        }



        if($_REQUEST['id'] == 0) {
            echo json_encode($lista2);
        }

        if($_REQUEST['id'] > 0) {
            if(strlen($url) > 1) {
                header('Content-Type: application/pdf');
                echo $url;
            }
            else 
                echo "no encontrado ";
        }

    }

?>