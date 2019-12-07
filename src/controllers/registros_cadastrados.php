 <?php 
 // configurações do banco
include("../config/db.php");

// $sql = "SELECT * FROM BUFFET WHERE 1 ORDER BY BUFFET.nome ASC";
$sql = "SELECT * FROM `ORCAMENTO` O JOIN `EVENTO` E ON(O.EVENTO_codigo = E.codigo)";

// $data = $obj->dataNascimento;
$mensagem_retorno = "";

if ($result = mysqli_query($mysqli, $sql)) {
  while ($obj = mysqli_fetch_object($result)) {
    $mensagem_retorno .= "<tr>";
    $mensagem_retorno .= "  <td>$obj->descricao </td>";
    $mensagem_retorno .= "  <td>$obj->inicio</td>";
    $mensagem_retorno .= "  <td>$obj->termino</td>";
    $mensagem_retorno .= "  <td>$obj->data_validade</td>";
    $mensagem_retorno .= "  <td>$obj->valor</td>";
    $mensagem_retorno .= "  <td class='text-center'> <a href='#' class='edita'  cod='$obj->codigo' ><i class='fas fa-user-edit'></i></a> </td>";
    $mensagem_retorno .= "  <td class='text-center'> <a href='#' class='remove' cod='$obj->codigo' ><i class='fas fa-user-minus'></i></a> </td>";
    $mensagem_retorno .= "</tr>";
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


?> 