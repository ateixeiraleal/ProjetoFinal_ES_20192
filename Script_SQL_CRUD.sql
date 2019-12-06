use trabalho;

-- RF003: Cadastro de buffet *MUDAR DADOS DE ENTRADA PELOS RECEBIDOS DO USUÁRIO*
insert into `BUFFET`
values('CNPJ', 'NOME');
insert into `BUFFET_TELEFONES`
values('TELEFONE', 'CNPJ');

-- RF004: Editar dados do buffet *MUDAR DADOS DE ENTRADA PELOS RECEBIDOS DO USUÁRIO*
update `BUFFET` set cnpj = 'CNPJ' where codigo = 'CODIGO';
update `BUFFET` set nome = 'NOME' where codigo = 'CODIGO';

-- RF005: Exclusão dos dados do buffet *MUDAR OS DADOS DE ENTRADA PELOS RECEBIDOS DO USUÁRIO*
delete from `BUFFET` where cnpj = 'CNPJ';

-- RF006: Consulta *MUDAR OS DADOS DE ENTRADA PELOS RECEBIDOS DO USUÁRIO*
select * from `NOME_TABELA`;

-- RF008: Consultar lista de convidados *MUDAR OS DADOS DE ENTRADA PELOS RECEBIDOS DO USUÁRIO*
select nome, rg
from `CONVIDADO`
where rg in (select LC.CONVIDADO_rg
from `EVENTO` E join `LISTA_CONVIDADOS` LC on (E.codigo = LC.EVENTO_codigo)
where E.descricao = 'NOME_ENVENTO');

-- RF009: Consultar bandas que tocarão em um evento *MUDAR OS DADOS DE ENTRADA PELOS RECEBIDOS DO USUÁRIO*
select banda
from `BANDAS`
where SHOW_EVENTO_codigo in (select EVENTO_codigo
	from `ORCAMENTO`
    where EVENTO_codigo in (select ORCAMENTO_codigo
		from `CONTRATO`
		where numero = 'NUMERO_CONTRATO'));
        
-- RF010: Consultar de lista de eventos ordenados pela data de início.
select *
from `EVENTO`
order by inicio;