<?php

    $ruta = "C:\\inetpub\\wwwroot\\Formato_Unico_Personal\\FUPs\\Masivo_Copia";

    // REGR880910PI1
    // AAAF8301279M5

    // HEMA60

    $curp = "";

    if(  !(isset($_REQUEST['curp']) && isset($_REQUEST['id'])) && isset($_REQUEST['h'])    )  {
        return '[]';
    }
    else{
        

    if( (strlen($_REQUEST['curp']) == 6 || strlen($_REQUEST['curp']) == 13 || strlen($_REQUEST['curp']) == 18) ) {

        
        if($_REQUEST['id'] > 0)
        if(!(sha1('c63823b9bf2476065c7edb4e50f5203d112d8ad8' . $_REQUEST['curp'])  == $_REQUEST['h']))
            return '[]';
        
        $curp = addslashes(strtoupper($_REQUEST['curp']));
        $curp = substr($curp,0,6);


        if( $curp == "") {
            echo '[]';
            return;
        }

        $ruta_len = strlen($ruta);

        $lista = glob("$ruta" . "/*{$curp}*");
        
        $lista_qty = sizeof($lista);

        $lista2 = array();

        $i=0;
        $archivo_pdf = "";
        foreach($lista as $lista_) {
            $i++;
            $curp2 = "";
            $elemento = substr( $lista_, $ruta_len + 1 );
            $elemento_len = sizeof($elemento);
            
            $encontrar = explode("_",$elemento);
            
            foreach($encontrar as $encontrar_) {
            
                if( substr($encontrar_,0,6) == $curp ) {
                    $curp2 = $encontrar_;
                }
            
            }

            
            // agrupar por curp

            $lista2[] = array( "curp"=>$curp2,  "nombre" => $elemento , "detalle" => array(filesize($lista_), date("Ymd",filemtime($lista_))) );
            if($_REQUEST['id'] == $i) {
                $url = file_get_contents("$lista_");
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

}
?>