
<?php include("./config/db.php"); ?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Trabalho Final - Cadastro de Orçamento</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">
    <link href="./assets/css/all.css" rel="stylesheet">

    <!-- scripts -->
    <script src="./assets/js/jquery-3.3.1.min.js"></script>
    <script src="./assets/js/jquery.mask.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/script.js"></script>


    
  </head>

  <body class="bg-light">

    <h1 class="text-center titulo">Trabalho Final - Cadastro de Orçamento</h1>

    <!-- FORMULARIO DE CADASTRO -->
    <div class="container container-form-cadastro">
      <form id="form-cadastro">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputDataValidade">Data válidade</label>
            <input type="date" class="form-control" id="inputDataValidade" name="inputDataValidade" placeholder="Data Válidade">
          </div>
          <div class="form-group col-md-6">
            <label for="selectContratante">Contratante</label>
            <select class="form-control" id="selectContratante" name="selectContratante"></select>
          </div>
          
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="selectEvento">Evento</label>
            <select class="form-control" id="selectEvento" name="selectEvento"></select>
          </div>
          <div class="form-group col-md-6">
            <label for="inputValor">Valor</label>
            <input type="number" class="form-control" id="inputValor" name="inputValor" min="0.00" step="0.01">
          </div>
        </div>
        
        <button type="submit" class="btn btn-dark float-right">Cadastrar</button>
      </form>
    </div>

    <!-- TABELA PARA MOSTRAR OS REGISTROS DO BANCO -->
    <div class="container">
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Evento</th>
            <th scope="col">Data Início</th>
            <th scope="col">Data Termino</th>
            <th scope="col">Válidade Orçamento</th>
            <th scope="col">Valor</th>
            <th class="text-center" scope="col">Editar</th>
            <th class="text-center" scope="col">Deletar</th>
          </tr>
        </thead>
        <tbody>

          <?php 

          $sql = "SELECT * FROM `ORCAMENTO` O JOIN `EVENTO` E ON(O.EVENTO_codigo = E.codigo)";
          if ($result = mysqli_query($mysqli, $sql)) {
            while ($obj = mysqli_fetch_object($result)) {; 
              $dti = date('d/m/Y h:m',strtotime($obj->inicio)); 
              $dtf = date('d/m/Y h:m',strtotime($obj->termino)); 
              $dtv = date('d/m/Y',strtotime($obj->data_validade));?>
            <tr>
              <td><?php echo $obj->descricao; ?></td>
              <td><?php echo $dti; ?></td>
              <td><?php echo $dtf; ?></td>
              <td><?php echo $dtv; ?></td>
              <td><?php echo $obj->valor; ?></td>
              <td class="text-center"><a href="#" class="edita"  cod="<?php echo $obj->codigo; ?>"><i class="fas fa-user-edit"></i></a></td>
              <td class="text-center"><a href="#" class="remove" cod="<?php echo $obj->codigo; ?>" ><i class="fas fa-user-minus"></i></a></td>
            </tr>
              <?php

            }
            // Free result set
            mysqli_free_result($result);
          }
          ?> 
        </tbody>
      </table>
    </div>

    

    <!-- MODAL EDITAR REGISTRO -->
    <div class="modal fade" id="modalEditarRegistro" tabindex="-1" role="dialog" aria-labelledby="modalEditarRegistroLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-edit"></i> Editar Registro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <!-- FORM ATUALIZAR REGISTRO -->
            <form id="form-edita-registro">
              <input type="hidden" id="cnpjParaEditar" name="cnpjParaEditar" value="">
              <input type="hidden" id="telParaEditar" name="telParaEditar" value="">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="inputNomeEdit">Nome*</label>
                  <input type="text" class="form-control" id="inputNomeEdit" name="inputNomeEdit" placeholder="Nome">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputCnpjEdit">cnpj*</label>
                  <input type="text" class="form-control" id="inputCnpjEdit" name="inputCnpjEdit" placeholder="cnpj">
                </div>

                <div class="form-group col-md-4">
                  <label for="inputTelEdit">Telefone/Celular</label>
                  <input type="tel" class="form-control" id="inputTelEdit" name="inputTelEdit">
                </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-dark float-right">Editar</button>
              </div>
            </form>


          </div>
          
        </div>
      </div>
    </div>


    <!-- MODAL DE CONFIRMAÇÃO DA EXCLUSÃO -->
    <div class="modal fade" id="modalConfirmaExclusao" tabindex="-1" role="dialog" aria-labelledby="modalConfirmaExclusaoLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-minus"></i> Excluir Registro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4>Deseja realmente excluir esse registro???</h4>           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" id="removerRegistro" class="btn btn-danger float-right">Excluir</button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xs-12 col-sm-4 retornoForms float-right alert">
        <p class="conteudoRetorno"></p>
    </div>
  </body>
</html>