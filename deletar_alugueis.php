<html>
  <head>
    <title>DELETAR RESERVAS</title>
    <meta charset="utf-8"/> 
  </head>
    
<body> 

<?php

//Comando para acessar o banco de dados 
$servername = "sql208.epizy.com";
$username = "epiz_26913849";
$password = "Ber6t04YUO";
$dbname = "epiz_26913849_nara17";

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) 
{
  die("Conexão Falhou: " . mysqli_connect_error());
}
echo "Conexão Estabelecida! <BR><BR>";


// Seleciona banco
if (!mysqli_select_db($conn, $dbname)) 
{
    echo "Foi impossível de selecionar o banco de dados \"$dbname\": " . mysqli_error($conn);
    exit;
}
   
$stmt = mysqli_stmt_init($conn);

$num_deletado = $_GET['numc'];

//Variável que prepara os comandos do SQL
$stmt_prepared_okay =  mysqli_stmt_prepare($stmt, "DELETE FROM aluguel_barcos WHERE confirmacao = 0");   

if ($stmt_prepared_okay) 
{
    //prepara os parâmetros
    mysqli_stmt_bind_param($stmt);
    
    $stmt_executed_okay = mysqli_stmt_execute($stmt);

    if ($stmt_executed_okay) 
    {
	   echo "Os dados foram excluídos permanentemente!";

    } else {
             mysqli_error($conn);
        exit;
    }
      mysqli_stmt_close($stmt);
}

// fecha a conexão
mysqli_close($conn);    

?>

</body>
</html>