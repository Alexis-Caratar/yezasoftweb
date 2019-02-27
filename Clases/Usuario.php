<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author ALEXIS CARATAR
 */
class Usuario {
    private $id;
    private $usuario;
    private $clave;
    
    function __construct($campo, $valor) {
    
        if($campo!=null){
            if(is_array($campo)) $this->getObjetosDeVector ($campo);
            else{
                $cadenaSQL=" select * from usuario where $campo=$valor";
                
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
                if(count($resultado)>0) $this->getObjetosDeVector ($resultado[0]);
            }
        }
         
    
    }
    
    function  getObjetosDeVector($vector){
     $this->usuario=$vector[0];
    $this->clave=$vector[1];
    $this->id=$vector[2];
    }
    
    
    function getUsuario() {
        return $this->usuario;
    }
    function getClave() {
        return $this->clave;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

        public function Modificaradministrador($usuario,$claveactual,$clavenueva){
          $cadenaSQL="update usuario set clave='$clavenueva' where usuario='$usuario'";
        ConectorBD::ejecutarQuery($cadenaSQL,null);        
    }
    
    public static function validar($usuario,$clave){
        $valido=false;
        $usuario=new Usuario('usuario', "'$usuario'");
        if ($usuario->getUsuario()!=null){
            if ($usuario->getClave()==$clave)
                $valido=true;
        }
        return $valido;
        
    }
    public static function validarclave($claveactual){
        $valido=false;
        $clave=new Usuario('clave', "'$claveactual'");
        if ($clave->getClave()!=null)
        $valido=true;
        return $valido;
        
    }
    
    
    
}
