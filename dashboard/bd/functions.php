<?php
    include_once '../bd/conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $user=$_SESSION['id'];

    if(isset($_GET['like'])){ //Si damos like
        $id = $_GET['like'];
        
        $consulta = "SELECT id FROM lke WHERE (id_user2 = '$user' and id_user1 = $id) or (id_user2 = '$id' and id_user1 = $user)";//Comprobamos que no exista ya un registro en el que alguno de los usuarios de like o dislike al otro
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetch(PDO::FETCH_ASSOC); 
        if ($data['id'] != ""){ //Si existe este registro acualizamos el like correspondiente.
            $_SESSION['data'] = $data['id'];
            $r= $data['id'];
            $_SESSION['cons'] = $consulta;
            $consulta = "UPDATE `lke` SET `like2`= 1 WHERE id = $r";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            crear_match($conexion,$id,$user);


        }else{//En caso de no haber registro creamos uno nuevo
            $consulta = "INSERT INTO lke (id_user1, id_user2, like1) VALUES ('$user', '$id','1')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();  
        }                   
    }

    if(isset($_GET['dislike'])){//Si damos dislike
        $id = $_GET['dislike'];
        $consulta = "SELECT id FROM lke WHERE (id_user2 = '$user' and id_user1 = $id) or (id_user2 = '$id' and id_user1 = $user)";//Comprobamos que no exista ya un registro en el que alguno de los usuarios de like o dislike al otro
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetch(PDO::FETCH_ASSOC); 
        if ($data['id'] != ""){ //Si existe este registro acualizamos el dislike correspondiente.
            $_SESSION['data'] = $data['id'];
            $r= $data['id'];
            $_SESSION['cons'] = $consulta;
            $consulta = "UPDATE `lke` SET `like2`= 0 WHERE id = $r";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
        }else{//En caso de no haber registro creamos uno nuevo
            $consulta = "INSERT INTO lke (id_user1, id_user2, like1) VALUES ('$user', '$id','0')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();  
        }                       
    }

    function conect(){
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();
        return $conexion;
    }
    function crear_match($conexion){
        
        $consulta = "SELECT id,id_user1,id_user2 FROM lke WHERE like1 = 1 and like2 = 1";//Buscar en la tabla de likes los match creados
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetch(PDO::FETCH_ASSOC); 
        $u1=$data['id_user1'];
        $u2=$data['id_user2'];
        $idlke=$data['id_lke'];

        $consulta = "SELECT id FROM tmatch WHERE id_user1 = $u1 and id_user2 = $u2";//Comprobamos que no exista ya un registro en el que alguno de los usuarios de like o dislike al otro
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetch(PDO::FETCH_ASSOC); 

        if($data['id'] == ""){
            $consulta = "INSERT INTO `tmatch`(`id_user1`, `id_user2`) VALUES ($u1,$u2)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 

            // $consulta = "SELECT id FROM tmatch WHERE id_user1 = $u1 and id_user2 = $u2";//Comprobamos que no exista ya un registro en el que alguno de los usuarios de like o dislike al otro
            // $resultado = $conexion->prepare($consulta);
            // $resultado->execute();
            // $data = $resultado->fetch(PDO::FETCH_ASSOC);
            // $id_match=$data['id'];

            // $consulta = "UPDATE `lke` SET `id_match`=  WHERE id = $idlke";
            // $resultado = $conexion->prepare($consulta);
            // $resultado->execute();
        } 
    }
?>