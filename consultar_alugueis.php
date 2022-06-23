<html>
  <head>
        <title>TABELA DE RESERVAS</title>
        <meta charset="utf-8"/> 
        <style>
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 70%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 3px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }
        </style>
  </head>
    
<body> 
<center><h1> RESERVAS <h1></center>
<?php
    
//Comandos de acesso ao banco de dados 
$servername = "sql208.epizy.com";
$username = "epiz_26913849";
$password = "Ber6t04YUO";
$dbname = "epiz_26913849_nara17";

$conn = mysqli_connect($servername, $username, $password);


if (!$conn) 
{
  die("Falha na Conexão: " . mysqli_connect_error());
}
echo "<BR>";


// Selecionar banco
if (!mysqli_select_db($conn, $dbname)) 
{
    echo "Foi impossível de selecionar o banco de dados \"$dbname\": " . mysqli_error($conn);
    exit;
}


$sql = "SELECT nome, telefone, dia, horario, confirmacao FROM aluguel_barcos";
    
$stmt = mysqli_stmt_init($conn);    
$stmt_prepared_okay = mysqli_stmt_prepare($stmt, $sql);  
  
/* create a prepared statement */
if ($stmt_prepared_okay) 
{
    // Prepara os parametros
    mysqli_stmt_bind_param($stmt, "ss", $dia,$horario);

    // executa a query
    mysqli_stmt_execute($stmt);

    // liga as variávais de resultado 
    mysqli_stmt_bind_result($stmt, $nome, $telefone, $dia, $horario, $confirmacao);

    /* busca os valores */
    while(mysqli_stmt_fetch($stmt))
    {
          echo "<center><table>
    <tr>
      <th>Nome</th>
      <th>Contato</th>
      <th>Dia Reservado</th>
      <th>Horário Reservado</th>
      <th>Status</th>
    </tr>
    <tr>
      <td> $nome</td>
      <td> $telefone</td>
      <td> $dia</td>
      <td> $horario</td>
      <td></center>";
      if($confirmacao == 0)
      {
        echo "<a href=confirmar_alugueis.php?horario=$horario&dia=$dia>CONFIRMAR</a>";
      }
      else
      {
        echo"CONFIRMADO";
      }    
      echo"
      </td>
      </tr>
      </table>";
    }

    // close statement
    mysqli_stmt_close($stmt);
}    
    
?>
    <br> <a href = "index.html"><center><button>Voltar</button></center></a>
</body>
</html> 