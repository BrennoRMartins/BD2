<!DOCTYPE html>
<?php
require_once('dbconnection_postgres.php');?>
<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2>Lista de Professores</h2>
    <table class="table">
      <thead>
        <tr>
          <th>CPF</th>
          <th>Nome</th>
          <th>Data de Nascimento</th>
          <th>Currículo</th>
          <th>Cargo</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $conn = new PDO("pgsql:host=localhost;dbname=EscolaTrabalhoBD2", $user, $password);

        $stmt = $conn->query("SELECT cpf, nome, data_nasc, curriculo, cargo FROM professor");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<td>".$row["cpf"]."</td>";
          echo "<td>".$row["nome"]."</td>";
          echo "<td>".$row["data_nasc"]."</td>";
          echo "<td>".$row["cargo"]."</td>";
          echo "<td><a href='download_curriculo.php?cpf=".$row["cpf"]. "'>Download</a></td>";
          echo "<td>";
          echo "<a href='editar_professores.php?cpf=" .$row["cpf"]."'>Editar</a> | ";
          echo "<a href='deletar_professores.php?cpf=" .$row["cpf"]."'>Excluir</a>";
          echo "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>