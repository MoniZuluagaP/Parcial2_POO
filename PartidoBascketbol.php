<?php

class PartidoBascketbol extends Partido
{
    private $cantInfracciones;

    public function __construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2, $infracciones )
    {
        parent::__construct($idpartido, $fecha, $objEquipo1, $cantGolesE1, $objEquipo2, $cantGolesE2);
        $this->cantInfracciones = $infracciones;
    }

    public function getCantInfracciones(){
        return $this->cantInfracciones;
    }
    public function setCantInfracciones($cantInfracciones){
        $this->cantInfracciones = $cantInfracciones;
    }


    public function CoeficientePartido () {
        $coeficiente_base_partido = parent::CoeficientePartido();
        return ($coeficiente_base_partido - (0.75 * ($this->getCantInfracciones())));
    }

//coef = coeficiente_base_partido - (coef_penalización*cant_infracciones);
}