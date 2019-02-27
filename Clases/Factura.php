<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cargo
 *
 * @author ALEXIS CARATAR
 */
class Factura {
    private  $idfactura;
    private  $fecha;
    private  $identificaioncliente;
    private  $empresa;
    
    function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select *from empresa where $campo=$valor ";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
    
    private function cargarvector($vector){
        $this->idfactura=$vector['idfactura'];
        $this->fecha=$vector['fecha'];
        $this->identificaioncliente=$vector['identificaioncliente'];
        $this->empresa=$vector['empresa'];
    }
    
    function getIdfactura() {
        return $this->idfactura;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getIdentificaioncliente() {
        return $this->identificaioncliente;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function setIdfactura($idfactura) {
        $this->idfactura = $idfactura;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setIdentificaioncliente($identificaioncliente) {
        $this->identificaioncliente = $identificaioncliente;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    public function grabar(){
        $cadenaSQL="insert into factura (fecha,identificacioncliente,empresa) values(current_timestamp,'$this->identificaioncliente','123')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function grabarDomicilio(){
        $cadenaSQL="insert into factura (fecha,identificacioncliente,empresa) values(current_timestamp,'$this->identificaioncliente','123')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
}