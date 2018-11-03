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
                            <input type="hidden" id="inputIdRubrica" name="inputIdRubrica" >
                            <label for="inputRubricas">Selecciona la rubrica a Evaluar:</label>
                            <select class="form-control" id="inputRubricas" name="inputRubricas"></select>
                        </div>
                        <div class="col-xs-5">
                            <label for="inputNombre">Nombre:</label> 
                            <input class="form-control" id="inputNombre" name="inputNombre" placeholder="Nombre de la rubrica">
                        </div>
                        <div class="col-xs-3">
                            <label for="inputFecha">Fecha:</label> 
                            <input type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?=$dateNow; ?>">
                        </div>
                        <div class="col-xs-1">
                            <label>Terminar</label>
                            <button type="submit" id="guardar_datos" class="btn btn-info">Calificar</button>
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
                
                $.ajax({
                    type: "POST",
                    data: {idPeriodoFecha: <?=$idPeriodoFecha;?>, idGMatProf: <?=$idGMatProf; ?>},
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
                                                + '<td><input type="hidden" id="inputIdAlum" name="inputIdAlum[]" value="'+msg2.dataRes[i].idStudent+'" >'
                                                + msg2.dataRes[i].idStudent + '</td>'
                                                + '<td>' + msg2.dataRes[i].nameStudent + '</td>'
                                                + '<td><input type="number" id="inputCalif" name="inputCalif[]" value="10" style="display: none; " class="form-control inputCalif"></td>';
                                            $(newRow).appendTo("#data tbody");
                                        });
                                    }else{
                                        var newRow = '<tr><td colspan="3">' + msg2.msgErr + '</td></tr>';
                                        $("#data tbody").html(newRow);
                                    }
                                }
                            });
                        }else{
                            $(".content-header #inputRubricas").html("<option>"+msg.msgErr+"</option>");
                        }
                    }
                });
                
                $(".content-wrapper").on('change', '#inputRubricas', function(){
                    var idRubrica = $(this).val();
                    console.log(idRubrica);
                    $("#inputIdRubrica").val(idRubrica);
                    $("#data tbody .inputCalif").css('display', '');
                });
                
                //Añadir rubrica
                $('#formCalifRub').validate({
                    rules: {
                        inputRubricas: {required: true},
                        inputNombre: {required: true},
                        inputFecha: {required: true},
                        'inputCalif[]': {required: true, range: [0, 10], digits: true}
                    },
                    messages: {
                        inputRubricas: "Rubrica a evaluar obligatoria",
                        inputNombre: "Nombre de la rubrica obligatorio",
                        inputFecha: "Fecha de evaluación obligatoria",
                        'inputCalif[]': {
                                required: "Calificación del alumno obligatoria", 
                                range: "Solo números entre 0 y 10", 
                                digits: "Solo se permiten números enteros."
                        }
                    },
                    tooltip_options:{
                        inputRubricas: {trigger: "focus", placement: "bottom"},
                        inputNombre: {trigger: "focus", placement: "bottom"},
                        inputFecha: {trigger: "focus", placement: "bottom"},
                        'inputCalif[]': {trigger: "focus", placement: "bottom"}
                    },
                    submitHandler: function(form){
                        $.ajax({
                            type: "POST",
                            url: "../controllers/create_rubrica_calif.php",
                            data: $('form#formCalifRub').serialize(),
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
                                      $('.divError').hide();
                                    }, 1500);
                                }
                            }, error: function(){
                                alert("Error al calificar rubrica.");
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