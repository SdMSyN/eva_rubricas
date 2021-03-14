<?php require('header.php'); ?>

<title><?= $tit; ?></title>
<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
<meta name="description" content="Descripción de la página" />
<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />

</head>
<body class="hold-transition skin-blue sidebar-mini">

    <?php require('navbar.php'); ?>

    <?php
    if (isset($_SESSION['sessU']) AND $_SESSION['userPerfil'] == 1) {
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="row">
                    <div class="col-xs-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar por nombre" id="buscar" >
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" onclick="load(1);"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-4"></div>
                    <div class="col-xs-5 ">
                        <div class="btn-group pull-right">
                            <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modalAddPeriodo"><i class="fa fa-plus"></i> Nuevo</a>
                            <!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Mostrar <span class="caret"></span>
                            </button> -->
                        </div>
                    </div>
                </div>

                <!-- modal añadir nuevo periodo -->
                <form class="form-horizontal" id="formAddPeriodo" name="formAddPeriodo">
                    <div class="modal fade" id="modalAddPeriodo" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Nuevo Periodo</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">Nombre (Completo)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputName" name="inputName" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputNum" class="col-sm-3 control-label">Número de Periodos</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="inputNum" name="inputNum" value="3" max="10" required>
                                        </div>
                                    </div>
                                </div><!-- ./modal-body -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" id="guardar_datos" class="btn btn-primary">Añadir</button>
                                </div><!-- ./modal-footer -->
                            </div><!-- ./modal-content -->
                        </div><!-- ./modal-dialog -->
                    </div><!-- ./modal fade -->
                </form>
                <!-- fin modal -->

                <!-- modal añadir fechas periodo -->
                <form class="form-horizontal" id="formAddDatePeriodo" name="formAddDatePeriodo">
                    <div class="modal fade" id="modalAddDatePeriodo" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Nuevas fechas para el periodo</h4>
                                    <p class="divError"></p>
                                    <input type="text" class="form-control" id="inputIdPeriodo" name="inputIdPeriodo" >
                                </div>
                                <div class="modal-body">
                                    <div class="contenido2"></div>
                                </div><!-- ./modal-body -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" id="guardar_datos" class="btn btn-primary">Añadir</button>
                                </div><!-- ./modal-footer -->
                            </div><!-- ./modal-content -->
                        </div><!-- ./modal-dialog -->
                    </div><!-- ./modal fade -->
                </form>
                <!-- fin modal -->
                
                <!-- modal editar fechas periodo -->
                <form class="form-horizontal" id="formUpdDatePeriodo" name="formUpdDatePeriodo">
                    <div class="modal fade" id="modalUpdDatePeriodo" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Editar fechas para el periodo</h4>
                                    <p class="divError"></p>
                                    <input type="text" class="form-control" id="inputIdPeriodo" name="inputIdPeriodo" >
                                </div>
                                <div class="modal-body"> </div><!-- ./modal-body -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" id="guardar_datos" class="btn btn-primary">Actualizar</button>
                                </div><!-- ./modal-footer -->
                            </div><!-- ./modal-content -->
                        </div><!-- ./modal-dialog -->
                    </div><!-- ./modal fade -->
                </form>
                <!-- fin modal -->
                
                <!-- modal ver fechas periodo -->
                <form class="form-horizontal" id="formViewDatePeriodo" name="formViewDatePeriodo">
                    <div class="modal fade" id="modalViewDatePeriodo" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Ver fechas para el periodo</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body"> </div><!-- ./modal-body -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" id="guardar_datos" class="btn btn-primary">Actualizar</button>
                                </div><!-- ./modal-footer -->
                            </div><!-- ./modal-content -->
                        </div><!-- ./modal-dialog -->
                    </div><!-- ./modal fade -->
                </form>
                <!-- fin modal -->
                
                <!-- modal editar plan de estudio -->
                <form class="form-horizontal" id="formUpdPlanEst" name="formUpdPlanEst">
                    <div class="modal fade" id="modalUpdPlanEst" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Editar Plan de Estudios</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <input type="text" id="inputIdPlan" name="inputIdPlan" >
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">Nombre (Completo)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputName" name="inputName" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputYear" class="col-sm-3 control-label">Año</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="inputYear" name="inputYear" value="2018" max="2018" required>
                                        </div>
                                    </div>
                                </div><!-- ./modal-body -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" id="guardar_datos" class="btn btn-primary">Actualizar</button>
                                </div><!-- ./modal-footer -->
                            </div><!-- ./modal-content -->
                        </div><!-- ./modal-dialog -->
                    </div><!-- ./modal fade -->
                </form>
                <!-- fin modal -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Listado de Ciclos Escolares</h3>
                                <div class="divError"></div>
                            </div>
                            <div class="box-body">
                                <div class="table table-condensed table-hover table-striped">
                                    <table class="table table-striped table-bordered" id="data">
                                        <thead>
                                            <tr>
                                                <th><span title="">Nombre</span></th>
                                                <th><span title="">Número de periodos</span></th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div><!-- ./table -->
                            </div><!-- ./box-body -->
                        </div><!-- ./box -->
                    </div><!-- ./col-sm-12 -->
                </div><!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php require('footer.php'); ?>
        <!-- scripts acá -->

        <script>
            $(".loader").hide();
            var ordenar = '';
            $(document).ready(function () {
                filtrar();
                function filtrar() {
                    $(".loader").show();
                    $.ajax({
                        type: "POST",
                        data: {orderby: ordenar},
                        url: "../controllers/get_periodos.php",
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if (msg.error == 0) {
                                $("#data tbody").html("");
                                $.each(msg.dataRes, function (i, item) {
                                    var newRow = '<tr>'
                                            + '<td>' + msg.dataRes[i].nombre + '</td>'
                                            + '<td>' + msg.dataRes[i].numero + '</td>'
                                            + '<td><div class="btn-group pull-right dropdown">'
                                            + '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >Acciones <span class="fa fa-caret-down"></span></button>'
                                            + '<ul class="dropdown-menu">'
                                            + '<li><a href="#" data-toggle="modal" data-target="#modalAddDatePeriodo" id="addDatePeriodo" data-periodo="' + msg.dataRes[i].id + '" data-num="'+msg.dataRes[i].numero+'" ><i class="far fa-calendar-plus"></i> Asignar fechas</a></li>'
                                            + '<li><a href="#" data-toggle="modal" data-target="#modalUpdDatePeriodo" id="updDatePeriodo" data-periodo="' + msg.dataRes[i].id + '"><i class="far fa-calendar-alt"></i> Modificar fechas</a></li>'
                                            + '<li><a href="#" data-toggle="modal" data-target="#modalViewDatePeriodo" id="viewDatePeriodo" data-periodo="' + msg.dataRes[i].id + '"><i class="far fa-eye"></i> Ver</a></li>'
                                            + '</ul></div></td>'
                                            + '</tr>';
                                    $(newRow).appendTo("#data tbody");
                                })
                            } else {
                                var newRow = '<tr><td colspan="3">' + msg.msgErr + '</td></tr>';
                                $("#data tbody").html(newRow);
                            }
                        },
                        error: function (x, e) {
                            var cadErr = '';
                            if (x.status == 0) {
                                cadErr = '¡Estas desconectado!\n Por favor checa tu conexión a Internet.';
                            } else if (x.status == 404) {
                                cadErr = 'Página no encontrada.';
                            } else if (x.status == 500) {
                                cadErr = 'Error interno del servidor.';
                            } else if (e == 'parsererror') {
                                cadErr = 'Error.\nFalló la respuesta JSON.';
                            } else if (e == 'timeout') {
                                cadErr = 'Tiempo de respuesta excedido.';
                            } else {
                                cadErr = 'Error desconocido.\n' + x.responseText;
                            }
                            alert(cadErr);
                        }
                    });
                    $(".loader").hide();
                }

                //Ordenar ASC y DESC header tabla
                $("#data th span").click(function () {
                    if ($(this).hasClass("desc")) {
                        $("#data th span").removeClass("desc").removeClass("asc");
                        $(this).addClass("asc");
                        //ordenar = "&orderby="+$(this).attr("title")+" asc";
                        ordenar = $(this).attr("title") + " asc";
                    } else {
                        $("#data th span").removeClass("desc").removeClass("asc");
                        $(this).addClass("desc");
                        //ordenar = "&orderby="+$(this).attr("title")+" desc";
                        ordenar = $(this).attr("title") + " desc";
                    }
                    filtrar();
                });

                $("#buscar").keyup(function () {
                    var consulta = $(this).val();
                    $.ajax({
                        type: "POST",
                        data: {orderby: ordenar, query: consulta},
                        url: "../controllers/get_planes_estudio.php",
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if (msg.error == 0) {
                                $("#data tbody").html("");
                                $.each(msg.dataRes, function (i, item) {
                                    var newRow = '<tr>'
                                            + '<td><a href="director_plan_estudio.php?action=viewDetails&route=viewDirection&pln=17' + msg.dataRes[i].id + '&id=256&idUser=512">' + msg.dataRes[i].nombre + '</a></td>'
                                            + '<td>' + msg.dataRes[i].year + '</td>'
                                            + '<td><div class="btn-group pull-right dropdown">'
                                            + '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >Acciones <span class="fa fa-caret-down"></span></button>'
                                            + '<ul class="dropdown-menu">'
                                            + '<li><a href="director_plan_estudio.php?action=viewDetails&route=viewDirection&pln=17' + msg.dataRes[i].id + '&id=256&idUser=512"><i class="fa fa-eye"></i> Ver</a></li>'
                                            + '<li><a href="#" data-toggle="modal" data-target="#modalUpdPlanEst" id="editar" data-value="' + msg.dataRes[i].id + '"><i class="fa fa-edit"></i> Editar</a></li>';
                                            + '</ul></div></td>'
                                            + '</tr>';
                                    $(newRow).appendTo("#data tbody");
                                })
                            } else {
                                var newRow = '<tr><td colspan="3">' + msg.msgErr + '</td></tr>';
                                $("#data tbody").html(newRow);
                            }
                        },
                        error: function (x, e) {
                            var cadErr = '';
                            if (x.status == 0) {
                                cadErr = '¡Estas desconectado!\n Por favor checa tu conexión a Internet.';
                            } else if (x.status == 404) {
                                cadErr = 'Página no encontrada.';
                            } else if (x.status == 500) {
                                cadErr = 'Error interno del servidor.';
                            } else if (e == 'parsererror') {
                                cadErr = 'Error.\nFalló la respuesta JSON.';
                            } else if (e == 'timeout') {
                                cadErr = 'Tiempo de respuesta excedido.';
                            } else {
                                cadErr = 'Error desconocido.\n' + x.responseText;
                            }
                            alert(cadErr);
                        }
                    });
                })

                $("#data").on("click", "#updDatePeriodo", function(){
                    var idPeriodo = $(this).data('periodo');
                    $("#modalUpdDatePeriodo .modal-header #inputIdPeriodo").val(idPeriodo);
                    console.log(idPeriodo);
                    $.ajax({
                        type: "POST",
                        url: "../controllers/get_fechas_periodo.php",
                        data: {idPeriodo: idPeriodo},
                        success: function(msg){
                            console.log(msg);
                            var datos = jQuery.parseJSON(msg);
                            if (datos.error == 0) {
                                $("#modalUpdDatePeriodo .modal-body").html("");
                                var cadInputFecha = '';
                                $.each(datos.dataRes, function (i, item) {
                                    cadInputFecha += '<div class="row">'
                                        + '<div class="col-sm-2">'
                                        + '<input type="text" id="inputIdFechaPeriodo" name="inputIdFechaPeriodo[]" value="'+datos.dataRes[i].id+'">'
                                        + '<label class="control-label">Fecha de Inicio ' +(i+1)+ '</label>'
                                        + '</div>'
                                        + '<div class="col-sm-4">'
                                        + '<input type="date" class="form-control datePeriododBegin" id="datePeriododBegin" name="datePeriododBegin[]" required value="'+datos.dataRes[i].fechaInicio+'">'
                                        + '</div>'
                                        + '<div class="col-sm-2">'
                                        + '<label class="control-label">Fecha de Fin ' +(i+1)+ '</label>'
                                        + '</div>'
                                        + '<div class="col-sm-4">'
                                        + '<input type="date" class="form-control" id="datePeriododEnd" name="datePeriododEnd[]" required value="'+datos.dataRes[i].fechaFin+'">'
                                        + '</div>'
                                        + '</div>';
                                });
                                $("#modalUpdDatePeriodo .modal-body").html(cadInputFecha);
                            }else{
                                $("#modalUpdDatePeriodo .modal-body").html(datos.msgErr);
                            }
                        }
                    })
                })
                
                $("#data").on("click", "#viewDatePeriodo", function(){
                    var idPeriodo = $(this).data('periodo');
                    //$("#modalUpdDatePeriodo .modal-header #inputIdPeriodo").val(idPeriodo);
                    console.log(idPeriodo);
                    $.ajax({
                        type: "POST",
                        url: "../controllers/get_fechas_periodo.php",
                        data: {idPeriodo: idPeriodo},
                        success: function(msg){
                            console.log(msg);
                            var datos = jQuery.parseJSON(msg);
                            if (datos.error == 0) {
                                $("#modalViewDatePeriodo .modal-body").html("");
                                var cadInputFecha = '';
                                $.each(datos.dataRes, function (i, item) {
                                    cadInputFecha += '<div class="row">'
                                        + '<div class="col-sm-2">'
                                        + '<label class="control-label">Fecha de Inicio ' +(i+1)+ '</label>'
                                        + '</div>'
                                        + '<div class="col-sm-4">'
                                        + '<input type="date" class="form-control datePeriododBegin" id="datePeriododBegin" name="datePeriododBegin[]" readonly value="'+datos.dataRes[i].fechaInicio+'">'
                                        + '</div>'
                                        + '<div class="col-sm-2">'
                                        + '<label class="control-label">Fecha de Fin ' +(i+1)+ '</label>'
                                        + '</div>'
                                        + '<div class="col-sm-4">'
                                        + '<input type="date" class="form-control" id="datePeriododEnd" name="datePeriododEnd[]" readonly value="'+datos.dataRes[i].fechaFin+'">'
                                        + '</div>'
                                        + '</div>';
                                });
                                $("#modalViewDatePeriodo .modal-body").html(cadInputFecha);
                            }else{
                                $("#modalViewDatePeriodo .modal-body").html(datos.msgErr);
                            }
                        }
                    })
                })
                
                $(document).on("click", ".modal-body li a", function () {
                    tab = $(this).attr("href");
                    $(".modal-body .tab-content div").each(function () {
                        $(this).removeClass("active");
                    });
                    $(".modal-body .tab-content " + tab).addClass("active");
                });

                //Crear nuevo periodo
                $('#formAddPeriodo').validate({
                    rules: {
                        inputName: {required: true},
                        inputNum: {required: true}
                    },
                    messages: {
                        inputName: "Nombre del periodo a crear, obligatorio",
                        inputNum: "Número de periodos internos, obligatorios, mínimo 1."
                    },
                    submitHandler: function(form){
                        $.ajax({
                            type: "POST",
                            url: "../controllers/create_periodo.php",
                            data: $('form#formAddPeriodo').serialize(),
                            success: function(msg){
                                console.log(msg);
                                var msg = jQuery.parseJSON(msg);
                                if(msg.error == 0){
                                    $('#modalAddPeriodo .modal-header .divError').css({color: "#77DD77"});
                                    $('#modalAddPeriodo .modal-header .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      location.reload();
                                    }, 1500);
                                }else{
                                    $('#modalAddPeriodo .modal-header .divError').css({color: "#FF0000"});
                                    $('#modalAddPeriodo .modal-header .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      $('#modalAddPeriodo .modal-header .divError').hide();
                                    }, 1500);
                                }
                            }, error: function(){
                                alert("Error al crear periodo nuevo.");
                            }
                        });
                    }
                }); // end añadir nuevo cargo
                
                //Crear nuevas fechas para el periodo
                $('#formAddDatePeriodo').validate({
                    debug:false,
                    rules: {
                        'datePeriododBegin[]': {required: true},
                        'datePeriododEnd[]': {required: true}
                    },
                    messages: {
                        'datePeriododBegin[]': "Fecha de inicio obligatoria",
                        'datePeriododEnd[]': "Fecha de finalización obligatoria"
                    },
                    submitHandler: function(form){
                        $.ajax({
                            type: "POST",
                            url: "../controllers/create_fechas_periodo.php",
                            data: $('form#formAddDatePeriodo').serialize(),
                            success: function(msg){
                                console.log(msg);
                                var msg = jQuery.parseJSON(msg);
                                if(msg.error == 0){
                                    $('#modalAddDatePeriodo .modal-header .divError').css({color: "#77DD77"});
                                    $('#modalAddDatePeriodo .modal-header .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      location.reload();
                                    }, 1500);
                                }else{
                                    $('#modalAddDatePeriodo .modal-header .divError').css({color: "#FF0000"});
                                    $('#modalAddDatePeriodo .modal-header .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      $('#modalAddDatePeriodo .modal-header .divError').hide();
                                    }, 1500);
                                }
                            }, error: function(){
                                alert("Error al crear fechas del periodo.");
                            }
                        });
                    }
                }); // end añadir nuevo cargo
                
                //Crear nuevas fechas para el periodo
                $('#formUpdDatePeriodo').validate({
                    debug:false,
                    rules: {
                        'datePeriododBegin[]': {required: true},
                        'datePeriododEnd[]': {required: true}
                    },
                    messages: {
                        'datePeriododBegin[]': "Fecha de inicio obligatoria",
                        'datePeriododEnd[]': "Fecha de finalización obligatoria"
                    },
                    submitHandler: function(form){
                        $.ajax({
                            type: "POST",
                            url: "../controllers/update_fechas_periodo.php",
                            data: $('form#formUpdDatePeriodo').serialize(),
                            success: function(msg){
                                console.log(msg);
                                var msg = jQuery.parseJSON(msg);
                                if(msg.error == 0){
                                    $('#modalUpdDatePeriodo .modal-header .divError').css({color: "#77DD77"});
                                    $('#modalUpdDatePeriodo .modal-header .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      location.reload();
                                    }, 1500);
                                }else{
                                    $('#modalUpdDatePeriodo .modal-header .divError').css({color: "#FF0000"});
                                    $('#modalUpdDatePeriodo .modal-header .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      $('#modalUpdDatePeriodo .modal-header .divError').hide();
                                    }, 1500);
                                }
                            }, error: function(){
                                alert("Error al actualizar fechas del periodo.");
                            }
                        });
                    }
                }); // end añadir nuevo cargo
                
                //Obtener ID Periodo
                $("#data tbody").on("click", "#addDatePeriodo", function(){
                    var idPeriodo = $(this).data("periodo");
                    var numPeriodo = $(this).data("num");
                    $("#modalAddDatePeriodo .modal-header #inputIdPeriodo").val(idPeriodo);
                    console.log("Periodo: "+idPeriodo+", Núm: "+numPeriodo);
                    $("#modalAddDatePeriodo .modal-body .contenido2").html("");
                    var cadInputFecha = '';
                    for(var i=0; i<numPeriodo; i++){
                        cadInputFecha += '<div class="row">'
                        + '<div class="col-sm-2">'
                        + '<label class="control-label">Fecha de Inicio ' +(i+1)+ '</label>'
                        + '</div>'
                        + '<div class="col-sm-4">'
                        + '<input type="date" class="form-control datePeriododBegin" id="datePeriododBegin" name="datePeriododBegin[]" required>'
                        + '</div>'
                        + '<div class="col-sm-2">'
                        + '<label class="control-label">Fecha de Fin ' +(i+1)+ '</label>'
                        + '</div>'
                        + '<div class="col-sm-4">'
                        + '<input type="date" class="form-control" id="datePeriododEnd" name="datePeriododEnd[]" required>'
                        + '</div>'
                        + '</div>';
                    }
                    console.log(cadInputFecha);
                    $("#modalAddDatePeriodo .modal-body .contenido2").html(cadInputFecha);
                });

            });
        </script>

        <?php
    } else {
        ?>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Error 401
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="error-page">
                    <h2 class="headline text-yellow"> 401</h2>

                    <div class="error-content">
                        <h3><i class="fa fa-warning text-yellow"></i> Oops! No tienes autorización para visualizar ésta página.</h3>

                        <p>
                            <a href="login.php">Inicia sesión</a> para poder visualizar el contenido, lamentamos las molestias.
                        </p>

                    </div>
                    <!-- /.error-content -->
                </div>
                <!-- /.error-page -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    <?php require('footer.php'); ?>
        <script>
            $(".loader").hide();
        </script>
        <?php
    }
    ?>
</body>
</html>
