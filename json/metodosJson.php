<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of metodosJson
 *
 * @author mathe
 */
class metodosJson {

    public function ObjParaJson($string) {
        $nomearq = "gravarsql.json";
        $dados_json = json_encode($string);
        $fp = fopen($nomearq, "w");
        fwrite($fp, $dados_json);
        fclose($fp);
    }

    public function JsonParaObj() {
        $nomearq = "gravarsql.json";
        $arquivo = file_get_contents($nomearq);
        $json = json_decode($arquivo);
        return $json;
    }

}
