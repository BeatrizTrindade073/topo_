<?php
/* $host = "localhost";
$db   = "podium";
$user = "root";
$pass = "";
$con = mysql_pconnect($host, $user, $pass);
mysql_select_db($db, $con);
$query = sprintf("SELECT nome FROM alunos");
$dados = mysql_query($query, $con) or die(mysql_error());
$linha = mysql_fetch_assoc($dados);
$total = mysql_num_rows($dados);
?>
<html>
	<head>
	<title>Exemplo</title>
</head>
<body>
<?php
	// se o número de resultados for maior que zero, mostra os dados
	if($total > 0) {
		// inicia o loop que vai mostrar todos os dados
		do {
?>
			<p><?=$linha['nome']?></p>
<?php
		// finaliza o loop que vai mostrar os dados
		}while($linha = mysql_fetch_assoc($dados));
	// fim do if
	}
?>
</body>
</html>
<?php
// tira o resultado da busca da memória
mysql_free_result($dados);
?> */


//FAZ A CONEXAO COM O BANCO DE DADOS PODIUM
$host = "localhost";
$user = "root";
$pass = "";
$db = "podium";
$mysqli = new mysqli($host, $user, $pass, $db);
//SELECIONA AS TABELAS ALUNOS E CURSOS
$consulta = "SELECT * FROM alunos";
$consulta2 = "SELECT * FROM cursos";
$con2 = $mysqli->query($consulta2) or die($mysqli->error);
$con = $mysqli->query($consulta) or die($mysqli->error);
if($mysqli->connect_errno){
    echo "falha na conexao: (".$mysqli->connect_errno.") " .$mysqli->connect_error;
}
while($c = mysqli_fetch_array($con)){
	if(isset($_POST['ID_Aluno']) && isset($_POST['Senha'])){
		if($_POST['ID_Aluno'] == $c['ID_Aluno'] && $_POST['Senha'] == $c['Senha']){
			session_start();
			$_SESSION['nome'] = $c['Nome'];
			$_SESSION['ID_Aluno'] = $_POST['ID_Aluno'];
		}	
	}
}
<<<<<<< HEAD

=======
if(isset($_POST['Enviar'])){
	$email = $mysqli->escape_string($_POST['email']);
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error[] = "Email errado";
		echo $error;
	}
	if(count($error) == 0){
	$novasenha = substr(md5(time()) ,0,6);
	$novasenhacrip = md5(md5($novasenha));
	if( mail($email, "Sua Nova Senha", "Sua Nova senha é:" .$novasenha)){
		$sql_code = "UPDATE alunos SET Senha = '$novasenhacrip' WHERE Email = '$email' ";
		$sql_query = $mysqli->query($sqli_code) or die($mysqli->error);
		}
	}
}
>>>>>>> e93416fe6ad831a4e5687ca34d41ca1d06522be3
/*if($contador!=1){
	header('Location: /topo/login.html');
}
else{
}*/
?>
