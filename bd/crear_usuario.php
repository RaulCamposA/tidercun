<?php 
session_start();

include_once './conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

        if(isset($_POST)) {

            $usuario = filter_var($_POST["usuario"]);
            $password = filter_var($_POST["password"]);
            $fullname = filter_var($_POST["fullname"]);
            $job = filter_var($_POST["job"]);
            $school = filter_var($_POST["school"]);
            $city = filter_var($_POST["city"]);
            $sexo = filter_var($_POST["sexo"]);
            $description = filter_var($_POST["description"]);
            // $revisar = getimagesize($_FILES["image"]["tmp_name"]);

            if($usuario !== false){              
              if($password !== false){
                if($fullname !== false){
                  if($job !== false){
                    if($school !== false){
                      if($city !== false){
                        if($sexo !== false){
                          if($description !== false){
                            // INSERT INTO `usuarios`(`id`, `usuario`, `password`, `fullname`, `puesto`, `escuela`, `ciudad`, `id_sexo`, `about_us`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9])
                            $consulta = "INSERT INTO users (username, password, fullname, puesto, escuela, ciudad, id_sexo,about_us) VALUES ('$usuario', '$password','$fullname','$job','$school','$city','$sexo','$description')";
                            //echo($consulta);
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();

                            // $consulta = "SELECT id FROM usuarios WHERE usuario = '$usuario' AND password='$password' AND fullname='$fullname' AND puesto='$job' AND escuela='$school' AND id_sexo = '$sexo' AND about_us='$description'";
                            // $resultado = $conexion->prepare($consulta);
                            // $resultado->execute();
                            // $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

                            $consulta = "SELECT * FROM usuarios";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                            header( "refresh:5;url=../index.php" ); 

                            // if($resultado === TRUE){
                            //   echo"Datos guardados";
                              // if($revisar !== false){
                              //   $image = $_FILES['image']['tmp_name'];
                              //   $imgContenido = addslashes(file_get_contents($image));                              
                              //   //Insertar imagen en la base de datos
                              //   $insertar = $db->query("INSERT into images_tabla (imagenes, creado) VALUES ('$imgContenido', now())");
                              //   // COndicional para verificar la subida del fichero
                              //   if($insertar){
                              //       echo "Archivo Subido Correctamente.";
                              //   }else{
                              //       echo "Ha fallado la subida, reintente nuevamente.";
                              //   } 
                              //   // Sie el usuario no selecciona ninguna imagen
                              // }else{
                              //     echo "Por favor seleccione imagen a subir.";
                              // }

                            // }else{echo"Error".$insertar}
                                            
                          }

                        }

                      }

                    }

                  
                }
              }

            }
          }
        }
        //  print json_encode($data);
        //  print($resultado); //enviar el array final en formato json a JS
        $conexion = NULL;
?>