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
class Empresa {
      private $nit;
      private $nombre;
      private $direccion;
      private $barrio;
      private $ciudad;
      private $telefono;
      private $celular;
      private $redessociales;
      private $foto;
      private $administrador;
      
      function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select * from empresa where $campo='$valor'";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
    
    
      private function cargarvector($vector){
          $this->nit=$vector['nit'];
          $this->nombre=$vector['nombre'];
          $this->direccion=$vector['direccion'];
          $this->barrio=$vector['barrio'];
          $this->ciudad=$vector['ciudad'];
          $this->telefono=$vector['telefono'];
          $this->administrador=$vector['administrador'];
          $this->celular=$vector['celular'];
          $this->redessociales=$vector['redessociales'];
          $this->foto=$vector['foto'];
      }
      
      function getBarrio() {
          return $this->barrio;
      }

      function getCiudad() {
          return $this->ciudad;
      }

      function setBarrio($barrio) {
          $this->barrio = $barrio;
      }

      function setCiudad($ciudad) {
          $this->ciudad = $ciudad;
      }

            function getNit() {
          return $this->nit;
      }

      function getNombre() {
          return $this->nombre;
      }

      function getDireccion() {
          return $this->direccion;
      }

      function getTelefono() {
          return $this->telefono;
      }

      function getCelular() {
          return $this->celular;
      }

      function getRedessociales() {
          return $this->redessociales;
      }

      function setNit($nit) {
          $this->nit = $nit;
      }

      function setNombre($nombre) {
          $this->nombre = $nombre;
      }

      function setDireccion($direccion) {
          $this->direccion = $direccion;
      }

      function setTelefono($telefono) {
          $this->telefono = $telefono;
      }

      function setCelular($celular) {
          $this->celular = $celular;
      }

      function setRedessociales($redessociales) {
          $this->redessociales = $redessociales;
      }
      
      function getFoto() {
          return $this->foto;
      }

      function setFoto($foto) {
          $this->foto = $foto;
      }
      
      function getAdministrador() {
          return $this->administrador;
      }

      function setAdministrador($administrador) {
          $this->administrador = $administrador;
      }

      public function modificar(){
          $foto="";
        if ($this->foto!="null"){
            $foto=",foto='$this->foto'";
        }
        $cadenaSQL="update empresa set nit='{$this->nit}', nombre='{$this->nombre}', direccion='{$this->direccion}', barrio='$this->barrio',ciudad='{$this->ciudad}', telefono='{$this->telefono}', celular='{$this->celular}', redessociales='{$this->redessociales}' $foto, administrador='{$this->administrador}' where nit ='{$this->nit}';";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
      }
      
      public static function  getDatos($filtro, $orden){
          $cadenaSQL="select *from empresa";
          if($filtro!=NULL){
              $cadenaSQL.=" where $filtro";
          } else {
            $cadenaSQL.=" where null";
          }
          if($orden!=NULL) $cadenaSQL.=" order by $orden";
          return ConectorBD::ejecutarQuery($cadenaSQL, null);
      }
      public static function getDatosEnObjetos($filtro, $orden){
          $datos= Empresa::getDatos($filtro, $orden);
          $listasSI=array();//se define un arreglo 
          
          
          for ($i = 0; $i < count($datos); $i++){
              $si=new Empresa($datos[$i], NULL);
              $listasSI[$i]=$si;
          }
          return $listasSI;
      }
}