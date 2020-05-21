<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/x-icon" calss="img/icon.jpg" />
  <title>TinderCun</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="vendor/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">      
    <link href="css/sb-admin-2.css" rel="stylesheet">
</head>
<body>
    <?php require_once "vistas/parte_superior.php"?>

    <!--INICIO del cont principal-->
    <div class="container" id="contine-porfiles">
        <h1>PERFILES DE POSIBLES PAREJAS</h1>
        <?php 
            include_once '../bd/conexion.php';
            include_once './bd/functions.php';
            $conexion = conect();
            $user=$_SESSION['id'];

            $consulta = "SELECT id_user1,id_user2 FROM lke WHERE (like1 = 1 and like2 = 1) and (id_user1 = $user or id_user2= $user)";//Buscar en la tabla de likes los match creados
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetch(PDO::FETCH_ASSOC); 
            $u1=$data['id_user1'];
            $u2=$data['id_user2'];

            $consulta = "SELECT * FROM users WHERE (id != $user) and ((id=$u1)or(id=$u2)) ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

        ?>
        <div class="row justify-content-center">
            <table>
                <thead>
                    <tr>
                        <!-- <th>Id</th> -->
                        <th>Fullname</th>
                        <th>Job</th>
                        <th>School</th>
                        <th>City</th>
                        <th>Information</th>
                    </tr>
                </thead>
                <?php
                    while($row = $resultado->fetch(PDO::FETCH_ASSOC)):?>  
                    <tr>
                        <!-- <td><?php echo $row['id'];?></td> -->
                        <td><?php echo $row['fullname'];?></td>
                        <td><?php echo $row['puesto'];?></td>
                        <td><?php echo $row['escuela'];?></td>
                        <td><?php echo $row['ciudad'];?></td>
                        <td><?php echo $row['about_us'];?></td>
                    </tr> 
                    <?php endwhile;?>    
            </table>
            <!-- <?php echo $_SESSION['cons'];?> -->
            <!-- <?php echo $_SESSION['id'];?> -->
            <!-- <?php echo $_SESSION['data'];?> -->
                
        </div>
    </div>
    <!--FIN del cont principal-->

    <?php require_once "vistas/parte_inferior.php"?>
</body>
</html>
