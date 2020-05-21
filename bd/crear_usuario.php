<?php 
session_start();
ob_start();
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
                     

                            // SELECT id FROM `users` WHERE username = "Jocabed"  and password = "1234"  and puesto = "diseñadora" and escuela = "Unicaribe" and ciudad = "Cancún Quintana Roo" and id_sexo = "2" and about_us = "kjdfbhdkfasdf";
                            $consulta = "SELECT id FROM users WHERE username ='$usuario' and password = '$password' and fullname = '$fullname' and puesto = '$job' and escuela = '$school' and ciudad = '$city' and id_sexo = '$sexo' and about_us = '$description'";
                            $resultado = $conexion->prepare($consulta);
                            $resultado->execute();
                            $data=$resultado->fetch(PDO::FETCH_ASSOC);
                            $a=$data['id'];
                            // echo $a;

                            if((isset($_FILES['miArchivo'])) && ($_FILES['miArchivo'] !='')){
                              // echo"si entro";
                              $file = $_FILES['miArchivo']; //Asignamos el contenido del parametro a una variable para su mejor manejo                              
                              $temName = $file['tmp_name']; //Obtenemos el directorio temporal en donde se ha almacenado el archivo;
                              $fileName = $file['name']; //Obtenemos el nombre del archivo
                              $fileExtension = substr(strrchr($fileName, '.'), 1); //Obtenemos la extensiÃ³n del archivo.
                              
                              //Comenzamos a extraer la informaciÃ³n del archivo
                              $fp = fopen($temName, "rb");//abrimos el archivo con permiso de lectura
                              $contenido = fread($fp, filesize($temName));//leemos el contenido del archivo
                              //Una vez leido el archivo se obtiene un string con caracteres especiales.
                              $contenido = addslashes($contenido);//se escapan los caracteres especiales
                              fclose($fp);//Cerramos el archivo
                              
                              //Insertando los datos
                              //Creando el query
                              $query = "INSERT INTO img (fileName ,extension ,binario, id_users) VALUES ('$fileName' ,'$fileExtension' ,'$contenido','$a')";
                              //Ejecutando el Query
                              // $result = mysqli_query($conexion, $query);
                              $resultado = $conexion->prepare($query);
                              $resultado->execute();

                              header('Location: ../index.php');
                            }

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
        //  echo($resultado); //enviar el array final en formato json a JS
        $conexion = NULL;
?>