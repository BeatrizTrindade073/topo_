<?php

 $id = $_GET['id_pag'];
 $parc = $_GET['nparc'];
        $host = "localhost";
        $user = "podium93_topo";
        $pass = "juniorx9s4x9n5";
        $db = "podium93_topo";
        $mysqli = new mysqli($host, $user, $pass, $db);
        
        
$consultaParcela = "SELECT * FROM aluno_parcela WHERE ID_Pagamento = '{$id}'";
 $cParcela = $mysqli->query($consultaParcela) or die($mysqli->error);
$consultaAluno = "SELECT * FROM aluno_pagamento WHERE ID_Pagamento = '{$id}'";
                $cAluno = $mysqli->query($consultaAluno) or die($mysqli->error);
                while($ca = mysqli_fetch_array($cAluno)){
                    $id_aluno = $ca['ID_Aluno'];
                 }
                while($c = mysqli_fetch_array($cParcela)){
                    if($c['parcela']==$parc){
                        $pagamento= "UPDATE aluno_parcela set valor_pago = '{$c['valor_parcela']}' where ID_Pagamento = '{$id}' and parcela = '{$parc}'";
                $cPagamento = $mysqli->query($pagamento) or die($mysqli->error);
                echo '<script>alert("Pagamento cadastrado com sucesso!")</script>';
                
                ?>
                <html>
                    <head> </head>
                    </body>
             <meta http-equiv="refresh" content="0 url=./pagamentoAluno.php?alunoid=<?php echo $id_aluno; ?>">
            </body>
             </html>
             <?php
                    }
                }
                ?>