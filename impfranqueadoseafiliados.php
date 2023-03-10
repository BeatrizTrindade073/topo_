<?php

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
$user = "podium93_topo";
$pass = "juniorx9s4x9n5";
$db = "podium93_topo";
        $mysqli = new mysqli($host, $user, $pass, $db);
        
     $parcelas = 6;
     setlocale(LC_ALL,'pt_BR.UTF8');
      mb_internal_encoding('UTF8'); 
      mb_regex_encoding('UTF8');
        date_default_timezone_set('America/Sao_Paulo');
        $data = strftime('%d de %B de %Y', strtotime('today'));
      
     $franqueado = $mysqli->query("SELECT * FROM franqueados");
      
 
      while($cfranqueado = mysqli_fetch_array($franqueado)){
          
          $franqueados .= ("ID:".$franqueado['ID_franqueados']. " - Nome: ".$cfranqueado['Nome'] . " - Telefone:" .$cfranqueado['Telefone'] . " - CNPJ: " .$cfranqueado['CNPJ'] . " </br> </br> ");
          
      }
      
      $afiliado = $mysqli->query("SELECT * FROM afiliados");
      
 
      while($cafiliado = mysqli_fetch_array($afiliado)){
          
          $afiliados .= ("ID:".$cafiliado['ID_afiliados']. " - Nome: ".$cafiliado['Nome'] . " - Telefone:" .$cafiliado['Telefone'] . " - CNPJ: " .$cafiliado['CNPJ'] . " </br> </br> ");
          
      }
      $dompdf->loadHtml('
        <!DOCTYPE html>
        <html lang="pt-br">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            
            <title>Alunos </title>
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
        <p style="font-size:20px;font-weight:bold;text-align:center;margin-top:20px;">Lista de Franqueados</p>
        <p style="font-size:13px;margin-top:20px;">'.$franqueados.'</p>
        <hr>
        <p style="font-size:20px;font-weight:bold;text-align:center;margin-top:20px;">Lista de Afiliados</p>
        <p style="font-size:13px;margin-top:20px;">'.$afiliados.'</p>
       
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

