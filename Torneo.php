<?php

class Torneo
{
    private $colPartidosTorneo;
    private $montoPremio;

    public function __construct($premio) {
        $this->colPartidosTorneo = [];
        $this->montoPremio = $premio;
    }

    public function getColPartidosTorneo(){
        return $this->colPartidosTorneo;
    }
    public function setColPartidosTorneo($colPartidosTorneo){
        $this->colPartidosTorneo = $colPartidosTorneo;
        return $this;
    }

    public function getMontoPremio(){
        return $this->montoPremio;
    }
    public function setMontoPremio($montoPremio){
        $this->montoPremio = $montoPremio;
        return $this;
    }

    public function  ingresarPartido(Equipo $ObjEquipo1, Equipo $ObjEquipo2, $fecha, $tipoPartido)
    {
        $partido = null;
        $partidosTorneo = $this->getColPartidosTorneo();
        $idPartido = 0;
        if ($ObjEquipo1->getObjCategoria()->getDescripcion() == $ObjEquipo2->getObjCategoria()->getDescripcion() &&
            $ObjEquipo1->getCantJugadores() == $ObjEquipo2->getCantJugadores()) {
            $idPartido += 1;
            if($tipoPartido == 'Futbol') {
                $partido = new PartidoFutbol($idPartido,$fecha,$ObjEquipo1,0,$ObjEquipo2,0 );
            }
            else if ($tipoPartido == 'basquetbol') {
                $partido = new PartidoBascketbol($idPartido,$fecha,$ObjEquipo1,0,$ObjEquipo2,0,0);
            }
            array_push($partidosTorneo, $partido);
            $this->setColPartidosTorneo($partidosTorneo);

        }
        return $partido;
    }

    public function darGanadores($deporte) {
        $partidosJugados = $this->getColPartidosTorneo();
        $ganadoresDeporte = [];
        foreach ($partidosJugados as $unPartido) {
            if ($deporte == 'futbol' && $unPartido instanceof PartidoFutbol) {
                $ganadorPartido = $unPartido->darEquipoGanador();
                array_push($ganadoresDeporte, $ganadorPartido);
            }
            else if ($deporte == 'basquet' && $unPartido instanceof PartidoBascketbol) {
                $ganadorPartido = $unPartido->darEquipoGanador();
                array_push($ganadoresDeporte, $ganadorPartido);
            }
        }
        return $ganadoresDeporte;
    }

    public function calcularPremioPartido($OBJPartido) {
        $equipoGanador = $OBJPartido->darEquipoGanador();
        $premioPartido = ($OBJPartido->CoeficientePartido()) * ($this->getMontoPremio());

        $ganadorYPremio = ["equipoGanador" =>$equipoGanador, "premioPartido" => $premioPartido];
        return $ganadorYPremio;
    }
//(premioPartido = Coef_partido * ImportePremio)

}