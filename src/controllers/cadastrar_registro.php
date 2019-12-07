<?php 
// configurações do banco
include("../config/db.php");

// valores do formulario recebidos via post
$validade = $_POST["inputDataValidade"];
$contratante = $_POST['selectContratante'];
$evento = $_POST["selectEvento"];
$valor = $_POST["inputValor"];
$data_cadastro = date("Y/m/d");



$sql = "INSERT INTO ORCAMENTO (`data`, data_validade, CONTRATANTE_id, EVENTO_codigo, valor)
      VALUES ('$data_cadastro','$validade', '$contratante', '$evento', '$valor')";

if ($mysqli->query($sql) === true) {
  echo json_encode(
    array(
      'success' => true,
      'message' => 'Cadastrado com sucesso'
    )
  );
} else {
  echo json_encode(
    array(
      'success' => false,
      'message' => "Error: " + $mysqli->error
    )
  );
}


  $mysqli->close();





?>