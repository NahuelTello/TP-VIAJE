<?php
class Viaje{

    private $idViaje;
    private $destinoViaje;
    private $cantMaxPasajeros;
    private $coleccionPasajeros = []; //Arreglo asociativo, se almacenan nombre, apellido y dni del pasajero
    private $objResponsableViaje;

    //Metodo Constructor
    public function __construct($id, $destino, $cantMaxima, $instanciaResponsable)
    {
        $this->idViaje = $id;
        $this->destinoViaje = $destino;
        $this->cantMaxPasajeros = $cantMaxima;
        $this->objResponsableViaje = $instanciaResponsable;
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

    public function getResponsableViaje(){
        return $this->objResponsableViaje;
    }

    public function setRespondableViaje($nuevoResponsable){
        $this->objResponsableViaje = $nuevoResponsable;
    }

    /**
     * Agrega un nuevo pasajero
     * 
     * @param array $pasajero
     * @return boolean
      */
    public function agregarPasajero($objPasajero){
        $res = false;
        $nuevaColeccion = $this->getColeccionPasajeros();
        $longArreglo = count($nuevaColeccion);
        $noEsEncontrado = true;
        $i = 0;
        $comparaDni = $objPasajero->getDni();
        while ($noEsEncontrado && $i< $longArreglo) {
            $seleccionadoPasajero = $nuevaColeccion[$i];
            $seleccionadoDni = $seleccionadoPasajero->getDni();

            if ($seleccionadoDni == $comparaDni) {
                $noEsEncontrado = false;
            }
            $i++;
        }

        if ($noEsEncontrado) {
            $res = true;
            $longArreglo = count($nuevaColeccion);
            if ($longArreglo == 0) {
                $nuevaColeccion[0] = $objPasajero;
            } else {
                $nuevaColeccion[$longArreglo] = $objPasajero;
            }

            $this->setColeccionPasajeros($nuevaColeccion);
        } else {
            $res = false;
        }

       /*  $existePasajero = in_array($pasajero,$this->getColeccionPasajeros()); */
        /* if ($existePasajero) {
            $res = false;
        } else {
            array_push($nuevaColeccion,$pasajero);
            $this->setColeccionPasajeros($nuevaColeccion);
            $res = true;
        } */
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
        $coleccionPasajeros = $this->getColeccionPasajeros();
        $longArray = count($coleccionPasajeros);
        if ($cantidadMax <= $longArray ) {
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
    public function sacarPasajero($dni){
        $res = false;
        $coleccionBusqueda = $this->getColeccionPasajeros();
        $longArray = count($coleccionBusqueda);
        $j = 0;
        $indice = 0;
        $noEsEncontrado = true;

        //Buscamos el pasajero con un while
        while ($noEsEncontrado || $j < $longArray) {
            $seleccionadoPasajero = $coleccionBusqueda[$j];
            $seleccionadoDni = $seleccionadoPasajero->getDni();

            if ($seleccionadoDni == $dni) {
                $noEsEncontrado = false;
                $indice = $j;
            }
            $j++;
        }

        if (!$noEsEncontrado) {
            $nuevaColeccionSinPasajeros = [];
            foreach ($coleccionBusqueda as $clave => $elemento) {
                $long = count($nuevaColeccionSinPasajeros);
                if ($indice != $clave) {
                    if ($long == 0) {
                        $nuevaColeccionSinPasajeros[0] = $elemento;
                    } else {
                        $nuevaColeccionSinPasajeros[$long] = $elemento;
                    }
                }
            }
            $this->setColeccionPasajeros($nuevaColeccionSinPasajeros);
            $res = true;
        } else {
            $res = false;
        }


        /* if ($existePasajero) {
            $indice = array_search($pasajero,$coleccionBusqueda);
            array_splice($coleccionBusqueda, $indice, 1);
            $this->setColeccionPasajeros($coleccionBusqueda);
            $res=true;
        } */
        return $res;
    }

    /**
     * Modifica los datos de un pasajero
     * 
     * @param int $dni
     * @return boolean
     */
    public function modificarDatos($dni){
        $res = false;
        $coleccionPaso = $this->getColeccionPasajeros();
        $long = count($coleccionPaso);
        $noEsEncontrado = true;
        $k =0;
        $indice = 0 ;

        //Buscamos el pasajero con un while
        while ($noEsEncontrado &&  $k < $long) {
            $seleccionadoPasajero = $coleccionPaso[$k];
            $seleccionadoDni = $seleccionadoPasajero->getDni();

            if ($dni == $seleccionadoDni) {
                $noEsEncontrado = false;
                $indice = $k;
                $res = true;
            }
            $k++;
        }

        if (!$noEsEncontrado) {
            $objPasajero = $coleccionPaso[$indice];
            $this->menuModificar($objPasajero);
            $coleccionPaso[$indice] = $objPasajero;
        }



        /* if ($existePasajero) {
            $indiceColeccion = array_search($pasajero, $coleccionPaso);
            $coleccionPaso[$indiceColeccion] = $pasajero2;
            $this->setColeccionPasajeros($coleccionPaso);
            $res = true;
        } */
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
        foreach ($this->getColeccionPasajeros() as $indice => $elemento) {
            $objPasajero = $elemento;
            $str = $objPasajero->__toString();
            $pasajerosString .= $str;
        }
        return $pasajerosString;
    }

    private function menuModificar($objPasajero){
        $menu = "1- Modificar Nombre\n2- Modificar Apellido\n3- Modificar Dni\n4- Modificar Telefono\n 5- Ver Informacion\n6- Salir";
        $terminar = true;

        do {
            echo $menu;
            $opcion = trim(fgets(STDIN));
            switch ($opcion) {
                case 1:
                    echo "Ingrese el nuevo nombre: \n";
                    $nuevoNombre = trim(fgets(STDIN));
                    $objPasajero->setNombre($nuevoNombre);
                    break;

                case 2:
                    echo "Ingrese el nuevo apellido: \n";
                    $nuevoApellido = trim(fgets(STDIN));
                    $objPasajero->setApellido($nuevoApellido);
                    break;

                case 3:
                    echo "Ingrese el nuevo dni: \n";
                    $nuevoDni = intval(trim(fgets(STDIN)));
                    $objPasajero->setDni($nuevoDni);
                    break;

                case 4:
                    echo "Ingrese el nuevo telefono: \n";
                    $nuevoTelefono = trim(fgets(STDIN));
                    $objPasajero->setTelefono($nuevoTelefono);
                    break;

                case 5:
                    echo $objPasajero;
                    break;

                default:
                    $terminar = false;
                    break;
            } 
        }while ($terminar);
        return $objPasajero;
    }

    public function __toString()
    {
        $pasajerosStr = $this->mostrarPasajeros();
        $coleccionPasajeros = $this->getColeccionPasajeros();
        $responsableViaje = $this->getResponsableViaje();
        $responsableViajeStr = $responsableViaje->__toString();
        $cantidadPasajeros = count($coleccionPasajeros);
        $str = "Viaje - {$this->getIdViaje()} \nDestino - {$this->getDestino()} \nCantidad de Lugares - {$this->getCantidadMaxPasajeros()} \nLugares Ocupados - {$cantidadPasajeros} \nDatos del Responsable -\n{$responsableViajeStr}\nDatos de Pasajeros - {$pasajerosStr}";
        return $str;
    }


}