<?php
$servidor = "localhost";
$porta = "5432";
$db = "EscolaTrabalhoBD2";
$user = "postgres";
$password = "123";
$conexao = pg_connect("host=$servidor port=$porta dbname=$db user=$user password=$password");
?>