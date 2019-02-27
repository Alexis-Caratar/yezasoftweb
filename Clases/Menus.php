<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.ZULLY
 */

/**
 * Description of Menu
 *
 * @author ALEXIS CARATAR
 */
require_once dirname(__FILE__). '\Menu.php';
require_once dirname(__FILE__). '\Plato.php';

class Menus {
    private  $idmenu;
    private  $nombre;
    
    /*
    function __toString() {
        return $this->nombre;;
    }
     */
    
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
    if ($orden!=null) $cadenaSQL.=" order by ". $orden;
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
public static function getlistamenu($preterminado){
    $datosmenu= Menu::getDatosObjetos(NULL, 'nombre');
    
    $listamenus= '';
    for ($i = 0; $i < count($datosmenu); $i++) {
        $menu=$datosmenu[$i];
        if ($preterminado==$menu->getIdmenu())    $auxiliar= 'selected';
        else 
            $auxiliar='';
        $listamenus.="<option value='{$menu->getIdmenu()}' $auxiliar >{$menu->getNombre()} </option> ";
    }    
        return $listamenus;
    
}
public static function listaOpcciones($menu){
    $elemento =  Menu::getDatosObjetos(null, null);//llamando al datos en eobjeto para costruir el objeto en menu
    $lista="<option value='' name='' >lista menu</option>";
    for ($i = 0; $i < count($elemento); $i++ ) {
        
        $si=$elemento[$i];
        if ($menu==$si->getIdmenu()) {
            $auxiliar='selected';
        }else{
            $auxiliar='';
        }
        $lista.="<option value='{$si->getIdmenu()}' $auxiliar>{$si->getNombre()}</option>";
    }
    
    return $lista;
}
}

