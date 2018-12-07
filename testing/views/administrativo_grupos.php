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
                            <input class="typeahead form-control" name="q" type="search" autofocus autocomplete="off" id="q">
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
                
                <!-- modal ver Alumnos/Estudiantes -->
                <div class="modal fade" id="modalViewStudents" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Ver alumnos</h4>
                                <p class="divError"></p>
                            </div>
                            <div class="modal-body">
                                <div class="row text-center buttonAddStudent">
                                    
                                </div>
                                <br>
                                <table class="table table-striped students">
                                    <thead>
                                        <tr><th>No.</th><th>Nombre</th><th>Actualizar</th><th>X</th></tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div><!-- ./modal-body -->
                        </div><!-- ./modal-content -->
                    </div><!-- ./modal-dialog -->
                </div><!-- ./modal fade -->
                <!-- fin modal -->
                
                <!-- modal añadir nuevo alumno -->
                <form class="form-horizontal" id="formAddStudent" name="formUpdGroup">
                    <div class="modal fade" id="modalAddStudent" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Añadir Alumno NUEVO</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <input type="text" id="inputIdGrupo" name="inputIdGrupo" >
                                    <div class="form-group">
                                        <label for="inputAP" class="col-sm-3 control-label">Apellido Paterno</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="inputAP" name="inputAP" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAM" class="col-sm-3 control-label">Apellido Materno</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="inputAM" name="inputAM" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">Nombre</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="inputName" name="inputName" >
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
                
                <!-- modal buscar y añadir alumno -->
                <div class="modal fade" id="modalSearchStudent" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Buscar Alumno</h4>
                                <p class="divError"></p>
                            </div>
                            <div class="modal-body">
                                <input type="text" id="inputIdGrupo" name="inputIdGrupo" >
                                <div class="form-group row">
                                    <label for="inputSearchStudent" class="col-sm-2 control-label">Buscar: </label>
                                    <div class="col-sm-9">
                                        <input type="text" id="inputSearchStudent" name="inputSearchStudent" class="form-control searchStudent">
                                    </div> 
                                </div>
                            </div><!-- ./modal-body -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" id="searchStudent" class="btn btn-primary">Añadir</button>
                            </div><!-- ./modal-footer -->
                        </div><!-- ./modal-content -->
                    </div><!-- ./modal-dialog -->
                </div><!-- ./modal fade -->
                <!-- fin modal -->
                
                <!-- modal exportar grupo -->
                <form class="form-horizontal" id="formImportStudent" name="formImportStudent">
                    <div class="modal fade" id="modalImportStudent" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Exportar Alumnos</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <input type="text" id="inputIdGrupo" name="inputIdGrupo" >
                                    <div class="form-group">
                                        <label for="inputFile" for="inputFile" class="col-sm-4 control-label">Archivo CSV 
                                            <a href="#" data-toggle="tooltip" title="Archivo Excel en formato CSV (archivo separado por comas), 3 o 4 campos: Apellido paterno, Apellido Materno, Nombre(s) y Usuario [opcional]">
                                                <span class="glyphicon glyphicon-question-sign"></span>
                                            </a>
                                            <a href="../uploads/plantillaGrupo.csv" data-toggle="tooltip" title="Descargar formato">
                                                <span class="glyphicon glyphicon-download-alt"></span>
                                            </a>
                                            : </label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" id="inputFile" name="inputFile" >
                                        </div>
                                    </div>
                                </div><!-- ./modal-body -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" id="guardar_datos" class="btn btn-primary">Importar</button>
                                </div><!-- ./modal-footer -->
                            </div><!-- ./modal-content -->
                        </div><!-- ./modal-dialog -->
                    </div><!-- ./modal fade -->
                </form><!-- ./form -->
                <!-- fin modal -->
                
                <!-- modal actualizar asignación de materias -->
                <form class="form-horizontal" id="formUpdStudent" name="formUpdStudent">
                    <div class="modal fade" id="modalUpdStudent" tabindex="-1" role="dialog" aria-labellebdy="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Actualizar alumno</h4>
                                    <p class="divError"></p>
                                </div>
                                <div class="modal-body">
                                    <input type="text" id="inputIdStudent" name="inputIdStudent" >
                                    <div class="form-group">
                                        <label for="inputStudent" class="col-sm-3 control-label">Alumno: </label>
                                        <div class="col-sm-9">
                                            <input class="form-control" id="inputStudent" name="inputStudent" >
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
                                            + '<li id="viewStudents" value="'+msg.dataRes[i].id+'" data-toggle="modal" data-target="#modalViewStudents" ><a href="#"><i class="fa fa-graduation-cap"></i> Ver alumnos</a></li>'
                                            + '<li><a href="administrativo_view_cal_group.php?idGrupo='+msg.dataRes[i].id+'&idPerInfo='+msg.dataRes[i].perInfoId+'"><i class="fa fa-eye"></i> Ver Calificaciones</a></li>'
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
                
                //Cargar Alumnos ventana Modal
                $("#data").on("click", "#viewStudents", function(){
                    var idGrupo = $(this).val();
                    //$("#modalViewMats #addMat .buttonAddMat").data("whatever", idGrupo);
                    var buttons = '<div class="row">';
                    buttons += '<div class="col-sm-4"><button type="button" class="btn btn-info" id="addStudent" '
                            +'data-toggle="modal" data-target="#modalAddStudent" data-grupo="'+idGrupo+'" >'
                            +'Añadir Alumno</button></div>';
                    buttons += '<div class="col-sm-4"><button type="button" class="btn btn-info" id="searchStudent" '
                            +'data-toggle="modal" data-target="#modalSearchStudent" data-grupo="'+idGrupo+'" >'
                            +'Buscar y Añadir Alumno</button></div>';
                    buttons += '<div class="col-sm-4"><button type="button" class="btn btn-info" id="importStudent" '
                            +'data-toggle="modal" data-target="#modalImportStudent" data-grupo="'+idGrupo+'" >'
                            +'Importar Alumnos</button></div>';
                    buttons += '</div>';
                    $("#modalViewStudents .buttonAddStudent").html(buttons);
                    console.log(idGrupo);
                    $.ajax({
                        type: "POST",
                        data: {idGrupo: idGrupo},
                        url: "../controllers/get_grupos_alumnos.php",
                        success: function(msg){
                            var msg = jQuery.parseJSON(msg);
                            $("#modalViewStudents .students tbody").html("");
                            if(msg.error == 0){
                                var newRow = '';
                                $.each(msg.dataRes, function(i, item){
                                    newRow += '<tr>';
                                        newRow += '<td>'+(i+1)+'</td>';
                                        newRow += '<td>'+msg.dataRes[i].nameStudent+'</td>';
                                        newRow += '<td>'
                                                +'<button type="button" class="btn btn-primary" id="updStudent" data-whatever="'+msg.dataRes[i].idStudent+'" data-toggle="modal" data-target="#modalUpdStudent">'
                                                    +'Actualizar alumno'
                                                +'</button></td>';
                                        newRow += '<td>'
                                                 +'<button type="button" class="btn btn-danger" id="deleteStudent" value="'+msg.dataRes[i].idStudent+'"><span class="glyphicon glyphicon-remove"></span></button>'
                                                  +'</td>';
                                    newRow += '</tr>';
                                });
                                $(newRow).appendTo("#modalViewStudents .students tbody");
                            }else{
                                var newRow = '<tr><td>'+msg.msgErr+'</td></tr>';
                                $(newRow).appendTo("#modalViewStudents .students tbody");
                            }
                        }
                    });
                });
                
                //Añadir Alumno
                $("#modalViewStudents").on("click", "#addStudent", function(){
                    var idGrupo = $(this).data("grupo");
                    $("#modalAddStudent .modal-body #inputIdGrupo").val(idGrupo);
                    console.log("studiante: "+idGrupo);
                });
                
                //Asignar nuevo alumno
                $('#formAddStudent').validate({
                    rules: {
                        inputAP: {required: true},
                        inputAM: {required: true},
                        inputName: {required: true}
                    },
                    messages: {
                        inputAP: "Apellido paterno obligatoria",
                        inputAM: "Apellido materno obligatoria",
                        inputName: "Nombre obligatorio"
                    },
                    submitHandler: function(form){
                        $.ajax({
                            type: "POST",
                            url: "../controllers/create_student.php",
                            data: $('form#formAddStudent').serialize(),
                            success: function(msg){
                                console.log(msg);
                                var msg = jQuery.parseJSON(msg);
                                if(msg.error == 0){
                                    $('#modalAddStudent .divError').css({color: "#77DD77"});
                                    $('#modalAddStudent .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      location.reload();
                                    }, 1500);
                                }else{
                                    $('#modalAddStudent .divError').css({color: "#FF0000"});
                                    $('#modalAddStudent .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      $('#divError').hide();
                                    }, 1500);
                                }
                            }, error: function(){
                                alert("Error al añadir alumno.");
                            }
                        });
                    }
                }); // end añadir nuevo cargo
                
                //Buscar alumno async                
                var students = new Bloodhound({
                    datumTokenizer: function(datum) {
                      return Bloodhound.tokenizers.whitespace(datum.value);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    remote: {
                        wildcard: '%QUERY',
                        url: '../controllers/search_student.php?query=%QUERY',
                    }
                  });

                // Instantiate the Typeahead UI
                $('#modalSearchStudent .modal-body .searchStudent').typeahead(null, {
                    display: 'name',
                    source: students,
                    limit: 8
                  });

                //Buscar alumno, añadir grupo
                $("#modalViewStudents").on("click", "#searchStudent", function(){
                    var idGrupo = $(this).data("grupo");
                    $("#modalSearchStudent .modal-body #inputIdGrupo").val(idGrupo);
                    console.log("Grupo: "+idGrupo);
                });
                
                //Añadir alumno mediante busqueda
                $("#modalSearchStudent").on("click", "#searchStudent", function(){
                    var queryStudent = $("#modalSearchStudent #inputSearchStudent").val();
                    var idGrupo = $("#modalSearchStudent #inputIdGrupo").val();
                    console.log("Grupo:"+idGrupo+"- Student: "+queryStudent);
                    $.ajax({
                        type: "POST",
                        data: {idGrupo: idGrupo, nameStudent: queryStudent},
                        url: "../controllers/insert_alumno_busqueda.php",
                        success: function(msg){
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            if(msg.error == 0){
                                $('#modalSearchStudent .divError').css({color: "#77DD77"});
                                $('#modalSearchStudent .divError').html(msg.msgErr);
                                setTimeout(function () {
                                  location.reload();
                                }, 1500);
                            }else{
                                $('#modalSearchStudent .divError').show();
                                $('#modalSearchStudent .divError').css({color: "#FF0000"});
                                $('#modalSearchStudent .divError').html(msg.msgErr);
                                setTimeout(function () {
                                  $('#modalSearchStudent .divError').hide();
                                }, 1500);
                            }
                        }
                    });
                })
                
                //Importar alumno, añadir grupo
                $("#modalViewStudents").on("click", "#importStudent", function(){
                    var idGrupo = $(this).data("grupo");
                    $("#modalImportStudent .modal-body #inputIdGrupo").val(idGrupo);
                    console.log("Grupo: "+idGrupo);
                });
                
                //añadir nuevo grupo
                $('#formImportStudent').validate({
                     rules: {
                         inputFile: {required: true, extension: "csv"}
                     },
                     messages: {
                         inputFile: { 
                             required: "Se requiere un archivo",
                             extension: "Solo se permite archivos *.csv (archivo separado por comas de Excel)"
                         }
                     },
                     tooltip_options: {
                         inputFile: {trigger: "focus", placement: "bottom"}
                     },
                     submitHandler: function(form){
                         $('#loading').show();
                         $.ajax({
                             type: "POST",
                             url: "../controllers/import_grupo.php",
                             data: new FormData($("form#formImportStudent")[0]),
                             //data: $('form#formAdd').serialize(),
                             contentType: false,
                             processData: false,
                             success: function(msg){
                                 console.log(msg);
                                 var msg = jQuery.parseJSON(msg);
                                 if(msg.error == 0){
                                     $('#modalImportStudent .divError').css({color: "#77DD77"});
                                     $('#modalImportStudent .divError').html(msg.msgErr);
                                     setTimeout(function () {
                                       location.reload();
                                     }, 1500);
                                 }else{
                                     $('#modalImportStudent .divError').css({color: "#FF0000"});
                                     $('#modalImportStudent .divError').html(msg.msgErr);
                                     setTimeout(function () {
                                       $('#modalImportStudent .divError').hide();
                                     }, 2500);
                                 }
                             }, error: function(){
                                 alert("Error al importar grupo");
                             }
                         });
                     }
                 }); // end añadir nuevo grupo
                
                //Actualizar alumno
                $("#modalViewStudents").on("click", "#updStudent", function(){
                    var idStudent = $(this).data("whatever");
                    $("#modalUpdStudent .modal-body #inputIdStudent").val(idStudent);
                    console.log("Alumno: "+idStudent);
                    $.ajax({
                        type: "POST",
                        data: {idStudent: idStudent},
                        url: "../controllers/get_alumnos.php",
                        success: function(msg){
                            console.log(msg);
                            var msg = jQuery.parseJSON(msg);
                            $("#modalUpdStudent .modal-body #inputMat").html("");
                            if(msg.error == 0){
                                $("#modalUpdStudent .modal-body #inputStudent").val(msg.dataRes[0].nameStudent)
                            }else{
                                $("#modalUpdStudent .modal-body #inputStudent").html(msg.msgErr);
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
                
                //Actualizar alumno validación
                $('#formUpdStudent').validate({
                    rules: {
                        inputStudent: {required: true}
                    },
                    messages: {
                        inputStudent: "Nombre del alumno obligatorio"
                    },
                    submitHandler: function(form){
                        $.ajax({
                            type: "POST",
                            url: "../controllers/update_alumno.php",
                            data: $('form#formUpdStudent').serialize(),
                            success: function(msg){
                                console.log(msg);
                                var msg = jQuery.parseJSON(msg);
                                if(msg.error == 0){
                                    $('#modalUpdStudent .divError').css({color: "#77DD77"});
                                    $('#modalUpdStudent .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      location.reload();
                                    }, 2000);
                                }else{
                                    $('#modalUpdStudent .divError').css({color: "#FF0000"});
                                    $('#modalUpdStudent .divError').html(msg.msgErr);
                                    setTimeout(function () {
                                      $('#modalUpdStudent .divError').hide();
                                    }, 2000);
                                }
                            }, error: function(){
                                alert("Error al actualizar alumno.");
                            }
                        });
                    }
                }); // end añadir nuevo cargo
                
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
