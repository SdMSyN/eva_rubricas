<?php require('header.php'); ?>

<title><?= $tit; ?></title>
<meta name="author" content="Luigi Pérez Calzada (GianBros)" />
<meta name="description" content="Descripción de la página" />
<meta name="keywords" content="etiqueta1, etiqueta2, etiqueta3" />

</head>
<body class="hold-transition skin-blue sidebar-mini">

    <?php require('navbar.php'); ?>

    <?php
    if (isset($_SESSION['sessU']) AND $_SESSION['userPerfil'] == 2) {
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
                
                <!-- modal ver materias -->
                <div class="modal fade" id="modalViewMats" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Ver materias</h4>
                                <p class="divError"></p>
                            </div>
                            <div class="modal-body">
                                <div class="row text-center buttonAddMat">
                                    
                                </div>
                                <br>
                                <table class="table table-striped matsProfs">
                                    <thead>
                                        <tr><th>Nombre Materia</th><th>Nombre Profesor</th><th>Actualizar</th><th></th></tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div><!-- ./modal-body -->
                        </div><!-- ./modal-content -->
                    </div><!-- ./modal-dialog -->
                </div><!-- ./modal fade -->
                <!-- fin modal -->
                
                <!-- modal asignar materias -->
                <form class="form-horizontal" id="formAddMatProf" name="formUpdGroup">
                    <div class="modal fade" id="modalAddMatProf" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Asignar materia</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <input type="text" id="inputIdGrupo" name="inputIdGrupo" >
                                    <div class="form-group">
                                        <label for="inputMat" class="col-sm-3 control-label">Materia</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="inputMat" name="inputMat" required> </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputProf" class="col-sm-3 control-label">Profesor</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="inputProf" name="inputProf" required> </select>
                                        </div>
                                    </div>
                                </div><!-- ./modal-body -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" id="guardar_datos" class="btn btn-primary">Asignar</button>
                                </div><!-- ./modal-footer -->
                            </div><!-- ./modal-content -->
                        </div><!-- ./modal-dialog -->
                    </div><!-- ./modal fade -->
                </form><!-- ./form -->
                <!-- fin modal -->
                
                <!-- modal actualizar asignación de materias -->
                <form class="form-horizontal" id="formUpdMatProf" name="formUpdGroup">
                    <div class="modal fade" id="modalUpdMatProf" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Actualizar materia</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <input type="text" id="inputIdGrupo" name="inputIdGrupo" >
                                    <input type="text" id="inputIdGMatProf" name="inputIdGMatProf" >
                                    <div class="form-group">
                                        <label for="inputMat" class="col-sm-3 control-label">Materia</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="inputMat" name="inputMat" required> </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputProf" class="col-sm-3 control-label">Profesor</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="inputProf" name="inputProf" required> </select>
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
                                            + '<li id="viewMats" value="'+msg.dataRes[i].id+'" data-toggle="modal" data-target="#modalViewMats"><a href="#" ><i class="fa fa-book "></i> Ver materias</a></li>'
                                            + '<li><a href="#"><i class="fa fa-graduation-cap"></i> Ver alumnos</a></li>';
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
                
                //Cargar materias a ventana modal
                $("#data").on("click", "#viewMats", function(){
                    var idGrupo = $(this).val();
                    //$("#modalViewMats #addMat .buttonAddMat").data("whatever", idGrupo);
                    $("#modalViewMats .buttonAddMat").html('<button type="button" class="btn btn-danger" id="addMat" data-toggle="modal" data-target="#modalAddMatProf" data-whatever="'+idGrupo+'" >Asignar materia</button>');
                    console.log(idGrupo);
                    $.ajax({
                        type: "POST",
                        data: {idGrupo: idGrupo},
                        url: "../controllers/get_grupos_mat_prof.php",
                        success: function(msg){
                            var msg = jQuery.parseJSON(msg);
                            $("#modalViewMats .matsProfs tbody").html("");
                            if(msg.error == 0){
                                var newRow = '';
                                $.each(msg.dataRes, function(i, item){
                                    newRow += '<tr>';
                                        newRow += '<td>'+msg.dataRes[i].materia+'</td>';
                                        newRow += '<td>'+msg.dataRes[i].profesor+'</td>';
                                        newRow += '<td>'
                                                +'<button type="button" class="btn btn-primary" id="updMat" data-whatever="'+msg.dataRes[i].id+'" data-grupo="'+idGrupo+'" data-toggle="modal" data-target="#modalUpdMatProf">'
                                                    +'Actualizar materia'
                                                +'</button></td>';
                                        newRow += '<td>'
                                                 +'<button type="button" class="btn btn-danger" id="delete" value="'+msg.dataRes[i].id+'"><span class="glyphicon glyphicon-remove"></span></button>'
                                                  +'</td>';
                                    newRow += '</tr>';
                                });
                                $(newRow).appendTo("#modalViewMats .matsProfs tbody");
                            }else{
                                var newRow = '<tr><td>'+msg.msgErr+'</td></tr>';
                                $(newRow).appendTo("#modalViewMats .matsProfs tbody");
                            }
                        }
                    });
                });
                
                //Asignar materias
                $("#modalViewMats").on("click", "#addMat", function(){
                    var idGrupo = $(this).data("whatever");
                    $("#modalAddMatProf .modal-body #inputIdGrupo").val(idGrupo);
                    console.log("hola "+idGrupo);
                    $.ajax({
                        type: "POST",
                        data: {idGrupo: idGrupo},
                        url: "../controllers/get_mats_plan_nivel.php",
                        success: function(msg){
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            $("#modalAddMatProf .modal-body #inputMat").html("");
                            if(msg.error == 0){
                                $.each(msg.dataRes, function (i, item) {
                                    $("#modalAddMatProf .modal-body #inputMat").append($('<option>', {
                                        value: msg.dataRes[i].id,
                                        text: msg.dataRes[i].nombre
                                    }));
                                });
                                //Llenamos profesores
                                $.ajax({
                                    type: "POST",
                                    url: "../controllers/get_profesores.php",
                                    success: function(msg){
                                        var msg = jQuery.parseJSON(msg);
                                        $("#modalAddMatProf .modal-body #inputProf").html("");
                                        if(msg.error == 0){
                                            $.each(msg.dataRes, function (i, item) {
                                                $("#modalAddMatProf .modal-body #inputProf").append($('<option>', {
                                                    value: msg.dataRes[i].id,
                                                    text: msg.dataRes[i].nombre
                                                }));
                                            });
                                        }else{
                                            $("#modalAddMatProf .modal-body #inputProf").html(msg.msgErr);
                                        }
                                    }
                                })
                            }else{
                                $("#modalAddMatProf .modal-body #inputMat").html(msg.msgErr);
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
                });
                
                //Actualizar materias
                $("#modalViewMats").on("click", "#updMat", function(){
                    var idGrupo = $(this).data("grupo");
                    var idGMatProf = $(this).data("whatever");
                    $("#modalUpdMatProf .modal-body #inputIdGrupo").val(idGrupo);
                    $("#modalUpdMatProf .modal-body #inputIdGMatProf").val(idGMatProf);
                    console.log("hola "+idGrupo+"-"+idGMatProf);
                    $.ajax({
                        type: "POST",
                        data: {idGrupo: idGrupo},
                        url: "../controllers/get_mats_plan_nivel.php",
                        success: function(msg){
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            $("#modalUpdMatProf .modal-body #inputMat").html("");
                            if(msg.error == 0){
                                $.each(msg.dataRes, function (i, item) {
                                    $("#modalUpdMatProf .modal-body #inputMat").append($('<option>', {
                                        value: msg.dataRes[i].id,
                                        text: msg.dataRes[i].nombre
                                    }));
                                });
                                //Llenamos profesores
                                $.ajax({
                                    type: "POST",
                                    url: "../controllers/get_profesores.php",
                                    success: function(msg){
                                        var msg = jQuery.parseJSON(msg);
                                        $("#modalUpdMatProf .modal-body #inputProf").html("");
                                        if(msg.error == 0){
                                            $.each(msg.dataRes, function (i, item) {
                                                $("#modalUpdMatProf .modal-body #inputProf").append($('<option>', {
                                                    value: msg.dataRes[i].id,
                                                    text: msg.dataRes[i].nombre
                                                }));
                                            });
                                        }else{
                                            $("#modalUpdMatProf .modal-body #inputProf").html(msg.msgErr);
                                        }
                                    }
                                })
                            }else{
                                $("#modalUpdMatProf .modal-body #inputMat").html(msg.msgErr);
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
                });
                
                //Asignar materia y profesor
                $('#formAddMatProf').validate({
                    rules: {
                        inputMat: {required: true},
                        inputProf: {required: true}
                    },
                    messages: {
                        inputMat: "Materia obligatoria",
                        inputProf: "Profesor que impartirá la materia, obligatorio"
                    },
                    submitHandler: function(form){
                        $.ajax({
                            type: "POST",
                            url: "../controllers/create_grupo_mat_prof.php",
                            data: $('form#formAddMatProf').serialize(),
                            success: function(msg){
                                console.log(msg);
                                var msg = jQuery.parseJSON(msg);
                                if(msg.error == 0){
                                    $('.divError').css({color: "#77DD77"});
                                    $('.divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      location.reload();
                                    }, 1500);
                                }else{
                                    $('.divError').css({color: "#FF0000"});
                                    $('.divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      $('#divError').hide();
                                    }, 1500);
                                }
                            }, error: function(){
                                alert("Error al asignar materia al grupo.");
                            }
                        });
                    }
                }); // end añadir nuevo cargo
                
                //Actualizar materia y profesor
                $('#formUpdMatProf').validate({
                    rules: {
                        inputMat: {required: true},
                        inputProf: {required: true}
                    },
                    messages: {
                        inputMat: "Materia obligatoria",
                        inputProf: "Profesor que impartirá la materia, obligatorio"
                    },
                    submitHandler: function(form){
                        $.ajax({
                            type: "POST",
                            url: "../controllers/update_grupo_mat_prof.php",
                            data: $('form#formUpdMatProf').serialize(),
                            success: function(msg){
                                console.log(msg);
                                var msg = jQuery.parseJSON(msg);
                                if(msg.error == 0){
                                    $('#modalUpdMatProf .divError').css({color: "#77DD77"});
                                    $('#modalUpdMatProf .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      location.reload();
                                    }, 1500);
                                }else{
                                    $('#modalUpdMatProf .divError').css({color: "#FF0000"});
                                    $('#modalUpdMatProf .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      $('#divError').hide();
                                    }, 1500);
                                }
                            }, error: function(){
                                alert("Error al actualizar materia al grupo.");
                            }
                        });
                    }
                }); // end añadir nuevo cargo
                    
                //Eliminar materia
                $("#modalViewMats").on("click", "#delete", function(){
                    var idGMatProf = $(this).val();
                    console.log("Hola: "+idGMatProf);
                    if(confirm("¿Seguro que deseas eliminar esta materia? Se borrará la materia y el profesor asignado")){
                        $.ajax({
                             method: "POST",
                             data: {idGMatProf: idGMatProf},
                             url: "../controllers/delete_grupo_mat_prof.php",
                             success: function(data){
                                console.log(data);
                                var msg = jQuery.parseJSON(data);
                                if(msg.error == 0){
                                    setTimeout(function () {
                                      location.reload();
                                    }, 1500);
                                }else{
                                    setTimeout(function () {
                                        
                                    }, 1500);
                                }
                             }
                         })
                    }else{
                        alert("Ten cuidado.");
                    }
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
