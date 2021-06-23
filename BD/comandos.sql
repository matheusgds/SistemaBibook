
delete from cidade where idcidade>=1;
alter table cidade auto_increment =1;

DROP TABLE bibliotecario;
DROP TABLE administrador;

select * from estado;
select * from cidade;
select * from estado_has_cidade;
select * from contadeacesso;

SELECT sigla FROM estado;

select * from estado e inner join estado_has_cidade ehc where 1=ehc.Estado_idEstado;  

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




