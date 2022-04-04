<?php
class Viaje{

    private $idViaje;
    private $destinoViaje;
    private $cantMaxPasajeros;
    private $coleccionPasajeros = []; //Arreglo asociativo, se almacenan nombre, apellido y dni del pasajero

    //Metodo Constructor
    public function __construct($id, $destino, $cantMaxima)
    {
        $this->idViaje = $id;
        $this->destinoViaje = $destino;
        $this->cantMaxPasajeros = $cantMaxima;
    }

    //Metodos Getters y Setters
    public function getIdViaje(){
        return $this->idViaje;
    }

    public function setIdViaje($codViaje){
        $this->idViaje = $codViaje;
    }

    public function getDestino(){
        return $this->destinoViaje;
    }

    public function setDestino($destinoSet){
        $this->destinoViaje = $destinoSet;
    }

    public function getCantidadMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }

    public function setCantidadMaxPasajeros($cantMax){
        $this->cantMaxPasajeros = $cantMax;
    }

    public function getColeccionPasajeros(){
        return $this->coleccionPasajeros;
    }

    public function setColeccionPasajeros($arrayPasajeros){
        $this->coleccionPasajeros = $arrayPasajeros;
    }

    /**
     * Agrega un nuevo pasajero
     * 
     * @param array $pasajero
     * @return boolean
      */
    public function agregarPasajero($pasajero){
        $res = false;
        $nuevaColeccion = $this->getColeccionPasajeros();
        $existePasajero = in_array($pasajero,$this->getColeccionPasajeros());
        if ($existePasajero) {
            $res = false;
        } else {
            array_push($nuevaColeccion,$pasajero);
            $this->setColeccionPasajeros($nuevaColeccion);
            $res = true;
        }
        return $res;
    }

    /**
     * Verifica si se puede agregar a mas personas
     * 
     * @param void
     * @return boolean
      */
    public function hayLugar(){
        $res = true;
        $cantidadMax = $this->getCantidadMaxPasajeros();
        $cantPasajeros = count($this->getColeccionPasajeros());
        if ($cantidadMax <= $cantPasajeros) {
            $res = false;
        }
        return $res;
    }

    /**
     * Elimina un pasajero de la coleccion
     * 
     * @param array $pasajero
     * @return boolean
      */
    public function sacarPasajero($pasajero){
        $res = false;
        $coleccionBusqueda = $this->getColeccionPasajeros();
        $existePasajero = in_array($pasajero, $coleccionBusqueda);
        if ($existePasajero) {
            $indice = array_search($pasajero,$coleccionBusqueda);
            array_splice($coleccionBusqueda, $indice, 1);
            $this->setColeccionPasajeros($coleccionBusqueda);
            $res=true;
        }
        return $res;
    }

    /**
     * Modifica los datos de un pasajero
     * 
     * @param array @pasajero
     * @param array @pasajero2
     * @return boolean
     */
    public function modificarDatos($pasajero, $pasajero2){
        $res = false;
        $coleccionPaso = $this->getColeccionPasajeros();
        $existePasajero = in_array($pasajero, $coleccionPaso);
        if ($existePasajero) {
            $indiceColeccion = array_search($pasajero, $coleccionPaso);
            $coleccionPaso[$indiceColeccion] = $pasajero2;
            $this->setColeccionPasajeros($coleccionPaso);
            $res = true;
        }
        return $res;
    }

    /**
     * Muestra en un String los pasajeros
     * 
     * @param void
     * @return String
      */
    private function mostrarPasajeros(){
        $pasajerosString = "";
        $pasajerosColeccion = $this->getColeccionPasajeros();
        foreach ($pasajerosColeccion as $indice => $elemento) {
            $nombre = $elemento["nombre"];
            $apellido = $elemento["apellido"];
            $dni = $elemento["dni"];
            $pasajerosString .= "Nombre: {$nombre} \n Apellido: {$apellido} \n Dni: {$dni} \n";
        }
        return $pasajerosString;
    }

    public function __toString()
    {
        $pasajeros = $this->mostrarPasajeros();
        $coleccionPasajeros = $this->getColeccionPasajeros();
        $cantidad = count($coleccionPasajeros);
        $str = "Viaje: {$this->getIdViaje()}. \n
        Destino: {$this->getDestino()}. \n
        Cant Asientos: {$this->getCantidadMaxPasajeros()}. \n
        Asientos Ocupados: {$cantidad}. \n
        Datos de los pasajeros:\n {$pasajeros}.\n";
        return $str;
    }


}