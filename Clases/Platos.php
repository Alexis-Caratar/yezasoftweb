<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Plato
 *
 * @author ALEXIS CARATAR
 */

require_once dirname(__FILE__). '\Menu.php';


class Platos {
    
     private  $idplato;
    private  $nombre;
    private  $descripcion;
    private  $valor;
    private  $tiempopreparacion;
    private  $menu;
    private  $tipo; 
    private  $foto;
  
    
    
    function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select *from plato where $campo = $valor ";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
    
    private function cargarvector($vector){
        $this->idplato=$vector['idplato'];
        $this->nombre=$vector['nombre'];
        $this->descripcion=$vector['descripcion'];
        $this->valor=$vector['valor'];
        $this->tiempopreparacion=$vector['tiempopreparacion'];
        $this->menu=$vector['menu'];
        $this->tipo=$vector['tipo'];
        $this->foto=$vector['foto'];
      
    }
    function getIdplato() {
        return $this->idplato;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getValor() {
        return $this->valor;
    }

    function getTiempopreparacion() {
        return $this->tiempopreparacion;
    }

    function getMenu() {
        return $this->menu;
    }
    function  getNombreMenus(){
        return new Menu(' idmenu' , $this->getMenu() );        
    }
    
    function getTipo() {
        return $this->tipo;
    }

    function getFoto() {
        return $this->foto;
    }
    

    function setIdplato($idplato) {
        $this->idplato = $idplato;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setTiempopreparacion($tiempopreparacion) {
        $this->tiempopreparacion = $tiempopreparacion;
    }

    function setMenu($menu) {
        $this->menu = $menu;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }
    
    public function __toString() {
        return $this->nombre;
    }

    
    public function grabar(){
        $cadenaSQL="insert into plato (idplato,nombre,descripcion,valor,tiempopreparacion,menu,tipo,foto) "
                . "values('$this->idplato','$this->nombre','$this->descripcion',$this->valor,$this->tiempopreparacion,$this->menu,'$this->tipo','$this->foto    ')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function grabarservicio($idservicio){
        $cadenaSQL="insert into plato (idplato,nombre,descripcion,valor,tipo,foto) "
                . "values('$idservicio','$this->nombre','$this->descripcion',$this->valor,'$this->tipo','$this->foto')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function Modificar($idplatoanterior){
        $cadenaSQL="update plato set idplato=$this->idplato,nombre='$this->nombre',descripcion='$this->descripcion',valor=$this->valor,tiempopreparacion=$this->tiempopreparacion,menu=$this->menu,tipo='$this->tipo',foto='$this->foto' where idplato='$idplatoanterior'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
  
    public function Eliminar(){
        $cadenaSQL="delete from plato where idplato='$this->idplato'";
        ConectorBD::ejecutarQuery($cadenaSQL,null);
    }

    
public static function  getDatos($filtro,$orden){
    $cadenaSQL="select*from plato ";
    if ($filtro!=null) $cadenaSQL.=" where ". $filtro;
    if ($orden!=null) $cadenaSQL.=" order by ". $orden;
    return ConectorBD::ejecutarQuery($cadenaSQL, NULL);
}

public static function getDatosObjetos($filtro,$orden){
    $datos= Plato::getDatos($filtro, $orden);
    $listasplato= array();
    for ($i = 0; $i < count($datos); $i++) {
        $lista=new Plato($datos[$i], null);
        $listasplato[$i]=$lista;
    }
    return $listasplato;
}

public static function arreglo(){//se crea el arreglo para java script lista de seleccion
    $datos="var plato=new Array();\n";
    
    $objet=  Plato::getDatosObjetos(null, null);
    for ($i = 0; $i < count($objet); $i++) {
        $objetos=$objet[$i];
        $datos.="plato[$i]=new Array();\n";
        $datos.="\t plato[$i][0]='{$objetos->getIdplato()}'\n";
        $datos.="\t plato[$i][1]='{$objetos->getNombre()}'\n";
        $datos.="\t plato[$i][2]={$objetos->getMenu()}\n";
        $datos.="\t plato[$i][3]={$objetos->getValor()}\n";
    }
    return $datos;
}
}
