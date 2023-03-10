<?php 
    include("valida.php");
    session_start();
    $consultaAlunos = "SELECT * from alunos";
    $consultaColab = "SELECT * from colaboradores";
    $consultaCursos = "SELECT * from cursos";
    if($_SESSION['Perfil'] == "Afiliado"){
        $consultaAfiliadoAluno = "SELECT * from cursos_afiliados WHERE ID_afiliados = '{$_SESSION['id']}'";
        $conAA = $mysqli->query($consultaAfiliadoAluno) or die($mysqli->error);
    }
    if($_SESSION['Perfil'] == "Franqueado"){
        $consultaFranqueadoAluno = "SELECT * from cursos_franqueados  WHERE ID_franqueador = '{$_SESSION['id']}'";
        $conFA = $mysqli->query($consultaFranqueadoAluno) or die($mysqli->error);
    }
    $conAlunos = $mysqli->query($consultaAlunos) or die($mysqli->error);
    $conAlunos2 = $mysqli->query($consultaAlunos) or die($mysqli->error);
    $conColab = $mysqli->query($consultaColab) or die($mysqli->error);
    $conCursos = $mysqli->query($consultaCursos) or die($mysqli->error);
    if($_SESSION['verifica'] != 2){
        header('Location: ./index.html');
    }
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
    <a href="./admin.php"><img src="img/iconetopo.jpg" id="iconetopo"></a>
        <ul id="mAdmin">
            <li><a href="./admin.php"><i class="bi bi-house"></i>Início</a></li>
            <li style="cursor:pointer;color:rgb(216, 211, 211)"><i class="bi bi-person-badge"></i>Cadastro<i class="bi bi-caret-down"></i>
                    <div id="barras">
                    <?php
                     if($_SESSION['Perfil'] == "Administrador"){
                        echo  " <a href='./curso.php'>Cadastrar Curso</a>";
                    }
                        if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador" ||  $_SESSION['Perfil'] == "Franqueado"){
                            echo  "
                            <a href='./horario.php'>Cadastrar Horários</a>
                            <a href='./alunoHorario.php'>Cadastra Aluno em Horários</a>";
                        }
                    ?>
                    </div>
            </li>
            <li style="cursor:pointer;color:rgb(216, 211, 211)"><i class="bi bi-wrench"></i>Gerencia<i class="bi bi-caret-down"></i>
                    <div id="barras">
                    <?php
                        if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador" ||  $_SESSION['Perfil'] == "Franqueado"){
                            echo  "<a href='./mostrahorario.php'>Horário</a>
                            <a href='./propagandas.php'>Propragandas</a>";
                        }
                        if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador"){
                            echo  "
                            <a href='./mostraCurso.php'>Curso</a>";
                        }
                    ?>
                    </div>
            </li>
            <li style="cursor:pointer;color:rgb(216, 211, 211)"><i class="bi bi-file-bar-graph"></i>Relatórios<i class="bi bi-caret-down"></i>
                        <div id="barras">
                        <?php
                        if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador" ||  $_SESSION['Perfil'] == "Franqueado"){
                            echo  " <a href='./editaClausulas.php'>Contratos</a>
                            <a href='./pagamentos.php'>Pagamentos</a>
                            <a href='./aniversariantes.php'>Aniversariantes</a>
                            <a href='./historico.php'>Históricos</a>";
                        }
                    ?>
                        </div>
            </li>
            <li style="cursor:pointer;color:rgb(216, 211, 211)"><i class="bi bi-gear"></i>Manutenção<i class="bi bi-caret-down"></i>
                    <div id="barras">
                    <?php
                        if($_SESSION['Perfil'] == "Administrador"){
                            echo  "<a href='valida.php?back'>Backup</a>";
                        }
                    ?>
                        <a href="./licenca">Licença</a>
                        <a href="./sat.php">Satisfação</a>
                    </div>
            </li>

            <li><a href="./valida.php?sair=true"><i class="bi bi-escape"></i>Sair</a></li>
        </ul>
        <div>
        <img id="mAdmin2" src="img/menuH.png" onclick="menu()"/>
        <ul id="mAdmin3" style="display:none">
            <li><a href="./admin.php" style="color:black"><i class="bi bi-house"></i>Início</a></li>
            <li style="cursor:pointer;"><i class="bi bi-person-badge"></i>Cadastro<i class="bi bi-caret-down"></i>
                    <div id="barras">
                    <?php
                     if($_SESSION['Perfil'] == "Administrador"){
                        echo  " <a href='./curso.php'>Cadastrar Curso</a>";
                    }
                    if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador" ||  $_SESSION['Perfil'] == "Franqueado"){
                        echo  "
                        <a href='./horario.php'>Cadastrar Horários</a>
                        <a href='./alunoHorario.php'>Cadastra Aluno em Horários</a>";
                    }
                    ?>
                        
                    </div>
            </li>
            <li style="cursor:pointer;"><i class="bi bi-wrench"></i>Gerencia<i class="bi bi-caret-down"></i>
                    <div id="barras">
                    <?php
                        if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador" ||  $_SESSION['Perfil'] == "Franqueado"){
                            echo  "<a href='./mostrahorario.php'>Horário</a>
                            <a href='./propagandas.php'>Propragandas</a>";
                        }
                        if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador"){
                            echo  "
                            <a href='./mostraCurso.php'>Curso</a>";
                        }
                    ?>
                    </div>
            </li>
            <li style="cursor:pointer;"><i class="bi bi-file-bar-graph"></i>Relatórios<i class="bi bi-caret-down"></i>
                        <div id="barras">
                        <?php
                        if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador" ||  $_SESSION['Perfil'] == "Franqueado"){
                            echo  " <a href='./editaClausulas.php'>Contratos</a>
                            <a href='./pagamentos.php'>Pagamentos</a>
                            <a href='./aniversariantes.php'>Aniversariantes</a>
                            <a href='./historico.php'>Históricos</a>";
                        }
                    ?>
                        </div>
            </li>
            <li style="cursor:pointer;"><i class="bi bi-gear"></i>Manutenção<i class="bi bi-caret-down"></i>
                    <div id="barras">
                    <?php
                        if($_SESSION['Perfil'] == "Administrador"){
                            echo  "<a href='valida.php?back'>Backup</a>";
                        }
                    ?>
                        <a href="./licenca">Licença</a>
                        <a href="./sat.php">Satisfação</a>
                    </div>
            </li>

            <li><a href="./valida.php?sair=true" style="color:black"><i class="bi bi-escape"></i>Sair</a></li>
        </ul>
        </div>
    </nav>
        <div class="admin">
            <div id="painel">
                <h2><strong>Administração</strong></h2>
                <!-- <a href="admin.php" class="btn btn-primary btn-sm">Voltar</a> -->
            <div id="func">
                <div id="listaAlunos"  class="listAlunos">
                <div class="cont-header" id="cbcLista">
                    <div style="display:flex;" id="icones">
                    <i class='bi bi-person-fill'></i><h1>Cursando</h1>
                    <i class='bi bi-check2-circle'></i><h1>Concluído</h1>
                    <i class='bi bi-x-square-fill'></i><h1>Cancelado</h1>
                    <i class='bi bi-exclamation-diamond-fill'></i><h1>Bloqueado</h1>
                    </div><hr>
                    <h1>Lista de alunos</h1>
                    <form action="buscarAluno.php" method="POST">
                    <select name='aluno'>
                        <?php
                        if($_SESSION['Perfil'] == "Afiliado"){
                            while($cAA = mysqli_fetch_array($conAA)){
                                $idAluno[] = $cAA['ID_Aluno'];
                            }
                            while($cAlunos = mysqli_fetch_array($conAlunos2)){
                                for($i=0;$i<count($idAluno);$i++){
                                    if($cAlunos['ID_Aluno'] == $idAluno[$i]){
                                        echo "<option id='busca' value='".$cAlunos['ID_Aluno']."'>".$cAlunos['Nome']." - ".$cAlunos['CPF']."</option>";
                                    }
                            } 
                        }
                    }
                        if($_SESSION['Perfil'] == "Franqueado"){
                            while($cFA = mysqli_fetch_array($conFA)){
                                $idAluno[] = $cFA['ID_Aluno'];
                            }  
                            while($cAlunos = mysqli_fetch_array($conAlunos2)){
                                for($i=0;$i<count($idAluno);$i++){
                                    if($cAlunos['ID_Aluno'] == $idAluno[$i]){
                                        echo "<option id='busca' value='".$cAlunos['ID_Aluno']."'>".$cAlunos['Nome']." - ".$cAlunos['CPF']."</option>";
                                    }
                            }                            
                        }
                        }
                        if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador"  || $_SESSION['Perfil'] == "Instrutor"){
                            while($cAlunos = mysqli_fetch_array($conAlunos2)){
                                $colabFranqueado = "SELECT * from cursos_franqueados  WHERE ID_franqueador = '{$_SESSION['idfran']}'";
                                $cFranqueado = $mysqli->query($colabFranqueado) or die($mysqli->error);
                                $idColabFranqueado = [];
                                while($c = mysqli_fetch_array($cFranqueado)){
                                    $idColabFranqueado[] = $c['ID_Aluno'];
                                }
                                for($i=0;$i<count($idColabFranqueado);$i++){
                                    if($idColabFranqueado[$i] == $cAlunos['ID_Aluno']){
                                        echo "<option id='busca' value='".$cAlunos['ID_Aluno']."'>".$cAlunos['Nome']." - ".$cAlunos['CPF']."</option>";
                                    }
                                }
                           
                        }
                    }
                        ?>
                    </select>
                    <input type="submit" class="btn btn-success btn-sm" style="background-color:blue;margin-top:10px;font-size:15px; vertical-align:baseline" name="buscaAluno" value='Buscar'></input>
                    <a href="./admin.php" class="btn btn-success btn-sm" style="background-color:blue;margin:0px;font-size:15px">Voltar</a>
                    <a href="./impalunos.php" class="btn btn-success btn-sm" style="background-color:blue;margin:0px;font-size:15px">Imprimir Alunos</a>
                    </form>
                    <br>
                </div>

                <div class="content" style="overflow-y: scroll;height:500px;display:flex">   
                    <?php
                       $table = '<table class="table table-striped" id="tableAluno">';
                            $table .='<thead>';
                                $table .= '<tr>';
                                   $table .= '<th>ID</th>';
                                   $table .= '<th>Nome</th>';
                                //    $table .= '<th>Responsável</th>';
                                   $table .= '<th class="esconde">CPF</th>';
                                   $table .= '<th class="esconde">Telefone</th>';
                                   $table .= '<th class="esconde">Situação</th>';
                                //    $table .= '<th>CPF</th>';
                                //    $table .= '<th>RG</th>';
                                //    $table .= '<th>CEP</th>';
                                //    $table .= '<th>Estado</th>';
                                //    $table .= '<th>Cidade</th>';
                                //    $table .= '<th>Rua</th>';
                                //    $table .= '<th>Número</th>';
                                //    $table .= '<th>Senha</th>';
                                if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador" || $_SESSION['Perfil'] == "Franqueado"){
                                    $table .= '<th>Funções</th>';
                                    $table .= '<th>Curso/Horários</th>';
                                }
                               
                                $table .= '</tr>';
                            $table .= '</thead>';
                            $table .= '<tbody>';
           
                                while($cAlunos = mysqli_fetch_array($conAlunos)){
                                    
                                        if($_SESSION['Perfil'] == "Afiliado"){
                                            while($cAA = mysqli_fetch_array($conAA)){
                                                $idAluno[] = $cAA['ID_Aluno'];
                                            }
                                            for($i=0;$i<count($idAluno);$i++){
                                                if($idAluno[$i] == $cAlunos['ID_Aluno']){
                                                $table .= "<tr class='alunoBusca'  name=".$cAlunos['ID_Aluno'].">";
                                                $table .= "<td>{$cAlunos['ID_Aluno']}</td>";
                                                $table .= "<td>{$cAlunos['Nome']}</td>";
                                                $table .= "<td class='esconde'>{$cAlunos['CPF']}</td>";
                                                $table .= "<td class='esconde'>{$cAlunos['Telefone']}</td>";
                                                if($cAlunos['Status'] == 1){
                                                    $table .= "<td class='esconde'><i class='bi bi-person-fill'></i></td>";
                                                }
                                                if($cAlunos['Status'] == 2){
                                                    $table .= "<td class='esconde'><i class='bi bi-check2-circle'></i></td>";
                                                }
                                                if($cAlunos['Status'] == 3){
                                                    $table .= "<td class='esconde'><i class='bi bi-x-square-fill'></i></td>";
                                                }
                                                if($cAlunos['Status'] == 4){
                                                    $table .= "<td class='esconde'><i class='bi bi-exclamation-diamond-fill'></i></td>";
                                                }
                                                if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador" || $_SESSION['Perfil'] == "Franqueado"){
                                                    $table .= "<td><a href='editarAluno.php?alunoid=".$cAlunos['ID_Aluno']."' style='background-color:blue;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' value='".$cAlunos['ID_Aluno']."'>Editar</a><a href='mostrarAluno.php?alunoid=".$cAlunos['ID_Aluno']."' style='background-color:blue;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' value='".$cAlunos['ID_Aluno']."'>Mostrar</a></td>";
                                                    $table .= "<td><a style='background-color:green;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' href='cursoAluno.php?alunoid=".$cAlunos['ID_Aluno']."&&nome=".$cAlunos['Nome']."' style = 'margin:10px;font-size:15px;' 'value='".$cAlunos['ID_Aluno']."'>Adicionar</a>
                                                    <a style='background-color:red;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' href='deletar.php?alunoid=".$cAlunos['ID_Aluno']."&&nome=".$cAlunos['Nome']."' style = 'margin:10px;font-size:15px;' 'value='".$cAlunos['ID_Aluno']."'>Deletar</a></td>";
                                                }
                                               
                                                $table .= '</tr>';
                                                }
                                               } 
                                        
                                    }
                                        if($_SESSION['Perfil'] == "Franqueado"){
                                            while($cFA = mysqli_fetch_array($conFA)){
                                                $idAluno[] = $cFA['ID_Aluno'];
                                            }  
                                           for($i=0;$i<count($idAluno);$i++){
                                            if($idAluno[$i] == $cAlunos['ID_Aluno']){
                                                $table .= "<tr class='alunoBusca'  name=".$cAlunos['ID_Aluno'].">";
                                            $table .= "<td>{$cAlunos['ID_Aluno']}</td>";
                                            $table .= "<td>{$cAlunos['Nome']}</td>";
                                            $table .= "<td class='esconde'>{$cAlunos['CPF']}</td>";
                                            $table .= "<td class='esconde'>{$cAlunos['Telefone']}</td>";
                                            if($cAlunos['Status'] == 1){
                                                $table .= "<td class='esconde'><i class='bi bi-person-fill'></i></td>";
                                            }
                                            if($cAlunos['Status'] == 2){
                                                $table .= "<td class='esconde'><i class='bi bi-check2-circle'></i></td>";
                                            }
                                            if($cAlunos['Status'] == 3){
                                                $table .= "<td class='esconde'><i class='bi bi-x-square-fill'></i></td>";
                                            }
                                            if($cAlunos['Status'] == 4){
                                                $table .= "<td class='esconde'><i class='bi bi-exclamation-diamond-fill'></i></td>";
                                            }
                                            if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador" || $_SESSION['Perfil'] == "Franqueado"){
                                                $table .= "<td><a href='editarAluno.php?alunoid=".$cAlunos['ID_Aluno']."' style='background-color:blue;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' value='".$cAlunos['ID_Aluno']."'>Editar</a><a href='mostrarAluno.php?alunoid=".$cAlunos['ID_Aluno']."' style='background-color:blue;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' value='".$cAlunos['ID_Aluno']."'>Mostrar</a></td>";
                                                $table .= "<td><a style='background-color:green;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' href='cursoAluno.php?alunoid=".$cAlunos['ID_Aluno']."&&nome=".$cAlunos['Nome']."' style = 'margin:10px;font-size:15px;' 'value='".$cAlunos['ID_Aluno']."'>Adicionar</a>
                                                <a style='background-color:red;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' href='deletar.php?alunoid=".$cAlunos['ID_Aluno']."&&nome=".$cAlunos['Nome']."' style = 'margin:10px;font-size:15px;' 'value='".$cAlunos['ID_Aluno']."'>Deletar</a></td>";
                                            }
                                           
                                            $table .= '</tr>';
                                            }
                                           }                          

                                        }
                                        if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador" || $_SESSION['Perfil'] == "Instrutor"){
                                            if($_SESSION['idfran'] == 4){
                                                $table .= "<tr class='alunoBusca'  name=".$cAlunos['ID_Aluno'].">";
                                                $table .= "<td>{$cAlunos['ID_Aluno']}</td>";
                                                $table .= "<td>{$cAlunos['Nome']}</td>";
                                                $table .= "<td class='esconde'>{$cAlunos['CPF']}</td>";
                                                $table .= "<td class='esconde'>{$cAlunos['Telefone']}</td>";
                                                if($cAlunos['Status'] == 1){
                                                    $table .= "<td class='esconde'><i class='bi bi-person-fill'></i></td>";
                                                }
                                                if($cAlunos['Status'] == 2){
                                                    $table .= "<td class='esconde'><i class='bi bi-check2-circle'></i></td>";
                                                }
                                                if($cAlunos['Status'] == 3){
                                                    $table .= "<td class='esconde'><i class='bi bi-x-square-fill'></i></td>";
                                                }
                                                if($cAlunos['Status'] == 4){
                                                    $table .= "<td class='esconde'><i class='bi bi-exclamation-diamond-fill'></i></td>";
                                                }
                                                if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador" || $_SESSION['Perfil'] == "Franqueado"){
                                                    $table .= "<td><a href='editarAluno.php?alunoid=".$cAlunos['ID_Aluno']."' style='background-color:blue;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' value='".$cAlunos['ID_Aluno']."'>Editar</a><a href='mostrarAluno.php?alunoid=".$cAlunos['ID_Aluno']."' style='background-color:blue;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' value='".$cAlunos['ID_Aluno']."'>Mostrar</a></td>";
                                                    $table .= "<td><a style='background-color:green;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' href='cursoAluno.php?alunoid=".$cAlunos['ID_Aluno']."&&nome=".$cAlunos['Nome']."' style = 'margin:10px;font-size:15px;' 'value='".$cAlunos['ID_Aluno']."'>Adicionar</a>
                                                    <a style='background-color:red;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' href='deletar.php?alunoid=".$cAlunos['ID_Aluno']."&&nome=".$cAlunos['Nome']."' style = 'margin:10px;font-size:15px;' 'value='".$cAlunos['ID_Aluno']."'>Deletar</a></td>";
                                                }
                                               
                                                $table .= '</tr>';
                                            }
                                            else{
                                                $colabFran = "SELECT * from cursos_franqueados  WHERE ID_franqueador = '{$_SESSION['idfran']}'";
                                                $cFran = $mysqli->query($colabFran) or die($mysqli->error);
                                                $idColabFran = [];
                                                while($c = mysqli_fetch_array($cFran)){
                                                    $idColabFran[] = $c['ID_Aluno'];
                                                }
                                                for($i=0;$i<count($idColabFran);$i++){
                                                    if($idColabFran[$i] == $cAlunos['ID_Aluno']){
                                                        $table .= "<tr class='alunoBusca'  name=".$cAlunos['ID_Aluno'].">";
                                                        $table .= "<td>{$cAlunos['ID_Aluno']}</td>";
                                                        $table .= "<td>{$cAlunos['Nome']}</td>";
                                                        $table .= "<td class='esconde'>{$cAlunos['CPF']}</td>";
                                                        $table .= "<td class='esconde'>{$cAlunos['Telefone']}</td>";
                                                        if($cAlunos['Status'] == 1){
                                                            $table .= "<td class='esconde'><i class='bi bi-person-fill'></i></td>";
                                                        }
                                                        if($cAlunos['Status'] == 2){
                                                            $table .= "<td class='esconde'><i class='bi bi-check2-circle'></i></td>";
                                                        }
                                                        if($cAlunos['Status'] == 3){
                                                            $table .= "<td class='esconde'><i class='bi bi-x-square-fill'></i></td>";
                                                        }
                                                        if($cAlunos['Status'] == 4){
                                                            $table .= "<td class='esconde'><i class='bi bi-exclamation-diamond-fill'></i></td>";
                                                        }
                                                        if($_SESSION['Perfil'] == "Administrador" || $_SESSION['Perfil'] == "Coordenador" || $_SESSION['Perfil'] == "Franqueado"){
                                                            $table .= "<td><a href='editarAluno.php?alunoid=".$cAlunos['ID_Aluno']."' style='background-color:blue;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' value='".$cAlunos['ID_Aluno']."'>Editar</a><a href='mostrarAluno.php?alunoid=".$cAlunos['ID_Aluno']."' style='background-color:blue;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' value='".$cAlunos['ID_Aluno']."'>Mostrar</a></td>";
                                                            $table .= "<td><a style='background-color:green;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' href='cursoAluno.php?alunoid=".$cAlunos['ID_Aluno']."&&nome=".$cAlunos['Nome']."' style = 'margin:10px;font-size:15px;' 'value='".$cAlunos['ID_Aluno']."'>Adicionar</a>
                                                            <a style='background-color:red;border:1px solid black;color:white;font-size:15px;margin-top:9px;padding:2.2px' href='deletar.php?alunoid=".$cAlunos['ID_Aluno']."&&nome=".$cAlunos['Nome']."' style = 'margin:10px;font-size:15px;' 'value='".$cAlunos['ID_Aluno']."'>Deletar</a></td>";
                                                        }
                                                       
                                                        $table .= '</tr>';
                                                    }
                                                }
                                            }
                                           
                                        }
                                    }
                        $table .= '</tbody>';
                        $table .= '</table>';
                        echo $table;
                   ?>
                </div>
                </div>
                <hr>
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