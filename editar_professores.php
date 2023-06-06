<?php
require_once('dbconnection_postgres.php');
$conn = new PDO("pgsql:host=localhost;dbname=EscolaTrabalhoBD2", $user, $password);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST["cpf"];
    $nome = $_POST["nome"];
    $data_nascimento = $_POST["data_nascimento"];
    $cargo = $_POST["cargo"];

  $stmt = $conn->prepare("UPDATE professor SET nome = ?, data_nasc = ?, cargo = ? WHERE cpf = ?");
  $stmt->bindParam(1, $nome);
  $stmt->bindParam(2, $data_nascimento);
  $stmt->bindParam(3, $cargo);
  $stmt->bindParam(4, $cpf);
  $stmt->execute();

  header("Location: listar_professores.php");
  exit();
} else {
  $cpf = $_GET["cpf"];

  $stmt = $conn->prepare("SELECT cpf, nome, data_nasc, cargo FROM professor WHERE cpf = ?");
  $stmt->bindParam(1, $cpf);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nome = $row["nome"];
    $data_nascimento = $row["data_nasc"];
    $cargo = $row["cargo"];
  } else {
    header("Location: listar_editar.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2>Editar Professor</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="cpf">CPF:</label>
        <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $cpf;?>" readonly>
      </div>
      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome;?>">
      </div>
      <div class="form-group">
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $data_nascimento;?>">
      </div>
      <div class="form-group">
        <label for="nome">Cargo:</label>
        <input type="text" class="form-control" id="cargo" name="cargo" value="<?php echo $cargo;?>">
      </div>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
  </div>
</body>
</html>