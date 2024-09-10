<?php

    if(!empty($_POST)){

        //Añadimos los campos del form en variables para luego hacer el insert a la base de datos
        $txt_id = utf8_decode($_POST["txt_id"]);
        $txt_codigo = utf8_decode($_POST["txt_codigo"]);
        $txt_nombres = utf8_decode($_POST["txt_nombres"]);
        $txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
        $txt_direccion = utf8_decode($_POST["txt_direccion"]);
        $txt_telefono = utf8_decode($_POST["txt_telefono"]);
        $txt_fn = utf8_decode($_POST["txt_fn"]);
        $drop_puesto = utf8_decode($_POST["drop_puesto"]);
    
        //Incluimos la conexión a la base de datos
        include("datos_conexion.php");
        $db_conexion = mysqli_connect($db_host,$db_user,$db_pass,$db_dbName);
        $sql = "";
        //echo $txt_fn;

        /* change character set to utf8mb4 */
        if (!$db_conexion->set_charset("utf8mb4")) {
            printf("Error loading character set utf8: %s\n", $db_conexion->error);
        } else {
            printf("Current character set: %s\n", $db_conexion->character_set_name());
        }

        if(isset($_POST['btn_crear'])){
            //Aquí creamos el query para hacer el INSERT en la base de datos
            $sql = "INSERT INTO empleados (codigo, nombres, apellidos, direccion, telefono, fecha_nacimiento, id_puesto) VALUES ('". $txt_codigo ."','". $txt_nombres ."','". $txt_apellidos ."','". $txt_direccion ."','". $txt_telefono ."','". $txt_fn ."',". $drop_puesto .");";
        }else if(isset($_POST['btn_actualizar'])){
            //Aquí creamos el query para hacer el UPDATE en la base de datos
            $sql = "UPDATE empleados set codigo = '". $txt_codigo ."',nombres='". $txt_nombres ."',apellidos='". $txt_apellidos ."',direccion='". $txt_direccion ."',telefono='". $txt_telefono ."',fecha_nacimiento='". $txt_fn ."',id_puesto=". $drop_puesto ." where id_empleado = ". $txt_id .";";
        }else if (isset($_POST['btn_eliminar'])){
            //Aquí creamos el query para hacer el DELETE en la base de datos
            $sql = "DELETE FROM empleados WHERE id_empleado = ". $txt_id . ";";
        }

        if($db_conexion -> query($sql) === true){
            $db_conexion -> close();
            header('Location: /empresa_php/empleado.php');
        }else{
            $db_conexion -> close();
        }  
    
    }

?>