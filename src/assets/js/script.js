

$(function () {
  // mascara para o campo cnpj
  $("#inputCnpj").mask("99.999.999/9999-99", { reverse: true });
  // mascara para celular/telefone
  var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00)00000-0000' : '(00)0000-00009';
  },
    spOptions = {
      onKeyPress: function (val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
    };

  $('#inputTel').mask(SPMaskBehavior, spOptions);

  criaSelectContrante();
  criaSelectEvento();

});

// atualiza a tabela html de registro
function criaSelectContrante() {

  var url = window.location.href;
  url = url.split("/"); //quebra o endeço de acordo com a / (barra)
  var url_script_php = "http://" + url[2] + "/" + url[3] + "/201902/ProjetoFinal_ES_20192/src/controllers/getAllContratantes.php";

  /* Ajax */
  $.ajax({
    type: "POST",
    url: url_script_php,
    async: true,
    data: "",
    dataType: 'json',
    success: function (data) { /* sucesso */
      console.log(data)
      $("#selectContratante").html(data.message);
    },
    beforeSend: function () { /* antes de enviar */

    },
    complete: function () { /* completo */


    }
  });
}


// atualiza a tabela html de registro
function criaSelectEvento() {

  var url = window.location.href;
  url = url.split("/"); //quebra o endeço de acordo com a / (barra)
  var url_script_php = "http://" + url[2] + "/" + url[3] + "/201902/ProjetoFinal_ES_20192/src/controllers/getAllEventos.php";

  /* Ajax */
  $.ajax({
    type: "POST",
    url: url_script_php,
    async: true,
    data: "",
    dataType: 'json',
    success: function (data) { /* sucesso */
      console.log(data)
      $("#selectEvento").html(data.message);
    },
    beforeSend: function () { /* antes de enviar */

    },
    complete: function () { /* completo */


    }
  });
}


// atualiza a tabela html de registro
function atualizaTabela() {

  var url = window.location.href;
  url = url.split("/"); //quebra o endeço de acordo com a / (barra)
  var url_script_php = "http://" + url[2] + "/" + url[3] + "/201902/ProjetoFinal_ES_20192/src/controllers/registros_cadastrados.php";
  
  /* Ajax */
  $.ajax({
    type: "POST",
    url: url_script_php,
    async: true,
    data: "",
    dataType: 'json',
    success: function (data) { /* sucesso */
      console.log(data)
      if (data.success) {
        $('.table tbody').html(data.message);
      }
    },
    beforeSend: function () { /* antes de enviar */

    },
    complete: function () { /* completo */


    }
  });
}


// Submit do form de cadastro
$(document).on("submit", "#form-cadastro", function (event) {
  event.preventDefault();


  var url = window.location.href;
  url = url.split("/"); //quebra o endeço de acordo com a / (barra)
  var url_script_php = "http://" + url[2] + "/" + url[3] + "/201902/ProjetoFinal_ES_20192/src/controllers/cadastrar_registro.php";


  /* Ajax */
  $.ajax({
    type: "POST",
    url: url_script_php,
    async: true,
    data: $(this).serialize(),
    dataType: "json",
    success: function (data) { /* sucesso */

      if (data.success) {

        $('.retornoForms').addClass('alert-success');
        $('.conteudoRetorno').html('Cadastrado com sucesso');
        atualizaTabela();

      } else {

        $('.retornoForms').removeClass('alert-success');
        $('.retornoForms').addClass('alert-danger');
        $('.conteudoRetorno').html('ERRO: ' + data.message);
        $('.retornoForms').fadeIn('fast');
      }

    },
    beforeSend: function () { /* antes de enviar */
      $('.retornoForms').removeClass('alert-danger');
      $('.retornoForms').addClass('alert-success');
      $('.conteudoRetorno').html('Enviando ...');
      $('.retornoForms').css("display", "block");
    },
    complete: function () { /* completo */
      $('#form-cadastro')[0].reset();
      setTimeout(() => {
        $('.retornoForms').css("display", "none");
      }, 5000);
    }
  });
});

