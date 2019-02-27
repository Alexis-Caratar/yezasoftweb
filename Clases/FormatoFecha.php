<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Idioma
 *
 * @author Edwin
 */
class FormatoFecha {
    private $codigo;

    function __construct($codigo) {
        $this->codigo = $codigo;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function getNombre(){
        switch ($this->codigo) {
            case 'Am': return 'Am'; break;
            case 'Am': return 'Pm'; break;
        }
    }
    
    public function __toString() {
        return $this->getNombre();
    }
    
    public static function getListaEnOptions($predeterminado){
        switch ($predeterminado) {            
            case '1': return '<option value="Am">Am</option><option value="Pm" selected>Pm</option>'; break;
            default: return '<option value="Am">Am</option><option value="Pm">Pm</option>'; break;
        }
    }
}
