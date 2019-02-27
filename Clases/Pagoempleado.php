<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagoempleado
 *
 * @author ALEXIS CARATAR
 */
class Pagoempleado {
     private $idpagoempleado;
    private $idempleado;
    private $valorhoraextra;
    private $horasextras;
    private $auxiliotrasporte;
    private $descuentosalud;
    private $descuentopencion;
    private $riesgolaboral;
    private $fechasistema;
    private $fechainicio;
    private $fechafin;
    private $sueldo;
    
    function __construct($campo, $valor) {
        if ($campo!=null){
            if (is_array($campo)) $this->cargarvector($campo);
            else{
                $cadenaSQL="select * from pagoempleado where $campo=$valor ";
                $resultado= ConectorBD::ejecutarQuery($cadenaSQL,null);
                if (count($resultado)>0) $this->cargarvector($resultado[0]);   
            }
        }
    }
    
    private function cargarvector($vector){
        $this->idpagoempleado=$vector['idpagoempleado'];
        $this->idempleado=$vector['idempleado'];
        $this->valorhoraextra=$vector['valorhoraextra'];
        $this->horasextras=$vector['horasextras'];
        $this->auxiliotrasporte=$vector['auxiliotrasporte'];
        $this->descuentopencion=$vector['descuentopencion'];
        $this->riesgolaboral=$vector['riesgolaboral'];
        $this->fechasistema=$vector['fechasistema'];
        $this->fechainicio=$vector['fechainicio'];
        $this->fechafin=$vector['fechafin'];
        $this->sueldo=$vector['sueldo'];
        $this->descuentosalud=$vector['descuentosalud'];
    }
 
    function getValorhoraextra() {
        return $this->valorhoraextra;
    }

    function setValorhoraextra($valorhoraextra) {
        $this->valorhoraextra = $valorhoraextra;
    }    
    function getDescuentosalud() {
        return $this->descuentosalud;
    }

    function setDescuentosalud($descuentosalud) {
        $this->descuentosalud = $descuentosalud;
    }

        function getIdpagoempleado() {
        return $this->idpagoempleado;
    }

    function getIdempleado() {
        return $this->idempleado;
    }

    function getHorasextras() {
        return $this->horasextras;
    }

    function getAuxiliotrasporte() {
        return $this->auxiliotrasporte;
    }

    function getDescuentopencion() {
        return $this->descuentopencion;
    }

    function getRiesgolaboral() {
        return $this->riesgolaboral;
    }
      function getFechasistema() {
        return $this->fechasistema;
    }

    function getFechainicio() {
        return $this->fechainicio;
    }

    function getFechafin() {
        return $this->fechafin;
    }

    function getSueldo() {
        return $this->sueldo;
    }

    function setIdpagoempleado($idpagoempleado) {
        $this->idpagoempleado = $idpagoempleado;
    }

    function setIdempleado($idempleado) {
        $this->idempleado = $idempleado;
    }

    function setHorasextras($horasextras) {
        $this->horasextras = $horasextras;
    }

    function setAuxiliotrasporte($auxiliotrasporte) {
        $this->auxiliotrasporte = $auxiliotrasporte;
    }

    function setDescuentopencion($descuentopencion) {
        $this->descuentopencion = $descuentopencion;
    }

    function setRiesgolaboral($riesgolaboral) {
        $this->riesgolaboral = $riesgolaboral;
    }

     

    function setFechasistema($fechasistema) {
        $this->fechasistema = $fechasistema;
    }
    function setFechainicio($fechainicio) {
        $this->fechainicio = $fechainicio;
    }

    function setFechafin($fechafin) {
        $this->fechafin = $fechafin;
    }

    function setSueldo($sueldo) {
        $this->sueldo = $sueldo;
    }
  public function grabar(){
        $cadenaSQL="INSERT INTO `pagoempleado`( `idempleado`, `horasextras`, `valorhoraextra`, `auxiliotrasporte`, `descuentosalud`, `descuentopencion`, `fechainicio`, `fechafin`, `sueldo`, `fechasistema`, `riesgolaboral`) VALUES "
            ."('{$this->idempleado}',{$this->horasextras},{$this->valorhoraextra},{$this->auxiliotrasporte},{$this->descuentosalud},{$this->descuentopencion},'{$this->fechainicio}','{$this->fechafin}',{$this->sueldo},'{$this->fechasistema}',{$this->riesgolaboral})"; 
            ConectorBD::ejecutarQuery($cadenaSQL, null); 
            print_r($cadenaSQL);
        }
        
    
    public function modificar($idpagoempleado){
        $cadenaSQL="UPDATE `pagoempleado` SET `idempleado`={$this->idempleado},`horasextras`={$this->horasextras},`valorhoraextra`={$this->valorhoraextra},`auxiliotrasporte`={$this->auxiliotrasporte},`descuentosalud`={$this->descuentosalud},`descuentopencion`={$this->descuentopencion},`fechainicio`={$this->fechainicio},"
                . "`fechafin`={$this->fechafin},`sueldo`={$this->sueldo},`fechasistema`='{$this->fechasistema}',`riesgolaboral`={$this->riesgolaboral} WHERE idpagoempleado=$idpagoempleado";
         print_r($cadenaSQL);
        ConectorBD::ejecutarQuery($cadenaSQL, NULL);
    }
  
    public function eliminar() {
        $cadenaSQL="delete from pagoempleado where idpagoempleado={$this->idpagoempleado}";
        ConectorBD::ejecutarQuery($cadenaSQL, null);
        
    }
}
