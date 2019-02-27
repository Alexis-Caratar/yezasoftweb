<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DetalleOrden
 *
 * @author zuliban
 */
class DetalleOrdenes {
    //put your code here
    
	private $iddetalle;
	private $cantidad;
	private $comanda;
	private $nota;
	private $plato;
	private $domicilio;
	private $vrunitario;
	private $reserva;

	function __construct($campo, $valor) {
		if ($campo != null) {
			if (is_array($campo)){
                            $this->cargarvector($campo);
                        }else {
				
                           $cadenaSQL = "select comanda,plato.nombre, vrunitario,cantidad,sum(vrunitario*cantidad) as subtotal from detalleorden,plato where plato=idplato and $campo=$valor group by plato.nombre,vrunitario,cantidad,comanda";
			    $resultado = ConectorBD::ejecutarQuery($cadenaSQL, null);
				if (count($resultado) > 0)
					$this->cargarvector($resultado[0]);
			}
		}
	}

	private function cargarvector($vector) {
		$this->iddetalle = $vector[0];
		$this->comanda = $vector[1];
		$this->cantidad = $vector[2];
		$this->nota = $vector[3];
		$this->plato = $vector[4];
		$this->domicilio = $vector[5];
		$this->vrunitario = $vector[6];
		$this->reserva = $vector[7];
	}

	function getIddetalle() {
		return $this->iddetalle;
	}

	function getComanda() {
		return $this->comanda;
	}

	function getCantidad() {
		return $this->cantidad;
	}

	function getNota() {
		return $this->nota;
	}

	function getPlato() {
	        return new Platos('idplato', "'".$this->plato."'");
	}
	function Plato() {
	        return $this->plato;
	}

	function getObjetoPlato() {
		$this->plato;

		return new Plato("idPlato", $this->plato);
	}

	function getDomicilio() {

		return $this->domicilio;
	}

	function getVrunitario() {
		return $this->vrunitario;
	}

	function getReserva() {
		return $this->reserva;
	}

	function setIddetalle($iddetalle) {
		$this->iddetalle = $iddetalle;
	}

	function setComanda($comanda) {
		$this->comanda = $comanda;
	}

	function setCantidad($cantidad) {
		$this->cantidad = $cantidad;
	}

	function setNota($nota) {
		$this->nota = $nota;
	}

	function setPlato($plato) {
		$this->plato = $plato;
	}

	function setDomicilio($domicilio) {
		$this->domicilio = $domicilio;
	}

	function setVrunitario($vrunitario) {
		$this->vrunitario = $vrunitario;
	}

	function setReserva($reserva) {
		$this->reserva = $reserva;
	}

//	public function getSubt() {
//		return $this->vrunitario * $this->cantidad;
//	}

	public function getCiudad() {
		return new Plato("idplato", $this->getPlato());
	}

	public function getDepartamento() {
		return new Plato("idplato", $this->getPlato());
	}
	
	public function grabar() {
		$cadenaSQL ="insert into detalleOrden(comanda, cantidad, nota, plato, domicilio, vrUnitario, reserva) "
                        . "values($this->comanda, {$this->cantidad}, '{$this->nota}', '{$this->plato}', {$this->domicilio}, {$this->vrunitario}, {$this->reserva})";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
        }
	
        public function grabarComanda() {
		$cadenaSQL ="insert into detalleOrden(comanda, cantidad, nota, plato, vrUnitario) values($this->comanda, {$this->cantidad},'{$this->nota}', '{$this->plato}', {$this->vrunitario})";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
        
	public function grabarDomicilio() {
		$cadenaSQL ="insert into detalleOrden(comanda, cantidad, nota, plato, domicilio, vrUnitario, reserva) values($this->comanda, {$this->cantidad}, '{$this->nota}', '{$this->plato}', {$this->domicilio}, {$this->vrunitario}, {$this->reserva})";
		ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
        
	public static function getDatos($filtro, $orden) {
		$cadenaSQL = "select * from detalleorden ";
		if ($filtro != NULL)
			$cadenaSQL .= " where $filtro";
		if ($orden != NULL)
			$cadenaSQL .= " order by $orden";

		return ConectorBD::ejecutarQuery($cadenaSQL, null);
	}
        public static function getDatosComanda($filtro, $orden) {
		$cadenaSQL = "select comanda, cantidad, nota, plato, vrUnitario from detalleorden ";
		if ($filtro != NULL)
			$cadenaSQL .= " where $filtro";
		if ($orden != NULL)
			$cadenaSQL .= " order by $orden";
                    

		return ConectorBD::ejecutarQuery($cadenaSQL, null);
	}

	public static function getDatosEnObjetos($filtro, $orden) {

		$datos = DetalleOrdenes::getDatos($filtro, $orden);
		$listasSI = array(); //se define un arreglo 
		for ($i = 0; $i < count($datos); $i++) {
			$si = new DetalleOrdenes($datos[$i], NULL);
			$listasSI[$i] = $si;
		}
		return $listasSI;
	}

	public static function getListaEnOptions($predeterminado) {
		$sistemas = Evento::getDatosEnObjetos(null, 'nombre');
		$lista = "";
		for ($i = 0; $i < count($sistemas); $i++) {
			$si = $sistemas[$i];
			if ($predeterminado == $si->getId())
				$auxiliar = 'selected';
			else
				$auxiliar = '';
			$lista .= "<option value='{$si->getId()}' $auxiliar>{$si->getNombre()}</option>";
		}
		return $lista;
	}
        
        public function eliminar(){
            $cadenaSQL="delete from detalleorden where iddetalle={$this->iddetalle}";
            print_r($cadenaSQL);
            ConectorBD::ejecutarQuery($cadenaSQL, NULL);
        } 
        public function modificar(){
        $cadenaSQL="UPDATE detalleorden SET cantidad={$this->cantidad},nota='$this->nota',plato='$this->plato',vrunitario=$this->vrunitario."
           ." WHERE iddetalle={$this->iddetalle}";
          ConectorBD::ejecutarQuery($cadenaSQL, null);
    }
     

}
