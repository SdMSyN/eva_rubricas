<?php require('header.php'); ?>

<title><?= $tit; ?></title>
<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
<meta name="description" content="Descripción de la página" />
<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />

</head>
<body class="hold-transition skin-blue sidebar-mini">

    <?php require('navbar.php'); ?>

    <?php
    $action = $_GET['action'];
    $route = $_GET['route'];
    $pln = $_GET['pln'];
    $idTmp = $_GET['id'];
    $idUserTmp = $_GET['idUser'];
    $ban = true;
    if ($action != "viewDetails" || $route != "viewDirection" || $idTmp != 256 || $idUserTmp != 512) {
        $ban = false;
    }
    if (isset($_SESSION['sessU']) AND $_SESSION['userPerfil'] == 1 AND $ban) {
        $pln = substr($_GET['pln'], 2); //ID real del plan de estudios
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
                            <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modalAddMatPlan"><i class="fa fa-plus"></i> Nueva materia </a>
                            <!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Mostrar <span class="caret"></span>
                            </button> -->
                        </div>
                    </div>
                </div>

                <!-- modal añadir nuevo plan de estudios -->
                <form class="form-horizontal" id="formAddMatPlan" name="formAddMatPlan">
                    <div class="modal fade" id="modalAddMatPlan" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Nueva Materia en el Plan de Estudios</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <input type="text" id="inputIdPlanEst" name="inputIdPlanEst" value="<?= $pln; ?>">
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
                <form class="form-horizontal" id="formUpdMatPlanEst" name="formUpdMatPlanEst">
                    <div class="modal fade" id="modalUpdMatPlanEst" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Editar Materia del Plan de Estudios</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <input type="text" id="inputIdMat" name="inputIdMat" >
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">Nombre (Completo)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputName" name="inputName" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputGrado" class="col-sm-3 control-label">Grado</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="inputGrado" name="inputGrado" required></select>
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
                                <h3 class="box-title">Listado de Materias del Plan de Estudio</h3>
                                <div class="divError"></div>
                            </div>
                            <div class="box-body">
                                <div class="table table-condensed table-hover table-striped">
                                    <table class="table table-striped table-bordered" id="data">
                                        <thead>
                                            <tr>
                                                <th><span title="nameMat">Nombre</span></th>
                                                <th><span title="nameGrade">Grado</span></th>
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
                            $("#formAddMatPlan .modal-body #inputGrado").html("");
                            $.each(msg.dataRes, function (i, item) {
                                $("#formAddMatPlan .modal-body #inputGrado").append($('<option>', {
                                    value: msg.dataRes[i].id,
                                    text: msg.dataRes[i].nombre
                                }));
                            });
                            $("#formUpdMatPlanEst .modal-body #inputGrado").html("");
                            $.each(msg.dataRes, function (i, item) {
                                $("#formUpdMatPlanEst .modal-body #inputGrado").append($('<option>', {
                                    value: msg.dataRes[i].id,
                                    text: msg.dataRes[i].nombre
                                }));
                            });
                        } else {
                            $("#formAddMatPlan .modal-body #inputGrado").append($('<option>', {
                                value: 0,
                                text: "No existen grados en tu nivel Escolar"
                            }));
                            $("#formUpdMatPlanEst .modal-body #inputGrado").append($('<option>', {
                                value: 0,
                                text: "No existen grados en tu nivel Escolar"
                            }));
                        }
                    }
                })


                filtrar();
                function filtrar() {
                    $(".loader").show();
                    $.ajax({
                        type: "POST",
                        data: {idPlan: <?= $pln; ?>, orderby: ordenar},
                        url: "../controllers/get_materias_plan_estudio.php",
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if (msg.error == 0) {
                                $("#data tbody").html("");
                                $.each(msg.dataRes, function (i, item) {
                                    var newRow = '<tr>'
                                            + '<td>' + msg.dataRes[i].nombre + '</td>'
                                            + '<td>' + msg.dataRes[i].grado + '</td>'
                                            + '<td><div class="btn-group pull-right dropdown">'
                                            + '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >Acciones <span class="fa fa-caret-down"></span></button>'
                                            + '<ul class="dropdown-menu">'
                                            + '<li><a href="#" data-toggle="modal" data-target="#modalUpdMatPlanEst" id="editar" data-value="' + msg.dataRes[i].id + '"><i class="fa fa-edit"></i> Editar</a></li>'
                                            + '<li><a href="#" id="borrar" data-value="' + msg.dataRes[i].id + '" data-edo="1" ><i class="fa fa-trash"></i> Eliminar</a></li>'
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
                        data: {idPlan: <?= $pln; ?>, orderby: ordenar, query: consulta},
                        url: "../controllers/get_materias_plan_estudio.php",
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if (msg.error == 0) {
                                $("#data tbody").html("");
                                $.each(msg.dataRes, function (i, item) {
                                    var newRow = '<tr>'
                                            + '<td>' + msg.dataRes[i].nombre + '</td>'
                                            + '<td>' + msg.dataRes[i].grado + '</td>'
                                            + '<td><div class="btn-group pull-right dropdown">'
                                            + '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >Acciones <span class="fa fa-caret-down"></span></button>'
                                            + '<ul class="dropdown-menu">'
                                            + '<li><a href="#" data-toggle="modal" data-target="#modalUpdPlanEst" id="editar" data-value="' + msg.dataRes[i].id + '"><i class="fa fa-edit"></i> Editar</a></li>'
                                            + '<li><a href="#" id="borrar" data-value="' + msg.dataRes[i].id + '" data-edo="1" ><i class="fa fa-trash"></i> Dar de baja</a></li>'
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
                    var idMat = $(this).data('value');
                    console.log(idMat);
                    $(".loader").show();
                    $.ajax({
                        type: "POST",
                        url: "../controllers/get_materias_plan_estudio.php",
                        data: {idPlan: <?= $pln; ?>, orderby: ordenar, tarea: 'editar', idMat: idMat},
                        success: function (msg) {
                            console.log(msg);
                            var datos = jQuery.parseJSON(msg);
                            $("#modalUpdMatPlanEst .modal-body #inputIdMat").val(datos.dataRes[0].id);
                            $("#modalUpdMatPlanEst .modal-body #inputName").val(datos.dataRes[0].nombre);
                            $("#modalUpdMatPlanEst .modal-body #inputGrado").val(datos.dataRes[0].grado);
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

                $("#data").on("click", "#borrar", function () {
                    var idMat = $(this).data('value');
                    var idEdo = parseInt($(this).data('edo'));
                    var msgBorrar = '';
                    if (idEdo == 1)
                        msgBorrar = "¿Seguro que deseas eliminar esta materia? Solo puedes eliminarla si no ha sido asignada";
                    if (confirm(msgBorrar)) {
                        $(".loader").show();
                        $.ajax({
                            type: "POST",
                            url: "../controllers/delete_materia_plan_estudios.php",
                            data: {idMat: idMat},
                            success: function (response) {
                                var datos = jQuery.parseJSON(response);
                                if (datos.error == 0) {
                                    $(".loader").hide();
                                    $(".divError").removeClass("bg-danger");
                                    $(".divError").addClass("bg-success");
                                    $(".divError").html(datos.dataRes);
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    $(".loader").hide();
                                    $(".divError").removeClass("bg-success");
                                    $(".divError").addClass("bg-danger");
                                    $(".divError").html(datos.dataRes);
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
                                alert(cadErr);
                                $(".loader").hide();
                            }
                        })
                    } else {
                        alert("Ten cuidado.");
                    }
                });

            });
        </script>

        <script>
            var form1 = $("#formAddMatPlan");
            form1.validate({
                ignore: "",
                rules: {
                    inputName: {required: true, maxlength: 50},
                    inputGrado: {required: true}
                },
                messages: {
                    inputName: {
                        required: "Nombre de la materia, obligatorio",
                        maxlength: "Máximo 50 caracteres"
                    },
                    inputGrado: "Grado obligatorio"
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
            $("#formAddMatPlan").submit(function (event) {
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
                        url: "../controllers/create_materia_plan_estudio.php",
                        data: parametros,
                        success: function (msg) {
                            var datos = jQuery.parseJSON(msg);
                            if (datos.error == 0) {
                                $(".divError").removeClass("bg-danger");
                                $(".divError").addClass("bg-success");
                                $(".divError").html(datos.msg);
                                setTimeout(function () {
                                    location.reload();
                                }, 3000);
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
            var form2 = $("#formUpdMatPlanEst");
            form2.validate({
                ignore: "",
                rules: {
                    inputName: {required: true, maxlength: 25},
                    inputGrado: {required: true}
                },
                messages: {
                    inputName: {
                        required: "Nombre de la materia, obligatorio",
                        maxlength: "Máximo 25 caracteres"
                    },
                    inputGrado: "Grado obligatorio"
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
            $("#formUpdMatPlanEst").submit(function (event) {
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
                        url: "../controllers/update_materia_plan_estudios.php",
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
                                }, 3000);
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
