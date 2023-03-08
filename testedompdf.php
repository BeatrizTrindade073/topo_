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
      
     $aluno = $mysqli->query("SELECT * FROM alunos WHERE CPF = '{$cpf}'");
      
 
      while($caluno = mysqli_fetch_array($aluno)){
            $nome = $caluno['Nome'];
            $cep =  $caluno['CEP'];
            $id_Aluno =  $caluno['ID_Aluno'];
            $data_limite = date('d/m/y', strtotime($caluno['data_limite']));
            $resp = $caluno['Responsavel_2'];
          $cidade = $caluno['Cidade'];
            $end = $caluno['Rua']. " ".$caluno['Numero']." ".$caluno['Complemento']." ".$caluno['Cidade']." - ".$caluno['Estado'];
            $tel = $caluno['Telefone'];
            $nasc = date('d/m/y', strtotime($caluno['Nascimento']));
            $rg = $caluno['RG'];
            $resptel = $caluno['Responsavel_numero'];
          $respcep = $caluno['CEP_Responsavel'];
          $resprg = $caluno['RG_Responsavel'];
          $respcpf = $caluno['CPF_Responsavel'];
           $respnasc = date('d/m/y', strtotime($caluno['DATA_Responsavel']));
        }
    $franqueado = $mysqli->query("SELECT * FROM cursos_franqueados WHERE ID_Aluno = '{$id_Aluno}'");
    $afiliado = $mysqli->query("SELECT * FROM cursos_afiliados WHERE ID_Aluno = '{$id_Aluno}'");
      
       while($cfranqueado=mysqli_fetch_array($franqueado)){
      $idfranqueado=$cfranqueado['ID_franqueador'];
           
      }
      
      
      $nomefranqueado = $mysqli->query("SELECT * FROM franqueados WHERE ID_franqueados = '{$idfranqueado}'");
      
 while($cnomefranqueado=mysqli_fetch_array($nomefranqueado)){
      $nome_franqueado=$cnomefranqueado['Nome'];
     $cnpj_franqueado=$cnomefranqueado['CNPJ'];
     $tel_franqueado=$cnomefranqueado['Telefone'];
    $end_franqueado = $cnomefranqueado['Rua']. " ".$cnomefranqueado['Numero']." ".$cnomefranqueado['Complemento']." - ".$cnomefranqueado['Bairro']." , ".$cnomefranqueado['Cidade']." - ".$cnomefranqueado['Estado'];
      $logo = $cnomefranqueado['logo'];           
      }
      
       while($cafiliado=mysqli_fetch_array($afiliado)){
      $idafiliado=$cafiliado['ID_afiliados'];
           
           
      }
      
      $nomeafiliado = $mysqli->query("SELECT * FROM afiliados WHERE ID_afiliados = '{$idafiliado}'");
      
      while($cnomeafiliado=mysqli_fetch_array($nomeafiliado)){
      $nome_afiliado=$cnomeafiliado['Nome'];
      $cnpj_afiliado=$cnomeafiliado['CNPJ'];
     $tel_afiliado=$cnomeafiliado['Telefone'];
   $end_afiliado = $cnomeafiliado['Rua']. " ".$cnomeafiliado['Numero']." ".$cnomeafiliado['Complemento']." - ".$cnomeafiliaado['Bairro']." , ".$cnomeafiliado['Cidade']." - ".$cnomeafiliado['Estado'];
     $clausulas = $cnomeafiliado['clausulas'];
           
      }
     
       $Horario = $mysqli->query("SELECT ID_Horario FROM horarios_alunos WHERE ID_Aluno = '{$id_Aluno}'");
    $chora = [];
       while($chorario=mysqli_fetch_array($Horario)){
      $chora[]=$chorario['ID_Horario'];
      }
      
      $allhorario = $mysqli->query("SELECT * FROM horarios");
      while($callhorario=mysqli_fetch_array($allhorario)){
          for($i=0;$i<count($chora);$i++)
          {
              if($callhorario['ID_Horario']==$chora[$i])
              {
                  $dia .=($callhorario['Dia'] . " |<b>  " .$callhorario['Hora_inicio'] . "  -  " .$callhorario['Hora_fim'] . " |</br> ") ;
              }
          }
    
      }
      
    $Curso = $mysqli->query("SELECT ID_Curso FROM aluno_curso_progressos WHERE ID_Aluno = '{$id_Aluno}'");
    $cid = [];
     
      while($c=mysqli_fetch_array($Curso)){
      $cid[]=$c['ID_Curso'];
      }
      
    $nomeCurso = " ";
      $horaCurso = " ";
      $cargahoraria = 0;
      $precototal = 0;
      

         $allcurso = $mysqli->query("SELECT * FROM cursos");
      while($callcurso=mysqli_fetch_array($allcurso)){
          for($i=0;$i<count($cid);$i++)
          {
              if($callcurso['ID_Curso']==$cid[$i])
              {
                  $nomeCurso .=($callcurso['Nome_curso'] . " </br> ");
                  $horaCurso .=($callcurso['Horas'] . " horas </br> ");
                  $cargahoraria+=($callcurso['Horas']);
                  $precototal+=number_format($callcurso['Preco'],2,",",".");
              }
          }
    
      }

     $precopparcela = ($precototal)/($parcelas);   
      $precopparcela = number_format($precopparcela,2,",",".");
    
  if(!empty($nome_franqueado))
     {
         $emp_nome = $nome_franqueado;
         $emp_cnpj = $cnpj_franqueado;
         $emp_tel = $tel_franqueado;
         $emp_end = $end_franqueado;
     }
      


      //Envio do valor do buffer para a a classe
        //$dompdf->loadHtmlFile(__DIR__.'/teste.php');
      if(!empty($nome_afiliado)){
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
            
            .esquerdo{
            float:left;
            width:300px;
            display: block;
            }
            
            .littledireito{
            float:right;
            width:300px;
            display: block;
            }
            
            .direito{
            float:right;
            width:200px;
            display: block;
            position: fixed;
            }
            
            .littleesquerdo{
            float:left;
            width:400px;
            display: block;
            }
            </style>
        </head>
        <body>
        <div class="info">
        <p style="font-size:13px;font-weight:bold;margin-left:60%;margin-top:30px;">CONTRATO DE PRESTAÇÃO DE SERVIÇOS</p>
        <p>_______________________________________________________________________________</p>
    
        <div class="esquerdo">
        <p style="font-size:10px;margin-top:20px;">Nº do Contrato: - </p>
        <p style="font-size:10px;margin-top:10px;">Convênio:  - </p>
        <p style="font-size:10px;margin-top:10px;">Nº de Parcelas: '.$parcelas.' </p>
        <p style="font-size:10px;margin-top:10px;">Valor Entrada:  R$0,00</p>
        <p style="font-size:10px;margin-top:10px;">Valor do Curso com Desconto: R$'.$precototal.',00</p>
        <p style="font-size:10px;margin-top:10px;">Valor do Curso sem Desconto: R$'.$precototal.',00 </p>
         <p>_______________________________________________________________________________</p>
        <p style="font-size:10px;margin-top:20px;">Cursos Contratados: </p>
        <p style="font-size:10px;font-weight:bold;margin-top:10px;"> '.$nomeCurso.'</p>
         </br>
        <p>_______________________________________________________________________________</p>
        <p style="font-size:10px;font-weight:bold;margin-top:20px;">Contratado: </p>
        <p style="font-size:10px;margin-top:10px;"> Razão Social: GUERRA & NASCIMENTO EMPREENDIMENTOS LTDA</p>
        <p style="font-size:10px;margin-top:10px;"> Nome Fantasia: GRUPO PODIUM </p>
        <p style="font-size:10px;margin-top:10px;"> CNPJ: 04.880.821/0001-10</p>
        <p style="font-size:10px;margin-top:10px;"> Telefone: (32)3421-2299</p>
        <p style="font-size:10px;margin-top:10px;"> Endereço: Rua Tenente Fortunato - Centro, CATAGUASES/MG</p> 
         <p>_______________________________________________________________________________</p>
        <p style="font-size:10px;font-weight:bold;margin-top:20px;">Contratante: </p>
        <p style="font-size:10px;;margin-top:10px;"> Nome: '.$nome.'</p>
        <p style="font-size:10px;margin-top:10px;"> Endereço: '.$end.'</p>
        <p style="font-size:10px;margin-top:10px;"> CEP: '.$cep.'</p>
        <p style="font-size:10px;margin-top:10px;"> Telefone: '.$tel.'</p>
        <p style="font-size:10px;margin-top:10px;"> Data de Nascimento: '.$nasc.'</p>
        <p style="font-size:10px;margin-top:10px;"> RG: '.$rg.'</p>
        <p style="font-size:10px;margin-top:10px;"> CPF: '.$cpf.'</p>
         <p>_______________________________________________________________________________</p>
        <p style="font-size:10px;font-weight:bold;margin-top:20px;">Representante Legal: </p>
        <p style="font-size:10px;margin-top:10px;"> Nome: '.$resp.'</p>
        <p style="font-size:10px;margin-top:10px;"> Endereço: '.$end.'</p>
           <p style="font-size:10px;margin-top:10px;"> CEP: '.$respcep.'</p>
        <p style="font-size:10px;margin-top:10px;"> Telefone: '.$resptel.'</p>
         <p style="font-size:10px;margin-top:10px;"> Data de Nascimento: '.$respnasc.'</p>
        <p style="font-size:10px;margin-top:10px;"> RG: '.$resprg.'</p>
        <p style="font-size:10px;margin-top:10px;"> CPF: '.$respcpf.'</p>
        </div>
        <div class="direito">
        
       
        </div>
        
        </div>
        <p class="break"> </p>
        <div class="texto">
        </br>
        </br>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">Através do presente Contrato de Prestação de Serviços, de um lado o Aluno ou responsável acima descrito, contrata os serviços do GRUPO PODIUM cuja razão social é GUERRA & NASCIMENTO EMPREENDIMENTOS LTDA, estabelecida no endereço Rua Tenente Fortunato - Centro, CATAGUASES/MG e conforme as cláusulas e condições abaixo.</p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">1ª - A contratada se compromete a ministrar ao contratante os cursos de informática e(ou) cursos profissionalizantes e (ou) cursos de idiomas conforme horário, valores e condições de pagamento constantes na 1ª página. </p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">2ª - O presente contrato tem vigência definida pelo período total da carga horária contratada, de acordo com cada curso, podendo o mesmo se encerrar com menos tempo ou mais tempo que o previsto, já que existe uma previsão de duração que depende do desempenho individualizado de cada aluno.</p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">Paragráfo único: Será concedida uma carência de mais de 8 hora além da carga horária prevista para o término do curso. Quando a duração do curso ultrapassar essa carência, será cobrado do contratante um valor adicional proporcional à carga horária excedente.  </p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">3ª - O simples não comparecimento para as aulas, sem comunicação a contratada, não configura em cancelamento do curso, não isentando, portanto, o contratante dos pagamentos devidos. O aluno que não comparecer a uma aula, se responsabilizará pela ausência. Terá direito a reposição sem ônus, mediante apresentação de atestado médico ou de trabalho, até 10 por cento do total de horas contratadas. Após a 2ª falta consecutiva, sem justificativa, a escola entrará em contato com o responsável para identificar o motivo gerador da falta e o aluno perderá o direito a reposição sem custos. Para o aluno que faltou sem justificativa e queira repor a aula será cobrado o valor da tabela vigente, que deverá ser pago no dia agendado para a reposição.  </p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">4ª - Se o aluno maracr horários para trabalhos, internet, treinamentos, reposição de aula e não comparecer deverá comunicar a escola com 24 horas de antecedência. Só terá direito de a marcar um novo horário sem custo, mediante atestado médico ou de trabalho. </p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">O aluno que necessitar trocar de horário, se for menor de idade, deverá ser solicitado por seu responsável junto à secretaria. A troca somente será realizada se houver vaga no horário pretendido. A partir da 2ª troca será cobrado taxa, conforme tabela vigente a cada troca.</p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">6ª - O aluno que optar por Horários Indefinidos deverá assistir no mínimo uma aula por semana. Sua ausência, à aula, será registrada como falta. A reposiçãodesta aula obedecerá a Cláusula 3ª.</p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">7ª - É defeso o acesso a sites pornográficos, e de inteira e exclusiva responsabilidade do CONTRATANTE e/ou responsável legal o conteúdo inserido ou disponibilzado por estes em sites de relacionamento, bem como transmissões via e-mail ou mensagens instantâneas, não havendo ingerência da Escola, por se tratar de instrumentos de propriedade exclusiva de seus idealizadores, posto que a mesma não controla o conteúdo disponibilizado em tais serviços.</p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">8ª - É obrigatória a compra do material didático dos cursos de idiomas. Já os demais cursos, a compra do material didático é opcional. Caso o aluno queira adquiri-los, consultar a tabela.</p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">9ª - Ao final do curso, conforme contrato, será concedido Certificado de Conclusão ao aluno que compareceu no mínimo a 75% das aulas ministradas e obteve aproveitamento igual ou superior a 70%.</p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">10ª - No caso de atraso no pagamento de qualquer parcela, o valor desta será acrescido de multa de 2% e juros de mora de 0,06% ao dia. O atraso, eventual, tolerado após o vencimento não caracteriza uma novação contratual. Esta liberalidade não significa alteração nas datas já previstas para pagamento. </p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">11ª - O contratante terá neste contrato uma taxa de matrícula, no valor de R$100,00. O bônus concedido no boleto bancário, carnê ou qualquer outra forma de pagamento, somente será válido para pagamento antecipado ou até o vencimento da parcela.</p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">12ª - A contratada oferece ao contratante a possiblidade de desistir do presente contrato em até 7 dias úteis, contados a partir da assinatura do presente contrato. Para isso deverá, a contratante, formalizar a intenção por escrito junto a secretaria da contratada.</p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">13ª - Caso a contrtante desista do curso após o início das aulas, pagará o valor proporcional às horas/aulas, compreendido até o momento da formalização por escrito, do seu pedido de desistência do mesmo , mais multa de 10% sobre o valor do curso (inclui-se períodos que o mesmo esteve ausente sem justificativas).</p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">14ª - O contrato poderá ser rescindido pela CONTRATADA em caso de prática pelo ALUNO, de atos de indisciplina ou outros previstos nas Regras da Escola, sendo devidas às mensalidades até a data do efetivo desligamento. Poderá, ainda, responder civil e criminalmente por estes atos ilícitos. </p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">15ª - O contratante/aluno autoriza o uso de sua imagem para divulgação em murais, redes sociais, e-mails, site e(ou) outras mídias. </p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">16ª - Caso seja necessário, por força maior, as aulas poderão acontecer online sem nenhum tipo de prejuízo para o aluno através de aplicativos de chamada ou plataforma EAD. Nesse caso, o aluno continua cumprindo com seus compromissos financeiros. </p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">17ª - O não cumprimento das obrigações pecuniárias expressas no contrato faculta a CONTRATADA a inclusão do CONTRATANTE no cadastro de devedores do Serviço de Proteção ao Crédito - SPC, ou entidade com finalidade semelhante, e caberá ao CONTRATANTE o pagamento de todas as despesas decorrentes desta cobrança. A CONTRATADA dará a quitação após o adimplemento integral dos débitos existentes. </p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">18ª - O contratante declara neste ato ter sido informado das regras e condições técnicas do curso contratado. </p>
        <p style="font-size:10px;margin-right:0%;margin-top:10px;">19ª - Para dirimir questões oriundas do presente contratao, fica eleito o Foro da cidade de Cataguases, renunciando as partes a qualquer outro, por mais privilegiado que possa ser. </p>
        </div>
        <div class="rodape">
        </br>
        <center>
        <p style="font-size:10px;font-weight:bold;margin-top:10px;">'.$cidade.', '.$data.'</p>
        </center>
        <div class="littleesquerdo">
        </br>
        </br>
        <center>
         <p>________________________</p>
        <p style="font-size:10px;font-weight:bold;margin-top:10px;"> '.$resp.' </p>
        <p style="font-size:10px;font-weight:bold;margin-top:10px;"> Representante Legal </p>
        </center>
        
        </div>
          <div class="littledireito">
         </br>
         </br>
           <center>
         <p style="margin-right:50%;">________________________</p>
         <p style="font-size:10px;font-weight:bold;margin-right:50%;margin-top:10px;"> GUERRA & NASCIMENTO EMPREENDIMENTOS LTDA </p>
         <p style="font-size:10px;font-weight:bold;margin-right:50%;margin-top:10px;"> Contratado </p>
         </center>
        
        </div>
        
        </div>
        
            
            </body>
       
        </html>
     '
                         );}
      
      if(!empty($nome_franqueado)){
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
            
            .esquerdo{
            float:left;
            width:300px;
            display: block;
            }
            
            .littledireito{
            float:right;
            width:300px;
            display: block;
            }
            
            .direito{
            float:right;
            width:200px;
            display: block;
            position: fixed;
            }
            
            .littleesquerdo{
            float:left;
            width:400px;
            display: block;
            }
            </style>
        </head>
        <body>
        <div class="info">
        <img src="data:image/jpeg;base64,'.base64_encode($logo).'"/>
        <p style="font-size:13px;font-weight:bold;margin-left:54%;margin-top:30px;">CONTRATO DE PRESTAÇÃO DE SERVIÇOS</p>
        <p>_______________________________________________________________________________</p>
        <div class="esquerdo">
        <p style="font-size:10px;margin-top:20px;">Nº do Contrato: - </p>
        <p style="font-size:10px;margin-top:10px;">Convênio:  - </p>
        <p style="font-size:10px;margin-top:10px;">Nº de Parcelas: '.$parcelas.' </p>
        <p style="font-size:10px;margin-top:10px;">Valor Entrada:  R$0,00</p>
        <p style="font-size:10px;margin-top:10px;">Valor do Curso com Desconto: R$'.$precototal.',00</p>
        <p style="font-size:10px;margin-top:10px;">Valor do Curso sem Desconto: R$'.$precototal.',00 </p>
        <p>_______________________________________________________________________________</p>
        <p style="font-size:10px;margin-top:20px;">Cursos Contratados: </p>
        <p style="font-size:10px;font-weight:bold;margin-top:10px;"> '.$nomeCurso.'</p>
        <p>_______________________________________________________________________________</p>
        <p style="font-size:10px;margin-top:20px;">Horários: </p>
        <p style="font-size:10px;font-weight:bold;margin-top:10px;"> '.$dia.' </p>
        <p>_______________________________________________________________________________</p>
        <p style="font-size:10px;font-weight:bold;margin-top:20px;">Contratado: </p>
        <p style="font-size:10px;margin-top:10px;"> Razão Social:</p>
        <p style="font-size:10px;margin-top:10px;"> Nome Fantasia: '.$emp_nome.'</p>
        <p style="font-size:10px;margin-top:10px;"> CNPJ: '.$emp_cnpj.'</p>
        <p style="font-size:10px;margin-top:10px;"> Telefone: '.$emp_tel.'</p>
        <p style="font-size:10px;margin-top:10px;"> Endereço: '.$emp_end.'</p> 
        <p>_______________________________________________________________________________</p>
        <p style="font-size:10px;font-weight:bold;margin-top:20px;">Contratante: </p>
        <p style="font-size:10px;;margin-top:10px;"> Nome: '.$nome.'</p>
        <p style="font-size:10px;margin-top:10px;"> Endereço: '.$end.'</p>
        <p style="font-size:10px;margin-top:10px;"> CEP: '.$cep.'</p>
        <p style="font-size:10px;margin-top:10px;"> Telefone: '.$tel.'</p>
        <p style="font-size:10px;margin-top:10px;"> Data de Nascimento: '.$nasc.'</p>
        <p style="font-size:10px;margin-top:10px;"> RG: '.$rg.'</p>
        <p style="font-size:10px;margin-top:10px;"> CPF: '.$cpf.'</p>
        <p>_______________________________________________________________________________</p>
        <p style="font-size:10px;font-weight:bold;margin-top:20px;">Representante Legal: </p>
        <p style="font-size:10px;margin-top:10px;"> Nome: '.$resp.'</p>
        <p style="font-size:10px;margin-top:10px;"> Endereço: '.$end.'</p>
        <p style="font-size:10px;margin-top:10px;"> CEP: '.$respcep.'</p>
        <p style="font-size:10px;margin-top:10px;"> Telefone: '.$resptel.'</p>
        <p style="font-size:10px;margin-top:10px;"> Data de Nascimento: '.$respnasc.'</p>
        <p style="font-size:10px;margin-top:10px;"> RG: '.$resprg.'</p>
        <p style="font-size:10px;margin-top:10px;"> CPF: '.$respcpf.'</p>
        </div>
        <div class="direito">
        <p style="font-size:10px;margin-left:1%;margin-top:20px;">Código do Aluno: '.$id_Aluno.' </p>
        <p style="font-size:10px;margin-left:1%;margin-top:10px;">Desconto: 0% </p>
        <p style="font-size:10px;margin-left:1%;margin-top:10px;">1º Vencimento: '.$data_limite.' </p>
        <p style="font-size:10px;margin-left:1%;margin-top:10px;">Carga Horária: '.$cargahoraria.' </p>
        <p style="font-size:10px;margin-left:1%;margin-top:10px;">Valor da Parcela com Desconto: R$'.$precopparcela.'</p>
        <p style="font-size:10px;margin-left:1%;margin-top:10px;">Valor da Parcela sem Desconto: R$'.$precopparcela.' </p>
        </br>
           
        </div>
        
        </div>
        <p class="break"> </p>
        <div class="texto">
        </br>
        </br>
         <p style="font-size:10px;margin-right:0%;margin-top:10px;"> '.$clausulas.'</p>
        </div>
        <div class="rodape">
        </br>
        <center>
        <p style="font-size:10px;font-weight:bold;margin-top:10px;">'.$cidade.', '.$data.'</p>
        </center>
        <div class="littleesquerdo">
        </br>
        </br>
        <center>
         <p>________________________</p>
        <p style="font-size:10px;font-weight:bold;margin-top:10px;"> '.$resp.' </p>
        <p style="font-size:10px;font-weight:bold;margin-top:10px;"> Representante Legal </p>
        </center>
        
        </div>
        <div class="littledireito">
         </br>
         </br>
           <center>
         <p style="margin-right:50%;">________________________</p>
         <p style="font-size:10px;font-weight:bold;margin-right:50%;margin-top:10px;"> '.$emp_nome.' </p>
         <p style="font-size:10px;font-weight:bold;margin-right:50%;margin-top:10px;"> Contratado </p>
         </center>
        
        </div>
        
        </div>
        
            
            </body>
       
        </html>
     '
                         );}
      
    
        //Renderização do arquivo PDF
        $dompdf->render();

        //Imprime o conteudo do pdf na tela
        header('Content-type: application/pdf');
        echo $dompdf->output();
    
    ?>

