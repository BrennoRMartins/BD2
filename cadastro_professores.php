<?php
require_once('dbconnection_postgres.php');
?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cpf = $_POST["cpf"];
        $nome = $_POST["nome"];
        $data_nascimento = $_POST["data_nascimento"];
        $cargo = $_POST["cargo"];
      
         if (isset($_FILES["curriculo"]) && $_FILES["curriculo"]["error"] == UPLOAD_ERR_OK) {
  
          $curriculo_pdf = file_get_contents($_FILES["curriculo"]["tmp_name"]);
      
          $conn = new PDO("pgsql:host=localhost;dbname=EscolaTrabalhoBD2", $user, $password);
      
          $stmt = $conn->prepare("INSERT INTO Professor(cpf, nome, data_nasc, cargo, curriculo) VALUES (?, ?, ?, ?, ?)");
          $stmt->bindParam(1, $cpf);
          $stmt->bindParam(2, $nome);
          $stmt->bindParam(3, $data_nascimento);
          $stmt->bindParam(4, $cargo);
          $stmt->bindParam(5, $curriculo_pdf, PDO::PARAM_LOB);
      
         
          if ($stmt->execute()) {
            echo "Professor cadastrado com sucesso";
          } else {
            echo "Erro ao cadastrar o professor";
          }
        } else {
          echo "Erro no upload do curriculo";
        }
      }
    }
      ?>
    