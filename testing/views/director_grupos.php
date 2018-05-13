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
                            <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modalAddGroup"><i class="fa fa-plus"></i> Nuevo</a>
                        </div>
                    </div>
                </div>

                <!-- modal añadir nuevo plan de estudios -->
                <form class="form-horizontal" id="formAddGroup" name="formAddGroup">
                    <div class="modal fade" id="modalAddGroup" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Nuevo Grupo</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="inputPE" class="col-sm-3 control-label">Plan de Estudios</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="inputPE" name="inputPE" required> </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">Nombre (Completo)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputName" name="inputName" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputGrado" class="col-sm-3 control-label">Grado</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="inputGrado" name="inputGrado" required> </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTurno" class="col-sm-3 control-label">Turno</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="inputTurno" name="inputTurno" required>
                                                <option value="1">Matutino</option>
                                                <option value="2">Vespertino</option>
                                            </select>
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

                <!-- modal editar plan de estudio -->
                <form class="form-horizontal" id="formUpdGroup" name="formUpdGroup">
                    <div class="modal fade" id="modalUpdGroup" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Editar Grupo</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="inputIdGrupo" name="inputIdGrupo" >
                                    <div class="form-group">
                                        <label for="inputPE" class="col-sm-3 control-label">Plan de Estudios</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="inputPE" name="inputPE" required> </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">Nombre (Completo)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputName" name="inputName" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputGrado" class="col-sm-3 control-label">Grado</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="inputGrado" name="inputGrado" required> </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTurno" class="col-sm-3 control-label">Turno</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="inputTurno" name="inputTurno" required>
                                                <option value="1">Matutino</option>
                                                <option value="2">Vespertino</option>
                                            </select>
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
                                <h3 class="box-title">Listado de Grupos</h3>
                                <div class="divError"></div>
                            </div>
                            <div class="box-body">
                                <div class="table table-condensed table-hover table-striped">
                                    <table class="table table-striped table-bordered" id="data">
                                        <thead>
                                            <tr>
                                                <th><span title="grupo">Nombre</span></th>
                                                <th><span title="grado">Grado</span></th>
                                                <th><span title="turno">Turno</span></th>
                                                <th><span title="year">Año</span></th>
                                                <th><span title="planEst">Plan de Estudios</span></th>
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
                
                //Obtenemos los grados del nivel escolar del usuario
                $.ajax({
                    type: "POST",
                    url: "../controllers/get_grados.php",
                    success: function (msg) {
                        console.log(msg);
                        var msg = jQuery.parseJSON(msg);
                        if (msg.error == 0) {
                            $("#modalAddGroup .modal-body #inputGrado").html("");
                            $("#modalUpdGroup .modal-body #inputGrado").html("");
                            $.each(msg.dataRes, function (i, item) {
                                $("#modalAddGroup .modal-body #inputGrado").append($('<option>', {
                                    value: msg.dataRes[i].id,
                                    text: msg.dataRes[i].nombre
                                }));
                                $("#modalUpdGroup .modal-body #inputGrado").append($('<option>', {
                                    value: msg.dataRes[i].id,
                                    text: msg.dataRes[i].nombre
                                }));
                            });
                        } else {
                            $("#modalAddGroup .modal-body #inputGrado").append($('<option>', {
                                value: 0,
                                text: "No existen grados en tu nivel Escolar"
                            }));
                            $("#modalUpdGroup .modal-body #inputGrado").append($('<option>', {
                                value: 0,
                                text: "No existen grados en tu nivel Escolar"
                            }));
                        }
                    }
                })
                
                //Obtenemos los planes de estudio
                $.ajax({
                    type: "POST",
                    url: "../controllers/get_planes_estudio.php",
                    success: function (msg) {
                        console.log(msg);
                        var msg = jQuery.parseJSON(msg);
                        if (msg.error == 0) {
                            $("#modalAddGroup .modal-body #inputPE").html("");
                            $("#modalUpdGroup .modal-body #inputPE").html("");
                            $.each(msg.dataRes, function (i, item) {
                                $("#modalAddGroup .modal-body #inputPE").append($('<option>', {
                                    value: msg.dataRes[i].id,
                                    text: msg.dataRes[i].nombre
                                }));
                                $("#modalUpdGroup .modal-body #inputPE").append($('<option>', {
                                    value: msg.dataRes[i].id,
                                    text: msg.dataRes[i].nombre
                                }));
                            });
                        } else {
                            $("#modalAddGroup .modal-body #inputPE").append($('<option>', {
                                value: 0,
                                text: "No existen planes de estudio"
                            }));
                            $("#modalUpdGroup .modal-body #inputPE").append($('<option>', {
                                value: 0,
                                text: "No existen planes de estudio"
                            }));
                        }
                    }
                })
                
                filtrar();
                function filtrar() {
                    $(".loader").show();
                    $.ajax({
                        type: "POST",
                        data: {orderby: ordenar},
                        url: "../controllers/get_grupos.php",
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if (msg.error == 0) {
                                $("#data tbody").html("");
                                $.each(msg.dataRes, function (i, item) {
                                    var newRow = '<tr>'
                                            + '<td>' + msg.dataRes[i].grupo + '</td>'
                                            + '<td>' + msg.dataRes[i].grado + '</td>'
                                            + '<td>' + msg.dataRes[i].turno + '</td>'
                                            + '<td>' + msg.dataRes[i].year + '</td>'
                                            + '<td>' + msg.dataRes[i].planEst + '</td>'
                                            + '<td><div class="btn-group pull-right dropdown">'
                                            + '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >Acciones <span class="fa fa-caret-down"></span></button>'
                                            + '<ul class="dropdown-menu">'
                                            + '<li><a href="#"><i class="fa fa-eye"></i> Ver</a></li>'
                                            + '<li><a href="#" data-toggle="modal" data-target="#modalUpdGroup" id="editar" data-value="' + msg.dataRes[i].id + '"><i class="fa fa-edit"></i> Editar</a></li>';
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
                        url: "../controllers/get_grupos.php",
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if (msg.error == 0) {
                                $("#data tbody").html("");
                                $.each(msg.dataRes, function (i, item) {
                                    var newRow = '<tr>'
                                            + '<td>' + msg.dataRes[i].grupo + '</td>'
                                            + '<td>' + msg.dataRes[i].grado + '</td>'
                                            + '<td>' + msg.dataRes[i].turno + '</td>'
                                            + '<td>' + msg.dataRes[i].year + '</td>'
                                            + '<td><div class="btn-group pull-right dropdown">'
                                            + '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >Acciones <span class="fa fa-caret-down"></span></button>'
                                            + '<ul class="dropdown-menu">'
                                            + '<li><a href="#"><i class="fa fa-eye"></i> Ver</a></li>'
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

                $("#data").on("click", "#editar", function () {
                    var idGrupo = $(this).data('value');
                    console.log(idGrupo);
                    $(".loader").show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/get_grupos.php",
                        data: {ordenar: ordenar, tarea: 'editar', idGrupo: idGrupo},
                        success: function (msg) {
                            console.log(msg);
                            var datos = jQuery.parseJSON(msg);
                            $("#modalUpdGroup .modal-body #inputIdGrupo").val(datos.dataRes[0].id);
                            $("#modalUpdGroup .modal-body #inputName").val(datos.dataRes[0].grupo);
                            $(".loader").hide();
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
                    })
                })

                $(document).on("click", ".modal-body li a", function () {
                    tab = $(this).attr("href");
                    $(".modal-body .tab-content div").each(function () {
                        $(this).removeClass("active");
                    });
                    $(".modal-body .tab-content " + tab).addClass("active");
                });

                

            });
        </script>

        <script>
            var form1 = $("#formAddGroup");
            form1.validate({
                ignore: "",
                rules: {
                    inputPE: {required: true},
                    inputName: {required: true, maxlength: 9},
                    inputGrado: {required: true},
                    inputTurno: {required: true}
                },
                messages: {
                    inputPE: {
                        required: "Plan de Estudios obligatorio"
                    },
                    inputName: {
                        required: "Nombre del plan, obligatorio",
                        maxlength: "Máximo 9 caracteres"
                    },
                    inputGrado: {
                        required: "Grado obligatorio"
                    },
                    inputTurno: {
                        required: "Turno obligatorio"
                    },
                },
                errorPlacement: function (error, element) {
                    error.addClass("help-block");
                    element.parents(".col-sm-9").addClass("has-feedback");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                    if (!element.next("span")[ 0 ]) {
                        $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".col-sm-9").addClass("has-error").removeClass("has-success");
                    $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".col-sm-9").addClass("has-success").removeClass("has-error");
                    $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
                }
            });
            $("#formAddGroup").submit(function (event) {
                var form1 = $(this).valid();
                var parametros = $(this).serialize();
                if (this.hasChildNodes('.nav.nav-tabs')) {
                    var validator = $(this).validate();
                    $(this).find("input").each(function () {
                        if (!validator.element(this)) {
                            form1 = false;
                            $('a[href=\\#' + $(this).closest('.tab-pane:not(.active)').attr('id') + ']').tab('show');
                            return false;
                        }
                    });
                }
                if (form1) {
                    $(".loader").show();
                    $('#guardar_datos').attr("disabled", true);
                    $.ajax({
                        type: "POST",
                        url: "../controllers/create_grupo.php",
                        data: parametros,
                        success: function (msg) {
                            var datos = jQuery.parseJSON(msg);
                            if (datos.error == 0) {
                                $(".divError").removeClass("bg-danger");
                                $(".divError").addClass("bg-success");
                                $(".divError").html(datos.msg);
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            } else {
                                $(".divError").removeClass("bg-success");
                                $(".divError").addClass("bg-danger");
                                $(".divError").html(datos.msg);
                                $(".loader").hide();
                                setTimeout(function () {
                                    $(".divError").hide();
                                }, 3000);
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
                            $(".divError").addClass("bg-danger");
                            $(".divError").html(cadErr);
                            setTimeout(function () {
                                $(".divError").hide();
                            }, 3000);
                        }
                    });
                    event.preventDefault();
                }
            })
        </script>

        <script>
            var form2 = $("#formUpdGroup");
            form2.validate({
                ignore: "",
                rules: {
                    inputPE: {required: true},
                    inputName: {required: true, maxlength: 9},
                    inputGrado: {required: true},
                    inputTurno: {required: true}
                },
                messages: {
                    inputPE: {
                        required: "Plan de Estudios obligatorio"
                    },
                    inputName: {
                        required: "Nombre del plan, obligatorio",
                        maxlength: "Máximo 9 caracteres"
                    },
                    inputGrado: {
                        required: "Grado obligatorio"
                    },
                    inputTurno: {
                        required: "Turno obligatorio"
                    },
                },
                errorPlacement: function (error, element) {
                    error.addClass("help-block");
                    element.parents(".col-sm-9").addClass("has-feedback");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                    if (!element.next("span")[ 0 ]) {
                        $("<span class='glyphicon glyphicon-remove form-control-feedback'></span>").insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).parents(".col-sm-9").addClass("has-error").removeClass("has-success");
                    $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).parents(".col-sm-9").addClass("has-success").removeClass("has-error");
                    $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
                }
            });
            $("#formUpdGroup").submit(function (event) {
                var form2 = $(this).valid();
                var parametros = $(this).serialize();
                if (this.hasChildNodes('.nav.nav-tabs')) {
                    var validator = $(this).validate();
                    $(this).find("input").each(function () {
                        if (!validator.element(this)) {
                            form2 = false;
                            $('a[href=\\#' + $(this).closest('.tab-pane:not(.active)').attr('id') + ']').tab('show');
                            return false;
                        }
                    });
                }
                if (form2) {
                    $(".loader").show();
                    $('#guardar_datos').attr("disabled", true);
                    $.ajax({
                        type: "POST",
                        url: "../controllers/update_grupos.php",
                        data: parametros,
                        success: function (msg) {
                            console.log(msg);
                            var datos = jQuery.parseJSON(msg);
                            if (datos.error == 0) {
                                $(".loader").hide();
                                $(".divError").removeClass("bg-danger");
                                $(".divError").addClass("bg-success");
                                $(".divError").html(datos.msg);
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            } else {
                                $(".loader").hide();
                                $(".divError").removeClass("bg-success");
                                $(".divError").addClass("bg-danger");
                                $(".divError").html(datos.msg);
                                setTimeout(function () {
                                    $(".divError").hide();
                                }, 3000);
                            }
                        },
                        error: function (x, e) {
                            $(".loader").hide();
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
                            $(".divError").addClass("bg-danger");
                            $(".divError").html(cadErr);
                            setTimeout(function () {
                                $(".divError").hide();
                            }, 3000);
                        }
                    });
                    event.preventDefault();
                }
            })
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
