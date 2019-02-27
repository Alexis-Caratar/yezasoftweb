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

require_once dirname(__FILE__). '/Menu.php';


class Plato {
    
     private  $idplato;
    private  $nombre;
    private  $descripcion;
    private  $valor;
    private  $tiempopreparacion;
    private  $menu;
    private  $tipo; 
    private  $foto;
    private  $observacion;
  
    
    
    function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select *from plato where $campo='$valor' ";
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
        //$this->observacion=$vector['observacion'];
      
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

      function getObservacion() {
        return $this->observacion;
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

  
       function setObservacion($observacion) {
        $this->observacion = $observacion;
    }
     public function getDepartamento(){
        return new Plato("idplato", $this->getIdplato());
    }

    
            
    public function grabar(){
        $cadenaSQL="insert into plato (idplato,nombre,descripcion,valor,tiempopreparacion,menu,tipo,foto) "
                . "values('$this->idplato','$this->nombre','$this->descripcion',$this->valor,$this->tiempopreparacion,$this->menu,'$this->tipo','$this->foto')";
       
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function grabarservicio($idservicio){
        $cadenaSQL="insert into plato (idplato,nombre,descripcion,valor,tipo,foto) "
                . "values('$idservicio','$this->nombre','$this->descripcion',$this->valor,'$this->tipo','$this->foto')";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
    public function Modificar($idplatoanterior){
        $foto="";
        if ($this->foto!="null"){
            $foto=",foto='$this->foto'";
        }
        $cadenaSQL="update plato set idplato='$this->idplato',nombre='$this->nombre',descripcion='$this->descripcion',valor=$this->valor,tiempopreparacion=$this->tiempopreparacion,menu=$this->menu,tipo='$this->tipo' $foto where idplato='$idplatoanterior'";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    
        
    public function Modificarservicio($idplato){
        $foto="";
        if ($this->foto!="null"){
            $foto=",foto='$this->foto'";
        }
              $cadenaSQL="update plato set nombre='$this->nombre',descripcion='$this->descripcion',valor=$this->valor ,tipo='$this->tipo' $foto where idplato='$idplato'";
              print_r($cadenaSQL);
              ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
    public function Eliminar(){
        $cadenaSQL="delete from plato where idplato='$this->idplato'";
        ConectorBD::ejecutarQuery($cadenaSQL,null);
    }
public static function  getDatos($filtro,$orden){
    $cadenaSQL="select*from plato ";
    if ($filtro!=null) $cadenaSQL.=" where ". $filtro;
    if ($orden!=null) $cadenaSQL.=" order by ". $orden ." desc";

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

public static function getlistamenu($preterminado){
    $cadenaSQL="SELECT idmenu,menu.nombre FROM menu";
     $datosmenu= ConectorBD::ejecutarQuery($cadenaSQL,null);
     $listamenus= '';
            for ($i = 0; $i < count($datosmenu); $i++) {
                if ($preterminado==$datosmenu[$i]['idmenu'])    $auxiliar= 'selected';
                else    $auxiliar='';
                $listamenus.="<option value='{$datosmenu[$i]['idmenu']}' $auxiliar >{$datosmenu[$i]['nombre']} </option> ";
        }
    return $listamenus;
}


//codigo jefry

public static function getListaEnOptions($predeterminado){
        $sistemas= Plato::getDatosObjetos("tipo='P'", 'idplato');
        $lista="";
        for ($i = 0; $i < count($sistemas); $i++) {
            $si=$sistemas[$i];
            if($predeterminado==$si->getIdplato()) $auxiliar='selected';
            else $auxiliar='';
            $lista.="<option value='{$si->getIdplato()}' $auxiliar>{$si->getNombre()}</option>";
        }
        return $lista;
    }

public function actualizarAccesos($opciones){
        $cadenaSQL="delete from reserva where idplato={$this->idplato}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        for ($i = 0; $i < count($opciones); $i++) {
            $cadenaSQL="insert into reserva (idplato) values ('{$this->idplato}')";
            ConectorBD::ejecutarQuery($cadenaSQL, null);
            
        }
    }

    public  static function getDatosEnArreglosJS(){
        $datos="var departamentos=new Array();\n";
        $departamentos= Plato::getDatosObjetos(null, "nombre");
        for ($i = 0; $i < count($departamentos); $i++) {
            $departamento=$departamentos[$i];
            $datos.="departamentos[$i]=new Array();\n";
            $datos.="\tdepartamentos[$i][0]='{$departamento->getIdplato()}'\n";
            $datos.="\tdepartamentos[$i][1]='{$departamento->getNombre()}'\n";
            $datos.="\tdepartamentos[$i][2]='{$departamento->getMenu()}'\n";
            
        }
        return $datos;
    }
    
    public static function getDatosEnArregloJS(){
        $datos="var productos=new Array();\n";
        $Producto=Plato::getDatosObjetos(null, "nombre");
        for ($i = 0; $i < count($Producto); $i++) {
            $producto=$Producto[$i];
            $datos.="productos[$i]=new Array();\n";
            $datos.="\t productos[$i][0]='{$producto->getIdplato()}';\n";
            $datos.="\t productos[$i][1]='{$producto->getNombre()}';\n";
            $datos.="\t productos[$i][2]='{$producto->getValor()}';\n";
        }
        return $datos;
    }
   

    public function getAccesos(){
        //Devuelve un vector de opciones con aquellas a las cuales tenga permiso el perfil.
        return Plato::getDatosObjetos("idplato in (select idplato from plato where  tipo='{$this->tipo}')", null);
    }
    
    public function getAccesosEnId(){
        //devuelve un vector con los id de las opciones a las cuales tiene permiso
        $accesos= $this->getAccesos();
        $arreglo= array();
        for($i=0; $i< count($accesos); $i++){
            $arreglo[$i]=$accesos[$i]->getIdplato();
        }
        return $arreglo;
    }

}
