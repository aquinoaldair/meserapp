var DataTablesCustom = function () {

    var datatableEl = $('#datatable');

    var initDataTables = function () {
        if(datatableEl.length) {
            datatableEl.DataTable();
        }
    };

    var datatableElButtons = $('#datatableButtons');

    var initDataTablesButtons = function () {
        console.log("iniciar datatables buttons");
        if(datatableElButtons.length) {
            datatableElButtons.DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        },
                        className: 'btn-success'
                    },
                ]
            } );
        }
    };

    var initDataTablesDeleteItems = function () {
        datatableEl.on("click", ".destroy", function(e){
            e.preventDefault();
            var row  = $(this).parents('tr');
            var id   = row.data('id');
            var form = $('#form-destroy');
            var url  = form.attr('action').replace(':data-id', id);
            var data = form.serialize();

            //inicio del swal
            swal({
                title: "Esta seguro de eliminarlo?",
                text: "Una vez eliminado no podras revertir esta acción",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: "DELETE",
                        url: url,
                        data: data
                    }).done(function(data) {
                        console.log(data);
                        row.fadeOut();
                        swal("El registro ha sido eliminado.", {
                            icon: "success",
                        });
                    }).fail(function (data) {
                        console.log(data);
                        swal("Ocurrio un error al eliminar el registro, intentelo de nuevo o contacte con su administrador", {
                            icon: "error",
                        });
                    });
                }
            });
            // fin del swal
        });
    };

    return {
        init: function() {
            initDataTables();
            initDataTablesDeleteItems();
            initDataTablesButtons();


        }
    };

}();

var RoomDelete = function () {

    var initButton =  function () {
        $( ".room-delete" ).click(function() {
            var key = $(this).attr('data-key');

            var form = $('#form-destroy');
            var url  = form.attr('action').replace(':data-id', key);
            var data = form.serialize();
            var el = $("#"+key);

            swal({
                title: "Esta seguro de eliminarlo?",
                text: "Una vez eliminado no podras revertir esta acción",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        method: "DELETE",
                        url: url,
                        data: data
                    }).done(function(data) {
                        console.log(key);
                        el.remove();
                        swal("El registro ha sido eliminado.", {
                            icon: "success",
                        });
                    }).fail(function (data) {
                        console.log(data);
                        swal("Ocurrio un error al eliminar el registro, intentelo de nuevo o contacte con su administrador", {
                            icon: "error",
                        });
                    });
                }
            });
        });
    };

    return {
        init: function() {
            initButton();
        }
    };
}();

$(document).ready(function(){
    DataTablesCustom.init();
    RoomDelete.init();
});
