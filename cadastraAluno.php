﻿<?php 
    include("validabia.php");
    $consultaAlunos = "SELECT * from alunos";
    $consultaColab = "SELECT * from colaboradores";
    $consultaCursos = "SELECT * from cursos";
    $consultaH = "SELECT * from horarios";
    $conAlunos = $mysqli->query($consultaAlunos) or die($mysqli->error);
    $conColab = $mysqli->query($consultaColab) or die($mysqli->error);
    $conCursos = $mysqli->query($consultaCursos) or die($mysqli->error);
    $conH = $mysqli->query($consultaH) or die($mysqli->error);
    session_start();
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
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
                            echo  " <a href='./contratos.php'>Contratos</a>
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
                            echo  " <a href='./contratos.php'>Contratos</a>
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
            <div id="cadastraAluno">
                    <div class="cont-header">
                    </div>
                    <div class="content">
                        <div id="dadosDoAluno" class="" style="padding:10px;">
                            <h3>Preencha os dados do Aluno</h3>
                            <form method="post" action="valida.php">
                                <input type="hidden" name="_token" value="WmrC6gcNsjkmzVGYVTc9EemXmdDXh5Zavb5ywoMY">
                                <div class="row">
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="nome">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome" placeholder="" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="nome">Responsável</label>
                                        <input type="text" class="form-control" id="resp" name="resp" placeholder="" >
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="nome">Telefone do Responsável </label>
                                        <input type="text" class="form-control" id="respT" name="respT" placeholder="" >
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="nome">CPF do Responsável </label>
                                        <input type="text" class="form-control" id="cpfT" name="CPFT" placeholder="" >
                                    </div>
                                     <div class="form-group col-12 col-lg-6">
                                        <label for="nome">RG do Responsável </label>
                                        <input type="text" class="form-control" id="rgT" name="RGT" placeholder="" >
                                    </div>
                                     <div class="form-group col-12 col-lg-6">
                                        <label for="nasc">Data de Nasc. do Responsável</label>
                                        <input type="date" class="form-control" id="nascimento" name="nascimentoT" placeholder="">
                                    </div>
                                     <div class="form-group col-12 col-lg-6">
                                        <label for="nasc">CEP do Responsável</label>
                                        <input type="text" class="form-control" id="nascimento" name="CEPT" placeholder="">
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="nasc">Data de Nasc.</label>
                                        <input type="date" class="form-control" id="nascimento" name="nascimento" placeholder="">
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="tel">Telefone</label>
                                        <input type="text"class="form-control" id="tel" name="telefone" min="15" placeholder="" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="cpf">CPF</label>
                                        <input type="text" class="form-control" minlenght="14"  maxlenght="20" id="cpf" name="cpf" placeholder="" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="rg">RG</label>
                                        <input type="text" class="form-control" id="rg" name="rg" placeholder="">
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="cep">CEP</label>
                                        <input type="text" class="form-control" id="cep" name="cep" placeholder="">
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="estado">Estado</label>
                                        <input type="text" class="form-control" id="estado" name="estado" placeholder="">
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="cidade">Cidade</label>
                                        <input type="text" class="form-control" id="cidade" name="cidade" placeholder="">
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="rua">Rua</label>
                                        <input type="text" class="form-control" id="rua" name="rua" placeholder="">
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="numero">Número</label>
                                        <input type="text" class="form-control" id="numero" name="numero" placeholder="">
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="complemento">Complemento</label>
                                        <input type="text" class="form-control" id="complemento" name="complemento" placeholder="">
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="senha">Senha</label>
                                        <input type="text" minlength="5" class="form-control" id="senha" name="senha" placeholder="" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="login">Login</label>
                                        <input type="text" minlength="5" class="form-control" id="login" name="login" placeholder="" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="curso">Cursos</label><br>
                                        <?php 
                                            $contcurso= 0;
                                             while($cCursos = mysqli_fetch_array($conCursos)){
                                                echo "<input type='checkbox' class='teste' name='curso".$contcurso."' value='".$cCursos['Preco']."'>".$cCursos['Nome_curso']." - Preço: R$".$cCursos['Preco']."</input><br>";
                                                $contcurso++;
                                            }?>
                                            
                                        <script>
                                           jQuery(function() {
                                                 $(document).ready(function() {
                                                      $('input').change(function() {
                                                            var total = $('input[class="teste"]:checked').get().reduce(function(tot, el) {
                                                            return tot + Number(el.value);
                                                                                    }, 0);
                                                            var input1 = document.querySelector("#matricula");
                                                            var matricula = input1.value;
                                                            var input2 = document.querySelector("#material");
                                                            var material = input2.value;
                                                            var input3 = document.querySelector("#parcelas");
                                                            var parcelas = input3.value;
                                                            var input4 = document.querySelector("#desconto");
                                                            var desconto = input4.value;
                                                    
                                                          var soma = parseFloat(total)+parseFloat(matricula)+parseFloat(material);
                                                          var descontando = (parseFloat(soma))*(parseInt(desconto)/100);
                                                        var comdesconto = parseFloat(soma) - parseFloat(descontando);
                                                        $('#resultado').val(parseFloat(soma));
                                                         $('#comdesconto').val(parseFloat(comdesconto));
                                                           $('#porparcela').val((parseFloat(resultado))/(parseInt(parcelas)));
                                                                 });
                
                                                    
                                                            });
                                                        });
                                        </script>
                                        <?php
                                            $contcurso--;
                                            echo "<input name='contcurso' value='".$contcurso."' style='display:none'/>";
                                             echo "</br>";
                                               echo "Valor da Matrícula(R$) <input style='width:60px;text-align:center;' type='number' id='matricula' name='matricula' value='0.0' /> </br></br>";
                                                  echo "Valor do Material Didático(R$) <input style='width:60px;text-align:center;' type='number' id='material' name='material' value='0.0' /> </br></br>";
                                         echo "Nº de Parcelas <input style='width:60px;text-align:center;' type='number' id='parcelas' name='parcelas' value='0' /> </br></br>";
                                         echo "Desconto(%) <input style='width:60px;text-align:center;' type='number' id='desconto' name='desconto' value='0' /> </br></br>";
                                         echo "Mensagem <input style='width:500px;height:50px;text-align:center;'type='text' id='mensagem' name='mensagem' value='Caso pagamento até o dia 12, desconto de 10%.' /> </br></br>";
                                        ?>
                                   Total (R$)<input type="number" name="total" style='width:60px;text-align:center;' id="resultado" value="0.0"/>
                                      </br>
                                      </br>
                                      Após desconto(R$) <input type="number" name="valor_com_desconto" style='width:60px;text-align:center;' id="comdesconto" value="0.0"/>
                                      </br>
                                      </br>
                                      Valor p/ Parcela (R$) <input type="number" name"parcelado" style='width:60px;text-align:center;' id="porparcela" value="0.0"/>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="curso">Horarios</label><br>
                                       <?php
                                             $conthorario = 0;
                                             $consultaHorario = "SELECT * from horarios";
                                             $conH = $mysqli->query($consultaHorario) or die($mysqli->error);
                                             while($cH = mysqli_fetch_array($conH)){
                                                if($cH['Dia'] == "Segunda-Feira"){
                                                    $hiSegunda [] = $cH['Hora_inicio'];
                                                    $hfSegunda [] = $cH['Hora_fim'];
                                                    $DispoSegunda []=  $cH['maquinas_dispo'] - $cH['maquinas_ocup'];
                                                    $idSegunda [] = $cH['ID_Horario']; 
                                                }
                                                if($cH['Dia'] == "Terça-Feira"){
                                                    $hiT [] = $cH['Hora_inicio'];
                                                    $hfT [] = $cH['Hora_fim'];
                                                    $DispoTerca [] =  $cH['maquinas_dispo'] - $cH['maquinas_ocup'];
                                                    $idT [] = $cH['ID_Horario']; 
                                                }
                                                if($cH['Dia'] == "Quarta-Feira"){
                                                    $hiQuarta [] = $cH['Hora_inicio'];
                                                    $hfQuarta [] = $cH['Hora_fim'];
                                                    $DispoQuarta []=  $cH['maquinas_dispo'] - $cH['maquinas_ocup'];
                                                    $idQuarta [] = $cH['ID_Horario']; 
                                                }
                                                if($cH['Dia'] == "Quinta-Feira"){
                                                    $hiQuinta [] = $cH['Hora_inicio'];
                                                    $hfQuinta [] = $cH['Hora_fim'];
                                                    $DispoQuinta []=  $cH['maquinas_dispo'] - $cH['maquinas_ocup'];
                                                    $idQuinta [] = $cH['ID_Horario']; 
                                                }
                                                if($cH['Dia'] == "Sexta-Feira"){
                                                    $hiSexta [] = $cH['Hora_inicio'];
                                                    $hfSexta [] = $cH['Hora_fim'];
                                                    $DispoSexta []=  $cH['maquinas_dispo'] - $cH['maquinas_ocup'];
                                                    $idSexta [] = $cH['ID_Horario']; 
                                                }
                                                if($cH['Dia'] == "Sabádo"){
                                                    $hiSabado [] = $cH['Hora_inicio'];
                                                    $hfSabado [] = $cH['Hora_fim'];
                                                    $DispoSabado []=  $cH['maquinas_dispo'] - $cH['maquinas_ocup'];
                                                    $idSabado [] = $cH['ID_Horario']; 
                                                }
                                                if($cH['Dia'] == "Domingo"){
                                                    $hiDomingo [] = $cH['Hora_inicio'];
                                                    $hfDomingo [] = $cH['Hora_fim'];
                                                    $DispoDomingo []=  $cH['maquinas_dispo'] - $cH['maquinas_ocup'];
                                                    $idDomingo [] = $cH['ID_Horario']; 
                                                }
                                             }
                                             
                                             echo "<br><p>Segunda</p>";
                                             for($i = 0 ; $i< count($hiSegunda); $i++){
                                                if($DispoSegunda[$i] == 0){
                                                    echo "<input  disabled type='checkbox' value=".$idSegunda[$i]." name='horario".$conthorario."'></input>".$hiSegunda[$i]."-".$hfSegunda[$i]." - Maquinas Disponiveis:".$DispoSegunda[$i]."<br>";
                                                    $conthorario++;
                                                }else{
                                                    echo "<input type='checkbox' value=".$idSegunda[$i]." name='horario".$conthorario."'></input>".$hiSegunda[$i]."-".$hfSegunda[$i]." - Maquinas Disponiveis:".$DispoSegunda[$i]."<br>";
                                                    $conthorario++;
                                                }
                                                }
                                                echo "<br><p>Terça</p>";
                                                for($i = 0 ; $i< count($hiT); $i++){
                                                    if($DispoTerca[$i] == 0){
                                                        echo "<input disabled type='checkbox' value=".$idT[$i]." name='horario".$conthorario."'></input>".$hiT[$i]."-".$hfT[$i]." - Maquinas Disponiveis:".$DispoTerca[$i]."<br>";
                                                        $conthorario++;
                                                    }else{
                                                        echo "<input  type='checkbox' value=".$idT[$i]." name='horario".$conthorario."'></input>".$hiT[$i]."-".$hfT[$i]." - Maquinas Disponiveis:".$DispoTerca[$i]."<br>";
                                                        $conthorario++;
                                                    }
                                                   
                                                }
                                                echo "<br><p>Quarta</p>";
                                                for($i = 0 ; $i< count($hiQuarta); $i++){
                                                    if($DispoQuarta[$i] == 0 ){
                                                        echo "<input disabled type='checkbox' value=".$idQuarta[$i]." name='horario".$conthorario."'></input>".$hiQuarta[$i]."-".$hfQuarta[$i]." - Maquinas Disponiveis:".$DispoQuarta[$i]."<br>";
                                                        $conthorario++;
                                                    }else{
                                                        echo "<input type='checkbox' value=".$idQuarta[$i]." name='horario".$conthorario."'></input>".$hiQuarta[$i]."-".$hfQuarta[$i]." - Maquinas Disponiveis:".$DispoQuarta[$i]."<br>";
                                                        $conthorario++;
                                                    }             
                                                }
                                                echo "<br><p>Quinta</p>";
                                                for($i = 0 ; $i< count($hiQuinta); $i++){
                                                    if($DispoQuinta[$i] == 0){
                                                        echo "<input disabled type='checkbox' value=".$idQuinta[$i]." name='horario".$conthorario."'></input>".$hiQuinta[$i]."-".$hfQuinta[$i]." - Maquinas Disponiveis:".$DispoQuinta[$i]."<br>";
                                                        $conthorario++;
                                                    }else{
                                                        echo "<input type='checkbox' value=".$idQuinta[$i]." name='horario".$conthorario."'></input>".$hiQuinta[$i]."-".$hfQuinta[$i]." - Maquinas Disponiveis:".$DispoQuinta[$i]."<br>";
                                                        $conthorario++;
                                                    } 
                                                }
                                                echo "<br><p>Sexta</p>";
                                                for($i = 0 ; $i< count($hiSexta); $i++){
                                                    if($DispoSexta[$i] == 0){
                                                        echo "<input disabled type='checkbox' value=".$idSexta[$i]." name='horario".$conthorario."'></input>".$hiSexta[$i]."-".$hfSexta[$i]." - Maquinas Disponiveis:".$DispoSexta[$i]."<br>";
                                                        $conthorario++;
                                                    }else{
                                                        echo "<input type='checkbox' value=".$idSexta[$i]." name='horario".$conthorario."'></input>".$hiSexta[$i]."-".$hfSexta[$i]." - Maquinas Disponiveis:".$DispoSexta[$i]."<br>";
                                                        $conthorario++;
                                                    } 
                                                }
                                                echo "<br><p>Sabádo</p>";
                                                for($i = 0 ; $i< count($hiSabado); $i++){
                                                    if($DispoSabado[$i] == 0){
                                                        echo "<input disabled type='checkbox' value=".$idSabado[$i]." name='horario".$conthorario."'></input>".$hiSabado[$i]."-".$hfSabado[$i]." - Maquinas Disponiveis:".$DispoSabado[$i]."<br>";
                                                        $conthorario++;
                                                    }else{
                                                        echo "<input type='checkbox' value=".$idSabado[$i]." name='horario".$conthorario."'></input>".$hiSabado[$i]."-".$hfSabado[$i]." - Maquinas Disponiveis:".$DispoSabado[$i]."<br>";
                                                        $conthorario++;
                                                    }
                                                }
                                                echo "<br><p>Domingo</p>";
                                                for($i = 0 ; $i< count($hiDomingo); $i++){
                                                    if($DispoDomingo[$i] == 0){
                                                        echo "<input disabled type='checkbox' value=".$idDomingo[$i]." name='horario".$conthorario."'></input>".$hiDomingo[$i]."-".$hfDomingo[$i]." - Maquinas Disponiveis:".$DispoDomingo[$i]."<br>";
                                                        $conthorario++;
                                                    }else{
                                                        echo "<input type='checkbox' value=".$idDomingo[$i]." name='horario".$conthorario."'></input>".$hiDomingo[$i]."-".$hfDomingo[$i]." - Maquinas Disponiveis:".$DispoDomingo[$i]."<br>";
                                                        $conthorario++;
                                                    }
                                                   
                                                }
                                                echo "<input type='number' value='".$conthorario."' name='conthorario' style='display:none'></input>";
                                                
                                            ?>
                                      <div>
                                        <label>O aluno está associado a qual Afiliado/Franqueado?</label><br>
                                        <input type="radio" name="perfil" value="afiliado" required>Afiliado</input>
                                        <input type="radio" name="perfil" value="franqueado">Franqueado</input>
                                        <?php
                                        $afiliados = "SELECT * FROM afiliados";
                                        $franqueados = "SELECT * FROM franqueados";
                                        $afi = $mysqli->query($afiliados) or die($mysqli->error);
                                        $fran = $mysqli->query($franqueados) or die($mysqli->error);
                                        echo "<br><label>Afiliados</label><br><select name='afiliados'>";
                                        while($a = mysqli_fetch_array($afi)){
                                            echo "<option value='".$a['ID_afiliados']."'>".$a['Nome']." - ".$a['Login']."</option>";
                                        }
                                        echo "</select>";
                                        echo "<br><label>Franqueado</label><br><select name='franqueados'>";
                                        while($f = mysqli_fetch_array($fran)){
                                            echo "<option value='".$f['ID_franqueados']."'>".$f['Nome']." - ".$f['Login']."</option>";
                                        }
                                        echo "</select>";
                                        ?>
                                      </div>
                                    </div>
                                </div>
<!-- q -->
                <!--BOTOES AO FIM DA SESSÃO-->
                                <div class="d-flex justify-content-center">
                                <a  href="./admin.php" class="btn btn-success mr-2" style="display:flex;background-color:blue;width:70px;height:40px;font-size:16px;color:white;">Voltar</a>

                                <input class="btn btn-success mr-2" type="submit" value="Enviar" name="cadastraAluno2">
                                </div>
                
            
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