<?php
//imprimir alunos e franqueados/afiliados
//diminuir botões horários e cadastrar cupons.
//logo
        require __DIR__.'/vendor/autoload.php';
        use Dompdf\Dompdf;
        use Dompdf\Options;
        //Instanciação do objeto options
        $options = new Options();
        //Configuração da root para o diretório atual
        $options->setChroot(__DIR__);
        $options->setIsRemoteEnabled(true);
        //Instanciação do objeto dompdf
        $cpf = $_GET['cpf'];
        $dompdf = new Dompdf($options);
       $host = "localhost";
$user = "root";
$pass = "bia999665";
$db = "podium";
        $mysqli = new mysqli($host, $user, $pass, $db);
        
     $parcelas = 6;
     setlocale(LC_ALL,'pt_BR.UTF8');
      mb_internal_encoding('UTF8'); 
      mb_regex_encoding('UTF8');
        date_default_timezone_set('America/Sao_Paulo');
        $data = strftime('%d de %B de %Y', strtotime('today'));
      
     $aluno = $mysqli->query("SELECT * FROM alunos");
      
 
      while($caluno = mysqli_fetch_array($aluno)){
          
          $alunos .= ($caluno['Nome'] . " - " .$caluno['Telefone'] . " - " .$caluno['Email'] . " </br> ");
          
      }
      $dompdf->loadHtml('
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            
            <title>Contrato </title>
            <style>
            *{
                margin:0;
                padding:0;
            }
            body{
                font-family: arial, helvetica, sans-serif;
                display: flex;
                flex-direction: collum;
                position: relative;
                width:700px;
                margin: auto;

            }
            .texto{
                
                text-align: justify;
                
                
            }
            .break { 
            page-break-before: always; 
            }
            
            
            </style>
        </head>
        <body>
        <div class="texto">
        <p style="font-size:10px;margin-top:10px;">'.$alunos.'</p>
       
        </div>
            
            </body>
       
        </html>
     '
                         );
   
    
        //Renderização do arquivo PDF
        $dompdf->render();

        //Imprime o conteudo do pdf na tela
        header('Content-type: application/pdf');
        echo $dompdf->output();
    
    ?>

