<?php
require_once('dbconnection_postgres.php');

$conn = new PDO("pgsql:host=localhost;dbname=EscolaTrabalhoBD2", $user, $password);
$cpf= $_GET["cpf"];

$stmt = $conn->prepare("SELECT curriculo FROM professor WHERE cpf = ?");
$stmt->bindParam(1, $cpf);
$stmt->execute();


if ($stmt->rowCount() > 0) {
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $curriculo = $row["curriculo"];

  $filename = "curriculo_" . $cpf . ".pdf";

  header("Content-Type: application/pdf");
  header("Content-Disposition: attachment; filename=" . $filename . "");
  header("Content-Length: " . strlen($curriculo));

  echo $curriculo;
} else {
  echo "Currículo não encontrado.";
}
?>