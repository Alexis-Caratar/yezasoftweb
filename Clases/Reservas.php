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
class Reservas {
      private $idreserva;
      private $estado;
      private $idevento;
      private $idplato;
      private $fechareserva;
      private $hora;
      private $formato;
      private $fechasistema;
      private $nombres;
      private $apellidos;
      private $direccion;
      private $barrio;
      private $telefono;
      private $identificacion;
      private $emails;
      private $clave;
      private $numeropersonas;
      private $abono;
      private $total;
      private $saldo;
      private $observacion;
      private $identificacioCliente;
      private $piso;
      
      function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select idreserva,evento,fechareserva,hora,fechasistema,numeropersona,observacion,abono,sum(vrunitario*cantidad)as total,identificacioncliente,piso,identificacion,nombres,apellidos,direccion,barrio,telefono,email,clave from reserva,cliente,detalleorden where identificacion=identificacioncliente and reserva=idreserva and $campo=$valor group by idreserva,identificacion";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
    
    
      private function cargarvector($vector){
          $this->idreserva=$vector['idreserva'];
          $this->idevento=$vector['evento'];
          $this->fechareserva=$vector['fechareserva'];
          $this->fechasistema=$vector['fechasistema'];
          $this->numeropersonas=$vector['numeropersona'];
          $this->abono=$vector['abono'];
          $this->piso=$vector['piso'];
          $this->observacion=$vector['observacion'];
          $this->identificacioCliente=$vector['identificacioncliente'];
          $this->identificacion=$vector['identificacion'];
          $this->nombres=$vector['nombres'];
          $this->apellidos=$vector['apellidos'];
          $this->direccion=$vector['direccion'];
          $this->barrio=$vector['barrio'];
          $this->hora=$vector['hora'];
          $this->telefono=$vector['telefono'];
          $this->emails=$vector['email'];
          $this->clave=$vector['clave'];
          $this->total=$vector['total'];
      }
      
      function getEstado() {
          return $this->estado;
      }

      function setEstado($estado) {
          $this->estado = $estado;
      }

      function getFormato() {
          return $this->formato;
      }

      function setFormato($formato) {
          $this->formato = $formato;
      }

      function getHora() {
          return $this->hora;
      }

      function setHora($hora) {
          $this->hora = $hora;
      }
      
      function getIdreserva() {
          return $this->idreserva;
      }

      function getIdevento() {
          return $this->idevento;
      }

      function getFechareserva() {
		  $fecha = explode(" ", $this->fechareserva);
          return $fecha[0];
      }

