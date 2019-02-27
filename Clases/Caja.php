<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Caja
 *
 * @author zuliban
 */
require_once dirname(__FILE__).'/../Clases/Empleado.php';
class Caja {
    //put your code here
    private $idcaja;
    private $fecha;
    private $base;
    private $gasto;
    private $usuario;
    
    function __construct($campo, $valor) {
        if($campo!=null){
            if(is_array($campo))  $this->cargarvector($campo);
            else {
            $cadenaSQL="select * from caja where $campo=$valor"; 
            $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
            if(count($resultado)>0) $this->cargarvector($resultado[0]);
            }
                
            
    }
        
    }
    
    private function cargarvector($vector) {
        $this->idcaja=$vector['idcaja'];
        $this->fecha=$vector['fecha'];
        $this->base=$vector['base'];
        $this->gasto=$vector['gasto'];
        $this->usuario=$vector['usuariocaja'];
        
    }

    
    function getIdcaja() {
        return $this->idcaja;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getBase() {
        return $this->base;
    }

    function getGasto() {
        return $this->gasto;
    }

  
    function getUsuario() {
        return $this->usuario;
    }

    function setIdcaja($idcaja) {
        $this->idcaja = $idcaja;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setBase($base) {
        $this->base = $base;
    }

    function setGasto($gasto) {
        $this->gasto = $gasto;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    function getnombreempleado($usuario){
        return new Empleado('identificacion', $usuario);
    }

    public function grabar(){
        $cadenaSQL="insert into caja (idcaja,fecha,base,gasto,factura,usuariocaja)values($this->idcaja,$this->fecha,$this->base,$this->gasto,$this->descripcion,$this->factura,$this->usuario)";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        
    }
    


}
