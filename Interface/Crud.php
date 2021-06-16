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
interface Crud {

    public function Insert();
    
    public function Update();
    
    public function Delete();

    public function SearchAll();
}
