<html>
  <head>
    <title>INSERIR RESERVA</title>
    <meta charset="utf-8"/> 
  </head>
    
<body> 

<?php

//comandos para acessar o banco de dados 
$servername = "sql208.epizy.com";
$username = "epiz_26913849";
$password = "Ber6t04YUO";
$dbname = "epiz_26913849_nara17";

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) 
{
  die("Conexão Falhou: " . mysqli_connect_error());
}
echo "<BR><BR>";


// Selecionando o nosso banco de dados criado no infinity
if (!mysqli_select_db($conn, $dbname)) 
{
    echo "Foi impossível de selecionar os dados \"$dbname\": " . mysqli_error($conn);
    exit;
}

//Atribui o comando de inicializar a uma 'variavel' para ficar mais organizado    
$stmt = mysqli_stmt_init($conn);


//uma 'variável' pra preparar os comandos SQL
$stmt_prepared_okay =  mysqli_stmt_prepare($stmt, "INSERT INTO aluguel_barcos (nome, telefone, dia, horario) VALUES (?, ?, ?, ?)");   

if ($stmt_prepared_okay) 
{
    //Preparar os parâmetros
    mysqli_stmt_bind_param($stmt, "ssss", $nome, $telefone, $dia, $horario);
    
    //// Variaveis para armazenar os valores
    $nome = $_GET['nome'];                  
    $telefone = $_GET['telefone'];
    $dia = $_GET['dia'];        
    $horario = $_GET['horario'];
    $stmt_executed_okay = mysqli_stmt_execute($stmt);

    if ($stmt_executed_okay) 
    {
     echo "<center>FOI RESERVADO COM SUCESSO! <br> ATENÇÃO: NÃO ESQUEÇA DE CONFIRMAR SEU ALUGUEL! <br> Caso não confirme, seu aluguel não será aceito. </center>" ;

    } else {
        echo "<center>NÃO FOI POSSÍVEL RESERVAR! <br> ALGUÉM JÁ RESERVOU ESSE HORÁRIO NESTE MESMO DIA. <br> Por favor, consulte a nossa tabela de reservas e veja um horário livre. <br>                <a href = consultar_alugueis.php> <br> <br> <button>Tabela de Reservas</button> </center> </a>";
             mysqli_error($conn);
        exit;
    }
      //fechar mysql
      mysqli_stmt_close($stmt);
}

// fechar conexão
mysqli_close($conn);    

?>

<br><br><a href = "consultar_alugueis.php"><center><button>Tabela de Reservas</button></center> </a>


</body>
</html>