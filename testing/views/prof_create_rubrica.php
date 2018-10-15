<?php require('header.php'); ?>

<title><?= $tit; ?></title>
<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
<meta name="description" content="Descripción de la página" />
<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />

</head>
<body class="hold-transition skin-blue sidebar-mini">

    <?php require('navbar.php'); ?>

    <?php
    if (isset($_SESSION['sessU']) AND $_SESSION['userPerfil'] == 3) {
        $idUser = $_SESSION['userId'];
        $idGMatProf = $_GET['idGMatProf'];
        $idGrupo = $_GET['idGrupo'];
        $idPeriodo = $_GET['idPeriodo'];
        $idPeriodoFecha = $_GET['idPeriodoFecha'];
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <form id="formCalifRub" name="formCalifRub">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-3">
                            <div class="input-group">
                                Selecciona la rubrica a Evaluar: 
                                <select class="form-control" id="inputRubricas" name="inputRubricas"></select>
                            </div>
                        </div>
                        <div class="col-xs-4"></div>
                        <div class="col-xs-5 ">
                            <div class="btn-group pull-right">

                            </div>
                        </div>
                    </div>

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Alumnos a evaluar</h3>
                                    <div class="divError"></div>
                                </div>
                                <div class="box-body">
                                    <div class="table table-condensed table-hover table-striped">
                                        <table class="table table-striped table-bordered" id="data">
                                            <thead>
                                                <tr>
                                                    <th><span title="grupo">ID</span></th>
                                                    <th><span title="grupo">Nombre</span></th>
                                                    <th><span title="grupo">Calificación</span></th>
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
            </form>
        </div>
        <!-- /.content-wrapper -->

        <?php require('footer.php'); ?>
        <!-- scripts acá -->

        <script>
            $(".loader").hide();
            var ordenar = '';
            $(document).ready(function () {
                //filtrar();
                
                $.ajax({
                    type: "POST",
                    data: {idPeriodo: <?=$idPeriodo;?>, idGMatProf: <?=$idGMatProf; ?>},
                    url: "../controllers/get_rubricas_info.php",
                    success: function(msg){
                        console.log(msg);
                        var msg = jQuery.parseJSON(msg);
                        $(".content-header #inputRubricas").html("<option></option>");
                        if(msg.error == 0){
                            $.each(msg.dataRes, function (i, item) {
                                $(".content-header #inputRubricas").append($('<option>', {
                                    value: msg.dataRes[i].id,
                                    text: msg.dataRes[i].nombre
                                }));
                            });
                            //Si salio correcto cargamos los alumnos
                            $.ajax({
                                type: "POST",
                                data: {idGrupo: <?= $idGrupo; ?>},
                                url: "../controllers/get_grupos_alumnos.php",
                                success: function(msg2){
                                    console.log(msg2);
                                    var msg2 = jQuery.parseJSON(msg2);
                                    if (msg2.error == 0) {
                                        $("#data tbody").html("");
                                        $.each(msg2.dataRes, function (i, item){
                                            var newRow = '<tr>'
                                                + '<td>' + msg2.dataRes[i].idStudent + '</td>'
                                                + '<td>' + msg2.dataRes[i].nameStudent + '</td>'
                                                + '<td><input type="number" id="inputCalif" name="inputCalif[]" class="form-control" min="0" max="10" value="10"></td>';
                                            $(newRow).appendTo("#data tbody");
                                        });
                                    }else{
                                        var newRow = '<tr><td colspan="3">' + msg2.msgErr + '</td></tr>';
                                        $("#data tbody").html(newRow);
                                    }
                                }
                            });
                        }else{
                            $(".content-header #inputRubricas").html(msg.msgErr);
                        }
                    }
                });
                
                $(".content-wrapper").on('change', '#inputRubricas', function(){
                    var idRubrica = $(this).val();
                    console.log(idRubrica);
                });
                
                function filtrar() {
                    $(".loader").show();
                    $.ajax({
                        type: "POST",
                        data: {tarea: "periodo", idPeriodo: <?=$idPeriodo;?>, orderby: ordenar},
                        url: "../controllers/get_periodos_fechas.php",
                        success: function (msg) {
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if (msg.error == 0) {
                                $("#data tbody").html("");
                                $.each(msg.dataRes, function (i, item) {
                                    var newRow = '<tr>'
                                            + '<td>' + (i+1) + '</td>'
                                            + '<td>' + msg.dataRes[i].fInicio + '</td>'
                                            + '<td>' + msg.dataRes[i].fFin + '</td>'
                                            + '<td><div class="btn-group pull-right dropdown">'
                                            + '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" >Acciones <span class="fa fa-caret-down"></span></button>'
                                            + '<ul class="dropdown-menu">'
                                            + '<li><a href="#" data-toggle="modal" data-target="#modalViewRub" id="verRubrica" data-value="'+msg.dataRes[i].id+'"><i class="fa fa-eye"></i> Ver Rubricas</a></li>'
                                            + '<li><a href="prof_create_rubrica.php?idGMatProf='+<?=$idGMatProf;?>
                                                + '&idGrupo=' + <?=$idGrupo;?> + '&idPeriodo=' + <?=$idPeriodo;?> + '&idPeriodoFecha='
                                                + msg.dataRes[i].id + '"><i class="fa fa-check"></i> Evaluar Rubrica</a></li>'
                                            + '<li><a href="#"><i class="fa fa-edit"></i> Modificar Rubrica</a></li>'
                                            + '<li><a href="#"><i class="fa fa-hourglass-end"></i> Terminar periodo</a></li>'
                                            + '<li><a href="#"><i class="fa fa-eye"></i> Ver calificaciones</a></li>'
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