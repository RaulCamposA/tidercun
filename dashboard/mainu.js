$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar3'>Editar</button><button class='btn btn-danger btnBorrar3'>Borrar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo usuario");            
    $("#modalCRUD").modal("show");        
    idLogin=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar3", function(){
    fila = $(this).closest("tr");
    idLogin = parseInt(fila.find('td:eq(0)').text());
    usuario = fila.find('td:eq(1)').text();
    password = fila.find('td:eq(2)').text();
    idPersona = fila.find('td:eq(3)').text();
    
    $("#usuario").val(usuario);
    $("#password").val(password);
    $("#idPersona").val(idPersona);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar usuario");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar3", function(){    
    fila = $(this);
    idLogin = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+idLogin+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crudu.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idLogin:idLogin},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    usuario = $.trim($("#usuario").val());
    password = $.trim($("#password").val());
    idPersona = $.trim($("#idPersona").val());
    $.ajax({
        url: "bd/crudu.php",
        type: "POST",
        dataType: "json",
        data: {idLogin:idLogin, usuario:usuario, password:password, idPersona:idPersona, opcion:opcion},
        success: function(data){  
            console.log(data);
            idLogin = data[0].idLogin;            
            usuario = data[0].usuario;
            password = data[0].password;
            idPersona = data[0].idPersona;
            if(opcion == 1){tablaPersonas.row.add([idLogin,usuario,password,idPersona]).draw();}
            else{tablaPersonas.row(fila).data([idLogin,usuario,password,idPersona]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});
