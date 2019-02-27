<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author ALEXIS CARATAR
 */
require_once dirname(__FILE__). '/Plato.php';

class Menu {
    private  $idmenu;
    private  $nombre;
    
    
    function __toString() {
        return $this->nombre;
    }
     
    
    function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select idmenu,nombre from menu where $campo=$valor ";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
    
    private function cargarvector($vector){
        $this->idmenu=$vector['idmenu'];
        $this->nombre=$vector['nombre'];
    }
    function getIdmenu() {
        return $this->idmenu;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setIdmenu($idmenu) {
        $this->idmenu = $idmenu;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    
    public function grabar(){
        $cadenaSQL="insert into menu (nombre) values('$this->nombre'  )";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public function Modificar(){
        $cadenaSQL="update menu set nombre='$this->nombre'  where idmenu=$this->idmenu";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public function Eliminar(){
        $cadenaSQL="delete from menu where idmenu=$this->idmenu";
        ConectorBD::ejecutarQuery($cadenaSQL,null);
    }

    
public static function  getDatos($filtro,$orden){
    $cadenaSQL="select idmenu,nombre from menu ";
    if ($filtro!=null) $cadenaSQL.=" where ". $filtro;
    if ($orden!=null) $cadenaSQL.=" order by ". $orden." desc";
    return ConectorBD::ejecutarQuery($cadenaSQL, NULL);
}

public static function getDatosObjetos($filtro,$orden){
    $datos= Menu::getDatos($filtro, $orden);
    $listasmenu= array();
    for ($i = 0; $i < count($datos); $i++) {
        $lista=new Menu($datos[$i], null);
        $listasmenu[$i]=$lista;
    }
    return $listasmenu;
}

}
