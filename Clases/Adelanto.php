<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adelanto
 *
 * @author ALEXIS CARATAR
 */
class Adelanto {
    
    private  $idadelanto;
    private  $valor;
    private  $fecha;
    private  $idempleado;
    
    
    function __construct($campo,$valor) {
       if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select  idadelanto,valor,fecha from adelanto where $campo=$valor ";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }    
    }
    
    
      private function cargarvector($vector){
        $this->idadelanto=$vector['idadelanto'];
        $this->valor=$vector['valor'];
        $this->fecha=$vector['fecha'];
    }
    

    function getIdadelanto() {
        return $this->idadelanto;
    }

    function getValor() {
        return $this->valor;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getIdempleado() {
        return $this->idempleado;
    }

    function setIdadelanto($idadelanto) {
        $this->idadelanto = $idadelanto;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setIdempleado($idempleado) {
        $this->idempleado = $idempleado;
    }


    
    public function grabar(){
        $cadenaSQL="insert into adelanto (valor,fecha,idempleado) values('$this->valor','$this->fecha','$this->idempleado')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public function Modificar(){
        $cadenaSQL="update adelanto set valor='$this->valor',fecha='$this->fecha', idempleado='$this->idempleado' where idadelanto=$this->idadelanto";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public function Eliminar(){
        $cadenaSQL="delete from adelanto where idadelanto='$this->idadelanto'";
        ConectorBD::ejecutarQuery($cadenaSQL,null);
    }

    
public static function  getDatos($filtro,$orden){
    $cadenaSQL="select*from adelanto";
    if ($filtro!=null) $cadenaSQL.=" where ". $filtro;
    if ($orden!=null) $cadenaSQL.=" order by ". $orden;
    return ConectorBD::ejecutarQuery($cadenaSQL, NULL);
}

public static function getDatosObjetos($filtro,$orden){
    $datos= Adelanto::getDatos($filtro, $orden);
    $listaadelantos= array();
    for ($i = 0; $i < count($datos); $i++) {
        $lista=new Adelanto($datos[$i], null);
        $listaadelantos[$i]=$lista;
    }
    return $listaadelantos;
}
    
    
}