// Submit do form de edição
$(document).on("submit", "#form-edita-registro", function (event) {
  event.preventDefault();

  var url = window.location.href;
  url = url.split("/"); //quebra o endeço de acordo com a / (barra)
  var url_script_php = "http://" + url[2] + "/" + url[3] + "/201902/ProjetoFinal_ES_20192/src/controllers/editar_registro.php";


  /* Ajax */
  $.ajax({
    type: "POST",
    url: url_script_php,
    async: true,
    data: $(this).serialize(),
    dataType: "json",
    success: function (data) { /* sucesso */

      if (data.success) {
        $('.retornoForms').addClass('alert-success');
        $('.conteudoRetorno').html('Editado com sucesso');
        atualizaTabela();
        $('#modalEditarRegistro').modal('hide');


      } else {

        $('.retornoForms').removeClass('alert-success');
        $('.retornoForms').addClass('alert-danger');
        $('.conteudoRetorno').html('ERRO: ' + data.message);
        $('.retornoForms').fadeIn('fast');
      }

    },
    beforeSend: function () { /* antes de enviar */
      $('.retornoForms').removeClass('alert-danger');
      $('.retornoForms').addClass('alert-success');
      $('.conteudoRetorno').html('Editando ...');
      $('.retornoForms').css("display", "block");
    },
    complete: function () { /* completo */
      $('#form-cadastro')[0].reset();
      setTimeout(() => {
        $('.retornoForms').css("display", "none");
      }, 5000);
    }
  });
});

// Preenche modal com dados do registro que será editado
$(document).on("click", ".edita", function () {
  // e.preventDefault();
  var id = $(this).attr("cod");
  $("#orcamento_id_editar").val(id);

  var url = window.location.href;
  url = url.split("/"); //quebra o endeço de acordo com a / (barra)
  var url_script_php = "http://" + url[2] + "/" + url[3] + "/201902/ProjetoFinal_ES_20192/src/controllers/dados_registro_edicao.php";

  /* Ajax */
  $.ajax({
    type: "POST",
    url: url_script_php,
    data: { 'id': id },
    dataType: "json",
    success: function (data) { /* sucesso */

      if (data.success) {
        $('#form-edita-registro')[0].reset();
        $('#inputDataValidadeEdit').val(data.listaDeOrcamentos[0].validade);
        $('#inputValorEdit').val(data.listaDeOrcamentos[0].valor);
        $('#orcamento_id_editar').val(data.listaDeOrcamentos[0].id);
        $('#modalEditarRegistro').modal('show');
        
      }

    }
  });
});

// Remove registro da tabela no evento do click de confirmação do modal
$(document).on("click", "#removerRegistro", function () {
  // e.preventDefault();

  var id = $(this).attr("cod");
  console.log(id)

  var url = window.location.href;
  url = url.split("/"); //quebra o endeço de acordo com a / (barra)
  var url_script_php = "http://" + url[2] + "/" + url[3] + "/201902/ProjetoFinal_ES_20192/src/controllers/deletar_registro.php";

  /* Ajax */
  $.ajax({
    type: "POST",
    url: url_script_php,
    data: { 'id': id },
    dataType: "json",
    success: function (data) { /* sucesso */


      if (data.success) {
        $('.retornoForms').addClass('alert-success');
        $('.conteudoRetorno').html('Removido com sucesso');
        atualizaTabela();
        $('#modalConfirmaExclusao').modal('hide');


      } else {

        $('.retornoForms').removeClass('alert-success');
        $('.retornoForms').addClass('alert-danger');
        $('.conteudoRetorno').html('ERRO: ' + data.message);
        $('.retornoForms').fadeIn('fast');
      }

    },
    beforeSend: function () { /* antes de enviar */
      $('.retornoForms').removeClass('alert-danger');
      $('.retornoForms').addClass('alert-success');
      $('.conteudoRetorno').html('Deletando ...');
      $('.retornoForms').css("display", "block");
    },
    complete: function () { /* completo */
      $('#form-cadastro')[0].reset();
      setTimeout(() => {
        $('.retornoForms').css("display", "none");
      }, 5000);
    }
  });
});

// abre o modal de confirmação de exclusão
$(document).on("click", ".remove", function () {

  var cod = $(this).attr("cod");
  $("#removerRegistro").attr("cod", cod);

  $('#modalConfirmaExclusao').modal('show');

});

