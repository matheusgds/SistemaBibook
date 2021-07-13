<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author mathe
 */
interface ICrud {
   public function Inserir($vetDados);
   public function Excluir($vetDados);
   public function Editar($vetDados);
   public function PesquisarTodos($sql);
    public function Existe($vetDados);
}