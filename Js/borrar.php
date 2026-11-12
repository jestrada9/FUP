<?php
    require_once('../Conexion/ServicioWeb.php');
    $num_docto = $_POST['num_doc'];
    $obs = $_POST['obs'];
    $usuario = $_POST['usuario'];

    if($num_docto!=""){
        $id_consulta = 156;
        $JSON="[{\"num_docto\":\"$num_docto\",\"obs\":\"$obs\",\"usuario\":\"$usuario\"}]";
        $arrayR1 = json_decode(json_encode($JSON), True);
        $params = array('Resultado'=>$id_consulta, 'Argumento'=>$arrayR1); //para conseguir la consulta
        $resultadoss=$cliente->getConsulta($params);
        //$arrayR3= json_decode(json_encode($resultadoss), True);
        //var_dump($arrayR3);
        //var_dump($arrayR3["return"]["fallo_"]);
        /*
        $pc = $arrayR3['return']["fallo_"];

        if($pc=="Update"){
            
        }
        */
        echo "Documento ".$num_docto." Borrado.";
    }
?>     