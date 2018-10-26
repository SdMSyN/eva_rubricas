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
                            
                        </div>
                    </div>
                </div>
                
                <!-- modal ver rubricas -->
                <div class="modal fade" id="modalViewRub" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Ver Rubricas</h4>
                                <p class="divError"></p>
                            </div>
                            <div class="modal-body">
                                <div class="row text-center buttonAddRub">
                                    
                                </div>
                                <br>
                                <table class="table table-striped rubricasInfo">
                                    <thead>
                                        <tr><th>Nombre</th><th>Actualizar</th><th>Eliminar</th></tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div><!-- ./modal-body -->
                        </div><!-- ./modal-content -->
                    </div><!-- ./modal-dialog -->
                </div><!-- ./modal fade -->
                <!-- fin modal -->
                
                <!-- modal añadir rubricas -->
                <form class="form-horizontal" id="formAddRub" name="formAddRub">
                    <div class="modal fade" id="modalAddRub" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Añadir Rubrica</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <input type="text" id="inputIdPeriodo" name="inputIdPeriodo" >
                                    <input type="text" id="inputIdGMatProf" name="inputIdGMatProf" >
                                    <div class="form-group">
                                        <label for="inputMat" class="col-sm-3 control-label">Rubrica: </label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="inputName" name="inputName" required>
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
                </form><!-- ./form -->
                <!-- fin modal -->
                
                <!-- modal actualizar rubricas -->
                <form class="form-horizontal" id="formUpdRub" name="formUpdRub">
                    <div class="modal fade" id="modalUpdRub" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Actualizar Rubrica</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <input type="text" id="inputIdRubrica" name="inputIdRubrica" >
                                    <div class="form-group">
                                        <label for="inputMat" class="col-sm-3 control-label">Rubrica: </label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="inputName" name="inputName" required>
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
                </form><!-- ./form -->
                <!-- fin modal -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Periodos de la materia: NOMBRE</h3>
                                <div class="divError"></div>
                            </div>
                            <div class="box-body">
                                <div class="table table-condensed table-hover table-striped">
                                    <table class="table table-striped table-bordered" id="data">
                                        <thead>
                                            <tr>
                                                <th><span title="grupo">Periodo</span></th>
                                                <th><span title="grupo">Inicio</span></th>
                                                <th><span title="grupo">Cierre</span></th>
                                                <th><span title="grupo">Acciones</span></th>
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
                                                + '&idGrupo=' + <?=$idGrupo;?> + '&idPeriodo=' + <?=$idPeriodo;?> 
                                                + '&idPeriodoFecha=' + msg.dataRes[i].id + '"><i class="fa fa-check"></i> Evaluar Rubrica</a></li>'
                                            + '<li><a href="prof_update_rubrica.php?idGMatProf='+<?=$idGMatProf;?>
                                                + '&idGrupo=' + <?=$idGrupo;?> + '&idPeriodo=' + <?=$idPeriodo;?> 
                                                + '&idPeriodoFecha=' + msg.dataRes[i].id + '"><i class="fa fa-edit"></i> Modificar Rubrica</a></li>'
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
                
                //Cargar rubricas a ventana modal
                $("#data").on("click", "#verRubrica", function(){
                    var idPeriodo = $(this).data("value");
                    //$("#modalViewMats #addMat .buttonAddMat").data("whatever", idGrupo);
                    $("#modalViewRub .buttonAddRub").html('<button type="button" class="btn btn-danger" id="addRub" data-toggle="modal" data-target="#modalAddRub" data-whatever="'+idPeriodo+'" >Crear Rubrica</button>');
                    console.log(idPeriodo);
                    $.ajax({
                        type: "POST",
                        data: {idGMatProf: <?= $idGMatProf; ?>, idPeriodo: idPeriodo},
                        url: "../controllers/get_rubricas_info.php",
                        success: function(msg){
                            var msg = jQuery.parseJSON(msg);
                            $("#modalViewRub .rubricasInfo tbody").html("");
                            if(msg.error == 0){
                                var newRow = '';
                                $.each(msg.dataRes, function(i, item){
                                    newRow += '<tr>';
                                        newRow += '<td>'+msg.dataRes[i].nombre+'</td>';
                                        newRow += '<td>'
                                                +'<button type="button" class="btn btn-primary" id="updRub" data-whatever="'+msg.dataRes[i].id+'" data-grupo="" data-toggle="modal" data-target="#modalUpdRub">'
                                                    +'Actualizar rubrica'
                                                +'</button></td>';
                                        newRow += '<td>'
                                                 +'<button type="button" class="btn btn-danger" id="delReb" value="'+msg.dataRes[i].id+'"><span class="glyphicon glyphicon-remove"></span></button>'
                                                  +'</td>';
                                    newRow += '</tr>';
                                });
                                $(newRow).appendTo("#modalViewRub .rubricasInfo tbody");
                            }else{
                                var newRow = '<tr><td>'+msg.msgErr+'</td></tr>';
                                $(newRow).appendTo("#modalViewRub .rubricasInfo tbody");
                            }
                        }
                    });
                });
                
                //Añadir rubrica a periodo
                $("#modalViewRub").on("click", "#addRub", function(){
                    var idPeriodo = $(this).data("whatever");
                    $("#modalAddRub .modal-body #inputIdPeriodo").val(idPeriodo);
                    $("#modalAddRub .modal-body #inputIdGMatProf").val(<?=$idGMatProf;?>);
                    console.log("hola "+idPeriodo);
                });
                
                //Actualizar rubrica
                $("#modalViewRub").on("click", "#updRub", function(){
                    var idRubrica = $(this).data("whatever");
                    $("#modalUpdRub .modal-body #inputIdRubrica").val(idRubrica);
                    console.log("hola "+idRubrica);
                    $.ajax({
                        type: "POST",
                        data: {idRubrica: idRubrica},
                        url: "../controllers/get_rubricas_info.php",
                        success: function(msg){
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            console.log(msg);
                            $("#modalUpdRub .modal-body #inputName").html("");
                            if(msg.error == 0){
                                $("#modalUpdRub .modal-body #inputName").val(msg.dataRes[0].nombre);
                            }else{
                                $("#modalUpdRub .modal-body #inputName").val(msg.msgErr);
                            }
                        }
                    });
                });
                
                //Añadir rubrica
                $('#formAddRub').validate({
                    rules: {
                        inputName: {required: true},
                    },
                    messages: {
                        inputName: "Nombre obligatorio",
                    },
                    submitHandler: function(form){
                        $.ajax({
                            type: "POST",
                            url: "../controllers/create_rubrica_info.php",
                            data: $('form#formAddRub').serialize(),
                            success: function(msg){
                                console.log(msg);
                                var msg = jQuery.parseJSON(msg);
                                if(msg.error == 0){
                                    $('#modalAddRub .divError').css({color: "#77DD77"});
                                    $('#modalAddRub .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      location.reload();
                                    }, 1500);
                                }else{
                                    $('#modalAddRub .divError').css({color: "#FF0000"});
                                    $('#modalAddRub .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      $('#divError').hide();
                                    }, 1500);
                                }
                            }, error: function(){
                                alert("Error al crear rubrica.");
                            }
                        });
                    }
                }); // end añadir rubrica
                
                //Actualizar rubrica
                $('#formUpdRub').validate({
                    rules: {
                        inputName: {required: true},
                    },
                    messages: {
                        inputName: "Nombre obligatorio",
                    },
                    submitHandler: function(form){
                        $.ajax({
                            type: "POST",
                            url: "../controllers/update_rubrica_info.php",
                            data: $('form#formUpdRub').serialize(),
                            success: function(msg){
                                console.log(msg);
                                var msg = jQuery.parseJSON(msg);
                                if(msg.error == 0){
                                    $('#modalUpdRub .modal-header .divError').css({color: "#77DD77"});
                                    $('#modalUpdRub .modal-header .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      location.reload();
                                    }, 1500);
                                }else{
                                    $('#modalUpdRub .modal-header .divError').css({color: "#FF0000"});
                                    $('#modalUpdRub .modal-header .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      $('#divError').hide();
                                    }, 1500);
                                }
                            }, error: function(){
                                alert("Error al actualizar rubrica.");
                            }
                        });
                    }
                }); // end añadir rubrica
                
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