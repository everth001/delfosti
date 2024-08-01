@extends('layouts.app', ['activePage' => 'pedido', 'titlePage' => __('Pedidos')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Listar Pedidos</h4>
                    </div>
                    <div class="col-12 text-right">
                        <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#mdAgregarPedido">Agregar Pedido</a>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="tbListarPedidos" class="table table-hover">
                            <thead class="text-warning">
                                <tr>
                                    <th>Id</th>
                                    <th>Nro. Pedido</th>
                                    <th>Producto</th>
                                    <th>Fecha Pedido</th>
                                    <th>Fecha Recepcion</th>
                                    <th>Fecha Despacho</th>
                                    <th>Fecha Entrega</th>
                                    <th>Repartidor</th>
                                    <th>Usuario</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdAgregarPedido" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Agregar Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="limpiar()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST" id="formPedido">
                @csrf
                <input type="hidden" name="id_pedido" id="id_pedido" class="form-control">
                <div class="modal-body p-4 bg-light">
                    <div class="row mt-1 mb-1">
                        <div class="col-lg-6">
                            <label for="lbNroPedido">Nro. Pedido</label>
                            <input type="text" name="nro_pedido" id="nro_pedido" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row mt-1 mb-1">
                        <div class="col-lg-6">
                            <label for="lbProducto">Producto</label>
                            <select class="form-control" id="producto" required>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <label for="lbEstado">Estado</label>
                            <select class="form-control" id="estado" required>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-1 mb-1 divRepartidor" style="display: none;">
                        <div class="col-lg">
                            <label for="lbRepartidor">Repartidor</label>
                            <input type="text" name="repartidor" id="repartidor" class="form-control mt-1">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg">
                            <label for="lbTrazabilidad"><b>Trazabilidad</b></label>
                            <table id="tbListarTrazabilidad" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Producto</th>
                                        <th>Usuario</th>
                                        <th>Tipo de Fecha</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal" onclick="limpiar()">Cancelar</button>
                    <button type="submit" id="btnGuardarRecarga" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        load_producto();
        load_estado();
        load_tb_listar_pedido();
    });



    function load_producto() {
        $("#producto").append(new Option("Seleccione una opcion", ""));
        $.ajax({
            url: `{{ route('listar.producto') }}`,
            method: 'get',
            success: function(response) {
                response.forEach(element => {
                    $("#producto").append(new Option('SKU: ' + element.sku.toUpperCase() + ' - ' + element.nombre.toUpperCase() + ' - UM: ' + element.unidad_medida.toUpperCase(), element.id));
                });
            }
        });
    }

    function load_estado() {
        $("#estado").append(new Option("Seleccione una opcion", ""));
        $.ajax({
            url: `{{ route('listar.estado') }}`,
            method: 'get',
            success: function(response) {
                response.forEach(element => {
                    $("#estado").append(new Option(element.nombre.toUpperCase(), element.id));
                });
            }
        });
    }

    $("#estado").change(function() {
        let estado = $("#estado").val();
        if (estado != 3) {
            $('.divRepartidor').hide();
        } else {
            $('.divRepartidor').show();
        }
    });

    function load_tb_listar_pedido() {
        $("#tbListarPedidos").DataTable({
            "columnDefs": [{
                "targets": [0],
                "visible": false,
                "searchable": false
            }],
            "searching": true,
            "lengthChange": true,
            pageLength: 10,
            destroy: true,
            order: [
                [0, "asc"]
            ],
            om: 'lfBrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel'
            ],
            language: {
                "emptyTable": "No hay datos disponibles en la tabla.",
                "info": " Del _START_ al _END_ de _TOTAL_ ",
                "infoEmpty": "Mostrando 0 registros de un total de 0.",
                "infoFiltered": "(filtrados de un total de _MAX_ registros)",
                "infoPostFix": "(actualizados)",
                "lengthMenu": "Mostrar _MENU_ registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "searchPlaceholder": "",
                "zeroRecords": "No se han encontrado coincidencias.",
                paginate: {
                    "first": "Primera",
                    "last": "Ultima",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "ajax": {
                "url": `{{ route('listar.pedido') }}`,
                'type': 'get',
                "dataSrc": ""
            },
            "columns": [{
                    "data": "id",
                    className: "text-center"
                },
                {
                    "data": "nro_pedido",
                    className: "text-center"
                },
                {
                    "data": "producto.nombre",
                    className: "text-center"
                },
                {
                    "data": "fecha_pedido",
                    className: "text-center"
                },
                {
                    "data": "fecha_recepcion",
                    className: "text-center"
                },
                {
                    "data": "fecha_despacho",
                    className: "text-center"
                },
                {
                    "data": "fecha_entrega",
                    className: "text-center"
                },
                {
                    "data": "repartidor",
                    className: "text-center"
                },
                {
                    "data": "user.name",
                    className: "text-center"
                },
                {
                    "data": "estado.nombre",
                    className: "text-center"
                },
                {
                    "data": "id",
                    className: "text-center",
                    "render": function(data, type, row) {
                        return `<button style="padding: 5px" type="button" class="btn btn-success" onclick="findPedido(${data})"><i class="material-icons">edit</i></button>`;
                    }
                }
            ]
        })
    }

    $("#formPedido").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var idPedido  = $("#id_pedido").val();

        if ($("#id_pedido").val() != '') {
            tempUrl = `{{ route('update.pedido', ['pedido' => ':id']) }}`.replace(':id', idPedido);
        } else {
            tempUrl = `{{ route('crear.pedido') }}`
        }
        
        formData.append("id_pedido", $("#id_pedido").val());
        formData.append("repartidor", $("#repartidor").val());
        formData.append("nro_pedido", $("#nro_pedido").val());
        formData.append("producto", $("#producto").val());
        formData.append("estado", $("#estado").val());

        $.ajax({
            url: tempUrl,
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                if (response.status == 0) {
                    $("#mdAgregarPedido").modal('hide');
                    limpiar();
                    Swal.fire('Guardado', 'El registro fue guardado con exito!', 'success')
                    load_tb_listar_pedido();
                }
            }
        });
    });

    function limpiar() {
        $('#formPedido')[0].reset();
        $("#id_pedido").val('');
    }

    function findPedido(idPedido) {
        $.ajax({
            url: `/pedido/buscar_pedido/${idPedido}`,
            method: 'post',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                $("#mdAgregarPedido").modal('show');
                $("#id_pedido").val(response.id);
                $("#nro_pedido").val(response.nro_pedido);
                $("#producto").val(response.producto_id);
                $("#estado").val(response.estado_id);
                $("#repartidor").val(response.repartidor);
                load_tb_listar_trazabilidad(response.id);
            }
        });
    }

    function load_tb_listar_trazabilidad(id_pedido) {
        $("#tbListarTrazabilidad").DataTable({
            "autoWidth": true,
            "columnDefs": [{
                "targets": [0],
                "visible": false,
                "searchable": false
            }],
            "searching": false,
            "lengthChange": false,
            "paging": false,
            "info": false,
            "lengthChange": false,
            pageLength: 10,
            destroy: true,
            order: [
                [0, "asc"]
            ],
            om: 'lfBrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel'
            ],
            language: {
                "emptyTable": "No hay datos disponibles en la tabla.",
                "info": " Del _START_ al _END_ de _TOTAL_ ",
                "infoEmpty": "Mostrando 0 registros de un total de 0.",
                "infoFiltered": "(filtrados de un total de _MAX_ registros)",
                "infoPostFix": "(actualizados)",
                "lengthMenu": "Mostrar _MENU_ registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "searchPlaceholder": "",
                "zeroRecords": "No se han encontrado coincidencias.",
                paginate: {
                    "first": "Primera",
                    "last": "Ultima",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "ajax": {
                "url": `{{ route('buscar.trazabilidadPedido') }}`,
                'type': 'get',
                'data': function(d) {
                    d.id_pedido = id_pedido;
                },
                "dataSrc": ""
            },
            "columns": [{
                    "data": "id",
                    className: "text-center"
                },
                {
                    "data": "producto",
                    className: "text-center"
                },
                {
                    "data": "nombre_user",
                    className: "text-center"
                },
                {
                    "data": "tipo_fecha",
                    className: "text-center"
                },
                {
                    "data": "fecha",
                    className: "text-center"
                },
                {
                    "data": "estado",
                    className: "text-center"
                }
            ]
        })
        $('#tbListarTrazabilidad').css('width', '');
    }
</script>
@endsection