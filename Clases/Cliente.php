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
class Cliente {
      private $nombres;
      private $apellidos;
      private $telefono;
      private $identificacion;
      private $emails;
      private $clave;
      
      function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select * from cliente where $campo='$valor'";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
    
    
      private function cargarvector($vector){
          $this->identificacion=$vector['identificacion'];
          $this->nombres=$vector['nombres'];
          $this->apellidos=$vector['apellidos'];
          $this->telefono=$vector['telefono'];
          $this->emails=$vector['email'];
          $this->clave=$vector['clave'];
      }
      
      function getNombres() {
          return $this->nombres;
      }

      function getApellidos() {
          return $this->apellidos;
      }

      function getTelefono() {
          return $this->telefono;
      }

      function getIdentificacion() {
          return $this->identificacion;
      }

      function getEmails() {
          return $this->emails;
      }

      function getClave() {
          return $this->clave;
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

      function setEmails($emails) {
          $this->emails = $emails;
      }

      function setClave($clave) {
          $this->clave = $clave;
      }

          
    function  getNombresCompletos(){
        return ($this->nombres."  ".$this->apellidos);
    }
          
    public function  grabarCliente(){
        $cadenaSQL="insert into cliente values"
              . "('{$this->identificacion}','{$this->nombres}', '{$this->apellidos}','{$this->telefono}', '{$this->emails}', '{$this->clave}');";
              ConectorBD::ejecutarQuery($cadenaSQL, null);
      }
      
      public function modificar(){
        $cadenaSQL="update cliente set identificacion='{$this->identificacion}', nombres='{$this->nombres}', apellidos='{$this->apellidos}', direccion='{$this->direccion}', telefono='{$this->telefono}', email='{$this->emails}', clave='{$this->clave}' where identificacion ='{$this->identificacion}';";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
      }
      
      public function eliminar(){
        $cadenaSQL="delete from cliente where identificacion = '{$this->identificacion}'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    } 
    public function getMenu(){
          return Menu::getDatosEnObjetos("idSI={$this->id}", 'id');
      }
      /*public static function  getDatos($filtro, $orden){
          $cadenaSQL="select *from cliente";
          if($filtro!=NULL) $cadenaSQL.=" where $filtro";
          if($orden!=NULL) $cadenaSQL.=" order by $orden";
          return ConectorBD::ejecutarQuery($cadenaSQL, null);
      }*/
      
      public static function  getDatos($filtro, $orden){
          $cadenaSQL="select *from cliente";
          if($filtro!=NULL){
              $cadenaSQL.=" where $filtro";
          } else {
            $cadenaSQL.=" where null";
          }
          if($orden!=NULL) $cadenaSQL.=" order by $orden";
          return ConectorBD::ejecutarQuery($cadenaSQL, null);
      }
      public static function getDatosEnObjetos($filtro, $orden){
          $datos= Cliente::getDatos($filtro, $orden);
          $listasSI=array();//se define un arreglo 
          for ($i = 0; $i < count($datos); $i++){
              $si=new Cliente($datos[$i], NULL);
              $listasSI[$i]=$si;
          }
          return $listasSI;
      }
      
      public static function getListaEnOptions($predeterminado){
        $sistemas= Cliente::getDatosEnObjetos(null, 'nombres');
        $lista="";
        for ($i = 0; $i < count($sistemas); $i++) {
            $si=$sistemas[$i];
            if($predeterminado==$si->getIdentificacion()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$si->getIdentificacion()}' $auxiliar>{$si->getNombres()} {$si->getApellidos()}</option>";
        }
        return $lista;
    }
    
    public static function validar2($usuario,$clave){
        $valido=false;
        $usuario=new Cliente('email', "$usuario");
        if ($usuario->getEmails()!=null){
            if ($usuario->getClave()==$clave)
                $valido=true;
        }
        return $valido;
    }
	
	public static function opciones(){
        $persona= Cliente::getDatosEnObjetos(null, null);
        $lista="<datalist id='persona'>";
        for ($i = 0; $i < count($persona); $i++) {
            $personas=$persona[$i];
            $lista.="<option value='{$personas->getIdentificacion()}'>{$personas->getNombres()} </option>";            
        }
        $lista.="</datalist>";
        return $lista;
    }
}