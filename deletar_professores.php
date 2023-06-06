<?php
require_once('dbconnection_postgres.php');
$conn = new PDO("pgsql:host=localhost;dbname=EscolaTrabalhoBD2", $user, $password);
$cpf = $_GET["cpf"];
$stmt = $conn->prepare("SELECT cpf, nome, data_nasc,cargo FROM professores WHERE cpf = ?");
$stmt->bindParam(1, $cpf);
$stmt->execute();

if ($stmt->rowCount() > 0) {
  $stmtExcluir = $conn->prepare("DELETE FROM Professor WHERE cpf = ?");
  $stmtExcluir->bindParam(1, $cpf);
  $stmtExcluir->execute();
} else {
  header("Location: listar_professores.php");
  exit();
}

header("Location: listar_professores.php");
exit();
?>