      function getFechasistema() {
          $fecha = explode(".", $this->fechasistema);
          return $fecha[0];
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

      function getNumeropersonas() {
          return  $this->numeropersonas;
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

      function getPiso() {
          return $this->piso;
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

      function setTelefono($telefono) {
          $this->telefono = $telefono;
      }

      function setIdentificacion($identificacion) {
          $this->identificacion = $identificacion;
      }

      function setEmails($emails) {
          $this->emails = $emails;
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

      function setPiso($piso) {
          $this->piso = $piso;
      }
      
      function getClave() {
          return $this->clave;
      }

      function setClave($clave) {
          $this->clave = $clave;
      }

      public function getEventoEnObjeto(){
        return new Evento("idevento", $this->idevento);
    }
    
    function  getNombresCompletos(){
        return ($this->nombres."  ".$this->apellidos);
    }
    
    function  getFechaYHora(){
        return ("Fecha: ".$this->getFechareserva()." <br>Hora:  ".$this->hora." ".$this->getFormato());
    }
    
    function  getDireccionYBario(){
        return ($this->getDireccion()." <br>Barrio:  ".$this->getBarrio());
    }
    
    function  getSaldos(){
        return ($this->getTotal()-$this->getAbono());
    }
    
    function getIdplato() {
        return $this->idplato;
    }
    
    function getSaldo() {
        return $this->saldo;
    }

    function setSaldo($saldo) {
        $this->saldo = $saldo;
    }
    
    function setIdplato($idplato) {
        $this->idplato = $idplato;
    }
    
    public function getDetalle(){
          return DetalleReserva::getDatosEnObjetos("idreserva={$this->idreserva}",null);
      }
      
      function getTotal() {
          return $this->total;
      }

      function setTotal($total) {
          $this->total = $total;
      }
      
      function getBarrio() {
          return $this->barrio;
      }

      function setBarrio($barrio) {
          $this->barrio = $barrio;
      }
      
          
    function  grabar(){
        
        $eventoa="";
         $eventob="";
         if($this->idevento==null){
             $eventoa="";
             $eventob="";
         }else{
             $eventoa="evento,";
             $eventob=$this->idevento.",";
         }
        
        $cadenaSQL="insert into reserva ({$eventoa}fechareserva,hora,fechasistema, numeropersona, direccion,barrio, abono, observacion,identificacioncliente, piso)values ({$eventob}'{$this->fechareserva}', '{$this->hora}', current_timestamp,{$this->numeropersonas}, '{$this->direccion}', '{$this->barrio}',{$this->abono}, '{$this->observacion}', '{$this->identificacioCliente}', '{$this->piso}')";
         ConectorBD::ejecutarQuery($cadenaSQL, null);  
      }
    function  grabarWeb(){
        $eventoa="";
         $eventob="";
         if($this->idevento==null){
             $eventoa="";
             $eventob="";
         }else{
             $eventoa="evento,";
             $eventob=$this->idevento.",";
         }
        $cadenaSQL="insert into reserva ({$eventoa} idplato, fechareserva,hora,fechasistema, numeropersona, direccion,barrio, observacion,identificacioncliente,estado)values ({$eventob}'{$this->idplato}', '{$this->fechareserva}', '{$this->hora}', current_timestamp,{$this->numeropersonas}, '{$this->direccion}', '{$this->barrio}', '{$this->observacion}', '{$this->identificacioCliente}','R')";
         ConectorBD::ejecutarQuery($cadenaSQL, null);  
      }
      
    
     public function Modificar(){
         $abono="";
         $evento="";
         if($this->abono==null){
             $abono="";
         }else{
             $abono=",abono=".$this->abono;
         }
         if($this->idevento==null){
             $evento=",evento=null";
         }else{
             $evento=",evento=".$this->idevento;
         }
        $cadenaSQL="update reserva set idplato=$this->idplato {$evento}, fechasistema=current_timestamp, fechareserva='$this->fechareserva', hora='$this->hora', direccion='$this->direccion', barrio='$this->barrio', numeropersona=$this->numeropersonas $abono , observacion='$this->observacion',identificacioncliente='$this->identificacioCliente', piso='$this->piso'  where idreserva=$this->idreserva";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
      function eliminar() {
          $cadenaSQL=" delete from detalleorden where reserva={$this->idreserva}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
          $cadenaSQL="delete from reserva where idreserva={$this->idreserva}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
          
      }
      public function getMenu(){
          return Menu::getDatosEnObjetos("idSI={$this->id}", 'id');
      }
      public static function  getDatos($filtro, $orden){
          $filtro2="and $filtro";
          if($filtro==NULL) $filtro2=" ";
          $cadenaSQL="select idreserva,fechareserva,hora,evento,fechasistema,numeropersona,observacion,abono,sum(vrunitario*cantidad)as total,identificacioncliente,piso,identificacion,nombres,apellidos,direccion,barrio,telefono,email,clave from reserva,cliente,detalleorden,comanda where identificacion=identificacioncliente and comanda.reserva=reserva.idreserva $filtro2 group by idreserva,identificacion";       
          if($orden!=NULL) $cadenaSQL.=" order by $orden";
          return ConectorBD::ejecutarQuery($cadenaSQL, null);
      }
      public static function getDatosEnObjetos($filtro, $orden){
          $datos= Reservas::getDatos($filtro, $orden);
          $listasSI=array();//se define un arreglo 
		  
          for ($i = 0; $i < count($datos); $i++){
              $si=new Reservas($datos[$i], NULL);
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
		
		if($this->getIdreserva() != '')$parametro=$this->getIdreserva();
		else $parametro = "null";
		return DetalleOrden::getDatosEnObjetos("reserva = $parametro ", null); // Buscamos los detalles de dicha factura mandando un filtro de el numero de la factura.
        
    }
	public function getDetalles(){
		
		if($this->getIdreserva() != '')$parametro=$this->getIdreserva();
		else $parametro = "null";
		return DetalleOrden::getDatos("reserva = $parametro ", null); // Buscamos los detalles de dicha factura mandando un filtro de el numero de la factura.
        
    }

}