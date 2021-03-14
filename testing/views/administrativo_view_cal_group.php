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
        $idUser = $_SESSION['userId'];
        $idGrupo = $_GET['idGrupo'];
        $idPerInfo = $_GET['idPerInfo'];
    ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <form id="formCalifRub" name="formCalifRub">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="row">
                        <div class="col-xs-4">
                            <input type="hidden" id="inputIdPeriodo" name="inputIdPeriodo" >
                            <label for="inputRubricas">Selecciona el periodo a visualizar:</label>
                            <select class="form-control" id="inputPeriodo" name="inputPeriodo"></select>
                        </div>
                    </div>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Alumnos</h3>
                                    <div class="divError"></div>
                                </div>
                                <div class="box-body">
                                    <div class="table table-condensed table-hover table-striped">
                                        <table class="table table-striped table-bordered" id="data">
                                            <thead>
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
                
                //Obtenemos los periodos 
                $.ajax({
                    type: "POST",
                    data: {idGrupo: <?=$idGrupo; ?>, tarea: "periodo", idPeriodo: <?= $idPerInfo; ?>},
                    url: "../controllers/get_periodos_fechas.php",
                    success: function(msg){
                        console.log(msg);
                        var msg = jQuery.parseJSON(msg);
                        $(".content-header #inputPeriodo").html("<option></option>");
                        if(msg.error == 0){
                            $(".content-header #inputPeriodo").append($('<option>', {
                                value: 0,
                                text: "TODOS"
                            }));
                            $.each(msg.dataRes, function (i, item) {
                                $(".content-header #inputPeriodo").append($('<option>', {
                                    value: msg.dataRes[i].id,
                                    text: msg.dataRes[i].fInicio + " a " + msg.dataRes[i].fFin
                                }));
                            });
                        }else{
                            $(".content-header #inputPeriodo").html("<option>"+msg.msgErr+"</option>");
                        }
                    }
                });
                
                $(".content-wrapper").on('change', '#inputPeriodo', function(){
                    var idPerFecha = $(this).val();
                    console.log(idPerFecha);
                    $("#inputIdRubrica").val(idPerFecha);
                    $("#data thead").html("");
                    $("#data tbody").html("");
                    if(idPerFecha == 0){
                        $.ajax({
                            type: "POST",
                            data: {idGrupo: <?= $idGrupo; ?>},
                            url: "../controllers/get_calif_alumnos_mats.php",
                            success: function(msg2){
                                console.log(msg2);
                                msg2 = jQuery.parseJSON(msg2);
                                if(msg2.error == 0){
                                    //Añadimos cabecerás
                                    var newRowTH = '<tr><th>Nombre</th>';
                                    var cantMat = 0;
                                    $.each(msg2.mats, function(i, item){
                                        newRowTH += '<th>' + msg2.mats[i].nameMat + '</th>';
                                        cantMat++;
                                    });
                                    newRowTH += '<th>Promedio</th>';
                                    newRowTH += '</tr>';
                                    $(newRowTH).appendTo("#data thead");
                                    //Añadimos alumnos y sus calificaciones
                                    var newRowTB = '';
                                    var  sumV = 0, promV = 0, cantV = 0, promHV = 0, sumHV = 0;
                                    var matrizCal = new Array();
                                    $.each(msg2.students, function(j, item){
                                        var sumH =0, promH = 0, cantH = 0;
                                        cantV++;
                                        newRowTB += '<tr>'
                                        newRowTB += '<td>' + msg2.students[j].nameStudent + '</td>';
                                        $.each(msg2.mats, function(k, item){
                                            if(j == 0) matrizCal[k] = 0;//Rellenamos primero con ceros la posición inicial
                                            var promMat = parseFloat(msg2.students[j].cals[k].promMat);
                                            promMat = promMat.toFixed(2);
                                            newRowTB += '<td>' + promMat + '</td>';
                                            sumH += parseFloat(msg2.students[j].cals[k].promMat);
                                            cantH++;
                                            matrizCal[k] += parseFloat(msg2.students[j].cals[k].promMat);
                                        })
                                        promH = sumH / cantH;
                                        promH = promH.toFixed(2);
                                        sumHV += parseFloat(promH);
                                        newRowTB += '<td><b>' + promH + '</b></td>';
                                        newRowTB += '</tr>';
                                    });
                                    console.log(matrizCal);
                                    newRowTB += '<tr><td><b>Promedio por materia: </b></td>';
                                    for(var l = 0; l < matrizCal.length; l++){
                                        promV = matrizCal[l] / cantV;
                                        promV = promV.toFixed(2);
                                        newRowTB += '<td><b>' + promV + '</b></td>';
                                    }
                                    promHV = sumHV / cantV;
                                    promHV = promHV.toFixed(2);
                                    newRowTB += '<td><b>'+promHV+'</b></td></tr>';
                                    $(newRowTB).appendTo("#data tbody");
                                }else{
                                    var newRow = '<tr><td colspan="3">' + msg2.msgErr + '</td></tr>';
                                    $("#data thead").html(newRow);
                                }
                            }
                        });
                    }else{
                        //Si salio correcto cargamos los alumnos y las rubricas
                        $.ajax({
                            type: "POST",
                            data: {idPeriodoFecha: idPerFecha, idGrupo: <?= $idGrupo; ?>},
                            url: "../controllers/get_calif_alumnos_mats.php",
                            success: function(msg2){
                                console.log(msg2);
                                msg2 = jQuery.parseJSON(msg2);
                                if(msg2.error == 0){
                                    //Añadimos cabecerás
                                    var newRowTH = '<tr><th>Nombre</th>';
                                    var cantMat = 0;
                                    $.each(msg2.mats, function(i, item){
                                        newRowTH += '<th>' + msg2.mats[i].nameMat + '</th>';
                                        cantMat++;
                                    });
                                    newRowTH += '<th>Promedio</th>';
                                    newRowTH += '</tr>';
                                    $(newRowTH).appendTo("#data thead");
                                    //Añadimos alumnos y sus calificaciones
                                    var newRowTB = '';
                                    var  sumV = 0, promV = 0, cantV = 0, promHV = 0, sumHV = 0;
                                    var matrizCal = new Array();
                                    $.each(msg2.students, function(j, item){
                                        var sumH =0, promH = 0, cantH = 0;
                                        cantV++;
                                        newRowTB += '<tr>'
                                        newRowTB += '<td>' + msg2.students[j].nameStudent + '</td>';
                                        $.each(msg2.mats, function(k, item){
                                            if(j == 0) matrizCal[k] = 0;//Rellenamos primero con ceros la posición inicial
                                            //var promMat = msg2.students[j].mats[k].promMat;
                                            //console.log(promMat);
                                            if(msg2.students[j].cals[k].promMat == "N/D"){
                                                newRowTB += '<td>N/D</td>';
                                                sumH += 0;
                                                matrizCal[k] += 0;
                                            }else{
                                                newRowTB += '<td>' + msg2.students[j].cals[k].promMat + '</td>';
                                                sumH += parseFloat(msg2.students[j].cals[k].promMat);
                                                matrizCal[k] += parseFloat(msg2.students[j].cals[k].promMat);
                                            }
                                            cantH++;
                                        })
                                        promH = sumH / cantH;
                                        promH = promH.toFixed(2);
                                        sumHV += parseFloat(promH);
                                        newRowTB += '<td><b>' + promH + '</b></td>';
                                        newRowTB += '</tr>';
                                    });
                                    console.log(matrizCal);
                                    newRowTB += '<tr><td><b>Promedio por materia: </b></td>';
                                    for(var l = 0; l < matrizCal.length; l++){
                                        promV = matrizCal[l] / cantV;
                                        promV = promV.toFixed(2);
                                        newRowTB += '<td><b>' + promV + '</b></td>';
                                    }
                                    promHV = sumHV / cantV;
                                    promHV = promHV.toFixed(2);
                                    newRowTB += '<td><b>'+promHV+'</b></td></tr>';
                                    $(newRowTB).appendTo("#data tbody");
                                }else{
                                    var newRow = '<tr><td colspan="3">' + msg2.msgErr + '</td></tr>';
                                    $("#data thead").html(newRow);
                                }
                            }
                        });
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