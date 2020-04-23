<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$idCategoria = (isset($_POST['idCategoria'])) ? $_POST['idCategoria'] : '';
$categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO categorias (categoria, estado) VALUES('$categoria', '$estado') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT idCategoria, categoria, estado FROM categorias ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE categorias SET categoria='$categoria', estado='$estado' WHERE idCategoria='$idCategoria' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT idCategoria, categoria, estado FROM categorias WHERE idCategoria='$idCategoria' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM categorias WHERE idCategoria='$idCategoria' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
