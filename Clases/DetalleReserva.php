<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of si
 *
 * @author lorenzo
 */
class DetalleReserva {
      private $idreserva;
      private $idevento;
      private $fechareserva;
      private $nombres;
      private $apellidos;
      private $direccion;
      private $telefono;
      private $identificacion;
      private $numeropersonas;
      private $abono;
      private $observacion;
      private $identificacioCliente;
      
      function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select concat(nombres,apellidos) as cliente, numeropersona,evento,fechareserva,direccion,telefono,observacion,abono from reserva,cliente where identificacioncliente=identificacion and $campo=$valor ";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
    
    
      private function cargarvector($vector){
          //$this->idreserva=$vector['idreserva'];
          $this->idevento=$vector['evento'];
          $this->fechareserva=$vector['fechareserva'];
          $this->numeropersonas=$vector['numeropersona'];
          $this->abono=$vector['abono'];
          $this->observacion=$vector['observacion'];
          //$this->identificacioCliente=$vector['identificacioncliente'];
          //$this->identificacion=$vector['identificacion'];
          //$this->nombres=$vector['nombres'];
          //$this->apellidos=$vector['apellidos'];
          $this->direccion=$vector['direccion'];
          $this->telefono=$vector['telefono'];
      }
      
      function getIdreserva() {
          return $this->idreserva;
      }

      function getIdevento() {
          return $this->idevento;
      }

      function getFechareserva() {
          return $this->fechareserva;
      }

      function getNombres() {
          return $this->nombres;
      }

      function getApellidos() {
          return $this->apellidos;
      }

      function getDireccion() {
          return $this->direccion;
      }

      function getTelefono() {
          return $this->telefono;
      }

      function getIdentificacion() {
          return $this->identificacion;
      }

      function getNumeropersonas() {
          return $this->numeropersonas;
      }

      function getAbono() {
          return $this->abono;
      }

      function getObservacion() {
          return $this->observacion;
      }

      function getIdentificacioCliente() {
          return $this->identificacioCliente;
      }

      function setIdreserva($idreserva) {
          $this->idreserva = $idreserva;
      }

      function setIdevento($idevento) {
          $this->idevento = $idevento;
      }

      function setFechareserva($fechareserva) {
          $this->fechareserva = $fechareserva;
      }

      function setNombres($nombres) {
          $this->nombres = $nombres;
      }

      function setApellidos($apellidos) {
          $this->apellidos = $apellidos;
      }

      function setDireccion($direccion) {
          $this->direccion = $direccion;
      }

      function setTelefono($telefono) {
          $this->telefono = $telefono;
      }

      function setIdentificacion($identificacion) {
          $this->identificacion = $identificacion;
      }

      function setNumeropersonas($numeropersonas) {
          $this->numeropersonas = $numeropersonas;
      }

      function setAbono($abono) {
          $this->abono = $abono;
      }

      function setObservacion($observacion) {
          $this->observacion = $observacion;
      }

      function setIdentificacioCliente($identificacioCliente) {
          $this->identificacioCliente = $identificacioCliente;
      }

      public function getEventoEnObjetos(){
        return new Evento("idevento", $this->idevento);
    }
    
    function  getNombresCompletos(){
        return ($this->nombres."  ".$this->apellidos);
    }
    
    function  getSubtotal(){
        return ($this->numeropersonas*$this->abono);
    }
    
    function  getTotal(){
        return (($this->numeropersonas*$this->abono)-$this->abono);
    }
          
    public static function  getDatos($filtro, $orden){
          $cadenaSQL="select concat(nombres,apellidos) as cliente, numeropersona,evento,fechareserva,direccion,telefono,observacion,abono from reserva,cliente where identificacioncliente=identificacion";
          if($filtro!=NULL) $cadenaSQL.=" and $filtro";
          if($orden!=NULL) $cadenaSQL.=" order by $orden";
          return ConectorBD::ejecutarQuery($cadenaSQL, null);
      }
      public static function getDatosEnObjetos($filtro, $orden){
          $datos= DetalleReserva::getDatos($filtro, $orden);
          $listasSI=array();//se define un arreglo 
          
          
          for ($i = 0; $i < count($datos); $i++){
              $si=new DetalleReserva($datos[$i], NULL);
              $listasSI[$i]=$si;
          }
          return $listasSI;
      }
      
      public static function getListaEnOptions($predeterminado){
        $sistemas= Evento::getDatosEnObjetos(null, 'nombre');
        $lista="";
        for ($i = 0; $i < count($sistemas); $i++) {
            $si=$sistemas[$i];
            if($predeterminado==$si->getId()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$si->getId()}' $auxiliar>{$si->getNombre()}</option>";
        }
        return $lista;
    }

}