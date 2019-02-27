<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Prestamo
 *
 * @author ALEXIS CARATAR
 */
class Prestamo {
    private $idprestamo;
    private $fecha;
    private $valor;
    private $interes;
    private $idempleado;
    private $cuota;
    function __construct($campo,$valor) {
               if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select  idprestamo,valor,fecha,interes,cuota,idempleado from prestamo where $campo=$valor ";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }  
        
    }
    
        private function cargarvector($vector){
        $this->idprestamo=$vector['idprestamo'];
        $this->fecha=$vector['fecha'];
        $this->valor=$vector['valor'];
        $this->interes=$vector['interes'];
        $this->idempleado=$vector['idempleado'];
        $this->cuota=$vector['cuota'];
    }
    
    function getIdprestamo() {
        return $this->idprestamo;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getValor() {
        return $this->valor;
    }

    function getInteres() {
        return $this->interes;
    }

    function getIdempleado() {
        return $this->idempleado;
    }

    function getCuota() {
        return $this->cuota;
    }

    function setIdprestamo($idprestamo) {
        $this->idprestamo = $idprestamo;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setInteres($interes) {
        $this->interes = $interes;
    }

    function setIdempleado($idempleado) {
        $this->idempleado = $idempleado;
    }

    function setCuota($cuota) {
        $this->cuota = $cuota;
    }
    
    
    
    public function grabar(){
        $cadenaSQL="insert into prestamo(valor,fecha,idempleado,cuota,interes) values('$this->valor','$this->fecha','$this->idempleado','$this->cuota','$this->interes')";
        print_r($cadenaSQL); 
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public function Modificar(){
        $cadenaSQL="update prestamo set valor='$this->valor',fecha='$this->fecha', idempleado='$this->idempleado',cuota='$this->cuota',interes='$this->interes' where idprestamo=$this->idprestamo ";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public function Eliminar(){
        $cadenaSQL="delete from prestamo where idprestamo='$this->idprestamo'";
        ConectorBD::ejecutarQuery($cadenaSQL,null);
    }

    
public static function  getDatos($filtro,$orden){
    $cadenaSQL="select*from prestamo";
    if ($filtro!=null) $cadenaSQL.=" where ". $filtro;
    if ($orden!=null) $cadenaSQL.=" order by ". $orden;
    return ConectorBD::ejecutarQuery($cadenaSQL, NULL);
}

public static function getDatosObjetos($filtro,$orden){
    $datos= Prestamo::getDatos($filtro, $orden);
    $listaprestamos= array();
    for ($i = 0; $i < count($datos); $i++) {
        $lista=new Prestamo($datos[$i], null);
        $listaprestamos[$i]=$lista;
    }
  
    return $listaprestamos;
}

public static function valorabonado($idprestamo){
     $cadenaSQL="SELECT sum(pago.valor)as valorabonado from prestamo, pago WHERE idprestamo=prestamo and idprestamo=$idprestamo";
     return  ConectorBD::ejecutarQuery($cadenaSQL, null);
}

}