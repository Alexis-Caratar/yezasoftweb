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
class Domicilio {
      private $iddomicilio;
      private $estado;
      private $fechasistema;
      private $idplato;
      private $fechadomicilio;
      private $hora;
      private $nombres;
      private $apellidos;
      private $direccion;
      private $barrio;
      private $telefono;
      private $identificacion;
      private $emails;
      private $clave;
      private $total;
      private $saldo;
      private $abono;
      private $identificacioCliente;
      
      function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
               // $cadenaSQL="select iddomicilio,fechadomicilio,hora,formato,fechasistema,abono,sum(vrunitario*cantidad)as total,identificacioncliente,identificacion,nombres,apellidos,direccion,barrio,telefono,email,estado,plato from domicilio,cliente,detalleorden where identificacion=identificacioncliente and reserva=idreserva and $campo=$valor group by idreserva,identificacion";
                $cadenaSQL="select iddomicilio,fechadomicilio,hora,fechasistema,abono,sum(vrunitario*cantidad)as total,identificacioncliente,identificacion,nombres,apellidos,direccion,barrio,telefono,email,abono from domicilio,cliente,detalleorden where identificacion=identificacioncliente and $campo=$valor group by identificacion,iddomicilio,domicilio.idplato";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
    
    
      private function cargarvector($vector){
          $this->iddomicilio=$vector['iddomicilio'];
          $this->fechadomicilio=$vector['fechadomicilio'];
          $this->fechasistema=$vector['fechasistema'];
          $this->abono=$vector['abono'];
          $this->identificacioCliente=$vector['identificacioncliente'];
          $this->identificacion=$vector['identificacion'];
          $this->nombres=$vector['nombres'];
          $this->apellidos=$vector['apellidos'];
          $this->direccion=$vector['direccion'];
          $this->barrio=$vector['barrio'];
          $this->hora=$vector['hora'];
          $this->telefono=$vector['telefono'];
          $this->emails=$vector['email'];
          $this->total=$vector['total'];
      }
      
      function getAbono() {
          return $this->abono;
      }

      function setAbono($abono) {
          $this->abono = $abono;
      }

      function getIddomicilio() {
          return $this->iddomicilio;
      }

      function getEstado() {
          return $this->estado;
      }

      function getFechasistema() {
          $fecha = explode(".", $this->fechasistema);
          return $fecha[0];
      }

      function getFechadomicilio() {
          	  $fecha = explode(" ", $this->fechadomicilio);
          return $fecha[0];
      }

