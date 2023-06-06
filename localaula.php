<!DOCTYPE html>
<?php require_once('dbconnection_postgres.php');?>
<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2>Locais e Horários de Aula</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Aula</th>
          <th>Modalidade</th>
          <th>Local</th>
          <th>Endereço</th>
          <th>Horário</th>
        </tr>
      </thead>
      <tbody>
        <?php
       $conn = new PDO("pgsql:host=localhost;dbname=EscolaTrabalhoBD2", $user, $password);
        $stmt = $conn->query("SELECT aula, modalidade, local, endereco, horario FROM viewlocalaula");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>";
          echo "<td>".$row["aula"]."</td>";
          echo "<td>".$row["modalidade"]."</td>";
          echo "<td>".$row["local"]."</td>";
          echo "<td>".$row["endereco"]."</td>";
          echo "<td>".$row["horario"]."</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>