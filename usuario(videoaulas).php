<?php
 require_once("validabia.php");
 if(isset($_FILES['imagem'])){
    if(!$_FILES['imagem']['size'] > 0){
        echo "<script>alert('Nenhuma imagem selecianada');</script>";
    }
    if($_FILES['imagem']['size'] > 65000){
        echo "<script>alert('Imagem muito grande');</script>";
    }
    else{
        $extensao = $_FILES['imagem']['name'];
        $ext = pathinfo($extensao, PATHINFO_EXTENSION);
        if($ext == "png" || $ext == "JPG" || $ext == "JPEG"){
            $arquivopng = addslashes(file_get_contents($_FILES['imagem']['tmp_name']));
            if(!isset($_SESSION)){session_start();}
            $query_arquivo = "UPDATE alunos SET imagem = '{$arquivopng}' WHERE ID_Aluno = '{$_SESSION['ID_Aluno']}'";
            $resultado = $mysqli->query($query_arquivo) or die($mysqli->error);
        }
        else{
            echo "<script>alert('Formato invalido');</script>";
        }
       
    }
   
 }
 
 if(!isset($_SESSION)){session_start();}
	if($_SESSION['verifica'] != 1){
        header('Location: ./index.html');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topo Treinamentos</title>
    <link rel="sortcut icon" href="img/iconetopo.jpg" type="image/jpg" />
    <link rel="stylesheet" href="css/loginNovo.css" type="text/css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../../resources/views/css/aluno/layout-aluno.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="js/constroi.js"> </script>
</head>
<!-- CORPO DA PAGINA USUARIO -->

    
<body class="usuario">
    <!-- CABEÇALHO DA PAGINA -->
    <nav id="nav">
        <img style="width:100%; height: 30vh;" src="img/logonav.png">
        
    </nav>
    <div sytle="display:flex;">
    <div id="modal" >   
                
   <div style="float:right;"><a onclick="fecha()" class="close" style="display:flex; cursor:pointer;" ><span aria-hidden='true'>&times;</span></a></div>
                <h5 style="padding-top:15px;"><strong>Selecione uma imagem para o perfil(menor que 50 KB)</strong></h5>
                    <form  method="POST" enctype="multipart/form-data" style="padding-top:15px;" >
		               
                    <input type="file"  name="imagem"/><label for="imagem" id="imgSubmit" style="display: inline-block;">Imagem</label>
		            <input type="submit" id="imgSubmit" style="left:10px" value="Enviar"/>
	                </form>
        </div>
    </div>
    <div id="modalH">   
                
   <div style="float:right;"><a onclick="fechaH()" class="close" style="display:flex; cursor:pointer;" ><span aria-hidden='true'>&times;</span></a></div>
                <h5 style="padding-top:15px;"><strong>Horários</strong></h5>
                <?php
                $consultaha = "SELECT * from horarios_alunos";
                $conha = $mysqli->query($consultaha) or die($mysqli->error);
                $consultaH = "SELECT * from horarios";
                $conH = $mysqli->query($consultaH) or die($mysqli->error);
                $horario = [];
                while($cha = mysqli_fetch_array($conha)){
                    if($cha['ID_Aluno'] == $_SESSION['ID_Aluno']){
                        $horario[] = $cha['ID_Horario'];
                    }
                }
                while($ch = mysqli_fetch_array($conH)){
                    for($i=0;$i<sizeof($horario);$i++){
                        if($ch['ID_Horario'] == $horario[$i]){
                            echo $ch['Dia']."-".$ch['Hora_inicio']."-".$ch['Hora_fim']."<br>";
                        }
                    }
                }
                ?>
        </div>
    </div>
    
    <!-- TROCA AVATAR DO USUARIO E VOLTA NA PAGINA INICIAL -->
    <div class="usuarioDiv" name="usuarioDiv" id="usuarioDiv">
        <?php 
        if(!isset($_SESSION)){session_start();}
        $arquiv = "SELECT imagem FROM alunos WHERE ID_ALUNO = '{$_SESSION['ID_Aluno']}'";
        $result = $mysqli->query($arquiv) or die($mysqli->error);
        $row = mysqli_fetch_array($result);
        if($row['imagem']  == "oi"){
            echo '<img id="fotoLogin" src="/topo/img/iconetopo.jpg"/>';
        }
        else{
            echo '<img id="fotoLogin" src="data:image/jpeg;base64,' . base64_encode( $row['imagem'] ) . '" />';
        }
        
        ?>
        <div id="usuarioId">
        <p style="font-size:30px;margin-top:-5vh;margin-bottom:2vh"><?php if(!isset($_SESSION)){session_start();}
            echo $_SESSION['nome'];
            ?>
        </p>
        <div style="display:flex;flex-direction:row">
        <button class="btn btn-primary btn-sm" onclick="altera();">Alterar Avatar</button>
        <button class="btn btn-primary btn-sm" onclick="alteraH();">Meus Horários</button>
        <form action="validabia.php" method="POST">
        
        <button style="background-color:rgba(218, 12, 12, 0.872);" class="btn btn-danger btn-sm" name="sair" type="submit">Sair</button>   
    </form>
    </div>
        </div>
    </div> 
    <h1 id="h1curso" style="margin-bottom:2vh;font-family: system-ui;">Seus Cursos</h1>
    <!--CURSOS DO ALUNO -->
</div>
<div id="load">
        <img src="./img/load.gif" style="width:10vw">
    </div>
    <script>
        window.onload = function(){
        var el = document.getElementById('load');
        el.style.display = 'none';
        document.getElementById('cursos').style.visibility = 'visible';
        };
    </script>
    <div id="cursos" style="visibility:hidden"> 
   <div id="cursoCont">
        <div id="btnVoltar">
            <a class="btnVoltarCurso" style="color:white;"onclick="javascript:volta();">Voltar</a>
        </div>
    </div>
   
    <?php 
        /*
        $consulta = "SELECT * FROM cursos";
        $consulta2 = "SELECT * FROM aluno_curso_progressos";
        $con = $mysqli->query($consulta) or die($mysqli->error);
        $con2 = $mysqli->query($consulta2) or die($mysqli->error);
        $i = 0;
        while($c2 = mysqli_fetch_array($con2)){
            if($c2['ID_Aluno'] ==  $_SESSION['ID_Aluno']){
                while($c = mysqli_fetch_array($con)){ 
                    if($c['ID_Curso'] == $c2['ID_Curso']){
                        echo "<div style='text-align:center' id = 'oi'>".$c['Nome_curso']."<img  src='img/apertomao.jpg'>"
                        ."<a>Acessar Curso</a>"."</div>";
                        $i++;
                        break;
                    }
                } 
            } 
         }
         while($i>0){
            echo "<script>adcElemento()</script>";
            $i--;
         }
         
        */
        $oi = $_SESSION['ID_Aluno']; $i = 0;
        $consulta = "SELECT cursos.Nome_curso, cursos.ID_Curso from alunos join aluno_curso_progressos ON aluno_curso_progressos.ID_Aluno = alunos.ID_Aluno join cursos ON cursos.ID_Curso = aluno_curso_progressos.ID_Curso WHERE alunos.ID_Aluno = $oi";
        $con = $mysqli->query($consulta) or die($mysqli->error);
        $i3 = 0;
        echo "<script>let i6 = 0;</script>";
        while($c = mysqli_fetch_array($con)){
            $oi2 = $c['ID_Curso'];
            $consulta2 = "SELECT cursos.aulas_totais, cursos.Nome_curso, cursos.Descricao, cursos.Horas from cursos join aluno_curso_progressos ON aluno_curso_progressos.ID_Curso = cursos.ID_Curso join alunos ON aluno_curso_progressos.ID_Aluno = alunos.ID_Aluno WHERE alunos.ID_Aluno = $oi and cursos.ID_Curso = $oi2";
            $con2 = $mysqli->query($consulta2) or die($mysqli->error);
            while($cCurso = mysqli_fetch_array($con2)){
                $aulas = $cCurso['aulas_totais'];
                $nomeCurso = $cCurso['Nome_curso'];
                $descricao = $cCurso['Descricao'];
                $horas = $cCurso['Horas'];
            }
            $i5 = [$aulas];
            $atual = "SELECT Aula_atual , Estagio FROM aluno_curso_progressos WHERE ID_Aluno = '{$_SESSION['ID_Aluno']}' AND ID_Curso = '{$c['ID_Curso']}'";
            $sqlatual = $mysqli->query($atual) or die($mysqli->error);
			$atual2 = mysqli_fetch_array($sqlatual)[0];
            $estagio = "SELECT Estagio FROM aluno_curso_progressos WHERE ID_Aluno = '{$_SESSION['ID_Aluno']}' AND ID_Curso = '{$c['ID_Curso']}'";
            $sqlestagio = $mysqli->query($estagio) or die($mysqli->error);
			$esta = mysqli_fetch_array($sqlestagio)[0];
            echo "<div style='text-align:center;' id='oi'><b style='font-size: 110%;'>".$c['Nome_curso']."</b><img  src='cursos/".$c['ID_Curso']."/".$c['ID_Curso'].".png'>"
                        ."<a onclick='mostraCurso".$c['ID_Curso']."();'>Acessar Curso</a></div>
                        <script>
                            function mostraCurso".$c['ID_Curso']."(){
                            let d = document.getElementsByClassName('cursoConteudo');
                            let u = document.querySelectorAll('#oi2');;
                            let e = document.getElementsByClassName('cursoTela');
                            for (let i = 0; i < e.length; i++) {
                              e[i].style.display = 'none';
                            }
                            document.getElementById('cursoCont').style.display = 'block';
                            let i2 = 0;            
                            for(let i3 = 0; i3 < d.length; i3++){
                               if(i2<u.length && u[i3].getAttribute('name') ==".$c['ID_Curso']."){
                                     d[i3].style.display = 'block';
                                     i2++;
                                }
                            }
                            window.scrollTo(0,0);
                         }
                        </script>";
            for($i2 = 1; $aulas >= $i2;$i2++){
                echo "<div style='text-align:center;display:none;margin-top:20px' id = 'oi2' name='".$c['ID_Curso']."'><img style='margin-bottom:4px' src='cursos/".$c['ID_Curso']."/".$i2."/img/0.jpg'>"
                ."<a onclick='mostraFase".$c['ID_Curso']."aula".$i2."()'>Aula ".$i2."</a></div>";
                echo "<div  class='modal-content' id='modal2' name='Curso".$c['ID_Curso']."Aula".$i2."'>
                <a onclick='fechaFase".$c['ID_Curso']."aula".$i2."()' class='close' style='float:right; margin-right:6px;margin-top:4px; cursor:pointer;' ><span aria-hidden='true'>&times;</span></a>
                <div id='modal2Cont'>Aula:".$i2." 
                </div>
                <div id='modal2Op'>
                <div style='padding-right: 9px;text-align: center;'><a id='aula".$i2."".$c['ID_Curso']."'onclick='mostraAula".$c['ID_Curso']."aula".$i2."()'  style='pointer-events: none;color:gray;'><i class='bi bi-cast'></i></a><p>Aula</p></div><img src='./img/caminho.png' style='width: 35px;height: 10px;vertical-align: middle;margin-top: 15px;'>
                <div style='padding-right: 2px;text-align: center;'><a id='passo".$i2."".$c['ID_Curso']."' target='_blank' href='cursos/".$c['ID_Curso']."/".$i2."/passo-a-passo.pdf'  style='pointer-events: none;color:gray;'><i class='bi bi-postcard'></i></a><p>Apostila</p></div><img src='./img/caminho.png' style='width: 35px;height: 10px;vertical-align: middle;margin-top: 15px;'>
                <div style='padding-right: 2px;text-align: center;'><a id='fixacao".$i2."".$c['ID_Curso']."' target='_blank' href='cursos/".$c['ID_Curso']."/".$i2."/fixacao.pdf'  style='pointer-events: none;color:gray;'><i class='bi bi-pencil-square'></i></a><p>Fixação</p></div><img src='./img/caminho.png' style='width: 35px;height: 10px;vertical-align: middle;margin-top: 15px;'>
                <div style='padding-left: 8px;text-align: center;'><a id='teste".$i2."".$c['ID_Curso']."' href='teste.php?i2=".$i2."&&idcurso=".$c['ID_Curso']."&&nomecurso=".$nomeCurso."'  style='pointer-events: none;color:gray;'><i class='bi bi-journal-check'></i></a><p>Teste</p></div>
                ";if($i2 == $aulas){
                    echo "<img src='./img/caminho.png' style='width: 35px;height: 10px;vertical-align: middle;margin-top: 15px;'><div style='padding-left: 8px;text-align: center;'><a id='certi".$i2."".$c['ID_Curso']."'  target='_blank' href='certificado.php?nomeCurso=".$nomeCurso."&&horas=".$horas."&&descricao=".$descricao."&&idcurso=".$c['ID_Curso']."' style='pointer-events: none;color:gray;'><i class='bi bi-filetype-pdf'></i></a><p>Certificado</p></div>";
                }echo "</div>
                </div>
                <script>";
                    if($i2 < $atual2){
                         echo   "document.getElementById('aula".$i2."".$c['ID_Curso']."').style.pointerEvents = 'auto';
                                 document.getElementById('aula".$i2."".$c['ID_Curso']."').style.color = 'green';
                                 document.getElementById('aula".$i2."".$c['ID_Curso']."').style.cursor = 'pointer';
                                 document.getElementById('passo".$i2."".$c['ID_Curso']."').style.pointerEvents = 'auto';
                                 document.getElementById('passo".$i2."".$c['ID_Curso']."').style.color = 'green';
                                 document.getElementById('passo".$i2."".$c['ID_Curso']."').style.cursor = 'pointer';
                                 document.getElementById('fixacao".$i2."".$c['ID_Curso']."').style.pointerEvents = 'auto';
                                 document.getElementById('fixacao".$i2."".$c['ID_Curso']."').style.color = 'green';
                                 document.getElementById('fixacao".$i2."".$c['ID_Curso']."').style.cursor = 'pointer';
                                 document.getElementById('teste".$i2."".$c['ID_Curso']."').style.pointerEvents = 'auto';
                                 document.getElementById('teste".$i2."".$c['ID_Curso']."').style.color = 'green';
                                 document.getElementById('teste".$i2."".$c['ID_Curso']."').style.cursor = 'pointer';";
                    }
                    if($i2 == $atual2){
                        echo   "document.getElementById('aula".$i2."".$c['ID_Curso']."').style.pointerEvents = 'auto';
                                document.getElementById('aula".$i2."".$c['ID_Curso']."').style.color = 'green';
                                document.getElementById('aula".$i2."".$c['ID_Curso']."').style.cursor = 'pointer';";
                    }
                    if($i2 == $atual2 && ($esta == 2 || $esta == 3)){
                        echo   "document.getElementById('aula".$i2."".$c['ID_Curso']."').style.pointerEvents = 'auto';
                                document.getElementById('aula".$i2."".$c['ID_Curso']."').style.color = 'green';
                                document.getElementById('aula".$i2."".$c['ID_Curso']."').style.cursor = 'pointer';
                                document.getElementById('passo".$i2."".$c['ID_Curso']."').style.pointerEvents = 'auto';
                                 document.getElementById('passo".$i2."".$c['ID_Curso']."').style.color = 'green';
                                 document.getElementById('passo".$i2."".$c['ID_Curso']."').style.cursor = 'pointer';
                                 document.getElementById('fixacao".$i2."".$c['ID_Curso']."').style.pointerEvents = 'auto';
                                 document.getElementById('fixacao".$i2."".$c['ID_Curso']."').style.color = 'green';
                                 document.getElementById('fixacao".$i2."".$c['ID_Curso']."').style.cursor = 'pointer';
                                 document.getElementById('teste".$i2."".$c['ID_Curso']."').style.pointerEvents = 'auto';
                                 document.getElementById('teste".$i2."".$c['ID_Curso']."').style.color = 'green';
                                 document.getElementById('teste".$i2."".$c['ID_Curso']."').style.cursor = 'pointer';";
                    }
                    if($i2 == $aulas &&  $atual2 == $aulas && $esta == 3){
                        echo   "document.getElementById('certi".$i2."".$c['ID_Curso']."').style.pointerEvents = 'auto';
                                document.getElementById('certi".$i2."".$c['ID_Curso']."').style.color = 'green';
                                document.getElementById('certi".$i2."".$c['ID_Curso']."').style.cursor = 'pointer';";
                    }
                    echo"
                    function mostraFase".$c['ID_Curso']."aula".$i2."(){
                        let contFase = document.getElementsByName('Curso".$c['ID_Curso']."Aula".$i2."');
                        contFase[0].style.display = 'block';
                        contFase[0].style.position = 'absolute';
                        window.scrollY;
                        contFase[0].style.top = (window.scrollY + 300) + 'px' ;
                        
                    }
                    function fechaFase".$c['ID_Curso']."aula".$i2."(){
                        let contFase = document.getElementsByName('Curso".$c['ID_Curso']."Aula".$i2."');
                        contFase[0].style.display = 'none';
                    }
                </script>";
                $i3++;
                $i4 = 0;
                if($c['ID_Curso']==60 || $c['ID_Curso'] == 62 || $c['ID_Curso'] == 63){
                    $pasta = new FilesystemIterator ("cursos/".$c['ID_Curso']."/".$i2."/img");
                    foreach($pasta as $file){
                        $arq= "cursos/".$c['ID_Curso']."/".$i2."/paginas/".$i4.".txt";
                        $pont = fopen($arq,"r");
                        $linha = fgets($pont);
                        while($linha){
                            echo "<p id='".$c['ID_Curso']."".$i2."".$i4."' style='display:none'>".$linha."</p>";
                            $linha = fgets($pont);
                        }
                        
                        $i4++;
                    //echo $pasta."<br>";
                    }
                }
                $i5[$i2] = $i4;
                echo 
            "<script>
                function mostraAula".$c['ID_Curso']."aula".$i2."(){
                let b = document.body;
                document.getElementById('nav').style.display = 'none';
                document.getElementById('h1curso').style.display = 'none';
                document.getElementsByClassName('usuarioDiv')[0].style.display = 'none';
                document.getElementById('cursos').style.display = 'none';
                let aula = document.createElement('div');
                let imagem = document.createElement('img');
                let video = document.createElement('video');
                video.muted = false;
                video.height = 375;
                video.width = 530; 
                let audio = document.createElement('audio');
                let prox = document.createElement('button');
                let vol = document.createElement('button');
                let sair = document.createElement('button');
                let textoAula = document.createElement('div');
                let AulaTexto = document.createElement('div');
                AulaTexto.setAttribute('id','AulaTexto');
                textoAula.setAttribute('id','textoAula');
                sair.setAttribute('id', 'sair');
                sair.setAttribute('onclick', 'sair".$c['ID_Curso']."aula".$i2."()');
                sair.innerHTML = 'Sair';
                prox.setAttribute('id', 'prox".$c['ID_Curso']."aula".$i2."');
                vol.setAttribute('id', 'vol".$c['ID_Curso']."aula".$i2."');
                prox.setAttribute('class', 'proxima');
                vol.setAttribute('class', 'volta');
                sair.setAttribute('class', 'sair');
                prox.innerHTML = '>>';
                vol.innerHTML = '<<';
                prox.setAttribute('onclick', 'prox".$c['ID_Curso']."aula".$i2."()');
                vol.setAttribute('onclick', 'vol".$c['ID_Curso']."aula".$i2."()');
                aula.setAttribute('id' , 'aulaEstilo');
                b.appendChild(aula);
                aula.appendChild(textoAula);
                aula.appendChild(AulaTexto);
                aula.appendChild(video);
                video.appendChild(audio);
                audio.setAttribute('id','audio');
                audio.setAttribute('src', 'cursos/".$c['ID_Curso']."/".$i2."/audio/'+i6+'.mp3');
                video.setAttribute('id','imagemEstilo');
                video.setAttribute('src', 'cursos/".$c['ID_Curso']."/".$i2."/vid/'+i6+'.mp4');
                imagem.setAttribute('src', 'cursos/".$c['ID_Curso']."/".$i2."/img/'+i6+'.jpg');
                imagem.setAttribute('id', 'imagemEstilo');
                textoAula.appendChild(sair);
                textoAula.appendChild(vol);
                textoAula.appendChild(prox);
                audio.setAttribute('controls', 'autoplay');
                prox.disabled = true;
                audio.play();
                audio.addEventListener('ended', function(){
                    audio.currentTime = 0;
                    video.setAttribute('controls', 'autoplay');
                    video.play();
                    video.addEventListener('ended', function(){
                    video.setAttribute('controls', 'autoplay');
                    video.currentTime = 0;
                    prox.disabled = false;
                    prox.style.background = 'yellow';
                    });
                    });
                document.getElementById('sair').style.display = 'block';
                document.getElementById('aulaEstilo').style.display = 'block';
                document.getElementById('".$c['ID_Curso']."".$i2."'+i6+'').style.display = 'block';
                let paragrafo = document.createElement('p');
                paragrafo.setAttribute('id', 'paragrafo');
                paragrafo.innerHTML = document.getElementById('".$c['ID_Curso']."".$i2."'+i6+'').innerHTML;
                }
                </script>";
              
            echo "<script>
            function prox".$c['ID_Curso']."aula".$i2."(){
                if(i6<".$i5[$i2]."){
                console.log(i6);
                console.log(document.getElementById('".$c['ID_Curso']."".$i2."'+i6+''));
                document.getElementById('".$c['ID_Curso']."".$i2."'+i6+'').style.display = 'none';
                i6++;
                if(i6 == ".$i5[$i2]."){
                    alert('Aula Concluída');
                    i6--;
                    document.getElementById('passo".$i2."".$c['ID_Curso']."').style.pointerEvents = 'auto';
                    document.getElementById('passo".$i2."".$c['ID_Curso']."').style.color = 'green';
                    document.getElementById('passo".$i2."".$c['ID_Curso']."').style.cursor = 'pointer';
                    document.getElementById('fixacao".$i2."".$c['ID_Curso']."').style.pointerEvents = 'auto';
                    document.getElementById('fixacao".$i2."".$c['ID_Curso']."').style.color = 'green';
                    document.getElementById('fixacao".$i2."".$c['ID_Curso']."').style.cursor = 'pointer';
                    document.getElementById('teste".$i2."".$c['ID_Curso']."').style.pointerEvents = 'auto';
                    document.getElementById('teste".$i2."".$c['ID_Curso']."').style.color = 'green';
                    document.getElementById('teste".$i2."".$c['ID_Curso']."').style.cursor = 'pointer';
                    sair".$c['ID_Curso']."aula".$i2."();
                }
                document.getElementById('paragrafo').innerHTML = document.getElementById('".$c['ID_Curso']."".$i2."'+i6+'').innerHTML;
                document.getElementById('".$c['ID_Curso']."".$i2."'+i6+'').style.display = 'block';
                document.getElementById('imagemEstilo').setAttribute('src', 'cursos/".$c['ID_Curso']."/".$i2."/img/'+i6+'.jpg');
                document.getElementById('audio').setAttribute('src', 'cursos/".$c['ID_Curso']."/".$i2."/audio/'+i6+'.mp3');
                audio.play();
                document.getElementById('prox".$c['ID_Curso']."aula".$i2."').disabled = true;document.getElementById('prox".$c['ID_Curso']."aula".$i2."').style.background = 'gray';
                }
            }</script>";
            echo "<script>function vol".$c['ID_Curso']."aula".$i2."(){
                document.getElementById('".$c['ID_Curso']."".$i2."'+i6+'').style.display = 'none';
                if(i6>0){
                    console.log(i6);
                    document.getElementById('".$c['ID_Curso']."".$i2."'+i6+'').style.display = 'none';
                    i6--;
                    document.getElementById('".$c['ID_Curso']."".$i2."'+i6+'').style.display = 'block';
                    document.getElementById('paragrafo').innerHTML = document.getElementById('".$c['ID_Curso']."".$i2."'+i6+'').innerHTML;
                    document.getElementById('imagemEstilo').setAttribute('src', 'cursos/".$c['ID_Curso']."/".$i2."/img/'+i6+'.jpg');
                    document.getElementById('audio').setAttribute('src', 'cursos/".$c['ID_Curso']."/".$i2."/audio/'+i6+'.mp3');
                    audio.play();
                    document.getElementById('prox".$c['ID_Curso']."aula".$i2."').disabled = false;document.getElementById('prox".$c['ID_Curso']."aula".$i2."').style.background = 'yellow';

                }
            
            }</script>";
            echo "<script>
            function sair".$c['ID_Curso']."aula".$i2."(){
            console.log(document.getElementById('".$c['ID_Curso']."".$i2."'+i6+''));
            document.getElementById('".$c['ID_Curso']."".$i2."'+i6+'').style.display = 'none';
            document.getElementById('nav').style.display = 'flex';
            document.getElementById('h1curso').style.display = 'flex';
            document.getElementsByClassName('usuarioDiv')[0].style.display = 'flex';
            document.getElementById('cursos').style.display = 'flex';document.getElementById('aulaEstilo').remove();i6=0;}
            </script>";
            }   
            $i++;
        }
        while($i>0){
            echo "<script>adcElemento()</script>";
            $i--;
        }
        while($i3>0){
            echo "<script>adcCurso();</script>";
            $i3--;
        }
    ?>      
    </div>
</body>
</html>