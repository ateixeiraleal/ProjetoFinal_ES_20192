<?php 
// configurações do banco
include("../config/db.php");

// valores do formulario recebidos via post
$validade = $_POST["inputDataValidadeEdit"];
$valor = $_POST["inputValorEdit"];
$id = $_POST['orcamento_id_editar'];

$sql = "UPDATE ORCAMENTO SET ORCAMENTO.data_validade = '$validade', ORCAMENTO.valor = '$valor' WHERE ORCAMENTO.codigo = '$id'";
if ($mysqli->query($sql) === true) {
  echo json_encode(
    array(
      'success' => true,
      'message' => 'Editado com sucesso'
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