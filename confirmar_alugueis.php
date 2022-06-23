<html>
  <head>
    <title>Confirmar Reservas</title>
    <meta charset="utf-8"/> 
  </head>
    
<body>


<?php

//Comandos para acessar o banco de dados 
$servername = "sql208.epizy.com";
$username = "epiz_26913849";
$password = "Ber6t04YUO";
$dbname = "epiz_26913849_nara17";

$conn = mysqli_connect($servername, $username, $password);


if (!$conn) {
  die("Conexão Falhou: " . mysqli_connect_error());
}
echo "Conexão Estabelecida! <BR><BR>";

// Selecionar banco
if (!mysqli_select_db($conn,$dbname)) {
    echo "Foi impossível selecionar o banco de dados \"$dbname\": " . mysqli_error($conn);
    exit;
}
    
$stmt = mysqli_stmt_init($conn);

//Variável de preparo dos comandos SQL
$horario_atualizado= $_GET['horario'];
$dia_atualizado= $_GET['dia'];
$stmt_prepared_okay =  mysqli_stmt_prepare($stmt,  "UPDATE aluguel_barcos SET confirmacao = 1 Where horario = '$horario_atualizado' and dia = '$dia_atualizado' ");   

if ($stmt_prepared_okay) {
    //prepara os parãmetros
    mysqli_stmt_bind_param($stmt, "s",$horario_atualizado);
    
    $stmt_executed_okay = mysqli_stmt_execute($stmt);

    if ($stmt_executed_okay) {
	   echo "CONFIRMADO";
    } else {
        echo "Não foi possível realizar a confirmação";
         
             mysqli_error($conn);
        exit;
    }
      mysqli_stmt_close($stmt);
}

// fecha conexão
mysqli_close($conn);

header("Location: consultar_alugueis.php");

?>

</body>
</html>