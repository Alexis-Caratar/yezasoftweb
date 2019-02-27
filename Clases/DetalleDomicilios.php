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
class DetalleDomicilio {
      private $iddomicilio;
      private $fechadomicilio;
      private $fechasistema;
      private $nombres;
      private $apellidos;
      private $direccion;
      private $factura;
      private $identificacion;
      private $estado;
      private $identificacioCliente;
      
      function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select iddomicilio, fechasistema,fechadomicilio,identificacion,nombres,apellidos,direccion,factura,estado from domicilio,cliente where identificacion=identificacioncliente and $campo=$valor ";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
    
    
      private function cargarvector($vector){
          $this->iddomicilio=$vector['iddomicilio'];
          $this->fechadomicilio=$vector['fechadomicilio'];
          $this->fechasistema=$vector['fechasistema'];
          $this->identificacion=$vector['identificacion'];
          //$this->identificacioCliente=$vector['identificacioncliente'];
          $this->nombres=$vector['nombres'];
          $this->apellidos=$vector['apellidos'];
          $this->direccion=$vector['direccion'];
          $this->factura=$vector['factura'];
          $this->estado=$vector['estado'];
      }
      
      function getIddomicilio() {
          return $this->iddomicilio;
      }

      function getFechadomicilio() {
          return $this->fechadomicilio;
      }

      function getFechasistema() {
          return $this->fechasistema;
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

      function getFactura() {
          return $this->factura;
      }

      function getIdentificacion() {
          return $this->identificacion;
      }

      function getEstado() {
          return $this->estado;
      }

      function getIdentificacioCliente() {
          return $this->identificacioCliente;
      }

      function setIddomicilio($iddomicilio) {
          $this->iddomicilio = $iddomicilio;
      }

      function setFechadomicilio($fechadomicilio) {
          $this->fechadomicilio = $fechadomicilio;
      }

      function setFechasistema($fechasistema) {
          $this->fechasistema = $fechasistema;
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

      function setFactura($factura) {
          $this->factura = $factura;
      }

      function setIdentificacion($identificacion) {
          $this->identificacion = $identificacion;
      }

      function setEstado($estado) {
          $this->estado = $estado;
      }

      function setIdentificacioCliente($identificacioCliente) {
          $this->identificacioCliente = $identificacioCliente;
      }
    
    function  getNombresCompletos(){
        return ($this->nombres."  ".$this->apellidos);
    }
    
    function  getSubtotal(){
        return ($this->iddomicilio*$this->identificacion);
    }
    
    function  getTotal(){
        return (($this->identificacion*$this->iddomicilio)-$this->identificacion);
    }
          
    public static function  getDatos($filtro, $orden){
          $cadenaSQL="select iddomicilio, fechasistema,fechadomicilio,identificacion,nombres,apellidos,direccion,factura,estado from domicilio,cliente where identificacion=identificacioncliente";
          if($filtro!=NULL) $cadenaSQL.=" and $filtro";
          if($orden!=NULL) $cadenaSQL.=" order by $orden";
          return ConectorBD::ejecutarQuery($cadenaSQL, null);
      }
      public static function getDatosEnObjetos($filtro, $orden){
          $datos= DetalleDomicilio::getDatos($filtro, $orden);
          $listasSI=array();//se define un arreglo 
          
          
          for ($i = 0; $i < count($datos); $i++){
              $si=new DetalleDomicilio($datos[$i], NULL);
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