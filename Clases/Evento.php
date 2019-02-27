<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of si
 *
 * @author alexis
 */
class Evento {
      private $idevento;
      private $nombre;
      private $foto;
      private $descripcion;
      
     function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select *from evento where $campo=$valor ";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
      private function cargarvector($vector){
          $this->idevento=$vector['idevento'];
          $this->nombre=$vector['nombre'];
          $this->descripcion=$vector['descripcion'];
          $this->foto=$vector['foto'];
      }
      
      function getIdevento() {
          return $this->idevento;
      }

      function setIdevento($idevento) {
          $this->idevento = $idevento;
      }

      function getNombre() {
          return $this->nombre;
      }

      function getFoto() {
          return $this->foto;
      }

      function getDescripcion() {
          return $this->descripcion;
      }

      function setNombre($nombre) {
          $this->nombre = $nombre;
      }

      function setFoto($foto) {
          $this->foto = $foto;
      }

      function setDescripcion($descripcion) {
          $this->descripcion = $descripcion;
      }
      
      public function __toString() {
          return $this->nombre;
      }
              
    function  grabar(){
        $cadenaSQL="insert into evento(nombre, descripcion, foto) values"
              . "('{$this->nombre}', '{$this->descripcion}', '{$this->foto}')";
         ConectorBD::ejecutarQuery($cadenaSQL, null);  
      }
      function  modificar(){
              $foto="";
        if ($this->foto!="null"){
            $foto=",foto='$this->foto'";
        }
           $cadenaSQL="update evento set nombre='$this->nombre',descripcion='$this->descripcion' $foto where idevento=$this->idevento";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
      }
      function eliminar() {
          $cadenaSQL="delete from evento where idevento={$this->idevento}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
      }
      public function getMenu(){
          return Menu::getDatosEnObjetos("idSI={$this->id}", 'id');
      }
      public static function  getDatos($filtro, $orden){
          $cadenaSQL="select *from evento";
          if($filtro!=NULL) $cadenaSQL.=" where $filtro";
          if($orden!=NULL) $cadenaSQL.=" order by $orden desc";
          return ConectorBD::ejecutarQuery($cadenaSQL, null);
      }
      public static function getDatosEnObjetos($filtro, $orden){
          $datos= Evento::getDatos($filtro, $orden);
          $listasSI=array();//se define un arreglo 
          
          
          for ($i = 0; $i < count($datos); $i++){
              $si=new Evento($datos[$i], NULL);
              $listasSI[$i]=$si;
          }
          return $listasSI;
      }
      
      public static function getListaEnOptions($predeterminado){
        $sistemas= Evento::getDatosEnObjetos(null, 'nombre');
        $lista="<option value='' name='' >Escojer Un Evento</option>";
        for ($i = 0; $i < count($sistemas); $i++) {
            $si=$sistemas[$i];
            if($predeterminado==$si->getIdEvento()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$si->getIdEvento()}' $auxiliar>{$si->getNombre()}</option>";
        }
        return $lista;
        
    }

}
