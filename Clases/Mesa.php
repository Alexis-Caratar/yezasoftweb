<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mesa
 *
 * @author zuliban
 */
class Mesa {
    //put your code here
    private $idmesa;
    private $area;
    private $color;
    private $mesainicial;
    private $piso;
    
    function __construct($campo, $valor) {
       if ($campo!=NULL) {//si campo no esta basio
            if (is_array($campo)) $this->cargarObjetoEnVector ($campo);//pregunta es arreglo por verdadero llama al cargar vector
            else {//por falso carga una consulta en la base de datos
                $cadenaSQL="select * from mesa where $campo='$valor'";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL, null);//llega como nulo por que estmos con la base de datos admin
                if(count($resultado)>0) $this->cargarObjetoEnVector ($resultado[0]);//debuelve el primero 
                //conut cuenta cuantas filas tiene el elemento
            }
            
        }
    }
    private function cargarObjetoEnVector($vector){
         $this->idmesa = $vector[0];
        $this->area = $vector[1];
        $this->color = $vector[2];
        $this->mesainicial = $vector[3];
        $this->piso = $vector[4];
        
    }
    function getIdmesa() {
        return $this->idmesa;
    }

    function getArea() {
        return $this->area;
    }

    function getColor() {
        return $this->color;
    }

    function getMesainicial() {
        return $this->mesainicial;
    }
 

    function getPiso() {
        return $this->piso;
    }

    function setIdmesa($idmesa) {
        $this->idmesa = $idmesa;
    }

    function setArea($area) {
        $this->area = $area;
    }

    function setColor($color) {
        $this->color = $color;
    }

    function setMesainicial($mesainicial) {
        $this->mesainicial = $mesainicial;
    }
/**
    function setNumesa($numesa) {
        $this->numesa = $numesa;
    }**/

    function setPiso($piso) {
        $this->piso = $piso;
    }

    public function modificar($idanterior){
        $cadenaSQL="update mesa set area='{$this->area}', color='{$this->color}', mesainicial='{$this->mesainicial}',  piso='{$this->piso}'"
        . " where idmesa =".$idanterior;
        ConectorBD::ejecutarQuery($cadenaSQL, NULL);
    }
    public function grabar(){
        $cadenaSQL="insert into mesa(area, color, mesainicial,  piso) values"
            ."('{$this->area}','{$this->color}','{$this->mesainicial}','{$this->piso}')"; 
            ConectorBD::ejecutarQuery($cadenaSQL, null);            
        }
        
    public function eliminar() {
        $cadenaSQL="delete from mesa where idmesa={$this->idmesa}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        
    }
    
    public static function getDatos($filtro, $orden){
        $cadenaSQL="select * from mesa";
        if($filtro!=null) $cadenaSQL.=" where $filtro";//si filtro no es basio hace la consulta el friltro
        if($orden!=null) $cadenaSQL.=" order by $orden";//si no llega basia en la cadena sql ordena
         return ConectorBD::ejecutarQuery($cadenaSQL, null) ;
    }
    public static function getDatosEnObjeto($filtro, $orden){
        $datos=  Mesa::getDatos($filtro, $orden);
        $listaMesa=  array();//secrea una variable de arregls o define arreglo=string[][]lista= 
        for($i =0; $i< count($datos);$i++){//recorrer arreglos
            $lista=new MESA($datos[$i],null);
            $listaMesa[$i]=$lista;//es envisado en un vector e objeto
        }
        return $listaMesa;
    }

 public static function getlistamesa($preterminado){
    $datosmesa= Mesa::getDatosObjetos(NULL, 'area');
    
    $listamesa= '';
    for ($i = 0; $i < count($datosmesa); $i++) {
        $mesa=$datosmesa[$i];
        if ($preterminado==$mesa->getIdmenu())    $auxiliar= 'selected';
        else 
            $auxiliar='';
        $listamesa.="<option value='{$mesa->getIdmesa()}' $auxiliar >{$mesa->getArea()} </option> ";
    }    
        return $listamesa;
    
}   
    
    
}

