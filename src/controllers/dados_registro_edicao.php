 <?php 
 // configurações do banco
include("../config/db.php");

if (!empty($_POST)) {
  if (isset($_POST['id'])) {
    if (!empty($_POST['id'])) {
      $id = $_POST['id'];

      // Query para verificar se tem o id no banco
      //$sql = "SELECT * FROM ORCAMENTO WHERE id = '$id'";

      $sql = "SELECT data_validade, valor FROM `ORCAMENTO` WHERE ORCAMENTO.codigo = '$id'";
      if ($result = mysqli_query($mysqli, $sql)) {

        while ($obj = mysqli_fetch_object($result)) {
          $list[] = array(
            'success' => true,
            'validade' => $obj->data_validade,
            'valor' => $obj->valor,
            'id' => $id
          );
        }


        echo json_encode(
          array(
            'success' => true,
            'listaDeOrcamentos' => $list
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
    } else {
      echo json_encode(
        array(
          'success' => false,
          'message' => "id não definido"
        )
      );
    }

  }

}


?> 