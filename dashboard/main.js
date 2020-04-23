$(document).ready(function(){
    tablaCategorias = $("#tablaCategorias").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar1'>Editar</button><button class='btn btn-danger btnBorrar1'>Borrar</button></div></div>"  
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
    $(".modal-title").text("Nueva Categoria");            
    $("#modalCRUD").modal("show");        
    idCategoria=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar1", function(){
    fila = $(this).closest("tr");
    idCategoria = parseInt(fila.find('td:eq(0)').text());
    categoria = fila.find('td:eq(1)').text();
    estado = fila.find('td:eq(2)').text();
    
    $("#categoria").val(categoria);
    $("#estado").val(estado);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Categoria");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar1", function(){    
    fila = $(this);
    idCategoria = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+idCategoria+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idCategoria:idCategoria},
            success: function(){
                tablaCategorias.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    categoria = $.trim($("#categoria").val());
    estado = $.trim($("#estado").val());    
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {idCategoria:idCategoria, categoria:categoria, estado:estado, opcion:opcion},
        success: function(data){  
            console.log(data);
            idCategoria = data[0].idCategoria;            
            categoria = data[0].categoria;
            estado = data[0].estado;
            if(opcion == 1){tablaCategorias.row.add([idCategoria,categoria,estado]).draw();}
            else{tablaCategorias.row(fila).data([idCategoria,categoria,estado]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});
