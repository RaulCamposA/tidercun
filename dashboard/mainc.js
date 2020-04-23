$(document).ready(function(){
    tablaCiudades = $("#tablaCiudades").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar2'>Editar</button><button class='btn btn-danger btnBorrar2'>Borrar</button></div></div>"  
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
    $(".modal-title").text("Nueva Ciudad");            
    $("#modalCRUD").modal("show");        
    idCiudad=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar2", function(){
    fila = $(this).closest("tr");
    idCiudad = parseInt(fila.find('td:eq(0)').text());
    ciudad = fila.find('td:eq(1)').text();
    idEstado = fila.find('td:eq(2)').text();
    
    $("#ciudad").val(ciudad);
    $("#idEstado").val(idEstado);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Ciudad");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar2", function(){    
    fila = $(this);
    idCiudad = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+idCiudad+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crudc.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idCiudad:idCiudad},
            success: function(){
                tablaCiudades.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    ciudad = $.trim($("#ciudad").val());
    idEstado = $.trim($("#idEstado").val());    
    $.ajax({
        url: "bd/crudc.php",
        type: "POST",
        dataType: "json",
        data: {idCiudad:idCiudad, ciudad:ciudad, idEstado:idEstado, opcion:opcion},
        success: function(data){  
            console.log(data);
            idCiudad = data[0].idCiudad;            
            ciudad = data[0].ciudad;
            idEstado = data[0].idEstado;
            if(opcion == 1){tablaCiudades.row.add([idCiudad,ciudad,idEstado]).draw();}
            else{tablaCiudades.row(fila).data([idCiudad,ciudad,idEstado]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});