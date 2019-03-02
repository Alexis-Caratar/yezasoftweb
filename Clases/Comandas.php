<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comanda
 *
 * @author zuliban
 */
require_once dirname(__FILE__).'/../Clases/Mesa.php';
class Comandas {
    //put your code here
    private $idcomanda;
    private $empleado;
    private $mesa;
    private $fecha;
    private $estado;
    private $reserva;
    private $factura;
    private $caja;
    
    function __construct($campo, $valor) {
      if ($campo!=null){
          if (is_array($campo)) $this->cargarObjetoEnvector ($campo);
        else {
           $cadenaSQL="select * from comanda where $campo=$valor";
           $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);
       
           if (count($resultado)>0) $this->cargarObjetoEnvector ($resultado[0]);
        }   
      }
    }

    private function cargarObjetoEnvector($vector){
          $this->idcomanda = $vector[0];
          $this->empleado=$vector[1];
        $this->mesa = $vector[2];
        $this->fecha = $vector[3];
        $this->estado = $vector[4];
        $this->reserva = $vector[5];
        $this->factura = $vector[6];
        $this->caja = $vector[7];
    }
    
    function getCaja() {
        return $this->caja;
    }

    function setCaja($caja) {
        $this->caja = $caja;
    }

        
    function getIdcomanda() {
        return $this->idcomanda;
    }
    function getEmpleado() {
        return new Personal('identificacion', "'".$this->empleado."'") ;
        
    }

    
    function getMesa() {
        return $this->mesa;
    }
    function getnumeromesa(){
        return new Mesa('idmesa',$this->mesa);
    }
                function getFecha() {
        return $this->fecha;
    }

    function getEstado() {
    if ($this->estado=='P') {
        $this->estado='PENDIENTE';
    }elseif ($this->estado=='V') {//para que en la interfaz complete segun el estado
        $this->estado='VISTA EN COCINA';
    }elseif ($this->estado=='L') {
         $this->estado='LISTO EN COCINA';
    }elseif($this->estado=='E'){
         $this->estado=="ENTREGADA";
          }elseif($this->estado=='PG'){
       $this->estado="PAGADO";
    }   
        return $this->estado;
    }

    function getReserva() {
        return $this->reserva;
    }

    function getFactura() {
        return $this->factura;
    }

    function setIdcomanda($idcomanda) {
        $this->idcomanda = $idcomanda;
    }
    function setEmpleado($empleado) {
        $this->empleado = $empleado;
    }

    
    function setMesa($mesa) {
        $this->mesa = $mesa;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setReserva($reserva) {
        $this->reserva = $reserva;
    }

    function setFactura($factura) {
        $this->factura = $factura;
    }

    public static function getDatos($filtro, $orden){
        $cadenaSQL="select * from comanda";
        if($filtro!=null)$cadenaSQL.=" where $filtro";
        if($orden!=null) $cadenaSQL.=" order by $orden";
return ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public static function getDatosEnObjeto($filtro, $orden){
        
        $datos=Comandas::getDatos($filtro, $orden);
        $listaComanda=  array();
        for ($i=0; $i< count($datos); $i++){
            $lista=new Comandas($datos[$i], null);
            $listaComanda[$i]=$lista;
        }
        return $listaComanda;
    }
    public function grabarComanda(){
        //secrea la cadena SQL
        $cadenaSQL="INSERT INTO comanda(idempleado, fecha, estado, factura,caja) VALUES"
                . "('{$this->empleado}',{$this->fecha},'{$this->estado}' , {$this->factura},{$this->caja})" ;
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public function eliminar(){
        $cadenaSQL="delete from comanda where idcomanda={$this->idcomanda}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public function modificar(){
        $cadenaSQL="update comanda set empleadoidentificacion='{$this->empleado}','{$this->mesa}','{$this->fecha}',{$this->estado}','{$this->factura}'"
        . " where idcomanda=".$this->idcomanda;
ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
     
    
}
