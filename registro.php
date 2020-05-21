<!doctype html>
<html>
    <head>
        <link rel="shortcut icon" href="#" />
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login con  PHP - Bootstrap 4</title>

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="estilos.css">
        <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">        
        
        <link rel="stylesheet" type="text/css" href="fuentes/iconic/css/material-design-iconic-font.min.css">
        
    </head>
    
    <body>
     
      <div class="container-login">
        <div class="wrap-register">
            <h3>Please write your information</h3>
            <form action="./bd/crear_usuario.php" method="post" role="form" class="contactForm" enctype="multipart/form-data">
                <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Write user name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validation"></div>
                </div>
                <div class="form-group col-md-6">
                    <input type="password" class="form-control" name="password" id="password" placeholder="New password"  data-msg="Please enter a valid password" />
                    <div class="validation"></div>
                </div>

                <div class="form-group col-md-6">
                    <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Write your full name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validation"></div>
                </div>

                <div class="form-group col-md-6">
                    <input type="text" name="job" class="form-control" id="job" placeholder="Your Job" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validation"></div>
                </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="school" id="school" placeholder="Your School" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="city" id="city" placeholder="Your City" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                    <div class="validation"></div>
                </div>
                <select name="sexo" id="sexo">                   
                        <option name="sexo" id="sexo"value="1">Hombre</option>
                        <option name="sexo" id="sexo" value="2">Mujer</option>
                </select>

                <div class="form-group">
                    <textarea class="form-control" name="description" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Write about you"></textarea>
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <label >Sube una foto.</label>
                    <div id="imagenes" class="col-sm-8">
                        <input type="file" name="miArchivo"></td>
                    </div>
                </div>
                <div class="container-login-form-btn">
                    <div class="wrap-login-form-btn">
                        <div class="login-form-bgbtn"></div>
                        <button type="submit" name="submit" class="login-form-btn">Registrar</button>
                    </div>
                </div>

            </form>
             <a class="link-text" href="./index.php">Login</a>


        </div>
    </div>     
        
        
     <script src="jquery/jquery-3.3.1.min.js"></script>    
     <script src="bootstrap/js/bootstrap.min.js"></script>    
     <script src="popper/popper.min.js"></script>    
        
     <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>    
     <script src="codigo.js"></script>    
    </body>
</html>