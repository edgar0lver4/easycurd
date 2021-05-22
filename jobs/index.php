<?php
    header('Access-Control-Allow-Origin: http://localhost:3000');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Content-Type: application/json');
    include_once('../specia-functions.php');
    $select = "SELECT 
                vp.id,
                e.empresa,
                vp.titulo,
                vp.descripcion,
                vp.tipo_puesto,
                vp.salario
            FROM vacantes_publicadas AS vp
            INNER JOIN empresas AS e ON e.idempr = vp.idempr";
    sp_select($data,$select,'trabajoparame');
    $ret = array();
    if($data !== false){
        $new_ret = [];
        $i = 0;
        while(!$data->EOF){
            $new_ret[$i]['id'] = $data->field[0];
            $new_ret[$i]['empresa'] = htmlentities($data->field[1]);
            $new_ret[$i]['titulo'] = htmlentities($data->field[2]);
            $new_ret[$i]['descrip'] = htmlspecialchars(nl2br(utf8_decode($data->field[3])));
            $new_ret[$i]['tipoPuesto']= $data->field[4];
            $new_ret[$i]['salario'] = $data->field[5];
            $i++;
            $data->Next();
        }
        $ret['data'] = $new_ret;
        $ret['status'] = 200;
        echo json_encode($ret);
    }else{
        echo "{'status':300,'message':'No hay registros para mostrar'}";
    }
?>