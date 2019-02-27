<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cargo
 *
 * @author ALEXIS CARATAR
 */
class Cargo {
    private  $idcargo;
    private  $nombre;
    private  $sueldo;
    
    function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select  idcargo,nombre,sueldo from cargo where $campo=$valor ";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
    
    private function cargarvector($vector){
        $this->idcargo=$vector['idcargo'];
        $this->nombre=$vector['nombre'];
        $this->sueldo=$vector['sueldo'];
    }
    
    function getIdcargo() {
        return $this->idcargo;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getSueldo() {
        return $this->sueldo;
    }

    function setIdcargo($idcargo) {
        $this->idcargo = $idcargo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setSueldo($sueldo) {
        $this->sueldo = $sueldo;
    }

        
    public function grabar(){
        $cadenaSQL="insert into cargo (nombre,sueldo) values('$this->nombre',$this->sueldo  )";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public function Modificar(){
        $cadenaSQL="update cargo set nombre='$this->nombre',sueldo=$this->sueldo  where idcargo=$this->idcargo";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public function Eliminar(){
        $cadenaSQL="delete from cargo where idcargo=$this->idcargo";
        ConectorBD::ejecutarQuery($cadenaSQL,null);
    }

    
public static function  getDatos($filtro,$orden){
    $cadenaSQL="select*from cargo ";
    if ($filtro!=null) $cadenaSQL.=" where ". $filtro;
    if ($orden!=null) $cadenaSQL.=" order by ". $orden." desc";
    return ConectorBD::ejecutarQuery($cadenaSQL, NULL);
}

public static function getDatosObjetos($filtro,$orden){
    $datos= Cargo::getDatos($filtro, $orden);
    $listascargos= array();
    for ($i = 0; $i < count($datos); $i++) {
        $lista=new Cargo($datos[$i], null);
        $listascargos[$i]=$lista;
    }
    return $listascargos;
}
}
