<?php

class PartidoFutbol extends Partido
{

    public function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2 )
    {
        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
    }

    public function CoeficientePartido () {
        $coefResultante = 0;
        $categoriaPartido = $this->getObjEquipo1()->getObjCategoria()->getDescripcion();
        if ($categoriaPartido == "Menores") {
            $coefResultante = 0.13;
        }
        else if ($categoriaPartido == "juveniles"){
            $coefResultante = 0.19;
        }
        else if ($categoriaPartido == "Mayores"){
            $coefResultante = 0.27;
        }
        return ($coefResultante) * (($this->getCantGolesE1()) + ($this->getCantGolesE2())) *
            (($this->getObjEquipo1()->getCantJugadores()) + ($this->getObjEquipo2()->getCantJugadores()));
    }

}