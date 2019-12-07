 <?php 
// configurações do banco
include("../config/db.php");

// id a ser deletado


if (!empty($_POST)) {
  if (isset($_POST['id'])) {
    if (!empty($_POST['id'])) {
      $id = $_POST['id'];

      // Query para verificar se tem o id no banco
      $sql = "DELETE FROM ORCAMENTO WHERE codigo = '$id'";
      if ($mysqli->query($sql) === true) {
        echo json_encode(
          array(
            'success' => true,
            'message' => 'Removido com sucesso'
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