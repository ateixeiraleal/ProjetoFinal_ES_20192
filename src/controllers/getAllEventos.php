<?php 
// configurações do banco
include("../config/db.php");


$sql = "SELECT codigo, descricao FROM EVENTO";
$mensagem_retorno = "<option selected>Escolha o evento</option>";

if ($result = mysqli_query($mysqli, $sql)) {
  while ($obj = mysqli_fetch_object($result)) {
    $mensagem_retorno .= "  <option value='" . $obj->codigo ."'>$obj->descricao </option>";
  }
  // Free result set
  mysqli_free_result($result);

  echo json_encode(
    array(
      'success' => true,
      'message' => $mensagem_retorno
    )
  );
} else {
  echo json_encode(
    array(
      'success' => false,
      'message' => "Erro consulta sql"
    )
  );
}

$mysqli->close();





?>