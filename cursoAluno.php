<?php 
    include("valida.php");
    $consultaAlunos = "SELECT * from alunos";
    $consultapro = "SELECT * from aluno_curso_progressos";
    $consultaCursos = "SELECT * from cursos";
    $conAlunos = $mysqli->query($consultaAlunos) or die($mysqli->error);
    $conPro = $mysqli->query($consultapro) or die($mysqli->error);
    $conCursos = $mysqli->query($consultaCursos) or die($mysqli->error);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - Topo Treinamentos</title>
    <link rel="sortcut icon" href="img/iconetopo.jpg" type="image/jpg" />

    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/loginNovo.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="js/constroi.js"> </script>
</head>
<body id="adminBody">
    <nav class="menuAdmin">
        <img src="img/iconetopo.jpg">
        <ul>
            <li><a href="./admin.php"><i class="bi bi-house"></i>Início</a></li>
            <li><a href=""><i class="bi bi-person-badge"></i>Cadastro<i class="bi bi-caret-down"></i></a>
                    <div id="barras">
                        <a href="./cadastraAluno.php">Cadastrar Alunos</a>
                        <a href="./listaAlunos.php">Listar alunos</a><hr>
                        <a href="./alunoCurso.php">Cadastrar Aluno em Curso</a>
                        <a href="./cadastraColab.php">Cadastrar Colaboradores</a>
                        <a href="./listaColab.php">Listar Colaboradores</a>
                    </div>
            </li>
            <li><a href=""><i class="bi bi-wrench"></i>Gerencia<i class="bi bi-caret-down"></i></a>
                    <div id="barras">
                        <a href="./pacotes.php">Pacotes</a>
                        <a href="./cursos.php">Cursos</a>
                        <a href="./propagandas.php">Propragandas</a>
                        <a href="./salas.php">Salas</a>
                        <a href="./maquinas.php">Máquinas</a>
                        <a href="./horario.php">Cadastrar Horários</a>
                    </div>
            </li>
            <li><a href=""><i class="bi bi-file-bar-graph"></i>Relatórios<i class="bi bi-caret-down"></i></a>
                        <div id="barras">
                            <a href="./presenca.php">Lista de Presença</a>
                            <a href="./contratos.php">Contratos</a>
                            <a href="./pagamentos.php">Pagamentos</a>
                            <a href="./aniversariantes.php">Aniversariantes</a>
                        </div>
            </li>
            <li><a href=""><i class="bi bi-gear"></i>Manutenção<i class="bi bi-caret-down"></i></a>
                    <div id="barras">
                        <a href="./backup.php">Backup</a>
                        <a href="./licenca">Licença</a>
                        <a href="./sat.php">Satisfação</a>
                    </div>
            </li>
            <li><a href="./index.html"><i class="bi bi-escape"></i>Sair</a></li>
        </ul>
    </nav>
        <div class="admin">
            <div id="painel">
                <h2><strong>Administração</strong></h2>
                <!-- <a href="admin.php" class="btn btn-primary btn-sm">Voltar</a> -->
            <div id="func">
            <div id="listaAlunos" class="listAlunos">
                <div class="cont-header" id="cbcLista">
                    <h1>Cadastre o aluno <?php echo $_GET['nome'] ?> em um Curso ou mais:</h1>
                    <a href="./alunoCurso.php" class="btn btn-success btn-sm" style="background-color:blue;">Voltar</a>
                </div>
                <div class="content">   
                <div class="form-group col-12 col-lg-6">
                    <form action="valida.php" method="POST">
                        <label for="curso">Curso</label>
                            <select id="curso" name="curso">
                                <?php 
                                    while($cPro = mysqli_fetch_array($conPro)){
                                        if($cPro['ID_Aluno'] == $_GET['alunoid']){
                                            $cursoAlunos[] = $cPro['ID_Curso']; 
                                        }
                                    }
                                    while($cCursos = mysqli_fetch_array($conCursos)){
                                        $i2 = 0;
                                        for($i=0;$i<count($cursoAlunos);$i++){
                                            if($cCursos['ID_Curso'] == $cursoAlunos[$i]){
                                                $i2=1;
                                            }
                                        }
                                        if($i2 == 0){
                                            echo "<option value='".$cCursos['ID_Curso']."'>".$cCursos['ID_Curso']." - ".$cCursos['Nome_curso']."</option>";
                                        }      
                                    }
                                ?>      
                                
                            </select>
                            <?php
                            echo "<input class='btn btn-success mr-2' type='submit' value='Enviar' name='alunoCurso'>
                                <input style='display:none' value ='".$_GET['nome']."' name='nome'/>
                                <input style='display:none' value ='".$_GET['alunoid']."' name='alunoid'/>";
                            ?>
                    </form>
                                        
                                        
                </div>
                
                </div>
                </div>

                
               
            </div>
            <div id="func2">
                <div class="func2A">
                    <p>Licença</p>
                    <p style="font-size:80px">00</p>
                    <p>Dias Restantes</p>
                </div>
                <div class="func2A">
                    <p>Alunos Online</p>
                    <p style="font-size:80px">00</p>
                    <p>Alunos</p>
                </div>
                <div class="func2A">
                    <p>Número de Máquinas</p>
                    <p style="font-size:80px">00</p>
                    <p>Máquinas</p>
                </div>
            </div>
        </div> 
</body>
</html>