
drop schema sistemabibook;

delete from cidade where idcidade>=1;
alter table cidade auto_increment =1;

select * from estado;
select * from cidade;
select * from estado_has_cidade;
select * from contadeacesso;
select * from cidade_has_bairro;
select * from bairro;
select * from rua;
select * from rua_has_bairro; 
select * from cliente;

SELECT sigla FROM estado;

select nome from cidade c inner join estado_has_cidade ehc where 1=ehc.Estado_idEstado; 
select idEstado from estado where sigla = 'SC';
select idEstado from estado where sigla = "SC";

select * from cidade;

select max(idCidade) from cidade;

SELECT idEstado FROM estado WHERE sigla= 'sc';

INSERT INTO numerocasa (numero) VALUES(1);

SET FOREIGN_KEY_CHECKS = 0;
SET FOREIGN_KEY_CHECKS = 1;

DELIMITER //
CREATE PROCEDURE InserirNumeroCasa (tam INT)
BEGIN
DECLARE contador INT DEFAULT 0;
loop_teste: LOOP
    SET contador = contador + 1;
	INSERT INTO numerocasa (numero) VALUES(contador);
    IF contador >= tam THEN
        LEAVE loop_teste;
    END IF;
END LOOP loop_teste;

END//
DELIMITER ;

call InserirNumeroCasa(500);

ALTER TABLE edicao MODIFY nedicao int(4);

DELIMITER //
CREATE PROCEDURE InserirAnoPublicacao (tam INT)
BEGIN
DECLARE contador INT DEFAULT 1800;
loop_teste: LOOP
    SET contador = contador + 1;
	INSERT INTO anodepublicacao (ano) VALUES(contador);
    IF contador >= tam THEN
        LEAVE loop_teste;
    END IF;
END LOOP loop_teste;

END//
DELIMITER ;

call InserirAnoPublicacao(2022);


DELIMITER //
CREATE PROCEDURE Inserirnedicao(tam INT)
BEGIN
DECLARE contador INT DEFAULT 0;
loop_teste: LOOP
    SET contador = contador + 1;
	INSERT INTO edicao (nedicao) VALUES(contador);
    IF contador >= tam THEN
        LEAVE loop_teste;
    END IF;
END LOOP loop_teste;

END//
DELIMITER ;

call Inserirnedicao(50);

select * from anodepublicacao;
select * from autor;
select * from cliente;
select * from estado;
select * from estado_has_cidade;
select * from cidade;
select * from bairro;
select * from cidade_has_bairro;
select * from rua;
select * from rua_has_bairro;
	

SET FOREIGN_KEY_CHECKS = 0;
delete from rua where idRua>=1;
alter table rua auto_increment =1;
    
SET FOREIGN_KEY_CHECKS = 0;
delete from cliente where idCliente>2;
alter table bairro auto_increment =1;

delete from cidade_has_bairro where Bairro_idBairro>=1;


delete from anodepublicacao where idAnoDePublicacao>=1;
alter table anodepublicacao auto_increment =1;

alter table locacao add column dataentrega date after hora;
alter table locacao modify hora datetime;

delete from estado_has_cidade where Cidade_idCidade>=1;

alter table tipodelivro add column codigo varchar(45) not null;

select * from biblioteca;
select * from livro;
select * from editora;
select * from livro_has_autor;
select * from contadeacesso;

select * from Estado_has_Cidade where Estado_idEstado= 1 and Cidade_idCidade= 1;

insert into autor(nome)values('john green');

insert into livro_has_autor(Livro_idLivro,Autor_idAutor)values(2,2);

select * from tipodelivro;

SELECT * FROM livro WHERE TipoDeLivro_idTipoDeLivro = $procurar ORDER BY nome;
select * from livro l inner join tipodelivro tl on l.TipoDeLivro_idTipoDeLivro = tl.codigo;
select * from livro l where l.TipoDeLivro_idTipoDeLivro =1;


select * from locacao where Cliente_idCliente=1;

SET FOREIGN_KEY_CHECKS = 0;
delete from locacao where idlocacao>=1;
alter table locacao auto_increment =1;
delete from livro_has_locacao where Livro_idLivro>=1;


select * from locacao;
select * from livro_has_locacao;
select * from estado;

update livro_has_locacao set status = 0 where Livro_idLivro = 3;
