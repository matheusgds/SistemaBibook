
delete from cidade where idcidade>=1;
alter table cidade auto_increment =1;

DROP TABLE bibliotecario;
DROP TABLE administrador;

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

select * from estado;
select * from cidade;
select * from estado_has_cidade;

SET FOREIGN_KEY_CHECKS = 0;
delete from rua where idRua>=1;
alter table rua auto_increment =1;


delete from estado_has_cidade where Cidade_idCidade>=1;

alter table tipodelivro add column codigo varchar(45) not null;

select * from biblioteca;

select * from Estado_has_Cidade where Estado_idEstado= 1 and Cidade_idCidade= 1;