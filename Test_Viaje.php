<?php
include_once "Viaje.php";

echo "BIENVENIDO A NUESTRA EMPRESA DE VIAJES! :) \n";
echo "Por favor, ingrese los siguientes datos! \n";
echo "------------------------------------------- \n";
echo "Ingresar el codigo del viaje: \n";
$codViaje = trim(fgets(STDIN));
echo "Ingresar el destino: \n";
$destinoViaje = trim(fgets(STDIN));
echo "Ingresar la cantidad maxima de lugares (asientos): \n";
$asientosViaje = trim(fgets(STDIN));

//Creamos el objeto viaje
$objetoViaje = new Viaje($codViaje,$destinoViaje,$asientosViaje);
$terminar = true;

do {
    echo menuPrincipal();
    $opcion = trim(fgets(STDIN));
    switch ($opcion) {
        case 1:
            echo "ID VIAJE (actual): {$objetoViaje->getIdViaje()} .\n";
            echo "Ingresar el nuevo ID: \n";
            $nuevoID = trim(fgets(STDIN));
            $objetoViaje->setIdViaje($nuevoID);
            break;
        case 2:
            echo "DESTINO VIAJE (actual): {$objetoViaje->getDestino()}.\n";
            echo "Ingresar el nuevo DESTINO: \n";
            $nuevoDestino = trim(fgets(STDIN));
            $objetoViaje->setDestino($nuevoDestino);
            break;
        case 3:
            echo "CANTIDAD DE LUGARES (asientos): {$objetoViaje->getCantidadMaxPasajeros()}.\n";
            echo "Ingresar la nueva cantidad de lugares (asientos): \n";
            $nuevaCantidadLugares = trim(fgets(STDIN));
            $objetoViaje->setCantidadMaxPasajeros($nuevaCantidadLugares);
            break;
        case 4:
            echo "Antes de añadir un pasajero, verificamos que haya lugar! \n";
            if ($objetoViaje->hayLugar()) {
                echo "Ingrese los datos del pasajero: \n";
                $datosPasajero = almacenarDatosPasajero();
                if ($objetoViaje->agregarPasajero($datosPasajero)) {
                    echo "Agregado con exito! \n";
                } else {
                    echo "El mismo ya se encuentra en el viaje. \n";
                }
            } else {
                echo "No hay mas lugares en este viaje :( \n";
            }
            break;
        case 5:
            echo "Ingrese los datos del pasajero a eliminar: \n" ;
            $datosPasajero = almacenarDatosPasajero();
            if ($objetoViaje->sacarPasajero($datosPasajero)) {
                echo "Pasajero eliminado! \n";
            } else {
                echo "El pasajero ingresado no se ha encontrado \n";
            }
            break;
        case 6:
            echo "Ingresar los datos del pasajero: \n";
            $datosPasajero = almacenarDatosPasajero();
            echo "Ingrese los nuevos datos: \n";
            $datosPasajero2 = almacenarDatosPasajero();
            if ($objetoViaje->modificarDatos($datosPasajero,$datosPasajero2)) {
                echo "Datos modificados con exito! \n";
            } else {
                echo "El pasajero ingresado no se ha encontrado \n";
            }
            break;
        case 7:
            echo $objetoViaje;
            break;

        default:
            $terminar = false;
            break;
    }
} while ($terminar);

function menuPrincipal(){
    $menu = "
    1) Modificar ID del viaje.\n
    2) Modificar el destino.\n
    3) Modificar la cantidad de lugares (asientos).\n
    4) Añadir Pasajero. \n
    5) Eliminar Pasajero. \n
    6) Modificar Pasajero. \n
    7) Ver Viaje. \n
    8) Salir. \n";
    return $menu;
}

function almacenarDatosPasajero(){
    echo "Ingrese el Nombre: \n";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese el Apellido: \n";
    $apellido = trim(fgets(STDIN));
    echo "Ingrese el DNI: \n";
    $dni = trim(fgets(STDIN));
    $pasajero = ["nombre" => $nombre, "apellido" => $apellido, "dni" => $dni];
    return $pasajero;
}