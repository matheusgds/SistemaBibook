-- MySQL Script generated by MySQL Workbench
-- Tue Jul 27 21:16:12 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema SistemaBibook
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema SistemaBibook
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `SistemaBibook` DEFAULT CHARACTER SET utf8 ;
USE `SistemaBibook` ;

-- -----------------------------------------------------
-- Table `SistemaBibook`.`Estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Estado` (
  `idEstado` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `sigla` VARCHAR(2) NOT NULL,
  PRIMARY KEY (`idEstado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Cidade` (
  `idCidade` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idCidade`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Bairro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Bairro` (
  `idBairro` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idBairro`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Rua`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Rua` (
  `idRua` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(120) NOT NULL,
  PRIMARY KEY (`idRua`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`NumeroCasa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`NumeroCasa` (
  `idNumeroCasa` INT NOT NULL AUTO_INCREMENT,
  `numero` VARCHAR(4) NULL,
  PRIMARY KEY (`idNumeroCasa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Contato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Contato` (
  `idContato` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(100) NULL,
  `telefone1` VARCHAR(45) NULL,
  `telefone2` VARCHAR(45) NULL,
  `celular` VARCHAR(45) NULL,
  PRIMARY KEY (`idContato`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`ContaDeAcesso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`ContaDeAcesso` (
  `idContaDeAcesso` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `pass` VARCHAR(70) NOT NULL,
  `tipodeacesso` INT NOT NULL,
  PRIMARY KEY (`idContaDeAcesso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Cliente` (
  `idCliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(300) NOT NULL,
  `cpf` VARCHAR(45) NOT NULL,
  `rg` VARCHAR(45) NOT NULL,
  `datanasc` DATE NOT NULL,
  `sexo` VARCHAR(1) NOT NULL,
  `situacao` TINYINT NOT NULL,
  `Estado_idEstado` INT NOT NULL,
  `Cidade_idCidade` INT NOT NULL,
  `Bairro_idBairro` INT NOT NULL,
  `Rua_idRua` INT NOT NULL,
  `NumeroCasa_idNumeroCasa` INT NOT NULL,
  `Contato_idContato` INT NOT NULL,
  `ContaDeAcesso_idContaDeAcesso` INT NOT NULL,
  PRIMARY KEY (`idCliente`),
  INDEX `fk_Cliente_Estado1_idx` (`Estado_idEstado` ASC) ,
  INDEX `fk_Cliente_Cidade1_idx` (`Cidade_idCidade` ASC) ,
  INDEX `fk_Cliente_Bairro1_idx` (`Bairro_idBairro` ASC),
  INDEX `fk_Cliente_Rua1_idx` (`Rua_idRua` ASC) ,
  INDEX `fk_Cliente_NumeroCasa1_idx` (`NumeroCasa_idNumeroCasa` ASC) ,
  INDEX `fk_Cliente_Contato1_idx` (`Contato_idContato` ASC) ,
  INDEX `fk_Cliente_ContaDeAcesso1_idx` (`ContaDeAcesso_idContaDeAcesso` ASC),
  CONSTRAINT `fk_Cliente_Estado1`
    FOREIGN KEY (`Estado_idEstado`)
    REFERENCES `SistemaBibook`.`Estado` (`idEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_Cidade1`
    FOREIGN KEY (`Cidade_idCidade`)
    REFERENCES `SistemaBibook`.`Cidade` (`idCidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_Bairro1`
    FOREIGN KEY (`Bairro_idBairro`)
    REFERENCES `SistemaBibook`.`Bairro` (`idBairro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_Rua1`
    FOREIGN KEY (`Rua_idRua`)
    REFERENCES `SistemaBibook`.`Rua` (`idRua`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_NumeroCasa1`
    FOREIGN KEY (`NumeroCasa_idNumeroCasa`)
    REFERENCES `SistemaBibook`.`NumeroCasa` (`idNumeroCasa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_Contato1`
    FOREIGN KEY (`Contato_idContato`)
    REFERENCES `SistemaBibook`.`Contato` (`idContato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cliente_ContaDeAcesso1`
    FOREIGN KEY (`ContaDeAcesso_idContaDeAcesso`)
    REFERENCES `SistemaBibook`.`ContaDeAcesso` (`idContaDeAcesso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Rua_has_Bairro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Rua_has_Bairro` (
  `Rua_idRua` INT NOT NULL,
  `Bairro_idBairro` INT NOT NULL,
  PRIMARY KEY (`Rua_idRua`, `Bairro_idBairro`),
  INDEX `fk_Rua_has_Bairro_Bairro1_idx` (`Bairro_idBairro` ASC) ,
  INDEX `fk_Rua_has_Bairro_Rua1_idx` (`Rua_idRua` ASC) ,
  CONSTRAINT `fk_Rua_has_Bairro_Rua1`
    FOREIGN KEY (`Rua_idRua`)
    REFERENCES `SistemaBibook`.`Rua` (`idRua`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Rua_has_Bairro_Bairro1`
    FOREIGN KEY (`Bairro_idBairro`)
    REFERENCES `SistemaBibook`.`Bairro` (`idBairro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Estado_has_Cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Estado_has_Cidade` (
  `Estado_idEstado` INT NOT NULL,
  `Cidade_idCidade` INT NOT NULL,
  PRIMARY KEY (`Estado_idEstado`, `Cidade_idCidade`),
  INDEX `fk_Estado_has_Cidade_Cidade1_idx` (`Cidade_idCidade` ASC) ,
  INDEX `fk_Estado_has_Cidade_Estado1_idx` (`Estado_idEstado` ASC) ,
  CONSTRAINT `fk_Estado_has_Cidade_Estado1`
    FOREIGN KEY (`Estado_idEstado`)
    REFERENCES `SistemaBibook`.`Estado` (`idEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Estado_has_Cidade_Cidade1`
    FOREIGN KEY (`Cidade_idCidade`)
    REFERENCES `SistemaBibook`.`Cidade` (`idCidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Cidade_has_Bairro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Cidade_has_Bairro` (
  `Cidade_idCidade` INT NOT NULL,
  `Bairro_idBairro` INT NOT NULL,
  PRIMARY KEY (`Cidade_idCidade`, `Bairro_idBairro`),
  INDEX `fk_Cidade_has_Bairro_Bairro1_idx` (`Bairro_idBairro` ASC) ,
  INDEX `fk_Cidade_has_Bairro_Cidade1_idx` (`Cidade_idCidade` ASC) ,
  CONSTRAINT `fk_Cidade_has_Bairro_Cidade1`
    FOREIGN KEY (`Cidade_idCidade`)
    REFERENCES `SistemaBibook`.`Cidade` (`idCidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cidade_has_Bairro_Bairro1`
    FOREIGN KEY (`Bairro_idBairro`)
    REFERENCES `SistemaBibook`.`Bairro` (`idBairro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Biblioteca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Biblioteca` (
  `idBiblioteca` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(120) NOT NULL,
  `Estado_idEstado` INT NOT NULL,
  `Cidade_idCidade` INT NOT NULL,
  `Bairro_idBairro` INT NOT NULL,
  `Rua_idRua` INT NOT NULL,
  `NumeroCasa_idNumeroCasa` INT NOT NULL,
  `Contato_idContato` INT NOT NULL,
  PRIMARY KEY (`idBiblioteca`),
  INDEX `fk_Biblioteca_Estado1_idx` (`Estado_idEstado` ASC) ,
  INDEX `fk_Biblioteca_Cidade1_idx` (`Cidade_idCidade` ASC), 
  INDEX `fk_Biblioteca_Bairro1_idx` (`Bairro_idBairro` ASC) ,
  INDEX `fk_Biblioteca_Rua1_idx` (`Rua_idRua` ASC),
  INDEX `fk_Biblioteca_NumeroCasa1_idx` (`NumeroCasa_idNumeroCasa` ASC),
  INDEX `fk_Biblioteca_Contato1_idx` (`Contato_idContato` ASC) ,
  CONSTRAINT `fk_Biblioteca_Estado1`
    FOREIGN KEY (`Estado_idEstado`)
    REFERENCES `SistemaBibook`.`Estado` (`idEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Biblioteca_Cidade1`
    FOREIGN KEY (`Cidade_idCidade`)
    REFERENCES `SistemaBibook`.`Cidade` (`idCidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Biblioteca_Bairro1`
    FOREIGN KEY (`Bairro_idBairro`)
    REFERENCES `SistemaBibook`.`Bairro` (`idBairro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Biblioteca_Rua1`
    FOREIGN KEY (`Rua_idRua`)
    REFERENCES `SistemaBibook`.`Rua` (`idRua`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Biblioteca_NumeroCasa1`
    FOREIGN KEY (`NumeroCasa_idNumeroCasa`)
    REFERENCES `SistemaBibook`.`NumeroCasa` (`idNumeroCasa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Biblioteca_Contato1`
    FOREIGN KEY (`Contato_idContato`)
    REFERENCES `SistemaBibook`.`Contato` (`idContato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`LocalDePublicacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`LocalDePublicacao` (
  `idLocalDePublicacao` INT NOT NULL AUTO_INCREMENT,
  `Estado_idEstado` INT NOT NULL,
  `Cidade_idCidade` INT NOT NULL,
  PRIMARY KEY (`idLocalDePublicacao`),
  INDEX `fk_LocalDePublicacao_Estado1_idx` (`Estado_idEstado` ASC) ,
  INDEX `fk_LocalDePublicacao_Cidade1_idx` (`Cidade_idCidade` ASC) ,
  CONSTRAINT `fk_LocalDePublicacao_Estado1`
    FOREIGN KEY (`Estado_idEstado`)
    REFERENCES `SistemaBibook`.`Estado` (`idEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LocalDePublicacao_Cidade1`
    FOREIGN KEY (`Cidade_idCidade`)
    REFERENCES `SistemaBibook`.`Cidade` (`idCidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Editora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Editora` (
  `idEditora` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idEditora`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Edicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Edicao` (
  `idEdicao` INT NOT NULL AUTO_INCREMENT,
  `nedicao` INT NOT NULL,
  PRIMARY KEY (`idEdicao`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`AnoDePublicacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`AnoDePublicacao` (
  `idAnoDePublicacao` INT NOT NULL AUTO_INCREMENT,
  `ano` INT NOT NULL,
  PRIMARY KEY (`idAnoDePublicacao`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`TipoDeLivro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`TipoDeLivro` (
  `idTipoDeLivro` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(100) NOT NULL,
  `codigo` DOUBLE NOT NULL,
  PRIMARY KEY (`idTipoDeLivro`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Livro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Livro` (
  `idLivro` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `subtitulo` VARCHAR(45) NOT NULL,
  `isbn` VARCHAR(45) NOT NULL,
  `quantidade` INT NOT NULL,
  `LocalDePublicacao_idLocalDePublicacao` INT NOT NULL,
  `Editora_idEditora` INT NOT NULL,
  `Edicao_idEdicao` INT NOT NULL,
  `AnoDePublicacao_idAnoDePublicacao` INT NOT NULL,
  `TipoDeLivro_idTipoDeLivro` INT NOT NULL,
  PRIMARY KEY (`idLivro`),
  INDEX `fk_Livro_LocalDePublicacao1_idx` (`LocalDePublicacao_idLocalDePublicacao` ASC),
  INDEX `fk_Livro_Editora1_idx` (`Editora_idEditora` ASC),
  INDEX `fk_Livro_Edicao1_idx` (`Edicao_idEdicao` ASC) ,
  INDEX `fk_Livro_AnoDePublicacao1_idx` (`AnoDePublicacao_idAnoDePublicacao` ASC) ,
  INDEX `fk_Livro_TipoDeLivro1_idx` (`TipoDeLivro_idTipoDeLivro` ASC) ,
  CONSTRAINT `fk_Livro_LocalDePublicacao1`
    FOREIGN KEY (`LocalDePublicacao_idLocalDePublicacao`)
    REFERENCES `SistemaBibook`.`LocalDePublicacao` (`idLocalDePublicacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Livro_Editora1`
    FOREIGN KEY (`Editora_idEditora`)
    REFERENCES `SistemaBibook`.`Editora` (`idEditora`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Livro_Edicao1`
    FOREIGN KEY (`Edicao_idEdicao`)
    REFERENCES `SistemaBibook`.`Edicao` (`idEdicao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Livro_AnoDePublicacao1`
    FOREIGN KEY (`AnoDePublicacao_idAnoDePublicacao`)
    REFERENCES `SistemaBibook`.`AnoDePublicacao` (`idAnoDePublicacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Livro_TipoDeLivro1`
    FOREIGN KEY (`TipoDeLivro_idTipoDeLivro`)
    REFERENCES `SistemaBibook`.`TipoDeLivro` (`idTipoDeLivro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Autor` (
  `idAutor` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(120) NOT NULL,
  PRIMARY KEY (`idAutor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Livro_has_Autor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Livro_has_Autor` (
  `Livro_idLivro` INT NOT NULL,
  `Autor_idAutor` INT NOT NULL,
  PRIMARY KEY (`Livro_idLivro`, `Autor_idAutor`),
  INDEX `fk_Livro_has_Autor_Autor1_idx` (`Autor_idAutor` ASC),
  INDEX `fk_Livro_has_Autor_Livro1_idx` (`Livro_idLivro` ASC) ,
  CONSTRAINT `fk_Livro_has_Autor_Livro1`
    FOREIGN KEY (`Livro_idLivro`)
    REFERENCES `SistemaBibook`.`Livro` (`idLivro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Livro_has_Autor_Autor1`
    FOREIGN KEY (`Autor_idAutor`)
    REFERENCES `SistemaBibook`.`Autor` (`idAutor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`locacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`locacao` (
  `idlocacao` INT NOT NULL AUTO_INCREMENT,
  `data` DATE NOT NULL,
  `hora` DATE NOT NULL,
  `dataentrega` DATE NOT NULL,
  `Cliente_idCliente` INT NOT NULL,
  PRIMARY KEY (`idlocacao`),
  INDEX `fk_locacao_Cliente1_idx` (`Cliente_idCliente` ASC) ,
  CONSTRAINT `fk_locacao_Cliente1`
    FOREIGN KEY (`Cliente_idCliente`)
    REFERENCES `SistemaBibook`.`Cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Livro_has_locacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Livro_has_locacao` (
  `Livro_idLivro` INT NOT NULL,
  `locacao_idlocacao` INT NOT NULL,
  PRIMARY KEY (`Livro_idLivro`, `locacao_idlocacao`),
  INDEX `fk_Livro_has_locacao_locacao1_idx` (`locacao_idlocacao` ASC) ,
  INDEX `fk_Livro_has_locacao_Livro1_idx` (`Livro_idLivro` ASC) ,
  CONSTRAINT `fk_Livro_has_locacao_Livro1`
    FOREIGN KEY (`Livro_idLivro`)
    REFERENCES `SistemaBibook`.`Livro` (`idLivro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Livro_has_locacao_locacao1`
    FOREIGN KEY (`locacao_idlocacao`)
    REFERENCES `SistemaBibook`.`locacao` (`idlocacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Fornecedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Fornecedor` (
  `idFornecedor` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `Estado_idEstado` INT NOT NULL,
  `Cidade_idCidade` INT NOT NULL,
  `Bairro_idBairro` INT NOT NULL,
  `Rua_idRua` INT NOT NULL,
  `NumeroCasa_idNumeroCasa` INT NOT NULL,
  `Contato_idContato` INT NOT NULL,
  PRIMARY KEY (`idFornecedor`),
  INDEX `fk_Fornecedor_Estado1_idx` (`Estado_idEstado` ASC) ,
  INDEX `fk_Fornecedor_Cidade1_idx` (`Cidade_idCidade` ASC) ,
  INDEX `fk_Fornecedor_Bairro1_idx` (`Bairro_idBairro` ASC) ,
  INDEX `fk_Fornecedor_Rua1_idx` (`Rua_idRua` ASC) ,
  INDEX `fk_Fornecedor_NumeroCasa1_idx` (`NumeroCasa_idNumeroCasa` ASC),
  INDEX `fk_Fornecedor_Contato1_idx` (`Contato_idContato` ASC) ,
  CONSTRAINT `fk_Fornecedor_Estado1`
    FOREIGN KEY (`Estado_idEstado`)
    REFERENCES `SistemaBibook`.`Estado` (`idEstado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fornecedor_Cidade1`
    FOREIGN KEY (`Cidade_idCidade`)
    REFERENCES `SistemaBibook`.`Cidade` (`idCidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fornecedor_Bairro1`
    FOREIGN KEY (`Bairro_idBairro`)
    REFERENCES `SistemaBibook`.`Bairro` (`idBairro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fornecedor_Rua1`
    FOREIGN KEY (`Rua_idRua`)
    REFERENCES `SistemaBibook`.`Rua` (`idRua`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fornecedor_NumeroCasa1`
    FOREIGN KEY (`NumeroCasa_idNumeroCasa`)
    REFERENCES `SistemaBibook`.`NumeroCasa` (`idNumeroCasa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fornecedor_Contato1`
    FOREIGN KEY (`Contato_idContato`)
    REFERENCES `SistemaBibook`.`Contato` (`idContato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SistemaBibook`.`Multa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SistemaBibook`.`Multa` (
  `idMulta` INT NOT NULL AUTO_INCREMENT,
  `valor` DOUBLE NULL,
  `status` TINYINT NOT NULL,
  `locacao_idlocacao` INT NOT NULL,
  PRIMARY KEY (`idMulta`),
  INDEX `fk_Multa_locacao1_idx` (`locacao_idlocacao` ASC),
  CONSTRAINT `fk_Multa_locacao1`
    FOREIGN KEY (`locacao_idlocacao`)
    REFERENCES `SistemaBibook`.`locacao` (`idlocacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