      function getHora() {
          return $this->hora;
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

      function getEmails() {
          return $this->emails;
      }

      function getClave() {
          return $this->clave;
      }

      function getIdentificacioCliente() {
          return $this->identificacioCliente;
      }

      function setIddomicilio($iddomicilio) {
          $this->iddomicilio = $iddomicilio;
      }

      function setEstado($estado) {
          $this->estado = $estado;
      }

      function setFechasistema($fechasistema) {
          $this->fechasistema = $fechasistema;
      }

      function setFechadomicilio($fechadomicilio) {
          $this->fechadomicilio = $fechadomicilio;
      }

      function setHora($hora) {
          $this->hora = $hora;
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

      function setIdentificacioCliente($identificacioCliente) {
          $this->identificacioCliente = $identificacioCliente;
      }
      function getBarrio() {
          return $this->barrio;
      }

      function getTotal() {
          return $this->total;
      }

      function getSaldo() {
          return $this->saldo;
      }

      function setBarrio($barrio) {
          $this->barrio = $barrio;
      }

      function setTotal($total) {
          $this->total = $total;
      }

      function setSaldo($saldo) {
          $this->saldo = $saldo;
      }
       
      function getIdplato() {
          return $this->idplato;
      }

      function setIdplato($idplato) {
          $this->idplato = $idplato;
      }

      function  getNombresCompletos(){
        return ($this->nombres."  ".$this->apellidos);
    }
    
    function  getSaldos(){
        return ($this->getTotal()-$this->getAbono());
    }
    
    function  getFechaYHora(){
        return ("Fecha: ".$this->getFechadomicilio()." <br>Hora:  ".$this->hora);
    }
    
    function  getDireccionYBario(){
        return ($this->getDireccion()." <br>Barrio:  ".$this->getBarrio());
    }
        
    public function getDetalle(){
          return DetalleReserva::getDatosEnObjetos("idreserva={$this->idreserva}",null);
     
    }
    
    function  grabarWeb(){
        $cadenaSQL="insert into domicilio (fechasistema, fechadomicilio, direccion,identificacioncliente, barrio,hora,idplato)values (current_timestamp,'{$this->fechadomicilio}', '{$this->direccion}', '{$this->identificacioCliente}', '{$this->barrio}', '{$this->hora}', '{$this->idplato}')";
		
         ConectorBD::ejecutarQuery($cadenaSQL, null);  
      }
      
    function  grabar(){
        $cadenaSQL="insert into domicilio (fechasistema, fechadomicilio, direccion,identificacioncliente, barrio,hora,idplato,abono)values (current_timestamp,'{$this->fechadomicilio}', '{$this->direccion}', '{$this->identificacioCliente}', '{$this->barrio}', '{$this->hora}', '{$this->idplato}',{$this->abono})";
		
         ConectorBD::ejecutarQuery($cadenaSQL, null);  
      }
    
    function  Modificar(){
        $abono="";
         if($this->abono==null){
             $abono="";
         }else{
             $abono=",abono=".$this->abono;
         }
        $cadenaSQL="update domicilio set idplato=$this->idplato,fechasistema=current_timestamp, fechadomicilio='$this->fechadomicilio', hora='$this->hora', direccion='$this->direccion', barrio='$this->barrio' $abono , identificacioncliente='$this->identificacioCliente'  where iddomicilio=$this->iddomicilio";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
		
         ConectorBD::ejecutarQuery($cadenaSQL, null);  
      }
    
      function eliminar() {
          $cadenaSQL=" delete from detalleorden where domicilio={$this->iddomicilio}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
          $cadenaSQL="delete from domicilio where iddomicilio={$this->iddomicilio}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
          
      }
      
      public static function  getDatos($filtro, $orden){
          $filtro2="and $filtro";
          if($filtro==NULL) $filtro2=" ";
          $cadenaSQL="select iddomicilio,fechadomicilio,hora,fechasistema,abono,identificacioncliente,identificacion,nombres,apellidos,direccion,barrio,telefono,email,sum(vrunitario*cantidad)as total from comanda,domicilio,cliente,detalleorden where identificacion=identificacioncliente and domicilio.iddomicilio=comanda.domicilio $filtro2 group by iddomicilio,identificacion";
          if($orden!=NULL) $cadenaSQL.=" order by $orden";

          return ConectorBD::ejecutarQuery($cadenaSQL, null);
      }
      public static function getDatosEnObjetos($filtro, $orden){
          $datos= Domicilio::getDatos($filtro, $orden);
          $listasSI=array();//se define un arreglo 
		  
          for ($i = 0; $i < count($datos); $i++){
              $si=new Domicilio($datos[$i], NULL);
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
	
	public function getDetallesEnObjetos(){
		
		if($this->getIddomicilio() != '')$parametro=$this->getIddomicilio();
		else $parametro = "null";
		return DetalleOrden::getDatosEnObjetos("domicilio = $parametro ", null); // Buscamos los detalles de dicha factura mandando un filtro de el numero de la factura.
        
    }
	public function getDetalles(){
		
		if($this->getIddomicilio() != '')$parametro=$this->getIddomicilio();
		else $parametro = "null";
		return DetalleOrden::getDatos("domicilio = $parametro ", null); // Buscamos los detalles de dicha factura mandando un filtro de el numero de la factura.
        
    }

}